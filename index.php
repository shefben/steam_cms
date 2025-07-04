<?php
if (isset($_GET['area'])) {
        $area = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['area']);
} else {
        // Render the home page when no specific area is requested.  The
        // home page logic lives in home.php which will determine the
        // appropriate theme and template to use.  Previously this block
        // attempted to check for a template using an undefined variable
        // $tpl which resulted in a redirect to the news page.  The news
        // page expects a template that doesn't exist in the default theme
        // leading to a blank page on first load.  Simply delegate to
        // home.php.
        require_once __DIR__.'/cms/db.php';
        require 'home.php';
        exit;
}
require_once __DIR__.'/cms/db.php';

if(in_array($area,['store','browse','search','game','package','all'])){
    $file=['store'=>'index','browse'=>'browse','search'=>'search','game'=>'game','package'=>'package','all'=>'all'][$area];
    include __DIR__.'/storefront/'.$file.'.php';
    exit;
}

// if a specific FAQ entry was requested, render it from the database
if($area === 'faq' && isset($_GET['id'])){
    $parts = array_map('intval', explode(',', preg_replace('/[^0-9,]/','',$_GET['id'])));
    if(count($parts) === 4){
        list($cat1,$cat2,$faq1,$faq2) = $parts;
        $stmt = cms_get_db()->prepare('SELECT title,body FROM faq_content WHERE catid1=? AND catid2=? AND faqid1=? AND faqid2=?');
        $stmt->execute([$cat1,$cat2,$faq1,$faq2]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $page_title = 'FAQ';
            include 'cms/header.php';
            echo "<div class=\"content\" id=\"container\">";
            echo '<h1>FREQUENTLY ASKED QUESTIONS</h1><div class="narrower">';
            echo '<h3>'.htmlspecialchars($row['title']).'</h3>';
            echo $row['body'];
            if(isset($_GET['return'])){
                $sec = preg_replace('/[^a-zA-Z0-9_]/','',$_GET['return']);
                echo '<ul><li><a href="index.php?area=faq&section='.$sec.'">Return to '.htmlspecialchars(ucfirst($sec)).' FAQ</a></li></ul>';
            }
            echo '</div></div>';
            include 'cms/footer.php';
            exit;
        }
    }
    $area = 'notfound';
}

$theme = cms_get_setting('theme','2004');
$page = cms_get_custom_page($area,$theme);
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
        $_GET['id'] = $id;
        $area = 'faq_entry';
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

if (file_exists($area.".php")) {
        include $area.".php";
        exit;
}

$page_title = 'Invalid Area';
$error_html = cms_get_setting('error_html','<p>Page not found.</p>');
include 'cms/header.php';
echo $error_html;
include 'cms/footer.php';
?>
