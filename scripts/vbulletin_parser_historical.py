#!/usr/bin/env python3
"""
VBulletin Forum Data Parser for Historical phpBB Integration

This script parses archived VBulletin forum pages and extracts data for
integration into phpBB with style-conditional display.

Features:
- No avatar handling (users have no avatars)
- Adds historical data flags
- Creates phpBB-compatible SQL with conditional display logic
- Designed for 2003_v2/2004 theme integration
"""

import os
import re
import html
import datetime
import sys
from pathlib import Path
from typing import Dict, List, Tuple, Optional
from dataclasses import dataclass
from bs4 import BeautifulSoup

@dataclass
class ForumData:
    forum_id: int
    forum_name: str
    forum_desc: str
    parent_id: int = 0
    is_historical: bool = True

@dataclass
class UserData:
    user_id: int
    username: str
    user_email: str = ""
    user_regdate: int = 0
    user_posts: int = 0
    user_location: str = ""
    user_signature: str = ""
    is_historical: bool = True

@dataclass
class ThreadData:
    thread_id: int
    forum_id: int
    thread_title: str
    thread_starter: int
    thread_time: int
    thread_posts: int = 0
    thread_views: int = 0
    is_historical: bool = True

@dataclass
class PostData:
    post_id: int
    thread_id: int
    user_id: int
    post_time: int
    post_content: str
    post_subject: str = ""
    poster_ip: str = ""
    is_historical: bool = True

class HistoricalVBulletinParser:
    def __init__(self, forums_dir: str):
        self.forums_dir = Path(forums_dir)
        self.forums = {}
        self.users = {}
        self.threads = {}
        self.posts = {}

        # Track ID ranges to avoid conflicts with real data
        self.historical_user_id_offset = 100000  # Historical users start at 100000
        self.historical_forum_id_offset = 1000   # Historical forums start at 1000
        self.historical_thread_id_offset = 100000 # Historical threads start at 100000
        self.historical_post_id_offset = 1000000  # Historical posts start at 1000000

    def clean_html_content(self, content: str) -> str:
        """Clean HTML content and convert to phpBB-compatible format"""
        if not content:
            return ""

        # Parse with BeautifulSoup
        soup = BeautifulSoup(content, 'html.parser')

        # Convert VB quote tags to phpBB format
        for quote in soup.find_all('blockquote'):
            quote_text = quote.get_text().strip()
            if 'Originally posted by' in quote_text:
                username_match = re.search(r'Originally posted by (\w+)', quote_text)
                if username_match:
                    username = username_match.group(1)
                    quote_content = re.sub(r'Originally posted by.*?>', '', str(quote))
                    quote.replace_with(f'[quote="{username}"]{quote_content}[/quote]')

        # Convert other BB codes and clean up
        text = soup.get_text()
        text = re.sub(r'\s+', ' ', text).strip()

        # Remove any potentially harmful content
        text = html.escape(text)

        return text

    def parse_timestamp(self, timestamp_str: str) -> int:
        """Parse VBulletin timestamp format to Unix timestamp"""
        try:
            timestamp_str = timestamp_str.strip()
            if ' AM' in timestamp_str or ' PM' in timestamp_str:
                dt = datetime.datetime.strptime(timestamp_str, '%m-%d-%Y %I:%M %p')
            else:
                for fmt in ['%m-%d-%Y %H:%M', '%Y-%m-%d %H:%M:%S']:
                    try:
                        dt = datetime.datetime.strptime(timestamp_str, fmt)
                        break
                    except ValueError:
                        continue
                else:
                    return 0

            return int(dt.timestamp())
        except Exception as e:
            print(f"Error parsing timestamp '{timestamp_str}': {e}")
            return 0

    def extract_user_id_from_url(self, url: str) -> int:
        """Extract user ID from VBulletin profile URL and convert to historical ID"""
        match = re.search(r'userid=(\d+)', url)
        if match:
            original_id = int(match.group(1))
            return self.historical_user_id_offset + original_id
        return 0

    def parse_forum_listing(self, filepath: Path) -> Optional[ForumData]:
        """Parse a forum listing page to extract forum information"""
        try:
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Extract forum ID from filename and convert to historical ID
            forum_id_match = re.search(r'forumid_(\d+)\.php', filepath.name)
            if not forum_id_match:
                return None

            original_forum_id = int(forum_id_match.group(1))
            historical_forum_id = self.historical_forum_id_offset + original_forum_id

            # Extract forum name from breadcrumb or title
            forum_name = ""
            breadcrumb = soup.find('font', {'size': '2'})
            if breadcrumb:
                links = breadcrumb.find_all('a')
                if links:
                    forum_name = links[-1].get_text().strip()

            if not forum_name:
                title_tag = soup.find('title')
                if title_tag:
                    title_text = title_tag.get_text()
                    if ' - ' in title_text:
                        forum_name = title_text.split(' - ')[1].strip()

            return ForumData(
                forum_id=historical_forum_id,
                forum_name=forum_name or f"Historical Forum {original_forum_id}",
                forum_desc=f"Historical forum data from 2004 Steam forums",
                is_historical=True
            )

        except Exception as e:
            print(f"Error parsing forum {filepath}: {e}")
            return None

    def parse_user_data(self, post_soup: BeautifulSoup) -> Optional[UserData]:
        """Extract user data from a post"""
        try:
            # Find username
            username_elem = post_soup.find('font', {'size': '2'})
            if not username_elem or not username_elem.find('b'):
                return None

            username = username_elem.find('b').get_text().strip()

            # Add historical prefix to avoid conflicts
            historical_username = f"[2004] {username}"

            # Extract user ID from profile link
            profile_link = post_soup.find('a', href=re.compile(r'member\.php.*userid='))
            if not profile_link:
                return None

            user_id = self.extract_user_id_from_url(profile_link.get('href', ''))
            if not user_id:
                return None

            # Extract registration date and posts
            user_info_text = post_soup.get_text()

            reg_date = 0
            reg_match = re.search(r'Registered: (\w+ \d+)', user_info_text)
            if reg_match:
                reg_date_str = reg_match.group(1)
                try:
                    dt = datetime.datetime.strptime(reg_date_str, '%b %Y')
                    reg_date = int(dt.timestamp())
                except:
                    pass

            posts = 0
            posts_match = re.search(r'Posts: (\d+)', user_info_text)
            if posts_match:
                posts = int(posts_match.group(1))

            location = ""
            location_match = re.search(r'Location: ([^<\n]+)', user_info_text)
            if location_match:
                location = location_match.group(1).strip()

            return UserData(
                user_id=user_id,
                username=historical_username,
                user_email=f"{username.lower().replace(' ', '_')}@2004forums.steam",
                user_regdate=reg_date,
                user_posts=posts,
                user_location=location,
                is_historical=True
            )

        except Exception as e:
            print(f"Error parsing user data: {e}")
            return None

    def parse_thread_page(self, filepath: Path) -> Tuple[Optional[ThreadData], List[PostData]]:
        """Parse a thread page to extract thread info and all posts"""
        try:
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Extract thread ID from filename and convert to historical ID
            thread_id_match = re.search(r'thread_(\d+)(?:_pagenumber_\d+)?\.php', filepath.name)
            if not thread_id_match:
                return None, []

            original_thread_id = int(thread_id_match.group(1))
            historical_thread_id = self.historical_thread_id_offset + original_thread_id

            # Extract thread title
            thread_title = ""
            title_tag = soup.find('title')
            if title_tag:
                title_text = title_tag.get_text()
                if ' - ' in title_text:
                    thread_title = title_text.split(' - ')[-1].strip()

            # Extract forum ID from breadcrumb and convert to historical ID
            forum_id = 0
            breadcrumb_links = soup.find_all('a', href=re.compile(r'forumid='))
            if breadcrumb_links:
                last_forum_link = breadcrumb_links[-1]
                forum_id_match = re.search(r'forumid=(\d+)', last_forum_link.get('href', ''))
                if forum_id_match:
                    original_forum_id = int(forum_id_match.group(1))
                    forum_id = self.historical_forum_id_offset + original_forum_id

            posts_data = []
            post_tables = soup.find_all('table', {'cellpadding': '4', 'cellspacing': '1'})

            thread_starter = 0
            thread_time = 0

            for i, post_table in enumerate(post_tables):
                try:
                    # Extract post ID
                    post_anchor = post_table.find('a', {'name': re.compile(r'post\d+')})
                    if not post_anchor:
                        continue

                    post_id_match = re.search(r'post(\d+)', post_anchor.get('name', ''))
                    if not post_id_match:
                        continue

                    original_post_id = int(post_id_match.group(1))
                    historical_post_id = self.historical_post_id_offset + original_post_id

                    # Extract user data
                    user_data = self.parse_user_data(post_table)
                    if not user_data:
                        continue

                    # Store user data
                    if user_data.user_id not in self.users:
                        self.users[user_data.user_id] = user_data

                    if i == 0:  # First post is thread starter
                        thread_starter = user_data.user_id

                    # Extract post content
                    content_cell = post_table.find('td', {'bgcolor': '#3E4637', 'width': '100%'})
                    if not content_cell:
                        continue

                    post_content = ""
                    post_subject = ""

                    # Find the post subject
                    subject_elem = content_cell.find('b')
                    if subject_elem:
                        post_subject = subject_elem.get_text().strip()
                        if post_subject.startswith('Re: '):
                            post_subject = post_subject[4:]

                    # Extract post content
                    content_paras = content_cell.find_all('p')
                    if content_paras:
                        for para in content_paras[:-2]:  # Exclude metadata paragraphs
                            para_text = self.clean_html_content(str(para))
                            if para_text and para_text != post_subject:
                                post_content += para_text + "\n\n"

                    post_content = post_content.strip()

                    # Extract timestamp
                    timestamp_cell = post_table.find('td', {'height': '16', 'nowrap': True})
                    post_time = 0
                    if timestamp_cell:
                        timestamp_text = timestamp_cell.get_text()
                        time_match = re.search(r'(\d{2}-\d{2}-\d{4}\s+\d{1,2}:\d{2}\s+[AP]M)', timestamp_text)
                        if time_match:
                            post_time = self.parse_timestamp(time_match.group(1))

                    if i == 0:  # First post time is thread time
                        thread_time = post_time

                    posts_data.append(PostData(
                        post_id=historical_post_id,
                        thread_id=historical_thread_id,
                        user_id=user_data.user_id,
                        post_time=post_time,
                        post_content=post_content,
                        post_subject=post_subject,
                        poster_ip="127.0.0.1",  # Historical posts get localhost IP
                        is_historical=True
                    ))

                except Exception as e:
                    print(f"Error parsing post in thread {original_thread_id}: {e}")
                    continue

            thread_data = None
            if thread_title and forum_id and thread_starter:
                thread_data = ThreadData(
                    thread_id=historical_thread_id,
                    forum_id=forum_id,
                    thread_title=f"[2004] {thread_title}",  # Historical prefix
                    thread_starter=thread_starter,
                    thread_time=thread_time,
                    thread_posts=len(posts_data),
                    is_historical=True
                )

            return thread_data, posts_data

        except Exception as e:
            print(f"Error parsing thread {filepath}: {e}")
            return None, []

    def process_all_files(self):
        """Process all forum files and extract data"""
        print("Processing historical forum files...")

        # Process forum listings
        forum_files = list(self.forums_dir.glob("forumid_*.php"))
        print(f"Found {len(forum_files)} forum files")

        for forum_file in forum_files:
            forum_data = self.parse_forum_listing(forum_file)
            if forum_data:
                self.forums[forum_data.forum_id] = forum_data
                print(f"Parsed historical forum: {forum_data.forum_name}")

        # Process thread files
        thread_files = list(self.forums_dir.glob("thread_*.php"))
        print(f"Found {len(thread_files)} thread files")

        for i, thread_file in enumerate(thread_files):
            if i % 50 == 0:
                print(f"Processing thread {i+1}/{len(thread_files)}: {thread_file.name}")

            thread_data, posts_data = self.parse_thread_page(thread_file)

            if thread_data:
                self.threads[thread_data.thread_id] = thread_data

                for post_data in posts_data:
                    self.posts[post_data.post_id] = post_data

    def generate_installation_sql(self, output_file: str):
        """Generate SQL for installation integration"""
        print("\nGenerating historical forum installation SQL...")

        sql_statements = []

        # Header
        sql_statements.append("-- Historical 2004 Steam Forum Data")
        sql_statements.append("-- This data only displays when using 2003_v2 or 2004 phpBB styles")
        sql_statements.append(f"-- Generated on: {datetime.datetime.now()}")
        sql_statements.append("")
        sql_statements.append("SET FOREIGN_KEY_CHECKS = 0;")
        sql_statements.append("")

        # Add historical flag column to phpBB tables if not exists
        sql_statements.append("-- Add historical data columns")
        sql_statements.append("ALTER TABLE phpbb_users ADD COLUMN IF NOT EXISTS is_historical TINYINT(1) DEFAULT 0;")
        sql_statements.append("ALTER TABLE phpbb_forums ADD COLUMN IF NOT EXISTS is_historical TINYINT(1) DEFAULT 0;")
        sql_statements.append("ALTER TABLE phpbb_topics ADD COLUMN IF NOT EXISTS is_historical TINYINT(1) DEFAULT 0;")
        sql_statements.append("ALTER TABLE phpbb_posts ADD COLUMN IF NOT EXISTS is_historical TINYINT(1) DEFAULT 0;")
        sql_statements.append("")

        # Historical Users
        if self.users:
            sql_statements.append("-- Historical Users (2004 Steam Forums)")
            user_values = []
            for user_id, user in self.users.items():
                username_clean = user.username.lower().replace(' ', '_').replace('[2004]_', '')
                email = user.user_email
                signature = user.user_signature.replace("'", "\\'").replace('"', '\\"')
                location = user.user_location.replace("'", "\\'").replace('"', '\\"')

                user_values.append(
                    f"({user_id}, '{user.username}', '{username_clean}', '{email}', "
                    f"{user.user_regdate}, {user.user_posts}, '{signature}', '{location}', 1)"
                )

            if user_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_users (user_id, username, username_clean, user_email, user_regdate, user_posts, user_sig, user_from, is_historical) VALUES")
                sql_statements.append(",\n".join(user_values) + ";")
            sql_statements.append("")

        # Historical Forums
        if self.forums:
            sql_statements.append("-- Historical Forums")
            forum_values = []
            for forum_id, forum in self.forums.items():
                forum_threads = [t for t in self.threads.values() if t.forum_id == forum_id]
                forum_posts_count = sum([t.thread_posts for t in forum_threads])
                forum_topics_count = len(forum_threads)

                forum_name = forum.forum_name.replace("'", "\\'").replace('"', '\\"')
                forum_desc = forum.forum_desc.replace("'", "\\'").replace('"', '\\"')

                forum_values.append(
                    f"({forum_id}, '{forum_name}', '{forum_desc}', 1, "
                    f"{forum_posts_count}, {forum_topics_count}, 1)"
                )

            if forum_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, forum_type, forum_posts, forum_topics, is_historical) VALUES")
                sql_statements.append(",\n".join(forum_values) + ";")
            sql_statements.append("")

        # Historical Topics/Threads
        if self.threads:
            sql_statements.append("-- Historical Topics")
            topic_values = []
            for thread_id, thread in self.threads.items():
                title = thread.thread_title.replace("'", "\\'").replace('"', '\\"')

                topic_values.append(
                    f"({thread_id}, {thread.forum_id}, '{title}', {thread.thread_starter}, "
                    f"{thread.thread_time}, {thread.thread_posts}, {thread.thread_views}, 1)"
                )

            if topic_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_posts, topic_views, is_historical) VALUES")
                sql_statements.append(",\n".join(topic_values) + ";")
            sql_statements.append("")

        # Historical Posts
        if self.posts:
            sql_statements.append("-- Historical Posts")
            post_values = []
            for post_id, post in self.posts.items():
                subject = post.post_subject.replace("'", "\\'").replace('"', '\\"')
                content = post.post_content.replace("'", "\\'").replace('"', '\\"')
                poster_ip = post.poster_ip.replace("'", "\\'")

                # Get forum_id from thread
                thread = self.threads.get(post.thread_id)
                forum_id = thread.forum_id if thread else 0

                post_values.append(
                    f"({post_id}, {post.thread_id}, {forum_id}, {post.user_id}, "
                    f"{post.post_time}, '{subject}', '{content}', '{poster_ip}', 1)"
                )

            if post_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_subject, post_text, poster_ip, is_historical) VALUES")
                sql_statements.append(",\n".join(post_values) + ";")
            sql_statements.append("")

        sql_statements.append("SET FOREIGN_KEY_CHECKS = 1;")

        # Write to file
        with open(output_file, 'w', encoding='utf-8') as f:
            f.write("\n".join(sql_statements))

        print(f"Historical forum SQL written to: {output_file}")
        print(f"Statistics:")
        print(f"  Historical Forums: {len(self.forums)}")
        print(f"  Historical Users: {len(self.users)}")
        print(f"  Historical Threads: {len(self.threads)}")
        print(f"  Historical Posts: {len(self.posts)}")

def main():
    if len(sys.argv) < 2:
        print("Usage: python vbulletin_parser_historical.py <forums_directory> [output_file]")
        print("Example: python vbulletin_parser_historical.py ./forums historical_forum_data.sql")
        sys.exit(1)

    forums_dir = sys.argv[1]
    output_file = sys.argv[2] if len(sys.argv) > 2 else "historical_forum_data.sql"

    if not os.path.exists(forums_dir):
        print(f"Error: Forums directory '{forums_dir}' does not exist")
        sys.exit(1)

    parser = HistoricalVBulletinParser(forums_dir)
    parser.process_all_files()
    parser.generate_installation_sql(output_file)

if __name__ == "__main__":
    main()