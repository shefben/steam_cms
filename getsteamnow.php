<?php
require_once __DIR__.'/cms/db.php';
$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme','2004');
$page = cms_get_download_page($theme);
include 'cms/header.php';
if ($page) {
    echo $page['content'];
} else {
    echo '<p>Download page not available.</p>';
}
include 'cms/footer.php';
