<?php
require_once __DIR__.'/../cms/header.php';
$db = cms_get_db();
$categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
$developers = $db->query('SELECT name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_COLUMN);
?>
<h1>Browse Games</h1>
<h2>Categories</h2>
<ul>
<?php foreach($categories as $c): ?>
 <li><a href="../index.php?area=search&Browse=1&category=<?php echo $c['id']?>&"><?php echo htmlspecialchars($c['name'])?></a></li>
<?php endforeach; ?>
</ul>
<h2>Developers</h2>
<ul>
<?php foreach($developers as $d): ?>
 <li><a href="../index.php?area=search&Browse=1&developer=<?php echo urlencode($d)?>&"><?php echo htmlspecialchars($d)?></a></li>
<?php endforeach; ?>
</ul>
<?php require_once __DIR__.'/../cms/footer.php'; ?>
