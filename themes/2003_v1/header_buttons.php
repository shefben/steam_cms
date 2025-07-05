<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==='') $page_title = $site_title; else $page_title = $site_title.' '.$page_title;
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
a { color: #d8ded3; text-decoration: none }
a:hover { color: #fff; font-weight: normal }
</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title><?php echo htmlspecialchars($page_title); ?></title>
<style media="screen" type="text/css">
#layer1 { position: absolute; top: 230px; left: 171px; width: 734px; height: 523px; visibility: visible }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($base); ?>/themes/2003_v1/steam.css">
</head>
<body bgcolor="#626d5c" text="black">
<div align="center">
<table bgcolor="black" border="0" cellpadding="0" cellspacing="0" width="800">
<tr><td colspan="5" height="10" width="799"></td><td height="10" width="1"></td></tr>
<tr>
<td colspan="3" height="2" width="660"></td>
<td align="left" colspan="2" height="26" rowspan="2" valign="top" width="139"><img border="0" height="26" src="<?php echo htmlspecialchars($base); ?>/themes/2003_v1/images/Type_SupportSite2.jpg" width="128"></td>
<td height="2" width="1"></td>
</tr>
<tr>
<td height="60" rowspan="2" width="15"></td>
<td align="left" height="60" rowspan="2" valign="top" width="320"><img border="0" height="52" src="<?php echo htmlspecialchars($base); ?>/themes/2003_v1/images/SteamTM.jpg" width="202"></td>
<td height="24" width="325"></td>
<td height="24" width="1"></td>
</tr>
<tr>
<td align="left" colspan="2" height="36" valign="top" width="451">
<div align="right">
<a href="<?php echo htmlspecialchars($base); ?>/index.php">Home</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php">Support</a> |
<a href="http://www.steampowered.com/forums?boardid=1041">Forums</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/bugfixes.php">Bugs</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php#TroubleshootingAnchor">Troubleshooting</a> |
<a href="<?php echo htmlspecialchars($base); ?>/support/index.php#ContactAnchor">Contact</a>
</div>
</td>
<td height="36" width="13"></td>
<td height="36" width="1"></td>
</tr>
<tr height="1">
<td width="15"></td><td width="320"></td><td width="325"></td><td width="126"></td><td width="13"></td><td width="1"></td>
</tr>
</table>
<br>
