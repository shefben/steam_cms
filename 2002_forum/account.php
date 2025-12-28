<?php
require_once 'includes/template.php';

$user = cb_require_login();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify current password for sensitive changes
    $currentPass = $_POST['current_password'] ?? '';
    $stmt = cb_db()->prepare('SELECT passhash FROM users WHERE id=?');
    $stmt->execute([$user['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($currentPass, $row['passhash'])) {
        $errors[] = 'Current password is incorrect.';
    } else {
        $data = [];

        // Email update
        if (!empty($_POST['email']) && $_POST['email'] !== $user['email']) {
            $data['email'] = $_POST['email'];
        }

        // Signature update
        if (isset($_POST['signature'])) {
            $data['signature'] = $_POST['signature'];
        }

        // Password change
        if (!empty($_POST['new_password'])) {
            if ($_POST['new_password'] !== $_POST['confirm_password']) {
                $errors[] = 'New passwords do not match.';
            } else {
                $data['new_password'] = $_POST['new_password'];
            }
        }

        if (empty($errors) && !empty($data)) {
            $result = cb_update_profile($user['id'], $data);
            if ($result['success']) {
                $success = true;
                $user = cb_current_user(); // Refresh user data
            } else {
                $errors = $result['errors'];
            }
        } elseif (empty($errors) && empty($data)) {
            $success = true; // No changes made
        }
    }
}

// Get post count and rank
$postCount = cb_get_post_count($user['id']);
$rank = cb_get_rank($postCount);

cb_header('Account Options');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header row -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Account Options</b></font>
  </td>
</tr>
</table>

<!-- Account Info -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Username:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= htmlspecialchars($user['username']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Rank:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2"><?= htmlspecialchars($rank) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Posts:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= $postCount ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Registered:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2"><?= cb_fmt($user['registered']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Last Login:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= $user['last_login'] ? cb_fmt($user['last_login']) : 'Never' ?></font>
  </td>
</tr>
</table>

</td></tr></table>

<br>

<?php if ($success): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#00FF00"><b>Changes saved successfully!</b></font>
  </td>
</tr>
</table>
<br>
<?php endif; ?>

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
<br>
<?php endif; ?>

<form method="post" action="account.php">
<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Edit Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Edit Profile</b></font>
  </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Email:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="email" size="35" maxlength="100" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%" valign="top">
    <font face="Arial" size="2"><b>Signature:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <textarea name="signature" rows="4" cols="50"><?= htmlspecialchars($user['signature'] ?? '') ?></textarea>
    <br><font face="Arial" size="1">(max 500 characters)</font>
  </td>
</tr>
</table>

<!-- Password Change -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="2">
    <font face="Arial" size="2" color="#EBEDEA"><b>Change Password</b></font>
    <font face="Arial" size="1"> (leave blank to keep current password)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>New Password:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="password" name="new_password" size="25" maxlength="32">
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Confirm New Password:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="password" name="confirm_password" size="25" maxlength="32">
  </td>
</tr>
</table>

<!-- Current Password Required -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="2">
    <font face="Arial" size="2" color="#EBEDEA"><b>Confirm Changes</b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Current Password:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="password" name="current_password" size="25" maxlength="32">
    <font face="Arial" size="1" color="#FF6600"> (required to save changes)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" colspan="2" align="center">
    <input type="submit" value="Save Changes">
    &nbsp;&nbsp;
    <input type="button" value="Back to Forums" onclick="location.href='index.php'">
  </td>
</tr>
</table>

</td></tr></table>
</form>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="1">
      <a href="logout.php">Logout</a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
