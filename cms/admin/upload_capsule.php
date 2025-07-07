<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();
$pos = $_POST['position'] ?? '';
$appid = (int)($_POST['appid'] ?? 0);
$theme = cms_get_setting('theme', '2006_v1');
$useAll = cms_get_setting('capsules_same_all', '1') === '1';
if (!$pos || !$appid || !isset($_FILES['file'])) {
    http_response_code(400);
    exit('bad');
}
$target = $useAll ? 'all' : $theme;
$basePath = dirname(__DIR__, 2) . '/images/capsules/' . $target;
if (!is_dir($basePath)) {
    mkdir($basePath, 0777, true);
}
$fileName = $appid . '.png';
$path = $basePath . '/' . $fileName;
move_uploaded_file($_FILES['file']['tmp_name'], $path);

$rel = $target . '/' . $fileName;
$size = $pos === 'large' ? 'large' : 'small';
if ($useAll) {
    $stmt = $db->prepare('REPLACE INTO storefront_capsules_all(position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,0,0)');
    $stmt->execute([$pos, $size, $rel, $appid]);
} else {
    $stmt = $db->prepare('REPLACE INTO storefront_capsules_per_theme(theme,position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,?,0,0)');
    $stmt->execute([$theme, $pos, $size, $rel, $appid]);
}
echo $rel;
