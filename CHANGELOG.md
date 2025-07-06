# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
- Add storefront dropdown navigation in admin sidebar
- Templated 2005 v1 index page with dynamic news, 2004 header, and dynamic footer
- Introduce root path site setting and base URL handling
- Removed news box height limit in 2004 theme for exact layout
- Added setting to limit news by theme year
- Random banner endpoint pulls from custom folder regardless of theme
- Implemented index_brief news token for 2004 theme
- Created separate storefront admin pages for products, categories and sidebar
- Fixed storefront menu auto-expansion and navigation order

- Added two-line word limit for index news snippets
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
- Default pages render through layout/default.tpl when no template chosen
- Reverted storefront pages to static PHP templates
- Storefront assets load from new per-theme folders
- Template engine supports theme_subdir for partials
- Asset mover updated to migrate 2004 storefront assets and 2005 theme files
- Custom page templates now use {BASE} for theme paths
- Header buttons use text labels instead of images
- Footer and header templates moved into installer
- Added database-driven header tag and theme settings
- Template engine loads theme configuration from database instead of theme files
