<?php
/*  search.php – pixel-perfect clone of Steam Support “Search Board” page               */
/*  Requires:  includes/bootstrap.php  (for session, DB, header/footer helpers)         */

require_once __DIR__.'/includes/bootstrap.php';

/* ────────── parameters ────────── */
$boardId = (int)($_GET['boardid'] ?? 0);

/* current board (or die) */
$stmt = cb_db()->prepare('SELECT * FROM boards WHERE id=?');
$stmt->execute([$boardId]);
$board = $stmt->fetch(PDO::FETCH_ASSOC) or die('Board not found');

/* all boards for <select name="which"> */
$boards = cb_db()->query('SELECT id,name FROM boards ORDER BY ordering,name')
                 ->fetchAll(PDO::FETCH_ASSOC);

/* ────────── form defaults ────────── */
$in      = $_POST['search']  ?? '';
$how     = $_POST['how']     ?? 'phrase';           // phrase | all | any
$which   = $_POST['which']   ?? $boardId;           // all | boardId
$where   = $_POST['where']   ?? 'both';             // subject | message | both
$poster  = $_POST['poster']  ?? '';
$within  = isset($_POST['within']);
$days    = (int)($_POST['days'] ?? 2);

/* ────────── execute search if posted ────────── */
$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql  = 'SELECT t.id thread_id, t.subject, p.created, u.username
             FROM posts p
             JOIN threads t ON t.id = p.thread_id
             LEFT JOIN users u ON u.id = p.user_id ';
    $w    = [];
    $args = [];

    /* which boards */
    if ($which !== 'all') {
        $sql .= 'WHERE t.board_id = ? ';
        $args[] = $which;
    } else {
        $sql .= 'WHERE 1 ';
    }

    /* search for */
    if ($in !== '') {
        $col = ($where === 'subject' ? 't.subject' :
               ($where === 'message' ? 'p.message' : 'CONCAT_WS(\' \',t.subject,p.message)'));

        if ($how === 'phrase') {
            $w[]  = "$col LIKE ?";
            $args[] = '%'.$in.'%';
        } else {
            $words = preg_split('/\s+/', trim($in));
            $sub   = [];
            foreach ($words as $wrd) {
                $sub[] = "$col LIKE ?";
                $args[] = '%'.$wrd.'%';
            }
            $w[] = '(' . implode($how === 'all' ? ' AND ' : ' OR ', $sub) . ')';
        }
    }

    /* posted by */
    if ($poster !== '') {
        $w[]  = 'u.username = ?';
        $args[] = $poster;
    }

    /* only posts within … days */
    if ($within) {
        $w[]  = 'p.created >= DATE_SUB(NOW(), INTERVAL ? DAY)';
        $args[] = $days;
    }

    $sql .= ($w ? ' AND ' . implode(' AND ', $w) : '') . ' ORDER BY p.created DESC LIMIT 250';

    $stmt = cb_db()->prepare($sql);
    $stmt->execute($args);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ────────── OUTPUT ────────── */
cb_header('Search Board – '.$board['name']);
?>
<!-- identical wrapper + colours from search.html -->
<table align="center" bgcolor="#626D5C" border="0" cellpadding="5" cellspacing="0" width="798">
<tr valign="top">
  <td bgcolor="#4c5844" width="100%">
    <div align="center">
      <table width="100%" border="0" cellspacing="0">
        <tr><td>
          <p align="right">
            <a href="board.php?boardid=<?=$boardId?>">
              <img src="images/buttons/grey/returntoboard.gif" width="88" height="19" border="0">
            </a>
          </p>
          <p align="left">
            <b><font face="Arial" size="5" color="#FFFFFF">Search Board</font></b><br>
            <font face="Arial" size="2">
              You can search through this board for messages containing specific text,
              from specific people, and within specific timeframes.<br>
              Please enter each of your selected criteria in the boxes below and click search.
            </font>
          </p>

<!--  SEARCH FORM  -->
<center>
<form action="search.php?boardid=<?=$boardId?>" method="POST">
<table width="100%" border="0" cellspacing="0">
  <!-- SEARCH FOR -->
  <tr>
    <td width="20%"><font face="Arial" size="2">Search for</font></td>
    <td width="80%">
      <input type="text"   name="search" size="20" value="<?=htmlspecialchars($in)?>">
      <select name="how" size="1">
        <option value="phrase"<?=$how==='phrase'?' selected':''?>>Phrase</option>
        <option value="all"<?=$how==='all'?' selected':''?>>All Words</option>
        <option value="any"<?=$how==='any'?' selected':''?>>Any Word</option>
      </select>
    </td>
  </tr>

  <!-- SEARCH ON -->
  <tr>
    <td width="20%"><font face="Arial" size="2">Search on</font></td>
    <td width="80%">
      <select name="which" size="1">
        <option value="all"<?=$which==='all'?' selected':''?>>All Boards Belonging to this User</option>
        <?php foreach ($boards as $b): ?>
          <option value="<?=$b['id']?>"<?=$which==$b['id']?' selected':''?>><?=htmlspecialchars($b['name'])?></option>
        <?php endforeach; ?>
      </select>
    </td>
  </tr>

  <!-- SEARCH IN -->
  <tr>
    <td width="20%"><font face="Arial" size="2">Search in</font></td>
    <td width="80%">
      <select name="where" size="1">
        <option value="subject"<?=$where==='subject'?' selected':''?>>Subject Only</option>
        <option value="message"<?=$where==='message'?' selected':''?>>Message Text Only</option>
        <option value="both"<?=$where==='both'?' selected':''?>>Subject and Message Text</option>
      </select>
    </td>
  </tr>

  <!-- POSTED BY -->
  <tr>
    <td width="20%"><font face="Arial" size="2">Posted by</font></td>
    <td width="80%"><input type="text" name="poster" size="20" value="<?=htmlspecialchars($poster)?>"></td>
  </tr>

  <!-- ONLY POSTS ... -->
  <tr>
    <td width="20%"><font face="Arial" size="2">Only posts... </font></td>
    <td width="80%">
      <font face="Arial" size="2">
        <input type="checkbox" name="within" value="ON" <?=$within?'checked':''?>>
        Posted within the last
        <select name="days" size="1">
          <?php foreach ([2,3,5,7,14,21,30] as $d): ?>
            <option value="<?=$d?>"<?=$days==$d?' selected':''?>><?=$d?></option>
          <?php endforeach; ?>
        </select> days
      </font>
    </td>
  </tr>
</table>

<p align="center"><input type="submit" value="Search"></p>
<input type="hidden" name="action"  value="search">
<input type="hidden" name="boardid" value="<?=$boardId?>">
</form>
</center>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<hr size="1" color="#424b3c">
<font face="Arial" size="2"><b>Results:</b></font><br>
<?php if ($results): ?>
<table width="100%" border="0" cellspacing="0">
  <tr bgcolor="#424b3c">
    <th><font face="Arial" size="2" color="#EBEDEA">Subject</font></th>
    <th><font face="Arial" size="2" color="#EBEDEA">Author</font></th>
    <th><font face="Arial" size="2" color="#EBEDEA">Date</font></th>
  </tr>
  <?php $alt=false; foreach ($results as $r): ?>
  <tr bgcolor="<?=cb_zebra($alt)?>">
    <td><font face="Arial" size="2"><a href="thread.php?threadid=<?=$r['thread_id']?>"><?=htmlspecialchars($r['subject'])?></a></font></td>
    <td><font face="Arial" size="2"><?=htmlspecialchars($r['username']??'Guest')?></font></td>
    <td><font face="Arial" size="2"><?=cb_fmt($r['created'])?></font></td>
  </tr>
  <?php $alt=!$alt; endforeach; ?>
</table>
<?php else: ?>
<font face="Arial" size="2">No matches found.</font>
<?php endif; ?>
<?php endif; /* POST */ ?>

        </td></tr>
      </table>
    </div>
  </td>
</tr>
</table>

<?php cb_footer(); ?>
