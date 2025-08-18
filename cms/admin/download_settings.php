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

if (isset($_POST['save_vis'])) {
    $db->prepare('DELETE FROM download_page_visibility WHERE theme=?')->execute([$theme]);
    if (isset($_POST['vis']) && is_array($_POST['vis'])) {
        $ins = $db->prepare('INSERT INTO download_page_visibility(theme,version,file_id) VALUES (?,?,?)');
        foreach ($_POST['vis'] as $fileId => $vers) {
            foreach ($vers as $ver => $on) {
                $ins->execute([$theme, (int)$ver, (int)$fileId]);
            }
        }
    }
    echo '<p>Visibility updated.</p>';
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
if (isset($_POST['save_sysreq'])) {
    $ver = (int)($_POST['sys_version'] ?? 0);
    $content = $_POST['sys_content'] ?? '';
    $stmt = $db->prepare('REPLACE INTO download_system_requirements(theme,version,content) VALUES(?,?,?)');
    $stmt->execute([$theme,$ver,$content]);
    echo '<p>System requirements saved.</p>';
}

$verNums = [];
foreach ($versions as $k => $label) {
    if (preg_match('/v(\d+)$/', $k, $m)) {
        $verNums[(int)$m[1]] = $label;
    }
}
$allFiles = $db->query('SELECT id,title FROM download_files ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
$visMap = [];
$vStmt = $db->prepare('SELECT file_id,version FROM download_page_visibility WHERE theme=?');
$vStmt->execute([$theme]);
foreach ($vStmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $visMap[$row['file_id']][$row['version']] = true;
}

$cats = $db->query('SELECT * FROM download_categories ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
$sysReqs = [];
$srStmt = $db->prepare('SELECT version,content FROM download_system_requirements WHERE theme=?');
$srStmt->execute([$theme]);
foreach ($srStmt->fetchAll(PDO::FETCH_ASSOC) as $sr) {
    $sysReqs[(int)$sr['version']] = $sr['content'];
}
reset($verNums);
$firstVer = key($verNums);
?>
<h2>Download/Get Steam Now Management</h2>
<form method="post">
<div style="display:flex;gap:20px;">
<?php foreach ($versions as $ver => $label):
    $thumb = $ver;
    if ($theme === '2003_v2' || $theme === '2004') {
        $thumb = preg_replace('/_v(\d+)$/', '_dlv$1', $ver);
    }
    ?>
    <label style="text-align:center;">
        <input type="radio" name="download_version" value="<?php echo $ver; ?>" <?php echo $ver == $current ? 'checked' : ''; ?>><br>
        <img src="images/downloadpage_thumbnails/<?php echo $thumb; ?>.png" alt="<?php echo $label; ?>">
    </label>
<?php endforeach; ?>
</div>
<button type="submit" name="save_type" class="btn btn-primary" style="margin-top:10px;">Save Download page type</button>
</form>

<h3 style="margin-top:20px;">File Visibility by Version</h3>
<form method="post">
<table class="data-table" style="margin-top:10px;">
<tr><th>File</th>
<?php foreach ($verNums as $num => $label): ?>
    <th><?php echo $label; ?></th>
<?php endforeach; ?>
</tr>
<?php foreach ($allFiles as $f): ?>
<tr>
    <td><?php echo htmlspecialchars($f['title']); ?></td>
    <?php foreach ($verNums as $num => $label): ?>
    <td style="text-align:center;"><input type="checkbox" name="vis[<?php echo $f['id']; ?>][<?php echo $num; ?>]" <?php echo isset($visMap[$f['id']][$num])?'checked':''; ?>></td>
    <?php endforeach; ?>
</tr>
<?php endforeach; ?>
</table>
<button type="submit" name="save_vis" class="btn btn-primary" style="margin-top:10px;">Save Visibility</button>
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

<h3 style="margin-top:20px;">System Requirements</h3>
<form method="post" id="sysreqForm">
<label>Version:
<select name="sys_version" id="sysreqVersion">
<?php foreach ($verNums as $num => $label): ?>
    <option value="<?php echo $num; ?>"><?php echo $label; ?></option>
<?php endforeach; ?>
</select>
</label><br>
<div id="sysReqBox" class="wysiwyg" contenteditable="true" style="margin-top:5px;">
<?php echo htmlspecialchars($sysReqs[$firstVer] ?? ''); ?>
</div>
<input type="hidden" name="sys_content" id="sysReqInput">
<button type="submit" name="save_sysreq" class="btn btn-primary" style="margin-top:10px;">Save System Requirements</button>
</form>
<script>
var sysReqData = <?php echo json_encode($sysReqs, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?>;
var box = $('#sysReqBox');
$('#sysreqVersion').on('change', function(){ box.html(sysReqData[$(this).val()] || ''); });
$('#sysreqForm').on('submit', function(){ $('#sysReqInput').val(box.html()); });
</script>
<style>
.wysiwyg{border:1px solid #ccc;min-height:100px;padding:4px;}
</style>
<?php include 'admin_footer.php'; ?>
