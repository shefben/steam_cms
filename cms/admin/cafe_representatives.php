<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
        $stmt=$db->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$_POST['url'],$_POST['website'],$_POST['email'],$_POST['rep_name'],$_POST['address'],$_POST['city_province'],$_POST['zip'],$_POST['country'],$_POST['phone'],$_POST['ord']]);
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_representatives SET url=?,website=?,email=?,rep_name=?,address=?,city_province=?,zip=?,country=?,phone=?,ord=? WHERE id=?');
        $stmt->execute([$_POST['url'],$_POST['website'],$_POST['email'],$_POST['rep_name'],$_POST['address'],$_POST['city_province'],$_POST['zip'],$_POST['country'],$_POST['phone'],$_POST['ord'],$_POST['id']]);
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['delete'])){
        $stmt=$db->prepare('DELETE FROM cafe_representatives WHERE id=?');
        $stmt->execute([$_POST['delete']]);
        header('Location: cafe_representatives.php'); exit;
    }
}
$entries=$db->query('SELECT * FROM cafe_representatives ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cafe Representatives</h2>
<table border="1">
<tr><th>Order</th><th>Website</th><th>URL</th><th>Email</th><th>Name</th><th>Address</th><th>City/Prov</th><th>Zip</th><th>Country</th><th>Phone</th><th>Actions</th></tr>
<?php foreach($entries as $e): ?>
<tr><form method="post">
<td><input type="number" name="ord" value="<?php echo $e['ord']; ?>" style="width:40px"></td>
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
<button name="delete" value="<?php echo $e['id']; ?>" onclick="return confirm('Delete?')">Delete</button>
</td>
</form></tr>
<?php endforeach; ?>
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
<?php include 'admin_footer.php'; ?>
