<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$appid = (int)($_GET['AppId'] ?? 0);
$stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$app){ echo '<p>App not found.</p>'; exit; }
$images = json_decode($app['images'] ?: '[]', true);
$sysreq = $app['sysreq'];
$packs = $db->prepare('SELECT s.subid,s.name,s.price FROM subscriptions s JOIN subscription_apps sa ON s.subid=sa.subid WHERE sa.appid=? ORDER BY s.price');
$packs->execute([$appid]);
$packages = $packs->fetchAll(PDO::FETCH_ASSOC);
$is_demo = (bool)$db->query('SELECT 1 FROM app_categories WHERE appid='.$appid.' AND category_id=10')->fetchColumn();

$theme = cms_get_setting('theme','2005_v2');
$tpl_body = __DIR__.'/templates/'.($app['show_metascore']? '2005_game_metascore.twig' : '2005_game.twig');
$links = cms_load_store_links(__FILE__);
$params = [
    'app'=>$app,
    'images'=>$images,
    'packages'=>$packages,
    'is_demo'=>$is_demo,
    'appid'=>$appid,
    'sysreq'=>$sysreq,
    'links'=>$links,
    'theme_subdir' => 'storefront',
];
ob_start();
cms_render_template($tpl_body, $params);
$body = ob_get_clean();

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, ['page_title'=>$app['name'], 'content'=>$body, 'theme_subdir' => 'storefront']);
