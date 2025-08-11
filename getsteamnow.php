<?php
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/template_engine.php';

$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme', '2004');
$page  = cms_get_download_page($theme);
$verNum = 1;
if ($page && preg_match('/v(\d+)/', $page['version'], $m)) {
    $verNum = (int)$m[1];
}
$files = cms_get_all_download_files($theme, $verNum);

$template = cms_theme_page_template('downloadpage', $theme, (string)$verNum);
$tplDir   = dirname($template);

$content = cms_render_string(
    file_get_contents($template),
    [
        'links'      => $page['links'] ?? [],
        'categories' => $page['categories'] ?? [],
        'files'      => $files,
    ],
    $tplDir
);

$layout = cms_theme_layout(null, $theme);

cms_render_template($layout, [
    'page_title' => $page_title,
    'content'    => $content,
]);
