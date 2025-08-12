<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';

$theme = cms_get_setting('theme', '2004');
$page_title = 'support';
$page = cms_get_support_page($theme);

ob_start();
?>

<div class="" id="newsbox" style="
    position: relative;
    top: 423px;">
<br><div class="boxTop">Top Support Questions</div><br clear="all">
<div class="box" style="z-index: 12;">
<?php if ($page && !empty($page['faqs'])): ?>
<?php foreach ($page['faqs'] as $f): ?>
    <a href="faq_entry.php?id=<?php echo $f['faqid1'].','.$f['faqid2']; ?>"><strong><?php echo htmlspecialchars($f['title']); ?></strong></a><br><br>
<?php endforeach; ?>
<?php endif; ?>

</div>
</div>
<div id="textcontainer">
<h1>SUPPORT</H1>
<h2>QUESTIONS, <em>ANSWERS, BUG FIXES, ETC</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<?php echo $page['content'] ?? '' ?>
</div>
</div>

<?php
$content = ob_get_clean();
$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
]);
