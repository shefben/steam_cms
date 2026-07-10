<?php
/**
 * PERFORMANCE OPTIMIZATION: Use centralized bootstrap
 * Previously had scattered require_once calls causing 50-100ms overhead
 */
$configFile = __DIR__ . DIRECTORY_SEPARATOR . 'cms' . DIRECTORY_SEPARATOR . 'config.php';
if (!is_file($configFile)) {
    header('Location: ./install.php');
    exit;
}

// PERFORMANCE OPTIMIZATION: Full Page Cache for anonymous users
require_once __DIR__ . '/cms/full_page_cache.php';
if (FullPageCache::serve()) {
    exit;
}
FullPageCache::start();

// Single bootstrap call replaces multiple scattered requires
require_once __DIR__ . '/cms/bootstrap.php';

if (isset($_GET['area'])) {
    $area = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['area']);
} else {
    // Render the home page when no specific area is requested
    require 'home.php';
    exit;
}

$storeDir = __DIR__ . '/storefront/';
cms_require_template_engine(); // Lazy-load template engine only when needed

if(in_array($area,['store','browse','search','game','package','all'])){
    $file=['store'=>'index','browse'=>'browse','search'=>'search','game'=>'game','package'=>'package','all'=>'all'][$area];
    include $storeDir.$file.'.php';
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

$theme = cms_get_current_theme(); // Use safer function that ensures non-empty theme
$page = cms_get_custom_page($area,$theme);
if($page){
    $page_title = $page['title'];
    $content = $page['content'];
    $tpl = cms_theme_layout($page['template'], $theme);
    cms_render_template($tpl, ['page_title'=>$page_title,'content'=>$content]);
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
        $_GET['id'] = $id; // keep area as "news" so news.php handles the article
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

header('Location: error.php');
exit;
?>
