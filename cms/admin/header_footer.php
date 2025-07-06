<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$base = cms_base_url();
$theme_list = array_filter(cms_get_themes(), fn($t)=>substr($t,-6) !== '_admin');
$theme = $_GET['theme'] ?? ($_POST['theme'] ?? ($theme_list[0] ?? ''));
$logo_files = array_map('basename', glob(__DIR__.'/../img/steam_logo_onblack*.gif'));
$data = cms_get_theme_header_data($theme);
$footer_html = cms_get_theme_footer($theme);

if(isset($_POST['reorder']) && isset($_POST['order'])){
    $indices = array_map('intval', explode(',', $_POST['order']));
    $buttons = $data['buttons'];
    $reordered = [];
    foreach($indices as $i){
        if(isset($buttons[$i])) $reordered[] = $buttons[$i];
    }
    $data['buttons'] = $reordered;
    $db = cms_get_db();
    $db->prepare('DELETE FROM theme_headers WHERE theme=?')->execute([$theme]);
    $ins = $db->prepare('INSERT INTO theme_headers(theme,ord,logo,text,img,hover,depressed,url,visible,spacer) VALUES(?,?,?,?,?,?,?,?,1,?)');
    foreach($reordered as $ord=>$b){
        $ins->execute([$theme,$ord,$data['logo'],$b['text'],$b['img'],$b['hover'],$b['alt'],$b['url'],$data['spacer'] ?? '']);
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
    $num = 1;
    do {
        $fname = 'steam_logo_onblack_' . $num . '.gif';
        $path = __DIR__ . '/../img/' . $fname;
        $num++;
    } while(file_exists($path));
    move_uploaded_file($_FILES['new_logo']['tmp_name'], $path);
    $data['logo'] = '/img/' . $fname;
    $logo_files[] = $fname;
    echo '<p>Logo uploaded.</p>';
}

if(isset($_POST['save'])){
    $theme = $_POST['theme'];
    $logo = isset($_POST['logo_choice']) ? trim($_POST['logo_choice']) : trim($_POST['logo']);
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
            'text'=>trim($b['text'])
        ];
    }
    $data = ['logo'=>$logo,'buttons'=>$out];
    $db = cms_get_db();
    $db->prepare('DELETE FROM theme_headers WHERE theme=?')->execute([$theme]);
    $ins = $db->prepare('INSERT INTO theme_headers(theme,ord,logo,text,img,hover,depressed,url,visible,spacer) VALUES(?,?,?,?,?,?,?,?,1,?)');
    $spacer = $data['spacer'] ?? '';
    foreach($out as $ord=>$b){
        $ins->execute([$theme,$ord,$logo,$b['text'],$b['img'],$b['hover'],$b['alt'],$b['url'],$spacer]);
    }
    $db->prepare('REPLACE INTO theme_footers(theme,html) VALUES(?,?)')->execute([$theme,$_POST['footer_html']]);
    cms_set_setting('no_header_pages', trim($_POST['no_header_pages']));
    cms_set_setting('header_bar_pages', trim($_POST['header_bar_pages']));
    cms_set_setting('no_footer_pages', trim($_POST['no_footer_pages']));
    cms_set_setting('page_logo_overrides', trim($_POST['logo_overrides']));
    $no_header_pages = trim($_POST['no_header_pages']);
    $header_bar_pages = trim($_POST['header_bar_pages']);
    $no_footer_pages = trim($_POST['no_footer_pages']);
    $footer_html = $_POST['footer_html'];
    $logo_overrides = trim($_POST['logo_overrides']);
    $data = cms_get_theme_header_data($theme);
    echo '<p>Settings saved.</p>';
}
if(isset($_POST['add'])){
    $data['buttons'][] = ['url'=>'','img'=>'','hover'=>'','alt'=>'','text'=>''];
}
?>
<h2>Header &amp; Footer</h2>
<label>Theme: <select id="theme-select" name="theme" onchange="location.href='header_footer.php?theme='+this.value;">
<?php foreach($theme_list as $t): ?>
  <option value="<?php echo htmlspecialchars($t); ?>" <?php if($t==$theme) echo 'selected'; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select></label>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="theme" value="<?php echo htmlspecialchars($theme); ?>">
<p>Current logo:</p>
<?php $logo = $data['logo']; if($logo && $logo[0]=='/') $logo = $base.$logo; ?>
<img src="<?php echo htmlspecialchars($logo); ?>" id="logo-preview" alt="logo" style="max-height:40px"><br>
<select name="logo_choice" id="logo-choice">
  <?php foreach($logo_files as $f): $p='/img/'.$f; ?>
  <option value="<?php echo $p; ?>" data-img="<?php echo $base.$p; ?>" style="background:url('<?php echo $base.$p; ?>') no-repeat left center;padding-left:50px;min-height:20px;" <?php if($data['logo']==$p) echo 'selected'; ?>><?php echo $f; ?></option>
  <?php endforeach; ?>
</select>
<input type="file" name="new_logo" id="new-logo" style="display:inline">
<button type="submit" name="upload_logo" value="1" class="btn btn-secondary">Upload</button>
<input type="hidden" name="logo" id="logo-url" value="<?php echo htmlspecialchars($data['logo']); ?>"><br><br>
<table id="buttons-table" class="data-table">
<thead><tr><th></th><th>URL</th><th>Text</th><th>Delete</th></tr></thead>
<tbody>
<?php foreach($data['buttons'] as $i=>$b): ?>
<tr class="button-row" data-index="<?php echo $i; ?>">
<td class="handle">☰</td>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>" title="Link target when clicked" style="width:250px"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][text]" value="<?php echo htmlspecialchars($b['text'] ?? ''); ?>" title="Text fallback" style="width:200px"></td>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
<input type="hidden" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img']); ?>">
<input type="hidden" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover']); ?>">
<input type="hidden" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt']); ?>">
</tr>
<?php endforeach; ?>
</tbody>
</table>
<br>
<button type="button" id="add-button" class="btn btn-primary">Add Button</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
var tbody = document.querySelector('#buttons-table tbody');
function sendOrder(){
    var ids=[];
    tbody.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.index);});
    var data=new URLSearchParams();
    data.set('reorder','1');
    data.set('order',ids.join(','));
    var theme=document.getElementById('theme-select').value;
    fetch('header_footer.php?theme='+encodeURIComponent(theme),{method:'POST',body:data});
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






</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
