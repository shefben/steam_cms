<?php
if (isset($_GET['area'])) {
        $area = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['area']);
} else {
        require_once __DIR__.'/cms/db.php';
        $theme = cms_get_setting('theme','default');
        $tpl = __DIR__.'/themes/'.$theme.'/index_template.php';
        if(file_exists($tpl)){
                require 'home.php';
                exit;
        }
        header('Location: index.php?area=news');
        exit;
}
require_once __DIR__.'/cms/db.php';
$page = cms_get_custom_page($area);
if($page){
    $page_title = $page['title'];
    include 'cms/header.php';
    echo $page['content'];
    include 'cms/footer.php';
    exit;
}
if (isset($_GET['tab'])) {
        $tab = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['tab']);
        $area = 'tab_'.$tab;
} elseif (isset($_GET['AppId'])) {
        $id = preg_replace('/[^0-9]/','',$_GET['AppId']);
        $area = 'app_'.$id;
} elseif (isset($_GET['SubId'])) {
        $id = preg_replace('/[^0-9]/','',$_GET['SubId']);
        $area = 'sub_'.$id;
} elseif (isset($_GET['publisher'])) {
        $pub = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['publisher']);
        $area = 'publisher_'.$pub;
}
elseif ($area == "all" && (isset($_GET['page'])) && (!isset($_GET['genre']))) {
        $p = preg_replace('/[^0-9]/','',$_GET['page']);
        $area = 'all_page'.$p;
} elseif ($area == "all" && (isset($_GET['genre'])) && (!isset($_GET['page']))) {
        $g = preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['genre']);
        $area = 'all_genre'.$g;
} elseif ($area == "all" && (isset($_GET['page'])) && (isset($_GET['genre']))) {
        $p = preg_replace('/[^0-9]/','',$_GET['page']);
        $g = preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['genre']);
        $area = 'all_genre'.$g.'_page'.$p;
} elseif ($area == "news" && (isset($_GET['id']))) {
        $id = preg_replace('/[^0-9]/','',$_GET['id']);
        $area = 'news_'.$id;
} elseif ($area == "faq" && (isset($_GET['id']))) {
        $id = preg_replace('/[^0-9,]/','',$_GET['id']);
        $area = 'faq_'.$id;
} elseif ($area == "archives" && (isset($_GET['date']))) {
        $d = preg_replace('/[^0-9-]/','',$_GET['date']);
        $area = 'archive_'.$d;
} elseif ($area == "search" && (isset($_GET['category'])) && (!isset($_GET['developer']))) {
        $c = preg_replace('/[^0-9]/','',$_GET['category']);
        $area = 'searchcategory_'.$c;
} elseif ($area == "search" && (isset($_GET['developer']))) {
        $dev = preg_replace('/[^a-zA-Z0-9_-]/','',$_GET['developer']);
        $area = 'searchdeveloper_'.$dev;
} elseif ($area == "screenshots" && (isset($_GET['id']))) {
        $id = preg_replace('/[^0-9]/','',$_GET['id']);
        $area = 'screenshots_'.$id;
} elseif ($area == "redirect" && (isset($_GET['media']))) {
        $m = preg_replace('/[^a-zA-Z0-9_.-]/','',$_GET['media']);
        $area = 'redirect_'.$m;
} elseif ($area == "redirect" && (isset($_GET['app']))) {
        $a = preg_replace('/[^a-zA-Z0-9_.-]/','',$_GET['app']);
        $area = 'redirect_'.$a;
} elseif ($area == "redirect" && (isset($_GET['preload']))) {
        $p = preg_replace('/[^a-zA-Z0-9_.-]/','',$_GET['preload']);
        $area = 'redirect_'.$p;
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
if (($area == "dormant") && (isset($_GET['account']))) {
        $acct = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['account']);
        $area = 'dormant_account_'.$acct;
}
if (($area == "faq") && (isset($_GET['section']))) {
        $sec = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['section']);
        $area = 'faq_section_'.$sec;
}

// try to locate the requested page
$file = "$area.php";
if(!file_exists($file)){
    // some content lives in subdirectories (eg. faq pages)
    if(strpos($area,'faq_')===0 && file_exists("faq_pages/$file")){
        $file = "faq_pages/$file";
    }elseif(strpos($area,'news_')===0 && file_exists("news_pages/$file")){
        $file = "news_pages/$file";
    }else{
        $file = 'notfound.php';
    }
}

include $file;
?>
