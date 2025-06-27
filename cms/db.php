<?php
function cms_get_db(){
    static $db;
    if($db) return $db;
    if(!file_exists(__DIR__.'/config.php')){
        die('CMS not installed. Please run install.php');
    }
    $cfg = include __DIR__.'/config.php';
    $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['dbname']};charset=utf8mb4";
    $db = new PDO($dsn, $cfg['user'], $cfg['pass'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    return $db;
}

function cms_get_setting($key, $default=null){
    $db = cms_get_db();
    try{
        $stmt = $db->prepare('SELECT value FROM settings WHERE `key`=?');
        $stmt->execute([$key]);
        $val = $stmt->fetchColumn();
        return $val!==false ? $val : $default;
    }catch(PDOException $e){
        if($e->getCode()==='42S02') return $default; // table missing
        throw $e;
    }
}

function cms_set_setting($key,$value){
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO settings(`key`,value) VALUES(?,?)');
    $stmt->execute([$key,$value]);
}

function cms_get_custom_page($slug){
    $db = cms_get_db();
    try{
        $stmt = $db->prepare('SELECT title,content FROM custom_pages WHERE slug=?');
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        if($e->getCode()==='42S02') return null; // table missing
        throw $e;
    }
}

function cms_record_visit($page){
    $db = cms_get_db();
    $date = date('Y-m-d');
    $stmt = $db->prepare('INSERT INTO page_views(date,page,views) VALUES(?,?,1) '
        .'ON DUPLICATE KEY UPDATE views=views+1');
    $stmt->execute([$date,$page]);
}

function cms_current_admin(){
    return $_SESSION['admin_id'] ?? 0;
}

function cms_all_permissions(){
    return [
        'manage_admins'    => 'Manage Administrators',
        'manage_settings'  => 'Manage Site Settings',
        'manage_pages'     => 'Manage Custom Pages',
        'manage_signups'   => 'Manage Café Signups',
        'manage_news'      => 'Manage All News',
        'news_create'      => 'Create News',
        'news_edit'        => 'Edit News',
        'news_delete'      => 'Delete News',
        'manage_faq'       => 'Manage FAQ',
        'faq_add'          => 'Add FAQ',
        'faq_edit'         => 'Edit FAQ',
        'faq_delete'       => 'Delete FAQ',
        'faqcat_add'       => 'Add FAQ Category',
        'faqcat_edit'      => 'Edit FAQ Category',
        'faqcat_delete'    => 'Delete FAQ Category'
    ];
}

function cms_has_permission($perm){
    $id = cms_current_admin();
    if(!$id) return false;
    $db = cms_get_db();
    $row = $db->prepare('SELECT permissions FROM admin_users WHERE id=?');
    $row->execute([$id]);
    $perms = $row->fetchColumn();
    if($perms===false) return false;
    if($perms==='all') return true;
    $list = array_map('trim', explode(',', $perms));
    if(in_array($perm,$list)) return true;
    $parents = [
        'news_create'  => 'manage_news',
        'news_edit'    => 'manage_news',
        'news_delete'  => 'manage_news',
        'faq_add'      => 'manage_faq',
        'faq_edit'     => 'manage_faq',
        'faq_delete'   => 'manage_faq',
        'faqcat_add'   => 'manage_faq',
        'faqcat_edit'  => 'manage_faq',
        'faqcat_delete'=> 'manage_faq'
    ];
    if(isset($parents[$perm]) && in_array($parents[$perm], $list)) return true;
    return false;
}

function cms_require_permission($perm){
    if(!cms_has_permission($perm)){
        echo '<p>Access denied.</p>';
        include __DIR__.'/admin/admin_footer.php';
        exit;
    }
}

function cms_require_any_permission($perms){
    foreach($perms as $p){
        if(cms_has_permission($p)) return;
    }
    echo '<p>Access denied.</p>';
    include __DIR__.'/admin/admin_footer.php';
    exit;
}

function cms_header_buttons_html($theme){
    $json = cms_get_setting('header_config', null);
    $data = $json ? json_decode($json, true) : ['logo'=>'','buttons'=>[]];
    if(!$data) $data = ['logo'=>'','buttons'=>[]];
    $buttons = $data['buttons'];
    $out = '';
    if($theme === '2007'){
        $sep = '';
        foreach($buttons as $b){
            $text = trim($b['text'] ?? $b['alt'] ?? '');
            if($text === '') continue;
            $url = htmlspecialchars($b['url']);
            $out .= $sep.'<a class="headerLink" href="'.$url.'">'.htmlspecialchars($text).'</a>';
            $sep = ' &nbsp; | &nbsp; ';
        }
    }elseif($theme === '2004'){
        foreach($buttons as $b){
            $img = trim($b['img']);
            if($img === '') continue;
            $url = htmlspecialchars($b['url']);
            $img_h = htmlspecialchars($img);
            $hover = htmlspecialchars($b['hover']);
            $alt = htmlspecialchars($b['alt']);
            $out .= "<a href=\"$url\"><img valign=\"bottom\" src=\"$img_h\" onMouseOver=\"this.src='$hover'\" onMouseOut=\"this.src='$img_h'\" alt=\"$alt\"></a>";
        }
        if(cms_current_admin() || (isset($_COOKIE['cms_admin_id']) && isset($_COOKIE['cms_admin_hash']))){
            $out .= "<a href=\"/cms/admin/index.php\" style=\"padding-right:5px;\"><img valign=\"bottom\" src=\"/img/admin.gif\" alt=\"Admin\"></a>";
        }
    }
    return $out;
}
?>
