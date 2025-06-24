<?php
require_once __DIR__ . '/../db.php';
$header_file = __DIR__ . '/../content/header.json';
$data = file_exists($header_file) ? json_decode(file_get_contents($header_file), true) : ["logo"=>"/img/steam_logo_onblack.gif","buttons"=>[]];
if(isset($_POST['save'])){
    $logo = trim($_POST['logo']);
    $buttons = $_POST['buttons'] ?? [];
    $out = [];
    foreach($buttons as $b){
        if(isset($b['delete'])) continue;
        if(trim($b['url'])=='' && trim($b['img'])=='') continue;
        $out[] = [
            'url'=>trim($b['url']),
            'img'=>trim($b['img']),
            'hover'=>trim($b['hover']),
            'alt'=>trim($b['alt'])
        ];
    }
    $data = ['logo'=>$logo,'buttons'=>$out];
    file_put_contents($header_file, json_encode($data, JSON_PRETTY_PRINT));
}
if(isset($_POST['add'])){
    $data['buttons'][] = ['url'=>'','img'=>'','hover'=>'','alt'=>''];
}
?>
<html>
<head><title>Edit Header</title></head>
<body>
<h1>Edit Header</h1>
<form method="post">
Logo URL: <input type="text" name="logo" value="<?php echo htmlspecialchars($data['logo']); ?>" size="50"><br><br>
<table border="1" cellpadding="2">
<tr><th>URL</th><th>Image</th><th>Hover</th><th>Alt</th><th>Delete</th></tr>
<?php foreach($data['buttons'] as $i=>$b): ?>
<tr>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>"></td>
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
</body>
</html>
