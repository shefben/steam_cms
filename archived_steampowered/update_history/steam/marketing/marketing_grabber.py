#!/usr/bin/env python3
"""
Steam Marketing Page Archiver
Downloads archived Steam marketing pages from Archive.org with all assets.
Processes only specific URL patterns and saves with proper directory structure.
Enhanced with proper rate limiting and 404 fallback handling.
"""

import requests
import time
import re
import os
import hashlib
from urllib.parse import urlparse, urljoin, parse_qs, unquote
from bs4 import BeautifulSoup
import logging
from pathlib import Path
import threading
from queue import Queue
import mimetypes
from collections import defaultdict

# Configure logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')
logger = logging.getLogger(__name__)

class RateLimitedSession:
    """Session wrapper that enforces Archive.org rate limits: max 7 requests per 9 seconds"""

    def __init__(self):
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': ('Mozilla/5.0 (Windows NT 10.0; Win64; x64) '
                           'AppleWebKit/537.36 (KHTML, like Gecko) '
                           'Chrome/91.0.4472.124 Safari/537.36')
        })
        self.request_times = []          # unix-timestamps of the last requests
        self.lock = threading.Lock()
        self.max_requests = 7
        self.interval = 9.0              # seconds

    def _wait_if_needed(self):
        """Ensure we don?t exceed 7 requests per rolling 9-second window"""
        with self.lock:
            now = time.time()
            # prune timestamps outside the current window
            self.request_times = [t for t in self.request_times
                                  if now - t < self.interval]

            if len(self.request_times) >= self.max_requests:
                sleep_for = self.interval - (now - self.request_times[0]) + 0.05
                logger.info(f"Rate limiting: waiting {sleep_for:.2f}s")
                time.sleep(max(sleep_for, 0))

            self.request_times.append(time.time())

    def get(self, url, **kwargs):
        self._wait_if_needed()
        return self.session.get(url, **kwargs)

class SteamMarketingArchiver:
    def __init__(self, download_dir="steam_marketing_archive"):
        self.download_dir = Path(download_dir)
        self.download_dir.mkdir(exist_ok=True)

        self.session = RateLimitedSession()
        self.downloaded_files = set()  # Track downloaded files to avoid duplicates
        self.asset_queue = Queue()

        # Store available timestamps for each URL for 404 fallback
        self.url_timestamps = defaultdict(list)

        # Common asset extensions to look for
        self.asset_extensions = {'.css', '.js', '.gif', '.jpg', '.jpeg', '.png', '.ico', '.swf', '.pdf'}

    # ??????????????????????????????????????????????????????????????
    def _wayback_variants(self, asset_url: str, timestamp: str):
        """
        Return a list of Wayback URLs to try ? primary plus alternate host.
        """
        primary = f"https://web.archive.org/web/{timestamp}id_/{asset_url}"
        parsed  = urlparse(asset_url)
        swap = {
            "www.steampowered.com":       "storefront.steampowered.com",
            "www.steampowered.com:80":    "storefront.steampowered.com",
            "storefront.steampowered.com": "www.steampowered.com",
        }
        urls = [primary]
        if parsed.netloc in swap:
            alt = parsed._replace(netloc=swap[parsed.netloc]).geturl()
            urls.append(f"https://web.archive.org/web/{timestamp}id_/{alt}")
        return urls

    def is_valid_url_pattern(self, url):
        """Check if URL matches the allowed patterns"""
        parsed = urlparse(url)
        path = parsed.path.lower()
        query = parsed.query.lower()

        # Must be one of the specified base domains
        if not (parsed.netloc.endswith('steampowered.com:80') or
                parsed.netloc.endswith('storefront.steampowered.com')):
            return False

        # Must start with /steam/marketing/
        if not path.startswith('/steam/marketing/'):
            return False

        # Check ending patterns
        valid_endings = [
            path.endswith('/'),
            path.endswith('/?') or (path.endswith('/') and query == ''),
            query == 'l=english' or query == 'i=english'
        ]

        if not any(valid_endings):
            return False

        # Reject if it has other language parameters
        if 'l=' in query and 'l=english' not in query:
            return False

        # Reject if it ends with image extensions
        for ext in ['.gif', '.jpg', '.png', '.jpeg']:
            if path.lower().endswith(ext):
                return False

        return True

    def get_directory_path(self, url):
        """Extract nested directory path from URL"""
        parsed = urlparse(url)
        path = parsed.path.strip('/')
        query = parsed.query

        # Remove the base /steam/marketing/ part
        if path.lower().startswith('steam/marketing/'):
            path = path[len('steam/marketing/'):]
        elif path.lower().startswith('steam/marketing'):
            path = path[len('steam/marketing'):]

        # If there's remaining path, use it as nested directory structure
        if path:
            # Remove any trailing slashes and clean up
            dir_path = path.rstrip('/')
            # Replace any problematic characters
            dir_path = re.sub(r'[<>:"|?*]', '_', dir_path)

            # For URLs like /message/1171/, create message/1171 structure
            parts = dir_path.split('/')
            return '/'.join(parts) if parts else 'marketing_root'
        else:
            # If no path, use 'root' or similar
            return 'marketing_root'

    def discover_marketing_pages(self, base_urls):
        """Discover all marketing pages from CDX API and store timestamps"""
        all_pages = {}

        for base_url in base_urls:
            logger.info(f"Discovering pages for: {base_url}")

            # Extract clean base URL and construct proper wildcard pattern
            parsed_url = urlparse(base_url)
            # Remove trailing slash and add wildcard
            clean_path = parsed_url.path.rstrip('/')
            base_url_pattern = f"{parsed_url.scheme}://{parsed_url.netloc}{clean_path}/*"

            logger.info(f"CDX search pattern: {base_url_pattern}")

            cdx_url = "https://web.archive.org/cdx/search/cdx"
            params = [
                ('url', base_url_pattern),
                ('output', 'json'),
                ('fl', 'timestamp,original,statuscode,mimetype,digest'),
                ('filter', 'statuscode:200'),
                ('filter', 'mimetype:text/html')
            ]

            try:
                response = self.session.get(cdx_url, params=params, timeout=30)
                response.raise_for_status()
                data = response.json()

                if len(data) <= 1:
                    logger.warning(f"No snapshots found for {base_url}")
                    continue

                # Skip header row
                snapshots = data[1:]
                logger.info(f"Found {len(snapshots)} HTML snapshots for {base_url}")

                # Filter and collect timestamps
                seen_urls = set()

                for snapshot in snapshots:
                    timestamp, original, statuscode, mimetype, digest = snapshot

                    # Store all timestamps for this URL (for 404 fallback)
                    self.url_timestamps[original].append(timestamp)

                    # Apply our filtering rules
                    if not self.is_valid_url_pattern(original):
                        continue

                    # Only keep one version of each unique URL (most recent)
                    if original not in seen_urls:
                        seen_urls.add(original)

                        dir_path = self.get_directory_path(original)

                        # Store the most recent timestamp for each URL
                        if dir_path not in all_pages or timestamp > all_pages[dir_path]['timestamp']:
                            all_pages[dir_path] = {
                                'timestamp': timestamp,
                                'original_url': original,
                                'wayback_url': f"https://web.archive.org/web/{timestamp}id_/{original}",
                                'all_timestamps': sorted(self.url_timestamps[original], reverse=True)
                            }

                # Sort timestamps for each URL for better fallback
                for url in self.url_timestamps:
                    self.url_timestamps[url] = sorted(self.url_timestamps[url], reverse=True)

                logger.info(f"After filtering: {len([k for k, v in all_pages.items() if base_url in v['original_url']])} unique pages from {base_url}")

            except Exception as e:
                logger.error(f"Error fetching CDX data for {base_url}: {e}")
                continue

        logger.info(f"Total unique marketing pages discovered: {len(all_pages)}")
        return all_pages

    def find_working_timestamp(self, url, preferred_timestamp=None):
        """Find a working timestamp for a URL, fallback if 404"""
        available_timestamps = self.url_timestamps.get(url, [])

        if not available_timestamps:
            # If we don't have timestamps, try to discover them
            logger.info(f"No cached timestamps for {url}, discovering...")
            cdx_url = "https://web.archive.org/cdx/search/cdx"
            params = [
                ('url', url),
                ('output', 'json'),
                ('fl', 'timestamp,statuscode'),
                ('filter', 'statuscode:200')
            ]

            try:
                response = self.session.get(cdx_url, params=params, timeout=30)
                response.raise_for_status()
                data = response.json()

                if len(data) > 1:
                    timestamps = [row[0] for row in data[1:]]  # Skip header
                    available_timestamps = sorted(timestamps, reverse=True)
                    self.url_timestamps[url] = available_timestamps

            except Exception as e:
                logger.warning(f"Could not discover timestamps for {url}: {e}")
                return None

        # Try preferred timestamp first if provided
        if preferred_timestamp and preferred_timestamp in available_timestamps:
            test_timestamps = [preferred_timestamp] + [t for t in available_timestamps if t != preferred_timestamp]
        else:
            test_timestamps = available_timestamps

        # Try each timestamp until we find one that works
        for timestamp in test_timestamps:
            wayback_url = f"https://web.archive.org/web/{timestamp}id_/{url}"
            try:
                response = self.session.get(wayback_url, timeout=30)
                if response.status_code == 200:
                    logger.info(f"Found working timestamp {timestamp} for {url}")
                    return timestamp, wayback_url
                else:
                    logger.debug(f"Timestamp {timestamp} returned {response.status_code} for {url}")
            except Exception as e:
                logger.debug(f"Error testing timestamp {timestamp} for {url}: {e}")
                continue

        logger.warning(f"No working timestamp found for {url}")
        return None, None

    def download_file(self, urls, local_path, is_asset=False, preferred_timestamp=None):
        """
        Download a file (asset or page).  `urls` may be a single string or
        a list of fallback URLs; the first that returns HTTP 200 wins.
        """
        if isinstance(urls, str):
            urls = [urls]

        if local_path.exists():
            logger.debug(f"File already exists, skipping: {local_path}")
            return True

        local_path.parent.mkdir(parents=True, exist_ok=True)

        for url in urls:
            try:
                logger.info(f"Downloading: {url}")
                response = self.session.get(url, timeout=30)
                if response.status_code == 404 and is_asset:
                    logger.debug("404 ? will try next variant (if any)")
                    continue
                response.raise_for_status()

                with open(local_path, "wb") as fh:
                    fh.write(response.content)
                logger.info(f"Saved: {local_path}")
                return True

            except Exception as e:
                logger.warning(f"Error downloading {url}: {e}")
                # fall through to next variant

        logger.error(f"All variants failed for {local_path}")
        return False


    def extract_asset_urls(self, content, base_url):
        """Extract all asset URLs from HTML/CSS content"""
        assets = set()

        # Parse HTML if it looks like HTML
        if content.strip().startswith('<'):
            try:
                soup = BeautifulSoup(content, 'html.parser')

                # Extract from various HTML elements
                selectors = [
                    ('img', 'src'),
                    ('link', 'href'),
                    ('script', 'src'),
                    ('embed', 'src'),
                    ('object', 'data'),
                    ('source', 'src'),
                    ('iframe', 'src'),
                    ('input', 'src'),  # Added input elements
                    ('video', 'src'),
                    ('audio', 'src'),
                    ('track', 'src')
                ]

                for tag_name, attr_name in selectors:
                    for tag in soup.find_all(tag_name):
                        url = tag.get(attr_name)
                        if url and url.strip() and not url.startswith(('javascript:', 'mailto:', 'tel:', '#')):
                            assets.add(url.strip())

                # Extract from <style> tags
                for style_tag in soup.find_all('style'):
                    if style_tag.string:
                        css_urls = self.extract_css_urls(style_tag.string)
                        assets.update(css_urls)

                # Extract from style attributes
                for element in soup.find_all(style=True):
                    style_content = element['style']
                    css_urls = self.extract_css_urls(style_content)
                    assets.update(css_urls)

                # Extract background images from elements with background CSS
                for element in soup.find_all():
                    style_attr = element.get('style', '')
                    if 'background' in style_attr.lower():
                        css_urls = self.extract_css_urls(style_attr)
                        assets.update(css_urls)

            except Exception as e:
                logger.warning(f"Error parsing HTML: {e}")

        # Extract from CSS (whether in HTML <style> tags or standalone CSS)
        css_urls = self.extract_css_urls(content)
        assets.update(css_urls)

        # Convert relative URLs to absolute and filter valid ones
        absolute_assets = set()
        for asset_url in assets:
            if asset_url and asset_url.strip():
                try:
                    # Skip data URLs, javascript, etc.
                    if asset_url.startswith(('data:', 'javascript:', 'mailto:', 'tel:', '#')):
                        continue

                    # Convert to absolute URL
                    absolute_url = urljoin(base_url, asset_url.strip())

                    # Only include URLs that look like assets
                    parsed = urlparse(absolute_url)
                    path_lower = parsed.path.lower()

                    # Check if it's likely an asset based on extension or common asset paths
                    is_asset = (
                        any(path_lower.endswith(ext) for ext in ['.css', '.js', '.gif', '.jpg', '.jpeg', '.png', '.ico', '.swf', '.pdf', '.woff', '.woff2', '.ttf', '.eot', '.svg']) or
                        '/css/' in path_lower or
                        '/js/' in path_lower or
                        '/images/' in path_lower or
                        '/img/' in path_lower or
                        '/assets/' in path_lower or
                        'stylesheet' in absolute_url.lower()
                    )

                    if is_asset:
                        absolute_assets.add(absolute_url)

                except Exception as e:
                    logger.debug(f"Could not process asset URL {asset_url}: {e}")
                    continue

        return absolute_assets

    def extract_css_urls(self, css_content):
        """Extract URLs from CSS content"""
        urls = set()

        if not css_content:
            return urls

        # Find url() declarations in CSS - more comprehensive regex
        patterns = [
            r'url\s*\(\s*["\']([^"\']+)["\']\s*\)',  # url("path") or url('path')
            r'url\s*\(\s*([^"\')\s]+)\s*\)',          # url(path) without quotes
            r'@import\s+["\']([^"\']+)["\']',         # @import "path"
            r'@import\s+url\s*\(\s*["\']?([^"\')\s]+)["\']?\s*\)'  # @import url(path)
        ]

        for pattern in patterns:
            matches = re.findall(pattern, css_content, re.IGNORECASE | re.MULTILINE)
            for match in matches:
                # Clean up the URL
                url = match.strip()
                if url and not url.startswith('data:') and not url.startswith('#'):
                    urls.add(url)

        return urls

    def make_paths_relative(self, content, base_dir, original_base_url, nested_depth=0):
        """Rewrite absolute Steam/Marketing URLs so they are relative to index.html"""
        if not content:
            return content

        parsed_base  = urlparse(original_base_url)
        base_domain  = f"{parsed_base.scheme}://{parsed_base.netloc}"
        path_prefix  = "../" * nested_depth if nested_depth > 0 else ""
        mk_root_len  = len("/steam/marketing/")   # slice-length helper (lower-case)

        patterns = [
            (r'((?:src|href|data|action)\s*=\s*["\'])([^"\']+)(["\'])',         "html"),
            (r'(url\s*\(\s*["\']?)([^"\')\s]+)(["\']?\s*\))',                   "css"),
            (r'(@import\s+["\'])([^"\']+)(["\'])',                              "css"),
            (r'(@import\s+url\s*\(\s*["\']?)([^"\')\s]+)(["\']?\s*\))',         "css")
        ]

        def _rewrite(url):
            """Return url rewritten to a relative path (or None if untouched)."""
            if url.startswith(("data:", "javascript:", "mailto:", "tel:", "#")):
                return None

            # absolutise first
            if url.startswith("//"):
                abs_url = parsed_base.scheme + ":" + url
            elif url.startswith("/"):
                abs_url = base_domain + url
            elif not url.startswith(("http://", "https://")):
                abs_url = urljoin(original_base_url, url)
            else:
                abs_url = url

            p          = urlparse(abs_url)
            if p.netloc != parsed_base.netloc:
                return None       # external resource, leave untouched

            path = p.path
            low  = path.lower()

            if low.startswith("/steam/marketing/"):
                rel = path[mk_root_len:] or "index.html"
            elif low.startswith("/steam/"):
                rel = path[len("/steam/"):]
                if nested_depth == 0 and not rel.startswith("./"):
                    rel = "./" + rel
            else:
                rel = path.lstrip("/")
                if nested_depth > 0:
                    rel = path_prefix + rel
                elif not rel.startswith("./") and ("css" in p.path):
                    rel = "./" + rel

            if p.query:
                rel += "?" + p.query
            if p.fragment:
                rel += "#" + p.fragment
            return rel

        for patt, _ in patterns:
            def repl(m):
                new = _rewrite(m.group(2))
                return m.group(1) + (new if new is not None else m.group(2)) + m.group(3)
            content = re.sub(patt, repl, content, flags=re.IGNORECASE)

        return content


    def download_page_with_assets(self, page_info, dir_path):
        """Download a single page and all its assets"""
        wayback_url  = page_info['wayback_url']
        original_url = page_info['original_url']
        timestamp    = page_info['timestamp']

        page_dir = self.download_dir / dir_path
        page_dir.mkdir(parents=True, exist_ok=True)
        index_path = self.download_dir / f"{dir_path}.html"

        if index_path.exists():
            logger.info(f"Page already exists, skipping: {index_path}")
            return

        logger.info(f"Processing page: {original_url} -> {dir_path}")

        try:
            nested_depth = len([p for p in dir_path.split("/") if p])

            response = self.session.get(wayback_url, timeout=30)
            if response.status_code == 404:
                logger.warning("404 on main page ? trying fallback timestamp")
                new_ts, new_url = self.find_working_timestamp(original_url, timestamp)
                if not new_url:
                    logger.error(f"No working timestamp for {original_url}")
                    return
                timestamp = new_ts
                response  = self.session.get(new_url, timeout=30)

            response.raise_for_status()
            html_content = response.text
            asset_urls   = self.extract_asset_urls(html_content, original_url)
            logger.info(f"Found {len(asset_urls)} potential assets for {dir_path}")

            downloaded_assets = []
            prefix = "steam/marketing/"

            # -------- primary asset loop -------------------------------------
            for asset_url in asset_urls:
                try:
                    asset_wayback_urls = self._wayback_variants(asset_url, timestamp)
                    parsed_asset = urlparse(asset_url)
                    asset_path   = parsed_asset.path.lstrip("/")

                    # trim /steam/marketing/  (case-insensitive)
                    if asset_path.lower().startswith(prefix):
                        asset_path = asset_path[len(prefix):]

                    # avoid repeating page dir
                    first = asset_path.split("/", 1)[0]
                    if first.lower() == dir_path.lower() and "/" in asset_path:
                        asset_path = asset_path.split("/", 1)[1]

                    local_asset_path = page_dir / asset_path
                    local_asset_path.parent.mkdir(parents=True, exist_ok=True)

                    if self.download_file(asset_wayback_urls, local_asset_path,
                                          is_asset=True, preferred_timestamp=timestamp):
                        downloaded_assets.append(asset_url)

                        # --- handle CSS ---------------------------------------
                        if local_asset_path.suffix.lower() == ".css":
                            with open(local_asset_path, "r", encoding="utf-8", errors="ignore") as fh:
                                css_content = fh.read()
                            css_assets = self.extract_asset_urls(css_content, asset_url)
                            logger.info(f"Found {len(css_assets)} assets in {local_asset_path}")

                            for css_asset_url in css_assets:
                                css_urls  = self._wayback_variants(css_asset_url, timestamp)
                                parsed_ca = urlparse(css_asset_url)
                                css_path  = parsed_ca.path.lstrip("/")

                                if css_path.lower().startswith(prefix):
                                    css_path = css_path[len(prefix):]

                                first = css_path.split("/", 1)[0]
                                if first.lower() == dir_path.lower() and "/" in css_path:
                                    css_path = css_path.split("/", 1)[1]

                                local_css_path = page_dir / css_path
                                local_css_path.parent.mkdir(parents=True, exist_ok=True)

                                self.download_file(css_urls, local_css_path,
                                                   is_asset=True, preferred_timestamp=timestamp)

                            # rewrite URLs inside the CSS
                            updated = self.make_paths_relative(css_content,
                                                               local_asset_path.parent,
                                                               asset_url,
                                                               nested_depth)
                            with open(local_asset_path, "w", encoding="utf-8") as fh:
                                fh.write(updated)

                except Exception as e:
                    logger.warning(f"Error downloading asset {asset_url}: {e}")

            modified_html = self.make_paths_relative(html_content, page_dir,
                                                     original_url, nested_depth)

            with open(index_path, "w", encoding="utf-8") as fh:
                fh.write(modified_html)

            logger.info(f"Saved page: {index_path}")
            logger.info(f"Downloaded {len(downloaded_assets)} assets for {dir_path}")

        except Exception as e:
            logger.error(f"Error processing page {original_url}: {e}")


    def collect_missing_assets(self, pages):
        """Return a set of asset URLs that were referenced but not downloaded"""
        missing = set()
        prefix  = "steam/marketing/"

        logger.info("Scanning for missing assets ?")

        for dir_path, page_info in pages.items():
            page_dir   = self.download_dir / dir_path
            index_path = page_dir / "index.html"
            if not index_path.exists():
                continue

            try:
                with open(index_path, "r", encoding="utf-8", errors="ignore") as fh:
                    html = fh.read()

                asset_urls = self.extract_asset_urls(html, page_info["original_url"])

                # check HTML-referenced assets
                for url in asset_urls:
                    p   = urlparse(url)
                    ap  = p.path.lstrip("/")
                    if ap.lower().startswith(prefix):
                        ap = ap[len(prefix):]
                    elif ap.lower().startswith("steam/"):
                        ap = ap[len("steam/"):]
                    loc = self.download_dir / ap
                    if not loc.exists():
                        missing.add(url)

                # check inside every CSS that?s already on disk
                css_files = list(page_dir.rglob("*.css")) + list(self.download_dir.rglob("*.css"))
                for css_file in css_files:
                    try:
                        with open(css_file, "r", encoding="utf-8", errors="ignore") as fh:
                            css = fh.read()
                        for url in self.extract_asset_urls(css, page_info["original_url"]):
                            p  = urlparse(url)
                            ap = p.path.lstrip("/")
                            if ap.lower().startswith(prefix):
                                ap = ap[len(prefix):]
                            elif ap.lower().startswith("steam/"):
                                ap = ap[len("steam/"):]
                            loc = self.download_dir / ap
                            if not loc.exists():
                                missing.add(url)
                    except Exception as e:
                        logger.warning(f"Error scanning {css_file}: {e}")

            except Exception as e:
                logger.warning(f"Error scanning {index_path}: {e}")

        logger.info(f"Found {len(missing)} missing assets")
        return missing


    def try_alternative_domains(self, asset_url, timestamp, base_urls):
        """Try downloading an asset from alternative domains"""
        parsed_asset = urlparse(asset_url)

        # Create list of alternative URLs to try
        alternative_urls = []

        for base_url in base_urls:
            parsed_base = urlparse(base_url)
            alternative_domain = parsed_base.netloc

            # Skip if it's the same domain as the original asset
            if alternative_domain == parsed_asset.netloc:
                continue

            # Create alternative URL with different domain
            alt_url = f"{parsed_base.scheme}://{alternative_domain}{parsed_asset.path}"
            if parsed_asset.query:
                alt_url += '?' + parsed_asset.query

            alternative_urls.append(alt_url)

        # Try each alternative URL
        for alt_url in alternative_urls:
            try:
                alt_wayback_url = f"https://web.archive.org/web/{timestamp}id_/{alt_url}"
                logger.info(f"Trying alternative URL: {alt_wayback_url}")

                response = self.session.get(alt_wayback_url, timeout=30)
                if response.status_code == 200:
                    return alt_wayback_url, response.content
                elif response.status_code == 404:
                    # Try finding a working timestamp for this alternative URL
                    alt_timestamp, alt_working_url = self.find_working_timestamp(alt_url, timestamp)
                    if alt_working_url:
                        logger.info(f"Found working alternative: {alt_working_url}")
                        response = self.session.get(alt_working_url, timeout=30)
                        if response.status_code == 200:
                            return alt_working_url, response.content

            except Exception as e:
                logger.debug(f"Alternative URL {alt_url} failed: {e}")
                continue

        return None, None

    def fill_missing_assets(self, missing_assets, pages, base_urls):
        """Attempt to download missing assets from alt domains / timestamps"""
        logger.info(f"Attempting to fill {len(missing_assets)} missing assets ?")
        filled = 0
        prefix = "steam/marketing/"

        # pick the newest page timestamp as best guess
        best_ts = max(p["timestamp"] for p in pages.values())

        for asset_url in missing_assets:
            try:
                p  = urlparse(asset_url)
                ap = p.path.lstrip("/")
                if ap.lower().startswith(prefix):
                    ap = ap[len(prefix):]
                elif ap.lower().startswith("steam/"):
                    ap = ap[len("steam/"):]
                local_path = self.download_dir / ap
                if local_path.exists():
                    continue

                local_path.parent.mkdir(parents=True, exist_ok=True)

                # 1- try variants of the original domain
                urls = self._wayback_variants(asset_url, best_ts)
                if self.download_file(urls, local_path, is_asset=True,
                                      preferred_timestamp=best_ts):
                    filled += 1
                    continue

                # 2- try alternate domains
                alt_url, alt_content = self.try_alternative_domains(asset_url, best_ts, base_urls)
                if alt_url and alt_content:
                    with open(local_path, "wb") as fh:
                        fh.write(alt_content)
                    logger.info(f"Filled from alt domain: {local_path}")
                    filled += 1
                else:
                    logger.warning(f"Still missing: {asset_url}")

            except Exception as e:
                logger.error(f"Error filling {asset_url}: {e}")

        logger.info(f"Successfully filled {filled} missing assets")
        return filled


    def run(self, base_urls):
        """Main execution method"""
        logger.info("Starting Steam Marketing Page Archiver")
        logger.info(f"Target URLs: {base_urls}")
        logger.info(f"Download directory: {self.download_dir}")
        logger.info("Rate limiting: max 5 requests per 8 seconds")

        # Discover all marketing pages
        pages = self.discover_marketing_pages(base_urls)

        if not pages:
            logger.error("No valid pages found")
            return

        logger.info(f"Found {len(pages)} unique pages to download")

        # Phase 1: Download each page with its assets
        logger.info(f"\n{'='*60}")
        logger.info("PHASE 1: DOWNLOADING PAGES AND ASSETS")
        logger.info(f"{'='*60}")

        for i, (dir_path, page_info) in enumerate(pages.items(), 1):
            logger.info(f"\n{'='*50}")
            logger.info(f"Processing page {i}/{len(pages)}: {dir_path}")
            logger.info(f"{'='*50}")

            self.download_page_with_assets(page_info, dir_path)

        # Phase 2: Fill in missing assets using alternative URLs
        logger.info(f"\n{'='*60}")
        logger.info("PHASE 2: FILLING MISSING ASSETS")
        logger.info(f"{'='*60}")

        # Collect all missing assets
        missing_assets = self.collect_missing_assets(pages)

        if missing_assets:
            # Attempt to fill missing assets
            filled_count = self.fill_missing_assets(missing_assets, pages, base_urls)

            logger.info(f"\n{'='*60}")
            logger.info("ARCHIVING COMPLETED!")
            logger.info(f"Downloaded {len(pages)} pages to {self.download_dir}")
            logger.info(f"Filled {filled_count} missing assets from alternative sources")
            logger.info(f"{'='*60}")
        else:
            logger.info(f"\n{'='*60}")
            logger.info("ARCHIVING COMPLETED!")
            logger.info(f"Downloaded {len(pages)} pages to {self.download_dir}")
            logger.info("No missing assets found - all downloads successful!")
            logger.info(f"{'='*60}")

def main():
    """Main function"""
    base_urls = [
        "http://www.steampowered.com:80/steam/marketing/",
        "http://storefront.steampowered.com/steam/marketing/"
    ]

    logger.info("Steam Marketing Page Archiver")
    logger.info("Downloads archived Steam marketing pages with all assets")
    logger.info("Enhanced with proper rate limiting and 404 fallback")

    archiver = SteamMarketingArchiver()
    archiver.run(base_urls)

if __name__ == "__main__":
    main()