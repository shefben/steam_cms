<?php $page_title = 'Support'; include 'cms/header.php'; ?>
<!-- support -->
<div class="content" id="container">
<h1>FREQUENTLY ASKED QUESTIONS</h1>
<h2>QUESTIONS, <em>ANSWERS, TROUBLESHOOTING...</em></h2><img src="img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
<?php
$db = cms_get_db();
$cats = $db->query('SELECT * FROM faq_categories WHERE hidden=0 ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$cat_order = cms_get_setting('faq_cat_order','');
$cat_order = $cat_order !== '' ? explode(',', $cat_order) : [];
usort($cats,function($a,$b) use($cat_order){
    $ia = array_search($a['id1'].','.$a['id2'],$cat_order);
    $ib = array_search($b['id1'].','.$b['id2'],$cat_order);
    if($ia===false) $ia = PHP_INT_MAX;
    if($ib===false) $ib = PHP_INT_MAX;
    return $ia <=> $ib;
});
$faqs = $db->query('SELECT * FROM faq_content ORDER BY title')->fetchAll(PDO::FETCH_ASSOC);
$bycat = [];
foreach($faqs as $f){
    $bycat[$f['catid1'].','.$f['catid2']][] = $f;
}
$threshold = 50;
foreach($cats as $c){
    echo '<h3><a href="index.php?area=faq&section='.urlencode($c['name']).'" style="color:#BFBA50;font-family:trebuchet ms,arial narrow,helvetica narrow,verdana,tahoma,helvetica;font-size:14px;font-weight:bold;line-height:18px;margin:0;padding:0;letter-spacing:0.1em;text-decoration: none;">'.htmlspecialchars(strtoupper($c['name'])).'</a></h3>';
    echo '<ul>';
    $key = $c['id1'].','.$c['id2'];
    if(isset($bycat[$key])){
        foreach($bycat[$key] as $f){
            $id = $c['id1'].','.$c['id2'].','.$f['faqid1'].','.$f['faqid2'];
            $icon = ($f['views'] >= $threshold) ? '/img/yellowSquare.gif' : '/img/square2.gif';
            echo '<li style="list-style-image:url('.$icon.');"> <a href="index.php?area=faq&id='.$id.'">'.htmlspecialchars($f['title'])."</a></li>";
        }
    }
    echo '</ul>';
}
?>
</div>
</div>
<?php include 'cms/footer.php'; ?>
