#!/usr/bin/env python3
"""
steamnews_to_news_table.py

Inputs (same directory):
  - steamNews_with_products.sql
  - install_news.sql

Output:
  - news_merged.sql

Rules:
- Replace publish_date for matching IDs using install_news.sql timestamps (DATETIME).
- Add is_official=1 and status='final' for every row.
- Remove source_url and date_raw entirely.
- Rename / remap:
    steamNews.newsid       -> news.id
    steamNews.date_iso     -> news.publish_date (but overridden by install timestamps when present)
    steamNews.publisher    -> news.author
    steamNews.content_html -> news.content
- KEEP steamNews.category -> news.category (unchanged).
- Set publish_at = publish_date, views=0.
"""

from __future__ import annotations

import re
from pathlib import Path
from typing import List, Dict


STEAM_IN = Path("steamNews_with_products.sql")
INSTALL_IN = Path("install_news.sql")
OUT = Path("news_merged.sql")


def split_sql_csv(values_blob: str) -> List[str]:
    """
    Split a SQL VALUES(...) list by commas, respecting single-quoted strings.
    Preserves tokens exactly (including quotes, escaping like '').
    """
    out: List[str] = []
    buf: List[str] = []
    in_str = False
    i = 0
    n = len(values_blob)

    while i < n:
        ch = values_blob[i]

        if in_str:
            buf.append(ch)
            if ch == "'":
                # SQL escape: '' inside strings
                if i + 1 < n and values_blob[i + 1] == "'":
                    buf.append(values_blob[i + 1])
                    i += 1
                else:
                    in_str = False
        else:
            if ch == "'":
                in_str = True
                buf.append(ch)
            elif ch == ",":
                out.append("".join(buf).strip())
                buf = []
            else:
                buf.append(ch)

        i += 1

    tail = "".join(buf).strip()
    if tail:
        out.append(tail)

    return out


def normalize_col_list(cols_blob: str) -> List[str]:
    cols = []
    for c in cols_blob.split(","):
        c = c.strip()
        if c.startswith("`") and c.endswith("`") and len(c) >= 2:
            c = c[1:-1]
        cols.append(c)
    return cols


def build_install_publish_date_map(install_sql: str) -> Dict[int, str]:
    """
    Extract id -> publish_date token (DATETIME string) from install_news.sql.

    Expected style:
      INSERT INTO news(id,title,author,publish_date,content,products) VALUES (...);
    But column ordering may vary, so we parse column list + values list.
    """
    out: Dict[int, str] = {}

    insert_re = re.compile(
        r"INSERT\s+INTO\s+news\s*\((?P<cols>[^)]*?)\)\s*VALUES\s*\((?P<vals>.*?)\)\s*;",
        re.IGNORECASE | re.DOTALL,
    )

    for m in insert_re.finditer(install_sql):
        cols = normalize_col_list(m.group("cols"))
        vals = split_sql_csv(m.group("vals"))

        if not cols or not vals or len(cols) != len(vals):
            continue

        lower_cols = [c.lower() for c in cols]
        if "id" not in lower_cols or "publish_date" not in lower_cols:
            continue

        try:
            id_idx = lower_cols.index("id")
            pd_idx = lower_cols.index("publish_date")
            news_id = int(vals[id_idx].strip())
        except Exception:
            continue

        publish_date_token = vals[pd_idx].strip()
        # Keep as-is (usually 'YYYY-MM-DD HH:MM:SS')
        if publish_date_token:
            out[news_id] = publish_date_token

    return out


def parse_steam_inserts(steam_sql: str) -> List[Dict[str, str]]:
    """
    Parse INSERT INTO steamNews (...) VALUES (... ) ...; blocks.
    Returns list of row dicts keyed by column names.
    We ignore ON DUPLICATE clauses entirely.
    """
    rows: List[Dict[str, str]] = []

    insert_re = re.compile(
        r"INSERT\s+INTO\s+steamNews\s*\((?P<cols>[^)]*?)\)\s*"
        r"VALUES\s*\((?P<vals>.*?)\)\s*"
        r"(?:ON\s+DUPLICATE\s+KEY\s+UPDATE\s*.*?\s*)?;",
        re.IGNORECASE | re.DOTALL,
    )

    for m in insert_re.finditer(steam_sql):
        cols = normalize_col_list(m.group("cols"))
        vals = split_sql_csv(m.group("vals"))

        if not cols or not vals or len(cols) != len(vals):
            continue

        row = {cols[i]: vals[i] for i in range(len(cols))}
        rows.append(row)

    return rows


def date_iso_to_datetime_token(date_iso_token: str) -> str:
    """
    Convert a DATE token like '2002-10-15' to DATETIME token '2002-10-15 00:00:00'.
    If token is NULL or already looks like a datetime string, leave reasonably.
    """
    t = date_iso_token.strip()
    if not t or t.upper() == "NULL":
        return "NULL"

    # expecting quoted date: 'YYYY-MM-DD'
    m = re.fullmatch(r"'(\d{4}-\d{2}-\d{2})'", t)
    if m:
        return f"'{m.group(1)} 00:00:00'"

    # If it already contains time, keep it (best-effort)
    return t


def emit_news_sql(rows: List[Dict[str, str]], install_pd_map: Dict[int, str]) -> str:
    """
    Create output SQL matching the target news table schema.
    """
    header = """-- Generated by steamnews_to_news_table.py
SET NAMES utf8mb4;
SET time_zone = '+00:00';

CREATE TABLE news(
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                title TEXT,
                author TEXT,
                category TEXT,
                publish_date DATETIME,
                publish_at DATETIME,
                views INT DEFAULT 0,
                content TEXT,
                products TEXT,
                is_official TINYINT(1) DEFAULT 1,
                status VARCHAR(20) DEFAULT 'draft',
                INDEX(publish_date),
                INDEX(publish_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

"""

    out_lines: List[str] = [header]

    # For determinism: sort by id numeric
    def get_id(r: Dict[str, str]) -> int:
        raw = r.get("newsid", "0").strip()
        try:
            return int(raw)
        except Exception:
            return 0

    rows_sorted = sorted(rows, key=get_id)

    for r in rows_sorted:
        try:
            news_id = int(r.get("newsid", "").strip())
        except Exception:
            continue

        title = r.get("title", "NULL")
        author = r.get("publisher", "NULL")          # publisher -> author
        category = r.get("category", "NULL")         # KEEP category unchanged
        content = r.get("content_html", "NULL")      # content_html -> content
        products = r.get("products", "NULL")

        # publish_date: prefer install timestamp if present, else date_iso -> datetime
        if news_id in install_pd_map:
            publish_date = install_pd_map[news_id]
        else:
            publish_date = date_iso_to_datetime_token(r.get("date_iso", "NULL"))

        publish_at = publish_date
        views = "0"
        is_official = "1"
        status = "'final'"

        cols_out = (
            "id, title, author, category, publish_date, publish_at, views, content, products, is_official, status"
        )
        vals_out = (
            f"{news_id}, {title}, {author}, {category}, {publish_date}, {publish_at}, "
            f"{views}, {content}, {products}, {is_official}, {status}"
        )

        stmt = (
            f"INSERT INTO news ({cols_out})\n"
            f"VALUES ({vals_out})\n"
            f"ON DUPLICATE KEY UPDATE\n"
            f"  title=VALUES(title),\n"
            f"  author=VALUES(author),\n"
            f"  category=VALUES(category),\n"
            f"  publish_date=VALUES(publish_date),\n"
            f"  publish_at=VALUES(publish_at),\n"
            f"  views=VALUES(views),\n"
            f"  content=VALUES(content),\n"
            f"  products=VALUES(products),\n"
            f"  is_official=VALUES(is_official),\n"
            f"  status=VALUES(status);\n"
        )
        out_lines.append(stmt)

    return "".join(out_lines)


def main() -> int:
    if not STEAM_IN.exists():
        print(f"Missing input: {STEAM_IN}")
        return 1
    if not INSTALL_IN.exists():
        print(f"Missing input: {INSTALL_IN}")
        return 1

    steam_sql = STEAM_IN.read_text(encoding="utf-8", errors="replace")
    install_sql = INSTALL_IN.read_text(encoding="utf-8", errors="replace")

    install_pd_map = build_install_publish_date_map(install_sql)
    rows = parse_steam_inserts(steam_sql)

    if not rows:
        print("No steamNews INSERTs found in steamNews_with_products.sql (format changed?)")
        return 2

    merged_sql = emit_news_sql(rows, install_pd_map)
    OUT.write_text(merged_sql, encoding="utf-8", errors="strict")

    matched = sum(1 for r in rows if int(r.get("newsid", "0").strip() or 0) in install_pd_map)
    print(f"Wrote: {OUT}")
    print(f"Rows processed: {len(rows)}")
    print(f"Publish_date overridden from install_news.sql for {matched} matching IDs")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
