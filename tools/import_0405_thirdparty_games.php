<?php
require_once __DIR__.'/../cms/db.php';
$db = cms_get_db();
$db->exec("DELETE FROM `0405_storefront_thirdpartGames`");
$path = __DIR__.'/../archived_steampowered/2004/storefront/3rdparty.php';
ob_start();
include $path;
$html = ob_get_clean();
$segments = preg_split('/<div class="capsule3">/', $html);
$insert = $db->prepare('INSERT INTO `0405_storefront_thirdpartGames`(title,description,image_thumb,image_screenshot,websiteUrl,isHidden) VALUES(?,?,?,?,?,0)');
$count = 0;
foreach(array_slice($segments,1) as $seg){
    if(!preg_match('~<div class="captop3"><div>&nbsp; &nbsp;(.*?)</div></div>(.*)~s',$seg,$m)) continue;
    $title = trim($m[1]);
    $rest = $m[2];
    preg_match('~<td valign="bottom"[^>]*><img src="([^"]+)"~',$rest,$m2); $img1=$m2[1]??'';
    preg_match('~<div><img src="([^"]+)"~',$rest,$m3); $img2=$m3[1]??'';
    if($img1) $img1 = '/04-05v1_storefront/' . ltrim($img1, '/');
    if($img2) $img2 = '/04-05v1_storefront/' . ltrim($img2, '/');
    preg_match('~<td width="100%">(.*?)</td>~s',$rest,$m4); $desc=trim(strip_tags($m4[1]??''));
    preg_match('~window.open\(\'([^\']+)\'~',$rest,$m5); $url=$m5[1]??'';
    $insert->execute([$title,$desc,$img1,$img2,$url]);
    $count++;
}
if($count){
    echo "Imported $count thirdparty games\n";
}else{
    echo "No thirdparty games parsed\n";
}
