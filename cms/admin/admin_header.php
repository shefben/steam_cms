<?php
session_start();
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/breadcrumbs.php';
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
    ['file'=>'cafe_signups.php','label'=>'Cafe Signup Requests','visible'=>1],
    ['file'=>'cafe_directory.php','label'=>'Cafe Directory','visible'=>1],
    ['file'=>'cafe_pricing.php','label'=>'Cafe Pricing','visible'=>1],
    ['file'=>'cafe_representatives.php','label'=>'Cafe Representatives','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
    ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
    ['file'=>'custom_titles.php','label'=>'Custom Titles','visible'=>1],
    ['file'=>'random_content.php','label'=>'Random Content','visible'=>1],
    ['file'=>'scheduled_content.php','label'=>'Scheduled Content','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
    ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1],
    ['file'=>'admin_users.php','label'=>'Administrators','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'roles.php','label'=>'Roles','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'activity_log.php','label'=>'Activity Log','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
    ['file'=>'storefront.php','label'=>'Storefront','visible'=>1],
    ['file'=>'storefront_main.php','label'=>'Main Page','visible'=>1],
    ['file'=>'storefront_products.php','label'=>'Products','visible'=>1],
    ['file'=>'storefront_categories.php','label'=>'Categories','visible'=>1],
    ['file'=>'storefront_sidebar.php','label'=>'Sidebar','visible'=>1],
    ['file'=>'storefront_developers.php','label'=>'Developers','visible'=>1],
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
    'cafe_signups.php' => '☕',
    'cafe_directory.php' => '📑',
    'cafe_pricing.php' => '💲',
    'cafe_representatives.php' => '🤝',
    'content_servers.php' => '🖥️',
    'contentserver_banners.php' => '🖼️',
    'custom_pages.php' => '📄',
    'custom_titles.php' => '🔤',
    'random_content.php' => '🎲',
    'scheduled_content.php' => '📅',
    'theme.php'        => '🎨',
    'settings.php'     => '⚙️',
    'header_footer.php'=> '📑',
    'storefront.php'   => '🏬',
    'storefront_main.php' => '🖼️',
    'storefront_products.php' => '🛒',
    'storefront_categories.php' => '📂',
    'storefront_sidebar.php' => '🔗',
    'storefront_developers.php' => '👥',
    'faq_categories.php'=> '📂',
    'admin_users.php'  => '👥',
    'roles.php'        => '🔑',
    'activity_log.php' => '📜',
    'error_page.php'   => '❌',
    '../logout.php'    => '🚪',
];

$sf_root = null;
$sf_pages = [];
$faq_root = null;
$faq_pages = [];
$cafe_pages = [];
foreach ($nav_items as $k => $item) {
    if (!($item['visible'] ?? 1)) continue;
    if ($item['file'] === 'storefront.php') {
        $sf_root = $item;
        unset($nav_items[$k]);
    } elseif (preg_match('/^storefront.*\.php/', $item['file'])) {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'faq.php') {
        $faq_root = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'faq_categories.php') {
        $faq_pages[] = $item;
        unset($nav_items[$k]);
    } elseif (preg_match('/^cafe_.*\.php/', $item['file'])) {
        $cafe_pages[] = $item;
        unset($nav_items[$k]);
    }
}

if ($faq_root) {
    array_unshift($faq_pages, ['file' => $faq_root['file'], 'label' => 'Frequently Asked Questions']);
}

$nav_html = '<ul class="nav-menu">';
$logout = null;
foreach ($nav_items as $item) {
    if(!($item['visible']??1)) continue;
    $file = $item['file'];
    if ($file === 'support_2003.php') continue;
    $label = $item['label'];
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    $icon = $icons[$file] ?? '';
    $item_html = '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
    if($file === '../logout.php'){
        $logout = $item_html;
        continue;
    }
    $nav_html .= $item_html;
}
$has_sf = $sf_root || $sf_pages;
if ($has_sf) {
    $root_file = $sf_root['file'] ?? 'storefront.php';
    $root_label = $sf_root['label'] ?? 'Storefront';
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $icon = $icons[$root_file] ?? '';
    $nav_html .= '<li id="sf-parent"><a href="'.$root_file.'"'.$active.' aria-label="StoreFront menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($sf_pages) {
        $nav_html .= '<ul class="sub-menu" id="sf-sub" style="display:none">';
        foreach ($sf_pages as $it) {
            $file = $it['file'];
            $label = $it['label'];
            $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
            $icon = $icons[$file] ?? '';
            $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
        }
        $nav_html .= '</ul>';
    }
    $nav_html .= '</li>';
}
$has_faq = $faq_root || $faq_pages;
if ($has_faq) {
    $root_file = $faq_root['file'] ?? 'faq.php';
    $root_label = $faq_root['label'] ?? 'FAQ';
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $icon = $icons[$root_file] ?? '';
    $nav_html .= '<li id="faq-parent"><a href="'.$root_file.'"'.$active.' aria-label="FAQ menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($faq_pages) {
        $nav_html .= '<ul class="sub-menu" id="faq-sub" style="display:none">';
        foreach ($faq_pages as $it) {
            $file = $it['file'];
            $label = $it['label'];
            $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
            $icon = $icons[$file] ?? '';
            $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
        }
        $nav_html .= '</ul>';
    }
    $nav_html .= '</li>';
}
$has_cafe = !empty($cafe_pages);
if($has_cafe){
    $icon = '☕';
    $active = '';
    foreach($cafe_pages as $it){
        if(strpos($_SERVER['PHP_SELF'],$it['file'])!==false){$active=' class="active"';break;}
    }
    $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu">'.htmlspecialchars($icon.' Cyber Cafe Management').'</a>';
    $nav_html .= '<ul class="sub-menu" id="cafe-sub" style="display:none">';
    foreach($cafe_pages as $it){
        $file=$it['file'];$label=$it['label'];
        $ac=strpos($_SERVER['PHP_SELF'],$file)!==false?' class="active"':'';
        $icon=$icons[$file]??'';
        $nav_html.='<li><a href="'.$file.'"'.$ac.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
    }
    $nav_html.='</ul></li>';
}
$nav_html .= $logout ? $logout : '';
$nav_html .= '</ul>';

include "$theme_dir/header.php";
?>
