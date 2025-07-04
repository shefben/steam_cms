# Codex o3 Agent – SteamPowered (2002–2010) CMS Re-Creation  
*Guidelines & Operating Manual*

---

## 1. Mission Statement
Re-create the public‐facing **steampowered.com** experience from 2002 – 2010 *and* deliver a modern, professional **CMS admin panel** that makes every data point—news, themes, product listings, promos—*fully* editable while preserving the original look-and-feel of each year.

---

## 2. Primary Objectives
| Priority | Goal | Key Points |
|----------|------|------------|
| **P0** | **Pixel-perfect front-end fidelity** | Match archived HTML / CSS exactly for each yearly theme (2002 → 2010). |
| **P1** | **Professional Admin UX** | Admin screens must ship with complete CSS styling—*never plain HTML*. Use responsive layouts, accessible color contrasts, intuitive navigation, and clear form validation feedback. |
| **P2** | **Data-first architecture** | **All** configuration, content, and state is persisted in the relational database (MariaDB/MySQL). **Do not** store app data in JSON or flat files. |
| **P3** | **Extensible and Templated** | All unique front-end pages must be templated for our **custom template engine**. These templates must be reusable and designed to support content injection, partial overrides, and extension logic. |
| **P4** | **Manipulable Content** | All example/archive pages must be parsed into structured, editable formats. The CMS must allow precise manipulation of each element—adding, removing, reordering—without touching the raw HTML. |

---

## 3. Tech Stack Overview
* **Language:** PHP 8.x, modern PSR-12 style  
* **DB:** MariaDB / MySQL 8.x (InnoDB)  
* **Template Engine:** Custom (Twig-compatible syntax)  
* **Styles:** Vanilla CSS + optional SCSS build step (no Tailwind / Bootstrap; replicate Valve’s original styling)  
* **Version Control:** Git, main branch = `trunk`  

---

## 4. Admin Panel Design Principles
1. **Full CSS Styling Required**  
   - Every screen ships with dedicated style rules within `/public/admin/css/`.  
   - Use BEM naming or scoped data attributes; avoid global collisions with public themes.  

2. **Intuitive Navigation**  
   - Persistent left sidebar + breadcrumb header.  
   - Keyboard-accessible components, tab order, ARIA labels.  

3. **Smart Forms**  
   - Instant inline validation.  
   - Re-usable form field components (text, slug, markdown, WYSIWYG, datetime, image upload).  

4. **Visual Continuity**  
   - Colors/fonts echo the 2002–2010 public themes while maintaining modern accessibility contrast.  

---

## 5. Database-First Rule Set
**All data must be fully normalized. The following practices are strictly prohibited:**
- ❌ No JSON blobs  
- ❌ No flat config files  
- ❌ No serialized data  
- ❌ **Absolutely no key/value rows** (e.g., `settings (key, value)` is forbidden)

Instead:
- Use strongly-typed, structured tables with descriptive column names.
- Create dedicated schema for each content type (e.g., `news_articles`, `product_listings`, `theme_assets`, `page_blocks`, `nav_links`).

**All content must be manageable through the CMS.**

---

## 6. Page Templating
Every unique page must:
- Be rendered using the **custom template engine**.
- Be constructed from modular components (headers, footers, content blocks).
- Be fully **extensible and overridable**, supporting child themes and layout inheritance.
- Be automatically linked to editable sections in the CMS (e.g., page title, meta, content blocks).

> Example:  
> The 2004 Subscriber Agreement must not be hardcoded. Instead, it's parsed into editable chunks, stored in a dedicated `pages` table, and rendered via `page_subscriber_agreement.twig`.

---

## 7. Parsed Page Requirements
All pre-existing legacy HTML content must:
- Be parsed into structured records at import.  
- Preserve content hierarchy (headings, lists, tables, etc).  
- Be injected into CMS-controlled templates with editable regions.  
- Allow admin to add/remove paragraphs, images, sections easily.

> Never store full raw HTML blobs.  
> Each visual section should map to a discrete record or field.

---

## 8. Yearly Theme Handling
* Table: `themes (id, year, name, css_path, assets_path, is_default)`  
* Each request resolves the active theme by (a) user profile override, (b) global default, (c) fallback to 2003.  
* Public controllers inject theme-specific view paths; templates use `/themes/{year}/templates/*.twig`.  

---

## 9. Coding Conventions
* PSR-12, strict types, short array syntax, `declare(strict_types=1);`.  
* Controllers thin; domain logic lives in Services.  
* Use PDO prepared statements or a lightweight ORM (e.g., Doctrine DBAL—not Active Record).  

---

## 10. Security & Performance
* CSRF tokens on all mutating admin requests.  
* Content Security Policy headers to mitigate XSS.  
* Redis page-fragment caching for heavy archive pages.  
* Prepared statements everywhere—*no* string-built SQL.  

---

## 11. Typical Agent Task Workflow
```text
1. Receive user story (e.g., “Add 2006 theme”).
2. Design DB changes → create migration & seeder.
3. Slice original 2006 CSS/graphics → store in /themes/2006/.
4. Build templated page using our engine with injected editable blocks.
5. Build admin UI for enabling/disabling theme and editing content blocks.
6. Write feature tests (PHPUnit) + Cypress admin E2E.
7. Commit with Conventional Commits prefix (feat:, fix:, chore:).
```

---

## 12. Non-Functional Requirements
* Accessibility: WCAG 2.1 AA minimum in admin panel.
* Logging: Monolog, daily rotation; errors to `error_log` table.
* Backups: Nightly SQL dump script included in `/scripts/backup/`.

---

## 13. Glossary
* Theme – A full HTML/CSS asset set replicating a specific historical year.
* CMS – Admin interface to manage all site data.
* Migration – SQL file describing an atomic schema change.
* Page Template – A custom-engine parsed layout with defined injection points.
* Parsed Page – A legacy HTML page restructured into editable CMS-managed blocks.

---

## 14. Final Reminders
    ✅ All content must be stored in proper tables.
    ❌ Do not use `key/value` settings for anything.
    ✅ All pages must be templated and extendable.
    ❌ Never store content in JSON or serialized blobs.
    ✅ Admin panel HTML must always be styled. Plain HTML is unacceptable.