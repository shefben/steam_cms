# Template Tags Reference

This document describes the built-in Twig tags available in the CMS templates. Each tag outputs HTML content pulled from the database or settings tables.

## Basic Tags

### `header(withButtons = true)`
Renders the site header for the active theme.

- **withButtons** (`bool`, default `true`): when `false` the navigation buttons are omitted.
- **Example:**
  ```twig
  {{ header() }}            {# header with buttons #}
  {{ header(false) }}       {# header without buttons #}
  ```

### `header_logo(path)`
Sets a temporary header logo before outputting the header.

- **path** (`string`): image path relative to the active theme directory.
- **Example:**
  ```twig
  {{ header_logo('images/custom_logo.gif') }}
  {{ header() }}
  ```

### `content_header_image()`
Outputs the content header image for the current page. Custom pages use their assigned image; other pages fall back to the `content_header_image` setting.

- **Example:** `{{ content_header_image() }}`

### `footer()`
Outputs the HTML footer stored in the `theme_footers` table.

- **Example:** `{{ footer() }}`

### `nav_buttons(theme = '', style = '', spacer = null, color = null)`
Generates the navigation bar using button definitions from `theme_headers`.

- **theme** (`string`, default `''`): override the current theme when loading buttons.
- **style** (`string`, default `''`): inline CSS applied to the spacer element between buttons.
- **spacer** (`?string`, default `null`): overrides the spacer character from the database.
- **color** (`?string`, default `null`): hex color (`#RRGGBB`) applied to the spacer text.
- **Example:**
  ```twig
  {{ nav_buttons() }}
  {{ nav_buttons('2006_v2', 'font-weight:bold', '|', '#ffffff') }}
  ```

### `logo()`
Outputs the logo image defined for the active theme.

- **Example:** `{{ logo() }}`

## News Tags

### `news(type, count = null)`
Fetches and renders news articles.

- **type** (`string`): determines the layout. Supported values are:
  - `full_article` – full body with title, author and date.
  - `partial_article` – truncated body with “Continue Reading” link.
  - `small_abstract` – title with a short summary.
  - `link_only` – title linked to the full article.
  - `index_summary` – title plus first sentence.
  - `index_summary_date` – summary with short date.
  - `index_bodygreen` – summary styled with BodyGreen classes.
  - `index_2006` – compact link format used by 2006 themes.
  - `index_brief` – very short summary used on the index page.
- **count** (`int|null`, default `null`): maximum number of articles to display. `null` uses the theme default.
- **Example:** `{{ news('full_article', 5) }}`
- Articles missing a `publish_at` timestamp fall back to their `publish_date` for ordering and visibility.

### `news_index_brief(count = 3)`
Shortcut for `news('index_brief', count)`.

### `news_index_bodygreen(count = 5)`
Shortcut for `news('index_bodygreen', count)`.

### `news_index_2006(count = 5)`
Shortcut for `news('index_2006', count)`.

### `news_archive_months(year, months = 12)`
Outputs links for the previous `months` months pointing to the archive for `year`.
- **year** (`int`): theme year displayed in the header.
- **months** (`int`, default `12`): number of months to include starting from the current month.
- **Example:** `{{ news_archive_months(2006) }}`

### `html_title()`
Returns the HTML `<title>` text.

### `steam_news_title()`
Returns the “STEAM NEWS” heading.

### `rss_feed_title()`
Label for the RSS feed link.

### `news_archive_title(year)`
Displays the archive header for the given year.
- **year** (`int`): year to show in the header.

### `full_archive_title()`
Label for the link to the full news archive.

### `news_search_bar()`
Outputs the news search form used by 2007 themes.
- **Example:** `{{ news_search_bar() }}`

### `getsteamnow_button(text)`
Renders a "Get Steam Now" button with custom text.
- **text** (`string`): button label text.
- **Example:** `{{ getsteamnow_button('Download Steam') }}`

### `sidebar_right(year, page = 'news')`
Renders the right-hand sidebar for the given `page`. For `page = 'news'`, 2006 themes display the STEAM NEWS header, RSS link and archive months while 2007 themes show the search bar.

- **year** (`int`): theme year.
- **page** (`string`, default `'news'`): page context.
- **Example:** `{{ sidebar_right(2006) }}`

## Simple Text Blocks

Each of these tags outputs raw HTML stored in the `settings` table. Lists accept a `rows` parameter to control how many rows are rendered (column counts are fixed).

- `join_steam_text()` – promotional blurb for the Join Steam box.
- `gear_block()`, `free_block()` – sidebar promo blocks.
- `support_email()` – support contact address.

### `sidebar_section(name, options = {})`
Renders a sidebar block using the active theme's template located under `layouts/sidebar_sections/`.
The block's links and content are loaded from `sidebar_sections`, `sidebar_section_variants`,
and `sidebar_section_entries` for the current theme.
`name` selects the section (e.g., `search`, `get_steam_now`, `new_on_steam`, `latest_news`).
`options` may provide values like `rows` or `limit` depending on the section.
For `new_on_steam`, the RSS feed link is auto-appended on 2006 themes; later themes include it in the seed data.
`latest_news` adds a "Read more news" link for pre-2007 themes while newer themes store the link with their entries.

## Join Steam Block

### `join_steam_block(style = '2006')`
Outputs a promotional block inviting users to install Steam.

- **style** (`string`, default `'2006'`): layout variant. Use `'2007'` for the 2007 theme styling.
- **Example:** `{{ join_steam_block('2007') }}`

## Storefront Tags

### `categories_list()`
Outputs links to all visible categories.
- **Example:** `{{ categories_list() }}`

### `capsule_block(key)`
Displays a single storefront capsule with image, price and link.
- **key** (`string`): capsule position such as `top`, `middle`, `bottom_left`, `bottom_right`.
- **Example:** `{{ capsule_block('top') }}`

### `large_capsule_block(key = 'large')`
Renders a large-feature capsule.
- **key** (`string`, default `'large'`): capsule position/identifier.
- **Example:** `{{ large_capsule_block() }}`

### `featured_capsules()`
Outputs a static arrangement of capsules defined in `store_capsules`.
- **Example:** `{{ featured_capsules() }}`

### `store_sidebar()`
Generates storefront sidebar navigation links.
- **Example:** `{{ store_sidebar() }}`

### `storefront_capsules()`
Renders a collection of storefront game capsules with prices and images. Used for main storefront layouts.
- **Example:** `{{ storefront_capsules() }}`

### `tabs_block()`
For theme `2007_v2`, renders tabbed game lists built from `storefront_tabs` and `storefront_tab_games`.
- **Example:** `{{ tabs_block() }}`

### `custom_index_sidebar_configurations()`
Returns JSON configuration for customizable sidebar elements on the index page.
- **Example:** `{{ custom_index_sidebar_configurations() }}`

### `tournament_calendar(months = 4)`
Displays a calendar of upcoming tournaments.
- **months** (`int`, default `4`): number of months to show starting from current month.
- **Example:** `{{ tournament_calendar(6) }}`

## 2008 Theme Tags

These tags are specifically designed for the 2008 Steam themes and provide enhanced functionality and layouts:

### `header_2008()`
Renders the 2008-specific header layout with updated styling and navigation.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ header_2008() }}`

### `cart_status()`
Displays the shopping cart status for the 2008 theme. Currently returns empty content but designed for future cart functionality.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ cart_status() }}`

### `sidebar_2008_search()`
Renders the enhanced search section for 2008 theme sidebars.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_search() }}`

### `sidebar_2008_browse()`
Displays the browse section with categories and navigation for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_browse() }}`

### `sidebar_2008_install_steam()`
Shows the "Install Steam" promotional section with 2008 styling.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_install_steam() }}`

### `sidebar_2008_freeloads()`
Displays free content and downloads section for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_freeloads() }}`

### `sidebar_2008_news()`
Renders the news section specifically formatted for 2008 theme sidebars.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_news() }}`

### `sidebar_2008_catalogs()`
Shows the game catalogs section for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_catalogs() }}`

### `sidebar_2008_steam_info()`
Displays Steam information and help links for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_2008_steam_info() }}`

### `large_capsule_flash_2008()`
Renders a large featured game capsule with 2008 Flash-style animations and effects.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ large_capsule_flash_2008() }}`

### `small_capsules_2008()`
Displays a collection of small game capsules with 2008 theme styling.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ small_capsules_2008() }}`

### `tabbed_single_column_capsule()`
Shows tabbed content with single-column capsule layout for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ tabbed_single_column_capsule() }}`

### `extras_section_2008()`
Renders additional content and extras section for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ extras_section_2008() }}`

### `sidebar_right_2008()`
Displays the complete right sidebar layout for 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ sidebar_right_2008() }}`

### `footer_2008()`
Renders the footer with 2008-specific styling and content.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ footer_2008() }}`

### `tab_switching_script()`
Provides JavaScript functionality for tab switching in 2008 themes.
- **Theme Specific:** 2008 themes only
- **Example:** `{{ tab_switching_script() }}`

## Platform Tags

### `platform_update_news()`
Outputs update history entries for the current app ID.

- Requires the global variable `$platform_update_appid` to be set before rendering.
- Entries are collapsible and are read from `platform_update_history`.
- **Example:** `{{ platform_update_news() }}`

## Title Helpers

### `split_title(text)`
Splits a string into two emphasized halves.
- **text** (`string`): title to split.
- **Example:** `{{ split_title('Steam Powered') }}`

### `split_title_entry(name)`
Looks up a named title fragment in `custom_titles` and renders it with `split_title`.
- **name** (`string`): value of `title_name` to fetch.
- **Example:** `{{ split_title_entry('home') }}`

### `page_title_2002()`
Displays the current page's `page_name` using the 2002 banner style.
- **Example:** `{{ page_title_2002() }}`

### `sitetitle()`
Shows the current page name using the 2002/2003 style.
- **Example:** `{{ sitetitle() }}`

## Utility Tags

### `current_theme()`
Returns the identifier of the active theme.
- **Example:** `{{ current_theme() }}`

### `current_page()`
Returns the slug of the current page.
- **Example:** `{{ current_page() }}`

## Conditional Tags

### `theme_specific_content_start(themes)` / `theme_specific_content_end()`
Capture a block of markup that should only appear for certain themes.

- **themes** (`string`): comma-separated list of theme identifiers.
- Usage:
  ```twig
  {{ theme_specific_content_start('2006_v2,2007_v1') }}
  <p>Only visible on selected themes.</p>
  {{ theme_specific_content_end() }}
  ```

## Dynamic Content Tags

Tags beginning with `random_` or `scheduled_` are created on the fly.

### `random_<group>`
Selects one random entry from `random_content` where the group name matches `<group>`.
- **Example:** `{{ random_sidebar }}`
- Image paths beginning with `images/` are rewritten to load from the CMS root (`./images/`).

### `scheduled_<tagname>`
Outputs all active rows from `scheduled_content` with `tag_name` of `<tagname>` and whose schedule matches the current date.
- Supports `every_n_days`, `day_of_month`, and `fixed_range` scheduling modes.
- **Example:** `{{ scheduled_weekly_feature }}`

## Development Notes

- All tags output raw HTML and are marked safe for Twig.
- Theme files reside in `themes/<year_variant>/` with layouts under `layout/`.
- New tags can be added in `cms/template_engine.php` by registering additional `TwigFunction` objects.

## Admin & Database Mapping

The following table lists each tag or tag group, where its content is managed in the administrator UI, and which database tables store the information.

| Tag(s) | Admin Screen | Database Tables |
|--------|--------------|-----------------|
|`header`, `nav_buttons`, `logo`, `header_logo`|**Header/Footer** (`header_footer.php`)|`theme_headers`, `theme_settings`, `theme_footers`|
|`footer`|**Header/Footer**|`theme_footers`|
|`news*` tags|**News** (`news.php`)|`news`|
|`join_steam_text`, `join_steam_block`|**Settings** (`settings.php`)|`settings`|
|`gear_block`, `free_block`|**Settings**|`settings`|
|`sidebar_section`|**Sidebar Sections** (`index_sidebar_management.php`)|`sidebar_sections`, `sidebar_section_variants`, `sidebar_section_entries`|
|`categories_list`|**Storefront Categories** (`storefront_categories.php`)|`store_categories`|
|`capsule_block`, `large_capsule_block`, `featured_capsules`, `storefront_capsules`|**Storefront Main** (`storefront_main.php`) and **Upload Capsule** (`upload_capsule.php`)|`storefront_capsules_all`, `storefront_capsules_per_theme`, `store_capsules`|
|`store_sidebar`|**Storefront Sidebar** (`storefront_sidebar.php`)|`store_sidebar_links`|
|`tabs_block`|**Storefront Main**|`storefront_tabs`, `storefront_tab_games`|
|`tournament_calendar`|**Tournaments** (`tournaments.php`)|`tournaments`|
|`platform_update_news`|N/A|`platform_update_history`|
|`split_title_entry`|**Custom Titles** (`custom_titles.php`)|`custom_titles`|
|`sitetitle`, `page_title_2002`|**Custom Pages** (`custom_pages.php`)|`custom_pages`|
|`content_header_image`|**Settings** (`settings.php`), **Custom Pages** (`custom_pages.php`)|`settings`, `custom_pages`|
|`theme_specific_content_start`, `theme_specific_content_end`|N/A|N/A|
|`current_theme`, `current_page`|N/A|N/A|
|`custom_index_sidebar_configurations`|**Index Sidebar Management** (`index_sidebar_management.php`)|Various sidebar tables|
|All `*_2008` tags|**Settings** and **Storefront** pages|Various storefront and content tables|
|`getsteamnow_button`|**Settings**|`settings`|
|`random_<group>`|**Random Content** (`random_content.php`) and **Random Groups** (`random_groups.php`)|`random_content`, `random_groups`|
|`scheduled_<tag>`|**Scheduled Content** (`scheduled_content.php`)|`scheduled_content`|

