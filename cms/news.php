<?php
require_once __DIR__.'/db.php';

function cms_get_news_settings(){
    $def=['articles_per_page'=>8,'partial_words'=>120];
    return [
        'articles_per_page'=>(int)cms_get_setting('news_articles_per_page',$def['articles_per_page']),
        'partial_words'=>(int)cms_get_setting('news_partial_words',$def['partial_words'])
    ];
}

function cms_save_news_settings($data){
    cms_set_setting('news_articles_per_page',$data['articles_per_page']);
    cms_set_setting('news_partial_words',$data['partial_words']);
}

function cms_render_news($type,$count=null){
    $settings = cms_get_news_settings();
    if($count===null) $count = $settings['articles_per_page'];
    $db = cms_get_db();
    // MySQL/MariaDB does not allow binding parameters for the LIMIT clause in
    // some versions. Cast $count to an integer and inject it directly to avoid
    // syntax errors when executing the query.
    $limit = (int)$count;
    $stmt = $db->prepare("SELECT id,title,author,publish_date,content FROM news "
        . "WHERE publish_date<=NOW() ORDER BY publish_date DESC LIMIT $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $out = '';
    foreach($rows as $row){
        $title = htmlspecialchars($row['title']);
        $author = htmlspecialchars($row['author']);
        $date = htmlspecialchars($row['publish_date']);
        $link = "news.php?news={$row['id']}";
        $content = $row['content'];
        switch($type){
            case 'full_article':
                $out .= "<div class='news-full'>";
                $out .= "<h3><a href='$link'>$title</a></h3>";
                $out .= "<span class='meta'>$date &middot; $author</span>";
                $out .= $content;
                $out .= "</div>";
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
        }
    }
    return $out;
}
?>
