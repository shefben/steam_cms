<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$area = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['area'] ?? 'browse');

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
$ver = (strpos($theme, '2006') !== false) ? '2006' : '2005';
$layout = ($ver === '2005') ? 'storefront.twig' : 'default.twig';

if ($ver === '2005') {
    $tpl = cms_theme_layout($layout, $theme);
    cms_render_template($tpl, ['page_title' => 'Steam Games', 'theme_subdir' => 'storefront']);
} else {
    $body_tpl = dirname(__DIR__) . '/themes/2005_v1/storefront/layout/2005_body.twig';
    $links = cms_load_store_links(__FILE__);
    $db = cms_get_db();
    $capsules = [];
    $res = $db->query('SELECT position,appid,image FROM store_capsules');
    foreach ($res as $row) {
        $capsules[$row['position']] = $row;
    }

    ob_start();
    if (file_exists($body_tpl)) {
        cms_render_template_theme($body_tpl, '2005_v1', [
            'links'    => $links,
            'capsules' => $capsules,
            'theme_subdir' => 'storefront',
        ]);
    }
    $body = ob_get_clean();

    $tpl = cms_theme_layout($layout, $theme);
    cms_render_template($tpl, [
        'page_title' => 'Steam Games',
        'content'    => $body,
        'theme_subdir' => 'storefront',
    ]);
}
?>
