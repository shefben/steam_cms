<?php
if (!defined('CMS_ROOT')) {
    define('CMS_ROOT', dirname(__DIR__));
}
/**
 * Cached configuration values to avoid repeated database queries.
 * @var array<string, string|null>
 */
$cms_settings_cache = [];
/**
 * Cached theme data to avoid repeated database queries.
 * @var array<string, mixed>
 */
$cms_theme_header_cache = [];
$cms_theme_footer_cache = [];
$cms_theme_css_cache = [];
$cms_theme_config_cache = [];
$cms_theme_setting_cache = [];
$cms_prepared_statements = [];

function cms_get_db(): PDO
{
    static $db;
    if ($db instanceof PDO) {
        try {
            if ($db->getAttribute(PDO::ATTR_CONNECTION_STATUS)) {
                return $db;
            }
        } catch (PDOException $e) {
            // fall through to reconnect
        }
    }
    if (!file_exists(__DIR__ . '/config.php')) {
        throw new RuntimeException('CMS not installed. Please run install.php');
    }
    $cfg = include __DIR__ . '/config.php';
    $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['dbname']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))",
    ];
    $db = new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
    return $db;
}

function cms_get_prepared_statement(string $sql): PDOStatement
{
    global $cms_prepared_statements;
    if (!isset($cms_prepared_statements[$sql])) {
        $db = cms_get_db();
        $cms_prepared_statements[$sql] = $db->prepare($sql);
    }
    return $cms_prepared_statements[$sql];
}

function cms_ensure_plugin_migrations_table(): void
{
    static $created = false;
    if ($created) {
        return;
    }
    $db = cms_get_db();
    $db->exec("CREATE TABLE IF NOT EXISTS plugin_migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plugin_name VARCHAR(100) NOT NULL,
        version VARCHAR(50) NOT NULL,
        executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY plugin_version (plugin_name, version)
    )");
    $created = true;
}

function cms_ensure_plugin_settings_table(): void
{
    static $created = false;
    if ($created) {
        return;
    }
    $db = cms_get_db();
    $db->exec("CREATE TABLE IF NOT EXISTS plugin_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plugin_name VARCHAR(100) NOT NULL,
        setting_key VARCHAR(100) NOT NULL,
        setting_value TEXT,
        setting_type VARCHAR(20) DEFAULT 'string',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY plugin_setting (plugin_name, setting_key)
    )");
    $created = true;
}

function cms_load_settings(): void
{
    global $cms_settings_cache;
    if ($cms_settings_cache !== []) {
        return;
    }

    if (function_exists('apcu_entry')) {
        $cms_settings_cache = apcu_entry('cms_settings_cache', function () {
            $db = cms_get_db();
            try {
                return $db
                    ->query('SELECT `key`, value FROM settings')
                    ->fetchAll(PDO::FETCH_KEY_PAIR);
            } catch (PDOException $e) {
                if ($e->getCode() === '42S02') {
                    return [];
                }
                throw $e;
            }
        }, 60);
        return;
    }

    $db = cms_get_db();
    try {
        $cms_settings_cache = $db
            ->query('SELECT `key`, value FROM settings')
            ->fetchAll(PDO::FETCH_KEY_PAIR);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            $cms_settings_cache = [];
        } else {
            throw $e;
        }
    }
}

function cms_get_setting($key, $default = null)
{
    global $cms_settings_cache;
    cms_load_settings();
    return array_key_exists($key, $cms_settings_cache) ? $cms_settings_cache[$key] : $default;
}

function cms_set_setting($key, $value): void
{
    global $cms_settings_cache;
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO settings(`key`,value) VALUES(?,?)');
    $stmt->execute([$key, $value]);
    $cms_settings_cache[$key] = $value;
    if (function_exists('apcu_delete')) {
        apcu_delete('cms_settings_cache');
    }
}

function cms_get_custom_page($slug,$theme=null){
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT page_name,title,content,theme,template,header_image FROM custom_pages WHERE slug=? AND status="published"');
        $stmt->execute([$slug]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S22') { // column missing
            $stmt = $db->prepare('SELECT title,content,theme FROM custom_pages WHERE slug=? AND status="published"');
            $stmt->execute([$slug]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$rows) return null;
            foreach ($rows as $row) {
                if ($theme !== null && $row['theme'] !== null && $row['theme'] !== '') {
                    $themes = array_map('trim', explode(',', $row['theme']));
                    if (in_array($theme, $themes, true)) {
                        unset($row['theme']);
                        $row['template'] = null;
                        $row['page_name'] = null;
                        cms_set_content_header_image(null);
                        return $row;
                    }
                } elseif (!isset($default)) {
                    $default = $row;
                }
            }
            if (!empty($default)) {
                unset($default['theme']);
                $default['template'] = null;
                $default['page_name'] = null;
                cms_set_content_header_image(null);
                return $default;
            }
            return null;
        }
        if ($e->getCode() === '42S02') return null; // table missing
        throw $e;
    }
    if (!$rows) return null;
    $match = null;
    $default = null;
    foreach ($rows as $row) {
        if ($row['theme'] !== null && $row['theme'] !== '') {
            $themes = array_map('trim', explode(',', $row['theme']));
            if ($theme !== null && in_array($theme, $themes, true)) {
                $match = $row;
                break;
            }
        } elseif ($default === null) {
            $default = $row;
        }
    }
    if ($match === null) {
        if ($default === null) return null;
        $match = $default;
    }
    unset($match['theme']);
    if (!isset($match['template']) || $match['template'] === '') $match['template'] = null;
    cms_set_content_header_image($match['header_image'] ?? null);
    return $match;
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

function cms_get_download_page(string $theme): ?array
{
    $db = cms_get_db();
    $default = $theme === '2003_v2' ? '2003_v2_v2' : '2004_v3';
    $ver = cms_get_setting('download_page_' . $theme, $default);
    try {
        $linkStmt = $db->prepare('SELECT category,label,url FROM download_links WHERE version=? ORDER BY ord,id');
        $linkStmt->execute([$ver]);
        $links = $linkStmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        try {
            $catStmt = $db->query('SELECT id,name,file_size FROM download_categories ORDER BY id');
            $categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            if ($e->getCode() !== '42S02') {
                throw $e;
            }
        }
        $verNum = 0;
        if (preg_match('/v(\d+)$/', $ver, $m2)) {
            $verNum = (int)$m2[1];
        }
        $sr = '';
        try {
            $srStmt = $db->prepare('SELECT content FROM download_system_requirements WHERE theme=? AND version=?');
            $srStmt->execute([$theme,$verNum]);
            $val = $srStmt->fetchColumn();
            if ($val !== false) {
                $sr = $val;
            }
        } catch (PDOException $e) {
            if ($e->getCode() !== '42S02') {
                throw $e;
            }
        }
        return [
            'version'    => $ver,
            'links'      => $links,
            'categories' => $categories,
            'system_requirements' => $sr,
        ];
    } catch (PDOException $e) {
        if ($e->getCode()==='42S02') return null;
        throw $e;
    }
}

function cms_extract_legacy_body(string $html): string
{
    if (preg_match('/<div class="content"[^>]*>(.*)<div class="footer">/s', $html, $m)) {
        return trim($m[1]);
    }
    if (preg_match('/<body[^>]*>(.*)<\/body>/s', $html, $m)) {
        return trim($m[1]);
    }
    return trim($html);
}

function cms_rewrite_legacy_paths(string $html): string
{
    $html = preg_replace(
        '#https://web\.archive\.org/.+?steampowered\.com(:80)?/index\.php#',
        'index.php',
        $html
    );
    return str_replace('action="index.php"', 'action="/index.php"', $html);
}

function cms_get_cafe_signup_page(string $theme): ?string
{
    $files = [
        '2004_signup_v1' => __DIR__ . '/../archived_steampowered/2004/Cyber Café Sign-up_version_1.html',
        '2004_signup_v2' => __DIR__ . '/../archived_steampowered/2004/Cyber Café Sign-up_version_2.html',
    ];
    $default = '2004_signup_v1';
    $ver = cms_get_setting('cafe_signup_page_' . $theme, $default);
    if (!isset($files[$ver]) || !file_exists($files[$ver])) {
        return null;
    }
    $html = file_get_contents($files[$ver]);
    $html = cms_rewrite_legacy_paths($html);
    return cms_extract_legacy_body($html);
}

function cms_get_cheat_form_page(string $theme): ?string
{
    $files = [
        '2004_cheat_v1' => __DIR__ . '/../archived_steampowered/2004/cheat_form_version_1.html',
        '2004_cheat_v2' => __DIR__ . '/../archived_steampowered/2004/cheat_form_version_2.html',
    ];
    $default = '2004_cheat_v1';
    $ver = cms_get_setting('cheat_form_page_' . $theme, $default);
    if (!isset($files[$ver]) || !file_exists($files[$ver])) {
        return null;
    }
    $html = file_get_contents($files[$ver]);
    $html = cms_rewrite_legacy_paths($html);
    return cms_extract_legacy_body($html);
}

function cms_get_cd_account_page(string $theme): ?string
{
    $files = [
        '2004_cd_v1' => __DIR__ . '/../archived_steampowered/2004/cd_account_form_version_1.html',
        '2004_cd_v2' => __DIR__ . '/../archived_steampowered/2004/cd_account_form_version_2.html',
    ];
    $default = '2004_cd_v1';
    $ver = cms_get_setting('cd_account_page_' . $theme, $default);
    if (!isset($files[$ver]) || !file_exists($files[$ver])) {
        return null;
    }
    $html = file_get_contents($files[$ver]);
    $html = cms_rewrite_legacy_paths($html);
    return cms_extract_legacy_body($html);
}

function cms_get_download_files(int $limit = 10, int $offset = 0): array
{
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT * FROM download_files ORDER BY id LIMIT ? OFFSET ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $mStmt = $db->prepare('SELECT host,url FROM download_file_mirrors WHERE file_id=? ORDER BY ord,id');
    foreach ($files as &$f) {
        $mStmt->execute([$f['id']]);
        $f['mirrors'] = $mStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $files;
}

function cms_get_all_download_files(?string $theme = null, ?string $version = null): array
{
    $db = cms_get_db();

    if ($theme !== null && $version !== null) {
        try {
            // Get files with their version-specific settings from new table structure
            $stmt = $db->prepare('
                SELECT df.*, 
                       COALESCE(dfv.is_visible, 1) as is_visible,
                       COALESCE(dfv.render_type, "title_size_mirrors_buttons") as render_type,
                       COALESCE(dfv.location, "main_content") as location,
                       COALESCE(dfv.sort_order, df.sort_order, 0) as sort_order
                FROM download_files df
                LEFT JOIN download_file_versions dfv ON df.id = dfv.file_id 
                    AND dfv.theme = ? AND dfv.page_version = ?
                WHERE COALESCE(dfv.is_visible, 1) = 1
                ORDER BY COALESCE(dfv.sort_order, df.sort_order, 0), df.id
            ');
            $stmt->execute([$theme, $version]);
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Fallback to old structure if new table doesn't exist yet
            if ($e->getCode() === '42S02') {
                $files = $db->query('SELECT *, 1 as is_visible, "title_size_mirrors_buttons" as render_type, "main_content" as location, 0 as sort_order FROM download_files ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw $e;
            }
        }
    } else {
        $files = $db->query('SELECT *, 1 as is_visible, "title_size_mirrors_buttons" as render_type, "main_content" as location, 0 as sort_order FROM download_files ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
    }

    $mStmt = $db->prepare('SELECT host,url FROM download_file_mirrors WHERE file_id=? ORDER BY ord,id');
    $out = [];
    foreach ($files as $f) {
        $mStmt->execute([$f['id']]);
        $f['mirrors'] = $mStmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($f['main_url']) && !empty($f['mirrors'])) {
            $f['main_url'] = $f['mirrors'][0]['url'];
        }
        $out[] = $f;
    }
    return $out;
}

function cms_render_download_file(array $file, string $theme = '2004'): string
{
    require_once __DIR__ . '/utilities/text_styler.php';
    
    $renderType = $file['render_type'] ?? 'title_size_mirrors_buttons';
    $title = htmlspecialchars($file['title']);
    $size = htmlspecialchars($file['file_size'] ?? '');
    $mainUrl = htmlspecialchars($file['main_url'] ?? '');
    $mirrors = $file['mirrors'] ?? [];
    
    // Use single button for legacy usingbutton field
    if (isset($file['usingbutton']) && $file['usingbutton'] && $renderType === 'title_size_mirrors_buttons') {
        $renderType = 'single_button';
    }
    
    switch ($renderType) {
        case 'black_buttons_table':
            // Specific layout for 2003 v2 with black buttons in table layout
            $html = "<table><tr><td width=\"220\">\n";
            $count = 0;
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $orderNum = $count + 1;
                
                $html .= "<table cellspacing=\"0\"><tr>\n";
                $html .= "<td><img height=\"24\" src=\"images/black_button_leftside.gif\" width=\"10\"></td>\n";
                $html .= "<td align=\"middle\" bgcolor=\"#000000\"><a class=\"maize\" href=\"{$url}\">{$orderNum}: {$host}</a></td>\n";
                $html .= "<td><img height=\"24\" src=\"images/black_button_rightside.gif\" width=\"10\"></td>\n";
                $html .= "</tr></table>\n<br>\n";
                
                $count++;
                // Switch to second column after 5 buttons
                if ($count === 5) {
                    $html .= "</td><td>\n";
                }
            }
            $html .= "</td></tr></table>\n";
            break;
            
        case 'title_size_mirrors_buttons':
            $html = "<h3>{$title}";
            if ($size) $html .= " ({$size})";
            $html .= "</h3>\n";
            
            if ($mainUrl) {
                $html .= "<a href=\"{$mainUrl}\" class=\"download-button\">Download</a>\n";
            }
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $html .= "<a href=\"{$url}\" class=\"download-button\">{$host}</a>\n";
            }
            break;
            
        case 'title_size_mirrors_links':
            $html = "<h3>{$title}";
            if ($size) $html .= " ({$size})";
            $html .= "</h3>\n";
            
            if ($mainUrl) {
                $html .= "<a href=\"{$mainUrl}\" class=\"download-link\">Download</a><br>\n";
            }
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $html .= "<a href=\"{$url}\" class=\"download-link\">{$host}</a><br>\n";
            }
            break;
            
        case 'title_no_size_mirrors_links':
            $html = "<h3>{$title}</h3>\n";
            
            if ($mainUrl) {
                $html .= "<a href=\"{$mainUrl}\" class=\"download-link\">Download</a><br>\n";
            }
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $html .= "<a href=\"{$url}\" class=\"download-link\">{$host}</a><br>\n";
            }
            break;
            
        case 'mirrors_buttons_no_title':
            $html = '';
            if ($mainUrl) {
                $html .= "<a href=\"{$mainUrl}\" class=\"download-button\">Download</a>\n";
            }
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $html .= "<a href=\"{$url}\" class=\"download-button\">{$host}</a>\n";
            }
            break;
            
        case 'single_button':
            $url = $mainUrl ?: ($mirrors[0]['url'] ?? '');
            if ($url) {
                $buttonText = $file['buttonText'] ?? $title;
                $html = '<a href="' . $url . '">' . renderGetSteamNowButton($buttonText) . '</a>';
            } else {
                $html = '';
            }
            break;
            
        case 'single_link':
            $url = $mainUrl ?: ($mirrors[0]['url'] ?? '');
            if ($url) {
                $html = "<a href=\"{$url}\" class=\"download-link\">{$title}</a>";
            } else {
                $html = '';
            }
            break;
            
        case 'title_single_link_with_size':
            $url = $mainUrl ?: ($mirrors[0]['url'] ?? '');
            if ($url) {
                $html = "<a href=\"{$url}\" class=\"download-link\">{$title}</a>";
                if ($size) $html .= " ({$size})";
            } else {
                $html = '';
            }
            break;
            
        case 'floating_box_single_link':
            $url = $mainUrl ?: ($mirrors[0]['url'] ?? '');
            if ($url) {
                $html = "<div class=\"floating-box\"><a href=\"{$url}\" class=\"download-link\">{$title}</a></div>";
            } else {
                $html = '';
            }
            break;
            
        case 'floating_box_title_mirrors_links':
            $html = "<div class=\"floating-box\">\n";
            $html .= "<h4>{$title}</h4>\n";
            
            if ($mainUrl) {
                $html .= "<a href=\"{$mainUrl}\" class=\"download-link\">Download</a><br>\n";
            }
            foreach ($mirrors as $mirror) {
                $host = htmlspecialchars($mirror['host'] ?? 'Mirror');
                $url = htmlspecialchars($mirror['url']);
                $html .= "<a href=\"{$url}\" class=\"download-link\">{$host}</a><br>\n";
            }
            $html .= "</div>\n";
            break;
            
        default:
            $html = "<p>{$title}</p>";
            break;
    }
    
    return $html;
}

function cms_get_featured_capsules(?string $theme = null): array
{
    $db    = cms_get_db();
    $theme = $theme ?? cms_get_setting('theme', '2005_v2');
    $useAll = cms_get_setting('capsules_same_all', '1') === '1';

    $capsules = [];

    // Prefer legacy four-position layout from store_capsules when available
    try {
        $res = $db->query('SELECT position, appid, image FROM store_capsules');
        foreach ($res as $row) {
            $capsules[$row['position']] = [
                'appid' => (int)$row['appid'],
                'image' => $row['image'],
            ];
        }
    } catch (PDOException $e) {
        $capsules = [];
    }

    if ($capsules) {
        return $capsules;
    }

    // Fall back to dynamic capsule items table introduced for 2006+
    $stmt = $db->prepare('SELECT appid, image_path FROM storefront_capsule_items WHERE theme = ? ORDER BY ord LIMIT 4');
    $stmt->execute([$theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows && $useAll) {
        $stmt = $db->query('SELECT appid, image_path FROM storefront_capsule_items WHERE theme IS NULL ORDER BY ord LIMIT 4');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($rows) {
        $positions = ['top', 'middle', 'bottom_left', 'bottom_right'];
        foreach ($rows as $i => $r) {
            if (isset($positions[$i])) {
                $capsules[$positions[$i]] = [
                    'appid' => (int)$r['appid'],
                    'image' => $r['image_path'],
                ];
            }
        }
    }

    return $capsules;
}

function cms_insert_support_request(string $page, array $fields, string $lang = 'en'): void
{
    $db = cms_get_db();
    $vals = array_fill(0, 10, null);
    foreach ($fields as $i => $val) {
        if ($i < 10) {
            $vals[$i] = $val;
        }
    }
    $stmt = $db->prepare('INSERT INTO support_requests(page,language,f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,created) '
        .'VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW())');
    $stmt->execute(array_merge([$page,$lang], $vals));

    $map = [
        'troubleshooter'   => 'Troubleshooter request',
        'cd_account_form'  => 'CD key form submission',
        'cheat_form'       => 'Cheat form submission',
    ];
    if (isset($map[$page])) {
        cms_create_notification('form', $map[$page]);
    }
}

function cms_insert_bug_report(array $data): int
{
    $db = cms_get_db();
    $stmt = $db->prepare('INSERT INTO bug_reports(email_address, description, reproducible, repro_steps, os, connection_type, file_system, reporter_comments, created, updated) VALUES(?,?,?,?,?,?,?,?,NOW(),NOW())');
    $stmt->execute([
        $data['email_address'] ?? '',
        $data['description'] ?? '',
        $data['repro'] ?? '',
        $data['repro_steps'] ?? '',
        $data['os'] ?? '',
        $data['connection_type'] ?? '',
        $data['file_system'] ?? '',
        $data['reporter_comments'] ?? '',
    ]);
    return (int) $db->lastInsertId();
}

function cms_get_bug_reports(): array
{
    $db = cms_get_db();
    $stmt = $db->query('SELECT * FROM bug_reports ORDER BY created DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cms_get_bug_report(int $id): ?array
{
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT * FROM bug_reports WHERE id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function cms_update_bug_report(int $id, array $data): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('UPDATE bug_reports SET email_address=?, description=?, reproducible=?, repro_steps=?, os=?, connection_type=?, file_system=?, reporter_comments=?, updated=NOW() WHERE id=?');
    $stmt->execute([
        $data['email_address'] ?? '',
        $data['description'] ?? '',
        $data['repro'] ?? '',
        $data['repro_steps'] ?? '',
        $data['os'] ?? '',
        $data['connection_type'] ?? '',
        $data['file_system'] ?? '',
        $data['reporter_comments'] ?? '',
        $id,
    ]);
}

function cms_delete_bug_report(int $id): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('DELETE FROM bug_reports WHERE id=?');
    $stmt->execute([$id]);
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

/**
 * Backward-compatible wrapper for cms_has_permission().
 *
 * Some legacy components still call cms_check_permission(); keep this
 * helper as a thin alias so those calls resolve correctly without
 * duplicating permission logic.
 *
 * @param string $perm Permission identifier to verify
 * @return bool        Whether the current admin has the permission
 */
function cms_check_permission($perm){
    return cms_has_permission($perm);
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

function cms_set_content_header_image(?string $path): void {
    if ($path === null || $path === '') {
        unset($GLOBALS['cms_content_header_image']);
    } else {
        $GLOBALS['cms_content_header_image'] = $path;
    }
}

function cms_get_content_header_image(): ?string {
    if (isset($GLOBALS['cms_content_header_image'])) {
        return $GLOBALS['cms_content_header_image'];
    }
    $img = cms_get_setting('content_header_image', '');
    return $img !== '' ? $img : null;
}

function cms_get_theme_header_data($theme, string $page = ''){
    global $cms_theme_header_cache;
    $cacheKey = $theme.'|'.$page;
    if (isset($cms_theme_header_cache[$cacheKey])) {
        return $cms_theme_header_cache[$cacheKey];
    }

    $db = cms_get_db();

    static $hasBold;
    if ($hasBold === null) {
        try {
            $db->query('SELECT bold FROM theme_headers LIMIT 1');
            $hasBold = true;
        } catch (PDOException $e) {
            if ($e->getCode() === '42S22') {
                $hasBold = false;
            } elseif ($e->getCode() === '42S02') {
                return ['logo' => '', 'spacer' => '', 'buttons' => []];
            } else {
                throw $e;
            }
        }
    }

    $cols = 'logo,text,img,hover,depressed,url,visible,spacer' . ($hasBold ? ',bold' : '');

    try {
        $stmt = $db->prepare("SELECT $cols FROM theme_headers WHERE theme=? AND page=? ORDER BY ord,id");
        $stmt->execute([$theme, $page]);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S22') {
            // older schema without page column
            $stmt = $db->prepare("SELECT $cols FROM theme_headers WHERE theme=? ORDER BY ord,id");
            $stmt->execute([$theme]);
        } elseif ($e->getCode() === '42S02') {
            return ['logo' => '', 'spacer' => '', 'buttons' => []];
        } else {
            throw $e;
        }
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows && $page !== '') {
        try {
            $stmt->execute([$theme, '']);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // ignore if schema lacks page column
        }
    }

    if (!$rows) {
        $cms_theme_header_cache[$cacheKey] = ['logo' => '', 'spacer' => '', 'buttons' => []];
        return $cms_theme_header_cache[$cacheKey];
    }

    $logo    = $rows[0]['logo'];
    $spacer  = $rows[0]['spacer'];
    $buttons = [];

    foreach ($rows as $r) {
        $buttons[] = [
            'text'     => $r['text'],
            'img'      => $r['img'],
            'hover'    => $r['hover'],
            'depressed'=> $r['depressed'],
            'url'      => $r['url'],
            'visible'  => $r['visible'],
            'bold'     => $hasBold ? (int)$r['bold'] : 0,
        ];
    }

    $cms_theme_header_cache[$cacheKey] = ['logo' => $logo, 'spacer' => $spacer, 'buttons' => $buttons];
    return $cms_theme_header_cache[$cacheKey];
}

function cms_get_theme_footer($theme)
{
    global $cms_theme_footer_cache;
    if (isset($cms_theme_footer_cache[$theme])) {
        return $cms_theme_footer_cache[$theme];
    }
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
            $cms_theme_footer_cache[$theme] = '';
            return '';
        }

        $cms_theme_footer_cache[$theme] = $html;
        return $html;
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            $cms_theme_footer_cache[$theme] = '';
            return '';
        }
        throw $e;
    }
}

function cms_get_theme_css($theme){
    global $cms_theme_css_cache;
    if (isset($cms_theme_css_cache[$theme])) {
        return $cms_theme_css_cache[$theme];
    }
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT css_path FROM themes WHERE name=?');
        $stmt->execute([$theme]);
        $css = $stmt->fetchColumn();
        if($css===false || $css==='') {
            $cms_theme_css_cache[$theme] = 'steampowered02.css';
            return 'steampowered02.css';
        }
        $cms_theme_css_cache[$theme] = $css;
        return $css;
    } catch(PDOException $e){
        if(in_array($e->getCode(), ['42S02','42S22'])) {
            $cms_theme_css_cache[$theme] = 'steampowered02.css';
            return 'steampowered02.css';
        }
        throw $e;
    }
}

function cms_get_theme_setting(string $theme, string $name, $default = null){
    global $cms_theme_setting_cache;
    $cacheKey = $theme.'|'.$name;
    if (array_key_exists($cacheKey, $cms_theme_setting_cache)) {
        return $cms_theme_setting_cache[$cacheKey];
    }

    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT value FROM theme_settings WHERE theme=? AND name=?');
        $stmt->execute([$theme,$name]);
        $val = $stmt->fetchColumn();
        $cms_theme_setting_cache[$cacheKey] = $val!==false ? $val : $default;
        return $cms_theme_setting_cache[$cacheKey];
    } catch(PDOException $e){
        if($e->getCode()==='42S02') {
            $cms_theme_setting_cache[$cacheKey] = $default;
            return $default;
        }
        throw $e;
    }
}

function cms_get_theme_config(string $theme): array
{
    global $cms_theme_config_cache;
    if (isset($cms_theme_config_cache[$theme])) {
        return $cms_theme_config_cache[$theme];
    }
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT name, value FROM theme_settings WHERE theme=?');
        $stmt->execute([$theme]);
        $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        $cms_theme_config_cache[$theme] = $rows ?: [];
        return $cms_theme_config_cache[$theme];
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            $cms_theme_config_cache[$theme] = [];
            return [];
        }
        throw $e;
    }
}

function cms_set_theme_setting(string $theme, string $name, $value){
    global $cms_theme_setting_cache, $cms_theme_config_cache;
    $db = cms_get_db();
    $stmt = $db->prepare('REPLACE INTO theme_settings(theme,name,value) VALUES(?,?,?)');
    $stmt->execute([$theme,$name,$value]);
    $cms_theme_setting_cache[$theme.'|'.$name] = $value;
    if (isset($cms_theme_config_cache[$theme])) {
        $cms_theme_config_cache[$theme][$name] = $value;
    }
}
function cms_nav_buttons_html($theme, string $spacer_style = '', ?string $spacer_override = null, ?string $spacer_color = null){
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
            $titleAttr = htmlspecialchars($text);
            $label = htmlspecialchars($text);
            if(in_array($theme, ['2002_v2','2003_v1']) && !empty($b['bold'])){
                $label = '<b>'.$label.'</b>';
            }
            $segment = '<a href="'.$url.'" title="'.$titleAttr.'">'.$label.'</a>';
        }
        if(!$first && $spacer !== ''){
            $styleParts = [];
            if($spacer_style){
                $styleParts[] = $spacer_style;
            }
            if($spacer_color && preg_match('/^#?[0-9a-fA-F]{3,6}$/', $spacer_color)){
                $color = ltrim($spacer_color,'#');
                $styleParts[] = 'color:#'.$color;
            }
            $style = $styleParts ? ' style="'.htmlspecialchars(implode(';', $styleParts)).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $out .= $segment;
        $first = false;
    }
    if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
        if(!$first && $spacer !== ''){
            $styleParts = [];
            if($spacer_style){
                $styleParts[] = $spacer_style;
            }
            if($spacer_color && preg_match('/^#?[0-9a-fA-F]{3,6}$/', $spacer_color)){
                $color = ltrim($spacer_color,'#');
                $styleParts[] = 'color:#'.$color;
            }
            $style = $styleParts ? ' style="'.htmlspecialchars(implode(';', $styleParts)).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $base = cms_base_url();
        $out .= '<a href="'.$base.'/cms/admin/index.php" title="Admin">ADMIN</a>';
    }
    return $out;
}
function cms_header_buttons_html($theme, string $spacer_style = '', ?string $spacer_override = null, ?string $spacer_color = null){
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
            $titleAttr = htmlspecialchars($text);
            $label = htmlspecialchars($text);
            if(in_array($theme, ['2002_v2','2003_v1']) && !empty($b['bold'])){
                $label = '<b>'.$label.'</b>';
            }
            $segment = '<div class="globalNavItem"><a href="'.$url.'" title="'.$titleAttr.'"><span class="globalNavLink">'.$label.'</span></a></div>';
        }
        if(!$first && $spacer !== ''){
            $styleParts = [];
            if($spacer_style){
                $styleParts[] = $spacer_style;
            }
            if($spacer_color && preg_match('/^#?[0-9a-fA-F]{3,6}$/', $spacer_color)){
                $color = ltrim($spacer_color,'#');
                $styleParts[] = 'color:#'.$color;
            }
            $style = $styleParts ? ' style="'.htmlspecialchars(implode(';', $styleParts)).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $out .= $segment;
        $first = false;
    }
    if(cms_current_admin() || isset($_COOKIE['cms_admin_token'])){
        if(!$first && $spacer !== ''){
            $styleParts = [];
            if($spacer_style){
                $styleParts[] = $spacer_style;
            }
            if($spacer_color && preg_match('/^#?[0-9a-fA-F]{3,6}$/', $spacer_color)){
                $color = ltrim($spacer_color,'#');
                $styleParts[] = 'color:#'.$color;
            }
            $style = $styleParts ? ' style="'.htmlspecialchars(implode(';', $styleParts)).'"' : '';
            $out .= '<span class="navSpacer"'.$style.'>'.$spacer.'</span>';
        }
        $base = cms_base_url();
        $out .= '<a href="'.$base.'/cms/admin/index.php" title="Admin">ADMIN</a>';
    }
    return $out;
}

function cms_render_header(string $theme, bool $with_buttons = true): string {
    cms_record_visit($_SERVER['REQUEST_URI'] ?? '');
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
    // Check for theme-specific navbar.css override
    $base_path         = rtrim($base, '/');
    $theme_navbar_css  = "themes/$theme/css/navbar.css";
    $includes_navbar_css = "./includes/css/navbar.css";

    // Determine which navbar stylesheet to load. If the active theme provides
    // its own navbar.css it should completely replace the global one so that
    // duplicate rules do not conflict. Assign an ID so templates can reference
    // or replace the link if needed.
    if (is_file(dirname(__DIR__) . "/$theme_navbar_css")) {
        $navbar_css = ($base_path ? $base_path . '/' : '') . $theme_navbar_css;
    } else {
        $navbar_css = $includes_navbar_css;
    }
    $out  = '<link href="' . $navbar_css . '" rel="stylesheet" type="text/css" id="navbar-css">';
    $out .= '<div style="min-width:850px;">';
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
            $target = parse_url($l['url'], PHP_URL_PATH);
            $l['url'] .= $qs;
            $l['current'] = ($target === $path);
            if (!$l['current'] && ($target === '/storefront/allgames.php' || $target === '/storefront/all.php')) {
                if (in_array($path, ['/storefront/game.php','/storefront/package.php','/storefront/all.php'], true)) {
                    $l['current'] = true;
                }
            }
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

function cms_get_app_screenshots(int $appid): array
{
    $db = cms_get_db();
    try {
        $stmt = $db->prepare('SELECT id,filename,hidden,ord FROM store_screenshots WHERE appid=? ORDER BY ord,id');
        $stmt->execute([$appid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return [];
        }
        throw $e;
    }
}

function cms_set_app_screenshot(int $appid, string $file, bool $hidden, int $ord): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('INSERT INTO store_screenshots(appid,filename,hidden,ord) VALUES(?,?,?,?)');
    $stmt->execute([$appid,$file,$hidden?1:0,$ord]);
}

function cms_app_screenshot_fs_dir(int $appid): string
{
    return CMS_ROOT . '/storefront/images/apps/' . $appid . '/screenshots/';
}

function cms_app_header_fs_dir(int $appid): string
{
    return CMS_ROOT . '/storefront/apps/' . $appid . '/headers/';
}

function cms_app_screenshot_url(int $appid, string $file): string
{
    return rtrim(cms_base_url(), '/') . '/storefront/images/apps/' . $appid . '/screenshots/' . $file;
}

function cms_app_header_url(int $appid, string $file): string
{
    return rtrim(cms_base_url(), '/') . '/storefront/apps/' . $appid . '/headers/' . $file;
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
        $stmt = $db->prepare('SELECT id,type,message FROM notifications WHERE is_read = 0 AND (admin_id = ? OR admin_id = 0) ORDER BY created DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return [];
        }
        throw $e;
    }
}

function cms_mark_notification_read(int $id): void
{
    $db = cms_get_db();
    $stmt = $db->prepare('UPDATE notifications SET is_read=1 WHERE id=?');
    $stmt->execute([$id]);
}

function cms_create_notification(string $type, string $message, int $adminId = 0): void
{
    $db = cms_get_db();
    $db->exec('CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id INT DEFAULT 0,
        type VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        data JSON NULL,
        is_read TINYINT(1) DEFAULT 0,
        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )');
    $stmt = $db->prepare('INSERT INTO notifications(admin_id,type,message) VALUES(?,?,?)');
    $stmt->execute([$adminId, $type, $message]);
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

function cms_get_sidebar_sections_html(string $theme, bool $for_admin = false): string
{
    static $sectionCache = [];
    $cacheKey = $theme . '|' . ($for_admin ? '1' : '0');
    if (isset($sectionCache[$cacheKey])) {
        return $sectionCache[$cacheKey];
    }

    $db = cms_get_db();
    try {
        $stmt = cms_get_prepared_statement(
            'SELECT v.variant_id, s.section_id, s.title, v.icon_path, v.is_collapsible, v.collapsible_id, v.has_icicles, v.html_content
             FROM sidebar_sections s
             JOIN sidebar_section_variants v ON s.section_id = v.section_id
             WHERE FIND_IN_SET(?, v.theme_list)
             ORDER BY v.sort_order, s.section_id'
        );
        $stmt->execute([$theme]);
        $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return '';
        }
        throw $e;
    }

    $out = '';
    foreach ($sections as $section) {
        $sid = (int)$section['section_id'];
        $vid = (int)$section['variant_id'];
        $html = $section['html_content'];
        if (strpos($html, '{{entries}}') !== false) {
            $estmt = cms_get_prepared_statement(
                'SELECT entry_content FROM sidebar_section_entries WHERE parent_variant_id=? AND (theme_list IS NULL OR theme_list="" OR FIND_IN_SET(?, theme_list)) ORDER BY entry_order'
            );
            $estmt->execute([$vid, $theme]);
            $entries = '';
            foreach ($estmt->fetchAll(PDO::FETCH_ASSOC) as $erow) {
                $entries .= $erow['entry_content'];
            }
            $html = str_replace('{{entries}}', $entries, $html);
        }
        $icon = $section['icon_path'] ? '<img src="' . htmlspecialchars($section['icon_path'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '" alt="" align="absmiddle"> ' : '';
        $title = trim($section['title']);
        $titleEsc = htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $html = cms_render_string($html, [], dirname(__DIR__) . '/themes/' . $theme);
        if (!empty($section['has_icicles']) && in_array($theme, ['2007_v1','2007_v2'], true)) {
            $style = 'background-image: url(./images/ice/ice_right.jpg); background-repeat: no-repeat;';
            if (preg_match('/^<([a-z0-9]+)([^>]*)style="([^"]*)"/i', $html)) {
                $html = preg_replace('/^<([a-z0-9]+)([^>]*)style="([^"]*)"/i', '<$1$2style="$3 ' . $style . '"', $html, 1);
            } else {
                $html = preg_replace('/^<([a-z0-9]+)([^>]*)>/i', '<$1$2 style="' . $style . '">', $html, 1);
            }
        }
        $hasTitle = $titleEsc !== '';
        if ($for_admin) {
            $out .= '<div class="sidebar-section" data-id="' . $sid . '">';
            if ($hasTitle) {
                $out .= '<h1>' . $icon . $titleEsc . '</h1>';
            }
            $out .= '<div class="section-controls"><button class="edit-section" data-id="' . $sid
                . '">Edit</button> <button class="delete-section" data-id="' . $sid . '">Delete</button></div>'
                . $html;
            if ($hasTitle) {
                $out .= '<div class="rightColHr"></div>';
            }
            $out .= '</div>';
        } else {
            if ($hasTitle) {
                $out .= '<h1>' . $icon . $titleEsc . '</h1>' . $html . '<div class="rightColHr"></div>';
            } else {
                $out .= $html;
            }
        }
    }
    $sectionCache[$cacheKey] = $out;
    return $out;
}

function cms_get_csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function cms_verify_csrf(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
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

function cms_log_missing_file(string $path): void
{
    cms_log_php_error('missing_file', 'Missing file: ' . $path, $path, 0);
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


error_reporting(E_ALL);
set_error_handler('cms_error_handler', E_ALL);
set_exception_handler('cms_exception_handler');
register_shutdown_function('cms_shutdown_handler');
?>
