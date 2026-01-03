<?php
require_once '../includes/template.php';

$admin = cb_require_admin();
$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_board'])) {
        $name = trim($_POST['name'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        $order = (int)($_POST['ordering'] ?? 0);
        $mods = trim($_POST['moderators'] ?? '');

        if (empty($name)) {
            $error = 'Board name is required.';
        } else {
            $boardId = cb_create_board($name, $desc, $order, $mods ?: null);
            cb_log_mod_action($admin['id'], 'create_board', 'board', $boardId, "Created board: $name");
            $message = "Board '$name' created successfully!";
            $action = 'list';
        }
    } elseif (isset($_POST['update_board'])) {
        $boardId = (int)$_POST['board_id'];
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'ordering' => (int)($_POST['ordering'] ?? 0),
            'moderators' => trim($_POST['moderators'] ?? '') ?: null
        ];

        if (empty($data['name'])) {
            $error = 'Board name is required.';
        } else {
            cb_update_board($boardId, $data);
            cb_log_mod_action($admin['id'], 'update_board', 'board', $boardId, "Updated board: {$data['name']}");
            $message = "Board updated successfully!";
            $action = 'list';
        }
    } elseif (isset($_POST['delete_board'])) {
        $boardId = (int)$_POST['board_id'];
        $board = cb_get_board($boardId);
        if ($board) {
            cb_delete_board($boardId);
            cb_log_mod_action($admin['id'], 'delete_board', 'board', $boardId, "Deleted board: {$board['name']}");
            $message = "Board '{$board['name']}' deleted.";
        }
        $action = 'list';
    }
}

// Get data for display
$boards = cb_get_boards();
$editBoard = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $editBoard = cb_get_board((int)$_GET['id']);
    if (!$editBoard) {
        $error = 'Board not found.';
        $action = 'list';
    }
}

cb_header('Manage Boards');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="3" color="#EBEDEA"><b>Manage Boards</b></font>
  </td>
</tr>
</table>

<!-- Admin Navigation -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <a href="index.php">Dashboard</a> |
      <b><a href="boards.php">Manage Boards</a></b> |
      <a href="users.php">Manage Users</a> |
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

<?php if ($action === 'new' || $action === 'edit'): ?>
<!-- Create/Edit Board Form -->
<form method="post" action="boards.php">
<?php if ($editBoard): ?>
<input type="hidden" name="board_id" value="<?= $editBoard['id'] ?>">
<?php endif; ?>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" colspan="2">
    <font face="Arial" size="2" color="#EBEDEA"><b><?= $editBoard ? 'Edit Board' : 'Create New Board' ?></b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%">
    <font face="Arial" size="2"><b>Name:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="name" size="40" maxlength="80" value="<?= htmlspecialchars($editBoard['name'] ?? '') ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="20%" valign="top">
    <font face="Arial" size="2"><b>Description:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <textarea name="description" rows="3" cols="50"><?= htmlspecialchars($editBoard['description'] ?? '') ?></textarea>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="20%">
    <font face="Arial" size="2"><b>Display Order:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="ordering" size="5" value="<?= htmlspecialchars($editBoard['ordering'] ?? '0') ?>">
    <font face="Arial" size="1"> (lower numbers appear first)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="20%">
    <font face="Arial" size="2"><b>Moderators:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="text" name="moderators" size="40" value="<?= htmlspecialchars($editBoard['moderators'] ?? '') ?>">
    <font face="Arial" size="1"> (comma-separated usernames)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2" align="center">
    <?php if ($editBoard): ?>
    <input type="submit" name="update_board" value="Update Board">
    <?php else: ?>
    <input type="submit" name="create_board" value="Create Board">
    <?php endif; ?>
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='boards.php'">
  </td>
</tr>
</table>
</form>

<?php else: ?>
<!-- Board List -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Current Boards</b></font>
    <font face="Arial" size="1" color="#EBEDEA"> | <a href="boards.php?action=new">+ Create New Board</a></font>
  </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="5%"><font face="Arial" size="1" color="#EBEDEA"><b>ID</b></font></td>
  <td bgcolor="#4C5844" width="5%"><font face="Arial" size="1" color="#EBEDEA"><b>Order</b></font></td>
  <td bgcolor="#4C5844" width="25%"><font face="Arial" size="1" color="#EBEDEA"><b>Name</b></font></td>
  <td bgcolor="#4C5844" width="35%"><font face="Arial" size="1" color="#EBEDEA"><b>Description</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Moderators</b></font></td>
  <td bgcolor="#4C5844" width="15%"><font face="Arial" size="1" color="#EBEDEA"><b>Actions</b></font></td>
</tr>
<?php if (empty($boards)): ?>
<tr>
  <td bgcolor="#424B3C" colspan="6" align="center">
    <font face="Arial" size="2"><em>No boards created yet.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($boards as $b): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= $b['id'] ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= $b['ordering'] ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="2"><a href="../board.php?boardid=<?= $b['id'] ?>"><?= htmlspecialchars($b['name']) ?></a></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars(substr($b['description'] ?? '', 0, 80)) ?><?= strlen($b['description'] ?? '') > 80 ? '...' : '' ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>"><font face="Arial" size="1"><?= htmlspecialchars($b['moderators'] ?? '-') ?></font></td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1">
      <a href="boards.php?action=edit&id=<?= $b['id'] ?>">Edit</a> |
      <form method="post" action="boards.php" style="display:inline;">
        <input type="hidden" name="board_id" value="<?= $b['id'] ?>">
        <input type="submit" name="delete_board" value="Delete" style="font-size:10px;" onclick="return confirm('Delete this board and ALL its threads/posts?')">
      </form>
    </font>
  </td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

<?php endif; ?>

</td></tr></table>

<?php
cb_footer();
?>
