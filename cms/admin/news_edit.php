<?php
require_once 'admin_header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
cms_require_permission($id ? 'news_edit' : 'news_create');
$db = cms_get_db();
$theme = cms_get_setting('theme','2004');
if(isset($_GET['ajax']) && $id){
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($article);
    exit;
}
if($id){
    $stmt = $db->prepare('SELECT * FROM news WHERE id=?');
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$article) { echo 'Article not found'; exit; }
}else{
    $now = date('Y-m-d H:i:s');
    $article = [
        'title'       => '',
        'author'      => getenv('USER') ?: 'Admin',
        'content'     => '',
        'publish_at'  => $now,
        'publish_date'=> $now
    ];
}
if(isset($_POST['autosave'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $pub    = $_POST['publish_at'];
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?, author=?, content=?, publish_date=?, publish_at=?, status="draft" WHERE id=?');
        $stmt->execute([$title,$author,$content,$pub,$pub,$id]);
    }else{
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,publish_at,content,views,is_official,status) VALUES(?,?,?,?,?,0,0,\'draft\')');
        $stmt->execute([$title,$author,$pub,$pub,$content]);
        $id = $db->lastInsertId();
    }
    cms_touch_cache_version();
    cms_admin_log('Autosaved news article '.$id);
    header('Content-Type: application/json');
    echo json_encode(['time'=>date('H:i:s'),'id'=>$id]);
    exit;
}
if(isset($_POST['save'])){
    $title  = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $pub    = $_POST['publish_at'];
    $status = (strtotime($pub) > time()) ? 'scheduled' : 'published';
    if($id){
        $stmt = $db->prepare('UPDATE news SET title=?, author=?, content=?, publish_date=?, publish_at=?, status=? WHERE id=?');
        $stmt->execute([$title,$author,$content,$pub,$pub,$status,$id]);
        cms_admin_log('Updated news article '.$id);
    }else{
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,publish_at,content,views,is_official,status) VALUES(?,?,?,?,?,0,0,?)');
        $stmt->execute([$title,$author,$pub,$pub,$content,$status]);
        $id = $db->lastInsertId();
        cms_admin_log(($status==='scheduled'?'Scheduled':'Created').' news article '.$id);
    }
    cms_touch_cache_version();
    header('Location: news.php');
    exit;
}
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
function autoSave(){
    var data={
        autosave:1,
        title:document.querySelector('input[name=title]').value,
        author:document.querySelector('input[name=author]').value,
        publish_at:document.querySelector('input[name=publish_at]').value,
        content:CKEDITOR.instances.content.getData()
    };
    return fetch('news_edit.php<?php echo $id?"?id=$id":""; ?>',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:new URLSearchParams(data)
    }).then(r=>r.json()).then(function(res){
        document.getElementById('lastSaved').textContent='Last saved '+res.time;
        if(!<?php echo $id?1:0; ?>){
            history.replaceState(null,'','news_edit.php?id='+res.id);
        }
    });
}
setInterval(autoSave,30000);
</script>
<h2><?php echo $id ? 'Edit' : 'Add'; ?> Article</h2>
<form method="post">
Title: <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" size="60"><br><br>
Author: <input type="text" name="author" value="<?php echo htmlspecialchars($article['author']); ?>"><br><br>
Publish Date: <input type="datetime-local" name="publish_at" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($article['publish_at']))); ?>"><br><br>
<textarea id="content" name="content" style="width:100%;height:300px;"><?php echo htmlspecialchars($article['content']); ?></textarea><br>
<input type="submit" name="save" value="Save">
<span id="lastSaved" style="margin-left:10px;color:green;"></span>
<button type="button" id="previewBtn">Preview</button>
<?php if($id): ?>
<button type="button" id="restoreDraft">Restore Draft</button>
<?php endif; ?>
</form>
<p><a href="news.php">Back</a></p>
<?php if($id): ?>
<script>
document.getElementById('restoreDraft').addEventListener('click',function(){
    fetch('news_edit.php?id=<?php echo $id; ?>&ajax=1')
    .then(r=>r.json()).then(function(d){
        document.querySelector('input[name=title]').value=d.title;
        document.querySelector('input[name=author]').value=d.author;
        document.querySelector('input[name=publish_at]').value=d.publish_at.replace(' ','T');
        CKEDITOR.instances.content.setData(d.content);
    });
});
document.getElementById('previewBtn').addEventListener('click',function(){
    autoSave().then(function(){
        window.open('preview.php?type=news&id=<?php echo $id; ?>&theme=<?php echo $theme; ?>','_blank');
    });
});
</script>
<?php endif; ?>
<?php include 'admin_footer.php'; ?>
