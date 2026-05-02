<?php
require_once __DIR__.'/includes/bootstrap.php';

$tid = (int)($_GET['threadid'] ?? 0);
$row = cb_db()->prepare('SELECT t.*, b.name board, b.id as board_id FROM threads t JOIN boards b ON b.id=t.board_id WHERE t.id=?');
$row->execute([$tid]);
$thread = $row->fetch(PDO::FETCH_ASSOC) or die('Thread not found');

$user = cb_current_user();
$canMod = $user && cb_can_moderate_board($thread['board_id'], $user);

// Check if thread is hidden and user can't see it
if ($thread['hidden'] && !$canMod) {
    die('This thread is not available.');
}

// Handle moderation message
$modMsg = $_GET['modmsg'] ?? '';

cb_header(htmlspecialchars($thread['board']));

echo '<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>';

// Thread header with status indicators
echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
        <td bgcolor="#424B3C" width="70%"><font face="Arial" size="4" color="#EBEDEA"><b>',
        htmlspecialchars($thread['subject']),
        '</b></font>';
if ($thread['locked']) {
    echo ' <font face="Arial" size="1" color="#FF6600">[LOCKED]</font>';
}
if ($thread['sticky']) {
    echo ' <font face="Arial" size="1" color="#BFBA50">[STICKY]</font>';
}
if ($thread['hidden']) {
    echo ' <font face="Arial" size="1" color="#FF0000">[HIDDEN]</font>';
}
echo '</td>';

// Moderation controls for thread
if ($canMod) {
    $returnUrl = urlencode("thread.php?threadid=$tid");
    echo '<td bgcolor="#424B3C" width="30%" align="right"><font face="Arial" size="1">';
    echo '<b>Mod:</b> ';
    if ($thread['hidden']) {
        echo '<a href="moderate.php?action=unhide&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Unhide</a> | ';
    } else {
        echo '<a href="moderate.php?action=hide&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Hide</a> | ';
    }
    if ($thread['locked']) {
        echo '<a href="moderate.php?action=unlock&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Unlock</a> | ';
    } else {
        echo '<a href="moderate.php?action=lock&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Lock</a> | ';
    }
    if ($thread['sticky']) {
        echo '<a href="moderate.php?action=unsticky&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Unsticky</a> | ';
    } else {
        echo '<a href="moderate.php?action=sticky&type=thread&id=' . $tid . '&return=' . $returnUrl . '">Sticky</a> | ';
    }
    echo '<a href="moderate.php?action=delete&type=thread&id=' . $tid . '&return=' . $returnUrl . '" style="color:#FF0000;">Delete</a>';
    echo '</font></td>';
}
echo '</tr></table>';

// Show moderation message
if ($modMsg) {
    echo '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#4C5844"><td>';
    echo '<font face="Arial" size="2" color="#00FF00"><b>' . htmlspecialchars($modMsg) . '</b></font>';
    echo '</td></tr></table>';
}

// Show locked notice
if ($thread['locked']) {
    echo '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#4C5844"><td>';
    echo '<font face="Arial" size="2" color="#FF6600"><b>This thread is locked. No new replies can be posted.</b></font>';
    echo '</td></tr></table>';
}

// Get posts (include hidden posts for moderators)
if ($canMod) {
    $posts = cb_db()->prepare('SELECT p.*, u.username, u.signature, u.is_mod, u.is_admin FROM posts p LEFT JOIN users u ON u.id=p.user_id WHERE p.thread_id=? ORDER BY p.id');
} else {
    $posts = cb_db()->prepare('SELECT p.*, u.username, u.signature, u.is_mod, u.is_admin FROM posts p LEFT JOIN users u ON u.id=p.user_id WHERE p.thread_id=? AND (p.hidden=0 OR p.hidden IS NULL) ORDER BY p.id');
}
$posts->execute([$tid]);

$alt = false;
$postNum = 0;
while ($p = $posts->fetch(PDO::FETCH_ASSOC)) {
    $postNum++;
    $isHidden = !empty($p['hidden']);

    echo '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="', cb_zebra($alt), '">';

    // Author column
    echo '<td width="20%" valign="top"><font face="Arial" size="2"><b>',
         htmlspecialchars($p['username'] ?? 'Guest'), '</b>';

    // Show badges
    if (!empty($p['is_admin'])) {
        echo '<br><font size="1" color="#FF6600">[Admin]</font>';
    } elseif (!empty($p['is_mod'])) {
        echo '<br><font size="1" color="#BFBA50">[Moderator]</font>';
    }

    echo '<br><font size="1">', cb_fmt($p['created']), '</font>';

    // Show IP for moderators
    if ($canMod && !empty($p['ip_addr'])) {
        echo '<br><font size="1" color="#666666">IP: ', htmlspecialchars($p['ip_addr']), '</font>';
    }

    echo '</font></td>';

    // Message column
    echo '<td width="80%" valign="top">';

    // Hidden post indicator
    if ($isHidden) {
        echo '<font face="Arial" size="1" color="#FF0000"><b>[POST HIDDEN]</b></font><br>';
    }

    echo '<font face="Arial" size="2">', nl2br(htmlspecialchars($p['message'])), '</font>';

    // Signature
    if (!empty($p['signature'])) {
        echo '<br><hr size="1" color="#4C5844"><font face="Arial" size="1">', nl2br(htmlspecialchars($p['signature'])), '</font>';
    }

    // Post moderation controls
    if ($canMod) {
        $returnUrl = urlencode("thread.php?threadid=$tid");
        echo '<br><br><font face="Arial" size="1" color="#666666">';
        echo '<b>Mod:</b> ';
        if ($isHidden) {
            echo '<a href="moderate.php?action=unhide&type=post&id=' . $p['id'] . '&return=' . $returnUrl . '">Unhide</a>';
        } else {
            echo '<a href="moderate.php?action=hide&type=post&id=' . $p['id'] . '&return=' . $returnUrl . '">Hide</a>';
        }
        echo ' | <a href="moderate.php?action=delete&type=post&id=' . $p['id'] . '&return=' . $returnUrl . '" style="color:#FF0000;">Delete</a>';
        echo '</font>';
    }

    echo '</td></tr></table>';

    $alt = !$alt;
}

// Reply section (if not locked)
if (!$thread['locked']) {
    if ($user) {
        echo '<br><table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#424B3C"><td>';
        echo '<font face="Arial" size="2"><a href="reply.php?threadid=' . $tid . '">Post a Reply</a></font>';
        echo '</td></tr></table>';
    } else {
        echo '<br><table border="0" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#424B3C"><td>';
        echo '<font face="Arial" size="2"><a href="login.php?redir=' . urlencode("thread.php?threadid=$tid") . '">Login to post a reply</a></font>';
        echo '</td></tr></table>';
    }
}

echo '</td></tr></table>';

// Navigation
echo '<br><table border="0" cellspacing="0" cellpadding="4" width="100%"><tr><td>';
echo '<font face="Arial" size="1">';
echo '<a href="board.php?boardid=' . $thread['board_id'] . '">&laquo; Back to ' . htmlspecialchars($thread['board']) . '</a>';
echo ' | <a href="index.php">Forum Index</a>';
if ($canMod) {
    echo ' | <a href="admin/">Admin Panel</a>';
}
echo '</font>';
echo '</td></tr></table>';

cb_footer();
