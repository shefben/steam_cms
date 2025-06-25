<?php
require_once __DIR__.'/config.php';

function db_connect() {
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

function get_setting($db, $key) {
    $stmt = $db->prepare("SELECT setting_value FROM settings WHERE setting_key=?");
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $stmt->bind_result($val);
    $stmt->fetch();
    $stmt->close();
    return $val;
}

function set_setting($db, $key, $val) {
    $stmt = $db->prepare("REPLACE INTO settings(setting_key, setting_value) VALUES(?,?)");
    $stmt->bind_param('ss', $key, $val);
    $stmt->execute();
    $stmt->close();
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
    $fp = @fsockopen($ip, $port, $errno, $errstr, 2);
    if ($fp) { fclose($fp); return true; }
    return false;
}

function get_servers($db){
    $res = $db->query("SELECT cs.id, cs.name, cs.ip, cs.port, cs.total_capacity, ss.available_bandwidth, ss.unique_connections, ss.last_checked, ss.status FROM content_servers cs LEFT JOIN server_stats ss ON cs.id=ss.server_id");
    $servers = [];
    while ($row = $res->fetch_assoc()) $servers[] = $row;
    return $servers;
}

function get_last_update($db){
    $res = $db->query("SELECT MAX(last_checked) AS last_update FROM server_stats");
    $row = $res->fetch_assoc();
    return $row ? $row['last_update'] : null;
}

function update_server_stats($db, &$server){
    if (!$server['last_checked'] || strtotime($server['last_checked']) < time() - 43200) {
        $status = 'DOWN';
        $available = 0;
        $unique = 0;
        $fp = @fsockopen($server['ip'], $server['port'], $errno, $errstr, 2);
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
        $stmt->bind_param('iiis', $server['id'], $available, $unique, $status);
        $stmt->execute();
        $stmt->close();
        $server['available_bandwidth'] = $available;
        $server['unique_connections'] = $unique;
        $server['status'] = $status;
        $server['last_checked'] = date('Y-m-d H:i:s');
    }
}

function render_server_block($s, $max_capacity){
    ob_start();
    ?>
    <!-- ===== BEGIN CONTENT SERVER BLOCK ===== -->
    <span class="linky" onclick="showBranch('Server<?php echo $s['id']; ?>Details');swapPlus('plus<?php echo $s['id']; ?>')"><img class="plusMinus" id="plus<?php echo $s['id']; ?>" src="./img/plus.gif"></span>
    <div class="statusBlock" title="<?php if($s['status']=='UP'){ echo 'Available: '.$s['total_capacity'].'Mbps | Current Load: '.($s['total_capacity']?round((1-($s['available_bandwidth']/$s['total_capacity']))*100,1):0).'%'; } else { echo 'Server is down.  No information available.'; } ?>">
    <h2 class="<?php echo $s['status']=='UP' ? 'status' : 'status-down'; ?>">CONTENT SERVER <?php echo $s['id']; ?> - <?php echo htmlspecialchars($s['name']); ?><?php if($s['status']!='UP') echo ' - DOWN'; ?></h2>
    <?php if($s['status']=='UP'): ?>
    <table class="statusGraph" cellspacing="0" width="<?php echo (int)(($s['total_capacity']/$max_capacity)*100); ?>%">
            <tr>
                    <td class="CurrentLoad" width="<?php echo (int)((1-$s['available_bandwidth']/$s['total_capacity'])*100); ?>%" height="6"></td>
                    <td class="AvailableBytesPerSecond" width="<?php echo (int)(($s['available_bandwidth']/$s['total_capacity'])*100); ?>%"></td>
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
?>
