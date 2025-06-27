<?php
session_start();
require_once __DIR__.'/db.php';
$err = '';
$dest = isset($_GET['return']) ? $_GET['return'] : 'admin/index.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $db=cms_get_db();
    $user=trim($_POST['username']);
    $pass=$_POST['password'];
    $stay=isset($_POST['stay']);
    $stmt=$db->prepare('SELECT id,password FROM admin_users WHERE username=?');
    $stmt->execute([$user]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row && password_verify($pass,$row['password'])){
        $_SESSION['admin_id']=$row['id'];
        if($stay){
            setcookie('cms_admin_id',$row['id'],time()+60*60*24*30,'/');
            setcookie('cms_admin_hash',$row['password'],time()+60*60*24*30,'/');
        }
        header('Location: '.$dest);
        exit;
    }else{
        $err='Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html><head><title>Admin Login</title></head>
<body>
<h2>Admin Login</h2>
<?php if($err) echo '<p style="color:red;">'.$err.'</p>'; ?>
<form method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
<label><input type="checkbox" name="stay"> Stay logged in</label><br>
<input type="submit" value="Login">
</form>
</body></html>
