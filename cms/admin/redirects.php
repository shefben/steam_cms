<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if(isset($_POST['save'])){
    $slug = trim($_POST['slug']);
    $target = trim($_POST['target']);
    if($slug!='' && $target!=''){
        $db->prepare('REPLACE INTO redirects(slug,target,created) VALUES(?,?,NOW())')->execute([$slug,$target]);
    }
}
if(isset($_POST['delete'])){
    $db->prepare('DELETE FROM redirects WHERE id=?')->execute([(int)$_POST['delete']]);
}
$rows = $db->query('SELECT * FROM redirects ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Custom Redirects</h2>
<form method="post">
Slug: <input type="text" name="slug"> Target URL: <input type="text" name="target" size="40">
<input type="submit" name="save" value="Add/Update">
</form>
<table border="1" cellpadding="2">
<tr><th>Slug</th><th>Target</th><th>Hits</th><th>Action</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['slug']); ?></td>
<td><?php echo htmlspecialchars($r['target']); ?></td>
<td><?php echo (int)$r['hits']; ?></td>
<td><form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $r['id']; ?>"><input type="submit" value="Delete"></form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
