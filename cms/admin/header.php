<?php
require_once 'admin_header.php';
$default_logo = file_exists(__DIR__.'/../content/logo.png')?'/cms/content/logo.png':'/img/steam_logo_onblack.gif';
$json = cms_get_setting('header_config', null);
$data = $json?json_decode($json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];
if(isset($_POST['save'])){
    $logo = trim($_POST['logo']);
    $buttons = $_POST['buttons'] ?? [];
    $out = [];
    foreach($buttons as $b){
        if(isset($b['delete'])) continue;
        if(trim($b['url'])=='' && trim(($b['img']??''))=='' && trim(($b['text']??''))=='') continue;
        $out[] = [
            'url'=>trim($b['url']),
            'img'=>trim($b['img']),
            'hover'=>trim($b['hover']),
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
<img src="<?php echo htmlspecialchars($data['logo']); ?>" alt="logo"><br>
<a href="logo.php">Upload new logo</a>
<form method="post">
Logo URL: <input type="text" name="logo" value="<?php echo htmlspecialchars($data['logo']); ?>" size="50"><br><br>
<table border="1" cellpadding="2">
<tr><th>URL</th><th>Text</th><th>Image</th><th>Hover</th><th>Alt</th><th>Delete</th></tr>
<?php foreach($data['buttons'] as $i=>$b): ?>
<tr>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][text]" value="<?php echo htmlspecialchars($b['text'] ?? ''); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt']); ?>"></td>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<input type="submit" name="add" value="Add Button">
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
