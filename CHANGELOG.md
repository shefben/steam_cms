# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
- Avoided cache warnings by verifying directories exist before removing them.
- News admin add and edit actions open in an AJAX modal and update the table without page reload.
- News admin pagination uses button controls and collapses page links to first and last five with ellipses.
- Ensured admin login persists session data by closing the session before redirecting.
- Included CSRF token in admin login templates to avoid invalid request errors.
- Fixed fatal error on Preload Marketing admin page due to undefined `$pdo` variable.
- Updated marketing table to store localized content and adjusted admin preload page and installer accordingly.
- Corrected download settings thumbnails for 2003_v2 and 2004 themes to load from the proper path.
- Fixed 2005_v2 index to display latest news by falling back to `publish_date` when `publish_at` is missing.
- Capsule previews in index management now load theme CSS for accurate rendering.
- Restored modal-based Add Capsule and Add Tabbed Capsule actions for 2006 index capsule management.
- Installer now writes the configured database port to `config.php`.
- Added .htaccess redirect for Counter-Strike price change marketing page.
- Installer seeds default redirect rules into the `redirects` table to preserve legacy paths.
- Grouped plugin sidebar links under a dedicated Plugins parent in the admin navigation.
- Isolated admin sessions per installation with unique cookie names and scoped paths to prevent cross-CMS logins.
- Resolved Twig parser error on Random Content admin page by replacing deprecated `raw` blocks with `verbatim`.
- Removed back links from redirect and media admin pages.
- Added admin notifications for new cheat, CD key, troubleshooter, map contest, and cyber cafe form submissions with indicator.
- Prevented duplicate `session_start` warnings on Update History page by checking session state in the admin header.
- Corrected Page Version Management thumbnail URLs to resolve from the admin images directory.
- Restored legacy `cms_check_permission()` helper to fix undefined function errors in the plugin API.
- Added inline editing with AJAX to custom redirects management.
- Custom titles admin now supports AJAX add, delete, and save actions without page reloads.
- Consolidated support, FAQ, content, and storefront links under new sidebar parents for easier navigation.
- Sidebar renderer now supports nested parent menus.
- Applied dropdown toggle fix to all admin themes so nested parents expand consistently.
- Restored top navigation tabs on 2004/2005v1 storefront for packages, games, and third-party listings.
- Plugin API now supports JSON-defined sidebar sections with customizable admin widgets and entry hooks.
- Plugin sidebar sections can target specific themes via a `themes` list stored in `theme_list` columns.
- Logged missing 404 request paths, including static assets like images, CSS, and JS, to the error log for easier diagnostics.
- Sidebar dropdowns now use a generic click handler so they toggle consistently across all admin pages.
- Parent-only sidebar links no longer require URLs and won't navigate when toggled.
- Installer seeds parent-only sidebar headers without PHP targets, preventing navigation.
- Removed URLs from all sidebar parent links, including storefront, index management, and legacy storefront headers.
- Added bug report form with database storage and admin management interface.
- Redirected settings page after saving so new admin theme loads without manual refresh.
- Fixed custom pages and page version management screens to show content in the Neon admin theme.
- Restored Page Version Management radio controls for hyphenated theme variants and skipped empty page groups.
- Fixed content server stats to render all servers with collapsible blocks for 2003 v2 and grouped entries for 2004+ themes.
- Installer seeds default content servers from 2003 v2 and 2004 archives.
- Error Log admin page supports deleting individual entries and clearing the entire log.
- Error logger now records all PHP errors and warnings by enforcing E_ALL reporting.
- Removed duplicated news rows and stripped stray `\n` sequences during installation.
- 2003 v1 update notification now displays only on the Get Steam Now page.
- Installer seeds default sidebar sections for 2006 v1/v2 and 2007 v1/v2 themes.
- Admin sidebar navigation and icons now load entirely from the database, removing hard-coded defaults from the header.
- Fixed installer to skip upgrade migrations and correctly parse SQL triggers.
- Added theme.json support allowing themes to declare custom settings with admin widgets.
- Moved 2004/2005 map contest toggle to submissions page with AJAX updates and inline notifications.
- Replaced random content creation link with modal-based button and fixed submission handling.
- Replaced theme update text with transient notifications on save.
- Restored styling for GreenSteam and GreenSteam v2 admin themes.
- Corrected Neon admin select arrows and sidebar toggle glyphs.
- Replaced troubleshooter management inline editor with AJAX modal and restored WYSIWYG.
- Updated survey stats form to label category IDs explicitly.
- Integrated image picker for selecting existing storefront capsule images.
- Product editor can add existing screenshots through an AJAX-powered image picker.
- Fixed 2007 v1 and v2 theme header bars so logo and navigation stay on one line.
- Removed binary image assets from Green Steam admin themes
- Added neon-styled admin theme based on neon_version2 example.
- Updated neon admin navigation markup to mirror original HTML structure.
- Header & Footer admin defaults to the current theme instead of the first theme.
- Introduced Twig-driven admin layout system with per-page identifiers and tag-specific templates, including a neon default layout mirroring the example HTML.
- Converted default and v2 admin themes to Twig layouts preserving their original structure.
- Added Twig-based login templates for neon, default, and v2 admin themes.
- Drag handles in Neon admin theme now use a move cursor for clearer dragging.
- Fixed header warning when deleting survey categories and darkened survey category links.
- Added CSV/JSON import and export for FAQs.
- Added migration indexing `publish_at` on the news table.
- Added triggers to notify admins of new cafe signups, import jobs, and platform update releases.
- Added index on `faq_content` category columns for faster admin lookups.
- Normalized theme asset paths by collapsing duplicate slashes.
- Added tests for theme asset path rewriting and JavaScript `newImage()` handling.
- Legacy storefront package editor supports rich text descriptions with a WYSIWYG control.
- Custom pages support content header images with AJAX upload/selection and `content_header_image` template tag.
- Pre-existing header image selection now uses jQuery Image Picker for thumbnails and single-image selection.
- Fixed Tabbed Capsule modal to persist tabs and game details on save.
- Tabbed Capsule editor supports selecting existing capsule images or uploading new files for each game.
- Added interactive 2006+ index management page with drag-and-drop capsules and AJAX editing.
- Index manager now supports GetTheGear and Freestuff/Custom capsule types with editable titles and rich text content.
- Fixed Troubleshooter sidebar link to toggle sub-menu instead of navigating.
- Introduced Green Steam admin themes with windowed layouts derived from example HTML.
- Restored radio buttons and thumbnails on the Page Version Management admin page when theme variants are active.
- GetTheGear and Freestuff capsules now match original theme dimensions (small in 2006, large in 2007).
- Installer seeds 2006+ index management link in admin navigation.
- 2006_v1, 2006_v2, 2007_v1, and 2007_v2 themes load index capsules from database entries.
- 2007_v1 and 2007_v2 themes group capsule rows in `<div class="inline">` containers, except for large capsules.
- 2007_v1 and 2007_v2 GetTheGear and Freestuff capsules now render inside `<div class="leftCol_home_indent">` wrappers.
- Tabbed capsule markup wrapped in `<div class="leftCol_home_indent">` for consistent indentation.
- Map contest submission form now includes custom styling and required field validation.
- FAQ drag-and-drop ordering uses a reusable helper and is covered by integration tests.
- Installer seeds download categories from archived 2004 and 2003_v2 pages.
- Index manager capsules include a circular **X** control to delete items and reflow remaining capsules.
- Added dedicated **Add Tabbed Capsule** workflow with multi-tab builder, game image uploads, and AJAX saving.
- Tabbed capsule games now persist title, price, and image paths in relational tables and render from database records.
- Replaced news sidebar text with template tags and added search bar tag for 2007 themes.
- Right sidebar content generated through `custom_index_sidebar_configurations()` tag for 2006–2007 themes.
- Index sidebar management modal supports editing theme-specific variants, drag-and-drop sorting, and CSRF protection.
- Removed download page version options from Page Version Management; now handled in Download Settings.
- Random content loader now picks a new entry on each render and respects absolute image paths.
- Render 2006–2007 storefront capsules using legacy HTML markup so capsule images display correctly.
- Capsule tags now load theme-specific entries before falling back to globally shared capsules.
- Root .htaccess now redirects storefront paths to the 04-05 directory when the active theme is 2004 or 2005_v1.
- Added fallback to legacy capsule tables so default storefront capsules render when no dynamic items are configured.
- Corrected cafe_pricing seed to match placeholder count and include page title.
- FAQ page now loads popularity icons from the active theme directory.
- FAQ page renders through the default layout so the active theme styles apply.
- Resolved installation fatal error caused by passing a PDOStatement to PDO::exec.
- Removed installer for 2004 support pages; forms now load archived HTML through Twig templates.
- Prefilled 04-05 storefront games, packages, and third-party tables via SQL seed
- Added 2007_v1 and 2007_v2 themes with browse catalog list tag
- Find sidebar title in 2007_v2 layout now pulled from settings; browse catalog title seeded for 2007 themes
- Update history page collapses entries with latest entry expanded by default
- Cafe directory importer parses text files and deduplicates entries
- Cafe directory seed SQL includes country and state data
- Introduced role-based permission system with new roles admin page
- Permissions on role and user forms presented as selectable checkboxes with all/none toggles
- Admin dashboard graphs now use Chart.js with weekly/monthly toggles
- Admin dashboard graph records page views and renders weekly/monthly data
- Enabled drag-and-drop ordering across admin pages by loading SortableJS in admin themes.
- Consolidated Random Content and Random Groups scripts under jQuery ready handlers and added sidebar access to group management.
- Grouped Random Content and Random Groups links under a "Random Content Management" dropdown with installation defaults.
- Removed per-page jQuery and SortableJS script tags and wrapped drag-and-drop setups in DOM-ready handlers.
- Fresh installations seed the admin sidebar with all recently added navigation links
- Admin news list supports filtering by title and author with AJAX pagination
- Added preview endpoint with theme selection and admin-only access
- Admin login styled with theme CSS, includes jQuery validation and reset link
- News articles can be scheduled and auto-published when publish date is reached
- Admin sidebar links now support drag-and-drop sorting with dynamic add/remove
- Custom page template fallback now loads `default.twig` from the active theme
- Add storefront dropdown navigation in admin sidebar
- Global header bar uses 2006 layout with dynamic navigation
- Header bar styles now output inline with the 2006 layout
- Fixed 2006 v1 and v2 theme layouts so storefront capsules render correctly
- CSS links beginning with ./ now resolve to the root website path
- Random content entries reference groups via foreign keys
- Renamed 2002_page_title tag to page_title_2002 to comply with Twig naming rules
- Added page_title_2002 and support_email template tags
- 2002_v1 navigation highlights active page based on current route
- Admin settings include configurable support email address
- News admin page offers configurable date format with AJAX persistence
- Storefront sidebar and media table links now respect the configured root path
- CSS file url() references now point to the theme images directory
- Storefront layout detection searches storefront folders first
- Default storefront capsules now seed with 05_01_2005 images
- Full article news output retains HTML formatting
- Header logo can be overridden per page using the `header_logo()` tag
- Fixed status page to render statistics HTML correctly
- Status and content server pages now render via the default layout template
- Content server page loads its block from the active theme
- Server now directs all 404 errors to the custom error.php page
- Footer() tag now falls back to the default theme when a theme-specific footer is missing
- Fix install script ordering so storefront tabs load without foreign key errors
- Insert placeholder app 1502 so category seeding passes
- Corrected admin user insert query to match placeholder count
- Fixed capsule modal positioning and added overlay click to close
- Corrected CSS link rewriting so themes define custom locations
- Resolved PHP 8 deprecation warnings from template engine asset path parsing
- Fixed duplicate slashes in CSS links when rewriting theme assets
- CSS rewrite no longer forces a "css" directory when the stylesheet resides at the theme root
- Theme asset URLs no longer start with a slash when no base path is set
- JavaScript image preloads via newImage() now point to the theme images directory
- Corrected capsule image paths in storefront admin
- Pagination links spaced apart for clarity
- Added activity log admin page with user and action filters
- Added admin activity logging table and hooks for critical actions
- Added contextual help icons powered by new help_texts table
- Drag-and-drop ordering restored for cafe and category pages
- News export and import with CSV/JSON support and transactions
- Content server banner admin now overlays disabled images and toggles them between year and disabled folders
- FAQ sidebar includes "Frequently Asked Questions" link
- Category delete action now uses a button
- Logo preview resolves {BASE} correctly
- Templated 2005 v1 index page with dynamic news, 2004 header, and dynamic footer
- Introduce root path site setting and base URL handling
- Notification table tracks messages for admins
- Added draft status and auto-saving for news and custom pages
- Twig templating integrated; {BASE} placeholders now auto-convert
- Twig templates now load from each theme's `layout` folder
- Capsule uploads now support client-side cropping via Cropper.js
- Removed news box height limit in 2004 theme for exact layout
- Added setting to limit news by theme year
- Random banner endpoint pulls from custom folder regardless of theme
- Implemented index_brief news token for 2004 theme
- Created separate storefront admin pages for products, categories and sidebar
- Fixed storefront menu auto-expansion and navigation order

- Added two-line word limit for index news snippets
- Fixed fatal error when loading custom pages by including template engine
- Improved installer SQL parser for HTML-heavy statements
- Added full subscriber agreement text and batch script for capsules
- Cleaned 2005v1 index template and fixed header include
- Corrected admin sidebar links for products and categories
- Logout link now appears last in the admin menu
- FAQ admin sidebar now toggles questions and categories
- Added drag-and-drop FAQ category manager with AJAX saving
- Public FAQ page honors category order and hidden flag
- Paginated FAQ list in admin interface
- GlobalHeadBar logo width style removed and header padding updated
- News admin page paginated with cross-page drag support
- Theme index pages hidden from custom page list
- Template engine rewrites stylesheet links to theme assets
- Improved stylesheet path rewriting to handle relative references
- Added missing content server tables to installer
- Cafe directory now paginated
- Admin sidebar reorganized with dropdown for Cafe management
- Visiting unknown pages now returns 404 with custom error content
- Pricing imported from packages when generating storefront SQL
- Added 2005 v2 archived index template and asset copy script
- Legacy 2003 templates updated with archived HTML
- Missing pages redirect to dedicated error page
- Fixed 2003 v2 theme to load images and styles from its theme directory
- Storefront uses archived stylesheet and images
- Storefront seed SQL includes pricing
- Header & Footer admin simplified button table and supports logo uploads
- Storefront images copied from archive via move_assets.py
- Added dash.gif copy rule to asset mover
- Sidebar links editable with drag-and-drop ordering
- Added featured capsule selector with live preview in admin
- Header button table simplified with drag ordering and logo selector
- Sidebar links stored in new table with default entries
- Logo dropdown shows mini previews
- Automated scan populates move_assets.py with archived theme assets
* Fixed warnings on developer list with missing website fields.
* Corrected product pagination query parameters.
* Added capsule selection dropdowns in storefront admin.
- Fixed settings retrieval for content server page with correct column names.
- Removed obsolete "2003" theme and updated theme checks.
- Resolved parse error when using the 2003_v2 theme index page.
- Fixed 2003_v1 and 2002_v2 themes to load HTML from their own directories rather than the archive.
- Restored 2003 compatibility check on network status page.
- News listing shows full articles again with a line break inserted around 230 characters.
- Added theme_headers and theme_footers tables with admin editing per theme
- Added {nav_buttons} template tag for navigation buttons
- Navigation buttons now show images when available and use theme-defined spacers
- Footer template tag {footer} outputs DB-defined HTML
- Theme CSS paths stored in themes table and editable via admin
- Templates loaded from theme layouts with partials support
- Custom pages choose layout file from dropdown
- Default pages render through layout/default.twig when no template chosen
- Reverted storefront pages to static PHP templates
- Storefront assets load from new per-theme folders
- Template engine supports theme_subdir for partials
- Asset mover updated to migrate 2004 storefront assets and 2005 theme files
- Custom page templates now use {BASE} for theme paths
- Header buttons use text labels instead of images
- Footer and header templates moved into installer
- Added database-driven header tag and theme settings
- Template engine loads theme configuration from database instead of theme files
- Added base Twig templates for 2006_v1, 2006_v2, 2007_v1 and 2007_v2 themes
- Reworked 2006-2007 Twig layouts with full HTML and new content tags
- Introduced storefront_capsules_all and storefront_capsules_per_theme tables
- Admin page now toggles shared or theme-specific capsules and loads from DB
- Added spotlight tab tables and admin UI for theme 2007_v2

- Removed automatic CSS and JS loading; themes must link assets explicitly
- Asset URLs in inline styles are rewritten to theme folders
- 2006_v1 theme seed data for join steam, find links and new on steam list
- Added random_content and scheduled_content tables with dynamic Twig tags
- New admin pages for managing random and scheduled content
- Added `split_title` Twig tag to split headings into emphasized halves
- Added `custom_titles` table and `split_title_entry` Twig tag
- Added admin CRUD interface for custom titles
- Scheduled content admin validates schedule type
- Capsule admin groups existing images by theme
- Asset mover script covers 2006/2007 examples
- Converted map_contest.php to Twig template
- Added TAGS.md with reference for all template tags
- Navigation buttons support per-page overrides via new page field and auto-detect the current template
- Spacer HTML can be configured per theme and overridden when calling {nav_buttons}
- Added theme upload feature allowing ZIP installation from the admin panel

- Storefront templates consolidated under 2005_v1 theme; admin capsule uploads now save to storefront/images/capsules
- Storefront CSS and border images copied via move_assets.py instead of tracking binaries

- 2005 theme GIF assets installed by move_assets.py and removed from the repo

- Added troubleshooter management and support request tracking

- Fixed base URL when rendering storefront pages so theme assets load correctly
- Corrected base path detection so storefront links under subdirectories resolve properly

- Added global PHP error handler with database logging and admin Error Log page

- Installer converts troubleshooter content to UTF-8 to avoid MySQL errors

- Storefront routes preserve legacy query parameters and index.php defaults to browse page
* Added store_pages table to manage storefront page titles and images.
* Removed binary images from themes; asset mover now generates them on demand.
* Fixed title image lookup by aligning store page keys with template tags.
- Added preload and trailer fields to store_apps; screenshots managed individually
- Products now include a checkbox to hide the trailer link on game pages
- Game assets now load from storefront/images/apps/[appid] paths; package page iterates games dynamically
- Admin cafe directory filters by country and state with dropdowns
- Random Content page lets admins create new tag names
- Scheduled Content page's new entry table is compact
- Login screen styled like the installer
- Header/Footer page updates via AJAX when changing theme and stores logos per theme
- Combined survey pages with content server links under one menu, grouped support/FAQ/troubleshooter links, fixed legacy storefront and custom page edit flows, corrected CD key troubleshooter thumbnail, and ensured header/footer logo previews load from theme images.
- Custom page editor resets forms when switching pages so subsequent edits work.
- Aborted in-flight AJAX requests so legacy storefront and custom page edit buttons always load the intended record.
- Settings page allows custom parent/child sidebar links
- FAQ admin pagination includes page numbers
- News admin lists pages with numbered pagination, sortable headers, and button actions
- Developer and custom pages lists use styled buttons for edit/delete
- Admin cafe directory updates table via AJAX and loads states dynamically
- Storefront apps store minimum and recommended system requirements separately
- Installer creates sysreq column for store apps
- Cyber cafe pages render via the default Twig layout with header and footer
- Cyber cafe program pages converted to custom pages
- Content servers can be flagged as filtered and include website links
- Filtered info popup loads from custom page
- Cafe directory add entry widget includes country dropdown
- Content server admin page no longer offers theme selection
- Status page groups servers by region with capacity bars scaled to max 1000
- Status page uses current theme with 2004 fallback
- Fixed stray output from legacy theme config files
- Added 04-05 storefront importer and routing
* Added legacy storefront management UI and importer updates
* Added thirdparty game management for legacy storefront
* Added legacy package importer and unified asset folder
* Legacy storefront game and thirdparty admin pages support AJAX image uploads with automatic file naming

* Added legacy package management page with AJAX uploads
* Thirdparty screenshot uploads now use t2_<id>.ext naming
* Legacy storefront URLs no longer expose the 04-05v1 directory; assets copy to /storefront
* Added bold option for 2002_v2 and 2003_v1 navigation links
* Added logo and sitetitle template tags; nav_buttons accepts color param; custom pages include page_name
* Random content admin page lists tags with edit/delete actions and clarifies `random_` prefix
* Scheduled content "Add New" table shows headers on two lines for better layout
* Added theme_specific_content_start/End tags for conditional theme blocks
* Added random content groups with AJAX creation
* Expanded TAGS.md with admin and database mapping
- News table now stores related products parsed during installation
- Implemented map contest submission pages and admin interface.
- Added Counter-Strike: Source product news page with database-driven pagination
- Added Page Version Management admin page with radio options for legacy forms
- Implemented Download System Management for files and settings
- Added mirror host URLs with 10-entry limit and seeded default downloads
- Added default installer mirrors and updated page selection images
- Removed binary download thumbnails from version control
- Dynamic button rendering for 2004 download pages using text_styler
- Download manager supports theme visibility and optional Steam button text
- Default download files now pre-select visibility based on theme and
  getsteamnow version logic filters dedicated server and update tool entries
- Admin sidebar always shows a Page Version Management link
- Download management uses a simple WYSIWYG editor for descriptions
- Seeded the complete 2004 Steam installer catalog with titles, sizes, and mirror hosts during installation
- Added tournament management admin page and dynamic tournament calendar page.
- Removed obsolete footer from tourney_limited page.
- Added dynamic survey statistics with optional official data import and admin management.
- Installer now seeds official 2006 survey stats from bundled SQL instead of parsing HTML.
- Survey page mirrors archived 2006 design exactly while loading stats from the database.
- Storefront now renders tabbed capsules using saved HTML content and respects capsule ordering.
- Reworked `storefront_capsules_per_theme` with integer ordering, theme checkboxes in the admin modal, and seeded Gear/Freestuff capsules with editable content.
- Installer seeds example character image random group and templates use a random tag for 2003 v2 and 2004 themes.
- Random content tag now resolves image paths from the CMS root instead of theme directories.
- Added generic sidebar renderer for 2006+ themes and introduced initial admin pages for index capsule and sidebar management.
- Removed theme-specific product banners; templates now reference archived assets to avoid binary duplication
- Seeded default 2006+ storefront capsules directly into `storefront_capsule_items` and retired legacy fallbacks
- Stabilized Neon admin sidebar dropdown arrow positioning and styling
- Introduced extensible theme settings with page-targeted widgets and
  plugin API enabling custom admin pages, template tags, sidebar links, and
  tag hooks
- Added global plugin hooks for Twig environment and template rendering, and
  theme settings can target custom tables with typed values
- Ensured plugin migrations and settings tables are created to prevent missing table errors in the plugin API.
