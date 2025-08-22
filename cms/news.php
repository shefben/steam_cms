<?php
require_once __DIR__.'/db.php';
require_once __DIR__.'/cache_manager.php';

/**
 * Cache for rendered news blocks keyed by parameters.
 * @var array<string, string>
 */
$cms_news_cache = [];

function cms_news_url($id, $archive = false){
    $id = (int)$id;
    return 'index.php?area=news' . ($archive ? '&archive=yes' : '') . '&id=' . $id;
}

function cms_get_news_settings()
{
    $def = [
        'articles_per_page' => 10,
        'partial_words'     => 120,
        'source'            => 'both',
        'date_format'       => 'long',
    ];

    return [
        'articles_per_page' => (int) cms_get_setting('news_articles_per_page', $def['articles_per_page']),
        'partial_words'     => (int) cms_get_setting('news_partial_words', $def['partial_words']),
        'source'            => cms_get_setting('news_source', $def['source']),
        'date_format'       => cms_get_setting('news_date_format', $def['date_format']),
    ];
}

function cms_save_news_settings($data){
    cms_set_setting('news_articles_per_page',$data['articles_per_page']);
    cms_set_setting('news_partial_words',$data['partial_words']);
    cms_set_setting('news_source',$data['source']);
    if(isset($data['date_format'])){
        cms_set_setting('news_date_format',$data['date_format']);
    }
}

function cms_render_news($type,$count=null){
    global $cms_news_cache;
    $settings = cms_get_news_settings();
    if($count===null) $count = $settings['articles_per_page'];

    $theme = cms_get_setting('theme','2004');
    $cache_key = $type.'|'.$count.'|'.$settings['source'].'|'.$theme;
    
    // Check memory cache first
    if (isset($cms_news_cache[$cache_key])) {
        return $cms_news_cache[$cache_key];
    }
    
    // Register source files that could affect this cache
    $cache_manager = cms_cache_manager();
    $source_files = [
        __FILE__, // news.php itself
        __DIR__ . '/db.php', // database config
    ];
    $cache_manager->registerSourceFiles($cache_key, $source_files, 'news');
    
    // Try to get from cache
    $cache_ttl = (int)cms_get_setting('news_cache_ttl', '1800');
    $html = $cache_manager->get($cache_key, 'news', $cache_ttl);
    if ($html !== null) {
        $cms_news_cache[$cache_key] = $html;
        return $html;
    }

    $db = cms_get_db();
    // MySQL/MariaDB does not allow binding parameters for the LIMIT clause in
    // some versions. Cast $count to an integer and inject it directly to avoid
    // syntax errors when executing the query.
    $limit = (int)$count;
    $publishCol = 'COALESCE(publish_at, publish_date)';
    $where = ["$publishCol<=NOW()", "(status IS NULL OR status='published')"];
    // By default, allow news from all years so newer themes without
    // corresponding yearly content still render articles.
    $year_only = cms_get_setting('news_year_only','0') === '1';
    if($year_only){
        $theme = cms_get_setting('theme','2004');
        if(preg_match('/^(\d{4})/', $theme, $m)){
            $where[] = 'YEAR(' . $publishCol . ')='.(int)$m[1];
        }
    }
    if($settings['source']==='official'){
        $where[] = 'is_official=1';
    }elseif($settings['source']==='custom'){
        $where[] = 'is_official=0';
    }
    $sql = "SELECT id,title,author,publish_date,content FROM news WHERE ".implode(' AND ',$where)." ORDER BY $publishCol DESC LIMIT $limit";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $out = '';
    foreach ($rows as $row) {
        $title  = htmlspecialchars($row['title']);
        $author = htmlspecialchars($row['author']);
        $format = cms_get_setting('news_date_format', 'long');
        if ($format === 'iso') {
            $date = date('Y-m-d H:i:s', strtotime($row['publish_date']));
        } else {
            $date = date('F j, Y, g:i a', strtotime($row['publish_date']));
        }
        $date  = htmlspecialchars($date);
        $link   = cms_news_url($row['id']);
        $content = str_replace('\\n', '', $row['content']);
        switch($type){
            case 'full_article':
                $out .= "<p><h3><a href='$link' style='text-decoration: none; color: #BFBA50;'>$title</a></h3>";
                $out .= "<span style='font-size: 9px;'>$date &middot; $author<table width='100%' cellpadding='0' cellspacing='0'><tr><td height='1' width='100%' bgcolor='#808080'></td></tr><tr><td height='10' width='100%'></td></tr></table></span>";
                // News content is stored as trusted HTML, so output it directly
                // to allow markup like links and formatting to render correctly.
                $out .= $content;
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
                $out .= "<a class='rightLink_news' href='$link'><img border='0' height='7' src='ico_arrow_yellow.gif' width='7'>$title<p>$summary</p></a>";
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
        $out .= "<p align=\"right\"><sub><a href=\"index.php?area=news\" style=\"text-decoration: none;\">read more &gt;</a></sub></p>";
    }
    if($type==='index_summary_date'){
        $out .= "<p align=\"righ\t\"><sub><a class=\"BodyGreen\" href=\"index.php?area=news\" style=\"color: Black; font-weight: bold;\">read more &gt;</a>&nbsp;</sub></p>";
    }
    // Store in new cache system
    $cache_manager->set($cache_key, $out, 'news');
    
    // Also store in memory cache
    $cms_news_cache[$cache_key] = $out;
    return $out;
}
?>
