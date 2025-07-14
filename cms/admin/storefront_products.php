<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

$page = max(1, (int)($_GET['p'] ?? 1));
$per = 25;
$offset = ($page-1)*$per;
$stmt = $db->prepare('SELECT * FROM store_apps ORDER BY appid LIMIT :lim OFFSET :off');
$stmt->bindValue(':lim', $per, PDO::PARAM_INT);
$stmt->bindValue(':off', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = $db->query('SELECT COUNT(*) FROM store_apps')->fetchColumn();

$export = $_GET['export'] ?? '';
if ($export === 'csv' || $export === 'json') {
    $dataStmt = $db->query('SELECT appid,name,developer,price,availability FROM store_apps ORDER BY appid');
    $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
    $file = 'products.' . ($export === 'csv' ? 'csv' : 'json');
    if ($export === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $file);
        $out = fopen('php://output', 'w');
        if ($data) {
            fputcsv($out, array_keys($data[0]));
            foreach ($data as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
    } else {
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=' . $file);
        echo json_encode($data);
    }
    exit;
}
?>
<h2>Store Products</h2>
<p>
    <a class="btn btn-secondary" href="storefront_products.php?export=csv">Export CSV</a>
    <a class="btn btn-secondary" href="storefront_products.php?export=json">Export JSON</a>
</p>
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
