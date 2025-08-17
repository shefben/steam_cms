#!/usr/bin/env python3
"""
fix_background_gifs.py (v3)

What this does
--------------
For each group/member in background_groups.json:
  • Finds the HTML file: <marketing>/<basename(folder)>.html (or .htm)
  • Rewrites **background.gif** references to: img/background<group>.gif
    - Works in HTML attributes (src= / background=), inline styles, and CSS url(...)
  • Additionally, normalizes any **relative** references that look like
    "<anything>/img/<file>" → "img/<file>"
    - Applies to HTML attrs and CSS url(...)
    - Skips http(s)://, data:, steam://
    - Leaves already-correct "img/<file>" alone

Usage
-----
  python fix_background_gifs.py -j path\to\background_groups.json
  python fix_background_gifs.py -n                # dry run
  python fix_background_gifs.py --no-css          # skip linked CSS edits
  python fix_background_gifs.py -v                # verbose per-file details

Encoding
--------
  • HTML read/write: latin-1
  • CSS read/write: utf-8 (fallback to latin-1)

Backups
-------
  • Creates .bak next to any file it modifies.
"""
import argparse
import json
import re
import shutil
from pathlib import Path
from typing import List, Tuple, Optional

# 1) Specific "background.gif" replacement targets
ATTR_BG_PATTERN = re.compile(
    r'(?i)\\b(src|background)\\s*=\\s*(["\\\']?)(?!https?:|steam://|data:)(?:[^>\\s"\\\']*[\\\\/])?background\\.gif\\2'
)
CSS_URL_BG_PATTERN = re.compile(
    r'(?i)url\\(\\s*(["\\\']?)(?!https?:|steam://|data:)(?:[^)\\\'"]*[\\\\/])?background\\.gif\\1\\s*\\)'
)

# 2) Generic normalizer for any "<anything>/img/<file>" → "img/<file>"
#    (match attr values that are relative; we capture the whole URL-ish value to run through a helper)
ATTR_GENERIC_PATTERN = re.compile(
    r'(?is)\\b(src|background)\\s*=\\s*(["\\\']?)([^"\\\'>\\s]+)\\2'
)
CSS_URL_GENERIC_PATTERN = re.compile(
    r'(?is)url\\(\\s*(["\\\']?)([^)\\\'"]+)\\1\\s*\\)'
)

LINK_CSS_HREF_PATTERN = re.compile(
    r'(?is)<link\\b[^>]*?href\\s*=\\s*["\\\']([^"\\\']+\\.css)\\b[^"\\\']*["\\\'][^>]*>'
)

def pick_html_for_folder(folder_path: str) -> Path:
    p = Path(folder_path)
    marketing_dir = p.parent
    base = p.name
    html = marketing_dir / f"{base}.html"
    if html.exists():
        return html
    htm = marketing_dir / f"{base}.htm"
    if htm.exists():
        return htm
    return html

def _normalize_img_like(url: str) -> Optional[str]:
    """Return normalized 'img/<tail>' if url is relative and contains '/img/<tail>' with a prefix before 'img/'."""
    s = url.strip()
    if re.match(r'(?i)^(?:https?://|steam://|data:|img[\\\\/])', s):
        return None
    m = re.search(r'(?i)[\\\\/](img)[\\\\/]+([^?#"\\\'>]+)$', s)
    if not m:
        return None
    tail = m.group(2)
    if not tail:
        return None
    return f"img/{tail}"

def _replace_bg_specific_in_text(text: str, group_number: int) -> Tuple[str, int]:
    """Replace background.gif → img/background<group>.gif in HTML/CSS text."""
    new_src = f"img/background{group_number}.gif"

    def _attr_repl(m: re.Match) -> str:
        attr = m.group(1)
        quote = m.group(2) or ""
        return f'{attr}={quote}{new_src}{quote}'

    text2, n1 = ATTR_BG_PATTERN.subn(_attr_repl, text)

    def _url_repl(m: re.Match) -> str:
        q = m.group(1) or ""
        return f'url({q}{new_src}{q})'

    text3, n2 = CSS_URL_BG_PATTERN.subn(_url_repl, text2)
    return text3, (n1 + n2)

def _replace_generic_normalization_in_text(text: str) -> Tuple[str, int]:
    """Normalize any relative '<anything>/img/<file>' to 'img/<file>' in HTML attrs and CSS url()."""
    # Attributes
    def attr_norm_repl(m: re.Match) -> str:
        attr = m.group(1)
        quote = m.group(2) or ""
        val = m.group(3)
        new = _normalize_img_like(val)
        if new and new != val:
            return f'{attr}={quote}{new}{quote}'
        return m.group(0)  # unchanged

    t2, n_attr = ATTR_GENERIC_PATTERN.subn(attr_norm_repl, text)

    # CSS url(...)
    def css_norm_repl(m: re.Match) -> str:
        q = m.group(1) or ""
        val = m.group(2)
        new = _normalize_img_like(val)
        if new and new != val:
            return f'url({q}{new}{q})'
        return m.group(0)

    t3, n_css = CSS_URL_GENERIC_PATTERN.subn(css_norm_repl, t2)
    return t3, (n_attr + n_css)

def replace_in_css_file(css_path: Path, group_number: int, dry_run: bool=False, verbose: bool=False) -> int:
    if not css_path.exists():
        return 0

    # Read CSS (utf-8, fallback latin-1)
    try:
        css_text = css_path.read_text(encoding="utf-8")
    except UnicodeDecodeError:
        css_text = css_path.read_text(encoding="latin-1", errors="ignore")

    total_changes = 0

    # First: specific background.gif rewrite
    css_text_1, n_bg = _replace_bg_specific_in_text(css_text, group_number)
    total_changes += n_bg

    # Second: generic normalization
    css_text_2, n_norm = _replace_generic_normalization_in_text(css_text_1)
    total_changes += n_norm

    if total_changes > 0 and not dry_run:
        bak = css_path.with_suffix(css_path.suffix + ".bak")
        try:
            if not bak.exists():
                shutil.copy2(css_path, bak)
        except Exception:
            pass
        # Write CSS as utf-8
        css_path.write_text(css_text_2, encoding="utf-8", errors="ignore")

    if verbose and (n_bg or n_norm):
        print(f"  CSS changed: {css_path} (bg:{n_bg}, norm:{n_norm})")

    return total_changes

def update_html(html_path: Path, group_number: int, dry_run: bool=False, include_css: bool=True, verbose: bool=False) -> dict:
    if not html_path.exists():
        return {"html": str(html_path), "exists": False, "changed": False, "replacements_html_bg": 0, "replacements_html_norm": 0, "replacements_css": 0}

    try:
        text = html_path.read_text(encoding="latin-1", errors="ignore")
    except Exception as e:
        return {"html": str(html_path), "exists": True, "changed": False, "replacements_html_bg": 0, "replacements_html_norm": 0, "replacements_css": 0, "error": str(e)}

    # 1) Specific background.gif rewrite in HTML text
    t1, n_html_bg = _replace_bg_specific_in_text(text, group_number)

    # 2) Generic normalization in HTML text
    t2, n_html_norm = _replace_generic_normalization_in_text(t1)

    n_css = 0
    css_paths: List[Path] = []
    if include_css:
        # Find linked CSS files from the ORIGINAL text (not to miss any due to edits)
        for href in LINK_CSS_HREF_PATTERN.findall(text):
            resolved = (html_path.parent / href).resolve()
            css_paths.append(resolved)

        for css in css_paths:
            n_css += replace_in_css_file(css, group_number, dry_run=dry_run, verbose=verbose)

    if (n_html_bg or n_html_norm) and not dry_run:
        bak = html_path.with_suffix(html_path.suffix + ".bak")
        try:
            if not bak.exists():
                shutil.copy2(html_path, bak)
        except Exception:
            pass
        html_path.write_text(t2, encoding="latin-1", errors="ignore")

    if verbose:
        print(f"[DBG] {html_path}  html_bg:{n_html_bg} html_norm:{n_html_norm} css_total:{n_css}")

    return {
        "html": str(html_path),
        "exists": True,
        "changed": bool(n_html_bg or n_html_norm or n_css),
        "replacements_html_bg": int(n_html_bg),
        "replacements_html_norm": int(n_html_norm),
        "replacements_css": int(n_css),
        "css_files": [str(p) for p in css_paths],
    }

def main():
    ap = argparse.ArgumentParser(description="Update background.gif + normalize <anything>/img/<file> to img/<file>")
    ap.add_argument("-j", "--json", default="background_groups.json", help="Path to background_groups.json")
    ap.add_argument("-n", "--dry-run", action="store_true", help="Show actions without writing")
    ap.add_argument("--no-css", action="store_true", help="Do NOT rewrite linked CSS files")
    ap.add_argument("-v", "--verbose", action="store_true", help="Verbose per-file debug output")
    args = ap.parse_args()

    json_path = Path(args.json)
    if not json_path.exists():
        print(f"[ERROR] JSON not found: {json_path}")
        raise SystemExit(1)

    with json_path.open("r", encoding="utf-8") as f:
        data = json.load(f)

    groups = data.get("groups", [])
    total = 0
    changed = 0
    summaries = []

    for grp in groups:
        group_number = grp.get("group_number")
        members = grp.get("members", [])
        if group_number is None:
            continue

        for mem in members:
            folder = mem.get("folder")
            if not folder:
                continue

            html_path = pick_html_for_folder(folder)
            result = update_html(
                html_path,
                group_number,
                dry_run=args.dry_run,
                include_css=not args.no_css,
                verbose=args.verbose
            )
            summaries.append(result)
            total += 1
            if result.get("changed"):
                changed += 1

    print(f"Processed members: {total}, files with any changes (HTML or CSS): {changed}")
    for s in summaries:
        flag = "CHANGED" if s.get("changed") else ("MISSING" if not s.get("exists") else "OK")
        print(f"[{flag}] {s.get('html')}  (html bg: {s.get('replacements_html_bg')}, html norm: {s.get('replacements_html_norm')}, css edits: {s.get('replacements_css')})")
        css_list = s.get("css_files") or []
        for css in css_list:
            print(f"       ↳ CSS: {css}")

if __name__ == "__main__":
    main()
