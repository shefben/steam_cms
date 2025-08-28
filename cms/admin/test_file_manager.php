<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../db.php';

// Check admin authentication
if (!cms_current_admin()) {
    echo "Not authenticated\n";
    exit;
}

echo "Testing file_manager.php endpoint...\n";

// Test the list action
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'http://localhost/file_manager.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => 'action=list&path=images',
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded',
        'Cookie: ' . $_SERVER['HTTP_COOKIE']
    ],
]);

$response = curl_exec($curl);
$error = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";
if ($error) {
    echo "CURL Error: $error\n";
}

// Try to decode JSON
$data = json_decode($response, true);
if ($data === null) {
    echo "JSON decode error: " . json_last_error_msg() . "\n";
} else {
    echo "JSON decoded successfully\n";
    echo "Success: " . ($data['success'] ? 'true' : 'false') . "\n";
    if (isset($data['files'])) {
        echo "Files count: " . count($data['files']) . "\n";
    }
}
?>