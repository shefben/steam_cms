<?php
$page_title = 'Steam Network Status';
require_once __DIR__.'/cms/utilities/functions.php';
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';
$db = db_connect();
$main_ip = get_setting($db,'main_network_ip');
$main_port = get_setting($db,'main_network_port');
$steam_online = check_online($main_ip,$main_port);
$servers = get_servers($db);
foreach ($servers as &$srv) {
    $srv['available_bandwidth'] = $srv['total_capacity'];
}
$last_update    = date('Y-m-d H:i:s');
$total_capacity = get_total_capacity($servers);
$total_available = $total_capacity;
$theme  = cms_get_setting('theme', '2004');
$theme_dir = __DIR__ . '/themes/' . $theme;
if (!is_file($theme_dir.'/contentserver_block.php')) {
    $theme_dir = __DIR__.'/themes/2004';
    $theme = '2004';
}
$theme_file = $theme_dir.'/contentserver_block.php';

ob_start();
include $theme_file;
$content = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template_theme($tpl, $theme, [
    'page_title' => $page_title,
    'content'    => $content,
]);
