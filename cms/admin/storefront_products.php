<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

$page = max(1, (int)($_GET['p'] ?? 1));
$per = 25;
$offset = ($page - 1) * $per;
$stmt = $db->prepare('SELECT * FROM store_apps ORDER BY appid LIMIT :lim OFFSET :off');
$stmt->bindValue(':lim', $per, PDO::PARAM_INT);
$stmt->bindValue(':off', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = (int)$db->query('SELECT COUNT(*) FROM store_apps')->fetchColumn();

 $export = $_GET['export'] ?? '';
 if ($export === 'csv' || $export === 'json') {
     $dataStmt = $db->query('SELECT appid,name,developer,price,availability FROM store_apps ORDER BY appid');
     $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
     $file = 'products.' . ($export === 'csv' ? 'csv' : 'json');
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

 $tbodyHtml = '';
 foreach ($rows as $r) {
     $tbodyHtml .= '<tr>';
     $tbodyHtml .= '<td>' . $r['appid'] . '</td>';
     $imgs = json_decode($r['images'] ?: '[]', true);
     $imgTag = '';
     if ($imgs) {
         $img = htmlspecialchars($imgs[0]);
         $imgTag = '<img src="../archived_steampowered/2005/storefront/screenshots/' . $img . '" width="40">';
     }
     $tbodyHtml .= '<td>' . $imgTag . '</td>';
     $tbodyHtml .= '<td>' . htmlspecialchars($r['name']) . '</td>';
     $tbodyHtml .= '<td>' . htmlspecialchars($r['developer']) . '</td>';
     $tbodyHtml .= '<td>' . $r['price'] . '</td>';
     $tbodyHtml .= '<td>' . htmlspecialchars($r['availability']) . '</td>';
     $tbodyHtml .= '<td><a href="storefront_product.php?id=' . $r['appid'] . '">Edit</a></td>';
     $tbodyHtml .= '</tr>';
 }

 $pages = (int)ceil($total / $per);
 ob_start();
 if ($pages > 1) {
    echo '<div class="pagination" data-page="' . $page . '" data-pages="' . $pages . '">';
    echo '<button id="prevPage"' . ($page <= 1 ? ' disabled' : '') . '>&laquo; Prev</button> ';
    $start = max(1, $page - 3);
    for ($i = $start; $i <= $page; $i++) {
        if ($i == $page) {
            echo '<span class="current">' . $i . '</span>';
        } else {
            echo '<a href="#" data-page="' . $i . '">' . $i . '</a>';
        }
    }
    if ($page < $pages - 3) {
        echo '<span class="ellipsis">...</span>';
        for ($i = $pages - 2; $i <= $pages; $i++) {
            echo '<a href="#" data-page="' . $i . '">' . $i . '</a>';
        }
    } else {
        for ($i = $page + 1; $i <= $pages; $i++) {
            echo '<a href="#" data-page="' . $i . '">' . $i . '</a>';
        }
    }
    echo ' <button id="nextPage"' . ($page >= $pages ? ' disabled' : '') . '>Next &raquo;</button>';
     echo '</div>';
 }
 $paginationHtml = ob_get_clean();

 if (isset($_GET['ajax'])) {
     header('Content-Type: application/json');
     echo json_encode(['tbody' => $tbodyHtml, 'pagination' => $paginationHtml]);
     exit;
 }
?>
<h2>Store Products</h2>
<p>
    <a class="btn btn-secondary" href="storefront_products.php?export=csv">Export CSV</a>
    <a class="btn btn-secondary" href="storefront_products.php?export=json">Export JSON</a>
</p>
<table class="table">
<tr><th>ID</th><th>Image</th><th>Name</th><th>Developer</th><th>Price</th><th>Avail</th><th></th></tr>
<tbody id="products-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>
<?php echo $paginationHtml; ?>
<script>
function loadProducts(p){
    $.get('storefront_products.php',{ajax:1,p:p},function(res){
        $('#products-body').html(res.tbody);
        $('.pagination').replaceWith(res.pagination);
        bindPagination();
    },'json');
}
function bindPagination(){
    $('.pagination').on('click','a',function(e){
        e.preventDefault();
        var p=$(this).data('page');
        loadProducts(p);
    });
    $('#prevPage').on('click',function(){
        var p=parseInt($('.pagination').data('page'),10); if(p>1){ loadProducts(p-1); }
    });
    $('#nextPage').on('click',function(){
        var pag=$('.pagination'); var p=parseInt(pag.data('page'),10); var t=parseInt(pag.data('pages'),10); if(p<t){ loadProducts(p+1); }
    });
}
$(function(){ bindPagination(); });
</script>
<?php include 'admin_footer.php'; ?>
