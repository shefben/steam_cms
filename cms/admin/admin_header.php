<?php
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../template_engine.php';
require_once __DIR__ . '/../plugin_api.php'; // load plugin system
require_once __DIR__ . '/../cache_manager.php'; // load cache system
require_once __DIR__ . '/breadcrumbs.php';

if (!cms_current_admin()) {
    if (isset($_COOKIE['cms_admin_token'])) {
        $uid = cms_validate_admin_token($_COOKIE['cms_admin_token']);
        if ($uid) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $uid;
        }
    }
    if (!cms_current_admin()) {
        $ret = urlencode($_SERVER['REQUEST_URI']);
        header('Location: ../login.php?return=' . $ret);
        exit;
    }
}

$admin_theme = cms_get_setting('admin_theme', 'v2');
$theme_dir   = dirname(__DIR__, 2) . "/themes/{$admin_theme}_admin";
$base_url    = cms_base_url();
$theme_url   = ($base_url ? $base_url : '') . "/themes/{$admin_theme}_admin";
if (!is_dir($theme_dir)) {
    $theme_dir = dirname(__DIR__, 2) . "/themes/default_admin";
    $theme_url = ($base_url ? $base_url : '') . "/themes/default_admin";
}

$page_id     = basename($_SERVER['SCRIPT_NAME'], '.php');
$page_title  = ucwords(str_replace('_', ' ', $page_id));
$admin_layout = cms_admin_layout($page_id . '.twig', $admin_theme);
if ($admin_layout) {
    ob_start();
}

$admin_id = cms_current_admin();
$db = cms_get_db();
$stmt = $db->prepare('SELECT username FROM admin_users WHERE id=?');
$stmt->execute([$admin_id]);
$admin_name = $stmt->fetchColumn() ?: 'admin';

// Auto-clear cache on any POST request (saves/updates)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    // Check if this is a form submission that modifies data
    $save_indicators = ['save', 'submit', 'update', 'create', 'delete', 'import', 'upload'];
    $is_save_operation = false;
    
    foreach ($save_indicators as $indicator) {
        if (isset($_POST[$indicator]) || 
            array_key_exists($indicator, $_POST) || 
            strpos(strtolower(implode('', array_keys($_POST))), $indicator) !== false) {
            $is_save_operation = true;
            break;
        }
    }
    
    // Also check for common button names and form actions
    foreach ($_POST as $key => $value) {
        if (is_string($key) && (
            stripos($key, 'save') !== false ||
            stripos($key, 'submit') !== false ||
            stripos($key, 'update') !== false ||
            stripos($key, 'create') !== false ||
            stripos($key, 'delete') !== false ||
            stripos($key, 'import') !== false ||
            stripos($key, 'upload') !== false
        )) {
            $is_save_operation = true;
            break;
        }
    }
    
    if ($is_save_operation) {
        $cleared = cms_clear_all_caches();
        // Store cache clear notification for display
        $_SESSION['cache_cleared'] = $cleared;
    }
}

$notes = cms_get_unread_notifications($admin_id);
$notifications_html = '';

// Add cache clear notification if available
if (isset($_SESSION['cache_cleared'])) {
    $cleared = (int)$_SESSION['cache_cleared'];
    if ($cleared > 0) {
        $notifications_html .= '<div class="cache-notification" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 8px; margin: 4px 0; border-radius: 4px;">';
        $notifications_html .= "✓ Cache cleared automatically ({$cleared} files removed)";
        $notifications_html .= '</div>';
    }
    unset($_SESSION['cache_cleared']);
}

if ($notes) {
    $notifications_html = '<div class="notifications"><ul>';
    foreach ($notes as $n) {
        $id   = (int)$n['id'];
        $type = htmlspecialchars($n['type']);
        $msg  = htmlspecialchars($n['message']);
        $notifications_html .= "<li><strong>{$type}</strong>: {$msg} <button class=\"notify-dismiss\" data-id=\"{$id}\" aria-label=\"Dismiss\">&times;</button></li>";
    }
    $notifications_html .= '</ul></div>';
}

// Load navigation items from database
$nav_items = json_decode(cms_get_setting('nav_items', '[]'), true) ?: [];

// Allow plugins to provide additional sidebar links grouped under a Plugins parent
cms_load_plugins();
$plugin_links = cms_plugin_sidebar_links();
if (!empty($plugin_links)) {
    foreach ($plugin_links as &$pl) {
        if (empty($pl['parent'])) {
            $pl['parent'] = 'plugins.php';
        }
    }
    unset($pl);
    $nav_items[] = ['file' => 'plugins.php', 'label' => 'Plugins', 'visible' => 1, 'icon' => '🔌'];
    $nav_items = array_merge($nav_items, $plugin_links);
}

// Organize items by parent
$items_by_parent = [];
foreach ($nav_items as $item) {
    if (!($item['visible'] ?? 1)) {
        continue;
    }
    $parent = $item['parent'] ?? '';
    $items_by_parent[$parent][] = $item;
}

$use_spans = ($admin_theme === 'neon');

// Determine if a menu branch contains the active page
$has_active = function (string $file) use (&$has_active, $items_by_parent): bool {
    foreach ($items_by_parent[$file] ?? [] as $child) {
        $chk = $child['url'] ?? $child['file'];
        if (strpos($_SERVER['REQUEST_URI'], $chk) !== false || $has_active($child['file'])) {
            return true;
        }
    }
    return false;
};

// Render menu items recursively
$render_items = function (string $parent) use (&$render_items, $items_by_parent, $use_spans, $has_active): string {
    $html = '';
    foreach ($items_by_parent[$parent] ?? [] as $item) {
        $file = $item['file'];
        $label = cms_admin_translate($item['label']);
        $url = $item['url'] ?? $file;
        $icon = $item['icon'] ?? '';
        $children = $items_by_parent[$file] ?? [];
        $link = $children ? '#' : $url;
        $active = strpos($_SERVER['REQUEST_URI'], $url) !== false ? ' class="active"' : '';
        $open = $children && ($active || $has_active($file));
        if ($open && !$active) {
            $active = ' class="active"';
        }
        if ($use_spans) {
            $icon_html = $icon !== '' ? '<span class="nav-icon">' . htmlspecialchars($icon) . '</span>' : '';
            $label_html = '<span class="nav-label">' . htmlspecialchars($label) . '</span>';
            $text = $icon_html . $label_html;
        } else {
            $text = htmlspecialchars(trim(($icon ? $icon . ' ' : '') . $label));
        }
        if ($children) {
            $parent_id = preg_replace('/\.php$/', '', $file) . '-parent';
            $sub_id = preg_replace('/\.php$/', '', $file) . '-sub';
            $html .= '<li id="' . $parent_id . '"><a href="' . $link . '"' . $active . '>' . $text . '</a>';
            $html .= '<button class="submenu-toggle" aria-expanded="' . ($open ? 'true' : 'false') . '" aria-controls="' . $sub_id . '"></button>';
            $style = $open ? 'display:block' : 'display:none';
            $html .= '<ul class="sub-menu" id="' . $sub_id . '" style="' . $style . '">' . $render_items($file) . '</ul></li>';
        } else {
            $html .= '<li><a href="' . $link . '"' . $active . '>' . $text . '</a></li>';
        }
    }
    return $html;
};

$nav_html = '<ul class="nav-menu">' . $render_items('') . '</ul>';

if (!$admin_layout) {
    include "$theme_dir/header.php";
}
?>
