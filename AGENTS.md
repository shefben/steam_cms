# agents.md
_A multi-agent workflow for **ChatGPT o3 Codex** to turn a flat “static-HTML-in-PHP-files” site into a fully skin-aware PHP CMS._

---

## ☑ Global rules

| # | Guideline |
|---|-----------|
| 1 | **Strict 20-minute sprint limit** per agent run. Break bigger jobs into sub-tasks ≤ 20 minutes. |
| 2 | Output **runnable code, not advice**. When a stub is unavoidable, add `// TODO:` markers that the next agent can fill in. |
| 3 | Use PHP 8.3+, modern PSR-12 coding style, Composer autoloading and namespaces. |
| 4 | Follow *12-factor-app* principles: keep config in `.env`, never hard-code hostnames or credentials. |
| 5 | Keep commits atomic. The _CI-setup step_ (see `setup.sh`) is already handled before the first agent starts. |
| 6 | Re-use existing open-source where sensible—don’t reinvent CMS primitives such as routing, RBAC, or migrations. |
| 7 | Prefer **Latin-1** or **ASCII** string ops when encoding/decoding binary blobs (per user constraint). |

---

## 🧩 Agents

> Each agent is a self-contained prompt executed by Codex o3.  
> Success criteria, inputs and outputs are explicit so downstream agents have zero guess-work.

| Id | Agent | Objective | Success Criteria | Inputs | Output Artifacts |
|----|-------|-----------|------------------|--------|------------------|
| A0 | **SiteAuditAgent** | Crawl the repo’s `*.php` files (really HTML) → build a JSON manifest of pages, shared fragments, assets and inline scripts. | `site-map.json` lists every page with title, depth, relative links, and non-HTML assets. | File tree | `docs/site-map.json` |
| A1 | **TemplateExtractor** | Derive common header, nav, footer, sidebars → emit Twig/Latte/Blade view partials + master layout. | `resources/views/layout.blade.php` renders existing pages with 0 visual drift. | `site-map.json` | `resources/views/*` |
| A2 | **RoutingScaffolder** | Generate a PSR-15 router config that maps legacy URLs → Controller stubs returning the matching view. | `routes/web.php` passes `php artisan route:list` with 0 errors. | View files | `routes/web.php`, `app/Http/Controllers/*` |
| A3 | **CMSIntegrator** | Choose & initialise the CMS core (e.g. _Laravel_). Configure theme/skin support that defers to A1 templates. | `composer install` passes, CMS homepage renders. | Repo root | Working CMS bootstrap |
| A4 | **ContentMigrator** | Extract static body content into DB seeders / Markdown blocks. Replace hard-coded text in views with CMS fields. | All page bodies now editable in CMS backend; fixtures load via `php artisan migrate --seed`. | DB schema, original HTML | Seeder classes, migrations |
| A5 | **AssetPipelineAgent** | Move CSS/JS/images to `/public`, convert inline `<style>`/`<script>` to versioned assets compiled via Vite. | `npm run build` succeeds; pages reference hashed filenames. | Original HTML | `resources/css`, `resources/js` |
| A6 | **AuthRBACAgent** | Implement user auth, roles, and page-level permissions (public vs logged-in vs admin). | Login/registration flow passes feature tests; roles seeded. | CMS core | Controllers, Policies, Tests |
| A7 | **QATestAgent** | Generate PHPUnit + Dusk tests that hit every route, assert 200 status, and diff the DOM vs original static HTML snapshot. | All tests green; visual diff ≤ 2% per page. | Everything so far | `tests/Feature/*`, `tests/Browser/*` |
| A8 | **DeploymentAgent** | Produce `Dockerfile`, `docker-compose.yml`, Nginx conf, and GitHub Actions CI. | `docker compose up -d` → site reachable on :8080; CI pipeline passes. | Repo state | Deploy scripts |

---

## 🔄 Workflow / Phase plan

| Phase | Responsible Agent(s) | Max Runs | Primary Artifacts |
|-------|----------------------|----------|-------------------|
| 0 – Discovery | A0 | 1 | `docs/site-map.json` |
| 1 – Templating | A1, A2 | 2 | Layout & routes |
| 2 – CMS Core | A3 | 1 | Bootstrapped framework |
| 3 – Content | A4 | 2 | Migrations & seeders |
| 4 – Assets | A5 | 1 | Built asset pipeline |
| 5 – Access Control | A6 | 1 | Auth + RBAC |
| 6 – QA | A7 | 1 | Automated tests |
| 7 – Deploy | A8 | 1 | Container & CI |

---

## 🏃‍♂️ Prompt skeleton (per agent)

```yaml
# === COPY BELOW INTO Codex prompt box ===
system:
  - "You are ChatGPT o3 Codex. Obey agents.md global rules."
user:
  - "AGENT_ID: A<n>"
  - "OBJECTIVE: <copy from table>"
  - "INPUTS: <paths / JSON docs>"
  - "DELIVERABLES: <expected new/modified files>"
  - "CONSTRAINTS: Complete within 20 minutes, commit atomic."
# ========================================
```
Fill <n> and tags accordingly.
Every subsequent agent must read the repo as-is (including previous agents’ commits) to stay in sync.