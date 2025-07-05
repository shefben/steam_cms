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
        $ord = $i+1;
        $vis = empty($_POST['hide'][$i]) ? 1 : 0;
        $db->prepare('UPDATE store_sidebar_links SET label=?,url=?,type=?,ord=?,visible=? WHERE id=?')
           ->execute([$label,$url,$type,$ord,$vis,$id]);
    }
}
if(isset($_POST['add_sidebar']) || isset($_POST['add_spacer'])){
    $label = isset($_POST['add_spacer']) ? '' : trim($_POST['new_label']);
    $url   = isset($_POST['add_spacer']) ? '' : trim($_POST['new_url']);
    $type  = isset($_POST['add_spacer']) ? 'spacer' : 'link';
    $ord   = count($db->query('SELECT id FROM store_sidebar_links')->fetchAll()) + 1;
    $db->prepare('INSERT INTO store_sidebar_links(label,url,type,ord,visible) VALUES(?,?,?,?,1)')
       ->execute([$label,$url,$type,$ord]);
}
$sidebar_links = $db->query('SELECT * FROM store_sidebar_links ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Storefront Sidebar</h2>
<form method="post">
<table class="table" id="sidebar-list">
<tr><th></th><th>Label</th><th>URL</th><th>Type</th><th>Hide</th><th>Remove</th></tr>
<?php foreach($sidebar_links as $s): ?>
<tr>
 <td class="handle">&#9776;<input type="hidden" name="ord[]" value="<?php echo $s['ord']?>"></td>
 <td><input type="text" name="label[]" value="<?php echo htmlspecialchars($s['label'])?>" <?php if($s['type']=='spacer') echo 'disabled';?>></td>
 <td><input type="text" name="url[]" value="<?php echo htmlspecialchars($s['url'])?>" <?php if($s['type']=='spacer') echo 'disabled';?>></td>
 <td>
  <select name="type[]">
   <option value="link"<?php if($s['type']=='link') echo ' selected';?>>Link</option>
   <option value="spacer"<?php if($s['type']=='spacer') echo ' selected';?>>Spacer</option>
  </select>
 </td>
 <td><input type="checkbox" name="hide[]" value="1" <?php if(!$s['visible']) echo 'checked';?>></td>
 <td><button type="button" class="remove btn">Remove</button><input type="hidden" name="del[]" value=""></td>
 <input type="hidden" name="sid[]" value="<?php echo $s['id']?>">
</tr>
<?php endforeach; ?>
</table>
<div style="margin-top:10px"><input type="submit" name="save_sidebar" value="Save" class="btn btn-primary"></div>
</form>
<hr>
<form method="post" id="addForm" style="margin-top:10px">
 <input type="text" name="new_label" placeholder="Label">
 <input type="text" name="new_url" placeholder="URL">
 <button name="add_sidebar" value="1" class="btn">Add Link</button>
 <button name="add_spacer" value="1" class="btn">Add Spacer</button>
</form>
<script>
function updateOrders(){
  $('#sidebar-list tr').each(function(i){
    $(this).find('input[name="ord[]"]').val(i+1);
  });
}
Sortable.create(document.querySelector('#sidebar-list'),{handle:'.handle',animation:150,onSort:updateOrders});
updateOrders();
$('#sidebar-list').on('click','.remove',function(){
  var row=$(this).closest('tr');
  row.find('input[name="del[]"]').val('1');
  row.hide();
});
</script>
<?php include 'admin_footer.php'; ?>
