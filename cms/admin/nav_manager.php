<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$default_nav = $default_nav ?? [];
$json = cms_get_setting('nav_items', null);
$nav_items = $json ? json_decode($json, true) : $default_nav;
if(!$nav_items) $nav_items = $default_nav;

if(isset($_POST['save'])){
    $items = [];
    foreach($_POST['item'] as $i){
        $items[] = [
            'file'=>trim($i['file']),
            'label'=>trim($i['label']),
            'visible'=>isset($i['visible'])?1:0
        ];
    }
    cms_set_setting('nav_items', json_encode($items));
    $nav_items = $items;
    echo '<p>Navigation saved.</p>';
}
?>
<h2>Navigation Manager</h2>
<form method="post">
<table border="1" cellpadding="2">
<tr><th>Order</th><th>File</th><th>Label</th><th>Visible</th></tr>
<?php foreach($nav_items as $idx=>$it): ?>
<tr>
<td><?php echo $idx+1; ?></td>
<td><input type="text" name="item[<?php echo $idx; ?>][file]" value="<?php echo htmlspecialchars($it['file']); ?>"></td>
<td><input type="text" name="item[<?php echo $idx; ?>][label]" value="<?php echo htmlspecialchars($it['label']); ?>"></td>
<td><input type="checkbox" name="item[<?php echo $idx; ?>][visible]" <?php echo !empty($it['visible'])?'checked':''; ?>></td>
</tr>
<?php endforeach; ?>
</table>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
