<?php
$page_title = $page_title ?? 'Steam';
include $CMS_ROOT.'/header.php';
?>
<div class="content" id="container" style="background-image:url(/img/cz_guy.gif); background-position:top right; background-repeat:no-repeat;">
    {content}
    <br>
    <br><div class="boxTop">Latest News</div><br clear="all">
    <div class="box">
        {news_index_summary(5)}
        <p align="right"><sub><a href="/news.php" style="text-decoration: none;">read more &gt;</a></sub></p>
    </div>
</div>
<?php include $CMS_ROOT.'/footer.php'; ?>
