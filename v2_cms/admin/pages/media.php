<?php
// Media management page

$media_model = new MediaModel($db);
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'upload':
                try {
                    if (isset($_FILES['files'])) {
                        $uploaded_count = 0;
                        $files = $_FILES['files'];
                        
                        // Handle multiple file uploads
                        if (is_array($files['name'])) {
                            for ($i = 0; $i < count($files['name']); $i++) {
                                if ($files['error'][$i] === 0) {
                                    $file = [
                                        'name' => $files['name'][$i],
                                        'tmp_name' => $files['tmp_name'][$i],
                                        'size' => $files['size'][$i],
                                        'type' => $files['type'][$i],
                                        'error' => $files['error'][$i]
                                    ];
                                    
                                    if ($media_model->upload($file, $current_theme, $_SESSION['admin_user']['id'])) {
                                        $uploaded_count++;
                                    }
                                }
                            }
                        } else {
                            if ($files['error'] === 0) {
                                if ($media_model->upload($files, $current_theme, $_SESSION['admin_user']['id'])) {
                                    $uploaded_count = 1;
                                }
                            }
                        }
                        
                        if ($uploaded_count > 0) {
                            $message = '<div class="alert alert-success">' . $uploaded_count . ' file(s) uploaded successfully!</div>';
                        } else {
                            $message = '<div class="alert alert-danger">No files were uploaded. Please check file types and sizes.</div>';
                        }
                    }
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Upload failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete':
                try {
                    $id = $_POST['id'];
                    $media_model->delete($id);
                    $message = '<div class="alert alert-success">File deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Delete failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get media files
$all_media = isset($_GET['all']) ? true : false;
$media_files = $media_model->getByTheme($all_media ? null : $current_theme);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="toggleUploadForm()">Upload Files</button>
    <a href="?action=media&theme=<?= $current_theme ?>&all=1" 
       class="btn <?= $all_media ? 'btn-success' : 'btn-warning' ?>">
        <?= $all_media ? 'Showing All Files' : 'Show All Files' ?>
    </a>
    <?php if ($all_media): ?>
        <a href="?action=media&theme=<?= $current_theme ?>" class="btn btn-warning">Show Theme Files Only</a>
    <?php endif; ?>
</div>

<!-- Upload Form -->
<div id="upload-form" class="card" style="display: none;">
    <div class="card-header">
        <h3>Upload Media Files</h3>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="upload">
            
            <div class="file-upload">
                <input type="file" id="files" name="files[]" multiple accept="image/*,application/pdf,.txt,.doc,.docx">
                <label for="files" class="file-upload-label">
                    📁 Choose Files (Multiple Selection Supported)
                </label>
                <p style="margin-top: 10px; font-size: 12px; color: #7f8c8d;">
                    Supported formats: Images (JPG, PNG, GIF), PDF, Text files<br>
                    Maximum file size: 10MB per file<br>
                    Files will be associated with theme: <strong><?= htmlspecialchars($current_theme) ?></strong>
                </p>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Upload Files</button>
                <button type="button" class="btn btn-danger" onclick="toggleUploadForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Media Grid -->
<div class="card">
    <div class="card-header">
        <h3>Media Files <?= $all_media ? '(All Themes)' : 'for ' . htmlspecialchars($current_theme) ?></h3>
    </div>
    <div class="card-body">
        <?php if (empty($media_files)): ?>
            <p>No media files found. <a href="#" onclick="toggleUploadForm()">Upload your first file!</a></p>
        <?php else: ?>
            <div class="media-grid">
                <?php foreach ($media_files as $file): ?>
                    <div class="media-item">
                        <div class="media-preview">
                            <?php if ($file['file_type'] === 'image'): ?>
                                <img src="<?= htmlspecialchars($file['file_path']) ?>" alt="<?= htmlspecialchars($file['original_name']) ?>">
                            <?php else: ?>
                                <div style="font-size: 40px; color: #7f8c8d;">
                                    <?php
                                    switch ($file['file_type']) {
                                        case 'document': echo '📄'; break;
                                        default: echo '📁'; break;
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="media-info">
                            <div class="media-filename"><?= htmlspecialchars($file['original_name']) ?></div>
                            <div class="media-meta">
                                <?= number_format($file['file_size'] / 1024, 1) ?> KB • 
                                <?= date('M j, Y', strtotime($file['created_at'])) ?>
                                <?php if ($file['theme']): ?>
                                    <br>Theme: <?= htmlspecialchars($file['theme']) ?>
                                <?php endif; ?>
                            </div>
                            <div style="margin-top: 10px;">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($file['file_path']) ?>" 
                                       readonly onclick="this.select()" style="font-size: 11px;">
                                <div style="margin-top: 8px;">
                                    <button class="btn btn-small btn-primary" onclick="copyToClipboard('<?= htmlspecialchars($file['file_path']) ?>')">Copy URL</button>
                                    <form method="POST" style="display: inline;" 
                                          onsubmit="return confirm('Are you sure you want to delete this file?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $file['id'] ?>">
                                        <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleUploadForm() {
    const form = document.getElementById('upload-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Create temporary notification
        const notification = document.createElement('div');
        notification.textContent = 'Copied to clipboard!';
        notification.style.cssText = 'position:fixed;top:20px;right:20px;background:#27ae60;color:white;padding:10px;border-radius:4px;z-index:9999;';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard');
    });
}

// File upload preview
document.getElementById('files').addEventListener('change', function(e) {
    const files = e.target.files;
    const label = document.querySelector('.file-upload-label');
    
    if (files.length > 0) {
        if (files.length === 1) {
            label.textContent = files[0].name;
        } else {
            label.textContent = files.length + ' files selected';
        }
    } else {
        label.textContent = '📁 Choose Files (Multiple Selection Supported)';
    }
});
</script>
