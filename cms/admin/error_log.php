<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();
$perPage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$total = (int)$db->query('SELECT COUNT(*) FROM error_logs')->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));
$stmt = $db->prepare('SELECT * FROM error_logs ORDER BY created DESC LIMIT ? OFFSET ?');
$stmt->execute([$perPage, $offset]);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Error Log</h2>
<table class="data-table">
<tr><th>Time</th><th>Level</th><th>Message</th><th>File</th><th>Line</th></tr>
<?php foreach ($logs as $log): ?>
<tr>
 <td><?php echo htmlspecialchars($log['created']); ?></td>
 <td><?php echo htmlspecialchars($log['level']); ?></td>
 <td><?php echo htmlspecialchars($log['message']); ?></td>
 <td><?php echo htmlspecialchars(basename($log['file'])); ?></td>
 <td><?php echo (int)$log['line']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<div class="pagination">
<?php
$query = $_GET;
if ($page > 1) { $query['page'] = $page - 1; echo '<a href="?' . http_build_query($query) . '">&laquo; Prev</a>'; }
if ($page < $pages) { $query['page'] = $page + 1; echo ' <a href="?' . http_build_query($query) . '">Next &raquo;</a>'; }
?>
</div>
<?php include 'admin_footer.php'; ?>
