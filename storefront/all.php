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
$tpl_body = __DIR__.'/templates/2005_all.html';
$links = cms_load_store_links(__FILE__);
ob_start();
cms_render_template($tpl_body, ['apps'=>$apps,'links'=>$links]);
$body = ob_get_clean();

$tpl = __DIR__.'/../themes/'.$theme.'/default_template.php';
if(!file_exists($tpl)) $tpl = __DIR__.'/../themes/2005_v2/default_template.php';
cms_render_template($tpl, ['page_title'=>'All Games','content'=>$body]);
?>

