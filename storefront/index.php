<?php
$base = dirname(__DIR__);
require_once $base.'/cms/header.php';
$theme = cms_get_setting('theme', '2005_v2');
$ver = (strpos($theme, '2006') !== false) ? '2006' : '2005';
$tpl = __DIR__.'/templates/' . $ver . '_body.html';
$base_url = cms_base_url();
$sf_base  = ($base_url ? $base_url : '') . '/storefront';
$links = [
    ['type' => 'link', 'label' => 'Home', 'url' => $sf_base . '/index.php'],
    ['type' => 'spacer'],
    ['type' => 'link', 'label' => 'Browse Games', 'url' => $sf_base . '/browse.php'],
    ['type' => 'link', 'label' => 'All Games', 'url' => $sf_base . '/all.php'],
    ['type' => 'link', 'label' => 'Search', 'url' => $sf_base . '/search.php'],
];
$featured = json_decode(cms_get_setting('store_featured','{}'), true) ?: [];
if(file_exists($tpl)){
    include $tpl;
}
require_once $base.'/cms/footer.php';
?>
