<?php
require_once 'admin_header.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'recent') {
    $limit = min(50, max(1, (int)($_GET['limit'] ?? 10)));
    $admin_id = cms_current_admin();
    $db = cms_get_db();
    
    $stmt = $db->prepare('SELECT id, type, message, created FROM notifications WHERE is_read = 0 AND (admin_id = ? OR admin_id = 0) ORDER BY created DESC LIMIT ?');
    $stmt->execute([$admin_id, $limit]);
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($notifications);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    cms_mark_notification_read($id);
    cms_admin_log("notification $id read");
    echo json_encode(['success' => 1]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'invalid']);

