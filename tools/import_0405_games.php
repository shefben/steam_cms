<?php
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$db->exec("DELETE FROM `0405_storefront_games`");

$path = __DIR__.'/../archived_steampowered/2004/storefront/games.php';
ob_start();
include $path;
$html = ob_get_clean();
$parts = preg_split('/<div class="captop">/', $html);
$count=0;
$stmt = $db->prepare('INSERT INTO `0405_storefront_games`(appid,title,description,image_thumb,image_screenshot,purchaseButtonStr,isHidden) VALUES(?,?,?,?,?,?,0)');
foreach(array_slice($parts,1) as $seg){
    if(!preg_match("~<div> &nbsp; &nbsp;(.*?)</div></div>(.*)~s", $seg, $m)) continue;
    $title = trim($m[1]);
    $rest = $m[2];
    if(!preg_match('~steam://run/(\d+)~', $rest, $a)) continue;
    $appid = (int)$a[1];
    preg_match('~<td valign="bottom"[^>]*><img src="([^"]+)"~', $rest, $m2); $img1=$m2[1]??'';
    preg_match('~<div><img src="([^"]+)"~', $rest, $m3); $img2=$m3[1]??'';
    if($img1) $img1 = '/storefront/' . ltrim($img1, '/');
    if($img2) $img2 = '/storefront/' . ltrim($img2, '/');
    preg_match('~<td style="padding-left:12px;" width="100%">(.*?)</td>~s', $rest, $m4); $desc=trim(strip_tags($m4[1]??''));
    preg_match('~<td nowrap class="purchase">(.*?)</td>~s', $rest, $m5); $btn=trim(strip_tags($m5[1]??''));
    $stmt->execute([$appid,$title,$desc,$img1,$img2,$btn]);
    $count++;
}
if($count){
    echo "Imported $count games\n";
} else {
    echo "No games parsed\n";
}
