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
