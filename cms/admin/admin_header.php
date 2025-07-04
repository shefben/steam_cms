<?php
session_start();
require_once __DIR__ . '/../db.php';
if(!cms_current_admin()){
    if(isset($_COOKIE['cms_admin_token'])){
        $uid=cms_validate_admin_token($_COOKIE['cms_admin_token']);
        if($uid){
            session_regenerate_id(true);
            $_SESSION['admin_id']=$uid;
        }
    }
    if(!cms_current_admin()){
        $ret=urlencode($_SERVER['REQUEST_URI']);
        header('Location: ../login.php?return='.$ret);
        exit;
    }
}
$admin_theme = cms_get_setting('admin_theme','v2');
$theme_dir = dirname(__DIR__,2)."/themes/{$admin_theme}_admin";
$base_url = cms_base_url();
$theme_url = ($base_url? $base_url : '')."/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)){
    $theme_dir = dirname(__DIR__,2)."/themes/default_admin";
    $theme_url = ($base_url? $base_url : '')."/themes/default_admin";
}
$admin_id = cms_current_admin();
$db = cms_get_db();
$stmt = $db->prepare('SELECT username FROM admin_users WHERE id=?');
$stmt->execute([$admin_id]);
$admin_name = $stmt->fetchColumn() ?: 'admin';

$default_nav = [
    ['file'=>'index.php','label'=>'Dashboard','visible'=>1],
    ['file'=>'main_content.php','label'=>'Main Content','visible'=>1],
    ['file'=>'news.php','label'=>'News','visible'=>1],
    ['file'=>'faq.php','label'=>'FAQ','visible'=>1],
    ['file'=>'cybercafe.php','label'=>'Cyber Cafe Management','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
    ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
    ['file'=>'storefront_main.php','label'=>'Main Page','visible'=>1],
    ['file'=>'storefront.php','label'=>'Storefront','visible'=>1],
    ['file'=>'storefront.php#products','label'=>'Products','visible'=>1],
    ['file'=>'storefront.php#categories','label'=>'Categories','visible'=>1],
    ['file'=>'storefront_developers.php','label'=>'Developers','visible'=>1],
    ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1],
    ['file'=>'admin_users.php','label'=>'Administrators','visible'=>1],
    ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
    ['file'=>'../logout.php','label'=>'Logout','visible'=>1]
];
$json = cms_get_setting('nav_items',null);
$nav_items = $json ? json_decode($json,true) : $default_nav;
if(!$nav_items) $nav_items = $default_nav;

$icons = [
    'index.php'        => '📊',
    'main_content.php' => '📝',
    'news.php'         => '📰',
    'faq.php'          => '❓',
    'cybercafe.php'    => '☕',
    'content_servers.php' => '🖥️',
    'contentserver_banners.php' => '🖼️',
    'custom_pages.php' => '📄',
    'theme.php'        => '🎨',
    'settings.php'     => '⚙️',
    'header_footer.php'=> '📑',
    'storefront.php'   => '🏬',
    'storefront_main.php' => '🖼️',
    'storefront.php#products' => '🛒',
    'storefront.php#categories' => '📂',
    'storefront_developers.php' => '👥',
    'faq_categories.php'=> '📂',
    'admin_users.php'  => '👥',
    'error_page.php'   => '❌',
    '../logout.php'    => '🚪',
];

$sf_pages = [];
foreach ($nav_items as $k => $item) {
    if (!($item['visible'] ?? 1)) continue;
    if (preg_match('/^storefront.*\.php/', $item['file'])) {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
    }
}

$nav_html = '<ul class="nav-menu">';
foreach ($nav_items as $item) {
    if(!($item['visible']??1)) continue;
    $file = $item['file'];
    if ($file === 'support_2003.php' || $file === 'cafe_signups.php') continue;
    $label = $item['label'];
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    $icon = $icons[$file] ?? '';
    $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
}
if ($sf_pages) {
    $nav_html .= '<li id="sf-parent"><a href="#" aria-label="StoreFront menu">🏬 StoreFront</a><ul class="sub-menu" id="sf-sub" style="display:none">';
    foreach ($sf_pages as $it) {
        $file = $it['file'];
        $label = $it['label'];
        $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
        $icon = $icons[$file] ?? '';
        $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
    }
    $nav_html .= '</ul></li>';
}
$nav_html .= '</ul>';

include "$theme_dir/header.php";
?>
