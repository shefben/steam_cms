<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faq_add','faq_edit','faq_delete']);
$db=cms_get_db();
if(isset($_POST['delete'])){
    cms_require_permission('faq_delete');
    $stmt=$db->prepare('DELETE FROM faq_content WHERE faqid1=? AND faqid2=?');
    $stmt->execute([$_POST['faqid1'],$_POST['faqid2']]);
}
$rows=$db->query('SELECT f.*,c.name as catname FROM faq_content f JOIN faq_categories c ON c.id1=f.catid1 AND c.id2=f.catid2 ORDER BY c.name,title')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>FAQs</h2>
<?php if(cms_has_permission('faq_add')): ?>
<p><a href="faq_edit.php">Add FAQ</a></p>
<?php endif; ?>
<table>
<tr><th>Category</th><th>Title</th><th>Actions</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['catname']); ?></td>
<td><?php echo htmlspecialchars($r['title']); ?></td>
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
</table>
<?php include 'admin_footer.php'; ?>
