<?php
require_once __DIR__ . '/../db.php';
$admin_theme = cms_get_setting('admin_theme','v2');
$base_url = cms_base_url();
$theme_dir = dirname(__DIR__,2) . "/themes/{$admin_theme}_admin";
$theme_url = ($base_url ? $base_url : '') . "/themes/{$admin_theme}_admin";
if (!is_dir($theme_dir)) {
    $theme_dir = dirname(__DIR__,2) . '/themes/default_admin';
    $theme_url = ($base_url ? $base_url : '') . '/themes/default_admin';
}
echo '<script src="' . htmlspecialchars($theme_url) . '/js/jquery.min.js"></script>';
echo '<script src="' . htmlspecialchars($theme_url) . '/js/chart.min.js"></script>';
include "$theme_dir/footer.php";
?>
