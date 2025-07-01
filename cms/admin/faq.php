<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faq_add','faq_edit','faq_delete']);
$db=cms_get_db();
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('faq_edit');
    cms_set_setting('faq_order', $_POST['order']);
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        echo 'ok';
    }else{
        header('Location: faq.php');
    }
    exit;
}
if(isset($_POST['delete'])){
    cms_require_permission('faq_delete');
    $stmt=$db->prepare('DELETE FROM faq_content WHERE faqid1=? AND faqid2=?');
    $stmt->execute([$_POST['faqid1'],$_POST['faqid2']]);
}
$rows=$db->query('SELECT f.*,c.name as catname FROM faq_content f JOIN faq_categories c ON c.id1=f.catid1 AND c.id2=f.catid2 ORDER BY c.name,title')->fetchAll(PDO::FETCH_ASSOC);
$order = cms_get_setting('faq_order','');
$order = $order !== '' ? explode(',', $order) : [];
usort($rows,function($a,$b) use($order){
    $ia = array_search($a['faqid1'].'-'.$a['faqid2'],$order);
    $ib = array_search($b['faqid1'].'-'.$b['faqid2'],$order);
    if($ia===false) $ia = PHP_INT_MAX;
    if($ib===false) $ib = PHP_INT_MAX;
    return $ia <=> $ib;
});
?>
<h2>FAQs</h2>
<?php if(cms_has_permission('faq_add')): ?>
<p><a href="faq_edit.php">Add FAQ</a></p>
<?php endif; ?>
<form id="faqOrder" method="post">
<input type="hidden" name="order" id="faq-order">
<table id="faq-table" class="data-table">
<thead><tr><th></th><th>Category</th><th>Title</th><th>Views</th><th>Actions</th></tr></thead>
<tbody id="faq-body">
<?php foreach($rows as $r): ?>
<tr data-id="<?php echo $r['faqid1'].'-'.$r['faqid2']; ?>">
<td class="handle">☰</td>
<td><?php echo htmlspecialchars($r['catname']); ?></td>
<td><?php echo htmlspecialchars($r['title']); ?></td>
<td><?php echo (int)$r['views']; ?></td>
<td>
<?php if(cms_has_permission('faq_edit')): ?>
    <a href="faq_edit.php?faqid1=<?php echo $r['faqid1']; ?>&faqid2=<?php echo $r['faqid2']; ?>">Edit</a>
<?php endif; ?>
<?php if(cms_has_permission('faq_delete')): ?>
    <form method="post" style="display:inline"><input type="hidden" name="faqid1" value="<?php echo $r['faqid1']; ?>"><input type="hidden" name="faqid2" value="<?php echo $r['faqid2']; ?>"><input type="submit" name="delete" value="Delete"></form>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="save-faq" class="btn btn-success">Save Order</button>
</form>
<script>
document.addEventListener('DOMContentLoaded',function(){
    new Sortable(document.getElementById('faq-body'),{handle:'.handle'});
    var body=document.getElementById('faq-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('faq.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
    document.getElementById('save-faq').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
});
</script>
<?php include 'admin_footer.php'; ?>
