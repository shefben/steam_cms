<?php
require_once __DIR__ . '/../db.php';
$admin_theme = cms_get_setting('admin_theme','default');
$theme_dir = dirname(__DIR__,2)."/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)) $theme_dir = dirname(__DIR__,2)."/themes/default_admin";
include "$theme_dir/footer.php";
?>
