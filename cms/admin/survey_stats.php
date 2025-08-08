<?php
ob_start();
require_once 'admin_header.php';
$db = cms_get_db();
function cms_survey_recalc($db, int $cat): void
{
    $stmt = $db->prepare('SELECT id,count FROM survey_entries WHERE category_id=?');
    $stmt->execute([$cat]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = array_sum(array_column($rows, 'count')) ?: 0;
    foreach ($rows as $r) {
        $pct = $total > 0 ? ($r['count'] / $total) * 100 : 0;
        $u = $db->prepare('UPDATE survey_entries SET percentage=? WHERE id=?');
        $u->execute([round($pct, 2), $r['id']]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $stmt = $db->prepare('INSERT INTO survey_categories(slug,title) VALUES(?,?)');
        $stmt->execute([trim($_POST['slug']), trim($_POST['title'])]);
        cms_admin_log('Added survey category ' . trim($_POST['slug']));
        ob_end_clean();
        header('Location: survey_stats.php');
        exit;
    }
    if (isset($_POST['delete_category']) && isset($_POST['category_id'])) {
        $stmt = $db->prepare('DELETE FROM survey_categories WHERE id=?');
        $stmt->execute([(int)$_POST['category_id']]);
        cms_admin_log('Deleted survey category ' . (int)$_POST['category_id']);
        ob_end_clean();
        header('Location: survey_stats.php');
        exit;
    }
    if (isset($_POST['add_entry']) && isset($_POST['category_id'])) {
        $cat = (int)$_POST['category_id'];
        $stmt = $db->prepare('INSERT INTO survey_entries(category_id,label,count) VALUES(?,?,?)');
        $stmt->execute([$cat, trim($_POST['label']), (int)$_POST['count']]);
        cms_survey_recalc($db, $cat);
        cms_admin_log('Added survey entry to category ' . $cat);
        ob_end_clean();
        header('Location: survey_stats.php?cat=' . $cat);
        exit;
    }
    if (isset($_POST['delete_entry']) && isset($_POST['entry_id'])) {
        $stmt = $db->prepare('SELECT category_id FROM survey_entries WHERE id=?');
        $stmt->execute([(int)$_POST['entry_id']]);
        $cat = $stmt->fetchColumn();
        $stmt = $db->prepare('DELETE FROM survey_entries WHERE id=?');
        $stmt->execute([(int)$_POST['entry_id']]);
        cms_survey_recalc($db, (int)$cat);
        cms_admin_log('Deleted survey entry ' . (int)$_POST['entry_id']);
        ob_end_clean();
        header('Location: survey_stats.php?cat=' . (int)$cat);
        exit;
    }
}
$categories = $db->query('SELECT * FROM survey_categories ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
$catId = isset($_GET['cat']) ? (int)$_GET['cat'] : (isset($categories[0]) ? (int)$categories[0]['id'] : 0);
$entries = [];
if ($catId) {
    $stmt = $db->prepare('SELECT * FROM survey_entries WHERE category_id=? ORDER BY ord,id');
    $stmt->execute([$catId]);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Survey Statistics</h2>
<div class="survey-admin">
    <div class="categories">
        <h3>Categories</h3>
        <ul>
            <?php foreach ($categories as $c) : ?>
                <?php $active = ($c['id'] == $catId) ? ' class="active"' : ''; ?>
                <li<?php echo $active; ?>>
                    <a href="?cat=<?php echo (int)$c['id']; ?>"><?php echo htmlspecialchars($c['title']); ?></a>
                    <form method="post" class="inline-form" style="display:inline"
                        onsubmit="return confirm('Delete category?');">
                        <input type="hidden" name="category_id" value="<?php echo (int)$c['id']; ?>">
                        <button name="delete_category" class="btn btn-small">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <h4>Add Category</h4>
        <form method="post">
            <input type="text" name="slug" placeholder="slug" required>
            <input type="text" name="title" placeholder="title" required>
            <button class="btn" name="add_category">Add</button>
        </form>
    </div>
    <div class="entries">
        <h3>Entries</h3>
        <table class="data-table">
            <tr><th>Label</th><th>Percent</th><th>Count</th><th>Actions</th></tr>
            <?php foreach ($entries as $e) : ?>
            <tr>
                <td><?php echo htmlspecialchars($e['label']); ?></td>
                <td><?php echo htmlspecialchars($e['percentage']); ?>%</td>
                <td><?php echo htmlspecialchars($e['count']); ?></td>
                <td>
                    <form method="post" class="inline-form" onsubmit="return confirm('Delete entry?');">
                        <input type="hidden" name="entry_id" value="<?php echo (int)$e['id']; ?>">
                        <button name="delete_entry" class="btn btn-small">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($catId) : ?>
        <h4>Add Entry</h4>
        <form method="post">
            <input type="hidden" name="category_id" value="<?php echo $catId; ?>">
            <input type="text" name="label" placeholder="label" required>
            <input type="number" name="count" placeholder="count" required>
            <button class="btn" name="add_entry">Add</button>
        </form>
        <?php endif; ?>
    </div>
</div>
<script>
</script>
<?php include 'admin_footer.php'; ?>
