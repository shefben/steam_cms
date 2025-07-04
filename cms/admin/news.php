<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_news','news_create','news_edit','news_delete']);
$db = cms_get_db();
// save new order
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('news_edit');
    $ids = array_map('intval', explode(',', $_POST['order']));
    cms_set_setting('news_order', json_encode($ids));
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        echo 'ok';
    }else{
        header('Location: news.php');
    }
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
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$total = count($rows);
$pages = max(1, (int)ceil($total/$perPage));
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
<?php foreach($rows as $i=>$row): $p = floor($i/$perPage)+1; ?>
<tr data-id="<?php echo $row['id']; ?>" data-page="<?php echo $p; ?>"<?php if($p!=$page) echo ' style="display:none"'; ?>>
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
<div class="pagination">
<?php if($page>1): ?><a href="?page=<?php echo $page-1; ?>">&laquo; Prev</a><?php endif; ?>
<?php if($page<$pages): ?><a href="?page=<?php echo $page+1; ?>">Next &raquo;</a><?php endif; ?>
</div>
<p><a href="index.php">Back</a></p>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('news-body');
    var currentPage=<?php echo $page; ?>;
    function showPage(p){
        body.querySelectorAll('tr').forEach(function(tr){
            tr.style.display=(p==='all' || tr.dataset.page==p)?'':'none';
        });
        currentPage=p==='all'?currentPage:p;
    }
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('news.php',{method:'POST',body:data});
    }
    new Sortable(body,{
        handle:'.handle',
        onStart:function(){showPage('all');},
        onEnd:function(){sendOrder();showPage(currentPage);}
    });
    showPage(currentPage);
    document.getElementById('save-order').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
    document.querySelectorAll('.pagination a').forEach(function(a){
        a.addEventListener('click',function(e){
            e.preventDefault();
            var p=parseInt(this.href.split('=')[1]);
            showPage(p);
            history.replaceState(null,'','?page='+p);
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
