<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();
$pos = $_POST['position'] ?? '';
$year = (int)($_POST['year'] ?? 0);
$month = (int)($_POST['month'] ?? 0);
$day = (int)($_POST['day'] ?? 0);
$appid = (int)($_POST['appid'] ?? 0);
if (!$pos || !$year || !$month || !$day || !isset($_FILES['file'])) {
    http_response_code(400);
    exit('bad');
}

$basePath = dirname(__DIR__, 2) . '/storefront/images/capsules';
$folder = $basePath . '/' . $pos;
$fileName = sprintf('%02d_%02d_%04d.png', $month, $day, $year);
if (file_exists($folder . '/' . $fileName)) {
    $i = 1;
    while (file_exists($folder . '/' . preg_replace('/\.png$/', "_${i}.png", $fileName))) {
        $i++;
    }
    $fileName = preg_replace('/\.png$/', "_${i}.png", $fileName);
}
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}
$path = $folder . '/' . $fileName;
move_uploaded_file($_FILES['file']['tmp_name'], $path);

$rel = $pos . '/' . $fileName;
$stmt = $db->prepare('REPLACE INTO store_capsules(position,image,appid) VALUES(?,?,?)');
$stmt->execute([$pos, $rel, $appid]);
echo $rel;
