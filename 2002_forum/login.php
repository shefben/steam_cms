<?php
require_once 'includes/template.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (cb_login($_POST['name'],$_POST['pass'])) {
        header('Location: '.($_GET['redir']??'index.php')); exit;
    }
    $err='Incorrect username or password';
}
cb_header('Login');
echo '<table cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" border="0"><tr><td>';
if (!empty($err)) echo '<font color="#FF0000">',$err,'</font><br>';
echo '<form method="post" action="login.php?redir=',urlencode($_GET['redir']??''),'">
<font face="Verdana,Arial" size="2"><b>Username:</b></font><br><input type="text" name="name" size="20"><br>
<font face="Verdana,Arial" size="2"><b>Password:</b></font><br><input type="password" name="pass" size="20"><br><br>
<input type="submit" value="Login">&nbsp;&nbsp;
<input type="button" value="Register" onclick="location.href=\'register.php\'">
</form></td></tr></table>';
cb_footer();
