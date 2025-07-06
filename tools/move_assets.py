"""Move archived assets to new theme folders"""
import os, shutil

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ASSETS = {
    # 2005 storefront assets
    'archived_steampowered/2005/storefront/img/storefront/sp_top_left.gif': 'img/storefront/sp_top_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_right.gif': 'img/storefront/sp_top_right.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_left.gif': 'img/storefront/sp_bottom_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_right.gif': 'img/storefront/sp_bottom_right.gif',
    'archived_steampowered/2005/storefront/img/dash.gif': 'themes/2005_v2/assets/img/dash.gif',

    # 2006 theme assets
    'archived_steampowered/2006/v1/img': 'themes/2006_v1/assets/img',
    'archived_steampowered/2006/v1/gfx': 'themes/2006_v1/assets/gfx',
    'archived_steampowered/2006/v1/styles_global.css': 'themes/2006_v1/assets/css/styles_global.css',
    'archived_steampowered/2006/v1/styles_capsules.css': 'themes/2006_v1/assets/css/styles_capsules.css',
    'archived_steampowered/2006/v1/styles_content.css': 'themes/2006_v1/assets/css/styles_content.css',
    'archived_steampowered/2006/v2/img': 'themes/2006_v2/assets/img',
    'archived_steampowered/2006/v2/gfx': 'themes/2006_v2/assets/gfx',
    'archived_steampowered/2006/v2/styles_global.css': 'themes/2006_v2/assets/css/styles_global.css',
    'archived_steampowered/2006/v2/styles_capsules.css': 'themes/2006_v2/assets/css/styles_capsules.css',
    'archived_steampowered/2006/v2/styles_content.css': 'themes/2006_v2/assets/css/styles_content.css',

    # 2007 theme assets
    'archived_steampowered/2007/v1/img': 'themes/2007_v1/assets/img',
    'archived_steampowered/2007/v1/gfx': 'themes/2007_v1/assets/gfx',
    'archived_steampowered/2007/v1/styles_global.css': 'themes/2007_v1/assets/css/styles_global.css',
    'archived_steampowered/2007/v1/styles_home.css': 'themes/2007_v1/assets/css/styles_home.css',
    'archived_steampowered/2007/v2/img': 'themes/2007_v2/assets/img',
    'archived_steampowered/2007/v2/gfx': 'themes/2007_v2/assets/gfx',
    'archived_steampowered/2007/v2/styles_global.css': 'themes/2007_v2/assets/css/styles_global.css',
    'archived_steampowered/2007/v2/styles_home.css': 'themes/2007_v2/assets/css/styles_home.css',
}
for src_rel, dest_rel in ASSETS.items():
    src = os.path.join(ROOT, src_rel)
    dest = os.path.join(ROOT, dest_rel)
    if not os.path.exists(src):
        print(f"Source missing: {src}")
        continue
    os.makedirs(os.path.dirname(dest), exist_ok=True)
    shutil.copy2(src, dest)
    print(f"Copied {src_rel} -> {dest_rel}")
