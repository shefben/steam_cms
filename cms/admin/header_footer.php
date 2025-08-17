<?php
$ajax = isset($_GET['ajax_form']);
if($ajax){ ob_start(); }
require_once 'admin_header.php';
cms_require_permission('manage_settings');
if($ajax){ ob_clean(); }

$base = cms_base_url();
$theme_list = array_filter(cms_get_themes(), fn($t)=>substr($t,-6) !== '_admin');
$default_theme = cms_get_setting('theme', $theme_list[0] ?? '');
if (!in_array($default_theme, $theme_list, true)) {
    $default_theme = $theme_list[0] ?? '';
}
$theme = $_GET['theme'] ?? ($_POST['theme'] ?? $default_theme);
$page = $_GET['page'] ?? ($_POST['page'] ?? '');
$data = cms_get_theme_header_data($theme, $page);
$show_bold = in_array($theme, ['2002_v2','2003_v1']);
$image_dir = dirname(__DIR__,2)."/themes/$theme/images";
$logo_files = glob($image_dir.'/*logo*.{gif,png,jpg,jpeg}', GLOB_BRACE);
$logo_files = array_map(function($f) use($theme){ return '/themes/'.$theme.'/images/'.basename($f); }, $logo_files);
if (empty($data['logo']) && !empty($logo_files)) {
    $data['logo'] = $logo_files[0];
}
$spacer = $data['spacer'] ?? '';
$footer_html = cms_get_theme_footer($theme);
$css_path = cms_get_theme_css($theme);

ob_start();

if(isset($_POST['reorder']) && isset($_POST['order'])){
    $indices = array_map('intval', explode(',', $_POST['order']));
    $buttons = $data['buttons'];
    $reordered = [];
    foreach($indices as $i){
        if(isset($buttons[$i])) $reordered[] = $buttons[$i];
    }
    $data['buttons'] = $reordered;
    $db = cms_get_db();
    $db->prepare('DELETE FROM theme_headers WHERE theme=? AND page=?')->execute([$theme, $page]);
    $ins = $db->prepare('INSERT INTO theme_headers(theme,page,ord,logo,text,img,hover,depressed,url,visible,bold,spacer) VALUES(?,?,?,?,?,?,?,?,?,1,?,?)');
    foreach($reordered as $ord=>$b){
        $ins->execute([$theme,$page,$ord,$data['logo'],$b['text'],$b['img'],$b['hover'],$b['alt'],$b['url'],$b['bold']?1:0,$spacer]);
    }
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        echo 'ok';
    }
    exit;
}

$no_header_pages = cms_get_setting('no_header_pages','');
$header_bar_pages = cms_get_setting('header_bar_pages','');
$no_footer_pages = cms_get_setting('no_footer_pages','');
$logo_overrides = cms_get_setting('page_logo_overrides','');

if(isset($_POST['upload_logo']) && isset($_FILES['new_logo']) && is_uploaded_file($_FILES['new_logo']['tmp_name'])){
    $fname = preg_replace('/[^a-zA-Z0-9._-]/','',$_FILES['new_logo']['name']);
    if($fname==='') $fname = 'logo_'.time().'.gif';
    $dest = $image_dir.'/'.$fname;
    $n = 1;
    while(file_exists($dest)){
        $dest = $image_dir.'/'.pathinfo($fname,PATHINFO_FILENAME).'_'.$n.'.'.pathinfo($fname,PATHINFO_EXTENSION);
        $n++;
    }
    if(!is_dir($image_dir)) mkdir($image_dir,0755,true);
    move_uploaded_file($_FILES['new_logo']['tmp_name'],$dest);
    $rel = '/themes/'.$theme.'/images/'.basename($dest);
    $data['logo'] = $rel;
    $logo_files[] = $rel;
    $db = cms_get_db();
    $count = $db->prepare('SELECT COUNT(*) FROM theme_headers WHERE theme=? AND page=?');
    $count->execute([$theme,$page]);
    if($count->fetchColumn()>0){
        $db->prepare('UPDATE theme_headers SET logo=? WHERE theme=? AND page=?')->execute([$rel,$theme,$page]);
    }else{
        $db->prepare('INSERT INTO theme_headers(theme,page,ord,logo,text,img,hover,depressed,url,visible,bold,spacer) VALUES(?,?,?,?,?,?,?,?,?,1,0,"")')->execute([$theme,$page,0,$rel,'','','','','']);
    }
    echo '<p>Logo uploaded.</p>';
}

if(isset($_POST['save'])){
    $theme = $_POST['theme'];
    $logo = isset($_POST['logo_choice']) ? trim($_POST['logo_choice']) : trim($_POST['logo']);
    $css_path = trim($_POST['css_path']);
    $buttons = $_POST['buttons'] ?? [];
    $out = [];
    foreach($buttons as $i=>$b){
        if(isset($b['delete'])) continue;
        if(trim($b['url'])=='' && trim(($b['img']??''))=='' && trim(($b['text']??''))=='') continue;
        $img = trim($b['img']);
        $hover = trim($b['hover']);
        if(isset($_FILES['img_file']['name'][$i]) && is_uploaded_file($_FILES['img_file']['tmp_name'][$i])){
            $ext = pathinfo($_FILES['img_file']['name'][$i], PATHINFO_EXTENSION);
            $fname = 'btn_'.$i.'_'.time().'.'.$ext;
            move_uploaded_file($_FILES['img_file']['tmp_name'][$i], __DIR__.'/../content/'.$fname);
            $img = '/cms/content/'.$fname;
        }
        if(isset($_FILES['hover_file']['name'][$i]) && is_uploaded_file($_FILES['hover_file']['tmp_name'][$i])){
            $ext = pathinfo($_FILES['hover_file']['name'][$i], PATHINFO_EXTENSION);
            $fname = 'btn_'.$i.'_hover_'.time().'.'.$ext;
            move_uploaded_file($_FILES['hover_file']['tmp_name'][$i], __DIR__.'/../content/'.$fname);
            $hover = '/cms/content/'.$fname;
        }
        $out[] = [
            'url'=>trim($b['url']),
            'img'=>$img,
            'hover'=>$hover,
            'alt'=>trim($b['alt']),
            'text'=>trim($b['text']),
            'bold'=>isset($b['bold']) ? 1 : 0
        ];
    }
    $spacer = trim($_POST['spacer'] ?? $spacer);
    $data = ['logo'=>$logo,'buttons'=>$out, 'spacer'=>$spacer];
    $db = cms_get_db();
    $db->prepare('DELETE FROM theme_headers WHERE theme=? AND page=?')->execute([$theme,$page]);
    $ins = $db->prepare('INSERT INTO theme_headers(theme,page,ord,logo,text,img,hover,depressed,url,visible,bold,spacer) VALUES(?,?,?,?,?,?,?,?,?,1,?,?)');
    foreach($out as $ord=>$b){
        $ins->execute([$theme,$page,$ord,$logo,$b['text'],$b['img'],$b['hover'],$b['alt'],$b['url'],$b['bold']?1:0,$spacer]);
    }
    $db->prepare('REPLACE INTO theme_footers(theme,html) VALUES(?,?)')->execute([$theme,$_POST['footer_html']]);
    $db->prepare('UPDATE themes SET css_path=? WHERE name=?')->execute([$css_path,$theme]);
    cms_set_setting('no_header_pages', trim($_POST['no_header_pages']));
    cms_set_setting('header_bar_pages', trim($_POST['header_bar_pages']));
    cms_set_setting('no_footer_pages', trim($_POST['no_footer_pages']));
    cms_set_setting('page_logo_overrides', trim($_POST['logo_overrides']));
    $no_header_pages = trim($_POST['no_header_pages']);
    $header_bar_pages = trim($_POST['header_bar_pages']);
    $no_footer_pages = trim($_POST['no_footer_pages']);
    $footer_html = $_POST['footer_html'];
    $logo_overrides = trim($_POST['logo_overrides']);
    $data = cms_get_theme_header_data($theme, $page);
    $spacer = $data['spacer'] ?? '';
    echo '<p>Settings saved.</p>';
}
if(isset($_POST['add'])){
    $new = ['url'=>'','img'=>'','hover'=>'','alt'=>'','text'=>''];
    if($show_bold){
        $new['bold'] = 0;
    }
    $data['buttons'][] = $new;
}
?>
<h2>Header &amp; Footer</h2>
<label>Theme: <select id="theme-select" name="theme">
<?php foreach($theme_list as $t): ?>
  <option value="<?php echo htmlspecialchars($t); ?>" <?php if($t==$theme) echo 'selected'; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select></label>
<label style="margin-left:10px;">Page:
  <input type="text" id="page-input" name="page" value="<?php echo htmlspecialchars($page); ?>" placeholder="index" style="width:120px">
</label>
<div id="hf-form-wrapper">
<form method="post" enctype="multipart/form-data" id="hf-form">
<input type="hidden" name="theme" value="<?php echo htmlspecialchars($theme); ?>">
<input type="hidden" name="page" value="<?php echo htmlspecialchars($page); ?>">
Stylesheet path: <input type="text" name="css_path" value="<?php echo htmlspecialchars($css_path); ?>" style="width:300px" title="Theme CSS file"><br>
<p>Current logo:</p>
<?php $logo = $data['logo'];
$logo = str_ireplace('{BASE}', $base, $logo);
if($logo && $logo[0]=='/') $logo = $base.$logo; ?>
<img src="<?php echo htmlspecialchars($logo); ?>" id="logo-preview" alt="logo" style="max-height:40px"><br>
<select name="logo_choice" id="logo-choice">
  <?php foreach($logo_files as $p): ?>
  <option value="<?php echo $p; ?>" data-img="<?php echo $base.$p; ?>" style="background:url('<?php echo $base.$p; ?>') no-repeat left center;padding-left:50px;min-height:20px;" <?php if($data['logo']===$p) echo 'selected'; ?>><?php echo basename($p); ?></option>
  <?php endforeach; ?>
</select>
<input type="file" name="new_logo" id="new-logo" style="display:inline">
<button type="submit" name="upload_logo" id="upload-logo-btn" value="1" class="btn btn-secondary" disabled>Upload</button>
<input type="hidden" name="logo" id="logo-url" value="<?php echo htmlspecialchars($data['logo']); ?>"><br><br>
<table id="buttons-table" class="data-table">
<thead><tr><th></th><th>URL</th><th>Text</th><?php if($show_bold): ?><th>Bold</th><?php endif; ?><th>Delete</th></tr></thead>
<tbody>
<?php foreach($data['buttons'] as $i=>$b): ?>
<tr class="button-row" data-index="<?php echo $i; ?>">
<td class="handle">☰</td>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>" title="Link target when clicked" style="width:250px"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][text]" value="<?php echo htmlspecialchars($b['text'] ?? ''); ?>" title="Text fallback" style="width:200px"></td>
<?php if($show_bold): ?><td style="text-align:center"><input type="checkbox" name="buttons[<?php echo $i; ?>][bold]" value="1" <?php if(!empty($b['bold'])) echo 'checked'; ?>></td><?php endif; ?>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
<input type="hidden" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img'] ?? ''); ?>">
<input type="hidden" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover'] ?? ''); ?>">
<input type="hidden" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt'] ?? ''); ?>">
</tr>
<?php endforeach; ?>
</tbody>
</table>
<br>
<button type="button" id="add-button" class="btn btn-primary">Add Button</button>
<br>
Spacer between links: <input type="text" name="spacer" value="<?php echo htmlspecialchars($spacer); ?>" style="width:150px" title="HTML allowed between nav links"><br>
<h3>Display Options</h3>
Pages without header bar (one per line):<br>
<textarea name="no_header_pages" style="width:100%;height:60px;" title="Hide entire header on these pages"><?php echo htmlspecialchars($no_header_pages); ?></textarea><br>
Header bar only pages (one per line):<br>
<textarea name="header_bar_pages" style="width:100%;height:60px;" title="Show only the header bar without navigation"><?php echo htmlspecialchars($header_bar_pages); ?></textarea><br>
Pages without footer (one per line):<br>
<textarea name="no_footer_pages" style="width:100%;height:60px;" title="Hide the footer on these pages"><?php echo htmlspecialchars($no_footer_pages); ?></textarea><br>
Logo overrides (one per line URL:year:logo path):<br>
<textarea name="logo_overrides" style="width:100%;height:60px;" title="Override logo on specified pages using format /url.php:2004:/img/logo.png"><?php echo htmlspecialchars($logo_overrides); ?></textarea><br>
<h3>Footer</h3>
<textarea name="footer_html" style="width:100%;height:200px;" title="Custom HTML inserted in the footer"><?php echo htmlspecialchars($footer_html); ?></textarea><br>
<input type="submit" name="save" value="Save" class="btn btn-success">
</form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    var tbody = document.querySelector('#buttons-table tbody');
    var showBold = <?php echo $show_bold ? 'true' : 'false'; ?>;
    function sendOrder(){
        var ids=[];
        tbody.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.index);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        var theme=document.getElementById('theme-select').value;
        var page=document.getElementById('page-input').value;
        fetch('header_footer.php?theme='+encodeURIComponent(theme)+'&page='+encodeURIComponent(page),{method:'POST',body:data});
    }
    var sortable = new Sortable(tbody, {handle: '.handle', onEnd: sendOrder});

    document.getElementById('add-button').addEventListener('click', function(){
        var tbody = document.querySelector('#buttons-table tbody');
        var idx = tbody.querySelectorAll('tr').length;
        var row = document.createElement('tr');
        row.className = 'button-row';
        row.dataset.index = idx;
        row.innerHTML = `<td class="handle">☰</td>`+
            `<td><input type="text" name="buttons[${idx}][url]" style="width:250px"></td>`+
            `<td><input type="text" name="buttons[${idx}][text]" style="width:200px"></td>`+
            (showBold ? `<td style="text-align:center"><input type="checkbox" name="buttons[${idx}][bold]" value="1"></td>` : '')+
            `<td><input type="checkbox" name="buttons[${idx}][delete]"></td>`+
            `<input type="hidden" name="buttons[${idx}][img]">`+
            `<input type="hidden" name="buttons[${idx}][hover]">`+
            `<input type="hidden" name="buttons[${idx}][alt]">`;
        tbody.appendChild(row);
    });

    document.getElementById('logo-choice').addEventListener('change', function(){
        var opt = this.options[this.selectedIndex];
        document.getElementById('logo-url').value = opt.value;
        document.getElementById('logo-preview').src = opt.dataset.img;
    });

    var uploadBtn=document.getElementById('upload-logo-btn');
    var fileInput=document.getElementById('new-logo');
    fileInput.addEventListener('change',function(){
        uploadBtn.disabled=!this.value;
    });
    uploadBtn.disabled=!fileInput.value;

    function loadForm(){
        var theme=document.getElementById('theme-select').value;
        var page=document.getElementById('page-input').value;
        $('#hf-form-wrapper').load('header_footer.php?ajax_form=1&theme='+encodeURIComponent(theme)+'&page='+encodeURIComponent(page));
    }
    document.getElementById('theme-select').addEventListener('change',loadForm);
    document.getElementById('page-input').addEventListener('change',loadForm);
});
</script>
<p><a href="index.php">Back</a></p>
<?php
$content = ob_get_clean();
if($ajax){
    ob_end_clean();
    echo $content;
    exit;
}
echo $content;
include 'admin_footer.php';
?>
