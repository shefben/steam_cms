<?php
require_once __DIR__.'/../cms/db.php';
$db = cms_get_db();
$db->exec("DELETE FROM `0405_storefront_packages`");
$path = __DIR__.'/../archived_steampowered/2004/storefront/packs.php';
ob_start();
include $path;
$html = ob_get_clean();
$segments = preg_split('/<div class="capsule">/', $html);
$insert = $db->prepare('INSERT INTO `0405_storefront_packages`(subid,title,description,image_thumb,image_screenshot,price,steamOnlyBadge,isHidden) VALUES(?,?,?,?,?,?,?,0)');
$count=0;
foreach(array_slice($segments,1) as $seg){
    if(!preg_match('~<div class="captop"><div> &nbsp; &nbsp;(.*?)</div></div>(.*)~s',$seg,$m)) continue;
    $title = trim($m[1]);
    $rest = $m[2];
    preg_match('~<td valign="bottom"[^>]*><img src="([^"]+)"~',$rest,$m2); $img1=$m2[1]??'';
    preg_match('~<td class="pricing2">(.*?)</td>~s',$rest,$mBadge);
    $badge = strpos($mBadge[1]??'', 'Offer')!==false ? 1:0;
    preg_match('~<td class="pricing2">(?:<img src="([^"]+)")?~',$rest,$mscreen); $img2=$mscreen[1]??'';
    if($img1) $img1 = '/storefront/' . ltrim($img1, '/');
    if($img2) $img2 = '/storefront/' . ltrim($img2, '/');
    preg_match('~<td>\s*<script.*?</script>\s*(.*?)</td>~s',$rest,$descMatch);
    if(!$descMatch){
        preg_match('~<td>(.*?)</td>~s',$rest,$descMatch);
    }
    $desc=trim(strip_tags($descMatch[1]??''));
    preg_match('~Package price.*?<td nowrap[^>]*>(\$[^<]+)~s',$rest,$priceMatch); $price=$priceMatch[1]??'';
    preg_match('~steam://purchase/(\d+)~',$rest,$subMatch); $subid=(int)($subMatch[1]??0);
    if(!$subid) continue;
    $insert->execute([$subid,$title,$desc,$img1,$img2,$price,$badge]);
    $count++;
}
if($count){
    echo "Imported $count packages\n";
}else{
    echo "No packages parsed\n";
}
?>
