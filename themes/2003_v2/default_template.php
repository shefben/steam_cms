<?php
$page_title = $page_title ?? 'Steam';
include $CMS_ROOT.'/header.php';
?>
<div class="content" id="container">
<h1>TITLE</h1>
<h2>basic saying, <em>about page</em></h2><img src="<?php echo htmlspecialchars($THEME_URL); ?>/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
{content}
</div>
</div>
<?php include $CMS_ROOT.'/footer.php'; ?>
