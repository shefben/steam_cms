<?php
session_start();
require_once '../functions.php';
$db = db_connect();
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    $stmt = $db->prepare('SELECT id, password_hash FROM users WHERE username=?');
    $stmt->bind_param('s', $u);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    if ($stmt->fetch() && password_verify($p, $hash)) {
        $_SESSION['uid'] = $id;
        header('Location: index.php');
        exit;
    }
    $error = 'Invalid credentials';
    $stmt->close();
}
?>
<html><body>
<h1>Admin Login</h1>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
<input type="submit" value="Login">
</form>
</body></html>
