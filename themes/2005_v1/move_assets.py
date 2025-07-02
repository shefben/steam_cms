import os, shutil, re

TEMPLATE = os.path.join(os.path.dirname(__file__), 'default_template.php')
ASSET_DIR = os.path.join(os.path.dirname(__file__), 'assets')
if not os.path.isdir(ASSET_DIR):
    os.makedirs(ASSET_DIR)

with open(TEMPLATE, 'r', encoding='utf-8') as f:
    data = f.read()

paths = set(re.findall(r'[\"\'](/[^\"\']+)', data))
root = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', '..'))

for p in paths:
    src = os.path.join(root, p.lstrip('/'))
    if os.path.exists(src):
        dst = os.path.join(ASSET_DIR, os.path.basename(p))
        shutil.copy2(src, dst)
        data = data.replace(p, 'assets/'+os.path.basename(p))

with open(TEMPLATE, 'w', encoding='utf-8') as f:
    f.write(data)
print('Assets moved. Update paths in template.')
