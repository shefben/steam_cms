<?php
require_once __DIR__.'/cms/utilities/functions.php';
require_once __DIR__.'/cms/db.php';
$page_title = 'Steam Network Status';
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
$cs_theme = cms_get_setting('cs_theme','default');
include __DIR__.'/cms/header.php';
$theme = 'default';
if($cs_theme==='2004') $theme='2004';
elseif($cs_theme==='2007') $theme='2007';
$theme_file = __DIR__.'/themes/'.$theme.'.php';
include $theme_file;
include __DIR__.'/cms/footer.php';
