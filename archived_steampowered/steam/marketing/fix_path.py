#!/usr/bin/env python3
"""
rewrite_img_paths.py
────────────────────
• For every *.html file in the same directory as this script:
      <img  src="img/foo/bar.png">      → <img  src="file_stem/img/foo/bar.png">
      <table background='img/foo.jpg'>  → <table background='file_stem/img/foo.jpg'>

  where “file_stem” is the HTML file name without the extension
  (now_playing.html → now_playing).

• Files are modified in-place; unchanged files are left untouched.
"""

import re
from pathlib import Path

# Matches:  src="img/...   or   background='img/...   (case-insensitive)
ATTR_RE = re.compile(
    r'(?P<attr>\b(?:src|background)\s*=\s*)(?P<quote>[\'"])(?P<path>img/[^\'"]+)(?P=quote)',
    flags=re.IGNORECASE,
)

def fix_html_file(html_path: Path) -> bool:
    """Rewrite one HTML file; return True if it changed."""
    stem = html_path.stem  # e.g.  now_playing  from  now_playing.html

    def _rewrite(match):
        # Build new attribute value: now_playing/img/…
        new_path = f"{stem}/{match.group('path')}"
        return f"{match.group('attr')}{match.group('quote')}{new_path}{match.group('quote')}"

    original = html_path.read_text(encoding="utf-8", errors="ignore")
    updated  = ATTR_RE.sub(_rewrite, original)

    if updated != original:
        html_path.write_text(updated, encoding="utf-8")
        return True
    return False


def main():
    here = Path(__file__).resolve().parent
    changed = sum(fix_html_file(html) for html in here.glob("*.html"))
    print(f"Updated {changed} HTML file(s).")


if __name__ == "__main__":
    main()
