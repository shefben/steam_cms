<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
?>
<div class="footer">
<a href="http://www.valvesoftware.com"><img align="left" src="<?php echo htmlspecialchars($base); ?>/themes/2003_v2/img/valve_greenlogo.gif"></a> 2003 Valve, L.L.C. All rights reserved. Read our <a href="http://www.valvesoftware.com/privacy.htm">privacy policy</a>.<br>
        Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
</div>
<?php echo cms_get_setting('footer_html',''); ?>
</body>
</html>
