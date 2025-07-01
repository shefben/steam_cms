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
    <style>
    .navBar {
        margin-left: 140px;
    }
    .globalNavItem {
        display:inline;
        vertical-align: top;
        margin-bottom: 0px;
    }
    .globalNavItem a {
        display:inline;
        margin-right: 15px;
        margin-left: 15px;
        padding-bottom: 9px;
        background-color: #000000;
        text-decoration:none;
    }
    .globalNavItem a:hover {
        background-color: #4C5844;
        text-decoration:none;
    }
    .globalNavLink {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.8em;
        color: #FFFFFF;
        letter-spacing: 1px;
        background-color: #000000;
        text-decoration: none;
        padding-top: 3px;
        padding-bottom: 3px;
    }
    </style>
    <link rel="Shortcut Icon" type="image/png" href="/webicon.png">
    <script language="JavaScript" src="/nav.js"></script>
    <link href="<?php echo htmlspecialchars($base); ?>/news_rss.php" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>
<body>
<?php
$default_logo = file_exists($root.'/content/logo.png')?'/cms/content/logo.png':'/img/steam_logo_onblack.gif';
$data_json = cms_get_setting('header_config', null);
$data = $data_json?json_decode($data_json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];
$override = $GLOBALS['CMS_CUSTOM_LOGO'] ?? null;
if($override){
    $data['logo'] = $override;
}
$nav_html = cms_header_buttons_html('2004');
$logo = $data['logo'];
if($logo && $logo[0]=='/') $logo = $base.$logo;
echo "<div class=\"header\" ><nobr>";
echo '<div><a href="'.htmlspecialchars($base).'/index.php"><img alt="Steam main" border="0" src="'.htmlspecialchars($logo).'"></a></div>';
echo '<div class=\'navBar\'>'.$nav_html.'</div>';
echo '</div>';
?>
