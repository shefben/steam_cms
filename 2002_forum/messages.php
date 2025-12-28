<?php
require_once 'includes/template.php';

$user = cb_require_login();
$action = $_GET['action'] ?? 'inbox';
$errors = [];
$success = '';

/**
 * Get unread message count for current user
 */
function cb_get_unread_count(int $userId): int {
    $stmt = cb_db()->prepare('SELECT COUNT(*) FROM private_messages WHERE to_user=? AND read_at IS NULL AND deleted_by_receiver=0');
    $stmt->execute([$userId]);
    return (int)$stmt->fetchColumn();
}

/**
 * Send a private message
 */
function cb_send_pm(int $fromUser, string $toUsername, string $subject, string $message): array {
    $subject = trim($subject);
    $message = trim($message);
    $toUsername = trim($toUsername);

    if (empty($toUsername)) {
        return ['success' => false, 'error' => 'Please enter a recipient username.'];
    }
    if (empty($subject)) {
        return ['success' => false, 'error' => 'Please enter a subject.'];
    }
    if (empty($message)) {
        return ['success' => false, 'error' => 'Please enter a message.'];
    }

    // Find recipient
    $stmt = cb_db()->prepare('SELECT id FROM users WHERE username=?');
    $stmt->execute([$toUsername]);
    $recipient = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recipient) {
        return ['success' => false, 'error' => 'User not found: ' . htmlspecialchars($toUsername)];
    }

    if ($recipient['id'] == $fromUser) {
        return ['success' => false, 'error' => 'You cannot send a message to yourself.'];
    }

    $stmt = cb_db()->prepare('INSERT INTO private_messages (from_user, to_user, subject, message, sent_at) VALUES (?, ?, ?, ?, NOW())');
    $stmt->execute([$fromUser, $recipient['id'], $subject, $message]);

    return ['success' => true];
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_message'])) {
        $result = cb_send_pm(
            $user['id'],
            $_POST['to_user'] ?? '',
            $_POST['subject'] ?? '',
            $_POST['message'] ?? ''
        );
        if ($result['success']) {
            $success = 'Message sent successfully!';
            $action = 'sent';
        } else {
            $errors[] = $result['error'];
            $action = 'compose';
        }
    } elseif (isset($_POST['delete_message'])) {
        $msgId = (int)($_POST['msg_id'] ?? 0);
        $folder = $_POST['folder'] ?? 'inbox';

        // Check ownership
        $stmt = cb_db()->prepare('SELECT from_user, to_user FROM private_messages WHERE id=?');
        $stmt->execute([$msgId]);
        $msg = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($msg) {
            if ($msg['to_user'] == $user['id']) {
                $stmt = cb_db()->prepare('UPDATE private_messages SET deleted_by_receiver=1 WHERE id=?');
                $stmt->execute([$msgId]);
                $success = 'Message deleted.';
            } elseif ($msg['from_user'] == $user['id']) {
                $stmt = cb_db()->prepare('UPDATE private_messages SET deleted_by_sender=1 WHERE id=?');
                $stmt->execute([$msgId]);
                $success = 'Message deleted.';
            }
        }
        $action = $folder;
    }
}

// Get unread count for display
$unreadCount = cb_get_unread_count($user['id']);

cb_header('Private Messages');
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header row -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Private Messages</b></font>
    <?php if ($unreadCount > 0): ?>
    <font face="Arial" size="1" color="#FF6600"> (<?= $unreadCount ?> unread)</font>
    <?php endif; ?>
  </td>
</tr>
</table>

<!-- Navigation tabs -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2">
      <a href="messages.php?action=inbox"><b>Inbox</b></a><?php if ($unreadCount > 0): ?> (<?= $unreadCount ?>)<?php endif; ?> |
      <a href="messages.php?action=sent"><b>Sent</b></a> |
      <a href="messages.php?action=compose"><b>Compose</b></a>
    </font>
  </td>
</tr>
</table>

<?php if (!empty($success)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#00FF00"><b><?= htmlspecialchars($success) ?></b></font>
  </td>
</tr>
</table>
<?php endif; ?>

<?php if (!empty($errors)): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
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

<?php if ($action === 'inbox'): ?>
<!-- INBOX -->
<?php
$stmt = cb_db()->prepare('
    SELECT pm.*, u.username as from_username
    FROM private_messages pm
    JOIN users u ON pm.from_user = u.id
    WHERE pm.to_user = ? AND pm.deleted_by_receiver = 0
    ORDER BY pm.sent_at DESC
');
$stmt->execute([$user['id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" width="5%"><font face="Arial" size="1" color="#EBEDEA"><b></b></font></td>
  <td bgcolor="#424B3C" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>From</b></font></td>
  <td bgcolor="#424B3C" width="50%"><font face="Arial" size="1" color="#EBEDEA"><b>Subject</b></font></td>
  <td bgcolor="#424B3C" width="25%"><font face="Arial" size="1" color="#EBEDEA"><b>Date</b></font></td>
</tr>
<?php if (empty($messages)): ?>
<tr>
  <td colspan="4" bgcolor="#4C5844" align="center">
    <font face="Arial" size="2"><em>No messages in your inbox.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($messages as $msg): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2"><?= $msg['read_at'] ? '' : '<b>*</b>' ?></font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2"><?= htmlspecialchars($msg['from_username']) ?></font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2">
      <a href="messages.php?action=view&id=<?= $msg['id'] ?>">
        <?php if (!$msg['read_at']): ?><b><?php endif; ?>
        <?= htmlspecialchars($msg['subject']) ?>
        <?php if (!$msg['read_at']): ?></b><?php endif; ?>
      </a>
    </font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1"><?= cb_fmt($msg['sent_at']) ?></font>
  </td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

<?php elseif ($action === 'sent'): ?>
<!-- SENT -->
<?php
$stmt = cb_db()->prepare('
    SELECT pm.*, u.username as to_username
    FROM private_messages pm
    JOIN users u ON pm.to_user = u.id
    WHERE pm.from_user = ? AND pm.deleted_by_sender = 0
    ORDER BY pm.sent_at DESC
');
$stmt->execute([$user['id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C" width="5%"><font face="Arial" size="1" color="#EBEDEA"><b></b></font></td>
  <td bgcolor="#424B3C" width="20%"><font face="Arial" size="1" color="#EBEDEA"><b>To</b></font></td>
  <td bgcolor="#424B3C" width="50%"><font face="Arial" size="1" color="#EBEDEA"><b>Subject</b></font></td>
  <td bgcolor="#424B3C" width="25%"><font face="Arial" size="1" color="#EBEDEA"><b>Date</b></font></td>
</tr>
<?php if (empty($messages)): ?>
<tr>
  <td colspan="4" bgcolor="#4C5844" align="center">
    <font face="Arial" size="2"><em>No sent messages.</em></font>
  </td>
</tr>
<?php else: ?>
<?php $alt = false; foreach ($messages as $msg): ?>
<tr>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2"><?= $msg['read_at'] ? '&#10003;' : '' ?></font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2"><?= htmlspecialchars($msg['to_username']) ?></font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="2">
      <a href="messages.php?action=view&id=<?= $msg['id'] ?>&folder=sent"><?= htmlspecialchars($msg['subject']) ?></a>
    </font>
  </td>
  <td bgcolor="<?= cb_zebra($alt) ?>">
    <font face="Arial" size="1"><?= cb_fmt($msg['sent_at']) ?></font>
  </td>
</tr>
<?php $alt = !$alt; endforeach; ?>
<?php endif; ?>
</table>

<?php elseif ($action === 'compose'): ?>
<!-- COMPOSE -->
<?php
$toUser = $_GET['to'] ?? $_POST['to_user'] ?? '';
$reSubject = $_GET['re'] ?? $_POST['subject'] ?? '';
$quoteMsg = '';
if (isset($_GET['quote'])) {
    $stmt = cb_db()->prepare('SELECT pm.*, u.username FROM private_messages pm JOIN users u ON pm.from_user = u.id WHERE pm.id=? AND pm.to_user=?');
    $stmt->execute([(int)$_GET['quote'], $user['id']]);
    $orig = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($orig) {
        $toUser = $orig['username'];
        $reSubject = (strpos($orig['subject'], 'Re: ') === 0) ? $orig['subject'] : 'Re: ' . $orig['subject'];
        $quoteMsg = "\n\n--- Original Message ---\n" . $orig['message'];
    }
}
?>

<form method="post" action="messages.php?action=compose">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="15%">
    <font face="Arial" size="2"><b>To:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <input type="text" name="to_user" size="30" maxlength="20" value="<?= htmlspecialchars($toUser) ?>">
    <font face="Arial" size="1"> (username)</font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="15%">
    <font face="Arial" size="2"><b>Subject:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <input type="text" name="subject" size="50" maxlength="120" value="<?= htmlspecialchars($reSubject) ?>">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="15%" valign="top">
    <font face="Arial" size="2"><b>Message:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <textarea name="message" rows="10" cols="60"><?= htmlspecialchars($_POST['message'] ?? $quoteMsg) ?></textarea>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" colspan="2" align="center">
    <input type="submit" name="send_message" value="Send Message">
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='messages.php'">
  </td>
</tr>
</table>
</form>

<?php elseif ($action === 'view' && isset($_GET['id'])): ?>
<!-- VIEW MESSAGE -->
<?php
$msgId = (int)$_GET['id'];
$folder = $_GET['folder'] ?? 'inbox';

// Get message - check if user is sender or recipient
$stmt = cb_db()->prepare('
    SELECT pm.*,
           sender.username as from_username,
           receiver.username as to_username
    FROM private_messages pm
    JOIN users sender ON pm.from_user = sender.id
    JOIN users receiver ON pm.to_user = receiver.id
    WHERE pm.id = ? AND (pm.from_user = ? OR pm.to_user = ?)
');
$stmt->execute([$msgId, $user['id'], $user['id']]);
$msg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$msg || ($msg['to_user'] == $user['id'] && $msg['deleted_by_receiver']) || ($msg['from_user'] == $user['id'] && $msg['deleted_by_sender'])):
?>
<table border="0" cellspacing="0" cellpadding="8" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600"><b>Message not found or has been deleted.</b></font>
  </td>
</tr>
</table>
<?php else:
// Mark as read if recipient viewing
if ($msg['to_user'] == $user['id'] && !$msg['read_at']) {
    $stmt = cb_db()->prepare('UPDATE private_messages SET read_at = NOW() WHERE id = ?');
    $stmt->execute([$msgId]);
}
?>

<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" width="15%">
    <font face="Arial" size="2"><b>From:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><?= htmlspecialchars($msg['from_username']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="15%">
    <font face="Arial" size="2"><b>To:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2"><?= htmlspecialchars($msg['to_username']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" width="15%">
    <font face="Arial" size="2"><b>Subject:</b></font>
  </td>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2"><b><?= htmlspecialchars($msg['subject']) ?></b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C" width="15%">
    <font face="Arial" size="2"><b>Date:</b></font>
  </td>
  <td bgcolor="#424B3C">
    <font face="Arial" size="1"><?= cb_fmt($msg['sent_at']) ?></font>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2">
    <hr size="1" color="#626D5C">
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" colspan="2">
    <font face="Arial" size="2"><?= nl2br(htmlspecialchars($msg['message'])) ?></font>
  </td>
</tr>
</table>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="2">
      <?php if ($msg['to_user'] == $user['id']): ?>
      <a href="messages.php?action=compose&to=<?= urlencode($msg['from_username']) ?>&re=<?= urlencode((strpos($msg['subject'], 'Re: ') === 0) ? $msg['subject'] : 'Re: ' . $msg['subject']) ?>">Reply</a> |
      <a href="messages.php?action=compose&quote=<?= $msg['id'] ?>">Quote</a> |
      <?php endif; ?>
      <form method="post" action="messages.php" style="display:inline;">
        <input type="hidden" name="msg_id" value="<?= $msg['id'] ?>">
        <input type="hidden" name="folder" value="<?= htmlspecialchars($folder) ?>">
        <input type="submit" name="delete_message" value="Delete" onclick="return confirm('Delete this message?')">
      </form>
      &nbsp;|&nbsp;
      <a href="messages.php?action=<?= htmlspecialchars($folder) ?>">Back to <?= ucfirst($folder) ?></a>
    </font>
  </td>
</tr>
</table>

<?php endif; ?>

<?php endif; ?>

</td></tr></table>

<br>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td>
    <font face="Arial" size="1">
      <a href="index.php">Back to Forums</a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
