<?php
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/template_engine.php';

$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme', '2004');

if ($theme === '2005_v1' || $theme === '2005_v2') {
    $verNum = 3;
    $files = cms_get_all_download_files('2004', $verNum);
    $page = cms_get_download_page('2004');
    if (!$page) {
        $page = ['version' => '2004_v3', 'links' => [], 'categories' => [], 'system_requirements' => ''];
    }
    $template = cms_theme_page_template('downloadpage', '2004', (string)$verNum);
} else {
    $page  = cms_get_download_page($theme);
    $verNum = 1;
    if ($page && preg_match('/v(\d+)/', $page['version'], $m)) {
        $verNum = (int)$m[1];
    }
    $files = cms_get_all_download_files($theme, $verNum);
    $template = cms_theme_page_template('downloadpage', $theme, (string)$verNum);
}
$tplDir   = dirname($template);

$content = cms_render_string(
    file_get_contents($template),
    [
        'links'      => $page['links'] ?? [],
        'categories' => $page['categories'] ?? [],
        'files'      => $files,
        'system_requirements' => $page['system_requirements'] ?? '',
    ],
    $tplDir
);

if ($theme === '2003_v1' && cms_get_setting('support2003_show', '1') === '1') {
    $notice = cms_get_setting('support2003_html', '<div class="notification"><b>:: REQUIRED UPDATE AVAILABLE</b></div>');
    $content = $notice . $content;
}

$layout = cms_theme_layout(null, $theme);

cms_render_template($layout, [
    'page_title' => $page_title,
    'content'    => $content,
]);
