#!/usr/bin/env python3
# Python 3.9+
import os
import shutil
import filecmp
from pathlib import Path
from datetime import datetime

# Common web image extensions; tweak if needed.
IMAGE_EXTS = {
    ".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp",
    ".svg", ".ico", ".tif", ".tiff"
}

def is_image_file(name: str) -> bool:
    return os.path.splitext(name)[1].lower() in IMAGE_EXTS

def main() -> None:
    root = Path(__file__).resolve().parent
    dest_img = root / "img"
    dest_img.mkdir(exist_ok=True)

    log_path = root / "image_conflicts.txt"

    moved = 0
    identical = 0
    conflicts = 0
    skipped_bg = 0
    scanned_img_dirs = 0

    with log_path.open("a", encoding="latin-1") as log:
        log.write(f"\n--- Run at {datetime.now().strftime('%m/%d/%Y %H:%M:%S')} ---\n")

        # Walk top-down so we can prune directories cleanly
        for dirpath, dirnames, filenames in os.walk(root, topdown=True):
            cur = Path(dirpath)

            # Skip the root img/ directory entirely
            try:
                if cur.samefile(dest_img):
                    dirnames[:] = []  # don't descend into it
                    continue
            except FileNotFoundError:
                # Some OS/filesystems may raise if path disappears mid-walk
                pass

            # Only act inside folders literally named 'img' (not the root one we skipped)
            if cur.name.lower() == "img":
                scanned_img_dirs += 1

                # Do not descend into nested dirs under this img/
                dirnames[:] = []

                for fname in filenames:
                    # Skip the special background.gif (case-insensitive)
                    if fname.lower() == "background.gif":
                        skipped_bg += 1
                        continue

                    if not is_image_file(fname):
                        continue

                    src = cur / fname
                    dst = dest_img / fname

                    if dst.exists():
                        # Compare by content; if identical, ignore. Otherwise, log conflict.
                        try:
                            if filecmp.cmp(str(src), str(dst), shallow=False):
                                identical += 1
                                continue
                            else:
                                conflicts += 1
                                log.write(f"CONFLICT (different content): '{src}' -> '{dst}'\n")
                                continue
                        except Exception as e:
                            conflicts += 1
                            log.write(f"ERROR comparing '{src}' vs '{dst}': {e}\n")
                            continue

                    # No destination collision: move the file
                    try:
                        shutil.move(str(src), str(dest_img))
                        moved += 1
                    except Exception as e:
                        conflicts += 1
                        log.write(f"ERROR moving '{src}' -> '{dest_img}': {e}\n")

    print(f"Scanned 'img' folders: {scanned_img_dirs}")
    print(f"Moved: {moved}")
    print(f"Identical (left in place): {identical}")
    print(f"Skipped 'background.gif': {skipped_bg}")
    print(f"Conflicts/Errors logged: {conflicts}")

if __name__ == "__main__":
    main()
