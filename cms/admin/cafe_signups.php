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
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 50;
$offset = ($page - 1) * $limit;
$total = (int)$db->query('SELECT COUNT(*) FROM ccafe_registration')->fetchColumn();
$pages = max(1, ceil($total / $limit));

$rows=$db->query("SELECT id,company,firstname,lastname,state,email,created FROM ccafe_registration ORDER BY created DESC LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);

ob_start();
echo '<div class="pagination" style="margin-top:15px; margin-bottom:15px;">';
if ($page > 1) echo '<a href="?page='.($page-1).'">&laquo; Prev</a> ';
for($i=max(1, $page-3); $i<=min($pages, $page+3); $i++) {
    if ($i == $page) echo '<strong>'.$i.'</strong> ';
    else echo '<a href="?page='.$i.'">'.$i.'</a> ';
}
if ($page < $pages) echo '<a href="?page='.($page+1).'">Next &raquo;</a>';
echo '</div>';
$paginationHtml = ob_get_clean();
?>
<h2>Cafe Signups</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Review and manage incoming Internet Cafe sign-up applications.</p>
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
<?php echo $paginationHtml; ?>
<?php include 'admin_footer.php'; ?>
