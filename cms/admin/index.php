<?php
require_once 'admin_header.php';
$db = cms_get_db();
// gather stats
$stats = $db->query("SELECT SUM(views) as total FROM page_views")->fetch(PDO::FETCH_ASSOC);
$total = $stats['total'] ?? 0;
$popular = $db->query("SELECT page, SUM(views) as v FROM page_views GROUP BY page ORDER BY v DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$popular_page = $popular ? $popular['page'] : 'N/A';
$days = [];
$rows = $db->query("SELECT date,SUM(views) v FROM page_views WHERE date>=DATE_SUB(CURDATE(),INTERVAL 30 DAY) GROUP BY date ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $r){
    $days[$r['date']] = (int)$r['v'];
}
?>
<h2>Admin Dashboard</h2>
<p>Total visits: <?php echo (int)$total; ?></p>
<p>Most popular page: <?php echo htmlspecialchars($popular_page); ?></p>
<div style="display:flex;align-items:flex-end;height:100px;">
<?php foreach($days as $d=>$v): $h=$v ? ($v*5) : 1; ?>
    <div title="<?php echo $d.' : '.$v; ?>" style="width:3px;margin:0 1px;background:#333;height:<?php echo $h; ?>px"></div>
<?php endforeach; ?>
</div>
<?php include 'admin_footer.php'; ?>
