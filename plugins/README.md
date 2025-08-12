# Plugin API Guide

Plugins extend the CMS without modifying core files. Each plugin lives in
`plugins/{name}/plugin.php` and uses the helpers from `cms/plugin_api.php`.

## Registration Functions

- `cms_register_admin_page($slug, $title, $callback, $parent = null)` – Add a
  new admin page. Automatically adds a sidebar link; `$parent` (a file id like
  `demo_root.php`) nests the link.
- `cms_register_sidebar_link($file, $label, $url, $parent = null)` – Add a raw
  sidebar link.
- `cms_register_template_tag($name, $callback)` – Expose a new Twig template tag
  that returns HTML.
- `cms_hook_template_tag($tag, $when, $callback)` – Run code `before` arguments
  are processed or `after` a tag renders.
- `cms_add_hook($event, $callback)` – Listen for global events like
  `twig_environment`, `template_pre_render`, or `template_post_render`.

## Examples

Two example plugins are included:

- `simple_hello` – minimal plugin adding an admin page, template tag, and a
  post-render hook.
- `full_demo` – showcases nested pages, sidebar links, tag creation, tag
  hooks, and template pre/post render hooks.
