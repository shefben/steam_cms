<?php
require_once __DIR__.'/includes/bootstrap.php';               // ← this line is all you needed

$tid = (int)($_GET['threadid'] ?? 0);
$row = cb_db()->prepare('SELECT t.*, b.name board FROM threads t JOIN boards b ON b.id=t.board_id WHERE t.id=?');
$row->execute([$tid]);
$thread = $row->fetch(PDO::FETCH_ASSOC) or die('Thread not found');

cb_header(htmlspecialchars($thread['board']));

echo '<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>';

echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
        <td bgcolor="#424B3C"><font face="Arial" size="4" color="#EBEDEA"><b>',
        htmlspecialchars($thread['subject']),
        '</b></font></td></tr></table>';

$posts = cb_db()->prepare('SELECT p.*, u.username FROM posts p LEFT JOIN users u ON u.id=p.user_id WHERE p.thread_id=? ORDER BY p.created');
$posts->execute([$tid]);
$alt = false;
while ($p = $posts->fetch(PDO::FETCH_ASSOC)) {
    echo '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="',
         cb_zebra($alt),'"><td width="20%" valign="top"><font face="Arial" size="2"><b>',
         htmlspecialchars($p['username'] ?? 'Guest'),'</b><br>',cb_fmt($p['created']),
         '</font></td><td width="80%" valign="top"><font face="Arial" size="2">',
         nl2br(htmlspecialchars($p['message'])),'</font></td></tr></table>';
    $alt = !$alt;
}

echo '</td></tr></table>';
cb_footer();
