<?php
session_start();
require_once '../functions.php';
if (!isset($_SESSION['uid'])) { header('Location: login.php'); exit; }
$db = db_connect();
$servers = get_servers($db);
$main_ip = get_setting($db,'main_network_ip');
$main_port = get_setting($db,'main_network_port');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $stmt=$db->prepare('INSERT INTO content_servers(name,ip,port,total_capacity) VALUES(?,?,?,?)');
        $stmt->bind_param('ssii',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity']);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php'); exit;
    }
    if (isset($_POST['update'])) {
        $stmt=$db->prepare('UPDATE content_servers SET name=?, ip=?, port=?, total_capacity=? WHERE id=?');
        $stmt->bind_param('ssiii',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity'],$_POST['id']);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php'); exit;
    }
    if (isset($_POST['delete'])) {
        $id=(int)$_POST['delete'];
        $db->query('DELETE FROM content_servers WHERE id='.$id);
        $db->query('DELETE FROM server_stats WHERE server_id='.$id);
        header('Location: index.php'); exit;
    }
}
?>
<html><body>
<h1>Content Servers</h1>
<table border="1">
<tr><th>Name</th><th>IP</th><th>Port</th><th>Capacity</th><th>Actions</th></tr>
<?php foreach($servers as $s): ?>
<tr>
<form method="post">
<td><input type="text" name="name" value="<?php echo htmlspecialchars($s['name']); ?>"></td>
<td><input type="text" name="ip" value="<?php echo htmlspecialchars($s['ip']); ?>"></td>
<td><input type="number" name="port" value="<?php echo $s['port']; ?>"></td>
<td><input type="number" name="capacity" value="<?php echo $s['total_capacity']; ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $s['id']; ?>">
<button name="update" value="1">Update</button>
<button name="delete" value="<?php echo $s['id']; ?>" onclick="return confirm('delete?')">Delete</button>
</td>
</form>
</tr>
<?php endforeach; ?>
</table>
<h2>Add New Server</h2>
<form method="post">
<input type="text" name="name" placeholder="Name">
<input type="text" name="ip" placeholder="IP">
<input type="number" name="port" placeholder="Port">
<input type="number" name="capacity" placeholder="Capacity">
<button name="add" value="1">Add</button>
</form>
<h2>Settings</h2>
<form method="post" action="settings.php">
IP <input type="text" name="main_network_ip" value="<?php echo htmlspecialchars($main_ip); ?>">
Port <input type="number" name="main_network_port" value="<?php echo $main_port; ?>">
<input type="submit" value="Update">
</form>
<p><a href="logout.php">Logout</a></p>
</body></html>
