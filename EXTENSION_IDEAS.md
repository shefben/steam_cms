# Extensibility Ideas

## Plugin API
- Event system for database migrations during plugin install/uninstall
- Ability to register REST endpoints for AJAX-based admin features
- Plugin-provided CLI commands for maintenance tasks
- Versioned plugin metadata with dependency resolution
- Ability to enqueue custom CSS/JS assets on admin pages
- Support for internationalization via translation files
- Background job hooks for queueing long-running tasks
- Security policy allowing plugins to declare required capabilities
- Plugin-defined Twig filters in addition to functions
- Composer-like autoloader per plugin to organize code

## Theme Customization
- Support for per-theme database migrations during activation
- Widget groups and tabs for complex configuration pages
- Conditional field visibility based on other setting values
- Ability to define custom database schemas for arbitrary tables
- Theme-specific asset compilation (e.g., SCSS to CSS) on install
- Live preview mode to test settings without activating
- Export/import of theme settings between installations
- Versioned theme manifests with upgrade paths
- Integration of third-party widget libraries (color pickers, media pickers)
- Access control rules to limit which admins can edit theme options
