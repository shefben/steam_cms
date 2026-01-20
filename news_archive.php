<?php
require_once __DIR__.'/cms/template_engine.php';
$db = cms_get_db();
$theme = cms_get_setting('theme','2004');

// Determine which themes use sidebar layout (2006+ style)
$sidebar_themes = ['2006_v1', '2006_v2', '2007_v1', '2007_v2', '2008'];
$use_sidebar = in_array($theme, $sidebar_themes, true);

// Build WHERE clause with same date filtering logic as cms_render_news()
$publishCol = 'COALESCE(publish_at, publish_date)';
$where = ["(status IS NULL OR status='published' OR status='final')"];

// Filter news by date based on CDR date limit setting
$cdr_date_limit = cms_get_setting('news_cdr_date_limit','0') === '1';
if($cdr_date_limit){
    // When enabled: show news up to and including CDRDATE
    $cdr_date = cms_get_setting('CDRDATE','');
    if($cdr_date !== ''){
        // CDRDATE is in m/d/Y format, convert to Unix timestamp for comparison
        $parsed_date = DateTime::createFromFormat('m/d/Y', $cdr_date);
        if($parsed_date){
            $parsed_date->setTime(23, 59, 59);
            $unix_timestamp = $parsed_date->getTimestamp();
            $where[] = "$publishCol <= $unix_timestamp";
        }
    }
} else {
    // When disabled: show news up to and including December 31st of theme's year
    if(preg_match('/^(\d{4})/', $theme, $m)){
        $theme_year = (int)$m[1];
        $end_of_year = mktime(23, 59, 59, 12, 31, $theme_year);
        $where[] = "$publishCol <= $end_of_year";
    }
}

$sql = "SELECT id,title,publish_date FROM news WHERE ".implode(' AND ',$where)." ORDER BY $publishCol DESC";
$rows = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if ($use_sidebar) {
    // 2006+ format: sidebar layout with <h1> month headers and <p> article lists
    $content = '';
    $current = '';

    foreach($rows as $row){
        $ts = is_numeric($row['publish_date']) ? (int)$row['publish_date'] : strtotime($row['publish_date']);
        if(!$ts) continue;
        $month = date('F Y', $ts);
        if($month != $current){
            if($current) $content .= "</p>\n";
            $content .= '<h1>'.htmlspecialchars($month).'</h1>'."\n\n".'<p>';
            $current = $month;
        }
        // Format: [Mon j, g:i a] with space before AM/PM
        $short = date('M j, g:i a', $ts);
        $link = cms_news_url($row['id'], true);
        $title = strtolower(htmlspecialchars($row['title']));
        $content .= '<a href="'.$link.'">'. $title .'</a> ['.$short.']<br>'."\n";
    }
    if($current) $content .= "</p>\n";

    $tpl = cms_theme_layout('news_archive.twig', $theme);
    if (!$tpl || !cms_file_exists($tpl)) {
        $tpl = cms_theme_layout('default_with_sidebar.twig', $theme);
    }
    cms_render_template($tpl, [
        'page_title' => 'Steam News Archive',
        'content' => $content,
        'archive_content' => $content
    ]);
} else {
    // 2003-2005 format: narrower layout with <h3> month headers and <ul><li> article lists
    $content = '<h1>STEAM NEWS</h1>';
    $content .= '<h2>ARCHIVED <em>VALVE NEWS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br>';
    $content .= '<div class="narrower">';

    $current = '';
    foreach($rows as $row){
        $ts = is_numeric($row['publish_date']) ? (int)$row['publish_date'] : strtotime($row['publish_date']);
        if(!$ts) continue;
        $month = date('F Y', $ts);
        if($month != $current){
            if($current) $content .= "</ul>";
            $content .= '<h3>'.htmlspecialchars($month).'</h3><ul>';
            $current = $month;
        }
        // Format: [Mon j, g:ia] without space before AM/PM
        $short = date('M j, g:ia', $ts);
        $link = cms_news_url($row['id'], true);
        $content .= '<li> <a href="'.$link.'" style="text-decoration: none;">'
            .htmlspecialchars($row['title']).'</a> <span style="color: #808080; font-size: 10px;">['.$short.']</span><br></li>';
    }
    $content .= $current ? "</ul>\n" : '';
    $content .= '<p align="center"><br><a href="index.php?area=news" style="text-decoration: none;"><i>return to the current news</i></a></p>';
    $content .= '</div>';

    $tpl = cms_theme_layout('default.twig', $theme);
    cms_render_template($tpl, ['page_title'=>'Steam News', 'content'=>$content]);
}
