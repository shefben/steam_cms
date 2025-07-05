<?php
$root = dirname(__DIR__,2);
require_once "$root/cms/db.php";
$base = cms_base_url();
$theme_url = $theme_url ?? (($base? $base : '').'/themes/2005_v2');
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==="") $page_title = $site_title;
else $page_title = $site_title . " " . $page_title;
$default_logo = file_exists($root.'/content/logo.png')? $base.'/cms/content/logo.png' : $base.'/img/steam_logo_onblack.gif';
$data_json = cms_get_setting('header_config', null);
$data = $data_json?json_decode($data_json,true):['logo'=>$default_logo];
$override = $GLOBALS['CMS_CUSTOM_LOGO'] ?? null;
$logo = $override ?: (isset($data['logo'])?$data['logo']:$default_logo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="ROBOTS" content="ALL">
    <meta name="DESCRIPTION" content="SteamPowered">
    <meta name="KEYWORDS" content="Steam, account, account creation, signup">
    <meta name="AUTHOR" content="Valve Corporation">
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($theme_url); ?>/steampowered03.css">
<?php if (strpos($_SERVER['SCRIPT_NAME'], '/storefront/') !== false): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($theme_url); ?>/assets/storefront.css">
<?php endif; ?>
    <style>
    .globalHeadBar
    {
        background:#000000;
        margin: 0px;
        width: 80%;
        padding-top: 47px;
        padding-bottom: 9px;
        float: left;
    }
    .globalHeadBar_logo {
        background:#000000;
        margin: 0px;
        padding-top: 4px;
        padding-bottom: 9px;
        float: left;
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
    <link rel="Shortcut Icon" type="image/png" href="<?php echo htmlspecialchars($base); ?>/webicon.png">
</head>
<body bgcolor="#4c5844" leftmargin="0" topmargin="0">
<?php
$logo_url = $logo;
if($logo_url && $logo_url[0]=='/') $logo_url = $base.$logo_url;
$nav_html = cms_header_buttons_html('2005_v2');
echo '<div style="min-width:850px;">';
echo '<div class="globalHeadBar_logo"><a href="'.htmlspecialchars($base).'/index.php"><img alt="Steam main" border="0" src="'.htmlspecialchars($logo_url).'"></a></div>';
echo '<div class="globalHeadBar">'.$nav_html.'</div>';
echo '</div>';
?>
