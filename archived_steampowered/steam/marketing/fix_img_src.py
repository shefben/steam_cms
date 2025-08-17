#!/usr/bin/env python3
"""
Normalize <img src> paths to /img/... under the folder where this script runs.

Rules:
- Only touch <img> tags.
- Leave absolute/external/data URIs alone (http(s), //, data:, mailto:, javascript:).
- Convert any relative path that contains an img directory (e.g., ../x/img/foo.png,
  ./img/foo.png, x/y/img/foo.png, img/foo.png) to /img/foo.png.
- Works on .htm and .html files (case-insensitive), recursively.
- Uses latin-1 to avoid choking on odd encodings common in old sites.
"""

import os
import re
from typing import Tuple

# Match complete <img ...> tags
IMG_TAG_RE = re.compile(r'(?is)<img\b[^>]*>')

# Match a src=... attribute inside a tag (quotes optional)
SRC_ATTR_RE = re.compile(r'''(?i)\bsrc\s*=\s*(?P<q>["']?)(?P<val>[^"'>\s]+)(?P=q)''')

# Schemes we will NOT touch
SKIP_PREFIXES = ('http://', 'https://', '//', 'data:', 'mailto:', 'javascript:')

def _normalize_src_value(val: str) -> str:
    """
    Return a normalized src value or the original if no change needed.
    Target: /img/<tail>
    """
    original = val
    v = val.strip()

    # Ignore absolute/external/data URIs
    low = v.lower()
    if low.startswith(SKIP_PREFIXES):
        return original

    # Normalize slashes for inspection; keep length same so indices align
    v_norm = v.replace('\\', '/')
    low_norm = v_norm.lower()

    # Determine if/where 'img/' occurs
    new_val = None
    if low_norm.startswith('img/'):
        # e.g. "img/foo.png" -> "/img/foo.png"
        tail = v_norm[4:]  # after "img/"
        new_val = 'img/' + tail.lstrip('/\\')
    else:
        idx = low_norm.find('/img/')
        if idx != -1:
            # e.g. "../path/img/foo.png" -> "/img/foo.png"
            tail = v_norm[idx + 5:]  # after "/img/"
            new_val = 'img/' + tail.lstrip('/\\')

    # If no '/img/' but path contains '\img\' (rare in HTML), we already normalized backslashes above
    # so it would have appeared as '/img/' if present.

    return new_val if new_val is not None else original

def _fix_img_tag(tag_html: str) -> str:
    m = SRC_ATTR_RE.search(tag_html)
    if not m:
        return tag_html

    val = m.group('val')
    fixed = _normalize_src_value(val)
    if fixed == val:
        return tag_html  # no change

    # Replace only the attribute value, preserving original spacing/quotes
    start, end = m.span('val')
    return tag_html[:start] + fixed + tag_html[end:]

def _process_html(content: str) -> Tuple[str, int]:
    changes = 0

    def repl_tag(m):
        nonlocal changes
        tag = m.group(0)
        fixed = _fix_img_tag(tag)
        if fixed != tag:
            changes += 1
        return fixed

    new_content = IMG_TAG_RE.sub(repl_tag, content)
    return new_content, changes

def _is_html(filename: str) -> bool:
    ext = os.path.splitext(filename)[1].lower()
    return ext in ('.htm', '.html')

def main():
    root = os.getcwd()
    total_files = 0
    total_changes = 0

    for dirpath, _, filenames in os.walk(root):
        for fname in filenames:
            if not _is_html(fname):
                continue
            fpath = os.path.join(dirpath, fname)
            try:
                with open(fpath, 'r', encoding='latin-1', errors='ignore') as f:
                    content = f.read()
                fixed, changes = _process_html(content)
                if changes > 0:
                    with open(fpath, 'w', encoding='latin-1', errors='ignore') as f:
                        f.write(fixed)
                    print(f"[UPDATED] {fpath}  ({changes} change{'s' if changes != 1 else ''})")
                    total_changes += changes
                total_files += 1
            except Exception as e:
                print(f"[ERROR] {fpath}: {e}")

    print(f"\nDone. Scanned {total_files} HTML files. Applied {total_changes} changes.")

if __name__ == '__main__':
    main()
