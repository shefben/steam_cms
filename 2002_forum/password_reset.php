<?php
require_once 'includes/template.php';

$errors = [];
$success = false;
$mode = 'request'; // 'request' or 'reset'

// Check if we have a reset token
if (isset($_GET['token'])) {
    $mode = 'reset';
    $token = $_GET['token'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        // Request password reset
        $email = trim($_POST['email'] ?? '');
        if (empty($email)) {
            $errors[] = 'Please enter your email address.';
        } else {
            $token = cb_generate_reset_token($email);
            if ($token) {
                // In a real system, this would send an email
                // For this demo, we'll just show the reset link
                $success = true;
                $resetLink = "password_reset.php?token=" . urlencode($token);
            } else {
                // Don't reveal if email exists or not for security
                $success = true;
            }
        }
    } elseif (isset($_POST['new_password'])) {
        // Actually reset the password
        $token = $_POST['token'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($newPassword !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
            $mode = 'reset';
        } else {
            $result = cb_reset_password($token, $newPassword);
            if ($result['success']) {
                $success = true;
                $mode = 'complete';
            } else {
                $errors[] = $result['error'];
                $mode = 'reset';
            }
        }
    }
}

cb_header('Lost Password');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header row -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Lost Password</b></font>
  </td>
</tr>
</table>

<?php if ($mode === 'complete' && $success): ?>
<!-- Password successfully reset -->
<table border="0" cellspacing="0" cellpadding="8" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#C4CABE">
      <b>Password Reset Successful!</b><br><br>
      Your password has been changed. You may now <a href="login.php">login</a> with your new password.
    </font>
  </td>
</tr>
</table>

<?php elseif ($mode === 'request' && $success): ?>
<!-- Reset request submitted -->
<table border="0" cellspacing="0" cellpadding="8" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#C4CABE">
      <b>Reset Instructions Sent!</b><br><br>
      If an account exists with that email address, you will receive password reset instructions shortly.
      <?php if (isset($resetLink)): ?>
      <br><br>
      <font size="1" color="#FF6600">
        <b>Demo Mode:</b> In production, an email would be sent. For testing, use this link:<br>
        <a href="<?= htmlspecialchars($resetLink) ?>"><?= htmlspecialchars($resetLink) ?></a>
      </font>
      <?php endif; ?>
    </font>
  </td>
</tr>
</table>

<?php elseif ($mode === 'reset'): ?>
<!-- Reset form (using token) -->

<?php if (!empty($errors)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600">
      <b>Error:</b><br>
      <?php foreach ($errors as $e): ?>
        &bull; <?= htmlspecialchars($e) ?><br>
      <?php endforeach; ?>
    </font>
  </td>
</tr>
</table>
<?php endif; ?>

<form method="post" action="password_reset.php">
<input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" colspan="2">
    <font face="Arial" size="2">Enter your new password below:</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>New Password:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="password" name="new_password" size="25" maxlength="32">
    <font face="Arial" size="1"> (4-32 characters)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Confirm Password:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="password" name="confirm_password" size="25" maxlength="32">
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" colspan="2" align="center">
    <input type="submit" value="Reset Password">
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='login.php'">
  </td>
</tr>
</table>
</form>

<?php else: ?>
<!-- Request form -->

<?php if (!empty($errors)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600">
      <b>Error:</b><br>
      <?php foreach ($errors as $e): ?>
        &bull; <?= htmlspecialchars($e) ?><br>
      <?php endforeach; ?>
    </font>
  </td>
</tr>
</table>
<?php endif; ?>

<form method="post" action="password_reset.php">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" colspan="2">
    <font face="Arial" size="2">
      Enter the email address associated with your account. If an account exists,
      you will receive instructions to reset your password.
    </font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Email Address:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="text" name="email" size="35" maxlength="100" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2" align="center">
    <input type="submit" value="Send Reset Instructions">
    &nbsp;&nbsp;
    <input type="button" value="Back to Login" onclick="location.href='login.php'">
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
      Remember your password? <a href="login.php">Login here</a> |
      Don't have an account? <a href="signup.php">Create one</a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
