#!/usr/bin/env python3
# -*- coding: latin-1 -*-
"""
Background image grouper/renamer + HTML/CSS fixer + CSS similarity grouping

Actions:
  1) Scan all subfolders for 'img/background.(gif|jpg|jpeg|png)'.
  2) Group by exact byte content (SHA-1). Singles go to 'uniques'.
  3) Write JSON report describing groups and uniques.
  4) For each group N (1-based), move the group's *reference* background.* to
     '<root>/img/backgroundN.<ref_ext>' (overwrites if exists).
     For each folder in that group:
       - Ensure local image exists as 'img/backgroundN.<ext>' where <ext> is:
           a) the folder's original extension if it had 'background.<ext>', else
           b) existing 'backgroundN.<ext>' if present, else
           c) the group's <ref_ext> (copied from root/img).
       - Update the folder's index.html|index.htm to keep path but change only
         the filename to 'backgroundN.<chosen_ext>'.
       - Update any .css in that folder the same way (filename only).
  5) After rewriting, move OTHER files from each folder's 'img' dir into
     the root 'img' dir (skip any 'background*.gif|jpg|jpeg|png'); on collision,
     keep existing root file and append a note to 'img_move_conflicts.txt'.
  6) Write 'missing_html.json' (folders lacking index.htm/html) and
     'missing_img.json' (folders lacking an img dir).
  7) Finally, scan ALL .css files under root, compare contents with all
     whitespace removed, and write 'css_groups.json' containing:
       - groups of matching CSS (listing files and directories)
       - list of unique CSS files.

Notes:
  - Python 3.9.13 on Windows.
  - File I/O uses latin-1 encoding as requested.
"""

import os
import re
import json
import shutil
import hashlib
from typing import List, Dict, Tuple, Optional


# --------------------------- Discovery & Hashing -----------------------------

_BG_EXTS = (".gif", ".jpg", ".jpeg", ".png")

def find_background_images(root: str) -> List[str]:
    """Return absolute file paths to every 'img/background.<ext>' under root."""
    hits = []
    for dirpath, _, _ in os.walk(root):
        imgdir = os.path.join(dirpath, "img")
        if not os.path.isdir(imgdir):
            continue
        for ext in _BG_EXTS:
            candidate = os.path.join(imgdir, "background" + ext)
            if os.path.isfile(candidate):
                hits.append(os.path.abspath(candidate))
    hits.sort(key=str.lower)
    return hits


def sha1_file(path: str, chunk_size: int = 65536) -> str:
    h = hashlib.sha1()
    with open(path, "rb") as f:
        while True:
            chunk = f.read(chunk_size)
            if not chunk:
                break
            h.update(chunk)
    return h.hexdigest()


def group_exact(paths: List[str]) -> Tuple[List[List[int]], List[int], List[str]]:
    """
    Group by exact file content using SHA-1 only.
    Returns (groups, uniques, sha1s):
      - groups: list of lists of indices (size >= 2), each group is exact duplicates
      - uniques: list of indices that have no duplicates
      - sha1s: precomputed sha1 hex strings for each path
    """
    if not paths:
        return [], [], []
    sha1s = [sha1_file(p) for p in paths]
    buckets: Dict[str, List[int]] = {}
    for idx, sh in enumerate(sha1s):
        buckets.setdefault(sh, []).append(idx)
    groups = [sorted(v) for v in buckets.values() if len(v) >= 2]
    groups.sort(key=lambda g: paths[g[0]].lower())
    in_groups = {i for g in groups for i in g}
    uniques = sorted([i for i in range(len(paths)) if i not in in_groups],
                     key=lambda i: paths[i].lower())
    return groups, uniques, sha1s


# ------------------------------ HTML/CSS helpers ----------------------------

def case_insensitive_find(root: str, candidates: List[str]) -> Optional[str]:
    """
    Return the first existing file in root matching any candidate name,
    case-insensitively. Looks only in the given directory (non-recursive).
    """
    try:
        lower_map = {name.lower(): name for name in os.listdir(root)}
    except FileNotFoundError:
        return None
    for cand in candidates:
        real = lower_map.get(cand.lower())
        if real and os.path.isfile(os.path.join(root, real)):
            return os.path.join(root, real)
    return None


def find_html_for_folder(folder_path: str) -> Optional[str]:
    """Look for 'index.html' or 'index.htm' inside the subfolder itself."""
    cand = ["index.html", "index.htm"]
    return case_insensitive_find(folder_path, cand)


def list_css_files_in_folder(folder_path: str) -> List[str]:
    """Return absolute paths to *.css files in the given folder (non-recursive)."""
    try:
        names = os.listdir(folder_path)
    except FileNotFoundError:
        return []
    out = []
    for n in names:
        if n.lower().endswith(".css"):
            p = os.path.join(folder_path, n)
            if os.path.isfile(p):
                out.append(p)
    return out


def _rewrite_background_filename_only_in_text(text: str, new_basename: str) -> Tuple[str, bool]:
    changed = False

    # CSS url(...)
    def _css_repl(m):
        nonlocal changed
        quote = m.group(1) or ""
        prefix = m.group("prefix") or ""
        changed = True
        return "url(" + quote + prefix + new_basename + quote + ")"

    text2 = re.sub(
        r"url\(\s*([\"']?)(?P<prefix>[^)\"']*?[\\/])?background(?:\d+)?\.(?:gif|jpe?g|png)\1\s*\)",
        _css_repl,
        text,
        flags=re.IGNORECASE,
    )

    # HTML-like attributes
    def _attr_repl(m):
        nonlocal changed
        attr = m.group(1)
        quote = m.group(2)
        prefix = m.group("prefix") or ""
        changed = True
        return f'{attr}={quote}{prefix}{new_basename}{quote}'

    text3 = re.sub(
        r"(?i)\b(src|href|data-[\w-]+)\s*=\s*([\"'])(?P<prefix>[^\"']*?[\\/])?background(?:\d+)?\.(?:gif|jpe?g|png)\2",
        _attr_repl,
        text2,
    )

    # Generic quoted strings
    def _generic_repl(m):
        nonlocal changed
        quote = m.group(1)
        prefix = m.group("prefix") or ""
        changed = True
        return f"{quote}{prefix}{new_basename}{quote}"

    text4 = re.sub(
        r"([\"'])(?P<prefix>[^\"']*?[\\/])?background(?:\d+)?\.(?:gif|jpe?g|png)\1",
        _generic_repl,
        text3,
        flags=re.IGNORECASE,
    )

    return text4, changed



def rewrite_background_filename_only_in_file(path: str, new_basename: str) -> bool:
    """
    Open file at `path`, rewrite any background*.{gif|jpg|jpeg|png} references
    to keep the path and only change the filename to `new_basename`.
    Returns True if modified.
    """
    try:
        with open(path, "r", encoding="latin-1", errors="replace") as f:
            original = f.read()
    except FileNotFoundError:
        return False

    updated, changed = _rewrite_background_filename_only_in_text(original, new_basename)
    if changed:
        with open(path, "w", encoding="latin-1", errors="strict") as f:
            f.write(updated)
    return changed


# -------------------------- File moving operations --------------------------

def ensure_dir(path: str) -> None:
    os.makedirs(path, exist_ok=True)


def move_overwriting(src: str, dst: str) -> None:
    """Move src to dst, removing existing dst if necessary (Windows-safe)."""
    if os.path.exists(dst):
        os.remove(dst)
    ensure_dir(os.path.dirname(dst))
    shutil.move(src, dst)


def copy_overwriting(src: str, dst: str) -> None:
    """Copy src to dst, overwriting if needed."""
    ensure_dir(os.path.dirname(dst))
    shutil.copy2(src, dst)


def move_other_img_files_to_root(root_img: str, folder_img: str, conflicts: List[str]) -> None:
    """
    Move all files from folder_img to root_img except any 'background*.gif|jpg|jpeg|png'.
    On collision, keep destination and record conflict note instead.
    """
    if not os.path.isdir(folder_img):
        return
    for name in os.listdir(folder_img):
        lname = name.lower()
        if lname.startswith("background") and (lname.endswith(".gif") or lname.endswith(".jpg")
                                               or lname.endswith(".jpeg") or lname.endswith(".png")):
            continue
        src = os.path.join(folder_img, name)
        if not os.path.isfile(src):
            continue
        dst = os.path.join(root_img, name)
        if os.path.exists(dst):
            conflicts.append(f"Collision: {src} -> {dst} (kept existing)")
            continue
        ensure_dir(root_img)
        shutil.move(src, dst)


# ------------------------- Local background rename --------------------------

def _detect_existing_local_bg(folder_img: str, ext: str) -> bool:
    """Return True if 'background<ext>' exists in folder_img."""
    path = os.path.join(folder_img, f"background{ext}")
    return os.path.isfile(path)

def _detect_existing_local_bgN(folder_img: str, group_no: int, ext: str) -> bool:
    """Return True if 'background{N}<ext>' exists in folder_img."""
    path = os.path.join(folder_img, f"background{group_no}{ext}")
    return os.path.isfile(path)



def ensure_local_background_named(folder: str, group_no: int, root_img: str, group_ext: str) -> str:
    """
    Ensure the subfolder has 'img/background{group_no}<group_ext>'.
    Touch ONLY files with <group_ext> to avoid clobbering other background.*.
    Returns the basename 'background{N}<group_ext>'.
    """
    folder_img = os.path.join(folder, "img")
    ensure_dir(folder_img)

    old_local = os.path.join(folder_img, f"background{group_ext}")
    new_local = os.path.join(folder_img, f"background{group_no}{group_ext}")
    consolidated = os.path.join(root_img, f"background{group_no}{group_ext}")

    # (1) If 'background<ext>' exists, rename it in place to 'backgroundN<ext>'
    if _detect_existing_local_bg(folder_img, group_ext):
        if os.path.exists(new_local):
            os.remove(new_local)
        shutil.move(old_local, new_local)
        return f"background{group_no}{group_ext}"

    # (2) If 'backgroundN<ext>' already exists, keep it
    if _detect_existing_local_bgN(folder_img, group_no, group_ext):
        return f"background{group_no}{group_ext}"

    # (3) Otherwise copy the consolidated root image back
    copy_overwriting(consolidated, new_local)
    return f"background{group_no}{group_ext}"



# ------------------------------- CSS similarity -----------------------------

def _normalize_css_for_compare(text: str) -> str:
    """
    Normalize CSS for equivalence comparison:
      - strip BOM
      - remove /* ... */ comments
      - remove all whitespace (spaces, tabs, newlines)
      - lowercase (ignore letter-case differences)
    """
    if not isinstance(text, str):
        return ""
    # Strip UTF-8/UTF-16 BOM if present
    text = text.lstrip("\ufeff")
    # Remove block comments
    text = re.sub(r"/\*.*?\*/", "", text, flags=re.DOTALL)
    # Remove all whitespace
    text = re.sub(r"\s+", "", text)
    # Case-insensitive compare
    return text.lower()


def group_all_css_under_root(root: str) -> Dict[str, List[Dict[str, str]]]:
    """
    Walk the entire tree, collect all *.css files, and group by SHA1 of
    whitespace-stripped content. Returns {hash: [{dir, file, path}], ...}
    """
    buckets: Dict[str, List[Dict[str, str]]] = {}
    for dirpath, _, filenames in os.walk(root):
        for name in filenames:
            if not name.lower().endswith(".css"):
                continue
            path = os.path.join(dirpath, name)
            try:
                with open(path, "r", encoding="latin-1", errors="replace") as f:
                    raw = f.read()
            except Exception:
                continue
            norm = _normalize_css_for_compare(raw)
            h = hashlib.sha1(norm.encode("latin-1", errors="replace")).hexdigest()
            buckets.setdefault(h, []).append({
                "dir": dirpath,
                "file": name,
                "path": path
            })
    return buckets


def write_css_groups_json(root: str) -> None:
    """
    Build css_groups.json summarizing:
      - matching_groups: groups with >=2 files (includes directories & files)
      - unique_css_files: groups with exactly 1 file
    """
    buckets = group_all_css_under_root(root)
    matching_groups = []
    uniques = []
    for h, files in buckets.items():
        if len(files) >= 2:
            dirs = sorted(sorted({f["dir"] for f in files}), key=str.lower)
            matching_groups.append({
                "normalized_sha1": h,
                "directories": dirs,
                "files": sorted(files, key=lambda x: (x["dir"].lower(), x["file"].lower())),
                "count_files": len(files),
                "count_dirs": len(dirs),
            })
        else:
            f = files[0]
            uniques.append({
                "normalized_sha1": h,
                "dir": f["dir"],
                "file": f["file"],
                "path": f["path"],
            })

    payload = {
        "matching_groups": sorted(matching_groups, key=lambda g: (-g["count_dirs"], g["normalized_sha1"])),
        "unique_css_files": sorted(uniques, key=lambda u: (u["dir"].lower(), u["file"].lower())),
        "total_css_files": sum(len(v) for v in buckets.values())
    }
    out_path = os.path.join(root, "css_groups.json")
    with open(out_path, "w", encoding="latin-1") as jf:
        json.dump(payload, jf, indent=2, ensure_ascii=False)
    print("Wrote CSS similarity groups:", out_path)


# ------------------------------- Main logic ---------------------------------

def main():
    root = os.path.abspath(os.path.dirname(__file__))
    root_img = os.path.join(root, "img")
    ensure_dir(root_img)

    imgs = find_background_images(root)
    if not imgs:
        print("No img/background.(gif|jpg|jpeg|png) files found under:", root)
        # Still run CSS grouping so you get css_groups.json even if no backgrounds
        write_css_groups_json(root)
        return

    groups, uniques, sha1s = group_exact(imgs)

    # Assign group numbers: groups 1..G, then uniques continue G+1..G+U
    numbered_groups: List[Dict] = []
    group_counter = 1
    for g in groups:
        ref_idx = g[0]
        ref_path = imgs[ref_idx]
        ref_ext = os.path.splitext(ref_path)[1].lower()  # includes dot
        numbered_groups.append({
            "group_number": group_counter,
            "reference_image": ref_path,
            "reference_ext": ref_ext,
            "members": [
                {
                    "folder": os.path.dirname(os.path.dirname(imgs[i])),
                    "image": imgs[i],
                    "sha1": sha1s[i],
                    "ext": os.path.splitext(imgs[i])[1].lower(),
                }
                for i in g
            ],
        })
        group_counter += 1

    numbered_uniques: List[Dict] = []
    for i in uniques:
        ref_path = imgs[i]
        ref_ext = os.path.splitext(ref_path)[1].lower()
        numbered_uniques.append({
            "group_number": group_counter,
            "reference_image": ref_path,
            "reference_ext": ref_ext,
            "folder": os.path.dirname(os.path.dirname(ref_path)),
            "image": ref_path,
            "sha1": sha1s[i],
            "ext": ref_ext,
        })
        group_counter += 1

    # JSON report (before modifications)
    report = {
        "root": root,
        "groups": numbered_groups,
        "uniques": numbered_uniques,
    }
    report_path = os.path.join(root, "background_groups.json")
    with open(report_path, "w", encoding="latin-1") as jf:
        json.dump(report, jf, indent=2, ensure_ascii=False)
    print("Wrote JSON report:", report_path)

    # Notes & missing lists
    conflict_notes: List[str] = []
    missing_html: List[str] = []
    missing_img: List[str] = []

    # Helper: update HTML + sibling CSS for a set of folders
    def update_htmls_for_folders(group_no: int, folders: List[str], group_ext: str) -> None:
        for folder in folders:
            folder_img = os.path.join(folder, "img")
            if not os.path.isdir(folder_img):
                missing_img.append(folder)
                new_basename = f"background{group_no}{group_ext}"
            else:
                new_basename = ensure_local_background_named(folder, group_no, root_img, group_ext)

            html = find_html_for_folder(folder)
            if not html:
                missing_html.append(folder)
            else:
                _ = rewrite_background_filename_only_in_file(html, new_basename)

            for css_path in list_css_files_in_folder(folder):
                _ = rewrite_background_filename_only_in_file(css_path, new_basename)

            if os.path.isdir(folder_img):
                move_other_img_files_to_root(root_img, folder_img, conflict_notes)


    # Process groups (duplicates)
    for g in numbered_groups:
        group_no = g["group_number"]
        ref = g["reference_image"]
        group_ext = g["reference_ext"]  # includes dot
        dst = os.path.join(root_img, f"background{group_no}{group_ext}")
        move_overwriting(ref, dst)
        folders = [m["folder"] for m in g["members"]]
        update_htmls_for_folders(group_no, folders, group_ext)

    # Process uniques (singles)
    for u in numbered_uniques:
        group_no = u["group_number"]
        ref = u["reference_image"]
        group_ext = u["reference_ext"]
        dst = os.path.join(root_img, f"background{group_no}{group_ext}")
        move_overwriting(ref, dst)
        update_htmls_for_folders(group_no, [u["folder"]], group_ext)

    # Write conflict notes
    if conflict_notes:
        note_path = os.path.join(root, "img_move_conflicts.txt")
        with open(note_path, "w", encoding="latin-1") as nf:
            nf.write("\r\n".join(conflict_notes))
        print("Wrote collision notes:", note_path)
    else:
        print("No filename collisions while consolidating img/ assets.")

    # Write missing HTML / IMG lists
    if missing_html:
        with open(os.path.join(root, "missing_html.json"), "w", encoding="latin-1") as mf:
            json.dump(sorted(set(missing_html), key=str.lower), mf, indent=2, ensure_ascii=False)
        print("Wrote missing HTML list (folders without index.html/htm).")
    if missing_img:
        with open(os.path.join(root, "missing_img.json"), "w", encoding="latin-1") as mf:
            json.dump(sorted(set(missing_img), key=str.lower), mf, indent=2, ensure_ascii=False)
        print("Wrote missing IMG list (folders without img dir).")

    # Final summary JSON with destinations (root-level dest uses group's ref ext)
    for g in numbered_groups:
        g["root_dest_background"] = f"img/background{g['group_number']}{g['reference_ext']}"
    for u in numbered_uniques:
        u["root_dest_background"] = f"img/background{u['group_number']}{u['reference_ext']}"
    report["groups"] = numbered_groups
    report["uniques"] = numbered_uniques
    with open(report_path, "w", encoding="latin-1") as jf:
        json.dump(report, jf, indent=2, ensure_ascii=False)
    print("Updated JSON report with destinations:", report_path)

    # ---- CSS similarity step (ignore whitespace) ----
    write_css_groups_json(root)


if __name__ == "__main__":
    main()
