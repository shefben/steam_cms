<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$theme = cms_get_setting('theme','default');
if(isset($_POST['save'])){
    cms_set_setting('theme', trim($_POST['theme']));
    $theme = trim($_POST['theme']);
    echo '<p>Theme updated.</p>';
}
?>
<h2>Theme Configuration</h2>
<form method="post">
Theme: <input type="text" name="theme" value="<?php echo htmlspecialchars($theme); ?>"><br><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
