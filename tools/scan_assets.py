import os
import re
import ast

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
ARCH = os.path.join(ROOT, 'archived_steampowered')
MOVE_SCRIPT = os.path.join(ROOT, 'tools', 'move_assets.py')

# pattern for direct asset references
ASSET_RE = re.compile(r"archived_steampowered/[^\"'\s>]+\.(?:gif|jpg|jpeg|png|css|js)", re.I)
# pattern for str_replace directories e.g. str_replace('images/','/archived.../images/', $html)
DIR_RE = re.compile(r"str_replace\('[^']*','(/archived_steampowered/[^']+)',")

assets = {}

for base, _, files in os.walk(ROOT):
    for fname in files:
        if not fname.lower().endswith(('.php', '.html', '.htm', '.js', '.css')):
            continue
        path = os.path.join(base, fname)
        try:
            text = open(path, 'r', errors='ignore').read()
        except Exception:
            continue
        for match in ASSET_RE.findall(text):
            assets[match] = None
        for match in DIR_RE.findall(text):
            d = os.path.join(ROOT, match.lstrip('/'))
            if os.path.isdir(d):
                for root2, _, files2 in os.walk(d):
                    for f in files2:
                        if f.lower().endswith(('.gif','.jpg','.jpeg','.png','.css','.js')):
                            rel = os.path.relpath(os.path.join(root2,f), ROOT).replace('\\','/')
                            assets[rel] = None

# compute destinations
def compute_dest(src):
    parts = src.split('/')
    if len(parts) < 3:
        return None
    year = parts[1]
    variant = parts[2]
    if re.fullmatch(r"v\d+", variant):
        rest = '/'.join(parts[3:])
        return f'themes/{year}_{variant}/assets/{rest}'
    if variant == 'storefront':
        rest = '/'.join(parts[4:])
        return f'img/storefront/{rest}'
    return None

for src in list(assets.keys()):
    dest = compute_dest(src)
    if dest:
        assets[src] = dest
    else:
        del assets[src]

# parse current move_assets.py
with open(MOVE_SCRIPT, 'r', encoding='utf-8') as f:
    data = f.read()
match = re.search(r"ASSETS\s*=\s*(\{[\s\S]*?\})", data)
existing = ast.literal_eval(match.group(1)) if match else {}
updated = existing.copy()
updated.update({k:v for k,v in assets.items() if v})

# build dictionary text
lines = ["ASSETS = {"]
for k,v in sorted(updated.items()):
    lines.append(f"    '{k}': '{v}',")
lines.append("}")
new_dict = '\n'.join(lines) + '\n'

# replace in file
new_data = re.sub(r"ASSETS\s*=\s*\{[\s\S]*?\}\s*", new_dict, data)
with open(MOVE_SCRIPT, 'w', encoding='utf-8') as f:
    f.write(new_data)
print(f"Mapped {len(updated) - len(existing)} new assets.")
