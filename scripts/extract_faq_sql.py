import os, re
from bs4 import BeautifulSoup

CAT_DIR = '.'
PAGE_DIR = 'faq_pages'
CAT_SQL = {}
FAQ_SQL = []

# parse categories from legacy section pages if available
for fname in os.listdir(CAT_DIR):
    if not fname.startswith('faq_section_') or not fname.endswith('.php'):
        continue
    html=open(fname,encoding='ISO-8859-1').read()
    m=re.search(r'id=(\d+),(\d+)', html)
    if not m:
        continue
    id1,id2=m.group(1),m.group(2)
    soup=BeautifulSoup(html,'html.parser')
    h3=soup.find('h3')
    name=h3.get_text(strip=True) if h3 else fname
    CAT_SQL[f'{id1},{id2}'] = name

# parse faq pages
for fname in sorted(os.listdir(PAGE_DIR)):
    if not fname.startswith('faq_') or not fname.endswith('.php'):
        continue
    if re.match(r'faq[5-9]\.php', fname):
        continue
    parts=fname[4:-4].split(',')
    if len(parts)!=4:
        continue
    catid1,catid2,faqid1,faqid2=parts
    html=open(os.path.join(PAGE_DIR,fname),encoding='ISO-8859-1').read()
    soup=BeautifulSoup(html,'html.parser')
    h3=soup.find('h3')
    if h3:
        key=f"{catid1},{catid2}"
        CAT_SQL.setdefault(key, h3.get_text(strip=True))
    ul=soup.find('ul')
    em=ul.find('em') if ul else None
    body_container=None
    if em:
        body_container=ul.find_next_sibling()
    if not em or not body_container:
        continue
    title=em.get_text(strip=True)
    # remove footer part
    if body_container.find('p', style=re.compile('font-size')):
        body_container.find('p', style=re.compile('font-size')).decompose()
    for ret in body_container.find_all('a'):
        if 'Return to' in ret.get_text():
            ret.parent.decompose()
    body=body_container.decode_contents().strip()
    FAQ_SQL.append(f"INSERT INTO faq_content(catid1,catid2,faqid1,faqid2,title,body) VALUES ({catid1},{catid2},{faqid1},{faqid2},'{title.replace("'","''")}','{body.replace("'","''")}');")

# Write SQL output to the sql folder used during installation
output_path = os.path.join('sql','install_faq.sql')
with open(output_path,'w',encoding='utf-8') as f:
    for key,name in CAT_SQL.items():
        id1,id2=key.split(',')
        f.write(f"INSERT INTO faq_categories(id1,id2,name) VALUES ({id1},{id2},'{name.replace("'","''")}');\n")
    for line in FAQ_SQL:
        f.write(line+"\n")
