<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$appid = (int)($_GET['appid'] ?? 0);
$stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$app){ echo '<p>App not found. AppId: '.$appid.'</p>'; exit; }

// Load content overlay data
$overlay_stmt = $db->prepare('
    SELECT title, content, active 
    FROM product_content_overlays 
    WHERE appid = ? AND active = 1 
    AND (start_date IS NULL OR start_date <= NOW()) 
    AND (end_date IS NULL OR end_date >= NOW())
    LIMIT 1
');
$overlay_stmt->execute([$appid]);
$content_overlay = $overlay_stmt->fetch(PDO::FETCH_ASSOC);

// Load discount data for the app
$discount_stmt = $db->prepare('
    SELECT discount_type, discount_value, discount_label, active 
    FROM product_discounts 
    WHERE appid = ? AND active = 1 
    AND (start_date IS NULL OR start_date <= NOW()) 
    AND (end_date IS NULL OR end_date >= NOW())
    LIMIT 1
');
$discount_stmt->execute([$appid]);
$discount = $discount_stmt->fetch(PDO::FETCH_ASSOC);
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
$links = cms_store_sidebar_links();
$now = date('Y-m-d');

// Determine template variant based on database fields
$tpl_name = 'gamepage.twig'; // Default normal variant
if (!empty($app['is_preload']) && $now >= ($app['preload_start'] ?: $now) && $now <= ($app['preload_end'] ?: $now)) {
    $tpl_name = 'gamepage_preload.twig'; // Preload variant
} elseif (!empty($app['show_metascore']) || !empty($app['metacritic'])) {
    $tpl_name = 'gamepage_with_metascore.twig'; // Metascore variant
}

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
    'release_state' => $app['release_state'] ?? 'released',
    'release_date' => $app['release_date'],
    'preorder_available' => $app['preorder_available'] ?? 0,
    'preload_available' => $app['preload_available'] ?? 0,
    'preorder_bonus_text' => $app['preorder_bonus_text'],
    'content_overlay' => $content_overlay,
    'discount' => $discount,
    'package' => []
];
if(!empty($app['is_preload'])){
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
