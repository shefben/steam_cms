<?php
/**
 * Moderation action handler
 * Handles: hide/unhide, lock/unlock, sticky/unsticky, delete for threads and posts
 */
require_once 'includes/template.php';

$user = cb_current_user();
if (!$user || !cb_can_moderate($user)) {
    die('Access denied. You must be a moderator to perform this action.');
}

$action = $_GET['action'] ?? '';
$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);
$returnUrl = $_GET['return'] ?? 'index.php';

if (!$action || !$type || !$id) {
    die('Invalid request.');
}

// Get the target item and verify permissions
$boardId = 0;

if ($type === 'thread') {
    $stmt = cb_db()->prepare('SELECT t.*, b.name as board_name FROM threads t JOIN boards b ON t.board_id = b.id WHERE t.id = ?');
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$item) die('Thread not found.');
    $boardId = $item['board_id'];
} elseif ($type === 'post') {
    $stmt = cb_db()->prepare('SELECT p.*, t.board_id, t.subject as thread_subject FROM posts p JOIN threads t ON p.thread_id = t.id WHERE p.id = ?');
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$item) die('Post not found.');
    $boardId = $item['board_id'];
} else {
    die('Invalid target type.');
}

// Check board-specific moderation permission
if (!cb_can_moderate_board($boardId, $user)) {
    die('You do not have permission to moderate this board.');
}

// Process the action
$success = false;
$message = '';

switch ($action) {
    case 'hide':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET hidden = 1 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'hide_thread', 'thread', $id, "Hidden thread: {$item['subject']}");
            $message = 'Thread hidden.';
        } elseif ($type === 'post') {
            $stmt = cb_db()->prepare('UPDATE posts SET hidden = 1 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'hide_post', 'post', $id, "Hidden post in thread: {$item['thread_subject']}");
            $message = 'Post hidden.';
        }
        $success = true;
        break;

    case 'unhide':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET hidden = 0 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'unhide_thread', 'thread', $id, "Unhidden thread: {$item['subject']}");
            $message = 'Thread unhidden.';
        } elseif ($type === 'post') {
            $stmt = cb_db()->prepare('UPDATE posts SET hidden = 0 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'unhide_post', 'post', $id, "Unhidden post in thread: {$item['thread_subject']}");
            $message = 'Post unhidden.';
        }
        $success = true;
        break;

    case 'lock':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET locked = 1 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'lock_thread', 'thread', $id, "Locked thread: {$item['subject']}");
            $message = 'Thread locked.';
            $success = true;
        }
        break;

    case 'unlock':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET locked = 0 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'unlock_thread', 'thread', $id, "Unlocked thread: {$item['subject']}");
            $message = 'Thread unlocked.';
            $success = true;
        }
        break;

    case 'sticky':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET sticky = 1 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'sticky_thread', 'thread', $id, "Made thread sticky: {$item['subject']}");
            $message = 'Thread stickied.';
            $success = true;
        }
        break;

    case 'unsticky':
        if ($type === 'thread') {
            $stmt = cb_db()->prepare('UPDATE threads SET sticky = 0 WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'unsticky_thread', 'thread', $id, "Removed sticky from thread: {$item['subject']}");
            $message = 'Thread unstickied.';
            $success = true;
        }
        break;

    case 'delete':
        // Confirm deletion
        if (!isset($_GET['confirm'])) {
            cb_header('Confirm Deletion');
            ?>
            <table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>
            <table border="0" cellspacing="0" cellpadding="4" width="100%">
            <tr>
              <td bgcolor="#424B3C">
                <font face="Arial" size="2" color="#EBEDEA"><b>Confirm Deletion</b></font>
              </td>
            </tr>
            <tr>
              <td bgcolor="#4C5844">
                <font face="Arial" size="2">
                  Are you sure you want to permanently delete this <?= $type ?>?<br><br>
                  <?php if ($type === 'thread'): ?>
                  <b>Thread:</b> <?= htmlspecialchars($item['subject']) ?><br>
                  <font color="#FF6600">Warning: This will also delete all posts in this thread!</font>
                  <?php else: ?>
                  <b>Post in:</b> <?= htmlspecialchars($item['thread_subject']) ?>
                  <?php endif; ?>
                </font>
              </td>
            </tr>
            <tr>
              <td bgcolor="#424B3C" align="center">
                <a href="moderate.php?action=delete&type=<?= $type ?>&id=<?= $id ?>&confirm=1&return=<?= urlencode($returnUrl) ?>">
                  <font color="#FF0000"><b>Yes, Delete</b></font>
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="<?= htmlspecialchars($returnUrl) ?>">Cancel</a>
              </td>
            </tr>
            </table>
            </td></tr></table>
            <?php
            cb_footer();
            exit;
        }

        if ($type === 'thread') {
            $stmt = cb_db()->prepare('DELETE FROM threads WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'delete_thread', 'thread', $id, "Deleted thread: {$item['subject']}");
            $message = 'Thread deleted.';
            // Redirect to board instead of thread
            $returnUrl = "board.php?boardid=" . $item['board_id'];
        } elseif ($type === 'post') {
            $stmt = cb_db()->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->execute([$id]);
            cb_log_mod_action($user['id'], 'delete_post', 'post', $id, "Deleted post in thread: {$item['thread_subject']}");
            $message = 'Post deleted.';
        }
        $success = true;
        break;

    default:
        die('Invalid action.');
}

// Redirect back with message
if ($success) {
    $separator = strpos($returnUrl, '?') !== false ? '&' : '?';
    header('Location: ' . $returnUrl . $separator . 'modmsg=' . urlencode($message));
    exit;
}

die('Action failed.');
