<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$groupsList = $db->query('SELECT id, name FROM random_groups ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajax'])) {
    $action = $_POST['action'] ?? '';
    $resp   = [];
    if ($action === 'add') {
        $name    = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['name'] ?? '');
        $group   = (int)($_POST['group_id'] ?? 0);
        $content = $_POST['content'] ?? '';
        if ($name === '' || $group <= 0) {
            $resp['error'] = 'All fields required';
        } else {
            $stmt = $db->prepare('SELECT COUNT(*) FROM random_groups WHERE id=?');
            $stmt->execute([$group]);
            if ($stmt->fetchColumn() == 0) {
                $resp['error'] = 'Invalid group';
            } else {
                $ins = $db->prepare('INSERT INTO random_content(tag_name,group_id,content) VALUES(?,?,?)');
                $ins->execute([$name, $group, $content]);
                $resp['success'] = true;
            }
        }
    } elseif ($action === 'save') {
        $tag = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['tag'] ?? '');
        if ($tag === '') {
            $resp['error'] = 'Invalid tag';
        } else {
            if (!empty($_POST['content'])) {
                foreach ($_POST['content'] as $id => $html) {
                    $id   = (int)$id;
                    $stmt = $db->prepare('UPDATE random_content SET content=? WHERE uniqueid=?');
                    $stmt->execute([$html, $id]);
                }
            }
            if (!empty($_POST['delete'])) {
                foreach ($_POST['delete'] as $id) {
                    $id = (int)$id;
                    $db->prepare('DELETE FROM random_content WHERE uniqueid=?')->execute([$id]);
                }
            }
            if (!empty($_POST['new']) && !empty($_POST['group_id'])) {
                $gid = (int)$_POST['group_id'];
                $ins = $db->prepare('INSERT INTO random_content(tag_name,group_id,content) VALUES(?,?,?)');
                foreach ($_POST['new'] as $html) {
                    $ins->execute([$tag, $gid, $html]);
                }
            }
            $resp['success'] = true;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($resp);
    exit;
}

if (isset($_GET['ajax']) && isset($_GET['tag'])) {
    $tag  = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['tag']);
    $stmt = $db->prepare('SELECT uniqueid,content,group_id FROM random_content WHERE tag_name=? ORDER BY uniqueid');
    $stmt->execute([$tag]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if (isset($_POST['delete_tag'])) {
    $del = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['delete_tag']);
    if ($del !== '') {
        $db->prepare('DELETE FROM random_content WHERE tag_name=?')->execute([$del]);
        cms_admin_log('Deleted random content tag ' . $del);
    }
}

$rowsList = $db->query('SELECT DISTINCT c.tag_name, g.name AS group_name, c.group_id FROM random_content c JOIN random_groups g ON c.group_id = g.id ORDER BY g.name, c.tag_name')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Random Content</h2>
<p><a href="random_groups.php" class="btn btn-secondary">Manage Random Groups</a></p>
<table class="data-table">
<thead><tr><th>Group</th><th>Tag Name</th><th>Action</th></tr></thead>
<tbody>
<?php foreach ($rowsList as $row) : ?>
<tr>
  <td><?php echo htmlspecialchars($row['group_name']); ?></td>
  <td>{% verbatim %}{{random_<?php echo htmlspecialchars($row['tag_name']); ?>}}{% endverbatim %}</td>
  <td class="actions">
    <button type="button" class="btn btn-primary edit-btn" data-tag="<?php echo htmlspecialchars($row['tag_name']); ?>">Edit</button>
    <form method="post" style="display:inline">
      <button class="btn btn-danger" name="delete_tag" value="<?php echo htmlspecialchars($row['tag_name']); ?>" onclick="return confirm('Delete tag?')">Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<p><button type="button" class="btn btn-secondary" id="add-random-btn">Add Random Content</button></p>
<div id="addModal" style="display:none;" aria-modal="true" role="dialog">
  <form id="add-form">
    <label>Name: <input type="text" id="new-name" required></label>
    <label>Group:
      <select id="new-group" required>
        <option value="">Select</option>
        <?php foreach ($groupsList as $g) { ?>
          <option value="<?php echo (int)$g['id']; ?>"><?php echo htmlspecialchars($g['name']); ?></option>
        <?php } ?>
      </select>
    </label>
    <textarea id="new-content" rows="4" style="width:300px"></textarea>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" id="cancel-new" class="btn btn-secondary">Cancel</button>
    <span id="add-error" style="color:red;display:none;"></span>
  </form>
</div>
<div id="editModal" style="display:none;" aria-modal="true" role="dialog">
  <form id="edit-form">
    <input type="hidden" name="tag" id="edit-tag">
    <input type="hidden" name="group_id" id="edit-group-id">
    <div id="edit-entries"></div>
    <button type="button" id="edit-add" class="btn btn-secondary">Add Entry</button>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" id="edit-cancel" class="btn btn-secondary">Cancel</button>
    <span id="edit-error" style="color:red;display:none;"></span>
  </form>
</div>
<script>
$(function(){
    function escapeHtml(text){
        return $('<div>').text(text).html();
    }

    $('#add-random-btn').on('click', function(){
        $('#add-form')[0].reset();
        $('#add-error').hide();
        $('#addModal').show();
    });
    $('#cancel-new').on('click', function(){ $('#addModal').hide(); });
    $('#add-form').on('submit', function(e){
        e.preventDefault();
        var name = $('#new-name').val().trim();
        var group = $('#new-group').val();
        var content = $('#new-content').val();
        $.post('random_content.php', {ajax:1, action:'add', name:name, group_id:group, content:content}, function(res){
            if(res.error){
                $('#add-error').text(res.error).show();
            } else {
                $('#addModal').hide();
                var groupName = $('#new-group option:selected').text();
                var row = '<tr><td>'+escapeHtml(groupName)+'</td><td>{% verbatim %}{{random_'+escapeHtml(name)+'}}{% endverbatim %}</td><td class="actions"><button type="button" class="btn btn-primary edit-btn" data-tag="'+escapeHtml(name)+'">Edit</button><form method="post" style="display:inline"><button class="btn btn-danger" name="delete_tag" value="'+escapeHtml(name)+'" onclick="return confirm(\'Delete tag?\')">Delete</button></form></td></tr>';
                $('table.data-table tbody').append(row);
            }
        }, 'json');
    });

    $('.data-table').on('click', '.edit-btn', function(){
        var tag = $(this).data('tag');
        $.get('random_content.php', {ajax:1, tag:tag}, function(res){
            $('#edit-tag').val(tag);
            $('#edit-group-id').val(res.length ? res[0].group_id : 0);
            var container = $('#edit-entries').empty();
            res.forEach(function(r){
                var div = $('<div class="entry" data-id="'+r.uniqueid+'">');
                var del = $('<button type="button" class="delete-entry btn btn-danger" data-id="'+r.uniqueid+'">Delete</button>');
                var ta = $('<textarea name="content['+r.uniqueid+']" rows="4" style="width:300px"></textarea>').val(r.content);
                div.append(del).append(ta);
                container.append(div);
            });
            $('#editModal').show();
            $('#edit-error').hide();
        }, 'json');
    });

    $('#edit-cancel').on('click', function(){ $('#editModal').hide(); });

    $('#edit-add').on('click', function(){
        var div = $('<div class="entry" data-id="new">');
        var del = $('<button type="button" class="delete-entry btn btn-danger" data-id="new">Delete</button>');
        var ta = $('<textarea name="new[]" rows="4" style="width:300px"></textarea>');
        div.append(del).append(ta);
        $('#edit-entries').append(div);
    });

    $('#edit-entries').on('click', '.delete-entry', function(){
        var id = $(this).data('id');
        if(id !== 'new'){
            $('<input>').attr({type:'hidden',name:'delete[]'}).val(id).appendTo('#edit-form');
        }
        $(this).parent().remove();
    });

    $('#edit-form').on('submit', function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        data.push({name:'ajax', value:1});
        data.push({name:'action', value:'save'});
        $.post('random_content.php', data, function(res){
            if(res.error){
                $('#edit-error').text(res.error).show();
            } else {
                $('#editModal').hide();
                $('#edit-form')[0].reset();
            }
        }, 'json');
    });
});
</script>
<style>
#addModal,#editModal{background:#fff;border:1px solid #333;padding:10px;position:fixed;top:10%;left:50%;transform:translateX(-50%);z-index:1000;}
#addModal label,#editModal label{display:block;margin-top:5px;}
.entry{margin-bottom:10px;}
</style>
<?php include 'admin_footer.php'; ?>

