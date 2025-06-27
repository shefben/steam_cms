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
        try{
            $dsn="mysql:host=$host;port=$port;charset=utf8mb4";
            $pdo=new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbname`");
            $pdo->exec("CREATE TABLE IF NOT EXISTS news(id INT AUTO_INCREMENT PRIMARY KEY,title TEXT,author TEXT,publish_date DATETIME,views INT DEFAULT 0,content TEXT)");
            $pdo->exec("CREATE TABLE IF NOT EXISTS faq_categories(id1 BIGINT,id2 BIGINT,name TEXT,PRIMARY KEY(id1,id2))");
            $pdo->exec("CREATE TABLE IF NOT EXISTS faq_content(catid1 BIGINT,catid2 BIGINT,faqid1 BIGINT,faqid2 BIGINT,title TEXT,body TEXT,PRIMARY KEY(faqid1,faqid2))");
            $pdo->exec("CREATE TABLE IF NOT EXISTS ccafe_registration(
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
            $pdo->exec("CREATE TABLE IF NOT EXISTS custom_pages(
                slug VARCHAR(255) PRIMARY KEY,
                title TEXT,
                content MEDIUMTEXT,
                created DATETIME,
                updated DATETIME
            )");
            $pdo->exec("CREATE TABLE IF NOT EXISTS media(
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename TEXT,
                uploaded DATETIME
            )");
            $pdo->exec("CREATE TABLE IF NOT EXISTS redirects(
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(200) UNIQUE,
                target TEXT,
                hits INT DEFAULT 0,
                created DATETIME
            )");
            $pdo->exec("CREATE TABLE IF NOT EXISTS settings(`key` VARCHAR(64) PRIMARY KEY,value TEXT)");
            $pdo->exec("CREATE TABLE IF NOT EXISTS admin_users(
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100),
                email TEXT,
                first_name TEXT,
                last_name TEXT,
                permissions TEXT,
                created DATETIME,
                password VARCHAR(255)
            )");
            $pdo->exec("CREATE TABLE IF NOT EXISTS page_views(
                date DATE,
                page VARCHAR(255),
                views INT DEFAULT 0,
                PRIMARY KEY(date,page)
            )");
            foreach(glob(__DIR__.'/sql/*.sql') as $file){
                $sql=file_get_contents($file);
                foreach(array_filter(array_map('trim',explode(';',$sql))) as $stmt){
                    if($stmt) $pdo->exec($stmt);
                }
            }
            $hash=password_hash($admin_pass,PASSWORD_DEFAULT);
            $stmt=$pdo->prepare('INSERT INTO admin_users(username,email,first_name,last_name,permissions,created,password) VALUES(?,?,?,?,?,NOW(),?)');
            $stmt->execute([$admin_user,'','','','all',$hash]);
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
                ['file'=>'admin_users.php','label'=>'Administrators','visible'=>1],
                ['file'=>'nav_manager.php','label'=>'Navigation','visible'=>1],
                ['file'=>'error_page.php','label'=>'Error Page','visible'=>1],
                ['file'=>'logo.php','label'=>'Logo','visible'=>1],
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
        body{font-family:Arial, sans-serif;background:#1e3a52;color:#fff;display:flex;justify-content:center;align-items:center;min-height:100vh;}
        .box{background:#2a475e;padding:20px;border-radius:8px;width:400px;}
        input[type=text],input[type=password]{width:100%;padding:8px;margin-bottom:10px;border:1px solid #444;background:#fff;color:#000;}
        .progress{height:6px;background:#444;margin-bottom:20px;}
        .progress div{height:6px;background:#66c0f4;width:<?php echo $step*50; ?>%;}
        .btn{background:#66c0f4;color:#1e3a52;border:none;padding:10px;width:100%;cursor:pointer;border-radius:4px;font-weight:bold;}
    </style>
</head>
<body>
<div class="box">
    <div class="progress"><div></div></div>
    <?php if($errors): ?>
        <ul style="color:#ff8080;">
        <?php foreach($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
        </ul>
    <?php endif; ?>
    <?php if($step==1): ?>
        <h2>Step 1: Database</h2>
        <form method="post">
            <input name="host" placeholder="Host" value="localhost">
            <input name="port" placeholder="Port" value="3306">
            <input name="dbname" placeholder="Database" value="steamcms">
            <input name="dbuser" placeholder="DB User" value="root">
            <input type="password" name="dbpass" placeholder="DB Password">
            <button class="btn" type="submit">Continue</button>
        </form>
    <?php elseif($step==2): ?>
        <h2>Step 2: Admin User</h2>
        <form method="post">
            <input name="admin_user" placeholder="Admin Username">
            <input type="password" name="admin_pass" placeholder="Admin Password">
            <button class="btn" type="submit">Install</button>
        </form>
    <?php else: ?>
        <h2>Installation Complete</h2>
        <p><a href="cms/login.php" style="color:#66c0f4;">Log in</a></p>
    <?php endif; ?>
</div>
</body>
</html>
