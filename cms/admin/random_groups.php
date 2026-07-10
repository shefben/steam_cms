<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$csrf_token = cms_get_csrf_token();

if (isset($_POST['ajax'])) {
    $resp = [];
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        $resp['error'] = 'Bad CSRF token';
    } else {
        $action = $_POST['action'] ?? '';
        if ($action === 'create' || $action === 'update') {
            $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['name'] ?? '');
            $id = (int)($_POST['id'] ?? 0);
            if ($name === '') {
                $resp['error'] = 'Name required';
            } else {
                if ($action === 'update' && $id <= 0) {
                    $resp['error'] = 'Invalid ID';
                } else {
                    $stmt = $db->prepare('SELECT COUNT(*) FROM random_groups WHERE name=?' . ($action === 'update' ? ' AND id<>?' : ''));
                    $params = [$name];
                    if ($action === 'update') {
                        $params[] = $id;
                    }
                    $stmt->execute($params);
                    if ($stmt->fetchColumn() > 0) {
                        $resp['error'] = 'Group already exists';
                    } else {
                        if ($action === 'create') {
                            $db->prepare('INSERT INTO random_groups(name) VALUES(?)')->execute([$name]);
                            $resp['id'] = $db->lastInsertId();
                        } else {
                            $db->prepare('UPDATE random_groups SET name=? WHERE id=?')->execute([$name, $id]);
                            $resp['id'] = $id;
                        }
                        $resp['success'] = true;
                        $resp['name'] = $name;
                    }
                }
            }
        } elseif ($action === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $db->prepare('DELETE FROM random_groups WHERE id=?')->execute([$id]);
                $resp['success'] = true;
            } else {
                $resp['error'] = 'Invalid ID';
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($resp);
    exit;
}

$groups = $db->query('SELECT * FROM random_groups ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/missing.css">
<h2>Random Groups</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage groups of images used by the random content system.</p>
<table class="data-table" id="group-table">
<thead><tr><th>ID</th><th>Name</th><th>Actions</th></tr></thead>
<tbody id="group-body">
<?php foreach ($groups as $g): ?>
<tr><td><?php echo $g['id']; ?></td><td><?php echo htmlspecialchars($g['name']); ?></td><td><button class="btn btn-secondary btn-sm edit-group" data-id="<?php echo $g['id']; ?>" data-name="<?php echo htmlspecialchars($g['name'], ENT_QUOTES); ?>">Edit</button> <button class="btn btn-danger btn-sm delete-group" data-id="<?php echo $g['id']; ?>">Delete</button></td></tr>
<?php endforeach; ?>
</tbody>
</table>
<button id="add-group" class="btn btn-primary">Add New Random Group</button>
<div id="groupModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:1000;justify-content:center;align-items:center;">
    <div class="modal" role="dialog" aria-modal="true" style="background:white;border-radius:8px;padding:20px;width:90%;max-width:400px;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
        <h3 id="groupModalTitle" style="margin-top:0;border-bottom:1px solid #ddd;padding-bottom:10px;">Random Group</h3>
        <form id="groupForm">
            <input type="hidden" id="group-id">
            <div style="margin-bottom:15px;">
                <label for="group-name" style="display:block;margin-bottom:4px;font-weight:bold;">Group Name:</label>
                <input type="text" id="group-name" style="width:100%;padding:8px;box-sizing:border-box;">
            </div>
            <span id="group-error" style="color:red;display:none;margin-bottom:10px;"></span>
            <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:15px;border-top:1px solid #ddd;">
                <button type="button" id="cancel-modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    var CSRF_TOKEN = <?php echo json_encode($csrf_token); ?>;
    function openModal(id, name){
        $('#group-id').val(id || '');
        $('#group-name').val(name || '');
        $('#groupModalTitle').text(id ? 'Edit Random Group' : 'Add Random Group');
        $('#group-error').hide();
        $('#groupModal').css('display', 'flex');
    }
    $('#add-group').on('click', function(){
        openModal('', '');
    });
    $('#group-body').on('click', '.edit-group', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        openModal(id, name);
    });
    $('#cancel-modal').on('click', function(){
        $('#groupModal').hide();
    });
    $('#groupForm').on('submit', function(e){
        e.preventDefault();
        var id = $('#group-id').val();
        var name = $('#group-name').val().trim();
        if(!name) return;
        var action = id ? 'update' : 'create';
        $.post('random_groups.php', {ajax:1, action:action, id:id, name:name, csrf_token:CSRF_TOKEN}, function(res){
            if(res.error){
                $('#group-error').text(res.error).show();
            }else{
                if(action === 'create'){
                    $('#group-body').append('<tr><td>'+res.id+'</td><td>'+res.name+'</td><td><button class="btn btn-secondary btn-sm edit-group" data-id="'+res.id+'" data-name="'+res.name+'">Edit</button> <button class="btn btn-danger btn-sm delete-group" data-id="'+res.id+'">Delete</button></td></tr>');
                }else{
                    var row = $('#group-body').find('button.edit-group[data-id="'+res.id+'"]').closest('tr');
                    row.find('td:nth-child(2)').text(res.name);
                    row.find('button.edit-group').data('name', res.name).attr('data-name', res.name);
                }
                $('#groupModal').hide();
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
