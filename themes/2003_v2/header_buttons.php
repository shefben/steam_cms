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
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($base); ?>/themes/2003_v2/steampowered.css">
    <script language="JavaScript" src="<?php echo htmlspecialchars($base); ?>/themes/2003_v2/nav.js"></script>
</head>
<body>
<?php
$header = cms_get_theme_header_data('2003_v2');
$override = $GLOBALS['CMS_CUSTOM_LOGO'] ?? null;
$logo = $override ?: ($header['logo'] ?: '/themes/2003_v2/img/steam_logo_onblack.gif');
$nav_html = cms_header_buttons_html('2003_v2');
if($logo && $logo[0]=='/') $logo = $base.$logo;
?>
<div class="header">
<nobr><a href="<?php echo htmlspecialchars($base); ?>/index.php"><img align="top" alt="[Steam]" height="54" src="<?php echo htmlspecialchars($logo); ?>" width="152"></a>
<span class="navBar"><?php echo $nav_html; ?></span>
</nobr>
</div>
