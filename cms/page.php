<?php
$pagesDir = __DIR__ . '/pages';
$allowed = array_map(fn($p) => basename($p, '.php'), glob($pagesDir . '/*.php'));
$page = isset($_GET['page']) ? basename($_GET['page']) : 'home';
if (!in_array($page, $allowed, true)) {
    echo '<p>Page not found.</p>';
    include __DIR__ . '/footer.php';
    return;
}
$file = $pagesDir . '/' . $page . '.php';
include __DIR__ . '/header.php';
include $file;
include __DIR__ . '/footer.php';
