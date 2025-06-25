<?php
require_once 'admin_header.php';
$footer = cms_get_setting('footer_html','');
if(isset($_POST['save'])){
    cms_set_setting('footer_html', $_POST['footer']);
    $footer = $_POST['footer'];
}
?>
<h2>Edit Footer</h2>
<form method="post">
<textarea name="footer" style="width:100%;height:200px;"><?php echo htmlspecialchars($footer); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
