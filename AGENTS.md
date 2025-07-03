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
| **P3** | **Extensibility** | New themes and features can be added without touching core code. Favor plug-in hooks, migrations, and seed scripts. |

---

## 3. Tech Stack Overview
* **Language:** PHP 8.x, modern PSR-12 style  
* **DB:** MariaDB / MySQL 8.x (InnoDB)  
* **Template Engine:** Twig 3.x  
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
* **No JSON blobs** for configs, lists, or settings.  
* **Normalized schema** with lookup tables for theme assets, navigation, and CMS settings.  
* **Migrations**: Use SQL migration files (`/database/migrations/`) named `YYYYMMDD_HHMMSS_description.sql`.  
* **Seeders** preload original news items, product catalog, and yearly theme metadata.  

---

## 6. Yearly Theme Handling
* Table: `themes (id, year, name, css_path, assets_path, is_default)`  
* Each request resolves the active theme by (a) user profile override, (b) global default, (c) fallback to 2003.  
* Public controllers inject theme-specific view paths; Twig picks up `/themes/{year}/templates/*.twig`.  

---

## 7. Coding Conventions
* PSR-12, strict types, short array syntax, `declare(strict_types=1);`.  
* Controllers thin; domain logic lives in Services.  
* Use PDO prepared statements or a lightweight ORM (e.g., Doctrine DBAL—not Active Record).  

---

## 8. Security & Performance
* CSRF tokens on all mutating admin requests.  
* Content Security Policy headers to mitigate XSS.  
* Redis page-fragment caching for heavy archive pages.  
* Prepared statements everywhere—*no* string-built SQL.  

---

## 9. Typical Agent Task Workflow
1. Receive user story (e.g., “Add 2006 theme”).
2. Design DB changes → create migration & seeder.
3. Slice original 2006 CSS/graphics → store in /themes/2006/.
4. Build admin UI for enabling/disabling theme.
5. Write feature tests (PHPUnit) + Cypress admin E2E.
6. Commit with Conventional Commits prefix (feat:, fix:, chore:).

---

## 10. Non-Functional Requirements
* Accessibility: WCAG 2.1 AA minimum in admin panel.

* Logging: Monolog, daily rotation; errors to error_log table.

* Backups: Nightly SQL dump script included in /scripts/backup/.

---

## 11. Glossary
* Theme – A full HTML/CSS asset set replicating a specific historical year.

* CMS – Admin interface to manage all site data.

* Migration – SQL file describing an atomic schema change.

---

## 12. A Final Reminder
* Never output or rely on JSON files for configuration or content—store everything in the database.
* Always wrap admin HTML in polished, production-ready CSS. Plain markup is unacceptable.

