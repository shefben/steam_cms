<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();
$pos = $_POST['position'] ?? '';
$year = (int)($_POST['year'] ?? 0);
$month = (int)($_POST['month'] ?? 0);
$appid = (int)($_POST['appid'] ?? 0);
if (!$pos || !$year || !$month || !isset($_FILES['file'])) {
    http_response_code(400);
    exit('bad');
}

$basePath = dirname(__DIR__, 2) . '/storefront/images/capsules';
$monthName = date('F', mktime(0,0,0,$month,1,$year));
$baseFolder = sprintf('%04d_%02d-%s', $year, $month, $monthName);
$folder = $basePath . '/' . $baseFolder;
$fileName = $pos . '_capsule.png';
if (is_dir($folder) && file_exists($folder . '/' . $fileName)) {
    $i = 1;
    while (is_dir($folder . '_' . $i)) {
        $i++;
    }
    $folder .= '_' . $i;
}
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}
$path = $folder . '/' . $fileName;
move_uploaded_file($_FILES['file']['tmp_name'], $path);

$rel = basename($folder) . '/' . $fileName;
$stmt = $db->prepare('REPLACE INTO store_capsules(position,image,appid) VALUES(?,?,?)');
$stmt->execute([$pos, $rel, $appid]);
echo $rel;
