"""Copy storefront assets from archived sources to live paths."""

import os, shutil

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ASSETS = {
    'archived_steampowered/2002/v2/Images/Bar_Contact.jpg': 'themes/2002_v2/assets/Images/Bar_Contact.jpg',
    'archived_steampowered/2002/v2/Images/Bar_GetAnswers.jpg': 'themes/2002_v2/assets/Images/Bar_GetAnswers.jpg',
    'archived_steampowered/2002/v2/Images/Bar_Instructions.jpg': 'themes/2002_v2/assets/Images/Bar_Instructions.jpg',
    'archived_steampowered/2002/v2/Images/Bar_TroubleShootng.jpg': 'themes/2002_v2/assets/Images/Bar_TroubleShootng.jpg',
    'archived_steampowered/2002/v2/Images/LOGO_Steam2.gif': 'themes/2002_v2/assets/Images/LOGO_Steam2.gif',
    'archived_steampowered/2002/v2/Images/SteamTM.jpg': 'themes/2002_v2/assets/Images/SteamTM.jpg',
    'archived_steampowered/2002/v2/Images/Type_SteamCommunity.jpg': 'themes/2002_v2/assets/Images/Type_SteamCommunity.jpg',
    'archived_steampowered/2002/v2/Images/Type_SupportSite2.jpg': 'themes/2002_v2/assets/Images/Type_SupportSite2.jpg',
    'archived_steampowered/2002/v2/Images/Type_Top5Bugs.jpg': 'themes/2002_v2/assets/Images/Type_Top5Bugs.jpg',
    'archived_steampowered/2002/v2/Images/Type_steampowered.gif': 'themes/2002_v2/assets/Images/Type_steampowered.gif',
    'archived_steampowered/2002/v2/Images/Valve_CircleR.gif': 'themes/2002_v2/assets/Images/Valve_CircleR.gif',
    'archived_steampowered/2003/v1/images/Bar_Contact.jpg': 'themes/2003_v1/assets/images/Bar_Contact.jpg',
    'archived_steampowered/2003/v1/images/Bar_GetAnswers.jpg': 'themes/2003_v1/assets/images/Bar_GetAnswers.jpg',
    'archived_steampowered/2003/v1/images/Bar_TroubleShootng.jpg': 'themes/2003_v1/assets/images/Bar_TroubleShootng.jpg',
    'archived_steampowered/2003/v1/images/Graphic_box.jpg': 'themes/2003_v1/assets/images/Graphic_box.jpg',
    'archived_steampowered/2003/v1/images/LOGO_Steam2.gif': 'themes/2003_v1/assets/images/LOGO_Steam2.gif',
    'archived_steampowered/2003/v1/images/SteamTM.jpg': 'themes/2003_v1/assets/images/SteamTM.jpg',
    'archived_steampowered/2003/v1/images/Type_SupportSite2.jpg': 'themes/2003_v1/assets/images/Type_SupportSite2.jpg',
    'archived_steampowered/2003/v1/images/Type_steampowered.gif': 'themes/2003_v1/assets/images/Type_steampowered.gif',
    'archived_steampowered/2003/v1/images/Valve_CircleR.gif': 'themes/2003_v1/assets/images/Valve_CircleR.gif',
    'archived_steampowered/2003/v1/steam.css': 'themes/2003_v1/assets/steam.css',
    'archived_steampowered/2005/v1/nav.js': 'themes/2005_v1/nav.js',
    'archived_steampowered/2005/v1/steampowered02.css': 'themes/2005_v1/steampowered02.css',
    'archived_steampowered/2005/v2/steampowered03.css': 'themes/2005_v2/steampowered03.css',
    'archived_steampowered/2005/storefront/img/dash.gif': 'themes/2005_v2/assets/img/dash.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_left.gif': 'img/storefront/sp_bottom_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_right.gif': 'img/storefront/sp_bottom_right.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_left.gif': 'img/storefront/sp_top_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_right.gif': 'img/storefront/sp_top_right.gif',
}

DIRS = {
    'archived_steampowered/2005/v1/img': 'themes/2005_v1/img',
    'archived_steampowered/2005/v2/img': 'themes/2005_v2/img',
    'archived_steampowered/2004/storefront/img': 'themes/2004/storefront/img',
    'archived_steampowered/2004/storefront/images': 'themes/2004/storefront/images',
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

for src_rel, dest_rel in DIRS.items():
    src = os.path.join(ROOT, src_rel)
    dest = os.path.join(ROOT, dest_rel)
    if not os.path.exists(src):
        print(f'Source dir missing: {src}')
        continue
    shutil.copytree(src, dest, dirs_exist_ok=True)
    print(f'Copied directory {src_rel} -> {dest_rel}')

# Move storefront capsule images into consolidated folders
CAPS_SRC = os.path.join(ROOT, 'archived_steampowered/2005/storefront/capsules/img')
CAPS_DEST = os.path.join(ROOT, 'storefront/images/capsules')
for folder in os.listdir(CAPS_SRC):
    src_dir = os.path.join(CAPS_SRC, folder)
    if not os.path.isdir(src_dir):
        continue
    parts = folder.split('_')
    if len(parts) < 2:
        continue
    year = parts[0]
    month = parts[1].split('-')[0]
    date = f'{month}_01_{year}.png'
    for pos in ['top', 'middle', 'bottom_right', 'bottom_left']:
        src = os.path.join(src_dir, f'{pos}_capsule.png')
        if not os.path.exists(src):
            continue
        dest = os.path.join(CAPS_DEST, pos, date)
        os.makedirs(os.path.dirname(dest), exist_ok=True)
        shutil.copy2(src, dest)
        print(f'Copied {src} -> {dest}')

