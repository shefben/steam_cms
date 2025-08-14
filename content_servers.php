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
    $used = ($srv['total_capacity'] ?? 0) - ($srv['available_bandwidth'] ?? 0);
    $load = ($srv['total_capacity'] ?? 0) > 0 ? ($used / $srv['total_capacity']) * 100 : 0;
    $load = max(0, min(100, $load));
    $srv['load_percent'] = $load;
    $srv['avail_percent'] = 100 - $load;
}
unset($srv);
$last_update    = date('Y-m-d H:i:s');
$total_capacity = get_total_capacity($servers);
$total_available = $total_capacity;

$regions = [];
foreach ($servers as $srv) {
    $reg = $srv['region'] ?? 'Unknown';
    $regions[$reg][] = $srv;
}
ksort($regions, SORT_NATURAL | SORT_FLAG_CASE);
foreach ($regions as &$list) {
    usort($list, fn($a, $b) => strcasecmp($a['name'], $b['name']));
}
unset($list);

$theme  = cms_get_setting('theme', '2004');
$template = cms_theme_page_template('content_servers', $theme);
if (basename($template) === 'content_servers.twig') {
    $tplDir = dirname($template);
    $content = cms_render_string(
        file_get_contents($template),
        [
            'servers' => $servers,
            'regions' => $regions,
            'total_available' => $total_available,
            'total_capacity' => $total_capacity,
        ],
        $tplDir
    );
} else {
    $theme_dir = __DIR__ . '/themes/' . $theme;
    if (!is_file($theme_dir.'/contentserver_block.php')) {
        $theme_dir = __DIR__.'/themes/2004';
        $theme = '2004';
    }
    $theme_file = $theme_dir.'/contentserver_block.php';
    ob_start();
    include $theme_file;
    $content = ob_get_clean();
}

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template_theme($tpl, $theme, [
    'page_title' => $page_title,
    'content'    => $content,
]);
