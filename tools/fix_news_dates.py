#!/usr/bin/env python3
import re
from datetime import datetime
from pathlib import Path

file = Path(__file__).resolve().parent.parent / 'sql' / 'install_news.sql'
content = file.read_text(encoding='utf-8')

pattern = re.compile(r"'([A-Za-z]+ \d{1,2}, \d{4}, \d{1,2}:\d{2} [ap]m)'")

def replace(match: re.Match) -> str:
    dt_str = match.group(1)
    dt = datetime.strptime(dt_str, '%B %d, %Y, %I:%M %p')
    return "'{}'".format(dt.strftime('%Y-%m-%d %H:%M:%S'))

new_content = pattern.sub(replace, content)
file.write_text(new_content, encoding='utf-8')
