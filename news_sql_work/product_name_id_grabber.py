#!/usr/bin/env python3
"""
add_url_appids_to_associated.py

Input:
  - news_merged_with_associated_appids.sql

Output:
  - news_merged_with_associated_appids_urlfixed.sql

Behavior:
- For each INSERT INTO news (...) VALUES (...):
  - Extract the `content` field (SQL string)
  - Find appids in URLs like:
      store.steampowered.com/app/236510
      cdn.steampowered.com/v/gfx/apps/236510/capsule_...
    (Also handles http/https and optional trailing slash/query)
  - Merge found appids into associated_appids (comma-separated), preserving existing ones,
    adding new ones not already present.
- Leaves everything else unchanged.
"""

from __future__ import annotations

import re
from pathlib import Path
from typing import List

SQL_IN = Path("news_merged_with_associated_appids.sql")
SQL_OUT = Path("news_merged_with_associated_appids_urlfixed.sql")

INSERT_RE = re.compile(
    r"INSERT\s+INTO\s+news\s*\((?P<cols>[^)]*)\)\s*VALUES\s*\((?P<vals>.*?)\)\s*"
    r"(?P<rest>ON\s+DUPLICATE\s+KEY\s+UPDATE\s+.*?;)",
    re.IGNORECASE | re.DOTALL
)

# Match appids inside typical Steam URLs found in HTML.
# Covers:
#   /app/236510
#   /apps/236510/
# with optional protocol/domain/path noise.
URL_APPID_RE = re.compile(
    r"""(?ix)
    (?:https?://)?                # optional scheme
    (?:[a-z0-9.-]+\.)?            # optional subdomain(s)
    steampowered\.com             # domain
    /app/(\d+)                    # /app/<appid>
    (?:[/?#"' ]|$)                # boundary
    |
    (?:https?://)?                # optional scheme
    (?:[a-z0-9.-]+\.)?            # optional subdomain(s)
    steampowered\.com             # domain
    /v/gfx/apps/(\d+)             # /v/gfx/apps/<appid>
    (?:[/?#"' ]|$)                # boundary
    |
    (?:https?://)?                # optional scheme
    (?:[a-z0-9.-]+\.)?            # optional subdomain(s)
    steampowered\.com             # domain
    /apps/(\d+)                   # /apps/<appid>/... (some cdn paths)
    (?:[/?#"' ]|$)                # boundary
    """
)

def split_sql_values(values_blob: str) -> List[str]:
    """
    Split a SQL VALUES(...) list into fields, handling:
    - single-quoted strings with doubled quotes '' inside
    - commas inside strings
    """
    out: List[str] = []
    buf: List[str] = []
    in_str = False
    i = 0
    n = len(values_blob)

    while i < n:
        c = values_blob[i]

        if in_str:
            buf.append(c)
            if c == "'":
                # doubled '' escape inside string
                if i + 1 < n and values_blob[i + 1] == "'":
                    buf.append("'")
                    i += 1
                else:
                    in_str = False
        else:
            if c == "'":
                in_str = True
                buf.append(c)
            elif c == ",":
                out.append("".join(buf).strip())
                buf = []
            else:
                buf.append(c)
        i += 1

    if buf:
        out.append("".join(buf).strip())

    return out

def parse_columns(cols_blob: str) -> List[str]:
    return [c.strip().strip("`") for c in cols_blob.split(",") if c.strip()]

def sql_unquote(s: str) -> str:
    s = s.strip()
    if len(s) >= 2 and s[0] == "'" and s[-1] == "'":
        inner = s[1:-1]
        return inner.replace("''", "'")
    return s

def sql_quote(s: str) -> str:
    return "'" + s.replace("'", "''") + "'"

def extract_url_appids(content: str) -> List[str]:
    """
    Return appids found in content, in appearance order, unique.
    """
    found: List[str] = []
    seen = set()

    for m in URL_APPID_RE.finditer(content):
        # regex has 3 alternative capture groups, pick the one that matched
        appid = m.group(1) or m.group(2) or m.group(3)
        if appid and appid not in seen:
            seen.add(appid)
            found.append(appid)

    return found

def merge_appids(existing_csv: str, new_ids: List[str]) -> str:
    """
    Merge comma-separated appids with new ids, preserving existing order,
    appending new ones at the end.
    """
    existing_csv = existing_csv.strip()
    existing = []
    seen = set()

    if existing_csv:
        for part in existing_csv.split(","):
            p = part.strip()
            if p and p.isdigit() and p not in seen:
                seen.add(p)
                existing.append(p)

    for nid in new_ids:
        if nid not in seen:
            seen.add(nid)
            existing.append(nid)

    return ",".join(existing)

def main():
    sql = SQL_IN.read_text(encoding="utf-8", errors="replace")

    def repl(m: re.Match) -> str:
        cols = parse_columns(m.group("cols"))
        vals = split_sql_values(m.group("vals"))
        rest = m.group("rest")

        if len(cols) != len(vals):
            return m.group(0)

        cols_l = [c.lower() for c in cols]

        # Need content + associated_appids to exist
        try:
            content_i = cols_l.index("content")
            assoc_i = cols_l.index("associated_appids")
        except ValueError:
            return m.group(0)

        content_raw = vals[content_i]
        assoc_raw = vals[assoc_i]

        # content should be a SQL string
        content = sql_unquote(content_raw)

        # associated_appids may be '' or NULL or a quoted string
        if assoc_raw.upper() == "NULL":
            existing_assoc = ""
        else:
            existing_assoc = sql_unquote(assoc_raw)

        url_appids = extract_url_appids(content)
        if not url_appids:
            return m.group(0)

        merged = merge_appids(existing_assoc, url_appids)

        # write back
        vals[assoc_i] = sql_quote(merged)

        new_cols = ", ".join(cols)
        new_vals = ", ".join(vals)
        return f"INSERT INTO news ({new_cols})\nVALUES ({new_vals})\n{rest}"

    out_sql = INSERT_RE.sub(repl, sql)
    SQL_OUT.write_text(out_sql, encoding="utf-8")

if __name__ == "__main__":
    main()
