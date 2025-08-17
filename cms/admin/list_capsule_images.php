<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$theme = cms_get_setting('theme', '2004');
$useAll = cms_get_setting('capsules_same_all', '1') === '1';
$imgBase = dirname(__DIR__, 2) . '/storefront/images/capsules';
$list = [];
if ($useAll) {
    foreach (glob($imgBase . '/*', GLOB_ONLYDIR) as $dir) {
        foreach (glob($dir . '/*.png') as $file) {
            $list[] = basename(dirname($file)) . '/' . basename($file);
        }
    }
} else {
    $dir = $imgBase . '/' . $theme;
    if (is_dir($dir)) {
        foreach (glob($dir . '/*.png') as $file) {
            $list[] = $theme . '/' . basename($file);
        }
    }
}
header('Content-Type: application/json');
echo json_encode($list);
?>
