<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();
$pos = $_POST['position'] ?? '';
$posMap = [
    'top1'=>1,
    'top2'=>2,
    'large'=>3,
    'under1'=>4,
    'under2'=>5,
    'bottom1'=>6,
    'bottom2'=>7,
    'gear'=>8,
    'free'=>9,
    'tabbed'=>10
];
$appid = (int)($_POST['appid'] ?? 0);
$theme = cms_get_setting('theme', '2006_v1');
$useAll = cms_get_setting('capsules_same_all', '1') === '1';
$is2006 = preg_match('/^200[67]/',$theme) === 1;
$styleMap = $is2006 ? [
    'top1' => 'left:0;top:0;width:288px;height:105px',
    'top2' => 'left:301px;top:0;width:289px;height:105px',
    'large' => 'left:0;top:112px;width:590px;height:221px',
    'under1' => 'left:0;top:344px;width:288px;height:105px',
    'under2' => 'left:301px;top:344px;width:289px;height:105px',
    'bottom1' => 'left:0;top:456px;width:288px;height:105px',
    'bottom2' => 'left:301px;top:456px;width:289px;height:105px'
] : [
    'top' => 'left:1px;top:1px;width:588px;height:98px',
    'middle' => 'left:0;top:112px;width:589px;height:228px',
    'bottom_left' => 'left:0;top:352px;width:288px;height:158px',
    'bottom_right' => 'left:301px;top:352px;width:289px;height:158px'
];
if(!isset($styleMap[$pos])){
    http_response_code(400);
    exit('badpos');
}

if(!isset($posMap[$pos])){
    http_response_code(400);
    exit('badpos');
}
$ord = $posMap[$pos];
preg_match('/width:(\d+)px;height:(\d+)px/',$styleMap[$pos],$m);
$dw=(int)$m[1];
$dh=(int)$m[2];
if (!$pos || !$appid || !isset($_FILES['file'])) {
    http_response_code(400);
    exit('bad');
}
$target = $useAll ? 'all' : $theme;
$basePath = dirname(__DIR__, 2) . '/storefront/images/capsules/' . $target;
if (!is_dir($basePath)) {
    mkdir($basePath, 0777, true);
}
$fileName = $appid . '.png';
$path = $basePath . '/' . $fileName;
$tmp = $_FILES['file']['tmp_name'];
$img = imagecreatefrompng($tmp);
if (!$img) {
    http_response_code(415);
    exit('badimg');
}
$dst = imagecreatetruecolor($dw, $dh);
imagealphablending($dst, false);
imagesavealpha($dst, true);
list($w,$h) = getimagesize($tmp);
imagecopyresampled($dst, $img, 0,0,0,0, $dw,$dh, $w,$h);
imagepng($dst, $path);
imagedestroy($img);
imagedestroy($dst);

$rel = $target . '/' . $fileName;
$size = $pos === 'large' ? 'large' : 'small';
if ($useAll) {
    $stmt = $db->prepare('REPLACE INTO storefront_capsules_all(position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,0,0)');
    $stmt->execute([$pos, $size, $rel, $appid]);
} else {
    $stmt = $db->prepare('REPLACE INTO storefront_capsules_per_theme(theme,ord,size,image_path,appid,price,hidden,title,content) VALUES(?,?,?,?,?,?,0,NULL,NULL)');
    $stmt->execute([$theme, $ord, $size, $rel, $appid, null]);
}
echo $rel;
