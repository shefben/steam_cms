<?php
session_start();
$_SESSION = [];
session_destroy();
setcookie('cms_admin_id','',time()-3600,'/');
setcookie('cms_admin_hash','',time()-3600,'/');
header('Location: login.php');
