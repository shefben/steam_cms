<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$subId      = (int)($_GET['SubId'] ?? 0);
$sort_by    = $_GET['sort_by'] ?? 'Name';
$sort_last  = $_GET['sort_last'] ?? $sort_by;
$sort_order = strtoupper($_GET['sort_order'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';

function build_url(array $params){
    $order = ['area','SubId','sort_by','sort_last','sort_order'];
    $out = [];
    foreach($order as $k){ $out[$k] = $params[$k] ?? ''; }
    return 'index.php?'.http_build_query($out, '', '&');
}

$base_params = [
    'area'       => 'package',
    'SubId'      => $subId,
    'sort_by'    => $sort_by,
    'sort_last'  => $sort_last,
    'sort_order' => $sort_order
];

$pkg = $db->prepare('SELECT * FROM subscriptions WHERE subid=?');
$pkg->execute([$subId]);
$package = $pkg->fetch(PDO::FETCH_ASSOC);
if(!$package){ echo '<p>Package not found.</p>'; exit; }

$sort_map = ['Name'=>'a.name','Developer'=>'a.developer','Price'=>'a.price','Metascore'=>'a.metacritic'];
$sort_col = $sort_map[$sort_by] ?? 'a.name';
$sql = 'SELECT a.* FROM subscription_apps sa JOIN store_apps a ON sa.appid=a.appid WHERE sa.subid=? ORDER BY '.$sort_col.' '.$sort_order;
$stmt = $db->prepare($sql);
$stmt->execute([$subId]);
$apps = $stmt->fetchAll(PDO::FETCH_ASSOC);

$theme = cms_get_setting('theme','2005_v2');
$tpl_body = dirname(__DIR__).'/themes/2005_v1/storefront/layouts/2005_package.twig';
$links = cms_load_store_links(__FILE__);
ob_start();
cms_render_template($tpl_body, [
    'package'=>$package,
    'apps'=>$apps,
    'base_params'=>$base_params,
    'sort_last'=>$sort_last,
    'sort_order'=>$sort_order,
    'subId'=>$subId,
    'links'=>$links,
    'theme_subdir' => 'storefront',
]);
$body = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, ['page_title'=>$package['name'], 'content'=>$body, 'theme_subdir' => 'storefront']);
