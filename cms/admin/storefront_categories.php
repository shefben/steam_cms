<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

if(isset($_POST['save_categories'])){
    foreach($_POST['id'] as $i=>$id){
        if(!empty($_POST['delete'][$i])){
            $db->prepare('DELETE FROM store_categories WHERE id=?')->execute([$id]);
            continue;
        }
        $name = trim($_POST['name'][$i]);
        $ord = (int)$_POST['ord'][$i];
        $vis = isset($_POST['visible'][$i]) ? 1 : 0;
        $db->prepare('UPDATE store_categories SET name=?, ord=?, visible=? WHERE id=?')
           ->execute([$name,$ord,$vis,$id]);
    }
}
if(isset($_POST['add_category'])){
    $name = trim($_POST['new_name']);
    if($name!==''){
        $ord = (int)$db->query('SELECT IFNULL(MAX(ord),0)+1 FROM store_categories')->fetchColumn();
        $db->prepare('INSERT INTO store_categories(name,ord,visible) VALUES(?,?,1)')->execute([$name,$ord]);
    }
}

$categories = $db->query('SELECT * FROM store_categories ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Store Categories</h2>
<form method="post">
<table class="table">
<tr><th>Order</th><th>Name</th><th>Visible</th><th>Delete</th></tr>
<?php foreach($categories as $c): ?>
<tr>
  <td><input type="number" name="ord[]" value="<?php echo $c['ord']?>" style="width:50px"></td>
  <td><input type="text" name="name[]" value="<?php echo htmlspecialchars($c['name'])?>"></td>
  <td><input type="checkbox" name="visible[]" value="1" <?php if($c['visible']) echo 'checked';?>></td>
  <td><input type="checkbox" name="delete[]" value="1"></td>
  <input type="hidden" name="id[]" value="<?php echo $c['id']?>">
</tr>
<?php endforeach; ?>
</table>
<div style="margin-top:10px">
    <input type="submit" name="save_categories" value="Save" class="btn btn-primary">
</div>
</form>
<hr>
<form method="post" style="margin-top:10px">
    <input type="text" name="new_name" placeholder="New category">
    <input type="submit" name="add_category" value="Add" class="btn">
</form>
<?php include 'admin_footer.php'; ?>
