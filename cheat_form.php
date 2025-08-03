<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';

$page_title = 'Cheat Form';
$theme      = cms_get_setting('theme', '2004');
$tpl        = cms_theme_layout('default.twig', $theme);

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
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => '<p>Thank you for submitting your request.</p>',
        'show_title' => false,
    ]);
    return;
}

$page_html = cms_get_cheat_form_page($theme);
if ($page_html) {
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => $page_html,
        'show_title' => false,
    ]);
    return;
}

$content = '<!-- forums -->'
    . '<script>function popup(src,scroll,x,y,target){open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes");}</script>'
    . '<h1>CHEAT FORM</h1>'
    . '<h2>BEEN <em>CAUGHT CHEATING?</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>'
    . '<div class="narrower"><br>'
    . 'Support for the Valve Anti-Cheat has been moved into the <a href="javascript:popup(\'/troubleshooter/live/index.php\',\'yes\',550,550,\'\')">Steam troubleshooter</a>.'
    . '</div>';

cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
    'show_title' => false,
]);
