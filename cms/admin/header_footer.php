<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$base = cms_base_url();
$default_logo = file_exists(__DIR__.'/../content/logo.png') ? $base.'/cms/content/logo.png' : $base.'/img/steam_logo_onblack.gif';
$json = cms_get_setting('header_config', null);
$data = $json?json_decode($json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];

$no_header_pages = cms_get_setting('no_header_pages','');
$header_bar_pages = cms_get_setting('header_bar_pages','');
$no_footer_pages = cms_get_setting('no_footer_pages','');
$footer_html = cms_get_setting('footer_html','');
$logo_overrides = cms_get_setting('page_logo_overrides','');

if(isset($_POST['save'])){
    $logo = trim($_POST['logo']);
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
    cms_set_setting('header_config', json_encode($data));
    cms_set_setting('no_header_pages', trim($_POST['no_header_pages']));
    cms_set_setting('header_bar_pages', trim($_POST['header_bar_pages']));
    cms_set_setting('no_footer_pages', trim($_POST['no_footer_pages']));
    cms_set_setting('footer_html', $_POST['footer_html']);
    cms_set_setting('page_logo_overrides', trim($_POST['logo_overrides']));
    $no_header_pages = trim($_POST['no_header_pages']);
    $header_bar_pages = trim($_POST['header_bar_pages']);
    $no_footer_pages = trim($_POST['no_footer_pages']);
    $footer_html = $_POST['footer_html'];
    $logo_overrides = trim($_POST['logo_overrides']);
    echo '<p>Settings saved.</p>';
}
if(isset($_POST['add'])){
    $data['buttons'][] = ['url'=>'','img'=>'','hover'=>'','alt'=>'','text'=>''];
}
?>
<h2>Header &amp; Footer</h2>
<form method="post" enctype="multipart/form-data">
<p>Current logo:</p>
<?php $logo = $data['logo']; if($logo && $logo[0]=='/') $logo = $base.$logo; ?>
<img src="<?php echo htmlspecialchars($logo); ?>" id="logo-preview" alt="logo" style="max-height:40px"><br>
Logo URL: <input type="text" name="logo" id="logo-url" value="<?php echo htmlspecialchars($data['logo']); ?>" size="50" title="Default header logo path"><br><br>
<table id="buttons-table" class="data-table">
<thead><tr><th></th><th>Preview</th><th>URL</th><th>Text</th><th>Image</th><th>Hover</th><th>Alt</th><th>Delete</th></tr></thead>
<tbody>
<?php foreach($data['buttons'] as $i=>$b): ?>
<tr class="button-row" data-index="<?php echo $i; ?>">
<td class="handle">☰</td>
<td>
<?php if(!empty($b['img'])): ?>
    <img src="<?php echo htmlspecialchars($b['img']); ?>" data-hover="<?php echo htmlspecialchars($b['hover']); ?>" class="preview" style="max-height:24px">
<?php else: ?>
    <span class="text-preview preview"><?php echo htmlspecialchars($b['text'] ?: $b['url']); ?></span>
<?php endif; ?>
</td>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>" title="Link target when clicked"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][text]" value="<?php echo htmlspecialchars($b['text'] ?? ''); ?>" title="Text fallback if no image"></td>
<td><input type="hidden" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img']); ?>"><input type="file" name="img_file[<?php echo $i; ?>]" class="img-file" title="Button image"></td>
<td><input type="hidden" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover']); ?>"><input type="file" name="hover_file[<?php echo $i; ?>]" class="hover-file" title="Hover state image"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt']); ?>" title="Alt text for accessibility"></td>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
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
var sortable = new Sortable(document.querySelector('#buttons-table tbody'), {handle: '.handle'});

document.getElementById('add-button').addEventListener('click', function(){
    var tbody = document.querySelector('#buttons-table tbody');
    var idx = tbody.querySelectorAll('tr').length;
    var row = document.createElement('tr');
    row.className = 'button-row';
    row.dataset.index = idx;
    row.innerHTML = `<td class="handle">☰</td>`+
        `<td><span class="text-preview preview"></span></td>`+
        `<td><input type="text" name="buttons[${idx}][url]"></td>`+
        `<td><input type="text" name="buttons[${idx}][text]"></td>`+
        `<td><input type="hidden" name="buttons[${idx}][img]"><input type="file" name="img_file[${idx}]" class="img-file"></td>`+
        `<td><input type="hidden" name="buttons[${idx}][hover]"><input type="file" name="hover_file[${idx}]" class="hover-file"></td>`+
        `<td><input type="text" name="buttons[${idx}][alt]"></td>`+
        `<td><input type="checkbox" name="buttons[${idx}][delete]"></td>`;
    tbody.appendChild(row);
});

document.addEventListener('change', function(e){
    if(e.target.classList.contains('img-file')){
        var row = e.target.closest('tr');
        var img = e.target.files[0];
        if(img){
            if(!row.querySelector('img.preview')){
                row.querySelector('.preview').outerHTML = '<img class="preview" style="max-height:24px">';
            }
            var reader = new FileReader();
            reader.onload = function(ev){ row.querySelector('img.preview').src = ev.target.result; };
            reader.readAsDataURL(img);
        }
    }else if(e.target.classList.contains('hover-file')){
        var row = e.target.closest('tr');
        var img = e.target.files[0];
        if(img){
            if(!row.querySelector('img.preview')){
                row.querySelector('.preview').outerHTML = '<img class="preview" style="max-height:24px">';
            }
            var reader = new FileReader();
            reader.onload = function(ev){ row.querySelector('img.preview').dataset.hover = ev.target.result; };
            reader.readAsDataURL(img);
        }
    }
});

document.addEventListener('input', function(e){
    if(e.target.matches('input[type="text"]')){
        var row = e.target.closest('tr');
        var text = row.querySelector('input[name*="[text]"]').value || row.querySelector('input[name*="[url]"]').value;
        var preview = row.querySelector('.text-preview');
        if(preview) preview.textContent = text;
    }
});

document.addEventListener('mouseover', function(e){
    if(e.target.matches('img.preview')){
        var hover = e.target.dataset.hover;
        if(hover){ e.target.dataset.orig = e.target.src; e.target.src = hover; }
    }
});

document.addEventListener('mouseout', function(e){
    if(e.target.matches('img.preview')){
        var orig = e.target.dataset.orig;
        if(orig){ e.target.src = orig; }
    }
});
</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
