<?php
$page_title = $page_title ?? 'Welcome to Steam';
include $CMS_ROOT.'/header.php';
?>
<div class="content" id="container" style="background-image:url(<?php echo htmlspecialchars($THEME_URL); ?>/img/shieldguy.gif); background-position:top right; background-repeat:no-repeat;">
{content}
</div>
<?php include $CMS_ROOT.'/footer.php'; ?>
