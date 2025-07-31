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

$legacy_visible = in_array(cms_get_setting('theme','2004'), ['2004','2005_v1']) ? 1 : 0;
$default_nav = [
    ['file'=>'index.php','label'=>'Dashboard','visible'=>1],
    ['file'=>'main_content.php','label'=>'Main Content','visible'=>1],
    ['file'=>'news.php','label'=>'News','visible'=>1],
    ['file'=>'faq.php','label'=>'FAQ','visible'=>1],
    ['file'=>'map_contest_submissions.php','label'=>'Map Contest Submissions','visible'=>1],
    ['file'=>'cafe_signups.php','label'=>'Cafe Signup Requests','visible'=>1],
    ['file'=>'cafe_directory.php','label'=>'Cafe Directory','visible'=>1],
    ['file'=>'cafe_pricing.php','label'=>'Cafe Pricing','visible'=>1],
    ['file'=>'cafe_representatives.php','label'=>'Cafe Representatives','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
    ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
    ['file'=>'tournaments.php','label'=>'Tournament Management','visible'=>1],
    ['file'=>'custom_titles.php','label'=>'Custom Titles','visible'=>1],
    ['file'=>'random_content.php','label'=>'Random Content','visible'=>1],
    ['file'=>'random_groups.php','label'=>'Random Groups','visible'=>1],
    ['file'=>'scheduled_content.php','label'=>'Scheduled Content','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'download_page.php','label'=>'Download/Get Steam Now Management','visible'=>1],
    ['file'=>'troubleshooter.php','label'=>'Troubleshooter','visible'=>1],
    ['file'=>'troubleshooter_manage.php','label'=>'Manage Troubleshooter','visible'=>1],
    ['file'=>'troubleshooter_requests.php','label'=>'Support Requests','visible'=>1],
    ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
    ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1],
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
    'random_content.php' => '🎲',
    'random_groups.php' => '📁',
    'scheduled_content.php' => '📅',
    'theme.php'        => '🎨',
    'settings.php'     => '⚙️',
    'download_page.php' => '⬇️',
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
$faq_root = null;
$faq_pages = [];
$ts_root = null;
$ts_pages = [];
$cafe_pages = [];
$custom_groups = [];
foreach ($nav_items as $k => $item) {
    if (!($item['visible'] ?? 1)) continue;
    if (!empty($item['parent'])) {
        $custom_groups[$item['parent']][] = $item;
        unset($nav_items[$k]);
        continue;
    }
    if ($item['file'] === 'storefront.php') {
        $sf_root = $item;
        unset($nav_items[$k]);
    } elseif (preg_match('/^storefront.*\.php/', $item['file'])) {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'legacy_storefront.php') {
        $legacy_sf_root = $item;
        unset($nav_items[$k]);
    } elseif (preg_match('/^legacy_storefront_.*\.php/', $item['file'])) {
        $legacy_sf_pages[] = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'faq.php') {
        $faq_root = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'faq_categories.php') {
        $faq_pages[] = $item;
        unset($nav_items[$k]);
    } elseif ($item['file'] === 'troubleshooter.php') {
        $ts_root = $item;
        unset($nav_items[$k]);
    } elseif (preg_match('/^troubleshooter_.*\.php/', $item['file'])) {
        $ts_pages[] = $item;
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
    $label = cms_admin_translate($item['label']);
    $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
    $icon = $icons[$file] ?? '';
    if(isset($custom_groups[$file])){
        $open = false;
        foreach($custom_groups[$file] as $child){ if(strpos($_SERVER['PHP_SELF'],$child['file'])!==false){ $open=true; break; } }
        $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a><ul class="sub-menu" style="'.($open?'display:block':'display:none').'">';
        foreach($custom_groups[$file] as $child){
            if(!($child['visible']??1)) continue;
            $cfile=$child['file'];
            $clabel=cms_admin_translate($child['label']);
            $cac = strpos($_SERVER['PHP_SELF'],$cfile)!==false ? ' class="active"' : '';
            $cicon=$icons[$cfile]??'';
            $nav_html .= '<li><a href="'.$cfile.'"'.$cac.'>'.htmlspecialchars($cicon.' '.$clabel).'</a></li>';
        }
        $nav_html .= '</ul></li>';
        continue;
    }
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
    $root_label = cms_admin_translate($sf_root['label'] ?? 'Storefront');
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $icon = $icons[$root_file] ?? '';
    $sf_open = false;
    foreach ($sf_pages as $it) {
        if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false) { $sf_open = true; break; }
    }
    $nav_html .= '<li id="sf-parent"><a href="'.$root_file.'"'.$active.' aria-label="StoreFront menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($sf_pages) {
        $style = $sf_open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="sf-sub" style="'.$style.'">';
        foreach ($sf_pages as $it) {
            $file = $it['file'];
            $label = cms_admin_translate($it['label']);
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
    $root_label = cms_admin_translate($faq_root['label'] ?? 'FAQ');
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $icon = $icons[$root_file] ?? '';
    $faq_open = false;
    foreach ($faq_pages as $it) {
        if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false) { $faq_open = true; break; }
    }
    $nav_html .= '<li id="faq-parent"><a href="'.$root_file.'"'.$active.' aria-label="FAQ menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($faq_pages) {
        $style = $faq_open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="faq-sub" style="'.$style.'">';
        foreach ($faq_pages as $it) {
            $file = $it['file'];
            $label = cms_admin_translate($it['label']);
            $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
            $icon = $icons[$file] ?? '';
            $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
        }
        $nav_html .= '</ul>';
    }
    $nav_html .= '</li>';
}
$has_ts = $ts_root || $ts_pages;
if ($has_ts) {
    $root_file = $ts_root['file'] ?? 'troubleshooter.php';
    $root_label = cms_admin_translate($ts_root['label'] ?? 'Troubleshooter');
    $active = strpos($_SERVER['PHP_SELF'], $root_file)!==false ? ' class="active"' : '';
    $icon = $icons[$root_file] ?? '';
    $ts_open = false;
    foreach ($ts_pages as $it) {
        if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false) { $ts_open = true; break; }
    }
    $nav_html .= '<li id="ts-parent"><a href="'.$root_file.'"'.$active.' aria-label="Troubleshooter menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($ts_pages) {
        $style = $ts_open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="ts-sub" style="'.$style.'">';
        foreach ($ts_pages as $it) {
            $file = $it['file'];
            $label = cms_admin_translate($it['label']);
            $active = strpos($_SERVER['PHP_SELF'],$file)!==false ? ' class="active"' : '';
            $icon = $icons[$file] ?? '';
            $nav_html .= '<li><a href="'.$file.'"'.$active.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
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
    $icon = $icons[$root_file] ?? '🎮';
    $open = false;
    foreach ($legacy_sf_pages as $it) { if (strpos($_SERVER['PHP_SELF'],$it['file'])!==false){ $open=true; break; } }
    $nav_html .= '<li id="legacy-sf-parent"><a href="'.$root_file.'"'.$active.' aria-label="Legacy Storefront menu">'.htmlspecialchars($icon.' '.$root_label).'</a>';
    if ($legacy_sf_pages) {
        $style = $open ? 'display:block' : 'display:none';
        $nav_html .= '<ul class="sub-menu" id="legacy-sf-sub" style="'.$style.'">';
        foreach ($legacy_sf_pages as $it) {
            $file=$it['file'];$label=cms_admin_translate($it['label']);
            $ac=strpos($_SERVER['PHP_SELF'],$file)!==false?' class="active"':'';
            $icon=$icons[$file]??'';
            $nav_html .= '<li><a href="'.$file.'"'.$ac.'>'.htmlspecialchars($icon.' '.$label).'</a></li>';
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
    $cafe_open = $active ? true : false;
    $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu">'.htmlspecialchars($icon.' '.cms_admin_translate('Cyber Cafe Management')).'</a>';
    $style = $cafe_open ? 'display:block' : 'display:none';
    $nav_html .= '<ul class="sub-menu" id="cafe-sub" style="'.$style.'">';
    foreach($cafe_pages as $it){
        $file=$it['file'];$label=cms_admin_translate($it['label']);
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
