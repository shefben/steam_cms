<?php
require_once 'admin_header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
cms_require_permission($id ? 'news_edit' : 'news_create');
$db = cms_get_db();

if(isset($_POST['autosave'])){
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $content = $_POST['content'] ?? '';
    $date = $_POST['publish_date'] ?? date('Y-m-d H:i:s');
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?,author=?,content=?,publish_date=?,status="draft",updated=NOW() WHERE id=?');
        $stmt->execute([$title,$author,$content,$date,$id]);
    }else{
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,content,views,is_official,status,updated) VALUES(?,?,?,?,0,0,"draft",NOW())');
        $stmt->execute([$title,$author,$date,$content]);
        $id = $db->lastInsertId();
    }
    cms_admin_log('Autosaved news draft '.$id);
    header('Content-Type: application/json');
    echo json_encode(['id'=>$id,'updated'=>date('Y-m-d H:i:s')]);
    exit;
}

if(isset($_GET['restore']) && $id){
    $stmt = $db->prepare('SELECT title,author,content,publish_date FROM news WHERE id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($row);
    exit;
}
if($id){
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$article) { echo 'Article not found'; exit; }
}else{
    $article = [
        'title' => '',
        'author' => getenv('USER') ?: 'Admin',
        'content' => '',
        'publish_date' => date('Y-m-d H:i:s'),
        'status' => 'draft',
        'updated' => date('Y-m-d H:i:s')
    ];
}
if(isset($_POST['save'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?, author=?, content=?, publish_date=?, status="published", updated=NOW() WHERE id=?');
        $stmt->execute([$title,$author,$content,$_POST['publish_date'],$id]);
        cms_admin_log('Updated news article '.$id);
    }else{
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,content,views,is_official,status,updated) VALUES(?,?,?,?,0,0,"published",NOW())');
        $stmt->execute([$title,$author,$_POST['publish_date'],$content]);
        $id = $db->lastInsertId();
        cms_admin_log('Created news article '.$id);
    }
    header('Location: news.php');
    exit;
}
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
var articleId = <?php echo $id; ?>;
function autoSave(){
    var form = document.getElementById('editForm');
    var data = new FormData(form);
    data.append('autosave','1');
    fetch('news_edit.php'+(articleId?('?id='+articleId):''),{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(r=>r.json()).then(function(res){
        if(res.id){articleId=res.id;}
        document.getElementById('lastSaved').textContent=res.updated;
    });
}
setInterval(autoSave,30000);
document.getElementById('restoreBtn').addEventListener('click',function(e){
    e.preventDefault();
    if(!articleId) return;
    fetch('news_edit.php?id='+articleId+'&restore=1',{headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(r=>r.json()).then(function(d){
        document.querySelector('input[name=title]').value=d.title;
        document.querySelector('input[name=author]').value=d.author;
        document.querySelector('input[name=publish_date]').value=d.publish_date.replace(' ','T');
        CKEDITOR.instances.content.setData(d.content);
    });
});
</script>
<h2><?php echo $id ? 'Edit' : 'Add'; ?> Article</h2>
<p>Last saved: <span id="lastSaved"><?php echo htmlspecialchars($article['updated']); ?></span></p>
<form method="post" id="editForm">
Title: <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" size="60"><br><br>
Author: <input type="text" name="author" value="<?php echo htmlspecialchars($article['author']); ?>"><br><br>
Publish Date: <input type="datetime-local" name="publish_date" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($article['publish_date']))); ?>"><br><br>
<textarea id="content" name="content" style="width:100%;height:300px;"><?php echo htmlspecialchars($article['content']); ?></textarea><br>
<input type="submit" name="save" value="Save">
<button type="button" id="restoreBtn">Restore Draft</button>
</form>
<p><a href="news.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
