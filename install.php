<?php
session_start();
if (file_exists(__DIR__.'/cms/config.php')) {
    echo 'CMS already installed.';
    exit;
}
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$errors = [];

/**
 * Convert a loose, human-readable date (e.g. “Wed, 24 Aug 2005”
 * or “February 24, 2005, 12:33 pm”) to ‘Y-m-d H:i:s’.
 * If PHP can’t parse it, return the original string unchanged.
 */
function normalizeDate(string $raw): string
{
    // strip outer quotes that str_getcsv removed earlier
    $clean = trim($raw, " \t\n\r\0\x0B'\"");
    $ts    = strtotime($clean);
    return $ts !== false ? date('Y-m-d H:i:s', $ts) : $raw;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($step == 1) {
        $host = trim($_POST['host']);
        $port = trim($_POST['port']);
        $user = trim($_POST['dbuser']);
        $pass = trim($_POST['dbpass']);
        $dbname = trim($_POST['dbname']);
        try {
            $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $_SESSION['cms_install'] = compact('host', 'port', 'user', 'pass', 'dbname');
            header('Location: install.php?step=2');
            exit;
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    } elseif ($step == 2 && isset($_SESSION['cms_install'])) {
        $config = $_SESSION['cms_install'];
        $host = $config['host'];
        $port = $config['port'];
        $user = $config['user'];
        $pass = $config['pass'];
        $dbname = $config['dbname'];
        $admin_user = trim($_POST['admin_user']);
        $admin_pass = trim($_POST['admin_pass']);
        $admin_email = trim($_POST['admin_email']);
        try {
            $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbname`");
            $pdo->exec("DROP TABLE IF EXISTS news");
            $pdo->exec("CREATE TABLE news(id BIGINT AUTO_INCREMENT PRIMARY KEY,title TEXT,author TEXT,publish_date DATETIME,publish_at DATETIME,views INT DEFAULT 0,content TEXT,is_official TINYINT(1) DEFAULT 1,status VARCHAR(20) DEFAULT 'draft')");
            $pdo->exec("DROP TABLE IF EXISTS content_servers");
            $pdo->exec("CREATE TABLE content_servers(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255),
                ip VARCHAR(100),
                port INT,
                total_capacity INT,
                region VARCHAR(100)
            )");
            $pdo->exec("DROP TABLE IF EXISTS server_stats");
            $pdo->exec("CREATE TABLE server_stats(
                id INT AUTO_INCREMENT PRIMARY KEY,
                server_id INT,
                available_bandwidth INT,
                unique_connections INT,
                last_checked DATETIME,
                status VARCHAR(10)
            )");
            $pdo->exec("DROP TABLE IF EXISTS faq_categories");
            $pdo->exec("CREATE TABLE faq_categories(id1 BIGINT,id2 BIGINT,name TEXT,hidden TINYINT(1) DEFAULT 0,PRIMARY KEY(id1,id2))");
            $pdo->exec("DROP TABLE IF EXISTS faq_content");
            $pdo->exec("CREATE TABLE faq_content(catid1 BIGINT,catid2 BIGINT,faqid1 BIGINT,faqid2 BIGINT,title TEXT,body TEXT,views INT DEFAULT 0,PRIMARY KEY(faqid1,faqid2))");
            $pdo->exec("DROP TABLE IF EXISTS ccafe_registration");
            $pdo->exec("CREATE TABLE ccafe_registration(
                id INT AUTO_INCREMENT PRIMARY KEY,
                created DATETIME,
                company TEXT,
                address1 TEXT,
                address2 TEXT,
                city TEXT,
                state TEXT,
                zip TEXT,
                country TEXT,
                firstname TEXT,
                lastname TEXT,
                email TEXT,
                phone TEXT,
                fax TEXT,
                locations INT,
                seats INT,
                prepaid_hours TEXT,
                ship_name TEXT,
                ship_address1 TEXT,
                ship_address2 TEXT,
                ship_city TEXT,
                ship_state TEXT,
                ship_zip TEXT,
                ship_country TEXT,
                directory TEXT,
                contact_email TEXT,
                ship_phone TEXT,
                wire_transfer TEXT
            )");
            $pdo->exec("DROP TABLE IF EXISTS custom_pages");
            $pdo->exec("CREATE TABLE custom_pages(
                slug VARCHAR(255) PRIMARY KEY,
                title TEXT,
                content MEDIUMTEXT,
                theme TEXT DEFAULT NULL,
                template VARCHAR(255) DEFAULT NULL,
                created DATETIME,
                updated DATETIME,
                status VARCHAR(20) DEFAULT 'draft'
            )");
            $pdo->exec("DROP TABLE IF EXISTS cafe_directory");
            $pdo->exec("CREATE TABLE cafe_directory(
                id INT AUTO_INCREMENT PRIMARY KEY,
                url TEXT,
                name TEXT,
                phone TEXT,
                address TEXT,
                city_state TEXT,
                zip TEXT,
                ord INT DEFAULT 0
            )");
            $pdo->exec("DROP TABLE IF EXISTS cafe_representatives");
            $pdo->exec("CREATE TABLE cafe_representatives(
                id INT AUTO_INCREMENT PRIMARY KEY,
                url TEXT,
                website TEXT,
                email TEXT,
                rep_name TEXT,
                address TEXT,
                city_province TEXT,
                zip TEXT,
                country TEXT,
                phone TEXT,
                ord INT DEFAULT 0
            )");
            $pdo->exec("DROP TABLE IF EXISTS media");
            $pdo->exec("CREATE TABLE media(
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename TEXT,
                uploaded DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS redirects");
            $pdo->exec("CREATE TABLE redirects(
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(200) UNIQUE,
                target TEXT,
                hits INT DEFAULT 0,
                created DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS random_content");
            $pdo->exec("CREATE TABLE random_content(
                uniqueid INT AUTO_INCREMENT PRIMARY KEY,
                tag_name VARCHAR(25) NOT NULL,
                content TEXT NOT NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS scheduled_content");
            $pdo->exec("CREATE TABLE scheduled_content(
                content_id INT AUTO_INCREMENT PRIMARY KEY,
                theme_name VARCHAR(64),
                description VARCHAR(255) NOT NULL,
                tag_name VARCHAR(25) NOT NULL,
                content TEXT NOT NULL,
                schedule_type ENUM('every_n_days','day_of_month','fixed_range') NOT NULL,
                every_n_days INT DEFAULT NULL,
                day_of_month TINYINT DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                fixed_start_datetime DATETIME DEFAULT NULL,
                fixed_end_datetime DATETIME DEFAULT NULL,
                active BOOLEAN DEFAULT TRUE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS custom_titles");
            $pdo->exec("CREATE TABLE custom_titles(
                uniqueid INT AUTO_INCREMENT PRIMARY KEY,
                title_name VARCHAR(100) UNIQUE,
                themes VARCHAR(255),
                title_content TEXT NOT NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS settings");
            $pdo->exec("CREATE TABLE settings(`key` VARCHAR(64) PRIMARY KEY,value TEXT)");
            $pdo->exec("DROP TABLE IF EXISTS themes");
            $pdo->exec("CREATE TABLE themes(name VARCHAR(255) PRIMARY KEY, css_path TEXT DEFAULT NULL)");
            $pdo->exec("DROP TABLE IF EXISTS theme_settings");
            $pdo->exec("CREATE TABLE theme_settings(theme VARCHAR(50), name VARCHAR(50), value TEXT, PRIMARY KEY(theme,name))");
            $pdo->exec("DROP TABLE IF EXISTS theme_headers");
            $pdo->exec("CREATE TABLE theme_headers(
                id INT AUTO_INCREMENT PRIMARY KEY,
                theme VARCHAR(50),
                page VARCHAR(50) DEFAULT '',
                ord INT DEFAULT 0,
                logo TEXT,
                text TEXT,
                img TEXT,
                hover TEXT,
                depressed TEXT,
                url TEXT,
                visible TINYINT(1) DEFAULT 1,
                spacer TEXT,
                INDEX(theme),
                INDEX(page)
            )");
            $pdo->exec("DROP TABLE IF EXISTS theme_footers");
            $pdo->exec("CREATE TABLE theme_footers(
                theme VARCHAR(50) PRIMARY KEY,
                html MEDIUMTEXT
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_users");
            $pdo->exec("DROP TABLE IF EXISTS player_sessions");
            $pdo->exec("CREATE TABLE player_sessions (
                id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id       BIGINT UNSIGNED NOT NULL,
                session_start DATETIME        NOT NULL,
                session_end   DATETIME        NOT NULL,
                INDEX(user_id, session_start)
            )");
                        $pdo->exec("DROP TABLE IF EXISTS player_history");
                        $pdo->exec("CREATE TABLE player_history (
                ts           TIMESTAMP PRIMARY KEY,
                players      INT UNSIGNED NOT NULL,
                game_servers INT UNSIGNED NOT NULL
            )");
                        $pdo->exec("DROP TABLE IF EXISTS bw_history");
                        $pdo->exec("CREATE TABLE bw_history (
                ts     TIMESTAMP PRIMARY KEY,
                mbps   INT UNSIGNED NOT NULL 
            )");

            $pdo->exec("DROP TABLE IF EXISTS admin_roles");
            $pdo->exec("CREATE TABLE admin_roles(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) UNIQUE,
                permissions TEXT
            )");

            $pdo->exec("CREATE TABLE admin_users(
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100),
                email TEXT,
                first_name TEXT,
                last_name TEXT,
                permissions TEXT,
                role_id INT DEFAULT NULL,
                created DATETIME,
                password VARCHAR(255)
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_tokens");
            $pdo->exec("CREATE TABLE admin_tokens(
                token_hash VARCHAR(64) PRIMARY KEY,
                user_id INT,
                expires DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_logs");
            $pdo->exec("CREATE TABLE admin_logs(
                id INT AUTO_INCREMENT PRIMARY KEY,
                user INT,
                action TEXT,
                ts DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS notifications");
            $pdo->exec("CREATE TABLE notifications(
                id INT AUTO_INCREMENT PRIMARY KEY,
                type VARCHAR(50) NOT NULL,
                message TEXT NOT NULL,
                target_user INT DEFAULT NULL,
                target_role VARCHAR(50) DEFAULT NULL,
                created DATETIME DEFAULT CURRENT_TIMESTAMP,
                read_at DATETIME DEFAULT NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS page_views");
            $pdo->exec("CREATE TABLE page_views(
                date DATE,
                page VARCHAR(255),
                views INT DEFAULT 0,
                PRIMARY KEY(date,page)
            )");
            $pdo->exec("DROP TABLE IF EXISTS help_texts");
            $pdo->exec("CREATE TABLE help_texts(
                page VARCHAR(64),
                field VARCHAR(64),
                content TEXT,
                PRIMARY KEY(page,field)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
            function split_sql_statements($sql)
            {
                $stmts = [];
                $buffer = '';
                $inBlock = false;
                foreach (preg_split("/\r?\n/", $sql) as $line) {
                    $trim = trim($line);
                    if ($inBlock) {
                        if (strpos($trim, '*/') !== false) {
                            $inBlock = false;
                        }
                        continue;
                    }
                    if ($trim === '' || str_starts_with($trim, '--') || $trim[0] === '#') {
                        continue;
                    }
                    if (str_starts_with($trim, '/*')) {
                        $inBlock = true;
                        continue;
                    }
                    $buffer .= $line."\n";
                    if (preg_match('/;\s*$/', $trim)) {
                        $stmts[] = trim($buffer);
                        $buffer = '';
                    }
                }
                if (trim($buffer) !== '') {
                    $stmts[] = trim($buffer);
                }
                return $stmts;
            }

            foreach (glob(__DIR__.'/sql/*.sql') as $file) {
                $sql = file_get_contents($file);
                foreach (split_sql_statements($sql) as $stmt) {
                    $stmt = trim($stmt);
                    if ($stmt === '') {
                        continue;
                    }

                    if (stripos($stmt, 'INSERT INTO news') === 0) {
                        // isolate the part after “VALUES”
                        $vals = trim(substr($stmt, stripos($stmt, 'VALUES') + 6));
                        $vals = rtrim($vals, ';');
                        $rows = preg_split('/\),\s*\(/', trim($vals, '()'));   // split rows

                        $newsStmt = $pdo->prepare(
                            'INSERT INTO news(id,title,author,publish_date,publish_at,content,status) VALUES(?,?,?,?,?,?,?)'
                        );

                        foreach ($rows as $row) {
                            $parts = str_getcsv($row, ',', "'");
                            if (count($parts) < 5) {
                                continue;
                            }

                            // undo doubled single-quotes, trim whitespace
                            $id      = trim($parts[0]);
                            $title   = str_replace("''", "'", $parts[1]);
                            $author  = str_replace("''", "'", $parts[2]);
                            $date    = normalizeDate($parts[3]);
                            $content = str_replace("''", "'", $parts[4]);

                            $newsStmt->execute([
                                $id,
                                $title,
                                $author,
                                $date,
                                $date,
                                $content,
                                'published'
                            ]);
                        }
                        continue;  // skip $pdo->exec($stmt) — we’ve handled it.
                    }

                    require_once 'sql/install_custom_pages.php';

                    $pdo->exec($stmt);
                }
            }
            // use first inserted content server as default network target
            try {
                $res = $pdo->query("SELECT ip,port FROM content_servers ORDER BY id ASC LIMIT 1");
                $server = $res ? $res->fetch(PDO::FETCH_ASSOC) : false;
                if ($server) {
                    $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
                    $stmt->execute(['main_network_ip',$server['ip']]);
                    $stmt->execute(['main_network_port',$server['port']]);
                }
            } catch (PDOException $e) {
                // table might not exist; ignore
            }
            $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,role_id,created,password) VALUES(?,?,?,?,?,?,NOW(),?)');
            $stmt->execute([$admin_user,$admin_email,'','', '', 1,$hash]);
            // default settings
            $footer = <<<'HTML'
© 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.</span></td>

HTML;
            $error_html = <<<HTML
<!-- invalid_area -->

<div class="content" id="container">
<h1>INVALID AREA</H1>
<h2>PERHAPS  <em>YOU MISTYPED?</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>
Please select an option from the top menu.

</div>
</div>
HTML;
                        $header_buttons = [
                ['url' => '/news.php','text' => 'news'],
                ['url' => '/getsteamnow.php','text' => 'getSteamNow'],
                ['url' => '/cybercafes.php','text' => 'Cyber Cafes'],
                ['url' => '/support.php','text' => 'Support'],
                ['url' => '/forums.php','text' => 'Forums'],
                ['url' => '/status/status.html','text' => 'Status']
            ];
            $default_nav = [
                ['file' => 'index.php','label' => 'Dashboard','visible' => 1],
                ['file' => 'main_content.php','label' => 'Main Content','visible' => 1],
                ['file' => 'news.php','label' => 'News','visible' => 1],
                ['file' => 'faq.php','label' => 'FAQ','visible' => 1],
                ['file' => 'cafe_signups.php','label' => 'Cafe Signup Requests','visible' => 1],
                ['file' => 'cafe_directory.php','label' => 'Cafe Directory','visible' => 1],
                ['file' => 'cafe_pricing.php','label' => 'Cafe Pricing','visible' => 1],
                ['file' => 'cafe_representatives.php','label' => 'Cafe Representatives','visible' => 1],
                ['file' => 'content_servers.php','label' => 'Servers','visible' => 1],
                ['file' => 'contentserver_banners.php','label' => 'ContentServer Banner Management','visible' => 1],
                ['file' => 'custom_pages.php','label' => 'Custom Pages','visible' => 1],
                ['file' => 'custom_titles.php','label' => 'Custom Titles','visible' => 1],
                ['file' => 'random_content.php','label' => 'Random Content','visible' => 1],
                ['file' => 'scheduled_content.php','label' => 'Scheduled Content','visible' => 1],
                ['file' => 'theme.php','label' => 'Theme','visible' => 1],
                ['file' => 'settings.php','label' => 'Settings','visible' => 1],
                ['file' => 'header_footer.php','label' => 'Header & Footer','visible' => 1],
                ['file' => 'storefront_main.php','label' => 'Main Page','visible' => 1],
                ['file' => 'storefront.php','label' => 'Storefront','visible' => 1],
                ['file' => 'storefront_sidebar.php','label' => 'Sidebar','visible' => 1],
                ['file' => 'storefront_products.php','label' => 'Products','visible' => 1],
                ['file' => 'storefront_categories.php','label' => 'Categories','visible' => 1],
                ['file' => 'storefront_developers.php','label' => 'Developers','visible' => 1],
                ['file' => 'faq_categories.php','label' => 'FAQ Categories','visible' => 1],
                ['file' => 'admin_users.php','label' => 'Administrators','visible' => 1],
                ['file' => 'error_page.php','label' => 'Error Page','visible' => 1],
                ['file' => '../logout.php','label' => 'Logout','visible' => 1]
            ];
            $defaults = [
                'theme' => '2004',
                'admin_theme' => 'v2',
                'site_title' => 'Steam',
                'smtp_host' => '',
                'smtp_port' => '',
                'smtp_user' => '',
                'smtp_pass' => '',
                'header_overrides' => '',
                'header_config' => json_encode(['logo' => 'themes/2004/images/valve_head.gif','buttons' => $header_buttons]),
                'footer_html' => $footer,
                'favicon' => '/favicon.ico',
                'error_html' => $error_html,
                'nav_items' => json_encode($default_nav),
                'root_path' => '',
                'gzip' => '0',
                'enable_cache' => '0',
                'news_year_only' => '1'
            ];
            $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
            foreach ($defaults as $k => $v) {
                $stmt->execute([$k,$v]);
            }
            $pageStmt = $pdo->prepare('INSERT INTO custom_pages(slug,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,?,?,?)');

            /* -----------------------------------------------------------
             *  HEADER-BAR SEEDS
             * --------------------------------------------------------- */

            $default_buttons = [
                ['url' => 'index.php?area=news',          'text' => 'news'],
                ['url' => 'index.php?area=getsteamnow',   'text' => 'getSteamNow'],
                ['url' => 'index.php?area=cybercafes',    'text' => 'Cyber Cafes'],
                ['url' => 'support.php',       'text' => 'Support'],
                ['url' => 'index.php?area=forums',        'text' => 'Forums'],
                ['url' => 'status/status.php','text' => 'Status'],
            ];

            /* theme-specific overrides                                    */
            $button_overrides = [
                /* 2003_v1 → Support | Forums | Contact ------------------ */
                '2003_v1' => [
                    ['url' => 'support.php',   'text' => 'Support'],
                    ['url' => 'index.php?area=forums',    'text' => 'Forums'],
                    ['url' => 'contact.php',   'text' => 'Contact'],
                ],

                /* 2002_v2 → Try Steam Now! | Steam Support Site | Valve Home */
                '2002_v2' => [
                    ['url' => 'getsteamnow.php','text' => 'Try Steam Now!'],
                    ['url' => 'support.php',   'text' => 'Steam Support Site'],
                    ['url' => 'http://www.valvesoftware.com','text' => 'Valve Home'],
                ],
            ];

            /* -----------------------------------------------------------
             *  LOGOS PER THEME
             * --------------------------------------------------------- */
            $logos = [
                '2002_v1' => '',   // special-case: no header bar
                '2002_v2' => 'themes/2002_v2/images/LOGO_Steam2.gif',
                '2003_v1' => 'themes/2003_v1/images/LOGO_Steam2.gif',
                '2003_v2' => 'themes/2003_v2/images/valve_head.gif',
                '2004'    => 'themes/2004/images/valve_head.gif',
                '2005_v1' => 'themes/2005_v1/images/Logo_VALVE.gif',
                '2005_v2' => 'themes/2005_v2/images/Logo_VALVE.gif',
                '2006_v1' => 'themes/2006_v1/images/logo_steam_header.jpg',
                '2006_v2' => 'themes/2006_v2/images/logo_steam_header.jpg',
            ];

            /* -----------------------------------------------------------
             *  INSERT
             * --------------------------------------------------------- */
            $thStmt = $pdo->prepare(
                'INSERT INTO theme_headers
                 (theme,page,ord,logo,text,img,hover,depressed,url,visible,spacer)
                 VALUES (?,?,?,?,?,?,?,?,?,1,?)'
            );

            foreach ($logos as $theme => $logo) {

                /* 2002_v1 has **no** header bar ----------------------------------- */
                if ($theme === '2002_v1') {
                    continue;
                }

                /* pick button seed: override or default --------------------------- */
                $buttons = $button_overrides[$theme] ?? $default_buttons;

                $ord     = 0;
                $spacer  = in_array($theme, ['2002_v2','2003_v1']) ? ' | ' : '';

                foreach ($buttons as $btn) {
                    $thStmt->execute([
                        $theme,
                        '',
                        $ord++,
                        $logo,
                        $btn['text'],
                        null,           // img
                        null,           // hover
                        null,           // depressed
                        $btn['url'],
                        $spacer
                    ]);
                }
            }

            $tfStmt = $pdo->prepare('INSERT INTO theme_footers(theme,html) VALUES(?,?)');
            $tfStmt->execute(['2003_v1',<<<'HTML'
<tbody><tr height="19">
<td colspan="4" height="19" width="799"></td>
<td height="19" width="1"><spacer height="19" type="block" width="1"></spacer></td>
</tr>
<tr height="24">
<td colspan="2" height="24" width="360"></td>
<td align="left" height="24" valign="top" width="424" xpos="360"><img border="0" height="23" src="themes/2003_v1/images/Valve_CircleR.gif" width="82"></td>
<td height="77" rowspan="2" width="15"></td>
<td height="24" width="1"><spacer height="24" type="block" width="1"></spacer></td>
</tr>
<tr height="53">
<td height="53" width="17"></td>
<td align="left" colspan="2" content="" csheight="53" height="53" valign="top" width="767" xpos="17">
<div align="center">
<p><font color="white" size="2"><b><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular"></font></b><a href="support/supportindex.html" target="_self">Support</a> | <a href="forums" target="_self">Forums </a>| <a href="index.php#contactanchor2" target="_self">Contact<br>
</a></font><font color="#969f8e" size="1">(c) 2003 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks<br>
                                and/or registered trademarks of Valve, L.L.C.</font></p>
</div>
</td>
<td height="53" width="1"><spacer height="53" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="17"><spacer height="1" type="block" width="17"></spacer></td>
<td height="1" width="343"><spacer height="1" type="block" width="343"></spacer></td>
<td height="1" width="424"><spacer height="1" type="block" width="424"></spacer></td>
<td height="1" width="15"><spacer height="1" type="block" width="15"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody>
HTML]);
            $tfStmt->execute(['2003_v2',<<<'HTML'
<div class="footer">
<a href="http://www.valvesoftware.com"><img align="left" src="{BASE}images/valve_greenlogo.gif"></a> ©2003 Valve, L.L.C. All rights reserved. Read our <a href="index.php?area=privacy">privacy policy</a>.<br>
Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
</div>']);
$tfStmt->execute(['2004','<div class="footer">
<a href="http://www.valvesoftware.com"><img src="images/valve_greenlogo.gif" align="left"></a> ©2004 Valve Corporation. All rights reserved. <a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.<br>
Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve Corporation.
</div>
HTML]);
            $tfStmt->execute(['2005_v1',<<<'HTML'
<span class="footerfix">© 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.</span>
HTML]);
            $tfStmt->execute(['2005_v2',<<<'HTML'
<tbody><tr height="11">
<td height="11" width="800"></td>
<td height="11" width="1"><spacer height="11" type="block" width="1"></spacer></td>
</tr>
<tr height="100">
<td content="" csheight="100" height="100" valign="top" width="800" xpos="0">
<div class="footer">
                                © 2005 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="index.php?area=privacy">Privacy Policy.</a> &nbsp;<a href="index.php?area=legal">Legal.</a> &nbsp;<a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></div>
<p></p>
<div align="right">
<p><img alt="" border="0" height="20" src="themes/2005_v2/images/creditcardonsteam.gif" width="279"></p>
</div>
</td>
<td height="100" width="1"><spacer height="100" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="800"><spacer height="1" type="block" width="800"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody>
HTML]);
            $tfStmt->execute(['2006_v1',<<<'HTML'
<div class="footer">
<table background="themes/2006_v1/images/img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="themes/2006_v1/images/img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="themes/2006_v1/images/logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></div>
</td>
<td background="themes/2006_v1/images/img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);
            $tfStmt->execute(['2006_v2',<<<'HTML'
<div class="footer">
<table background="themes/2006_v2/images/img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="themes/2006_v2/images/img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="themes/2006_v2/images/logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></div>
</td>
<td background="themes/2006_v2/images/img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);
            $tfStmt->execute(['2007',<<<'HTML'
<div class="footer">
<table background="themes/2007/images/img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="themes/2007/images/img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="themes/2007/images/logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">
<form action="index.php">
<input name="area" type="hidden" value="main">
<input name="cc" type="hidden" value="US">
<select name="l" onchange="submit();">
<option id="l_danish" value="danish">Danish</option>
<option id="l_dutch" value="dutch">Dutch</option>
<option id="l_english" selected="" value="english">English</option>
<option id="l_finnish" value="finnish">Finnish</option>
<option id="l_french" value="french">French</option>
<option id="l_german" value="german">German</option>
<option id="l_italian" value="italian">Italian</option>
<option id="l_japanese" value="japanese">Japanese</option>
<option id="l_korean" value="korean">Korean</option>
<option id="l_norwegian" value="norwegian">Norwegian</option>
<option id="l_polish" value="polish">Polish</option>
<option id="l_portuguese" value="portuguese">Portuguese</option>
<option id="l_russian" value="russian">Russian</option>
<option id="l_schinese" value="schinese">Simplified Chinese</option>
<option id="l_tchinese" value="tchinese">Traditional Chinese</option>
<option id="l_spanish" value="spanish">Spanish</option>
<option id="l_swedish" value="swedish">Swedish</option>
<option id="l_thai" value="thai">Thai</option>
</select><br>
<br></form>				© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a>
<br></div>
</td>
<td background="themes/2007/images/img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);

            $features_html = <<<'HTML'
<!-- features -->

<div class="content" id="container">
<h1>FEATURES</H1>
<h2>WHAT <em>CAN STEAM DO?</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
Once you've installed Steam, all of the following features are available on your desktop <i>and while you're playing Steam games</i>.
<br><br>
<h3>EASY AND FAST ACCESS TO GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_games.gif">
After installing Steam, you'll have instant access to Valve's full library of games. And when you choose one to play, you don't have to wait for the whole thing to download -- you can start playing in a matter of minutes.<br clear="all">
<br clear="all">
<h3>AUTOMATIC UPDATES</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_updates.gif">
Say goodbye to game patches forever--they're a thing of the past. Steam will keep all of its games up-to-date for as long as you want to keep playing them. No more hunting for download sites just to get up and running!<br clear="all">
<br clear="all">
<h3>INSTANT MESSAGING, EVEN IN GAME</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_im.gif">
Keep in touch with your buddies through "Friends," Steam's instant-messenger. It even works while you or your friends are playing games -- you don't have to stop playing to communicate.<br clear="all">
<br clear="all">
<h3>SERVER BROWSER - FIND YOUR FRIENDS' GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_servers.gif">
Now it's incredibly easy to find a quality game server -- one that's fast, that's running your favorite game, and even one that has your friends already playing on it.<br clear="all">
<br clear="all">
<h3>PARLOR GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_chess.gif">
Maybe you're dodging your homework. Maybe you're just bored while waiting for another turn in Counter-Strike. Either way -- why not enjoy a nice game of Chess? Or Checkers? Or Go? Or Hearts... Or....<br clear="all">
<br clear="all">

<!-- <h3>AND LOTS MORE</h3>
<img width="88" height="88" align="left" vspace="4" src="images/thumb_xxx.gif">
xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx. xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx.

-->
</div><br clear="all">
<a href="index.php?area=getsteamnow"><img src="images/but_getsteamnow.gif" height="24" width="124" alt="get steam now"></a><br>
</div>
HTML;
            $pageStmt->execute(['features','Features',$features_html,'2003_v1,2003_v2,2004','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $e3_html = <<<'HTML'
<!-- e3 movies -->
<div class="content" id="container">
<h1>Half-Life 2: E3 2003</H1>
<h2>MOVIES<em> FROM THE ELECTRONIC ENTERTAINMENT EXPO</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
Half-Life 2 debuted last year at E3, and won <a href="http://www.gamecriticsawards.com/past.html">Best of Show, Best PC Game, Best Action Game, and Special Commendation for Graphics</a>. On this page you can download video footage (captured directly from the game engine) showing all of the gameplay demos from the 2003 E3 booth.<br><br>
<nobr>
<img style="border:6px solid black;" width="180" height="100" src="images/movie_thumbs/hl2_movie1.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="images/movie_thumbs/hl2_movie2.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="images/movie_thumbs/hl2_movie3.jpg">
</nobr><br>
<br>
These files are high-resolution, so they are pretty large. A <a href="http://bitconjurer.org/BitTorrent/download.html">BitTorrent</a> client is needed to download them, so please install that first.<br><br>
<span style="color:red;font-weight:bold;">Note: These files have been taken offline for now. (They will soon be replaced by the E3 2004 movies.)</span><br><br>
<table width="480">
<tr>
<td>The GMan</a> (70MB)</td>
<td>Docks</a> (50MB)</td>
</tr><tr>
<td>Kleiner's Lab</a> (85MB)</td>
<td>Traptown</a> (190MB)</td>
</tr><tr>
<td>Tunnels</a> (100MB)</td>
<td>Bugbait</a> (170MB)</td>
</tr><tr>
<td>Barricade</a> (120MB)</td>
<td>Coastline</a> (170MB)</td>
</tr><tr>
<td>Striders</a> (150MB)</td>
<td>Psyche</a> (16MB)</td>
</tr>
</table>
<br><br>
Note that these movies are in Bink .exe format. If your computer has trouble playing the movies, you may want to download the <a href="http://www.radgametools.com/bnkdown.htm">the RAD video tools</a> and try different playback settings.
</div>
</div>
HTML;
            $pageStmt->execute(['e3_movies','Half-Life 2 E3 Movies',$e3_html,'2003_v1,2003_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $forums_html = <<<'HTML'
<!-- forums -->
<div class="content" id="container">
<h1>FORUMS</h1>
<h2>FOR <em>SUPPORT AND DISCUSSION</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>
<p>Before posting a problem in the forums, please use the new interactive Steam Support system..  It contains answers for many of the most common problems and questions.</p>
<p align="center"><a href="support.php">Use the Steam Support system.</a></p>
<p>Below are some forum usage guidelines. They are posted here as a general reminder in an effort to keep the forums friendly and usable for everyone.</p>
<ul><em>
<li style="list-style-image:url(images/square2.gif);"> The forums are for everyone, new and advanced user alike.<br>
<br>
<li style="list-style-image:url(images/square2.gif);"> Before you post a question, use the <a href="/forums/search.php" target="_blank">forum search feature</a> to determine whether your topic has already been covered.<br>
<br>
<li style="list-style-image:url(images/square2.gif);"> Do not start flame wars. If you have a problem with someone, message that person and carry on a private discussion. Also, if someone has engaged in behavior that is a detriment to the message board -- spamming, flaming people, etc -- contact one of the forum moderators. Flaming the offensive user will only increase the problem.<br>
<br>
<li style="list-style-image:url(images/square2.gif);"> Please post in the correct forum.<br>
<br>
<li style="list-style-image:url(images/square2.gif);"> Administrators/Moderators reserve the right to change, edit, or delete any content at any time if they feel it is inappropriate.<br>
</em></ul>
<p>The bottom line is: respect others and you will be treated with respect. Be rude and disrespectful, and you'll not find much help here.</p>
<p align="center"><a href="forums/"> I agree to these terms.</a></p>
</div>
</div>
HTML;
            $pageStmt->execute(['forums','Forums',$forums_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2,2006_v1,2006_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $ded_html = <<<'HTML'
<!-- dedicated server -->
<div class="content" id="container">
<h1>Dedicated Server update files</h1>
<h2>WINDOWS<em> AND LINUX VERSIONS</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
For those server admins who have trouble with the Steam HLDS update tool, or have trouble getting the dedicated server update through Steam, here are the changed files.<br>
<br>
<h3 style="text-transform:uppercase;">March 23rd (CS:CZ) Release</h3>
NOTE: This release includes only those files which have changed since the last dedicated server release. This download is an update only -- it requires that you have a Half-Life dedicated game server already installed. If you're looking for the full dedicated server Steam installer, you can find it on the <a href="/?area=getsteamnow">Get Steam Now</a> page (towards the bottom).<br><br>
<b>NOTE: This download requires you to have <a href="http://www.bitconjurer.org/BitTorrent/download.html">BitTorrent</a> installed.</b><br>
<br>
<a href="files/HLserver/mar22/czero_dedicated_server_032204.zip.torrent">Windows Dedicated Server Update</a><br>
<br>
<a href="files/HLserver/mar22/czero_dedicated_server_linux_032204.tgz.torrent">Linux Dedicated Server Update</a><br>
</div>
</div>
HTML;
            $pageStmt->execute(['dedicated_server','Dedicated Server update files',$ded_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $css_html = <<<'HTML'
<!-- CS:S Beta 1 FAQ -->
<div class="content" id="container">
<h1>COUNTER-STRIKE: SOURCE</h1>
<h2>BETA 1 <em>QUESTIONS AND ANSWERS</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
<ul>
<li style="list-style-image:url(images/square2.gif);"> <a href="#q1"><em>When will Counter-Strike: Source beta 1 be released?</em></a>
<li style="list-style-image:url(images/square2.gif);"> <a href="#q2"><em>How can I get Counter-Strike: Source beta 1?</em></a>
<li> <a href="#q3"><em>I am a member of the Valve Cyber Caf&eacute; Program, or I own Condition Zero.  How will I know when Counter-Strike: Source beta 1 is available?</em></a>
<li> <a href="#q8"><em>If I purchased the ATI/Half-Life 2 Video Card bundle, how do I participate in the Counter-Strike: Source Beta??</em></a>
<li> <a href="#q4"><em>Can I get access to the beta if I am not part of the Valve Cyber Caf&eacute; Program, and do not own Condition Zero?</em></a>
<li> <a href="#q5"><em>How will Counter-Strike: Source be different from the Half-Life 1 based Counter-Strike?</em></a>
<li> <a href="#q6"><em>What will the system requirements be for Counter-Strike: Source?</em></a>
<li> <a href="#q7"><em>Do I get to keep Counter-Strike: Source after the beta period has ended?</em></a>
</ul>
<table cellspacing="3" cellpadding="3" align="center">
<tr>
        <td colspan="2" align="center"><hr style="width: 100%;"></td>
</tr>
<tr bgcolor="#606060">
        <td><a href="images/cs_source_01.jpg"><img src="images/cs_source_01_tn.jpg"></td>
        <td><a href="images/cs_source_02.jpg"><img src="images/cs_source_02_tn.jpg"></td>
</tr>
<tr>
        <td colspan="2" align="center"><hr style="width: 100%;"></td>
</tr>
</table>
<p>Starting later this summer, Valve will be conducting a limited-time beta of Counter-Strike: Source via Steam.</p>
<p>The beta will first be open to subscribers of the Valve Cyber Caf&eacute; Program, and then extended to owners of Counter-Strike: Condition Zero and owners of ATI Half-Life 2 vouchers.</p>
<p>If you do not already have a Steam account, you can create a Steam account and use your ATI/Half-Life 2 product key printed on the coupon that came with the video card.  Once you have entered the key, you will be prompted to join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?area=getsteamnow">Click here to install Steam</a></p>
<p>If you have a Steam account and have not yet registered your ATI/Half-Life 2 product key printed on the coupon that came with the video card, you can register your key below and join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="steam://open/registerproduct/">Click here register your ATI key</a></p>
<p>No.</p>
</div>
</div>
HTML;
            $pageStmt->execute(['css_b1','Counter-Strike: Source Beta 1 FAQ',$css_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $pricing_html = <<<'HTML'
<div class="content" id="container">
<h1>PRICING AND LICENSING</H1>
<h2>VALVE'S<em> OFFICIAL CYBER CAF&Eacute; PROGRAM</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

Valve's Official Cyber Caf&eacute; Program makes things simple for the caf&eacute; owner.<br>
<br>
<h3 style="text-transform:uppercase;">One low monthly fee</h3>
For a low monthly fee per licensed computer, your caf&eacute; gets access to all of Valve's games. See the <a href="index.php?area=cybercafe_program">full list of Features and Benefits</a> for the details of what's included. Payment is handled in three-month blocks, in advance, either by recurring automatic billing or by invoice. <!-- For full details about licensing, payment, and the details of the Caf&eacute; Program, please see the official <a href="cafe_signup.php">Valve Cyber Caf&eacute; Agreement</a>. --><br>
<br>
<!--
<h3 style="text-transform:uppercase;">APRIL CYBER CAF&Eacute; PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="index.php?area=cybercafe_promotion">special offer to Cyber Caf&eacute;s</a>. During this time, a 12-month cyber caf&eacute; license for Valve's games is being offered at a savings of 33%. <a href="/?area=cybercafe_promotion">See this page for details</a>.<br>
<Br>
-->
<h3 style="text-transform:uppercase;">Fully licensed software</h3>
Software purchased at retail is not licensed for commercial use such as cyber caf&eacute; play. If you operate a gaming center, our program is the legal way to obtain a commercial license and offer Valve's games to your customers.<br>
<br>
<h3 style="text-transform:uppercase;">As Always, Tournament Licenses Are Free</h3>
If you'd like to host a LAN event or competition, just <a href="mailto:cafe@valvesoftware.com">let us know</a> and we'll issue you a Tournament License, free of charge.<br>
<br>
<a href="index.php?area=cafe_signup">Sign up now for the CyberCaf&eacute; Program!</a><br>
<br>
<a href="index.php?area=cybercafes">Return to main Cyber Caf&eacute; page</a>

</div>
</div>
HTML;
            $pageStmt->execute(['cafe_pricing','Cyber Café Pricing and Licensing',$pricing_html,null,'default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

            $dirStmt = $pdo->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord) VALUES(?,?,?,?,?,?,?)');
            $defaultCafes = [
                ['http://www.gparadise.com','Gamers Paradise (IGUK)','(178) 424-7985','5 Station Road','Ashford','TW15 2UW'],
                [null,'Fragz R Us Ltd','+441268271650','11 East Walk','Basildon, Essex','SS141HG'],
                ['http://ozzis.co.uk','Ozzi\'s Online Gaming (IGUK)','(192) 447-1777','23 Commercial Street','Batley','WF17 5HJ'],
                ['http://www.quarks.co.uk','Quarks - Reading (IGUK)','0118 9782229','7 Union Street - Reading','Berkshire','RG1 1EU'],
                ['http://www.dotcomicide.net','Dotcomicide (IGUK)','(+44) (0) 1214725248','616 Bristol Road - Selly Oak','Birmingham','B29 6BQ'],
                [null,'NetAdventure/GlobalGaming Arena (IGUK)','44-121-693-6655','68-70 Dalton Street - Dale End','Birmingham','B4 7LX'],
                ['http://www.wireworld.co.uk','Wireworld Bournemouth','(44) 1202 859680','280 Charminster Road','Bournemouth','BH8 9RT'],
                [null,"Surf 'N' Play (IGUK)",'44 (0) 117 950 8833','14 High Street - Westbury on Trym','Bristol','BS93DU'],
                ['http://www.thelanrooms.co.uk','The LAN Rooms (IGUK)','973-3886','6 Cotham Hill - Cotham','Bristol','BS6 6LF'],
                ['http://www.plexusweb.co.uk','Plexus (IGUK)','01282 422858','5 Yorkshire St','Burnley','BB11 2DB'],
                ['http://www.cyberemporium.co.uk','Cyber Emporium (IGUK)','01298214455','28 High Street','Buxton','SK17 6EU'],
                ['http://lansport.co.uk','Lansport(iGUK)','332344177','Agard street','Derby','DE1 1DZ'],
                ['http://www.ubernet.org.uk','I.G.Net/UberNet (IGUK)','01382 322949','6 Panmure street','Dundee','DD5 2ll'],
                ['http://www.impactgaming.co.uk','Impact Gaming Ltd','01323 642299','21a Langney Road','Eastbourne','Bn21 3QA'],
                ['http://www.netplay.co.uk','NetPlay LTD (IGUK)','01424 853996','117-119 Seaside Road','Eastbourne','BN21 3PH'],
                ['http://www.cyber-gamer.net','CyberNetHX (IGUK)','01422 300011','1-9 Silver Street','Halifax','HX1 1HS'],
                ['http://cyberscene.co.uk','Cyberscene(IGUK)','01279 419111','Shop 4 Bush house - Bush fair shopping centre','Harlow,Esssex','cm18 6ns'],
                ['http://www.harrowarena.com','HarrowArena (IGUK)','02088638264','276 Station Road','Harrow','HA1 2EA'],
                ['http://www.webfrenzy.co.uk','Web Frenzy ltd (IGUK)','01424 426777','1 Breeds Place','hastings','TN34 3AA'],
                ['http://www.cyber-gamer.net','CyberNetHD(IGUK)','713497','80 John William Street','Huddersfield','HD6 3RG'],
                [null,'Compsel Ltd/The Hub (IGUK)','(441) 482-6582','206 Newland Avenue','Hull','HU106JG'],
                ['http://www.equestiow.tk','E-Quest (IGUK)','(198) 353-2597','14 Scarrots Lane - Newport','Isle of Wight','PO30 1JD'],
                ['http://www.cafeclix.co.uk','Cafe Clix (IGUK)','01926 863200','46 Abby End','Kenilworth','CV8 1QJ'],
                ['http://www.gamesgenius.com','Games Genius Limited(IGUK)','355- 281','10 High Street - Gravesend','Kent','DA11 0BQ'],
                ['http://www.lcionline.co.uk','LCI Online (IGUK)','264-0620','1093-1095 Melton Road - Syston','Leicester','LE7 2JS'],
                ['http://www.gametheworld.com','GAMETHEWORLD Lisburn (IGUK)','02892 628880','3 Graham Gardens','Lisburn','BT28 1 XE'],
                ['http://www.lanforce.co.uk','LANFORCE','','1st Floor - 6 & 8 Norwich Street','Norfolk','NR21 9AE'],
                ['http://www.battlenet.co.uk','Battlenet (IGUK)','01603 765595','2a Queens Road','Norwich','NR2 3PR'],
                [null,'CombatStrike Ltd.','44 115 9881880','The Cornerhouse - Burton Street','Nottingham','NG9 5EA'],
                [null,'Gamecentre2 (IGUK)','01723 500505','1 Harcourt Place','SCARBOROUGH','YO11 2EP'],
                ['http://www.starbytes.co.uk','StarBytes Cyber Cafes Limited (IGUK)','023 8033 0000','12 New Road','Southampton','SO14 0AA'],
                ['http://www.xcession.com','Xcession Cybercafe (IGUK)','245-6549','Stevenage Leisure Centre - Lytton Way','Stevenage','SG1 1LZ'],
                ['http://enamorgaming.co.uk','Enamor (IGUK)','01915658855','46 Frederick Street','Sunderland','SR1NF'],
                ['http://www.quarks.co.uk','Quarks - Guildford (IGUK)','','7 Jeffries Passage - Guildford','Surrey','GU1 4AP'],
                ['http://www.quarks.co.uk','Quarks - Richmond (IGUK)','','4 Red Lion Street - Richmond','Surrey','TW3 1RW'],
                ['http://www.wiredinn.co.uk','Wired Inn (IGUK)','(0) 1793 430 300','Fleetway House - Queen Street','SWINDON','SN1 1RN'],
                ['http://www.escape-interactive.com','e-scape (IGUK)','+44 (0) 1926 887211','111 Warwick Street - Leamington Spa','Warwickshire','CN32 4QZ'],
                ['http://www.ecobwebs.co.uk','Cobwebs (IGUK)','01305 779688','28 St Thomas Street','Weymouth','DT4 8EJ'],
                ['http://www.cyber-realm.co.uk','Cyber Realm Limited (IGUK)','07739 024954','56 High Street','Wickford','SS12 9AT'],
                [null,"Snor'z Game Systems Ltd (IGUK)",'01902 781451','Unit 10 Marsh Lane Parade - Stafford Road','Wolverhampton','WV10 6RT'],
                ['http://www.lan-den.net','landen ltd(IGUK)','(190) 5 2-6260','Top floor,22-24 New street','worcester','WR1 2DN']
            ];
            $ord = 1;
            foreach ($defaultCafes as $c) {
                $dirStmt->execute(array_merge($c, [$ord++]));
            }

            $repStmt = $pdo->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
            $defaultReps = [
                ['http://www.transferbg.com/','TRANSFER GROUP LTD.','transfer@transferbg.com','Vasil Enfedzhiyan','80 Danail Nikolaev Street','Plovdiv','4000','Bulgaria','359 32 624 080'],
                ['http://www.ledzone.com/index_steam.html','NAMCO LIMITED','steam@ledzone.com','Reina Yagishita','Tokyu-Plaza Annex 2F','Tokyo','144-0051','Japan',''],
                ['http://www.valvepcbang.com/','GNA Soft Co., Ltd.','west@gnasoft.com','Sean Lee','249-4 Urban Light Bldg 7th Floor','Seoul','135-010','Korea',''],
                ['http://www.boomtown.net/','BOOMTOWN','JAPC@cafe.boomtown.net','Jakob Christiansen','Larslejsstrde 6','Kobenhavn C, Copenhagen','0900','Denmark','+45-51909111'],
                ['http://www.computergames.ro/','COMPUTER GAMES ONLINE SRL','silviu@computergames.ro','Silviu Stroie','Unirii 75 Blvd, bl. H1','Bucharest','','Romania',''],
                ['http://www.unalis.com.tw/','UNALIS CORPORATION','leon@unalis.com.tw','Leon Chang','10F, No 168 SEC 2','Taipei','','Taiwan','']
            ];
            foreach ($defaultReps as $r) {
                $repStmt->execute(array_merge($r, [$ord++]));
            }
            $stmt2 = $pdo->prepare('REPLACE INTO themes(name, css_path) VALUES(?,?)');
            foreach (glob(__DIR__.'/themes/*', GLOB_ONLYDIR) as $dir) {
                $name = basename($dir);
                if (substr($name, -6) === '_admin') {
                    continue;
                }
                $css = 'steampowered02.css';
                if (!file_exists("$dir/css/$css")) {
                    $css = file_exists("$dir/css/steampowered.css") ? 'steampowered.css' : '';
                    if ($css === '') {
                        $files = glob("$dir/css/*.css");
                        $css = $files ? basename($files[0]) : '';
                    }
                }
                $css_path = $css ? 'css/'.$css : '';
                $stmt2->execute([$name,$css_path]);
                $cfg_file = "$dir/config.php";
                if (file_exists($cfg_file)) {
                    $cfg = include $cfg_file;
                    if (is_array($cfg)) {
                        $set = $pdo->prepare('REPLACE INTO theme_settings(theme,name,value) VALUES(?,?,?)');
                        foreach ($cfg as $k => $v) {
                            $set->execute([$name,$k,(string)$v]);
                        }
                    }
                }
                $sql_dir = "$dir/sql";
                if (is_dir($sql_dir)) {
                    foreach (glob($sql_dir.'/*.sql') as $sql) {
                        $pdo->exec(file_get_contents($sql));
                    }
                }
            }
            $cfg = "<?php\nreturn [\n    'host'=>'$host',\n    'port'=>'$port',\n    'dbname'=>'$dbname',\n    'user'=>'$user',\n    'pass'=>'$pass'\n];\n?>";
            file_put_contents(__DIR__.'/cms/config.php', $cfg);
            unset($_SESSION['cms_install']);
            header('Location: install.php?step=3');
            exit;
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Install CMS</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #171a21 0%, #2a475e 100%);
            color: #c7d5e0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .install-container {
            background: #1e3a52;
            border: 1px solid #3c4043;
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .install-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .install-header h1 {
            color: #ffffff;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .install-header p {
            color: #8f8f8f;
            font-size: 16px;
        }

        .steam-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #66c0f4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #ffffff;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #3c4043;
            border-radius: 6px;
            font-size: 14px;
            background: #2a475e;
            color: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #66c0f4;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary {
            background: #66c0f4;
            color: #1e3a52;
        }

        .btn-primary:hover {
            background: #5aa9e6;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.2);
            border: 1px solid #e74c3c;
            color: #ffffff;
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.2);
            border: 1px solid #27ae60;
            color: #ffffff;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #3c4043;
            border-radius: 3px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #66c0f4;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
<div class="install-container">
    <div class="install-header">
        <div class="steam-logo">CMS</div>
        <h1>SteamCMS Installation</h1>
        <p>Multi-era Steam website content management system</p>
    </div>
    <div class="progress-bar">
        <div class="progress-fill" style="width: <?php echo ($step / 3) * 100; ?>%;"></div>
    </div>
    <?php if ($errors): ?>
        <ul style="color:#ff8080;">
        <?php foreach ($errors as $e) {
            echo '<li>'.htmlspecialchars($e).'</li>';
        } ?>
        </ul>
    <?php endif; ?>
    <?php if ($step == 1): ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Step 1: Database Configuration</h2>
        <form method="post">
            <div class="form-group">
                <label for="host">Database Host</label>
                <input id="host" class="form-control" name="host" value="localhost">
            </div>
            <div class="form-group">
                <label for="port">Database Port</label>
                <input id="port" class="form-control" name="port" value="3306">
            </div>
            <div class="form-group">
                <label for="dbname">Database Name</label>
                <input id="dbname" class="form-control" name="dbname" value="steamcms">
            </div>
            <div class="form-group">
                <label for="dbuser">Database User</label>
                <input id="dbuser" class="form-control" name="dbuser" value="root">
            </div>
            <div class="form-group">
                <label for="dbpass">Database Password</label>
                <input id="dbpass" type="password" class="form-control" name="dbpass">
            </div>
            <button class="btn btn-primary" type="submit">Continue</button>
        </form>
    <?php elseif ($step == 2): ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Step 2: Admin User</h2>
        <form method="post">
            <div class="form-group">
                <label for="admin_user">Admin Username</label>
                <input id="admin_user" class="form-control" name="admin_user" value="admin">
            </div>
            <div class="form-group">
                <label for="admin_pass">Admin Password</label>
                <input id="admin_pass" type="password" class="form-control" name="admin_pass" value="steamcms">
            </div>
            <div class="form-group">
                <label for="admin_email">Admin Email</label>
                <input id="admin_email" type="email" class="form-control" name="admin_email" value="admin@steampowered.com">
            </div>
            <button class="btn btn-primary" type="submit">Install</button>
        </form>
    <?php else: ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Installation Complete</h2>
        <p><a href="cms/login.php" class="btn btn-primary">Log in</a></p>
    <?php endif; ?>
</div>
</body>
</html>
