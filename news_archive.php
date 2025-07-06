<?php
require_once __DIR__.'/cms/template_engine.php';
$db = cms_get_db();
$theme = cms_get_setting('theme','2004');
$rows = $db->query('SELECT id,title,publish_date FROM news ORDER BY publish_date DESC')->fetchAll(PDO::FETCH_ASSOC);
$content = '<h1>STEAM NEWS</h1>';
$content .= '<h2>ARCHIVED <em>VALVE NEWS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br>';
$content .= '<div class="narrower">';
$current = '';
foreach($rows as $row){
    $ts = strtotime($row['publish_date']);
    if(!$ts) continue;
    $month = date('F Y',$ts);
    if($month != $current){
        if($current) $content .= "</ul>\n";
        $content .= '<h3>'.htmlspecialchars($month).'</h3><ul>';
        $current = $month;
    }
    $short = date('M j, g:ia',$ts);
    $link = cms_news_url($row['id'], true);
    $content .= '<li><a href="'.$link.'" style="text-decoration: none;">'
        .htmlspecialchars($row['title']).'</a> <span style="color: #808080; font-size: 10px;">['.$short.']</span></li>';
}
$content .= $current ? "</ul>\n" : '';
$content .= '<p style="text-align:center;"><em><a href="/index.php?area=news">return to the current news</a></em></p>';
$content .= '</div>';
$tpl = cms_theme_layout('default.tpl', $theme);
cms_render_template($tpl, ['page_title'=>'Steam News', 'content'=>$content]);
