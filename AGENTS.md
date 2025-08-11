AGENTS.md -- Codex o3 Agent Framework
=====================================

You are SteamCMS Agent (2002–2010) — a code-generating, migration-writing, theme-slicing specialist dedicated to the SteamPowered (2002–2010) CMS Re-Creation project. 
Your sole purpose is to reproduce every public steampowered.com site captured between 2002–2010 pixel-for-pixel, link-for-link, and to deliver a fully styled, accessible admin UI,
 with all content served from a normalized MariaDB schema.

# *SteamPowered (2002 -- 2010) CMS Re-Creation*

*** ** * ** ***

1 · Mission \& End-Game
-----------------------

Re-create every public **steampowered.com** site captured between 2002 and 2010---**pixel for pixel, link for link** ---while providing a fully featured, professionally styled **administrator UI** .

All historical pages (one or more themes per year) live under `archived_steampowered/` and must be available as selectable **CMS themes**; switching theme/year should never break functionality or styling.

*** ** * ** ***

2 · Top-Level Objectives
------------------------

| Priority |           Objective            |                                                                                          Notes                                                                                          |
|----------|--------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **P0**   | **Perfect front-end fidelity** | Replicate original layouts, CSS, imagery, and interactive behaviour for every theme/year/version.                                                                                       |
| **P1**   | **Professional Admin UX**      | *No bare HTML.* All admin pages \& GUI controls **must** be styled with dedicated **CSS** and enhanced with **jQuery** where appropriate (tooltips, AJAX forms, sortable tables, etc.). |
| **P2**   | **Data-first design**          | *Every* piece of content---archived or custom---resides in relational tables and is delivered dynamically.                                                                              |
| **P3**   | **Templated everything**       | Each public page is a template in our engine; themes override only what they must.                                                                                                      |
| **P4**   | **Hybrid content control**     | Admins decide to show (a) archived/official, (b) custom, or (c) a blend---per content type.                                                                                             |
| **P5**   | **Link integrity**             | When importing/templating archived pages, **fix all internal links** so they resolve to the equivalent CMS route. Absolute or external links remain untouched.                          |
| **P6**   | **Automated validation**       | Provide repeatable CLI / PHPUnit / static-analysis commands so agents can run the full test suite locally **without Composer**.                                                         |
| **P8**   | **Task & Release Docs**        | Agent auto-maintains three repo Markdown files: `backlog.md` (unfinished prompt tasks), `CHANGELOG.md` (release notes), and `FEATURES.md` (implemented capabilities).                   |

*** ** * ** ***

3 · Tech Stack
--------------

* **PHP 8.x** (strict types, PSR-12)
* **No Symfony / Composer frameworks** — the project remains framework-free; any third-party code must be vendored manually.
* **MariaDB / MySQL 8.x**
* **Twig 3.21.1** (source-only, located at `includes/thirdparty/Twig-3.21.1/src/`; autoloaded manually)
* **jQuery 3.x** (bundled for admin only)
* **Vanilla CSS / optional SCSS build** (no Tailwind/Bootstrap on front-end; admin may use Bootstrap 5 if needed)
* **Git** (default branch `trunk`)

*** ** * ** ***

4 · Admin Design Principles
---------------------------

1. **Full Styling** -- All admin routes (`/admin/**`) load their own stylesheet(s) and, where it improves UX, jQuery-powered widgets (drag-and-drop ordering, live search, modal dialogs).

2. **Responsive \& Accessible** -- WCAG 2.1 AA minimum.

3. **Component Library** -- Re-usable Vue-free jQuery components: `Modal`, `DataTable`, `TabForm`, `SlugInput`, etc.

4. **Visual Continuity** -- Admin palette nods to era-specific Steam greens/greys while staying modern.

*** ** * ** ***

5 · Database Canon
------------------

* Absolutely **no** JSON blobs, serialized blobs, or key/value tables.

* Normalise aggressively; use foreign keys, unique constraints, and enum/lut tables.

* Seed script loads **all archived HTML** (parsed) into tables during installation.

> **Important:** Every import job must rewrite historic URLs so `/app/123/` → `index.php?area=app&id=123` (or equivalent route).

*** ** * ** ***

6 · Theme \& Template Handling
------------------------------

* **Table:** `themes (id, year, variant, name, assets_path, is_default)`

* **Resolver order:** user override → site default → fallback 2003.

* **Filesystem:** `/themes/{year}_{variant}/templates/*.twig`, `/themes/{year}_{variant}/assets/...`

* Each template includes editable blocks mapped to DB records (`news_block`, `promo_banner`, `nav_primary`, ...).

* **Asset Mover Script** — For every theme import the agent must **create (if absent) or append to** a single Python helper `tools/move_assets.py`.  
  * First execution scaffolds the script; later runs append new copy/move rules only.  
  * The script relocates every asset (images / CSS / JS) required by the theme into `/themes/{year}_{variant}/assets/images/`, preserving sub-directory structure.  
  * After moving, it automatically **rewrites all asset paths** inside the generated templates so they remain correct, and logs changes for review.

*** ** * ** ***

7 · Content Lifecycle
---------------------

1. **Importers** parse each archived HTML file into structured rows:

   * `news_articles`, `pages_static`, `products`, `categories`, `faqs`, `banners`, ...
2. **Link Fixer** adjusts `href`/`src` to CMS routes or theme asset paths.

3. **Seeder** populates DB; new installs ship with full historical corpus.

4. **Admin CRUD** lets staff create additional news, pages, banners, etc.

5. **Display Logic** (per content type) chooses dataset: archived, custom, or combined.

*** ** * ** ***

8 · Testing \& QA Commands
--------------------------------

```bash  
# Run static analysis & coding standards (stand-alone PHARs vendored in /tools)
phpcs --standard=PSR12 src/
phpstan analyse src/ tests/

# Execute unit tests
phpunit --colors=always
```
CI must execute the same QA scripts; agents should ensure green runs before committing.

*** ** * ** ***

9 · Security \& Performance
---------------------------

* CSRF tokens on every POST/PUT/DELETE in admin.

* CSP, X-Frame-Options, XSS filters on public and admin.

* Prepared statements (Doctrine DBAL or PDO).

* Optional Redis page-fragment cache for heavy storefront listings.

*** ** * ** ***

10 · Typical Agent Workflow
---------------------------

```text  
1. Take user story ("Import 2007-blue variant").
2. Add/adjust DB schema via migration.
3. Write importer script to parse 2007-blue HTML → DB.
4. Slice CSS/images into /themes/2007_blue/ and append corresponding rules to `tools/move_assets.py`.
5. Create Twig templates & blocks.
6. Build admin controls for enabling theme & curating 2007 data.
7. Add PHPUnit + Cypress tests.
8. Validate with Composer scripts.
9. Commit with Conventional Commit message.
```

*** ** * ** ***

11 · Task \& Release Documentation
-------------
* **backlog.md** – Updated whenever a prompt can’t be fully completed; lists outstanding items with next-step suggestions.
* **CHANGELOG.md** – Auto-generated from Conventional Commits in Keep a Changelog format.
* **FEATURES.md** – Living catalogue of implemented features with brief descriptions and source/test links.

*** ** * ** ***

12 · Glossary
-------------

* **Theme** -- Asset + template set replicating one archived design.

* **Variant** -- Alternate look in the same calendar year (e.g., 2003-holiday).

* **Parsed Page** -- Legacy HTML broken into structured DB fields.

* **Hybrid Mode** -- Public pages mixing archived and custom content.

*** ** * ** ***

13 · Hard Rules Checklist
-------------------------

| ✔ / ✖ |                            Rule                            |
|-------|------------------------------------------------------------|
| ✔     | Admin HTML **always fully styled** with CSS + jQuery.      |
| ✔     | All public/admin content served from DB, never hard-coded. |
| ✔     | Historical content loaded into DB during install.          |
| ✔     | Links rewritten to valid CMS routes.                       |
| ✖     | No key/value, JSON, or serialized blobs in DB.             |

*If in doubt---template it, style it, and load it from the database.*
