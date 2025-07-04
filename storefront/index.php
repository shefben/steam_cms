<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$theme = cms_get_setting('theme', '2005_v2');
$ver = (strpos($theme, '2006') !== false) ? '2006' : '2005';
$body_tpl = __DIR__.'/templates/' . $ver . '_body.html';
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

ob_start();
if (file_exists($body_tpl)) {
    cms_render_template($body_tpl, ['links' => $links, 'featured' => $featured]);
}
$body = ob_get_clean();

$tpl = __DIR__.'/../themes/'.$theme.'/default_template.php';
if (!file_exists($tpl)) {
    $tpl = __DIR__.'/../themes/2005_v2/default_template.php';
}
cms_render_template($tpl, ['page_title' => 'Steam Games', 'content' => $body]);
?>
