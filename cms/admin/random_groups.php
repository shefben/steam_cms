<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$csrf_token = cms_get_csrf_token();

if (isset($_POST['ajax'])) {
    $resp = [];
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        $resp['error'] = 'Bad CSRF token';
    } elseif ($_POST['action'] === 'create') {
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['name'] ?? '');
        if ($name === '') {
            $resp['error'] = 'Name required';
        } else {
            $stmt = $db->prepare('SELECT COUNT(*) FROM random_groups WHERE name=?');
            $stmt->execute([$name]);
            if ($stmt->fetchColumn() > 0) {
                $resp['error'] = 'Group already exists';
            } else {
                $db->prepare('INSERT INTO random_groups(name) VALUES(?)')->execute([$name]);
                $resp['success'] = true;
                $resp['id'] = $db->lastInsertId();
                $resp['name'] = $name;
            }
        }
    } elseif ($_POST['action'] === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $db->prepare('DELETE FROM random_groups WHERE id=?')->execute([$id]);
            $resp['success'] = true;
        } else {
            $resp['error'] = 'Invalid ID';
        }
    }
    header('Content-Type: application/json');
    echo json_encode($resp);
    exit;
}

$groups = $db->query('SELECT * FROM random_groups ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Random Groups</h2>
<table class="data-table" id="group-table">
<thead><tr><th>ID</th><th>Name</th><th>Actions</th></tr></thead>
<tbody id="group-body">
<?php foreach ($groups as $g): ?>
<tr><td><?php echo $g['id']; ?></td><td><?php echo htmlspecialchars($g['name']); ?></td><td><button class="btn btn-danger btn-sm delete-group" data-id="<?php echo $g['id']; ?>">Delete</button></td></tr>
<?php endforeach; ?>
</tbody>
</table>
<p><a href="#" id="show-add-form">Create new Random Group</a></p>
<div id="add-group-form" style="display:none;margin-top:10px;">
    <label for="group-name">Group Name:</label>
    <input type="text" id="group-name">
    <button id="save-group" class="btn btn-primary">Save</button>
    <span id="group-error" style="color:red;display:none;"></span>
</div>
<script>
$(function(){
    $('#show-add-form').on('click', function(e){
        e.preventDefault();
        $('#group-error').hide();
        $('#add-group-form').slideToggle('fast');
    });
    var CSRF_TOKEN = <?php echo json_encode($csrf_token); ?>;
    $('#save-group').on('click', function(){
        var name = $('#group-name').val().trim();
        if(!name) return;
        $.post('random_groups.php', {ajax:1, action:'create', name:name, csrf_token:CSRF_TOKEN}, function(res){
            if(res.error){
                $('#group-error').text(res.error).show();
            }else{
                $('#group-error').hide();
                $('#group-body').append('<tr><td>'+res.id+'</td><td>'+res.name+'</td><td><button class="btn btn-danger btn-sm delete-group" data-id="'+res.id+'">Delete</button></td></tr>');
                $('#group-name').val('');
                $('#add-group-form').slideUp('fast');
            }
        }, 'json');
    });

    $('#group-body').on('click', '.delete-group', function(){
        var btn = $(this);
        var id = btn.data('id');
        $.post('random_groups.php', {ajax:1, action:'delete', id:id, csrf_token:CSRF_TOKEN}, function(res){
            if(res.success){
                btn.closest('tr').remove();
            }
        }, 'json');
    });
});
</script>
<?php include 'admin_footer.php'; ?>
