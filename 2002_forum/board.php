<?php
require_once __DIR__.'/includes/bootstrap.php';

$boardId = (int)($_GET['boardid'] ?? 0);
$b = cb_db()->prepare('SELECT * FROM boards WHERE id=?');
$b->execute([$boardId]);
$board = $b->fetch(PDO::FETCH_ASSOC) or die('Board not found');

/* ── paging ── */
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 40;
$count   = cb_db()->prepare('SELECT COUNT(*) FROM threads WHERE board_id=?');
$count->execute([$boardId]);
$totalTopics = (int)$count->fetchColumn();
$pages   = max(1, ceil($totalTopics / $perPage));
$offset  = ($page-1) * $perPage;

cb_header(htmlspecialchars($board['name']));

/* 1-px olive border wrapper */
echo '<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>';

/* top banner (board title + buttons) */
echo '<table border="0" cellspacing="0" width="100%"><tr>
        <td width="50%"><font face="Arial" size="4" color="#FFFFFF"><b>',
        htmlspecialchars($board['name']),
        '</b></font><br><font face="Arial" size="1">Last Visit: ',
        ($_SESSION["last_visit_$boardId"] ?? 'Never'),
        ' -- Currently: ',cb_fmt(date('Y-m-d H:i:s')),
        '</font></td>
        <td width="50%" align="right">
          <a href="newtopic.php?boardid=',$boardId,'"><img src="images/buttons/grey/postnewtopic.gif"  width="88" height="19" border="0"></a>
          <a href="board.php?boardid=',$boardId,'"><img src="images/buttons/grey/boardlistings.gif" width="82" height="19" border="0"></a>
          <a href="search.php?boardid=',$boardId,'"><img src="images/buttons/grey/search.gif"         width="48" height="19" border="0"></a>
        </td></tr>
        <tr><td colspan="2"><font color="#4C5844" size="1">.</font></td></tr>
      </table>';

/* column header */
echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="2%"></td>
          <td width="48%" bgcolor="#424B3C"><b><font face="Arial" size="2" color="#EBEDEA">Subject</font></b></td>
          <td width="10%" bgcolor="#424B3C" align="center"><b><font face="Arial" size="2" color="#EBEDEA">Posts</font></b></td>
          <td width="20%" bgcolor="#424B3C"><b><font face="Arial" size="2" color="#EBEDEA">Updated</font></b></td>
          <td width="20%" bgcolor="#424B3C" align="right"><b><font face="Arial" size="2" color="#EBEDEA">Author</font></b></td>
        </tr>
      </table>';

/* thread rows */
$q = cb_db()->prepare(
    'SELECT t.id, t.subject, t.last_post, u.username,
            (SELECT COUNT(*)-1 FROM posts WHERE thread_id=t.id) AS replies
       FROM threads t LEFT JOIN users u ON u.id=t.user_id
      WHERE t.board_id=? ORDER BY t.last_post DESC
      LIMIT '.$perPage.' OFFSET '.$offset);
$q->execute([$boardId]);

$alt = false;
while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>',
         '<td width="2%"><font face="Arial" size="2"><font color="red">*</font></font></td>',
         '<td width="48%" bgcolor="',cb_zebra($alt),'" ><font face="Arial" size="2"><a href="thread.php?threadid=',$r['id'],'">',
         htmlspecialchars($r['subject']),'</a></font></td>',
         '<td width="10%" bgcolor="',cb_zebra($alt),'" align="center"><font face="Arial" size="2">',$r['replies'],'</font></td>',
         '<td width="20%" bgcolor="',cb_zebra($alt),'"><font face="Arial" size="2">',cb_fmt($r['last_post']),'</font></td>',
         '<td width="20%" bgcolor="',cb_zebra($alt),'" align="right"><font face="Arial" size="2">',
         htmlspecialchars($r['username'] ?? 'Guest'),'</font></td></tr></table>';
    $alt = !$alt;
}

/* ----- page nav + stats ----- */
echo '<br><center><font face="Arial" size="2"><b>',
     $totalTopics,' Topic(s). ', $pages,' page(s). Viewing page ',$page,'.</b><br>';

echo '&lt; Prev [ ';
for ($i=1;$i<=$pages;$i++){
    if ($i==$page) echo "<b>$i</b>";
    else            echo "<b><a href=\"board.php?boardid=$boardId&page=$i\">$i</a></b>";
    echo ' ';
}
echo '] ';
if ($page<$pages)
    echo '<a href="board.php?boardid=',$boardId,'&page=',($page+1),'">Next &gt;</a>';
else
    echo 'Next &gt;';
echo '</font></center><br>';

/* ----- moderators + legend ----- */
$mods = trim($board['moderators'] ?? '');
echo '<table border="0" cellspacing="0" width="100%"><tr>
        <td width="50%"><font color="#4C5844" face="Arial" size="1">.</font></td>
        <td width="50%"><font color="#4C5844" face="Arial" size="1">.</font></td>
      </tr><tr>
        <td width="50%"></td>
        <td width="50%" align="right"><font face="Arial" size="1"><b>Moderators on this board:</b><br>',
        ($mods ? $mods : '<i>none listed</i>'),
        '</font></td>
      </tr><tr>
        <td colspan="2"><br><font face="Arial" size="1"><font color="red">*</font> Updated or new since last visit.</font></td>
      </tr></table>';

echo '</td></tr></table>';  /* close olive frame */

$_SESSION["last_visit_$boardId"] = date('Y-m-d H:i:s');
cb_footer();
