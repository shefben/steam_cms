#!/usr/bin/env python3
"""
VBulletin Avatar and Signature Parser

This script specifically handles avatar files and signature extraction
from VBulletin forum archives.
"""

import os
import re
import shutil
import datetime
from pathlib import Path
from typing import Dict, List, Optional
from dataclasses import dataclass

@dataclass
class AvatarData:
    user_id: int
    avatar_filename: str
    avatar_width: int = 0
    avatar_height: int = 0

class AvatarSignatureParser:
    def __init__(self, forums_dir: str, avatar_output_dir: str = "avatars"):
        self.forums_dir = Path(forums_dir)
        self.avatar_output_dir = Path(avatar_output_dir)
        self.avatars = {}

        # Create avatar output directory
        self.avatar_output_dir.mkdir(exist_ok=True)

    def extract_user_id_from_avatar_filename(self, filename: str) -> int:
        """Extract user ID from avatar filename (e.g., avatar_12345.gif)"""
        match = re.search(r'avatar_(\d+)\.', filename)
        return int(match.group(1)) if match else 0

    def process_avatar_files(self):
        """Process all avatar files and copy them to phpBB format"""
        print("Processing avatar files...")

        # Find all avatar files
        avatar_files = list(self.forums_dir.glob("avatar_*.gif")) + \
                      list(self.forums_dir.glob("avatar_*.jpg")) + \
                      list(self.forums_dir.glob("avatar_*.png"))

        print(f"Found {len(avatar_files)} avatar files")

        for avatar_file in avatar_files:
            try:
                user_id = self.extract_user_id_from_avatar_filename(avatar_file.name)
                if not user_id:
                    continue

                # Get file extension
                file_ext = avatar_file.suffix.lower()

                # phpBB avatar naming convention
                phpbb_avatar_name = f"{user_id}_{avatar_file.name}"

                # Copy avatar to output directory
                output_path = self.avatar_output_dir / phpbb_avatar_name
                shutil.copy2(avatar_file, output_path)

                # Try to get image dimensions (requires PIL)
                width, height = 0, 0
                try:
                    from PIL import Image
                    with Image.open(avatar_file) as img:
                        width, height = img.size
                except ImportError:
                    print("PIL not available - cannot determine image dimensions")
                except Exception:
                    pass

                self.avatars[user_id] = AvatarData(
                    user_id=user_id,
                    avatar_filename=phpbb_avatar_name,
                    avatar_width=width,
                    avatar_height=height
                )

                print(f"Processed avatar for user {user_id}: {phpbb_avatar_name}")

            except Exception as e:
                print(f"Error processing avatar {avatar_file}: {e}")

    def extract_signatures_from_posts(self):
        """Extract signatures from post files"""
        print("Extracting signatures from posts...")

        signatures = {}

        # Process thread files to extract signatures
        thread_files = list(self.forums_dir.glob("thread_*.php"))

        for thread_file in thread_files:
            try:
                with open(thread_file, 'r', encoding='utf-8', errors='ignore') as f:
                    content = f.read()

                # Look for signature patterns
                # VB signatures are often in specific HTML patterns
                sig_patterns = [
                    r'<hr[^>]*>([^<]+(?:<[^>]+>[^<]*</[^>]+>[^<]*)*)',  # Content after HR
                    r'_________________+([^<\n]+)',  # Content after line of underscores
                    r'--\s*([^<\n]+(?:\n[^<\n]+)*)',  # Content after double dash
                ]

                # Extract user IDs and their potential signatures
                user_links = re.findall(r'userid=(\d+)', content)

                for pattern in sig_patterns:
                    sig_matches = re.findall(pattern, content, re.MULTILINE | re.DOTALL)

                    for match in sig_matches:
                        sig_text = re.sub(r'<[^>]+>', '', match).strip()
                        if len(sig_text) > 10 and len(sig_text) < 500:  # Reasonable signature length
                            # Try to associate with a user ID
                            for user_id in user_links:
                                user_id = int(user_id)
                                if user_id not in signatures or len(sig_text) > len(signatures[user_id]):
                                    signatures[user_id] = sig_text

            except Exception as e:
                continue

        return signatures

    def generate_avatar_sql(self, output_file: str):
        """Generate SQL for avatar updates"""
        print(f"\nGenerating avatar SQL for {len(self.avatars)} users...")

        sql_statements = []
        sql_statements.append("-- phpBB Avatar Updates from VBulletin")
        sql_statements.append(f"-- Generated on: {datetime.datetime.now()}")
        sql_statements.append("")
        sql_statements.append("-- Update user avatars")

        for user_id, avatar in self.avatars.items():
            avatar_filename = avatar.avatar_filename.replace("'", "\\'")

            sql_statements.append(
                f"UPDATE phpbb_users SET "
                f"user_avatar = '{avatar_filename}', "
                f"user_avatar_type = 1, "  # 1 = uploaded avatar
                f"user_avatar_width = {avatar.avatar_width}, "
                f"user_avatar_height = {avatar.avatar_height} "
                f"WHERE user_id = {user_id};"
            )

        sql_statements.append("")
        sql_statements.append("-- Instructions:")
        sql_statements.append(f"-- Copy avatar files from '{self.avatar_output_dir}' to your phpBB 'images/avatars/upload/' directory")

        with open(output_file, 'w', encoding='utf-8') as f:
            f.write("\n".join(sql_statements))

        print(f"Avatar SQL written to: {output_file}")
        print(f"Avatar files copied to: {self.avatar_output_dir}")
        print(f"Please copy avatar files to your phpBB images/avatars/upload/ directory")

    def create_avatar_migration_script(self):
        """Create a script to help migrate avatars to phpBB"""
        migration_script = f"""#!/bin/bash
# Avatar Migration Script for phpBB
# This script helps copy avatar files to the correct phpBB location

PHPBB_AVATAR_DIR="$1"

if [ -z "$PHPBB_AVATAR_DIR" ]; then
    echo "Usage: $0 <phpbb_avatars_directory>"
    echo "Example: $0 /var/www/phpbb/images/avatars/upload/"
    exit 1
fi

if [ ! -d "$PHPBB_AVATAR_DIR" ]; then
    echo "Error: phpBB avatar directory does not exist: $PHPBB_AVATAR_DIR"
    exit 1
fi

echo "Copying {len(self.avatars)} avatar files to phpBB..."

"""

        for user_id, avatar in self.avatars.items():
            migration_script += f'cp "{self.avatar_output_dir}/{avatar.avatar_filename}" "$PHPBB_AVATAR_DIR/"\n'

        migration_script += """
echo "Avatar migration complete!"
echo "Don't forget to run the avatar SQL updates on your phpBB database."
"""

        script_path = self.avatar_output_dir / "migrate_avatars.sh"
        with open(script_path, 'w') as f:
            f.write(migration_script)

        # Make script executable
        script_path.chmod(0o755)

        print(f"Avatar migration script created: {script_path}")

def main():
    import sys
    import datetime

    if len(sys.argv) < 2:
        print("Usage: python avatar_signature_parser.py <forums_directory> [avatar_output_dir] [sql_output_file]")
        sys.exit(1)

    forums_dir = sys.argv[1]
    avatar_output_dir = sys.argv[2] if len(sys.argv) > 2 else "avatars"
    sql_output_file = sys.argv[3] if len(sys.argv) > 3 else "avatar_updates.sql"

    parser = AvatarSignatureParser(forums_dir, avatar_output_dir)
    parser.process_avatar_files()
    parser.generate_avatar_sql(sql_output_file)
    parser.create_avatar_migration_script()

if __name__ == "__main__":
    main()