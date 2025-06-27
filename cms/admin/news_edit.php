<?php
require_once 'admin_header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
cms_require_permission($id ? 'news_edit' : 'news_create');
$db = cms_get_db();
if($id){
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$article) { echo 'Article not found'; exit; }
}else{
$article = ['title'=>'','author'=>getenv('USER')?:'Admin','content'=>'','publish_date'=>date('Y-m-d H:i:s')];
}
if(isset($_POST['save'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?, author=?, content=?, publish_date=? WHERE id=?');
        $stmt->execute([$title,$author,$content,$_POST['publish_date'],$id]);
    }else{
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,content,views) VALUES(?,?,?,?,0)');
        $stmt->execute([$title,$author,$_POST['publish_date'],$content]);
        $id = $db->lastInsertId();
    }
    header('Location: news.php');
    exit;
}
?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'#content'});</script>
<h2><?php echo $id ? 'Edit' : 'Add'; ?> Article</h2>
<form method="post">
Title: <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" size="60"><br><br>
Author: <input type="text" name="author" value="<?php echo htmlspecialchars($article['author']); ?>"><br><br>
Publish Date: <input type="datetime-local" name="publish_date" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($article['publish_date']))); ?>"><br><br>
<textarea id="content" name="content" style="width:100%;height:300px;"><?php echo htmlspecialchars($article['content']); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="news.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
