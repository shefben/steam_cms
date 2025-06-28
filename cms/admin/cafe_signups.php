<?php
require_once 'admin_header.php';
cms_require_permission('manage_signups');
$db = cms_get_db();
if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    $db->prepare('DELETE FROM ccafe_registration WHERE id=?')->execute([$id]);
    header('Location: cafe_signups.php');
    exit;
}
$rows=$db->query('SELECT id,company,firstname,lastname,state,email,created FROM ccafe_registration ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cafe Signups</h2>
<table class="data-table">
<tr><th>Company</th><th>Date</th><th>State</th><th>Email</th><th>Actions</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['company']); ?></td>
<td><?php echo htmlspecialchars($r['created']); ?></td>
<td><?php echo htmlspecialchars($r['state']); ?></td>
<td><?php echo htmlspecialchars($r['email']); ?></td>
<td>
    <a href="cafe_signup_view.php?id=<?php echo $r['id']; ?>">View</a> |
    <a href="cafe_signup_edit.php?id=<?php echo $r['id']; ?>">Edit</a> |
    <a href="?delete=<?php echo $r['id']; ?>" onclick="return confirm('Delete?');">Remove</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php include 'admin_footer.php'; ?>
