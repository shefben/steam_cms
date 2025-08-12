<?php

declare(strict_types=1);

/**
 * Theme configuration loader and helpers.
 *
 * Themes may provide a `theme.json` file describing additional settings and
 * admin widgets. This utility reads that configuration and exposes helpers to
 * install default values, render widgets, and save user input. The goal is to
 * allow theme authors to extend the admin panel without writing PHP.
 */

require_once __DIR__ . '/db.php';

/**
 * Retrieve a theme setting from an arbitrary table.
 * Assumes the table follows a simple `name`/`value` schema.
 */
function cms_theme_get_value(string $table, string $name, string $default): string
{
    if ($table === 'settings') {
        return cms_get_setting($name, $default);
    }
    $db = cms_get_db();
    $stmt = $db->prepare("SELECT value FROM $table WHERE name=? LIMIT 1");
    $stmt->execute([$name]);
    $val = $stmt->fetchColumn();
    return $val !== false ? (string)$val : $default;
}

/**
 * Persist a theme setting into an arbitrary table.
 * The table must provide `name` and `value` columns.
 */
function cms_theme_set_value(string $table, string $name, string $value): void
{
    if ($table === 'settings') {
        cms_set_setting($name, $value);
        return;
    }
    $db = cms_get_db();
    $stmt = $db->prepare("UPDATE $table SET value=? WHERE name=?");
    $stmt->execute([$value, $name]);
    if ($stmt->rowCount() === 0) {
        $stmt = $db->prepare("INSERT INTO $table (name, value) VALUES (?, ?)");
        $stmt->execute([$name, $value]);
    }
}

/**
 * Load configuration for a theme.
 *
 * @param string $theme Theme folder name
 * @return array<string,mixed>
 */
function cms_load_theme_config(string $theme): array
{
    $file = dirname(__DIR__) . '/themes/' . $theme . '/theme.json';
    if (!is_file($file)) {
        return [];
    }
    $json = json_decode((string)file_get_contents($file), true);
    return is_array($json) ? $json : [];
}

/**
 * Ensure default settings defined by the theme exist in the database.
 *
 * @param string $theme Theme folder name
 */
function cms_install_theme_settings(string $theme): void
{
    $config = cms_load_theme_config($theme);
    if (empty($config['settings']) || !is_array($config['settings'])) {
        return;
    }
    $db = cms_get_db();
    foreach ($config['settings'] as $setting) {
        $name = $setting['name'] ?? null;
        if ($name === null || $name === '') {
            continue;
        }
        $table = $setting['table'] ?? 'settings';
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            $table = 'settings';
        }
        $default = (string)($setting['default'] ?? '');
        $stmt = $db->prepare("SELECT COUNT(*) FROM $table WHERE name=?");
        $stmt->execute([$name]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $db->prepare("INSERT INTO $table (name, value) VALUES (?, ?)");
            $stmt->execute([$name, $default]);
        }
    }
}

/**
 * Render admin widgets defined by the theme.
 *
 * @param string $theme Theme folder name
 */
/**
 * Render admin widgets defined by the theme for a specific page.
 *
 * Settings in theme.json may specify a `page` field (or array of pages) to
 * limit where the widget appears and an optional `target`/`position` pair to
 * move the widget before or after an existing element by ID.
 *
 * @param string $theme Theme folder name
 * @param string $page  Current admin page id
 */
function cms_render_theme_admin_widgets(string $theme, string $page): void
{
    $config = cms_load_theme_config($theme);
    if (empty($config['settings']) || !is_array($config['settings'])) {
        return;
    }
    foreach ($config['settings'] as $setting) {
        $name  = $setting['name'] ?? '';
        if ($name === '') {
            continue;
        }
        // page filter
        $pages = $setting['page'] ?? $setting['pages'] ?? null;
        if ($pages !== null) {
            $pages = is_array($pages) ? $pages : [$pages];
            if (!in_array($page, $pages, true)) {
                continue;
            }
        }
        $label = htmlspecialchars($setting['label'] ?? $name, ENT_QUOTES);
        $type  = $setting['type'] ?? 'text';
        $table = $setting['table'] ?? 'settings';
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            $table = 'settings';
        }
        $value = cms_theme_get_value($table, $name, (string)($setting['default'] ?? ''));
        $valueEsc = htmlspecialchars((string)$value, ENT_QUOTES);
        $wid = 'theme_widget_' . preg_replace('/[^a-z0-9_]/i', '_', $name);
        switch ($type) {
            case 'checkbox':
                $checked = $value === '1' ? 'checked' : '';
                echo "<div id=\"$wid\"><label><input type=\"checkbox\" name=\"theme_settings[$name]\" value=\"1\" $checked> $label</label></div><br><br>";
                break;
            case 'textarea':
                echo "<div id=\"$wid\"><label>$label<br><textarea name=\"theme_settings[$name]\" style=\"width:100%;height:200px;\">$valueEsc</textarea></label></div><br><br>";
                break;
            default:
                echo "<div id=\"$wid\"><label>$label: <input type=\"text\" name=\"theme_settings[$name]\" value=\"$valueEsc\"></label></div><br><br>";
        }
        $target = $setting['target'] ?? null;
        $position = $setting['position'] ?? null; // 'before' or 'after'
        if ($target && ($position === 'before' || $position === 'after')) {
            $targetEsc = htmlspecialchars($target, ENT_QUOTES);
            $posFunc = $position === 'before' ? 'before' : 'after';
            echo "<script>var w=document.getElementById('$wid');var t=document.getElementById('$targetEsc');if(t&&w){t.insertAdjacentElement('$posFunc',w);}</script>";
        }
    }
}

/**
 * Save theme settings submitted from the admin form.
 *
 * @param string               $theme Theme folder name
 * @param array<string,mixed>  $post  $_POST array
 */
function cms_save_theme_settings(string $theme, array $post): void
{
    if (!isset($post['theme_settings']) || !is_array($post['theme_settings'])) {
        return;
    }
    $config = cms_load_theme_config($theme);
    if (empty($config['settings']) || !is_array($config['settings'])) {
        return;
    }
    foreach ($config['settings'] as $setting) {
        $name = $setting['name'] ?? '';
        if ($name === '') {
            continue;
        }
        $type = $setting['type'] ?? 'text';
        $table = $setting['table'] ?? 'settings';
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            $table = 'settings';
        }
        $datatype = $setting['datatype'] ?? 'string';
        $val = $post['theme_settings'][$name] ?? '';
        if ($type === 'checkbox') {
            $val = $val ? '1' : '0';
        }
        switch ($datatype) {
            case 'int':
                $val = (string)(int)$val;
                break;
            case 'float':
                $val = (string)(float)$val;
                break;
            default:
                $val = (string)$val;
        }
        cms_theme_set_value($table, $name, $val);
    }
}

