<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../template_engine.php';
$admin_theme = cms_get_setting('admin_theme','v2');
$base_url = cms_base_url();
$theme_dir = dirname(__DIR__,2) . "/themes/{$admin_theme}_admin";
$theme_url = ($base_url ? $base_url : '') . "/themes/{$admin_theme}_admin";
if (!is_dir($theme_dir)) {
    $theme_dir = dirname(__DIR__,2) . '/themes/default_admin';
    $theme_url = ($base_url ? $base_url : '') . '/themes/default_admin';
}

if (isset($admin_layout) && $admin_layout) {
    $page_content = ob_get_clean();
    $admin_initials = implode('', array_map(fn($w) => strtoupper($w[0]), preg_split('/\s+/', $admin_name)));
    $breadcrumbs_html = cms_admin_breadcrumb();
    $sidebar = cms_admin_tag('sidebar', [
        'nav' => $nav_html,
        'theme_url' => $theme_url,
    ], $admin_theme);
    $page_title = $page_title ?? ucwords(str_replace('_', ' ', $page_id ?? ''));
    $content = cms_admin_tag('content', [
        'content' => $page_content,
        'page_title' => $page_title,
        'admin_name' => $admin_name,
        'admin_initials' => $admin_initials,
        'notifications_html' => $notifications_html ?? '',
        'breadcrumbs_html' => $breadcrumbs_html,
    ], $admin_theme);
    cms_render_template($admin_layout, [
        'sidebar' => $sidebar,
        'content' => $content,
        'theme_url' => $theme_url,
        'page_id' => $page_id ?? '',
        'admin_name' => $admin_name,
        'notifications_html' => $notifications_html ?? '',
        'breadcrumbs_html' => $breadcrumbs_html,
    ]);
} else {
    include "$theme_dir/footer.php";
}
?>
