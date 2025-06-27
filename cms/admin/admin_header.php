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

$nav_items = [
    'index.php' => 'Dashboard',
    'main_content.php' => 'Main Content',
    'news.php' => 'News',
    'faq.php' => 'FAQ',
    'cafe_signups.php' => 'Café Signups',
    'content_servers.php' => 'Servers',
    'custom_pages.php' => 'Custom Pages',
    'theme.php' => 'Theme',
    'settings.php' => 'Settings',
    'admin_users.php' => 'Administrators',
    'error_page.php' => 'Error Page',
    'logo.php' => 'Logo',
    '../logout.php' => 'Logout'
];

$nav_html = '<ul class="nav-menu">';
foreach($nav_items as $file=>$label){
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($label).'</a></li>';
}
$nav_html .= '</ul>';

include "$theme_dir/header.php";
?>
