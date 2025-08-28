<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if(isset($_POST['upload']) && isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
    $name = basename($_FILES['file']['name']);
    $path = __DIR__.'/../content/media/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $path);
    $stmt = $db->prepare('INSERT INTO media(filename,uploaded) VALUES(?,NOW())');
    $stmt->execute([
        '/cms/content/media/'.$name
    ]);
    echo '<p>File uploaded.</p>';
}

if(isset($_POST['delete'])){
    $id = (int)$_POST['delete'];
    $row = $db->prepare('SELECT filename FROM media WHERE id=?');
    $row->execute([$id]);
    $file = $row->fetchColumn();
    if($file){
        $path = dirname(__DIR__).$file;
        if(file_exists($path)) unlink($path);
        $db->prepare('DELETE FROM media WHERE id=?')->execute([$id]);
    }
}

$rows = $db->query('SELECT * FROM media ORDER BY uploaded DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Media Library</h2>
<div class="upload-section" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px;">
    <button type="button" class="btn btn-primary" id="media-file-picker">
        Choose or Upload Media File
    </button>
    <div id="upload-status" style="margin-top: 10px;"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('media-file-picker').addEventListener('click', function() {
        openFilePickerForMedia('media', function(selectedPath) {
            document.getElementById('upload-status').innerHTML = 
                '<div style="color: green;">✓ File uploaded and registered: ' + selectedPath + '</div>';
        }, { 
            allowedTypes: ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'mp3', 'pdf', 'zip'] 
        });
    });
});
</script>
<table border="1" cellpadding="2">
<tr><th>File</th><th>Uploaded</th><th>Action</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><a href="<?php echo htmlspecialchars($r['filename']); ?>" target="_blank"><?php echo htmlspecialchars(basename($r['filename'])); ?></a></td>
<td><?php echo htmlspecialchars($r['uploaded']); ?></td>
<td>
<form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $r['id']; ?>"><input type="submit" value="Delete"></form>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php include 'admin_footer.php'; ?>
