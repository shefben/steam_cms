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
        $stmt = $db->prepare('SELECT title,content,theme,template FROM custom_pages WHERE slug=?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row) return null;
        if($theme!==null && $row['theme']!==null && $row['theme']!==''){
            $themes = array_map('trim', explode(',', $row['theme']));
            if(!in_array($theme,$themes,true)) return null;
        }
        unset($row['theme']);
        if(!isset($row['template']) || $row['template']==='') $row['template'] = 'default.twig';
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
    $root = rtrim(cms_get_setting('root_path',''), '/');
    if($root !== ''){
        return $root === '/' ? '' : $root;
    }
    $dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    if(substr($dir, -10) === '/cms/admin'){
        $dir = substr($dir, 0, -10);
    }elseif(substr($dir, -4) === '/cms'){
        $dir = substr($dir, 0, -4);
    }
    return $dir === '/' ? '' : $dir;
}

function cms_get_theme_header_data($theme){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT logo,text,img,hover,depressed,url,visible,spacer FROM theme_headers WHERE theme=? ORDER BY ord,id');
        $stmt->execute([$theme]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$rows) return ['logo'=>'','spacer'=>'','buttons'=>[]];
        $logo = $rows[0]['logo'];
        $spacer = $rows[0]['spacer'];
        $buttons = [];
        foreach($rows as $r){
            $buttons[] = [
                'text'=>$r['text'],
                'img'=>$r['img'],
                'hover'=>$r['hover'],
                'depressed'=>$r['depressed'],
                'url'=>$r['url'],
                'visible'=>$r['visible']
            ];
        }
        return ['logo'=>$logo,'spacer'=>$spacer,'buttons'=>$buttons];
    } catch(PDOException $e){
        if($e->getCode()==='42S02') return ['logo'=>'','spacer'=>'','buttons'=>[]];
        throw $e;
    }
}

function cms_get_theme_footer($theme){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT html FROM theme_footers WHERE theme=?');
        $stmt->execute([$theme]);
        $html = $stmt->fetchColumn();
        if($html===false) return '';
        return $html;
    } catch(PDOException $e){
        if($e->getCode()==='42S02') return '';
        throw $e;
    }
}

function cms_get_theme_css($theme){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT css_path FROM themes WHERE name=?');
        $stmt->execute([$theme]);
        $css = $stmt->fetchColumn();
        if($css===false || $css==='') return 'steampowered02.css';
        return $css;
    } catch(PDOException $e){
        if(in_array($e->getCode(), ['42S02','42S22'])) return 'steampowered02.css';
        throw $e;
    }
}

function cms_get_theme_setting(string $theme, string $name, $default = null){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT value FROM theme_settings WHERE theme=? AND name=?');
        $stmt->execute([$theme,$name]);
        $val = $stmt->fetchColumn();
        return $val!==false ? $val : $default;
    } catch(PDOException $e){
        if($e->getCode()==='42S02') return $default;
        throw $e;
    }
}

function cms_get_theme_config(string $theme): array
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT name, value FROM theme_settings WHERE theme=?');
        $stmt->execute([$theme]);
        $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        return $rows ?: [];
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return [];
        }
        throw $e;
    }
}

function cms_set_theme_setting(string $theme, string $name, $value){
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO theme_settings(theme,name,value) VALUES(?,?,?)');
    $stmt->execute([$theme,$name,$value]);
}

function cms_header_buttons_html($theme, string $spacer_style = ''){
    $data = cms_get_theme_header_data($theme);
    $buttons = $data['buttons'];
    $spacer  = $data['spacer'] ?? '';
    $out = '';
    $first = true;
    foreach($buttons as $b){
        if(!$b['visible']) continue;
        $text = trim($b['text']);
        $url  = htmlspecialchars($b['url']);
        $segment = '';
        if($b['img']){
            $img = htmlspecialchars($b['img']);
            $alt = htmlspecialchars($text);
            $segment = '<a href="'.$url.'"><img src="'.$img.'" alt="'.$alt.'"></a>';
        }else{
            $title = htmlspecialchars($text);
            $segment = '<a href="'.$url.'" title="'.$title.'">'.$title.'</a>';
        }
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.htmlspecialchars($spacer).'</span>';
        }
        $out .= $segment;
        $first = false;
    }
    if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.htmlspecialchars($spacer).'</span>';
        }
        $base = cms_base_url();
        $out .= '<a href="'.$base.'/cms/admin/index.php" title="Admin">ADMIN</a>';
    }
    return $out;
}

function cms_render_header(string $theme, bool $with_buttons = true): string {
    $data = cms_get_theme_header_data($theme);
    $base = cms_base_url();
    $logo = $data['logo'] ?: '/img/steam_logo_onblack.gif';
    if($logo && $logo[0]=='/') $logo = $base.$logo;
    $out = '<div class="header"><nobr>';
    $out .= '<div><a href="'.$base.'/index.php"><img alt="Steam" src="'.htmlspecialchars($logo).'"></a></div>';
    if($with_buttons){
        $nav = cms_header_buttons_html($theme);
        $out .= '<div class="navBar">'.$nav.'</div>';
    }
    $out .= '</nobr></div>';
    return $out;
}

function cms_refresh_themes(){
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO themes(name, css_path) VALUES(?,?)');
    $base = dirname(__DIR__);
    foreach(glob($base.'/themes/*', GLOB_ONLYDIR) as $dir){
        $name = basename($dir);
        if(substr($name,-6) === '_admin') continue;
        $css = 'steampowered02.css';
        if(!file_exists("$dir/css/$css")){
            $css = file_exists("$dir/css/steampowered.css") ? 'steampowered.css' : '';
            if($css === ''){
                $files = glob("$dir/css/*.css");
                $css = $files ? basename($files[0]) : '';
            }
        }
        $css_path = $css ? 'css/'.$css : '';
        $stmt->execute([$name,$css_path]);

        $cfg_file = "$dir/config.php";
        if(file_exists($cfg_file)){
            $cfg = include $cfg_file;
            if(is_array($cfg)){
                foreach($cfg as $k=>$v){
                    cms_set_theme_setting($name, $k, (string)$v);
                }
            }
        }

        $sql_dir = "$dir/sql";
        if(is_dir($sql_dir)){
            foreach(glob($sql_dir.'/*.sql') as $sql){
                $hash = md5_file($sql);
                $key  = 'sql_'.basename($sql);
                $stored = cms_get_theme_setting($name, $key, '');
                if($stored !== $hash){
                    $db->exec(file_get_contents($sql));
                    cms_set_theme_setting($name, $key, $hash);
                }
            }
        }
    }
}

function cms_get_themes(){
    $db = cms_get_db();
    $res = $db->query('SELECT name FROM themes ORDER BY name');
    return $res ? $res->fetchAll(PDO::FETCH_COLUMN) : [];
}

function cms_store_sidebar_links(){
    $db = cms_get_db();
    try {
        $res = $db->query('SELECT id,label,url,type,ord,visible FROM store_sidebar_links WHERE visible=1 ORDER BY ord,id');
        return $res->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        if($e->getCode()==='42S02') return [];
        throw $e;
    }
}

function cms_load_store_links($file){
    $path = '/storefront/' . basename($file);
    $links = cms_store_sidebar_links();
    foreach($links as &$l){
        if($l['type']==='link'){
            $l['current'] = (parse_url($l['url'], PHP_URL_PATH) === $path);
        }
    }
    return $links;
}
?>
