<?php
require_once 'admin_header.php';
require_once __DIR__.'/../template_engine.php';
cms_require_permission('manage_settings');
$gzip = cms_get_setting('gzip','0');
$cache = cms_get_setting('enable_cache','0');

if(isset($_POST['save'])){
    $gzip = isset($_POST['gzip'])?'1':'0';
    $cache = isset($_POST['cache'])?'1':'0';
    cms_set_setting('gzip',$gzip);
    cms_set_setting('enable_cache',$cache);
    if(isset($_POST['clear_cache'])){
        foreach(glob(__DIR__.'/../cache/*.html') as $f) unlink($f);
        cms_clear_twig_cache();
        cms_clear_runtime_caches();
        cms_touch_cache_version();
    }
    echo '<p>Settings saved.</p>';
}
?>
<h2>Performance Settings</h2>
<form method="post">
<label><input type="checkbox" name="gzip" <?php if($gzip==='1') echo 'checked'; ?>> Enable gzip compression</label><br>
<label><input type="checkbox" name="cache" <?php if($cache==='1') echo 'checked'; ?>> Enable page caching</label><br>
<label><input type="checkbox" name="clear_cache" value="1"> Clear cache on save</label><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
