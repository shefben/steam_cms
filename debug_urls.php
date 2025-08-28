<?php
require_once 'cms/db.php';

echo "<h2>URL Debug Information</h2>\n";

echo "<h3>Server Variables:</h3>\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'not set') . "<br>\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'not set') . "<br>\n";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'not set') . "<br>\n";

echo "<h3>CMS Functions:</h3>\n";
echo "cms_root_path(): '" . cms_root_path() . "'<br>\n";
echo "cms_base_url(): '" . cms_base_url() . "'<br>\n";

echo "<h3>Expected paths:</h3>\n";
echo "Expected CSS: /2004_cms/cms/admin/css/file-picker.css<br>\n";
echo "Expected JS: /2004_cms/cms/admin/js/file-picker.js<br>\n";

echo "<h3>Actual constructed paths:</h3>\n";
$base = cms_base_url();
echo "CSS: '" . $base . "/cms/admin/css/file-picker.css'<br>\n";
echo "JS: '" . $base . "/cms/admin/js/file-picker.js'<br>\n";

echo "<h3>File existence check:</h3>\n";
$css_path = __DIR__ . '/cms/admin/css/file-picker.css';
$js_path = __DIR__ . '/cms/admin/js/file-picker.js';

echo "CSS file exists: " . (file_exists($css_path) ? 'YES' : 'NO') . " ($css_path)<br>\n";
echo "JS file exists: " . (file_exists($js_path) ? 'YES' : 'NO') . " ($js_path)<br>\n";
?>