<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');

$theme = cms_get_setting('theme','2004');
$db = cms_get_db();

$versions = [];
$defaultVer = '';
if ($theme === '2003_v2') {
    $versions = [
        '2003_v2_v1' => 'Version 1',
        '2003_v2_v2' => 'Version 2',
        '2003_v2_v3' => 'Version 3'
    ];
    $defaultVer = '2003_v2_v2';
} elseif ($theme === '2004') {
    $versions = [
        '2004_v1' => 'Version 1',
        '2004_v2' => 'Version 2',
        '2004_v3' => 'Version 3'
    ];
    $defaultVer = '2004_v3';
}
$settingKey = 'download_page_' . $theme;
$current = cms_get_setting($settingKey, $defaultVer);

if (isset($_POST['save_type']) && isset($_POST['download_version'])) {
    $sel = $_POST['download_version'];
    if (isset($versions[$sel])) {
        cms_set_setting($settingKey, $sel);
        $current = $sel;
        echo '<p>Download page type saved.</p>';
    }
}

if (isset($_POST['save_cat'])) {
    $id = (int)($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $size = trim($_POST['file_size'] ?? '');
    if ($name !== '') {
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE download_categories SET name=?,file_size=? WHERE id=?');
            $stmt->execute([$name,$size,$id]);
            echo '<p>Category updated.</p>';
        } else {
            $stmt = $db->prepare('INSERT INTO download_categories(name,file_size) VALUES(?,?)');
            $stmt->execute([$name,$size]);
            echo '<p>Category added.</p>';
        }
    }
}
if (isset($_POST['delete_cat'])) {
    $id = (int)($_POST['id'] ?? 0);
    $db->prepare('DELETE FROM download_categories WHERE id=?')->execute([$id]);
    echo '<p>Category deleted.</p>';
}

$cats = $db->query('SELECT * FROM download_categories ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Download/Get Steam Now Management</h2>
<form method="post">
<div style="display:flex;gap:20px;">
<?php foreach ($versions as $ver=>$label): ?>
    <label style="text-align:center;">
        <input type="radio" name="download_version" value="<?php echo $ver; ?>" <?php echo $ver==$current?'checked':''; ?>><br>
        <img src="images/downloadpage_thumbnails/<?php echo $ver; ?>.png" alt="<?php echo $label; ?>">
    </label>
<?php endforeach; ?>
</div>
<button type="submit" name="save_type" class="btn btn-primary" style="margin-top:10px;">Save Download page type</button>
</form>

<h3 style="margin-top:20px;">Download Categories</h3>
<table class="data-table" style="margin-top:10px;">
<tr><th>ID</th><th>Name</th><th>File Size</th><th>Action</th></tr>
<tr>
    <form method="post">
    <td>new</td>
    <td><input type="text" name="name"></td>
    <td><input type="text" name="file_size"></td>
    <td><button type="submit" name="save_cat" class="btn btn-small">Add</button></td>
    </form>
</tr>
<?php foreach ($cats as $c): ?>
<tr>
    <form method="post">
    <td><?php echo $c['id']; ?><input type="hidden" name="id" value="<?php echo $c['id']; ?>"></td>
    <td><input type="text" name="name" value="<?php echo htmlspecialchars($c['name']); ?>"></td>
    <td><input type="text" name="file_size" value="<?php echo htmlspecialchars($c['file_size']); ?>"></td>
    <td>
        <button type="submit" name="save_cat" class="btn btn-small">Save</button>
        <button type="submit" name="delete_cat" class="btn btn-small" onclick="return confirm('Delete?');">Delete</button>
    </td>
    </form>
</tr>
<?php endforeach; ?>
</table>
<?php include 'admin_footer.php'; ?>
