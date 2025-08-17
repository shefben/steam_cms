#!/usr/bin/env python3
"""
Flatten nested 'message/<parentname>' folders.

From the script's directory downward, for each directory <PARENT>:
if there exists '<PARENT>/message/<PARENT>/', move all contents of that
innermost folder up into '<PARENT>/' and then delete the 'message' folder.

Example:
  F:\...\steam\Messages\809\message\809\{message.css,img\...}
becomes
  F:\...\steam\Messages\809\{message.css,img\...}
and removes
  F:\...\steam\Messages\809\message\
"""

import os
import shutil
from pathlib import Path

def _case_insensitive_find(name_list, target_lower):
    """Return the actual entry from name_list whose casefold() matches target_lower, else None."""
    for n in name_list:
        if n.casefold() == target_lower:
            return n
    return None

def move_contents(src: Path, dst: Path):
    """
    Move all entries (files/dirs) from src into dst.
    - Files: overwrite if exists.
    - Dirs: merge recursively; if a conflicting file blocks a dir, skip and warn.
    """
    for entry in src.iterdir():
        s = entry
        d = dst / entry.name
        try:
            if s.is_file():
                # Ensure destination dir exists
                d.parent.mkdir(parents=True, exist_ok=True)
                if d.exists() and d.is_file():
                    # Overwrite file
                    d.unlink()
                elif d.exists() and d.is_dir():
                    # Destination is a directory but source is a file -> treat as conflict
                    print(f"[WARN] Skipping file '{s}' because '{d}' is a directory.")
                    continue
                os.replace(str(s), str(d))
                print(f"[MOVE] {s} -> {d}")
            elif s.is_dir():
                if d.exists() and d.is_file():
                    print(f"[WARN] Skipping directory '{s}' because '{d}' is an existing file.")
                    continue
                if not d.exists():
                    # Move the whole directory atomically if possible
                    shutil.move(str(s), str(d))
                    print(f"[MOVE] {s} -> {d}")
                else:
                    # Merge contents
                    move_contents(s, d)
                    # Remove the now-empty source directory (ignore if not empty due to errors)
                    try:
                        s.rmdir()
                        print(f"[RMDIR] {s}")
                    except OSError:
                        pass
            else:
                # Symlinks or specials: try to move like files
                d.parent.mkdir(parents=True, exist_ok=True)
                if d.exists():
                    if d.is_file():
                        d.unlink()
                    else:
                        print(f"[WARN] Skipping special '{s}' due to existing non-file destination '{d}'.")
                        continue
                shutil.move(str(s), str(d))
                print(f"[MOVE] {s} -> {d}")
        except Exception as e:
            print(f"[ERROR] Moving '{s}' -> '{d}': {e}")

def process_tree(base: Path):
    """
    Walk the tree top-down. For each directory, look for a 'message' subfolder
    (case-insensitive) containing a subfolder with the same name as the parent.
    """
    for dirpath, dirnames, _ in os.walk(base, topdown=True):
        parent = Path(dirpath)
        parent_name = parent.name

        # find a 'message' folder under this parent (case-insensitive)
        message_actual = _case_insensitive_find(dirnames, "message")
        if not message_actual:
            continue

        message_dir = parent / message_actual
        nested_dir = message_dir / parent_name  # '<parent>/message/<parent>/'

        if nested_dir.is_dir():
            print(f"\n[HIT] Found nested folder: {nested_dir}")
            print(f"[INFO] Moving contents into: {parent}")
            move_contents(nested_dir, parent)

            # Remove the entire 'message' folder after moving
            try:
                shutil.rmtree(str(message_dir))
                print(f"[RM -R] {message_dir}")
            except Exception as e:
                print(f"[ERROR] Removing '{message_dir}': {e}")

            # Avoid descending into a directory we just removed
            try:
                dirnames.remove(message_actual)
            except ValueError:
                pass

def main():
    base_dir = Path(__file__).resolve().parent
    print(f"[START] Base directory: {base_dir}")
    process_tree(base_dir)
    print("[DONE] Completed flattening.")

if __name__ == "__main__":
    main()
