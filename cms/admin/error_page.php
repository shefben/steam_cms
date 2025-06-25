<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$html = cms_get_setting('error_html','');
if(isset($_POST['save'])){
    $html = $_POST['error_html'];
    cms_set_setting('error_html',$html);
    echo '<p>Saved.</p>';
}
?>
<h2>Edit Error Page Text</h2>
<form method="post">
<textarea name="error_html" style="width:100%;height:300px;"><?php echo htmlspecialchars($html); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="main_content.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
