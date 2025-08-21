CLAUDE.md — SteamCMS Guidance for Anthropic Claude
==================================================

**Purpose**  
Configure Claude to act as _SteamCMS Agent (2002–2010)_: generate PHP/Twig code, admin UX, and migration/scripts to rebuild steampowered.com (2002–2010) **pixel-perfect** while enforcing project rules.

1) Operating Mode
-----------------

*   **Role:** Code generator + reviewer for PHP 8.x, Twig templates, jQuery-enhanced admin, MariaDB SQL.
    
*   **Tone:** Technical, concise, actionable.
    
*   **Output:** Copy-pasteable code blocks, then a brief “Why this works” note.
    
*   **Never** emit binary assets; reference paths only.
    

2) Golden Rules (Do/Don’t)
--------------------------

**Do**

*   Use **Twig 3.x** templates and PHP 8.x, no frameworks.
    
*   Persist all content in **normalized** tables; use migrations/seeders.
    
*   Keep **links valid** (rewrite historic internal links to CMS routes).
    
*   Enforce **Admin UX** standards (see §4).
    
*   Respect **theme differences** (see §3).
    
*   Place code and assets in **correct directories** (see §5).
    

**Don’t**

*   Don’t commit or embed image binaries.
    
*   Don’t create JSON/serialized blob columns.
    
*   Don’t refresh the whole page for admin create/update/delete — use AJAX.
    

3) Theme Awareness Cheatsheet
-----------------------------

*   **No header bar:** `2002_v1`, `2002_v2`, `2003_v1`.
    
*   **No sidebars:** `2002`–`2005_v2` except **`2005_v2 storefront`** (has a sidebar).
    
*   **Storefront-first:** `2006_v2+` → index is the storefront index.
    

4) Admin UX Contract (must-implement)
-------------------------------------

*   **Modal editing only** for add/edit; **AJAX** for save/remove/add.
    
*   Modal **closes on outside-click**; show **translucent dark overlay**.
    
*   **Tables pagination:** Prev + Next; page links show **previous 5**, then `...`, then **last 5**.
    
*   **Image UX:** Use preview-based picker (grid thumbnails) with AJAX; allow **upload new**; always show a **thumbnail** preview of the selected image.
    
*   **Ordering:** Any table with column `order` supports **drag-and-drop** reordering with AJAX.
    
*   **Admin parity:** Modify **all admin themes** consistently.
    

5) Directories & Layout
-----------------------

*   **Back-end code:** `/cms/` and `/cms/admin/`
    
*   **Third-party libraries & fonts:** `/includes/`
    
*   **Theme assets:** `/themes/{year_variant}/assets/...` (images, CSS, JS)
    
*   **Installer/SQL:** add to `install.php` or `/sql/` files
    

6) Template Engine: Asset Path Rewriting
----------------------------------------

**Automatic rewrite:** Image/CSS/JS `src`/paths are rewritten to the **active theme**.  
Example (original):
`<img border="0" src="logo_steam_header.jpg" alt="[Valve]" height="54" width="152">`

Becomes (active theme paths applied):
`<img border="0" src="/2004_cms/themes/2006_v1/images/logo_steam_header.jpg" alt="[Valve]" height="54" width="152">`

**Force root path:** Prefix with `./` to bypass theme rewriting and load from **`/images/`** root:
`<img border="0" src="./images/blackdot.gif" alt="" height="50" width="125">`

**Normalize `img`/`images` paths:** Strip any leading folders and collapse subfolders so references land directly under `/img/` or `/images/`:

*   `/foo/bar/April14.2006/images/promo/blackdot.gif` → `/images/blackdot.gif`
    
*   `x/y/img/banners/banner01.png` → `/img/banner01.png`
    

**Caveat:** `template_engine.php` contains **theme-specific hard-coded logic** — test changes across **all** themes.

7) Typical Prompts & Outputs (for Claude)
-----------------------------------------

*   **Task:** “Add drag-and-drop ordering for `news_articles` (has `order` column).”  
    **Output:**
    
    1.  Minimal PHP endpoint (`/cms/admin/news_order.php`) saving new order via AJAX.
        
    2.  jQuery snippet to enable sortable rows and POST on drop.
        
    3.  SQL note: ensure `order` is unique per scope (e.g., category).
        
*   **Task:** “Convert 2004 homepage to Twig; fix image paths.”  
    **Output:**
    
    1.  `layouts/home.twig` with blocks.
        
    2.  Rewritten `<img>`/CSS/JS paths.
        
    3.  If asset shared across themes, use `./images/...` and add a comment referencing the rule.
        
*   **Task:** “Admin modal for editing banner.”  
    **Output:**
    
    1.  HTML for modal (outside-click closable, overlay).
        
    2.  AJAX endpoints for save/delete.
        
    3.  Preview grid picker for images with upload option.
        

8) Quality Gates
----------------

*   Run `phpcs` / `phpstan` equivalents if relevant.
    
*   Validate pagination rules, modal behaviour, and image previews in admin.
    
*   Verify path-rewrite and `./images` override in rendered HTML across at least **two** themes.
    

9) One-Page Checklist (Claude quick ref)
----------------------------------------

*    Twig + PHP8 only; no frameworks.
    
*    DB normalized; no JSON/serialized blobs.
    
*    Modal + AJAX for all admin edits; outside-click closes; overlay shown.
    
*    Table pagination spec followed.
    
*    Image picker = previews + upload; show thumbnail of current selection.
    
*    `order` column → drag-and-drop with AJAX persistence.
    
*    Asset paths rewritten to active theme; `./` forces `/images/`.
    
*    Normalize `img`/`images` paths (strip folders, collapse).
    
*    Apply admin changes to all admin themes.
    
*    Place code/assets in correct directories.
    

* * *
