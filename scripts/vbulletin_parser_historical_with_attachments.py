#!/usr/bin/env python3
"""
VBulletin Forum Data Parser for Historical phpBB Integration with Attachment Support

This script parses archived VBulletin forum pages and extracts data for
integration into phpBB with style-conditional display, including attachment handling.

Features:
- No avatar handling (users have no avatars)
- Adds historical data flags
- Creates phpBB-compatible SQL with conditional display logic
- Processes attachment files and creates phpBB attachment entries
- Designed for 2003_v2/2004 theme integration
"""

import os
import re
import html
import datetime
import sys
import mimetypes
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

@dataclass
class AttachmentData:
    attach_id: int
    post_msg_id: int
    real_filename: str
    attach_comment: str = ""
    physical_filename: str = ""
    filesize: int = 0
    filetime: int = 0
    mimetype: str = ""
    extension: str = ""
    is_historical: bool = True

class HistoricalVBulletinParser:
    def __init__(self, forums_dir: str):
        self.forums_dir = Path(forums_dir)
        self.forums = {}
        self.users = {}
        self.threads = {}
        self.posts = {}
        self.attachments = {}

        # Track ID ranges to avoid conflicts with real data
        self.historical_user_id_offset = 100000  # Historical users start at 100000
        self.historical_forum_id_offset = 1000   # Historical forums start at 1000
        self.historical_thread_id_offset = 100000 # Historical threads start at 100000
        self.historical_post_id_offset = 1000000  # Historical posts start at 1000000
        self.historical_attachment_id_offset = 100000  # Historical attachments start at 100000

        # Initialize mimetypes
        mimetypes.init()

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

        # Basic cleanup
        text = re.sub(r'\s+', ' ', text).strip()
        text = html.unescape(text)

        return text

    def extract_date_from_string(self, date_str: str) -> int:
        """Extract timestamp from VBulletin date string"""
        if not date_str:
            return int(datetime.datetime(2004, 1, 1).timestamp())

        try:
            # Try to parse common VBulletin date formats
            date_patterns = [
                r'(\d{1,2})-(\d{1,2})-(\d{4})\s+(\d{1,2}):(\d{2})\s*(AM|PM)',
                r'(\d{1,2})/(\d{1,2})/(\d{4})\s+(\d{1,2}):(\d{2})\s*(AM|PM)',
                r'(\w+)\s+(\d{1,2}),?\s+(\d{4})\s+(\d{1,2}):(\d{2})\s*(AM|PM)',
            ]

            for pattern in date_patterns:
                match = re.search(pattern, date_str, re.IGNORECASE)
                if match:
                    groups = match.groups()
                    if len(groups) >= 6:
                        # Handle different date formats
                        if pattern.startswith(r'(\w+)'):  # Month name format
                            month_name = groups[0]
                            day = int(groups[1])
                            year = int(groups[2])
                            hour = int(groups[3])
                            minute = int(groups[4])
                            ampm = groups[5].upper()

                            month_dict = {
                                'JANUARY': 1, 'FEBRUARY': 2, 'MARCH': 3, 'APRIL': 4,
                                'MAY': 5, 'JUNE': 6, 'JULY': 7, 'AUGUST': 8,
                                'SEPTEMBER': 9, 'OCTOBER': 10, 'NOVEMBER': 11, 'DECEMBER': 12,
                                'JAN': 1, 'FEB': 2, 'MAR': 3, 'APR': 4, 'JUN': 6,
                                'JUL': 7, 'AUG': 8, 'SEP': 9, 'OCT': 10, 'NOV': 11, 'DEC': 12
                            }
                            month = month_dict.get(month_name.upper(), 1)
                        else:
                            month = int(groups[0])
                            day = int(groups[1])
                            year = int(groups[2])
                            hour = int(groups[3])
                            minute = int(groups[4])
                            ampm = groups[5].upper()

                        # Convert 12-hour to 24-hour
                        if ampm == 'PM' and hour != 12:
                            hour += 12
                        elif ampm == 'AM' and hour == 12:
                            hour = 0

                        dt = datetime.datetime(year, month, day, hour, minute)
                        return int(dt.timestamp())

        except Exception as e:
            print(f"Warning: Could not parse date '{date_str}': {e}")

        # Default to 2004 if parsing fails
        return int(datetime.datetime(2004, 1, 1).timestamp())

    def scan_attachment_files(self):
        """Scan for attachment files in the forums directory"""
        print("Scanning for attachment files...")

        attachment_pattern = re.compile(r'attachment_(\d+)\.(.+)')
        attachment_files = []

        for file_path in self.forums_dir.glob("attachment_*.*"):
            match = attachment_pattern.match(file_path.name)
            if match:
                vb_attachment_id = int(match.group(1))
                file_extension = match.group(2)
                attachment_files.append((vb_attachment_id, file_path, file_extension))

        print(f"Found {len(attachment_files)} attachment files")

        # Process each attachment
        for vb_attachment_id, file_path, file_extension in attachment_files:
            # Generate phpBB attachment ID
            phpbb_attachment_id = self.historical_attachment_id_offset + vb_attachment_id

            # Get file info
            file_stat = file_path.stat()
            filesize = file_stat.st_size
            filetime = int(file_stat.st_mtime)

            # Determine mimetype
            mimetype, _ = mimetypes.guess_type(file_path.name)
            if not mimetype:
                if file_extension.lower() in ['jpg', 'jpeg']:
                    mimetype = 'image/jpeg'
                elif file_extension.lower() == 'gif':
                    mimetype = 'image/gif'
                elif file_extension.lower() == 'png':
                    mimetype = 'image/png'
                elif file_extension.lower() == 'zip':
                    mimetype = 'application/zip'
                else:
                    mimetype = 'application/octet-stream'

            # Create attachment data
            attachment = AttachmentData(
                attach_id=phpbb_attachment_id,
                post_msg_id=0,  # Will be linked later if we can find the association
                attach_comment="Historical attachment from 2004 forums",
                real_filename=f"attachment_{vb_attachment_id}.{file_extension}",
                physical_filename=f"{phpbb_attachment_id}_{filetime}.{file_extension}",
                filesize=filesize,
                filetime=filetime,
                mimetype=mimetype,
                extension=file_extension,
                is_historical=True
            )

            self.attachments[phpbb_attachment_id] = attachment
            print(f"  Processed attachment {vb_attachment_id} -> {phpbb_attachment_id} ({attachment.real_filename}, {filesize} bytes)")

    def process_forum_file(self, file_path: Path):
        """Process a forum listing file"""
        if not file_path.name.startswith('forumid_'):
            return

        try:
            with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Extract forum ID from filename
            forum_id_match = re.search(r'forumid_(\d+)', file_path.name)
            if not forum_id_match:
                return

            vb_forum_id = int(forum_id_match.group(1))
            phpbb_forum_id = self.historical_forum_id_offset + vb_forum_id

            # Extract forum name from title or page content
            title_tag = soup.find('title')
            forum_name = "Historical Forum"
            if title_tag:
                title_text = title_tag.get_text()
                forum_name = re.sub(r'Steam Users Forums - ', '', title_text).strip()
                if not forum_name:
                    forum_name = f"Forum {vb_forum_id}"

            # Create forum data
            forum = ForumData(
                forum_id=phpbb_forum_id,
                forum_name=f"[2004] {forum_name}",
                forum_desc=f"Historical Steam forum from 2004 (ID: {vb_forum_id})",
                parent_id=0,
                is_historical=True
            )

            self.forums[phpbb_forum_id] = forum
            print(f"Processed forum: {forum.forum_name}")

        except Exception as e:
            print(f"Error processing forum file {file_path}: {e}")

    def process_thread_file(self, file_path: Path):
        """Process a thread file"""
        if not file_path.name.startswith('thread_'):
            return

        try:
            with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Extract thread ID from filename
            thread_id_match = re.search(r'thread_(\d+)', file_path.name)
            if not thread_id_match:
                return

            vb_thread_id = int(thread_id_match.group(1))
            phpbb_thread_id = self.historical_thread_id_offset + vb_thread_id

            # Extract thread title
            title_tag = soup.find('title')
            thread_title = "Historical Thread"
            if title_tag:
                title_text = title_tag.get_text()
                thread_title = re.sub(r'Steam Users Forums - ', '', title_text).strip()

            # Find all posts in the thread
            post_tables = soup.find_all('table', class_=lambda x: x and 'tborder' in x)
            if not post_tables:
                post_tables = soup.find_all('table', attrs={'cellpadding': '4'})

            posts_found = []
            forum_id = 0  # Will be determined from first post

            for post_table in post_tables:
                try:
                    # Extract post data
                    post_data = self.extract_post_data(post_table, phpbb_thread_id)
                    if post_data:
                        posts_found.append(post_data)
                        if not forum_id:
                            # Use a default forum ID or try to determine from context
                            forum_id = self.historical_forum_id_offset + 1

                except Exception as e:
                    print(f"Error processing post in {file_path}: {e}")

            if posts_found:
                # Create thread data
                first_post = posts_found[0]
                thread = ThreadData(
                    thread_id=phpbb_thread_id,
                    forum_id=forum_id,
                    thread_title=f"[2004] {thread_title}",
                    thread_starter=first_post.user_id,
                    thread_time=first_post.post_time,
                    thread_posts=len(posts_found),
                    thread_views=0,
                    is_historical=True
                )

                self.threads[phpbb_thread_id] = thread

                # Add all posts
                for post in posts_found:
                    self.posts[post.post_id] = post

                print(f"Processed thread: {thread.thread_title} ({len(posts_found)} posts)")

        except Exception as e:
            print(f"Error processing thread file {file_path}: {e}")

    def extract_post_data(self, post_table, thread_id: int) -> Optional[PostData]:
        """Extract post data from a post table"""
        try:
            # Generate post ID
            post_id = self.historical_post_id_offset + len(self.posts) + 1

            # Extract username
            username_link = post_table.find('a', href=re.compile(r'member\.php.*uid=\d+'))
            username = "Anonymous"
            user_id = self.historical_user_id_offset

            if username_link:
                username = username_link.get_text().strip()
                # Extract user ID from href
                uid_match = re.search(r'uid=(\d+)', username_link.get('href', ''))
                if uid_match:
                    vb_user_id = int(uid_match.group(1))
                    user_id = self.historical_user_id_offset + vb_user_id

                    # Create user if not exists
                    if user_id not in self.users:
                        user = UserData(
                            user_id=user_id,
                            username=f"[2004] {username}",
                            user_email=f"{username.lower().replace(' ', '_')}@2004forums.steam",
                            user_regdate=int(datetime.datetime(2004, 1, 1).timestamp()),
                            user_posts=1,
                            is_historical=True
                        )
                        self.users[user_id] = user

            # Extract post content
            post_content = ""
            content_cells = post_table.find_all('td', class_=lambda x: x and 'alt1' in x)
            for cell in content_cells:
                cell_text = self.clean_html_content(str(cell))
                if cell_text and len(cell_text) > 50:  # Likely post content
                    post_content = cell_text
                    break

            # Extract post date
            date_cells = post_table.find_all('td', class_=lambda x: x and 'thead' in x)
            post_time = int(datetime.datetime(2004, 1, 1).timestamp())
            for cell in date_cells:
                cell_text = cell.get_text()
                if re.search(r'\d{1,2}[-/]\d{1,2}[-/]\d{4}', cell_text):
                    post_time = self.extract_date_from_string(cell_text)
                    break

            return PostData(
                post_id=post_id,
                thread_id=thread_id,
                user_id=user_id,
                post_time=post_time,
                post_content=post_content or f"Historical post content from thread {thread_id}",
                post_subject="",
                poster_ip="127.0.0.1",
                is_historical=True
            )

        except Exception as e:
            print(f"Error extracting post data: {e}")
            return None

    def process_all_files(self):
        """Process all forum files"""
        print(f"Scanning directory: {self.forums_dir}")

        # First scan for attachments
        self.scan_attachment_files()

        # Process forum files
        for file_path in self.forums_dir.glob("forumid_*.php"):
            self.process_forum_file(file_path)

        # Process thread files
        for file_path in self.forums_dir.glob("thread_*.php"):
            self.process_thread_file(file_path)

        print(f"\nProcessing complete!")
        print(f"Forums: {len(self.forums)}")
        print(f"Users: {len(self.users)}")
        print(f"Threads: {len(self.threads)}")
        print(f"Posts: {len(self.posts)}")
        print(f"Attachments: {len(self.attachments)}")

    def generate_installation_sql(self, output_file: str):
        """Generate phpBB installation SQL with historical data"""
        sql_statements = []

        sql_statements.append("-- Historical Steam Forum Data (2004)")
        sql_statements.append("-- Generated on: " + datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"))
        sql_statements.append("-- This data only displays when using Steam 2003/2004 phpBB styles")
        sql_statements.append("")
        sql_statements.append("SET FOREIGN_KEY_CHECKS = 0;")
        sql_statements.append("")

        # Historical Users
        if self.users:
            sql_statements.append("-- Historical Users")
            user_values = []
            for user_id, user in self.users.items():
                username = user.username.replace("'", "\\'").replace('"', '\\"')
                email = user.user_email.replace("'", "\\'")
                location = user.user_location.replace("'", "\\'")
                signature = user.user_signature.replace("'", "\\'")

                user_values.append(
                    f"({user_id}, '{username}', '{email}', {user.user_regdate}, "
                    f"{user.user_posts}, '{location}', '{signature}', 1)"
                )

            if user_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_users (user_id, username, user_email, user_regdate, user_posts, user_from, user_sig, is_historical) VALUES")
                sql_statements.append(",\n".join(user_values) + ";")
            sql_statements.append("")

        # Historical Forums
        if self.forums:
            sql_statements.append("-- Historical Forums")
            forum_values = []
            for forum_id, forum in self.forums.items():
                name = forum.forum_name.replace("'", "\\'").replace('"', '\\"')
                desc = forum.forum_desc.replace("'", "\\'").replace('"', '\\"')

                forum_values.append(
                    f"({forum_id}, '{name}', '{desc}', {forum.parent_id}, 1)"
                )

            if forum_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, is_historical) VALUES")
                sql_statements.append(",\n".join(forum_values) + ";")
            sql_statements.append("")

        # Historical Threads (Topics)
        if self.threads:
            sql_statements.append("-- Historical Threads")
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

        # Historical Attachments
        if self.attachments:
            sql_statements.append("-- Historical Attachments")
            attachment_values = []
            for attach_id, attachment in self.attachments.items():
                real_filename = attachment.real_filename.replace("'", "\\'").replace('"', '\\"')
                physical_filename = attachment.physical_filename.replace("'", "\\'").replace('"', '\\"')
                comment = attachment.attach_comment.replace("'", "\\'").replace('"', '\\"')
                mimetype = attachment.mimetype.replace("'", "\\'")

                attachment_values.append(
                    f"({attach_id}, {attachment.post_msg_id}, '{real_filename}', '{comment}', "
                    f"'{physical_filename}', {attachment.filesize}, {attachment.filetime}, "
                    f"'{mimetype}', '{attachment.extension}', 1)"
                )

            if attachment_values:
                sql_statements.append("INSERT IGNORE INTO phpbb_attachments (attach_id, post_msg_id, real_filename, attach_comment, physical_filename, filesize, filetime, mimetype, extension, is_historical) VALUES")
                sql_statements.append(",\n".join(attachment_values) + ";")
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
        print(f"  Historical Attachments: {len(self.attachments)}")

def main():
    if len(sys.argv) < 2:
        print("Usage: python vbulletin_parser_historical_with_attachments.py <forums_directory> [output_file]")
        print("Example: python vbulletin_parser_historical_with_attachments.py ./forums historical_forum_data.sql")
        sys.exit(1)

    forums_dir = sys.argv[1]
    output_file = sys.argv[2] if len(sys.argv) > 2 else "historical_forum_data_with_attachments.sql"

    if not os.path.exists(forums_dir):
        print(f"Error: Forums directory '{forums_dir}' does not exist")
        sys.exit(1)

    parser = HistoricalVBulletinParser(forums_dir)
    parser.process_all_files()
    parser.generate_installation_sql(output_file)

if __name__ == "__main__":
    main()