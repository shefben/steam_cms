#!/usr/bin/env python
# -*- coding: latin-1 -*-

"""
Fetch CDX JSON for Steam storefront (2007-2008), select the latest snapshot per AppId for URLs
containing ?area=game&AppId=... (works for either index.php? or /? patterns), and write one
Wayback URL per AppId to a text file.

Requirements:
- Python 3.9.13 64-bit (Windows OK)
- Network access
- Only stdlib is used
- All text I/O uses latin-1 encoding
- Date/time strings formatted as "%m/%d/%Y %H:%M:%S"
"""

import sys
import os
import json
import datetime
from urllib.parse import urlparse, parse_qsl
from urllib.request import urlopen, Request
from urllib.error import URLError, HTTPError

# ---------- HARD-CODED SETTINGS ----------
CDX_URL = (
    "https://web.archive.org/cdx/search/cdx"
    "?url=storefront.steampowered.com/v2/"
    "&matchType=prefix"
    "&from=20070101"
    "&to=20081231"
    "&output=json"
    "&fl=timestamp,original,statuscode,mimetype,digest"
    "&filter=statuscode:200"
    "&filter=mimetype:text/html"
    "&collapse=digest"
)

# Output file (text)
OUTPUT_FILE = "wayback_game_appids_2007_2008.txt"

# Expected CDX fields based on ?fl=...
EXPECTED_FIELDS = ["timestamp", "original", "statuscode", "mimetype", "digest"]


def now_str() -> str:
    # mandated format: "%m/%d/%Y %H:%M:%S"
    return datetime.datetime.utcnow().strftime("%m/%d/%Y %H:%M:%S")


def fetch_json(url: str) -> list:
    headers = {
        "User-Agent": "CDXFetcher/1.0 (+no-js; html-only)"
    }
    req = Request(url, headers=headers)
    try:
        with urlopen(req, timeout=60) as resp:
            data = resp.read().decode("latin-1", errors="replace")
    except HTTPError as e:
        sys.stderr.write(f"[{now_str()}] HTTPError {e.code} for {url}\n")
        raise
    except URLError as e:
        sys.stderr.write(f"[{now_str()}] URLError {e.reason} for {url}\n")
        raise
    except Exception as e:
        sys.stderr.write(f"[{now_str()}] Error fetching {url}: {e}\n")
        raise

    try:
        return json.loads(data)
    except Exception as e:
        sys.stderr.write(f"[{now_str()}] JSON parse error: {e}\n")
        sys.stderr.write(f"First 400 chars:\n{data[:400]}\n")
        raise


def is_header_row(row) -> bool:
    if not isinstance(row, list):
        return False
    txt = [str(x).lower() for x in row]
    return txt == EXPECTED_FIELDS


def extract_appid_and_ok(url_str: str):
    """
    Returns (appid, ok, english_or_none).
    ok=True if:
      - URL contains area=game
      - URL contains AppId=<something>
      - cc is either not present OR 'US' OR '--'
    english_or_none=True if 'l' is absent or 'english' (case-insensitive).
    """
    try:
        parts = urlparse(url_str)
        qs = dict(parse_qsl(parts.query, keep_blank_values=True))

        # Primary (case-sensitive first)
        area = qs.get("area", "").lower()
        appid = qs.get("AppId") or qs.get("appid")
        cc = qs.get("cc", "")
        lval = qs.get("l", "")  # may be absent

        cc_ok = (not cc) or (cc.upper() == "US") or (cc == "--")
        english_or_none = (not lval) or (lval.lower() == "english")

        if area == "game" and appid and cc_ok:
            return appid, True, english_or_none

        # Case-insensitive fallback
        low = {k.lower(): v for k, v in qs.items()}
        area2 = low.get("area", "").lower()
        appid2 = low.get("appid")
        cc2 = low.get("cc", "")
        lval2 = low.get("l", "")

        cc_ok2 = (not cc2) or (cc2.upper() == "US") or (cc2 == "--")
        english_or_none2 = (not lval2) or (lval2.lower() == "english")

        if area2 == "game" and appid2 and cc_ok2:
            return appid2, True, english_or_none2

        return "", False, False
    except Exception:
        return "", False, False


def main() -> int:
    sys.stderr.write(f"[{now_str()}] Fetching CDX JSON...\n")
    rows = fetch_json(CDX_URL)
    if not rows:
        sys.stderr.write(f"[{now_str()}] Empty CDX response.\n")
        return 2

    if rows and is_header_row(rows[0]):
        rows = rows[1:]

    # Build latest-by-appid map
    latest = {}  # appid -> (timestamp, original)
    total_scanned = 0
    total_matched = 0

    for row in rows:
        total_scanned += 1
        if not isinstance(row, list) or len(row) < 2:
            continue
        timestamp = str(row[0])
        original = str(row[1])

        appid, ok, english_or_none = extract_appid_and_ok(original)
        if not ok:
            continue
        total_matched += 1

        # Store as (pref_flag, timestamp, original), where pref_flag: 1 for English/none, 0 otherwise
        pref_flag = 1 if english_or_none else 0
        prev = latest.get(appid)

        if prev is None:
            latest[appid] = (pref_flag, timestamp, original)
        else:
            prev_pref, prev_ts, _ = prev
            # Prefer English/none over other languages; if equal, take latest timestamp
            if (pref_flag > prev_pref) or (pref_flag == prev_pref and timestamp > prev_ts):
                latest[appid] = (pref_flag, timestamp, original)


    if not latest:
        sys.stderr.write(f"[{now_str()}] No matching ?area=game&AppId=* entries after filtering.\n")
        return 1

    # Sort by AppId (numeric if possible)
    # Sort by AppId (numerics first, then non-numerics; case-insensitive)
    items = list(latest.items())  # [(appid, (ts, orig)), ...]

    def appid_key(item):
        k = str(item[0]).strip()
        if k.isdigit():
            return (0, int(k))      # group 0: numeric appids, sort by int
        return (1, k.lower())       # group 1: non-numeric, sort lexicographically

    items.sort(key=appid_key)

    # Write one line per AppId to file as full Wayback URL
    out_path = os.path.join(os.getcwd(), OUTPUT_FILE)
    sys.stderr.write(f"[{now_str()}] Writing {len(items)} lines to: {out_path}\n")
    try:
        with open(out_path, "w", encoding="latin-1", errors="replace") as f:
            for appid, (pref_flag, ts, orig) in items:
                wayback = "https://web.archive.org/web/{}id_/{}".format(ts, orig)
                f.write(wayback + "\n")
    except Exception as e:
        sys.stderr.write(f"[{now_str()}] Error writing output file: {e}\n")
        return 3

    sys.stderr.write(
        f"[{now_str()}] Done. Scanned={total_scanned}, matched={total_matched}, "
        f"unique_appids={len(items)}\n"
    )
    return 0


if __name__ == "__main__":
    sys.exit(main())
