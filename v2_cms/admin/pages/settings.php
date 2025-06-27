<?php
// Settings management page

$media_model = new MediaModel($db);
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'upload_logo':
                try {
                    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
                        // Validate image
                        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($_FILES['logo']['type'], $allowed_types)) {
                            throw new Exception('Only JPEG, PNG, and GIF files are allowed.');
                        }
                        
                        // Upload file
                        $media_id = $media_model->upload($_FILES['logo'], $current_theme, $_SESSION['admin_user']['id']);
                        
                        if ($media_id) {
                            // Get uploaded file info
                            $uploaded_file = $db->queryOne("SELECT * FROM media_files WHERE id = ?", [$media_id]);
                            
                            // Set as logo for current theme
                            $cms->setSetting('logo_url', '/' . $uploaded_file['file_path'], 'image');
                            $message = '<div class="alert alert-success">Logo uploaded successfully!</div>';
                        } else {
                            throw new Exception('Failed to upload logo.');
                        }
                    } else {
                        throw new Exception('Please select a valid image file.');
                    }
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update_settings':
                try {
                    $settings = [
                        'site_title' => $_POST['site_title'],
                        'meta_description' => $_POST['meta_description'],
                        'footer_text' => $_POST['footer_text'],
                        'analytics_code' => $_POST['analytics_code'],
                        'maintenance_mode' => isset($_POST['maintenance_mode']) ? '1' : '0',
                        'exclude_header_pages' => $_POST['exclude_header_pages'],
                        'exclude_footer_pages' => $_POST['exclude_footer_pages'],
                        'exclude_navigation_pages' => $_POST['exclude_navigation_pages']
                    ];
                    
                    foreach ($settings as $key => $value) {
                        $cms->setSetting($key, $value);
                    }
                    
                    $message = '<div class="alert alert-success">Settings updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'reset_logo':
                try {
                    $cms->setSetting('logo_url', '/images/steam_logo.gif', 'image');
                    $message = '<div class="alert alert-success">Logo reset to default!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get current settings
$current_logo = $cms->getSetting('logo_url', '/images/steam_logo.gif');
$site_title = $cms->getSetting('site_title', 'Steam');
$meta_description = $cms->getSetting('meta_description', '');
$footer_text = $cms->getSetting('footer_text', '');
$analytics_code = $cms->getSetting('analytics_code', '');
$maintenance_mode = $cms->getSetting('maintenance_mode', '0');
$exclude_header_pages = $cms->getSetting('exclude_header_pages', '');
$exclude_footer_pages = $cms->getSetting('exclude_footer_pages', '');
$exclude_navigation_pages = $cms->getSetting('exclude_navigation_pages', '');

// Get theme config
$theme_config = $cms->getThemeConfig();
?>

<?= $message ?>

<!-- Logo Management -->
<div class="card">
    <div class="card-header">
        <h3>Logo Management</h3>
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 30px; align-items: flex-start;">
            <div style="flex: 1;">
                <h4>Current Logo</h4>
                <div style="border: 2px solid #ddd; padding: 20px; text-align: center; margin-bottom: 20px; background: #f8f9fa;">
                    <?php if ($current_logo): ?>
                        <img src="<?= htmlspecialchars($current_logo) ?>" alt="Current Logo" 
                             style="max-width: 300px; max-height: 100px; object-fit: contain;">
                        <br><br>
                        <small style="color: #7f8c8d;"><?= htmlspecialchars($current_logo) ?></small>
                    <?php else: ?>
                        <p style="color: #7f8c8d;">No logo set</p>
                    <?php endif; ?>
                </div>
                
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="reset_logo">
                    <button type="submit" class="btn btn-warning btn-small" 
                            onclick="return confirm('Reset to default logo?')">
                        Reset to Default
                    </button>
                </form>
            </div>
            
            <div style="flex: 1;">
                <h4>Upload New Logo</h4>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="upload_logo">
                    
                    <div class="file-upload">
                        <input type="file" id="logo" name="logo" accept="image/*" required>
                        <label for="logo" class="file-upload-label">
                            📁 Choose Logo File
                        </label>
                        <p style="margin-top: 10px; font-size: 12px; color: #7f8c8d;">
                            Supported formats: JPEG, PNG, GIF<br>
                            Recommended size: 300x100px or smaller
                        </p>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">
                        Upload Logo
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- General Settings -->
<div class="card">
    <div class="card-header">
        <h3>General Settings</h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="update_settings">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="site_title">Site Title</label>
                    <input type="text" id="site_title" name="site_title" class="form-control" 
                           value="<?= htmlspecialchars($site_title) ?>">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" id="meta_description" name="meta_description" class="form-control" 
                           value="<?= htmlspecialchars($meta_description) ?>"
                           placeholder="Brief description for search engines...">
                </div>
            </div>
            
            <div class="form-group">
                <label for="footer_text">Footer Text</label>
                <textarea id="footer_text" name="footer_text" class="form-control" rows="3"
                          placeholder="Copyright and legal information..."><?= htmlspecialchars($footer_text) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="analytics_code">Analytics Code (Google Analytics, etc.)</label>
                <textarea id="analytics_code" name="analytics_code" class="form-control" rows="5"
                          placeholder="Paste your analytics tracking code here..."><?= htmlspecialchars($analytics_code) ?></textarea>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="maintenance_mode" value="1" 
                           <?= $maintenance_mode === '1' ? 'checked' : '' ?>>
                    Maintenance Mode (temporarily disable frontend)
                </label>
            </div>
            
            <button type="submit" class="btn btn-success">Update Settings</button>
        </form>
    </div>
</div>

<!-- Page Display Options -->
<div class="card">
    <div class="card-header">
        <h3>Page Display Options</h3>
        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
            Configure which pages should exclude headers, footers, or navigation elements
        </p>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="update_settings">
            
            <!-- Copy all other settings as hidden fields -->
            <input type="hidden" name="site_title" value="<?= htmlspecialchars($site_title) ?>">
            <input type="hidden" name="meta_description" value="<?= htmlspecialchars($meta_description) ?>">
            <input type="hidden" name="footer_text" value="<?= htmlspecialchars($footer_text) ?>">
            <input type="hidden" name="analytics_code" value="<?= htmlspecialchars($analytics_code) ?>">
            <?php if ($maintenance_mode === '1'): ?>
                <input type="hidden" name="maintenance_mode" value="1">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="exclude_header_pages">Exclude Header Pages</label>
                <textarea id="exclude_header_pages" name="exclude_header_pages" class="form-control" rows="4"
                          placeholder="Enter page URLs or slugs (one per line) where the header should be excluded&#10;Example:&#10;/custom-page&#10;index.php?page=special&#10;/about"><?= htmlspecialchars($exclude_header_pages) ?></textarea>
                <small style="color: #7f8c8d;">Pages listed here will not display the header section</small>
            </div>
            
            <div class="form-group">
                <label for="exclude_footer_pages">Exclude Footer Pages</label>
                <textarea id="exclude_footer_pages" name="exclude_footer_pages" class="form-control" rows="4"
                          placeholder="Enter page URLs or slugs (one per line) where the footer should be excluded&#10;Example:&#10;/landing-page&#10;index.php?page=popup&#10;/fullscreen"><?= htmlspecialchars($exclude_footer_pages) ?></textarea>
                <small style="color: #7f8c8d;">Pages listed here will not display the footer section</small>
            </div>
            
            <div class="form-group">
                <label for="exclude_navigation_pages">Exclude Navigation Pages (Keep Logo Only)</label>
                <textarea id="exclude_navigation_pages" name="exclude_navigation_pages" class="form-control" rows="4"
                          placeholder="Enter page URLs or slugs (one per line) where navigation should be hidden but logo kept&#10;Example:&#10;/minimal-page&#10;index.php?page=clean&#10;/simple"><?= htmlspecialchars($exclude_navigation_pages) ?></textarea>
                <small style="color: #7f8c8d;">Pages listed here will show the header with logo but hide navigation links/buttons</small>
            </div>
            
            <button type="submit" class="btn btn-success">Update Page Display Options</button>
        </form>
    </div>
</div>

<!-- Theme Information -->
<div class="card">
    <div class="card-header">
        <h3>Current Theme Information</h3>
    </div>
    <div class="card-body">
        <?php if ($theme_config): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Theme Name</div>
                    <div class="stat-number" style="font-size: 18px;">
                        <?= htmlspecialchars($theme_config['display_name']) ?>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Era</div>
                    <div class="stat-number" style="font-size: 18px;">
                        <?= htmlspecialchars($theme_config['theme']) ?>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Layout Type</div>
                    <div class="stat-number" style="font-size: 18px;">
                        <?= ucfirst($theme_config['layout_type']) ?>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Navigation</div>
                    <div class="stat-number" style="font-size: 18px;">
                        <?= $theme_config['has_navigation'] ? 'Enabled' : 'Disabled' ?>
                    </div>
                </div>
            </div>
            
            <p><strong>Description:</strong> <?= htmlspecialchars($theme_config['description']) ?></p>
            <p><strong>Header Style:</strong> <?= ucfirst($theme_config['header_style']) ?></p>
            <p><strong>Color Scheme:</strong> <?= ucfirst($theme_config['color_scheme']) ?></p>
        <?php else: ?>
            <p>No theme configuration found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Advanced Settings -->
<div class="card">
    <div class="card-header">
        <h3>Advanced Settings</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <strong>Database Information:</strong><br>
            • Total News Articles: <?= $db->queryOne("SELECT COUNT(*) as count FROM news_articles")['count'] ?><br>
            • Total FAQ Entries: <?= $db->queryOne("SELECT COUNT(*) as count FROM faq_entries")['count'] ?><br>
            • Total Navigation Links: <?= $db->queryOne("SELECT COUNT(*) as count FROM navigation_links")['count'] ?><br>
            • Total Media Files: <?= $db->queryOne("SELECT COUNT(*) as count FROM media_files")['count'] ?><br>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="?action=backup" class="btn btn-warning">Export Database Backup</a>
            <a href="?action=import" class="btn btn-primary">Import Data</a>
        </div>
    </div>
</div>

<script>
// File upload preview
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const label = document.querySelector('.file-upload-label');
        label.textContent = file.name;
        
        // Show preview if it's an image
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('logo-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'logo-preview';
                    preview.style.cssText = 'max-width: 200px; max-height: 100px; margin-top: 10px; border: 1px solid #ddd; padding: 5px;';
                    document.querySelector('.file-upload').appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
