<?php
require_once __DIR__ . '/cms/template_engine.php';
$page_title = 'Steam News';
$content = '';
$db = cms_get_db();
$theme = cms_get_setting('theme','2004');

$content .= '<h1>STEAM NEWS</h1>';
if(isset($_GET['news']) || isset($_GET['id'])){
    $id = isset($_GET['news']) ? (int)$_GET['news'] : (int)$_GET['id'];
    $is_archive = (isset($_GET['archive']) && $_GET['archive'] === 'yes');
    $stmt = $db->prepare('SELECT * FROM news WHERE id=? AND status="published"');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $content .= '<h2>VALVE <em>NEWS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br><div class="narrower">';
    if($row){
        $db->prepare('UPDATE news SET views=views+1 WHERE id=?')->execute([$id]);
        $title = htmlspecialchars($row['title']);
        $date = htmlspecialchars($row['publish_date']);
        $author = htmlspecialchars($row['author']);
        $self_link = cms_news_url($id, $is_archive);
        $content .= "<p><h3><a href='$self_link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
        $content .= "<span style='font-size: 9px;'>$date &middot; $author<table width='100%' cellpadding='0' cellspacing='0'><tr><td height='1' width='100%' bgcolor='#808080'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
        $content .= $row['content'];
        $content .= '<div><br>&nbsp;</div><br></p>';
    }else{
        $content .= '<p>That news item could not be found in the database.</p>';
    }
    $content .= '<ul><li> <a href="index.php?area=news" style="text-decoration: none;"><i>return to news page</i></a></ul>';
    $content .= '</div>';
}else{
$content .= '<h2>LATEST <em>VALVE NEWS</em> &nbsp; <a href="/rss.xml" title="RSS format news feed"><img border="0" width="27" height="13" align="absmiddle" src="/img/RSS.gif"></a></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br><div class="narrower">';
    $content .= '{{news("full_article", 10)}}';
    $content .= '<p align="center"><a href="news_archive.php" style="text-decoration: none;"><i>view the news archives</i></a> &middot; <a href="rss.xml" style="text-decoration: none;"><i>rss news feed</i></a></p>';
    $content .= '</div>';
}
$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'content'    => $content,
    'page_title' => $page_title
]);
