# SteamPowered (2002–2010) CMS Re-Creation

A comprehensive content management system that recreates the historical steampowered.com website from 2002 to 2010, pixel for pixel and link for link. This CMS supports multiple themes representing different years and provides a modern admin interface for managing content.

## Features

### Historical Accuracy
- **Pixel-perfect recreation** of Steam websites from 2002-2010
- **Multiple theme support** with year-specific variants (2002, 2003, 2004, 2005, 2006, 2007, 2008)
- **Original asset preservation** including images, CSS, and JavaScript
- **Authentic navigation** and user interface elements

### Modern CMS Capabilities
- **Twig templating engine** with extensive custom tags
- **MariaDB/MySQL database** with normalized schema
- **Admin interface** with role-based permissions
- **Content management** for news, pages, storefront items, and more
- **Cache system** with automatic invalidation
- **Plugin architecture** for extensibility

### Content Types
- **News articles** with multiple display formats
- **Custom pages** with theme-specific layouts
- **Storefront capsules** and game information
- **Sidebar sections** and promotional content
- **Random and scheduled content** blocks
- **Tournament calendars** and event management

## Installation

### Requirements
- PHP 8.x with PDO support
- MariaDB/MySQL 8.x
- Web server (Apache/Nginx)
- At least 1GB disk space for themes and assets

### Setup
1. Extract files to your web server document root
2. Import the database schema from `sql/` directory
3. Copy `cms/config.sample.php` to `cms/config.php` and configure database settings
4. Set proper file permissions for cache directories
5. Access `/cms/admin/` to begin configuration

## Template Tags Reference

The CMS provides an extensive library of template tags for creating theme templates. See [TAGS.md](TAGS.md) for complete documentation.

### Basic Usage
```twig
{{ header() }}                    {# Site header with navigation #}
{{ news('full_article', 5) }}     {# Display 5 full news articles #}
{{ sidebar_section('search') }}   {# Sidebar search section #}
{{ footer() }}                    {# Site footer #}
```

### Theme-Specific Tags
```twig
{# 2006 theme features #}
{{ join_steam_block('2006') }}
{{ capsule_block('large') }}

{# 2008 theme features #}
{{ header_2008() }}
{{ sidebar_2008_search() }}
{{ large_capsule_flash_2008() }}
```

### Dynamic Content
```twig
{{ random_sidebar }}              {# Random content from 'sidebar' group #}
{{ scheduled_feature }}           {# Scheduled content with 'feature' tag #}
```

## Administrative Interface

### Content Management
- **News Management** (`/cms/admin/news.php`) - Create and edit news articles
- **Custom Pages** (`/cms/admin/custom_pages.php`) - Manage static pages
- **Storefront** (`/cms/admin/storefront_main.php`) - Configure game capsules and store content
- **Sidebar Sections** (`/cms/admin/index_sidebar_management.php`) - Customize sidebar content

### System Configuration
- **Settings** (`/cms/admin/settings.php`) - Global CMS settings
- **Theme Management** (`/cms/admin/theme.php`) - Switch between historical themes
- **Header/Footer** (`/cms/admin/header_footer.php`) - Configure navigation and branding
- **Performance** (`/cms/admin/performance.php`) - Cache and optimization settings

### User Management
- **Admin Users** (`/cms/admin/admin_users.php`) - Manage administrator accounts
- **Roles** (`/cms/admin/roles.php`) - Configure permissions and access levels

## Theme Development

### Theme Structure
```
themes/
├── 2004/
│   ├── templates/           # Twig template files
│   ├── assets/             # CSS, JS, and images
│   └── config.php          # Theme configuration
├── 2006_v1/
├── 2007_v2/
└── 2008/
```

### Creating Templates
Templates use Twig syntax with custom CMS tags:

```twig
<!DOCTYPE html>
<html>
<head>
    <title>{{ html_title() }}</title>
    <link rel="stylesheet" href="{{ CSS_PATH }}">
</head>
<body>
    {{ header() }}
    
    <div class="content">
        {% block content %}{% endblock %}
    </div>
    
    {{ footer() }}
</body>
</html>
```

### Theme Configuration
Each theme includes a `config.php` file with settings:

```php
<?php
return [
    'news_count' => 10,
    'sidebar_width' => 250,
    'enable_flash' => false
];
```

## Plugin Development

The CMS supports plugins for extending functionality without modifying core files.

### Plugin Structure
```
plugins/
└── my_plugin/
    └── plugin.php
```

### Basic Plugin
```php
<?php
// Register admin page
cms_register_admin_page('my_plugin', 'My Plugin', function() {
    echo '<h2>My Plugin Settings</h2>';
});

// Register template tag
cms_register_template_tag('my_tag', function($text) {
    return '<strong>' . htmlspecialchars($text) . '</strong>';
});

// Add event hook
cms_add_hook('template_post_render', function($html) {
    return $html . '<!-- My plugin was here -->';
});
```

## Cache System

The CMS includes an advanced caching system with:
- **File timestamp validation** - Cache automatically invalidates when source files change
- **Automatic clearing** - Cache clears on admin saves and updates
- **Namespace support** - Separate cache areas for different content types
- **Source file tracking** - Dependencies tracked for intelligent invalidation

### Cache Management
Cache is managed automatically but can be controlled via:
- **Performance Settings** - Enable/disable caching globally
- **Admin Interface** - Cache status and manual clearing options
- **API Functions** - `cms_clear_all_caches()` for programmatic control

## Database Schema

### Core Tables
- `news` - News articles and content
- `custom_pages` - Static pages and custom content
- `settings` - Global configuration options
- `admin_users` - Administrator accounts and permissions

### Theme Tables
- `theme_headers` - Navigation and header content
- `theme_footers` - Footer content by theme
- `theme_settings` - Theme-specific configuration

### Storefront Tables
- `store_apps` - Game and application information
- `storefront_capsules_all` - Global storefront capsules
- `storefront_capsules_per_theme` - Theme-specific capsules
- `store_categories` - Product categories

### Content Management Tables
- `sidebar_sections` - Sidebar content blocks
- `random_content` - Random content pool
- `scheduled_content` - Time-based content
- `tournaments` - Tournament and event data

## Security Features

- **SQL injection protection** via prepared statements
- **XSS prevention** through proper output escaping
- **CSRF protection** on admin forms
- **Session management** with secure tokens
- **Role-based access control** for admin functions
- **Input validation** and sanitization

## Performance Optimizations

- **Template caching** with source file dependency tracking
- **CSS preprocessing** and minification
- **Database query optimization** with indexed lookups
- **Asset compression** and browser caching headers
- **Memory usage monitoring** and optimization

## File Organization

```
├── cms/                    # Core CMS files
│   ├── admin/             # Administrative interface
│   ├── utilities/         # Helper functions and tools
│   ├── cache/             # Cache storage directory
│   ├── db.php             # Database abstraction layer
│   ├── template_engine.php # Twig integration and tags
│   └── plugin_api.php     # Plugin system
├── themes/                # Theme files and assets
├── plugins/               # Plugin directory
├── sql/                   # Database schema and migrations
├── tests/                 # Test suite
└── tools/                 # Development and maintenance tools
```

## Contributing

### Development Standards
- Follow PSR-12 coding standards
- Use strict type declarations
- Implement comprehensive error handling
- Write tests for new functionality
- Document all public APIs

### Testing
Run the test suite:
```bash
php tests/CacheInvalidationTest.php
phpunit --colors=always
```

### Historical Accuracy
When working on theme recreations:
- Reference original archive captures
- Maintain pixel-perfect layouts
- Preserve authentic user interactions
- Test across different screen resolutions

## License

This project recreates historical Steam website designs for educational and preservation purposes. All Steam-related trademarks and assets belong to Valve Corporation.

## Support

For documentation, examples, and support:
- Review the [TAGS.md](TAGS.md) for template tag reference
- Check [FEATURES.md](FEATURES.md) for implemented functionality
- See [CHANGELOG.md](CHANGELOG.md) for version history
- Visit the admin interface help sections

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed version history and feature additions.