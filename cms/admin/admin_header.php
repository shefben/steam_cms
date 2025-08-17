<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../template_engine.php';
require_once __DIR__ . '/../plugin_api.php'; // load plugin system
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
    ['file'=>'map_contest_submissions.php','label'=>'Map Contest Submissions','visible'=>1],
    ['file'=>'cafe_signups.php','label'=>'Cafe Signup Requests','visible'=>1],
    ['file'=>'cafe_directory.php','label'=>'Cafe Directory','visible'=>1],
    ['file'=>'cafe_pricing.php','label'=>'Cafe Pricing','visible'=>1],
    ['file'=>'cafe_representatives.php','label'=>'Cafe Representatives','visible'=>1],
    ['file'=>'content_servers.php','label'=>'Servers','visible'=>1,'parent'=>'survey_stats'],
    ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1,'parent'=>'survey_stats'],
    ['file'=>'tournaments.php','label'=>'Tournament Management','visible'=>1],
    ['file'=>'media.php','label'=>'Media','visible'=>1],
    ['file'=>'redirects.php','label'=>'Redirects','visible'=>1],
    ['file'=>'support_faq','label'=>'Support & FAQ','visible'=>1],
    ['file'=>'faq_management','label'=>'FAQ Management','visible'=>1,'parent'=>'support_faq'],
    ['file'=>'faq.php','label'=>'FAQ','visible'=>1,'parent'=>'faq_management'],
    ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1,'parent'=>'faq_management'],
    ['file'=>'support_page.php','label'=>'Support Page','visible'=>1,'parent'=>'support_faq'],
    ['file'=>'bug_reports.php','label'=>'Bug Reports','visible'=>1,'parent'=>'support_faq'],
    ['file'=>'troubleshooter','label'=>'Troubleshooter','visible'=>1,'parent'=>'support_faq'],
    ['file'=>'troubleshooter.php','label'=>'Troubleshooter','visible'=>1,'parent'=>'troubleshooter'],
    ['file'=>'troubleshooter_manage.php','label'=>'Troubleshooter Management','visible'=>1,'parent'=>'troubleshooter'],
    ['file'=>'troubleshooter_requests.php','label'=>'Requests Viewer','visible'=>1,'parent'=>'troubleshooter'],
    ['file'=>'content_management','label'=>'Content Management','visible'=>1],
    ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1,'parent'=>'content_management'],
    ['file'=>'error_page.php','label'=>'Error Page','visible'=>1,'parent'=>'content_management'],
    ['file'=>'custom_titles.php','label'=>'Custom Titles','visible'=>1,'parent'=>'content_management'],
    ['file'=>'page_selection.php','label'=>'Page Version Management','visible'=>1,'parent'=>'content_management'],
    ['file'=>'scheduled_content.php','label'=>'Scheduled Content','visible'=>1,'parent'=>'content_management'],
    ['file'=>'random_content','label'=>'Random Content Management','visible'=>1],
    ['file'=>'random_content.php','label'=>'Random Content','visible'=>1,'parent'=>'random_content'],
    ['file'=>'random_groups.php','label'=>'Random Groups','visible'=>1,'parent'=>'random_content'],
    ['file'=>'preload_marketing.php','label'=>'Preload Marketing Content','visible'=>1],
    ['file'=>'survey_stats','label'=>'Survey & Content Server Management','visible'=>1],
    ['file'=>'update_history.php','label'=>'Update History Management','visible'=>1],
    ['file'=>'theme.php','label'=>'Theme','visible'=>1],
    ['file'=>'settings.php','label'=>'Settings','visible'=>1],
    ['file'=>'download_files.php','label'=>'File Management','visible'=>1],
    ['file'=>'download_settings.php','label'=>'Download Settings','visible'=>1],
    ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
    ['file'=>'admin_users.php','label'=>'Administrators','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'roles.php','label'=>'Roles','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'activity_log.php','label'=>'Activity Log','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'error_log.php','label'=>'Error Log','visible'=>cms_has_permission('manage_admins')?1:0],
    ['file'=>'storefront_management','label'=>'Storefront Management','visible'=>1],
    ['file'=>'storefront','label'=>'Storefront','visible'=>1,'parent'=>'storefront_management'],
    ['file'=>'storefront_main.php','label'=>'Main Page','visible'=>1,'parent'=>'storefront'],
    ['file'=>'storefront_products.php','label'=>'Products','visible'=>1,'parent'=>'storefront'],
    ['file'=>'storefront_categories.php','label'=>'Categories','visible'=>1,'parent'=>'storefront'],
    ['file'=>'storefront_sidebar.php','label'=>'Sidebar','visible'=>1,'parent'=>'storefront'],
    ['file'=>'storefront_developers.php','label'=>'Developers','visible'=>1,'parent'=>'storefront'],
    ['file'=>'index_management','label'=>'2006+ Index Management','visible'=>1],
    ['file'=>'capsule_management_2006.php','label'=>'Index Capsule Management','visible'=>1,'parent'=>'index_management'],
    ['file'=>'index_sidebar_management.php','label'=>'Index Sidebar Management','visible'=>1,'parent'=>'index_management'],
    ['file'=>'legacy_storefront','label'=>'2004/2005 Storefront Management','visible'=>$legacy_visible,'parent'=>'storefront_management'],
    ['file'=>'legacy_storefront_games.php','label'=>'Game management','visible'=>$legacy_visible,'parent'=>'legacy_storefront'],
    ['file'=>'legacy_storefront_thirdparty.php','label'=>'Thirdparty Game management','visible'=>$legacy_visible,'parent'=>'legacy_storefront'],
    ['file'=>'legacy_storefront_packages.php','label'=>'Package/Subscription Management','visible'=>$legacy_visible,'parent'=>'legacy_storefront'],
    ['file'=>'../logout.php','label'=>'Logout','visible'=>1]
];
$json = cms_get_setting('nav_items',null);
$nav_items = $json ? json_decode($json,true) : $default_nav;
if(!$nav_items) $nav_items = $default_nav;

// Allow plugins to provide additional sidebar links grouped under a Plugins parent
cms_load_plugins();
$plugin_links = cms_plugin_sidebar_links();
if (!empty($plugin_links)) {
    $plugin_files = array_column($plugin_links, 'file');
    foreach ($plugin_links as &$pl) {
        if (empty($pl['parent']) || !in_array($pl['parent'], $plugin_files, true)) {
            $pl['parent'] = 'plugins.php';
        }
    }
    unset($pl);
    $nav_items[] = ['file' => 'plugins.php', 'label' => 'Plugins', 'visible' => 1];
    $nav_items = array_merge($nav_items, $plugin_links);
}

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
    'support_faq' => '🛟',
    'faq_management' => '📚',
    'support_page.php' => '🛟',
    'troubleshooter' => '🆘',
    'custom_titles.php' => '🔤',
    'redirects.php' => '↪️',
    'random_content' => '🎲',
    'random_content.php' => '🎲',
    'random_groups.php' => '📁',
    'survey_stats' => '📈',
    'scheduled_content.php' => '📅',
    'update_history.php' => '📜',
    'theme.php'        => '🎨',
    'settings.php'     => '⚙️',
    'plugins.php'      => '🔌',
    'download_files.php' => '⬇️',
    'download_settings.php' => '🛠️',
    'page_selection.php' => '📄',
    'troubleshooter.php' => '🆘',
    'troubleshooter_manage.php' => '📝',
    'troubleshooter_requests.php' => '📬',
    'header_footer.php'=> '📑',
    'storefront_management' => '🏪',
    'storefront'   => '🏬',
    'storefront_main.php' => '🖼️',
    'storefront_products.php' => '🛒',
    'storefront_categories.php' => '📂',
    'storefront_sidebar.php' => '🔗',
    'storefront_developers.php' => '👥',
    'index_management' => '🗂️',
    'capsule_management_2006.php' => '🧩',
    'index_sidebar_management.php' => '📚',
    'legacy_storefront' => '🎮',
    'legacy_storefront_games.php' => '🎮',
    'legacy_storefront_thirdparty.php' => '🎮',
    'legacy_storefront_packages.php' => '🎮',
    'faq_categories.php'=> '📂',
    'content_management' => '🗃️',
    'admin_users.php'  => '👥',
    'roles.php'        => '🔑',
    'activity_log.php' => '📜',
    'error_log.php'    => '🐞',
    'error_page.php'   => '❌',
    '../logout.php'    => '🚪',
];

$sf_root = null;
$sf_pages = [];
$sf_parent = null;
$legacy_sf_root = null;
$legacy_sf_pages = [];
$legacy_sf_parent = null;
$cafe_pages = [];
$download_pages = [];
$custom_groups = [];
foreach ($nav_items as $k => $item) {
    if (!($item['visible'] ?? 1)) continue;
    if ($item['file'] === 'storefront') {
        $sf_root = $item;
        $sf_parent = $item['parent'] ?? null;
        unset($nav_items[$k]);
        continue;
    } elseif (preg_match('/^storefront.*\\.php/', $item['file'])) {
        $sf_pages[] = $item;
        unset($nav_items[$k]);
        continue;
    } elseif ($item['file'] === 'legacy_storefront') {
        $legacy_sf_root = $item;
        $legacy_sf_parent = $item['parent'] ?? null;
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
if ($admin_theme === 'neon') {
    $nav_html = '<div class="logo"><h1>Admin CMS</h1><p>Steampowered.com</p></div><ul class="nav-menu">';
}
$logout = null;
$make_link = function(string $file, string $label, string $active = '', string $extra = '', ?string $url = null) use ($icons, $use_spans): string {
    $icon = $icons[$file] ?? '';
    $href = $url ?? $file;
    if ($use_spans) {
        $icon_html = $icon !== '' ? '<span class="nav-icon">'.htmlspecialchars($icon).'</span>' : '';
        return '<a href="'.$href.'"'.$active.$extra.'>'.$icon_html.'<span class="nav-label">'.htmlspecialchars($label).'</span></a>';
    }
    $text = trim(($icon ? $icon.' ' : '').$label);
    return '<a href="'.$href.'"'.$active.$extra.'>'.htmlspecialchars($text).'</a>';
};
$extra_nav_html = '';
$has_sf = $sf_root || $sf_pages;
if ($has_sf) {
    $root_file = $sf_root['file'] ?? 'storefront';
    $root_label = cms_admin_translate($sf_root['label'] ?? 'Storefront');
    $sf_open = false;
    foreach ($sf_pages as $it) {
        $chk = $it['url'] ?? $it['file'];
        if (strpos($_SERVER['REQUEST_URI'],$chk)!==false) { $sf_open = true; break; }
    }
    $active = $sf_open ? ' class="active"' : '';
    $html = '<li id="sf-parent">'.$make_link($root_file,$root_label,$active,' aria-label="StoreFront menu"','#');
    if ($sf_pages) {
        $html .= '<button class="submenu-toggle" aria-expanded="'.($sf_open?'true':'false').'" aria-controls="sf-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
        $style = $sf_open ? 'display:block' : 'display:none';
        $html .= '<ul class="sub-menu" id="sf-sub" style="'.$style.'">';
        foreach ($sf_pages as $it) {
            $file = $it['file'];
            $link = $it['url'] ?? $file;
            $label = cms_admin_translate($it['label']);
            $active = strpos($_SERVER['REQUEST_URI'],$link)!==false ? ' class="active"' : '';
            $html .= '<li>'.$make_link($file,$label,$active,'',$link).'</li>';
        }
        $html .= '</ul>';
    }
    $html .= '</li>';
    if ($sf_parent) {
        $custom_groups[$sf_parent][] = ['html' => $html, 'match' => $root_file];
    } else {
        $extra_nav_html .= $html;
    }
}
$has_leg = ($legacy_sf_root || $legacy_sf_pages) && $legacy_visible;
if ($has_leg) {
    $root_file = $legacy_sf_root['file'] ?? 'legacy_storefront';
    $root_label = cms_admin_translate($legacy_sf_root['label'] ?? '2004/2005 Storefront Management');
    $open = false;
    foreach ($legacy_sf_pages as $it) { $chk = $it['url'] ?? $it['file']; if (strpos($_SERVER['REQUEST_URI'],$chk)!==false){ $open=true; break; } }
    $active = $open ? ' class="active"' : '';
    $html = '<li id="legacy-sf-parent">'.$make_link($root_file,$root_label,$active,' aria-label="Legacy Storefront menu"','#');
    if ($legacy_sf_pages) {
        $html .= '<button class="submenu-toggle" aria-expanded="'.($open?'true':'false').'" aria-controls="legacy-sf-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
        $style = $open ? 'display:block' : 'display:none';
        $html .= '<ul class="sub-menu" id="legacy-sf-sub" style="'.$style.'">';
        foreach ($legacy_sf_pages as $it) {
            $file=$it['file'];
            $link=$it['url'] ?? $file;
            $label=cms_admin_translate($it['label']);
            $ac=strpos($_SERVER['REQUEST_URI'],$link)!==false?' class="active"':'';
            $html .= '<li>'.$make_link($file,$label,$ac,'',$link).'</li>';
        }
        $html .= '</ul>';
    }
    $html .= '</li>';
    if ($legacy_sf_parent) {
        $custom_groups[$legacy_sf_parent][] = ['html' => $html, 'match' => $root_file];
    } else {
        $extra_nav_html .= $html;
    }
}
$has_active = function (string $file) use (&$has_active, $custom_groups): bool {
    foreach ($custom_groups[$file] ?? [] as $child) {
        $chk = $child['url'] ?? $child['file'] ?? ($child['match'] ?? null);
        if ($chk && strpos($_SERVER['REQUEST_URI'], $chk) !== false) {
            return true;
        }
        if (!empty($child['file']) && $has_active($child['file'])) {
            return true;
        }
    }
    return false;
};

$render_item = function (array $item) use (&$render_item, $custom_groups, $make_link, $use_spans, $has_active) {
    if (isset($item['html'])) {
        return $item['html'];
    }
    if (!($item['visible'] ?? 1)) {
        return '';
    }
    $file = $item['file'];
    if ($file === 'support_2003.php') {
        return '';
    }
    $children = $custom_groups[$file] ?? [];
    $has_children = !empty($children);
    $link = $has_children ? '#' : ($item['url'] ?? $file);
    $label = cms_admin_translate($item['label']);
    $active = strpos($_SERVER['REQUEST_URI'], $link) !== false ? ' class="active"' : '';
    $open = $has_children && ($active || $has_active($file));
    if ($open && !$active) {
        $active = ' class="active"';
    }
    if ($has_children) {
        $parent_id = preg_replace('/\.php$/', '', $file) . '-parent';
        $sub_id = preg_replace('/\.php$/', '', $file) . '-sub';
        $html = '<li id="' . $parent_id . '">' . $make_link($file, $label, $active, '', $link);
        $html .= '<button class="submenu-toggle" aria-expanded="' . ($open ? 'true' : 'false') . '" aria-controls="' . $sub_id . '"><span class="visually-hidden">' . cms_admin_translate('Toggle submenu') . '</span></button>';
        $html .= '<ul class="sub-menu" id="' . $sub_id . '" style="' . ($open ? 'display:block' : 'display:none') . '">';
        foreach ($children as $child) {
            $html .= $render_item($child);
        }
        $html .= '</ul></li>';
        return $html;
    }
    return '<li>' . $make_link($file, $label, $active, '', $link) . '</li>';
};

foreach ($nav_items as $item) {
    $html = $render_item($item);
    if ($item['file'] === '../logout.php') {
        $logout = $html;
        continue;
    }
    $nav_html .= $html;
}
$nav_html .= $extra_nav_html;
$has_download = !empty($download_pages);
if($has_download){
    $icon = '⬇️';
    $active = '';
    foreach($download_pages as $it){
        $chk = $it['url'] ?? $it['file'];
        if(strpos($_SERVER['REQUEST_URI'],$chk)!==false){$active=' class="active"';break;}
    }
    $open = $active ? true : false;
    if($use_spans){
        $nav_html .= '<li id="download-parent"><a href="#"'.$active.' aria-label="Download menu"><span class="nav-icon">'.htmlspecialchars($icon).'</span><span class="nav-label">'.htmlspecialchars(cms_admin_translate('Download System Management')).'</span></a>';
    }else{
        $nav_html .= '<li id="download-parent"><a href="#"'.$active.' aria-label="Download menu">'.htmlspecialchars($icon.' '.cms_admin_translate('Download System Management')).'</a>';
    }
    $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($open?'true':'false').'" aria-controls="download-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
    $style = $open ? 'display:block' : 'display:none';
    $nav_html .= '<ul class="sub-menu" id="download-sub" style="'.$style.'">';
    foreach($download_pages as $it){
        $file=$it['file'];
        $link=$it['url'] ?? $file;
        $label=cms_admin_translate($it['label']);
        $ac=strpos($_SERVER['REQUEST_URI'],$link)!==false?' class="active"':'';
        $nav_html.='<li>'.$make_link($file,$label,$ac,'',$link).'</li>';
    }
    $nav_html.='</ul></li>';
}
$has_cafe = !empty($cafe_pages);
if($has_cafe){
    $icon = '☕';
    $active = '';
    foreach($cafe_pages as $it){
        $chk = $it['url'] ?? $it['file'];
        if(strpos($_SERVER['REQUEST_URI'],$chk)!==false){$active=' class="active"';break;}
    }
    $cafe_open = $active ? true : false;
    if($use_spans){
        $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu"><span class="nav-icon">'.htmlspecialchars($icon).'</span><span class="nav-label">'.htmlspecialchars(cms_admin_translate('Cyber Cafe Management')).'</span></a>';
    }else{
        $nav_html .= '<li id="cafe-parent"><a href="#"'.$active.' aria-label="Cafe menu">'.htmlspecialchars($icon.' '.cms_admin_translate('Cyber Cafe Management')).'</a>';
    }
    $nav_html .= '<button class="submenu-toggle" aria-expanded="'.($cafe_open?'true':'false').'" aria-controls="cafe-sub"><span class="visually-hidden">'.cms_admin_translate('Toggle submenu').'</span></button>';
    $style = $cafe_open ? 'display:block' : 'display:none';
    $nav_html .= '<ul class="sub-menu" id="cafe-sub" style="'.$style.'">';
    foreach($cafe_pages as $it){
        $file=$it['file'];
        $link=$it['url'] ?? $file;
        $label=cms_admin_translate($it['label']);
        $ac=strpos($_SERVER['REQUEST_URI'],$link)!==false?' class="active"':'';
        $nav_html.='<li>'.$make_link($file,$label,$ac,'',$link).'</li>';
    }
    $nav_html.='</ul></li>';
}
$nav_html .= $logout ? $logout : '';
$nav_html .= '</ul>';

if (!$admin_layout) {
    include "$theme_dir/header.php";
}
?>
