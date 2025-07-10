<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if (isset($_GET['ajax']) && isset($_GET['tag'])) {
    $tag = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['tag']);
    $stmt = $db->prepare('SELECT uniqueid,content FROM random_content WHERE tag_name=? ORDER BY uniqueid');
    $stmt->execute([$tag]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $tag = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['tag']);
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
            $ins = $db->prepare('INSERT INTO random_content(tag_name,content) VALUES(?,?)');
            foreach ($_POST['new'] as $html) {
                $ins->execute([$tag, $html]);
            }
        }
    }
}

$tags = $db->query('SELECT DISTINCT tag_name FROM random_content ORDER BY tag_name')->fetchAll(PDO::FETCH_COLUMN);
$current = $_POST['tag'] ?? ($tags[0] ?? '');
$entries = [];
if ($current) {
    $stmt = $db->prepare('SELECT uniqueid,content FROM random_content WHERE tag_name=? ORDER BY uniqueid');
    $stmt->execute([$current]);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Random Content</h2>
<select id="tag-select" name="tag">
<?php foreach ($tags as $t): ?>
<option value="<?php echo htmlspecialchars($t); ?>"<?php if ($t === $current) echo ' selected'; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select>
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
$('#tag-select').on('change',function(){
    var t=this.value;
    $.get('random_content.php',{ajax:1,tag:t},function(data){
        $('#editor-container').empty();
        data.forEach(function(row){ addEditor(row.uniqueid,row.content); });
        $('input[name=tag]').val(t);
    },'json');
});
$('#add').on('click',function(){ addEditor(null,''); });
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
});
</script>
<?php include 'admin_footer.php'; ?>
