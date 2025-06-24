import os
from bs4 import BeautifulSoup

NEWS_DIR = 'news_pages'
SQL_FILE = 'cms/install_news.sql'

insert_lines = []

for fname in sorted(os.listdir(NEWS_DIR)):
    if not fname.endswith('.php'):
        continue
    path = os.path.join(NEWS_DIR, fname)
    html = open(path, encoding='ISO-8859-1').read()
    if '<p><h3>' not in html:
        continue
    html = html.split('<p><h3>', 1)[1]
    html = '<p><h3>' + html
    if 'return to news page' in html:
        html = html.split('return to news page')[0]
    soup = BeautifulSoup(html, 'html.parser')
    h3 = soup.find('h3')
    if not h3:
        continue
    title = h3.get_text(strip=True)
    span = h3.find_next('span')
    if span:
        parts = span.get_text(' ', strip=True).split('·')
        date = parts[0].strip() if parts else ''
        author = parts[1].strip() if len(parts) > 1 else ''
    else:
        date = author = ''
    p = h3.parent
    for tag in p.find_all(['h3', 'span']):
        tag.extract()
    content = p.decode_contents().strip()
    news_id = fname[5:-4]
    def sqlesc(s):
        return s.replace("'", "''").replace("\n", "\\n")
    insert_lines.append(
        f"INSERT INTO news(id,title,author,date,content) VALUES ({news_id},'{sqlesc(title)}','{sqlesc(author)}','{sqlesc(date)}','{sqlesc(content)}');")
    with open(path, 'w', encoding='utf-8') as f:
        f.write(str(p))

with open(SQL_FILE, 'w', encoding='utf-8') as f:
    f.write('\n'.join(insert_lines) + '\n')
