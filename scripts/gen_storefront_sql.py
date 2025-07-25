import re, pathlib, json, html
from collections import defaultdict

base = pathlib.Path('archived_steampowered/2005/storefront')
cat_html = base / 'browse_games_catagories.html'
all_html = base / 'all_games.html'
app_dir = base / 'app_pages'
cat_search_dir = base / 'search_catagory_pages'

html_cat = cat_html.read_text()
categories = {int(cid):name for cid,name in re.findall(r'category=(\d+)&amp;">([^<]+)</a>', html_cat)}
developers = [name for name,_ in re.findall(r'developer=([^&]+)&amp;">([^<]+)</a>', html_cat)]

# parse search-category pages to build app->category mapping
app_cat_map = {}
for page in cat_search_dir.glob('searchcategory_*.php'):
    text = page.read_text(errors='ignore')
    m = re.search(r'id="cat_list" value="(\d+)"\s+SELECTED>([^<]+)<', text)
    if not m:
        continue
    cid = int(m.group(1))
    cname = m.group(2).strip()
    if cid not in categories:
        categories[cid] = cname
    appids = re.findall(r'id="row_(\d+)"', text)
    for aid in appids:
        app_cat_map.setdefault(int(aid), set()).add(cid)

# parse metascore information from sorting page
meta_scores = {}
meta_file = base / 'all_misc_sorting_pages' / 'all_sort_Metascore_Developer_ASC.php'
if meta_file.exists():
    meta_text = meta_file.read_text()
    meta_text = re.sub(r'<!--.*?-->', '', meta_text, flags=re.DOTALL)
    row_re_ms = re.compile(r'<tr[^>]*id="row_(\d+)".*?>\s*(.*?)</tr>', re.DOTALL)
    for aid, row in row_re_ms.findall(meta_text):
        cells = re.findall(r'<td[^>]*>(.*?)</td>', row, re.DOTALL)
        if len(cells) >= 8:
            score = re.sub('<.*?>', '', cells[5]).strip()
            if score and score != '--':
                meta_scores[int(aid)] = score

subs = {}
sub_map = defaultdict(set)

html_all = all_html.read_text()
row_re = re.compile(r'<tr[^>]*id="row_(\d+)".*?>\s*(.*?)</tr>', re.DOTALL)
apps = []
for appid, row in row_re.findall(html_all):
    cells = re.findall(r'<td[^>]*>(.*?)</td>', row, re.DOTALL)
    if len(cells) >= 8:
        name = re.sub('<.*?>', '', cells[1]).strip()
        dev_raw = re.sub('<.*?>', '', cells[3]).strip()
        avail = re.sub('<.*?>', '', cells[5]).strip()
        price_text = re.sub('<.*?>', '', cells[7]).strip()
        price = price_text.replace('$', '') if price_text and price_text not in ('-', 'Third-party', 'Free', 'In account') else '0'
        dev = next((d for d in developers if d.startswith(dev_raw.replace('...', '').strip())), dev_raw)
        apps.append({
            "appid": int(appid),
            "name": name,
            "developer": dev,
            "availability": avail,
            "price": price,
            "metacritic": meta_scores.get(int(appid), '')
        })

# parse app pages for description, screenshots, packages and system requirements
for app in apps:
    f = app_dir / f"app_{app['appid']}.php"
    if not f.exists():
        continue
    text = f.read_text(errors='ignore')
    m = re.search(r'game_description.*?<span[^>]*>([^<]+)</span><br><br>(.*?)<br', text, re.DOTALL)
    if m:
        desc = html.unescape(re.sub('<.*?>', '', m.group(2))).strip()
        app['description'] = desc
    imgs = re.findall(r'screenshots/([0-9_]+_thumb.jpg)', text)
    if imgs:
        app['images'] = imgs
        app['main_image'] = imgs[0]
    packs = []
    for name, price_val, subid in re.findall(r'<span class="package_title">([^<]+)</span>.*?<span class="package_title">\$([0-9\.]+)</span>.*?steam://purchase/(\d+)', text, re.DOTALL):
        sub_id = int(subid)
        packs.append({"subid": sub_id, "name": name, "price": price_val})
        subs.setdefault(sub_id, {"name": name, "price": price_val})
        sub_map[sub_id].add(app['appid'])
    m = re.search(r'purchase_header">system Requirements</span><br>\s*<span[^>]*>(.*?)</span>', text, re.IGNORECASE | re.DOTALL)
    if m:
        req = html.unescape(re.sub('<.*?>', '', m.group(1))).strip()
        parts = re.split(r'Recommended:?\s*', req, flags=re.IGNORECASE)
        app['sysreq'] = req
        if len(parts) > 1:
            app['sysreq_min'] = parts[0].strip()
            app['sysreq_rec'] = parts[1].strip()
        else:
            app['sysreq_min'] = req
            app['sysreq_rec'] = ''
    if app['price'] == '0' and packs:
        try:
            app['price'] = str(min(float(p['price']) for p in packs))
        except ValueError:
            pass

out = []
out.append("CREATE TABLE store_categories(id INT PRIMARY KEY,name TEXT,ord INT,visible TINYINT DEFAULT 1);")
out.append("CREATE TABLE store_developers(id INT AUTO_INCREMENT PRIMARY KEY,name TEXT);")
out.append("CREATE TABLE store_apps(appid INT PRIMARY KEY,name TEXT,developer TEXT,availability TEXT,price DECIMAL(10,2),metacritic TEXT DEFAULT NULL,metacritic_url TEXT,description TEXT,sysreq TEXT,sysreq_min TEXT,sysreq_rec TEXT,trailer_url TEXT,hide_trailer TINYINT DEFAULT 0,main_image TEXT,images TEXT,show_metascore TINYINT DEFAULT 0,is_preload TINYINT DEFAULT 0,preload_start DATE DEFAULT NULL,preload_end DATE DEFAULT NULL);")
out.append("CREATE TABLE subscriptions(subid INT PRIMARY KEY,name TEXT,price DECIMAL(10,2));")
out.append("CREATE TABLE subscription_apps(subid INT,appid INT,PRIMARY KEY(subid,appid));")
out.append("CREATE TABLE app_categories(appid INT,category_id INT,PRIMARY KEY(appid,category_id));")
out.append("CREATE TABLE store_capsules(position VARCHAR(20) PRIMARY KEY, image TEXT, appid INT);")
for i, (cid, name) in enumerate(categories.items(), 1):
    out.append(
        f"INSERT INTO store_categories(id,name,ord,visible) "
        f"VALUES({cid},'{name.replace("'","''")}',{i},1);"
    )
for name in developers:
    out.append(f"INSERT INTO store_developers(name) VALUES('{name.replace("'","''")}');")
for app in apps:
    desc = json.dumps(app.get('description',''))
    images = json.dumps(json.dumps(app.get('images', [])))
    mscore = json.dumps(app.get('metacritic',''))
    sysreq = json.dumps(app.get('sysreq',''))
    main_img = json.dumps(app.get('main_image',''))
    out.append(
        f"INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) "
        f"VALUES({app['appid']},{json.dumps(app['name'])},{json.dumps(app['developer'])},{json.dumps(app['availability'])},{app['price']},{mscore},{desc},{sysreq},{main_img},{images},0);")

for subid, info in sorted(subs.items()):
    out.append(f"INSERT INTO subscriptions(subid,name,price) VALUES({subid},{json.dumps(info['name'])},{info['price']});")
for subid, aids in sorted(sub_map.items()):
    for aid in sorted(aids):
        out.append(f"INSERT INTO subscription_apps(subid,appid) VALUES({subid},{aid});")

for aid, cids in sorted(app_cat_map.items()):
    for cid in sorted(cids):
        out.append(f"INSERT INTO app_categories(appid,category_id) VALUES({aid},{cid});")
featured = {"top":2400,"middle":380,"bottom_left":1200,"bottom_right":1300}
out.append("INSERT INTO settings(`key`,value) VALUES('store_featured'," + json.dumps(json.dumps(featured)) + ");")
out.append("INSERT INTO store_capsules(position,image,appid) VALUES"
            "('top','top/08_01_2006.png',2400),"
            "('middle','middle/08_01_2006.png',380),"
            "('bottom_left','bottom_left/08_01_2006.png',1200),"
            "('bottom_right','bottom_right/08_01_2006.png',1300);")

pathlib.Path('sql/install_storefront.sql').write_text('\n'.join(out))
print('Wrote', len(out), 'lines to sql/install_storefront.sql')
