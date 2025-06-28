<?php
require_once 'admin_header.php';
$base = cms_base_url();
$default_logo = file_exists(__DIR__.'/../content/logo.png') ? $base.'/cms/content/logo.png' : $base.'/img/steam_logo_onblack.gif';
$json = cms_get_setting('header_config', null);
$data = $json?json_decode($json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];
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
}
if(isset($_POST['add'])){
    $data['buttons'][] = ['url'=>'','img'=>'','hover'=>'','alt'=>'','text'=>''];
}
?>
<h2>Edit Header</h2>
<p>Current logo:</p>
<?php $logo = $data['logo']; if($logo && $logo[0]=='/') $logo = $base.$logo; ?>
<img src="<?php echo htmlspecialchars($logo); ?>" id="logo-preview" alt="logo" style="max-height:40px"><br>
<a href="logo.php">Upload new logo</a>
<form method="post" enctype="multipart/form-data">
Logo URL: <input type="text" name="logo" id="logo-url" value="<?php echo htmlspecialchars($data['logo']); ?>" size="50"><br><br>
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
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][text]" value="<?php echo htmlspecialchars($b['text'] ?? ''); ?>"></td>
<td><input type="hidden" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img']); ?>"><input type="file" name="img_file[<?php echo $i; ?>]" class="img-file"></td>
<td><input type="hidden" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover']); ?>"><input type="file" name="hover_file[<?php echo $i; ?>]" class="hover-file"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt']); ?>"></td>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<br>
<button type="button" id="add-button" class="btn btn-primary">Add Button</button>
<input type="submit" name="save" value="Save" class="btn btn-success">
</form>
<script>
$(function(){
    $('#buttons-table tbody').sortable({
        handle: '.handle',
        placeholder: 'sortable-placeholder'
    });

    $('#add-button').on('click', function(){
        var idx = $('#buttons-table tbody tr').length;
        var row = `<tr class="button-row" data-index="${idx}">
            <td class="handle">☰</td>
            <td><span class="text-preview preview"></span></td>
            <td><input type="text" name="buttons[${idx}][url]"></td>
            <td><input type="text" name="buttons[${idx}][text]"></td>
            <td><input type="hidden" name="buttons[${idx}][img]"><input type="file" name="img_file[${idx}]" class="img-file"></td>
            <td><input type="hidden" name="buttons[${idx}][hover]"><input type="file" name="hover_file[${idx}]" class="hover-file"></td>
            <td><input type="text" name="buttons[${idx}][alt]"></td>
            <td><input type="checkbox" name="buttons[${idx}][delete]"></td>
        </tr>`;
        $('#buttons-table tbody').append(row);
    });

    $(document).on('change','.img-file',function(){
        var img = this.files[0];
        var row = $(this).closest('tr');
        if(img){
            if(!row.find('img.preview').length){
                row.find('.preview').replaceWith('<img class="preview" style="max-height:24px">');
            }
            var reader = new FileReader();
            reader.onload = function(e){
                row.find('img.preview').attr('src',e.target.result);
            };
            reader.readAsDataURL(img);
        }
    });

    $(document).on('change','.hover-file',function(){
        var img = this.files[0];
        var row = $(this).closest('tr');
        if(img){
            if(!row.find('img.preview').length){
                row.find('.preview').replaceWith('<img class="preview" style="max-height:24px">');
            }
            var reader = new FileReader();
            reader.onload = function(e){
                row.find('img.preview').attr('data-hover',e.target.result);
            };
            reader.readAsDataURL(img);
        }
    });

    $(document).on('input','input[type="text"]',function(){
        var row=$(this).closest('tr');
        var text=row.find('input[name*="[text]"]').val() || row.find('input[name*="[url]"]').val();
        row.find('.text-preview').text(text);
    });

    $(document).on('mouseenter','img.preview',function(){
        var hover=$(this).data('hover');
        if(hover){ $(this).data('orig',$(this).attr('src')).attr('src',hover); }
    }).on('mouseleave','img.preview',function(){
        var orig=$(this).data('orig');
        if(orig){ $(this).attr('src',orig); }
    });
});
</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
