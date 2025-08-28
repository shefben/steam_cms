<?php
// Minimal test of file_manager.php without any includes that might output HTML

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing file_manager.php directly...\n\n";

// Test by making a direct HTTP request to avoid any session/include issues
$url = 'http://localhost/2004_cms/cms/admin/file_manager.php';

// Prepare POST data
$postData = [
    'action' => 'list',
    'path' => 'images'
];

// Use cURL to make the request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

// Add session cookie if possible
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION['admin_id'] = 1; // Mock admin session

$sessionName = session_name();
$sessionId = session_id();
curl_setopt($ch, CURLOPT_COOKIE, "$sessionName=$sessionId");

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Response Code: $httpCode\n\n";

// Split headers and body
$parts = explode("\r\n\r\n", $response, 2);
$headers = $parts[0];
$body = $parts[1] ?? '';

echo "=== HEADERS ===\n";
echo $headers . "\n\n";

echo "=== BODY ===\n";
echo $body . "\n\n";

echo "=== ANALYSIS ===\n";
if (strpos($body, '<!DOCTYPE') === 0 || strpos($body, '<html') === 0) {
    echo "❌ ERROR: Response contains HTML instead of JSON\n";
    echo "First 200 characters of body:\n";
    echo substr($body, 0, 200) . "...\n";
} else {
    echo "✅ Response appears to be JSON\n";
    $json = json_decode($body, true);
    if ($json) {
        echo "✅ Valid JSON decoded\n";
        print_r($json);
    } else {
        echo "❌ Invalid JSON: " . json_last_error_msg() . "\n";
    }
}
?>