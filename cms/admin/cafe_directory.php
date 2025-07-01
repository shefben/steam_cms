<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
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
    if(isset($_POST['delete'])){
        $stmt=$db->prepare('DELETE FROM cafe_directory WHERE id=?');
        $stmt->execute([$_POST['delete']]);
        header('Location: cafe_directory.php'); exit;
    }
}
$entries=$db->query('SELECT * FROM cafe_directory ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cafe Directory</h2>
<table border="1">
<tr><th>Order</th><th>Name</th><th>URL</th><th>Phone</th><th>Address</th><th>City/State</th><th>Zip</th><th>Actions</th></tr>
<?php foreach($entries as $e): ?>
<tr><form method="post">
<td><input type="number" name="ord" value="<?php echo $e['ord']; ?>" style="width:50px"></td>
<td><input type="text" name="name" value="<?php echo htmlspecialchars($e['name']); ?>"></td>
<td><input type="text" name="url" value="<?php echo htmlspecialchars($e['url']); ?>"></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($e['phone']); ?>"></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($e['address']); ?>"></td>
<td><input type="text" name="city_state" value="<?php echo htmlspecialchars($e['city_state']); ?>"></td>
<td><input type="text" name="zip" value="<?php echo htmlspecialchars($e['zip']); ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $e['id']; ?>">
<button name="update" value="1">Update</button>
<button name="delete" value="<?php echo $e['id']; ?>" onclick="return confirm('Delete?')">Delete</button>
</td>
</form></tr>
<?php endforeach; ?>
</table>
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
<?php include 'admin_footer.php'; ?>
