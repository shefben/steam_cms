<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==='') $page_title = $site_title; else $page_title = $site_title.' '.$page_title;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="ROBOTS" content="ALL">
    <meta name="DESCRIPTION" content="Valve - Steam account signup">
    <meta name="KEYWORDS" content="Steam, account, account creation, signup">
    <meta name="AUTHOR" content="Valve LLC">
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/steampowered.css">
    <script language="JavaScript" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/nav.js"></script>
</head>
<body>
<div class="header">
<nobr><a href="<?php echo htmlspecialchars($base); ?>/index.php"><img align="top" alt="[Steam]" height="54" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/img/steam_logo_onblack.gif" width="152"></a>
<span class="navBar">
<a href="<?php echo htmlspecialchars($base); ?>/index.php?area=getsteamnow" onmouseout="out(0)" onmouseover="over(0)"><img alt="getSteamNow" height="22" name="getSteamNow" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/img/getSteamNow.gif" valign="bottom" width="108"></a>
<a href="<?php echo htmlspecialchars($base); ?>/index.php?area=forums" onmouseout="out(1)" onmouseover="over(1)"><img alt="Forums" height="22" name="forums" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/img/forums.gif" valign="bottom" width="68"></a>
<a href="<?php echo htmlspecialchars($base); ?>/index.php?area=support" onmouseout="out(2)" onmouseover="over(2)"><img alt="Support" height="22" name="support" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/img/support.gif" valign="bottom" width="68"></a>
<a href="<?php echo htmlspecialchars($base); ?>/index.php?area=status" onmouseout="out(14)" onmouseover="over(14)"><img alt="Status" height="22" name="status" src="<?php echo htmlspecialchars($base); ?>/archived_steampowered/2003/v2/img/status.gif" valign="bottom" width="65"></a>
</span>
</nobr>
</div>
