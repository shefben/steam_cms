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

The template engine exposes a set of Twig functions used to render dynamic content. Below is the complete list together with any arguments and typical usage.

| Tag | Arguments / Types | Description & Usage |
|-----|-------------------|---------------------|
| `header(withButtons=true)` | – | Render the theme header including the navigation buttons. Used at the top of every layout. |
| `footer()` | – | Output the theme footer. Placed at the bottom of layouts. |
| `nav_buttons(theme, style, spacer)` | `theme` (string), `style` (string), `spacer` (string) | Load navigation links. The active template decides which page-specific buttons to show. The spacer argument overrides the stored value. |
| `news(type, count)` | `type` can be `full_article`, `partial_article`, `small_abstract`, `link_only`, `index_summary`, `index_summary_date`, `index_bodygreen`, `index_2006`, `index_brief`. `count` limits the number of items. | Generic news renderer. The helpers `news_index_brief`, `news_index_bodygreen` and `news_index_2006` call this with preset types. |
| `news_index_brief(count)` | – | Convenience wrapper for `news('index_brief', count)`. Appears on early home pages. |
| `news_index_bodygreen(count)` | – | Wrapper for `news('index_bodygreen', count)`. |
| `news_index_2006(count)` | – | Wrapper for `news('index_2006', count)` used by the 2006 themes. |
| `join_steam_text()` | – | Returns the marketing text for the “Join Steam” section. |
| `join_steam_block(style)` | `style` is `2006` or `2007` | Renders the full “Join Steam” promo block. Inserted near the top of the page. |
| `new_on_steam_title()` | – | Title string for the “New On Steam” list. |
| `new_on_steam_list()` | – | HTML list of the most recent releases. |
| `latest_news_title()` | – | Title string for the “Latest News” list. |
| `latest_news_list()` | – | HTML list for news headlines. |
| `find_title()` | – | Title string for the “Find” links area. |
| `find_list()` | – | HTML links for searching, browsing and videos. |
| `categories_list()` | – | List of store categories linking to search results. Typically shown under the find list. |
| `browse_catalog_title()` | – | Title for the browse catalog section. |
| `browse_catalog_list()` | – | HTML list for the browse catalog section. |
| `publisher_catalogs_title()` | – | Title string for the publisher catalog block. |
| `publisher_catalogs_list()` | – | HTML list of publisher catalogs. |
| `coming_soon_title()` | – | Title for the “Coming Soon” list. |
| `coming_soon_list()` | – | HTML list of upcoming releases. |
| `capsule_block(key)` | `key` can be positions like `top1`, `top2`, `under1`, `under2`, `bottom1`, `bottom2` | Outputs a small storefront capsule image and price for the given slot. |
| `large_capsule_block(key)` | usually `large` | Renders the large promotional capsule. |
| `store_sidebar()` | – | Generates the left menu for storefront pages. |
| `featured_capsules()` | – | Layout helper used by early store pages to show multiple highlighted capsules. |
| `gear_block()` | – | Insert HTML for the Steam gear advertisement. |
| `free_block()` | – | Insert HTML promoting free content. |
| `tabs_block()` | – | Dynamic tab list used by the 2007 storefront theme. |

These tags allow layouts to remain clean and theme agnostic while pulling dynamic data from the CMS.

## How rendering works

When a page is requested the CMS resolves the active theme and looks for a layout under that theme’s `layouts/` directory. If the file is missing it falls back to the default theme. Template files are processed by Twig and receive variables like `BASE`, `THEME_URL` and custom page content.

Only templates inside the `layouts/` folder (or partial subfolders) should be used. Legacy PHP files outside this folder are ignored.

