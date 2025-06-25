<?php
require_once __DIR__ . '/cms/template_engine.php';
$page_title = 'Steam News';
$content = '';
$db = cms_get_db();
if(isset($_GET['news'])){
    $id = (int)$_GET['news'];
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        $db->prepare('UPDATE news SET views=views+1 WHERE id=?')->execute([$id]);
        $content .= '<h2>'.htmlspecialchars($row['title']).'</h2>';
        $content .= '<em>'.htmlspecialchars($row['date']).' &middot; '.htmlspecialchars($row['author']).'</em><hr>';
        $content .= $row['content'];
    }else{
        $content .= '<p>Article not found.</p>';
    }
}else{
    $content = '{news_full_article}';
}
cms_render_template(__DIR__.'/themes/2004/default_template.php',['content'=>$content,'page_title'=>$page_title]);
