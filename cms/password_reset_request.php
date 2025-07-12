<?php
session_start();
require_once __DIR__.'/db.php';

$admin_theme = cms_get_setting('admin_theme','v2');
$base_url = cms_base_url();
$theme_dir = dirname(__DIR__)."/themes/{$admin_theme}_admin";
$theme_url = ($base_url ? $base_url : '')."/themes/{$admin_theme}_admin";
if(!is_dir($theme_dir)){
    $theme_dir = dirname(__DIR__).'/themes/default_admin';
    $theme_url = ($base_url ? $base_url : '').'/themes/default_admin';
}

$sent = false;
if($_SERVER['REQUEST_METHOD']==='POST'){
    // In a full implementation we would email a reset link
    $sent = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Reset Request</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
</head>
<body class="login-page">
<main>
<h2>Reset Password</h2>
<?php if($sent): ?>
<p>Check your email for a reset link.</p>
<?php else: ?>
<form method="post" id="reset-form" novalidate>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <button type="submit">Send Reset Link</button>
    </div>
</form>
<?php endif; ?>
<p><a href="login.php">Back to login</a></p>
</main>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
$(function(){
    $('#reset-form').on('submit', function(){
        if($('#email').val().trim()===''){
            alert('Please enter your email address.');
            $('#email').focus();
            return false;
        }
        return true;
    });
});
</script>
</body>
</html>
