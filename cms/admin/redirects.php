<?php
require_once 'admin_header.php';
require_once __DIR__.'/../update_htaccess.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
) {
    header('Content-Type: application/json');
    $action = $_POST['action'];
    if ($action === 'add') {
        $slug = trim($_POST['slug'] ?? '');
        $target = trim($_POST['target'] ?? '');
        if ($slug !== '' && $target !== '') {
            $db->prepare('REPLACE INTO redirects(slug,target,created) VALUES(?,?,NOW())')->execute([$slug, $target]);
            $id = $db->lastInsertId();
            cms_admin_log('Saved redirect ' . $slug);
            cms_update_htaccess();
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
        }
    } elseif ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $slug = trim($_POST['slug'] ?? '');
        $target = trim($_POST['target'] ?? '');
        if ($id && $slug !== '' && $target !== '') {
            $db->prepare('UPDATE redirects SET slug=?, target=? WHERE id=?')->execute([$slug, $target, $id]);
            cms_admin_log('Updated redirect ' . $slug);
            cms_update_htaccess();
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
        }
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $db->prepare('DELETE FROM redirects WHERE id=?')->execute([$id]);
            cms_admin_log('Deleted redirect ' . $id);
            cms_update_htaccess();
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid id']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Unknown action']);
    }
    exit;
}

if (isset($_POST['save'])) {
    $slug = trim($_POST['slug']);
    $target = trim($_POST['target']);
    if ($slug != '' && $target != '') {
        $db->prepare('REPLACE INTO redirects(slug,target,created) VALUES(?,?,NOW())')->execute([$slug, $target]);
        cms_admin_log('Saved redirect ' . $slug);
        cms_update_htaccess();
    }
}
if (isset($_POST['delete'])) {
    $db->prepare('DELETE FROM redirects WHERE id=?')->execute([(int)$_POST['delete']]);
    cms_admin_log('Deleted redirect ' . (int)$_POST['delete']);
    cms_update_htaccess();
}
$rows = $db->query('SELECT * FROM redirects ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Custom Redirects</h2>
<form method="post" id="addRedirectForm">
Slug: <input type="text" name="slug" id="slug"> Target URL: <input type="text" name="target" id="target" size="40">
<input type="submit" name="save" value="Add/Update">
</form>
<table border="1" cellpadding="2" id="redirectsTable">
<tr><th>Slug</th><th>Target</th><th>Hits</th><th>Action</th></tr>
<?php foreach($rows as $r): ?>
<tr data-id="<?php echo $r['id']; ?>">
<td class="slug"><?php echo htmlspecialchars($r['slug']); ?></td>
<td class="target"><?php echo htmlspecialchars($r['target']); ?></td>
<td class="hits"><?php echo (int)$r['hits']; ?></td>
<td class="actions"><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
</tr>
<?php endforeach; ?>
</table>
<script src="js/redirects.js"></script>
<?php include 'admin_footer.php'; ?>
