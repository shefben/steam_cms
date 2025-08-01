# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
- Cafe directory importer parses text files and deduplicates entries
- Cafe directory seed SQL includes country and state data
- Introduced role-based permission system with new roles admin page
- Permissions on role and user forms presented as selectable checkboxes with all/none toggles
- Admin dashboard graphs now use Chart.js with weekly/monthly toggles
- Admin news list supports filtering by title and author with AJAX pagination
- Added preview endpoint with theme selection and admin-only access
- Admin login styled with theme CSS, includes jQuery validation and reset link
- News articles can be scheduled and auto-published when publish date is reached
- Admin sidebar links now support drag-and-drop sorting with dynamic add/remove
- Custom page template fallback now loads `default.twig` from the active theme
- Add storefront dropdown navigation in admin sidebar
- Global header bar uses 2006 layout with dynamic navigation
- Header bar styles now output inline with the 2006 layout
- CSS links beginning with ./ now resolve to the root website path
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
- Download management uses a simple WYSIWYG editor for descriptions and the Page Version Management screen lists all legacy download options
- Seeded the complete 2004 Steam installer catalog with titles, sizes, and mirror hosts during installation
- Added tournament management admin page and dynamic tournament calendar page.
- Removed obsolete footer from tourney_limited page.
