#!/usr/bin/env python
# -*- coding: latin-1 -*-

"""
Fetch CDX JSON for Steam storefront /app/* (2009), pick the LATEST good snapshot per AppID,
and append ONE Wayback URL per AppID that is not already present in the output file.

Constraints:
- Time window: 2009-01-01 .. 2009-12-31
- status=200, mimetype=text/html, collapse=original, fastLatest=true
- If 'cc' query param is present it MUST be 'US'
- If 'l' query param is present it MUST be 'English'
- De-duplicate by AppID; ignore cosmetic URL differences

I/O:
- Output file: wayback_appids_2009.txt (latin-1), APPEND mode if exists
- Log timestamps: "%m/%d/%Y %H:%M:%S"
"""

import sys
import os
import json
import datetime
import time
import re
from urllib.parse import urlparse, parse_qsl, urlunparse, urlencode
from urllib.request import urlopen, Request
from urllib.error import URLError, HTTPError

# ---------- CONFIG ----------
BASE_CDX = (
    "https://web.archive.org/cdx/search/cdx"
    "?url=store.steampowered.com/sub/"
    "&matchType=prefix"
    "&from=20080801"
    "&to=20091231"
    "&output=json"
    "&fl=timestamp,original,statuscode,mimetype,digest"
    "&filter=statuscode:200"
    "&filter=mimetype:text/html"
    "&collapse=digest"
    "&fastLatest=true"
)
PAGE_SIZE = 354
OUTPUT_FILE = "wayback_subids_2009.txt"
EXPECTED_FIELDS = ["timestamp", "original", "statuscode", "mimetype", "digest"]

# polite throttle (archive.org is sensitive)
MIN_DELAY = 2  # adjust if needed

def now_str() -> str:
    return datetime.datetime.utcnow().strftime("%m/%d/%Y %H:%M:%S")

def fetch_json(url: str, retries: int = 4, backoff: float = 1.5) -> list:
    headers = {
        "User-Agent": "CDXFetcher/2.1 (+no-js; html-only; contact: script-user)",
        "Accept": "application/json",
    }
    err = None
    for i in range(retries + 1):
        req = Request(url, headers=headers)
        try:
            with urlopen(req, timeout=60) as resp:
                raw = resp.read().decode("latin-1", errors="replace")
            time.sleep(MIN_DELAY)
            return json.loads(raw)
        except (HTTPError, URLError, json.JSONDecodeError) as e:
            err = e
            if i < retries:
                time.sleep(backoff ** (i + 1))
                continue
            break
        except Exception as e:
            err = e
            break
    sys.stderr.write(f"[{now_str()}] ERROR fetching {url}: {err}\n")
    return []

def is_header_row(row) -> bool:
    if not isinstance(row, list):
        return False
    return [str(x).lower() for x in row] == EXPECTED_FIELDS

def extract_appid_from_path(original_url: str) -> str:
    """
    Accepts:
      http://store.steampowered.com/app/10/
      http://store.steampowered.com:80/app/10/?cc=US&l=English
      http://store.steampowered.com//app//10//
    Returns "10" or "" if not matched.
    """
    try:
        p = urlparse(original_url)
        segs = [s for s in p.path.split("/") if s]
        if len(segs) >= 2 and segs[0].lower() == "sub":
            appid = segs[1]
            if appid.isdigit():
                return appid
    except Exception:
        pass
    return ""

# Parse an existing output line like:
#   https://web.archive.org/web/20090122023940id_/http://store.steampowered.com:80/app/10/
# and recover appid=10
_wb_appid_re = re.compile(r'/sub/(\d+)(?:/|$)')

def extract_appid_from_output_line(line: str) -> str:
    try:
        line = line.strip()
        if not line:
            return ""
        # Wayback format: /web/{ts}id_/{original}
        # Split on '/web/<ts>id_/' to get the original URL
        parts = line.split("id_/", 1)
        target = parts[1] if len(parts) == 2 else line
        m = _wb_appid_re.search(target)
        if m:
            return m.group(1)
    except Exception:
        pass
    return ""

def load_existing_appids(path: str) -> set:
    appids = set()
    if not os.path.isfile(path):
        return appids
    try:
        with open(path, "r", encoding="latin-1", errors="replace") as f:
            for ln in f:
                a = extract_appid_from_output_line(ln)
                if a:
                    appids.add(a)
    except Exception as e:
        sys.stderr.write(f"[{now_str()}] WARNING: failed reading existing file '{path}': {e}\n")
    return appids

def passes_locale_filters(original_url: str) -> bool:
    """
    If cc= present, it MUST be US.
    If l= present, it MUST be English.
    """
    try:
        p = urlparse(original_url)
        qs = dict(parse_qsl(p.query, keep_blank_values=True))
        if "cc" in qs and (qs.get("cc", "") or "").upper() != "US":
            return False
        if "l" in qs and (qs.get("l", "") or "").lower() != "english":
            return False
        return True
    except Exception:
        return False

def normalize_original_url(original_url: str) -> str:
    """
    Normalize for output:
      - collapse duplicate slashes in path
      - strip trailing '?' if query empty
      - keep provided query params (already locale-filtered)
    """
    try:
        p = urlparse(original_url)
        path = "/" + "/".join([s for s in p.path.split("/") if s])
        params = [(k, v) for (k, v) in parse_qsl(p.query, keep_blank_values=False)]
        q = urlencode(params, doseq=True)
        new = urlunparse((p.scheme, p.netloc, path, p.params, q, p.fragment))
        if new.endswith("?"):
            new = new[:-1]
        return new
    except Exception:
        return original_url.rstrip("&?")

def main() -> int:
    sys.stderr.write(f"[{now_str()}] Starting CDX crawl (2009, /app/*)?\n")

    # Load appids we already wrote earlier (append mode behavior)
    existing = load_existing_appids(OUTPUT_FILE)
    sys.stderr.write(f"[{now_str()}] Existing appids found in file: {len(existing)}\n")

    # Track only new (not-yet-in-file) latest picks
    latest_by_appid = {}  # appid -> (timestamp, original)

    page = 1
    total_rows = 0
    updated_new_appids = 0

    while True:
        url = f"{BASE_CDX}&page={page}&pageSize={PAGE_SIZE}"
        rows = fetch_json(url)
        if not rows:
            sys.stderr.write(f"[{now_str()}] Page {page}: no data (stop).\n")
            break
        if is_header_row(rows[0]):
            rows = rows[1:]
        if not rows:
            sys.stderr.write(f"[{now_str()}] Page {page}: empty rows (stop).\n")
            break

        page_kept = 0
        for row in rows:
            total_rows += 1
            if not isinstance(row, list) or len(row) < 2:
                continue
            ts = str(row[0])
            original = str(row[1])

            appid = extract_appid_from_path(original)
            if not appid:
                continue

            # Skip appids we already have in the output file
            if appid in existing:
                continue

            if not passes_locale_filters(original):
                continue

            prev = latest_by_appid.get(appid)
            if (prev is None) or (ts > prev[0]):
                latest_by_appid[appid] = (ts, original)
                page_kept += 1

        updated_new_appids += page_kept
        sys.stderr.write(f"[{now_str()}] Page {page}: scanned={len(rows)}, new_appids_updated~={page_kept}\n")
        page += 1

    if not latest_by_appid:
        sys.stderr.write(f"[{now_str()}] No NEW appids to append after filtering.\n")
        return 0  # not an error; just nothing to do

    # Sort new items by appid (numeric first)
    items = list(latest_by_appid.items())
    def appid_key(item):
        a = item[0]
        return (0, int(a)) if a.isdigit() else (1, a.lower())
    items.sort(key=appid_key)

    out_path = os.path.join(os.getcwd(), OUTPUT_FILE)
    mode = "a" if os.path.isfile(out_path) else "w"
    sys.stderr.write(f"[{now_str()}] Appending {len(items)} new lines to {out_path}\n")

    with open(out_path, mode, encoding="latin-1", errors="replace") as f:
        for appid, (ts, orig) in items:
            canon = normalize_original_url(orig)
            wayback = f"https://web.archive.org/web/{ts}id_/{canon}"
            f.write(wayback + "\n")

    sys.stderr.write(
        f"[{now_str()}] Done. pages_processed={page}, total_rows={total_rows}, "
        f"existing_appids={len(existing)}, new_appids_written={len(items)}\n"
    )
    return 0

if __name__ == "__main__":
    sys.exit(main())
