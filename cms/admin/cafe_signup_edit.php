<?php
require_once 'admin_header.php';
cms_require_permission('manage_signups');
$db=cms_get_db();
$id=isset($_GET['id'])?(int)$_GET['id']:0;
$stmt=$db->prepare('SELECT * FROM ccafe_registration WHERE id=?');
$stmt->execute([$id]);
$entry=$stmt->fetch(PDO::FETCH_ASSOC);
$allowed_fields = ['company','address1','address2','city','state','zip','country','firstname','lastname','email','phone','fax','locations','seats','prepaid_hours','ship_name','ship_address1','ship_address2','ship_city','ship_state','ship_zip','ship_country','directory','contact_email','ship_phone','wire_transfer'];
if(!$entry){echo 'Entry not found';include 'admin_footer.php';exit;}
if(isset($_POST['save'])){
    $update=[];$vals=[];
    foreach($allowed_fields as $k){
        $update[]="`$k`=?";
        $vals[] = trim($_POST[$k] ?? '');
    }
    $vals[]=$id;
    $db->prepare('UPDATE ccafe_registration SET '.implode(',',$update).' WHERE id=?')->execute($vals);
    header('Location: cafe_signups.php');
    exit;
}
?>
<h2>Edit Signup</h2>
<form method="post">
<?php foreach($allowed_fields as $k){ $v = $entry[$k] ?? ''; ?>
<div><?php echo ucfirst($k);?>: <input type="text" name="<?php echo $k; ?>" value="<?php echo htmlspecialchars($v); ?>"></div>
<?php } ?>
<input type="submit" name="save" value="Save">
</form>
<p><a href="cafe_signups.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
