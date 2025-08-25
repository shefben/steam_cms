<?php
require_once __DIR__ . '/cms/template_engine.php';

$page_title = cms_get_setting('download_page_title', 'Steam Downloads');
$theme = cms_get_setting('theme', '2004');
$db = cms_get_db();

// Get current download page version setting
$versions = [];
$defaultVer = '';
if ($theme === '2003_v2') {
    $versions = [
        'v1' => 'Version 1',
        'v2' => 'Version 2',
        'v3' => 'Version 3'
    ];
    $defaultVer = 'v2';
} elseif ($theme === '2004') {
    $versions = [
        'v1' => 'Version 1',
        'v2' => 'Version 2',
        'v3' => 'Version 3'
    ];
    $defaultVer = 'v3';
}

// Get configured version or use default
$configuredVersion = cms_get_setting("download_page_{$theme}", $defaultVer);

// Override version from URL parameter if valid
$selectedVersion = $_GET['version'] ?? $configuredVersion;
if (!isset($versions[$selectedVersion])) {
    $selectedVersion = $defaultVer;
}

// Load download files for this theme and version
$stmt = $db->prepare('
    SELECT df.*, dfv.render_type, dfv.is_visible, dfv.sort_order, dfv.location,
           (SELECT COUNT(*) FROM download_file_mirrors dm WHERE dm.file_id = df.id) as mirror_count
    FROM download_files df
    LEFT JOIN download_file_versions dfv ON df.id = dfv.file_id 
        AND dfv.theme = ? AND dfv.page_version = ?
    WHERE dfv.is_visible = 1 OR (dfv.is_visible IS NULL AND 1)
    ORDER BY COALESCE(dfv.sort_order, df.sort_order, df.id)
');
$stmt->execute([$theme, $selectedVersion]);
$downloads = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Load mirrors for each download
foreach ($downloads as &$download) {
    $stmt = $db->prepare('SELECT * FROM download_file_mirrors WHERE file_id = ? ORDER BY ord');
    $stmt->execute([$download['id']]);
    $download['mirrors'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Set default render type if not specified
    if (!$download['render_type']) {
        $download['render_type'] = 'title_size_mirrors_buttons';
    }
    
    // Set default location if not specified
    if (!$download['location']) {
        $download['location'] = 'main_content';
    }
}

// Separate downloads by location
$main_content_files = [];
$floating_box_files = [];

foreach ($downloads as $download) {
    if ($download['location'] === 'floating_box') {
        $floating_box_files[] = $download;
    } else {
        $main_content_files[] = $download;
    }
}

// Determine template layout
$layout_file = "downloadpage_{$selectedVersion}.twig";

// Render the page
$tpl = cms_theme_layout($layout_file, $theme);
cms_render_template($tpl, [
    'main_content_files' => $main_content_files,
    'floating_box_files' => $floating_box_files,
    'page_title' => $page_title,
    'current_version' => $selectedVersion,
    'available_versions' => $versions,
    'theme' => $theme
]);
?>