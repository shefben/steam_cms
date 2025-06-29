<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$show = cms_get_setting('support2003_show','1');
$html = cms_get_setting('support2003_html','<div class="notification"><b>:: REQUIRED UPDATE AVAILABLE</b></div>');
if(isset($_POST['save'])){
    $show = isset($_POST['show'])?'1':'0';
    $html = $_POST['html'];
    cms_set_setting('support2003_show',$show);
    cms_set_setting('support2003_html',$html);
    echo '<p>Saved.</p>';
}
?>
<h2>2003 Support Notification</h2>
<form method="post">
<label><input type="checkbox" name="show" value="1" <?php echo $show==='1'?'checked':''; ?>> Show notification</label><br><br>
<textarea name="html" style="width:100%;height:200px;"><?php echo htmlspecialchars($html); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
