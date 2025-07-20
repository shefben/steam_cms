<?php
$status_code = 404;
http_response_code($status_code);
require_once __DIR__.'/cms/db.php';
$page_title = 'Error';
$error_html = cms_get_setting('error_html','<p>Page not found.</p>');
include 'cms/header.php';
echo $error_html;
include 'cms/footer.php';
