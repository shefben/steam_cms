<?php
require_once __DIR__.'/session.php';
require_once __DIR__.'/db.php';
require_once __DIR__.'/template_engine.php';

$err = '';
$csrfToken = cms_get_csrf_token();

// Simple rate limiting
$maxAttempts = 5;
$lockoutDuration = 300; // 5 minutes
$lockUntil = $_SESSION['login_lock_until'] ?? 0;
if ($lockUntil > time()) {
    $err = 'Too many failed attempts. Please try again later.';
}

// Validate return URL to prevent open redirects
function validate_return_url($url) {
    if (empty($url)) {
        return 'admin/index.php';
    }
    
    // Only allow relative URLs starting with admin/
    if (preg_match('#^admin/[a-zA-Z0-9_/.-]+\.php(\?[a-zA-Z0-9_&=%-]*)?$#', $url)) {
        return $url;
    }
    
    return 'admin/index.php';
}

$dest = validate_return_url($_GET['return'] ?? '');
if ($err === '' && $_SERVER['REQUEST_METHOD']==='POST'){
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        $err = 'Invalid request';
    } else {
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
            $_SESSION['admin_logged_in'] = true;
            cms_admin_log('login success');
            if($stay){
                $token=cms_create_admin_token($row['id']);
                $cookiePath = cms_base_url() . '/';
                setcookie('cms_admin_token', $token, [
                    'expires' => time() + 60*60*24*7,
                    'path' => $cookiePath,
                    'httponly' => true,
                    'secure' => !empty($_SERVER['HTTPS']),
                    'samesite' => 'Lax'
                ]);
            }
            unset($_SESSION['login_attempts'], $_SESSION['login_lock_until']);
            // Ensure session data is written before redirecting
            session_write_close();
            header('Location: '.$dest);
            exit;
        }else{
            cms_admin_log('login failed', 0);
            $err='Invalid credentials';
            $attempts = $_SESSION['login_attempts'] ?? ['count'=>0, 'last'=>0];
            $attempts['count']++;
            $attempts['last'] = time();
            if ($attempts['count'] >= $maxAttempts) {
                $_SESSION['login_lock_until'] = time() + $lockoutDuration;
                $attempts['count'] = 0;
            }
            $_SESSION['login_attempts'] = $attempts;
        }
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

$tpl = cms_admin_layout('login.twig', $admin_theme);
if ($tpl) {
    cms_render_template_theme($tpl, "{$admin_theme}_admin", [
        'lang'          => $_SESSION['admin_lang'] ?? 'en',
        'theme_url'     => $theme_url,
        'err'           => $err,
        'csrf_token'    => $csrfToken,
        'login_title'   => cms_admin_translate('Admin Login'),
        'label_username'=> cms_admin_translate('Username'),
        'label_password'=> cms_admin_translate('Password'),
        'label_stay'    => cms_admin_translate('Stay logged in'),
        'label_login'   => cms_admin_translate('Login'),
        'label_forgot'  => cms_admin_translate('Forgot password?'),
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($_SESSION['admin_lang'] ?? 'en'); ?>">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/login.css">
</head>
<body class="login-page">
<div class="login-container">
<h2><?php echo htmlspecialchars(cms_admin_translate('Admin Login')); ?></h2>
<?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
<form method="post" id="login-form" novalidate>
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
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
</div>
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
