<?php
$page = isset($_GET['page']) ? basename($_GET['page']) : 'home';
$file = __DIR__ . '/pages/' . $page . '.php';
$page_title = ucfirst($page);
include __DIR__ . '/header.php';
if(file_exists($file)) {
    include $file;
} else {
    echo '<p>Page not found.</p>';
}
include __DIR__ . '/footer.php';
