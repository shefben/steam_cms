<?php
$upload_msg = '';
require_once 'admin_header.php';
require_once __DIR__ . '/../theme_config.php';
cms_require_permission('manage_settings');
$theme = cms_get_setting('theme','2004');
$show = cms_get_setting('support2003_show','1');
$html = cms_get_setting('support2003_html','<div class="notification"><b>:: REQUIRED UPDATE AVAILABLE</b></div>');
$auto_theme = cms_get_setting('auto_theme','0');
$themes = [];
foreach(glob(dirname(__DIR__,2).'/themes/*', GLOB_ONLYDIR) as $dir){
    $name = basename($dir);
    // Skip admin themes and forum themes
    if(substr($name,-6) == '_admin') continue;
    if(substr($name,-6) == '_forum') continue;
    $themes[] = $name;
}
sort($themes);

// Handle AJAX auto_theme toggle request
if(isset($_POST['ajax_auto_theme']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => '', 'enabled' => false];

    $enabled = isset($_POST['auto_theme']) && $_POST['auto_theme'] === '1';
    cms_set_setting('auto_theme', $enabled ? '1' : '0');
    $response['success'] = true;
    $response['enabled'] = $enabled;
    $response['message'] = $enabled ? 'Auto-theme enabled' : 'Auto-theme disabled';

    echo json_encode($response);
    exit;
}

// Handle AJAX save request
if(isset($_POST['ajax_save']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];

    if(isset($_POST['theme'])){
        $newTheme = trim($_POST['theme']);
        if(in_array($newTheme, $themes)){
            cms_set_setting('theme', $newTheme);
            if($newTheme === '2003_v1'){
                $showVal = isset($_POST['support2003_show']) ? '1' : '0';
                $htmlVal = $_POST['support2003_html'] ?? '';
                cms_set_setting('support2003_show', $showVal);
                cms_set_setting('support2003_html', $htmlVal);
            }
            cms_save_theme_settings($newTheme, $_POST);
            require_once __DIR__.'/../update_htaccess.php';
            cms_update_htaccess();
            $response['success'] = true;
            $response['message'] = 'Theme saved successfully!';
        } else {
            $response['message'] = 'Invalid theme selected.';
        }
    } else {
        $response['message'] = 'No theme selected.';
    }

    echo json_encode($response);
    exit;
}

if(isset($_POST['upload']) && isset($_FILES['theme_zip']) && is_uploaded_file($_FILES['theme_zip']['tmp_name'])){
    $file = $_FILES['theme_zip'];
    if(strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'zip'){
        $upload_msg = '<p class="error">Only .zip files are allowed.</p>';
    }else{
        $base = pathinfo($file['name'], PATHINFO_FILENAME);
        $name = preg_replace('/[^a-zA-Z0-9_-]/','', $base);
        if($name === ''){
            $upload_msg = '<p class="error">Invalid file name.</p>';
        }else{
            $dest = dirname(__DIR__,2).'/themes/'.$name;
            if(is_dir($dest)){
                $upload_msg = '<p class="error">Theme already exists.</p>';
            }else{
                mkdir($dest, 0777, true);
                $zip = new ZipArchive();
                if($zip->open($file['tmp_name']) === true){
                    $zip->extractTo($dest);
                    $zip->close();
                    $valid = false;
                    foreach (['layouts', 'layout'] as $dir) {
                        if (is_dir($dest.'/' . $dir) && glob($dest.'/' . $dir . '/*.twig')) {
                            $valid = true;
                            break;
                        }
                    }
                    $valid = $valid && is_dir($dest.'/assets');
                    if($valid){
                        cms_install_theme_settings($name);
                        cms_refresh_themes();
                        $themes = cms_get_themes();
                        $upload_msg = '<p>Theme uploaded successfully.</p>';
                    }else{
                        $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dest, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
                        foreach($iter as $f){
                            if($f->isDir()) rmdir($f->getPathname());
                            else unlink($f->getPathname());
                        }
                        rmdir($dest);
                        $upload_msg = '<p class="error">Archive missing templates or assets.</p>';
                    }
                }else{
                    rmdir($dest);
                    $upload_msg = '<p class="error">Could not open archive.</p>';
                }
            }
        }
    }
}
?>
<style>
#theme-save-message {
    display: none;
    background: #155724;
    color: #fff;
    padding: 12px 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    font-weight: bold;
}
#theme-save-message.show {
    display: block;
}
.auto-theme-frame {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px 20px;
    margin-bottom: 25px;
    background: #f9f9f9;
}
.auto-theme-title {
    margin: 0 0 10px 0;
    font-size: 1.1em;
}
.auto-theme-status-enabled {
    font-weight: bold;
    color: #28a745;
}
.auto-theme-status-disabled {
    font-weight: bold;
    color: #dc3545;
}
.auto-theme-checkbox-label {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    font-size: 1em;
}
.auto-theme-checkbox-label input[type="checkbox"] {
    margin-right: 8px;
    transform: scale(1.2);
    cursor: pointer;
}
.theme-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.theme-table th, .theme-table td {
    padding: 10px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.theme-table th {
    background: #f5f5f5;
    font-weight: bold;
}
.theme-table tr:hover {
    background: #fafafa;
}
.theme-table input[type="radio"] {
    cursor: pointer;
    transform: scale(1.2);
}
.theme-table .theme-name {
    font-size: 1.1em;
}
</style>

<h2>Theme Configuration</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Configure the active site theme.</p>

<div id="theme-save-message"></div>

<div class="auto-theme-frame">
    <p class="auto-theme-title">
        Use STMServer for auto-theme:
        (<span id="auto-theme-status" class="<?php echo $auto_theme === '1' ? 'auto-theme-status-enabled' : 'auto-theme-status-disabled'; ?>">
            <?php echo $auto_theme === '1' ? 'ENABLED' : 'DISABLED'; ?>
        </span>)
    </p>
    <label class="auto-theme-checkbox-label">
        <input type="checkbox" id="auto-theme-checkbox" <?php echo $auto_theme === '1' ? 'checked' : ''; ?>>
        Use STMServer to automatically change themes
    </label>
</div>

<?php echo $upload_msg; ?>

<form method="post" enctype="multipart/form-data" style="margin-bottom: 30px;">
    Upload theme (.zip): <input type="file" name="theme_zip" accept=".zip" required>
    <input type="submit" name="upload" value="Upload">
</form>

<h3>Available Themes</h3>
<form id="theme-form">
    <table class="theme-table data-table">
        <thead>
            <tr>
                <th style="width: 80px;">Enabled</th>
                <th>Theme Title</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($themes as $t): ?>
            <tr>
                <td>
                    <input type="radio" name="theme" value="<?php echo htmlspecialchars($t); ?>" <?php echo $t === $theme ? 'checked' : ''; ?>>
                </td>
                <td class="theme-name"><?php echo htmlspecialchars($t); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="support-options" style="display: <?php echo $theme === '2003_v1' ? 'block' : 'none'; ?>;">
        <h3>2003 Support Notification</h3>
        <label><input type="checkbox" name="support2003_show" value="1" <?php echo $show === '1' ? 'checked' : ''; ?>> Show notification</label><br><br>
        <textarea name="support2003_html" style="width:100%;height:200px;"><?php echo htmlspecialchars($html); ?></textarea><br><br>
    </div>

    <button type="button" id="save-theme-btn" class="btn btn-primary">Save</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('theme-form');
    var saveBtn = document.getElementById('save-theme-btn');
    var messageDiv = document.getElementById('theme-save-message');
    var supportOptions = document.getElementById('support-options');
    var autoThemeCheckbox = document.getElementById('auto-theme-checkbox');
    var autoThemeStatus = document.getElementById('auto-theme-status');

    // Auto-theme checkbox change handler
    autoThemeCheckbox.addEventListener('change', function() {
        var formData = new FormData();
        formData.append('ajax_auto_theme', '1');
        formData.append('auto_theme', this.checked ? '1' : '0');

        fetch('theme.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                // Update the status text and styling
                if (data.enabled) {
                    autoThemeStatus.textContent = 'ENABLED';
                    autoThemeStatus.className = 'auto-theme-status-enabled';
                } else {
                    autoThemeStatus.textContent = 'DISABLED';
                    autoThemeStatus.className = 'auto-theme-status-disabled';
                }

                // Show success message briefly
                messageDiv.textContent = data.message;
                messageDiv.style.background = '#155724';
                messageDiv.className = 'show';
                setTimeout(function() {
                    messageDiv.className = '';
                }, 3000);
            } else {
                // Revert checkbox on failure
                autoThemeCheckbox.checked = !autoThemeCheckbox.checked;
                messageDiv.textContent = 'Failed to save auto-theme setting.';
                messageDiv.style.background = '#dc3545';
                messageDiv.className = 'show';
            }
        })
        .catch(function(error) {
            // Revert checkbox on error
            autoThemeCheckbox.checked = !autoThemeCheckbox.checked;
            messageDiv.textContent = 'An error occurred while saving.';
            messageDiv.style.background = '#dc3545';
            messageDiv.className = 'show';
        });
    });

    // Show/hide 2003 support options based on selected theme
    form.querySelectorAll('input[name="theme"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (supportOptions) {
                supportOptions.style.display = this.value === '2003_v1' ? 'block' : 'none';
            }
        });
    });

    // Save button click handler
    saveBtn.addEventListener('click', function() {
        var formData = new FormData(form);
        formData.append('ajax_save', '1');

        // Handle unchecked checkbox
        var checkbox = form.querySelector('input[name="support2003_show"]');
        if (checkbox && !checkbox.checked) {
            formData.set('support2003_show', '0');
        }

        fetch('theme.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            messageDiv.textContent = data.message;
            messageDiv.className = data.success ? 'show' : 'show error';
            if (!data.success) {
                messageDiv.style.background = '#dc3545';
            } else {
                messageDiv.style.background = '#155724';
            }

            // Auto-hide message after 5 seconds
            setTimeout(function() {
                messageDiv.className = '';
            }, 5000);
        })
        .catch(function(error) {
            messageDiv.textContent = 'An error occurred while saving.';
            messageDiv.style.background = '#dc3545';
            messageDiv.className = 'show';
        });
    });
});
</script>

<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
