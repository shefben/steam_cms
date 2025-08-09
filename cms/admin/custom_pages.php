<?php
require_once 'admin_header.php';

if(isset($_GET['ajax']) && isset($_GET['edit'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['edit']);
    $thm = isset($_GET['theme']) ? preg_replace('/[^a-zA-Z0-9_,]/','',$_GET['theme']) : null;
    $stmt=cms_get_db()->prepare('SELECT * FROM custom_pages WHERE slug=? AND theme <=> ?');
    $stmt->execute([$slug,$thm]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($row);
    exit;
}
cms_require_permission('manage_pages');
$db=cms_get_db();
$themes = cms_get_themes();
$current_theme = cms_get_setting('theme','2004');
$template_files = array_map('basename', glob(__DIR__.'/../themes/'.$current_theme.'/layout/*.twig'));
if(isset($_POST['autosave'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $page_name=trim($_POST['page_name'] ?? '');
    $content=$_POST['content'];
    $template = in_array($_POST['template'] ?? '', $template_files, true) ? $_POST['template'] : null;
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET page_name=?,title=?,content=?,theme=?,template=?,updated=NOW(),status="draft" WHERE id=?');
        $stmt->execute([$page_name,$title,$content,$themeStr,$template,$row['id']]);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,page_name,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,?,?,NOW(),"draft")');
        $stmt->execute([$slug,$page_name,$title,$content,$themeStr,$template,date('Y-m-d H:i:s')]);
    }
    cms_admin_log('Autosaved custom page '.$slug);
    header('Content-Type: application/json');
    echo json_encode(['time'=>date('H:i:s')]);
    exit;
}
if(isset($_POST['save_page'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $page_name=trim($_POST['page_name'] ?? '');
    $content=$_POST['content'];
    $template = in_array($_POST['template'] ?? '', $template_files, true) ? $_POST['template'] : null;
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET page_name=?,title=?,content=?,theme=?,template=?,updated=NOW(),status="published" WHERE id=?');
        $stmt->execute([$page_name,$title,$content,$themeStr,$template,$row['id']]);
        cms_admin_log('Updated custom page '.$slug);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,page_name,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,?,?,NOW(),"published")');
        $stmt->execute([$slug,$page_name,$title,$content,$themeStr,$template,date('Y-m-d H:i:s')]);
        cms_admin_log('Created custom page '.$slug);
    }
}
if(isset($_GET['delete'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['delete']);
    $thm = isset($_GET['theme']) ? preg_replace('/[^a-zA-Z0-9_,]/','',$_GET['theme']) : null;
    $db->prepare('DELETE FROM custom_pages WHERE slug=? AND theme <=> ?')->execute([$slug,$thm]);
    cms_admin_log('Deleted custom page '.$slug.' theme '.($thm ?? 'all'));
}
$pages=$db->query("SELECT slug,title,theme FROM custom_pages WHERE slug NOT LIKE '%_index' ORDER BY slug")->fetchAll(PDO::FETCH_ASSOC);
$edit=null;
if(isset($_GET['edit'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['edit']);
    $thm = isset($_GET['theme']) ? preg_replace('/[^a-zA-Z0-9_,]/','',$_GET['theme']) : null;
    $stmt=$db->prepare('SELECT * FROM custom_pages WHERE slug=? AND theme <=> ?');
    $stmt->execute([$slug,$thm]);
    $edit=$stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<h2>Custom Pages</h2>
<button id="addBtn">Add Custom Page</button>
<table>
<tr><th>Slug</th><th>Themes</th><th>Title</th><th>Actions</th></tr>
<?php foreach($pages as $p): ?>
<tr><td><?php echo htmlspecialchars($p['slug'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($p['theme'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($p['title'] ?? ''); ?></td>
<td><button type="button" class="edit-btn btn btn-primary btn-small" data-slug="<?php echo htmlspecialchars($p['slug']); ?>" data-theme="<?php echo htmlspecialchars($p['theme']); ?>">Edit</button>
 <a href="?delete=<?php echo urlencode($p['slug']); ?>&amp;theme=<?php echo urlencode($p['theme']); ?>" class="btn btn-danger btn-small" onclick="return confirm('Delete?');">Delete</a></td></tr>
<?php endforeach; ?>
</table>
<div id="editor" style="display:none;border:1px solid #333;padding:10px;background:#eee;">
<form method="post">
<input type="text" name="slug" id="slug" placeholder="Page ID"><br>
<label>Page Name: <input type="text" name="page_name" id="page_name" value="<?php echo isset($edit['page_name']) ? htmlspecialchars($edit['page_name']) : ''; ?>"></label><br>
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
<input type="submit" name="save_page" value="Save">
<span id="lastSaved" style="margin-left:10px;color:green;"></span>
<button type="button" id="previewBtn" style="display:none;">Preview</button>
<button type="button" id="restoreDraft" style="display:none;">Restore Draft</button>
<button type="button" id="cancel">Cancel</button>
</form>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
var loadReq;
function autoSave(){
    var data=$('form').serializeArray();
    data.push({name:'autosave',value:1});
    data.push({name:'page_name',value:$('#page_name').val()});
    data.push({name:'content',value:CKEDITOR.instances.content.getData()});
    return $.post('custom_pages.php',data,function(res){
        $('#lastSaved').text('Last saved '+res.time);
    },'json');
}
setInterval(autoSave,30000);

function loadPage(slug,theme){
    var form = $('#editor form')[0];
    if(form){
        form.reset();
    }
    $('#previewBtn,#restoreDraft').hide();
    CKEDITOR.instances.content.setData('');
    $('#slug').val(slug).prop('readonly',true);
    if (loadReq) {
        loadReq.abort();
    }
    loadReq = $.ajax({
        url: 'custom_pages.php',
        data: {ajax:1,edit:slug,theme:theme},
        dataType: 'json',
        cache: false,
        success: function(d){
        $('#page_name').val(d.page_name||'');
        $('#title').val(d.title||'');
        $('#template').val(d.template||'');
        CKEDITOR.instances.content.setData(d.content||'');
        $('.themeChk').prop('checked',false);
        if(d.theme){
            d.theme.split(',').forEach(function(t){
                $('.themeChk[value="'+t+'"]').prop('checked',true);
            });
        }
        $('#previewBtn').off('click').on('click',function(){
            autoSave().then(function(){
                window.open('preview.php?type=page&slug='+encodeURIComponent(slug)+'&theme=<?php echo $current_theme; ?>','_blank');
            });
        }).show();
        $('#restoreDraft').off('click').on('click',function(){
            $.get('custom_pages.php?ajax=1&edit='+encodeURIComponent(slug)+'&theme='+encodeURIComponent(theme||''),function(r){
                $('#page_name').val(r.page_name||'');
                $('#title').val(r.title||'');
                $('#template').val(r.template||'');
                CKEDITOR.instances.content.setData(r.content||'');
            },'json');
        }).show();
        $('#editor').show();
        }
    });
}

$(document).on('click','.edit-btn',function(){
    var slug=$(this).data('slug');
    var theme=$(this).data('theme')||'';
    loadPage(slug,theme);
});

$('#addBtn').on('click',function(){
    $('#slug').prop('readonly',false).val('');
    $('#page_name').val('');
    $('#title').val('');
    CKEDITOR.instances.content.setData('');
    $('.themeChk').prop('checked',false);
    $('#template').val('');
    $('#previewBtn,#restoreDraft').hide();
    $('#editor').show();
});

<?php if($edit): ?>
loadPage('<?php echo addslashes($edit['slug']); ?>','<?php echo addslashes($edit['theme'] ?? ''); ?>');
<?php endif; ?>

$('#cancel').on('click',function(){ $('#editor').hide(); });
</script>
<?php include 'admin_footer.php'; ?>
