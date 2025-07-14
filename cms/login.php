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
    $stmt=$db->prepare('SELECT id,password,language FROM admin_users WHERE username=?');
    $stmt->execute([$user]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row && password_verify($pass,$row['password'])){
        session_regenerate_id(true);
        $_SESSION['admin_id']=$row['id'];
        $_SESSION['admin_lang']=$row['language'] ?: 'en';
        cms_admin_log('login success');
        if($stay){
            $token=cms_create_admin_token($row['id']);
            setcookie('cms_admin_token',$token,[
                'expires'=>time()+60*60*24*7,
                'path'=>'/',
                'httponly'=>true
            ]);
        }
        header('Location: '.$dest);
        exit;
    }else{
        cms_admin_log('login failed', 0);
        $err='Invalid credentials';
    }
}

$admin_theme = cms_get_setting('admin_theme','v2');
$base_url = cms_base_url();
$theme_dir = dirname(__DIR__)."/themes/{$admin_theme}_admin";
$theme_url = ($base_url ? $base_url : '')."/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)){
    $theme_dir = dirname(__DIR__).'/themes/default_admin';
    $theme_url = ($base_url ? $base_url : '').'/themes/default_admin';
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($_SESSION['admin_lang'] ?? 'en'); ?>">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
</head>
<body class="login-page">
<main>
<h2><?php echo htmlspecialchars(cms_admin_translate('Admin Login')); ?></h2>
<?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
<form method="post" id="login-form" novalidate>
    <div>
        <label for="username"><?php echo htmlspecialchars(cms_admin_translate('Username')); ?></label>
        <input type="text" name="username" id="username" autocomplete="username">
    </div>
    <div>
        <label for="password"><?php echo htmlspecialchars(cms_admin_translate('Password')); ?></label>
        <input type="password" name="password" id="password" autocomplete="current-password">
    </div>
    <div>
        <label for="stay"><input type="checkbox" name="stay" id="stay"> <?php echo htmlspecialchars(cms_admin_translate('Stay logged in')); ?></label>
    </div>
    <div>
        <button type="submit"><?php echo htmlspecialchars(cms_admin_translate('Login')); ?></button>
    </div>
    <p><a href="password_reset_request.php"><?php echo htmlspecialchars(cms_admin_translate('Forgot password?')); ?></a></p>
</form>
</main>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
$(function(){
    $('#login-form').on('submit', function(){
        if($('#username').val().trim()===''){
            alert('Please enter your username.');
            $('#username').focus();
            return false;
        }
        if($('#password').val()===''){
            alert('Please enter your password.');
            $('#password').focus();
            return false;
        }
        return true;
    });
});
</script>
</body>
</html>
