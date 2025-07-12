<?php
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/news.php';
header('Content-Type: application/rss+xml; charset=utf-8');
$db = cms_get_db();
$items = $db->query("SELECT id,title,content,publish_date FROM news WHERE publish_date<=NOW() AND status='published' ORDER BY publish_date DESC LIMIT 20")->fetchAll(PDO::FETCH_ASSOC);
$site = cms_get_setting('site_title','Steam');
$base = 'http://'.$_SERVER['HTTP_HOST'];
echo "<?xml version='1.0' encoding='UTF-8'?>\n";
echo "<rss version='2.0'><channel>";
echo "<title>".htmlspecialchars($site)." News</title>";
echo "<link>$base/index.php?area=news</link>";
echo "<description>Latest news</description>";
foreach($items as $it){
    echo "<item>";
    echo "<title>".htmlspecialchars($it['title'])."</title>";
    echo "<link>$base/".cms_news_url($it['id'])."</link>";
    echo "<pubDate>".date(DATE_RSS, strtotime($it['publish_date']))."</pubDate>";
    echo "<description>".htmlspecialchars(strip_tags($it['content']))."</description>";
    echo "</item>";
}
echo "</channel></rss>";
?>
