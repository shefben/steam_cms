<?php
require_once 'admin_header.php';
$db = cms_get_db();
// gather visit stats
$total = (int)$db->query("SELECT SUM(views) FROM page_views")->fetchColumn();
// top pages in last month
$popular = $db->query("SELECT page, SUM(views) v FROM page_views WHERE date>=DATE_SUB(CURDATE(),INTERVAL 30 DAY) GROUP BY page ORDER BY v DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
$popular_page = $popular ? $popular[0]['page'] : 'N/A';
// visits per week (last 12 weeks)
$weekly = [];
$start = new DateTime('monday this week');
$start->modify('-11 week');
for($i=0;$i<12;$i++){
    $weekly[$start->format('M j')] = 0;
    $start->modify('+1 week');
}
$rows = $db->query("SELECT YEARWEEK(date,3) wk, MIN(date) start_date, SUM(views) v FROM page_views WHERE date>=DATE_SUB(CURDATE(),INTERVAL 12 WEEK) GROUP BY wk ORDER BY wk")->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $r){
    $label = date('M j', strtotime($r['start_date']));
    $weekly[$label] = (int)$r['v'];
}
// visits per month (last 12 months)
$monthly = [];
$start = new DateTime('first day of this month');
$start->modify('-11 month');
for($i=0;$i<12;$i++){
    $monthly[$start->format('M Y')] = 0;
    $start->modify('+1 month');
}
$rows = $db->query("SELECT DATE_FORMAT(date,'%Y-%m') ym, SUM(views) v FROM page_views WHERE date>=DATE_SUB(CURDATE(),INTERVAL 12 MONTH) GROUP BY ym ORDER BY ym")->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $r){
    $label = date('M Y', strtotime($r['ym'].'-01'));
    $monthly[$label] = (int)$r['v'];
}
// other counts
$news_count = (int)$db->query("SELECT COUNT(*) FROM news")->fetchColumn();
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
        <tr><th colspan="2">Top Pages (30 days)</th></tr>
        <?php foreach($popular as $p): ?>
        <tr><td><?php echo htmlspecialchars($p['page']); ?></td><td><?php echo $p['v']; ?></td></tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="chart-controls" aria-label="View range controls">
    <button id="showWeekly" class="btn btn-small" aria-pressed="true">Weekly</button>
    <button id="showMonthly" class="btn btn-small" aria-pressed="false">Monthly</button>
</div>
<div class="chart-container">
    <canvas id="visitsChart" role="img" aria-label="Visits over time"></canvas>
</div>
<div class="chart-container">
    <canvas id="pagesChart" role="img" aria-label="Top pages last month"></canvas>
</div>
<script>
const weeklyLabels = <?php echo json_encode(array_keys($weekly)); ?>;
const weeklyData = <?php echo json_encode(array_values($weekly)); ?>;
const monthlyLabels = <?php echo json_encode(array_keys($monthly)); ?>;
const monthlyData = <?php echo json_encode(array_values($monthly)); ?>;
const pagesLabels = <?php echo json_encode(array_column($popular,'page')); ?>;
const pagesData = <?php echo json_encode(array_column($popular,'v')); ?>;
const visitsCtx = document.getElementById('visitsChart').getContext('2d');
let visitsChart = new Chart(visitsCtx, {
    type: 'line',
    data: { labels: weeklyLabels, datasets: [{ label: 'Visits', data: weeklyData, borderColor: '#27ae60', backgroundColor: 'rgba(39,174,96,0.2)', tension: 0.1, pointRadius: 3, fill: false }] },
    options: { responsive: true, plugins: { legend: { display:false } }, scales: { x: { display: true }, y: { beginAtZero: true, suggestedMax: 1, ticks: { precision: 0 } } } }
});
document.getElementById('showWeekly').addEventListener('click', function(){
    this.setAttribute('aria-pressed','true');
    document.getElementById('showMonthly').setAttribute('aria-pressed','false');
    visitsChart.data.labels = weeklyLabels;
    visitsChart.data.datasets[0].data = weeklyData;
    visitsChart.update();
});
document.getElementById('showMonthly').addEventListener('click', function(){
    this.setAttribute('aria-pressed','true');
    document.getElementById('showWeekly').setAttribute('aria-pressed','false');
    visitsChart.data.labels = monthlyLabels;
    visitsChart.data.datasets[0].data = monthlyData;
    visitsChart.update();
});
new Chart(document.getElementById('pagesChart').getContext('2d'), {
    type: 'bar',
    data: { labels: pagesLabels, datasets: [{ label: 'Views', data: pagesData, backgroundColor: '#2980b9' }] },
    options: { responsive: true, plugins: { legend: { display:false } }, scales:{ y:{ beginAtZero:true } } }
});
</script>
<?php include 'admin_footer.php'; ?>
