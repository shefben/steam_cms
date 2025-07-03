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

function cms_get_custom_page($slug,$theme=null){
    $db = cms_get_db();
    try{
        $stmt = $db->prepare('SELECT title,content,theme FROM custom_pages WHERE slug=?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row) return null;
        if($theme!==null && $row['theme']!==null && $row['theme']!==''){
            $themes = array_map('trim', explode(',', $row['theme']));
            if(!in_array($theme,$themes,true)) return null;
        }
        unset($row['theme']);
        return $row;
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

function cms_create_admin_token($user_id){
    $token = bin2hex(random_bytes(32));
    $hash = hash('sha256', $token);
    $db = cms_get_db();
    $stmt = $db->prepare('INSERT INTO admin_tokens(token_hash,user_id,expires) VALUES(?, ?, DATE_ADD(NOW(), INTERVAL 7 DAY))');
    $stmt->execute([$hash, $user_id]);
    return $token;
}

function cms_validate_admin_token($token){
    $hash = hash('sha256', $token);
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT user_id FROM admin_tokens WHERE token_hash=? AND expires>NOW()');
    $stmt->execute([$hash]);
    return $stmt->fetchColumn();
}

function cms_clear_admin_token($token){
    $hash = hash('sha256', $token);
    $db = cms_get_db();
    $stmt = $db->prepare('DELETE FROM admin_tokens WHERE token_hash=?');
    $stmt->execute([$hash]);
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
        'manage_store'     => 'Manage Storefront',
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

function cms_base_url(){
    $dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    if(substr($dir, -10) === '/cms/admin'){
        $dir = substr($dir, 0, -10);
    }elseif(substr($dir, -4) === '/cms'){
        $dir = substr($dir, 0, -4);
    }
    return $dir === '/' ? '' : $dir;
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
    }elseif($theme === '2004' || $theme === '2005_v1' || $theme === '2005_v2'){
        foreach($buttons as $b){
            $text = trim($b['text'] ?? $b['alt'] ?? '');
            if($text === '') continue;
            $url = htmlspecialchars($b['url']);
            $title = htmlspecialchars($text);
            $label = htmlspecialchars($text);
            $out .= '<div class="globalNavItem"><a href="'.$url.'" title="'.$title.'"><span class="globalNavLink">'.$label.'</span></a></div>';
        }
        if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
            $base = cms_base_url();
            $out .= '<div class="globalNavItem"><a href="'.$base.'/cms/admin/index.php" title="Admin"><span class="globalNavLink">ADMIN</span></a></div>';
        }
    }
    return $out;
}

function cms_refresh_themes(){
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO themes(name) VALUES(?)');
    $base = dirname(__DIR__);
    foreach(glob($base.'/themes/*', GLOB_ONLYDIR) as $dir){
        $name = basename($dir);
        if(substr($name,-6) === '_admin') continue;
        $stmt->execute([$name]);
    }
}

function cms_get_themes(){
    $db = cms_get_db();
    $res = $db->query('SELECT name FROM themes ORDER BY name');
    return $res ? $res->fetchAll(PDO::FETCH_COLUMN) : [];
}
?>
