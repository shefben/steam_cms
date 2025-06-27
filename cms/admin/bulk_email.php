<?php
require_once 'admin_header.php';
cms_require_permission('manage_signups');
$db = cms_get_db();

if(isset($_POST['send']) && trim($_POST['message'])!=''){
    $subject = trim($_POST['subject']);
    $msg = $_POST['message'];
    $rows = $db->query('SELECT email FROM ccafe_registration')->fetchAll(PDO::FETCH_COLUMN);
    $count = 0;
    foreach($rows as $email){
        mail($email,$subject,$msg);
        $count++;
    }
    echo '<p>Sent to '.count($rows).' recipients.</p>';
}
?>
<h2>Bulk Email</h2>
<form method="post">
Subject: <input type="text" name="subject" size="60"><br>
<textarea name="message" style="width:100%;height:200px;"></textarea><br>
<input type="submit" name="send" value="Send">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
