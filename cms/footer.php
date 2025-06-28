<?php
require_once __DIR__.'/db.php';
$theme = cms_get_setting('theme','default');
$theme_dir = dirname(__DIR__)."/themes/$theme";
$footer = "$theme_dir/footer.php";
if(!file_exists($footer)) $footer = dirname(__DIR__).'/themes/default/footer.php';
$page = basename($_SERVER['PHP_SELF']);
$no_footer = array_filter(array_map('trim', preg_split('/\r?\n/', cms_get_setting('no_footer_pages',''))));
if(in_array($page,$no_footer)) return;
include $footer;
