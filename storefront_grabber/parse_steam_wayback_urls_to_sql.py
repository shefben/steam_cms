# parse_steam_wayback_urls_to_sql.py
# Python 3.9.13 (64-bit). Reads a text file of Wayback URLs (one per line),
# fetches HTML, extracts storefront data (2008-2009 era modern Steam format), 
# downloads images to gfx/apps/{appid}/ directories, and writes MySQL-ready SQL.
#
# Handles modern Steam store format with:
# - game_area_header, game_area_screenshots, game_area_purchase divs
# - game_area_description, game_area_sys_req_full, game_area_details
# - Comprehensive package extraction, image downloading, ESRB ratings
#
# Encoding: latin-1 for both I/O and HTML decode

import argparse
import html
import io
import os
import re
import sys
import time
import urllib.request
from typing import Dict, List, Optional, Tuple

# ---- Networking (requests) ----
try:
    import requests  # type: ignore
except Exception:
    requests = None

# ---- Optional robust parsing (BeautifulSoup), regex fallback always available ----
try:
    from bs4 import BeautifulSoup  # type: ignore
except Exception:
    BeautifulSoup = None

from collections import deque
import threading

MAX_CONCURRENT = 2
MAX_REQUESTS = 4  # Be more conservative with downloads
WINDOW = 10

sem = threading.Semaphore(MAX_CONCURRENT)

_request_times = deque()
_rate_lock = threading.Lock()

def _acquire_rate_slot():
    # Sliding-window limiter: allow at most MAX_REQUESTS timestamps in last WINDOW seconds
    while True:
        with _rate_lock:
            now = time.time()
            # drop expired timestamps
            while _request_times and (now - _request_times[0]) >= WINDOW:
                _request_times.popleft()
            if len(_request_times) < MAX_REQUESTS:
                _request_times.append(now)
                return
        time.sleep(0.2)

def download_image(url: str, local_path: str, max_retries: int = 3, wayback_ts: Optional[str] = None, fail_log_file: Optional[str] = None) -> bool:
    """Download image to local_path with retries.
       - Skips if already downloaded (by sanitized local filename)
       - Strips Wayback prefix if present for a clean origin URL
       - Drops query/fragment from the remote URL
       - Sanitizes the LOCAL filename (Windows-safe; no '?t=...' etc.)
       - If direct CDN fetch fails, tries Wayback fallback using the page's timestamp (wayback_ts) if provided
       - Appends failures to fail_log_file if provided
    """
    from urllib.parse import urlsplit, urlunsplit

    def _strip_wayback(u: str) -> str:
        # remove /web/<ts>(id_|im_|if_)?/ wrapper
        return re.sub(r'^https?://web\.archive\.org/web/\d+(?:[a-z_]+)?/', '', u, flags=re.I)

    def _drop_query_frag(u: str) -> str:
        try:
            p = urlsplit(u)
            return urlunsplit((p.scheme, p.netloc, p.path, '', ''))
        except Exception:
            return u.split('?', 1)[0].split('#', 1)[0]

    def _sanitize_name(name: str) -> str:
        # remove query/fragment from filename then strip Windows-invalid chars
        name = name.split('?', 1)[0].split('#', 1)[0]
        name = re.sub(r'[<>:"/\\|?*]', '_', name).rstrip('. ')
        if len(name) > 240:
            root, ext = os.path.splitext(name)
            name = root[:240 - len(ext)] + ext
        return name

    def _log_fail(msg: str):
        if not fail_log_file:
            return
        try:
            with io.open(fail_log_file, "a", encoding="latin-1", errors="ignore") as ff:
                ts = time.strftime("%m/%d/%Y %H:%M:%S")
                ff.write(f"[{ts}] {msg}\n")
        except Exception:
            pass

    # sanitize local filename
    save_dir = os.path.dirname(local_path)
    base = _sanitize_name(os.path.basename(local_path))
    save_path = os.path.join(save_dir, base)

    if os.path.exists(save_path):
        return True  # already downloaded

    os.makedirs(save_dir, exist_ok=True)

    # Prepare remote URL candidates
    origin = _drop_query_frag(_strip_wayback(url))
    candidates: List[str] = []

    if origin.startswith('http'):
        # Try HTTP first to avoid historical SSL issues, then HTTPS
        if origin.startswith('https://'):
            candidates.append('http://' + origin[len('https://'):])
            candidates.append(origin)
        else:
            candidates.append(origin)
            candidates.append('https://' + origin[len('http://'):])

        # Explicit cdn variants if host present
        if 'cdn.steampowered.com/' in origin:
            after = origin.split('cdn.steampowered.com/', 1)[1]
            candidates.extend([
                'http://cdn.steampowered.com/' + after,
                'https://cdn.steampowered.com/' + after,
            ])

    # Wayback fallbacks using timestamp from the page we're parsing (if provided)
    if wayback_ts and origin.startswith('http'):
        # Prefer image rewrite 'im_' for binary assets
        candidates.append(f'https://web.archive.org/web/{wayback_ts}im_/{origin}')
        # Generic (non-im_) playback as additional fallback
        candidates.append(f'https://web.archive.org/web/{wayback_ts}/{origin}')

    # Finally, also try the original URL verbatim (may already be an archived im_ URL)
    candidates.append(url)

    last_err: Optional[str] = None
    for try_url in candidates:
        if not try_url.startswith('http'):
            continue
        for attempt in range(max_retries):
            try:
                _acquire_rate_slot()
                req = urllib.request.Request(try_url, headers={
                    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Python/ImageDownloader'
                })
                with urllib.request.urlopen(req, timeout=15) as resp:
                    if getattr(resp, 'status', 200) == 200:
                        data = resp.read()
                        if len(data) > 200:  # avoid tiny error bodies
                            with open(save_path, 'wb') as f:
                                f.write(data)
                            print(f"  Downloaded: {os.path.basename(save_path)}")
                            return True
                    last_err = f"HTTP {getattr(resp, 'status', 0)}"
            except Exception as e:
                last_err = str(e)
                if attempt < max_retries - 1:
                    time.sleep(0.5)
                continue

    _log_fail(f"IMAGE FAIL\turl={url}\tlocal={save_path}\treason={last_err or 'unknown'}")
    print(f"  Failed to download {os.path.basename(save_path)}: {last_err or 'unknown'}")
    return False



# ----------------- helpers -----------------
MONTHS = {
    'january': '01','february': '02','march': '03','april': '04',
    'may': '05','june': '06','july': '07','august': '08',
    'september': '09','october': '10','november': '11','december': '12'
}

def sql_escape(s: str) -> str:
    # Use standard SQL single-quote escaping
    return s.replace("\\", "\\\\").replace("'", "''")

def norm_ws(s: str) -> str:
    return re.sub(r'\s+', ' ', s).strip()

APPID_PATH_RE = re.compile(r'/app/(\d+)(?:/|$)')

def extract_appid_from_input_url(url: str) -> Optional[str]:
    m = APPID_PATH_RE.search(url)
    return m.group(1) if m else None

def get_inner_html(el) -> str:
    # raw inner HTML (BeautifulSoup)
    return ''.join(str(c) for c in getattr(el, 'contents', []))

def filename_id(name: str) -> Optional[str]:
    # from 0000002746_thumb.jpg -> 0000002746
    m = re.search(r'(\d{5,})', name)
    return m.group(1) if m else None

def parse_release_date(raw: str) -> Optional[str]:
    if not raw:
        return None
    s = raw.strip()
    m = re.match(r'([A-Za-z]+)\s+(\d{1,2}),\s*(\d{4})', s)
    if m:
        mon = MONTHS.get(m.group(1).lower())
        day = int(m.group(2))
        year = m.group(3)
        if mon:
            return f"{year}-{mon}-{day:02d}"
    m = re.match(r'([A-Za-z]+)\s+(\d{4})', s)
    if m:
        mon = MONTHS.get(m.group(1).lower())
        year = m.group(2)
        if mon:
            return f"{year}-{mon}-01"
    m = re.match(r'(\d{4})$', s)
    if m:
        return f"{s}-01-01"
    m = re.match(r'(\d{4})-(\d{2})-(\d{2})$', s)
    if m:
        return s
    return None

def classify_link(url: str, text: str) -> str:
    u = (url or '').lower()
    t = (text or '').lower()
    if 'forums.steampowered.com' in u or 'forum' in u or 'forums' in t:
        return 'forum'
    if 'manual' in u or 'area=manual' in u or 'manual' in t:
        return 'manual'
    if 'stats' in u or 'area=stats' in u or 'stats' in t:
        return 'stats'
    if 'video' in u or 'area=game' in u and re.search(r'\bAppId=(90\d|91\d)\b', u):
        return 'video'
    if 'demo' in u or 'area=game' in u and re.search(r'\bAppId=219\b', u):
        return 'demo'
    if 'metacritic.com' in u:
        return 'critic'
    if 'valvesoftware.com' in u or 'half-life' in u or 'counter-strike' in u or 'dayofdefeat' in u:
        return 'website'
    return 'website'

def dedupe_preserve(seq: List[str]) -> List[str]:
    seen = set()
    out = []
    for x in seq:
        if x not in seen:
            seen.add(x)
            out.append(x)
    return out

def safe_get_text(el) -> str:
    if el is None:
        return ''
    return norm_ws(html.unescape(el.get_text(separator=' ')))


# ----------------- core parsing -----------------
def parse_with_bs4(html_text: str) -> Dict:
    soup = BeautifulSoup(html_text, 'html.parser')

    # Modern vs legacy detection
    is_modern_format = bool(soup.select('#game_area_header, #game_area_screenshots, #game_area_purchase'))

    # ---- Title: always from <title> ? "on Steam"
    title = ''
    page_title = soup.find('title')
    if page_title:
        t = safe_get_text(page_title)
        t = re.sub(r'^\s*Steam\s*-\s*', '', t, flags=re.I)
        t = re.sub(r'\s+on\s+Steam\s*$', '', t, flags=re.I)
        title = t.strip()

    # ---- AppID: keep old fallbacks, media pages, etc. (URL fallback handled in main)
    appid = None
    inp = soup.find('input', {'name': re.compile(r'^AppId$', re.I)})
    if inp and inp.has_attr('value') and (inp['value'] or '').isdigit():
        appid = inp['value']
    if not appid:
        m = re.search(r'gfx/apps/(\d+)/', html_text, flags=re.I)
        if m: appid = m.group(1)
    if not appid:
        m = re.search(r'[?&]AppId=(\d+)', html_text, flags=re.I)
        if m: appid = m.group(1)

    # ---- Header image (modern)
    header_img = ''
    header_image_url = ''
    if is_modern_format:
        hdr = soup.select_one('#game_area_header img, .game_header_image, .game_header_image img')
        if hdr and hdr.has_attr('src'):
            header_image_url = html.unescape(hdr['src'])
            header_img = 'header.jpg'  # normalize local name as requested
    else:
        brand = soup.select_one('.detail_brandArea img')
        if brand and brand.has_attr('src'):
            header_image_url = html.unescape(brand['src'])
            header_img = os.path.basename(header_image_url) or 'header.jpg'

    # ---- Screenshots (modern div) -> collect source URLs + filenames + IDs
    from urllib.parse import urlsplit  # ensure we strip ?t= cache-busters from names
    screenshots_info = []
    screenshot_urls = []
    if is_modern_format:
        for img in soup.select('#game_area_screenshots img'):
            src = html.unescape(img.get('src') or '')
            if not src:
                continue
            screenshot_urls.append(src)
            base = os.path.basename(urlsplit(src).path)
            base_full = re.sub(r'_thumb(\.\w+)$', r'\1', base, flags=re.I)
            sid = filename_id(base_full)
            screenshots_info.append({
                'id': sid,
                'filename': base_full,
                'thumb_filename': re.sub(r'(\.\w+)$', r'_thumb\1', base_full, flags=re.I),
                'src': src
            })
    else:
        for img in soup.select('.detail_screenArea img'):
            src = html.unescape(img.get('src') or '')
            if not src:
                continue
            base = os.path.basename(urlsplit(src).path)
            base_full = re.sub(r'_thumb(\.\w+)$', r'\1', base, flags=re.I)
            sid = filename_id(base_full)
            screenshots_info.append({
                'id': sid,
                'filename': base_full,
                'thumb_filename': re.sub(r'(\.\w+)$', r'_thumb\1', base_full, flags=re.I),
                'src': src
            })
            screenshot_urls.append(src)

    # ---- Description HTML (full inner HTML)
    about_html = ''
    if is_modern_format:
        desc = soup.select_one('#game_area_description.game_area_description')
        if desc:
            about_html = get_inner_html(desc).strip()
    else:
        # legacy ?About the Game? fallback
        about_html = ''
        about_header = soup.find(string=re.compile(r'\bAbout\s+the\s+Game\b', re.I))
        if about_header:
            cont = getattr(about_header, 'parent', None)
            if cont:
                about_html = ''.join(str(p) for p in cont.find_all(['p','ul','ol'], recursive=True))

    # Detect "About this video" (modern media/trailer pages)
    about_is_video = False
    h2 = soup.select_one('#game_area_description h2')
    if h2 and re.search(r'\bAbout\s+this\s+video\b', safe_get_text(h2), re.I):
        about_is_video = True

    # ---- System requirements (full HTML)
    sys_req_html = ''
    if is_modern_format:
        req = soup.select_one('#game_area_sys_req_full, .game_area_sys_req_full')
        if req:
            sys_req_html = get_inner_html(req).strip()
    else:
        req = soup.find(id=re.compile(r'^sys_req_content$', re.I))
        if req:
            sys_req_html = get_inner_html(req).strip()

    # ---- Purchase note
    purchase_note_html = ''
    pn = soup.select_one('#purchase_note')
    if pn:
        purchase_note_html = get_inner_html(pn).strip()

    # ---- Metascore & link (modern IDs)
    metascore = None
    metascore_url = ''
    ms = soup.select_one('#game_area_metascore')
    if ms:
        s = safe_get_text(ms)
        if s.isdigit():
            metascore = int(s)
    ml = soup.select_one('#game_area_metalink a[href*="metacritic"]')
    if ml and ml.has_attr('href'):
        metascore_url = ml['href']

    # ---- Genres, Dev/Publisher (+ URLs), Release date, Languages, Categories/specs
    details = soup.select_one('#game_area_details')
    genres, devs, pubs, dev_urls, pub_urls, languages, options = [], [], [], [], [], [], []

    if details:
        text_block = norm_ws(details.get_text(' '))

        # Genres
        for g in details.select('b:-soup-contains("Genre") + a, b:-soup-contains("Genres") + a'):
            gt = safe_get_text(g)
            if gt: genres.append(gt)
        for b in details.find_all('b'):
            if re.search(r'^\s*Genres?\s*:\s*$', safe_get_text(b), re.I):
                for a in b.find_all_next('a'):
                    if a.find_previous_sibling('br'):
                        break
                    t = safe_get_text(a)
                    if t: genres.append(t)

        # Developer(s)
        for b in details.find_all('b'):
            if re.search(r'^\s*Developer\s*:\s*$', safe_get_text(b), re.I):
                for a in b.find_all_next('a'):
                    if a.find_previous_sibling('br'):
                        break
                    t = safe_get_text(a); h = a.get('href') or ''
                    if t: devs.append(t)
                    if h: dev_urls.append(h)

        # Publisher(s)
        for b in details.find_all('b'):
            if re.search(r'^\s*Publisher\s*:\s*$', safe_get_text(b), re.I):
                for a in b.find_all_next('a'):
                    if a.find_previous_sibling('br'):
                        break
                    t = safe_get_text(a); h = a.get('href') or ''
                    if t: pubs.append(t)
                    if h: pub_urls.append(h)

        # Release date
        release_date = None
        m = re.search(r'\bRelease Date:\s*([A-Za-z0-9, ]+)', text_block, flags=re.I)
        if m:
            release_date = parse_release_date(m.group(1).strip())
        # Languages
        m = re.search(r'\bLanguages:\s*([A-Za-z0-9,\-\(\) ]+)', text_block, flags=re.I)
        if m:
            languages = [norm_ws(x) for x in m.group(1).split(',') if norm_ws(x)]

        # Specs (Single-player, Multi-player, Co-op, etc.)
        for spec in details.select('.game_area_details_specs'):
            t = safe_get_text(spec)
            if t: options.append(t)

    game_details = {
        'developer': dedupe_preserve(devs),
        'publisher': dedupe_preserve(pubs),
        'developer_urls': dedupe_preserve(dev_urls),
        'publisher_urls': dedupe_preserve(pub_urls),
        'release_date': release_date if 'release_date' in locals() else None,
        'languages': dedupe_preserve(languages),
        'options': dedupe_preserve(options),
        'genres': dedupe_preserve(genres),
        'packages': []
    }

    # ---- Packages/prices (both old and newer markup)
    purchase_area = soup.select_one('#game_area_purchase, .game_area_purchase')
    if purchase_area:
        for block in purchase_area.select('.game_area_purchase_game'):
            subid = None
            f = block.select_one('form input[name="subid"]')
            if f and f.has_attr('value') and f['value'].isdigit():
                subid = f['value']
            price = safe_get_text(block.select_one('.game_area_purchase_price')) or ''
            name = safe_get_text(block.select_one('h1')) or ''
            if name or price or subid:
                game_details['packages'].append({'sub_id': subid, 'name': name, 'price': price, 'discount': None})

        for package in purchase_area.select('.game_purchase_sub, .game_area_purchase_sub'):
            pkg = {'sub_id': None, 'name': '', 'price': '', 'discount': None}
            if package.has_attr('data-ds-subid'): pkg['sub_id'] = package['data-ds-subid']
            elif package.has_attr('data-subid'):  pkg['sub_id'] = package['data-subid']
            name_elem = package.select_one('.game_purchase_sub_name, h1')
            price_elem = package.select_one('.game_purchase_price, .discount_final_price')
            disc_elem = package.select_one('.discount_pct')
            if name_elem:  pkg['name'] = safe_get_text(name_elem)
            if price_elem: pkg['price'] = safe_get_text(price_elem)
            if disc_elem:
                m = re.search(r'(\d+)%', safe_get_text(disc_elem))
                if m: pkg['discount'] = int(m.group(1))
            if pkg['name'] or pkg['price'] or pkg['sub_id']:
                game_details['packages'].append(pkg)

    # ---- Media links (modern list with titles)
    media_links_title = []
    for a in soup.select('#game_area_media_list li a[href]'):
        media_links_title.append({'title': safe_get_text(a), 'url': a['href']})

    # ---- ?This Game? (demo/media/trailer pages) -> parent app + capsule image
    parent_appid = None
    capsule_image_url = ''
    hdr = soup.select_one('#game_area_details h2')
    if hdr and re.search(r'^\s*This Game\s*$', safe_get_text(hdr), re.I):
        a = hdr.find_next('a', href=True)
        if a:
            m = APPID_PATH_RE.search(a['href'])
            if m:
                parent_appid = m.group(1)
                img = a.find('img', src=True)
                if img:
                    capsule_image_url = html.unescape(img['src'])

    # ---- Mod website (green button)
    mod_url = ''
    mod_a = soup.select_one('.game_area_purchase_button a.btn_green[href^="http"]')
    if mod_a and re.search(r'\bvisit the website\b', safe_get_text(mod_a), re.I):
        mod_url = mod_a['href']

    # ---- ESRB via filename (same as before)
    esrb_rating = None
    for pattern, rating in {
        r'esrb_e\.': 'E', r'esrb_e10\+?\.': 'E10+', r'esrb_t\.': 'T',
        r'esrb_m\.': 'M', r'esrb_ao\.': 'AO', r'esrb_rp\.': 'RP'
    }.items():
        if re.search(pattern, html_text, re.I):
            esrb_rating = rating
            break

    # Modern media/trailer: either "This Game" block or "About this video" header
    is_media_modern = bool(parent_appid) or about_is_video

    return {
        'appid': appid,
        'title': title,
        'header_image_filename': header_img,
        'header_image_url': header_image_url,
        'screenshots_info': screenshots_info,
        'screenshot_urls': screenshot_urls,
        'metascore': metascore,
        'metascore_url': metascore_url,
        'about_html': about_html,
        'about_video_html': about_html if about_is_video else '',
        'media_links_title': media_links_title,
        'game_details': game_details,
        'sys_req_html': sys_req_html,
        'purchase_note_html': purchase_note_html,
        'trailer_appid': None,
        'esrb_rating': esrb_rating,
        'is_modern_format': is_modern_format,
        'is_media': is_media_modern,
        'media_kind': 'video' if about_is_video else ('media' if parent_appid else None),
        'parent_appid': parent_appid,
        'capsule_image_url': capsule_image_url,
        'mod_url': mod_url
    }



def parse_with_regex_only(html_text: str) -> Dict:
    def one(p, flags=0) -> Optional[str]:
        m = re.search(p, html_text, flags)
        return m.group(1) if m else None

    title = one(r'<title>(.*?)</title>', re.I | re.S) or ''
    title = re.sub(r'^\s*Steam\s*-\s*', '', html.unescape(title), flags=re.I).strip()

    appid = one(r'name=["\']AppId["\']\s+value=["\'](\d+)["\']', re.I)
    if not appid:
        m = re.search(r'gfx/apps/(\d+)/', html_text, flags=re.I)
        if m: appid = m.group(1)
    if not appid:
        m = re.search(r'[?&]AppId=(\d+)', html_text, flags=re.I)
        if m: appid = m.group(1)

    header_img = ''
    m = re.search(r'<div\s+class=["\']detail_brandArea["\'].*?<img[^>]+src=["\']([^"\']+)["\']', html_text, flags=re.I | re.S)
    if m:
        header_img = os.path.basename(m.group(1))

    screenshots: List[str] = []
    for m in re.finditer(r'class=["\']detail_screenArea["\'][\s\S]*?<img[^>]+src=["\']([^"\']+)["\']', html_text, flags=re.I):
        bn = os.path.basename(m.group(1))
        bn = re.sub(r'_thumb(\.jpg|\.jpeg|\.png)$', r'\1', bn, flags=re.I)
        screenshots.append(bn)
    screenshots = dedupe_preserve(screenshots)

    metascore = None
    m = re.search(r'class=["\']rightCol_2_top_mc["\'][^>]*>(\d{1,3})<', html_text, flags=re.I)
    if m:
        try: metascore = int(m.group(1))
        except: pass
    metascore_url = one(r'href=["\']([^"\']*metacritic\.com[^"\']*)["\']', re.I) or ''

    about = ''
    m = re.search(r'(About\s+the\s+Game).*?</div>\s*<p>(.*?)</p>', html_text, flags=re.I | re.S)
    if m:
        about = norm_ws(html.unescape(m.group(2)))

    # Media + Links
    media_links: List[Tuple[str, str]] = []
    media_block = re.search(r'id=["\']media_links_content["\'][\s\S]*?</div>\s*<script', html_text, flags=re.I)
    if media_block:
        block = media_block.group(0)
        for a in re.finditer(r'<a[^>]+href=["\']([^"\']+)["\'][^>]*>(.*?)</a>', block, flags=re.I | re.S):
            url = a.group(1)
            text = norm_ws(html.unescape(re.sub('<[^<]+?>', ' ', a.group(2))))
            media_links.append((classify_link(url, text), url))

    # Game details (approx)
    game_details = {'developer': [], 'publisher': [], 'release_date': None, 'languages': [], 'options': []}
    gd = re.search(r'id=["\']game_details_content["\'][\s\S]*?</div>\s*<script', html_text, flags=re.I)
    if gd:
        gdt = norm_ws(html.unescape(re.sub('<[^<]+?>', ' ', gd.group(0))))
        m = re.search(r'\bDeveloper\s*:\s*([^<\n]+)', gdt, flags=re.I)
        if m: game_details['developer'] = [norm_ws(x) for x in re.split(r',|;|\|', m.group(1)) if norm_ws(x)]
        m = re.search(r'\bPublisher\s*:\s*([^<\n]+)', gdt, flags=re.I)
        if m: game_details['publisher'] = [norm_ws(x) for x in re.split(r',|;|\|', m.group(1)) if norm_ws(x)]
        m = re.search(r'\bRelease\s*Date\s*:\s*([A-Za-z0-9, ]+)', gdt, flags=re.I)
        if m: game_details['release_date'] = parse_release_date(m.group(1).strip())
        m = re.search(r'\bLanguages\s*:\s*([A-Za-z0-9,\-\(\) ]+)', gdt, flags=re.I)
        if m: game_details['languages'] = [norm_ws(x) for x in m.group(1).split(',') if norm_ws(x)]
        opts = re.findall(r'(Single-player|Multi-player|Co-op|Valve Anti-Cheat(?: enabled)?|Friends enabled|Includes Source SDK|HDR available|Captions available|Steam Cloud|Steam Achievements)', gdt, flags=re.I)
        game_details['options'] = dedupe_preserve([re.sub(r'\s*enabled\s*$', '', o, flags=re.I).strip() for o in opts])

    is_media = _is_media_page_regex(html_text)
    parent_appid = _extract_parent_game_appid_regex(html_text) if is_media else None
    media_details = _extract_media_details_regex(html_text) if is_media else {}

    # System requirements
    sys_min = ''
    sys_rec = ''
    sys_block = re.search(r'id=["\']sys_req_content["\'][\s\S]*?</div>', html_text, flags=re.I)
    if sys_block:
        block = sys_block.group(0)
        m = re.search(r'<strong>\s*Minimum\s*:?\s*</strong>\s*([^<]+)', block, flags=re.I)
        if m: sys_min = norm_ws(html.unescape(m.group(1)))
        m = re.search(r'<strong>\s*Recommended\s*:?\s*</strong>\s*([^<]+)', block, flags=re.I)
        if m: sys_rec = norm_ws(html.unescape(m.group(1)))

    trailer_appid = None
    for pat in (r'appid=(\d+)', r'steam://run/(\d+)', r'/videos/(\d+)/', r'"trailerAppId"\s*:\s*"(\d+)"'):
        m = re.search(pat, html_text, flags=re.I)
        if m:
            trailer_appid = m.group(1)
            break

    return {
        'appid': appid, 'title': title,
        'header_image_filename': header_img,
        'screenshots': screenshots,
        'metascore': metascore, 'metascore_url': metascore_url,
        'about': about, 'media_links': media_links,
        'game_details': game_details,
        'sys_min': sys_min, 'sys_rec': sys_rec,
        'trailer_appid': trailer_appid,
        'is_media': is_media,
        'parent_appid': parent_appid,
        'media_details': media_details
    }

def _extract_parent_game_appid_regex(html_text: str) -> Optional[str]:
    m = re.search(r'class=["\']rightLink_game["\'][^>]*>\s*<span[^>]*>\s*<img[^>]+>\s*</span>\s*</a>\s*', html_text, flags=re.I)
    # Simpler and more tolerant: scan any anchor with area=game&AppId=
    m = re.search(r'href=["\'][^"\']*area=game[^"\']*AppId=(\d+)[^"\']*["\']', html_text, flags=re.I)
    return m.group(1) if m else None

def _extract_media_details_regex(html_text: str) -> dict:
    res = {
        'media_title': '',
        'producer': '',
        'media_release_date': None,
        'media_languages': [],
        'resolution': '',
        'length': '',
        'video_asset_path': ''
    }
    # Title :
    m = re.search(r'<strong>\s*Title\s*:\s*</strong>\s*([^<]+)<', html_text, flags=re.I)
    if m:
        res['media_title'] = norm_ws(html.unescape(m.group(1)))
    if not res['media_title']:
        t = re.search(r'<title>(.*?)</title>', html_text, flags=re.I|re.S)
        if t:
            res['media_title'] = re.sub(r'^\s*Steam\s*-\s*', '', norm_ws(html.unescape(t.group(1))), flags=re.I)

    # Producer :
    m = re.search(r'<strong>\s*Producer\s*:\s*</strong>\s*([^<]+)<', html_text, flags=re.I)
    if m:
        res['producer'] = norm_ws(html.unescape(m.group(1)))

    # Release Date :
    m = re.search(r'<strong>\s*Release\s*Date\s*:\s*</strong>\s*([^<]+)<', html_text, flags=re.I)
    if m:
        res['media_release_date'] = parse_release_date(norm_ws(html.unescape(m.group(1))))

    # Languages :
    m = re.search(r'<strong>\s*Languages\s*:\s*</strong>\s*([^<]+)<', html_text, flags=re.I)
    if m:
        res['media_languages'] = [norm_ws(x) for x in html.unescape(m.group(1)).split(',') if norm_ws(x)]

    # Resolution / Length (from spec boxes)
    m = re.search(r'>\s*Resolution\s*:\s*</strong>\s*([0-9xX ]+)\s*<', html_text, flags=re.I)
    if m:
        res['resolution'] = norm_ws(m.group(1).replace('x ', 'x').replace(' x', 'x'))
    m = re.search(r'>\s*Length\s*:\s*</strong>\s*([0-9:]+)\s*<', html_text, flags=re.I)
    if m:
        res['length'] = m.group(1).strip()

    # SWF fileID path
    m = re.search(r'new\s+SWFObject\("vid_ctn\.swf\?fileID=([^"&]+)', html_text, flags=re.I)
    if m:
        res['video_asset_path'] = m.group(1).strip()

    return res

def _is_media_page_regex(html_text: str) -> bool:
    if re.search(r'class=["\']rightCol_2_top_media["\'][^>]*style=["\'][^"\']*display:\s*block', html_text, flags=re.I):
        return True
    if re.search(r'>\s*Media\s+Details\s*<', html_text, flags=re.I):
        return True
    if re.search(r'class=["\']menu_item_current["\']>\s*<a[^>]+area=media', html_text, flags=re.I):
        return True
    if re.search(r'<title>[^<]*Trailer[^<]*</title>', html_text, flags=re.I):
        return True
    return False

def parse_single_html(html_text: str) -> Dict:
    if BeautifulSoup is not None:
        try:
            return parse_with_bs4(html_text)
        except Exception:
            pass
    return parse_with_regex_only(html_text)

def _extract_parent_game_appid_bs4(soup) -> Optional[str]:
    # ?This Game? block shows a rightLink_game anchor to the parent game
    link = soup.select_one('a.rightLink_game[href*="area=game"][href*="AppId="]')
    if link and link.has_attr('href'):
        m = re.search(r'[?&]AppId=(\d+)', link['href'], flags=re.I)
        if m:
            return m.group(1)
    # Sometimes it?s a sibling <a> with class rightLink_gameTitle or similar
    for a in soup.select('a[href*="area=game"][href*="AppId="]'):
        m = re.search(r'[?&]AppId=(\d+)', a.get('href') or '', flags=re.I)
        if m:
            return m.group(1)
    return None

def _extract_media_details_bs4(soup, html_text: str) -> dict:
    """
    Parse the ?Media Details? sidebar:
      - Title, Producer, Release Date, Languages
      - Spec boxes: Resolution, Length
      - Video asset path (SWFObject fileID=gfx/apps/904/?)
    """
    res = {
        'media_title': '',
        'producer': '',
        'media_release_date': None,
        'media_languages': [],
        'resolution': '',
        'length': '',
        'video_asset_path': ''
    }

    # Title (prefer sidebar Title :  ...; fallback page title)
    lbl = soup.find(string=re.compile(r'^\s*Title\s*:\s*$', re.I))
    if lbl and getattr(lbl, 'parent', None):
        sib = lbl.parent.next_sibling
        if sib:
            res['media_title'] = norm_ws(html.unescape(str(sib))).strip(' :')
    if not res['media_title']:
        t = soup.find('title')
        if t:
            res['media_title'] = re.sub(r'^\s*Steam\s*-\s*', '', safe_get_text(t), flags=re.I).strip()

    # Producer :
    gd = soup.find(id=re.compile(r'^game_details_content$', re.I)) or soup.find(id=re.compile(r'^game_details$', re.I))
    if gd:
        gdt = gd.get_text(separator=' ', strip=True)
        m = re.search(r'\bProducer\s*:\s*([^<\n]+)', gdt, flags=re.I)
        if m:
            res['producer'] = norm_ws(m.group(1))

        m = re.search(r'\bRelease\s*Date\s*:\s*([A-Za-z0-9, ]+)', gdt, flags=re.I)
        if m:
            res['media_release_date'] = parse_release_date(m.group(1).strip())

        m = re.search(r'\bLanguages\s*:\s*([A-Za-z0-9,\-\(\) ]+)', gdt, flags=re.I)
        if m:
            langs = [norm_ws(x) for x in m.group(1).split(',') if norm_ws(x)]
            res['media_languages'] = langs

        # Spec boxes: Resolution / Length
        for box in gd.select('.rightCol_2_specBox'):
            txt = safe_get_text(box)
            if not txt:
                continue
            m = re.search(r'\bResolution\s*:\s*([0-9xX ]+)', txt, flags=re.I)
            if m:
                res['resolution'] = norm_ws(m.group(1).replace('x ', 'x').replace(' x', 'x'))
            m = re.search(r'\bLength\s*:\s*([0-9:]+)', txt, flags=re.I)
            if m:
                res['length'] = m.group(1).strip()

    # Video SWF / file path (e.g., fileID=gfx/apps/904/)
    m = re.search(r'new\s+SWFObject\("vid_ctn\.swf\?fileID=([^"&]+)', html_text, flags=re.I)
    if m:
        res['video_asset_path'] = m.group(1).strip()

    return res

def _is_media_page_bs4(soup) -> bool:
    # ?rightCol_2_top_media? is visible on media pages
    el = soup.select_one('.rightCol_2_top_media')
    if el and ('display: block' in (el.get('style') or '').lower()):
        return True
    # Or the sidebar header literally says ?Media Details?
    hdr = soup.find(string=re.compile(r'\bMedia\s+Details\b', re.I))
    if hdr:
        return True
    # Or the left menu highlights Videos
    cur = soup.select_one('.leftMenu_2 .menu_item_current a')
    if cur and 'area=media' in (cur.get('href') or ''):
        return True
    # Or the title looks like a trailer
    t = soup.find('title')
    if t and re.search(r'\bTrailer\b', safe_get_text(t), flags=re.I):
        return True
    return False


# ----------------- SQL rendering to MATCH YOUR FORMAT -----------------
def render_games_insert(entry: Dict) -> str:
    """
    Build the INSERT IGNORE INTO games ... VALUES (...) with dynamic columns:
    - Always include: app_id, title
    - Add metascore + metascore_url if present
    - Add trailer_app_id if present
    - Always include about_game_description, header_image_filename at the end
    Column order matches your sample.
    """
    appid = entry.get('appid') or ''
    title = entry.get('title') or ''
    metascore = entry.get('metascore')
    metascore_url = entry.get('metascore_url') or ''
    trailer = entry.get('trailer_appid')
    about = entry.get('about_html') or entry.get('about') or ''  # prefer full HTML
    header_img = entry.get('header_image_filename') or ''

    cols = ['app_id', 'title']
    vals = [appid, f"'{sql_escape(title)}'"]

    if metascore is not None:
        cols += ['metascore', 'metascore_url']
        vals += [str(metascore), f"'{sql_escape(metascore_url)}'"]

    if trailer and str(trailer).isdigit():
        cols += ['trailer_app_id']
        vals += [str(trailer)]

    cols += ['about_game_description', 'header_image_filename']
    vals += [f"'{sql_escape(about)}'", f"'{sql_escape(header_img)}'"]

    return (
        "INSERT IGNORE INTO games (" + ", ".join(cols) + ") \n"
        "VALUES (" + ", ".join(vals) + ");\n"
    )

def render_trailer_sql(entry: Dict) -> str:
    """
    Build inserts for trailer/media pages:
      - Link to parent game in game_trailers
      - Trailer record with details
      - Trailer languages
      - Media links (using trailer_app_id as app_id for consistency)
    """
    trailer_id = entry.get('appid') or ''
    if not trailer_id:
        return ''
    md = entry.get('media_details') or {}
    title = md.get('media_title') or (entry.get('title') or '')
    producer = md.get('producer') or ''
    release_date = md.get('media_release_date')
    resolution = md.get('resolution') or ''
    length = md.get('length') or ''
    video_asset_path = md.get('video_asset_path') or ''
    header_img = entry.get('header_image_filename') or ''
    languages = md.get('media_languages') or []
    parent_appid = entry.get('parent_appid')
    media_links = entry.get('media_links') or []

    out = []
    out.append(f"-- Trailer: {sql_escape(title)} (Media App ID: {trailer_id})")

    # Link to parent game if known (app_id = game, trailer_app_id = this media)
    if parent_appid and str(parent_appid).isdigit():
        out.append(f"INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES ({parent_appid}, {trailer_id});")

    # Trailer master record
    rd = f"'{release_date}'" if release_date else "NULL"
    out.append(
        "INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)\n"
        f"VALUES ({trailer_id}, '{sql_escape(title)}', '{sql_escape(producer)}', {rd}, '{sql_escape(resolution)}', '{sql_escape(length)}', '{sql_escape(header_img)}', '{sql_escape(video_asset_path)}');\n"
    )

    # Trailer languages
    if languages:
        out.append("INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES ")
        vals = [f"({trailer_id}, (SELECT id FROM languages WHERE name = '{sql_escape(lang)}'))" for lang in languages]
        out.append(",\n".join(vals) + ";\n")

    # Media links (store under the trailer app id so they?re queryable)
    if media_links:
        out.append("INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES ")
        vals = [f"({trailer_id}, '{sql_escape(lt)}', '{sql_escape(url)}')" for (lt, url) in media_links]
        out.append(",\n".join(vals) + ";\n")

    return "\n".join(out) + "\n"

def render_sql_block(entry: Dict) -> str:
    appid = entry.get('appid') or ''
    title = entry.get('title') or ''
    if not appid or not title:
        return ''

    # Media/demo/trailer pages
    if entry.get('is_media'):
        # Modern media/trailer pages (About this video / This Game)
        if entry.get('is_modern_format'):
            parent_appid = entry.get('parent_appid')
            if not (parent_appid and str(parent_appid).isdigit()):
                # If we can't find a parent, do not emit a partial row
                return ''
            media_type = entry.get('media_kind') or 'media'
            desc_html = entry.get('about_video_html') or entry.get('about_html') or ''
            capsule_fn = os.path.basename(entry.get('capsule_image_url') or '') or ''
            capsule_sql = "NULL" if not capsule_fn else f"'{sql_escape(capsule_fn)}'"

            out: List[str] = []
            out.append(f"-- Media for parent App ID {parent_appid} (from page App ID: {appid})")

            # Link parent-child for traceability
            out.append(
                f"INSERT IGNORE INTO game_related (app_id, related_app_id, relation_type) "
                f"VALUES ({parent_appid}, {appid}, 'media_page');"
            )

            # Record the media entry under the parent game
            out.append(
                "INSERT IGNORE INTO game_media (app_id, media_type, description_html, capsule_image_filename) VALUES "
                f"({parent_appid}, '{sql_escape(media_type)}', '{sql_escape(desc_html)}', {capsule_sql});"
            )

            # Persist any media links list (with titles) under the parent app
            media_links_title = entry.get('media_links_title') or []
            if media_links_title:
                out.append("INSERT IGNORE INTO media_links (app_id, link_title, url) VALUES ")
                vals = [f"({parent_appid}, '{sql_escape(m['title'])}', '{sql_escape(m['url'])}')"
                        for m in media_links_title if m.get('url')]
                out.append(",\n".join(vals) + ";\n")

            out.append("")
            return "\n".join(out)

        # Legacy media/trailer page (old markup) -> use existing trailer writer
        return render_trailer_sql(entry)

    details = entry.get('game_details') or {}
    devs = details.get('developer') or []
    pubs = details.get('publisher') or []
    dev_urls = details.get('developer_urls') or []
    pub_urls = details.get('publisher_urls') or []
    release_date = details.get('release_date')
    languages = details.get('languages') or []
    options = details.get('options') or []
    packages = details.get('packages') or []
    genres = details.get('genres') or []

    sys_req_html = entry.get('sys_req_html') or ''
    purchase_note_html = entry.get('purchase_note_html') or ''
    media_links_title = entry.get('media_links_title') or []
    screenshots_info = entry.get('screenshots_info') or []
    esrb_rating = entry.get('esrb_rating')

    # Use full HTML description in games insert
    entry_for_games_insert = dict(entry)
    entry_for_games_insert['about'] = entry.get('about_html') or ''
    out: List[str] = []
    out.append(f"-- {sql_escape(title)} (App ID: {appid})")
    out.append(render_games_insert(entry_for_games_insert))

    # Developers/Publishers
    for d in devs:
        out.append(f"INSERT IGNORE INTO developers (name) VALUES ('{sql_escape(d)}');")
    for p in pubs:
        out.append(f"INSERT IGNORE INTO publishers (name) VALUES ('{sql_escape(p)}');")

    # Optional: store dev/publisher URLs (if you have auxiliary tables)
    for d in devs:
        for u in dev_urls:
            out.append(
                "INSERT IGNORE INTO developer_urls (developer_id, url) VALUES "
                f"((SELECT id FROM developers WHERE name = '{sql_escape(d)}'), '{sql_escape(u)}');"
            )
    for p in pubs:
        for u in pub_urls:
            out.append(
                "INSERT IGNORE INTO publisher_urls (publisher_id, url) VALUES "
                f"((SELECT id FROM publishers WHERE name = '{sql_escape(p)}'), '{sql_escape(u)}');"
            )

    # game_details (include ESRB rating if available)
    dev_id = f"(SELECT id FROM developers WHERE name = '{sql_escape(devs[0])}')" if devs else "NULL"
    pub_id = f"(SELECT id FROM publishers WHERE name = '{sql_escape(pubs[0])}')" if pubs else "NULL"
    rd = f"'{release_date}'" if release_date else "NULL"
    rating = f"'{sql_escape(esrb_rating)}'" if esrb_rating else "NULL"
    out.append(
        "\nINSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date, game_rating) \n"
        f"VALUES ({appid}, {dev_id}, {pub_id}, {rd}, {rating});\n"
    )

    # Genres
    if genres:
        for g in genres:
            out.append(f"INSERT IGNORE INTO genres (name) VALUES ('{sql_escape(g)}');")
        out.append("INSERT IGNORE INTO game_genres (app_id, genre_id) VALUES ")
        vals = [f"({appid}, (SELECT id FROM genres WHERE name = '{sql_escape(g)}'))" for g in genres]
        out.append(",\n".join(vals) + ";\n")

    # Languages
    if languages:
        out.append("INSERT IGNORE INTO game_languages (app_id, language_id) VALUES ")
        vals = [f"({appid}, (SELECT id FROM languages WHERE name = '{sql_escape(lang)}'))" for lang in languages]
        out.append(",\n".join(vals) + ";\n")

    # System requirements HTML (store as a single 'full_html' row)
    if sys_req_html:
        out.append(
            "INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES \n"
            f"({appid}, 'full_html', '{sql_escape(sys_req_html)}');\n"
        )

    # Purchase note
    if purchase_note_html:
        out.append(
            "INSERT IGNORE INTO game_purchase_notes (app_id, note_html) VALUES "
            f"({appid}, '{sql_escape(purchase_note_html)}');"
        )

    # Media + Links with titles
    if media_links_title:
        out.append("INSERT IGNORE INTO media_links (app_id, link_title, url) VALUES ")
        vals = [f"({appid}, '{sql_escape(m['title'])}', '{sql_escape(m['url'])}')" for m in media_links_title if m.get('url')]
        out.append(",\n".join(vals) + ";\n")
    mod_url = entry.get('mod_url') or ''
    if mod_url:
        out.append(
            "INSERT IGNORE INTO media_links (app_id, link_title, url) VALUES "
            f"({appid}, 'Mod website', '{sql_escape(mod_url)}');"
        )

    # Screenshots: filenames + derived image_ids
    if screenshots_info:
        out.append("INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES ")
        vals = [f"({appid}, '{sql_escape(s['filename'])}', {i})" for i, s in enumerate(screenshots_info)]
        out.append(",\n".join(vals) + ";\n")

        ids = [s['id'] for s in screenshots_info if s.get('id')]
        if ids:
            out.append("INSERT IGNORE INTO screenshot_ids (app_id, image_id) VALUES ")
            out.append(",\n".join(f"({appid}, '{sid}')" for sid in ids) + ";\n")

    # Options -> game_options
    for opt in options:
        out.append(
            "INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES "
            f"({appid}, '{sql_escape(opt)}', 'enabled');"
        )

    # Packages
    if packages:
        out.append("-- Package information")
        for pkg in packages:
            sub_id = pkg.get('sub_id') or 'NULL'
            pkg_name = sql_escape(pkg.get('name') or '')
            price = sql_escape(pkg.get('price') or '')
            discount = pkg.get('discount') or 'NULL'
            out.append(
                "INSERT IGNORE INTO game_packages (app_id, sub_id, package_name, price, discount_percent) VALUES "
                f"({appid}, {sub_id if str(sub_id).isdigit() else 'NULL'}, '{pkg_name}', '{price}', {discount});"
            )

    # If present, record ?This Game? parent link for regular pages (rare)
    parent_appid = entry.get('parent_appid')
    if parent_appid and str(parent_appid).isdigit():
        out.append(
            f"INSERT IGNORE INTO game_related (app_id, related_app_id, relation_type) "
            f"VALUES ({appid}, {parent_appid}, 'parent');"
        )

    out.append("")
    return "\n".join(out)



# ----------------- fetching -----------------
_DEFAULT_SESSION = None
_DEFAULT_UA = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) Python/3.9 WaybackParser"

def _get_session():
    global _DEFAULT_SESSION
    if _DEFAULT_SESSION is None:
        s = requests.Session()
        s.headers.update({"User-Agent": _DEFAULT_UA, "Accept": "text/html,*/*;q=0.8"})
        _DEFAULT_SESSION = s
    return _DEFAULT_SESSION

def fetch_url(url: str, timeout: float = 20.0, max_retries: int = 5, backoff: float = 1.5) -> Optional[str]:
    if requests is None:
        raise RuntimeError("Missing dependency: requests. Install with: pip install requests")

    sess = _get_session()
    err = None
    for i in range(max_retries):
        _acquire_rate_slot()  # <-- enforce 6 per 8s, globally
        try:
            r = sess.get(url, timeout=timeout, allow_redirects=True)
            if r.status_code == 200 and r.content:
                return r.content.decode('latin-1', errors='ignore')
            if r.status_code in (429, 503):
                time.sleep(backoff * (i + 1))
                continue
        except Exception as e:
            err = e
            time.sleep(backoff * (i + 1))
    sys.stderr.write(f"[WARN] Failed to fetch {url}: {err or 'HTTP ' + str(getattr(r,'status_code', 'n/a'))}\n")
    return None


# ----------------- main -----------------
def main():
    ap = argparse.ArgumentParser(description="Parse Steam Wayback product pages (URL list) to MySQL SQL matching sample format.")
    ap.add_argument("input_txt", help="Text file with one Wayback URL per line")
    ap.add_argument("output_sql", help="Output .sql file path")
    ap.add_argument("--cache_dir", default="", help="Optional: directory to cache raw HTML by AppId")
    ap.add_argument("--schema_file", default="steam_games_2007_schema.sql",
                    help="Schema file referenced in the header SOURCE line")
    args = ap.parse_args()

    if args.cache_dir:
        os.makedirs(args.cache_dir, exist_ok=True)

    # Derive failure logs next to the output SQL
    base_out, _ = os.path.splitext(args.output_sql)
    failed_images_path = base_out + "_failed_images.txt"
    failed_pages_path = base_out + "_failed_pages.txt"

    # Small helper to append to page failure log
    def _log_page_fail(reason: str, url: str):
        try:
            with io.open(failed_pages_path, "a", encoding="latin-1", errors="ignore") as ff:
                ts = time.strftime("%m/%d/%Y %H:%M:%S")
                ff.write(f"[{ts}] PAGE FAIL\t{reason}\t{url}\n")
        except Exception:
            pass

    # Header (match sample: title lines + SOURCE + generated timestamp)
    now_str = time.strftime("%m/%d/%Y %H:%M:%S")
    header = [
        "-- Steam Games 2007-2009 Data",
        "-- Extracted from Wayback Machine archives",
        f"-- Generated: {now_str}",
        "",
        f"SOURCE {args.schema_file};",
        "",
        "-- Data extraction begins",
        ""
    ]

    total = 0
    written = 0

    # Open output SQL and stream results as we parse (and while we download images)
    with io.open(args.output_sql, 'w', encoding='latin-1', errors='ignore') as f_out, \
         io.open(args.input_txt, 'r', encoding='latin-1', errors='ignore') as f_in:

        # write header immediately
        f_out.write("\n".join(header) + "\n")
        f_out.flush()

        for raw in f_in:
            url = raw.strip()
            if not url or url.startswith("#"):
                continue
            total += 1

            # Wayback timestamp from page URL (for image fallbacks)
            wb_ts = None
            m_ts = re.search(r'/web/(\d{14})', url)
            if m_ts:
                wb_ts = m_ts.group(1)

            # ----- CACHE READ (try by AppID from URL path OR query first) -----
            appid_hint = extract_appid_from_input_url(url)
            if not appid_hint:
                m_qs = re.search(r'[?&]AppId=(\d+)', url, flags=re.I)
                if m_qs:
                    appid_hint = m_qs.group(1)

            html_text = None
            cache_path = None
            if args.cache_dir and appid_hint:
                cache_path = os.path.join(args.cache_dir, f"{appid_hint}.html")
                if os.path.isfile(cache_path):
                    try:
                        html_text = io.open(cache_path, 'r', encoding='latin-1', errors='ignore').read()
                    except Exception:
                        html_text = None

            # ----- FETCH if not cached -----
            if html_text is None:
                html_text = fetch_url(url)
                if not html_text:
                    _log_page_fail("fetch_failed", url)
                    sys.stderr.write(f"[SKIP] No HTML for {url}\n")
                    continue

            # ----- PARSE -----
            data = parse_single_html(html_text)

            # Fallback: get appid from the input URL if parser couldn't find it
            if not data.get('appid'):
                a_from_url = extract_appid_from_input_url(url)
                if a_from_url:
                    data['appid'] = a_from_url

            # ----- CACHE WRITE (always attempt to cache using final appid) -----
            final_appid = data.get('appid') or appid_hint
            if args.cache_dir and final_appid:
                final_cache_path = os.path.join(args.cache_dir, f"{final_appid}.html")
                try:
                    # Write if not present or empty/tiny
                    needs_write = True
                    if os.path.exists(final_cache_path):
                        try:
                            if os.path.getsize(final_cache_path) > 200:
                                needs_write = False
                        except Exception:
                            needs_write = True
                    if needs_write:
                        io.open(final_cache_path, 'w', encoding='latin-1', errors='ignore').write(html_text)
                except Exception:
                    # best-effort cache; ignore failures
                    pass

            if not data.get('appid') or not (data.get('title') or '').strip():
                _log_page_fail("parse_missing_appid_or_title", url)
                sys.stderr.write(f"[WARN] Missing appid/title for {url}\n")
                continue

            # ----- WRITE SQL FIRST -----
            block = render_sql_block(data)
            if not block:
                _log_page_fail("empty_sql_block", url)
                sys.stderr.write(f"[WARN] Parsed empty for {url}\n")
                continue

            f_out.write(block + ("\n" if not block.endswith("\n") else ""))
            f_out.flush()
            written += 1

            # ----- DOWNLOAD ASSETS (skips if already present) -----
            app_id = data['appid']
            download_dir = f"gfx/apps/{app_id}"
            os.makedirs(download_dir, exist_ok=True)

            # Header -> save as header.jpg
            if data.get('header_image_url'):
                download_image(
                    data['header_image_url'],
                    f"{download_dir}/header.jpg",
                    wayback_ts=wb_ts,
                    fail_log_file=failed_images_path
                )

            # Screenshots -> download full + _thumb
            for s in data.get('screenshots_info', []):
                fn = s.get('filename')
                tfn = s.get('thumb_filename')
                src = s.get('src') or ''
                if not fn or not tfn:
                    continue
                # full
                full_url = re.sub(r'_thumb(\.\w+)$', r'\1', src, flags=re.I)
                download_image(
                    full_url,
                    f"{download_dir}/{fn}",
                    wayback_ts=wb_ts,
                    fail_log_file=failed_images_path
                )
                # thumb
                thumb_url = re.sub(r'(\.\w+)$', r'_thumb\1', full_url, flags=re.I)
                download_image(
                    thumb_url,
                    f"{download_dir}/{tfn}",
                    wayback_ts=wb_ts,
                    fail_log_file=failed_images_path
                )

            # If this is a demo/media page with a parent ?This Game?, also fetch the capsule into parent dir
            if data.get('is_media') and data.get('parent_appid') and data.get('capsule_image_url'):
                pdir = f"gfx/apps/{data['parent_appid']}"
                os.makedirs(pdir, exist_ok=True)
                cap_name = os.path.basename(re.sub(r'[?#].*$', '', data['capsule_image_url'])) or 'capsule.jpg'
                download_image(
                    data['capsule_image_url'],
                    f"{pdir}/{cap_name}",
                    wayback_ts=wb_ts,
                    fail_log_file=failed_images_path
                )

    sys.stdout.write(f"Processed URLs: {total}, wrote entries: {written}\n")


if __name__ == "__main__":
    main()
