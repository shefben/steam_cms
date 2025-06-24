<?php
$footer_file = __DIR__ . '/../content/footer.html';
if(isset($_POST['save'])){
    file_put_contents($footer_file, $_POST['footer']);
}
$footer = file_exists($footer_file) ? file_get_contents($footer_file) : '';
?>
<html>
<head><title>Edit Footer</title></head>
<body>
<h1>Edit Footer</h1>
<form method="post">
<textarea name="footer" style="width:100%;height:200px;"><?php echo htmlspecialchars($footer); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
</body>
</html>
