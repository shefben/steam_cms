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
<p class="page-description" style="color:#666;margin-bottom:15px;">Customize the content shown on the site's error page.</p>
<form method="post">
<textarea name="error_html" id="error_html" style="width:100%;height:300px;"><?php echo htmlspecialchars($html); ?></textarea><br>
<button type="submit" name="save" class="btn btn-primary" value="Save">Save</button>
</form>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('error_html', {baseHref: '/'});
</script>
<?php include 'admin_footer.php'; ?>
