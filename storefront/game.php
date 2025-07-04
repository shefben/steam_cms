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
$tpl_body = __DIR__.'/templates/2005_game.html';
ob_start();
cms_render_template($tpl_body, [
    'app'=>$app,
    'images'=>$images,
    'packages'=>$packages,
    'is_demo'=>$is_demo,
    'appid'=>$appid,
    'sysreq'=>$sysreq,
]);
$body = ob_get_clean();

$tpl = __DIR__.'/../themes/'.$theme.'/default_template.php';
if(!file_exists($tpl)) $tpl = __DIR__.'/../themes/2005_v2/default_template.php';
cms_render_template($tpl, ['page_title'=>$app['name'], 'content'=>$body]);
