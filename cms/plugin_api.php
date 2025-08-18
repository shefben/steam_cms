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
    'versioned_pages' => [], // Versioned page registrations
    'sidebar_renderers' => [], // Custom sidebar section renderers
    'sidebar_entry_templates' => [], // Entry templates for plugin sections
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
 * Register a page that offers selectable versions.
 *
 * @param string $key     Identifier for this page (used as form field name).
 * @param string $title   Heading shown on the admin selection page.
 * @param string $setting CMS setting key storing the chosen version.
 */
function cms_register_versioned_page(string $key, string $title, string $setting): void
{
    global $cms_plugins;
    $cms_plugins['versioned_pages'][$key] ??= [
        'title'    => $title,
        'setting'  => $setting,
        'versions' => [],
    ];
}

/**
 * Register a selectable version for a page.
 *
 * @param string   $pageKey Identifier used in cms_register_versioned_page().
 * @param string   $value   Value stored in the setting when selected.
 * @param string   $label   Human readable label shown to admins.
 * @param string   $image   Relative path to thumbnail image.
 * @param string[] $themes  List of themes this version applies to.
 */
function cms_register_page_version(string $pageKey, string $value, string $label, string $image, array $themes): void
{
    global $cms_plugins;
    if (!isset($cms_plugins['versioned_pages'][$pageKey])) {
        throw new InvalidArgumentException("Unknown versioned page: {$pageKey}");
    }
    $cms_plugins['versioned_pages'][$pageKey]['versions'][] = [
        'value'  => $value,
        'label'  => $label,
        'image'  => $image,
        'themes' => $themes,
    ];
}

/**
 * Retrieve all registered versioned pages.
 *
 * @return array<string,array<string,mixed>>
 */
function cms_plugin_page_versions(): array
{
    global $cms_plugins;
    return $cms_plugins['versioned_pages'];
}

/**
 * Register a custom sidebar section type using a JSON configuration.
 *
 * The JSON file must provide:
 * {
 *   "name": "unique_slug",
 *   "title": "Section Title",
 *   "entry_template": "<a href=\"{{url}}\">{{label}}</a>",
 *   "fields": [
 *     {"key":"url",   "label":"URL",   "type":"text"},
 *     {"key":"label", "label":"Label", "type":"text"}
 *   ]
 * }
 *
 * @param string        $jsonPath Path to the JSON definition file.
 * @param callable|null $renderer Optional callback to render the section.
 */
function cms_register_sidebar_section_type(string $jsonPath, ?callable $renderer = null): void
{
    global $cms_plugins;
    $config = json_decode(file_get_contents($jsonPath), true);
    if (!is_array($config) || empty($config['name'])) {
        throw new InvalidArgumentException('Invalid sidebar section JSON');
    }

    $type  = $config['name'];
    $title = $config['title'] ?? ucfirst($type);
    $entryTemplate = $config['entry_template'] ?? '{{content}}';
    $fields = $config['fields'] ?? [];
    $themes = $config['themes'] ?? [];
    if (is_string($themes)) {
        $themes = array_map('trim', explode(',', $themes));
    }
    $themeList = implode(',', $themes);

    $db = cms_get_db();
    $db->prepare('INSERT IGNORE INTO sidebar_section_types(type_name,title,theme_list,entry_template) VALUES(?,?,?,?)')
        ->execute([$type, $title, $themeList, $entryTemplate]);
    $stmt = $db->prepare('INSERT IGNORE INTO sidebar_section_type_fields(type_name,field_key,field_label,field_type,field_order) VALUES(?,?,?,?,?)');
    $order = 1;
    foreach ($fields as $field) {
        $stmt->execute([$type, $field['key'], $field['label'] ?? $field['key'], $field['type'] ?? 'text', $order++]);
    }

    if ($renderer) {
        $cms_plugins['sidebar_renderers'][$type] = $renderer;
    }
    $cms_plugins['sidebar_entry_templates'][$type] = $entryTemplate;
}

/**
 * Build HTML for a sidebar entry using the registered template.
 *
 * @param string               $type   Section type slug.
 * @param array<string,string> $fields Field values.
 */
function cms_plugin_build_sidebar_entry(string $type, array $fields): string
{
    global $cms_plugins;
    $tpl = $cms_plugins['sidebar_entry_templates'][$type] ?? '';
    foreach ($fields as $k => $v) {
        $tpl = str_replace('{{' . $k . '}}', htmlspecialchars($v, ENT_QUOTES), $tpl);
    }
    return $tpl;
}

/**
 * Insert a sidebar entry for a given section variant.
 *
 * @param string               $type      Section type slug.
 * @param array<string,string> $fields    Field values.
 * @param int                  $variantId Target sidebar_section_variants.variant_id.
 */
function cms_add_sidebar_entry(string $type, array $fields, int $variantId): void
{
    $db = cms_get_db();
    $html = cms_plugin_build_sidebar_entry($type, $fields);
    $stmt = $db->prepare('INSERT INTO sidebar_section_entries(parent_variant_id,entry_order,entry_content) VALUES(?,?,?)');
    $stmt->execute([$variantId, 0, $html]);
    $entryId = (int)$db->lastInsertId();
    $fStmt = $db->prepare('INSERT INTO sidebar_section_entry_fields(entry_id,field_key,field_value) VALUES(?,?,?)');
    foreach ($fields as $k => $v) {
        $fStmt->execute([$entryId, $k, $v]);
    }
}

/**
 * Load all plugins from the /plugins directory.
 */
function cms_load_plugins(): void
{
    static $pluginsLoaded = false;
    if ($pluginsLoaded) {
        return;
    }

    $cache_file = __DIR__ . '/cache/plugins.php';
    if (file_exists($cache_file) && filemtime($cache_file) >= time() - 3600) {
        $plugins = include $cache_file;
        foreach ($plugins as $plugin) {
            if (file_exists($plugin)) {
                include_once $plugin;
            }
        }
        $pluginsLoaded = true;
        return;
    }

    $foundPlugins = glob(__DIR__ . '/../plugins/*/plugin.php') ?: [];
    foreach ($foundPlugins as $file) {
        include $file;
    }

    if (!is_dir(dirname($cache_file))) {
        mkdir(dirname($cache_file), 0777, true);
    }
    file_put_contents($cache_file, '<?php return ' . var_export($foundPlugins, true) . ';');

    $pluginsLoaded = true;
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

