<?php
if (isset($_GET['area'])) {
	$area = $_GET['area'];
}
else { $area = "main"; }
if (isset($_GET['tab'])) {
	$area = 'tab_'.$_GET['tab'];
}
if (isset($_GET['AppId'])) {
	$area = 'app_'.$_GET['AppId'];
}
if (isset($_GET['SubId'])) {
	$area = 'sub_'.$_GET['SubId'];
}
if (isset($_GET['publisher'])) {
	$area = 'publisher_'.$_GET['publisher'];
}
if ($area == "all" && (isset($_GET['page'])) && (!isset($_GET['genre']))) {
	$area = 'all_page'.$_GET['page'];
}
if ($area == "all" && (isset($_GET['genre'])) && (!isset($_GET['page']))) {
	$area = 'all_genre'.$_GET['genre'];
}
if ($area == "all" && (isset($_GET['page'])) && (isset($_GET['genre']))) {
	$area = 'all_genre'.$_GET['genre'].'_page'.$_GET['page'];
}
if ($area == "news" && (isset($_GET['id']))) {
	$area = 'news_'.$_GET['id'];
}
if ($area == "faq" && (isset($_GET['id']))) {
	$area = 'faq_'.$_GET['id'];
}
if ($area == "archives" && (isset($_GET['date']))) {
	$area = 'archive_'.$_GET['date'];
}
if ($area == "search" && (isset($_GET['category'])) && (!isset($_GET['developer']))) {
	$area = 'searchcategory_'.$_GET['category'];
}
if ($area == "search" && (isset($_GET['developer']))) {
	$area = 'searchdeveloper_'.$_GET['developer'];
}
if ($area == "screenshots" && (isset($_GET['id']))) {
	$area = 'screenshots_'.$_GET['id'];
}
if ($area == "redirect" && (isset($_GET['media']))) {
	$area = 'redirect_'.$_GET['media'];
}
if ($area == "redirect" && (isset($_GET['app']))) {
	$area = 'redirect_'.$_GET['app'];
}
if ($area == "redirect" && (isset($_GET['preload']))) {
	$area = 'redirect_'.$_GET['preload'];
}

if ($area == "game")
	$area = 'main';
if ($area == "package")
	$area = 'main';
if ($area == "screenshots")
	$area = 'main';
if ($area == "free")
	$area = 'tab_demos';
if ($area == "all")
	$area = 'all_initial';

include $area.".php";
?>