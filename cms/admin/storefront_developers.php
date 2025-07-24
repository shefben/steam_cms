<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');

$db = cms_get_db();

if (isset($_POST['delete'])) {
    $id = (int)$_POST['delete'];
    $db->prepare('DELETE FROM store_developers WHERE id=?')->execute([$id]);
    $db->prepare('DELETE FROM developer_apps WHERE developer_id=?')->execute([$id]);
}

if (isset($_POST['save'])) {
    $id = (int)$_POST['id'];
    $name = trim($_POST['name']);
    $website = trim($_POST['website']);
    if ($id) {
        $db->prepare('UPDATE store_developers SET name=?,website=? WHERE id=?')
            ->execute([$name, $website, $id]);
    } else {
        $stmt = $db->prepare('INSERT INTO store_developers(name,website) VALUES(?,?)');
        $stmt->execute([$name, $website]);
    }
}

$rows = $db->query('SELECT * FROM store_developers ORDER BY name')
    ->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Developers</h2>
<table class="data-table">
    <tr><th>Name</th><th>Website</th><th>Actions</th></tr>
    <?php foreach ($rows as $r): ?>
    <tr>
        <td><?php echo htmlspecialchars($r['name']); ?></td>
        <td><?php echo htmlspecialchars($r['website'] ?? ''); ?></td>
        <td class="actions">
            <a href="storefront_developer.php?id=<?php echo $r['id']; ?>" class="btn btn-primary btn-small">Edit</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Delete developer?');">
                <button type="submit" name="delete" value="<?php echo $r['id']; ?>" class="btn btn-danger btn-small">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="storefront_developer.php" class="btn btn-success">Add Developer</a>
<?php include 'admin_footer.php'; ?>
