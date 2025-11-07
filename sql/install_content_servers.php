<?php

$servers = require __DIR__ . '/content_servers_seed.php';

$stmtSrv = $pdo->prepare(
    'INSERT IGNORE INTO content_servers(name, ip, port, total_capacity, region, website, filtered) VALUES(?,?,?,?,?,?,?)'
);

$stmtStat = $pdo->prepare(
    'INSERT IGNORE INTO server_stats(server_id, available_bandwidth, unique_connections, last_checked, status) ' .
    'VALUES(?, ?, 0, NOW(), ?)'
);

foreach ($servers as $srv) {
    [$name, $ip, $port, $total, $region, $website, $filtered, $used] = $srv;
    $stmtSrv->execute([$name, $ip, $port, $total, $region, $website, $filtered]);
    $id    = (int) $pdo->lastInsertId();
    $avail = $total - $used;
    $status = 'UNKNOWN';
    $stmtStat->execute([$id, $avail, $status]);
}
