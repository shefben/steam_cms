# Template Tags Reference

This document describes the built-in Twig tags available in the CMS templates. Each tag outputs HTML content pulled from the database or settings tables.

## Basic Tags

- **`header(withButtons = true)`** – Renders the site header. Buttons come from the `theme_headers` table (`logo`, `text`, `img`, `hover`, `depressed`, `url`, `visible`, `spacer`). The `theme` is picked from the current setting.
- **`header_logo(path)`** – Sets the header logo to an image within the active theme before calling `header()`. The path is relative to the theme directory.
- **`footer()`** – Outputs the theme footer HTML stored in the `theme_footers` table (`html`).
- **`nav_buttons(theme = '', style = '', spacer = null, color = null)`** – Generates a navigation bar using entries from `theme_headers`. The current template determines which page-specific buttons to load. The optional `theme` overrides the current theme, `spacer` overrides the spacer stored in the database, and `color` sets the spacer text color.
- **`logo()`** – Outputs the logo image defined in the `theme_headers` table for the current theme.

## News Tags

- **`news(type, count = null)`** – Displays news articles from the `news` table. The `type` controls formatting (`full_article`, `partial_article`, `small_abstract`, `link_only`, `index_summary`, `index_summary_date`, `index_bodygreen`, `index_2006`, `index_brief`). The optional `count` parameter limits the number of articles.
- **`news_index_brief(count = 3)`**, **`news_index_bodygreen(count = 5)`**, **`news_index_2006(count = 5)`** – Convenience wrappers around `news()` with preset formats.

## Simple Text Blocks

These tags pull their text from the `settings` table and simply echo it:

- `join_steam_text`
- `new_on_steam_title`, `new_on_steam_list`
- `latest_news_title`, `latest_news_list`
- `find_title`, `find_list`
- `browse_catalog_title`
- `publisher_catalogs_title`, `publisher_catalogs_list`
- `coming_soon_title`, `coming_soon_list`
- `gear_block`, `free_block`

## Join Steam Block

- **`join_steam_block(style = '2006')`** – Renders a small promo table using the `join_steam_text` setting. Pass `'2007'` for an alternate layout.

## Storefront Tags

- **`categories_list()`** – Lists visible categories from `store_categories` (`id`, `name`, `visible`, `ord`).
- **`capsule_block(key)`** and **`large_capsule_block(key = 'large')`** – Display storefront capsules. Data comes from `storefront_capsules_all` or `storefront_capsules_per_theme` depending on the `capsules_same_all` setting. Important columns include `position`, `image_path`, `appid` and `price`.
- **`featured_capsules()`** – Outputs a static set of capsule images defined in the `store_capsules` table (`position`, `appid`, `image`).
- **`store_sidebar()`** – Generates sidebar navigation from `store_sidebar_links` (`label`, `url`, `type`, `ord`, `visible`).
- **`tabs_block()`** – For theme `2007_v2` displays tabbed lists built from `storefront_tabs` and `storefront_tab_games` tables.

## Title Helpers

- **`split_title(text)`** – Splits a string into two emphasized halves using the rules described in the prompt. Outputs the provided HTML snippet.
- **`split_title_entry(name)`** – Fetches `title_content` from the `custom_titles` table for a given `title_name` and renders it with `split_title`.
- **`sitetitle()`** – Displays the current page's `page_name` using the 2002/2003 title style.

## Conditional Tags

- **`theme_specific_content_start(themes)`** and **`theme_specific_content_end()`** – Wrap page fragments that should only display when the active theme matches one of the comma-separated `themes`.

## Dynamic Content Tags

Tags that start with `random_` or `scheduled_` are resolved at runtime. Random content tag names are stored without the `random_` prefix in the database:

- **`random_<tagname>`** – Looks up all matching rows in `random_content` (`tag_name`, `content`) and returns one entry at random on each page load.
- **`scheduled_<tagname>`** – Reads entries from `scheduled_content` and checks the scheduling fields. Important columns include `schedule_type` (`every_n_days`, `day_of_month`, `fixed_range`), date fields, and `active` flag. Matching rows are concatenated and displayed.

## Development Notes

- All tags output raw HTML and are marked safe for Twig.
- Theme files reside in `themes/<year_variant>/` with layouts under `layout/`.
- New tags can be added in `cms/template_engine.php` by registering additional `TwigFunction` objects.

