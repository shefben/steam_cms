#!/usr/bin/env python3
"""
Continue processing URLs from wayback_game_appids_2007_2008.txt
Uses the enhanced parse_steam_wayback_urls_to_sql.py for modern Steam format parsing
Removes URLs from file after successful extraction
"""

import os
import sys
import time
import subprocess
from typing import List

def get_url_count(filename: str) -> int:
    """Count remaining URLs in file"""
    if not os.path.exists(filename):
        return 0
    
    with open(filename, 'r', encoding='utf-8', errors='ignore') as f:
        lines = [line.strip() for line in f if line.strip() and not line.startswith('#')]
    return len(lines)

def get_next_url(filename: str) -> str:
    """Get the first URL from file"""
    if not os.path.exists(filename):
        return ''
    
    with open(filename, 'r', encoding='utf-8', errors='ignore') as f:
        lines = f.readlines()
    
    for line in lines:
        line = line.strip()
        if line and not line.startswith('#'):
            return line
    return ''

def remove_first_url(filename: str):
    """Remove the first non-comment line from the file"""
    if not os.path.exists(filename):
        return
    
    with open(filename, 'r', encoding='utf-8', errors='ignore') as f:
        lines = f.readlines()
    
    # Find first non-comment line and remove it
    for i, line in enumerate(lines):
        if line.strip() and not line.strip().startswith('#'):
            lines.pop(i)
            break
    
    # Write back the remaining lines
    with open(filename, 'w', encoding='utf-8', errors='ignore') as f:
        f.writelines(lines)

def extract_app_id(url: str) -> str:
    """Extract AppId from URL"""
    import re
    match = re.search(r'AppId=(\d+)', url)
    return match.group(1) if match else 'unknown'

def main():
    urls_file = 'wayback_game_appids_2007_2008.txt'
    sql_output = 'sql/steam_games_continued_extraction.sql'
    temp_urls_file = 'temp_single_url.txt'
    
    print("=== Continuing Steam URL Processing ===")
    
    initial_count = get_url_count(urls_file)
    print(f"Initial URL count: {initial_count}")
    
    processed = 0
    failed = 0
    
    while True:
        current_url = get_next_url(urls_file)
        if not current_url:
            break
            
        app_id = extract_app_id(current_url)
        print(f"\nProcessing AppID {app_id}: {current_url}")
        
        # Write current URL to temp file for single processing
        with open(temp_urls_file, 'w', encoding='utf-8') as f:
            f.write(current_url + '\n')
        
        # Run the parser on single URL
        try:
            result = subprocess.run([
                sys.executable, 
                'parse_steam_wayback_urls_to_sql.py',
                temp_urls_file,
                f'temp_output_{app_id}.sql'
            ], capture_output=True, text=True, timeout=60)
            
            if result.returncode == 0:
                # Success - append to main SQL file
                temp_sql = f'temp_output_{app_id}.sql'
                if os.path.exists(temp_sql):
                    with open(temp_sql, 'r', encoding='latin-1', errors='ignore') as temp_f:
                        content = temp_f.read()
                    
                    if content.strip():  # Only append if there's actual content
                        with open(sql_output, 'a', encoding='latin-1', errors='ignore') as main_f:
                            main_f.write(f"\n-- AppID {app_id} extracted successfully\n")
                            main_f.write(content)
                            main_f.write("\n")
                        
                        processed += 1
                        print(f"✓ Successfully extracted data for AppID {app_id}")
                        
                        # Remove the URL from the file after successful extraction
                        remove_first_url(urls_file)
                    else:
                        print(f"✗ No data extracted for AppID {app_id}")
                        failed += 1
                        remove_first_url(urls_file)  # Remove anyway to avoid infinite loops
                    
                    # Clean up temp file
                    os.remove(temp_sql)
                else:
                    print(f"✗ No output file generated for AppID {app_id}")
                    failed += 1
                    remove_first_url(urls_file)
            else:
                print(f"✗ Parser failed for AppID {app_id}: {result.stderr}")
                failed += 1
                remove_first_url(urls_file)
                
        except subprocess.TimeoutExpired:
            print(f"✗ Timeout processing AppID {app_id}")
            failed += 1
            remove_first_url(urls_file)
        except Exception as e:
            print(f"✗ Error processing AppID {app_id}: {e}")
            failed += 1
            remove_first_url(urls_file)
        
        # Clean up temp files
        if os.path.exists(temp_urls_file):
            os.remove(temp_urls_file)
        
        # Progress update every 10 URLs
        if (processed + failed) % 10 == 0:
            remaining = get_url_count(urls_file)
            print(f"\nProgress: {processed} processed, {failed} failed, {remaining} remaining")
        
        # Brief pause to be respectful to servers
        time.sleep(2)
    
    final_count = get_url_count(urls_file)
    print(f"\n=== Processing Complete ===")
    print(f"URLs processed successfully: {processed}")
    print(f"URLs that failed: {failed}")
    print(f"URLs remaining: {final_count}")
    print(f"Total URLs processed: {initial_count - final_count}")
    print(f"SQL output written to: {sql_output}")

if __name__ == "__main__":
    main()