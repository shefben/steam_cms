<?php
require_once __DIR__.'/cms/db.php';
$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme','2004');
$page = cms_get_download_page($theme);
$files = cms_get_all_download_files($theme);
include 'cms/header.php';
if ($page) {
    echo $page['content'];
} else {
    echo '<p>Download page not available.</p>';
}
if ($files) {
    $buttonMode = $theme === '2004' && in_array($page['version'], ['2004_dlv2','2004_dlv3']);
    echo '<h2>Available Downloads</h2><ul>';
    foreach ($files as $f) {
        $url = htmlspecialchars($f['main_url']);
        $title = htmlspecialchars($f['title']);
        $size = htmlspecialchars($f['file_size']);
        echo '<li>';
        if ($buttonMode && $f['usingbutton']) {
            require_once __DIR__.'/cms/utilities/text_styler.php';
            $text = $f['buttonText'] !== '' ? $f['buttonText'] : "  CLICK HERE TO DOWNLOAD ( $size )";
            echo "<a href='$url'>" . renderGetSteamNowButton($text) . '</a>';
        } else {
            echo "<a href='$url'>$title</a> ($size)";
        }
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
