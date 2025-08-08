<?php

require_once __DIR__ . '/cms/db.php';

$theme = cms_get_setting('theme', '2004');
$db    = cms_get_db();
$base  = cms_base_url();

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
        $self   = 'productnews.php?id=' . $articleId;
        $newsHtml .= "<h3><a href='$self' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $newsHtml .= "<span style='font-size: 9px;'>$date · <a href=\"mailto:contact@valvesoftware.com\" style='text-decoration: none;'>$author</a><table cellpadding='0' cellspacing='0' width='100%'><tr><td bgcolor='#808080' height='1' width='100%'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
        $newsHtml .= $row['content'];
        $newsHtml .= '<div><br>&nbsp;</div><br>';
    } else {
        $newsHtml .= '<p>That news item could not be found.</p>';
    }
    $newsHtml .= '<ul><li><a href="productnews.php" style="text-decoration: none;"><i>return to news page</i></a></li></ul>';
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
        $link   = 'productnews.php?id=' . $id;
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
$content = "<span class=\"css_news_header\">{$headerText}<br><br></span>{$newsHtml}";
$tpl = cms_theme_layout('productpage.twig', $theme);
$bannerPath = ($base ? rtrim($base, '/').'/' : '/').'Images/productpage/ProductBanner_CSS02.gif';
cms_render_template($tpl, [
    'content' => $content,
    'banner'  => $bannerPath
]);
