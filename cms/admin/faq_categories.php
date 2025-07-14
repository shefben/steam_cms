<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faqcat_add','faqcat_edit','faqcat_delete']);
$db = cms_get_db();
if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_require_permission('faqcat_edit');
    cms_set_setting('faq_cat_order', $_POST['order']);
    cms_admin_log('Reordered FAQ categories');
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
    cms_admin_log('Deleted FAQ category '.$_POST['id1'].'-'.$_POST['id2']);
}
if(isset($_POST['save'])){
    $name=trim($_POST['name']);
    $id1=(int)$_POST['id1'];
    $id2=(int)$_POST['id2'];
    $hidden = isset($_POST['hidden']) ? (int)$_POST['hidden'] : null;
    if($id1 && $id2){
        cms_require_permission('faqcat_edit');
        if($hidden===null){
            $stmt=$db->prepare('UPDATE faq_categories SET name=? WHERE id1=? AND id2=?');
            $stmt->execute([$name,$id1,$id2]);
            cms_admin_log('Updated FAQ category '.$id1.'-'.$id2);
        }else{
            $stmt=$db->prepare('UPDATE faq_categories SET name=?,hidden=? WHERE id1=? AND id2=?');
            $stmt->execute([$name,$hidden,$id1,$id2]);
            cms_admin_log('Updated FAQ category '.$id1.'-'.$id2);
        }
    }else{
        cms_require_permission('faqcat_add');
        $t=microtime(true);$sec=floor($t);$usec=(int)(($t-$sec)*1e6);$id1=$sec;$id2=$usec*100;
        $stmt=$db->prepare('INSERT INTO faq_categories(id1,id2,name,hidden) VALUES(?,?,?,0)');
        $stmt->execute([$id1,$id2,$name]);
        cms_admin_log('Created FAQ category '.$id1.'-'.$id2);
    }
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ echo 'ok'; exit; }
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
<thead><tr><th></th><th>Title</th><th>Hidden</th><th>Actions</th></tr></thead>
<tbody id="cat-body">
<?php foreach($cats as $c): ?>
<tr data-id="<?php echo $c['id1'].'-'.$c['id2']; ?>">
  <td class="handle">☰</td>
  <td class="cat-name"><?php echo htmlspecialchars($c['name']); ?></td>
  <td><input type="checkbox" class="toggle-hidden" data-id1="<?php echo $c['id1']; ?>" data-id2="<?php echo $c['id2']; ?>" <?php echo $c['hidden']?'checked':''; ?>></td>
  <td class="actions">
    <?php if(cms_has_permission('faqcat_edit')): ?>
      <a href="#" class="edit-cat">Edit</a>
    <?php endif; ?>
    <?php if(cms_has_permission('faqcat_delete')): ?>
      <form method="post" class="delete-form" style="display:inline">
        <input type="hidden" name="id1" value="<?php echo $c['id1']; ?>">
        <input type="hidden" name="id2" value="<?php echo $c['id2']; ?>">
        <input type="submit" name="delete" value="Delete">
      </form>
    <?php endif; ?>
  </td>
</tr>
<tr class="edit-row" style="display:none" data-id="<?php echo $c['id1'].'-'.$c['id2']; ?>">
  <td colspan="4">
    <label>Edit FAQ Category Title:</label>
    <input type="text" class="edit-input" value="<?php echo htmlspecialchars($c['name']); ?>">
    <input type="hidden" class="edit-id1" value="<?php echo $c['id1']; ?>">
    <input type="hidden" class="edit-id2" value="<?php echo $c['id2']; ?>">
    <button class="save-cat">Save</button>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="save-cat" class="btn btn-success">Save Order</button>
</form>
<button id="add-cat-btn" class="btn btn-primary" type="button">Add Category</button>
<div id="add-cat-form" style="display:none;margin-top:10px;">
  <label>Title:</label>
  <input type="text" id="new-cat-title">
  <button id="add-cat-save" class="btn btn-success">Save</button>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('cat-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr[data-id]').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('faq_categories.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
    document.getElementById('save-cat').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });
    body.querySelectorAll('.edit-cat').forEach(function(btn){
        btn.addEventListener('click',function(e){
            e.preventDefault();
            var edit=this.closest('tr').nextElementSibling;
            $(edit).slideToggle('fast');
        });
    });
    body.querySelectorAll('.save-cat').forEach(function(btn){
        btn.addEventListener('click',function(e){
            e.preventDefault();
            var row=this.closest('.edit-row');
            var name=row.querySelector('.edit-input').value;
            var id1=row.querySelector('.edit-id1').value;
            var id2=row.querySelector('.edit-id2').value;
            var data=new URLSearchParams();
            data.set('save','1');
            data.set('id1',id1);
            data.set('id2',id2);
            data.set('name',name);
            fetch('faq_categories.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}})
              .then(function(){row.previousElementSibling.querySelector('.cat-name').textContent=name;});
        });
    });
    body.querySelectorAll('.toggle-hidden').forEach(function(cb){
        cb.addEventListener('change',function(){
            var data=new URLSearchParams();
            data.set('save','1');
            data.set('id1',this.dataset.id1);
            data.set('id2',this.dataset.id2);
            data.set('hidden',this.checked?1:0);
            fetch('faq_categories.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}});
        });
    });
    document.getElementById('add-cat-btn').addEventListener('click',function(){
        $('#add-cat-form').slideToggle('fast');
    });
    document.getElementById('add-cat-save').addEventListener('click',function(){
        var name=document.getElementById('new-cat-title').value.trim();
        if(!name) return;
        var data=new URLSearchParams();
        data.set('save','1');
        data.set('name',name);
        fetch('faq_categories.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}})
          .then(function(){location.reload();});
    });
});
</script>
<?php include 'admin_footer.php'; ?>
