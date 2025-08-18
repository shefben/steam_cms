<?php
require_once __DIR__ . '/../config.php';
function db_connect() {
    static $db;
    if ($db instanceof PDO) {
        try {
            // Check if connection is still alive
            $db->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            return $db;
        } catch (PDOException $e) {
            // Connection lost, need to reconnect
            $db = null;
        }
    }

    $config_path = __DIR__ . '/../config.php';  // use __DIR__ or you deserve the pain
    if (!file_exists($config_path)) {
        throw new RuntimeException('CMS not installed. Please run install.php');
    }

    $cfg = include $config_path;
    if (!is_array($cfg)) {
        throw new RuntimeException('Invalid config file. Expected an array.');
    }

    try {
        $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['dbname']};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $db = new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
        return $db;
    } catch (PDOException $e) {
        throw new RuntimeException('Connection failed: ' . $e->getMessage(), 0, $e);
    }
}

function get_setting($db, $key) {
    $stmt = $db->prepare("SELECT value FROM settings WHERE `key`=?");
    $stmt->execute([$key]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['value'] : null;
}

function set_setting($db, $key, $val) {
    $stmt = $db->prepare("REPLACE INTO settings(`key`, value) VALUES(?,?)");
    $stmt->execute([$key, $val]);
}

function get_total_capacity($servers){
    $sum = 0;
    foreach ($servers as $s) $sum += $s['total_capacity'];
    return $sum;
}

function get_total_available($servers){
    $sum = 0;
    foreach ($servers as $s) $sum += $s['available_bandwidth'];
    return $sum;
}

function check_online($ip, $port){
    $fp = @fsockopen($ip, $port, $errno, $errstr, 0.5);
    if ($fp) { 
        fclose($fp); 
        return true; 
    }
    error_log("Server check failed for $ip:$port - $errstr ($errno)");
    return false;
}

function get_servers($db){
    try {
        $res = $db->query("SHOW COLUMNS FROM content_servers LIKE 'region'");
    } catch(PDOException $e){
        if($e->getCode()===1146) return [];
        throw $e;
    }
    $has_region = $res && $res->rowCount() > 0;
    $res = $db->query("SHOW COLUMNS FROM content_servers LIKE 'website'");
    $has_website = $res && $res->rowCount() > 0;
    $res = $db->query("SHOW COLUMNS FROM content_servers LIKE 'filtered'");
    $has_filtered = $res && $res->rowCount() > 0;
    $select = "cs.id, cs.name, cs.ip, cs.port, cs.total_capacity";
    if($has_region) $select .= ", cs.region";
    if($has_website) $select .= ", cs.website";
    if($has_filtered) $select .= ", cs.filtered";
    $sql = "SELECT $select, ss.available_bandwidth, ss.unique_connections, ss.last_checked, ss.status FROM content_servers cs LEFT JOIN server_stats ss ON cs.id=ss.server_id";
    try {
        $res = $db->query($sql);
    } catch(PDOException $e){
        if($e->getCode()===1146) return [];
        throw $e;
    }
    $servers = [];
    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
        if(!isset($row['region'])) $row['region'] = 'Unknown';
        if(!isset($row['website'])) $row['website'] = null;
        if(!isset($row['filtered'])) $row['filtered'] = 0;
        $servers[] = $row;
    }
    return $servers;
}

function get_last_update($db){
    $res = $db->query("SELECT MAX(last_checked) AS last_update FROM server_stats");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['last_update'] : null;
}

function update_server_stats($db, &$server){
    if (!$server['last_checked'] || strtotime($server['last_checked']) < time() - 43200) {
        $status = 'DOWN';
        $available = 0;
        $unique = 0;
        $fp = @fsockopen($server['ip'], $server['port'], $errno, $errstr, 0.5);
        if (!$fp) {
            error_log("Failed to connect to server {$server['ip']}:{$server['port']} - $errstr ($errno)");
        }
        if ($fp) {
            fwrite($fp, "STATS\n");
            stream_set_timeout($fp, 2);
            $response = fgets($fp, 1024);
            if ($response) {
                list($available, $unique) = array_map('intval', explode(' ', trim($response)));
                $status = 'UP';
            }
            fclose($fp);
        }
        $stmt = $db->prepare("REPLACE INTO server_stats(server_id, available_bandwidth, unique_connections, last_checked, status) VALUES(?, ?, ?, NOW(), ?)");
        $stmt->execute([$server['id'], $available, $unique, $status]);
        $server['available_bandwidth'] = $available;
        $server['unique_connections'] = $unique;
        $server['status'] = $status;
        $server['last_checked'] = date('Y-m-d H:i:s');
    }
}

function render_server_block($s){
    $capWidth = min(100, ($s['total_capacity'] / 1000) * 100);
    $loadPct = $s['total_capacity'] ? (1 - $s['available_bandwidth'] / $s['total_capacity']) * 100 : 0;
    $loadPct = max(0, min(100, $loadPct));
    $availPct = 100 - $loadPct;
    ob_start();
    ?>
    <!-- ===== BEGIN CONTENT SERVER BLOCK ===== -->
    <span class="linky" onclick="showBranch('Server<?php echo $s['id']; ?>Details');swapPlus('plus<?php echo $s['id']; ?>')"><img class="plusMinus" id="plus<?php echo $s['id']; ?>" src="./img/plus.gif"></span>
    <div class="statusBlock" title="<?php if($s['status']=='UP'){ echo 'Available: '.$s['total_capacity'].'Mbps | Current Load: '.($s['total_capacity']?round((1-($s['available_bandwidth']/$s['total_capacity']))*100,1):0).'%'; } else { echo 'Server is down.  No information available.'; } ?>">
    <h2 class="<?php echo $s['status']=='UP' ? 'status' : 'status-down'; ?>">CONTENT SERVER <?php echo $s['id']; ?> -
        <?php if(!empty($s['website'])): ?>
            <a href="<?php echo htmlspecialchars($s['website']); ?>"><?php echo htmlspecialchars($s['name']); ?></a>
        <?php else: ?>
            <?php echo htmlspecialchars($s['name']); ?>
        <?php endif; ?>
        <?php if(!empty($s['filtered'])): ?> <font color="#5B5B5B">[<a class="filter_link" href="javascript:popUp('filtered_servers.php')">filtered</a>]</font><?php endif; ?>
        <?php if($s['status']!='UP') echo ' - DOWN'; ?>
    </h2>
    <?php if($s['status']=='UP'): ?>
    <table class="statusGraph" cellspacing="0" width="<?php echo (int)$capWidth; ?>%">
            <tr>
                    <td class="CurrentLoad" width="<?php echo (int)$loadPct; ?>%" height="6"></td>
                    <td class="AvailableBytesPerSecond" width="<?php echo (int)$availPct; ?>%"></td>
            </tr>
    </table>
    <?php endif; ?>
    <div class="statusDetails" id="Server<?php echo $s['id']; ?>Details">
    <table class="status">
            <tr>
                    <td class="details">Status</td>
                    <td class="<?php echo $s['status']=='UP' ? 'maize' : 'status-down'; ?>"><?php echo $s['status']=='UP' ? 'Alive' : 'DOWN'; ?></td>
            </tr>
            <tr>
                    <td>Host</td>
                    <td><?php echo htmlspecialchars($s['ip']); ?></td>
            </tr>
            <?php if($s['status']=='UP'): ?>
            <tr>
                    <td>Unique connections</td>
                    <td><?php echo $s['unique_connections']; ?></td>
            </tr>
            <tr>
                    <td>Total capacity (bandwidth)</td>
                    <td><?php echo $s['total_capacity']; ?>Mbps</td>
            </tr>
            <tr>
                    <td>Current available bandwidth</td>
                    <td><?php echo $s['available_bandwidth']; ?>Mbps</td>
            </tr>
            <?php endif; ?>
    </table>
    </div>
    </div>
    <!-- ===== END CONTENT SERVER BLOCK ===== -->
    <?php
    return ob_get_clean();
}

function rng_player_series(int $pts, int $start, int $step, int $cap): array {
    $usage = [];
    for ($i = 0; $i <= $pts; $i++) {
        $ts   = $start + $i * $step;
        $prev = ($i > 0 && isset($usage[$i-1]['v'])) ? $usage[$i-1]['v'] : rand(10_000, 90_000);
        $usage[] = ['t'=>$ts, 'v'=>max(0,min($cap, $prev + rand(-3_000,3_000)))];
    }
    // servers = cream line with a few bumps
    $baseline = 50_000;
    $capArr   = array_fill(0, $pts+1, $baseline);
    for ($j = 0; $j < 10; $j++) {
        $k = rand(10, $pts-10);
        $capArr[$k] += rand(200, 50_000);
    }
    return [$usage, $capArr];
}

function rng_bw_series(int $pts, int $start, int $step, int $cap): array {
    $usage = [];
    for ($i = 0; $i <= $pts; $i++) {
        $ts   = $start + $i * $step;
        $prev = $usage[$i-1]['v'] ?? rand(2_500, 5_500);
        $usage[] = ['t'=>$ts, 'v'=>max(1_200,min(6_500, $prev + rand(-300,300)))];
    }
    // capacity spikes (white stubs)
    $capArr = array_fill(0, $pts+1, $cap);
    for ($j = 0; $j < 6; $j++) {
        $k = rand(5, $pts-5);
        $capArr[$k] += rand(400,1_600);
    }
    return [$usage, $capArr];
}

/* ────────────────────────────────────────────────────────────
 * Monthly-average headline stats
 *   • unique users  (distinct SteamIDs per calendar month)
 *   • player minutes (Σ of session-minutes per month)
 * Returns: ['users'=>int, 'minutes'=>int]
 * ──────────────────────────────────────────────────────────── */
function headline_stats(int $maxConcurrent): array
{
    $useDB = false; /*(USE_DATABASE && ($_GET['source'] ?? '') !== 'rng')
             || ($_GET['source'] ?? '') === 'db';*/

    if ($useDB) {
        $db = db_connect();   // <- your own connector

        /* 12-month window, one row per calendar month, then AVG() */
        $sql = "
          SELECT
             AVG(m.users)   AS avg_users,
             AVG(m.minutes) AS avg_minutes
          FROM (
              SELECT
                  COUNT(DISTINCT user_id)             AS users,
                  SUM(TIMESTAMPDIFF(MINUTE,
                                   session_start,
                                   session_end))      AS minutes
              FROM   player_sessions
              WHERE  session_start >= CURDATE() - INTERVAL 12 MONTH
              GROUP  BY YEAR(session_start), MONTH(session_start)
          ) m";
        $row = $db->query($sql)->fetch_assoc();

        // DB columns are NULL if you don’t have 12 full months yet ⇒ fall back.
        if ($row && $row['avg_users'] !== null && $row['avg_minutes'] !== null) {
            return ['users'   => (int) $row['avg_users'],
                    'minutes' => (int) $row['avg_minutes']];
        }
        /* <— fall through to RNG if query empty */
    }

    /* ───── Random, but plausible ───── */
    $avgUsers   = max($maxConcurrent + rand(50_000, 200_000), 1_000_000);
    $avgMinutes = rand(3_500_000_000, 5_000_000_000);   // 3.5-5.0 B

    return ['users'=>$avgUsers, 'minutes'=>$avgMinutes];
}

function human_unit_format(int|float $n): string {
    $n = (float)$n;
    if ($n >= 1_000_000_000) {
        return number_format($n / 1_000_000_000, 3) . ' billion';
    }
    if ($n >= 1_000_000) {
        return number_format($n / 1_000_000, 2) . ' million';
    }
    if ($n >= 1_000) {
        return number_format($n / 1_000, 1) . ' thousand';
    }
    if ($n >= 100) {
        return number_format($n / 100, 0) . ' hundred';
    }
    return (string)number_format($n);
}

/* ---------- unified getters ---------- */
function player_data(int $pts, int $start, int $step, int $cap): array {
    /*if ((USE_DATABASE && ($_GET['source']??'')!=='rng') || ($_GET['source']??'')==='db') {
        return rng_player_series($pts, $start, $step, $cap);   // or rng_bw_series(…)
    }*/
    return rng_player_series($pts, $start, $step, $cap);
}

function bw_data(int $pts, int $start, int $step, int $cap): array {
    /*if ((USE_DATABASE && ($_GET['source']??'')!=='rng') || ($_GET['source']??'')==='db') {
        return  rng_bw_series($pts, $start, $step, $cap);
    }*/
    return rng_bw_series($pts, $start, $step, $cap);
}
?>
