<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();
$imgDir = __DIR__ . '/../../archived_steampowered/2005/storefront/screenshots/';
$publicImg = '../archived_steampowered/2005/storefront/screenshots/';
$appid = (int)($_GET['id'] ?? 0);
$stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$app){echo '<p>Unknown app.</p>';include 'admin_footer.php';exit;}

if(isset($_POST['save'])){
    $new_id = (int)$_POST['appid'];
    $name    = trim($_POST['name']);
    $price   = floatval($_POST['price']);
    $desc    = trim($_POST['description']);
    $dev_id  = (int)$_POST['developer'];
    $dev_name = $db->prepare('SELECT name FROM store_developers WHERE id=?');
    $dev_name->execute([$dev_id]);
    $dev_name = $dev_name->fetchColumn();
    $avail   = $_POST['availability'];
    $meta    = trim($_POST['metacritic']);
    $sysreq  = trim($_POST['sysreq']);
    $show_ms = isset($_POST['show_metascore']) ? 1 : 0;
    $images  = array_filter(array_map('trim', explode("\n", $_POST['images'])));

    $main_image = $app['main_image'];
    if(!empty($_FILES['main_image']['tmp_name'])){
        $fname = basename($_FILES['main_image']['name']);
        if(move_uploaded_file($_FILES['main_image']['tmp_name'], $imgDir.$fname)){
            $main_image = $fname;
        }
    }
    $uploaded = [];
    if(!empty($_FILES['screenshots']['name'][0])){
        foreach($_FILES['screenshots']['tmp_name'] as $i=>$tmp){
            if(!$tmp) continue;
            $name = basename($_FILES['screenshots']['name'][$i]);
            if(move_uploaded_file($tmp, $imgDir.$name)){
                $uploaded[] = $name;
            }
        }
    }
    if($uploaded){
        $images = array_merge($images, $uploaded);
    }

    $db->beginTransaction();
    if($new_id && $new_id !== $appid){
        $db->prepare('UPDATE store_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE subscription_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE developer_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE app_categories SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE store_capsules SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $appid = $new_id;
    }
    $upd = $db->prepare('UPDATE store_apps SET name=?,price=?,description=?,developer=?,availability=?,show_metascore=?,metacritic=?,sysreq=?,images=?,main_image=? WHERE appid=?');
    $upd->execute([$name,$price,$desc,$dev_name,$avail,$show_ms,$meta,$sysreq,json_encode($images),$main_image,$appid]);
    $db->prepare('DELETE FROM subscription_apps WHERE appid=?')->execute([$appid]);
    foreach($_POST['packages'] ?? [] as $sub){
        $db->prepare('INSERT INTO subscription_apps(subid,appid) VALUES(?,?)')->execute([(int)$sub,$appid]);
    }
    $db->prepare('DELETE FROM app_categories WHERE appid=?')->execute([$appid]);
    foreach($_POST['categories'] ?? [] as $cat){
        $db->prepare('INSERT INTO app_categories(appid,category_id) VALUES(?,?)')->execute([$appid,(int)$cat]);
    }
    $db->commit();
    header('Location: storefront.php#products');
    exit;
}
$developers = $db->query('SELECT id,name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$dev_id = $db->prepare('SELECT id FROM store_developers WHERE name=?');
$dev_id->execute([$app['developer']]);
$cur_dev = $dev_id->fetchColumn();
$images = json_decode($app['images'] ?: '[]', true);
$packages = $db->query('SELECT subid,name FROM subscriptions ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$cur_packs = $db->prepare('SELECT subid FROM subscription_apps WHERE appid=?');
$cur_packs->execute([$appid]);
$cur_packs = $cur_packs->fetchAll(PDO::FETCH_COLUMN);
$categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
$cur_cats = $db->prepare('SELECT category_id FROM app_categories WHERE appid=?');
$cur_cats->execute([$appid]);
$cur_cats = $cur_cats->fetchAll(PDO::FETCH_COLUMN);
?>
<h2>Edit Product</h2>
<form method="post" enctype="multipart/form-data">
<label>App ID <input type="text" name="appid" value="<?php echo $app['appid']?>"></label><br>
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
<br><label>Metascore <input type="text" name="metacritic" value="<?php echo htmlspecialchars($app['metacritic'])?>"></label>
<br><label>System Requirements<br><textarea name="sysreq" rows="4" cols="60"><?php echo htmlspecialchars($app['sysreq'])?></textarea></label>
<br><label>Main Image <input type="file" name="main_image"></label>
<?php if($app['main_image']): ?>
<div><img src="<?php echo $publicImg . $app['main_image']; ?>" width="100"></div>
<?php endif; ?>
<br><label>Screenshots (one per line)<br><textarea name="images" rows="4" cols="60"><?php echo implode("\n", $images); ?></textarea></label>
<br><label>Upload Screenshots <input type="file" name="screenshots[]" multiple></label>
<br><label>Packages<br><select name="packages[]" multiple size="5">
<?php foreach($packages as $p): $sel=in_array($p['subid'],$cur_packs)?'selected':''; ?>
<option value="<?php echo $p['subid']; ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($p['name']); ?></option>
<?php endforeach; ?>
</select></label>
<br><strong>Categories:</strong><br>
<?php foreach($categories as $c): $checked=in_array($c['id'],$cur_cats)?'checked':''; ?>
<label><input type="checkbox" name="categories[]" value="<?php echo $c['id']; ?>" <?php echo $checked; ?>> <?php echo htmlspecialchars($c['name']); ?></label><br>
<?php endforeach; ?>
<br><label><input type="checkbox" name="show_metascore" value="1" <?php if($app['show_metascore']) echo 'checked';?>> Show Metascore</label>
<div>
<?php foreach($images as $img): ?>
<img src="../archived_steampowered/2005/storefront/screenshots/<?php echo $img?>" width="100">
<?php endforeach; ?>
</div>
<input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
<?php include 'admin_footer.php'; ?>
