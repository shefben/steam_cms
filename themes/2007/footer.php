<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$footer = cms_get_setting('footer_html','');
?>
<div class="footer">
<?php echo $footer; ?>
</div>
</body>
</html>
