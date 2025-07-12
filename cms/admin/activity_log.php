<?php
require_once 'admin_header.php';
cms_require_permission('manage_admins');
$db = cms_get_db();

$users = $db->query('SELECT id, username FROM admin_users ORDER BY username')->fetchAll(PDO::FETCH_ASSOC);
$user = isset($_GET['user']) ? (int)$_GET['user'] : 0;
$action = trim($_GET['action'] ?? '');

$where = [];
$params = [];
if($user){
    $where[] = 'l.user = ?';
    $params[] = $user;
}
if($action !== ''){
    $where[] = 'l.action LIKE ?';
    $params[] = '%' . $action . '%';
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$stmt = $db->prepare("SELECT COUNT(*) FROM admin_logs l $whereSql");
$stmt->execute($params);
$total = (int)$stmt->fetchColumn();
$perPage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));
$pages = max(1, (int)ceil($total/$perPage));
$offset = ($page-1)*$perPage;

$paramsWithLimit = array_merge($params, [$perPage, $offset]);
$stmt = $db->prepare("SELECT l.*, u.username FROM admin_logs l LEFT JOIN admin_users u ON u.id=l.user $whereSql ORDER BY l.ts DESC LIMIT ? OFFSET ?");
$stmt->execute($paramsWithLimit);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Activity Log</h2>
<form method="get" style="margin-bottom:10px;">
<label>User:
<select name="user">
<option value="">All</option>
<?php foreach($users as $u): ?>
    <option value="<?php echo $u['id']; ?>"<?php if($user==$u['id']) echo ' selected'; ?>><?php echo htmlspecialchars($u['username']); ?></option>
<?php endforeach; ?>
</select></label>
<label>Action: <input type="text" name="action" value="<?php echo htmlspecialchars($action); ?>"></label>
<button type="submit">Filter</button>
</form>
<table class="data-table">
<tr><th>Time</th><th>User</th><th>Action</th></tr>
<?php foreach($logs as $log): ?>
<tr>
<td><?php echo htmlspecialchars($log['ts']); ?></td>
<td><?php echo htmlspecialchars($log['username'] ?? 'Unknown'); ?></td>
<td><?php echo htmlspecialchars($log['action']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<div class="pagination">
<?php
$query = $_GET;
if($page>1){ $query['page']=$page-1; echo '<a href="?'.http_build_query($query).'">&laquo; Prev</a>'; }
if($page<$pages){ $query['page']=$page+1; echo ' <a href="?'.http_build_query($query).'">Next &raquo;</a>'; }
?>
</div>
<?php include 'admin_footer.php'; ?>
