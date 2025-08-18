<?php
$upload_msg = '';
require_once 'admin_header.php';
require_once __DIR__ . '/../theme_config.php';
cms_require_permission('manage_settings');
$theme = cms_get_setting('theme','2004');
$show = cms_get_setting('support2003_show','1');
$html = cms_get_setting('support2003_html','<div class="notification"><b>:: REQUIRED UPDATE AVAILABLE</b></div>');
$themes = [];
foreach(glob(dirname(__DIR__,2).'/themes/*', GLOB_ONLYDIR) as $dir){
    $name = basename($dir);
    if(substr($name,-6) == '_admin') continue;
    $themes[] = $name;
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
                mkdir($dest, 0755, true);
                $zip = new ZipArchive();
                if ($zip->open($file['tmp_name']) === true) {
                    $bad = false;
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $fn = $zip->getNameIndex($i);
                        if (str_contains($fn, '..') || str_starts_with($fn, '/')) {
                            $bad = true;
                            break;
                        }
                    }
                    if ($bad) {
                        $zip->close();
                        rmdir($dest);
                        $upload_msg = '<p class="error">Archive contains invalid paths.</p>';
                    } else {
                        $zip->extractTo($dest);
                        $zip->close();
                        $valid = false;
                        foreach (['layouts', 'layout'] as $dir) {
                            if (is_dir($dest . '/' . $dir) && glob($dest . '/' . $dir . '/*.twig')) {
                                $valid = true;
                                break;
                            }
                        }
                        $valid = $valid && is_dir($dest . '/assets');
                        if ($valid) {
                            cms_install_theme_settings($name);
                            cms_refresh_themes();
                            $themes = cms_get_themes();
                            $upload_msg = '<p>Theme uploaded successfully.</p>';
                        } else {
                            $iter = new RecursiveIteratorIterator(
                                new RecursiveDirectoryIterator($dest, FilesystemIterator::SKIP_DOTS),
                                RecursiveIteratorIterator::CHILD_FIRST
                            );
                            foreach ($iter as $f) {
                                if ($f->isDir()) {
                                    rmdir($f->getPathname());
                                } else {
                                    unlink($f->getPathname());
                                }
                            }
                            rmdir($dest);
                            $upload_msg = '<p class="error">Archive missing templates or assets.</p>';
                        }
                    }
                } else {
                    rmdir($dest);
                    $upload_msg = '<p class="error">Could not open archive.</p>';
                }
            }
        }
    }
}
if(isset($_POST['save'])){
    cms_set_setting('theme', trim($_POST['theme']));
    $theme = trim($_POST['theme']);
    if($theme === '2003_v1'){
        $show = isset($_POST['support2003_show']) ? '1' : '0';
        $html = $_POST['support2003_html'] ?? '';
        cms_set_setting('support2003_show',$show);
        cms_set_setting('support2003_html',$html);
    }
    cms_save_theme_settings($theme, $_POST);
    require_once __DIR__.'/../update_htaccess.php';
    cms_update_htaccess();
    $saved = true;
}
?>
<h2>Theme Configuration</h2>
<?php echo $upload_msg; ?>
<form method="post" enctype="multipart/form-data">
Upload theme (.zip): <input type="file" name="theme_zip" accept=".zip" required>
<input type="submit" name="upload" value="Upload">
</form>
<form method="post">
Theme: <select name="theme">
<?php foreach($themes as $t): ?>
    <option value="<?php echo htmlspecialchars($t); ?>" <?php echo $t==$theme?'selected':''; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select><br><br>
<div id="support-options">
<h3>2003 Support Notification</h3>
<label><input type="checkbox" name="support2003_show" value="1" <?php echo $show==='1'?'checked':''; ?>> Show notification</label><br><br>
<textarea name="support2003_html" style="width:100%;height:200px;"><?php echo htmlspecialchars($html); ?></textarea><br>
</div>
<input type="submit" name="save" value="Save">
</form>
<?php if(!empty($saved)): ?>
<script>showNotify('OK');</script>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var select=document.querySelector('select[name="theme"]');
    var opt=document.getElementById('support-options');
    function update(){
        if(!opt) return;
        opt.style.display=select.value==='2003_v1'?'block':'none';
    }
    select.addEventListener('change',update);
    update();
});
</script>
<script>
function showNotify(msg){
  var n=document.createElement('div');
  n.className='cms-notify';
  n.textContent=msg;
  document.body.appendChild(n);
  requestAnimationFrame(function(){n.classList.add('show');});
  setTimeout(function(){n.classList.remove('show');},3000);
  setTimeout(function(){n.remove();},3500);
}
</script>
<style>
.cms-notify{position:fixed;right:20px;bottom:-50px;background:#333;color:#fff;padding:10px 20px;border-radius:4px;transition:bottom .3s;}
.cms-notify.show{bottom:20px;}
</style>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
