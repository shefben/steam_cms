<?php
$faqid1=isset($_GET['faqid1'])?(int)$_GET['faqid1']:0;
$faqid2=isset($_GET['faqid2'])?(int)$_GET['faqid2']:0;
require_once 'admin_header.php';
cms_require_permission(($faqid1&&$faqid2)?'faq_edit':'faq_add');
$db=cms_get_db();
if($faqid1&&$faqid2){
    $stmt=$db->prepare('SELECT * FROM faq_content WHERE faqid1=? AND faqid2=?');
    $stmt->execute([$faqid1,$faqid2]);
    $faq=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$faq){echo 'FAQ not found';include 'admin_footer.php';exit;}
}else{
    $faq=['catid1'=>'','catid2'=>'','title'=>'','body'=>''];
}
if(isset($_POST['save'])){
    $cat=explode(',',$_POST['category']);
    $title=$_POST['title'];
    $body=$_POST['body'];
    if($faqid1&&$faqid2){
        $db->prepare('UPDATE faq_content SET catid1=?,catid2=?,title=?,body=? WHERE faqid1=? AND faqid2=?')
            ->execute([$cat[0],$cat[1],$title,$body,$faqid1,$faqid2]);
    }else{
        $t=microtime(true);$sec=floor($t);$usec=(int)(($t-$sec)*1e6);$faqid1=$sec;$faqid2=$usec*100;
        $db->prepare('INSERT INTO faq_content(catid1,catid2,faqid1,faqid2,title,body) VALUES(?,?,?,?,?,?)')
            ->execute([$cat[0],$cat[1],$faqid1,$faqid2,$title,$body]);
    }
    header('Location: faq.php');
    exit;
}
$cats=$db->query('SELECT * FROM faq_categories ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2><?php echo $faqid1? 'Edit':'Add'; ?> FAQ</h2>
<form method="post">
Category:
<select name="category">
<?php foreach($cats as $c): $sel=($c['id1']==$faq['catid1']&&$c['id2']==$faq['catid2'])?'selected':'';?>
<option value="<?php echo $c['id1'].','.$c['id2']; ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($c['name']); ?></option>
<?php endforeach; ?>
</select><br><br>
Title:<br>
<input type="text" name="title" value="<?php echo htmlspecialchars($faq['title']); ?>"><br><br>
Body:<br>
<textarea name="body" id="faq-body" rows="10"><?php echo htmlspecialchars($faq['body']); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('faq-body');
</script>
<p><a href="faq.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
