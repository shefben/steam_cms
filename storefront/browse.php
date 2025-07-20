<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';
$db = cms_get_db();
$categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
$developers = $db->query('SELECT id,name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$links = cms_load_store_links(__FILE__);

$theme = cms_get_setting('theme','2005_v2');
$tpl_body = dirname(__DIR__).'/themes/2005_v1/storefront/layouts/2005_browse.twig';

$params = ['categories'=>$categories,'developers'=>$developers,'links'=>$links, 'theme_subdir' => 'storefront'];
ob_start();
cms_render_template($tpl_body, $params);
$body = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, ['page_title'=>'Browse Games','content'=>$body, 'theme_subdir' => 'storefront']);
?>
