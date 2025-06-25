<?php
require_once 'admin_header.php';
cms_require_permission('manage_news');
require_once __DIR__.'/../news.php';
$settings = cms_get_news_settings();
if(isset($_POST['save'])){
    $settings['articles_per_page'] = (int)$_POST['articles'];
    $settings['partial_words'] = (int)$_POST['partial_words'];
    cms_save_news_settings($settings);
}
?>
<h2>News Settings</h2>
<form method="post">
Articles per tag: <input type="number" name="articles" value="<?php echo $settings['articles_per_page']; ?>"><br><br>
Partial article word limit: <input type="number" name="partial_words" value="<?php echo $settings['partial_words']; ?>"><br><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
