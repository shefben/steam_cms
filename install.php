<?php
if(file_exists(__DIR__.'/cms/config.php')){
    echo 'CMS already installed.';
    exit;
}
$errors=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $host=trim($_POST['host']);
    $port=trim($_POST['port']);
    $user=trim($_POST['dbuser']);
    $pass=trim($_POST['dbpass']);
    $dbname=trim($_POST['dbname']);
    $admin_user=trim($_POST['admin_user']);
    $admin_pass=trim($_POST['admin_pass']);
    try{
        $dsn="mysql:host=$host;port=$port;charset=utf8mb4";
        $pdo=new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$dbname`");
        $pdo->exec("CREATE TABLE IF NOT EXISTS news(id INT AUTO_INCREMENT PRIMARY KEY,title TEXT,author TEXT,date TEXT,views INT DEFAULT 0,content TEXT)");
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
        $defaults = [
            'theme'=>'default',
            'admin_theme'=>'default',
            'site_title'=>'Steam',
            'smtp_host'=>'',
            'smtp_port'=>'',
            'smtp_user'=>'',
            'smtp_pass'=>'',
            'header_overrides'=>'',
            'header_config'=>json_encode(['logo'=>'/img/steam_logo_onblack.gif','buttons'=>$header_buttons]),
            'footer_html'=>$footer,
            'favicon'=>'/favicon.ico',
            'error_html'=>$error_html
        ];
        $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
        foreach($defaults as $k=>$v){ $stmt->execute([$k,$v]); }
        $cfg = "<?php
return [
    'host'=>'$host',
    'port'=>'$port',
    'dbname'=>'$dbname',
    'user'=>'$user',
    'pass'=>'$pass'
];
?>";
        file_put_contents(__DIR__.'/cms/config.php',$cfg);
        echo 'Installation complete.';
        exit;
    }catch(PDOException $e){
        $errors[]=$e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html><head><title>CMS Install</title></head><body>
<h1>Install CMS</h1>
<?php if($errors): ?><ul style="color:red;"><?php foreach($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul><?php endif; ?>
<form method="post">
Database Host: <input name="host" value="localhost"><br>
Port: <input name="port" value="3306"><br>
Database Name: <input name="dbname" value="steamcms"><br>
DB User: <input name="dbuser" value="root"><br>
DB Password: <input type="password" name="dbpass"><br><br>
Admin Username: <input name="admin_user"><br>
Admin Password: <input type="password" name="admin_pass"><br>
<input type="submit" value="Install">
</form>
</body></html>
