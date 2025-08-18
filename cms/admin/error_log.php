<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();
$csrfToken = cms_get_csrf_token();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        die('Invalid CSRF token');
    }
    if (isset($_POST['delete_id'])) {
        $id = (int)$_POST['delete_id'];
        $stmt = $db->prepare('DELETE FROM error_logs WHERE id = ?');
        $stmt->execute([$id]);
    } elseif (isset($_POST['clear_all'])) {
        $db->exec('DELETE FROM error_logs');
    }
    header('Location: error_log.php');
    exit;
}

$perPage = 30;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$total = (int)$db->query('SELECT COUNT(*) FROM error_logs')->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));
$stmt = $db->prepare('SELECT * FROM error_logs ORDER BY created DESC LIMIT :limit OFFSET :offset');
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Error Log</h2>
<table class="data-table">
<tr><th>Time</th><th>Level</th><th>Message</th><th>File</th><th>Line</th><th>Actions</th></tr>
<?php foreach ($logs as $log): ?>
<tr>
 <td><?php echo htmlspecialchars($log['created']); ?></td>
 <td><?php echo htmlspecialchars($log['level']); ?></td>
 <td><?php echo htmlspecialchars($log['message']); ?></td>
 <td><?php echo htmlspecialchars($log['file']); ?></td>
 <td><?php echo (int)$log['line']; ?></td>
 <td>
  <form method="post" style="display:inline" onsubmit="return confirm('Delete this entry?');">
   <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
   <input type="hidden" name="delete_id" value="<?php echo (int)$log['id']; ?>">
   <button class="btn btn-danger btn-small">Delete</button>
  </form>
 </td>
</tr>
<?php endforeach; ?>
</table>
<div class="pagination">
<?php
$query = $_GET;
if ($page > 1) { 
    $query['page'] = $page - 1; 
    echo '<a href="?' . http_build_query($query) . '" class="pagination-btn">&laquo; Previous</a>'; 
}

// Show page numbers with current page indicator
for ($i = 1; $i <= $pages; $i++) {
    $query['page'] = $i;
    $class = ($i == $page) ? 'pagination-current' : 'pagination-link';
    echo '<a href="?' . http_build_query($query) . '" class="' . $class . '">' . $i . '</a>';
}

if ($page < $pages) { 
    $query['page'] = $page + 1; 
    echo '<a href="?' . http_build_query($query) . '" class="pagination-btn">Next &raquo;</a>'; 
}
?>
</div>
<form method="post" onsubmit="return confirm('Clear all error logs?');">
 <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
 <input type="hidden" name="clear_all" value="1">
 <button class="btn btn-danger">Clear Error Log</button>
</form>
<?php include 'admin_footer.php'; ?>
