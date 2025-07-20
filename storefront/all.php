<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';
$db=cms_get_db();
$sql = 'SELECT a.*, GROUP_CONCAT(sc.name ORDER BY sc.ord SEPARATOR ", ") as cats '
      .'FROM store_apps a '
      .'LEFT JOIN app_categories ac ON a.appid=ac.appid '
      .'LEFT JOIN store_categories sc ON ac.category_id=sc.id '
      .'GROUP BY a.appid ORDER BY a.name';
$apps=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$theme = cms_get_setting('theme','2005_v2');
$tpl_body = dirname(__DIR__).'/themes/2005_v1/storefront/layout/2005_all.twig';
$links = cms_load_store_links(__FILE__);
$params = ['apps'=>$apps,'links'=>$links, 'theme_subdir' => 'storefront'];
ob_start();
cms_render_template_theme($tpl_body, '2005_v1', $params);
$body = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, ['page_title'=>'All Games','content'=>$body, 'theme_subdir' => 'storefront']);
?>

