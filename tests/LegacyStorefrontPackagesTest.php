<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE `0405_storefront_packages`(subid INTEGER PRIMARY KEY,title TEXT,description TEXT,image_thumb TEXT,image_screenshot TEXT,price TEXT,steamOnlyBadge INT,isHidden INT)');
$pdo->exec("INSERT INTO `0405_storefront_packages`(subid,title,description,image_thumb,image_screenshot,price,steamOnlyBadge,isHidden) VALUES(1,'Test','<b>bold</b> pkg','','','0',0,0)");
$row = $pdo->query('SELECT description FROM `0405_storefront_packages` WHERE subid=1')->fetchColumn();
if($row !== '<b>bold</b> pkg'){
    throw new Exception('Description mismatch');
}
