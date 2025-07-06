<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$theme = cms_get_setting('theme', '2005_v2');
$ver = (strpos($theme, '2006') !== false) ? '2006' : '2005';
$body_tpl = __DIR__.'/templates/' . $ver . '_body.html';
$links = cms_load_store_links(__FILE__);
$db = cms_get_db();
$capsules = [];
$res = $db->query('SELECT position,appid,image FROM store_capsules');
foreach($res as $row){
    $capsules[$row['position']] = $row;
}

ob_start();
if (file_exists($body_tpl)) {
    cms_render_template($body_tpl, ['links' => $links, 'capsules' => $capsules, 'theme_subdir' => 'storefront']);
}
$body = ob_get_clean();

$tpl = __DIR__.'/../themes/'.$theme.'/default_template.php';
if (!file_exists($tpl)) {
    $tpl = __DIR__.'/../themes/2005_v2/default_template.php';
}
cms_render_template($tpl, ['page_title' => 'Steam Games', 'content' => $body, 'theme_subdir' => 'storefront']);
?>
