<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$theme = cms_get_setting('theme','2004');
$slug_clean = str_replace('_','',$theme).'_index';
$slug_legacy = $theme.'_index';
$db = cms_get_db();
$msg = '';
$slug = $slug_clean;
if(isset($_POST['save_page'])){
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    $stmt = $db->prepare('SELECT slug FROM custom_pages WHERE slug=? OR slug=? LIMIT 1');
    $stmt->execute([$slug_clean,$slug_legacy]);
    $existing = $stmt->fetchColumn();
    if($existing){
        $slug = $existing;
        $u = $db->prepare('UPDATE custom_pages SET title=?,content=?,updated=NOW() WHERE slug=?');
        $u->execute([$title,$content,$slug]);
    }else{
        $u = $db->prepare('INSERT INTO custom_pages(slug,title,content,created,updated) VALUES(?,?,?,?,NOW())');
        $u->execute([$slug_clean,$title,$content,date('Y-m-d H:i:s')]);
    }
    $msg = 'Home page saved.';
}

$page = cms_get_custom_page($slug_clean,$theme);
if(!$page && $slug_legacy!==$slug_clean){
    $page = cms_get_custom_page($slug_legacy,$theme);
}
$title = $page['title'] ?? 'Home';
$content = $page['content'] ?? '';
?>
<h2>Edit Home Page</h2>
<?php if($msg): ?><p><?php echo htmlspecialchars($msg); ?></p><?php endif; ?>
<form method="post">
Title:<br>
<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" style="width:100%;"><br><br>
<textarea id="content" name="content" style="width:100%;height:400px;"><?php echo htmlspecialchars($content); ?></textarea><br>
<input type="submit" name="save_page" value="Save">
</form>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
</script>
<?php include 'admin_footer.php'; ?>
