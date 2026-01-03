<?php
require_once '../includes/template.php';

$admin = cb_require_admin();
$modLog = cb_get_mod_log(100);

cb_header('Moderation Log');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="3" color="#EBEDEA"><b>Moderation Log</b></font>
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
      <a href="users.php">Manage Users</a> |
      <b><a href="modlog.php">Moderation Log</a></b> |
      <a href="../index.php">Return to Forum</a>
    </font>
  </td>
</tr>
</table>

<!-- Log Table -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Date</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Moderator</b></font></td>
  <td bgcolor="#4C5844" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>Action</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Target</b></font></td>
  <td bgcolor="#4C5844" width="35%"><font face="Arial" size="1" color="#EBEDEA"><b>Details</b></font></td>
</tr>
<?php if (empty($modLog)): ?>
<tr>
  <td bgcolor="#424B3C" colspan="5" align="center">
    <font face="Arial" size="2"><em>No moderation actions recorded.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($modLog as $log): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= cb_fmt($log['created']) ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="2"><?= htmlspecialchars($log['username']) ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1">
      <?php
      $actionColors = [
          'delete_thread' => '#FF0000',
          'delete_post' => '#FF0000',
          'delete_user' => '#FF0000',
          'delete_board' => '#FF0000',
          'hide_thread' => '#FF6600',
          'hide_post' => '#FF6600',
          'unhide_thread' => '#00FF00',
          'unhide_post' => '#00FF00',
          'lock_thread' => '#FFFF00',
          'unlock_thread' => '#00FF00',
          'sticky_thread' => '#BFBA50',
          'unsticky_thread' => '#BFBA50',
          'ban_user' => '#FF0000',
          'unban_user' => '#00FF00',
      ];
      $color = $actionColors[$log['action']] ?? '#C4CABE';
      ?>
      <font color="<?= $color ?>"><?= htmlspecialchars($log['action']) ?></font>
    </font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= $log['target_type'] ?> #<?= $log['target_id'] ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($log['details'] ?? '-') ?></font></td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

</td></tr></table>

<?php
cb_footer();
?>
