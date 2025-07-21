<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$langs = ['en','fr','de','it','es'];
$lang = in_array($_GET['lang'] ?? '', $langs, true) ? $_GET['lang'] : $langs[0];
if(isset($_POST['save'])){
    $slug=preg_replace('/[^a-zA-Z0-9_]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $content=$_POST['content'];
    $id=isset($_POST['id'])? (int)$_POST['id'] : 0;
    if($id){
        $stmt=$db->prepare('UPDATE troubleshooter_pages SET lang=?,slug=?,title=?,content=?,updated=NOW() WHERE id=?');
        $stmt->execute([$lang,$slug,$title,$content,$id]);
    }else{
        $stmt=$db->prepare('INSERT INTO troubleshooter_pages(lang,slug,title,content,created,updated) VALUES(?,?,?,?,NOW(),NOW())');
        $stmt->execute([$lang,$slug,$title,$content]);
        $id=$db->lastInsertId();
    }
}
$pages=$db->prepare('SELECT slug,title FROM troubleshooter_pages WHERE lang=? ORDER BY slug');
$pages->execute([$lang]);
$pages=$pages->fetchAll(PDO::FETCH_ASSOC);
$edit=null;
if(isset($_GET['edit'])){
    $slug=preg_replace('/[^a-zA-Z0-9_]/','',$_GET['edit']);
    $stmt=$db->prepare('SELECT * FROM troubleshooter_pages WHERE lang=? AND slug=?');
    $stmt->execute([$lang,$slug]);
    $edit=$stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<h2>Manage Troubleshooter Pages</h2>
<form method="get" id="langForm">
<select name="lang" onchange="document.getElementById('langForm').submit()">
<?php foreach($langs as $l): ?>
<option value="<?php echo $l; ?>"<?php if($l==$lang) echo ' selected'; ?>><?php echo strtoupper($l); ?></option>
<?php endforeach; ?>
</select>
</form>
<table class="data-table">
<tr><th>Slug</th><th>Title</th><th>Actions</th></tr>
<?php foreach($pages as $p): ?>
<tr><td><?php echo htmlspecialchars($p['slug']); ?></td>
<td><?php echo htmlspecialchars($p['title']); ?></td>
<td><a href="?lang=<?php echo $lang; ?>&edit=<?php echo urlencode($p['slug']); ?>">Edit</a></td></tr>
<?php endforeach; ?>
</table>
<button id="addBtn">Add Page</button>
<div id="editor" style="display:none;margin-top:20px;">
<form method="post">
<input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang); ?>">
<input type="hidden" name="id" id="page_id" value="">
<label>Slug: <input type="text" name="slug" id="slug"></label><br>
<label>Title: <input type="text" name="title" id="title"></label><br>
<textarea name="content" id="content" style="width:100%;height:300px;"></textarea><br>
<input type="submit" name="save" value="Save" class="btn btn-primary">
<button type="button" id="cancelBtn">Cancel</button>
</form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
$('#addBtn').on('click',function(){
    $('#slug').prop('readonly',false).val('');
    $('#title').val('');
    $('#page_id').val('');
    CKEDITOR.instances.content.setData('');
    $('#editor').show();
});
$('#cancelBtn').on('click',function(){ $('#editor').hide(); });
<?php if($edit): ?>
$('#slug').val('<?php echo addslashes($edit['slug']); ?>');
$('#title').val('<?php echo addslashes($edit['title']); ?>');
$('#page_id').val('<?php echo (int)$edit['id']; ?>');
CKEDITOR.instances.content.setData(`<?php echo addslashes($edit['content']); ?>`);
$('#editor').show();
<?php endif; ?>
</script>
<?php include 'admin_footer.php'; ?>
