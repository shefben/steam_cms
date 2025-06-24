<?php
require_once __DIR__ . '/cms/db.php';
$page_title = 'Steam News';
include 'cms/header.php';
$db = cms_get_db();
if(isset($_GET['news'])){
    $id = (int)$_GET['news'];
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        echo '<p>Article not found.</p>';
    }else{
        $db->prepare('UPDATE news SET views=views+1 WHERE id=?')->execute([$id]);
        echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
        echo '<em>'.htmlspecialchars($row['date']).' &middot; '.htmlspecialchars($row['author']).'</em><hr>';
        echo $row['content'];
    }
}else{
    $stmt = $db->query('SELECT id,title,author,date,content FROM news ORDER BY date DESC LIMIT 8');
    foreach($stmt as $row){
        echo '<h3><a href="news.php?news='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></h3>';
        echo '<span style="font-size:9px;">'.htmlspecialchars($row['date']).' &middot; '.htmlspecialchars($row['author']).'</span><br>';
        $excerpt = strip_tags($row['content']);
        if(strlen($excerpt) > 200) $excerpt = substr($excerpt,0,200).'...';
        echo '<p>'.$excerpt.' <a href="news.php?news='.$row['id'].'">Read More</a></p>';
        echo '<hr>';
    }
}
include 'cms/footer.php';
