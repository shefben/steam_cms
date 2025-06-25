<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();
if(isset($_POST['action']) && $_POST['action']==='save'){
    $id = intval($_POST['id']);
    $email = trim($_POST['email']);
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $perm = trim($_POST['permissions']);
    if($id){
        $stmt=$db->prepare('UPDATE admin_users SET email=?,first_name=?,last_name=?,permissions=? WHERE id=?');
        $stmt->execute([$email,$first,$last,$perm,$id]);
        if($_POST['password']!=='' && $_POST['password']===$_POST['confirm']){
            $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $db->prepare('UPDATE admin_users SET password=? WHERE id=?')->execute([$hash,$id]);
        }
    }else{
        $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $stmt=$db->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,created,password) VALUES(?,?,?,?,?,NOW(),?)');
        $stmt->execute([trim($_POST['username']),$email,$first,$last,$perm,$hash]);
    }
}
if(isset($_POST['delete'])){
    $db->prepare('DELETE FROM admin_users WHERE id=?')->execute([intval($_POST['delete'])]);
}
$rows=$db->query('SELECT * FROM admin_users')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Administrators</h2>
<button id="addBtn">Add Administrator</button>
<table>
<tr><th>Username</th><th>Email</th><th>Created</th><th>Permissions</th><th>Actions</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['username']); ?></td>
<td><?php echo htmlspecialchars($r['email']); ?></td>
<td><?php echo htmlspecialchars($r['created']); ?></td>
<td><?php echo htmlspecialchars($r['permissions']); ?></td>
<td>
<button class="editBtn" data-id="<?php echo $r['id']; ?>">Edit</button>
<form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $r['id']; ?>"><input type="submit" value="Delete"></form>
</td>
</tr>
<?php endforeach; ?>
</table>
<div id="editor" style="display:none;border:1px solid #333;padding:10px;background:#eee;">
<form method="post">
<input type="hidden" name="id" id="eid" value="0">
<label>Username: <input type="text" name="username" id="eusername"></label><br>
<label>Email: <input type="text" name="email" id="eemail"></label><br>
<label>First Name: <input type="text" name="first_name" id="efirst"></label><br>
<label>Last Name: <input type="text" name="last_name" id="elast"></label><br>
<label>Permissions: <input type="text" name="permissions" id="eperm"></label><br>
<small>Available: <?php echo implode(', ', array_keys(cms_all_permissions())); ?></small><br>
<label>Password: <input type="password" name="password" id="epass"></label><br>
<label>Confirm: <input type="password" name="confirm" id="econf"></label><br>
<input type="hidden" name="action" value="save">
<button type="submit">Submit</button> <button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#addBtn').on('click',function(){
    $('#eid').val('0');
    $('#eusername').val('');
    $('#eemail').val('');
    $('#efirst').val('');
    $('#elast').val('');
    $('#eperm').val('');
    $('#epass').val('');
    $('#econf').val('');
    $('#editor').show();
});
$('.editBtn').on('click',function(){
    var id=$(this).data('id');
    <?php echo "var data=".json_encode($rows).";"; ?>
    for(var i=0;i<data.length;i++) if(data[i].id==id){
        $('#eid').val(data[i].id);
        $('#eusername').val(data[i].username);
        $('#eemail').val(data[i].email);
        $('#efirst').val(data[i].first_name);
        $('#elast').val(data[i].last_name);
        $('#eperm').val(data[i].permissions);
        break;
    }
    $('#editor').show();
});
$('#cancel').on('click',function(){ $('#editor').hide(); });
</script>
<?php include 'admin_footer.php'; ?>
