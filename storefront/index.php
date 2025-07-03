<?php
$base = dirname(__DIR__);
require_once $base.'/cms/header.php';
$theme = cms_get_setting('theme', '2005_v2');
$ver = (strpos($theme, '2006') !== false) ? '2006' : '2005';
$tpl = __DIR__.'/templates/' . $ver . '_body.html';
$links = json_decode(cms_get_setting('store_links','[]'), true) ?: [];
$featured = json_decode(cms_get_setting('store_featured','{}'), true) ?: [];
if(file_exists($tpl)){
    include $tpl;
}
require_once $base.'/cms/footer.php';
?>
