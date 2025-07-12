<?php
require_once __DIR__.'/db.php';

function cms_news_url($id, $archive = false){
    $id = (int)$id;
    return '{{ BASE }}/index.php?area=news' . ($archive ? '&archive=yes' : '') . '&id=' . $id;
}

function cms_get_news_settings(){
    $def=['articles_per_page'=>10,'partial_words'=>120,'source'=>'both'];
    return [
        'articles_per_page'=>(int)cms_get_setting('news_articles_per_page',$def['articles_per_page']),
        'partial_words'=>(int)cms_get_setting('news_partial_words',$def['partial_words']),
        'source'=>cms_get_setting('news_source',$def['source'])
    ];
}

function cms_save_news_settings($data){
    cms_set_setting('news_articles_per_page',$data['articles_per_page']);
    cms_set_setting('news_partial_words',$data['partial_words']);
    cms_set_setting('news_source',$data['source']);
}

function cms_render_news($type,$count=null){
    $settings = cms_get_news_settings();
    if($count===null) $count = $settings['articles_per_page'];
    $db = cms_get_db();
    // MySQL/MariaDB does not allow binding parameters for the LIMIT clause in
    // some versions. Cast $count to an integer and inject it directly to avoid
    // syntax errors when executing the query.
    $limit = (int)$count;
    $where = ['publish_date<=NOW()','status="published"'];
    $year_only = cms_get_setting('news_year_only','1') === '1';
    if($year_only){
        $theme = cms_get_setting('theme','2004');
        if(preg_match('/^(\d{4})/', $theme, $m)){
            $where[] = 'YEAR(publish_date)='.(int)$m[1];
        }
    }
    if($settings['source']==='official'){
        $where[] = 'is_official=1';
    }elseif($settings['source']==='custom'){
        $where[] = 'is_official=0';
    }
    $sql = "SELECT id,title,author,publish_date,content FROM news WHERE ".implode(' AND ',$where)." ORDER BY publish_date DESC LIMIT $limit";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $out = '';
    foreach($rows as $row){
        $title = htmlspecialchars($row['title']);
        $author = htmlspecialchars($row['author']);
        $date = htmlspecialchars($row['publish_date']);
        $link = cms_news_url($row['id']);
        $content = $row['content'];
        switch($type){
            case 'full_article':
                $break = 230;
                $plain = strip_tags($content);
                if(strlen($plain) > $break){
                    $pos = strrpos(substr($plain, 0, $break), ' ');
                    if($pos === false) $pos = $break;
                    $first = htmlspecialchars(substr($plain, 0, $pos), ENT_QUOTES, 'UTF-8');
                    $rest  = htmlspecialchars(substr($plain, $pos + 1), ENT_QUOTES, 'UTF-8');
                    $formatted = $first . '<br>' . $rest;
                }else{
                    $formatted = htmlspecialchars($plain, ENT_QUOTES, 'UTF-8');
                }
                $out .= "<p><h3><a href='$link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
                $out .= "<span style='font-size: 9px;'>$date &middot; $author<table width='100%' cellpadding='0' cellspacing='0'><tr><td height='1' width='100%' bgcolor='#808080'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
                $out .= $formatted;
                $out .= "<div><br>&nbsp;</div><br></p>";
                break;
            case 'partial_article':
                $limit = $settings['partial_words'];
                $words = preg_split('/\s+/', strip_tags($content));
                if(count($words) > $limit){
                    $excerpt = implode(' ', array_slice($words,0,$limit)).'...';
                }else{
                    $excerpt = implode(' ', $words);
                }
                $out .= "<div class='news-partial'>";
                $out .= "<h3><a href='$link'>$title</a></h3>";
                $out .= "<span class='meta'>$date &middot; $author</span>";
                $out .= "<p>$excerpt<br><a href='$link'>Continue Reading Article</a></p>";
                $out .= "</div>";
                break;
            case 'small_abstract':
                $excerpt = strip_tags($content);
                $excerpt = implode(' ', array_slice(preg_split('/\s+/', $excerpt),0,30));
                $out .= "<div class='news-small'>";
                $out .= "<h4><a href='$link'>$title</a></h4>";
                $out .= "<p>$excerpt</p>";
                $out .= "</div>";
                break;
            case 'link_only':
                $out .= "<a href='$link'>$title</a><br>";
                break;
            case 'index_summary':
                $text = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
                if(preg_match('/^(.+?[.!?])\s/', $text, $m)){
                    $summary = $m[1];
                }else{
                    $words = preg_split('/\s+/', $text);
                    $summary = implode(' ', array_slice($words, 0, 30));
                }
                $out .= "<strong><a href='$link' style='text-decoration: none;'>$title</a></strong><br>$summary<br><br>";
                break;
            case 'index_summary_date':
                $text = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
                if(preg_match('/^(.+?[.!?])\s/', $text, $m)){
                    $summary = $m[1];
                }else{
                    $words = preg_split('/\s+/', $text);
                    $summary = implode(' ', array_slice($words, 0, 30));
                }
                $date_fmt = date('m/d/y', strtotime($row['publish_date']));
                $out .= "<strong><a href='$link' style='text-decoration: none;'>$title</a></strong><br>($date_fmt)<br>$summary<br><br>";
                break;
            case 'index_bodygreen':
                $text = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
                if(preg_match('/^(.+?[.!?])\s/', $text, $m)){
                    $summary = $m[1];
                }else{
                    $words = preg_split('/\s+/', $text);
                    $summary = implode(' ', array_slice($words, 0, 30));
                }
                $date_fmt = date('m/d/y', strtotime($row['publish_date']));
                $out .= "<a class=\"BodyGreen\" href='$link' style='color: Black; font-weight: bold;'>$title</a><br>";
                $out .= "<sup class=\"BODYGreen\"><i>($date_fmt)</i></sup><br>";
                $out .= "<span class=\"BODYGreen\">$summary<br></span><br>";
                break;
            case 'index_2006':
                $text = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
                if(preg_match('/^(.+?[.!?])\s/', $text, $m)){
                    $summary = $m[1];
                }else{
                    $words = preg_split('/\s+/', $text);
                    $summary = implode(' ', array_slice($words, 0, 30));
                }
                $out .= "<a class='rightLink_news' href='$link'><img border='0' height='7' src='{{ BASE }}/themes/2006_v1/images/ico_arrow_yellow.gif' width='7'>$title<p>$summary</p></a>";
                break;
            case 'index_brief':
                $text = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
                $words = preg_split('/\s+/', $text);
                $words = array_slice($words, 0, 16);
                if(count($words) > 8){
                    array_splice($words, 8, 0, '<br>');
                }
                $summary = implode(' ', $words);
                $summary = str_replace(' <br>', '<br>', $summary);
                $out .= "<strong><a href='$link' style='text-decoration: none;'>$title</a></strong><br>$summary<br><br>";
                break;
        }
    }
    if($type==='index_brief'){
        $out .= "<p align=\"right\"><sub><a href=\"{{ BASE }}/index.php?area=news\" style=\"text-decoration: none;\">read more &gt;</a></sub></p>";
    }
    if($type==='index_summary_date'){
        $out .= "<p align=\"righ\t\"><sub><a class=\"BodyGreen\" href=\"{{ BASE }}/index.php?area=news\" style=\"color: Black; font-weight: bold;\">read more &gt;</a>&nbsp;</sub></p>";
    }
    return $out;
}
?>
