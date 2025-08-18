<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');

$db = cms_get_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = (int) $_POST['delete'];
        $db->prepare('DELETE FROM store_developers WHERE id=?')->execute([$id]);
        $db->prepare('DELETE FROM developer_apps WHERE developer_id=?')->execute([$id]);
        echo 'ok';
        exit;
    }

    $id = (int) ($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $website = trim($_POST['website'] ?? '');

    if ($id) {
        $db->prepare('UPDATE store_developers SET name=?,website=? WHERE id=?')
            ->execute([$name, $website, $id]);
    } else {
        $stmt = $db->prepare('INSERT INTO store_developers(name,website) VALUES(?,?)');
        $stmt->execute([$name, $website]);
        $id = (int) $db->lastInsertId();
    }

    header('Content-Type: application/json');
    echo json_encode(['id' => $id, 'name' => $name, 'website' => $website]);
    exit;
}

$id = (int) ($_GET['id'] ?? 0);
if ($id) {
    $stmt = $db->prepare('SELECT id,name,website FROM store_developers WHERE id=?');
    $stmt->execute([$id]);
    $dev = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$dev) {
        http_response_code(404);
        exit;
    }
    $stmt = $db->prepare('SELECT appid,name FROM store_apps WHERE developer=? ORDER BY name');
    $stmt->execute([$dev['name']]);
    $dev['games'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($dev);
    exit;
}

http_response_code(400);

