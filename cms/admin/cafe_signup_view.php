<?php
require_once 'admin_header.php';
cms_require_permission('manage_signups');
$db=cms_get_db();
$id=isset($_GET['id'])?(int)$_GET['id']:0;
$stmt=$db->prepare('SELECT * FROM ccafe_registration WHERE id=?');
$stmt->execute([$id]);
$entry=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$entry){echo 'Entry not found';include 'admin_footer.php';exit;}
if(isset($_POST['accept'])){
    // stub
    header('Location: cafe_signups.php');
    exit;
}
if(isset($_POST['deny'])){
    // stub
    header('Location: cafe_signups.php');
    exit;
}
?>
<h2>Cafe Signup Detail</h2>
<table>
<?php foreach($entry as $k=>$v): ?>
<tr><th><?php echo htmlspecialchars($k); ?></th><td><?php echo htmlspecialchars($v); ?></td></tr>
<?php endforeach; ?>
</table>
<form method="post">
<button name="accept" value="1">Accept</button>
<button name="deny" value="1">Deny</button>
</form>
<p><a href="cafe_signups.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
