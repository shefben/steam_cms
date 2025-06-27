<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$lang = isset($_GET['lang']) ? preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['lang']) : 'en';
$json = cms_get_setting('translations_'.$lang, '{}');
$data = json_decode($json, true) ?: [];

if(isset($_POST['save'])){
    $out = [];
    foreach($_POST['key'] as $idx=>$k){
        if(trim($k)=='') continue;
        $out[$k] = $_POST['val'][$idx];
    }
    cms_set_setting('translations_'.$lang, json_encode($out));
    $data = $out;
    echo '<p>Translations saved.</p>';
}
?>
<h2>Localization Manager (<?php echo htmlspecialchars($lang); ?>)</h2>
<form method="get" style="margin-bottom:10px;">
<select name="lang">
<?php
$languages = ['en','es','fr','de'];
foreach($languages as $l){
    $sel = $l==$lang?'selected':'';
    echo "<option value='$l' $sel>$l</option>";
}
?>
</select>
<input type="submit" value="Switch">
</form>
<form method="post">
<table border="1" cellpadding="2">
<tr><th>Key</th><th>Value</th></tr>
<?php $i=0; foreach($data as $k=>$v): ?>
<tr>
<td><input type="text" name="key[]" value="<?php echo htmlspecialchars($k); ?>"></td>
<td><input type="text" name="val[]" value="<?php echo htmlspecialchars($v); ?>"></td>
</tr>
<?php $i++; endforeach; ?>
<tr>
<td><input type="text" name="key[]"></td>
<td><input type="text" name="val[]"></td>
</tr>
</table>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
