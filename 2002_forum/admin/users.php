<?php
require_once '../includes/template.php';

$admin = cb_require_admin();
$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Pagination
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 25;
$search = trim($_GET['search'] ?? '');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        $userId = (int)$_POST['user_id'];
        $targetUser = cb_get_user($userId);

        if (!$targetUser) {
            $error = 'User not found.';
        } elseif ($userId === $admin['id'] && isset($_POST['is_admin']) && !$_POST['is_admin']) {
            $error = 'You cannot remove your own admin privileges.';
        } else {
            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'signature' => $_POST['signature'] ?? '',
                'is_mod' => isset($_POST['is_mod']) ? 1 : 0,
                'is_admin' => isset($_POST['is_admin']) ? 1 : 0,
                'banned' => isset($_POST['banned']) ? 1 : 0
            ];

            if (!empty($_POST['new_password'])) {
                $data['password'] = $_POST['new_password'];
            }

            cb_admin_update_user($userId, $data);
            cb_log_mod_action($admin['id'], 'update_user', 'user', $userId, "Updated user: {$targetUser['username']}");
            $message = "User '{$targetUser['username']}' updated successfully!";
            $action = 'list';
        }
    } elseif (isset($_POST['delete_user'])) {
        $userId = (int)$_POST['user_id'];
        $targetUser = cb_get_user($userId);

        if (!$targetUser) {
            $error = 'User not found.';
        } elseif ($userId === $admin['id']) {
            $error = 'You cannot delete your own account.';
        } else {
            cb_admin_delete_user($userId);
            cb_log_mod_action($admin['id'], 'delete_user', 'user', $userId, "Deleted user: {$targetUser['username']}");
            $message = "User '{$targetUser['username']}' deleted.";
        }
        $action = 'list';
    } elseif (isset($_POST['ban_user'])) {
        $userId = (int)$_POST['user_id'];
        $targetUser = cb_get_user($userId);

        if ($targetUser && $userId !== $admin['id']) {
            $newBanState = !$targetUser['banned'];
            cb_admin_update_user($userId, ['banned' => $newBanState]);
            $actionName = $newBanState ? 'ban_user' : 'unban_user';
            cb_log_mod_action($admin['id'], $actionName, 'user', $userId, ($newBanState ? 'Banned' : 'Unbanned') . " user: {$targetUser['username']}");
            $message = "User '{$targetUser['username']}' " . ($newBanState ? 'banned' : 'unbanned') . ".";
        }
        $action = 'list';
    }
}

// Get data for display
$offset = ($page - 1) * $perPage;
$usersData = cb_get_users($offset, $perPage, $search ?: null);
$users = $usersData['users'];
$totalUsers = $usersData['total'];
$totalPages = max(1, ceil($totalUsers / $perPage));

$editUser = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $editUser = cb_get_user((int)$_GET['id']);
    if (!$editUser) {
        $error = 'User not found.';
        $action = 'list';
    }
}

cb_header('Manage Users');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="3" color="#EBEDEA"><b>Manage Users</b></font>
  </td>
</tr>
</table>

<!-- Admin Navigation -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <a href="index.php">Dashboard</a> |
      <a href="boards.php">Manage Boards</a> |
      <b><a href="users.php">Manage Users</a></b> |
      <a href="modlog.php">Moderation Log</a> |
      <a href="../index.php">Return to Forum</a>
    </font>
  </td>
</tr>
</table>

<?php if ($message): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#00FF00"><b><?= htmlspecialchars($message) ?></b></font>
  </td>
</tr>
</table>
<?php endif; ?>

<?php if ($error): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600"><b><?= htmlspecialchars($error) ?></b></font>
  </td>
</tr>
</table>
<?php endif; ?>

<?php if ($action === 'edit' && $editUser): ?>
<!-- Edit User Form -->
<form method="post" action="users.php">
<input type="hidden" name="user_id" value="<?= $editUser['id'] ?>">

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="2">
    <font face="Arial" size="2" color="#EBEDEA"><b>Edit User: <?= htmlspecialchars($editUser['username']) ?></b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%">
    <font face="Arial" size="2"><b>Username:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= htmlspecialchars($editUser['username']) ?></font>
    <font face="Arial" size="1"> (cannot be changed)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="20%">
    <font face="Arial" size="2"><b>Email:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="text" name="email" size="40" value="<?= htmlspecialchars($editUser['email'] ?? '') ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%">
    <font face="Arial" size="2"><b>Registered:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= cb_fmt($editUser['registered']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="20%">
    <font face="Arial" size="2"><b>Last Login:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2"><?= $editUser['last_login'] ? cb_fmt($editUser['last_login']) : 'Never' ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%" valign="top">
    <font face="Arial" size="2"><b>Signature:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <textarea name="signature" rows="3" cols="50"><?= htmlspecialchars($editUser['signature'] ?? '') ?></textarea>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="20%">
    <font face="Arial" size="2"><b>New Password:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="password" name="new_password" size="25">
    <font face="Arial" size="1"> (leave blank to keep current)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%">
    <font face="Arial" size="2"><b>Permissions:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <input type="checkbox" name="is_mod" value="1" <?= $editUser['is_mod'] ? 'checked' : '' ?>> Moderator
      &nbsp;&nbsp;
      <input type="checkbox" name="is_admin" value="1" <?= $editUser['is_admin'] ? 'checked' : '' ?>> Administrator
      &nbsp;&nbsp;
      <input type="checkbox" name="banned" value="1" <?= $editUser['banned'] ? 'checked' : '' ?>> <font color="#FF6600">Banned</font>
    </font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" colspan="2" align="center">
    <input type="submit" name="update_user" value="Update User">
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='users.php'">
  </td>
</tr>
</table>
</form>

<?php else: ?>
<!-- Search Form -->
<form method="get" action="users.php">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2">
      Search: <input type="text" name="search" size="20" value="<?= htmlspecialchars($search) ?>">
      <input type="submit" value="Search">
      <?php if ($search): ?>
      <a href="users.php">Clear</a>
      <?php endif; ?>
    </font>
  </td>
</tr>
</table>
</form>

<!-- User List -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="5%"><font face="Arial" size="1" color="#EBEDEA"><b>ID</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Username</b></font></td>
  <td bgcolor="#4C5844" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>Email</b></font></td>
  <td bgcolor="#4C5844" width="10%"><font face="Arial" size="1" color="#EBEDEA"><b>Posts</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Registered</b></font></td>
  <td bgcolor="#4C5844" width="10%"><font face="Arial" size="1" color="#EBEDEA"><b>Status</b></font></td>
  <td bgcolor="#4C5844" width="25%"><font face="Arial" size="1" color="#EBEDEA"><b>Actions</b></font></td>
</tr>
<?php if (empty($users)): ?>
<tr>
  <td bgcolor="#424B3C" colspan="7" align="center">
    <font face="Arial" size="2"><em>No users found.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($users as $u): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= $u['id'] ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2">
      <?php if ($u['banned']): ?><s><?php endif; ?>
      <?= htmlspecialchars($u['username']) ?>
      <?php if ($u['banned']): ?></s><?php endif; ?>
      <?php if ($u['is_admin']): ?><font color="#FF6600" size="1">[A]</font><?php elseif ($u['is_mod']): ?><font color="#BFBA50" size="1">[M]</font><?php endif; ?>
    </font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($u['email'] ?? '-') ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= $u['post_count'] ?? 0 ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= cb_fmt($u['registered']) ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1">
      <?php if ($u['banned']): ?>
      <font color="#FF0000">Banned</font>
      <?php else: ?>
      <font color="#00FF00">Active</font>
      <?php endif; ?>
    </font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1">
      <a href="users.php?action=edit&id=<?= $u['id'] ?>">Edit</a>
      <?php if ($u['id'] !== $admin['id']): ?>
      |
      <form method="post" action="users.php" style="display:inline;">
        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
        <input type="submit" name="ban_user" value="<?= $u['banned'] ? 'Unban' : 'Ban' ?>" style="font-size:10px;">
      </form>
      |
      <form method="post" action="users.php" style="display:inline;">
        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
        <input type="submit" name="delete_user" value="Delete" style="font-size:10px;" onclick="return confirm('Delete this user and all their posts?')">
      </form>
      <?php endif; ?>
    </font>
  </td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" align="center">
    <font face="Arial" size="2">
      <?= $totalUsers ?> user(s). Page <?= $page ?> of <?= $totalPages ?>.
      <br>
      <?php if ($page > 1): ?>
      <a href="users.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">&laquo; Prev</a>
      <?php else: ?>
      &laquo; Prev
      <?php endif; ?>
      |
      <?php
      $start = max(1, $page - 3);
      $end = min($totalPages, $page + 3);
      for ($i = $start; $i <= $end; $i++):
      ?>
        <?php if ($i === $page): ?>
        <b><?= $i ?></b>
        <?php else: ?>
        <a href="users.php?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      |
      <?php if ($page < $totalPages): ?>
      <a href="users.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next &raquo;</a>
      <?php else: ?>
      Next &raquo;
      <?php endif; ?>
    </font>
  </td>
</tr>
</table>
<?php endif; ?>

<?php endif; ?>

</td></tr></table>

<?php
cb_footer();
?>
