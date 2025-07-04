<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

if(isset($_POST['save_sidebar'])){
    foreach($_POST['sid'] as $i=>$id){
        if(!empty($_POST['del'][$i])){
            $db->prepare('DELETE FROM store_sidebar_links WHERE id=?')->execute([$id]);
            continue;
        }
        $label = trim($_POST['label'][$i]);
        $url = trim($_POST['url'][$i]);
        $type = $_POST['type'][$i]=='spacer'?'spacer':'link';
        $ord = (int)$_POST['ord'][$i];
        $db->prepare('UPDATE store_sidebar_links SET label=?,url=?,type=?,ord=? WHERE id=?')->execute([$label,$url,$type,$ord,$id]);
    }
}
if(isset($_POST['add_sidebar'])){
    $label = trim($_POST['new_label']);
    $url   = trim($_POST['new_url']);
    $type  = $_POST['new_type']=='spacer'?'spacer':'link';
    $ord   = (int)$_POST['new_ord'];
    if($label!=='' || $type==='spacer'){
        $db->prepare('INSERT INTO store_sidebar_links(label,url,type,ord) VALUES(?,?,?,?)')->execute([$label,$url,$type,$ord]);
    }
}
$sidebar_links = $db->query('SELECT * FROM store_sidebar_links ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Storefront Sidebar</h2>
<form method="post">
<table class="table">
<tr><th>Order</th><th>Label</th><th>URL</th><th>Type</th><th>Delete</th></tr>
<?php foreach($sidebar_links as $s): ?>
<tr>
 <td><input type="number" name="ord[]" value="<?php echo $s['ord']?>" style="width:50px"></td>
 <td><input type="text" name="label[]" value="<?php echo htmlspecialchars($s['label'])?>"></td>
 <td><input type="text" name="url[]" value="<?php echo htmlspecialchars($s['url'])?>"></td>
 <td>
  <select name="type[]">
   <option value="link"<?php if($s['type']=='link') echo ' selected';?>>Link</option>
   <option value="spacer"<?php if($s['type']=='spacer') echo ' selected';?>>Spacer</option>
  </select>
 </td>
 <td><input type="checkbox" name="del[]" value="1"></td>
 <input type="hidden" name="sid[]" value="<?php echo $s['id']?>">
</tr>
<?php endforeach; ?>
</table>
<div style="margin-top:10px"><input type="submit" name="save_sidebar" value="Save" class="btn btn-primary"></div>
</form>
<hr>
<form method="post" style="margin-top:10px">
 <input type="number" name="new_ord" value="<?php echo count($sidebar_links)+1; ?>" style="width:50px">
 <input type="text" name="new_label" placeholder="Label">
 <input type="text" name="new_url" placeholder="URL">
 <select name="new_type"><option value="link">Link</option><option value="spacer">Spacer</option></select>
 <input type="submit" name="add_sidebar" value="Add" class="btn">
</form>
<?php include 'admin_footer.php'; ?>
