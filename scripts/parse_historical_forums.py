#!/usr/bin/env python3
"""
Parse Historical Steam Forum Archives
Extracts real post content, subjects, and forum descriptions from archived vBulletin HTML files.
Generates SQL to populate phpBB historical forum tables.

Handles:
- Thread pages (including multi-page threads with _pagenumber_ suffix)
- Quote/blockquote conversion to phpBB [quote] BBCode
- Announcement parsing (vBulletin announcebit templates)
- Attachment references
- Avatar/user data extraction
"""

import os
import re
import html
import json
from pathlib import Path
from typing import Dict, List, Tuple, Optional
from datetime import datetime
import time

# Directory containing archived forum files
FORUMS_DIR = Path(r"F:\development\steam\emulator_bot\stmsite-billysb\sites\2004\forums")
OUTPUT_DIR = Path(r"F:\development\steam\emulator_v2\files\webroot\2004_cms\scripts")

# Historical ID offsets
FORUM_ID_OFFSET = 1000    # Forum IDs: 1001, 1002, etc.
USER_ID_OFFSET = 100000   # User IDs: 100001, 100002, etc.
ANNOUNCEMENT_TOPIC_ID_OFFSET = 900000  # Announcement topic IDs start here
ANNOUNCEMENT_POST_ID_OFFSET = 9000000  # Announcement post IDs start here

# Track unique users for user table generation
all_users = {}  # username -> user_id


def get_or_create_user_id(username: str) -> int:
    """Get or create a historical user ID for a username."""
    if not username:
        username = "Anonymous"

    # Normalize username
    username = username.strip()

    if username not in all_users:
        all_users[username] = USER_ID_OFFSET + len(all_users) + 1

    return all_users[username]


def escape_sql_string(s: str) -> str:
    """Escape a string for SQL insertion."""
    if not s:
        return ""
    # Escape backslashes first, then single quotes
    s = s.replace('\\', '\\\\')
    s = s.replace("'", "\\'")
    s = s.replace('\n', '\\n')
    s = s.replace('\r', '')
    # Truncate extremely long content
    if len(s) > 60000:
        s = s[:60000] + '...[truncated]'
    return s


def extract_thread_title(html_content: str) -> str:
    """Extract thread title from HTML."""
    match = re.search(r'<title>Steam Users Forums\s*-\s*(.+?)</title>', html_content, re.IGNORECASE)
    if match:
        return html.unescape(match.group(1).strip())
    return ""


def extract_forum_id_from_thread(html_content: str) -> int:
    """Extract forum ID from thread page.

    Uses the newthread.php link (most reliable - always points to the correct forum),
    then falls back to the LAST forumdisplay.php link in the breadcrumb
    (the last one is the actual forum, earlier ones are parent categories).
    """
    # Best source: newthread.php link always has the correct forumid
    newthread_match = re.search(r'newthread\.php[^"]*forumid=(\d+)', html_content, re.IGNORECASE)
    if newthread_match:
        return int(newthread_match.group(1))

    # Fallback: newreply.php link also has forumid sometimes
    newreply_match = re.search(r'newreply\.php[^"]*forumid=(\d+)', html_content, re.IGNORECASE)
    if newreply_match:
        return int(newreply_match.group(1))

    # Fallback: get the LAST forumdisplay.php forumid in the breadcrumb
    # (first ones are parent categories, last is the actual forum)
    matches = re.findall(r'forumdisplay\.php[^"]*forumid=(\d+)', html_content, re.IGNORECASE)
    if matches:
        return int(matches[-1])

    return 0


def extract_thread_id_from_url(html_content: str) -> int:
    """Extract thread ID from navigation URLs."""
    match = re.search(r'threadid=(\d+)', html_content, re.IGNORECASE)
    if match:
        return int(match.group(1))
    return 0


def extract_thread_id_from_filename(filename: str) -> Tuple[int, int]:
    """Extract thread ID and page number from filename.

    For thread_XXXX files, the number IS the thread ID.
    For post_XXXX files, the number is a POST ID (not thread ID) -
    the actual thread ID must be extracted from the file content via extract_thread_id_from_url().
    Returns (id_from_filename, page_number).
    """
    # Strip extension (.php or .html)
    base = re.sub(r'\.(php|html?)$', '', filename)
    page = 1

    if '_pagenumber_' in base:
        parts = base.split('_pagenumber_')
        base = parts[0]
        page = int(parts[1])

    # Extract ID from thread_XXXX or post_XXXX
    match = re.search(r'(?:thread|post)_(\d+)', base)
    if match:
        return int(match.group(1)), page
    return 0, page


def parse_vb_date(date_str: str) -> int:
    """Parse vBulletin date format to Unix timestamp."""
    # Format: "06-09-2003 08:26 PM" or similar
    try:
        # Try different formats
        for fmt in ['%m-%d-%Y %I:%M %p', '%d-%m-%Y %I:%M %p', '%Y-%m-%d %H:%M']:
            try:
                dt = datetime.strptime(date_str.strip(), fmt)
                return int(dt.timestamp())
            except ValueError:
                continue
    except:
        pass
    # Default to 2004 timestamp
    return 1072936800  # Jan 1, 2004


def parse_vb_date_range(date_str: str) -> int:
    """Parse vBulletin announcement date range, return start date as timestamp."""
    # Format: "(08-06-2004 until 09-06-2004)"
    match = re.search(r'(\d{2}-\d{2}-\d{4})', date_str)
    if match:
        return parse_vb_date(match.group(1) + ' 12:00 AM')
    return 1072936800


def convert_quotes_to_bbcode(content: str) -> str:
    """Convert vBulletin blockquote HTML to phpBB [quote] BBCode.

    Source format:
    <blockquote><font...><font size="1">quote:</font><hr>
    <i>Originally posted by USERNAME </i><br />
    <b>QUOTED CONTENT</b><hr></font></blockquote>

    Target format:
    [quote="USERNAME"]QUOTED CONTENT[/quote]
    """
    # Process blockquotes from innermost to outermost
    # We loop until no more blockquotes are found (handles nesting)
    max_iterations = 10
    iteration = 0

    while '<blockquote>' in content.lower() and iteration < max_iterations:
        iteration += 1

        # Find innermost blockquote (one that doesn't contain another blockquote)
        # Use re.DOTALL so . matches newlines
        pattern = re.compile(
            r'<blockquote>((?:(?!<blockquote>).)*?)</blockquote>',
            re.IGNORECASE | re.DOTALL
        )

        match = pattern.search(content)
        if not match:
            break

        block_content = match.group(1)

        # Extract username from "Originally posted by USERNAME"
        username = ""
        username_match = re.search(
            r'Originally posted by\s+(.+?)\s*</i>',
            block_content, re.IGNORECASE | re.DOTALL
        )
        if username_match:
            username = html.unescape(username_match.group(1).strip())

        # Extract the actual quoted content
        # It's between the <hr> tags, after the "Originally posted by" line
        # Structure: ...quote:...<hr><i>Originally posted by X</i><br />CONTENT<hr>...
        quoted_text = block_content

        # Remove the "quote:" label and surrounding font tags
        quoted_text = re.sub(
            r'<font[^>]*>\s*quote:\s*</font>',
            '', quoted_text, flags=re.IGNORECASE
        )

        # Remove "Originally posted by USERNAME" line
        quoted_text = re.sub(
            r'<i>\s*Originally posted by\s+.*?</i>\s*(?:<br\s*/?>)?',
            '', quoted_text, flags=re.IGNORECASE | re.DOTALL
        )

        # Remove <hr> tags
        quoted_text = re.sub(r'<hr\s*/?>', '', quoted_text, flags=re.IGNORECASE)

        # Remove surrounding font tags
        quoted_text = re.sub(r'</?font[^>]*>', '', quoted_text, flags=re.IGNORECASE)

        # Convert <br> to newlines
        quoted_text = re.sub(r'<br\s*/?>', '\n', quoted_text, flags=re.IGNORECASE)

        # Remove bold/italic wrapper tags but keep content
        quoted_text = re.sub(r'</?[bi]>', '', quoted_text, flags=re.IGNORECASE)

        # Strip remaining HTML tags from quoted content
        quoted_text = re.sub(r'<[^>]+>', '', quoted_text)

        # Clean up whitespace
        quoted_text = html.unescape(quoted_text).strip()

        # Build the BBCode replacement
        if username:
            bbcode = f'[quote="{username}"]{quoted_text}[/quote]'
        else:
            bbcode = f'[quote]{quoted_text}[/quote]'

        # Replace the blockquote in the original content
        content = content[:match.start()] + bbcode + content[match.end():]

    return content


def extract_posts_from_html(html_content: str) -> List[Dict]:
    """Extract all posts from an HTML thread page."""
    posts = []

    # Split by post anchors
    post_blocks = re.split(r'<a name="post(\d+)"></a>', html_content)

    for i in range(1, len(post_blocks), 2):
        try:
            post_id = int(post_blocks[i])
            block = post_blocks[i + 1] if i + 1 < len(post_blocks) else ""

            # Extract author
            author_match = re.search(
                r'<font[^>]*face="verdana[^"]*"[^>]*size="2"[^>]*>\s*<b>([^<]+)</b></font>',
                block, re.IGNORECASE
            )
            author = html.unescape(author_match.group(1).strip()) if author_match else ""

            # Extract subject (usually in first post with icon)
            subject_match = re.search(
                r'<font[^>]*size="1"[^>]*>.*?<b>([^<]+)</b></font>\s*<p>',
                block, re.IGNORECASE | re.DOTALL
            )
            subject = ""
            if subject_match:
                subject = html.unescape(subject_match.group(1).strip())
                # Clean up subject - remove icon references
                subject = re.sub(r'^(Unhappy|Smile|Wink|Cool|Lightbulb|Question|Exclamation|Arrow|Post|Re:)\s*', '', subject)

            # Extract date - format: posticon.gif... 07-03-2004 <font color="...">10:50 AM</font>
            date_match = re.search(
                r'<img src="images/posticon\.gif"[^>]*>\s*(\d{2}-\d{2}-\d{4})\s*(?:<font[^>]*>)?\s*(\d{1,2}:\d{2}\s*[AP]M)',
                block, re.IGNORECASE
            )
            if date_match:
                post_time = parse_vb_date(date_match.group(1) + ' ' + date_match.group(2))
            else:
                post_time = 1072936800

            # Extract content - look for <p><font...>CONTENT</font></p>
            content_parts = []
            content_pattern = re.compile(
                r'<p><font[^>]*face="verdana[^"]*"[^>]*size="2"[^>]*>(.+?)</font></p>',
                re.IGNORECASE | re.DOTALL
            )

            for match in content_pattern.finditer(block):
                content = match.group(1)
                # Skip if it's a moderator link or IP log
                if 'Report this post' in content or 'IP: Logged' in content:
                    continue

                # Convert blockquotes to BBCode BEFORE stripping HTML
                content = convert_quotes_to_bbcode(content)

                # Clean remaining HTML tags
                content = re.sub(r'<br\s*/?>', '\n', content, flags=re.IGNORECASE)
                content = re.sub(r'<img[^>]*alt="([^"]*)"[^>]*>', r'[\1]', content, flags=re.IGNORECASE)
                content = re.sub(r'<a[^>]*href="([^"]*)"[^>]*>([^<]*)</a>', r'\2 (\1)', content, flags=re.IGNORECASE)
                content = re.sub(r'<[^>]+>', '', content)
                content = html.unescape(content)
                content = content.strip()
                if content and len(content) > 3:
                    content_parts.append(content)

            if content_parts:
                posts.append({
                    'post_id': post_id,
                    'author': author,
                    'subject': subject,
                    'content': '\n\n'.join(content_parts),
                    'post_time': post_time
                })
        except Exception as e:
            print(f"    Error parsing post: {e}")
            continue

    return posts


def extract_forum_info(html_content: str, forum_id: int) -> Dict:
    """Extract forum name and description from forumdisplay page."""
    info = {
        'forum_id': forum_id,
        'name': '',
        'description': ''
    }

    # Extract forum name from title
    title_match = re.search(r'<title>Steam Users Forums\s*-\s*(.+?)</title>', html_content, re.IGNORECASE)
    if title_match:
        info['name'] = html.unescape(title_match.group(1).strip())
        # Use forum name as description too
        info['description'] = f"Discussion forum for {info['name']}"

    return info


def extract_announcements(forums_dir: Path) -> List[Dict]:
    """Extract announcements from announcement_*.php files.

    Handles two vBulletin template formats:
    1. With markers: <!-- BEGIN TEMPLATE: announcebit --> ... <!-- END TEMPLATE: announcebit -->
    2. Without markers: raw <tr valign="top"> rows after the Author header row
    """
    announcements = []
    announcement_id = 0

    for filepath in sorted(forums_dir.glob('announcement_*.php')):
        if 'notfound' in filepath.name:
            continue

        try:
            with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
                file_content = f.read()

            # Extract forum ID from breadcrumb
            forum_id = 0
            forum_match = re.search(r'forumid=(\d+)', file_content)
            if forum_match:
                forum_id = int(forum_match.group(1))

            # Extract forum name from title
            forum_name = ""
            title_match = re.search(r'<title>Steam Users Forums\s*-\s*(.+?)\s*Announcements</title>', file_content, re.IGNORECASE)
            if title_match:
                forum_name = html.unescape(title_match.group(1).strip())

            # Try splitting by announcebit template markers first
            if '<!-- BEGIN TEMPLATE: announcebit -->' in file_content:
                bits = re.split(r'<!-- BEGIN TEMPLATE: announcebit -->', file_content)
                announcement_blocks = []
                for bit in bits[1:]:
                    end_match = re.search(r'<!-- END TEMPLATE: announcebit -->', bit)
                    if end_match:
                        announcement_blocks.append(bit[:end_match.start()])
                    else:
                        announcement_blocks.append(bit)
            else:
                # No template markers — split by announcement rows
                # Each announcement starts with <tr valign="top"> containing rowspan="2"
                announcement_blocks = re.split(
                    r'<tr valign="top">\s*\n\s*<td[^>]*bgcolor[^>]*width="175"[^>]*rowspan="2"',
                    file_content
                )
                # Re-prepend the td tag for consistent parsing, skip first (before any announcement)
                announcement_blocks = [
                    '<td bgcolor="#3E4637" width="175" rowspan="2"' + block
                    for block in announcement_blocks[1:]
                ]

            for bit in announcement_blocks:
                # Extract author name
                author_match = re.search(
                    r'<font[^>]*face="verdana[^"]*"[^>]*size="2"[^>]*>\s*<b>([^<]+)</b>\s*</font>',
                    bit, re.IGNORECASE
                )
                author = html.unescape(author_match.group(1).strip()) if author_match else "Unknown"

                # Extract author rank (line after author name)
                rank = ""
                rank_match = re.search(
                    r'<font[^>]*size="1"[^>]*>\s*\n\s*([^<\n]+?)(?:\s*<font|<br)',
                    bit, re.IGNORECASE
                )
                if rank_match:
                    rank = rank_match.group(1).strip()

                # Extract author user ID from profile link
                userid_match = re.search(r'userid=(\d+)', bit)
                author_userid = int(userid_match.group(1)) if userid_match else 0

                # Extract title and date range
                # Format: <b>TITLE</b> <font...>(DATE until DATE)</font>
                title_match = re.search(
                    r'<b>([^<]+)</b>\s*<font[^>]*>\s*\(([^)]+)\)',
                    bit, re.IGNORECASE | re.DOTALL
                )

                title = ""
                date_range = ""
                if title_match:
                    title = html.unescape(title_match.group(1).strip())
                    date_range = title_match.group(2).strip()

                if not title:
                    continue

                # Extract announcement content (between first <hr> and </font>\s*</td>)
                content_match = re.search(
                    r'<hr>\s*\n?(.*?)\s*</font>\s*\n?\s*</td>',
                    bit, re.IGNORECASE | re.DOTALL
                )

                announcement_content = ""
                if content_match:
                    announcement_content = content_match.group(1).strip()
                    # Convert HTML to clean text with basic formatting
                    announcement_content = re.sub(r'<br\s*/?>', '\n', announcement_content, flags=re.IGNORECASE)
                    announcement_content = re.sub(r'</?ul>', '\n', announcement_content, flags=re.IGNORECASE)
                    announcement_content = re.sub(r'<li>', '- ', announcement_content, flags=re.IGNORECASE)
                    announcement_content = re.sub(r'<b>([^<]*)</b>', r'[b]\1[/b]', announcement_content, flags=re.IGNORECASE)
                    announcement_content = re.sub(r'<u>([^<]*)</u>', r'[u]\1[/u]', announcement_content, flags=re.IGNORECASE)
                    announcement_content = re.sub(
                        r'<a[^>]*href="([^"]*)"[^>]*>([^<]*)</a>',
                        r'[url=\1]\2[/url]',
                        announcement_content, flags=re.IGNORECASE
                    )
                    announcement_content = re.sub(
                        r'<font[^>]*color="([^"]*)"[^>]*>([^<]*)</font>',
                        r'[color=\1]\2[/color]',
                        announcement_content, flags=re.IGNORECASE
                    )
                    announcement_content = re.sub(
                        r'<font[^>]*size="\+1"[^>]*>([^<]*)</font>',
                        r'[size=150]\1[/size]',
                        announcement_content, flags=re.IGNORECASE
                    )
                    # Strip remaining HTML tags
                    announcement_content = re.sub(r'<[^>]+>', '', announcement_content)
                    announcement_content = html.unescape(announcement_content).strip()

                post_time = parse_vb_date_range(date_range)

                announcement_id += 1
                announcements.append({
                    'id': announcement_id,
                    'forum_id': forum_id,
                    'forum_name': forum_name,
                    'author': author,
                    'author_rank': rank,
                    'author_userid': author_userid,
                    'title': title,
                    'date_range': date_range,
                    'post_time': post_time,
                    'content': announcement_content
                })

                print(f"  Announcement #{announcement_id}: \"{title}\" in {forum_name} (forum {forum_id}) by {author}")

        except Exception as e:
            print(f"  Error processing {filepath}: {e}")

    return announcements


def process_all_files():
    """Process all thread and post files."""
    all_threads = {}  # thread_id -> {title, forum_id, posts: [], first_post_time}
    all_forums = {}   # forum_id -> {name, description}

    # Process forumid files for forum descriptions
    print("Processing forum display files...")
    for filepath in FORUMS_DIR.glob('forumid_*.php'):
        if 'notfound' in filepath.name:
            continue
        try:
            forum_id = int(filepath.stem.replace('forumid_', ''))
            with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
                content = f.read()
            info = extract_forum_info(content, forum_id)
            if info['name']:
                all_forums[forum_id] = info
                print(f"  Forum {forum_id}: {info['name']}")
        except Exception as e:
            print(f"  Error processing {filepath}: {e}")

    # Process thread and post files (both .php and .html extensions)
    print("\nProcessing thread files...")
    thread_files = (
        list(FORUMS_DIR.glob('thread_*.php')) +
        list(FORUMS_DIR.glob('thread_*.html')) +
        list(FORUMS_DIR.glob('thread_*.htm')) +
        list(FORUMS_DIR.glob('post_*.php')) +
        list(FORUMS_DIR.glob('post_*.html')) +
        list(FORUMS_DIR.glob('post_*.htm'))
    )
    total = len(thread_files)

    for idx, filepath in enumerate(thread_files, 1):
        if idx % 50 == 0:
            print(f"  Processing {idx}/{total}...")

        try:
            file_thread_id, page = extract_thread_id_from_filename(filepath.name)
            if file_thread_id == 0:
                continue

            with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
                content = f.read()

            # Extract actual thread ID from URLs (more reliable)
            url_thread_id = extract_thread_id_from_url(content)
            thread_id = url_thread_id if url_thread_id else file_thread_id

            # Extract title
            title = extract_thread_title(content)

            # Extract forum ID
            forum_id = extract_forum_id_from_thread(content)

            # Extract posts
            posts = extract_posts_from_html(content)

            if thread_id not in all_threads:
                all_threads[thread_id] = {
                    'title': title,
                    'forum_id': forum_id,
                    'posts': [],
                    'first_post_time': 1072936800
                }

            if title and not all_threads[thread_id]['title']:
                all_threads[thread_id]['title'] = title

            if forum_id and not all_threads[thread_id]['forum_id']:
                all_threads[thread_id]['forum_id'] = forum_id

            # Add posts (avoiding duplicates by post_id)
            existing_post_ids = {p['post_id'] for p in all_threads[thread_id]['posts']}
            for post in posts:
                if post['post_id'] not in existing_post_ids:
                    all_threads[thread_id]['posts'].append(post)
                    existing_post_ids.add(post['post_id'])
                    # Track earliest post time
                    if post['post_time'] < all_threads[thread_id]['first_post_time']:
                        all_threads[thread_id]['first_post_time'] = post['post_time']

        except Exception as e:
            print(f"  Error processing {filepath}: {e}")

    # Sort posts within each thread by post_id
    for thread_data in all_threads.values():
        thread_data['posts'].sort(key=lambda p: p['post_id'])

    total_posts = sum(len(t['posts']) for t in all_threads.values())
    print(f"\nParsed {len(all_threads)} threads with {total_posts} posts")
    print(f"Parsed {len(all_forums)} forum descriptions")
    print(f"Found {len(all_users)} unique users")

    # Process announcements
    print("\nProcessing announcement files...")
    all_announcements = extract_announcements(FORUMS_DIR)
    print(f"Parsed {len(all_announcements)} announcements")

    return all_threads, all_forums, all_announcements


def generate_complete_sql(all_threads: Dict, all_forums: Dict, all_announcements: List[Dict]):
    """Generate complete SQL file with all historical data."""

    output_path = OUTPUT_DIR / 'historical_forum_data_real_content.sql'
    total_posts = sum(len(t['posts']) for t in all_threads.values())

    # FIRST PASS: Collect all users before writing SQL
    # This ensures all_users is populated before we write the users INSERT statement
    print("Collecting users from all threads...")
    for thread_id, thread_data in all_threads.items():
        for post in thread_data['posts']:
            get_or_create_user_id(post.get('author', ''))
    # Also collect announcement authors
    for ann in all_announcements:
        get_or_create_user_id(ann.get('author', ''))
    print(f"Collected {len(all_users)} unique users")

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write("-- Historical Steam Forum Data with Real Content\n")
        f.write(f"-- Generated: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")
        f.write(f"-- Contains {len(all_threads)} threads and {total_posts} posts\n")
        f.write(f"-- Contains {len(all_users)} historical users\n")
        f.write(f"-- Contains {len(all_announcements)} announcements\n\n")

        f.write("SET FOREIGN_KEY_CHECKS = 0;\n\n")

        # Generate forum structure matching original vBulletin forum_home.html
        f.write("-- ========================================\n")
        f.write("-- Historical Forums (Create Structure)\n")
        f.write("-- Matches original vBulletin forum_home.html hierarchy\n")
        f.write("-- ========================================\n\n")

        # Categories (forum_type=0)
        f.write("-- Categories (forum_type=0)\n")
        f.write("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical) VALUES\n")
        f.write("(1013, '[2004] Steam Discussions', '', 0, 0, 1),\n")
        f.write("(1040, '[2004] Source Game Discussions', '', 0, 0, 1),\n")
        f.write("(1005, '[2004] Valve Back Catalog Discussions', '', 0, 0, 1),\n")
        f.write("(1042, '[2004] Cyber Cafe Discussions', '', 0, 0, 1);\n\n")

        # Steam Discussions forums
        f.write("-- Forums under Steam Discussions (parent=1013)\n")
        f.write("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical) VALUES\n")
        f.write("(1014, '[2004] General', 'General discussion about Steam', 1013, 1, 1),\n")
        f.write("(1035, '[2004] VAC', 'Valve''s Anti Cheat (VAC) system', 1013, 1, 1),\n")
        f.write("(1017, '[2004] Community Help and Tips', 'Users helping other users with Steam issues', 1013, 1, 1),\n")
        f.write("(1015, '[2004] Suggestions / Ideas', 'Post all your suggestions about Steam and ideas for future releases', 1013, 1, 1),\n")
        f.write("(1039, '[2004] Hardware', 'Discuss computer hardware related to Steam games', 1013, 1, 1),\n")
        f.write("(1034, '[2004] Off Topic', 'Chat about off topic stuff! Keep it clean, keep it nice!', 1013, 1, 1);\n\n")

        # Source Game Discussions forums
        f.write("-- Forums under Source Game Discussions (parent=1040)\n")
        f.write("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical) VALUES\n")
        f.write("(1043, '[2004] Half-Life 2', 'General discussions about Half-Life 2', 1040, 1, 1),\n")
        f.write("(1046, '[2004] Half-Life 2: Deathmatch', 'Discussions about Half-Life 2: Deathmatch', 1040, 1, 1),\n")
        f.write("(1037, '[2004] Counter-Strike: Source', 'General discussions about Counter-Strike: Source', 1040, 1, 1),\n")
        f.write("(1044, '[2004] Source DS (Windows)', 'Source Dedicated Server running on Windows', 1040, 1, 1),\n")
        f.write("(1045, '[2004] Source DS (Linux)', 'Source Dedicated Server running on Linux', 1040, 1, 1),\n")
        f.write("(1041, '[2004] Source SDK', 'General discussion about the Source SDK', 1040, 1, 1);\n\n")

        # Valve Back Catalog forums
        f.write("-- Forums under Valve Back Catalog Discussions (parent=1005)\n")
        f.write("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical) VALUES\n")
        f.write("(1033, '[2004] CS: Condition Zero', 'Discussions about Counter-Strike: Condition Zero', 1005, 1, 1),\n")
        f.write("(1007, '[2004] Counter-Strike', 'General discussions about Counter-Strike', 1005, 1, 1),\n")
        f.write("(1020, '[2004] Half-Life', 'General discussions about Half-Life', 1005, 1, 1),\n")
        f.write("(1021, '[2004] Day of Defeat', 'General discussions about Day of Defeat', 1005, 1, 1),\n")
        f.write("(1022, '[2004] Team Fortress Classic', 'General discussions about Team Fortress Classic', 1005, 1, 1),\n")
        f.write("(1023, '[2004] Deathmatch Classic', 'General discussions about Deathmatch Classic', 1005, 1, 1),\n")
        f.write("(1024, '[2004] Opposing Force', 'General discussions about Opposing Force', 1005, 1, 1),\n")
        f.write("(1025, '[2004] Ricochet', 'General discussions about Ricochet', 1005, 1, 1),\n")
        f.write("(1016, '[2004] Windows Dedicated Server', 'Server administrators discuss issues relating to Steam and dedicated servers', 1005, 1, 1),\n")
        f.write("(1019, '[2004] Linux Dedicated Server', 'Server administrators discuss issues relating to using the Linux Steam client', 1005, 1, 1);\n\n")

        # Cyber Cafe forums
        f.write("-- Forums under Cyber Cafe Discussions (parent=1042)\n")
        f.write("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical) VALUES\n")
        f.write("(1031, '[2004] Cyber Cafe Program - Discussion', 'Discussions about the Steam Cyber Cafe Program', 1042, 1, 1),\n")
        f.write("(1032, '[2004] Cyber Cafe Program - Support', 'Support for the Steam Cyber Cafe Program', 1042, 1, 1);\n\n")

        # Generate historical users
        f.write("-- ========================================\n")
        f.write("-- Historical Users\n")
        f.write("-- ========================================\n\n")

        f.write("INSERT IGNORE INTO phpbb_users (user_id, username, username_clean, user_password, user_email, user_regdate, is_historical) VALUES\n")
        user_rows = []
        for username, user_id in sorted(all_users.items(), key=lambda x: x[1]):
            clean_name = escape_sql_string(username.lower().replace(' ', '_'))
            username_sql = escape_sql_string(username)
            user_rows.append(f"({user_id}, '[2004] {username_sql}', '{clean_name}', '', 'historical@steamforums.local', 1072936800, 1)")
        f.write(',\n'.join(user_rows))
        f.write(";\n\n")

        # Generate topics (normal threads)
        f.write("-- ========================================\n")
        f.write("-- Historical Topics\n")
        f.write("-- ========================================\n\n")

        f.write("INSERT IGNORE INTO phpbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_posts_approved, topic_views, topic_type, topic_visibility, is_historical) VALUES\n")
        topic_rows = []
        for thread_id, thread_data in sorted(all_threads.items()):
            if not thread_data['posts']:
                continue

            forum_id = FORUM_ID_OFFSET + (thread_data['forum_id'] or 1)
            title = escape_sql_string(thread_data['title'] or f"Thread {thread_id}")
            post_count = len(thread_data['posts'])
            first_post = thread_data['posts'][0] if thread_data['posts'] else {}
            poster_id = get_or_create_user_id(first_post.get('author', ''))
            post_time = thread_data['first_post_time']

            # topic_type 0 = normal thread, topic_visibility 1 = approved
            topic_rows.append(f"({thread_id}, {forum_id}, '[2004] {title}', {poster_id}, {post_time}, {post_count}, 0, 0, 1, 1)")

        f.write(',\n'.join(topic_rows))
        f.write(";\n\n")

        # Generate announcement topics (topic_type = 2)
        if all_announcements:
            f.write("-- ========================================\n")
            f.write("-- Historical Announcements (topic_type = 2)\n")
            f.write("-- ========================================\n\n")

            f.write("INSERT IGNORE INTO phpbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_posts_approved, topic_views, topic_type, topic_visibility, is_historical) VALUES\n")
            ann_topic_rows = []
            for ann in all_announcements:
                topic_id = ANNOUNCEMENT_TOPIC_ID_OFFSET + ann['id']
                forum_id = FORUM_ID_OFFSET + ann['forum_id']
                title = escape_sql_string(ann['title'])
                poster_id = get_or_create_user_id(ann['author'])
                post_time = ann['post_time']

                # topic_type 2 = announcement, topic_visibility 1 = approved
                ann_topic_rows.append(f"({topic_id}, {forum_id}, '[2004] {title}', {poster_id}, {post_time}, 1, 0, 2, 1, 1)")

            f.write(',\n'.join(ann_topic_rows))
            f.write(";\n\n")

        # Generate posts (normal threads)
        f.write("-- ========================================\n")
        f.write("-- Historical Posts\n")
        f.write("-- ========================================\n\n")

        f.write("INSERT IGNORE INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_subject, post_text, poster_ip, post_visibility, is_historical) VALUES\n")
        post_rows = []

        for thread_id, thread_data in sorted(all_threads.items()):
            forum_id = FORUM_ID_OFFSET + (thread_data['forum_id'] or 1)

            for post in thread_data['posts']:
                poster_id = get_or_create_user_id(post.get('author', ''))
                subject = escape_sql_string(post.get('subject', ''))
                content = escape_sql_string(post.get('content', ''))
                post_time = post.get('post_time', 1072936800)

                # post_visibility 1 = approved
                post_rows.append(
                    f"({post['post_id']}, {thread_id}, {forum_id}, {poster_id}, {post_time}, "
                    f"'{subject}', '{content}', '127.0.0.1', 1, 1)"
                )

        # Write in chunks to avoid memory issues
        chunk_size = 100
        for i in range(0, len(post_rows), chunk_size):
            chunk = post_rows[i:i+chunk_size]
            if i > 0:
                f.write(",\n")
            f.write(',\n'.join(chunk))

        f.write(";\n\n")

        # Generate announcement posts
        if all_announcements:
            f.write("-- ========================================\n")
            f.write("-- Historical Announcement Posts\n")
            f.write("-- ========================================\n\n")

            f.write("INSERT IGNORE INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_subject, post_text, poster_ip, post_visibility, is_historical) VALUES\n")
            ann_post_rows = []
            for ann in all_announcements:
                post_id = ANNOUNCEMENT_POST_ID_OFFSET + ann['id']
                topic_id = ANNOUNCEMENT_TOPIC_ID_OFFSET + ann['id']
                forum_id = FORUM_ID_OFFSET + ann['forum_id']
                poster_id = get_or_create_user_id(ann['author'])
                post_time = ann['post_time']
                subject = escape_sql_string(ann['title'])
                content = escape_sql_string(ann['content'])

                # post_visibility 1 = approved
                ann_post_rows.append(
                    f"({post_id}, {topic_id}, {forum_id}, {poster_id}, {post_time}, "
                    f"'{subject}', '{content}', '127.0.0.1', 1, 1)"
                )

            f.write(',\n'.join(ann_post_rows))
            f.write(";\n\n")

            # Update topic first/last post IDs for announcements
            f.write("-- Update announcement topic first/last post references\n")
            for ann in all_announcements:
                topic_id = ANNOUNCEMENT_TOPIC_ID_OFFSET + ann['id']
                post_id = ANNOUNCEMENT_POST_ID_OFFSET + ann['id']
                poster_id = get_or_create_user_id(ann['author'])
                poster_name = escape_sql_string(ann['author'])
                f.write(f"UPDATE phpbb_topics SET topic_first_post_id = {post_id}, topic_first_poster_name = '[2004] {poster_name}', ")
                f.write(f"topic_last_post_id = {post_id}, topic_last_poster_id = {poster_id}, topic_last_poster_name = '[2004] {poster_name}', ")
                f.write(f"topic_last_post_time = {ann['post_time']} ")
                f.write(f"WHERE topic_id = {topic_id};\n")
            f.write("\n")

        f.write("SET FOREIGN_KEY_CHECKS = 1;\n")

    print(f"\nGenerated: {output_path}")
    return output_path


def generate_json_export(all_threads: Dict, all_forums: Dict, all_announcements: List[Dict]):
    """Export parsed data as JSON for review."""

    output_path = OUTPUT_DIR / 'historical_forum_data_preview.json'

    # Get sample threads with most posts
    sample_threads = sorted(
        all_threads.items(),
        key=lambda x: len(x[1]['posts']),
        reverse=True
    )[:20]

    data = {
        'stats': {
            'total_threads': len(all_threads),
            'total_posts': sum(len(t['posts']) for t in all_threads.values()),
            'total_users': len(all_users),
            'total_forums': len(all_forums),
            'total_announcements': len(all_announcements)
        },
        'forums': {str(k): v for k, v in all_forums.items()},
        'announcements': [
            {
                'id': a['id'],
                'forum_id': a['forum_id'],
                'forum_name': a['forum_name'],
                'title': a['title'],
                'author': a['author'],
                'date_range': a['date_range'],
                'content': a['content'][:500] + ('...' if len(a['content']) > 500 else '')
            }
            for a in all_announcements
        ],
        'sample_threads': {
            str(k): {
                'title': v['title'],
                'forum_id': v['forum_id'],
                'post_count': len(v['posts']),
                'first_posts': [
                    {
                        'post_id': p['post_id'],
                        'author': p['author'],
                        'subject': p['subject'],
                        'content': p['content'][:500] + ('...' if len(p['content']) > 500 else '')
                    }
                    for p in v['posts'][:3]
                ]
            }
            for k, v in sample_threads
        }
    }

    with open(output_path, 'w', encoding='utf-8') as f:
        json.dump(data, f, indent=2, ensure_ascii=False)

    print(f"Generated preview: {output_path}")
    return output_path


if __name__ == '__main__':
    print("="*60)
    print("Historical Steam Forum Parser")
    print("="*60)

    all_threads, all_forums, all_announcements = process_all_files()

    print("\n" + "="*60)
    print("Generating output files...")
    print("="*60)

    generate_json_export(all_threads, all_forums, all_announcements)
    generate_complete_sql(all_threads, all_forums, all_announcements)

    print("\nDone!")
