<?php
session_start();
require_once __DIR__ . '/../db.php';
if(!cms_current_admin()){
    if(isset($_COOKIE['cms_admin_id'],$_COOKIE['cms_admin_hash'])){
        $id=(int)$_COOKIE['cms_admin_id'];
        $hash=$_COOKIE['cms_admin_hash'];
        $db=cms_get_db();
        $stmt=$db->prepare('SELECT password FROM admin_users WHERE id=?');
        $stmt->execute([$id]);
        $pw=$stmt->fetchColumn();
        if($pw && $pw===$hash){
            $_SESSION['admin_id']=$id;
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
$theme_url = "/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)){
    $theme_dir = dirname(__DIR__,2)."/themes/default_admin";
    $theme_url = "/themes/default_admin";
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
    ['file'=>'cafe_signups.php','label'=>'Café Signups','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'admin_users.php','label'=>'Administrators','visible'=>1],
    ['file'=>'nav_manager.php','label'=>'Navigation','visible'=>1],
    ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
    ['file'=>'logo.php','label'=>'Logo','visible'=>1],
    ['file'=>'../logout.php','label'=>'Logout','visible'=>1]
];
$json = cms_get_setting('nav_items',null);
$nav_items = $json ? json_decode($json,true) : $default_nav;
if(!$nav_items) $nav_items = $default_nav;

$nav_html = '<ul class="nav-menu">';
foreach($nav_items as $item){
    if(!($item['visible']??1)) continue;
    $file = $item['file'];
    $label = $item['label'];
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($label).'</a></li>';
}
$nav_html .= '</ul>';

include "$theme_dir/header.php";
?>
