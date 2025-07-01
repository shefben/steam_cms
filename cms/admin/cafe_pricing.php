<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');

$slug = 'cafe_pricing';
$db = cms_get_db();

if(isset($_POST['save_page'])){
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    $exists = $db->prepare('SELECT slug FROM custom_pages WHERE slug=?');
    $exists->execute([$slug]);
    if($exists->fetchColumn()){
        $stmt = $db->prepare('UPDATE custom_pages SET title=?,content=?,updated=NOW() WHERE slug=?');
        $stmt->execute([$title,$content,$slug]);
    }else{
        $stmt = $db->prepare('INSERT INTO custom_pages(slug,title,content,created,updated) VALUES(?,?,?,?,NOW())');
        $stmt->execute([$slug,$title,$content,date('Y-m-d H:i:s')]);
    }
    $msg = 'Page saved.';
}

$page = cms_get_custom_page($slug);
$title = $page['title'] ?? 'Cyber Café Pricing and Licensing';
$content = $page['content'] ?? '';
?>
<h2>Cafe Pricing</h2>
<?php if(isset($msg)) echo '<p>'.htmlspecialchars($msg).'</p>'; ?>
<form method="post">
Title:<br>
<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" style="width:100%;"><br><br>
<textarea id="content" name="content" style="width:100%;height:400px;"><?php echo htmlspecialchars($content); ?></textarea><br>
<input type="submit" name="save_page" value="Save">
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
</script>
<?php include 'admin_footer.php'; ?>
