<?php
$status_code = 404;
http_response_code($status_code);
require_once __DIR__.'/cms/db.php';
$path = $_SERVER['REQUEST_URI'] ?? 'unknown';
cms_log_missing_file($path);
$ext = pathinfo(parse_url($path, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION);
if ($ext !== '' && $ext !== 'php') {
    exit;
}
$page_title = 'Error';
$error_html = cms_get_setting('error_html','<p>Page not found.</p>');
include 'cms/header.php';
echo $error_html;
include 'cms/footer.php';
