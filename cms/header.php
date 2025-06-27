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
$req = basename($_SERVER['PHP_SELF']);
if(!empty($_SERVER['QUERY_STRING'])) $req .= '?' . $_SERVER['QUERY_STRING'];
$overrides = cms_get_setting('header_overrides','');
foreach(preg_split('/\r?\n/',$overrides) as $line){
    if(!trim($line)) continue;
    list($path,$t) = array_map('trim', explode(',', $line, 2));
    if($path === $req){
        $type = $t;
        break;
    }
}
$theme_dir = dirname(__DIR__)."/themes/$theme";
$header = "$theme_dir/header_{$type}.php";
if(!file_exists($header)) $header = dirname(__DIR__).'/themes/default/header_buttons.php';
include $header;
