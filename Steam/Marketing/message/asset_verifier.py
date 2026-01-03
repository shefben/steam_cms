#!/usr/bin/env python3
"""
asset_audit.py

Scans every .html file in the same directory as this script.
Finds:
  - <img src="..."> (also srcset)
  - <link rel="stylesheet" href="...">
  - <style> ... url(...) ... </style>
  - style="... url(...) ..."
Checks whether referenced local assets exist on disk.

Outputs:
  issues.txt
Each line: <html_basename>: <missing1>, <missing2>, ...

No parameters. Just run it.
"""

from __future__ import annotations

import re
from pathlib import Path
from urllib.parse import urlsplit, unquote


# --- Regexes for simple HTML/CSS extraction (good enough for static pages) ---
IMG_SRC_RE = re.compile(r"""<img\b[^>]*\bsrc\s*=\s*(['"])(.*?)\1""", re.IGNORECASE | re.DOTALL)
LINK_STYLESHEET_RE = re.compile(
    r"""<link\b[^>]*\brel\s*=\s*(['"])stylesheet\1[^>]*\bhref\s*=\s*(['"])(.*?)\2""",
    re.IGNORECASE | re.DOTALL,
)
# Allow href before rel too (HTML authors are creative in the worst ways)
LINK_HREF_RE = re.compile(r"""<link\b[^>]*\bhref\s*=\s*(['"])(.*?)\1""", re.IGNORECASE | re.DOTALL)
LINK_REL_RE = re.compile(r"""<link\b[^>]*\brel\s*=\s*(['"])(.*?)\1""", re.IGNORECASE | re.DOTALL)

# srcset: "a.jpg 1x, b.jpg 2x" or "a.jpg 320w, b.jpg 640w"
IMG_SRCSET_RE = re.compile(r"""<img\b[^>]*\bsrcset\s*=\s*(['"])(.*?)\1""", re.IGNORECASE | re.DOTALL)

# CSS url(...) extraction for inline style tags + style="" attributes
STYLE_TAG_RE = re.compile(r"""<style\b[^>]*>(.*?)</style>""", re.IGNORECASE | re.DOTALL)
STYLE_ATTR_RE = re.compile(r"""\bstyle\s*=\s*(['"])(.*?)\1""", re.IGNORECASE | re.DOTALL)
CSS_URL_RE = re.compile(r"""url\(\s*(['"]?)(.*?)\1\s*\)""", re.IGNORECASE | re.DOTALL)


def is_probably_remote(url: str) -> bool:
    """Return True if the asset is remote or data/blob/etc."""
    u = url.strip()
    if not u:
        return True
    parts = urlsplit(u)
    if parts.scheme and parts.scheme.lower() not in ("file",):
        return True  # http, https, data, blob, etc.
    # Protocol-relative: //cdn.example.com/x.css
    if u.startswith("//"):
        return True
    # Anchor or JS pseudo-URLs aren't file assets
    if u.startswith("#") or u.lower().startswith("javascript:"):
        return True
    return False


def normalize_asset_ref(ref: str) -> str:
    """
    Strip query/hash, decode %xx, normalize slashes a bit.
    Keep leading / if present (root-relative).
    """
    s = ref.strip()
    # src can be empty or weird
    if not s:
        return ""
    # Drop query/hash (a.png?v=1#x -> a.png)
    parts = urlsplit(s)
    path = parts.path
    path = unquote(path)
    return path


def resolve_to_fs_path(html_path: Path, asset_path: str, base_dir: Path) -> Path | None:
    """
    Resolve asset reference to a filesystem path.

    Rules:
    - Root-relative (/images/a.png) is treated as relative to base_dir (script dir).
      (No magic web root available, so this is the only sane choice.)
    - Relative paths resolve relative to the HTML file's directory.
    """
    if not asset_path:
        return None

    # Make Windows tolerate forward slashes.
    asset_path = asset_path.replace("\\", "/")

    if asset_path.startswith("/"):
        # Root-relative => interpret as under base_dir
        return (base_dir / asset_path.lstrip("/")).resolve()

    return (html_path.parent / asset_path).resolve()


def extract_assets(html_text: str) -> set[str]:
    assets: set[str] = set()

    # <img src="...">
    for _, src in IMG_SRC_RE.findall(html_text):
        assets.add(src)

    # <img srcset="...">
    for _, srcset in IMG_SRCSET_RE.findall(html_text):
        # Split by commas, take first token as URL
        for candidate in srcset.split(","):
            c = candidate.strip()
            if not c:
                continue
            url_part = c.split()[0]  # drop "1x", "320w", etc.
            assets.add(url_part)

    # <link rel="stylesheet" href="..."> in the strict order
    for _, _, href in LINK_STYLESHEET_RE.findall(html_text):
        assets.add(href)

    # Also handle <link href="..." rel="stylesheet"> swapped attributes
    # We'll grab all links, then keep those whose rel contains "stylesheet".
    link_tags = re.findall(r"<link\b[^>]*>", html_text, flags=re.IGNORECASE | re.DOTALL)
    for tag in link_tags:
        rel_m = LINK_REL_RE.search(tag)
        href_m = LINK_HREF_RE.search(tag)
        if not rel_m or not href_m:
            continue
        rel_val = rel_m.group(2).lower()
        if "stylesheet" in rel_val:
            assets.add(href_m.group(2))

    # Inline <style> ... url(...) ...
    for css_block in STYLE_TAG_RE.findall(html_text):
        for _, u in CSS_URL_RE.findall(css_block):
            assets.add(u)

    # style="... url(...) ..."
    for _, style_attr in STYLE_ATTR_RE.findall(html_text):
        for _, u in CSS_URL_RE.findall(style_attr):
            assets.add(u)

    return assets


def main() -> int:
    base_dir = Path(__file__).resolve().parent
    html_files = sorted(base_dir.glob("*.html"))

    issues_lines: list[str] = []

    for html_path in html_files:
        try:
            text = html_path.read_text(encoding="utf-8", errors="replace")
        except Exception as e:
            # If the HTML can't be read, that's an issue too.
            issues_lines.append(f"{html_path.stem}: [ERROR reading file: {e}]")
            continue

        raw_assets = extract_assets(text)
        missing: list[str] = []

        for raw in sorted(raw_assets):
            if is_probably_remote(raw):
                continue  # not a local file path, not our problem

            normalized = normalize_asset_ref(raw)
            if not normalized:
                continue

            fs_path = resolve_to_fs_path(html_path, normalized, base_dir)
            if fs_path is None:
                continue

            if not fs_path.exists():
                # Record the reference exactly as used (minus query/hash),
                # because that's what you need to fix in the HTML.
                missing.append(normalized)

        if missing:
            issues_lines.append(f"{html_path.stem}: " + ", ".join(missing))

    out_path = base_dir / "issues.txt"
    out_path.write_text("\n".join(issues_lines) + ("\n" if issues_lines else ""), encoding="utf-8")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
