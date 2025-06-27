<?php
$root = dirname(__DIR__,2);
require_once "$root/db.php";
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==="") $page_title = $site_title;
else $page_title = $site_title . " " . $page_title;
$default_logo = file_exists($root.'/content/logo.png')?'/cms/content/logo.png':'/img/steam_logo_onblack.gif';
$data_json = cms_get_setting('header_config', null);
$data = $data_json?json_decode($data_json,true):['logo'=>$default_logo];
$logo = isset($data['logo'])?$data['logo']:$default_logo;
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
    <link rel="stylesheet" type="text/css" href="/steampowered02.css">
    <link rel="Shortcut Icon" type="image/png" href="/webicon.png">
</head>
<body bgcolor="#4c5844" leftmargin="0" topmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr height="55">
        <td bgcolor="black" height="55">
            <table width="383" border="0" cellspacing="0" cellpadding="0">
                <tr height="18">
                    <td width="47" rowspan="2"></td>
                    <td width="335"></td>
                    <td width="1"><spacer type="block" width="1" height="18"></td>
                </tr>
                <tr height="36">
                    <td width="335" valign="top" align="left"><a href="/index.php"><img src="<?php echo htmlspecialchars($logo); ?>" alt="[Steam]" width="152" height="54" border="0"></a></td>
                    <td width="1"><spacer type="block" width="1" height="36"></td>
                </tr>
                <tr height="1" cntrlrow>
                    <td width="47"><spacer type="block" width="47" height="1"></td>
                    <td width="335"><spacer type="block" width="335" height="1"></td>
                    <td width="1"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php echo cms_header_buttons_html('2003'); ?>
