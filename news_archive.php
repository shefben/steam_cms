<?php
require_once __DIR__.'/cms/template_engine.php';
$db = cms_get_db();
$rows = $db->query('SELECT id,title,date FROM news ORDER BY date DESC')->fetchAll(PDO::FETCH_ASSOC);
$content = '<h1>STEAM NEWS</h1>';
$content .= '<h2>ARCHIVED <em>VALVE NEWS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br>';
$content .= '<div class="narrower">';
$current = '';
foreach($rows as $row){
    $ts = strtotime($row['date']);
    if(!$ts) continue;
    $month = date('F Y',$ts);
    if($month != $current){
        if($current) $content .= "</ul>\n";
        $content .= '<h3>'.htmlspecialchars($month).'</h3><ul>';
        $current = $month;
    }
    $short = date('M j, g:ia',$ts);
    $content .= '<li><a href="news.php?news='.$row['id'].'" style="text-decoration: none;">'
        .htmlspecialchars($row['title']).'</a> <span style="color: #808080; font-size: 10px;">['.$short.']</span></li>';
}
if($current) $content .= "</ul>\n";
$content .= '<p align="center"><br><a href="news.php" style="text-decoration: none;"><i>return to the current news</i></a></p>';
$content .= '</div>';
cms_render_template(__DIR__.'/themes/2004/default_template.php',[ 'page_title'=>'Steam News', 'content'=>$content]);
