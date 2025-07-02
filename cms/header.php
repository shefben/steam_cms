<?php
require_once __DIR__.'/db.php';
if(cms_get_setting('gzip','0')==='1' && !headers_sent()){
    ob_start('ob_gzhandler');
}
cms_record_visit($_SERVER['REQUEST_URI']);
$site = cms_get_setting("site_title","Steam");
if(!isset($page_title) || $page_title==="") $page_title = $site;
else $page_title = $site." ".$page_title;
$theme = cms_get_setting('theme','default');
$type = 'buttons';
$page = basename($_SERVER['PHP_SELF']);
$no_header = array_filter(array_map('trim', preg_split('/\r?\n/', cms_get_setting('no_header_pages',''))));
$bar_only = array_filter(array_map('trim', preg_split('/\r?\n/', cms_get_setting('header_bar_pages',''))));
$logo_override_lines = array_filter(array_map('trim', preg_split('/\r?\n/', cms_get_setting('page_logo_overrides',''))));
$custom_logo = null;
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach($logo_override_lines as $line){
    $parts = array_map('trim', explode(':', $line, 3));
    if(count($parts) === 3){
        list($path,$year,$logo) = $parts;
        if($current_path === $path && $year === $theme){
            $custom_logo = $logo;
            break;
        }
    }
}
if($custom_logo){
    $GLOBALS['CMS_CUSTOM_LOGO'] = $custom_logo;
}
if(in_array($page,$no_header)){
    return;
}
if(in_array($page,$bar_only)){
    $type = 'nobuttons';
}
$theme_dir = dirname(__DIR__)."/themes/$theme";
$base_url = cms_base_url();
$theme_url = ($base_url ? $base_url : '')."/themes/$theme";
$header = "$theme_dir/header_{$type}.php";
if(!file_exists($header)) $header = dirname(__DIR__).'/themes/default/header_buttons.php';
include $header;
