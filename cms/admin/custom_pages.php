<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db=cms_get_db();
$themes = cms_get_themes();
$current_theme = cms_get_setting('theme','2004');
$template_files = array_map('basename', glob(__DIR__.'/../themes/'.$current_theme.'/layout/*.twig'));

if(isset($_POST['autosave'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $content=$_POST['content'];
    $template = in_array($_POST['template'] ?? '', $template_files, true) ? $_POST['template'] : null;
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $exists=$db->prepare('SELECT slug FROM custom_pages WHERE slug=?');
    $exists->execute([$slug]);
    if($exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET title=?,content=?,theme=?,template=?,status="draft",updated=NOW() WHERE slug=?');
        $stmt->execute([$title,$content,$themeStr,$template,$slug]);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,NOW(),NOW(),"draft")');
        $stmt->execute([$slug,$title,$content,$themeStr,$template]);
    }
    cms_admin_log('Autosaved page draft '.$slug);
    header('Content-Type: application/json');
    echo json_encode(['slug'=>$slug,'updated'=>date('Y-m-d H:i:s')]);
    exit;
}
if(isset($_POST['save_page'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $content=$_POST['content'];
    $template = in_array($_POST['template'] ?? '', $template_files, true) ? $_POST['template'] : null;
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $exists=$db->prepare('SELECT slug FROM custom_pages WHERE slug=?');
    $exists->execute([$slug]);
    if($exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET title=?,content=?,theme=?,template=?,status="published",updated=NOW() WHERE slug=?');
        $stmt->execute([$title,$content,$themeStr,$template,$slug]);
        cms_admin_log('Updated custom page '.$slug);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,NOW(),NOW(),"published")');
        $stmt->execute([$slug,$title,$content,$themeStr,$template]);
        cms_admin_log('Created custom page '.$slug);
    }
}
if(isset($_GET['delete'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['delete']);
    $db->prepare('DELETE FROM custom_pages WHERE slug=?')->execute([$slug]);
    cms_admin_log('Deleted custom page '.$slug);
}
$pages=$db->query("SELECT slug,title FROM custom_pages WHERE slug NOT LIKE '%_index' ORDER BY slug")->fetchAll(PDO::FETCH_ASSOC);
$edit=null;
if(isset($_GET['edit'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['edit']);
    $stmt=$db->prepare('SELECT * FROM custom_pages WHERE slug=?');
    $stmt->execute([$slug]);
    $edit=$stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        header('Content-Type: application/json');
        echo json_encode($edit);
        exit;
    }
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
<label>Template:
    <select name="template" id="template">
        <option value="">default.twig</option>
        <?php foreach($template_files as $f): ?>
            <option value="<?php echo htmlspecialchars($f); ?>"<?php if(isset($edit['template']) && $edit['template']===$f) echo ' selected'; ?>><?php echo htmlspecialchars($f); ?></option>
        <?php endforeach; ?>
    </select>
</label><br>
<textarea name="content" id="content" style="width:100%;height:300px;"></textarea><br>
<p>Last saved: <span id="lastSaved"><?php echo isset($edit['updated']) ? htmlspecialchars($edit['updated']) : ''; ?></span></p>
<input type="submit" name="save_page" value="Save">
<button type="button" id="restoreBtn">Restore Draft</button>
<button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
function autoSave(){
    var form = document.querySelector('#editor form');
    if(!form) return;
    var data = new FormData(form);
    data.append('autosave','1');
    fetch('custom_pages.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(r=>r.json()).then(function(res){
        document.getElementById('lastSaved').textContent=res.updated;
        if(!document.getElementById('slug').readOnly){
            document.getElementById('slug').value=res.slug;
        }
    });
}
setInterval(autoSave,30000);
document.getElementById('restoreBtn').addEventListener('click',function(e){
    e.preventDefault();
    var slug=document.getElementById('slug').value;
    if(!slug) return;
    fetch('custom_pages.php?edit='+encodeURIComponent(slug),{headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(r=>r.json()).then(function(d){
        document.getElementById('title').value=d.title;
        CKEDITOR.instances.content.setData(d.content);
        document.getElementById('template').value=d.template||'';
        document.getElementById('lastSaved').textContent=d.updated;
    });
});
$('#addBtn').on('click',function(){
    $('#slug').prop('readonly',false).val('');
    $('#title').val('');
    CKEDITOR.instances.content.setData('');
    $('.themeChk').prop('checked',false);
    $('#template').val('');
    $('#editor').show();
});
<?php if($edit): ?>
$('#slug').val('<?php echo addslashes($edit['slug']); ?>').prop('readonly',true);
$('#title').val('<?php echo addslashes($edit['title']); ?>');
$('#template').val('<?php echo addslashes($edit['template'] ?? ''); ?>');
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
