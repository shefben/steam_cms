<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';

$page_title = 'CD Key & Account Form';
$theme      = cms_get_setting('theme', '2004');
$tpl        = cms_theme_layout('default.twig', $theme);

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
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => '<p>Thank you for submitting your request.</p>',
        'show_title' => false,
    ]);
    return;
}

$page_html = cms_get_cd_account_page($theme);
$content   = $page_html ?: '<p>Page not available.</p>';

cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
    'show_title' => false,
]);

