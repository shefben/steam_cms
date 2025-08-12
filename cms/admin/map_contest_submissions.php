<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
if(isset($_POST['MapContest'])){
    cms_set_setting('MapContest', $_POST['MapContest'] === '1' ? '1' : '0');
    echo 'OK';
    exit;
}
$map_contest = cms_get_setting('MapContest','0');
if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    $db->prepare('DELETE FROM map_contest_entries WHERE id=?')->execute([$id]);
    header('Location: map_contest_submissions.php');
    exit;
}
$rows=$db->query('SELECT id,created,full_name,map_name FROM map_contest_entries ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Map Contest Submissions</h2>
<label><input type="checkbox" id="endContest" <?php echo $map_contest==='1'?'checked':''; ?>> End 2004/2005 Map Contest</label>
<table class="data-table">
<tr><th>Date</th><th>First &amp; Last Name</th><th>Map Name</th><th>Actions</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['created']); ?></td>
<td><?php echo htmlspecialchars($r['full_name']); ?></td>
<td><?php echo htmlspecialchars($r['map_name']); ?></td>
<td class="actions">
<a href="map_contest_view.php?id=<?php echo $r['id']; ?>" class="btn btn-primary btn-small">View</a>
<a href="?delete=<?php echo $r['id']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Delete?');">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<script>
function showNotify(msg){
  var n=document.createElement('div');
  n.className='cms-notify';
  n.textContent=msg;
  document.body.appendChild(n);
  requestAnimationFrame(function(){n.classList.add('show');});
  setTimeout(function(){n.classList.remove('show');},3000);
  setTimeout(function(){n.remove();},3500);
}
document.getElementById('endContest').addEventListener('change',function(){
  var data=new URLSearchParams();
  data.set('MapContest', this.checked ? '1' : '0');
  fetch('map_contest_submissions.php', {method:'POST', body:data, headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(function(){ showNotify('OK'); });
});
</script>
<style>
.cms-notify{position:fixed;right:20px;bottom:-50px;background:#333;color:#fff;padding:10px 20px;border-radius:4px;transition:bottom .3s;}
.cms-notify.show{bottom:20px;}
</style>
<?php include 'admin_footer.php'; ?>
