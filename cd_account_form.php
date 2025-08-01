<?php
require_once __DIR__ . '/cms/db.php';
$page_title = 'CD Key & Account Form';
$theme = cms_get_setting('theme','2004');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        $_POST['validEmail'] ?? null,
        $_POST['steamLogin'] ?? null,
        $_POST['cdKey'] ?? null,
        $_POST['purchaseWhere'] ?? null,
        $_POST['accessOthers'] ?? null,
        $_POST['accessMultiple'] ?? null,
        $_POST['steamLastLogin'] ?? null,
        $_POST['steamIP'] ?? null,
        $_POST['problem'] ?? null,
        $_POST['readfaq'] ?? null,
    ];
    cms_insert_support_request('cd_account_form', $fields, 'en');
    include 'cms/header.php';
    echo '<p>Thank you for submitting your request.</p>';
    include 'cms/footer.php';
    return;
}
$page_html = cms_get_cd_account_page($theme);
include 'cms/header.php';
if ($page_html) {
    echo $page_html;
} else {
    echo '<p>Page not available.</p>';
}
include 'cms/footer.php';

