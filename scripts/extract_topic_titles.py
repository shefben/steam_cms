#!/usr/bin/env python3
"""
Extract Topic Titles from Archived Steam Forum Pages

This script extracts topic/thread titles from two sources:
1. Forum listing pages (forumid_*.php) - contain lists of threads with titles
2. Thread pages (thread_*.php, post_*.php) - contain title in <title> tag

Outputs SQL UPDATE statements to correct topic titles in phpbb_topics.
"""

import os
import re
import html
from pathlib import Path
from datetime import datetime
from typing import Dict, Set, Tuple

# Directory containing archived forum files
FORUMS_DIR = Path(r"F:\development\steam\emulator_v2\files\webroot\forums")
OUTPUT_DIR = Path(r"F:\development\steam\emulator_v2\files\webroot\2004_cms\scripts")

# Track all discovered topics
all_topics = {}  # topic_id -> {title, forum_id, starter, replies, views}


def escape_sql_string(s: str) -> str:
    """Escape a string for SQL insertion."""
    if not s:
        return ""
    s = s.replace('\\', '\\\\')
    s = s.replace("'", "\\'")
    s = s.replace('\n', ' ')
    s = s.replace('\r', '')
    return s.strip()


def clean_title(title: str) -> str:
    """Clean and normalize a topic title."""
    if not title:
        return ""
    # Decode HTML entities
    title = html.unescape(title)
    # Remove extra whitespace
    title = ' '.join(title.split())
    # Remove common prefixes that aren't part of the actual title
    title = re.sub(r'^(Read First!\s*)+', '', title, flags=re.IGNORECASE)
    return title.strip()


def extract_topics_from_forum_listing(html_content: str, forum_id: int) -> Dict[int, Dict]:
    """Extract all topic listings from a forum display page."""
    topics = {}

    # Pattern to match thread links: showthread.php?...&threadid=XXXX">TITLE</a>
    # Also capture thread starter from nearby member.php link

    # Split into thread rows using the template marker
    thread_blocks = re.split(r'<!-- BEGIN TEMPLATE: forumdisplaybit -->', html_content)

    for block in thread_blocks[1:]:  # Skip first block (before first thread)
        try:
            # Extract thread ID and title
            thread_match = re.search(
                r'showthread\.php\?[^"]*threadid=(\d+)[^"]*">([^<]+)</a>',
                block, re.IGNORECASE
            )
            if not thread_match:
                continue

            thread_id = int(thread_match.group(1))
            title = clean_title(thread_match.group(2))

            if not title or len(title) < 2:
                continue

            # Extract thread starter (username)
            starter_match = re.search(
                r'member\.php\?[^"]*action=getinfo[^"]*userid=(\d+)[^"]*">([^<]+)</a>',
                block, re.IGNORECASE
            )
            starter = clean_title(starter_match.group(2)) if starter_match else ""
            starter_id = int(starter_match.group(1)) if starter_match else 0

            # Extract reply count
            replies_match = re.search(r'javascript:who\(\d+\)">(\d+)</a>', block)
            replies = int(replies_match.group(1)) if replies_match else 0

            # Extract view count (number after replies)
            views_match = re.search(r'javascript:who\(\d+\)">\d+</a></font></td>\s*<td[^>]*><font[^>]*>(\d+)</font>', block)
            views = int(views_match.group(1)) if views_match else 0

            topics[thread_id] = {
                'title': title,
                'forum_id': forum_id,
                'starter': starter,
                'starter_id': starter_id,
                'replies': replies,
                'views': views,
                'source': 'forum_listing'
            }

        except Exception as e:
            continue

    return topics


def extract_title_from_thread_page(html_content: str) -> Tuple[str, int]:
    """Extract thread title and forum ID from a thread page."""
    title = ""
    forum_id = 0

    # Extract title from <title> tag
    title_match = re.search(r'<title>Steam Users Forums\s*-\s*(.+?)</title>', html_content, re.IGNORECASE)
    if title_match:
        title = clean_title(title_match.group(1))

    # Extract forum ID from breadcrumb
    forum_match = re.search(r'forumdisplay\.php[^"]*forumid=(\d+)', html_content, re.IGNORECASE)
    if forum_match:
        forum_id = int(forum_match.group(1))

    return title, forum_id


def extract_thread_id_from_filename(filename: str) -> int:
    """Extract thread ID from filename."""
    base = filename.replace('.php', '')
    if '_pagenumber_' in base:
        base = base.split('_pagenumber_')[0]

    match = re.search(r'(?:thread|post)_(\d+)', base)
    if match:
        return int(match.group(1))
    return 0


def extract_thread_id_from_url(html_content: str) -> int:
    """Extract thread ID from navigation URLs in the page."""
    match = re.search(r'threadid=(\d+)', html_content, re.IGNORECASE)
    if match:
        return int(match.group(1))
    return 0


def process_all_files():
    """Process all archived forum files to extract topic titles."""
    global all_topics

    print("="*70)
    print("Phase 1: Extracting topics from forum listing pages")
    print("="*70)

    # Process forum listing pages first - these have the most complete thread lists
    forum_files = list(FORUMS_DIR.glob('forumid_*.php'))
    print(f"Found {len(forum_files)} forum listing files")

    for filepath in forum_files:
        if 'notfound' in filepath.name.lower():
            continue
        try:
            # Extract forum ID from filename
            forum_id = int(filepath.stem.replace('forumid_', ''))

            with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
                content = f.read()

            topics = extract_topics_from_forum_listing(content, forum_id)

            # Merge with existing topics
            for tid, tdata in topics.items():
                if tid not in all_topics:
                    all_topics[tid] = tdata
                elif not all_topics[tid].get('title') and tdata.get('title'):
                    all_topics[tid]['title'] = tdata['title']

            if topics:
                print(f"  Forum {forum_id}: extracted {len(topics)} topic titles")

        except Exception as e:
            print(f"  Error processing {filepath.name}: {e}")

    print(f"\nTotal topics from forum listings: {len(all_topics)}")

    print("\n" + "="*70)
    print("Phase 2: Extracting topics from thread pages")
    print("="*70)

    # Process individual thread files
    thread_files = list(FORUMS_DIR.glob('thread_*.php')) + list(FORUMS_DIR.glob('post_*.php'))
    print(f"Found {len(thread_files)} thread files")

    new_from_threads = 0
    updated_from_threads = 0

    for idx, filepath in enumerate(thread_files, 1):
        if idx % 100 == 0:
            print(f"  Processing {idx}/{len(thread_files)}...")

        try:
            # Get thread ID from filename
            file_thread_id = extract_thread_id_from_filename(filepath.name)
            if file_thread_id == 0:
                continue

            with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
                content = f.read()

            # Get thread ID from URL (more reliable)
            url_thread_id = extract_thread_id_from_url(content)
            thread_id = url_thread_id if url_thread_id else file_thread_id

            # Extract title and forum ID
            title, forum_id = extract_title_from_thread_page(content)

            if not title:
                continue

            if thread_id not in all_topics:
                all_topics[thread_id] = {
                    'title': title,
                    'forum_id': forum_id,
                    'starter': '',
                    'starter_id': 0,
                    'replies': 0,
                    'views': 0,
                    'source': 'thread_page'
                }
                new_from_threads += 1
            elif not all_topics[thread_id].get('title'):
                all_topics[thread_id]['title'] = title
                updated_from_threads += 1

            # Update forum_id if we didn't have it
            if forum_id and not all_topics[thread_id].get('forum_id'):
                all_topics[thread_id]['forum_id'] = forum_id

        except Exception as e:
            continue

    print(f"\nNew topics from thread pages: {new_from_threads}")
    print(f"Updated topics from thread pages: {updated_from_threads}")
    print(f"\nTotal unique topics with titles: {len(all_topics)}")

    # Count topics with valid titles
    valid_titles = sum(1 for t in all_topics.values() if t.get('title'))
    print(f"Topics with valid titles: {valid_titles}")


def generate_sql_output():
    """Generate SQL statements to update topic titles."""

    output_path = OUTPUT_DIR / 'historical_forum_topic_titles.sql'

    print("\n" + "="*70)
    print("Generating SQL output")
    print("="*70)

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write("-- Historical Steam Forum Topic Titles\n")
        f.write(f"-- Generated: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")
        f.write(f"-- Contains {len(all_topics)} topic titles extracted from archived pages\n\n")

        f.write("SET FOREIGN_KEY_CHECKS = 0;\n\n")

        # Group by whether topic exists (update) or needs creation (insert)
        f.write("-- ========================================\n")
        f.write("-- Topic Title Updates\n")
        f.write("-- Updates existing topics with correct titles\n")
        f.write("-- ========================================\n\n")

        update_count = 0
        for topic_id, data in sorted(all_topics.items()):
            title = data.get('title', '')
            if not title:
                continue

            title_sql = escape_sql_string(title)
            forum_id = 1000 + (data.get('forum_id') or 1)

            f.write(f"UPDATE phpbb_topics SET topic_title = '[2004] {title_sql}' ")
            f.write(f"WHERE topic_id = {topic_id} AND is_historical = 1;\n")
            update_count += 1

        f.write(f"\n-- Total updates: {update_count}\n\n")

        # Also generate INSERT IGNORE statements for topics that might not exist
        f.write("-- ========================================\n")
        f.write("-- Topic Inserts (for missing topics)\n")
        f.write("-- Uses INSERT IGNORE to avoid duplicates\n")
        f.write("-- ========================================\n\n")

        f.write("INSERT IGNORE INTO phpbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_posts, topic_views, is_historical) VALUES\n")

        insert_rows = []
        for topic_id, data in sorted(all_topics.items()):
            title = data.get('title', '')
            if not title:
                continue

            title_sql = escape_sql_string(title)
            forum_id = 1000 + (data.get('forum_id') or 1)
            replies = data.get('replies', 0)
            views = data.get('views', 0)

            insert_rows.append(
                f"({topic_id}, {forum_id}, '[2004] {title_sql}', 100000, 1072936800, {replies + 1}, {views}, 1)"
            )

        f.write(',\n'.join(insert_rows))
        f.write(";\n\n")

        f.write("SET FOREIGN_KEY_CHECKS = 1;\n")

    print(f"Generated: {output_path}")
    print(f"Total topic updates: {update_count}")

    return output_path


def print_sample_topics():
    """Print sample of extracted topics for verification."""
    print("\n" + "="*70)
    print("Sample of extracted topics")
    print("="*70)

    count = 0
    for topic_id, data in sorted(all_topics.items()):
        if count >= 20:
            break
        if data.get('title'):
            print(f"  Topic {topic_id}: {data['title'][:60]}...")
            count += 1


if __name__ == '__main__':
    print("="*70)
    print("Steam Forum Topic Title Extractor")
    print("="*70)

    process_all_files()
    print_sample_topics()
    generate_sql_output()

    print("\nDone!")
