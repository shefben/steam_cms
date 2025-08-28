# 2009 Large Capsule — PHP Clone

This is a faithful reconstruction of the 2009 Steam "large capsule" Flash widget using the original image frames extracted from your SWF decompile.

## How it works
- Uses the PNG frames in `assets/slides/` (576x224) exactly as exported.
- Auto-advances every `duration` milliseconds (set in `config.php`) **only if there are more than 2 slides**, mirroring the original ActionScript's check.
- Hovering the capsule pauses rotation; moving the mouse out resumes it (equivalent to `_global.ovr/_global.out` handlers).
- Each slide is fully clickable via an invisible hit overlay. Set per-slide links in `config.php`.

## Files
- `index.php` — main widget.
- `config.php` — duration + per-slide links.
- `assets/slides/` — original frames (1.png..N.png) copied from `sprites/DefineSprite_25`.
- `assets/shapes/` — optional UI shape PNGs copied from the SWF; unused images can be removed.

## Usage
Deploy the folder to any PHP server and open `index.php`. Edit `config.php` to set your links and duration.

> Note: The original SWF likely drew numeric buttons and bar decorations programmatically. This clone uses plain HTML buttons laid out to match the same pixel area. If you want the **exact** typographic look, provide the original number glyphs or font and we can swap the buttons for image-based numbers.
