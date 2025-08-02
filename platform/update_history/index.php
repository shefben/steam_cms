<?php
require_once __DIR__.'/../../cms/template_engine.php';

$appid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$skin  = preg_replace('/[^0-9]/', '', $_GET['skin'] ?? '2');
$theme = "platform/version_{$skin}";

$db = cms_get_db();
$stmt = $db->prepare('SELECT name FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$name = $stmt->fetchColumn() ?: "App {$appid}";
$app_name_caps = strtoupper($name);

$latestStmt = $db->prepare('SELECT MAX(date) FROM platform_update_history WHERE appid=?');
$latestStmt->execute([$appid]);
$latest = $latestStmt->fetchColumn();
$latest_update_date = $latest ? date('F j, Y', strtotime($latest)) : '';

$GLOBALS['platform_update_appid'] = $appid;

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template_theme($tpl, $theme, [
    'id' => $appid,
    'skin' => $skin,
    'app_name_caps' => $app_name_caps,
    'latest_update_date' => $latest_update_date,
]);

