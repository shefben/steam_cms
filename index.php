<?php
if (isset($_GET['area'])) {
	$area = $_GET['area'];
}
else { $area = "main"; }
if (isset($_GET['tab'])) {
	$area = 'tab_'.$_GET['tab'];
}
elseif (isset($_GET['AppId'])) {
	$area = 'app_'.$_GET['AppId'];
}
elseif (isset($_GET['SubId'])) {
	$area = 'sub_'.$_GET['SubId'];
}
elseif (isset($_GET['publisher'])) {
	$area = 'publisher_'.$_GET['publisher'];
}
elseif ($area == "all" && (isset($_GET['page'])) && (!isset($_GET['genre']))) {
	$area = 'all_page'.$_GET['page'];
}
elseif ($area == "all" && (isset($_GET['genre'])) && (!isset($_GET['page']))) {
	$area = 'all_genre'.$_GET['genre'];
}
elseif ($area == "all" && (isset($_GET['page'])) && (isset($_GET['genre']))) {
	$area = 'all_genre'.$_GET['genre'].'_page'.$_GET['page'];
}
elseif ($area == "news" && (isset($_GET['id']))) {
	$area = 'news_'.$_GET['id'];
}
elseif ($area == "faq" && (isset($_GET['id']))) {
	$area = 'faq_'.$_GET['id'];
}
elseif ($area == "archives" && (isset($_GET['date']))) {
	$area = 'archive_'.$_GET['date'];
}
elseif ($area == "search" && (isset($_GET['category'])) && (!isset($_GET['developer']))) {
	$area = 'searchcategory_'.$_GET['category'];
}
elseif ($area == "search" && (isset($_GET['developer']))) {
	$area = 'searchdeveloper_'.$_GET['developer'];
}
elseif ($area == "screenshots" && (isset($_GET['id']))) {
	$area = 'screenshots_'.$_GET['id'];
}
elseif ($area == "redirect" && (isset($_GET['media']))) {
	$area = 'redirect_'.$_GET['media'];
}
elseif ($area == "redirect" && (isset($_GET['app']))) {
	$area = 'redirect_'.$_GET['app'];
}
elseif ($area == "redirect" && (isset($_GET['preload']))) {
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
if (($area == "dormant") && (isset($_GET['account'])))
	$area = 'dormant_account_'.$_GET['account'];
if (($area == "faq") && (isset($_GET['section'])))
	$area = 'faq_section_'.$_GET['section'];

if (file_exists($area.".php") == false) {
	$area = 'notfound';
}

include $area.".php";
?>