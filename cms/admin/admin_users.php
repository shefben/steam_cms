<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();
$roles = $db->query('SELECT id,name FROM admin_roles ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$roleMap = [];
foreach ($roles as $r) {
    $roleMap[$r['id']] = $r['name'];
}
if (isset($_POST['action']) && $_POST['action'] === 'save') {
    $id = intval($_POST['id']);
    $email = trim($_POST['email']);
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $role = $_POST['role_id'] !== '' ? intval($_POST['role_id']) : null;
    $lang = trim($_POST['language'] ?? 'en');
    $permList = $_POST['perm'] ?? [];
    if ($role) {
        $perm = '';
    } else {
        if (count($permList) === count(cms_all_permissions())) {
            $perm = 'all';
        } else {
            $perm = implode(',', array_map('trim', $permList));
        }
    }
    if ($id) {
        $stmt = $db->prepare('UPDATE admin_users SET email=?,first_name=?,last_name=?,language=?,permissions=?,role_id=? WHERE id=?');
        $stmt->execute([$email,$first,$last,$lang,$perm,$role,$id]);
        if ($_POST['password'] !== '' && $_POST['password'] === $_POST['confirm']) {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $db->prepare('UPDATE admin_users SET password=? WHERE id=?')->execute([$hash,$id]);
        }
        cms_admin_log('Updated admin user ' . $id);
        if ($id === cms_current_admin()) {
            $_SESSION['admin_lang'] = $lang;
        }
    } else {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO admin_users(username,email,first_name,last_name,language,permissions,role_id,created,password) VALUES(?,?,?,?,?,?,NOW(),?)');
        $stmt->execute([trim($_POST['username']),$email,$first,$last,$lang,$perm,$role,$hash]);
        cms_admin_log('Created admin user ' . trim($_POST['username']));
    }
}
if (isset($_POST['delete'])) {
    $delId = intval($_POST['delete']);
    $db->prepare('DELETE FROM admin_users WHERE id=?')->execute([$delId]);
    cms_admin_log('Deleted admin user ' . $delId);
}
$search = trim($_GET['q'] ?? '');
$where = '';
$params = [];
if ($search !== '') {
    $where = 'WHERE username LIKE ? OR email LIKE ?';
    $params = ["%$search%", "%$search%"];
}

$stmt = $db->prepare("SELECT COUNT(*) FROM admin_users $where");
$stmt->execute($params);
$total = (int)$stmt->fetchColumn();
$perPage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));
$pages = max(1, (int)ceil($total / $perPage));
$offset = ($page - 1) * $perPage;

 $sql = "SELECT * FROM admin_users $where ORDER BY username LIMIT ? OFFSET ?";
 $stmt = $db->prepare($sql);
 $idx = 1;
 foreach ($params as $p) {
     $stmt->bindValue($idx++, $p);
 }
 $stmt->bindValue($idx++, (int)$perPage, PDO::PARAM_INT);
 $stmt->bindValue($idx, (int)$offset, PDO::PARAM_INT);
 $stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tbodyHtml = '';
foreach ($rows as $r) {
    $tbodyHtml .= '<tr>';
    $tbodyHtml .= '<td>' . htmlspecialchars($r['username']) . '</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($r['email']) . '</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($r['created']) . '</td>';
    $tbodyHtml .= '<td>';
    if ($r['role_id']) {
        $tbodyHtml .= htmlspecialchars($roleMap[$r['role_id']] ?? 'Unknown');
    } else {
        $tbodyHtml .= htmlspecialchars($r['permissions']);
    }
    $tbodyHtml .= '</td>';
    $tbodyHtml .= '<td class="actions">';
    $tbodyHtml .= '<button class="editBtn btn btn-small" data-id="' . $r['id'] . '">Edit</button> ';
    $tbodyHtml .= '<form method="post" style="display:inline"><input type="hidden" name="delete" value="' . $r['id'] . '"><input type="submit" value="Delete" class="btn btn-small btn-danger"></form>';
    $tbodyHtml .= '</td>';
    $tbodyHtml .= '</tr>';
}

ob_start();
?>
<div class="pagination">
<?php
$query = $_GET;
if ($page > 1) {
    $query['page'] = $page - 1;
    echo '<a href="?' . http_build_query($query) . '">&laquo; Prev</a>';
}
if ($page < $pages) {
    $query['page'] = $page + 1;
    echo ' <a href="?' . http_build_query($query) . '">Next &raquo;</a>';
}
?>
</div>
<?php
$paginationHtml = ob_get_clean();

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(['tbody' => $tbodyHtml, 'pagination' => $paginationHtml, 'rows' => $rows]);
    exit;
}
?>
<h2>Administrators</h2>
<form method="get" id="search-form" style="margin-bottom:10px;">
    <label>Search: <input type="text" id="search-box" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by username or email"></label>
    <button type="submit" class="btn btn-small">Search</button>
</form>
<button id="addBtn" class="btn btn-primary">Add Administrator</button>
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
<label>Language: <select name="language" id="elang">
    <option value="en">en</option>
    <option value="es">es</option>
    <option value="fr">fr</option>
    <option value="de">de</option>
</select></label><br>
<label>Role: <select name="role_id" id="erole">
    <option value="">Custom Permissions</option>
    <?php foreach ($roles as $ro) : ?>
        <option value="<?php echo $ro['id']; ?>"><?php echo htmlspecialchars($ro['name']); ?></option>
    <?php endforeach; ?>
</select></label><br>
<div id="permRow">
<fieldset id="uPermBox" style="border:1px solid #ccc;padding:6px;max-height:200px;overflow:auto;">
<legend>Permissions</legend>
<?php foreach (cms_all_permissions() as $key => $label) : ?>
    <label style="display:block;"><input type="checkbox" class="permChk" name="perm[]" value="<?php echo $key; ?>"> <?php echo htmlspecialchars($label); ?></label>
<?php endforeach; ?>
<div style="margin-top:4px;">
    <button type="button" id="permAll" class="btn btn-small">All</button>
    <button type="button" id="permNone" class="btn btn-small">None</button>
</div>
</fieldset>
</div>
<label>Password: <input type="password" name="password" id="epass"></label><br>
<label>Confirm: <input type="password" name="confirm" id="econf"></label><br>
<input type="hidden" name="action" value="save">
<button type="submit">Submit</button> <button type="button" id="cancel">Cancel</button>
</form>
</div>
<?php echo "<script>var data=" . json_encode($rows) . ", currentPage=$page, cmsPerms=" . json_encode(cms_all_permissions()) . ";</script>"; ?>
<script>
function bindActions(){
    $('.editBtn').off('click').on('click',function(){
        var id=$(this).data('id');
        for(var i=0;i<data.length;i++) if(data[i].id==id){
            $('#eid').val(data[i].id);
            $('#eusername').val(data[i].username);
            $('#eemail').val(data[i].email);
            $('#efirst').val(data[i].first_name);
            $('#elast').val(data[i].last_name);
            $('#elang').val(data[i].language||'en');
            $('#erole').val(data[i].role_id?data[i].role_id:'');
            var p=data[i].permissions==='all'?Object.keys(cmsPerms):data[i].permissions.split(',');
            $('.permChk').prop('checked',false);
            for(var j=0;j<p.length;j++){ var k=p[j].trim(); if(k) $('.permChk[value="'+k+'"]').prop('checked',true); }
            break;
        }
        togglePerm();
        $('#editor').show();
    });
    $('.pagination a').off('click').on('click',function(e){
        e.preventDefault();
        var p=parseInt(new URL(this.href).searchParams.get('page'))||1;
        loadPage(p);
    });
}
function loadPage(p){
    var q=$('#search-box').val();
    $.get('admin_users.php',{ajax:1,q:q,page:p},function(res){
        $('#users-body').html(res.tbody);
        $('.pagination').replaceWith(res.pagination);
        data=res.rows;
        bindActions();
        currentPage=p;
    },'json');
}
$('#search-box').on('input',function(){ loadPage(1); });
$('#search-form').on('submit',function(e){ e.preventDefault(); loadPage(1); });
$('#addBtn').on('click',function(){
    $('#eid').val('0');
    $('#eusername').val('');
    $('#eemail').val('');
    $('#efirst').val('');
    $('#elast').val('');
    $('#elang').val('en');
    $('#erole').val('');
    $('.permChk').prop('checked',false);
    $('#epass').val('');
    $('#econf').val('');
    togglePerm();
    $('#editor').show();
});
$('#cancel').on('click',function(){ $('#editor').hide(); });
$('#erole').on('change',togglePerm);
$('#permAll').on('click',function(){ $('.permChk').prop('checked',true); });
$('#permNone').on('click',function(){ $('.permChk').prop('checked',false); });
function togglePerm(){
    if($('#erole').val()==='') $('#permRow').show();
    else $('#permRow').hide();
}
bindActions();
</script>
<?php include 'admin_footer.php'; ?>
