#!/usr/bin/env python3
"""
Complete VBulletin to phpBB Import Script

This script runs all the individual parsers in sequence to create
a complete import package for phpBB.
"""

import os
import sys
import datetime
import subprocess
from pathlib import Path

def run_command(cmd, description):
    """Run a command and handle errors"""
    print(f"\n{'='*60}")
    print(f"RUNNING: {description}")
    print(f"{'='*60}")

    try:
        result = subprocess.run(cmd, shell=True, check=True, capture_output=True, text=True)
        print("SUCCESS!")
        if result.stdout:
            print("Output:")
            print(result.stdout)
    except subprocess.CalledProcessError as e:
        print(f"ERROR: {e}")
        if e.stdout:
            print("STDOUT:")
            print(e.stdout)
        if e.stderr:
            print("STDERR:")
            print(e.stderr)
        return False
    return True

def create_installation_guide(output_dir: Path):
    """Create a comprehensive installation guide"""
    guide_content = f"""
# VBulletin to phpBB Import Guide

Generated on: {datetime.datetime.now()}

## Overview
This import package contains extracted data from VBulletin forums that has been
converted to phpBB-compatible SQL format.

## Files Generated

1. **forum_import.sql** - Main import file containing:
   - Forum categories and structures
   - User accounts
   - Topics/threads
   - Posts and replies

2. **memberlist_import.sql** - Additional user data from memberlist pages:
   - Enhanced user profiles
   - Registration dates
   - Post counts
   - Location information

3. **avatar_updates.sql** - Avatar assignments:
   - Links users to their avatar files
   - Sets avatar dimensions

4. **avatars/** - Avatar image files:
   - All user avatar images
   - Renamed for phpBB compatibility

5. **migrate_avatars.sh** - Avatar migration script

## Installation Steps

### Step 1: Prepare phpBB
1. Install phpBB 3.x on your server
2. Create a fresh database or backup existing data
3. Note your phpBB database credentials

### Step 2: Import Core Data
```sql
-- Connect to your phpBB database
mysql -u [username] -p [database_name]

-- Import main forum data
source forum_import.sql;

-- Import enhanced user data
source memberlist_import.sql;

-- Import avatar assignments
source avatar_updates.sql;
```

### Step 3: Migrate Avatars
```bash
# Copy avatar files to phpBB
chmod +x avatars/migrate_avatars.sh
./avatars/migrate_avatars.sh /path/to/phpbb/images/avatars/upload/
```

### Step 4: Post-Import Tasks

1. **Update Forum Statistics:**
```sql
-- Recalculate forum post/topic counts
UPDATE phpbb_forums SET
    forum_posts = (SELECT COUNT(*) FROM phpbb_posts WHERE forum_id = phpbb_forums.forum_id),
    forum_topics = (SELECT COUNT(*) FROM phpbb_topics WHERE forum_id = phpbb_forums.forum_id);

-- Update user post counts
UPDATE phpbb_users SET
    user_posts = (SELECT COUNT(*) FROM phpbb_posts WHERE poster_id = phpbb_users.user_id);
```

2. **Rebuild Search Index:**
   - Go to phpBB Admin Panel
   - Navigate to Maintenance → Database
   - Click "Rebuild search index"

3. **Clear Cache:**
   - Delete files in phpBB's cache/ directory
   - Or use Admin Panel → General → Purge cache

4. **Test Forum:**
   - Browse imported forums
   - Check that posts display correctly
   - Verify user profiles and avatars
   - Test posting new content

## Troubleshooting

### Import Errors
- Check for duplicate IDs if importing into existing phpBB
- Verify database character encoding (UTF-8 recommended)
- Check SQL syntax errors in import files

### Missing Avatars
- Verify avatar files copied to correct directory
- Check file permissions (web server needs read access)
- Confirm avatar SQL updates completed successfully

### Broken Posts
- Some HTML may need manual cleanup
- Check for unsupported BBCode from VBulletin
- Review posts with special characters

### User Issues
- Default password for imported users needs to be set
- Email addresses may need validation
- User groups may need manual assignment

## Additional Notes

- **Passwords**: Imported users will need to reset passwords as VB password hashes are incompatible
- **Permissions**: Review and set appropriate user/group permissions
- **Themes**: Styling will use your phpBB theme, not original VB appearance
- **Attachments**: File attachments are not included in this import
- **Private Messages**: PMs are not included in this basic import

## Statistics

Forums: See forum_import.sql for count
Users: See memberlist_import.sql for count
Topics: See forum_import.sql for count
Posts: See forum_import.sql for count
Avatars: Check avatars/ directory for count

## Support

This import script extracts data from archived VBulletin pages. Some data may be
incomplete due to the nature of HTML parsing. Review all imported content and
make manual adjustments as needed.

For phpBB support: https://www.phpbb.com/support/
For import script issues: Check the Python scripts and error logs
"""

    guide_path = output_dir / "IMPORT_GUIDE.txt"
    with open(guide_path, 'w', encoding='utf-8') as f:
        f.write(guide_content)

    print(f"Installation guide created: {guide_path}")

def main():
    if len(sys.argv) < 2:
        print("Usage: python run_full_import.py <forums_directory> [output_directory]")
        print()
        print("This script will:")
        print("1. Parse all forum data and generate SQL imports")
        print("2. Extract user data from memberlists")
        print("3. Process avatar files")
        print("4. Create a complete import package")
        print()
        print("Example: python run_full_import.py ./forums ./import_package")
        sys.exit(1)

    forums_dir = sys.argv[1]
    output_dir = Path(sys.argv[2] if len(sys.argv) > 2 else "vb_to_phpbb_import")

    if not os.path.exists(forums_dir):
        print(f"Error: Forums directory '{forums_dir}' does not exist")
        sys.exit(1)

    # Create output directory
    output_dir.mkdir(exist_ok=True)
    print(f"Output directory: {output_dir}")

    # Get script directory
    script_dir = Path(__file__).parent

    success = True

    # Step 1: Main forum import
    if success:
        success = run_command(
            f"python {script_dir}/vbulletin_parser.py {forums_dir} {output_dir}/forum_import.sql",
            "Parsing forums, threads, posts, and users"
        )

    # Step 2: Enhanced memberlist data
    if success:
        success = run_command(
            f"python {script_dir}/memberlist_parser.py {forums_dir} {output_dir}/memberlist_import.sql",
            "Extracting enhanced user data from memberlists"
        )

    # Step 3: Avatar processing
    if success:
        avatar_dir = output_dir / "avatars"
        success = run_command(
            f"python {script_dir}/avatar_signature_parser.py {forums_dir} {avatar_dir} {output_dir}/avatar_updates.sql",
            "Processing avatar files"
        )

    # Step 4: Create installation guide
    if success:
        create_installation_guide(output_dir)

    # Step 5: Create summary
    if success:
        print(f"\n{'='*60}")
        print("IMPORT PACKAGE COMPLETE!")
        print(f"{'='*60}")
        print(f"Location: {output_dir.absolute()}")
        print()
        print("Generated files:")
        for file_path in output_dir.glob("*"):
            if file_path.is_file():
                size = file_path.stat().st_size
                print(f"  {file_path.name} ({size:,} bytes)")
            elif file_path.is_dir():
                file_count = len(list(file_path.glob("*")))
                print(f"  {file_path.name}/ ({file_count} files)")
        print()
        print("Next steps:")
        print(f"1. Review IMPORT_GUIDE.txt in {output_dir}")
        print("2. Import SQL files into your phpBB database")
        print("3. Copy avatar files to phpBB installation")
        print("4. Test your imported forum!")

    else:
        print("\nImport failed! Check error messages above.")
        sys.exit(1)

if __name__ == "__main__":
    main()