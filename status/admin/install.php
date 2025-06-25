<?php
if (file_exists('installed.lock')) { echo 'Already installed'; exit; }

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $db_host = $_POST['db_host'] ?? 'localhost';
    $db_user = $_POST['db_user'] ?? 'stats';
    $db_pass = $_POST['db_pass'] ?? '';
    $db_name = $_POST['db_name'] ?? 'stats';

    $db = new mysqli($db_host, $db_user, $db_pass);
    if ($db->connect_errno) {
        die('Database connection failed: ' . $db->connect_error);
    }

    $db->query("CREATE DATABASE IF NOT EXISTS `{$db_name}`");
    $db->select_db($db_name);

    $db->query("CREATE TABLE IF NOT EXISTS settings(setting_key VARCHAR(50) PRIMARY KEY, setting_value TEXT)");
    $db->query("CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), password_hash TEXT)");
    $db->query("CREATE TABLE IF NOT EXISTS content_servers(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), ip VARCHAR(100), port INT, total_capacity INT)");
    $db->query("CREATE TABLE IF NOT EXISTS server_stats(id INT AUTO_INCREMENT PRIMARY KEY, server_id INT, available_bandwidth INT, unique_connections INT, last_checked DATETIME, status VARCHAR(10))");

    $stmt=$db->prepare('INSERT INTO users(username,password_hash) VALUES(?,?)');
    $hash=password_hash($_POST['admin_pass'],PASSWORD_DEFAULT);
    $stmt->bind_param('ss',$_POST['admin_user'],$hash);
    $stmt->execute();
    $stmt->close();

    $stmt=$db->prepare('REPLACE INTO settings(setting_key, setting_value) VALUES(?,?)');
    $key='main_network_ip';
    $stmt->bind_param('ss', $key, $_POST['main_ip']);
    $stmt->execute();
    $key='main_network_port';
    $stmt->bind_param('ss', $key, $_POST['main_port']);
    $stmt->execute();
    $stmt->close();

    $cfg = "<?php\n".
        "define('DB_HOST', '".addslashes($db_host)."');\n".
        "define('DB_USER', '".addslashes($db_user)."');\n".
        "define('DB_PASS', '".addslashes($db_pass)."');\n".
        "define('DB_NAME', '".addslashes($db_name)."');\n".
        "?>\n";
    file_put_contents('../config.php', $cfg);

    file_put_contents('installed.lock','1');
    echo 'Installed. Delete install.php for security.';
    exit;
}

?>
<html><body>
<h1>Install</h1>
<form method="post">
Database Host <input name="db_host" value="localhost"><br>
Database User <input name="db_user" value="stats"><br>
Database Pass <input type="password" name="db_pass"><br>
Database Name <input name="db_name" value="stats"><br>
Admin Username <input name="admin_user"><br>
Admin Password <input type="password" name="admin_pass"><br>
Main Network IP <input name="main_ip" value="127.0.0.1"><br>
Main Network Port <input name="main_port" value="27015"><br>
<input type="submit" value="Install">
</form>
</body></html>
