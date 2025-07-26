* Implement triggers to populate notifications for pending signups, incomplete imports, and new version releases.
* Add CSV/JSON import/export support to remaining admin lists (FAQ, storefront, etc.).
* Add tests covering template engine asset path handling for themes
* Verify CSS path rewrite logic when themes reference files with duplicate slashes
* Create tests ensuring root-level theme stylesheets are rewritten without extra directories
* Confirm asset URLs omit the leading slash when no base path is defined
* Test rewriting of JavaScript newImage() paths to theme images
* Profile slow database queries and add indexes where appropriate
* Add migration to add `publish_at` index for the existing news table
* Enhance package description field with a WYSIWYG editor
