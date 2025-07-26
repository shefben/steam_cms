# CMS Performance Analysis

## Identified Bottlenecks

- Settings lookups (`cms_get_setting`) query the database on every call. Pages invoke this function dozens of times which adds latency.
- Twig templates are parsed on each request without caching compiled templates.
- Template rendering rewrites asset URLs via expensive regular expressions for every request.
- Several Twig functions run database queries inside loops (e.g. `cms_render_news`).

## Implemented Optimizations

- Added an in-memory cache for `cms_get_setting` to avoid repeated queries.
- Enabled Twig's filesystem cache at `cms/cache/twig` so templates are compiled once.
- Cached theme header, footer, CSS, and config lookups to minimize database hits.
- Added file-based caching for `cms_render_news` output to avoid repeated queries.
- Indexed the `publish_at` column of the `news` table for faster ordering.

## Further Recommendations

- Profile database queries and add indexes where slow.
- Consider caching final rendered pages when content changes infrequently.
- Review Twig helper functions for redundant queries and batch them where possible.

