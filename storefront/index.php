<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';
$theme = cms_get_setting('theme', '2005_v2');
if (in_array($theme, ['2003', '2004', '2005_v1'], true)) {
    $area = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['area'] ?? '');
    if ($area === '') {
        header('Location: packs.php');
        exit;
    }
    foreach (['l','s','i','a'] as $p) {
        if (!isset($_GET[$p])) {
            $_GET[$p] = '';
        }
    }
    $file = __DIR__ . '/' . $area . '.php';
    if (is_file($file)) {
        include $file;
        return;
    }
}

$area = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['area'] ?? '');

// propagate legacy storefront parameters so included pages can access them
foreach (['l','s','i','a'] as $p) {
    if (!isset($_GET[$p])) {
        $_GET[$p] = '';
    }
}

if (in_array($area, ['browse', 'search', 'game', 'package', 'all'], true)) {
    include __DIR__ . '/' . $area . '.php';
    exit;
}

$theme = cms_get_setting('theme', '2005_v2');
$tpl   = cms_theme_layout('index.twig', $theme);
$links = cms_store_sidebar_links();

cms_render_template($tpl, [
    'links'        => $links,
    'theme_subdir' => 'storefront'
]);
?>
