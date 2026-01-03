<?php
require_once __DIR__.'/includes/bootstrap.php';

$user = cb_require_login();

$tid = (int)($_GET['threadid'] ?? 0);
$stmt = cb_db()->prepare('SELECT t.*, b.name as board_name, b.id as board_id FROM threads t JOIN boards b ON t.board_id = b.id WHERE t.id = ?');
$stmt->execute([$tid]);
$thread = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$thread) {
    die('Thread not found.');
}

// Check if thread is locked
if ($thread['locked']) {
    die('This thread is locked. You cannot post replies.');
}

// Check if user is banned
if ($user['banned']) {
    die('Your account has been banned. You cannot post.');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message'] ?? '');

    if (empty($message)) {
        $error = 'Please enter a message.';
    } elseif (strlen($message) > 65000) {
        $error = 'Message is too long (max 65000 characters).';
    } else {
        // Insert the reply
        $stmt = cb_db()->prepare('INSERT INTO posts (thread_id, user_id, message, created, ip_addr) VALUES (?, ?, ?, NOW(), ?)');
        $stmt->execute([$tid, $user['id'], $message, $_SERVER['REMOTE_ADDR'] ?? '']);

        // Update thread's last_post time
        $stmt = cb_db()->prepare('UPDATE threads SET last_post = NOW() WHERE id = ?');
        $stmt->execute([$tid]);

        // Redirect to thread
        header('Location: thread.php?threadid=' . $tid);
        exit;
    }
}

cb_header('Reply to ' . htmlspecialchars($thread['subject']));
?>

<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>

<!-- Header -->
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#424B3C">
    <font face="Arial" size="2" color="#EBEDEA"><b>Reply to: <?= htmlspecialchars($thread['subject']) ?></b></font>
  </td>
</tr>
</table>

<?php if ($error): ?>
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844">
    <font face="Arial" size="2" color="#FF6600"><b><?= htmlspecialchars($error) ?></b></font>
  </td>
</tr>
</table>
<?php endif; ?>

<form method="post" action="reply.php?threadid=<?= $tid ?>">
<table border="0" cellspacing="0" cellpadding="4" width="100%">
<tr>
  <td bgcolor="#4C5844" valign="top">
    <font face="Arial" size="2"><b>Your Reply:</b></font>
  </td>
</tr>
<tr>
  <td bgcolor="#424B3C">
    <textarea name="message" rows="12" cols="70"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
  </td>
</tr>
<tr>
  <td bgcolor="#4C5844" align="center">
    <input type="submit" value="Post Reply">
    &nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="location.href='thread.php?threadid=<?= $tid ?>'">
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
      <a href="thread.php?threadid=<?= $tid ?>">&laquo; Back to thread</a> |
      <a href="board.php?boardid=<?= $thread['board_id'] ?>">Back to <?= htmlspecialchars($thread['board_name']) ?></a>
    </font>
  </td>
</tr>
</table>

<?php
cb_footer();
?>
