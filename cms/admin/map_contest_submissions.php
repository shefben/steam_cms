<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    $db->prepare('DELETE FROM map_contest_entries WHERE id=?')->execute([$id]);
    header('Location: map_contest_submissions.php');
    exit;
}
$rows=$db->query('SELECT id,created,full_name,map_name FROM map_contest_entries ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Map Contest Submissions</h2>
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
<?php include 'admin_footer.php'; ?>
