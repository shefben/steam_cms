<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');

$theme = cms_get_setting('theme','2004');
$db = cms_get_db();

$versions = [];
$defaultVer = '';
if ($theme === '2003_v2') {
    $versions = [
        '2003_v2_dlv1' => 'Version 1',
        '2003_v2_dlv2' => 'Version 2'
    ];
    $defaultVer = '2003_v2_dlv2';
} elseif ($theme === '2004') {
    $versions = [
        '2004_dlv1' => 'Version 1',
        '2004_dlv2' => 'Version 2',
        '2004_dlv3' => 'Version 3'
    ];
    $defaultVer = '2004_dlv3';
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

if (isset($_POST['save_links'])) {
    $db->prepare('DELETE FROM download_links WHERE version=?')->execute([$current]);
    if (isset($_POST['links']) && is_array($_POST['links'])) {
        $stmt = $db->prepare('INSERT INTO download_links(version,category,label,url,ord) VALUES(?,?,?,?,?)');
        $ord = 1;
        foreach ($_POST['links'] as $row) {
            $url = trim($row['url'] ?? '');
            if ($url === '') continue;
            $stmt->execute([$current, trim($row['category'] ?? ''), trim($row['label'] ?? ''), $url, $ord++]);
        }
    }
    echo '<p>Links updated.</p>';
}

$stmt = $db->prepare('SELECT * FROM download_links WHERE version=? ORDER BY ord,id');
$stmt->execute([$current]);
$links = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<form method="post" style="margin-top:20px;">
<table id="linksTable" class="data-table">
<tr><th>Category</th><th>Label</th><th>URL</th><th></th></tr>
<?php foreach ($links as $i=>$row): ?>
<tr>
<td><input type="text" name="links[<?php echo $i; ?>][category]" value="<?php echo htmlspecialchars($row['category']); ?>"></td>
<td><input type="text" name="links[<?php echo $i; ?>][label]" value="<?php echo htmlspecialchars($row['label']); ?>"></td>
<td><input type="text" name="links[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($row['url']); ?>" style="width:100%;"></td>
<td><button type="button" class="remove">Remove</button></td>
</tr>
<?php endforeach; ?>
</table>
<button type="button" id="addLink">Add Link</button>
<input type="submit" name="save_links" value="Save Links" class="btn btn-primary">
</form>
<script>
$(function(){
    $('#addLink').on('click', function(){
        var idx = $('#linksTable tr').length - 1;
        var row = `<tr>
<td><input type="text" name="links[${idx}][category]"></td>
<td><input type="text" name="links[${idx}][label]"></td>
<td><input type="text" name="links[${idx}][url]" style="width:100%;"></td>
<td><button type="button" class="remove">Remove</button></td>
</tr>`;
        $('#linksTable').append(row);
    });
    $('#linksTable').on('click','.remove',function(){
        $(this).closest('tr').remove();
    });
});
</script>
<?php include 'admin_footer.php'; ?>
