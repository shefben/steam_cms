<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_news','news_create','news_edit','news_delete']);
$db = cms_get_db();
$titleFilter = trim($_GET['title'] ?? '');
$authorFilter = trim($_GET['author'] ?? '');
// save new order
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('news_edit');
    $ids = array_map('intval', explode(',', $_POST['order']));
    cms_set_setting('news_order', json_encode($ids));
    cms_admin_log('Reordered news articles');
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
    $delId = (int)$_POST['delete'];
    $stmt->execute([$delId]);
    cms_admin_log('Deleted news article '.$delId);
}
// move up/down by swapping publish dates
if(isset($_GET['move']) && isset($_GET['id'])){
    cms_require_permission('news_edit');
    $id = (int)$_GET['id'];
    $direction = $_GET['move'];
    $posts = $db->query('SELECT id,publish_at FROM news ORDER BY publish_at DESC')->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($posts);$i++){
        if($posts[$i]['id']==$id){
            if($direction=='up' && $i>0){
                $prev = $posts[$i-1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$prev['publish_at'],$id]);
                $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$posts[$i]['publish_at'],$prev['id']]);
                $db->commit();
            }elseif($direction=='down' && $i<count($posts)-1){
                $next = $posts[$i+1];
                $db->beginTransaction();
                $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$next['publish_at'],$id]);
                $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$posts[$i]['publish_at'],$next['id']]);
                $db->commit();
            }
            break;
        }
    }
    header('Location: news.php');
    exit;
}
$sql = 'SELECT id,title,author,publish_date,status,views FROM news WHERE 1';
$params = [];
if ($titleFilter !== '') {
    $sql .= ' AND title LIKE ?';
    $params[] = '%' . $titleFilter . '%';
}
if ($authorFilter !== '') {
    $sql .= ' AND author LIKE ?';
    $params[] = '%' . $authorFilter . '%';
}
$sql .= ' ORDER BY publish_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute($params);

// handle CSV/JSON export before further processing
$export = $_GET['export'] ?? '';
if ($export === 'csv' || $export === 'json') {
    $expSql = str_replace(
        'SELECT id,title,author,publish_date,status,views',
        'SELECT id,title,author,publish_date,status,views,content',
        $sql
    );
    $expStmt = $db->prepare($expSql);
    $expStmt->execute($params);
    $data = $expStmt->fetchAll(PDO::FETCH_ASSOC);
    $file = 'news_export.' . ($export === 'csv' ? 'csv' : 'json');
    if ($export === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $file);
        $out = fopen('php://output', 'w');
        if ($data) {
            fputcsv($out, array_keys($data[0]));
            foreach ($data as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
    } else {
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=' . $file);
        echo json_encode($data);
    }
    exit;
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
$tbodyHtml = '';
foreach ($rows as $i => $row) {
    $p = floor($i / $perPage) + 1;
    $style = $p != $page ? ' style="display:none"' : '';
    $tbodyHtml .= "<tr data-id='{$row['id']}' data-page='{$p}'{$style}>";
    $tbodyHtml .= '<td class="handle">☰</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($row['title']) . '</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($row['author']) . '</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($row['publish_date']) . '</td>';
    $tbodyHtml .= '<td>' . htmlspecialchars($row['status']) . '</td>';
    $tbodyHtml .= '<td>' . (int)$row['views'] . '</td>';
    $tbodyHtml .= '<td>';
    if (cms_has_permission('news_edit')) {
        $tbodyHtml .= '<a href="news_edit.php?id=' . $row['id'] . '" class="btn btn-primary btn-small">Edit</a>';
    }
    $tbodyHtml .= '</td><td>';
    if (cms_has_permission('news_delete')) {
        $tbodyHtml .= '<form method="post" style="display:inline">';
        $tbodyHtml .= '<input type="hidden" name="delete" value="' . $row['id'] . '">';
        $tbodyHtml .= '<input type="submit" value="Delete" class="btn btn-danger btn-small">';
        $tbodyHtml .= '</form>';
    }
    $tbodyHtml .= '</td></tr>';
}

ob_start();
?>
<div class="pagination">
<?php if ($page>1): ?><a href="?page=<?php echo $page-1; ?>&title=<?php echo urlencode($titleFilter); ?>&author=<?php echo urlencode($authorFilter); ?>">&laquo; Prev</a><?php endif; ?>
<?php for($i=1;$i<=$pages;$i++): ?>
<a href="?page=<?php echo $i; ?>&title=<?php echo urlencode($titleFilter); ?>&author=<?php echo urlencode($authorFilter); ?>"<?php if($i==$page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php if ($page<$pages): ?><a href="?page=<?php echo $page+1; ?>&title=<?php echo urlencode($titleFilter); ?>&author=<?php echo urlencode($authorFilter); ?>">Next &raquo;</a><?php endif; ?>
</div>
<?php
$paginationHtml = ob_get_clean();

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(['tbody' => $tbodyHtml, 'pagination' => $paginationHtml]);
    exit;
}
?>
<h2>News Articles</h2>
<?php if(cms_has_permission('news_create')): ?>
<p><a href="news_edit.php">Add New Article</a></p>
<?php endif; ?>
<p>
    <a class="btn btn-secondary" href="news.php?export=csv">Export CSV</a>
    <a class="btn btn-secondary" href="news.php?export=json">Export JSON</a>
    <?php if(cms_has_permission('news_create')): ?>
    <a class="btn btn-secondary" href="news_import.php">Import</a>
    <?php endif; ?>
</p>
<div id="filter-bar" style="margin-bottom:10px;">
    <label>Title: <input type="text" id="filter-title" value="<?php echo htmlspecialchars($titleFilter); ?>"></label>
    <label>Author: <input type="text" id="filter-author" value="<?php echo htmlspecialchars($authorFilter); ?>"></label>
    <button type="button" id="apply-filter" class="btn btn-primary">Filter</button>
</div>
<form id="orderForm" method="post">
<input type="hidden" name="order" id="order-input">
<table id="news-table" class="data-table">
<thead><tr><th></th><th class="sortable">Title</th><th class="sortable">Author</th><th class="sortable">Date</th><th class="sortable">Status</th><th class="sortable">Views</th><th colspan="2">Actions</th></tr></thead>
<tbody id="news-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>
<button type="button" id="save-order" class="btn btn-success">Save Order</button>
</form>
<?php echo $paginationHtml; ?>
<p><a href="index.php">Back</a></p>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('news-body');
    var currentPage=<?php echo $page; ?>;
    var sortable;
    function showPage(p){
        body.querySelectorAll('tr').forEach(function(tr){
            tr.style.display=(p==='all' || tr.dataset.page==p)?'' : 'none';
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
    function initSortable(){
        if(sortable){sortable.destroy();}
        sortable=new Sortable(body,{handle:'.handle',onStart:function(){showPage('all');},onEnd:function(){sendOrder();showPage(currentPage);}});
    }
    function bindPagination(){
        document.querySelectorAll('.pagination a').forEach(function(a){
            a.addEventListener('click',function(e){
                e.preventDefault();
                var p=parseInt(new URL(this.href).searchParams.get('page'));
                showPage(p);
                history.replaceState(null,'','?page='+p);
            });
        });
    }
    $('#news-table th.sortable').on('click',function(){
        var idx=$(this).index();
        var asc=$(this).data('asc')||0;
        var rows=$('#news-body tr').get();
        rows.sort(function(a,b){
            var ta=$(a).children('td').eq(idx-1).text().toLowerCase();
            var tb=$(b).children('td').eq(idx-1).text().toLowerCase();
            return asc?ta.localeCompare(tb):tb.localeCompare(ta);
        });
        $.each(rows,function(i,r){$('#news-body').append(r);});
        $(this).data('asc',asc?0:1);
    });
    $('#apply-filter').on('click',function(){
        var title=$('#filter-title').val();
        var author=$('#filter-author').val();
        $.get('news.php',{ajax:1,title:title,author:author},function(res){
            $('#news-body').html(res.tbody);
            $('.pagination').replaceWith(res.pagination);
            body=document.getElementById('news-body');
            bindPagination();
            initSortable();
            showPage(1);
        },'json');
    });
    bindPagination();
    initSortable();
    showPage(currentPage);
    document.getElementById('save-order').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
});
</script>
<?php include 'admin_footer.php'; ?>
