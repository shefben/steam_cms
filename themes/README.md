# Theme Creation Guide

This document explains how to create new themes for the Steam Powered CMS. Themes live under the `themes/` directory and are named by year and variant, for example `2004`, `2005_v2` or `2007_v1`.

## Folder structure

```
themes/
  {year}_{variant}/
    layouts/        # Page templates (*.twig)
    partials/       # Optional partial templates
    images/         # Theme images
    css/            # Stylesheets
    js/             # JavaScript files
    storefront/     # Store specific templates
```

Templates in the `layouts/` directory are loaded by the template engine and use the `.twig` extension. Partials may live inside `partials/` or `storefront/layouts/`.

## Template tags

Layouts can call a number of tags provided by `cms/template_engine.php`:

- `{{ header() }}` – outputs the theme header with navigation.
- `{{ footer() }}` – outputs the theme footer.
- `{{ nav_buttons(theme, style) }}` – render navigation links from another theme or style.
- `{{ news(type, count) }}` – display news items. Types include `index_brief`, `index_bodygreen`, `index_2006` and others.
- `{{ join_steam_block(style) }}` – show the “Join Steam” block in different styles.
- `{{ capsule_block(key) }}` – storefront capsule image and price for a position.
- `{{ tabs_block() }}` – storefront tab list for the 2007 theme.

Additional helpers exist for titles and lists such as `new_on_steam_title`, `new_on_steam_list`, `latest_news_title`, `latest_news_list`, etc.

## How rendering works

When a page is requested the CMS resolves the active theme and looks for a layout under that theme’s `layouts/` directory. If the file is missing it falls back to the default theme. Template files are processed by Twig and receive variables like `BASE`, `THEME_URL` and custom page content.

Only templates inside the `layouts/` folder (or partial subfolders) should be used. Legacy PHP files outside this folder are ignored.

