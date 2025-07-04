<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db=cms_get_db();
$themes = cms_get_themes();
if(isset($_POST['save_page'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $content=$_POST['content'];
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $exists=$db->prepare('SELECT slug FROM custom_pages WHERE slug=?');
    $exists->execute([$slug]);
    if($exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET title=?,content=?,theme=?,updated=NOW() WHERE slug=?');
        $stmt->execute([$title,$content,$themeStr,$slug]);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,title,content,theme,created,updated) VALUES(?,?,?,?,?,NOW())');
        $stmt->execute([$slug,$title,$content,$themeStr,date('Y-m-d H:i:s')]);
    }
}
if(isset($_GET['delete'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['delete']);
    $db->prepare('DELETE FROM custom_pages WHERE slug=?')->execute([$slug]);
}
$pages=$db->query("SELECT slug,title FROM custom_pages WHERE slug NOT LIKE '%_index' ORDER BY slug")->fetchAll(PDO::FETCH_ASSOC);
$edit=null;
if(isset($_GET['edit'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['edit']);
    $stmt=$db->prepare('SELECT * FROM custom_pages WHERE slug=?');
    $stmt->execute([$slug]);
    $edit=$stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<h2>Custom Pages</h2>
<button id="addBtn">Add Custom Page</button>
<table>
<tr><th>Slug</th><th>Title</th><th>Actions</th></tr>
<?php foreach($pages as $p): ?>
<tr><td><?php echo htmlspecialchars($p['slug']); ?></td>
<td><?php echo htmlspecialchars($p['title']); ?></td>
<td><a href="?edit=<?php echo urlencode($p['slug']); ?>">Edit</a> |
<a href="?delete=<?php echo urlencode($p['slug']); ?>" onclick="return confirm('Delete?');">Delete</a></td></tr>
<?php endforeach; ?>
</table>
<div id="editor" style="display:none;border:1px solid #333;padding:10px;background:#eee;">
<form method="post">
<input type="text" name="slug" id="slug" placeholder="Page ID"><br>
<label>Page Title: <input type="text" name="title" id="title"></label><br><br>
<fieldset><legend>Visible For Themes</legend>
<?php foreach($themes as $t): ?>
    <label><input type="checkbox" name="themes[]" value="<?php echo htmlspecialchars($t); ?>" class="themeChk"> <?php echo htmlspecialchars($t); ?></label>
<?php endforeach; ?>
</fieldset>
<textarea name="content" id="content" style="width:100%;height:300px;"></textarea><br>
<input type="submit" name="save_page" value="Save">
<button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
$('#addBtn').on('click',function(){
    $('#slug').prop('readonly',false).val('');
    $('#title').val('');
    CKEDITOR.instances.content.setData('');
    $('.themeChk').prop('checked',false);
    $('#editor').show();
});
<?php if($edit): ?>
$('#slug').val('<?php echo addslashes($edit['slug']); ?>').prop('readonly',true);
$('#title').val('<?php echo addslashes($edit['title']); ?>');
CKEDITOR.instances.content.setData(`<?php echo addslashes($edit['content']); ?>`);
<?php if($edit && $edit['theme']):
      $jsThemes = json_encode(explode(',', $edit['theme'])); ?>
var selectedThemes = <?php echo $jsThemes; ?>;
$('.themeChk').each(function(){
    $(this).prop('checked', selectedThemes.indexOf($(this).val()) !== -1);
});
<?php endif; ?>
$('#editor').show();
<?php endif; ?>
$('#cancel').on('click',function(){ $('#editor').hide(); });
</script>
<?php include 'admin_footer.php'; ?>
