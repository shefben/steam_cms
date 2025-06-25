<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faqcat_add','faqcat_edit','faqcat_delete']);
$db = cms_get_db();

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
?>
<h2>FAQ Categories</h2>
<table>
<tr><th>Name</th><th>ID1</th><th>ID2</th><th>Actions</th></tr>
<?php foreach($cats as $c): ?>
<tr>
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
</table>
<?php if(cms_has_permission('faqcat_add')): ?>
<h3>Add Category</h3>
<form method="post">
Name: <input type="text" name="name">
<input type="submit" name="save" value="Add">
</form>
<?php endif; ?>
<?php include 'admin_footer.php'; ?>
