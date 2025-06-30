<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';

$page_title = 'FAQ';
$content = '<h1>FREQUENTLY ASKED QUESTIONS</h1>';
$content .= '<h2>QUESTIONS, <em>ANSWERS, TROUBLESHOOTING...</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br><div class="narrower">';

if(!isset($_GET['id'])){
    header('Location: faq.php');
    exit;
}
$parts = array_map('intval', explode(',', $_GET['id']));
if(count($parts) !== 4){
    header('Location: faq.php');
    exit;
}
list($cat1,$cat2,$faq1,$faq2) = $parts;
$db = cms_get_db();
$stmt = $db->prepare('SELECT f.*,c.name as catname FROM faq_content f JOIN faq_categories c ON c.id1=f.catid1 AND c.id2=f.catid2 WHERE f.faqid1=? AND f.faqid2=?');
$stmt->execute([$faq1,$faq2]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row){
    $db->prepare('UPDATE faq_content SET views=views+1 WHERE faqid1=? AND faqid2=?')->execute([$faq1,$faq2]);
    $content .= '<h3>'.htmlspecialchars($row['catname'])."</h3>";
    $content .= '<ul><li><em>'.htmlspecialchars($row['title'])."</em></li></ul>";
    $content .= $row['body'];
    $content .= '<ul><li><a href="faq.php">Return to  FAQ</a></li></ul>';
}else{
    $content .= '<p>FAQ not found.</p><ul><li><a href="faq.php">Return to FAQ</a></li></ul>';
}
$content .= '</div>';

cms_render_template(__DIR__.'/themes/2004/default_template.php', [
    'page_title'=>$page_title,
    'content'=>$content
]);
