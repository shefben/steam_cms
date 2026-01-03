#!/usr/bin/env python3
"""
VBulletin Member List Parser

This script specifically parses memberlist pages to extract comprehensive user data
that might not be available in regular posts.
"""

import os
import re
import datetime
from pathlib import Path
from typing import Dict, List, Optional
from dataclasses import dataclass
from bs4 import BeautifulSoup

@dataclass
class MemberData:
    user_id: int
    username: str
    user_email: str = ""
    user_regdate: int = 0
    user_posts: int = 0
    user_location: str = ""
    user_signature: str = ""
    user_avatar: str = ""
    last_activity: int = 0
    user_title: str = ""

class MemberListParser:
    def __init__(self, forums_dir: str):
        self.forums_dir = Path(forums_dir)
        self.members = {}

    def parse_timestamp(self, timestamp_str: str) -> int:
        """Parse VBulletin timestamp format to Unix timestamp"""
        try:
            timestamp_str = timestamp_str.strip()

            # Common VB formats
            formats = [
                '%m-%d-%Y %I:%M %p',  # 07-03-2004 10:50 AM
                '%m-%d-%Y %H:%M',     # 07-03-2004 22:50
                '%Y-%m-%d %H:%M:%S',  # 2004-07-03 22:50:30
                '%m-%d-%Y',           # 07-03-2004
                '%Y-%m-%d'            # 2004-07-03
            ]

            for fmt in formats:
                try:
                    dt = datetime.datetime.strptime(timestamp_str, fmt)
                    return int(dt.timestamp())
                except ValueError:
                    continue

            return 0
        except Exception:
            return 0

    def extract_user_id_from_url(self, url: str) -> int:
        """Extract user ID from VBulletin profile URL"""
        match = re.search(r'userid=(\d+)', url)
        return int(match.group(1)) if match else 0

    def parse_memberlist_page(self, filepath: Path) -> List[MemberData]:
        """Parse a memberlist page to extract member information"""
        members = []

        try:
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Find member tables - VB usually uses tables for member listings
            member_tables = soup.find_all('table', {'cellpadding': '4'})

            for table in member_tables:
                rows = table.find_all('tr')

                for row in rows:
                    try:
                        cells = row.find_all('td')
                        if len(cells) < 3:  # Need at least username, posts, join date
                            continue

                        # Extract username and user ID
                        username_cell = None
                        user_id = 0
                        username = ""

                        for cell in cells:
                            # Look for profile links
                            profile_link = cell.find('a', href=re.compile(r'member\.php.*userid='))
                            if profile_link:
                                user_id = self.extract_user_id_from_url(profile_link.get('href', ''))
                                username = profile_link.get_text().strip()
                                username_cell = cell
                                break

                        if not username or not user_id:
                            continue

                        # Extract other data from cells
                        user_posts = 0
                        user_regdate = 0
                        user_location = ""
                        last_activity = 0
                        user_title = ""

                        cell_texts = [cell.get_text().strip() for cell in cells]

                        # Try to parse posts (usually a number)
                        for text in cell_texts:
                            if text.isdigit() and int(text) > 0:
                                user_posts = int(text)
                                break

                        # Try to parse join date
                        for text in cell_texts:
                            if re.search(r'\d{1,2}-\d{1,2}-\d{4}', text):
                                user_regdate = self.parse_timestamp(text)
                                break

                        # Look for location (usually contains common location words)
                        location_keywords = ['USA', 'UK', 'Canada', 'Germany', 'France', 'Australia']
                        for text in cell_texts:
                            if any(keyword.lower() in text.lower() for keyword in location_keywords):
                                user_location = text
                                break

                        # Extract user title (often near username)
                        if username_cell:
                            title_elem = username_cell.find('font', {'size': '1'})
                            if title_elem:
                                user_title = title_elem.get_text().strip()

                        member = MemberData(
                            user_id=user_id,
                            username=username,
                            user_posts=user_posts,
                            user_regdate=user_regdate,
                            user_location=user_location,
                            user_title=user_title,
                            last_activity=last_activity
                        )

                        members.append(member)

                    except Exception as e:
                        continue

        except Exception as e:
            print(f"Error parsing memberlist {filepath}: {e}")

        return members

    def parse_member_profile(self, filepath: Path) -> Optional[MemberData]:
        """Parse an individual member profile page"""
        try:
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()

            soup = BeautifulSoup(content, 'html.parser')

            # Extract user ID from URL or content
            user_id_match = re.search(r'userid=(\d+)', content)
            if not user_id_match:
                return None

            user_id = int(user_id_match.group(1))

            # Extract username (usually in title or header)
            username = ""
            title_tag = soup.find('title')
            if title_tag:
                title_text = title_tag.get_text()
                if 'Profile for' in title_text:
                    username = title_text.split('Profile for ')[-1].strip()
                elif ' - ' in title_text:
                    username = title_text.split(' - ')[0].strip()

            # Extract detailed profile information
            profile_text = soup.get_text()

            # Registration date
            user_regdate = 0
            reg_matches = re.findall(r'(?:Joined|Registered)[:\s]*(\d{1,2}[-/]\d{1,2}[-/]\d{4})', profile_text)
            if reg_matches:
                user_regdate = self.parse_timestamp(reg_matches[0])

            # Post count
            user_posts = 0
            posts_matches = re.findall(r'(?:Posts|Total Posts)[:\s]*(\d+)', profile_text)
            if posts_matches:
                user_posts = int(posts_matches[0])

            # Location
            user_location = ""
            location_matches = re.findall(r'Location[:\s]*([^\n\r]+)', profile_text)
            if location_matches:
                user_location = location_matches[0].strip()

            # Last activity
            last_activity = 0
            activity_matches = re.findall(r'Last Activity[:\s]*(\d{1,2}[-/]\d{1,2}[-/]\d{4}(?:\s+\d{1,2}:\d{2}(?:\s*[AP]M)?)?)', profile_text)
            if activity_matches:
                last_activity = self.parse_timestamp(activity_matches[0])

            # Email (often hidden, but sometimes visible)
            user_email = ""
            email_matches = re.findall(r'([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})', profile_text)
            if email_matches:
                user_email = email_matches[0]

            # Signature
            user_signature = ""
            sig_match = re.search(r'Signature[:\s]*([^\n\r]+(?:\n[^\n\r]+)*)', profile_text, re.MULTILINE)
            if sig_match:
                user_signature = sig_match.group(1).strip()

            return MemberData(
                user_id=user_id,
                username=username,
                user_email=user_email,
                user_regdate=user_regdate,
                user_posts=user_posts,
                user_location=user_location,
                user_signature=user_signature,
                last_activity=last_activity
            )

        except Exception as e:
            print(f"Error parsing member profile {filepath}: {e}")
            return None

    def process_all_memberlist_files(self):
        """Process all memberlist files"""
        print("Processing memberlist files...")

        # Process memberlist pages
        memberlist_files = list(self.forums_dir.glob("memberlist_*.php"))
        print(f"Found {len(memberlist_files)} memberlist files")

        for memberlist_file in memberlist_files:
            print(f"Processing: {memberlist_file.name}")
            members = self.parse_memberlist_page(memberlist_file)

            for member in members:
                if member.user_id not in self.members:
                    self.members[member.user_id] = member
                    print(f"  Added member: {member.username} (ID: {member.user_id})")
                else:
                    # Merge data if more complete
                    existing = self.members[member.user_id]
                    if member.user_posts > existing.user_posts:
                        existing.user_posts = member.user_posts
                    if member.user_regdate and not existing.user_regdate:
                        existing.user_regdate = member.user_regdate
                    if member.user_location and not existing.user_location:
                        existing.user_location = member.user_location

        # Process individual member profile files (if any)
        member_files = list(self.forums_dir.glob("member_*.php"))
        print(f"Found {len(member_files)} individual member files")

        for member_file in member_files:
            member = self.parse_member_profile(member_file)
            if member:
                if member.user_id not in self.members:
                    self.members[member.user_id] = member
                    print(f"Added detailed member: {member.username}")
                else:
                    # Merge more detailed data
                    existing = self.members[member.user_id]
                    if member.user_email:
                        existing.user_email = member.user_email
                    if member.user_signature:
                        existing.user_signature = member.user_signature
                    if member.last_activity:
                        existing.last_activity = member.last_activity

    def export_member_sql(self, output_file: str):
        """Export members as phpBB SQL"""
        print(f"\nExporting {len(self.members)} members to SQL...")

        sql_statements = []
        sql_statements.append("-- phpBB Members Import from VBulletin Memberlist")
        sql_statements.append(f"-- Generated on: {datetime.datetime.now()}")
        sql_statements.append("")

        # Update existing users with more complete data
        sql_statements.append("-- Update existing users with memberlist data")
        for user_id, member in self.members.items():
            updates = []

            if member.user_email:
                updates.append(f"user_email = '{member.user_email}'")
            if member.user_regdate:
                updates.append(f"user_regdate = {member.user_regdate}")
            if member.user_posts:
                updates.append(f"user_posts = {member.user_posts}")
            if member.user_location:
                location = member.user_location.replace("'", "\\'")
                updates.append(f"user_from = '{location}'")
            if member.user_signature:
                signature = member.user_signature.replace("'", "\\'")
                updates.append(f"user_sig = '{signature}'")
            if member.last_activity:
                updates.append(f"user_lastvisit = {member.last_activity}")

            if updates:
                sql_statements.append(f"UPDATE phpbb_users SET {', '.join(updates)} WHERE user_id = {user_id};")

        sql_statements.append("")
        sql_statements.append("-- Insert any new users found only in memberlist")

        member_values = []
        for user_id, member in self.members.items():
            username_clean = member.username.lower().replace(' ', '_')
            email = member.user_email or f"{username_clean}@example.com"
            signature = member.user_signature.replace("'", "\\'")
            location = member.user_location.replace("'", "\\'")

            member_values.append(
                f"({user_id}, '{member.username}', '{username_clean}', '{email}', "
                f"{member.user_regdate}, {member.user_posts}, '{signature}', '{location}', "
                f"{member.last_activity})"
            )

        if member_values:
            sql_statements.append("INSERT IGNORE INTO phpbb_users (user_id, username, username_clean, user_email, user_regdate, user_posts, user_sig, user_from, user_lastvisit) VALUES")
            sql_statements.append(",\n".join(member_values) + ";")

        with open(output_file, 'w', encoding='utf-8') as f:
            f.write("\n".join(sql_statements))

        print(f"Member SQL written to: {output_file}")

def main():
    import sys

    if len(sys.argv) < 2:
        print("Usage: python memberlist_parser.py <forums_directory> [output_file]")
        sys.exit(1)

    forums_dir = sys.argv[1]
    output_file = sys.argv[2] if len(sys.argv) > 2 else "memberlist_import.sql"

    parser = MemberListParser(forums_dir)
    parser.process_all_memberlist_files()
    parser.export_member_sql(output_file)

if __name__ == "__main__":
    main()