<?php
require_once 'includes/template.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = cb_register(
        $_POST['username'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? ''
    );

    if ($result['success']) {
        $success = true;
    } else {
        $errors = $result['errors'];
    }
}

cb_header('Create Account');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header row -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Create Account</b></font>
  </td>
</tr>
</table>

<?php if ($success): ?>
<table border="0" cellspacing="0" cellpadding="8" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#C4CABE">
      <b>Registration Successful!</b><br><br>
      Your account has been created. You may now <a href="login.php">login</a>.
    </font>
  </td>
</tr>
</table>

<?php else: ?>

<?php if (!empty($errors)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600">
      <b>Registration Error:</b><br>
      <?php foreach ($errors as $e): ?>
        &bull; <?= htmlspecialchars($e) ?><br>
      <?php endforeach; ?>
    </font>
  </td>
</tr>
</table>
<?php endif; ?>

<form method="post" action="signup.php">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Username:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="username" size="25" maxlength="20" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
    <font face="Arial" size="1"> (3-20 characters, letters/numbers/underscore only)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Email:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="text" name="email" size="30" maxlength="100" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <font face="Arial" size="1"> (used for password recovery)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Password:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="password" name="password" size="25" maxlength="32">
    <font face="Arial" size="1"> (4-32 characters)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Confirm Password:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="password" name="password_confirm" size="25" maxlength="32">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2" align="center">
    <input type="submit" value="Create Account">
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='index.php'">
  </td>
</tr>
</table>
</form>

<?php endif; ?>

</td></tr></table>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="1">
      Already have an account? <a href="login.php">Login here</a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
