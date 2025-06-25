<?php
require_once __DIR__.'/db.php';
$theme = cms_get_setting('theme','default');
$theme_dir = dirname(__DIR__)."/themes/$theme";
$footer = "$theme_dir/footer.php";
if(!file_exists($footer)) $footer = dirname(__DIR__).'/themes/default/footer.php';
include $footer;
