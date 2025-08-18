<?php
session_start();
$_SESSION = [];
session_destroy();
if(isset($_COOKIE['cms_admin_token'])){
    require_once __DIR__.'/db.php';
    cms_clear_admin_token($_COOKIE['cms_admin_token']);
    setcookie('cms_admin_token','',[
        'expires'=>time()-3600,
        'path'=>'/',
        'httponly'=>true,
        'secure'=>!empty($_SERVER['HTTPS']),
        'samesite'=>'Lax'
    ]);
}
header('Location: login.php');
exit;
