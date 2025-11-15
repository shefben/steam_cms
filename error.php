<?php
$status_code = 404;
http_response_code($status_code);
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';
$path = $_SERVER['REQUEST_URI'] ?? 'unknown';
cms_log_missing_file($path);
$ext = pathinfo(parse_url($path, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION);
if ($ext !== '' && $ext !== 'php') {
    exit;
}
$page_title = 'Error';
$error_html = cms_get_setting('error_html', '<p>Page not found.</p>');
$theme = cms_get_current_theme();
$layout = cms_theme_layout('error.twig', $theme);

// Allow themes without a bespoke error.twig to fall back to their default layout,
// so the standard header/footer chrome remains intact.

cms_render_template_theme($layout, $theme, [
    'page_title' => $page_title,
    'error_html' => $error_html,
    'content'    => $error_html,
]);
