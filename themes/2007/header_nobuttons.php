<?php
$root = dirname(__DIR__,2);
require_once "$root/db.php";
$site_title = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==="") $page_title = $site_title;
else $page_title = $site_title . " " . $page_title;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="stylesheet" href="/static_pages/2007_contentserver_stats/css/styles_global.css">
    <link rel="stylesheet" href="/static_pages/2007_contentserver_stats/css/styles_content.css">
    <link rel="stylesheet" href="/static_pages/2007_contentserver_stats/css/header.css">
</head>
<body>
<?php
$default_logo = file_exists($root.'/content/logo.png')?'/cms/content/logo.png':'/static_pages/2007_contentserver_stats/img/steamLogo.jpg';
$data_json = cms_get_setting('header_config', null);
$data = $data_json?json_decode($data_json,true):['logo'=>$default_logo,'buttons'=>[]];
if(!$data) $data=['logo'=>$default_logo,'buttons'=>[]];
$nav_html = cms_header_buttons_html('2007');
?>
<div class="headerBar" id="v4headerBar">
    <div class="steamLogo">
        <img src="<?php echo htmlspecialchars($data['logo']); ?>" width="105" height="54" border="0">
    </div>
    <div class="steamText">
        <img src="/static_pages/2007_contentserver_stats/img/steamText.jpg" width="72" height="35" border="0">
    </div>
    <div class="headerLinks" id="v4headerLinks">
        <p><?php echo $nav_html; ?></p>
    </div>
</div>
