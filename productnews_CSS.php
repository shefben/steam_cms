<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';

$theme = cms_get_setting('theme','2004');
$page_title = 'Counter-Strike: Source News';
$db = cms_get_db();

// Determine year filter based on active theme
$year = null;
if ($theme === '2004') {
    $year = 2004;
} elseif (in_array($theme, ['2005_v1','2005_v2'], true)) {
    $year = 2005;
}

$content = '<h1>COUNTER-STRIKE: SOURCE NEWS</h1>';

$articleId = isset($_GET['news']) ? (int)$_GET['news'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
if ($articleId > 0) {
    // Show single article if it matches product and year filters
    $where = 'id=? AND status="published" AND publish_at<=NOW() AND products LIKE ?';
    $params = [$articleId, '%CSS%'];
    if ($year !== null) {
        $where .= ' AND YEAR(publish_at)=?';
        $params[] = $year;
    }
    $stmt = $db->prepare("SELECT * FROM news WHERE $where");
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $content .= '<div class="narrower">';
    if ($row) {
        $db->prepare('UPDATE news SET views=views+1 WHERE id=?')->execute([$articleId]);
        $title = htmlspecialchars($row['title']);
        $date = htmlspecialchars($row['publish_date']);
        $author = htmlspecialchars($row['author']);
        $self_link = 'productnews_CSS.php?id='.$articleId;
        $content .= "<p><h3><a href='$self_link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $content .= "<span style='font-size: 9px;'>$date &middot; $author<table width='100%' cellpadding='0' cellspacing='0'><tr><td width='100%' height='1' bgcolor='#808080'></td></tr><tr><td width='100%' height='10'></td></tr></table></span>";
        $content .= $row['content'];
        $content .= '<div><br>&nbsp;</div><br></p>';
    } else {
        $content .= '<p>That news item could not be found.</p>';
    }
    $content .= '<ul><li><a href="productnews_CSS.php" style="text-decoration: none;"><i>return to news page</i></a></ul>';
    $content .= '</div>';
} else {
    // Paginated listing of product news
    $perPage = (int)cms_get_setting('news_articles_per_page', 10);
    $page = max(1, (int)($_GET['page'] ?? 1));
    $offset = ($page - 1) * $perPage;

    $where = ['status="published"', 'publish_at<=NOW()', 'products LIKE ?'];
    $params = ['%CSS%'];
    if ($year !== null) {
        $where[] = 'YEAR(publish_at)=?';
        $params[] = $year;
    }
    $whereSql = implode(' AND ', $where);

    $countStmt = $db->prepare("SELECT COUNT(*) FROM news WHERE $whereSql");
    $countStmt->execute($params);
    $total = (int)$countStmt->fetchColumn();
    $pages = max(1, (int)ceil($total / $perPage));

    $paramsPaged = array_merge($params, [$perPage, $offset]);
    $stmt = $db->prepare("SELECT id,title,author,publish_date,content FROM news WHERE $whereSql ORDER BY publish_at DESC LIMIT ? OFFSET ?");
    $stmt->execute($paramsPaged);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $content .= '<div class="narrower">';
    foreach ($rows as $row) {
        $id = (int)$row['id'];
        $title = htmlspecialchars($row['title']);
        $date = htmlspecialchars($row['publish_date']);
        $author = htmlspecialchars($row['author']);
        $link = 'productnews_CSS.php?id=' . $id;
        $content .= "<p><h3><a href='$link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $content .= "<span style='font-size: 9px;'>$date &middot; $author<table width='100%' cellpadding='0' cellspacing='0'><tr><td width='100%' height='1' bgcolor='#808080'></td></tr><tr><td width='100%' height='10'></td></tr></table></span>";
        $content .= $row['content'];
        $content .= '<div><br>&nbsp;</div><br></p>';
    }

    // Pagination links
    $content .= '<div class="pagination">';
    if ($page > 1) {
        $content .= '<a href="?page=' . ($page - 1) . '">&laquo; Prev</a> ';
    }
    if ($page < $pages) {
        $content .= '<a href="?page=' . ($page + 1) . '">Next &raquo;</a>';
    }
    $content .= '</div>';
    $content .= '</div>';
}

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
]);
