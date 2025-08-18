# Current Issues in CMS PHP Scripts

The following problems were identified after the latest round of fixes:

- **cms/admin/search.php** – Exposes internal admin PHP filenames through the search results, increasing the attack surface.
- **cms/plugin_api.php** – Automatically loads any plugin file in the plugins directory without verifying signatures or trust, allowing execution of arbitrary code.
