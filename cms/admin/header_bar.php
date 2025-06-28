<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$no_header_pages = cms_get_setting('no_header_pages','');
$header_bar_pages = cms_get_setting('header_bar_pages','');
$no_footer_pages = cms_get_setting('no_footer_pages','');

if(isset($_POST['save'])){
    cms_set_setting('no_header_pages', trim($_POST['no_header_pages']));
    cms_set_setting('header_bar_pages', trim($_POST['header_bar_pages']));
    cms_set_setting('no_footer_pages', trim($_POST['no_footer_pages']));
    echo '<p>Settings saved.</p>';
    $no_header_pages = trim($_POST['no_header_pages']);
    $header_bar_pages = trim($_POST['header_bar_pages']);
    $no_footer_pages = trim($_POST['no_footer_pages']);
}
?>
<h2>Header Bar Display</h2>
<form method="post">
Pages without header bar (one per line):<br>
<textarea name="no_header_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($no_header_pages); ?></textarea><br>
Header bar only pages (one per line):<br>
<textarea name="header_bar_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($header_bar_pages); ?></textarea><br>
Pages without footer (one per line):<br>
<textarea name="no_footer_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($no_footer_pages); ?></textarea><br>
<input type="submit" name="save" value="Save" class="btn btn-success">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
