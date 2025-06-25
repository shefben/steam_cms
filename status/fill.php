<?php
// --- Configuration – adjust if you can handle it ---
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'vuoOdtIeZRpxzc3o';
$dbName = 'stats';
$dbPort = 3339;

// 1) Connect
$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// 2) Create tables if missing
$db->query("
  CREATE TABLE IF NOT EXISTS content_servers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    ip VARCHAR(100),
    port INT,
    total_capacity INT
  )
");
$db->query("
  CREATE TABLE IF NOT EXISTS server_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    server_id INT,
    available_bandwidth INT,
    unique_connections INT,
    last_checked DATETIME,
    status VARCHAR(10)
  )
");


// 4) Helper to fetch servers
function get_servers($db){
    $res = $db->query("
      SELECT id, name, ip, port, total_capacity
      FROM content_servers
    ");
    $out = [];
    while ($row = $res->fetch_assoc()) {
        $out[] = $row;
    }
    return $out;
}

// 5) Fetch all servers
$servers = get_servers($db);
if (empty($servers)) {
    die("No servers found. Congrats on breaking it.\n");
}

// 6) Prepare server_stats insert
$stmtSS = $db->prepare("
  INSERT INTO server_stats
    (server_id, available_bandwidth, unique_connections, last_checked, status)
  VALUES (?, ?, ?, STR_TO_DATE(?, '%m/%d/%Y %H:%i:%s'), ?)
") or die("Prepare failed (server_stats): " . $db->error);

$statuses = ['online','offline','degraded'];
echo "Seeding one server_stats entry per server...\n";
foreach ($servers as $srv) {
    $sid  = (int)$srv['id'];
    $bw   = rand(100, 1000);
    $uc   = rand(1, 5000);
    $ts   = date('m/d/Y H:i:s');
    $stat = $statuses[array_rand($statuses)];

    $stmtSS->bind_param('iisss', $sid, $bw, $uc, $ts, $stat);
    if (! $stmtSS->execute()) {
        echo "  ➤ server_stats for server_id {$sid} failed: " . $stmtSS->error . "\n";
    } else {
        echo "  ✓ server_stats for server_id {$sid} inserted.\n";
    }
}
$stmtSS->close();

echo "All done—10 servers, 10 matching stats. Try not to mangle it.\n";

$db->close();