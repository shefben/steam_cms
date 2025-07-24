<?php
if (!defined('CMS_ROOT')) {
    define('CMS_ROOT', dirname(__DIR__));
}
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
    try {
        $stmt = $db->prepare('SELECT title,content,theme,template FROM custom_pages WHERE slug=? AND status="published"');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S22') { // column missing
            $stmt = $db->prepare('SELECT title,content,theme FROM custom_pages WHERE slug=? AND status="published"');
            $stmt->execute([$slug]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) return null;
            if ($theme !== null && $row['theme'] !== null && $row['theme'] !== '') {
                $themes = array_map('trim', explode(',', $row['theme']));
                if (!in_array($theme, $themes, true)) return null;
            }
            unset($row['theme']);
            $row['template'] = null;
            return $row;
        }
        if ($e->getCode() === '42S02') return null; // table missing
        throw $e;
    }
    if (!$row) return null;
    if ($theme !== null && $row['theme'] !== null && $row['theme'] !== '') {
        $themes = array_map('trim', explode(',', $row['theme']));
        if (!in_array($theme, $themes, true)) return null;
    }
    unset($row['theme']);
    if (!isset($row['template']) || $row['template'] === '') $row['template'] = null;
    return $row;
}

function cms_get_support_page(string $theme): ?array
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT * FROM support_pages WHERE FIND_IN_SET(?, years)');
        $stmt->execute([$theme]);
        $page = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$page) return null;
        $faqStmt = $db->prepare(
            'SELECT f.faqid1,f.faqid2,f.title,spf.ord FROM support_page_faqs spf '
            .'JOIN faq_content f ON f.faqid1=spf.faqid1 AND f.faqid2=spf.faqid2 '
            .'WHERE spf.support_id=? ORDER BY spf.ord'
        );
        $faqStmt->execute([$page['id']]);
        $page['faqs'] = $faqStmt->fetchAll(PDO::FETCH_ASSOC);
        return $page;
    } catch (PDOException $e) {
        if ($e->getCode()==='42S02') return null;
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
    $row = $db->prepare('SELECT role_id, permissions FROM admin_users WHERE id=?');
    $row->execute([$id]);
    $info = $row->fetch(PDO::FETCH_ASSOC);
    if(!$info) return false;

    $perms = $info['permissions'];
    if($info['role_id']){
        $stmt = $db->prepare('SELECT permissions FROM admin_roles WHERE id=?');
        $stmt->execute([$info['role_id']]);
        $perms = $stmt->fetchColumn();
    }

    if($perms===false || $perms==='') return false;
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
    if (str_ends_with($dir, '/cms/admin')) {
        $dir = substr($dir, 0, -10);
    } elseif (str_ends_with($dir, '/cms')) {
        $dir = substr($dir, 0, -4);
    } elseif (str_ends_with($dir, '/storefront')) {
        $dir = substr($dir, 0, -11);
    }
    return $dir === '/' ? '' : $dir;
}

function cms_set_current_template(string $tpl): void {
    $GLOBALS['cms_current_template'] = basename($tpl, '.twig');
}

function cms_set_current_theme(string $theme): void {
    $GLOBALS['cms_current_theme'] = $theme;
}

function cms_get_current_theme(): string {
    return $GLOBALS['cms_current_theme'] ?? cms_get_setting('theme', '2004');
}

function cms_get_current_page(): string {
    return $GLOBALS['cms_current_template'] ?? ($_GET['area'] ?? basename($_SERVER['SCRIPT_NAME'], '.php'));
}

function cms_set_header_logo_override(?string $path): void {
    if ($path === null) {
        unset($GLOBALS['cms_header_logo_override']);
    } else {
        $GLOBALS['cms_header_logo_override'] = $path;
    }
}

function cms_get_header_logo_override(): ?string {
    return $GLOBALS['cms_header_logo_override'] ?? null;
}

function cms_get_theme_header_data($theme, string $page = ''){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT logo,text,img,hover,depressed,url,visible,spacer FROM theme_headers WHERE theme=? AND page=? ORDER BY ord,id');
        $stmt->execute([$theme, $page]);
    } catch(PDOException $e){
        if($e->getCode()==='42S22') {
            // older schema without page column
            $stmt = $db->prepare('SELECT logo,text,img,hover,depressed,url,visible,spacer FROM theme_headers WHERE theme=? ORDER BY ord,id');
            $stmt->execute([$theme]);
        } elseif($e->getCode()==='42S02') {
            return ['logo'=>'','spacer'=>'','buttons'=>[]];
        } else {
            throw $e;
        }
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$rows && $page !== ''){
        try {
            $stmt->execute([$theme, '']);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // ignore if schema lacks page column
        }
    }
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
}

function cms_get_theme_footer($theme)
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT html FROM theme_footers WHERE theme=?');
        $stmt->execute([$theme]);
        $html = $stmt->fetchColumn();

        if ($html === false && $theme !== '2004') {
            $stmt->execute(['2004']);
            $html = $stmt->fetchColumn();
        }

        if ($html === false) {
            return '';
        }

        return $html;
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return '';
        }
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
function cms_nav_buttons_html($theme, string $spacer_style = '', ?string $spacer_override = null){
    $page    = cms_get_current_page();
    $data    = cms_get_theme_header_data($theme, $page);
    $buttons = $data['buttons'];
    $spacer  = $spacer_override !== null ? $spacer_override : ($data['spacer'] ?? '');
    $out = '';
    $first = true;
    $base = cms_base_url();
    foreach($buttons as $b){
        if(!$b['visible']) continue;
        $text = trim($b['text']);
        $url  = str_ireplace('{BASE}', $base, $b['url']);
        $url  = htmlspecialchars($url);
        $segment = '';
        if($b['img']){
            $imgPath = str_ireplace('{BASE}', $base, $b['img']);
            $img = htmlspecialchars($imgPath);
            $alt = htmlspecialchars($text);
            $segment = '<a href="'.$url.'"><img src="'.$img.'" alt="'.$alt.'"></a>';
        }else{
            $title = htmlspecialchars($text);
            $segment = '<a href="'.$url.'" title="'.$title.'">'.$title.'</a>';
        }
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $out .= $segment;
        $first = false;
    }
    if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $base = cms_base_url();
        $out .= '<a href="'.$base.'/cms/admin/index.php" title="Admin">ADMIN</a>';
    }
    return $out;
}
function cms_header_buttons_html($theme, string $spacer_style = '', ?string $spacer_override = null){
    $page    = cms_get_current_page();
    $data    = cms_get_theme_header_data($theme, $page);
    $buttons = $data['buttons'];
    $spacer  = $spacer_override !== null ? $spacer_override : ($data['spacer'] ?? '');
    $out = '';
    $first = true;
    $base = cms_base_url();
    foreach($buttons as $b){
        if(!$b['visible']) continue;
        $text = trim($b['text']);
        $url  = str_ireplace('{BASE}', $base, $b['url']);
        $url  = htmlspecialchars($url);
        $segment = '';
        if($b['img']){
            $imgPath = str_ireplace('{BASE}', $base, $b['img']);
            $img = htmlspecialchars($imgPath);
            $alt = htmlspecialchars($text);
            $segment = '<a href="'.$url.'"><img src="'.$img.'" alt="'.$alt.'"></a>';
        }else{
            $title = htmlspecialchars($text);
            $segment = '<div class="globalNavItem"><a href="'.$url.'" title="'.$title.'"><span class="globalNavLink">'.$title.'</span></a></div>';
        }
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $out .= $segment;
        $first = false;
    }
    if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
        if(!$first && $spacer !== ''){
            $style = $spacer_style ? ' style="'.htmlspecialchars($spacer_style).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $base = cms_base_url();
        $out .= '<a href="'.$base.'/cms/admin/index.php" title="Admin">ADMIN</a>';
    }
    return $out;
}

function cms_render_header(string $theme, bool $with_buttons = true): string {
    $data  = cms_get_theme_header_data($theme);
    $base  = cms_base_url();
    $logo  = $data['logo'] ?: '/img/steam_logo_onblack.gif';
    $override = cms_get_header_logo_override();
    if ($override !== null) {
        $logo = $override;
        if (!preg_match('~^(?:https?://|/)~', $logo)) {
            $logo = "themes/$theme/" . ltrim($logo, '/');
        }
    }
    $logo = str_ireplace('{BASE}', $base, $logo);
    if ($logo && $logo[0] == '/') {
        $logo = $base . $logo;
    }
    $out = '<link href="./includes/css/navbar.css" rel="stylesheet" type="text/css">';
    $out  .= '<div style="min-width:850px;">';
    $out .= '<div class="globalHeadBar_logo"><a href="'.$base.'/index.php"><img border="0" src="'.htmlspecialchars($logo).'" alt="[Valve]" height="54" width="152"></a></div>';

    $nav = $with_buttons ? cms_header_buttons_html($theme) : '';
    $out .= '<div class="globalHeadBar">'.$nav.'</div>';

    $out .= '</div><br clear="all">';
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
    $extra = [];
    foreach (['l','s','i','a'] as $p) {
        if (isset($_GET[$p]) && $_GET[$p] !== '') {
            $extra[$p] = $_GET[$p];
        }
    }
    $qs = $extra ? ('?' . http_build_query($extra, '', '&')) : '';
    foreach ($links as &$l) {
        if ($l['type'] === 'link') {
            $l['current'] = (parse_url($l['url'], PHP_URL_PATH) === $path);
            $l['url'] .= $qs;
        }
    }
    return $links;
}

function cms_get_store_page(string $slug): array
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT title, title_image AS titleimage FROM store_pages WHERE slug=?');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row) { return ['title' => '', 'titleimage' => '']; }
        return $row;
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return ['title' => '', 'titleimage' => ''];
        }
        throw $e;
    }
}

function cms_set_store_page(string $slug, string $title, string $image): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO store_pages(slug,title,title_image) VALUES(?,?,?)');
    $stmt->execute([$slug,$title,$image]);
}

function cms_admin_language(?int $userId = null): string
{
    if ($userId === null) {
        if (isset($_SESSION['admin_lang'])) {
            return $_SESSION['admin_lang'];
        }
        $userId = cms_current_admin();
    }
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT language FROM admin_users WHERE id=?');
        $stmt->execute([$userId]);
        $lang = $stmt->fetchColumn();
    } catch (PDOException $e) {
        if ($e->getCode() === '42S22') {
            return 'en';
        }
        throw $e;
    }
    $lang = $lang ?: 'en';
    if ($userId === cms_current_admin()) {
        $_SESSION['admin_lang'] = $lang;
    }
    return $lang;
}

function cms_admin_translate(string $key): string
{
    $lang = cms_admin_language();
    static $cache = [];
    if (!isset($cache[$lang])) {
        $json = cms_get_setting('admin_translations_' . $lang, '{}');
        $cache[$lang] = json_decode($json, true) ?: [];
    }
    return $cache[$lang][$key] ?? $key;
}

function cms_get_unread_notifications(int $userId): array
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT id,type,message,target_role FROM notifications WHERE read_at IS NULL AND (target_user IS NULL OR target_user=?) ORDER BY created DESC');
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return [];
        }
        throw $e;
    }
    $out = [];
    foreach ($rows as $r) {
        if (!$r['target_role'] || $r['target_role'] === 'all' || cms_has_permission($r['target_role'])) {
            $out[] = $r;
        }
    }
    return $out;
}

function cms_mark_notification_read(int $id): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('UPDATE notifications SET read_at=NOW() WHERE id=?');
    $stmt->execute([$id]);
}

function cms_admin_log(string $action, ?int $userId = null): void
{
    $db = cms_get_db();
    if ($userId === null) {
        $userId = cms_current_admin();
    }
    $stmt = $db->prepare('INSERT INTO admin_logs(`user`, action, ts) VALUES(?,?,NOW())');
    $stmt->execute([$userId, $action]);
}

function cms_get_help_text(string $page, string $field): string
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT content FROM help_texts WHERE page=? AND field=?');
        $stmt->execute([$page, $field]);
        $txt = $stmt->fetchColumn();
        return $txt !== false ? $txt : '';
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') return '';
        throw $e;
    }
}

function cms_help_icon(string $page, string $field): string
{
    $text = cms_get_help_text($page, $field);
    if ($text === '') return '';
    $esc = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return '<span class="help-icon" data-help="' . $esc . '" tabindex="0" role="button" aria-label="Help">?</span>';
}

function cms_log_php_error(string $level, string $message, string $file, int $line): void
{
    try {
        $db = cms_get_db();
        $stmt = $db->prepare(
            'INSERT INTO error_logs(level, message, file, line, created) VALUES(?,?,?,?,NOW())'
        );
        $stmt->execute([$level, $message, $file, $line]);
    } catch (Throwable $e) {
        // ignore logging failures
    }
}

function cms_error_handler(int $errno, string $errstr, string $errfile, int $errline): bool
{
    $root = realpath(CMS_ROOT);
    if ($root && str_starts_with(realpath($errfile), $root)) {
        $levels = [
            E_ERROR             => 'error',
            E_WARNING           => 'warning',
            E_PARSE             => 'parse',
            E_NOTICE            => 'notice',
            E_CORE_ERROR        => 'core_error',
            E_CORE_WARNING      => 'core_warning',
            E_COMPILE_ERROR     => 'compile_error',
            E_COMPILE_WARNING   => 'compile_warning',
            E_USER_ERROR        => 'user_error',
            E_USER_WARNING      => 'user_warning',
            E_USER_NOTICE       => 'user_notice',
            E_STRICT            => 'strict',
            E_RECOVERABLE_ERROR => 'recoverable_error',
            E_DEPRECATED        => 'deprecated',
            E_USER_DEPRECATED   => 'user_deprecated',
        ];
        $level = $levels[$errno] ?? 'error';
        cms_log_php_error($level, $errstr, $errfile, $errline);
    }
    return false;
}

function cms_exception_handler(Throwable $e): void
{
    $root = realpath(CMS_ROOT);
    if ($root && str_starts_with(realpath($e->getFile()), $root)) {
        cms_log_php_error('exception', $e->getMessage(), $e->getFile(), $e->getLine());
    }
    throw $e;
}

function cms_shutdown_handler(): void
{
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE], true)) {
        cms_error_handler($err['type'], $err['message'], $err['file'], $err['line']);
    }
}

set_error_handler('cms_error_handler');
set_exception_handler('cms_exception_handler');
register_shutdown_function('cms_shutdown_handler');
?>
