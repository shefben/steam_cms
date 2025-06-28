<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_news','news_create','news_edit','news_delete']);
$db = cms_get_db();
// save new order
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('news_edit');
    $ids = array_map('intval', explode(',', $_POST['order']));
    cms_set_setting('news_order', json_encode($ids));
    header('Location: news.php');
    exit;
}
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
$order = cms_get_setting('news_order', null);
$order = $order ? json_decode($order, true) : [];
usort($rows, function($a,$b) use($order){
    $ia = array_search($a['id'],$order);
    $ib = array_search($b['id'],$order);
    if($ia===false) $ia = PHP_INT_MAX;
    if($ib===false) $ib = PHP_INT_MAX;
    return $ia <=> $ib;
});
?>
<h2>News Articles</h2>
<?php if(cms_has_permission('news_create')): ?>
<p><a href="news_edit.php">Add New Article</a></p>
<?php endif; ?>
<form id="orderForm" method="post">
<input type="hidden" name="order" id="order-input">
<table id="news-table" class="data-table">
<thead><tr><th></th><th>Title</th><th>Author</th><th>Date</th><th>Views</th><th colspan="2">Actions</th></tr></thead>
<tbody id="news-body">
<?php foreach($rows as $row): ?>
<tr data-id="<?php echo $row['id']; ?>">
<td class="handle">☰</td>
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
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="save-order" class="btn btn-success">Save Order</button>
</form>
<p><a href="index.php">Back</a></p>
<script>
document.addEventListener('DOMContentLoaded',function(){
    new Sortable(document.getElementById('news-body'),{handle:'.handle'});
    document.getElementById('save-order').addEventListener('click',function(){
        var ids=[];
        document.querySelectorAll('#news-body tr').forEach(function(tr){ids.push(tr.dataset.id);});
        document.getElementById('order-input').value=ids.join(',');
        var input=document.createElement('input');
        input.type='hidden';input.name='reorder';input.value='1';
        document.getElementById('orderForm').appendChild(input);
        document.getElementById('orderForm').submit();
    });
});
</script>
<?php include 'admin_footer.php'; ?>
