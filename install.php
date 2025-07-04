<?php
session_start();
if(file_exists(__DIR__.'/cms/config.php')){
    echo 'CMS already installed.';
    exit;
}
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$errors = [];

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($step==1){
        $host=trim($_POST['host']);
        $port=trim($_POST['port']);
        $user=trim($_POST['dbuser']);
        $pass=trim($_POST['dbpass']);
        $dbname=trim($_POST['dbname']);
        try{
            $dsn="mysql:host=$host;port=$port;charset=utf8mb4";
            $pdo=new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $_SESSION['cms_install']=compact('host','port','user','pass','dbname');
            header('Location: install.php?step=2');
            exit;
        }catch(PDOException $e){
            $errors[]=$e->getMessage();
        }
    }elseif($step==2 && isset($_SESSION['cms_install'])){
        $config=$_SESSION['cms_install'];
        $host=$config['host'];
        $port=$config['port'];
        $user=$config['user'];
        $pass=$config['pass'];
        $dbname=$config['dbname'];
        $admin_user=trim($_POST['admin_user']);
        $admin_pass=trim($_POST['admin_pass']);
        $admin_email=trim($_POST['admin_email']);
        try{
            $dsn="mysql:host=$host;port=$port;charset=utf8mb4";
            $pdo=new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbname`");
            $pdo->exec("DROP TABLE IF EXISTS news");
            $pdo->exec("CREATE TABLE news(id BIGINT AUTO_INCREMENT PRIMARY KEY,title TEXT,author TEXT,publish_date DATETIME,views INT DEFAULT 0,content TEXT,is_official TINYINT(1) DEFAULT 1)");
            $pdo->exec("DROP TABLE IF EXISTS faq_categories");
            $pdo->exec("CREATE TABLE faq_categories(id1 BIGINT,id2 BIGINT,name TEXT,PRIMARY KEY(id1,id2))");
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
                created DATETIME,
                updated DATETIME
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
            $pdo->exec("DROP TABLE IF EXISTS settings");
            $pdo->exec("CREATE TABLE settings(`key` VARCHAR(64) PRIMARY KEY,value TEXT)");
            $pdo->exec("DROP TABLE IF EXISTS themes");
            $pdo->exec("CREATE TABLE themes(name VARCHAR(255) PRIMARY KEY)");
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

            $pdo->exec("CREATE TABLE admin_users(
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100),
                email TEXT,
                first_name TEXT,
                last_name TEXT,
                permissions TEXT,
                created DATETIME,
                password VARCHAR(255)
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_tokens");
            $pdo->exec("CREATE TABLE admin_tokens(
                token_hash VARCHAR(64) PRIMARY KEY,
                user_id INT,
                expires DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS page_views");
            $pdo->exec("CREATE TABLE page_views(
                date DATE,
                page VARCHAR(255),
                views INT DEFAULT 0,
                PRIMARY KEY(date,page)
            )");
            function split_sql_statements($sql){
                $stmts = [];
                $len = strlen($sql);
                $current = '';
                $inSingle = false;
                $inDouble = false;
                for($i=0;$i<$len;$i++){
                    $ch = $sql[$i];
                    if($ch === "'" && !$inDouble){
                        if($inSingle && $i+1<$len && $sql[$i+1]==="'"){
                            $current .= "''";
                            $i++;
                            continue;
                        }
                        $inSingle = !$inSingle;
                    }elseif($ch === '"' && !$inSingle){
                        if($inDouble && $i+1<$len && $sql[$i+1]==='"'){
                            $current .= '""';
                            $i++;
                            continue;
                        }
                        $inDouble = !$inDouble;
                    }
                    if($ch === ';' && !$inSingle && !$inDouble){
                        $stmts[] = trim($current);
                        $current = '';
                    }else{
                        $current .= $ch;
                    }
                }
                if(trim($current) !== '') $stmts[] = trim($current);
                return $stmts;
            }

            foreach(glob(__DIR__.'/sql/*.sql') as $file){
                $sql=file_get_contents($file);
                foreach(split_sql_statements($sql) as $stmt){
                    $stmt = trim($stmt);
                    if($stmt==='') continue;

                    if(stripos($stmt,'INSERT INTO news')===0 &&
                       preg_match('/^INSERT INTO news\([^\)]*\) VALUES \((.*)\)$/i',$stmt,$m)){
                        $parts = str_getcsv($m[1], ',', "'");
                        if(isset($parts[3])){
                            $ts = strtotime($parts[3]);
                            if($ts!==false){
                                $parts[3] = date('Y-m-d H:i:s',$ts);
                                $id = $parts[0];
                                $title = "'".str_replace("'","''",$parts[1])."'";
                                $author = "'".str_replace("'","''",$parts[2])."'";
                                $date = "'".$parts[3]."'";
                                $content = "'".str_replace("'","''",$parts[4])."'";
                                $stmt = "INSERT INTO news(id,title,author,publish_date,content) VALUES ($id,$title,$author,$date,$content)";
                            }
                        }
                    }

                    if(stripos($stmt,'INSERT INTO custom_pages')===0 &&
                       preg_match('/^INSERT INTO custom_pages\([^\)]*\) VALUES\s*(.*)$/i',$stmt,$m)){
                        $values = rtrim($m[1], ';');
                        $rows = preg_split('/\),\s*\(/', trim($values, '()'));
                        $cpStmt = $pdo->prepare('INSERT INTO custom_pages(slug,title,content,created,updated) VALUES(?,?,?,?,?)');
                        foreach($rows as $row){
                            $parts = str_getcsv($row, ',', "'");
                            if(count($parts)>=5){
                                $created = strtoupper($parts[3])=='NOW()' ? date('Y-m-d H:i:s') : $parts[3];
                                $updated = strtoupper($parts[4])=='NOW()' ? date('Y-m-d H:i:s') : $parts[4];
                                $cpStmt->execute([$parts[0],$parts[1],$parts[2],$created,$updated]);
                            }
                        }
                        continue;
                    }

                    $pdo->exec($stmt);
                }
            }
            // use first inserted content server as default network target
            try {
                $res = $pdo->query("SELECT ip,port FROM content_servers ORDER BY id ASC LIMIT 1");
                $server = $res ? $res->fetch(PDO::FETCH_ASSOC) : false;
                if($server){
                    $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
                    $stmt->execute(['main_network_ip',$server['ip']]);
                    $stmt->execute(['main_network_port',$server['port']]);
                }
            } catch (PDOException $e) {
                // table might not exist; ignore
            }
            $hash=password_hash($admin_pass,PASSWORD_DEFAULT);
            $stmt=$pdo->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,created,password) VALUES(?,?,?,?,?,NOW(),?)');
            $stmt->execute([$admin_user,$admin_email,'','','all',$hash]);
            // default settings
            $footer = file_get_contents(__DIR__.'/cms/content/footer.html');
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
            $sa_html = <<<'HTML'
<!-- steam subscriber agreement (truncated) -->
<div class="content" id="container">
<h1>STEAM&trade; SUBSCRIBER AGREEMENT</h1>
This Agreement is written only in the English language, which language will be controlling in all respects.<br>
<br>
<h2>1. REGISTRATION AND ACTIVATION.</h2>
Steam is an online service ("Steam") offered by Valve Corporation.<br>
<!-- full agreement text omitted for brevity -->
</div>
HTML;
            $header_buttons = [
                ['url'=>'/news.php','img'=>'/img/news.gif','hover'=>'/img/MOnews.gif','alt'=>'news'],
                ['url'=>'/getsteamnow.php','img'=>'/img/getSteamNow.gif','hover'=>'/img/MOgetSteamNow.gif','alt'=>'getSteamNow'],
                ['url'=>'/cybercafes.php','img'=>'/img/cafes.gif','hover'=>'/img/MOcafes.gif','alt'=>'Cyber Cafes'],
                ['url'=>'/support.php','img'=>'/img/support.gif','hover'=>'/img/MOsupport.gif','alt'=>'Support'],
                ['url'=>'/forums.php','img'=>'/img/forums.gif','hover'=>'/img/MOforums.gif','alt'=>'Forums'],
                ['url'=>'/status/status.html','img'=>'/img/status.gif','hover'=>'/img/MOstatus.gif','alt'=>'Status']
            ];
            $default_nav = [
                ['file'=>'index.php','label'=>'Dashboard','visible'=>1],
                ['file'=>'main_content.php','label'=>'Main Content','visible'=>1],
                ['file'=>'news.php','label'=>'News','visible'=>1],
                ['file'=>'faq.php','label'=>'FAQ','visible'=>1],
                ['file'=>'cybercafe.php','label'=>'Cyber Cafe Management','visible'=>1],
                ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
                ['file'=>'contentserver_banners.php','label'=>'ContentServer Banner Management','visible'=>1],
                ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
                ['file'=>'theme.php','label'=>'Theme','visible'=>1],
                ['file'=>'settings.php','label'=>'Settings','visible'=>1],
                ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
                ['file'=>'storefront_main.php','label'=>'Main Page','visible'=>1],
                ['file'=>'storefront.php','label'=>'Storefront','visible'=>1],
                ['file'=>'storefront.php#products','label'=>'Products','visible'=>1],
                ['file'=>'storefront.php#categories','label'=>'Categories','visible'=>1],
                ['file'=>'storefront_developers.php','label'=>'Developers','visible'=>1],
                ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1],
                ['file'=>'admin_users.php','label'=>'Administrators','visible'=>1],
                ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
                ['file'=>'../logout.php','label'=>'Logout','visible'=>1]
            ];
            $defaults = [
                'theme'=>'2004',
                'admin_theme'=>'v2',
                'site_title'=>'Steam',
                'smtp_host'=>'',
                'smtp_port'=>'',
                'smtp_user'=>'',
                'smtp_pass'=>'',
                'header_overrides'=>'',
                'header_config'=>json_encode(['logo'=>'/img/steam_logo_onblack.gif','buttons'=>$header_buttons]),
                'footer_html'=>$footer,
                'favicon'=>'/favicon.ico',
                'error_html'=>$error_html,
                'nav_items'=>json_encode($default_nav),
                'root_path'=>'',
                'gzip'=>'0',
                'enable_cache'=>'0',
                'news_year_only'=>'1'
            ];
            $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
            foreach($defaults as $k=>$v){ $stmt->execute([$k,$v]); }
            $pageStmt = $pdo->prepare('INSERT INTO custom_pages(slug,title,content,theme,created,updated) VALUES(?,?,?,?,?,NOW())');
            $pageStmt->execute(['subscriber_agreement','Steam Subscriber Agreement',$sa_html,null,date('Y-m-d H:i:s')]);

            $features_html = <<<'HTML'
<!-- features -->

<div class="content" id="container">
<h1>FEATURES</H1>
<h2>WHAT <em>CAN STEAM DO?</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
Once you've installed Steam, all of the following features are available on your desktop <i>and while you're playing Steam games</i>.
<br><br>
<h3>EASY AND FAST ACCESS TO GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_games.gif">
After installing Steam, you'll have instant access to Valve's full library of games. And when you choose one to play, you don't have to wait for the whole thing to download -- you can start playing in a matter of minutes.<br clear="all">
<br clear="all">
<h3>AUTOMATIC UPDATES</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_updates.gif">
Say goodbye to game patches forever--they're a thing of the past. Steam will keep all of its games up-to-date for as long as you want to keep playing them. No more hunting for download sites just to get up and running!<br clear="all">
<br clear="all">
<h3>INSTANT MESSAGING, EVEN IN GAME</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_im.gif">
Keep in touch with your buddies through "Friends," Steam's instant-messenger. It even works while you or your friends are playing games -- you don't have to stop playing to communicate.<br clear="all">
<br clear="all">
<h3>SERVER BROWSER - FIND YOUR FRIENDS' GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_servers.gif">
Now it's incredibly easy to find a quality game server -- one that's fast, that's running your favorite game, and even one that has your friends already playing on it.<br clear="all">
<br clear="all">
<h3>PARLOR GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_chess.gif">
Maybe you're dodging your homework. Maybe you're just bored while waiting for another turn in Counter-Strike. Either way -- why not enjoy a nice game of Chess? Or Checkers? Or Go? Or Hearts... Or....<br clear="all">
<br clear="all">

<!-- <h3>AND LOTS MORE</h3>
<img width="88" height="88" align="left" vspace="4" src="/img/thumb_xxx.gif">
xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx. xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx.

-->
</div><br clear="all">
<a href="getsteamnow.php"><img src="/img/but_getsteamnow.gif" height="24" width="124" alt="get steam now"></a><br>
</div>
HTML;
            $pageStmt->execute(['features','Features',$features_html,'2003_v1,2003_v2,2004',date('Y-m-d H:i:s')]);

            $e3_html = <<<'HTML'
<!-- e3 movies -->
<div class="content" id="container">
<h1>Half-Life 2: E3 2003</H1>
<h2>MOVIES<em> FROM THE ELECTRONIC ENTERTAINMENT EXPO</em></h2><img src="img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
Half-Life 2 debuted last year at E3, and won <a href="http://www.gamecriticsawards.com/past.html">Best of Show, Best PC Game, Best Action Game, and Special Commendation for Graphics</a>. On this page you can download video footage (captured directly from the game engine) showing all of the gameplay demos from the 2003 E3 booth.<br><br>
<nobr>
<img style="border:6px solid black;" width="180" height="100" src="img/movie_thumbs/hl2_movie1.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="img/movie_thumbs/hl2_movie2.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="img/movie_thumbs/hl2_movie3.jpg">
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
            $pageStmt->execute(['e3_movies','Half-Life 2 E3 Movies',$e3_html,'2003,2003_v1,2003_v2',date('Y-m-d H:i:s')]);

            $forums_html = <<<'HTML'
<!-- forums -->
<div class="content" id="container">
<h1>FORUMS</h1>
<h2>FOR <em>SUPPORT AND DISCUSSION</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>
<p>Before posting a problem in the forums, please use the new interactive Steam Support system..  It contains answers for many of the most common problems and questions.</p>
<p align="center"><a href="support.php">Use the Steam Support system.</a></p>
<p>Below are some forum usage guidelines. They are posted here as a general reminder in an effort to keep the forums friendly and usable for everyone.</p>
<ul><em>
<li style="list-style-image:url(/img/square2.gif);"> The forums are for everyone, new and advanced user alike.<br>
<br>
<li style="list-style-image:url(/img/square2.gif);"> Before you post a question, use the <a href="/forums/search.php" target="_blank">forum search feature</a> to determine whether your topic has already been covered.<br>
<br>
<li style="list-style-image:url(/img/square2.gif);"> Do not start flame wars. If you have a problem with someone, message that person and carry on a private discussion. Also, if someone has engaged in behavior that is a detriment to the message board -- spamming, flaming people, etc -- contact one of the forum moderators. Flaming the offensive user will only increase the problem.<br>
<br>
<li style="list-style-image:url(/img/square2.gif);"> Please post in the correct forum.<br>
<br>
<li style="list-style-image:url(/img/square2.gif);"> Administrators/Moderators reserve the right to change, edit, or delete any content at any time if they feel it is inappropriate.<br>
</em></ul>
<p>The bottom line is: respect others and you will be treated with respect. Be rude and disrespectful, and you'll not find much help here.</p>
<p align="center"><a href="/forums/"> I agree to these terms.</a></p>
</div>
</div>
HTML;
            $pageStmt->execute(['forums','Forums',$forums_html,'2003,2003_v1,2003_v2,2004,2005',date('Y-m-d H:i:s')]);

            $ded_html = <<<'HTML'
<!-- dedicated server -->
<div class="content" id="container">
<h1>Dedicated Server update files</h1>
<h2>WINDOWS<em> AND LINUX VERSIONS</em></h2><img src="img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
For those server admins who have trouble with the Steam HLDS update tool, or have trouble getting the dedicated server update through Steam, here are the changed files.<br>
<br>
<h3 style="text-transform:uppercase;">March 23rd (CS:CZ) Release</h3>
NOTE: This release includes only those files which have changed since the last dedicated server release. This download is an update only -- it requires that you have a Half-Life dedicated game server already installed. If you're looking for the full dedicated server Steam installer, you can find it on the <a href="/?area=getsteamnow">Get Steam Now</a> page (towards the bottom).<br><br>
<b>NOTE: This download requires you to have <a href="http://www.bitconjurer.org/BitTorrent/download.html">BitTorrent</a> installed.</b><br>
<br>
<a href="/HLserver/mar22/czero_dedicated_server_032204.zip.torrent">Windows Dedicated Server Update</a><br>
<br>
<a href="/HLserver/mar22/czero_dedicated_server_linux_032204.tgz.torrent">Linux Dedicated Server Update</a><br>
</div>
</div>
HTML;
            $pageStmt->execute(['dedicated_server','Dedicated Server update files',$ded_html,'2003,2003_v1,2003_v2,2004,2005',date('Y-m-d H:i:s')]);

            $css_html = <<<'HTML'
<!-- CS:S Beta 1 FAQ -->
<div class="content" id="container">
<h1>COUNTER-STRIKE: SOURCE</h1>
<h2>BETA 1 <em>QUESTIONS AND ANSWERS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
<ul>
<li style="list-style-image:url(/img/square2.gif);"> <a href="#q1"><em>When will Counter-Strike: Source beta 1 be released?</em></a>
<li style="list-style-image:url(/img/square2.gif);"> <a href="#q2"><em>How can I get Counter-Strike: Source beta 1?</em></a>
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
        <td><a href="/img/cs_source_01.jpg"><img src="/img/cs_source_01_tn.jpg"></td>
        <td><a href="/img/cs_source_02.jpg"><img src="/img/cs_source_02_tn.jpg"></td>
</tr>
<tr>
        <td colspan="2" align="center"><hr style="width: 100%;"></td>
</tr>
</table>
<p>Starting later this summer, Valve will be conducting a limited-time beta of Counter-Strike: Source via Steam.</p>
<p>The beta will first be open to subscribers of the Valve Cyber Caf&eacute; Program, and then extended to owners of Counter-Strike: Condition Zero and owners of ATI Half-Life 2 vouchers.</p>
<p>If you do not already have a Steam account, you can create a Steam account and use your ATI/Half-Life 2 product key printed on the coupon that came with the video card.  Once you have entered the key, you will be prompted to join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="getsteamnow.php">Click here to install Steam</a></p>
<p>If you have a Steam account and have not yet registered your ATI/Half-Life 2 product key printed on the coupon that came with the video card, you can register your key below and join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="steam://open/registerproduct/">Click here register your ATI key</a></p>
<p>No.</p>
</div>
</div>
HTML;
            $pageStmt->execute(['css_b1','Counter-Strike: Source Beta 1 FAQ',$css_html,'2003,2003_v1,2003_v2,2004,2005',date('Y-m-d H:i:s')]);

            $pricing_html = <<<'HTML'
<!-- cyber cafe pricing (truncated) -->
<div class="content" id="container">
<h1>PRICING AND LICENSING</h1>
<h2>VALVE'S <em>OFFICIAL CYBER CAF&Eacute; PROGRAM</em></h2>
<p>Valve's Official Cyber Caf&eacute; Program makes things simple for the caf&eacute; owner.</p>
<!-- full pricing text omitted for brevity -->
</div>
HTML;
            $pageStmt->execute(['cafe_pricing','Cyber Café Pricing and Licensing',$pricing_html,null,date('Y-m-d H:i:s')]);

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
            $ord=1;
            foreach($defaultCafes as $c){
                $dirStmt->execute(array_merge($c,[$ord++]));
            }

            $repStmt = $pdo->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
            $defaultReps = [
                ['http://www.transferbg.com/','TRANSFER GROUP LTD.','transfer@transferbg.com','Vasil Enfedzhiyan','80 Danail Nikolaev Street','Plovdiv  4000','','Bulgaria','Bulgaria','359 32 624 080'],
                ['http://www.ledzone.com/index_steam.html','NAMCO LIMITED','steam@ledzone.com ','Reina Yagishita','Tokyu-Plaza Annex 2F','7-3-3, Nishi-kamata, Ota-ku','144-0051','Tokyo','Japan',''],
                ['http://www.valvepcbang.com/','GNA Soft Co., Ltd.','west@gnasoft.com','Sean Lee','249-4 Urban Light Bldg 7th Floor','Nonhyundong Gangnamgu','135-010','Seoul','Korea',''],
                ['http://www.boomtown.net/','BOOMTOWN','JAPC@cafe.boomtown.net','Jakob Christiansen','Larslejsstrde 6','Kobenhavn C, Copenhagen','0900','Denmark','Norway, Sweden, Finland, Denmark, Iceland','+45-51909111'],
                ['http://www.computergames.ro/','COMPUTER GAMES ONLINE SRL','silviu@computergames.ro','Silviu Stroie','Unirii 75 Blvd, bl. H1','sc. C, et. 5, ap. 97 Sector 3','','Bucharest','Romania',''],
                ['http://www.unalis.com.tw/','UNALIS CORPORATION','leon@unalis.com.tw','Leon Chang','10F, No 168 SEC 2','Min Sheng E. Rd.','','Taipei','Taiwan','']
            ];
            foreach($defaultReps as $r){
                $r[9]=$ord++; // ensure ord column receives an integer
                $repStmt->execute($r);
            }
            $stmt2 = $pdo->prepare('REPLACE INTO themes(name) VALUES(?)');
            foreach(glob(__DIR__.'/themes/*', GLOB_ONLYDIR) as $dir){
                $name = basename($dir);
                if(substr($name,-6) === '_admin') continue;
                $stmt2->execute([$name]);
            }
            $cfg = "<?php\nreturn [\n    'host'=>'$host',\n    'port'=>'$port',\n    'dbname'=>'$dbname',\n    'user'=>'$user',\n    'pass'=>'$pass'\n];\n?>";
            file_put_contents(__DIR__.'/cms/config.php',$cfg);
            unset($_SESSION['cms_install']);
            header('Location: install.php?step=3');
            exit;
        }catch(PDOException $e){
            $errors[]=$e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
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
        <div class="progress-fill" style="width: <?php echo ($step/3)*100; ?>%;"></div>
    </div>
    <?php if($errors): ?>
        <ul style="color:#ff8080;">
        <?php foreach($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
        </ul>
    <?php endif; ?>
    <?php if($step==1): ?>
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
    <?php elseif($step==2): ?>
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
