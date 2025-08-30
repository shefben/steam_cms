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
$headerDir=dirname(__DIR__,2).'/images/headers/custom_pages';
if(!is_dir($headerDir)){
    mkdir($headerDir,0777,true);
}
$themes = cms_get_themes();
$current_theme = cms_get_setting('theme','2004');
$template_files = array_map('basename', glob(__DIR__.'/../themes/'.$current_theme.'/layout/*.twig'));

if(isset($_GET['list_header_images'])){
    $files=[];
    foreach(scandir($headerDir) as $f){
        if(preg_match('/\.(png|jpe?g|gif)$/i',$f)){
            $files[]=$f;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($files);
    exit;
}

if(isset($_POST['upload_header_image']) && isset($_FILES['header_image'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug'] ?? '');
    $themeStr = isset($_POST['theme']) ? preg_replace('/[^a-zA-Z0-9_,]/','',$_POST['theme']) : null;
    $name=preg_replace('/[^a-zA-Z0-9._-]/','',$_FILES['header_image']['name']);
    $path=$headerDir.'/'.$name;
    move_uploaded_file($_FILES['header_image']['tmp_name'],$path);
    $rel='images/headers/custom_pages/'.$name;
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $db->prepare('UPDATE custom_pages SET header_image=?,updated=NOW() WHERE id=?')->execute([$rel,$row['id']]);
    }else{
        $db->prepare('INSERT INTO custom_pages(slug,header_image,theme,created,updated,status) VALUES(?,?,?,?,NOW(),"draft")')->execute([$slug,$rel,$themeStr,date('Y-m-d H:i:s')]);
    }
    cms_set_content_header_image($rel);
    header('Content-Type: application/json');
    echo json_encode(['path'=>$rel]);
    exit;
}

if(isset($_POST['select_header_image'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug'] ?? '');
    $themeStr = isset($_POST['theme']) ? preg_replace('/[^a-zA-Z0-9_,]/','',$_POST['theme']) : null;
    $img=basename($_POST['image'] ?? '');
    $rel='images/headers/custom_pages/'.$img;
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $db->prepare('UPDATE custom_pages SET header_image=?,updated=NOW() WHERE id=?')->execute([$rel,$row['id']]);
    }else{
        $db->prepare('INSERT INTO custom_pages(slug,header_image,theme,created,updated,status) VALUES(?,?,?,?,NOW(),"draft")')->execute([$slug,$rel,$themeStr,date('Y-m-d H:i:s')]);
    }
    cms_set_content_header_image($rel);
    header('Content-Type: application/json');
    echo json_encode(['path'=>$rel]);
    exit;
}
if(isset($_POST['autosave'])){
    $slug=preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $title=trim($_POST['title']);
    $page_name=trim($_POST['page_name'] ?? '');
    $content=$_POST['content'];
    $template = in_array($_POST['template'] ?? '', $template_files, true) ? $_POST['template'] : null;
    $selThemes = isset($_POST['themes']) ? array_intersect($themes,$_POST['themes']) : [];
    $themeStr = $selThemes ? implode(',', $selThemes) : null;
    $header_image = trim($_POST['header_image'] ?? '');
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET page_name=?,title=?,content=?,theme=?,template=?,header_image=?,updated=NOW(),status="draft" WHERE id=?');
        $stmt->execute([$page_name,$title,$content,$themeStr,$template,$header_image,$row['id']]);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,page_name,title,content,theme,template,header_image,created,updated,status) VALUES(?,?,?,?,?,?,?,?,NOW(),"draft")');
        $stmt->execute([$slug,$page_name,$title,$content,$themeStr,$template,$header_image,date('Y-m-d H:i:s')]);
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
    $header_image = trim($_POST['header_image'] ?? '');
    $exists=$db->prepare('SELECT id FROM custom_pages WHERE slug=? AND theme <=> ?');
    $exists->execute([$slug,$themeStr]);
    if($row=$exists->fetch()){
        $stmt=$db->prepare('UPDATE custom_pages SET page_name=?,title=?,content=?,theme=?,template=?,header_image=?,updated=NOW(),status="published" WHERE id=?');
        $stmt->execute([$page_name,$title,$content,$themeStr,$template,$header_image,$row['id']]);
        cms_admin_log('Updated custom page '.$slug);
    }else{
        $stmt=$db->prepare('INSERT INTO custom_pages(slug,page_name,title,content,theme,template,header_image,created,updated,status) VALUES(?,?,?,?,?,?,?,?,NOW(),"published")');
        $stmt->execute([$slug,$page_name,$title,$content,$themeStr,$template,$header_image,date('Y-m-d H:i:s')]);
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
<link rel="stylesheet" href="css/image-picker.css">
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
<label>Set Content Header Image:</label><br>
<div id="headerImagePreview"></div>
<input type="hidden" name="header_image" id="header_image">
<input type="file" id="headerImageFile" style="display:none;">
<button type="button" id="uploadHeaderBtn">Upload Image</button>
<button type="button" id="selectHeaderBtn">Select Pre-existing Image</button><br><br>
<textarea name="content" id="content" style="width:100%;height:300px;"></textarea><br>
<input type="submit" name="save_page" value="Save">
<span id="lastSaved" style="margin-left:10px;color:green;"></span>
<button type="button" id="previewBtn" style="display:none;">Preview</button>
<button type="button" id="restoreDraft" style="display:none;">Restore Draft</button>
<button type="button" id="cancel">Cancel</button>
</form>
</div>
<div id="headerImageDialog" title="Select Header Image" style="display:none;">
    <select id="headerImageList"></select>
</div>
<script src="js/image-picker.min.js"></script>
<script>
// Wait for DOM and universal admin scripts to be ready
$(document).ready(function(){
    console.log('Custom pages: Initializing page functionality');
    
    // Load CKEditor dynamically with timeout handling
    var ckEditorLoaded = false;
    var ckEditorScript = document.createElement('script');
    ckEditorScript.src = 'https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js';
    ckEditorScript.onload = function() {
        console.log('CKEditor loaded successfully');
        ckEditorLoaded = true;
        CKEDITOR.replace('content');
    };
    ckEditorScript.onerror = function() {
        console.error('Failed to load CKEditor from CDN');
        $('#content').css('height', '400px').css('font-family', 'monospace');
    };
    document.head.appendChild(ckEditorScript);
    
    // Fallback timeout
    setTimeout(function() {
        if (!ckEditorLoaded) {
            console.warn('CKEditor loading timeout');
            $('#content').css('height', '400px').css('font-family', 'monospace');
        }
    }, 10000);
    
    var loadReq;
function autoSave(){
    var data=$('form').serializeArray();
    data.push({name:'autosave',value:1});
    data.push({name:'page_name',value:$('#page_name').val()});
    
    // Get content from CKEditor if loaded, otherwise from textarea
    var content = '';
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
        content = CKEDITOR.instances.content.getData();
    } else {
        content = $('#content').val();
    }
    data.push({name:'content',value:content});
    
    return $.post('custom_pages.php',data,function(res){
        $('#lastSaved').text('Last saved '+res.time);
    },'json').fail(function(){
        console.error('Autosave failed');
    });
}
setInterval(autoSave,30000);

function loadPage(slug,theme){
    var form = $('#editor form')[0];
    if(form){
        form.reset();
    }
    $('#previewBtn,#restoreDraft').hide();
    // Clear content - handle if CKEditor isn't loaded yet
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
        CKEDITOR.instances.content.setData('');
    } else {
        $('#content').val('');
    }
    setHeaderImage('');
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
        setHeaderImage(d.header_image||'');
        // Set content - handle if CKEditor isn't loaded yet
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
            CKEDITOR.instances.content.setData(d.content||'');
        } else {
            $('#content').val(d.content||'');
        }
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
                // Set content - handle if CKEditor isn't loaded yet
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
                    CKEDITOR.instances.content.setData(r.content||'');
                } else {
                    $('#content').val(r.content||'');
                }
            },'json');
        }).show();
        $('#editor').show();
        }
    });
}

// Bind edit button clicks with debugging
$(document).on('click','.edit-btn',function(e){
    e.preventDefault();
    console.log('Edit button clicked');
    var slug=$(this).data('slug');
    var theme=$(this).data('theme')||'';
    console.log('Loading page:', slug, 'theme:', theme);
    loadPage(slug,theme);
});

console.log('Edit button event handler bound');
console.log('Found edit buttons:', $('.edit-btn').length);

$('#addBtn').on('click',function(){
    console.log('Add button clicked');
    $('#slug').prop('readonly',false).val('');
    $('#page_name').val('');
    $('#title').val('');
    // Clear content - handle if CKEditor isn't loaded yet
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
        CKEDITOR.instances.content.setData('');
    } else {
        $('#content').val('');
    }
    $('.themeChk').prop('checked',false);
    $('#template').val('');
    setHeaderImage('');
    $('#previewBtn,#restoreDraft').hide();
    $('#editor').show();
});

<?php if($edit): ?>
loadPage('<?php echo addslashes($edit['slug']); ?>','<?php echo addslashes($edit['theme'] ?? ''); ?>');
<?php endif; ?>

$('#cancel').on('click',function(){ $('#editor').hide(); });

function setHeaderImage(path){
    $('#header_image').val(path);
    if(path){
        $('#headerImagePreview').html('<img src="../'+path+'" style="max-width:200px;">');
    }else{
        $('#headerImagePreview').empty();
    }
}

$('#uploadHeaderBtn').on('click',function(){
    $('#headerImageFile').click();
});

$('#headerImageFile').on('change',function(){
    var file=this.files[0];
    if(!file)return;
    var fd=new FormData();
    fd.append('upload_header_image',1);
    fd.append('header_image',file);
    fd.append('slug',$('#slug').val());
    fd.append('theme',$('.themeChk:checked').map(function(){return this.value;}).get().join(','));
    fetch('custom_pages.php',{method:'POST',body:fd}).then(r=>r.json()).then(function(res){
        setHeaderImage(res.path);
    });
});

$('#selectHeaderBtn').on('click',function(){
    fetch('custom_pages.php?list_header_images=1').then(r=>r.json()).then(function(list){
        var select=$('#headerImageList');
        if(select.data('picker')){
            select.data('picker').destroy();
        }
        select.empty();
        list.forEach(function(name){
            $('<option>').val(name).attr('data-img-src','../images/headers/custom_pages/'+name).appendTo(select);
        });
        select.imagepicker({hide_select:true});
        $('#headerImageDialog').dialog({
            modal:true,
            width:600,
            buttons:{
                'Select':function(){
                    var selected=select.val();
                    if(selected){
                        var fd=new FormData();
                        fd.append('select_header_image',1);
                        fd.append('image',selected);
                        fd.append('slug',$('#slug').val());
                        fd.append('theme',$('.themeChk:checked').map(function(){return this.value;}).get().join(','));
                        fetch('custom_pages.php',{method:'POST',body:fd}).then(r=>r.json()).then(function(res){
                            setHeaderImage(res.path);
                        });
                    }
                    $(this).dialog('close');
                },
                'Cancel':function(){
                    $(this).dialog('close');
                }
            }
        });
    });

}); // End document.ready
</script>
<?php include 'admin_footer.php'; ?>
