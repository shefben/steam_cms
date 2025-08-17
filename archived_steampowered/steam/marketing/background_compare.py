#!/usr/bin/env python3
# -*- coding: latin-1 -*-
"""
Exact-match background.gif grouper + migrator

Actions:
  1) Scan all subfolders for 'img/background.gif'.
  2) Group by exact byte content (SHA-1). Singles go to 'uniques'.
  3) Write JSON report describing groups and uniques.
  4) For each group N (1-based), move the group's *reference* background.gif
     to '<root>/img/backgroundN.gif' (overwrites if exists).
     For each folder in that group, update its HTML (root/<folder>.html|.htm)
     so any path to 'background.gif' becomes 'img/backgroundN.gif'.
  5) After rewriting HTMLs, move all OTHER files from each folder's 'img' dir
     into the root 'img' dir (skip 'background.gif'); on name collision, keep
     existing root file and append a note to 'img_move_conflicts.txt'.

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

def find_background_gifs(root: str) -> List[str]:
    """Return absolute file paths to every 'img/background.gif' under root."""
    hits = []
    for dirpath, _, _ in os.walk(root):
        candidate = os.path.join(dirpath, "img", "background.gif")
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


# ------------------------------ HTML helpers --------------------------------

def case_insensitive_find(root: str, candidates: List[str]) -> Optional[str]:
    """
    Return the first existing file in root matching any candidate name,
    case-insensitively. Looks only in the given directory (non-recursive).
    """
    lower_map = {name.lower(): name for name in os.listdir(root)}
    for cand in candidates:
        real = lower_map.get(cand.lower())
        if real and os.path.isfile(os.path.join(root, real)):
            return os.path.join(root, real)
    return None


def find_html_for_folder(root: str, folder_path: str) -> Optional[str]:
    """Folder base name 'foo' -> look for 'foo.html' or 'foo.htm' at root."""
    base = os.path.basename(folder_path)
    cand = [f"{base}.html", f"{base}.htm"]
    return case_insensitive_find(root, cand)


def rewrite_background_paths_in_html(html_path: str, new_rel_path: str) -> bool:
    """
    Replace any path ending in background.gif in HTML/CSS with new_rel_path.
    Returns True if file was modified, False if unchanged or missing.
    """
    try:
        with open(html_path, "r", encoding="latin-1", errors="replace") as f:
            original = f.read()
    except FileNotFoundError:
        return False

    content = original

    # 1) CSS url(...) forms
    #    url(background.gif) / url('.../background.gif') / url(".../background.gif")
    def _css_repl(m):
        quote = m.group(1) or ""
        return "url(" + quote + new_rel_path + quote + ")"

    content = re.sub(
        r"url\(\s*([\"']?)([^)\"']*?[\\/])?background\.gif\1\s*\)",
        _css_repl,
        content,
        flags=re.IGNORECASE,
    )

    # 2) src/href/data-*="...background.gif"
    def _attr_repl(m):
        attr = m.group(1)
        quote = m.group(2)
        return f'{attr}={quote}{new_rel_path}{quote}'

    content = re.sub(
        r"(?i)\b(src|href|data-[\w-]+)\s*=\s*([\"'])([^\"']*?[\\/])?background\.gif\2",
        _attr_repl,
        content,
    )

    # 3) Generic quoted strings containing background.gif as fallback
    content = re.sub(
        r"([\"'])([^\"']*?[\\/])?background\.gif\1",
        lambda m: f"{m.group(1)}{new_rel_path}{m.group(1)}",
        content,
        flags=re.IGNORECASE,
    )

    if content != original:
        with open(html_path, "w", encoding="latin-1", errors="strict") as f:
            f.write(content)
        return True
    return False


# -------------------------- File moving operations --------------------------

def ensure_dir(path: str) -> None:
    os.makedirs(path, exist_ok=True)


def move_overwriting(src: str, dst: str) -> None:
    """
    Move src to dst, removing existing dst if necessary so Windows doesn't fail.
    """
    if os.path.exists(dst):
        os.remove(dst)
    ensure_dir(os.path.dirname(dst))
    shutil.move(src, dst)


def move_other_img_files_to_root(root_img: str, folder_img: str, conflicts: List[str]) -> None:
    """
    Move all files from folder_img to root_img except 'background.gif'.
    On collision, keep destination and record conflict note instead.
    """
    if not os.path.isdir(folder_img):
        return
    for name in os.listdir(folder_img):
        if name.lower() == "background.gif":
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


# ------------------------------- Main logic ---------------------------------

def main():
    root = os.path.abspath(os.path.dirname(__file__))
    root_img = os.path.join(root, "img")
    ensure_dir(root_img)

    gifs = find_background_gifs(root)
    if not gifs:
        print("No img/background.gif files found under:", root)
        return

    groups, uniques, sha1s = group_exact(gifs)

    # Assign group numbers:
    #   Groups are numbered 1..G, then uniques continue G+1 .. G+U.
    numbered_groups: List[Dict] = []
    group_counter = 1
    for g in groups:
        ref_idx = g[0]
        numbered_groups.append({
            "group_number": group_counter,
            "reference_gif": gifs[ref_idx],
            "members": [
                {
                    "folder": os.path.dirname(os.path.dirname(gifs[i])),
                    "gif": gifs[i],
                    "sha1": sha1s[i],
                }
                for i in g
            ],
        })
        group_counter += 1

    numbered_uniques: List[Dict] = []
    for i in uniques:
        numbered_uniques.append({
            "group_number": group_counter,
            "reference_gif": gifs[i],
            "folder": os.path.dirname(os.path.dirname(gifs[i])),
            "gif": gifs[i],
            "sha1": sha1s[i],
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

    # Execute moves + HTML rewrites
    # Keep notes on collisions when flattening img/ assets
    conflict_notes: List[str] = []

    # Helper to update HTML for every folder in a set, to point to new path
    def update_htmls_for_folders(group_no: int, folders: List[str]) -> None:
        new_rel = f"img/background{group_no}.gif"
        for folder in folders:
            html = find_html_for_folder(root, folder)
            if html:
                _ = rewrite_background_paths_in_html(html, new_rel)
            # Move other img files to root img (skip background.gif)
            folder_img = os.path.join(folder, "img")
            move_other_img_files_to_root(root_img, folder_img, conflict_notes)

    # Process groups (duplicates)
    for g in numbered_groups:
        group_no = g["group_number"]
        ref = g["reference_gif"]
        dst = os.path.join(root_img, f"background{group_no}.gif")
        # Move *reference* background to root/img/backgroundN.gif
        move_overwriting(ref, dst)
        # Update HTMLs for every folder in this group
        folders = [m["folder"] for m in g["members"]]
        update_htmls_for_folders(group_no, folders)

    # Process uniques (singles)
    for u in numbered_uniques:
        group_no = u["group_number"]
        ref = u["reference_gif"]
        dst = os.path.join(root_img, f"background{group_no}.gif")
        move_overwriting(ref, dst)
        update_htmls_for_folders(group_no, [u["folder"]])

    # Write conflict notes, if any
    if conflict_notes:
        note_path = os.path.join(root, "img_move_conflicts.txt")
        with open(note_path, "w", encoding="latin-1") as nf:
            nf.write("\r\n".join(conflict_notes))
        print("Wrote collision notes:", note_path)
    else:
        print("No filename collisions while consolidating img/ assets.")

    # Final summary JSON with destinations included
    # (Augment the report and overwrite)
    for g in numbered_groups:
        g["dest_background"] = f"img/background{g['group_number']}.gif"
    for u in numbered_uniques:
        u["dest_background"] = f"img/background{u['group_number']}.gif"
    report["groups"] = numbered_groups
    report["uniques"] = numbered_uniques
    with open(report_path, "w", encoding="latin-1") as jf:
        json.dump(report, jf, indent=2, ensure_ascii=False)
    print("Updated JSON report with destinations:", report_path)


if __name__ == "__main__":
    main()
