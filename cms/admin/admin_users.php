<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();
$roles = $db->query('SELECT id,name FROM admin_roles ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$roleMap = [];
foreach($roles as $r){
    $roleMap[$r['id']] = $r['name'];
}
// search & pagination parameters
$search = trim($_GET['q'] ?? '');
$page   = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;
$where = '';
$params = [];
if($search !== ''){
    $where = 'WHERE username LIKE ? OR email LIKE ?';
    $params = ['%'.$search.'%','%'.$search.'%'];
}
$count = $db->prepare("SELECT COUNT(*) FROM admin_users $where");
$count->execute($params);
$total = (int)$count->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));
$offset = ($page-1)*$perPage;
$params[] = $perPage;
$params[] = $offset;
$stmt = $db->prepare("SELECT * FROM admin_users $where ORDER BY username LIMIT ? OFFSET ?");
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['action']) && $_POST['action']==='save'){
    $id = intval($_POST['id']);
    $email = trim($_POST['email']);
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $role = $_POST['role_id'] !== '' ? intval($_POST['role_id']) : null;
    $perm = $role ? '' : trim($_POST['permissions']);
    if($id){
        $stmt=$db->prepare('UPDATE admin_users SET email=?,first_name=?,last_name=?,permissions=?,role_id=? WHERE id=?');
        $stmt->execute([$email,$first,$last,$perm,$role,$id]);
        if($_POST['password']!=='' && $_POST['password']===$_POST['confirm']){
            $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $db->prepare('UPDATE admin_users SET password=? WHERE id=?')->execute([$hash,$id]);
        }
        cms_admin_log('Updated admin user '.$id);
    }else{
        $hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $stmt=$db->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,role_id,created,password) VALUES(?,?,?,?,?,?,NOW(),?)');
        $stmt->execute([trim($_POST['username']),$email,$first,$last,$perm,$role,$hash]);
        cms_admin_log('Created admin user '.trim($_POST['username']));
    }
}
if(isset($_POST['delete'])){
    $delId = intval($_POST['delete']);
    $db->prepare('DELETE FROM admin_users WHERE id=?')->execute([$delId]);
    cms_admin_log('Deleted admin user '.$delId);
}

$tbodyHtml = '';
foreach($rows as $r){
    $tbodyHtml .= '<tr>';
    $tbodyHtml .= '<td>'.htmlspecialchars($r['username']).'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($r['email']).'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($r['created']).'</td>';
    $tbodyHtml .= '<td>';
    if($r['role_id']){
        $tbodyHtml .= htmlspecialchars($roleMap[$r['role_id']] ?? 'Unknown');
    }else{
        $tbodyHtml .= htmlspecialchars($r['permissions']);
    }
    $tbodyHtml .= '</td><td>';
    $tbodyHtml .= '<button class="editBtn" data-id="'.$r['id'].'">Edit</button>';
    $tbodyHtml .= '<form method="post" style="display:inline"><input type="hidden" name="delete" value="'.$r['id'].'"><input type="submit" value="Delete"></form>';
    $tbodyHtml .= '</td></tr>';
}

ob_start();
?>
<div class="pagination">
<?php
$query = $_GET;
if($page>1){ $query['page']=$page-1; echo '<a href="?'.http_build_query($query).'">&laquo; Prev</a>'; }
if($page<$pages){ $query['page']=$page+1; echo ' <a href="?'.http_build_query($query).'">Next &raquo;</a>'; }
?>
</div>
<?php
$paginationHtml = ob_get_clean();

if(isset($_GET['ajax'])){
    header('Content-Type: application/json');
    echo json_encode(['tbody'=>$tbodyHtml,'pagination'=>$paginationHtml,'rows'=>$rows]);
    exit;
}
?>
<h2>Administrators</h2>
<div id="search-bar" style="margin-bottom:10px;">
    <input type="text" id="search-box" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search...">
</div>
<button id="addBtn">Add Administrator</button>
<table class="data-table">
<thead><tr><th>Username</th><th>Email</th><th>Created</th><th>Role/Permissions</th><th>Actions</th></tr></thead>
<tbody id="users-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>
<?php echo $paginationHtml; ?>
<div id="editor" style="display:none;border:1px solid #333;padding:10px;background:#eee;">
<form method="post">
<input type="hidden" name="id" id="eid" value="0">
<label>Username: <input type="text" name="username" id="eusername"></label><br>
<label>Email: <input type="text" name="email" id="eemail"></label><br>
<label>First Name: <input type="text" name="first_name" id="efirst"></label><br>
<label>Last Name: <input type="text" name="last_name" id="elast"></label><br>
<label>Role: <select name="role_id" id="erole">
    <option value="">Custom Permissions</option>
    <?php foreach($roles as $ro): ?>
        <option value="<?php echo $ro['id']; ?>"><?php echo htmlspecialchars($ro['name']); ?></option>
    <?php endforeach; ?>
</select></label><br>
<div id="permRow">
<label>Permissions: <input type="text" name="permissions" id="eperm"></label><br>
<small>Available: <?php echo implode(', ', array_keys(cms_all_permissions())); ?></small><br>
</div>
<label>Password: <input type="password" name="password" id="epass"></label><br>
<label>Confirm: <input type="password" name="confirm" id="econf"></label><br>
<input type="hidden" name="action" value="save">
<button type="submit">Submit</button> <button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
var data = <?php echo json_encode($rows); ?>;
function bindEditButtons(){
    $('.editBtn').on('click',function(){
        var id=$(this).data('id');
        for(var i=0;i<data.length;i++) if(data[i].id==id){
            $('#eid').val(data[i].id);
            $('#eusername').val(data[i].username);
            $('#eemail').val(data[i].email);
            $('#efirst').val(data[i].first_name);
            $('#elast').val(data[i].last_name);
            $('#erole').val(data[i].role_id?data[i].role_id:'');
            $('#eperm').val(data[i].permissions);
            break;
        }
        togglePerm();
        $('#editor').show();
    });
}
function bindPagination(){
    $('.pagination a').on('click',function(e){
        e.preventDefault();
        var p=parseInt(new URL(this.href).searchParams.get('page'));
        var q=$('#search-box').val();
        $.get('admin_users.php',{ajax:1,q:q,page:p},function(res){
            $('#users-body').html(res.tbody);
            $('.pagination').replaceWith(res.pagination);
            data=res.rows;
            bindPagination();
            bindEditButtons();
        },'json');
    });
}
$('#addBtn').on('click',function(){
    $('#eid').val('0');
    $('#eusername').val('');
    $('#eemail').val('');
    $('#efirst').val('');
    $('#elast').val('');
    $('#erole').val('');
    $('#eperm').val('');
    $('#epass').val('');
    $('#econf').val('');
    togglePerm();
    $('#editor').show();
});
bindEditButtons();
bindPagination();
$('#search-box').on('input',function(){
    var q=$(this).val();
    $.get('admin_users.php',{ajax:1,q:q},function(res){
        $('#users-body').html(res.tbody);
        $('.pagination').replaceWith(res.pagination);
        data=res.rows;
        bindPagination();
        bindEditButtons();
    },'json');
});
$('#cancel').on('click',function(){ $('#editor').hide(); });
$('#erole').on('change',togglePerm);
function togglePerm(){
    if($('#erole').val()==='') $('#permRow').show();
    else $('#permRow').hide();
}
</script>
<?php include 'admin_footer.php'; ?>
