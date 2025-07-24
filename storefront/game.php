<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$appid = (int)($_GET['AppId'] ?? 0);
$stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$app){ echo '<p>App not found.</p>'; exit; }
$images = [];
try {
    $images = cms_get_app_screenshots($appid);
    if(!$images) {
        $images = json_decode($app['images'] ?: '[]', true);
    } else {
        $images = array_column(array_filter($images, fn($r)=>!$r['hidden']), 'filename');
    }
    $images = array_slice($images,0,5);
} catch (Exception $e) {
    $images = json_decode($app['images'] ?: '[]', true);
}
$min = $app['sysreq_min'] ?? '';
$rec = $app['sysreq_rec'] ?? '';
$packs = $db->prepare('SELECT s.subid,s.name,s.price FROM subscriptions s JOIN subscription_apps sa ON s.subid=sa.subid WHERE sa.appid=? ORDER BY s.price');
$packs->execute([$appid]);
$packages = $packs->fetchAll(PDO::FETCH_ASSOC);
$is_demo = (bool)$db->query('SELECT 1 FROM app_categories WHERE appid='.$appid.' AND category_id=10')->fetchColumn();

$theme = cms_get_setting('theme','2005_v2');
$links = cms_load_store_links(__FILE__);
$tpl_name = $app['show_metascore'] ? 'gamepage_with_metascore.twig' : 'gamepage.twig';
$tpl = cms_theme_layout($tpl_name, $theme);

$game = [
    'title' => $app['name'],
    'price' => $app['price'],
    'appid' => $appid,
    'description' => $app['description'],
    'metascore_score' => $app['metacritic'],
    'minimumreqs' => $min,
    'recommendedreqs' => $rec,
    'productheader_path' => $app['main_image'],
    'metascore_url' => $app['metacritic_url'],
    'trailer_url' => $app['trailer_url'],
    'show_trailer' => empty($app['hide_trailer']),
    'show_preload' => false,
    'package' => []
];
if(!empty($app['is_preload'])){
    $now = date('Y-m-d');
    $start = $app['preload_start'] ?: $now;
    $end   = $app['preload_end'] ?: $now;
    if($now >= $start && $now <= $end){
        $game['show_preload'] = true;
    }
}
foreach($packages as $p){
    $game['package'][] = ['title'=>$p['name'],'subid'=>$p['subid'],'price'=>$p['price']];
}
cms_render_template($tpl,[
    'game'=>$game,
    'images'=>$images,
    'is_demo'=>$is_demo,
    'links'=>$links,
    'theme_subdir'=>'storefront',
    'page_title'=>$app['name']
]);
