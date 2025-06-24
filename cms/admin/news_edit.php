<?php
require_once __DIR__ . '/../db.php';
$db = cms_get_db();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id){
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$article) { echo 'Article not found'; exit; }
}else{
    $article = ['title'=>'','author'=>getenv('USER')?:'Admin','content'=>''];
}
if(isset($_POST['save'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?, author=?, content=? WHERE id=?');
        $stmt->execute([$title,$author,$content,$id]);
    }else{
        $date = date('Y-m-d H:i:s');
        $stmt = $db->prepare('INSERT INTO news(title,author,date,content,views) VALUES(?,?,?,?,0)');
        $stmt->execute([$title,$author,$date,$content]);
        $id = $db->lastInsertId();
    }
    header('Location: news.php');
    exit;
}
?>
<html>
<head>
<title>Edit News</title>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'#content'});</script>
</head>
<body>
<h1><?php echo $id ? 'Edit' : 'Add'; ?> Article</h1>
<form method="post">
Title: <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" size="60"><br><br>
Author: <input type="text" name="author" value="<?php echo htmlspecialchars($article['author']); ?>"><br><br>
<?php if($id): ?>
Date: <?php echo htmlspecialchars($article['date']); ?><br><br>
<?php endif; ?>
<textarea id="content" name="content" style="width:100%;height:300px;"><?php echo htmlspecialchars($article['content']); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="news.php">Back</a></p>
</body>
</html>
