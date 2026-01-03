#!/usr/bin/env python3
# -*- coding: latin-1 -*-
"""
CSS group consolidator

- Parses css_groups.json (from previous step) to get "matching_groups".
- For each group:
    * Take the first CSS file path in group["files"] as the representative.
    * Move it to the root (same dir as this script) and rename to <basename>_<N>.css.
    * For each directory in group["directories"]:
        - Find index.html or index.htm in that directory.
        - Rewrite stylesheet references to point to ../<new_name> (root-level).
- Writes css_move_results.json summarizing actions.

Notes:
- Python 3.9.13, latin-1 enc/dec.
"""

import os
import re
import json
import shutil
from typing import Optional, Dict, Any, List, Tuple

CSS_GROUPS_JSON = "css_groups.json"  # produced earlier
RESULTS_JSON = "css_move_results.json"

# ------------------------------ Utilities -----------------------------------

def ensure_dir(path: str) -> None:
    os.makedirs(path, exist_ok=True)

def case_insensitive_find(dirpath: str, candidates: List[str]) -> Optional[str]:
    try:
        names = os.listdir(dirpath)
    except FileNotFoundError:
        return None
    lower = {n.lower(): n for n in names}
    for cand in candidates:
        real = lower.get(cand.lower())
        if real and os.path.isfile(os.path.join(dirpath, real)):
            return os.path.join(dirpath, real)
    return None

def read_json(path: str) -> Dict[str, Any]:
    with open(path, "r", encoding="latin-1", errors="replace") as f:
        return json.load(f)

def write_json(path: str, obj: Any) -> None:
    with open(path, "w", encoding="latin-1") as f:
        json.dump(obj, f, indent=2, ensure_ascii=False)

def move_overwriting(src: str, dst: str) -> None:
    """Windows-safe move with overwrite if needed."""
    ensure_dir(os.path.dirname(dst))
    if os.path.exists(dst):
        os.remove(dst)
    shutil.move(src, dst)

# ------------------------------ Rewriters -----------------------------------

def _rewrite_css_href_in_html_text(text: str, old_filename: str, new_rel_path: str) -> Tuple[str, bool]:
    """
    Update HTML content so references to old_filename now point to new_rel_path,
    adjusting ONLY the quoted string value (keeps quotes).

    - Handles <link ... href="...old_filename"> (any attrs order)
    - Also replaces any generic quoted string that is exactly ending with old_filename
      or has a simple path prefix before it (e.g., "./", "./css/", "css/").
    - We do not try to rewrite <style>@import ...</style> blocks here (rare in these pages).
    """
    changed = False

    # (1) <link ... href="...old_filename"...>
    # We capture the quote and any prefix before the old filename, then rebuild with new_rel_path.
    def _link_repl(m):
        nonlocal changed
        before = m.group(1)  # everything up to href=" or href='
        quote = m.group(2)
        # m.group(3) is optional prefix (like ./, css/, etc.) that's being replaced entirely
        changed = True
        return f'{before}{quote}{new_rel_path}{quote}'

    # pattern: anything, href="(optional prefix)old_filename"
    # Using a tempered dot to avoid overmatching across quotes.
    link_pat = re.compile(
        r'(<\s*link\b[^>]*?\bhref\s*=\s*)([\'"])(?:[^\'"]*?[\\/])?'
        + re.escape(old_filename)
        + r'\2',
        flags=re.IGNORECASE
    )
    text2 = link_pat.sub(_link_repl, text)

    # (2) Generic quoted strings containing old_filename; replace whole quoted string with new_rel_path
    def _generic_repl(m):
        nonlocal changed
        quote = m.group(1)
        changed = True
        return f'{quote}{new_rel_path}{quote}'

    # Replace e.g. "message.css", "./message.css", "css/message.css"
    generic_pat = re.compile(
        r'([\'"])(?:[^\'"]*?[\\/])?' + re.escape(old_filename) + r'\1',
        flags=re.IGNORECASE
    )
    text3 = generic_pat.sub(_generic_repl, text2)

    return text3, (text3 != text)

def rewrite_css_reference_in_html_file(html_path: str, old_filename: str, new_rel_path: str) -> bool:
    try:
        with open(html_path, "r", encoding="latin-1", errors="replace") as f:
            original = f.read()
    except FileNotFoundError:
        return False

    updated, _ = _rewrite_css_href_in_html_text(original, old_filename, new_rel_path)
    if updated != original:
        with open(html_path, "w", encoding="latin-1", errors="strict") as f:
            f.write(updated)
        return True
    return False

# ------------------------------ Main logic ----------------------------------

def main():
    root = os.path.abspath(os.path.dirname(__file__))  # expected ...\Marketing\message
    data = read_json(os.path.join(root, CSS_GROUPS_JSON))

    matching_groups = data.get("matching_groups", [])
    if not matching_groups:
        print("No matching_groups found in css_groups.json; nothing to do.")
        return

    results = {
        "root": root,
        "moved": [],     # list of {group_index, src, dst, new_name}
        "html_updates": [],  # list of {group_index, dir, html, changed}
        "errors": []
    }

    # We’ll name files like "<basename>_<N>.css" in the root.
    # N is 1-based index over matching_groups in the JSON order.
    for idx, group in enumerate(matching_groups, start=1):
        files = group.get("files") or []
        dirs = group.get("directories") or []
        if not files or not dirs:
            continue

        rep = files[0]  # representative css
        rep_path = rep.get("path")
        rep_file = rep.get("file") or "style.css"
        rep_dir = rep.get("dir")

        if not rep_path or not os.path.isfile(rep_path):
            results["errors"].append({
                "group_index": idx,
                "error": "Representative CSS file not found on disk",
                "path": rep_path
            })
            continue

        base, ext = os.path.splitext(rep_file)
        new_name = f"{base}_{idx}{ext}"
        dst_path = os.path.join(root, new_name)

        # Move representative CSS to root as new_name
        try:
            move_overwriting(rep_path, dst_path)
            results["moved"].append({
                "group_index": idx,
                "src": rep_path,
                "dst": dst_path,
                "new_name": new_name
            })
        except Exception as e:
            results["errors"].append({
                "group_index": idx,
                "error": f"Move failed: {e}",
                "src": rep_path,
                "dst": dst_path
            })
            continue

        # For each directory in the group, update index.html / index.htm
        # Build relative path from subdir --> root file (usually "../<new_name>")
        for d in dirs:
            try:
                rel_to_root = os.path.relpath(root, d)
                # Normalize to forward slashes for HTML
                rel_to_root_html = rel_to_root.replace("\\", "/")
                new_rel_path = f"{rel_to_root_html}/{new_name}" if rel_to_root_html != "." else new_name
                # Look for index.html or index.htm
                html_path = case_insensitive_find(d, ["index.html", "index.htm"])
                if not html_path:
                    results["html_updates"].append({
                        "group_index": idx,
                        "dir": d,
                        "html": None,
                        "changed": False,
                        "note": "No index.html/htm"
                    })
                    continue

                # We try to rewrite links pointing to the old filename (the name of files in this group)
                # Most groups use the same filename (e.g., message.css). If in doubt, use the first file's name.
                changed = rewrite_css_reference_in_html_file(html_path, rep_file, new_rel_path)
                results["html_updates"].append({
                    "group_index": idx,
                    "dir": d,
                    "html": html_path,
                    "changed": bool(changed),
                    "new_rel_path": new_rel_path,
                    "matched_old_filename": rep_file
                })
            except Exception as e:
                results["errors"].append({
                    "group_index": idx,
                    "dir": d,
                    "error": f"HTML update failed: {e}"
                })

    # Write audit
    write_json(os.path.join(root, RESULTS_JSON), results)
    print("Wrote:", os.path.join(root, RESULTS_JSON))


if __name__ == "__main__":
    main()
