<?php
require_once 'admin_header.php';
$db = cms_get_db();
// gather visit stats
$total = (int)$db->query("SELECT SUM(views) FROM page_views")->fetchColumn();
$popular = $db->query("SELECT page, SUM(views) v FROM page_views GROUP BY page ORDER BY v DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
$popular_page = $popular ? $popular[0]['page'] : 'N/A';
$days = [];
$rows = $db->query("SELECT date,SUM(views) v FROM page_views WHERE date>=DATE_SUB(CURDATE(),INTERVAL 30 DAY) GROUP BY date ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $r){
    $days[$r['date']] = (int)$r['v'];
}
// other counts
$news_count = (int)$db->query("SELECT COUNT(*) FROM news WHERE status='published'")->fetchColumn();
$faq_count = (int)$db->query("SELECT COUNT(*) FROM faq_content")->fetchColumn();
$user_count = (int)$db->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
$signup_count = (int)$db->query("SELECT COUNT(*) FROM ccafe_registration")->fetchColumn();
// server info
$php_version = phpversion();
$mysql_version = $db->query("SELECT VERSION()")->fetchColumn();
?>
<h2>Admin Dashboard</h2>
<div class="stats">
    <table class="data-table">
        <tr><th colspan="2">Site Stats</th></tr>
        <tr><td>Total Visits</td><td><?php echo $total; ?></td></tr>
        <tr><td>News Articles</td><td><?php echo $news_count; ?></td></tr>
        <tr><td>FAQ Entries</td><td><?php echo $faq_count; ?></td></tr>
        <tr><td>Admin Users</td><td><?php echo $user_count; ?></td></tr>
        <tr><td>Café Signups</td><td><?php echo $signup_count; ?></td></tr>
    </table>
    <table class="data-table">
        <tr><th colspan="2">Server Info</th></tr>
        <tr><td>PHP Version</td><td><?php echo htmlspecialchars($php_version); ?></td></tr>
        <tr><td>MySQL Version</td><td><?php echo htmlspecialchars($mysql_version); ?></td></tr>
    </table>
    <table class="data-table">
        <tr><th colspan="2">Top Pages</th></tr>
        <?php foreach($popular as $p): ?>
        <tr><td><?php echo htmlspecialchars($p['page']); ?></td><td><?php echo $p['v']; ?></td></tr>
        <?php endforeach; ?>
    </table>
</div>
<h3>Last 30 Days Visits</h3>
<div style="display:flex;align-items:flex-end;height:100px;">
<?php foreach($days as $d=>$v): $h=$v ? ($v*5) : 1; ?>
    <div title="<?php echo $d.' : '.$v; ?>" style="width:3px;margin:0 1px;background:#333;height:<?php echo $h; ?>px"></div>
<?php endforeach; ?>
</div>
<?php include 'admin_footer.php'; ?>
