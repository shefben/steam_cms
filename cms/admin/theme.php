<?php
require_once 'admin_header.php';
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
if(isset($_POST['save'])){
    cms_set_setting('theme', trim($_POST['theme']));
    $theme = trim($_POST['theme']);
    if(strpos($theme,'2003')===0){
        $show = isset($_POST['support2003_show']) ? '1' : '0';
        $html = $_POST['support2003_html'] ?? '';
        cms_set_setting('support2003_show',$show);
        cms_set_setting('support2003_html',$html);
    }
    echo '<p>Theme updated.</p>';
}
?>
<h2>Theme Configuration</h2>
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
<script>
document.addEventListener('DOMContentLoaded',function(){
    var select=document.querySelector('select[name="theme"]');
    var opt=document.getElementById('support-options');
    function update(){
        if(!opt) return;
        opt.style.display=select.value.startsWith('2003')?'block':'none';
    }
    select.addEventListener('change',update);
    update();
});
</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
