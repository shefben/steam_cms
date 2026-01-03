#!/usr/bin/env python3
"""
Test script for VBulletin parsers

Quick validation of parser functionality with sample files.
"""

import sys
from pathlib import Path
from vbulletin_parser import VBulletinParser

def test_basic_parsing(forums_dir):
    """Test basic parsing functionality"""
    print("Testing VBulletin Parser...")

    forums_path = Path(forums_dir)
    if not forums_path.exists():
        print(f"Error: Directory {forums_dir} does not exist")
        return False

    parser = VBulletinParser(forums_dir)

    # Test with a single thread file
    thread_files = list(forums_path.glob("thread_*.php"))
    if not thread_files:
        print("No thread files found for testing")
        return False

    test_file = thread_files[0]
    print(f"Testing with file: {test_file.name}")

    try:
        thread_data, posts_data = parser.parse_thread_page(test_file)

        if thread_data:
            print(f"[SUCCESS] Successfully parsed thread: {thread_data.thread_title}")
            print(f"  Thread ID: {thread_data.thread_id}")
            print(f"  Forum ID: {thread_data.forum_id}")
            print(f"  Posts found: {len(posts_data)}")

            if posts_data:
                first_post = posts_data[0]
                print(f"  First post by user {first_post.user_id}")
                print(f"  Content preview: {first_post.post_content[:100]}...")

            return True
        else:
            print("[FAILED] Failed to parse thread data")
            return False

    except Exception as e:
        print(f"[ERROR] Error during parsing: {e}")
        return False

def main():
    if len(sys.argv) < 2:
        print("Usage: python test_parser.py <forums_directory>")
        sys.exit(1)

    forums_dir = sys.argv[1]

    if test_basic_parsing(forums_dir):
        print("\n✓ Parser test passed!")
        print("You can now run the full import with:")
        print(f"  python run_full_import.py {forums_dir}")
    else:
        print("\n✗ Parser test failed!")
        print("Check the error messages above and verify your forum files.")

if __name__ == "__main__":
    main()