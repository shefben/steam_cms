<?php
require_once 'includes/template.php';

// Redirect if already logged in
if (cb_current_user()) {
    header('Location: ' . ($_GET['redir'] ?? 'index.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (cb_login($_POST['name'] ?? '', $_POST['pass'] ?? '')) {
        header('Location: ' . ($_GET['redir'] ?? 'index.php'));
        exit;
    }
    $error = 'Incorrect username or password.';
}

cb_header('Login');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header row -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Forum Login</b></font>
  </td>
</tr>
</table>

<?php if (!empty($error)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600"><b><?= htmlspecialchars($error) ?></b></font>
  </td>
</tr>
</table>
<?php endif; ?>

<form method="post" action="login.php?redir=<?= urlencode($_GET['redir'] ?? '') ?>">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Username:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="name" size="25" maxlength="20" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Password:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="password" name="pass" size="25" maxlength="32">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2" align="center">
    <input type="submit" value="Login">
    &nbsp;&nbsp;
    <input type="button" value="Register" onclick="location.href='signup.php'">
  </td>
</tr>
</table>
</form>

</td></tr></table>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="1">
      Forgot your password? <a href="password_reset.php">Reset it here</a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
