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
    'migrations'    => [],   // Plugin database migrations
    'table_schemas' => [],   // Custom table definitions
    'settings'      => [],   // Plugin settings schemas
    'asset_overrides' => [], // Theme asset overrides
    'template_blocks' => [], // Custom template blocks
    'template_overrides' => [], // Template override mappings
    'css_js_assets' => [],   // Dynamic CSS/JS assets
    'content_types' => [],   // Custom content types
    'news_categories' => [], // Custom news categories
    'dashboard_widgets' => [], // Dashboard widgets
    'notification_types' => [], // Custom notification types
    'permissions'   => [],   // Plugin-specific permissions
    'cache_namespaces' => [], // Plugin cache namespaces
    'language_packs' => [],  // Multi-language support
    'dev_tools'     => [],   // Development tools
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

// ============================================================================
// PLUGIN DATABASE MIGRATION SYSTEM (#1)
// ============================================================================

/**
 * Register a database migration file for a plugin.
 *
 * @param string $plugin_name   Unique plugin identifier
 * @param string $version       Migration version (e.g., '1.0.0', '1.1.0')
 * @param string $migration_file Path to SQL migration file
 * @param string $description   Human-readable description of the migration
 */
function cms_register_plugin_migration(string $plugin_name, string $version, string $migration_file, string $description = ''): void
{
    global $cms_plugins;
    $cms_plugins['migrations'][] = [
        'plugin' => $plugin_name,
        'version' => $version,
        'file' => $migration_file,
        'description' => $description,
        'executed' => false
    ];
}

/**
 * Execute pending plugin migrations.
 *
 * @param string|null $plugin_name Optional: run migrations for specific plugin only
 * @return array Results of migration execution
 */
function cms_execute_plugin_migrations(?string $plugin_name = null): array
{
    global $cms_plugins;
    $db = cms_get_db();
    $results = [];
    cms_ensure_plugin_migrations_table();
    
    // Get already executed migrations
    $executed = [];
    $stmt = $db->query("SELECT plugin_name, version FROM plugin_migrations");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $executed[$row['plugin_name']][$row['version']] = true;
    }
    
    foreach ($cms_plugins['migrations'] as $migration) {
        if ($plugin_name && $migration['plugin'] !== $plugin_name) {
            continue;
        }
        
        if (isset($executed[$migration['plugin']][$migration['version']])) {
            continue;
        }
        
        try {
            if (file_exists($migration['file'])) {
                $sql = file_get_contents($migration['file']);
                $db->exec($sql);
                
                // Record successful migration
                $stmt = $db->prepare("INSERT INTO plugin_migrations (plugin_name, version) VALUES (?, ?)");
                $stmt->execute([$migration['plugin'], $migration['version']]);
                
                $results[] = [
                    'plugin' => $migration['plugin'],
                    'version' => $migration['version'],
                    'status' => 'success',
                    'message' => $migration['description']
                ];
            } else {
                $results[] = [
                    'plugin' => $migration['plugin'],
                    'version' => $migration['version'],
                    'status' => 'error',
                    'message' => "Migration file not found: {$migration['file']}"
                ];
            }
        } catch (Exception $e) {
            $results[] = [
                'plugin' => $migration['plugin'],
                'version' => $migration['version'],
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
    
    return $results;
}

/**
 * Rollback plugin migrations (for deactivation).
 *
 * @param string $plugin_name Plugin to rollback
 * @param string|null $to_version Rollback to specific version (null = complete removal)
 * @return array Results of rollback
 */
function cms_rollback_plugin_migrations(string $plugin_name, ?string $to_version = null): array
{
    $db = cms_get_db();
    $results = [];
    cms_ensure_plugin_migrations_table();
    
    // Mark migrations as rolled back
    if ($to_version) {
        $stmt = $db->prepare("DELETE FROM plugin_migrations WHERE plugin_name = ? AND version > ?");
        $stmt->execute([$plugin_name, $to_version]);
    } else {
        $stmt = $db->prepare("DELETE FROM plugin_migrations WHERE plugin_name = ?");
        $stmt->execute([$plugin_name]);
    }
    
    $results[] = [
        'plugin' => $plugin_name,
        'status' => 'success',
        'message' => "Rollback completed to version: " . ($to_version ?: 'none')
    ];
    
    return $results;
}

// ============================================================================
// CUSTOM DATABASE TABLE REGISTRATION (#2)
// ============================================================================

/**
 * Register a custom table schema for a plugin.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $table_name Table name (without prefix)
 * @param array $schema Table schema definition
 */
function cms_register_plugin_table(string $plugin_name, string $table_name, array $schema): void
{
    global $cms_plugins;
    $cms_plugins['table_schemas'][$plugin_name][$table_name] = $schema;
}

/**
 * Create plugin tables based on registered schemas.
 *
 * @param string|null $plugin_name Optional: create tables for specific plugin only
 * @return array Results of table creation
 */
function cms_create_plugin_tables(?string $plugin_name = null): array
{
    global $cms_plugins;
    $db = cms_get_db();
    $results = [];
    
    $schemas = $plugin_name 
        ? [$plugin_name => $cms_plugins['table_schemas'][$plugin_name] ?? []]
        : $cms_plugins['table_schemas'];
    
    foreach ($schemas as $plugin => $tables) {
        foreach ($tables as $table_name => $schema) {
            try {
                $sql = cms_build_table_sql($table_name, $schema);
                $db->exec($sql);
                
                $results[] = [
                    'plugin' => $plugin,
                    'table' => $table_name,
                    'status' => 'success'
                ];
            } catch (Exception $e) {
                $results[] = [
                    'plugin' => $plugin,
                    'table' => $table_name,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }
    }
    
    return $results;
}

/**
 * Build CREATE TABLE SQL from schema definition.
 *
 * @param string $table_name Table name
 * @param array $schema Schema definition
 * @return string SQL statement
 */
function cms_build_table_sql(string $table_name, array $schema): string
{
    $columns = [];
    $indexes = [];
    $foreign_keys = [];
    
    foreach ($schema['columns'] as $col_name => $col_def) {
        $column_sql = "`{$col_name}` " . strtoupper($col_def['type']);
        
        if (isset($col_def['length'])) {
            $column_sql .= "({$col_def['length']})";
        }
        
        if (!empty($col_def['null']) && $col_def['null'] === false) {
            $column_sql .= " NOT NULL";
        }
        
        if (isset($col_def['default'])) {
            $column_sql .= " DEFAULT " . (is_string($col_def['default']) ? "'{$col_def['default']}'" : $col_def['default']);
        }
        
        if (!empty($col_def['auto_increment'])) {
            $column_sql .= " AUTO_INCREMENT";
        }
        
        $columns[] = $column_sql;
    }
    
    // Add primary key
    if (!empty($schema['primary_key'])) {
        $pk_cols = is_array($schema['primary_key']) ? $schema['primary_key'] : [$schema['primary_key']];
        $columns[] = "PRIMARY KEY (`" . implode('`, `', $pk_cols) . "`)";
    }
    
    // Add indexes
    if (!empty($schema['indexes'])) {
        foreach ($schema['indexes'] as $index_name => $index_def) {
            $idx_cols = is_array($index_def) ? $index_def : [$index_def];
            $indexes[] = "INDEX `{$index_name}` (`" . implode('`, `', $idx_cols) . "`)";
        }
    }
    
    // Add foreign keys
    if (!empty($schema['foreign_keys'])) {
        foreach ($schema['foreign_keys'] as $fk_def) {
            $foreign_keys[] = "FOREIGN KEY (`{$fk_def['column']}`) REFERENCES `{$fk_def['table']}`(`{$fk_def['reference']}`)";
        }
    }
    
    $all_definitions = array_merge($columns, $indexes, $foreign_keys);
    
    return "CREATE TABLE IF NOT EXISTS `{$table_name}` (\n  " . implode(",\n  ", $all_definitions) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
}

// ============================================================================
// PLUGIN SETTINGS API (#3)
// ============================================================================

/**
 * Register plugin settings schema.
 *
 * @param string $plugin_name Plugin identifier
 * @param array $settings_schema Settings definition
 */
function cms_register_plugin_settings(string $plugin_name, array $settings_schema): void
{
    global $cms_plugins;
    $cms_plugins['settings'][$plugin_name] = $settings_schema;
}

/**
 * Get plugin setting value with type validation.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $setting_key Setting key
 * @param mixed $default Default value if not set
 * @return mixed Setting value
 */
function cms_get_plugin_setting(string $plugin_name, string $setting_key, $default = null)
{
    global $cms_plugins;
    $db = cms_get_db();
    cms_ensure_plugin_settings_table();

    $stmt = $db->prepare("SELECT setting_value, setting_type FROM plugin_settings WHERE plugin_name = ? AND setting_key = ?");
    $stmt->execute([$plugin_name, $setting_key]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$row) {
        return $default;
    }
    
    return cms_cast_setting_value($row['setting_value'], $row['setting_type']);
}

/**
 * Set plugin setting value with type validation.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $setting_key Setting key
 * @param mixed $value Setting value
 * @param string $type Value type (string, int, bool, array, json)
 * @return bool Success status
 */
function cms_set_plugin_setting(string $plugin_name, string $setting_key, $value, string $type = 'string'): bool
{
    $db = cms_get_db();
    cms_ensure_plugin_settings_table();
    
    // Validate and encode value
    $encoded_value = cms_encode_setting_value($value, $type);
    
    $stmt = $db->prepare("REPLACE INTO plugin_settings (plugin_name, setting_key, setting_value, setting_type) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$plugin_name, $setting_key, $encoded_value, $type]);
}

/**
 * Cast setting value to appropriate type.
 *
 * @param string $value Stored value
 * @param string $type Value type
 * @return mixed Casted value
 */
function cms_cast_setting_value(string $value, string $type)
{
    switch ($type) {
        case 'int':
            return (int) $value;
        case 'bool':
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        case 'array':
        case 'json':
            return json_decode($value, true) ?: [];
        default:
            return $value;
    }
}

/**
 * Encode setting value for storage.
 *
 * @param mixed $value Value to encode
 * @param string $type Value type
 * @return string Encoded value
 */
function cms_encode_setting_value($value, string $type): string
{
    switch ($type) {
        case 'array':
        case 'json':
            return json_encode($value);
        case 'bool':
            return $value ? '1' : '0';
        default:
            return (string) $value;
    }
}

/**
 * Get all settings for a plugin.
 *
 * @param string $plugin_name Plugin identifier
 * @return array All plugin settings
 */
function cms_get_plugin_settings(string $plugin_name): array
{
    $db = cms_get_db();
    cms_ensure_plugin_settings_table();
    $stmt = $db->prepare("SELECT setting_key, setting_value, setting_type FROM plugin_settings WHERE plugin_name = ?");
    $stmt->execute([$plugin_name]);
    
    $settings = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $settings[$row['setting_key']] = cms_cast_setting_value($row['setting_value'], $row['setting_type']);
    }
    
    return $settings;
}

// ============================================================================
// THEME ASSET OVERRIDE SYSTEM (#4)
// ============================================================================

/**
 * Register theme asset override.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $theme Theme name (e.g., '2006_v1')
 * @param string $asset_type Asset type (css, js, image)
 * @param string $original_path Original asset path
 * @param string $override_path Plugin override path
 */
function cms_register_asset_override(string $plugin_name, string $theme, string $asset_type, string $original_path, string $override_path): void
{
    global $cms_plugins;
    $cms_plugins['asset_overrides'][$theme][$asset_type][$original_path] = [
        'plugin' => $plugin_name,
        'override_path' => $override_path
    ];
}

/**
 * Get asset override path if available.
 *
 * @param string $theme Current theme
 * @param string $asset_type Asset type
 * @param string $original_path Original asset path
 * @return string Asset path (original or override)
 */
function cms_get_asset_path(string $theme, string $asset_type, string $original_path): string
{
    global $cms_plugins;
    
    if (isset($cms_plugins['asset_overrides'][$theme][$asset_type][$original_path])) {
        return $cms_plugins['asset_overrides'][$theme][$asset_type][$original_path]['override_path'];
    }
    
    return $original_path;
}

// ============================================================================
// CUSTOM TEMPLATE BLOCK REGISTRATION (#5)
// ============================================================================

/**
 * Register a custom template block.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $block_name Block name
 * @param callable $renderer Block rendering function
 * @param array $position Position configuration (before/after existing blocks)
 * @param int $priority Priority for ordering (higher = earlier)
 */
function cms_register_template_block(string $plugin_name, string $block_name, callable $renderer, array $position = [], int $priority = 10): void
{
    global $cms_plugins;
    $cms_plugins['template_blocks'][$block_name] = [
        'plugin' => $plugin_name,
        'renderer' => $renderer,
        'position' => $position,
        'priority' => $priority
    ];
}

/**
 * Render template blocks for a specific position.
 *
 * @param string $position Position identifier
 * @param array $context Template context
 * @return string Rendered blocks HTML
 */
function cms_render_template_blocks(string $position, array $context = []): string
{
    global $cms_plugins;
    $output = '';
    $blocks = [];
    
    // Collect blocks for this position
    foreach ($cms_plugins['template_blocks'] as $block_name => $block_def) {
        if (in_array($position, $block_def['position']['locations'] ?? [])) {
            $blocks[] = [
                'name' => $block_name,
                'renderer' => $block_def['renderer'],
                'priority' => $block_def['priority']
            ];
        }
    }
    
    // Sort by priority
    usort($blocks, function($a, $b) {
        return $b['priority'] <=> $a['priority'];
    });
    
    // Render blocks
    foreach ($blocks as $block) {
        try {
            $output .= call_user_func($block['renderer'], $context);
        } catch (Exception $e) {
            error_log("Template block error [{$block['name']}]: " . $e->getMessage());
        }
    }
    
    return $output;
}

// ============================================================================
// TEMPLATE OVERRIDE HIERARCHY (#7)
// ============================================================================

/**
 * Register a template override.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $template_path Original template path
 * @param string $override_path Plugin override template path
 * @param array $themes Applicable themes (empty = all themes)
 */
function cms_register_template_override(string $plugin_name, string $template_path, string $override_path, array $themes = []): void
{
    global $cms_plugins;
    $cms_plugins['template_overrides'][$template_path][] = [
        'plugin' => $plugin_name,
        'override_path' => $override_path,
        'themes' => $themes
    ];
}

/**
 * Resolve template path with override hierarchy.
 *
 * @param string $template_path Original template path
 * @param string $current_theme Current theme
 * @return string Resolved template path
 */
function cms_resolve_template_path(string $template_path, string $current_theme): string
{
    global $cms_plugins;
    
    if (!isset($cms_plugins['template_overrides'][$template_path])) {
        return $template_path;
    }
    
    foreach ($cms_plugins['template_overrides'][$template_path] as $override) {
        // Check if override applies to current theme
        if (empty($override['themes']) || in_array($current_theme, $override['themes'])) {
            if (file_exists($override['override_path'])) {
                return $override['override_path'];
            }
        }
    }
    
    return $template_path;
}

// ============================================================================
// DYNAMIC CSS/JS INJECTION (#8)
// ============================================================================

/**
 * Register dynamic CSS/JS asset.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $asset_type Type: 'css' or 'js'
 * @param string $content Asset content or file path
 * @param array $conditions Loading conditions
 * @param string $location Where to inject: 'admin', 'frontend', 'both'
 */
function cms_register_dynamic_asset(string $plugin_name, string $asset_type, string $content, array $conditions = [], string $location = 'both'): void
{
    global $cms_plugins;
    $cms_plugins['css_js_assets'][] = [
        'plugin' => $plugin_name,
        'type' => $asset_type,
        'content' => $content,
        'conditions' => $conditions,
        'location' => $location
    ];
}

/**
 * Inject dynamic CSS/JS assets.
 *
 * @param string $location Current location: 'admin' or 'frontend'
 * @param array $context Current context (theme, page, user, etc.)
 * @return string Assets HTML
 */
function cms_inject_dynamic_assets(string $location, array $context = []): string
{
    global $cms_plugins;
    $output = '';
    
    foreach ($cms_plugins['css_js_assets'] as $asset) {
        // Check location
        if ($asset['location'] !== 'both' && $asset['location'] !== $location) {
            continue;
        }
        
        // Check conditions
        if (!cms_check_asset_conditions($asset['conditions'], $context)) {
            continue;
        }
        
        // Generate asset HTML
        if ($asset['type'] === 'css') {
            if (file_exists($asset['content'])) {
                $output .= '<link rel="stylesheet" href="' . htmlspecialchars($asset['content']) . '">' . "\n";
            } else {
                $output .= '<style>' . $asset['content'] . '</style>' . "\n";
            }
        } elseif ($asset['type'] === 'js') {
            if (file_exists($asset['content'])) {
                $output .= '<script src="' . htmlspecialchars($asset['content']) . '"></script>' . "\n";
            } else {
                $output .= '<script>' . $asset['content'] . '</script>' . "\n";
            }
        }
    }
    
    return $output;
}

/**
 * Check if asset conditions are met.
 *
 * @param array $conditions Conditions to check
 * @param array $context Current context
 * @return bool Whether conditions are met
 */
function cms_check_asset_conditions(array $conditions, array $context): bool
{
    foreach ($conditions as $key => $value) {
        switch ($key) {
            case 'theme':
                if (!in_array($context['theme'] ?? '', (array) $value)) {
                    return false;
                }
                break;
            case 'page':
                if (!in_array($context['page'] ?? '', (array) $value)) {
                    return false;
                }
                break;
            case 'user_permission':
                if (!cms_current_admin() || !cms_check_permission($value)) {
                    return false;
                }
                break;
        }
    }
    
    return true;
}

// ============================================================================
// CUSTOM CONTENT TYPES (#9)
// ============================================================================

/**
 * Register a custom content type.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $content_type Content type slug
 * @param array $definition Content type definition
 */
function cms_register_content_type(string $plugin_name, string $content_type, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['content_types'][$content_type] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Get registered content types.
 *
 * @return array Content types
 */
function cms_get_content_types(): array
{
    global $cms_plugins;
    return $cms_plugins['content_types'];
}

/**
 * Get content type definition.
 *
 * @param string $content_type Content type slug
 * @return array|null Content type definition
 */
function cms_get_content_type(string $content_type): ?array
{
    global $cms_plugins;
    return $cms_plugins['content_types'][$content_type] ?? null;
}

// ============================================================================
// NEWS SYSTEM EXTENSIONS (#11)
// ============================================================================

/**
 * Register a custom news category.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $category_slug Category slug
 * @param array $definition Category definition
 */
function cms_register_news_category(string $plugin_name, string $category_slug, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['news_categories'][$category_slug] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Get registered news categories.
 *
 * @return array News categories
 */
function cms_get_news_categories(): array
{
    global $cms_plugins;
    return $cms_plugins['news_categories'];
}

// ============================================================================
// PAGE BUILDER COMPONENTS (#12)
// ============================================================================

/**
 * Register a page builder component.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $component_id Component identifier
 * @param array $definition Component definition
 */
function cms_register_page_builder_component(string $plugin_name, string $component_id, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['page_components'][$component_id] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Get registered page builder components.
 *
 * @return array Page builder components
 */
function cms_get_page_builder_components(): array
{
    global $cms_plugins;
    return $cms_plugins['page_components'] ?? [];
}

/**
 * Render page builder component.
 *
 * @param string $component_id Component identifier
 * @param array $config Component configuration
 * @param array $content Component content data
 * @return string Component HTML
 */
function cms_render_page_builder_component(string $component_id, array $config = [], array $content = []): string
{
    global $cms_plugins;
    
    if (!isset($cms_plugins['page_components'][$component_id])) {
        return '';
    }
    
    $component = $cms_plugins['page_components'][$component_id];
    
    try {
        if (isset($component['renderer']) && is_callable($component['renderer'])) {
            return call_user_func($component['renderer'], $config, $content);
        }
    } catch (Exception $e) {
        error_log("Page builder component error [{$component_id}]: " . $e->getMessage());
        return '<div class="component-error">Component error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    
    return '';
}

/**
 * Get component configuration form fields.
 *
 * @param string $component_id Component identifier
 * @return array Configuration fields
 */
function cms_get_component_config_fields(string $component_id): array
{
    global $cms_plugins;
    
    if (!isset($cms_plugins['page_components'][$component_id])) {
        return [];
    }
    
    return $cms_plugins['page_components'][$component_id]['config_fields'] ?? [];
}

// ============================================================================
// DASHBOARD WIDGET SYSTEM (#13)
// ============================================================================

/**
 * Register a dashboard widget.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $widget_id Widget identifier
 * @param array $definition Widget definition
 */
function cms_register_dashboard_widget(string $plugin_name, string $widget_id, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['dashboard_widgets'][$widget_id] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Get registered dashboard widgets.
 *
 * @return array Dashboard widgets
 */
function cms_get_dashboard_widgets(): array
{
    global $cms_plugins;
    return $cms_plugins['dashboard_widgets'];
}

/**
 * Render dashboard widget.
 *
 * @param string $widget_id Widget identifier
 * @param array $config Widget configuration
 * @return string Widget HTML
 */
function cms_render_dashboard_widget(string $widget_id, array $config = []): string
{
    global $cms_plugins;
    
    if (!isset($cms_plugins['dashboard_widgets'][$widget_id])) {
        return '';
    }
    
    $widget = $cms_plugins['dashboard_widgets'][$widget_id];
    
    try {
        if (isset($widget['renderer']) && is_callable($widget['renderer'])) {
            return call_user_func($widget['renderer'], $config);
        }
    } catch (Exception $e) {
        error_log("Dashboard widget error [{$widget_id}]: " . $e->getMessage());
        return '<div class="widget-error">Widget error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    
    return '';
}

// ============================================================================
// ADMIN NOTIFICATION SYSTEM (#17)
// ============================================================================

/**
 * Register a custom notification type.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $type_slug Notification type slug
 * @param array $definition Type definition
 */
function cms_register_notification_type(string $plugin_name, string $type_slug, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['notification_types'][$type_slug] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Send plugin notification.
 *
 * @param string $type Notification type
 * @param string $message Notification message
 * @param int|null $admin_id Target admin ID (null = all admins)
 * @param array $data Additional notification data
 * @return bool Success status
 */
function cms_send_plugin_notification(string $type, string $message, ?int $admin_id = null, array $data = []): bool
{
    $db = cms_get_db();
    
    // Create notifications table if not exists
    $db->exec("CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id INT DEFAULT 0,
        type VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        data JSON NULL,
        is_read BOOLEAN DEFAULT FALSE,
        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $stmt = $db->prepare("INSERT INTO notifications (admin_id, type, message, data) VALUES (?, ?, ?, ?)");
    return $stmt->execute([
        $admin_id ?: 0,
        $type,
        $message,
        empty($data) ? null : json_encode($data)
    ]);
}

// ============================================================================
// ROLE-BASED PLUGIN PERMISSIONS (#18)
// ============================================================================

/**
 * Register plugin-specific permissions.
 *
 * @param string $plugin_name Plugin identifier
 * @param array $permissions Permission definitions
 */
function cms_register_plugin_permissions(string $plugin_name, array $permissions): void
{
    global $cms_plugins;
    $cms_plugins['permissions'][$plugin_name] = $permissions;
}

/**
 * Check plugin permission for current admin.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $permission Permission name
 * @return bool Whether permission is granted
 */
function cms_check_plugin_permission(string $plugin_name, string $permission): bool
{
    global $cms_plugins;
    
    if (!cms_current_admin()) {
        return false;
    }
    
    // Check if permission is registered
    if (!isset($cms_plugins['permissions'][$plugin_name][$permission])) {
        return false;
    }
    
    // For now, use existing CMS permission system
    // This can be extended with more sophisticated role-based permissions
    return cms_check_permission('manage_plugins');
}

// ============================================================================
// CACHE MANAGEMENT API (#26)
// ============================================================================

/**
 * Register plugin cache namespace.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $namespace Cache namespace
 * @param array $config Cache configuration
 */
function cms_register_cache_namespace(string $plugin_name, string $namespace, array $config = []): void
{
    global $cms_plugins;
    $cms_plugins['cache_namespaces'][$namespace] = array_merge($config, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Get plugin cache value.
 *
 * @param string $namespace Cache namespace
 * @param string $key Cache key
 * @param mixed $default Default value
 * @return mixed Cached value
 */
function cms_get_plugin_cache(string $namespace, string $key, $default = null)
{
    $cache_file = __DIR__ . "/cache/plugins/{$namespace}_{$key}.cache";
    
    if (!file_exists($cache_file)) {
        return $default;
    }
    
    $data = file_get_contents($cache_file);
    $cache = json_decode($data, true);
    
    if (!$cache || !isset($cache['expires']) || $cache['expires'] < time()) {
        unlink($cache_file);
        return $default;
    }
    
    return $cache['value'];
}

/**
 * Set plugin cache value.
 *
 * @param string $namespace Cache namespace
 * @param string $key Cache key
 * @param mixed $value Value to cache
 * @param int $ttl TTL in seconds (default: 3600)
 * @return bool Success status
 */
function cms_set_plugin_cache(string $namespace, string $key, $value, int $ttl = 3600): bool
{
    $cache_dir = __DIR__ . "/cache/plugins";
    if (!is_dir($cache_dir)) {
        mkdir($cache_dir, 0777, true);
    }
    
    $cache_file = "{$cache_dir}/{$namespace}_{$key}.cache";
    $cache_data = [
        'value' => $value,
        'expires' => time() + $ttl,
        'created' => time()
    ];
    
    return file_put_contents($cache_file, json_encode($cache_data)) !== false;
}

/**
 * Clear plugin cache namespace.
 *
 * @param string $namespace Cache namespace
 * @return int Number of files cleared
 */
function cms_clear_plugin_cache(string $namespace): int
{
    $cache_dir = __DIR__ . "/cache/plugins";
    $pattern = "{$cache_dir}/{$namespace}_*.cache";
    $files = glob($pattern);
    
    $cleared = 0;
    foreach ($files as $file) {
        if (unlink($file)) {
            $cleared++;
        }
    }
    
    return $cleared;
}

// ============================================================================
// MULTI-LANGUAGE PLUGIN SUPPORT (#29)
// ============================================================================

/**
 * Register language pack for plugin.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $language Language code (e.g., 'en', 'es', 'fr')
 * @param array $translations Translation strings
 */
function cms_register_plugin_language_pack(string $plugin_name, string $language, array $translations): void
{
    global $cms_plugins;
    $cms_plugins['language_packs'][$plugin_name][$language] = $translations;
}

/**
 * Get plugin translation string.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $key Translation key
 * @param string|null $language Language code (null = current language)
 * @param string|null $default Default value if not found
 * @return string Translated string
 */
function cms_plugin_translate(string $plugin_name, string $key, ?string $language = null, ?string $default = null): string
{
    global $cms_plugins;
    
    $language = $language ?: cms_get_setting('site_language', 'en');
    
    if (isset($cms_plugins['language_packs'][$plugin_name][$language][$key])) {
        return $cms_plugins['language_packs'][$plugin_name][$language][$key];
    }
    
    // Fallback to English
    if ($language !== 'en' && isset($cms_plugins['language_packs'][$plugin_name]['en'][$key])) {
        return $cms_plugins['language_packs'][$plugin_name]['en'][$key];
    }
    
    return $default ?: $key;
}

/**
 * Get available languages for plugin.
 *
 * @param string $plugin_name Plugin identifier
 * @return array Available language codes
 */
function cms_get_plugin_languages(string $plugin_name): array
{
    global $cms_plugins;
    return array_keys($cms_plugins['language_packs'][$plugin_name] ?? []);
}

// ============================================================================
// PLUGIN DEVELOPMENT TOOLS (#30)
// ============================================================================

/**
 * Register development tool.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $tool_name Tool name
 * @param array $definition Tool definition
 */
function cms_register_dev_tool(string $plugin_name, string $tool_name, array $definition): void
{
    global $cms_plugins;
    $cms_plugins['dev_tools'][$tool_name] = array_merge($definition, [
        'plugin' => $plugin_name
    ]);
}

/**
 * Plugin debug log.
 *
 * @param string $plugin_name Plugin identifier
 * @param string $message Log message
 * @param string $level Log level
 * @param array $context Additional context
 */
function cms_plugin_debug_log(string $plugin_name, string $message, string $level = 'info', array $context = []): void
{
    if (!cms_get_setting('plugin_debug_mode', false)) {
        return;
    }
    
    $log_dir = __DIR__ . "/logs/plugins";
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0777, true);
    }
    
    $log_file = "{$log_dir}/{$plugin_name}.log";
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] [{$level}] {$message}";
    
    if (!empty($context)) {
        $log_entry .= " " . json_encode($context);
    }
    
    file_put_contents($log_file, $log_entry . "\n", FILE_APPEND | LOCK_EX);
}

/**
 * Generate plugin scaffold.
 *
 * @param string $plugin_name Plugin name
 * @param array $options Scaffold options
 * @return array Result of scaffold generation
 */
function cms_generate_plugin_scaffold(string $plugin_name, array $options = []): array
{
    $plugin_dir = __DIR__ . "/../plugins/{$plugin_name}";
    
    if (is_dir($plugin_dir)) {
        return [
            'success' => false,
            'message' => "Plugin directory already exists: {$plugin_name}"
        ];
    }
    
    mkdir($plugin_dir, 0777, true);
    
    // Generate main plugin file
    $plugin_content = "<?php\n";
    $plugin_content .= "/**\n";
    $plugin_content .= " * Plugin: {$plugin_name}\n";
    $plugin_content .= " * Generated: " . date('Y-m-d H:i:s') . "\n";
    $plugin_content .= " */\n\n";
    $plugin_content .= "// Register plugin admin page\n";
    $plugin_content .= "cms_register_admin_page('{$plugin_name}', '" . ucfirst($plugin_name) . "', function() {\n";
    $plugin_content .= "    echo '<h2>" . ucfirst($plugin_name) . " Plugin</h2>';\n";
    $plugin_content .= "    echo '<p>Configure your plugin here.</p>';\n";
    $plugin_content .= "});\n\n";
    $plugin_content .= "// Register plugin settings\n";
    $plugin_content .= "cms_register_plugin_settings('{$plugin_name}', [\n";
    $plugin_content .= "    'enabled' => ['type' => 'bool', 'default' => true, 'label' => 'Enable Plugin'],\n";
    $plugin_content .= "    'config' => ['type' => 'json', 'default' => [], 'label' => 'Configuration']\n";
    $plugin_content .= "]);\n";
    
    file_put_contents("{$plugin_dir}/plugin.php", $plugin_content);
    
    // Generate README
    $readme_content = "# {$plugin_name} Plugin\n\n";
    $readme_content .= "## Description\n\n";
    $readme_content .= "Plugin description here.\n\n";
    $readme_content .= "## Installation\n\n";
    $readme_content .= "1. Copy plugin to /plugins/{$plugin_name}/\n";
    $readme_content .= "2. Activate plugin in admin panel\n\n";
    $readme_content .= "## Configuration\n\n";
    $readme_content .= "Configure plugin settings in Admin > Plugins > {$plugin_name}\n";
    
    file_put_contents("{$plugin_dir}/README.md", $readme_content);
    
    return [
        'success' => true,
        'message' => "Plugin scaffold generated successfully: {$plugin_name}",
        'path' => $plugin_dir
    ];
}

