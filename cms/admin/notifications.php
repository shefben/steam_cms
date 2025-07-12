<?php
require_once 'admin_header.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    cms_mark_notification_read($id);
    cms_admin_log("notification $id read");
    echo json_encode(['success' => 1]);
    exit;
}
http_response_code(400);
echo json_encode(['error' => 'invalid']);

