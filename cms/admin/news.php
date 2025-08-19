<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_news','news_create','news_edit','news_delete']);
$db = cms_get_db();
$titleFilter = trim($_GET['title'] ?? '');
$authorFilter = trim($_GET['author'] ?? '');
$csrfToken = cms_get_csrf_token();
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !cms_verify_csrf($_POST['csrf_token'] ?? '')) {
    http_response_code(400);
    echo 'Invalid CSRF token';
    return;
}
// save new order
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('news_edit');
    $ids = array_map('intval', explode(',', $_POST['order']));
    cms_set_setting('news_order', json_encode($ids));
    cms_admin_log('Reordered news articles');
    if($isAjax){
        echo 'ok';
    }else{
        header('Location: news.php');
    }
    return;
}
// delete
if(isset($_POST['delete'])){
    cms_require_permission('news_delete');
    $stmt = $db->prepare('DELETE FROM news WHERE id=?');
    $delId = (int)$_POST['delete'];
    $stmt->execute([$delId]);
    cms_admin_log('Deleted news article '.$delId);
    if($isAjax){
        header('Content-Type: application/json');
        echo json_encode(['status'=>'ok']);
        return;
    }
}
// change date format
if(isset($_POST['set_date_format'])){
    cms_require_permission('manage_news');
    $val = $_POST['set_date_format'] === 'iso' ? 'iso' : 'long';
    cms_set_setting('news_date_format', $val);
    cms_admin_log('Changed news date format to ' . $val);
    if($isAjax){
        echo 'ok';
    }else{
        header('Location: news.php');
    }
    return;
}
// move up/down by swapping publish dates
if(isset($_GET['move']) && isset($_GET['id'])){
    cms_require_permission('news_edit');
    $id = (int)$_GET['id'];
    $direction = $_GET['move'] === 'up' ? 'up' : ($_GET['move'] === 'down' ? 'down' : null);
    if (!$direction) {
        header('Location: news.php');
        return;
    }
    $posts = $db->query('SELECT id,publish_at FROM news ORDER BY publish_at DESC')->fetchAll(PDO::FETCH_ASSOC);
    $postCount = count($posts);
    
    // Bounds checking to prevent infinite loops
    if ($postCount === 0) {
        header('Location: news.php');
        return;
    }
    
    for($i=0; $i < $postCount; $i++){
        if($posts[$i]['id']==$id){
            try {
                if($direction=='up' && $i>0){
                    $prev = $posts[$i-1];
                    $db->beginTransaction();
                    $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$prev['publish_at'],$id]);
                    $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$posts[$i]['publish_at'],$prev['id']]);
                    $db->commit();
                }elseif($direction=='down' && $i < ($postCount-1)){
                    $next = $posts[$i+1];
                    $db->beginTransaction();
                    $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$next['publish_at'],$id]);
                    $db->prepare('UPDATE news SET publish_at=? WHERE id=?')->execute([$posts[$i]['publish_at'],$next['id']]);
                    $db->commit();
                }
            } catch (Exception $e) {
                if ($db->inTransaction()) {
                    $db->rollback();
                }
                error_log("News reordering failed: " . $e->getMessage());
            }
            break;
        }
    }
    header('Location: news.php');
    return;
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
// Create order lookup map for O(1) access instead of O(n) array_search
$orderMap = array_flip($order);
usort($rows, function($a,$b) use($orderMap){
    $ia = $orderMap[$a['id']] ?? PHP_INT_MAX;
    $ib = $orderMap[$b['id']] ?? PHP_INT_MAX;
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
        $tbodyHtml .= '<button type="button" class="btn btn-primary btn-small edit-btn" data-id="' . $row['id'] . '">Edit</button>';
    }
    $tbodyHtml .= '</td><td>';
    if (cms_has_permission('news_delete')) {
        $tbodyHtml .= '<button type="button" class="btn btn-danger btn-small delete-btn" data-id="' . $row['id'] . '">Delete</button>';
    }
    $tbodyHtml .= '</td></tr>';
}

ob_start();
?>
<div class="pagination">
<?php if ($page>1): ?>
    <button type="button" class="page-nav" data-page="<?php echo $page-1; ?>">&laquo; Back</button>
<?php endif; ?>
<?php
$firstEnd = min(5, $pages);
for ($i = 1; $i <= $firstEnd; $i++): ?>
    <a href="?page=<?php echo $i; ?>&title=<?php echo urlencode($titleFilter); ?>&author=<?php echo urlencode($authorFilter); ?>" data-page="<?php echo $i; ?>"<?php if($i==$page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php
$lastStart = max($pages - 4, $firstEnd + 1);
if ($lastStart > $firstEnd + 1): ?>
    <span class="ellipsis">...</span>
<?php endif; ?>
<?php for ($i = $lastStart; $i <= $pages; $i++): ?>
    <a href="?page=<?php echo $i; ?>&title=<?php echo urlencode($titleFilter); ?>&author=<?php echo urlencode($authorFilter); ?>" data-page="<?php echo $i; ?>"<?php if($i==$page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php if ($page<$pages): ?>
    <button type="button" class="page-nav" data-page="<?php echo $page+1; ?>">Next &raquo;</button>
<?php endif; ?>
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
<?php $fmt = cms_get_setting('news_date_format','long'); ?>
<div id="news-date-format" style="margin-bottom:15px;">
    <h3>Change Date/Time display</h3>
    <label style="margin-right:10px;">
        <input type="radio" name="date_format" value="long"<?php if($fmt==='long') echo ' checked'; ?>>
        August 11, 2004, 2:15 pm
    </label>
    <label>
        <input type="radio" name="date_format" value="iso"<?php if($fmt==='iso') echo ' checked'; ?>>
        2004-08-20 15:33:00
    </label>
</div>
<p><button type="button" id="add-news" class="btn btn-primary">Add New Article</button></p>
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
<div id="newsModalOverlay" class="modal-overlay" style="display:none;">
  <div class="modal" role="dialog" aria-modal="true">
    <form id="newsForm">
      <input type="hidden" name="id" id="newsId">
      <div class="modal-body">
        <label>Title: <input type="text" name="title" id="newsTitle"></label>
        <label>Author: <input type="text" name="author" id="newsAuthor"></label>
        <label>Publish Date: <input type="datetime-local" name="publish_at" id="newsPublish"></label>
        <label>Content:</label>
        <textarea name="content" id="newsContent" style="width:100%;height:200px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" id="newsCancel" class="btn">Cancel</button>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var csrfToken = '<?= htmlspecialchars($csrfToken, ENT_QUOTES) ?>';
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
        data.set('csrf_token', csrfToken);
        fetch('news.php',{method:'POST',body:data});
    }
    function initSortable(){
        if(sortable){sortable.destroy();}
        sortable=new Sortable(body,{handle:'.handle',onStart:function(){showPage('all');},onEnd:function(){sendOrder();showPage(currentPage);}});
    }
    
    // Memory management for CKEditor instances
    function destroyAllEditors() {
        for(var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].destroy(true);
        }
    }
    
    // Clean up on page unload
    window.addEventListener('beforeunload', function() {
        destroyAllEditors();
    });
    function bindPagination(){
        document.querySelectorAll('.pagination [data-page]').forEach(function(el){
            el.addEventListener('click',function(e){
                e.preventDefault();
                var p=parseInt(this.getAttribute('data-page'));
                showPage(p);
                history.replaceState(null,'','?page='+p);
            });
        });
    }
    function refreshList(){
        var title=$('#filter-title').val();
        var author=$('#filter-author').val();
        $.get('news.php',{ajax:1,title:title,author:author},function(res){
            $('#news-body').html(res.tbody);
            $('.pagination').replaceWith(res.pagination);
            body=document.getElementById('news-body');
            bindPagination();
            initSortable();
            showPage(currentPage);
        },'json');
    }
    function openModal(id){
        $('#newsForm')[0].reset();
        $('#newsId').val('');
        if(CKEDITOR.instances.newsContent){CKEDITOR.instances.newsContent.destroy(true);}
        if(id){
            $.get('news_edit.php',{id:id,ajax:1},function(d){
                $('#newsId').val(d.id);
                $('#newsTitle').val(d.title);
                $('#newsAuthor').val(d.author);
                $('#newsPublish').val(d.publish_at.replace(' ','T'));
                $('#newsContent').val(d.content);
                CKEDITOR.replace('newsContent');
                $('#newsModalOverlay').show();
            },'json');
        }else{
            $('#newsAuthor').val(<?php echo json_encode(getenv('USER') ?: 'Admin'); ?>);
            $('#newsPublish').val(new Date().toISOString().slice(0,16));
            CKEDITOR.replace('newsContent');
            $('#newsModalOverlay').show();
        }
    }
    function closeModal(){
        $('#newsModalOverlay').hide();
        $('#newsForm')[0].reset();
        if(CKEDITOR.instances.newsContent){
            CKEDITOR.instances.newsContent.destroy(true);
            delete CKEDITOR.instances.newsContent;
        }
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
    $('#apply-filter').on('click',function(){ refreshList(); });
    $('#add-news').on('click',function(){ openModal(); });
    $('#news-body').on('click','.edit-btn',function(){ openModal($(this).data('id')); });
    $('#newsCancel').on('click',function(){ closeModal(); });
    $('#newsForm').on('submit',function(e){
        e.preventDefault();
        var id=$('#newsId').val();
        var data={save:1,title:$('#newsTitle').val(),author:$('#newsAuthor').val(),publish_at:$('#newsPublish').val(),content:CKEDITOR.instances.newsContent.getData(),csrf_token:csrfToken};
        var url='news_edit.php'+(id?'?id='+id:'');
        $.post(url,data,function(){
            closeModal();
            refreshList();
        },'json');
    });
    $('#news-body').on('click','.delete-btn',function(){
        var id=$(this).data('id');
        if(confirm('Delete this article?')){
            $.post('news.php',{delete:id,csrf_token:csrfToken},function(){
                refreshList();
            });
        }
    });
    bindPagination();
    initSortable();
    showPage(currentPage);
    document.getElementById('save-order').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
    $('input[name="date_format"]').on('change',function(){
        $.post('news.php',{set_date_format:$(this).val(),csrf_token:csrfToken});
    });
});
</script>
<?php include 'admin_footer.php'; ?>
