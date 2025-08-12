#!/usr/bin/env python3
"""
Steam Platform Update History Scraper
Scrapes archived versions of Steam's platform update history from Archive.org
and generates an SQL file with deduplicated update entries.
Enhanced version that can process multiple URLs and check existing files for duplicates.
"""

import requests
import time
import re
import sqlite3
import hashlib
import os
from urllib.parse import urlparse, parse_qs
from bs4 import BeautifulSoup
from datetime import datetime
import threading
from queue import Queue
import logging

# Configure logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')
logger = logging.getLogger(__name__)

class SteamHistoryScraper:
    def __init__(self, max_connections=2):
        self.max_connections = max_connections
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
        })
        self.processed_hashes = set()  # To track duplicate content
        self.processed_dates_titles = set()  # Additional duplicate check by date+title
        self.existing_updates = {}  # Store existing updates from SQL files
        self.all_updates = []
        self.semaphore = threading.Semaphore(max_connections)

    def load_existing_sql_file(self, appid, filename=None):
        """Load existing updates from SQL file to prevent duplicates"""
        if filename is None:
            filename = f'steam_platform_updates_appid_{appid}.sql'

        if not os.path.exists(filename):
            logger.info(f"No existing SQL file found for App ID {appid}: {filename}")
            return set(), set()

        logger.info(f"Loading existing updates from: {filename}")

        existing_hashes = set()
        existing_date_titles = set()

        try:
            with open(filename, 'r', encoding='utf-8') as f:
                content = f.read()

                # Extract INSERT statements using regex
                insert_pattern = r"INSERT INTO `platform_update_history` \(`appid`, `date`, `title`, `content`\) VALUES\s*(.*?);"
                match = re.search(insert_pattern, content, re.DOTALL)

                if match:
                    values_section = match.group(1)

                    # Parse individual value tuples
                    # This is a simplified parser - in production you might want something more robust
                    tuple_pattern = r"\((\d+),\s*'([^']+)',\s*(NULL|'(?:[^'\\]|\\.)*'),\s*'((?:[^'\\]|\\.)*)'\)"

                    for tuple_match in re.finditer(tuple_pattern, values_section):
                        appid_val, date_val, title_val, content_val = tuple_match.groups()

                        # Unescape content
                        content_unescaped = content_val.replace("\\'", "'").replace('\\"', '"')

                        # Create hash from date and content (same logic as when creating)
                        content_hash = hashlib.md5(f"{date_val}_{content_unescaped}".encode()).hexdigest()
                        existing_hashes.add(content_hash)

                        # Handle title
                        if title_val == 'NULL':
                            title_clean = None
                        else:
                            # Remove quotes and unescape
                            title_clean = title_val[1:-1].replace("\\'", "'").replace('\\"', '"')

                        date_title_key = f"{date_val}_{title_clean or 'None'}"
                        existing_date_titles.add(date_title_key)

                logger.info(f"Loaded {len(existing_hashes)} existing updates from {filename}")

        except Exception as e:
            logger.error(f"Error loading existing file {filename}: {e}")
            return set(), set()

        return existing_hashes, existing_date_titles

    def discover_all_appids(self, base_url):
        """Discover all available app IDs from CDX API"""
        from urllib.parse import urlparse, parse_qs

        # Extract base URL without query parameters
        parsed_url = urlparse(base_url)
        base_url_clean = f"{parsed_url.scheme}://{parsed_url.netloc}{parsed_url.path}"

        cdx_url = f"https://web.archive.org/cdx/search/cdx"
        params = {
            'url': base_url_clean + '*',  # Use wildcard to get all variations
            'output': 'json',
            'fl': 'timestamp,original,statuscode,digest',
            'filter': '!statuscode:404'
        }

        try:
            response = self.session.get(cdx_url, params=params, timeout=30)
            response.raise_for_status()
            data = response.json()

            if len(data) <= 1:
                logger.warning("No snapshots found")
                return {}

            # Skip header row
            raw_snapshots = data[1:]
            logger.info(f"Found {len(raw_snapshots)} total snapshots")

            # Group snapshots by app ID
            appid_snapshots = {}
            seen_combinations = set()  # Track appid+digest combinations

            for snapshot in raw_snapshots:
                timestamp, original, statuscode, digest = snapshot

                # Only process successful responses with skin=0
                if statuscode != '200' or 'skin=0' not in original:
                    continue

                # Extract app ID from URL
                try:
                    parsed = urlparse(original)
                    params = parse_qs(parsed.query)
                    if 'id' in params:
                        appid = int(params['id'][0])

                        # Use appid+digest combination to avoid duplicates per app
                        combo_key = f"{appid}_{digest}"
                        if combo_key not in seen_combinations:
                            seen_combinations.add(combo_key)

                            if appid not in appid_snapshots:
                                appid_snapshots[appid] = []
                            appid_snapshots[appid].append((timestamp, original))

                except (ValueError, IndexError, KeyError):
                    continue

            # Sort app IDs and log what we found
            sorted_appids = sorted(appid_snapshots.keys())
            logger.info(f"Discovered {len(sorted_appids)} unique app IDs: {sorted_appids}")

            for appid in sorted_appids:
                logger.info(f"App ID {appid}: {len(appid_snapshots[appid])} unique snapshots")

            return appid_snapshots

        except Exception as e:
            logger.error(f"Error fetching CDX data: {e}")
            return {}

    def extract_appid_from_url(self, url):
        """Extract appid from URL parameters"""
        try:
            parsed = urlparse(url)
            params = parse_qs(parsed.query)
            return int(params.get('id', [0])[0])
        except:
            return 0

    def clean_steam_urls(self, content):
        """Remove everything before steam:// in URLs"""
        if not content:
            return content
        # Pattern to match URLs that contain steam://
        pattern = r'(https?://[^"]*)(steam://[^"]*)'
        return re.sub(pattern, r'\2', content)

    def parse_update_content(self, soup, appid):
        """Parse update content from the archived page"""
        updates = []
        content_div = soup.find('div', class_='content')

        if not content_div:
            logger.warning("No content div found")
            return updates

        # Try newer format first (post_header/post_content)
        post_headers = content_div.find_all('div', class_='post_header')

        if post_headers:
            logger.info(f"Found {len(post_headers)} posts in newer format")

            for header in post_headers:
                try:
                    # Extract date and title from post_date div
                    post_date_div = header.find('div', class_='post_date')
                    if not post_date_div:
                        continue

                    date_text = post_date_div.get_text().strip()

                    # Parse date and title - format: "September 9, 2008 - Steam Client Update Released"
                    if ' - ' in date_text:
                        date_part, title_part = date_text.split(' - ', 1)

                        # Remove "Current Release" if present
                        if title_part == "Current Release":
                            title = None
                        else:
                            # Remove <strong> tags and get clean title
                            title_strong = post_date_div.find('strong', class_='post_title')
                            if title_strong:
                                # Get clean text without any HTML tags
                                title = title_strong.get_text().strip()
                            else:
                                # Fallback: clean any HTML from title_part
                                from bs4 import BeautifulSoup
                                title = BeautifulSoup(title_part, 'html.parser').get_text().strip()
                    else:
                        date_part = date_text
                        title = None

                    # Parse the date
                    try:
                        date_obj = datetime.strptime(date_part.strip(), "%B %d, %Y")
                    except:
                        logger.warning(f"Could not parse date: {date_part}")
                        continue

                    # Find corresponding content div
                    onclick_attr = header.get('onclick', '')
                    post_id_match = re.search(r'togglePost\(\s*(\d+)\s*\)', onclick_attr)

                    if post_id_match:
                        post_id = post_id_match.group(1)
                        content_div_element = content_div.find('div', class_='post_content', id=f'content_{post_id}')

                        if content_div_element:
                            content_html = str(content_div_element)
                            # Clean steam URLs
                            content_html = self.clean_steam_urls(content_html)

                            # Create hash to check for duplicates based on date and content
                            content_hash = hashlib.md5(f"{date_obj.strftime('%Y-%m-%d')}_{content_html}".encode()).hexdigest()
                            date_title_key = f"{date_obj.strftime('%Y-%m-%d')}_{title or 'None'}"

                            if content_hash not in self.processed_hashes and date_title_key not in self.processed_dates_titles:
                                self.processed_hashes.add(content_hash)
                                self.processed_dates_titles.add(date_title_key)

                                update_entry = {
                                    'appid': appid,
                                    'date': date_obj.strftime('%Y-%m-%d'),
                                    'title': title,
                                    'content': content_html,
                                    'hash': content_hash
                                }
                                updates.append(update_entry)
                                logger.info(f"Added update: {date_obj.strftime('%Y-%m-%d')} - {title or 'No title'}")
                            else:
                                logger.info(f"Duplicate found, skipping: {date_obj.strftime('%Y-%m-%d')} - {title or 'No title'}")
                        else:
                            logger.warning(f"Could not find content div for post {post_id}")
                    else:
                        logger.warning(f"Could not extract post ID from onclick: {onclick_attr}")

                except Exception as e:
                    logger.error(f"Error parsing post header: {e}")
                    continue

        else:
            # Fall back to older format (linky spans)
            logger.info("Using older format parsing (linky spans)")
            linky_spans = content_div.find_all('span', class_='linky')

            if linky_spans:
                logger.info(f"Found {len(linky_spans)} spans in older format")

                for span in linky_spans:
                    try:
                        # Extract date from the span
                        onclick_attr = span.get('onclick', '')
                        date_match = re.search(r"showBranch\('([^']+)'\)", onclick_attr)

                        if not date_match:
                            # Try to get date from span text
                            span_text = span.get_text().strip()
                            date_match = re.search(r'(January|February|March|April|May|June|July|August|September|October|November|December)\s+\d+,\s+\d{4}', span_text)
                            if date_match:
                                date_str = date_match.group(0)
                            else:
                                continue
                        else:
                            date_str = date_match.group(1)

                        # Parse the date
                        try:
                            date_obj = datetime.strptime(date_str, "%B %d, %Y")
                        except:
                            logger.warning(f"Could not parse date: {date_str}")
                            continue

                        # Get title from span text, removing "Current Release" if present
                        title_text = span.get_text().strip()
                        if ' - ' in title_text:
                            title_part = title_text.split(' - ', 1)[1].strip()
                            if title_part == "Current Release":
                                title = None
                            else:
                                title = title_part
                        else:
                            title = None

                        # Find corresponding details div
                        details_div = content_div.find('div', id=date_str)
                        if details_div:
                            content_html = str(details_div)
                            # Clean steam URLs
                            content_html = self.clean_steam_urls(content_html)

                            # Create hash to check for duplicates
                            content_hash = hashlib.md5(f"{date_obj.strftime('%Y-%m-%d')}_{content_html}".encode()).hexdigest()

                            if content_hash not in self.processed_hashes:
                                self.processed_hashes.add(content_hash)

                                update_entry = {
                                    'appid': appid,
                                    'date': date_obj.strftime('%Y-%m-%d'),
                                    'title': title,
                                    'content': content_html,
                                    'hash': content_hash
                                }
                                updates.append(update_entry)
                                logger.info(f"Added update: {date_obj.strftime('%Y-%m-%d')} - {title or 'No title'}")
                            else:
                                logger.info(f"Duplicate found, skipping: {date_obj.strftime('%Y-%m-%d')}")

                    except Exception as e:
                        logger.error(f"Error parsing update entry: {e}")
                        continue
            else:
                logger.warning("No linky spans found in older format either")

        return updates

    def fetch_and_parse_snapshot(self, timestamp, original_url):
        """Fetch and parse a single snapshot"""
        with self.semaphore:  # Limit concurrent connections
            try:
                # Create the id_ URL
                wayback_url = f"https://web.archive.org/web/{timestamp}id_/{original_url}"

                logger.info(f"Fetching: {wayback_url}")
                response = self.session.get(wayback_url, timeout=30)
                response.raise_for_status()

                soup = BeautifulSoup(response.content, 'html.parser')
                appid = self.extract_appid_from_url(original_url)

                updates = self.parse_update_content(soup, appid)

                if updates:
                    logger.info(f"Extracted {len(updates)} updates from {timestamp}")
                    return updates
                else:
                    logger.warning(f"No updates found in {timestamp}")
                    return []

            except Exception as e:
                logger.error(f"Error processing snapshot {timestamp}: {e}")
                return []
            finally:
                time.sleep(1)  # Rate limiting

    def process_snapshots_threaded(self, snapshots):
        """Process snapshots using threading with connection limit"""
        results_queue = Queue()

        def worker(timestamp, original_url):
            updates = self.fetch_and_parse_snapshot(timestamp, original_url)
            results_queue.put(updates)

        threads = []
        for timestamp, original_url in snapshots:
            thread = threading.Thread(target=worker, args=(timestamp, original_url))
            threads.append(thread)
            thread.start()

        # Wait for all threads to complete
        for thread in threads:
            thread.join()

        # Collect results
        all_updates = []
        while not results_queue.empty():
            updates = results_queue.get()
            all_updates.extend(updates)

        return all_updates

    def generate_sql_file(self, updates, appid, filename=None, append_mode=False):
        """Generate MySQL/MariaDB compatible SQL file with INSERT statements"""
        if filename is None:
            filename = f'steam_platform_updates_appid_{appid}.sql'

        mode = 'a' if append_mode else 'w'

        with open(filename, mode, encoding='utf-8') as f:
            if not append_mode:
                # Write header and table creation only for new files
                f.write("-- Steam Platform Update History\n")
                f.write(f"-- App ID: {appid}\n")
                f.write("-- Generated on: {}\n".format(datetime.now().strftime('%Y-%m-%d %H:%M:%S')))
                f.write("-- MySQL/MariaDB Format\n\n")

                f.write("CREATE TABLE IF NOT EXISTS `platform_update_history` (\n")
                f.write("    `id` INT AUTO_INCREMENT PRIMARY KEY,\n")
                f.write("    `appid` INT NOT NULL,\n")
                f.write("    `date` DATE NOT NULL,\n")
                f.write("    `title` TEXT,\n")
                f.write("    `content` LONGTEXT NOT NULL,\n")
                f.write("    INDEX `idx_appid` (`appid`),\n")
                f.write("    INDEX `idx_date` (`date`)\n")
                f.write(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n")
            else:
                # For append mode, add a comment about the additional data
                f.write(f"\n-- Additional updates added on: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")

            # Sort updates by date (oldest first)
            sorted_updates = sorted(updates, key=lambda x: x['date'])

            if sorted_updates:
                f.write("INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES\n")

                for i, update in enumerate(sorted_updates):
                    if update['title']:
                        escaped_title = update['title'].replace("'", "\\'").replace('"', '\\"')
                        title_sql = f"'{escaped_title}'"
                    else:
                        title_sql = "NULL"

                    escaped_content = update['content'].replace("'", "\\'").replace('"', '\\"')

                    comma = "," if i < len(sorted_updates) - 1 else ";"
                    f.write(f"({update['appid']}, '{update['date']}', {title_sql}, '{escaped_content}'){comma}\n")

        action = "Appended to" if append_mode else "Generated"
        logger.info(f"{action} MySQL SQL file: {filename} with {len(updates)} updates")

    def process_single_url(self, base_url):
        """Process a single URL and return collected updates by app ID"""
        logger.info(f"Processing URL: {base_url}")

        # Discover all available app IDs for this URL
        appid_snapshots = self.discover_all_appids(base_url)
        if not appid_snapshots:
            logger.error(f"No app IDs found for URL: {base_url}")
            return {}

        all_app_updates = {}

        # Process each app ID separately
        for appid in sorted(appid_snapshots.keys()):
            logger.info(f"\n{'='*60}")
            logger.info(f"Processing App ID: {appid} from {base_url}")
            logger.info(f"{'='*60}")

            snapshots = appid_snapshots[appid]
            logger.info(f"Processing {len(snapshots)} snapshots for App ID {appid}")

            # Load existing updates for this app ID to prevent duplicates
            existing_hashes, existing_date_titles = self.load_existing_sql_file(appid)

            # Add existing data to our tracking sets
            self.processed_hashes.update(existing_hashes)
            self.processed_dates_titles.update(existing_date_titles)

            # Process snapshots in batches to respect connection limits
            batch_size = 10
            app_updates = []

            for i in range(0, len(snapshots), batch_size):
                batch = snapshots[i:i + batch_size]
                logger.info(f"Processing batch {i//batch_size + 1}/{(len(snapshots) + batch_size - 1)//batch_size} for App ID {appid}")

                batch_updates = self.process_snapshots_threaded(batch)
                app_updates.extend(batch_updates)

                # Brief pause between batches
                time.sleep(2)

            logger.info(f"App ID {appid}: Collected {len(app_updates)} new unique updates")
            all_app_updates[appid] = app_updates

        return all_app_updates

    def run(self, urls):
        """Main execution method - process multiple URLs"""
        if isinstance(urls, str):
            urls = [urls]

        logger.info("Starting Steam Update History Scraper")
        logger.info(f"Processing {len(urls)} URL(s)")

        total_updates_by_appid = {}

        # Process each URL
        for i, url in enumerate(urls):
            logger.info(f"\n{'='*80}")
            logger.info(f"PROCESSING URL {i+1}/{len(urls)}: {url}")
            logger.info(f"{'='*80}")

            # Reset tracking for each URL but preserve existing file data
            self.processed_hashes = set()
            self.processed_dates_titles = set()

            url_updates = self.process_single_url(url)

            # Merge updates by app ID
            for appid, updates in url_updates.items():
                if appid not in total_updates_by_appid:
                    total_updates_by_appid[appid] = []
                total_updates_by_appid[appid].extend(updates)

        # Generate or update SQL files
        total_updates_collected = 0
        for appid, updates in total_updates_by_appid.items():
            if updates:
                # Check if file exists to determine if we should append
                filename = f'steam_platform_updates_appid_{appid}.sql'
                file_exists = os.path.exists(filename)

                if file_exists:
                    logger.info(f"Appending {len(updates)} new updates to existing file for App ID {appid}")
                    self.generate_sql_file(updates, appid, filename, append_mode=True)
                else:
                    logger.info(f"Creating new file with {len(updates)} updates for App ID {appid}")
                    self.generate_sql_file(updates, appid, filename, append_mode=False)

                total_updates_collected += len(updates)
            else:
                logger.warning(f"No new updates were collected for App ID {appid}")

        logger.info(f"\n{'='*80}")
        logger.info(f"SCRAPING COMPLETED!")
        logger.info(f"Total URLs processed: {len(urls)}")
        logger.info(f"Total App IDs processed: {len(total_updates_by_appid)}")
        logger.info(f"Total new updates collected: {total_updates_collected}")
        logger.info(f"{'='*80}")

def main():
    """Main function"""
    import sys

    # Define URLs to process
    urls = [
        "https://storefront.steampowered.com/platform/update_history/index.php",
        # Add your second URL here:
        # "https://example.com/other/steam/history/url"
    ]

    # You can also add URLs via command line arguments
    if len(sys.argv) > 1:
        additional_urls = sys.argv[1:]
        urls.extend(additional_urls)
        logger.info(f"Added {len(additional_urls)} URLs from command line")

    logger.info("Steam Archive Grabber - Enhanced Multi-URL mode")
    logger.info("This will discover and process ALL app IDs found in the archives")
    logger.info("Existing SQL files will be checked to prevent duplicates")
    logger.info(f"URLs to process: {urls}")

    scraper = SteamHistoryScraper(max_connections=2)
    scraper.run(urls)

if __name__ == "__main__":
    main()