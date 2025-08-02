<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$groupsList = $db->query('SELECT id, name FROM random_groups ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajax']) && $_POST['action'] === 'add') {
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['name'] ?? '');
    $group = (int)($_POST['group_id'] ?? 0);
    $content = $_POST['content'] ?? '';
    $resp = [];
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
    header('Content-Type: application/json');
    echo json_encode($resp);
    exit;
}

if (isset($_GET['ajax']) && isset($_GET['tag'])) {
    $tag = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['tag']);
    $stmt = $db->prepare('SELECT uniqueid,content FROM random_content WHERE tag_name=? ORDER BY uniqueid');
    $stmt->execute([$tag]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if (isset($_POST['delete_tag'])) {
    $del = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['delete_tag']);
    if ($del !== '') {
        $db->prepare('DELETE FROM random_content WHERE tag_name=?')->execute([$del]);
        cms_admin_log('Deleted random content tag '.$del);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $tag = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['tag']);
    if (!empty($_POST['new_tag'])) {
        $new = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['new_tag']);
        if ($new !== '') {
            $tag = $new;
        }
    }
    if ($tag !== '') {
        if (!empty($_POST['content'])) {
            foreach ($_POST['content'] as $id => $html) {
                $id = (int)$id;
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
        if (!empty($_POST['new'])) {
            $grpStmt = $db->prepare('SELECT group_id FROM random_content WHERE tag_name=? LIMIT 1');
            $grpStmt->execute([$tag]);
            $gid = (int)$grpStmt->fetchColumn();
            $ins = $db->prepare('INSERT INTO random_content(tag_name,group_id,content) VALUES(?,?,?)');
            foreach ($_POST['new'] as $html) {
                $ins->execute([$tag, $gid, $html]);
            }
        }
    }
}

$rowsList = $db->query('SELECT DISTINCT c.tag_name, g.name AS group_name, c.group_id FROM random_content c JOIN random_groups g ON c.group_id = g.id ORDER BY g.name, c.tag_name')->fetchAll(PDO::FETCH_ASSOC);
$tags = array_column($rowsList, 'tag_name');
$current = $_GET['edit'] ?? ($_POST['tag'] ?? ($tags[0] ?? ''));
$entries = [];
$groupId = 0;
if ($current !== '' && isset($_GET['edit'])) {
    $stmt = $db->prepare('SELECT uniqueid,content,group_id FROM random_content WHERE tag_name=? ORDER BY uniqueid');
    $stmt->execute([$current]);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($entries) {
        $groupId = (int)$entries[0]['group_id'];
    }
}
?>
<h2>Random Content</h2>
<?php if (!isset($_GET['edit'])): ?>
<table class="data-table">
<thead><tr><th>Group</th><th>Tag Name</th><th>Action</th></tr></thead>
<tbody>
<?php foreach ($rowsList as $row): ?>
<tr>
  <td><?php echo htmlspecialchars($row['group_name']); ?></td>
  <td>{{random_<?php echo htmlspecialchars($row['group_name']); ?>}}</td>
  <td class="actions">
    <a class="btn btn-primary" href="random_content.php?edit=<?php echo urlencode($row['tag_name']); ?>">Edit</a>
    <form method="post" style="display:inline">
      <button class="btn btn-danger" name="delete_tag" value="<?php echo htmlspecialchars($row['tag_name']); ?>" onclick="return confirm('Delete tag?')">Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<p><a class="btn btn-secondary" href="#" id="add-random-btn">Add New Random Content</a></p>
<div id="add-form" style="display:none;margin-top:10px;">
  <label>Name: <input type="text" id="new-name"></label>
  <label>Group: <select id="new-group"><option value="">Select</option><?php foreach($groupsList as $g){echo '<option value="'.(int)$g['id'].'">'.htmlspecialchars($g['name']).'</option>'; } ?></select></label>
  <textarea id="new-content" rows="4" style="width:300px"></textarea>
  <button id="save-new" class="btn btn-primary">Save</button>
  <button id="cancel-new" class="btn btn-secondary">Cancel</button>
  <span id="add-error" style="color:red;display:none;"></span>
</div>
<?php else: ?>
<a href="random_content.php" class="btn btn-secondary">&laquo; Back to list</a>
<div id="new-tag-container" style="margin-top:10px;">
    <label for="new-tag">Tag Name (used as {{random_<span id="tag-preview"></span>}}):</label>
    <input type="text" id="new-tag" name="new_tag" style="width:200px" value="<?php echo htmlspecialchars($current === 'new' ? '' : $current); ?>">
</div>
<form method="post" id="content-form">
<input type="hidden" name="tag" value="<?php echo htmlspecialchars($current); ?>">
<div id="editor-container">
<?php foreach ($entries as $e): ?>
<div class="entry" data-id="<?php echo $e['uniqueid']; ?>">
    <button type="button" class="delete-btn" data-id="<?php echo $e['uniqueid']; ?>">Delete</button>
    <textarea name="content[<?php echo $e['uniqueid']; ?>]" class="editor"><?php echo htmlspecialchars($e['content']); ?></textarea>
</div>
<?php endforeach; ?>
</div>
<button type="button" id="add">Add</button>
<button type="submit" name="save" value="1">Save</button>
</form>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<?php if (isset($_GET['edit'])) { ?>
<script>
function addEditor(id,content){
    var div=$('<div class="entry" data-id="'+(id||'new')+'">');
    var del=$('<button type="button" class="delete-btn" data-id="'+(id||'new')+'">Delete</button>');
    var ta=$('<textarea class="editor" name="'+(id?"content["+id+"]":"new[]")+'"></textarea>');
    if(content){ ta.text(content); }
    div.append(del).append(ta);
    $('#editor-container').append(div);
    CKEDITOR.replace(ta[0]);
}
$('#add').on('click',function(){
    $('#new-tag-container').show();
    addEditor(null,'');
});
$('#editor-container').on('click','.delete-btn',function(){
    var id=$(this).data('id');
    if(id!=='new'){
        $('<input>').attr({type:'hidden',name:'delete[]'}).val(id).appendTo('#content-form');
    }
    var inst=CKEDITOR.instances[$(this).next('textarea').attr('id')];
    if(inst){ inst.destroy(true); }
    $(this).parent().remove();
});
$(function(){
    $('.editor').each(function(){ CKEDITOR.replace(this); });
    $('#new-tag-container').show();
    $('#new-tag').on('input',function(){
        $('#tag-preview').text($(this).val());
    }).trigger('input');
});
</script>
<?php } else { ?>
<script>
CKEDITOR.replace('new-content');
$('#add-random-btn').on('click',function(e){e.preventDefault();$('#add-form').slideToggle('fast');});
$('#cancel-new').on('click',function(e){e.preventDefault();$('#add-form').slideUp('fast');});
$('#save-new').on('click',function(){
    var data={ajax:1,action:'add',name:$('#new-name').val().trim(),group_id:$('#new-group').val(),content:CKEDITOR.instances['new-content'].getData()};
    $.post('random_content.php',data,function(res){
        if(res.error){$('#add-error').text(res.error).show();}
        else{location.reload();}
    },'json');
});
</script>
<?php } ?>
<?php include 'admin_footer.php'; ?>
