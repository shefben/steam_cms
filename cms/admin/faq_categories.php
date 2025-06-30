<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faqcat_add','faqcat_edit','faqcat_delete']);
$db = cms_get_db();
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('faqcat_edit');
    cms_set_setting('faq_cat_order', $_POST['order']);
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        echo 'ok';
    }else{
        header('Location: faq_categories.php');
    }
    exit;
}

if(isset($_POST['delete'])){
    cms_require_permission('faqcat_delete');
    $stmt=$db->prepare('DELETE FROM faq_categories WHERE id1=? AND id2=?');
    $stmt->execute([$_POST['id1'],$_POST['id2']]);
}
if(isset($_POST['save'])){
    $name=trim($_POST['name']);
    $id1=(int)$_POST['id1'];
    $id2=(int)$_POST['id2'];
    if($id1 && $id2){
        cms_require_permission('faqcat_edit');
        $stmt=$db->prepare('UPDATE faq_categories SET name=? WHERE id1=? AND id2=?');
        $stmt->execute([$name,$id1,$id2]);
    }else{
        cms_require_permission('faqcat_add');
        $t=microtime(true);$sec=floor($t);$usec=(int)(($t-$sec)*1e6);$id1=$sec;$id2=$usec*100;
        $stmt=$db->prepare('INSERT INTO faq_categories(id1,id2,name) VALUES(?,?,?)');
        $stmt->execute([$id1,$id2,$name]);
    }
}
$cats=$db->query('SELECT * FROM faq_categories ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$cat_order = cms_get_setting('faq_cat_order','');
$cat_order = $cat_order !== '' ? explode(',', $cat_order) : [];
usort($cats,function($a,$b) use($cat_order){
    $ia = array_search($a['id1'].'-'.$a['id2'],$cat_order);
    $ib = array_search($b['id1'].'-'.$b['id2'],$cat_order);
    if($ia===false) $ia = PHP_INT_MAX;
    if($ib===false) $ib = PHP_INT_MAX;
    return $ia <=> $ib;
});
?>
<h2>FAQ Categories</h2>
<form id="catOrder" method="post">
<input type="hidden" name="order" id="cat-order">
<table id="cat-table" class="data-table">
<thead><tr><th></th><th>Name</th><th>ID1</th><th>ID2</th><th>Actions</th></tr></thead>
<tbody id="cat-body">
<?php foreach($cats as $c): ?>
<tr data-id="<?php echo $c['id1'].'-'.$c['id2']; ?>">
<td class="handle">☰</td>
<form method="post">
<td><input type="text" name="name" value="<?php echo htmlspecialchars($c['name']); ?>"></td>
<td><?php echo $c['id1']; ?><input type="hidden" name="id1" value="<?php echo $c['id1']; ?>"></td>
<td><?php echo $c['id2']; ?><input type="hidden" name="id2" value="<?php echo $c['id2']; ?>"></td>
<td>
<?php if(cms_has_permission('faqcat_edit')): ?>
<input type="submit" name="save" value="Save">
<?php endif; ?>
<?php if(cms_has_permission('faqcat_delete')): ?>
<button name="delete" value="1">Delete</button>
<?php endif; ?>
</td>
</form>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="save-cat" class="btn btn-success">Save Order</button>
</form>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('cat-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('faq_categories.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
    document.getElementById('save-cat').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
});
</script>
<?php if(cms_has_permission('faqcat_add')): ?>
<h3>Add Category</h3>
<form method="post">
Name: <input type="text" name="name">
<input type="submit" name="save" value="Add">
</form>
<?php endif; ?>
<?php include 'admin_footer.php'; ?>
