<?php
require_once 'admin_header.php';
require_once dirname(__DIR__,2).'/cms/utilities/functions.php';
$db = db_connect();
$servers = get_servers($db);
$main_ip = get_setting($db,'main_network_ip');
$main_port = get_setting($db,'main_network_port');
if(!$main_ip && !$main_port && $servers){
    $main_ip = $servers[0]['ip'];
    $main_port = $servers[0]['port'];
    set_setting($db,'main_network_ip',$main_ip);
    set_setting($db,'main_network_port',$main_port);
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
        $filtered = isset($_POST['filtered']) ? 1 : 0;
        $stmt=$db->prepare('INSERT INTO content_servers(name,ip,port,total_capacity,region,website,filtered) VALUES(?,?,?,?,?,?,?)');
        $stmt->bind_param('ssisssi',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity'],$_POST['region'],$_POST['website'],$filtered);
        $stmt->execute();
        $stmt->close();
        cms_admin_log('Added content server '.trim($_POST['name']));
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['update'])){
        $filtered = isset($_POST['filtered']) ? 1 : 0;
        $stmt=$db->prepare('UPDATE content_servers SET name=?, ip=?, port=?, total_capacity=?, region=?, website=?, filtered=? WHERE id=?');
        $stmt->bind_param('ssisssii',$_POST['name'],$_POST['ip'],$_POST['port'],$_POST['capacity'],$_POST['region'],$_POST['website'],$filtered,$_POST['id']);
        $stmt->execute();
        $stmt->close();
        cms_admin_log('Updated content server '.intval($_POST['id']));
        header('Location: content_servers.php'); exit;
    }
    if(isset($_POST['delete'])){
        $id=(int)$_POST['delete'];
        $db->query('DELETE FROM content_servers WHERE id='.$id);
        $db->query('DELETE FROM server_stats WHERE server_id='.$id);
        cms_admin_log('Deleted content server '.$id);
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
<style>
.col-small { width: 60px; }
.modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; display: flex; justify-content: center; align-items: center; }
.modal { background: #fff; padding: 20px; border-radius: 8px; width: 400px; max-width: 90%; }
.modal label { display: block; margin-bottom: 10px; font-weight: bold; }
.modal input[type="text"], .modal input[type="number"] { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
.modal-actions { margin-top: 20px; text-align: right; }
</style>
<h2>Content Servers</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage the list of content/download servers available to clients.</p>
<table class="data-table">
<tr><th class="col-small">Select</th><th>Name</th><th>IP</th><th class="col-small">Port</th><th class="col-small">Capacity</th><th>Region</th><th>Website</th><th class="col-small">Filtered</th><th>Actions</th></tr>
<?php foreach($servers as $s): ?>
<tr>
<td><input type="radio" name="main_server" value="<?php echo $s['id']; ?>" form="mainForm" <?php echo ($s['ip']==$main_ip && $s['port']==$main_port)?'checked':''; ?>></td>
<td><?php echo htmlspecialchars($s['name']); ?></td>
<td><?php echo htmlspecialchars($s['ip']); ?></td>
<td><?php echo $s['port']; ?></td>
<td><?php echo $s['total_capacity']; ?></td>
<td><?php echo htmlspecialchars($s['region']); ?></td>
<td><?php echo htmlspecialchars($s['website']); ?></td>
<td><?php echo $s['filtered'] ? 'Yes' : 'No'; ?></td>
<td>
    <button type="button" class="btn btn-primary btn-small edit-btn" data-id="<?php echo $s['id']; ?>" data-name="<?php echo htmlspecialchars($s['name']); ?>" data-ip="<?php echo htmlspecialchars($s['ip']); ?>" data-port="<?php echo $s['port']; ?>" data-capacity="<?php echo $s['total_capacity']; ?>" data-region="<?php echo htmlspecialchars($s['region']); ?>" data-website="<?php echo htmlspecialchars($s['website']); ?>" data-filtered="<?php echo $s['filtered']; ?>">Edit</button>
    <form method="post" style="display:inline;">
        <button type="submit" name="delete" value="<?php echo $s['id']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Delete server?')">Delete</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</table>
<form id="mainForm" method="post" style="margin-top:10px; margin-bottom: 20px;">
<input type="hidden" name="set_main_server" value="1">
<button type="submit" class="btn btn-primary">Save Default Server</button>
</form>

<button type="button" id="addBtn" class="btn btn-secondary">Add new Content server</button>

<div id="serverModal" class="modal-overlay" style="display:none;">
    <div class="modal">
        <h3 id="modalTitle" style="margin-top:0;">Add Server</h3>
        <form method="post">
            <input type="hidden" name="id" id="serverId">
            <input type="hidden" name="action" id="serverAction" value="add">
            <label>Name <input type="text" name="name" id="serverName" required></label>
            <label>IP <input type="text" name="ip" id="serverIp" required></label>
            <label>Port <input type="number" name="port" id="serverPort" required></label>
            <label>Capacity <input type="number" name="capacity" id="serverCapacity" required></label>
            <label>Region <input type="text" name="region" id="serverRegion"></label>
            <label>Website <input type="text" name="website" id="serverWebsite"></label>
            <label style="font-weight:normal;"><input type="checkbox" name="filtered" id="serverFiltered" value="1"> Filtered</label>
            
            <div class="modal-actions">
                <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
                <button type="submit" name="save_server" value="1" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#addBtn').on('click', function() {
        $('#modalTitle').text('Add new Content server');
        $('#serverId').val('');
        $('#serverName').val('');
        $('#serverIp').val('');
        $('#serverPort').val('');
        $('#serverCapacity').val('');
        $('#serverRegion').val('');
        $('#serverWebsite').val('');
        $('#serverFiltered').prop('checked', false);
        $('#serverModal form').find('button[name="save_server"]').attr('name', 'add');
        $('#serverModal').css('display', 'flex');
    });

    $('.edit-btn').on('click', function() {
        $('#modalTitle').text('Edit Content server');
        $('#serverId').val($(this).data('id'));
        $('#serverName').val($(this).data('name'));
        $('#serverIp').val($(this).data('ip'));
        $('#serverPort').val($(this).data('port'));
        $('#serverCapacity').val($(this).data('capacity'));
        $('#serverRegion').val($(this).data('region'));
        $('#serverWebsite').val($(this).data('website'));
        $('#serverFiltered').prop('checked', $(this).data('filtered') == 1);
        $('#serverModal form').find('button[type="submit"]').attr('name', 'update');
        $('#serverModal').css('display', 'flex');
    });

    $('#cancelBtn').on('click', function() {
        $('#serverModal').hide();
    });

    $('#serverModal').on('click', function(e) {
        if (e.target === this) {
            $(this).hide();
        }
    });
});
</script>

<?php include 'admin_footer.php'; ?>
