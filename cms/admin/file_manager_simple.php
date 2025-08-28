<?php
// Simplified file manager that avoids any functions that might output HTML
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Simple admin check without calling functions that might output HTML
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] != 1) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

// Ensure we output JSON
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$response = ['success' => false, 'error' => ''];

try {
    switch ($action) {
        case 'list':
            $response = handleListFiles();
            break;
            
        case 'upload':
            $response = ['success' => false, 'error' => 'Upload not implemented in simplified version'];
            break;
            
        default:
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
exit;

function handleListFiles() {
    $requestedPath = $_POST['path'] ?? $_GET['path'] ?? 'images';
    
    // Get base path - simplified version
    $basePath = dirname(dirname(__DIR__)); // Go up to webroot
    
    // Security: Normalize and validate path
    $requestedPath = trim($requestedPath, '/\\');
    $requestedPath = str_replace(['../', '..\\'], '', $requestedPath);
    
    // Build full path
    $fullPath = $basePath . '/' . $requestedPath;
    
    if (!is_dir($fullPath)) {
        // Try default images directory
        $fullPath = $basePath . '/images';
        if (!is_dir($fullPath)) {
            return ['success' => false, 'error' => 'Directory not found: ' . $requestedPath];
        }
    }
    
    $files = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
    
    try {
        $iterator = new DirectoryIterator($fullPath);
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            
            $filename = $fileInfo->getFilename();
            $extension = strtolower($fileInfo->getExtension());
            
            // Only include image files
            if (!$fileInfo->isFile() || !in_array($extension, $allowedExtensions)) {
                continue;
            }
            
            $relativePath = str_replace($basePath, '', $fileInfo->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);
            $relativePath = ltrim($relativePath, '/');
            
            // Create proper URL path - simplified
            $urlPath = '/2004_cms/' . $relativePath;
            
            $files[] = [
                'name' => $filename,
                'path' => $urlPath,
                'size' => formatFileSize($fileInfo->getSize()),
                'modified' => date('Y-m-d H:i', $fileInfo->getMTime()),
                'thumbnail' => $urlPath, // Use same path for thumbnail
                'type' => $extension
            ];
        }
    } catch (Exception $e) {
        return ['success' => false, 'error' => 'Error reading directory: ' . $e->getMessage()];
    }
    
    // Sort files by name
    usort($files, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
    
    return [
        'success' => true,
        'files' => $files,
        'path' => $requestedPath,
        'total' => count($files)
    ];
}

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}
?>