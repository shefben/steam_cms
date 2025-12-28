<?php
require_once __DIR__.'/includes/bootstrap.php';

$boardId = (int)($_GET['boardid'] ?? 0);
$b = cb_db()->prepare('SELECT * FROM boards WHERE id=?');
$b->execute([$boardId]);
$board = $b->fetch(PDO::FETCH_ASSOC) or die('Board not found');

$user = cb_current_user();
$canMod = $user && cb_can_moderate_board($boardId, $user);

// Handle moderation message
$modMsg = $_GET['modmsg'] ?? '';

/* ── paging ── */
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 40;

// Count threads (include hidden for mods)
if ($canMod) {
    $count = cb_db()->prepare('SELECT COUNT(*) FROM threads WHERE board_id=?');
} else {
    $count = cb_db()->prepare('SELECT COUNT(*) FROM threads WHERE board_id=? AND (hidden=0 OR hidden IS NULL)');
}
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
        </td></tr>';

// Admin panel link for moderators
if ($canMod) {
    echo '<tr><td colspan="2" align="right"><font face="Arial" size="1"><a href="admin/">Admin Panel</a></font></td></tr>';
}

echo '<tr><td colspan="2"><font color="#4C5844" size="1">.</font></td></tr>
      </table>';

// Show moderation message
if ($modMsg) {
    echo '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#4C5844"><td>';
    echo '<font face="Arial" size="2" color="#00FF00"><b>' . htmlspecialchars($modMsg) . '</b></font>';
    echo '</td></tr></table>';
}

/* column header */
echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="2%"></td>
          <td width="', ($canMod ? '38%' : '48%'), '" bgcolor="#424B3C"><b><font face="Arial" size="2" color="#EBEDEA">Subject</font></b></td>
          <td width="10%" bgcolor="#424B3C" align="center"><b><font face="Arial" size="2" color="#EBEDEA">Posts</font></b></td>
          <td width="20%" bgcolor="#424B3C"><b><font face="Arial" size="2" color="#EBEDEA">Updated</font></b></td>
          <td width="20%" bgcolor="#424B3C" align="right"><b><font face="Arial" size="2" color="#EBEDEA">Author</font></b></td>';
if ($canMod) {
    echo '<td width="10%" bgcolor="#424B3C" align="center"><b><font face="Arial" size="1" color="#EBEDEA">Mod</font></b></td>';
}
echo '</tr></table>';

/* thread rows - sticky first, then by last_post */
if ($canMod) {
    $q = cb_db()->prepare(
        'SELECT t.id, t.subject, t.last_post, t.locked, t.sticky, t.hidden, u.username,
                (SELECT COUNT(*)-1 FROM posts WHERE thread_id=t.id) AS replies
           FROM threads t LEFT JOIN users u ON u.id=t.user_id
          WHERE t.board_id=?
          ORDER BY t.sticky DESC, t.last_post DESC
          LIMIT '.$perPage.' OFFSET '.$offset);
} else {
    $q = cb_db()->prepare(
        'SELECT t.id, t.subject, t.last_post, t.locked, t.sticky, t.hidden, u.username,
                (SELECT COUNT(*)-1 FROM posts WHERE thread_id=t.id) AS replies
           FROM threads t LEFT JOIN users u ON u.id=t.user_id
          WHERE t.board_id=? AND (t.hidden=0 OR t.hidden IS NULL)
          ORDER BY t.sticky DESC, t.last_post DESC
          LIMIT '.$perPage.' OFFSET '.$offset);
}
$q->execute([$boardId]);

$alt = false;
while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
    $isHidden = !empty($r['hidden']);
    $isLocked = !empty($r['locked']);
    $isSticky = !empty($r['sticky']);

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>';

    // Status indicator
    echo '<td width="2%"><font face="Arial" size="2">';
    if ($isSticky) {
        echo '<font color="#BFBA50">&#9733;</font>'; // Star for sticky
    } elseif ($isLocked) {
        echo '<font color="#FF6600">&#128274;</font>'; // Lock emoji
    } else {
        echo '<font color="red">*</font>';
    }
    echo '</font></td>';

    // Subject
    echo '<td width="', ($canMod ? '38%' : '48%'), '" bgcolor="', cb_zebra($alt), '">';
    echo '<font face="Arial" size="2">';
    if ($isHidden) {
        echo '<font color="#FF0000">[H]</font> ';
    }
    if ($isLocked) {
        echo '<font color="#FF6600">[L]</font> ';
    }
    if ($isSticky) {
        echo '<font color="#BFBA50">[S]</font> ';
    }
    echo '<a href="thread.php?threadid=', $r['id'], '">';
    if ($isHidden) {
        echo '<s>';
    }
    echo htmlspecialchars($r['subject']);
    if ($isHidden) {
        echo '</s>';
    }
    echo '</a></font></td>';

    // Replies
    echo '<td width="10%" bgcolor="', cb_zebra($alt), '" align="center"><font face="Arial" size="2">', $r['replies'], '</font></td>';

    // Last post
    echo '<td width="20%" bgcolor="', cb_zebra($alt), '"><font face="Arial" size="2">', cb_fmt($r['last_post']), '</font></td>';

    // Author
    echo '<td width="20%" bgcolor="', cb_zebra($alt), '" align="right"><font face="Arial" size="2">',
         htmlspecialchars($r['username'] ?? 'Guest'), '</font></td>';

    // Mod controls
    if ($canMod) {
        $returnUrl = urlencode("board.php?boardid=$boardId&page=$page");
        echo '<td width="10%" bgcolor="', cb_zebra($alt), '" align="center"><font face="Arial" size="1">';
        if ($isHidden) {
            echo '<a href="moderate.php?action=unhide&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Unhide">U</a>';
        } else {
            echo '<a href="moderate.php?action=hide&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Hide">H</a>';
        }
        echo ' ';
        if ($isLocked) {
            echo '<a href="moderate.php?action=unlock&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Unlock">&#128275;</a>';
        } else {
            echo '<a href="moderate.php?action=lock&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Lock">L</a>';
        }
        echo ' ';
        if ($isSticky) {
            echo '<a href="moderate.php?action=unsticky&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Unsticky">-S</a>';
        } else {
            echo '<a href="moderate.php?action=sticky&type=thread&id=' . $r['id'] . '&return=' . $returnUrl . '" title="Sticky">+S</a>';
        }
        echo '</font></td>';
    }

    echo '</tr></table>';
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
        <td width="50%">';
if ($canMod) {
    echo '<font face="Arial" size="1"><b>Legend:</b> [H]=Hidden [L]=Locked [S]=Sticky</font>';
}
echo '</td>
        <td width="50%" align="right"><font face="Arial" size="1"><b>Moderators on this board:</b><br>',
        ($mods ? $mods : '<i>none listed</i>'),
        '</font></td>
      </tr><tr>
        <td colspan="2"><br><font face="Arial" size="1"><font color="red">*</font> Updated or new since last visit. <font color="#BFBA50">&#9733;</font> Sticky thread.</font></td>
      </tr></table>';

echo '</td></tr></table>';  /* close olive frame */

$_SESSION["last_visit_$boardId"] = date('Y-m-d H:i:s');
cb_footer();
