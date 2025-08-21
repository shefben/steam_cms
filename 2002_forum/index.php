<?php
require_once 'includes/template.php';
require_once 'includes/db.php';          // your PDO helper
require_once __DIR__.'/includes/bootstrap.php';
cb_header();

/* pull boards */
$boards = cb_db()->query('SELECT id,name,description FROM boards ORDER BY ordering,name')
                 ->fetchAll(PDO::FETCH_ASSOC);

echo '<table border="5" cellpadding="0" cellspacing="0" width="100%" bordercolor="#4C5844"><tr><td>';
/* ---------- board header row ---------- */
echo '
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="padding:0" bgcolor="#424B3C" width="50%">
      <p style="margin:0" align="left"><font face="Arial" size="2" color="#EBEDEA"><b>Name</b></font></p>
    </td>
    <td style="padding:0" bgcolor="#424B3C" width="15%">
      <p style="margin:0" align="center"><font face="Arial" size="2" color="#EBEDEA"><b>Topics</b></font></p>
    </td>
    <td style="padding:0" bgcolor="#424B3C" width="15%">
      <p style="margin:0" align="center"><font face="Arial" size="2" color="#EBEDEA"><b>Posts</b></font></p>
    </td>
    <td style="padding:0" bgcolor="#424B3C" width="20%">
      <p style="margin:0" align="left"><font face="Arial" size="2" color="#EBEDEA"><b>Updated</b></font></p>
    </td>
  </tr>
</table>';



/* ---------- each board row ---------- */
$alt = false;
foreach ($boards as $b) {
    /* pull stats */
    $stats = cb_db()->prepare(
      'SELECT (SELECT COUNT(*) FROM threads WHERE board_id=?), 
              (SELECT COUNT(*) FROM posts p JOIN threads t ON p.thread_id=t.id WHERE t.board_id=?),
              (SELECT MAX(p.created) FROM posts p JOIN threads t ON p.thread_id=t.id WHERE t.board_id=?)'
    );
    $stats->execute([$b['id'],$b['id'],$b['id']]);
    [$topics,$posts,$last] = $stats->fetch(PDO::FETCH_NUM);

echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>',
     '<td style="padding:0" bgcolor="',cb_zebra($alt),'" width="50%">',
       '<p style="margin:0"><font face="Arial" size="2"><b>',
       '<a href="board.php?boardid=',$b['id'],'">',htmlspecialchars($b['name']),'</a></b><br>',
       htmlspecialchars($b['description']),'</font></p></td>',

     '<td style="padding:0" bgcolor="',cb_zebra($alt),'" width="15%" align="center">',
       '<font face="Arial" size="2">',$topics,'</font></td>',

     '<td style="padding:0" bgcolor="',cb_zebra($alt),'" width="15%" align="center">',
       '<font face="Arial" size="2">',$posts,'</font></td>',

     '<td style="padding:0" bgcolor="',cb_zebra($alt),'" width="20%">',
       '<p style="margin:0"><font face="Arial" size="2">',
       ($last ? cb_fmt($last) : '&ndash;'),
       '<br><font size="1">Last Visit: ',
       ($_SESSION["last_visit_$b[id]"] ?? "Never"),
       '</font></font></p></td></tr></table>';


    $alt = !$alt;  $_SESSION["last_visit_$b[id]"] = date('Y-m-d H:i:s');
}
echo '</td></tr></table>';

echo '</table>';

cb_footer();
?>
