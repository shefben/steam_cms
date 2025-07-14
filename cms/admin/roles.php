<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();

if (isset($_POST['save'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $permList = $_POST['perm'] ?? [];
    if (count($permList) === count(cms_all_permissions())) {
        $perm = 'all';
    } else {
        $perm = implode(',', array_map('trim', $permList));
    }
    if ($id) {
        $stmt = $db->prepare('UPDATE admin_roles SET name=?, permissions=? WHERE id=?');
        $stmt->execute([$name,$perm,$id]);
        cms_admin_log('Updated role ' . $id);
    } else {
        $stmt = $db->prepare('INSERT INTO admin_roles(name,permissions) VALUES(?,?)');
        $stmt->execute([$name,$perm]);
        cms_admin_log('Created role ' . $name);
    }
}

if (isset($_POST['delete'])) {
    $id = intval($_POST['delete']);
    $db->prepare('DELETE FROM admin_roles WHERE id=?')->execute([$id]);
    cms_admin_log('Deleted role ' . $id);
}

$roles = $db->query('SELECT * FROM admin_roles ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Roles</h2>
<button id="addBtn">Add Role</button>
<table>
<tr><th>Name</th><th>Permissions</th><th>Actions</th></tr>
<?php foreach ($roles as $r) : ?>
<tr>
  <td><?php echo htmlspecialchars($r['name']); ?></td>
  <td><?php echo htmlspecialchars($r['permissions']); ?></td>
  <td>
    <button class="editBtn" data-id="<?php echo $r['id']; ?>">Edit</button>
    <form method="post" style="display:inline">
      <input type="hidden" name="delete" value="<?php echo $r['id']; ?>">
      <input type="submit" value="Delete">
    </form>
  </td>
</tr>
<?php endforeach; ?>
</table>
<div id="editor" style="display:none;border:1px solid #333;padding:10px;background:#eee;">
<form method="post">
<input type="hidden" name="id" id="rid" value="0">
<label>Name: <input type="text" name="name" id="rname"></label><br>
<fieldset id="permBox" style="border:1px solid #ccc;padding:6px;max-height:200px;overflow:auto;">
<legend>Permissions</legend>
<?php foreach (cms_all_permissions() as $key => $label) : ?>
    <label style="display:block;"><input type="checkbox" class="permChk" name="perm[]" value="<?php echo $key; ?>"> <?php echo htmlspecialchars($label); ?></label>
<?php endforeach; ?>
<div style="margin-top:4px;">
    <button type="button" id="permAll" class="btn btn-small">All</button>
    <button type="button" id="permNone" class="btn btn-small">None</button>
</div>
</fieldset>
<input type="hidden" name="save" value="1">
<button type="submit">Submit</button> <button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<?php echo "<script>var cmsPerms=" . json_encode(cms_all_permissions()) . ";</script>"; ?>
<script>
$('#addBtn').on('click',function(){
    $('#rid').val('0');
    $('#rname').val('');
    $('.permChk').prop('checked',false);
    $('#editor').show();
});
$('.editBtn').on('click',function(){
    var id=$(this).data('id');
    var data=<?php echo json_encode($roles); ?>;
    for(var i=0;i<data.length;i++) if(data[i].id==id){
        $('#rid').val(data[i].id);
        $('#rname').val(data[i].name);
        var p=data[i].permissions==='all'?Object.keys(cmsPerms):data[i].permissions.split(',');
        $('.permChk').prop('checked',false);
        for(var j=0;j<p.length;j++){ var k=p[j].trim(); if(k) $('.permChk[value="'+k+'"]').prop('checked',true); }
        break;
    }
    $('#editor').show();
});
$('#cancel').on('click',function(){ $('#editor').hide(); });
$('#permAll').on('click',function(){ $('.permChk').prop('checked',true); });
$('#permNone').on('click',function(){ $('.permChk').prop('checked',false); });
</script>
<?php include 'admin_footer.php'; ?>
