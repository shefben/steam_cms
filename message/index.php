<?php
/**
 * Marketing Messages Display Handler
 *
 * Handles URLs like:
 *   - domain.com/message/<GID>/
 *   - domain.com/message/<GID>
 *   - domain.com/message?gid=<GID>
 *
 * Fetches the HTML content from MarketingMessages table by GID and displays it.
 */

declare(strict_types=1);

require_once __DIR__ . '/../cms/db.php';

// Extract GID from URL or query parameter
$gid = null;

// Check for ?gid= parameter first
if (isset($_GET['gid']) && $_GET['gid'] !== '') {
    $gid = $_GET['gid'];
} else {
    // Try to extract from path
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $path = parse_url($requestUri, PHP_URL_PATH);

    // Remove trailing slash and extract GID
    // Patterns: /message/12345/ or /message/12345 or /message12345
    if (preg_match('#/message/(\d+)/?$#i', $path, $matches)) {
        $gid = $matches[1];
    } elseif (preg_match('#/message(\d+)/?$#i', $path, $matches)) {
        $gid = $matches[1];
    }
}

// Validate GID (should be numeric)
if ($gid === null || !preg_match('/^\d+$/', $gid)) {
    http_response_code(400);
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Steam - Marketing Message</title>
    <style>body{background:#1b2838;color:#c7d5e0;font-family:Arial,Helvetica,sans-serif;margin:50px;text-align:center}
    a{color:#66c0f4}</style></head><body>
    <h2>Invalid or Missing Message ID</h2>
    <p>Please provide a valid message GID.</p>
    <p><a href="/">Return to Steam</a></p>
    </body></html>';
    exit;
}

try {
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT HTML FROM MarketingMessages WHERE GID = ? LIMIT 1');
    $stmt->execute([$gid]);
    $html = $stmt->fetchColumn();

    if ($html !== false && $html !== null) {
        // Output the raw HTML content
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        exit;
    }
} catch (Throwable $e) {
    // Log error but don't expose details
    error_log('MarketingMessages lookup error: ' . $e->getMessage());
}

// Message not found
http_response_code(404);
$escapedGid = htmlspecialchars($gid, ENT_QUOTES, 'UTF-8');
echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><title>Steam - Marketing Message</title>
<style>body{background:#1b2838;color:#c7d5e0;font-family:Arial,Helvetica,sans-serif;margin:50px;text-align:center}
a{color:#66c0f4}code{background:#2a475e;padding:3px 8px;border-radius:3px}</style></head><body>
<h2>Marketing Message Not Found</h2>
<p>The requested marketing message with GID <code>{$escapedGid}</code> was not found.</p>
<p><a href=\"/\">Return to Steam</a></p>
</body></html>";
