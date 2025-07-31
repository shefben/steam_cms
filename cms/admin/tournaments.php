<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if (isset($_POST['add'])) {
    $title = trim($_POST['title'] ?? '');
    $game  = trim($_POST['game'] ?? '');
    $host  = trim($_POST['host'] ?? '');
    $date  = $_POST['event_date'] ?? '';
    if ($title && $date) {
        $stmt = $db->prepare('INSERT INTO tournaments(title,game,host,event_date) VALUES(?,?,?,?)');
        $stmt->execute([$title, $game, $host, $date]);
        cms_admin_log('Added tournament ' . $title);
    }
}
if (isset($_POST['delete'])) {
    $id = (int)$_POST['delete'];
    $db->prepare('DELETE FROM tournaments WHERE id=?')->execute([$id]);
    cms_admin_log('Deleted tournament ' . $id);
}
$tournaments = $db->query('SELECT * FROM tournaments ORDER BY event_date')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Tournament Management</h2>
<table class="data-table">
<tr><th>ID</th><th>Date</th><th>Title</th><th>Game</th><th>Host</th><th>Actions</th></tr>
<?php foreach ($tournaments as $t) : ?>
<tr>
<td><?php echo $t['id']; ?></td>
<td><?php echo htmlspecialchars($t['event_date']); ?></td>
<td><?php echo htmlspecialchars($t['title']); ?></td>
<td><?php echo htmlspecialchars($t['game']); ?></td>
<td><?php echo htmlspecialchars($t['host']); ?></td>
<td>
    <form method="post" style="display:inline">
        <input type="hidden" name="delete" value="<?php echo $t['id']; ?>">
        <button class="btn btn-danger btn-small" onclick="return confirm('Delete?')">Delete</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</table>
<h3>Add Tournament</h3>
<form method="post">
<label>Date: <input type="date" name="event_date" required></label><br>
<label>Title: <input type="text" name="title" required></label><br>
<label>Game: <input type="text" name="game"></label><br>
<label>Host: <input type="text" name="host"></label><br>
<button type="submit" name="add" class="btn btn-primary">Add</button>
</form>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<?php include 'admin_footer.php'; ?>
