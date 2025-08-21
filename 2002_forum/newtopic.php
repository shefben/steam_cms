<?php
require_once __DIR__.'/includes/bootstrap.php';

$boardId = (int)($_GET['boardid'] ?? 0);
$board = cb_db()->prepare('SELECT * FROM boards WHERE id=?');
$board->execute([$boardId]);
$board = $board->fetch(PDO::FETCH_ASSOC) or die('Board not found');

$logged = isset($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = cb_db();
    $pdo->beginTransaction();
    $pdo->prepare('INSERT INTO threads(board_id,subject,user_id,created,last_post)
                   VALUES (?,?,?,NOW(),NOW())')
        ->execute([$boardId, $_POST['subject'], $logged ? $_SESSION['user']['id'] : null]);
    $tid = (int)$pdo->lastInsertId();
    $pdo->prepare('INSERT INTO posts(thread_id,user_id,message,created,ip_addr)
                   VALUES (?,?,?,?,?)')
        ->execute([$tid, $logged ? $_SESSION['user']['id'] : null,
                   $_POST['message'], date('Y-m-d H:i:s'), $_SERVER['REMOTE_ADDR']]);
    $pdo->commit();
    header("Location: thread.php?threadid=$tid");
    exit;
}

cb_header('Post Message');
?>
<table align="center" bgcolor="#626D5C" border="0" cellpadding="5" cellspacing="0" width="798">
 <tr valign="top"><td bgcolor="#4C5844">
  <div align="center">
   <table border="0" cellspacing="0" width="100%">
    <tr><td>
      <b><font color="#FFFFFF" face="Arial" size="5">Post Message</font></b><br>
      <font face="Arial" size="2">
        Enter the details of the message you'd like to post in the boxes below and click the button at the bottom of the form.
      </font><p></p>

<form method="POST">
<table border="0" cellspacing="0" width="100%">
  <tr>
    <td width="20%"><font face="Arial" size="2">Subject</font></td>
    <td width="80%"><input type="text" name="subject" size="30" maxlength="40"></td>
  </tr>
  <tr>
    <td width="20%"><font face="Arial" size="2">Message</font></td>
    <td width="80%"><textarea name="message" cols="60" rows="8" wrap="virtual"></textarea></td>
  </tr>
  <tr>
    <td width="20%"><font face="Arial" size="2">Notify</font></td>
    <td width="80%"><font face="Arial" size="2">
      <input type="checkbox" name="alert"  value="ON"> <a href="http://www.bearkey.com/alerts/" target="_blank">Bearkey Alert</a> me when this topic is updated (registered users only)<br>
      <input type="checkbox" name="notify" value="ON"> Email me when this topic is updated (registered users only)
    </font></td>
  </tr>
  <tr><td colspan="2"><font color="#4C5844" size="1">.</font></td></tr>

<?php if (!$logged): ?>
  <tr>
    <td></td>
    <td>
      <font face="Arial" size="2">
        Email <input type="text" name="email" size="15">
        Password <input type="password" name="password" size="8" maxlength="10">
        <input type="checkbox" name="rememberme" value="ON"> Remember Me
      </font>
    </td>
  </tr>
  <tr>
    <td></td>
    <td><font face="Arial" size="2">
      If you don't already have a Bearkey account, you can <a href="http://www.bearkey.com/signup/">signup for one here</a>.<br>
      If you have a signature setup, it will be automatically appended to your message.
    </font></td>
  </tr>
<?php endif; ?>
</table>

<p align="center">
  <input type="submit" value="<?= $logged ? 'Post' : 'Post with Login (email/pw required)' ?>">
</p>
</form>

<p align="left"><b><font face="Arial" size="2">Special Codes</font></b>
<ul type="square" style="margin-top:0;margin-bottom:0">
  <li><font face="Arial" size="2">b[<b>bold</b>]b</font></li>
  <li><font face="Arial" size="2">i[<i>italic</i>]i</font></li>
  <li><font face="Arial" size="2">u[<u>underline</u>]u</font></li>
  <li><font face="Arial" size="2">-[<strike>strike</strike>]-</font></li>
  <li><font face="Arial" size="2">q[quote]q</font></li>
  <li><font face="Arial" size="2">+[bullet]+</font></li>
  <li><font face="Arial" size="2">c[code]c</font></li>
  <li><font face="Arial" size="2">1{<font color="#d6e4e2">colour1</font>}1</font></li>
  <li><font face="Arial" size="2">2{<font color="#eecfcc">colour2</font>}2</font></li>
  <li><font face="Arial" size="2">3{<font color="#cceed2">colour3</font>}3</font></li>
  <li><font face="Arial" size="2">4{<font color="#cfd5f5">colour4</font>}4</font></li>
</ul></p>

    </td></tr></table>
  </div>
 </td></tr>
</table>
<?php cb_footer(); ?>
