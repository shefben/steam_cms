<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/admin_auth.php';

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
    }
}

require_once 'admin_header.php';

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
<p class="page-description" style="color:#666;margin-bottom:15px;">Create and edit standalone custom CMS pages, per-theme visibility, and header images.</p>
<link rel="stylesheet" href="css/image-picker.css">
<button type="button" id="addBtn" class="btn btn-primary">Add Custom Page</button>
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
<div id="editorOverlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:1000;justify-content:center;align-items:center;">
  <div id="editor" style="background:white;border-radius:8px;padding:0;width:90%;max-width:700px;max-height:90vh;overflow-y:auto;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
    <div style="padding:15px;border-bottom:1px solid #ddd;"><h3 style="margin:0;">Edit Custom Page</h3></div>
    <form method="post" style="padding:20px;">
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Page ID (Slug):</label>
        <input type="text" name="slug" id="slug" placeholder="Page ID" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box;"><br>
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Page Name:</label>
        <input type="text" name="page_name" id="page_name" value="<?php echo isset($edit['page_name']) ? htmlspecialchars($edit['page_name']) : ''; ?>" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box;">
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Page Title:</label>
        <input type="text" name="title" id="title" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box;">
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Visible For Themes:</label>
        <?php foreach($themes as $t): ?>
            <label style="display:inline-block;margin-right:15px;"><input type="checkbox" name="themes[]" value="<?php echo htmlspecialchars($t); ?>" class="themeChk"> <?php echo htmlspecialchars($t); ?></label>
        <?php endforeach; ?>
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Template:</label>
        <select name="template" id="template" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box;">
            <option value="">default.twig</option>
            <?php foreach($template_files as $f): ?>
                <option value="<?php echo htmlspecialchars($f); ?>"<?php if(isset($edit['template']) && $edit['template']===$f) echo ' selected'; ?>><?php echo htmlspecialchars($f); ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Content Header Image:</label>
        <div id="headerImagePreview" style="margin-bottom:10px;"></div>
        <input type="hidden" name="header_image" id="header_image">
        <input type="file" id="headerImageFile" style="display:none;">
        <button type="button" id="uploadHeaderBtn" class="btn btn-small" style="margin-right:5px;">Upload Image</button>
        <button type="button" id="selectHeaderBtn" class="btn btn-small">Select Existing</button>
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;margin-bottom:5px;font-weight:bold;">Content:</label>
        <textarea name="content" id="content" style="width:100%;height:250px;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box;"></textarea>
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:15px;border-top:1px solid #ddd;">
        <span id="lastSaved" style="color:green;margin-right:auto;"></span>
        <button type="button" id="previewBtn" class="btn btn-secondary" style="display:none;">Preview</button>
        <button type="button" id="restoreDraft" class="btn btn-secondary" style="display:none;">Restore Draft</button>
        <button type="button" id="cancel" class="btn" style="padding:8px 16px;border:1px solid #ccc;background:#f5f5f5;border-radius:4px;cursor:pointer;">Cancel</button>
        <input type="submit" name="save_page" value="Save" class="btn btn-primary" style="padding:8px 16px;background:#007bff;color:white;border:none;border-radius:4px;cursor:pointer;">
      </div>
    </form>
    </div>
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
        CKEDITOR.replace('content', {baseHref: '/' });
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
        $('#editorOverlay').css('display','flex');
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
    $('#editorOverlay').css('display','flex');
});

<?php if($edit): ?>
loadPage('<?php echo addslashes($edit['slug']); ?>','<?php echo addslashes($edit['theme'] ?? ''); ?>');
<?php endif; ?>

$('#cancel').on('click',function(){ $('#editorOverlay').hide(); });
$('#editorOverlay').on('click',function(e){ if(e.target.id === 'editorOverlay') $('#editorOverlay').hide(); });

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
}); // End click handler

}); // End document.ready
</script>
<?php include 'admin_footer.php'; ?>
