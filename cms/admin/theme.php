<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$theme = cms_get_setting('theme','default');
$themes = [];
foreach(glob(dirname(__DIR__,2).'/themes/*', GLOB_ONLYDIR) as $dir){
    $name = basename($dir);
    if(substr($name,-6) == '_admin') continue;
    $themes[] = $name;
}
if(isset($_POST['save'])){
    cms_set_setting('theme', trim($_POST['theme']));
    $theme = trim($_POST['theme']);
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
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
