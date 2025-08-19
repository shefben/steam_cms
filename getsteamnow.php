<?php
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/template_engine.php';

$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme', '2004');

// Determine version based on theme
$version = '';
if ($theme === '2005_v1' || $theme === '2005_v2') {
    $version = 'v3';
    $themeName = '2004';
} else {
    $page = cms_get_download_page($theme);
    if ($page && preg_match('/v(\d+)/', $page['version'], $m)) {
        $version = 'v' . $m[1];
    } else {
        $version = $theme === '2003_v2' ? 'v2' : 'v3';
    }
    $themeName = $theme;
}

// Get download files with new rendering system
$files = cms_get_all_download_files($themeName, $version);

// Separate files by location
$mainContentFiles = [];
$floatingBoxFiles = [];

foreach ($files as $file) {
    if (($file['location'] ?? 'main_content') === 'floating_box') {
        $floatingBoxFiles[] = $file;
    } else {
        $mainContentFiles[] = $file;
    }
}

// Render files into HTML
$renderedMainFiles = '';
foreach ($mainContentFiles as $file) {
    $renderedMainFiles .= cms_render_download_file($file, $themeName) . "\n";
}

$renderedFloatingFiles = '';
foreach ($floatingBoxFiles as $file) {
    $renderedFloatingFiles .= cms_render_download_file($file, $themeName) . "\n";
}

// Get page data for legacy compatibility
$page = cms_get_download_page($themeName) ?? [
    'version' => $themeName . '_' . $version, 
    'links' => [], 
    'categories' => [], 
    'system_requirements' => ''
];

$template = cms_theme_page_template('downloadpage', $themeName, substr($version, 1));
$tplDir = dirname($template);

$links = $page['links'] ?? [];
$categories = $page['categories'] ?? [];

$filteredCategories = array_filter($categories, function($category) use ($links) {
    return !empty(array_filter($links, function($link) use ($category) {
        return $link['category'] === $category['name'];
    }));
});

$content = cms_render_string(
    file_get_contents($template),
    [
        'links' => $links,
        'categories' => array_values($filteredCategories),
        'files' => $files,
        'main_content_files' => $mainContentFiles,
        'floating_box_files' => $floatingBoxFiles,
        'rendered_main_files' => $renderedMainFiles,
        'rendered_floating_files' => $renderedFloatingFiles,
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
    'content' => $content,
]);
