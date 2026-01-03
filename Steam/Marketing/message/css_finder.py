#!/usr/bin/env python3
# -*- coding: latin-1 -*-
"""
List first-level subfolders that do not contain a CSS file.

- Looks only at subdirectories one level down from the script's directory.
- Does not recurse deeper.
- Outputs missing list to missing_css.json.

Usage: run in the 'message/' root folder.
"""

import os
import json

def main():
    root = os.path.abspath(os.path.dirname(__file__))
    missing = []

    # list first-level subdirectories
    for name in os.listdir(root):
        subdir = os.path.join(root, name)
        if not os.path.isdir(subdir):
            continue
        # check for css files in this subdir (non-recursive)
        has_css = any(
            fn.lower().endswith(".css")
            for fn in os.listdir(subdir)
            if os.path.isfile(os.path.join(subdir, fn))
        )
        if not has_css:
            missing.append(subdir)

    # output
    out_path = os.path.join(root, "missing_css.json")
    with open(out_path, "w", encoding="latin-1") as f:
        json.dump(missing, f, indent=2, ensure_ascii=False)

    print("Missing CSS subfolders written to:", out_path)
    for m in missing:
        print(" -", m)

if __name__ == "__main__":
    main()
