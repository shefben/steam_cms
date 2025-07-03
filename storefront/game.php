<?php
require_once __DIR__.'/../cms/header.php';
$db = cms_get_db();
$appid = (int)($_GET['AppId'] ?? 0);
$app = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$app->execute([$appid]);
$app = $app->fetch(PDO::FETCH_ASSOC);
if(!$app){ echo '<p>App not found.</p>'; require_once __DIR__.'/../cms/footer.php'; exit; }
$images = json_decode($app['images'] ?: '[]', true);
$packages = json_decode($app['packages'] ?: '[]', true);
$sysreq = $app['sysreq'];
?>
<h1><?php echo htmlspecialchars($app['name'])?></h1>
<p>Developer: <?php echo htmlspecialchars($app['developer'])?></p>
<p>Price: <?php echo $app['price']?></p>
<p>Status: <?php echo htmlspecialchars($app['availability'])?></p>
<div><?php echo nl2br(htmlspecialchars($app['description']))?></div>
<?php if($images): ?>
<div class="screens">
<?php foreach($images as $img): ?>
  <img src="../archived_steampowered/2005/storefront/screenshots/<?php echo $img?>" width="120">
<?php endforeach; ?>
</div>
<?php endif; ?>
<?php if($packages): ?>
<h2>Packages</h2>
<table class="table">
<tr><th>Name</th><th>Price</th></tr>
<?php foreach($packages as $p): ?>
<tr><td><?php echo htmlspecialchars($p['name'])?></td><td><?php echo $p['price']?></td></tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($sysreq): ?>
<h2>System Requirements</h2>
<pre><?php echo htmlspecialchars($sysreq) ?></pre>
<?php endif; ?>
<?php require_once __DIR__.'/../cms/footer.php'; ?>
