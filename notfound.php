<?php
$page_title = 'Invalid Area';
require_once 'cms/db.php';
include 'cms/header.php';
$default = <<<HTML
<!-- invalid_area -->

<div class="content" id="container">
<h1>INVALID AREA</H1>
<h2>PERHAPS  <em>YOU MISTYPED?</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>
Please select an option from the top menu.

</div>
</div>
HTML;
echo cms_get_setting('error_html', $default);
include 'cms/footer.php';
?>
