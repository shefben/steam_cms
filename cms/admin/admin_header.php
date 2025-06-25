<?php
session_start();
require_once __DIR__ . '/../db.php';
$admin_theme = cms_get_setting('admin_theme','default');
$theme_dir = dirname(__DIR__,2)."/themes/{$admin_theme}_admin";
$theme_url = "/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)){
    $theme_dir = dirname(__DIR__,2)."/themes/default_admin";
    $theme_url = "/themes/default_admin";
}
$nav_html = '<nav>'
    .'<a href="index.php">Home</a> | '
    .'<a href="main_content.php">Main Content</a> | '
    .'<a href="news.php">News</a> | '
    .'<a href="faq.php">FAQ</a> | '
    .'<a href="forum.php">Forum</a> | '
    .'<a href="custom_pages.php">Custom Pages</a> | '
    .'<a href="settings.php">Site Settings</a> | '
    .'<a href="admin_users.php">Administrators</a>'
    .'</nav>';
include "$theme_dir/header.php";
?>
