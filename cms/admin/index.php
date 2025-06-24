<?php
$header_file = __DIR__ . '/../content/header.html';
$footer_file = __DIR__ . '/../content/footer.html';
$pages_dir   = __DIR__ . '/../pages';
if(!is_dir($pages_dir)) mkdir($pages_dir, 0777, true);

if(isset($_POST['save_header'])) {
    file_put_contents($header_file, $_POST['header']);
}
if(isset($_POST['save_footer'])) {
    file_put_contents($footer_file, $_POST['footer']);
}
if(isset($_POST['save_page']) && !empty($_POST['slug'])) {
    $slug = preg_replace('/[^a-zA-Z0-9_-]/','',$_POST['slug']);
    $content = $_POST['content'];
    file_put_contents("$pages_dir/$slug.php", $content);
}
if(isset($_GET['delete'])) {
    $f = basename($_GET['delete']);
    @unlink("$pages_dir/$f");
}
$pages = glob("$pages_dir/*.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>CMS Admin</title>
<style>
textarea { width: 100%; height: 200px; }
</style>
</head>
<body>
<h1>CMS Admin Panel</h1>
<ul>
  <li><a href="header.php">Edit Header</a></li>
  <li><a href="footer.php">Edit Footer</a></li>
  <li><a href="news.php">Manage News</a></li>
</ul>
<h2>Existing Pages</h2>
<ul>
<?php foreach($pages as $p): $bn=basename($p); ?>
<li><?php echo $bn; ?> - <a href="?delete=<?php echo urlencode($bn); ?>">delete</a></li>
<?php endforeach; ?>
</ul>
<h2>Add/Edit Page</h2>
<form method="post">
Slug: <input name="slug"><br>
<textarea name="content"></textarea><br>
<input type="submit" name="save_page" value="Save Page">
</form>
</body>
</html>
