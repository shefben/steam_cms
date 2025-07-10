"""Move archived assets to new theme folders"""
import os, shutil

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ASSETS = {
    'archived_steampowered/2006/v1/gfx/apps/1300/capsule_sm.jpg':
        'themes/2006_v1/assets/images/apps/1300/capsule_sm.jpg',
    'archived_steampowered/2007/v1/img/ico/ico_arrow_blue.gif':
        'themes/2007_v1/assets/images/ico/ico_arrow_blue.gif',
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
