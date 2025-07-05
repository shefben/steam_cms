<?php
require_once 'admin_header.php';
require_once dirname(__DIR__,2).'/cms/utilities/functions.php';
$db = db_connect();
$servers = get_servers($db);
$main_ip = get_setting($db,'main_network_ip');
$main_port = get_setting($db,'main_network_port');
$themes = [];
cms_refresh_themes();
$themes = cms_get_themes();
$cs_theme = get_setting($db,'cs_theme') ?: ($themes[0] ?? '2004');
if(!in_array($cs_theme,$themes) && $themes){
    $cs_theme = $themes[0];
    set_setting($db,'cs_theme',$cs_theme);
}
if(!$main_ip && !$main_port && $servers){
    $main_ip = $servers[0]['ip'];
    $main_port = $servers[0]['port'];
    set_setting($db,'main_network_ip',$main_ip);
    set_setting($db,'main_network_port',$main_port);
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
        $stmt=$db->prepare('INSERT INTO content_servers(name,ip,port,total_capacity,region) VALUES(?,?,?,?,?)');
        $stmt->bind_param('ssiss',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity'],$_POST['region']);
        $stmt->execute();
        $stmt->close();
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE content_servers SET name=?, ip=?, port=?, total_capacity=?, region=? WHERE id=?');
        $stmt->bind_param('ssissi',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity'],$_POST['region'],$_POST['id']);
        $stmt->execute();
        $stmt->close();
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['delete'])){
        $id=(int)$_POST['delete'];
        $db->query('DELETE FROM content_servers WHERE id='.$id);
        $db->query('DELETE FROM server_stats WHERE server_id='.$id);
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['set_settings'])){
        set_setting($db,'cs_theme',$_POST['cs_theme']);
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['set_main_server'])){
        $sid = (int)$_POST['main_server'];
        $stmt = $db->prepare('SELECT ip,port FROM content_servers WHERE id=?');
        $stmt->bind_param('i',$sid);
        $stmt->execute();
        $stmt->bind_result($ip,$port);
        if($stmt->fetch()){
            set_setting($db,'main_network_ip',$ip);
            set_setting($db,'main_network_port',$port);
        }
        $stmt->close();
        header('Location: content_servers.php'); exit;
    }
}
$servers = get_servers($db);
?>
<h2>Content Servers</h2>
<table border="1">
<tr><th>Select</th><th>Name</th><th>IP</th><th>Port</th><th>Capacity</th><th>Region</th><th>Actions</th></tr>
<?php foreach($servers as $s): ?>
<tr>
<form method="post">
<td><input type="radio" name="main_server" value="<?php echo $s['id']; ?>" form="mainForm" <?php echo ($s['ip']==$main_ip && $s['port']==$main_port)?'checked':''; ?>></td>
<td><input type="text" name="name" value="<?php echo htmlspecialchars($s['name']); ?>"></td>
<td><input type="text" name="ip" value="<?php echo htmlspecialchars($s['ip']); ?>"></td>
<td><input type="number" name="port" value="<?php echo $s['port']; ?>"></td>
<td><input type="number" name="capacity" value="<?php echo $s['total_capacity']; ?>"></td>
<td><input type="text" name="region" value="<?php echo htmlspecialchars($s['region']); ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $s['id']; ?>">
<button name="update" value="1">Update</button>
<button name="delete" value="<?php echo $s['id']; ?>" onclick="return confirm('delete?')">Delete</button>
</td>
</form>
</tr>
<?php endforeach; ?>
</table>
<form id="mainForm" method="post">
<input type="hidden" name="set_main_server" value="1">
<button type="submit">Save Default Server</button>
</form>
<h3>Add New Server</h3>
<form method="post">
<input type="text" name="name" placeholder="Name">
<input type="text" name="ip" placeholder="IP">
<input type="number" name="port" placeholder="Port">
<input type="number" name="capacity" placeholder="Capacity">
<input type="text" name="region" placeholder="Region">
<button name="add" value="1">Add</button>
</form>
<h3>Settings</h3>
<form method="post">
Theme <select name="cs_theme">
<?php foreach($themes as $t): ?>
    <option value="<?php echo htmlspecialchars($t); ?>" <?php echo $t==$cs_theme?'selected':''; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select>
<input type="hidden" name="set_settings" value="1">
<input type="submit" value="Update">
</form>
<?php include 'admin_footer.php'; ?>
