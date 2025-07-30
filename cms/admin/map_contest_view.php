<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db=cms_get_db();
$id=(int)($_GET['id'] ?? 0);
$stmt=$db->prepare('SELECT * FROM map_contest_entries WHERE id=?');
$stmt->execute([$id]);
$entry=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$entry){echo '<p>Entry not found.</p>';include 'admin_footer.php';exit;}
?>
<h2>Map Contest Submission</h2>
<table class="data-table">
<?php foreach($entry as $k=>$v): if(strpos($k,'screenshot')===0) continue; ?>
<tr><th><?php echo htmlspecialchars($k); ?></th><td><?php echo htmlspecialchars($v); ?></td></tr>
<?php endforeach; ?>
</table>
<?php $shots = array_filter([$entry['screenshot1'],$entry['screenshot2'],$entry['screenshot3']]); ?>
<?php if($shots): ?>
<div class="screens">
<?php foreach($shots as $s): ?>
<img src="<?php echo htmlspecialchars($s); ?>" class="thumb" width="150" data-full="<?php echo htmlspecialchars($s); ?>">
<?php endforeach; ?>
</div>
<div id="shotModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);text-align:center;">
<img id="shotFull" style="max-width:90%;max-height:90%;margin-top:5%;">
</div>
<script>
$('.thumb').on('click',function(){
 $('#shotFull').attr('src',$(this).data('full'));$('#shotModal').show();
});
$('#shotModal').on('click',function(){ $(this).hide(); });
</script>
<?php endif; ?>
<?php include 'admin_footer.php'; ?>
