"""Copy storefront assets from archived sources to live paths."""

import os, shutil

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ASSETS = {
    'archived_steampowered/2005/storefront/img/storefront/sp_top_left.gif': 'img/storefront/sp_top_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_right.gif': 'img/storefront/sp_top_right.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_left.gif': 'img/storefront/sp_bottom_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_right.gif': 'img/storefront/sp_bottom_right.gif',
    'archived_steampowered/2005/storefront/img/dash.gif': 'themes/2005_v2/assets/img/dash.gif',
}

for src_rel, dest_rel in ASSETS.items():
    src = os.path.join(ROOT, src_rel)
    dest = os.path.join(ROOT, dest_rel)
    if not os.path.exists(src):
        print(f'Source missing: {src}')
        continue
    os.makedirs(os.path.dirname(dest), exist_ok=True)
    shutil.copy2(src, dest)
    print(f'Copied {src_rel} -> {dest_rel}')

