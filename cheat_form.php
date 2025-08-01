<?php
$page_title = 'Cheat Form';
require_once __DIR__ . '/cms/db.php';
$theme = cms_get_setting('theme','2004');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        $_POST['steamEmail'] ?? null,
        $_POST['validEmail'] ?? null,
        $_POST['steamId'] ?? null,
        $_POST['cdKey'] ?? null,
        $_POST['operatingSystem'] ?? null,
        $_POST['plea'] ?? null,
    ];
    cms_insert_support_request('cheat_form', $fields, 'en');
    include 'cms/header.php';
    echo '<p>Thank you for submitting your request.</p>';
    include 'cms/footer.php';
    return;
}
$page_html = cms_get_cheat_form_page($theme);
if ($page_html) {
    include 'cms/header.php';
    echo $page_html;
    include 'cms/footer.php';
    return;
}
include 'cms/header.php'; ?>
<!-- forums -->

<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>

<div class="content" id="container">
<h1>CHEAT FORM</H1>
<h2>BEEN <em>CAUGHT CHEATING?</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>

Support for the Valve Anti-Cheat has been moved into the <a href="javascript:popup('/troubleshooter/live/index.php','yes',550,550,'')">Steam troubleshooter</a>.

</div>
</div>
<?php include 'cms/footer.php'; ?>
