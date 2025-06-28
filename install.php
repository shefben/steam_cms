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
            $pdo->exec("CREATE TABLE faq_content(catid1 BIGINT,catid2 BIGINT,faqid1 BIGINT,faqid2 BIGINT,title TEXT,body TEXT,PRIMARY KEY(faqid1,faqid2))");
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
                created DATETIME,
                updated DATETIME
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
            $pdo->exec("DROP TABLE IF EXISTS admin_users");
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
            $pdo->exec("DROP TABLE IF EXISTS page_views");
            $pdo->exec("CREATE TABLE page_views(
                date DATE,
                page VARCHAR(255),
                views INT DEFAULT 0,
                PRIMARY KEY(date,page)
            )");
            foreach(glob(__DIR__.'/sql/*.sql') as $file){
                $sql=file_get_contents($file);
                foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $stmt){
                    $stmt=trim($stmt);
                    if($stmt) $pdo->exec($stmt);
                }
            }
            $hash=password_hash($admin_pass,PASSWORD_DEFAULT);
            $stmt=$pdo->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,created,password) VALUES(?,?,?,?,?,NOW(),?)');
            $stmt->execute([$admin_user,$admin_email,'','','all',$hash]);
            // default settings
            $footer = file_get_contents(__DIR__.'/cms/content/footer.html');
            $nf = file_get_contents(__DIR__.'/notfound.php');
            $nf = preg_replace('~^<\?php.*?\?>~s','',$nf,1);
            $nf = preg_replace('~<\?php.*\?>\s*$~s','',$nf);
            $error_html = trim($nf);
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
                ['file'=>'cafe_signups.php','label'=>'Café Signups','visible'=>1],
                ['file'=>'content_servers.php','label'=>'Servers','visible'=>1],
                ['file'=>'custom_pages.php','label'=>'Custom Pages','visible'=>1],
                ['file'=>'theme.php','label'=>'Theme','visible'=>1],
                ['file'=>'settings.php','label'=>'Settings','visible'=>1],
                ['file'=>'header_footer.php','label'=>'Header & Footer','visible'=>1],
                ['file'=>'faq_categories.php','label'=>'FAQ Categories','visible'=>1],
                ['file'=>'admin_users.php','label'=>'Administrators','visible'=>1],
                ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
                ['file'=>'../logout.php','label'=>'Logout','visible'=>1]
            ];
            $defaults = [
                'theme'=>'default',
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
                'gzip'=>'0',
                'enable_cache'=>'0'
            ];
            $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
            foreach($defaults as $k=>$v){ $stmt->execute([$k,$v]); }
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
