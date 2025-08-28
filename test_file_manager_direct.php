<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mock admin session for testing
$_SESSION['admin_id'] = 1;

require_once __DIR__ . '/cms/db.php';

echo "<h2>File Manager Direct Test</h2>\n";

// Test the file manager directly
echo "<h3>Testing file listing for 'images' path:</h3>\n";

// Simulate POST request
$_POST['action'] = 'list';
$_POST['path'] = 'images';

// Capture the output from file_manager.php
ob_start();
include 'cms/admin/file_manager.php';
$output = ob_get_clean();

echo "<pre>Raw output from file_manager.php:</pre>\n";
echo "<code>" . htmlspecialchars($output) . "</code>\n";

// Try to decode JSON
$data = json_decode($output, true);
if ($data) {
    echo "<h3>Parsed JSON:</h3>\n";
    echo "<pre>" . print_r($data, true) . "</pre>\n";
    
    if (isset($data['files'])) {
        echo "<h3>Found " . count($data['files']) . " files:</h3>\n";
        foreach ($data['files'] as $file) {
            echo "<p><strong>" . htmlspecialchars($file['name']) . "</strong><br>";
            echo "Path: " . htmlspecialchars($file['path']) . "<br>";
            echo "Size: " . htmlspecialchars($file['size']) . "<br>";
            echo "Type: " . htmlspecialchars($file['type']) . "</p>";
        }
    }
} else {
    echo "<p style='color: red;'>Failed to parse JSON!</p>\n";
    echo "<p>JSON Error: " . json_last_error_msg() . "</p>\n";
}
?>