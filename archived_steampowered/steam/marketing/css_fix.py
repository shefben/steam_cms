#!/usr/bin/env python3
# Python 3.9 ? CSS dedup (whitespace-insensitive), HTML rewrite, JSON report
import os
import re
import json
import hashlib
from pathlib import Path

ENCODING = "latin-1"
DELETE_DUPLICATES = False  # True to delete non-reference duplicates
ABS_IGNORE_PREFIXES = ("http://", "https://", "//", "data:", "mailto:", "#")
REPORT_FILENAME = "css_dedupe_report.json"

# ---------- helpers ----------
def is_css(p: Path) -> bool:
    return p.suffix.lower() == ".css"

def is_html(p: Path) -> bool:
    return p.suffix.lower() in (".html", ".htm")

def iter_all_files(base: Path):
    for dirpath, _, filenames in os.walk(base):
        for name in filenames:
            yield Path(dirpath) / name

def iter_css_files_in_subdirs(base: Path):
    for dirpath, _, filenames in os.walk(base):
        d = Path(dirpath)
        for name in filenames:
            p = d / name
            if d == base:
                continue  # only subdirs
            if is_css(p):
                yield p

def norm_abskey(p: Path) -> str:
    return p.resolve().as_posix().casefold()

def to_posix(p: str) -> str:
    return p.replace("\\", "/")

def unique_dest_name(base_dir: Path, target_name: str) -> Path:
    dest = base_dir / target_name
    if not dest.exists():
        return dest
    stem, ext = os.path.splitext(target_name)
    i = 2
    while True:
        cand = base_dir / f"{stem}_{i}{ext}"
        if not cand.exists():
            return cand
        i += 1

def split_url_keep_suffix(url: str):
    m = re.match(r'^([^?#]+)([?#].*)?$', url)
    if not m:
        return url, ""
    return m.group(1), (m.group(2) or "")

# ---------- CSS grouping (whitespace-insensitive) ----------
_whitespace_re = re.compile(r"\s+", re.MULTILINE)

def css_digest_ignore_ws(path: Path) -> bytes:
    try:
        text = path.read_text(encoding=ENCODING, errors="ignore")
    except Exception:
        # fallback: binary -> latin-1 decode
        data = path.read_bytes()
        text = data.decode(ENCODING, errors="ignore")
    # Remove ALL whitespace (spaces, tabs, newlines, CR/LF, etc.)
    normalized = _whitespace_re.sub("", text)
    h = hashlib.sha1()
    h.update(normalized.encode(ENCODING, errors="ignore"))
    return h.digest()

def group_css_by_normhash(base: Path):
    groups = {}
    for p in iter_css_files_in_subdirs(base):
        try:
            dig = css_digest_ignore_ws(p)
        except Exception as e:
            print(f"[WARN] Skipping unreadable CSS {p}: {e}")
            continue
        groups.setdefault(dig, []).append(p.resolve())
    # Sort each group for determinism
    for k in groups:
        groups[k].sort()
    return groups

# ---------- planning ----------
def plan_groups(base_dir: Path):
    """
    Returns:
      group_list: [
        {
          'index': int,
          'ref_css': Path,
          'dest_path': Path,
          'members': [Path]
        }, ...
      ]
      css_abskey_to_group: { abskey: index }
      css_abskey_to_destname: { abskey: dest_filename }
    """
    g = group_css_by_normhash(base_dir)
    if not g:
        return [], {}, {}

    # Deterministic order by first member path, then digest
    ordered = sorted(g.items(), key=lambda kv: (str(kv[1][0]) if kv[1] else "", kv[0]))
    group_list = []
    css_abskey_to_group = {}
    css_abskey_to_destname = {}

    for idx, (digest, members) in enumerate(ordered, start=1):
        ref_css = members[0]
        base_no_ext = ref_css.stem
        dest_name = f"{base_no_ext}{idx}.css"
        dest_path = unique_dest_name(base_dir, dest_name)

        group_list.append({
            "index": idx,
            "ref_css": ref_css,
            "dest_path": dest_path,
            "members": members,
        })

        for m in members:
            key = norm_abskey(m)
            css_abskey_to_group[key] = idx
            css_abskey_to_destname[key] = dest_path.name

    return group_list, css_abskey_to_group, css_abskey_to_destname

# ---------- HTML rewrite ----------
def rewrite_all_htmls(base_dir: Path, css_abskey_to_destname: dict, per_group_htmls: dict):
    """
    For each HTML/HTM file anywhere under base_dir:
      - Find <link ... href="..."> that resolve to a CSS in css_abskey_to_destname
      - Rewrite href to the deduped CSS at base_dir (relative path)
      - Record the HTML in per_group_htmls[group_index]
    """
    for html_path in iter_all_files(base_dir):
        if not is_html(html_path):
            continue

        try:
            text = html_path.read_text(encoding=ENCODING, errors="strict")
        except Exception:
            text = html_path.read_text(encoding=ENCODING, errors="ignore")

        html_dir = html_path.parent
        changed = False

        def repl_link(match):
            nonlocal changed
            tag = match.group(0)
            attrs_str = match.group("attrs")

            rel_m = re.search(r'\brel\s*=\s*("|\')([^"\']*)\1', attrs_str, flags=re.I)
            href_m = re.search(r'\bhref\s*=\s*("|\')(?P<val>[^"\']*)\1', attrs_str, flags=re.I)
            if not href_m:
                return tag

            rel_val = (rel_m.group(2) if rel_m else "")
            href_val = href_m.group("val")

            # Only touch if rel includes 'stylesheet' OR href ends with .css
            if (rel_val and "stylesheet" not in rel_val.lower()) and not href_val.lower().endswith(".css"):
                return tag

            href_core, href_suffix = split_url_keep_suffix(href_val)
            if href_core.strip().lower().startswith(ABS_IGNORE_PREFIXES):
                return tag

            target_abs = (html_dir / href_core.replace("/", os.sep)).resolve()
            abskey = norm_abskey(target_abs)

            dest_filename = css_abskey_to_destname.get(abskey)
            if not dest_filename:
                return tag  # not a grouped CSS

            # Relative path from this HTML to base_dir
            rel_to_base = os.path.relpath(base_dir, html_dir)
            new_href = dest_filename if rel_to_base == "." else to_posix(str(Path(rel_to_base) / dest_filename))
            new_href += href_suffix

            def href_sub(m2):
                q = m2.group(1)
                return f'href={q}{new_href}{q}'

            new_attrs = re.sub(r'\bhref\s*=\s*("|\')(?:[^"\']*)\1', href_sub, attrs_str, flags=re.I, count=1)
            changed = True
            return f"<link{new_attrs}>"

        new_text = re.sub(r'<\s*link(?P<attrs>[^>]*)>', repl_link, text, flags=re.I)

        if changed:
            try:
                html_path.write_text(new_text, encoding=ENCODING, errors="strict")
                print(f"[REWRITE HTML] {html_path}")
            except Exception as e:
                print(f"[ERROR] Writing {html_path}: {e}")

        # After we know which CSS were referenced, collect per-group HTMLs
        # Scan again (cheap) to map original hrefs -> dest filenames, then group index
        if changed:
            # Re-resolve links against original CSS paths again to map groups
            # We do a lighter pass to collect abskeys:
            ref_abskeys = set()

            def collect_abskey(match):
                attrs_str = match.group("attrs")
                href_m = re.search(r'\bhref\s*=\s*("|\')(?P<val>[^"\']*)\1', attrs_str, flags=re.I)
                if not href_m:
                    return
                href_val = href_m.group("val")
                href_core, _ = split_url_keep_suffix(href_val)
                if href_core.strip().lower().endswith(".css") and not href_core.strip().lower().startswith(ABS_IGNORE_PREFIXES):
                    target_abs = (html_dir / href_core.replace("/", os.sep)).resolve()
                    ref_abskeys.add(norm_abskey(target_abs))

            for m in re.finditer(r'<\s*link(?P<attrs>[^>]*)>', new_text, flags=re.I):
                collect_abskey(m)

            # Any abskey that belonged to our plan? Attribute those to groups:
            for abskey, destname in css_abskey_to_destname.items():
                if abskey in ref_abskeys:
                    # find group index by inverse lookup (we'll pass a map in per_group_htmls)
                    # per_group_htmls is: {group_index: set(paths)}
                    # We need group index; build a reverse map once outside and pass in.
                    pass  # handled outside via a reverse map

    # Note: collection of per-group HTMLs is finalized outside, using the reverse mapping

# ---------- moves & cleanup ----------
def move_reference_css(group_list, base_dir: Path):
    for g in group_list:
        src = g["ref_css"]
        dst = g["dest_path"]
        try:
            dst.parent.mkdir(parents=True, exist_ok=True)
            if not dst.exists():
                os.replace(str(src), str(dst))
                print(f"[MOVE] {src} -> {dst}")
            else:
                print(f"[SKIP] Exists: {dst}")
        except Exception as e:
            print(f"[ERROR] Moving {src} -> {dst}: {e}")

def maybe_delete_duplicates(group_list):
    if not DELETE_DUPLICATES:
        return
    for g in group_list:
        ref_key = norm_abskey(g["ref_css"])
        for m in g["members"]:
            if norm_abskey(m) == ref_key:
                continue
            try:
                Path(m).unlink()
                print(f"[DEL DUP] {m}")
            except Exception as e:
                print(f"[WARN] Could not delete {m}: {e}")

# ---------- main ----------
def main():
    base_dir = Path(__file__).resolve().parent
    print(f"[START] Base: {base_dir}")

    group_list, css_abskey_to_group, css_abskey_to_destname = plan_groups(base_dir)
    if not group_list:
        print("[INFO] No CSS files found under subdirectories.")
        return

    # Build reverse: destname -> group index, and abskey -> group index
    destname_to_group = {g["dest_path"].name: g["index"] for g in group_list}
    per_group_htmls = {g["index"]: set() for g in group_list}

    # Rewrite ALL HTML/HTM (before moving CSS)
    # While rewriting, we need to attribute HTMLs to groups:
    for html_path in iter_all_files(base_dir):
        if not is_html(html_path):
            continue

        try:
            text = html_path.read_text(encoding=ENCODING, errors="strict")
        except Exception:
            text = html_path.read_text(encoding=ENCODING, errors="ignore")

        html_dir = html_path.parent
        changed = False
        groups_touched = set()

        def repl_link(match):
            nonlocal changed
            tag = match.group(0)
            attrs_str = match.group("attrs")

            rel_m = re.search(r'\brel\s*=\s*("|\')([^"\']*)\1', attrs_str, flags=re.I)
            href_m = re.search(r'\bhref\s*=\s*("|\')(?P<val>[^"\']*)\1', attrs_str, flags=re.I)
            if not href_m:
                return tag

            rel_val = (rel_m.group(2) if rel_m else "")
            href_val = href_m.group("val")

            if (rel_val and "stylesheet" not in rel_val.lower()) and not href_val.lower().endswith(".css"):
                return tag

            href_core, href_suffix = split_url_keep_suffix(href_val)
            if href_core.strip().lower().startswith(ABS_IGNORE_PREFIXES):
                return tag

            target_abs = (html_dir / href_core.replace("/", os.sep)).resolve()
            abskey = norm_abskey(target_abs)
            dest_filename = css_abskey_to_destname.get(abskey)
            if not dest_filename:
                return tag

            # Record the group this HTML will use
            grp = destname_to_group.get(dest_filename)
            if grp:
                groups_touched.add(grp)

            rel_to_base = os.path.relpath(base_dir, html_dir)
            new_href = dest_filename if rel_to_base == "." else to_posix(str(Path(rel_to_base) / dest_filename))
            new_href += href_suffix

            def href_sub(m2):
                q = m2.group(1)
                return f'href={q}{new_href}{q}'

            new_attrs = re.sub(r'\bhref\s*=\s*("|\')(?:[^"\']*)\1', href_sub, attrs_str, flags=re.I, count=1)
            changed = True
            return f"<link{new_attrs}>"

        new_text = re.sub(r'<\s*link(?P<attrs>[^>]*)>', repl_link, text, flags=re.I)

        if changed:
            try:
                html_path.write_text(new_text, encoding=ENCODING, errors="strict")
                print(f"[REWRITE HTML] {html_path}")
            except Exception as e:
                print(f"[ERROR] Writing {html_path}: {e}")
            for grp in groups_touched:
                per_group_htmls[grp].add(str(html_path.resolve()))

    # Move one reference CSS per group to base dir
    move_reference_css(group_list, base_dir)

    # Optionally delete duplicates
    maybe_delete_duplicates(group_list)

    # ---------- JSON report ----------
    report = {
        "base_dir": str(base_dir),
        "groups": []
    }
    for g in group_list:
        idx = g["index"]
        report["groups"].append({
            "group_index": idx,
            "dedup_css": str(g["dest_path"].name),
            "reference_css_original_path": str(g["ref_css"]),
            "all_member_css_paths": [str(m) for m in g["members"]],
            "html_using_this_css": sorted(per_group_htmls.get(idx, set())),
        })

    report_path = base_dir / REPORT_FILENAME
    report_json = json.dumps(report, indent=2, ensure_ascii=False)
    try:
        report_path.write_text(report_json, encoding=ENCODING)
        print(f"[REPORT] {report_path}")
    except Exception as e:
        print(f"[ERROR] Writing report {report_path}: {e}")

    print("[DONE] CSS dedup + HTML rewrite complete.")
    print(report_json)

if __name__ == "__main__":
    main()
