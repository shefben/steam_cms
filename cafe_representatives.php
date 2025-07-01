<?php
$page_title = 'Cyber Caf\xE9 Representatives';
require_once __DIR__.'/cms/db.php';
include __DIR__.'/cms/header.php';
$db = cms_get_db();
$entries = $db->query('SELECT * FROM cafe_representatives ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
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
</div>
</div>
<?php include 'cms/footer.php'; ?>
