<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['reorder']) && isset($_POST['order'])){
        $ids = array_map('intval', explode(',', $_POST['order']));
        foreach($ids as $i=>$id){
            $db->prepare('UPDATE cafe_representatives SET ord=? WHERE id=?')->execute([$i+1,$id]);
        }
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ echo 'ok'; exit; }
    }
    if(isset($_POST['add'])){
        $stmt=$db->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$_POST['url'],$_POST['website'],$_POST['email'],$_POST['rep_name'],$_POST['address'],$_POST['city_province'],$_POST['zip'],$_POST['country'],$_POST['phone'],$_POST['ord']]);
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_representatives SET url=?,website=?,email=?,rep_name=?,address=?,city_province=?,zip=?,country=?,phone=? WHERE id=?');
        $stmt->execute([$_POST['url'],$_POST['website'],$_POST['email'],$_POST['rep_name'],$_POST['address'],$_POST['city_province'],$_POST['zip'],$_POST['country'],$_POST['phone'],$_POST['id']]);
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['delete_single'])){
        $stmt=$db->prepare('DELETE FROM cafe_representatives WHERE id=?');
        $stmt->execute([$_POST['delete_single']]);
        header('Location: cafe_representatives.php'); exit;
    }
}
$entries=$db->query('SELECT * FROM cafe_representatives ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cafe Representatives</h2>
<input type="hidden" id="rep-order" name="order">
<table border="1" id="rep-table">
<tr><th></th><th>Website</th><th>URL</th><th>Email</th><th>Name</th><th>Address</th><th>City/Prov</th><th>Zip</th><th>Country</th><th>Phone</th><th>Actions</th></tr>
<tbody id="rep-body">
<?php foreach($entries as $e): ?>
<tr data-id="<?php echo $e['id']; ?>"><form method="post">
<td class="handle">&#9776;</td>
<td><input type="text" name="website" value="<?php echo htmlspecialchars($e['website']); ?>"></td>
<td><input type="text" name="url" value="<?php echo htmlspecialchars($e['url']); ?>"></td>
<td><input type="text" name="email" value="<?php echo htmlspecialchars($e['email']); ?>"></td>
<td><input type="text" name="rep_name" value="<?php echo htmlspecialchars($e['rep_name']); ?>"></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($e['address']); ?>"></td>
<td><input type="text" name="city_province" value="<?php echo htmlspecialchars($e['city_province']); ?>"></td>
<td><input type="text" name="zip" value="<?php echo htmlspecialchars($e['zip']); ?>"></td>
<td><input type="text" name="country" value="<?php echo htmlspecialchars($e['country']); ?>"></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($e['phone']); ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $e['id']; ?>">
<button name="update" value="1">Update</button>
<button name="delete_single" value="<?php echo $e['id']; ?>" onclick="return confirm('Delete?')">Delete</button>
</td>
</form></tr>
<?php endforeach; ?>
</tbody>
</table>
<h3>Add Representative</h3>
<form method="post">
Order <input type="number" name="ord" value="0" style="width:40px">
Website <input type="text" name="website">
URL <input type="text" name="url">
Email <input type="text" name="email">
Name <input type="text" name="rep_name">
Address <input type="text" name="address">
City/Prov <input type="text" name="city_province">
Zip <input type="text" name="zip">
Country <input type="text" name="country">
Phone <input type="text" name="phone">
<button name="add" value="1">Add</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('rep-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('cafe_representatives.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
});
</script>
<?php include 'admin_footer.php'; ?>
