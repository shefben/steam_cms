<?php
$page_title = 'Cyber Caf\xE9 Representatives';
require_once __DIR__.'/cms/db.php';
include __DIR__.'/cms/header.php';
$db = cms_get_db();
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 50;
$offset = ($page - 1) * $limit;
$total = (int)$db->query('SELECT COUNT(*) FROM cafe_representatives')->fetchColumn();
$pages = max(1, ceil($total / $limit));

$entries = $db->query("SELECT * FROM cafe_representatives ORDER BY ord,id LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);

ob_start();
echo '<div class="pagination" style="margin-top:15px; margin-bottom:15px;">';
if ($page > 1) echo '<a href="index.php?area=cafe_representatives&page='.($page-1).'">&laquo; Prev</a> ';
for($i=max(1, $page-3); $i<=min($pages, $page+3); $i++) {
    if ($i == $page) echo "<b>$i</b> ";
    else echo '<a href="index.php?area=cafe_representatives&page='.$i.'">'.$i.'</a> ';
}
if ($page < $pages) echo '<a href="index.php?area=cafe_representatives&page='.($page+1).'">Next &raquo;</a>';
echo '</div>';
$paginationHtml = ob_get_clean();
?>
<div class="content" id="container">
<h1>CYBER CAF&Eacute; REPRESENTATIVES</h1>
<div class="narrower">
<p>Below are the official licensed Valve Cyber Cafe Program representatives listed by world region. Please contact them for assistance.</p><br>
<?php foreach($entries as $e): ?>
<p>
<strong><?php if($e['url']){ ?><a href="<?php echo htmlspecialchars($e['url']); ?>" target="_blank"><?php echo htmlspecialchars($e['website']); ?></a><?php }else{ echo htmlspecialchars($e['website']); } ?></strong><br>
Email: <a href="mailto:<?php echo htmlspecialchars($e['email']); ?>"><?php echo htmlspecialchars($e['rep_name']); ?></a><br>
<?php echo htmlspecialchars($e['address']); ?><br>
<?php echo htmlspecialchars($e['city_province']); ?><br>
<?php echo htmlspecialchars($e['country']); ?>&nbsp;&nbsp;<?php echo htmlspecialchars($e['zip']); ?><br>
Phone: <?php echo htmlspecialchars($e['phone']); ?><br><br>
</p>
<?php endforeach; ?>
<?php echo $paginationHtml; ?>
</div>
</div>
<?php include 'cms/footer.php'; ?>
