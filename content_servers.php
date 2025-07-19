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
foreach($servers as &$srv){ update_server_stats($db,$srv); }
$last_update = get_last_update($db);
$total_capacity = get_total_capacity($servers);
$total_available = get_total_available($servers);
$max_capacity = 0; foreach($servers as $s){ if($s['total_capacity']>$max_capacity) $max_capacity=$s['total_capacity']; }
cms_refresh_themes();
$themes = cms_get_themes();
$cs_theme = cms_get_setting('cs_theme','2004');
if(!in_array($cs_theme,$themes)){
    $cs_theme = $themes[0] ?? '2004';
}
$theme_dir = __DIR__.'/themes/'.$cs_theme;
if (!is_file($theme_dir.'/contentserver_block.php')) {
    $theme_dir = __DIR__.'/themes/2004';
}
$theme_file = $theme_dir.'/contentserver_block.php';

ob_start();
include $theme_file;
$content = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $cs_theme);
cms_render_template_theme($tpl, $cs_theme, [
    'page_title' => $page_title,
    'content'    => $content,
]);
