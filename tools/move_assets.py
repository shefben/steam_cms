"""Move archived assets to new theme folders"""
import os, shutil, re

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ASSETS = {
    'archived_steampowered/2006/v1/gfx/apps/1300/capsule_sm.jpg':
        'themes/2006_v1/assets/images/apps/1300/capsule_sm.jpg',
    'archived_steampowered/2007/v1/styles_global.css':
        'themes/2007_v1/css/styles_global.css',
    'archived_steampowered/2007/v1/styles_home.css':
        'themes/2007_v1/css/styles_home.css',
    'archived_steampowered/2007/v1/minmax.js':
        'themes/2007_v1/js/minmax.js',
    'archived_steampowered/2007/v1/cookies.js':
        'themes/2007_v1/js/cookies.js',
    'archived_steampowered/2007/v1/collapse.js':
        'themes/2007_v1/js/collapse.js',
    'archived_steampowered/2007/v1/swfobject.js':
        'themes/2007_v1/js/swfobject.js',
    'archived_steampowered/2007/v1/corners.js':
        'themes/2007_v1/js/corners.js',
    'archived_steampowered/2007/v1/favicon.ico':
        'themes/2007_v1/favicon.ico',
    'archived_steampowered/2007/v1/img/logo_steam_header.jpg':
        'themes/2007_v1/images/logo_steam_header.jpg',
    'archived_steampowered/2007/v1/img/btn/btn_getSteam_ovr.gif':
        'themes/2007_v1/images/btn/btn_getSteam_ovr.gif',
    'archived_steampowered/2007/v1/img/btn_right_wd_over.jpg':
        'themes/2007_v1/images/btn_right_wd_over.jpg',
    'archived_steampowered/2007/v1/img/img_footer_bg.jpg':
        'themes/2007_v1/images/img_footer_bg.jpg',
    'archived_steampowered/2007/v1/img/img_footer_l.jpg':
        'themes/2007_v1/images/img_footer_l.jpg',
    'archived_steampowered/2007/v1/img/img_footer_r.jpg':
        'themes/2007_v1/images/img_footer_r.jpg',
    'archived_steampowered/2007/v1/img/logo_valve_footer.jpg':
        'themes/2007_v1/images/logo_valve_footer.jpg',
    'archived_steampowered/2007/v1/img/ico/ico_arrow_blue.gif':
        'themes/2007_v1/images/ico/ico_arrow_blue.gif',
    'archived_steampowered/2007/v1/img/ico/ico_arrow_grey.gif':
        'themes/2007_v1/images/ico/ico_arrow_grey.gif',

    'archived_steampowered/2007/v2/styles_global.css':
        'themes/2007_v2/css/styles_global.css',
    'archived_steampowered/2007/v2/styles_home.css':
        'themes/2007_v2/css/styles_home.css',
    'archived_steampowered/2007/v2/minmax.js':
        'themes/2007_v2/js/minmax.js',
    'archived_steampowered/2007/v2/cookies.js':
        'themes/2007_v2/js/cookies.js',
    'archived_steampowered/2007/v2/collapse.js':
        'themes/2007_v2/js/collapse.js',
    'archived_steampowered/2007/v2/swfobject.js':
        'themes/2007_v2/js/swfobject.js',
    'archived_steampowered/2007/v2/corners.js':
        'themes/2007_v2/js/corners.js',
    'archived_steampowered/2007/v2/javascript.js':
        'themes/2007_v2/js/javascript.js',
    'archived_steampowered/2007/v2/favicon.ico':
        'themes/2007_v2/favicon.ico',
    'archived_steampowered/2007/v2/img/logo_steam_header.jpg':
        'themes/2007_v2/images/logo_steam_header.jpg',
    'archived_steampowered/2007/v2/img/btn/btn_getSteam_ovr.gif':
        'themes/2007_v2/images/btn/btn_getSteam_ovr.gif',
    'archived_steampowered/2007/v2/img/btn_right_wd_over.jpg':
        'themes/2007_v2/images/btn_right_wd_over.jpg',
    'archived_steampowered/2007/v2/img/img_footer_bg.jpg':
        'themes/2007_v2/images/img_footer_bg.jpg',
    'archived_steampowered/2007/v2/img/img_footer_l.jpg':
        'themes/2007_v2/images/img_footer_l.jpg',
    'archived_steampowered/2007/v2/img/img_footer_r.jpg':
        'themes/2007_v2/images/img_footer_r.jpg',
    'archived_steampowered/2007/v2/img/logo_valve_footer.jpg':
        'themes/2007_v2/images/logo_valve_footer.jpg',
    'archived_steampowered/2007/v2/img/ico/ico_arrow_blue.gif':
        'themes/2007_v2/images/ico/ico_arrow_blue.gif',
    'archived_steampowered/2007/v2/img/ico/ico_arrow_grey.gif':
        'themes/2007_v2/images/ico/ico_arrow_grey.gif',
    # storefront assets for theme 2005_v1
    'archived_steampowered/2005/v1/storefront.css':
        'themes/2005_v1/storefront/css/storefront.css',
    'archived_steampowered/2005/storefront/img/apps/metaCriticBase.jpg':
        'themes/2005_v1/storefront/images/img/apps/metaCriticBase.jpg',
    'archived_steampowered/2005/storefront/img/apps/metaCriticLogo.jpg':
        'themes/2005_v1/storefront/images/img/apps/metaCriticLogo.jpg',
    'archived_steampowered/2005/storefront/img/apps/metaCriticSpace.jpg':
        'themes/2005_v1/storefront/images/img/apps/metaCriticSpace.jpg',
    'archived_steampowered/2005/storefront/img/dash.gif':
        'themes/2005_v1/storefront/images/img/dash.gif',
    'archived_steampowered/2005/storefront/img/endcap_blue_l.gif':
        'themes/2005_v1/storefront/images/img/endcap_blue_l.gif',
    'archived_steampowered/2005/storefront/img/endcap_blue_r.gif':
        'themes/2005_v1/storefront/images/img/endcap_blue_r.gif',
    'archived_steampowered/2005/storefront/img/screenshots.jpg':
        'themes/2005_v1/storefront/images/img/screenshots.jpg',
    'archived_steampowered/2005/storefront/img/search_blue_left.gif':
        'themes/2005_v1/storefront/images/img/search_blue_left.gif',
    'archived_steampowered/2005/storefront/img/search_blue_left_top.gif':
        'themes/2005_v1/storefront/images/img/search_blue_left_top.gif',
    'archived_steampowered/2005/storefront/img/search_blue_right_top.gif':
        'themes/2005_v1/storefront/images/img/search_blue_right_top.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_left.gif':
        'themes/2005_v1/storefront/images/sp_bottom_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_right.gif':
        'themes/2005_v1/storefront/images/sp_bottom_right.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_left.gif':
        'themes/2005_v1/storefront/images/sp_top_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_right.gif':
        'themes/2005_v1/storefront/images/sp_top_right.gif',
    'archived_steampowered/2005/storefront/img/tab_left_gray.gif':
        'themes/2005_v1/storefront/images/img/tab_left_gray.gif',
    'archived_steampowered/2005/storefront/img/tab_left_red.gif':
        'themes/2005_v1/storefront/images/img/tab_left_red.gif',
    'archived_steampowered/2005/storefront/img/tab_middle_gray.gif':
        'themes/2005_v1/storefront/images/img/tab_middle_gray.gif',
    'archived_steampowered/2005/storefront/img/tab_middle_red.gif':
        'themes/2005_v1/storefront/images/img/tab_middle_red.gif',
    'archived_steampowered/2005/storefront/img/tab_right_gray.gif':
        'themes/2005_v1/storefront/images/img/tab_right_gray.gif',
    'archived_steampowered/2005/storefront/img/tab_right_red.gif':
        'themes/2005_v1/storefront/images/img/tab_right_red.gif',
    'archived_steampowered/2005/storefront/img/title_grey.jpg':
        'themes/2005_v1/storefront/images/img/title_grey.jpg',
    'archived_steampowered/2005/storefront/img/title_blue.jpg':
        'themes/2005_v1/storefront/images/img/title_blue.jpg',
    'archived_steampowered/2005/storefront/img/title_red.jpg':
        'themes/2005_v1/storefront/images/img/title_red.jpg',
    'archived_steampowered/2005/storefront/img/title_package.jpg':
        'themes/2005_v1/storefront/images/img/title_package.jpg',

    # general theme images for 2005_v1
    'archived_steampowered/2005/v1/img/getSteamNow.gif':
        'themes/2005_v1/images/getSteamNow.gif',
    'archived_steampowered/2005/v1/img/forums.gif':
        'themes/2005_v1/images/forums.gif',
    'archived_steampowered/2005/v1/img/news.gif':
        'themes/2005_v1/images/news.gif',
    'archived_steampowered/2005/v1/img/steam_logo_onblack.gif':
        'themes/2005_v1/images/steam_logo_onblack.gif',
    'archived_steampowered/2005/v1/img/valve_greenlogo.gif':
        'themes/2005_v1/images/valve_greenlogo.gif',
    'archived_steampowered/2005/v1/img/productpage/but_ihavesteam.gif':
        'themes/2005_v1/images/productpage/but_ihavesteam.gif',
    'archived_steampowered/2005/v1/img/productpage/VerticalRule.gif':
        'themes/2005_v1/images/productpage/VerticalRule.gif',
    'archived_steampowered/2005/v1/img/productpage/hed_preloaditnow!.gif':
        'themes/2005_v1/images/productpage/hed_preloaditnow!.gif',
    'archived_steampowered/2005/v1/img/productpage/screenthumbs_hl2.gif':
        'themes/2005_v1/images/productpage/screenthumbs_hl2.gif',
    'archived_steampowered/2005/v1/img/productpage/but_withsteam.gif':
        'themes/2005_v1/images/productpage/but_withsteam.gif',
    'archived_steampowered/2005/v1/img/productpage/but_withoutsteam.gif':
        'themes/2005_v1/images/productpage/but_withoutsteam.gif',
    'archived_steampowered/2005/v1/img/productpage/but_downloadsteam.gif':
        'themes/2005_v1/images/productpage/but_downloadsteam.gif',
    'archived_steampowered/2005/v1/img/square.gif':
        'themes/2005_v1/images/square.gif',
    'archived_steampowered/2005/v1/img/cafes.gif':
        'themes/2005_v1/images/cafes.gif',
    'archived_steampowered/2005/v1/img/support.gif':
        'themes/2005_v1/images/support.gif',
    'archived_steampowered/2005/v1/img/status.gif':
        'themes/2005_v1/images/status.gif',
}

# storefront assets used by the unified 04-05 storefront
for folder in ['images', 'gfx', 'img']:
    src_base = os.path.join(ROOT, 'archived_steampowered', '2004', 'storefront', folder)
    if not os.path.isdir(src_base):
        continue
    for root_dir, _, files in os.walk(src_base):
        for fname in files:
            src_path = os.path.join(root_dir, fname)
            rel_src = os.path.relpath(src_path, ROOT)
            sub_path = os.path.relpath(src_path, os.path.join(ROOT, 'archived_steampowered', '2004', 'storefront'))
            ASSETS[rel_src] = f"storefront/{sub_path}"
for src_rel, dest_rel in ASSETS.items():
    src = os.path.join(ROOT, src_rel)
    dest = os.path.join(ROOT, dest_rel)
    if not os.path.exists(src):
        print(f"Source missing: {src}")
        continue
    os.makedirs(os.path.dirname(dest), exist_ok=True)
    shutil.copy2(src, dest)
    print(f"Copied {src_rel} -> {dest_rel}")

# replicate storefront assets into the 2004 and 2005_v1 theme folders so the
# legacy storefront can serve them when those themes are active
sf_src = os.path.join(ROOT, 'storefront')
for root_dir, _, files in os.walk(sf_src):
    for fname in files:
        rel_path = os.path.relpath(os.path.join(root_dir, fname), sf_src)
        for theme in ['2004', '2005_v1']:
            dest = os.path.join(ROOT, 'themes', theme, 'storefront', rel_path)
            os.makedirs(os.path.dirname(dest), exist_ok=True)
            shutil.copy2(os.path.join(root_dir, fname), dest)
            print(f"Copied {rel_path} -> themes/{theme}/storefront/{rel_path}")

