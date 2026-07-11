<?php
/**
 * Simple File API
 * Provides basic file listing and management operations for admin file pickers
 */

require_once '../db.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$path = trim($_POST['path'] ?? $_GET['path'] ?? '');

// Sanitize path to prevent directory traversal
$basePath = dirname(dirname(__DIR__));
$path = str_replace('..', '', $path);
$path = ltrim($path, '/');
$fullPath = $basePath . '/' . $path;

// Ensure the path is within the base directory
if (strpos(realpath($fullPath), realpath($basePath)) !== 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid path']);
    exit;
}

switch ($action) {
    case 'list':
        if (!is_dir($fullPath)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Directory not found']);
            exit;
        }

        $files = [];
        try {
            $items = scandir($fullPath);
            if ($items === false) {
                throw new Exception('Failed to read directory');
            }

            foreach ($items as $item) {
                if ($item === '.' || $item === '..') {
                    continue;
                }

                $itemPath = $fullPath . '/' . $item;
                if (is_file($itemPath)) {
                    $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                    // Only show image files
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                        $files[] = [
                            'name' => $item,
                            'path' => $path . '/' . $item,
                            'type' => 'file',
                            'size' => filesize($itemPath),
                            'url' => '/' . $path . '/' . $item
                        ];
                    }
                }
            }

            echo json_encode(['success' => true, 'files' => $files]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Unknown action']);
        break;
}
?>
