<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

$page = max(1, (int)($_GET['p'] ?? 1));
$per = 25;
$offset = ($page-1)*$per;
$stmt = $db->prepare('SELECT * FROM store_apps ORDER BY appid LIMIT ? OFFSET ?');
$stmt->execute([$per,$offset]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = $db->query('SELECT COUNT(*) FROM store_apps')->fetchColumn();
?>
<h2>Store Products</h2>
<table class="table">
<tr><th>ID</th><th>Image</th><th>Name</th><th>Developer</th><th>Price</th><th>Avail</th><th></th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo $r['appid']?></td>
<td><?php $imgs=json_decode($r['images'] ?: '[]', true); if($imgs){$img=$imgs[0]; echo '<img src="../archived_steampowered/2005/storefront/screenshots/'.$img.'" width="40">';} ?></td>
<td><?php echo htmlspecialchars($r['name'])?></td>
<td><?php echo htmlspecialchars($r['developer'])?></td>
<td><?php echo $r['price']?></td>
<td><?php echo htmlspecialchars($r['availability'])?></td>
<td><a href="storefront_product.php?id=<?php echo $r['appid']?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</table>
<?php $pages = ceil($total/$per); if($pages>1){ echo '<div class="pagination">'; if($page>1){$p=$page-1; echo "<a href='storefront_products.php?p=$p'>&laquo; Prev</a> ";} if($page<$pages){$p=$page+1; echo " <a href='storefront_products.php?p=$p'>Next &raquo;</a>";} echo '</div>'; } ?>
<?php include 'admin_footer.php'; ?>
