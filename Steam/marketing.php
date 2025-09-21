<?php
declare(strict_types=1);

require_once __DIR__ . '/../cms/db.php';

header('Content-Type: text/html; charset=utf-8');

$page = $_GET['page'] ?? '';
// Allow alnum, dot, dash, underscore in msgtype
if (!preg_match('/^[A-Za-z0-9._-]+$/', $page)) {
    http_response_code(400);
    echo '<!doctype html><html><body><h3>Invalid marketing page.</h3></body></html>';
    exit;
}

try {
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT content FROM marketing WHERE msgtype=? AND language=? LIMIT 1');
    $stmt->execute([$page, 'english']);
    $html = $stmt->fetchColumn();
    if ($html !== false) {
        echo (string)$html;
        exit;
    }
} catch (Throwable $e) {
    // fall through to fallback
}

// Fallback: simple message similar to existing steam/index.php
$missing = htmlspecialchars($page, ENT_QUOTES);
echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><title>Steam - Marketing</title>
<style>body{background:#4C5844;color:#fff;font-family:Verdana,Arial,sans-serif;font-size:75%;margin:80px 0 0 0;line-height:1.4em}a{color:#fff}</style>
</head><body><center><br><img src=\"/custom_assets/img/steamLogoOldGreen.jpg\" alt=\"Steam Logo\"><br><br><div style=\"background:#333d33;width:480px;padding:20px;\">\n<b style=\"color:#C4B550;\">This marketing message is missing.</b><br><br>\nRequested: steam/marketing/{$missing}/<br></div><br>\n<a href=\"/\">Return to Steam</a></center></body></html>";

