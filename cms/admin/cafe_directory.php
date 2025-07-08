<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['reorder']) && isset($_POST['order'])){
        $ids = array_map('intval', explode(',', $_POST['order']));
        foreach($ids as $i=>$id){
            $db->prepare('UPDATE cafe_directory SET ord=? WHERE id=?')->execute([$i+1,$id]);
        }
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ echo 'ok'; exit; }
    }
    if(isset($_POST['add'])){
        $stmt=$db->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord) VALUES(?,?,?,?,?,?,?)');
        $stmt->execute([$_POST['url'],$_POST['name'],$_POST['phone'],$_POST['address'],$_POST['city_state'],$_POST['zip'],$_POST['ord']]);
        header('Location: cafe_directory.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_directory SET url=?,name=?,phone=?,address=?,city_state=?,zip=?,ord=? WHERE id=?');
        $stmt->execute([$_POST['url'],$_POST['name'],$_POST['phone'],$_POST['address'],$_POST['city_state'],$_POST['zip'],$_POST['ord'],$_POST['id']]);
        header('Location: cafe_directory.php'); exit;
    }
    if(isset($_POST['delete_single'])){
        $stmt=$db->prepare('DELETE FROM cafe_directory WHERE id=?');
        $stmt->execute([$_POST['delete_single']]);
        header('Location: cafe_directory.php'); exit;
    }
}
$all=$db->query('SELECT * FROM cafe_directory ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
$page=max(1,(int)($_GET['page']??1));
$per=15;
$total=count($all);
$pages=max(1,ceil($total/$per));
$entries=array_slice($all,($page-1)*$per,$per);
?>
<h2>Cafe Directory</h2>
<input type="hidden" id="dir-order" name="order">
<table border="1" id="dir-table">
<tr><th></th><th>Name</th><th>URL</th><th>Phone</th><th>Address</th><th>City/State</th><th>Zip</th><th>Actions</th></tr>
<tbody id="dir-body">
<?php foreach($entries as $e): ?>
<tr data-id="<?php echo $e['id']; ?>"><form method="post">
<td class="handle">&#9776;</td>
<td><input type="text" name="name" value="<?php echo htmlspecialchars($e['name']); ?>"></td>
<td><input type="text" name="url" value="<?php echo htmlspecialchars($e['url']); ?>"></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($e['phone']); ?>"></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($e['address']); ?>"></td>
<td><input type="text" name="city_state" value="<?php echo htmlspecialchars($e['city_state']); ?>"></td>
<td><input type="text" name="zip" value="<?php echo htmlspecialchars($e['zip']); ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $e['id']; ?>">
<button name="update" value="1">Update</button>
<button name="delete_single" value="<?php echo $e['id']; ?>" onclick="return confirm('Delete?')">Delete</button>
</td>
</form></tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="pagination">
<?php if($page>1): ?><a href="?page=<?php echo $page-1;?>">&laquo; Prev</a><?php endif; ?>
<?php if($page<$pages): ?><a href="?page=<?php echo $page+1; ?>">Next &raquo;</a><?php endif; ?>
</div>
<h3>Add Entry</h3>
<form method="post">
Order <input type="number" name="ord" value="0" style="width:50px">
Name <input type="text" name="name">
URL <input type="text" name="url">
Phone <input type="text" name="phone">
Address <input type="text" name="address">
City/State <input type="text" name="city_state">
Zip <input type="text" name="zip">
<button name="add" value="1">Add</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('dir-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('cafe_directory.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
});
</script>
<?php include 'admin_footer.php'; ?>
