<?php
session_start();
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../template_engine.php';
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
$theme_dir   = dirname(__DIR__,2) . "/themes/{$admin_theme}_admin";
$base_url    = cms_base_url();
$theme_url   = ($base_url ? $base_url : '') . "/themes/{$admin_theme}_admin";
if (!is_dir($theme_dir)) {
    $theme_dir = dirname(__DIR__,2) . "/themes/default_admin";
    $theme_url = ($base_url ? $base_url : '') . "/themes/default_admin";
}
$page_id     = basename($_SERVER['SCRIPT_NAME'], '.php');
$page_title  = ucwords(str_replace('_', ' ', $page_id));
$admin_layout = cms_admin_layout($page_id . '.twig', $admin_theme);
if ($admin_layout) {
    ob_start();
}
$admin_id = cms_current_admin();
$db = cms_get_db();
$stmt = $db->prepare('SELECT username FROM admin_users WHERE id=?');
$stmt->execute([$admin_id]);
$admin_name = $stmt->fetchColumn() ?: 'admin';

$notes = cms_get_unread_notifications($admin_id);
$notifications_html = '';
if ($notes) {
    $notifications_html = '<div class="notifications"><ul>';
    foreach ($notes as $n) {
        $id = (int)$n['id'];
        $type = htmlspecialchars($n['type']);
        $msg = htmlspecialchars($n['message']);
        $notifications_html .= "<li><strong>{$type}</strong>: {$msg} <button class=\"notify-dismiss\" data-id=\"{$id}\" aria-label=\"Dismiss\">&times;</button></li>";
    }
    $notifications_html .= '</ul></div>';
}

$current_theme = cms_get_setting('theme','2004');
$legacy_visible = in_array($current_theme, ['2004','2005_v1']) ? 1 : 0;
$default_nav = [
    ['file'=>'index.php','label'=>'Dashboard','visible'=>1],
    ['file'=>'main_content.php','label'=>'Main Content','visible'=>1],
    ['file'=>'news.php','label'=>'News','visible'=>1],
    ['file'=>'faq.php','label'=>'FAQ','visible'=>1,'parent'=>'support_page.php'],
    ['file'=>'map_contest_submissions.php','label'=>'Map Contest Submissions','visible'=>1],
    ['file'=>'cafe_signups.php','label'=>'Cafe Signup Requests','visible'=>1],
    ['file'=>'cafe_directory.php','label'=>'Cafe Directory','visible'=>1],
    ['file'=>'cafe_pricing.php','label'=>'Cafe Pricing','visible'=>1],
    ['file'=>'cafe_representatives.php','label'=>'Cafe Representatives','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1,'parent'=>'survey_stats.php'],
    ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1,'parent'=>'survey_stats.php'],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
    ['file'=>'tournaments.php','label'=>'Tournament Management','visible'=>1],
    ['file'=>'custom_titles.php','label'=>'Custom Titles','visible'=>1],
    ['file'=>'media.php','label'=>'Media','visible'=>1],
    ['file'=>'redirects.php','label'=>'Redirects','visible'=>1],
    ['file'=>'support_page.php','label'=>'Support & FAQ Management','visible'=>1],
    ['file'=>'random_content.php','label'=>'Random Content Management','visible'=>1],
    ['file'=>'random_content.php','label'=>'Random Content','visible'=>1,'parent'=>'random_content.php'],
    ['file'=>'random_groups.php','label'=>'Random Groups','visible'=>1,'parent'=>'random_content.php'],
    ['file'=>'survey_stats.php','label'=>'Survey & Content Server Management','visible'=>1],
    ['file'=>'scheduled_content.php','label'=>'Scheduled Content','visible'=>1],
    ['file'=>'update_history.php','label'=>'Update History Management','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'download_files.php','label'=>'File Management','visible'=>1],
    ['file'=>'download_settings.php','label'=>'Download Settings','visible'=>1],
    ['file'=>'page_selection.php','label'=>'Page Version Management','visible'=>1],
    ['file'=>'troubleshooter.php','label'=>'Troubleshooter','visible'=>1,'parent'=>'support_page.php'],
    ['file'=>'troubleshooter_manage.php','label'=>'Troubleshooter Management','visible'=>1,'parent'=>'support_page.php'],
    ['file'=>'troubleshooter_requests.php','label'=>'Requests Viewer','visible'=>1,'parent'=>'support_page.php'],
    ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
    ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1,'parent'=>'support_page.php'],
    ['file'=>'admin_users.php','label'=>'Administrators','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'roles.php','label'=>'Roles','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'activity_log.php','label'=>'Activity Log','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'error_log.php','label'=>'Error Log','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
    ['file'=>'storefront.php','label'=>'Storefront','visible'=>1],
    ['file'=>'storefront_main.php','label'=>'Main Page','visible'=>1],
    ['file'=>'storefront_products.php','label'=>'Products','visible'=>1],
    ['file'=>'storefront_categories.php','label'=>'Categories','visible'=>1],
    ['file'=>'storefront_sidebar.php','label'=>'Sidebar','visible'=>1],
    ['file'=>'storefront_developers.php','label'=>'Developers','visible'=>1],
    ['file'=>'index_management.php','label'=>'2006+ Index Management','visible'=>1],
    ['file'=>'capsule_management_2006.php','label'=>'Index Capsule Management','visible'=>1,'parent'=>'index_management.php'],
    ['file'=>'index_sidebar_management.php','label'=>'Index Sidebar Management','visible'=>1,'parent'=>'index_management.php'],
    ['file'=>'legacy_storefront.php','label'=>'2004/2005 Storefront Management','visible'=>$legacy_visible],
    ['file'=>'legacy_storefront_games.php','label'=>'Game management','visible'=>$legacy_visible,'parent'=>'legacy_storefront.php'],
    ['file'=>'legacy_storefront_thirdparty.php','label'=>'Thirdparty Game management','visible'=>$legacy_visible,'parent'=>'legacy_storefront.php'],
    ['file'=>'legacy_storefront_packages.php','label'=>'Package/Subscription Management','visible'=>$legacy_visible,'parent'=>'legacy_storefront.php'],
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
    'map_contest_submissions.php' => '🗺️',
    'cafe_signups.php' => '☕',
    'cafe_directory.php' => '📑',
    'cafe_pricing.php' => '💲',
    'cafe_representatives.php' => '🤝',
    'content_servers.php' => '🖥️',
    'contentserver_banners.php' => '🖼️',
    'custom_pages.php' => '📄',
    'tournaments.php'  => '🏆',
    'support_page.php' => '🛟',
    'custom_titles.php' => '🔤',
    'redirects.php' => '↪️',
    'random_content.php' => '🎲',
    'random_groups.php' => '📁',
    'survey_stats.php' => '📈',
    'scheduled_content.php' => '📅',
    'update_history.php' => '📜',
    'theme.php'        => '🎨',
    'settings.php'     => '⚙️',
    'download_files.php' => '⬇️',
    'download_settings.php' => '🛠️',
    'page_selection.php' => '📄',
    'troubleshooter.php' => '🆘',
    'troubleshooter_manage.php' => '📝',
    'troubleshooter_requests.php' => '📬',
    'header_footer.php'=> '📑',
    'storefront.php'   => '🏬',
    'storefront_main.php' => '🖼️',
    'storefront_products.php' => '🛒',
    'storefront_categories.php' => '📂',
    'storefront_sidebar.php' => '🔗',
    'storefront_developers.php' => '👥',
    'index_management.php' => '🗂️',
    'capsule_management_2006.php' => '🧩',
    'index_sidebar_management.php' => '📚',
    'legacy_storefront.php' => '🎮',
    'legacy_storefront_games.php' => '🎮',
    'legacy_storefront_thirdparty.php' => '🎮',
    'legacy_storefront_packages.php' => '🎮',
    'faq_categories.php'=> '📂',
    'admin_users.php'  => '👥',
    'roles.php'        => '🔑',
    'activity_log.php' => '📜',
    'error_log.php'    => '🐞',
    'error_page.php'   => '❌',
    '../logout.php'    => '🚪',
];

$sf_root = null;
$sf_pages = [];
$legacy_sf_root = null;
$legacy_sf_pages = [];
$cafe_pages = [];
$download_pages = [];
$custom_groups = [];
foreach ($nav_items as $k => $item) {
    if (!($item['visible'] ?? 1)) continue;
    if ($item['file'] === 'storefront.php') {
        $sf_root = $item;
        unset($nav_items[$k]);
        continue;
    } elseif (preg_match('/^storefront.*\\.php/', $item['file'])) {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    } elseif ($item['file'] === 'media.php') {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    } elseif ($item['file'] === 'legacy_storefront.php') {
        $legacy_sf_root = $item;
        unset($nav_items[$k]);
        continue;
    } elseif (preg_match('/^legacy_storefront_.*\\.php/', $item['file'])) {
        $legacy_sf_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    } elseif (preg_match('/^cafe_.*\\.php/', $item['file'])) {
        $cafe_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    } elseif (preg_match('/^download_.*\\.php/', $item['file'])) {
        $download_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    }
    if (!empty($item['parent'])) {
        $custom_groups[$item['parent']][] = $item;
        unset($nav_items[$k]);
    }
}

$use_spans = ($admin_theme === 'neon');
$nav_html = '<ul class="nav-menu">';
$logout = null;
$make_link = function(string $file, string $label, string $active = '', string $extra = '') use ($icons, $use_spans): string {
    $icon = $icons[$file] ?? '';
    if ($use_spans) {
        $icon_html = $icon !== '' ? '<span class="nav-icon">'.htmlspecialchars($icon).'</span>' : '';
        return '<a href="'.$file.'"'.$active.$extra.'>'.$icon_html.'<span class="nav-label">'.htmlspecialchars($label).'</span></a>';
    }
    $text = trim(($icon ? $icon.' ' : '').$label);
    return '<a href="'.$file.'"'.$active.$extra.'>'.htmlspecialchars($text).'</a>';
};
foreach ($nav_items as $item) {
    if(!($item['visible']??1)) continue;
    $file = $item['file'];
    if ($file === 'support_2003.php') continue;
    $label = cms_admin_translate($item['label']);
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    if(isset($custom_groups[$file])){
        $open = false;
        foreach($custom_groups[$file] as $child){ if(strpos($_SERVER['PHP_SELF'],$child['file'])!==false){ $open=true; break; } }
        $parent_id = preg_replace('/\.php$/','',$file).'-parent';
        $sub_id = preg_replace('/\.php$/','',$file).'-sub';
        $nav_html .= '<li id="'.$parent_id.'">'.$make_link($file,$label,$active);
        if($admin_theme === 'neon'){
            $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($open?'true':'false').'" aria-controls="'.$sub_id.'"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
        }
        $nav_html .= '<ul class="sub-menu" id="'.$sub_id.'" style="'.($open?'display:block':'display:none').'">';
        foreach($custom_groups[$file] as $child){
            if(!($child['visible']??1)) continue;
            $cfile=$child['file'];
            $clabel=cms_admin_translate($child['label']);
            $cac = strpos($_SERVER['PHP_SELF'],$cfile)!==false ? ' class="active"' : '';
            $nav_html .= '<li>'.$make_link($cfile,$clabel,$cac).'</li>';
        }
        $nav_html .= '</ul></li>';
        continue;
    }
    $item_html = '<li>'.$make_link($file,$label,$active).'</li>';
    if($file === '../logout.php'){
        $logout = $item_html;
        continue;
    }
    $nav_html .= $item_html;
}
$has_sf = $sf_root || $sf_pages;
if ($has_sf) {
    $root_file = $sf_root['file'] ?? 'storefront.php';
    $root_label = cms_admin_translate($sf_root['label'] ?? 'Storefront');
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $sf_open = false;
    foreach ($sf_pages as $it) {
        if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false) { $sf_open = true; break; }
    }
    $nav_html .= '<li id="sf-parent">'.$make_link($root_file,$root_label,$active,' aria-label="StoreFront menu"');
    if ($sf_pages) {
        if($admin_theme === 'neon'){
            $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($sf_open?'true':'false').'" aria-controls="sf-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
        }
        $style = $sf_open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="sf-sub" style="'.$style.'">';
        foreach ($sf_pages as $it) {
            $file = $it['file'];
            $label = cms_admin_translate($it['label']);
            $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
            $nav_html .= '<li>'.$make_link($file,$label,$active).'</li>';
        }
        $nav_html .= '</ul>';
    }
    $nav_html .= '</li>';
}
$has_leg = ($legacy_sf_root || $legacy_sf_pages) && $legacy_visible;
if ($has_leg) {
    $root_file = $legacy_sf_root['file'] ?? 'legacy_storefront.php';
    $root_label = cms_admin_translate($legacy_sf_root['label'] ?? '2004/2005 Storefront Management');
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $open = false;
    foreach ($legacy_sf_pages as $it) { if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false){ $open=true; break; } }
    $nav_html .= '<li id="legacy-sf-parent">'.$make_link($root_file,$root_label,$active,' aria-label="Legacy Storefront menu"');
    if ($legacy_sf_pages) {
        if($admin_theme === 'neon'){
            $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($open?'true':'false').'" aria-controls="legacy-sf-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
        }
        $style = $open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="legacy-sf-sub" style="'.$style.'">';
        foreach ($legacy_sf_pages as $it) {
            $file=$it['file'];$label=cms_admin_translate($it['label']);
            $ac=strpos($_SERVER['PHP_SELF'],$file)!==false?' class="active"':'';
            $nav_html .= '<li>'.$make_link($file,$label,$ac).'</li>';
        }
        $nav_html .= '</ul>';
    }
    $nav_html .= '</li>';
}
$has_download = !empty($download_pages);
if($has_download){
    $icon = '⬇️';
    $active = '';
    foreach($download_pages as $it){
        if(strpos($_SERVER['PHP_SELF'],$it['file'])!==false){$active=' class="active"';break;}
    }
    $open = $active ? true : false;
    if($use_spans){
        $nav_html .= '<li id="download-parent"><a href="#"'.$active.' aria-label="Download menu"><span class="nav-icon">'.htmlspecialchars($icon).'</span><span class="nav-label">'.htmlspecialchars(cms_admin_translate('Download System Management')).'</span></a>';
    }else{
        $nav_html .= '<li id="download-parent"><a href="#"'.$active.' aria-label="Download menu">'.htmlspecialchars($icon.' '.cms_admin_translate('Download System Management')).'</a>';
    }
    if($admin_theme === 'neon'){
        $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($open?'true':'false').'" aria-controls="download-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
    }
    $style = $open ? 'display:block' : 'display:none';
    $nav_html .= '<ul class="sub-menu" id="download-sub" style="'.$style.'">';
    foreach($download_pages as $it){
        $file=$it['file'];$label=cms_admin_translate($it['label']);
        $ac=strpos($_SERVER['PHP_SELF'],$file)!==false?' class="active"':'';
        $nav_html.='<li>'.$make_link($file,$label,$ac).'</li>';
    }
    $nav_html.='</ul></li>';
}
$has_cafe = !empty($cafe_pages);
if($has_cafe){
    $icon = '☕';
    $active = '';
    foreach($cafe_pages as $it){
        if(strpos($_SERVER['PHP_SELF'],$it['file'])!==false){$active=' class="active"';break;}
    }
    $cafe_open = $active ? true : false;
    if($use_spans){
        $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu"><span class="nav-icon">'.htmlspecialchars($icon).'</span><span class="nav-label">'.htmlspecialchars(cms_admin_translate('Cyber Cafe Management')).'</span></a>';
    }else{
        $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu">'.htmlspecialchars($icon.' '.cms_admin_translate('Cyber Cafe Management')).'</a>';
    }
    if($admin_theme === 'neon'){
        $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($cafe_open?'true':'false').'" aria-controls="cafe-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
    }
    $style = $cafe_open ? 'display:block' : 'display:none';
    $nav_html .= '<ul class="sub-menu" id="cafe-sub" style="'.$style.'">';
    foreach($cafe_pages as $it){
        $file=$it['file'];$label=cms_admin_translate($it['label']);
        $ac=strpos($_SERVER['PHP_SELF'],$file)!==false?' class="active"':'';
        $nav_html.='<li>'.$make_link($file,$label,$ac).'</li>';
    }
    $nav_html.='</ul></li>';
}
$nav_html .= $logout ? $logout : '';
$nav_html .= '</ul>';

if (!$admin_layout) {
    include "$theme_dir/header.php";
}
?>
