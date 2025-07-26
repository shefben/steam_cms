<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';
$theme = cms_get_setting('theme', '2005_v2');
if (in_array($theme, ['2004','2005_v1'])) {
    $area = preg_replace('/[^a-zA-Z0-9_]/','', $_GET['area'] ?? 'index');
    $file = __DIR__.'/../04-05v1_storefront/'.($area ?: 'index').'.php';
    if (is_file($file)) {
        include $file;
        return;
    }
}

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
$tpl = cms_theme_layout('index.twig', $theme);
$links = cms_load_store_links(__FILE__);
$db = cms_get_db();
$capsules = [];
$res = $db->query('SELECT position,appid,image FROM store_capsules');
foreach ($res as $row) {
    $capsules[$row['position']] = $row;
}
cms_render_template($tpl, [
    'links'    => $links,
    'capsules' => $capsules,
    'theme_subdir' => 'storefront'
]);
?>
