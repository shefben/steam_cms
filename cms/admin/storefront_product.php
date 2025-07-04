<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();
$appid = (int)($_GET['id'] ?? 0);
$stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$app){echo '<p>Unknown app.</p>';include 'admin_footer.php';exit;}

if(isset($_POST['save'])){
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $desc = trim($_POST['description']);
    $dev_id = (int)$_POST['developer'];
    $dev_name = $db->prepare('SELECT name FROM store_developers WHERE id=?');
    $dev_name->execute([$dev_id]);
    $dev_name = $dev_name->fetchColumn();
    $avail = $_POST['availability'];
    $show_ms = isset($_POST['show_metascore']) ? 1 : 0;
    $upd = $db->prepare('UPDATE store_apps SET name=?,price=?,description=?,developer=?,availability=?,show_metascore=? WHERE appid=?');
    $upd->execute([$name,$price,$desc,$dev_name,$avail,$show_ms,$appid]);
    header('Location: storefront.php#products');
    exit;
}
$developers = $db->query('SELECT id,name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$dev_id = $db->prepare('SELECT id FROM store_developers WHERE name=?');
$dev_id->execute([$app['developer']]);
$cur_dev = $dev_id->fetchColumn();
$images = json_decode($app['images'] ?: '[]', true);
?>
<h2>Edit Product</h2>
<form method="post">
<p>ID: <?php echo $app['appid']?></p>
<label>Name <input type="text" name="name" value="<?php echo htmlspecialchars($app['name'])?>"></label><br>
<label>Price <input type="text" name="price" value="<?php echo $app['price']?>"></label><br>
<label>Developer <select name="developer">
<?php foreach($developers as $d): ?>
<option value="<?php echo $d['id']?>" <?php if($d['id']==$cur_dev) echo 'selected';?>><?php echo htmlspecialchars($d['name'])?></option>
<?php endforeach; ?>
</select></label><br>
<label>Availability <select name="availability">
<?php foreach(['Available','n/a','Comming Soon','New release'] as $opt): ?>
<option value="<?php echo $opt?>" <?php if($opt==$app['availability']) echo 'selected';?>><?php echo $opt?></option>
<?php endforeach; ?>
</select></label><br>
<label>Description<br><textarea name="description" rows="5" cols="60"><?php echo htmlspecialchars($app['description'])?></textarea></label>
<br><label><input type="checkbox" name="show_metascore" value="1" <?php if($app['show_metascore']) echo 'checked';?>> Show Metascore</label>
<div>
<?php foreach($images as $img): ?>
<img src="../archived_steampowered/2005/storefront/screenshots/<?php echo $img?>" width="100">
<?php endforeach; ?>
</div>
<input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
<?php include 'admin_footer.php'; ?>
