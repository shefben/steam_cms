<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==="") $page_title = $site_title;
else $page_title = $site_title . " " . $page_title;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="ROBOTS" content="ALL">
    <meta name="DESCRIPTION" content="SteamPowered">
    <meta name="KEYWORDS" content="Steam, account, account creation, signup">
    <meta name="AUTHOR" content="Valve LLC">
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($base); ?>/steampowered.css">
    <link rel="Shortcut Icon" type="image/png" href="<?php echo htmlspecialchars($base); ?>/webicon.png">
    <script language="JavaScript" src="<?php echo htmlspecialchars($base); ?>/nav.js"></script>
    <link href="<?php echo htmlspecialchars($base); ?>/rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>
<body>
<?php
$default_logo = file_exists($root.'/content/logo.png') ? $base.'/cms/content/logo.png' : $base.'/img/steam_logo_onblack.gif';
$data_json = cms_get_setting('header_config', null);
$data = $data_json?json_decode($data_json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];
$logo = $data['logo'];
if($logo && $logo[0]=='/') $logo = $base.$logo;
$nav_html = cms_header_buttons_html('2004');
echo "<div class=\"header\"><nobr>";
echo "<a href=\"{$base}/index.php\"><img src=\"".htmlspecialchars($logo)."\" alt=\"[Steam]\" height=\"54\" width=\"152\"></a>";
echo "<span class=\"navBar\">$nav_html</span></nobr></div>";
?>
