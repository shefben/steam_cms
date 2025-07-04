<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');

$db = cms_get_db();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $stmt = $db->prepare('SELECT * FROM store_developers WHERE id=?');
    $stmt->execute([$id]);
    $dev = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$dev) { echo '<p>Developer not found</p>'; include 'admin_footer.php'; exit; }
} else {
    $dev = ['name'=>'','website'=>''];
}

if (isset($_POST['save'])) {
    $name = trim($_POST['name']);
    $website = trim($_POST['website']);
    if ($id) {
        $db->prepare('UPDATE store_developers SET name=?,website=? WHERE id=?')->execute([$name,$website,$id]);
    } else {
        $stmt=$db->prepare('INSERT INTO store_developers(name,website) VALUES(?,?)');
        $stmt->execute([$name,$website]);
        $id = $db->lastInsertId();
    }
    header('Location: storefront_developers.php');
    exit;
}

$games=[];
if ($id) {
    $stmt = $db->prepare('SELECT appid,name FROM store_apps WHERE developer=? ORDER BY name');
    $stmt->execute([$dev['name']]);
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2><?php echo $id ? 'Edit' : 'Add'; ?> Developer</h2>
<form method="post">
<div class="form-group">
<label>Name <input type="text" name="name" value="<?php echo htmlspecialchars($dev['name']); ?>" class="form-control"></label>
</div>
<div class="form-group">
<label>Website <input type="text" name="website" value="<?php echo htmlspecialchars($dev['website']); ?>" class="form-control"></label>
</div>
<?php if ($id): ?>
<h3>Associated Games</h3>
<ul>
<?php foreach ($games as $g): ?>
<li><?php echo $g['appid'].' - '.htmlspecialchars($g['name']); ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
<p><a href="storefront_developers.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
