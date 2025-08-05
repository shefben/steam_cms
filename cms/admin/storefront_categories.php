<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

if(isset($_POST['delete_single'])){
    $id = (int)$_POST['delete_single'];
    $db->prepare('DELETE FROM store_categories WHERE id=?')->execute([$id]);
}

if(isset($_POST['reorder']) && isset($_POST['order'])){
    $ids = array_map('intval', explode(',', $_POST['order']));
    foreach($ids as $i => $cid){
        $db->prepare('UPDATE store_categories SET ord=? WHERE id=?')->execute([$i+1,$cid]);
    }
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ echo 'ok'; exit; }
}

if(isset($_POST['save_categories'])){
    foreach($_POST['id'] as $i=>$id){
        $name = trim($_POST['name'][$i]);
        $vis = isset($_POST['visible'][$i]) ? 1 : 0;
        $db->prepare('UPDATE store_categories SET name=?, visible=? WHERE id=?')
           ->execute([$name,$vis,$id]);
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
<form method="post" id="catForm">
<input type="hidden" name="order" id="cat-order">
<table class="table" id="cat-table">
<thead><tr><th></th><th>Name</th><th>Visible</th><th>Delete</th></tr></thead>
<tbody id="cat-body">
<?php foreach($categories as $c): ?>
<tr data-id="<?php echo $c['id']?>">
  <td class="handle">&#9776;<input type="hidden" name="id[]" value="<?php echo $c['id']?>"></td>
  <td><input type="text" name="name[]" value="<?php echo htmlspecialchars($c['name'])?>"></td>
  <td><input type="checkbox" name="visible[]" value="1" <?php if($c['visible']) echo 'checked';?>></td>
  <td><button type="submit" name="delete_single" value="<?php echo $c['id']?>" class="btn btn-danger btn-small">Delete</button></td>
</tr>
<?php endforeach; ?>
</tbody>
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
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('cat-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('storefront_categories.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
});
</script>
<?php include 'admin_footer.php'; ?>
