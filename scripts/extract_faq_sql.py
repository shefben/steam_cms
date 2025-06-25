import os, re
from bs4 import BeautifulSoup

CAT_DIR = '.'
PAGE_DIR = 'faq_pages'
CAT_SQL = []
FAQ_SQL = []

# parse categories
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
    CAT_SQL.append(f"INSERT INTO faq_categories(id1,id2,name) VALUES ({id1},{id2},'{name.replace("'","''")}');")

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
    ul=soup.find('ul')
    em=ul.find('em') if ul else None
    title=em.get_text(strip=True) if em else fname
    body=''
    body_container=None
    if em:
        body_container=ul.find_next_sibling()
    if body_container:
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
    f.write('\n'.join(CAT_SQL+FAQ_SQL))
