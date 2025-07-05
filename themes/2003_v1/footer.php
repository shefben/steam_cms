<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
?>
<table border="0" cellpadding="0" cellspacing="0" width="800">
<tr><td colspan="4" height="19" width="799"></td><td height="19" width="1"></td></tr>
<tr>
<td colspan="2" height="24" width="360"></td>
<td align="left" height="24" valign="top" width="424"><img border="0" height="23" src="<?php echo htmlspecialchars($base); ?>/themes/2003_v1/images/Valve_CircleR.gif" width="82"></td>
<td rowspan="2" width="15"></td>
<td height="24" width="1"></td>
</tr>
<tr>
<td height="53" width="17"></td>
<td align="left" colspan="2" height="53" valign="top" width="767">
<div align="center">
<a href="<?php echo htmlspecialchars($base); ?>/index.php">Home</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php">Support</a> |
<a href="http://www.steampowered.com/forums?boardid=1041">Forums</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/bugfixes.php">Bugs</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php#TroubleshootingAnchor">Troubleshooting</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php#ContactAnchor">Contact</a><br>
<span style="color:#969f8e;font-size:10px;">(c) 2003 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.</span>
</div>
</td>
<td width="1"></td>
</tr>
</table>
<?php echo cms_get_setting('footer_html',''); ?>
</div>
</body>
</html>
