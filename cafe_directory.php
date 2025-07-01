<?php
$page_title = 'Cyber Caf\xE9 Directory';
require_once __DIR__.'/cms/db.php';
include __DIR__.'/cms/header.php';
$db = cms_get_db();
$entries = $db->query('SELECT * FROM cafe_directory ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content" id="container">
<h1>CYBER CAF&Eacute; DIRECTORY</h1>
<div class="narrower">
<?php foreach($entries as $e): ?>
<p>
<strong><?php if($e['url']){ ?><a href="<?php echo htmlspecialchars($e['url']); ?>" target="_blank"><?php echo htmlspecialchars($e['name']); ?></a><?php }else{ echo htmlspecialchars($e['name']); } ?></strong>
<span style="font-size:10px;color:#999;" title="phone number"><font face="wingdings">(</font> <?php echo htmlspecialchars($e['phone']); ?></span><br>
<?php echo htmlspecialchars($e['address']); ?><br>
<?php echo htmlspecialchars($e['city_state']); ?><br>
<?php echo htmlspecialchars($e['zip']); ?><br><br>
</p>
<?php endforeach; ?>
</div>
</div>
<?php include 'cms/footer.php'; ?>
