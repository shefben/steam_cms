<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if (isset($_POST['ajax']) && $_POST['action'] === 'create') {
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['name'] ?? '');
    $resp = [];
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
    header('Content-Type: application/json');
    echo json_encode($resp);
    exit;
}

$groups = $db->query('SELECT * FROM random_groups ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Random Groups</h2>
<table class="data-table" id="group-table">
<thead><tr><th>ID</th><th>Name</th></tr></thead>
<tbody id="group-body">
<?php foreach ($groups as $g): ?>
<tr><td><?php echo $g['id']; ?></td><td><?php echo htmlspecialchars($g['name']); ?></td></tr>
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
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
$('#show-add-form').on('click', function(e){
    e.preventDefault();
    $('#group-error').hide();
    $('#add-group-form').slideToggle('fast');
});
$('#save-group').on('click', function(){
    var name = $('#group-name').val().trim();
    if(!name) return;
    $.post('random_groups.php', {ajax:1, action:'create', name:name}, function(res){
        if(res.error){
            $('#group-error').text(res.error).show();
        }else{
            $('#group-error').hide();
            $('#group-body').append('<tr><td>'+res.id+'</td><td>'+res.name+'</td></tr>');
            $('#group-name').val('');
            $('#add-group-form').slideUp('fast');
        }
    }, 'json');
});
</script>
<?php include 'admin_footer.php'; ?>
