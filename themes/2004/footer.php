<?php
$root = dirname(__DIR__,2);
require_once "$root/db.php";
echo cms_get_setting('footer_html','');
?>
</body>
</html>
