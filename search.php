<?php
require_once __DIR__.'/cms/db.php';
$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];
if($query!=''){
    $db = cms_get_db();
    $like = '%'.$query.'%';
    $stmt = $db->prepare("SELECT 'news' AS type, id, title, content AS text FROM news WHERE (title LIKE ? OR content LIKE ?) AND publish_date<=NOW()");
    $stmt->execute([$like,$like]);
    $results = array_merge($results,$stmt->fetchAll(PDO::FETCH_ASSOC));
    $stmt = $db->prepare("SELECT 'faq' AS type, concat(catid1,'.',faqid1) AS id, title, body AS text FROM faq_content WHERE title LIKE ? OR body LIKE ?");
    $stmt->execute([$like,$like]);
    $results = array_merge($results,$stmt->fetchAll(PDO::FETCH_ASSOC));
    $stmt = $db->prepare("SELECT 'page' AS type, slug as id, title, content as text FROM custom_pages WHERE title LIKE ? OR content LIKE ?");
    $stmt->execute([$like,$like]);
    $results = array_merge($results,$stmt->fetchAll(PDO::FETCH_ASSOC));
}
?>
<!DOCTYPE html>
<html><head><title>Search</title></head>
<body>
<form method="get">
<input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>">
<input type="submit" value="Search">
</form>
<?php if($query!=''): ?>
<h2>Results for "<?php echo htmlspecialchars($query); ?>"</h2>
<ul>
<?php foreach($results as $r): ?>
<li><strong><?php echo htmlspecialchars($r['title']); ?></strong> (<?php echo $r['type']; ?>)<br>
<?php
$pos = stripos($r['text'],$query);
if($pos!==false){
    $snippet = substr($r['text'], max(0,$pos-40), 80);
    $snippet = str_ireplace($query,'<mark>'.$query.'</mark>',$snippet);
    echo $snippet;
}
?>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</body></html>
