<?php

require_once __DIR__ . '/cms/db.php';

$theme = cms_get_setting('theme', '2004');
$db    = cms_get_db();

// Determine year filter based on active theme
$year = null;
if ($theme === '2004') {
    $year = 2004;
} elseif (in_array($theme, ['2005_v1', '2005_v2'], true)) {
    $year = 2005;
}

$articleId = isset($_GET['news']) ? (int)$_GET['news'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
$newsHtml  = '';

if ($articleId > 0) {
    $where  = 'id=? AND status="published" AND publish_at<=NOW() AND products LIKE ?';
    $params = [$articleId, '%CSS%'];
    if ($year !== null) {
        $where  .= ' AND YEAR(publish_at)=?';
        $params[] = $year;
    }
    $stmt = $db->prepare("SELECT * FROM news WHERE $where");
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $db->prepare('UPDATE news SET views=views+1 WHERE id=?')->execute([$articleId]);
        $title  = htmlspecialchars($row['title']);
        $date   = htmlspecialchars($row['publish_date']);
        $author = htmlspecialchars($row['author']);
        $self   = 'productnews_CSS.php?id=' . $articleId;
        $newsHtml .= "<h3><a href='$self' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $newsHtml .= "<span style='font-size: 9px;'>$date · <a href=\"mailto:contact@valvesoftware.com\" style='text-decoration: none;'>$author</a><table cellpadding='0' cellspacing='0' width='100%'><tr><td bgcolor='#808080' height='1' width='100%'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
        $newsHtml .= $row['content'];
        $newsHtml .= '<div><br>&nbsp;</div><br>';
    } else {
        $newsHtml .= '<p>That news item could not be found.</p>';
    }
    $newsHtml .= '<ul><li><a href="productnews_CSS.php" style="text-decoration: none;"><i>return to news page</i></a></li></ul>';
} else {
    $perPage = (int)cms_get_setting('news_articles_per_page', 10);
    $page    = max(1, (int)($_GET['page'] ?? 1));
    $offset  = ($page - 1) * $perPage;

    $where  = ['status="published"', 'publish_at<=NOW()', 'products LIKE ?'];
    $params = ['%CSS%'];
    if ($year !== null) {
        $where[]  = 'YEAR(publish_at)=?';
        $params[] = $year;
    }
    $whereSql = implode(' AND ', $where);

    $countStmt = $db->prepare("SELECT COUNT(*) FROM news WHERE $whereSql");
    $countStmt->execute($params);
    $total = (int)$countStmt->fetchColumn();
    $pages = max(1, (int)ceil($total / $perPage));

    $paramsPaged = array_merge($params, [$perPage, $offset]);
    $stmt        = $db->prepare("SELECT id,title,author,publish_date,content FROM news WHERE $whereSql ORDER BY publish_at DESC LIMIT ? OFFSET ?");
    $stmt->execute($paramsPaged);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $id     = (int)$row['id'];
        $title  = htmlspecialchars($row['title']);
        $date   = htmlspecialchars($row['publish_date']);
        $author = htmlspecialchars($row['author']);
        $link   = 'productnews_CSS.php?id=' . $id;
        $newsHtml .= "<h3><a href='$link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $newsHtml .= "<span style='font-size: 9px;'>$date · <a href=\"mailto:contact@valvesoftware.com\" style='text-decoration: none;'>$author</a><table cellpadding='0' cellspacing='0' width='100%'><tr><td bgcolor='#808080' height='1' width='100%'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
        $newsHtml .= $row['content'];
        $newsHtml .= "<div><br><a href='$link'><img src='img/readmore.gif'></a></div><br><br>";
    }

    $newsHtml .= '<div class="pagination">';
    if ($page > 1) {
        $newsHtml .= '<a href="?page=' . ($page - 1) . '">&laquo; Prev</a> ';
    }
    if ($page < $pages) {
        $newsHtml .= '<a href="?page=' . ($page + 1) . '">Next &raquo;</a>';
    }
    $newsHtml .= '</div>';
}

$headerText = ($theme === '2004') ? 'BETA NEWS' : 'LATEST NEWS';
$footerHtml = cms_get_theme_footer($theme);

echo <<<HTML
<html><head>
<title>Counter-Strike™: Source™ Latest News</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<meta name="ROBOTS" content="ALL">
<meta name="DESCRIPTION" content="SteamPowered">
<meta name="KEYWORDS" content="Steam, account, account creation, signup">
<meta name="AUTHOR" content="Valve LLC">
<link rel="stylesheet" type="text/css" href="steampowered.css">
<link rel="Shortcut Icon" type="image/png" href="webicon.png">
<script language="JavaScript" src="nav.js"></script>
<link rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" href="rss.xml">
</head>
<body>
<!-- begin header -->

<!-- end header -->
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td align="center" valign="top"><br>
<table background="img/productpage/ProductBanner_CSS02.gif" border="0" cellpadding="0" cellspacing="0" height="172" width="800">
<tr height="171">
<td height="171" width="799"></td>
<td height="171" width="1"><spacer height="171" type="block" width="1"></spacer></td>
</tr>
<tr height="1">
<td height="1" width="799"><spacer height="1" type="block" width="799"></spacer></td>
<td height="1" width="1"></td>
</tr>
</table>
<table bgcolor="#3e4637" border="0" cellpadding="0" cellspacing="0" width="800">
<tr height="24">
<td colspan="3" height="24" width="799"><spacer height="24" type="block" width="799"></spacer></td>
<td height="24" width="1"><spacer height="24" type="block" width="1"></spacer></td>
</tr>
<tr>
<td width="26"><spacer height="1" type="block" width="26"></spacer></td>
<td align="left" valign="top" width="736">
<div align="left" style="line-height: 17px; width: 70%; text-align: left; margin-left: 54px;">
<span class="css_news_header">{$headerText}<br><br></span>
{$newsHtml}
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
</td>
<td width="37"><spacer type="block" width="37"></spacer></td>
<td width="1"><spacer type="block" width="1"></spacer></td>
</tr>
<tr height="1">
<td height="1" width="26"><spacer height="1" type="block" width="26"></spacer></td>
<td height="1" width="736"><spacer height="1" type="block" width="736"></spacer></td>
<td height="1" width="37"><spacer height="1" type="block" width="37"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
</tr>
</table>
</td>
</tr>
</table>
<div class="footer">
</div>
<!-- begin footer -->
<div class="footer">
<table cellpadding="0" cellspacing="0">
<tr>
<td><a href="http://www.valvesoftware.com"><img src="img/valve_greenlogo.gif"></a></td>
<td>&nbsp;</td>
<td><span class="footerfix">{$footerHtml}<a href="http://www.valvesoftware.com/privacy.htm">Privacy Policy</a>. <a href="http://www.valvesoftware.com/legal.htm">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.</span></td>
<td width="15%">&nbsp;</td>
</tr>
</table>
</div>
<!-- end footer -->

</body></html>
HTML;
