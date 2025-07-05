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
    'archived_steampowered/2005/storefront/img/dash.gif': 'themes/2005_v2/assets/img/dash.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_left.gif': 'img/storefront/sp_bottom_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_bottom_right.gif': 'img/storefront/sp_bottom_right.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_left.gif': 'img/storefront/sp_top_left.gif',
    'archived_steampowered/2005/storefront/img/storefront/sp_top_right.gif': 'img/storefront/sp_top_right.gif',
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

