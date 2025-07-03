import re, pathlib, json, html

base = pathlib.Path('archived_steampowered/2005/storefront')
cat_html = base / 'browse_games_catagories.html'
all_html = base / 'all_games.html'
app_dir = base / 'app_pages'

html_cat = cat_html.read_text()
categories = re.findall(r'category=(\d+)&amp;">([^<]+)</a>', html_cat)
developers = [name for name,_ in re.findall(r'developer=([^&]+)&amp;">([^<]+)</a>', html_cat)]

html_all = all_html.read_text()
row_re = re.compile(r'<tr[^>]*id="row_(\d+)".*?>\s*(.*?)</tr>', re.DOTALL)
apps = []
for appid, row in row_re.findall(html_all):
    cells = re.findall(r'<td[^>]*>(.*?)</td>', row, re.DOTALL)
    if len(cells) >= 8:
        name = re.sub('<.*?>', '', cells[1]).strip()
        dev_raw = re.sub('<.*?>', '', cells[3]).strip()
        avail = re.sub('<.*?>', '', cells[5]).strip()
        price = re.sub('<.*?>', '', cells[7]).strip()
        price = '0' if price == '-' or not price else price.replace('$', '')
        dev = next((d for d in developers if d.startswith(dev_raw.replace('...', '').strip())), dev_raw)
        apps.append({"appid": int(appid), "name": name, "developer": dev, "availability": avail, "price": price})

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
    packs = []
    titles = re.findall(r'<span class="package_title">([^<]+)</span>', text)
    for i in range(0, len(titles)-1, 2):
        name = titles[i]
        price_txt = titles[i+1]
        if price_txt.startswith('$'):
            price_val = price_txt[1:]
            packs.append({"name": name, "price": price_val})
    if packs:
        app['packages'] = packs
    m = re.search(r'purchase_header">system Requirements</span><br>\s*<span[^>]*>(.*?)</span>', text, re.IGNORECASE | re.DOTALL)
    if m:
        req = html.unescape(re.sub('<.*?>', '', m.group(1))).strip()
        app['sysreq'] = req

out = []
out.append("CREATE TABLE store_categories(id INT PRIMARY KEY,name TEXT,ord INT,visible TINYINT DEFAULT 1);")
out.append("CREATE TABLE store_developers(id INT AUTO_INCREMENT PRIMARY KEY,name TEXT);")
out.append("CREATE TABLE store_apps(appid INT PRIMARY KEY,name TEXT,developer TEXT,availability TEXT,price DECIMAL(10,2),metacritic TEXT DEFAULT NULL,description TEXT,sysreq TEXT,images TEXT,packages TEXT);")
out.append("CREATE TABLE app_categories(appid INT,category_id INT,PRIMARY KEY(appid,category_id));")
for i, (cid, name) in enumerate(categories, 1):
    out.append(f"INSERT INTO store_categories(id,name,ord,visible) VALUES({cid},'{name.replace("'","''")}',{i},1);")
for name in developers:
    out.append(f"INSERT INTO store_developers(name) VALUES('{name.replace("'","''")}');")
for app in apps:
    desc = json.dumps(app.get('description',''))
    images = json.dumps(json.dumps(app.get('images', [])))
    packs = json.dumps(json.dumps(app.get('packages', [])))
    mscore = json.dumps(app.get('metacritic',''))
    sysreq = json.dumps(app.get('sysreq',''))
    out.append(
        f"INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,images,packages) "
        f"VALUES({app['appid']},{json.dumps(app['name'])},{json.dumps(app['developer'])},{json.dumps(app['availability'])},{app['price']},{mscore},{desc},{sysreq},{images},{packs});")

default_links = [
    {"type":"link","label":"Home","url":"index.php","hidden":0},
    {"type":"spacer","hidden":0},
    {"type":"link","label":"Browse Games","url":"index.php?area=browse&","hidden":0},
    {"type":"link","label":"All Games","url":"index.php?area=all&","hidden":0},
    {"type":"link","label":"Search","url":"index.php?area=search&","hidden":0},
    {"type":"spacer","hidden":0},
    {"type":"link","label":"Media","url":"index.php?Area=media&","hidden":0}
]
out.append("INSERT INTO settings(`key`,value) VALUES('store_links'," + json.dumps(json.dumps(default_links)) + ");")
featured = {"top":2400,"middle":380,"bottom_left":1200,"bottom_right":1300}
out.append("INSERT INTO settings(`key`,value) VALUES('store_featured'," + json.dumps(json.dumps(featured)) + ");")

pathlib.Path('sql/install_storefront.sql').write_text('\n'.join(out))
print('Wrote', len(out), 'lines to sql/install_storefront.sql')
