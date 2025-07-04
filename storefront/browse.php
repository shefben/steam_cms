<?php
require_once __DIR__.'/../cms/template_engine.php';
$db = cms_get_db();
$categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
$developers = $db->query('SELECT name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_COLUMN);

$theme = cms_get_setting('theme','2005_v2');
$tpl_body = __DIR__.'/templates/2005_browse.html';

ob_start();
cms_render_template($tpl_body, ['categories'=>$categories,'developers'=>$developers]);
$body = ob_get_clean();

$tpl = __DIR__.'/../themes/'.$theme.'/default_template.php';
if(!file_exists($tpl)) $tpl = __DIR__.'/../themes/2005_v2/default_template.php';
cms_render_template($tpl, ['page_title'=>'Browse Games','content'=>$body]);
?>
