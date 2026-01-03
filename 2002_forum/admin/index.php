<?php
require_once '../includes/template.php';

$admin = cb_require_admin();
$stats = cb_get_stats();
$modLog = cb_get_mod_log(10);

cb_header('Admin Panel');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="3" color="#EBEDEA"><b>Administration Panel</b></font>
  </td>
</tr>
</table>

<!-- Admin Navigation -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <b><a href="index.php">Dashboard</a></b> |
      <a href="boards.php">Manage Boards</a> |
      <a href="users.php">Manage Users</a> |
      <a href="modlog.php">Moderation Log</a> |
      <a href="../index.php">Return to Forum</a>
    </font>
  </td>
</tr>
</table>

<!-- Statistics -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="4">
    <font face="Arial" size="2" color="#EBEDEA"><b>Forum Statistics</b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Total Users:</b></font>
  </td>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><?= $stats['users'] ?></font>
  </td>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Total Boards:</b></font>
  </td>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><?= $stats['boards'] ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Total Threads:</b></font>
  </td>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><?= $stats['threads'] ?></font>
  </td>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><b>Total Posts:</b></font>
  </td>
  <td bgcolor="#424B3C" width="25%">
    <font face="Arial" size="2"><?= $stats['posts'] ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="25%">
    <font face="Arial" size="2"><b>Newest Member:</b></font>
  </td>
  <td bgcolor="#4C5844" colspan="3">
    <font face="Arial" size="2"><?= htmlspecialchars($stats['newest_user'] ?? 'None') ?></font>
  </td>
</tr>
</table>

<br>

<!-- Quick Actions -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Quick Actions</b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <a href="boards.php?action=new">Create New Board</a> |
      <a href="users.php">View All Users</a> |
      <a href="modlog.php">View Full Mod Log</a>
    </font>
  </td>
</tr>
</table>

<br>

<!-- Recent Moderation Log -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="4">
    <font face="Arial" size="2" color="#EBEDEA"><b>Recent Moderation Actions</b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>Date</b></font></td>
  <td bgcolor="#4C5844" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>Moderator</b></font></td>
  <td bgcolor="#4C5844" width="25%"><font face="Arial" size="1" color="#EBEDEA"><b>Action</b></font></td>
  <td bgcolor="#4C5844" width="35%"><font face="Arial" size="1" color="#EBEDEA"><b>Details</b></font></td>
</tr>
<?php if (empty($modLog)): ?>
<tr>
  <td bgcolor="#424B3C" colspan="4" align="center">
    <font face="Arial" size="2"><em>No moderation actions recorded.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($modLog as $log): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= cb_fmt($log['created']) ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($log['username']) ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($log['action']) ?> (<?= $log['target_type'] ?> #<?= $log['target_id'] ?>)</font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($log['details'] ?? '') ?></font></td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

</td></tr></table>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="1">
      Logged in as: <b><?= htmlspecialchars($admin['username']) ?></b> (Administrator)
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
