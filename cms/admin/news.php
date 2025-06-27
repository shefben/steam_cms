<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_news','news_create','news_edit','news_delete']);
$db = cms_get_db();
// delete
if(isset($_POST['delete'])){
    cms_require_permission('news_delete');
    $stmt = $db->prepare('DELETE FROM news WHERE id=?');
    $stmt->execute([ (int)$_POST['delete'] ]);
}
// move up/down by swapping publish dates
if(isset($_GET['move']) && isset($_GET['id'])){
    cms_require_permission('news_edit');
    $id = (int)$_GET['id'];
    $direction = $_GET['move'];
    $posts = $db->query('SELECT id,publish_date FROM news ORDER BY publish_date DESC')->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($posts);$i++){
        if($posts[$i]['id']==$id){
            if($direction=='up' && $i>0){
                $prev = $posts[$i-1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET publish_date=? WHERE id=?')->execute([$prev['publish_date'],$id]);
                $db->prepare('UPDATE news SET publish_date=? WHERE id=?')->execute([$posts[$i]['publish_date'],$prev['id']]);
                $db->commit();
            }elseif($direction=='down' && $i<count($posts)-1){
                $next = $posts[$i+1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET publish_date=? WHERE id=?')->execute([$next['publish_date'],$id]);
                $db->prepare('UPDATE news SET publish_date=? WHERE id=?')->execute([$posts[$i]['publish_date'],$next['id']]);
                $db->commit();
            }
            break;
        }
    }
    header('Location: news.php');
    exit;
}
$rows = $db->query('SELECT id,title,author,publish_date,views FROM news ORDER BY publish_date DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>News Articles</h2>
<?php if(cms_has_permission('news_create')): ?>
<p><a href="news_edit.php">Add New Article</a></p>
<?php endif; ?>
<table border="1" cellpadding="2">
<tr><th>Title</th><th>Author</th><th>Publish Date</th><th>Views</th><th colspan="3">Actions</th></tr>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo htmlspecialchars($row['title']); ?></td>
<td><?php echo htmlspecialchars($row['author']); ?></td>
<td><?php echo htmlspecialchars($row['publish_date']); ?></td>
<td><?php echo (int)$row['views']; ?></td>
<td>
<?php if(cms_has_permission('news_edit')): ?>
    <a href="news_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
<?php endif; ?>
</td>
<td>
<?php if(cms_has_permission('news_delete')): ?>
    <form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $row['id']; ?>"><input type="submit" value="Delete"></form>
<?php endif; ?>
</td>
<td>
<?php if(cms_has_permission('news_edit')): ?>
    <a href="?move=up&id=<?php echo $row['id']; ?>">Up</a> |
    <a href="?move=down&id=<?php echo $row['id']; ?>">Down</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
