<?php
require_once __DIR__.'/cms/db.php';
$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme','2004');
$page = cms_get_download_page($theme);
$files = cms_get_all_download_files();
include 'cms/header.php';
if ($page) {
    echo $page['content'];
} else {
    echo '<p>Download page not available.</p>';
}
if ($files) {
    echo '<h2>Available Downloads</h2><ul>';
    foreach ($files as $f) {
        $url = htmlspecialchars($f['main_url']);
        $title = htmlspecialchars($f['title']);
        $size = htmlspecialchars($f['file_size']);
        echo "<li><a href='$url'>$title</a> ($size)";
        if (!empty($f['mirrors'])) {
            echo '<ul>';
            foreach ($f['mirrors'] as $m) {
                $host = htmlspecialchars($m['host']);
                $mu = htmlspecialchars($m['url']);
                echo "<li><a href='$mu'>$host</a></li>";
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
include 'cms/footer.php';
