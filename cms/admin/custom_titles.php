<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    if (!empty($_POST['title_name'])) {
        foreach ($_POST['title_name'] as $id => $name) {
            $id = (int)$id;
            $themes = $_POST['themes'][$id] ?? '';
            $content = $_POST['title_content'][$id] ?? '';
            if ($id > 0) {
                $stmt = $db->prepare('UPDATE custom_titles SET title_name=?, themes=?, title_content=? WHERE uniqueid=?');
                $stmt->execute([$name, $themes, $content, $id]);
            }
        }
    }
    if (!empty($_POST['delete'])) {
        foreach ($_POST['delete'] as $id) {
            $id = (int)$id;
            $db->prepare('DELETE FROM custom_titles WHERE uniqueid=?')->execute([$id]);
        }
    }
    if (!empty($_POST['new_title_name'])) {
        $stmt = $db->prepare('INSERT INTO custom_titles(title_name,themes,title_content) VALUES(?,?,?)');
        $cnt = count($_POST['new_title_name']);
        for ($i=0;$i<$cnt;$i++) {
            $name = trim($_POST['new_title_name'][$i]);
            if ($name === '') continue;
            $themes = $_POST['new_themes'][$i] ?? '';
            $content = $_POST['new_title_content'][$i] ?? '';
            $stmt->execute([$name, $themes, $content]);
        }
    }
}

$rows = $db->query('SELECT * FROM custom_titles ORDER BY uniqueid')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Custom Titles</h2>
<form method="post">
<table class="table">
<tr><th>Name</th><th>Themes</th><th>Content</th><th>Delete</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
 <td><input type="text" name="title_name[<?php echo $r['uniqueid']; ?>]" value="<?php echo htmlspecialchars($r['title_name']); ?>"></td>
 <td><input type="text" name="themes[<?php echo $r['uniqueid']; ?>]" value="<?php echo htmlspecialchars($r['themes']); ?>"></td>
 <td><textarea name="title_content[<?php echo $r['uniqueid']; ?>]" rows="2"><?php echo htmlspecialchars($r['title_content']); ?></textarea></td>
 <td><input type="checkbox" name="delete[]" value="<?php echo $r['uniqueid']; ?>"></td>
</tr>
<?php endforeach; ?>
<tr>
 <td><input type="text" name="new_title_name[]"></td>
 <td><input type="text" name="new_themes[]"></td>
 <td><textarea name="new_title_content[]" rows="2"></textarea></td>
 <td></td>
</tr>
</table>
<button type="submit" name="save" value="1">Save</button>
</form>
<?php include 'admin_footer.php'; ?>
