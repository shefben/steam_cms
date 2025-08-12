<?php
$servers = require __DIR__ . '/content_servers_seed.php';
$stmt = $pdo->prepare('INSERT INTO content_servers(name, ip, port, total_capacity, region, website, filtered) VALUES(?,?,?,?,?,?,?)');
foreach ($servers as $srv) {
    $stmt->execute($srv);
}
?>
