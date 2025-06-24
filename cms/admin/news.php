<?php
require_once __DIR__ . '/../db.php';
$db = cms_get_db();
// delete
if(isset($_POST['delete'])){
    $stmt = $db->prepare('DELETE FROM news WHERE id=?');
    $stmt->execute([ (int)$_POST['delete'] ]);
}
// move up/down by swapping dates
if(isset($_GET['move']) && isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $direction = $_GET['move'];
    $posts = $db->query('SELECT id,date FROM news ORDER BY date DESC')->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($posts);$i++){
        if($posts[$i]['id']==$id){
            if($direction=='up' && $i>0){
                $prev = $posts[$i-1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET date=? WHERE id=?')->execute([$prev['date'],$id]);
                $db->prepare('UPDATE news SET date=? WHERE id=?')->execute([$posts[$i]['date'],$prev['id']]);
                $db->commit();
            }elseif($direction=='down' && $i<count($posts)-1){
                $next = $posts[$i+1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET date=? WHERE id=?')->execute([$next['date'],$id]);
                $db->prepare('UPDATE news SET date=? WHERE id=?')->execute([$posts[$i]['date'],$next['id']]);
                $db->commit();
            }
            break;
        }
    }
    header('Location: news.php');
    exit;
}
$rows = $db->query('SELECT id,title,author,date,views FROM news ORDER BY date DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head><title>Manage News</title></head>
<body>
<h1>News Articles</h1>
<p><a href="news_edit.php">Add New Article</a></p>
<table border="1" cellpadding="2">
<tr><th>Title</th><th>Author</th><th>Date</th><th>Views</th><th colspan="3">Actions</th></tr>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo htmlspecialchars($row['title']); ?></td>
<td><?php echo htmlspecialchars($row['author']); ?></td>
<td><?php echo htmlspecialchars($row['date']); ?></td>
<td><?php echo (int)$row['views']; ?></td>
<td><a href="news_edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
<td>
    <form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $row['id']; ?>"><input type="submit" value="Delete"></form>
</td>
<td>
    <a href="?move=up&id=<?php echo $row['id']; ?>">Up</a> |
    <a href="?move=down&id=<?php echo $row['id']; ?>">Down</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="index.php">Back</a></p>
</body>
</html>
