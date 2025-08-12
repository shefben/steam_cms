<?php
/**
 * SteamCMS Plugin API
 * -------------------
 *
 * This lightweight API allows extensions to hook into the CMS without
 * modifying core files. Plugins live in `/plugins/{name}/plugin.php` and call
 * the registration functions defined here. Each function is documented with
 * verbose comments to make creating plugins approachable.
 */

declare(strict_types=1);

use Twig\Environment;
use Twig\TwigFunction;

// Global container for registered plugin features.
$cms_plugins = [
    'sidebar_links' => [],   // Navigation entries for the admin sidebar
    'admin_pages'   => [],   // Custom admin pages (slug => [title, callback])
    'template_tags' => [],   // Additional Twig template tags
    'tag_hooks'     => [],   // Hooks on template tags (name => ['before'=>[], 'after'=>[]])
    'hooks'         => [],   // Generic event hooks (event => [callbacks])
];

/**
 * Register a new link in the admin sidebar.
 *
 * @param string      $file   Unique id for the link; used internally.
 * @param string      $label  Text shown in the sidebar.
 * @param string      $url    HREF target for the link.
 * @param string|null $parent Optional parent id to nest this link beneath.
 */
function cms_register_sidebar_link(string $file, string $label, string $url, ?string $parent = null): void
{
    global $cms_plugins;
    $cms_plugins['sidebar_links'][] = [
        'file'   => $file,
        'label'  => $label,
        'url'    => $url,
        'parent' => $parent,
        'visible'=> 1,
    ];
}

/**
 * Register a plugin-owned admin page.
 *
 * The page becomes available at `cms/admin/plugin.php?page=$slug` and a sidebar
 * link is automatically added.
 *
 * @param string   $slug     Identifier for the page.
 * @param string   $title    Human friendly title shown in navigation and page heading.
 * @param callable $callback Function that echoes the page contents when invoked.
 * @param string|null $parent Optional parent sidebar id for nesting.
 */
function cms_register_admin_page(string $slug, string $title, callable $callback, ?string $parent = null): void
{
    global $cms_plugins;
    $cms_plugins['admin_pages'][$slug] = [
        'title'    => $title,
        'callback' => $callback,
    ];
    cms_register_sidebar_link($slug . '.php', $title, "plugin.php?page=$slug", $parent);
}

/**
 * Register a new Twig template tag.
 *
 * @param string   $name     Tag name used in templates.
 * @param callable $callback Function returning the rendered HTML.
 */
function cms_register_template_tag(string $name, callable $callback): void
{
    global $cms_plugins;
    $cms_plugins['template_tags'][$name] = $callback;
}

/**
 * Attach a hook to run before or after a template tag renders.
 *
 * @param string   $tag      Target tag name.
 * @param string   $when     Either 'before' or 'after'.
 * @param callable $callback For 'before', receives array $args and must return
 *                           (possibly modified) array of arguments. For 'after',
 *                           receives mixed $output and should return modified
 *                           output.
 */
function cms_hook_template_tag(string $tag, string $when, callable $callback): void
{
    global $cms_plugins;
    $when = $when === 'before' ? 'before' : 'after';
    $cms_plugins['tag_hooks'][$tag][$when][] = $callback;
}

/**
 * Internal helper: run hooks for a tag.
 *
 * @param string $tag  Tag name.
 * @param string $when 'before' or 'after'.
 * @param mixed  $data Arguments or output depending on hook type.
 * @return mixed Modified data.
 */
function cms_apply_tag_hooks(string $tag, string $when, $data)
{
    global $cms_plugins;
    if (!empty($cms_plugins['tag_hooks'][$tag][$when])) {
        foreach ($cms_plugins['tag_hooks'][$tag][$when] as $cb) {
            $data = $cb($data);
        }
    }
    return $data;
}

/**
 * Register a callback for a named event hook.
 *
 * Event hooks provide integration points not tied to a specific template tag,
 * such as running code before or after a template renders.
 *
 * @param string   $event    Event identifier.
 * @param callable $callback Callback receiving mixed $data and returning
 *                           (optionally modified) data.
 */
function cms_add_hook(string $event, callable $callback): void
{
    global $cms_plugins;
    $cms_plugins['hooks'][$event][] = $callback;
}

/**
 * Apply hooks for a given event.
 *
 * @param string $event Event identifier.
 * @param mixed  $data  Payload passed through callbacks.
 * @return mixed Modified payload.
 */
function cms_apply_hooks(string $event, $data)
{
    global $cms_plugins;
    if (!empty($cms_plugins['hooks'][$event])) {
        foreach ($cms_plugins['hooks'][$event] as $cb) {
            $data = $cb($data);
        }
    }
    return $data;
}

/**
 * Load all plugins from the /plugins directory.
 */
function cms_load_plugins(): void
{
    static $loaded = false;
    if ($loaded) {
        return;
    }
    $loaded = true;
    foreach (glob(__DIR__ . '/../plugins/*/plugin.php') as $file) {
        include $file;
    }
}

/**
 * Retrieve sidebar links registered by plugins.
 *
 * @return array<int,array<string,mixed>>
 */
function cms_plugin_sidebar_links(): array
{
    global $cms_plugins;
    return $cms_plugins['sidebar_links'];
}

/**
 * Invoke a plugin's admin page callback.
 *
 * @param string $slug Page identifier.
 */
function cms_handle_plugin_page(string $slug): void
{
    global $cms_plugins;
    if (isset($cms_plugins['admin_pages'][$slug])) {
        $info = $cms_plugins['admin_pages'][$slug];
        $cb = $info['callback'];
        $cb();
    } else {
        echo '<p>Unknown plugin page.</p>';
    }
}

/**
 * Register plugin template tags with the Twig environment.
 *
 * @param Environment $env Twig environment instance.
 */
function cms_register_plugin_template_tags(Environment $env): void
{
    global $cms_plugins;
    foreach ($cms_plugins['template_tags'] as $name => $cb) {
        $env->addFunction(new TwigFunction($name, function (...$args) use ($name, $cb) {
            $args = cms_apply_tag_hooks($name, 'before', $args);
            $out  = $cb(...$args);
            return cms_apply_tag_hooks($name, 'after', $out);
        }, ['is_safe' => ['html']]));
    }
}

