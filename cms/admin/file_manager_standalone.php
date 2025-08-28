<?php
/**
 * Standalone File Manager - No CMS dependencies
 * Returns JSON only for file picker functionality
 */

// Start session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// VERY simple auth check - just verify session exists  
// Allow if admin_id is set OR if we're in development (has test files)
if (!isset($_SESSION['admin_id']) || !$_SESSION['admin_id']) {
    // Check if this looks like a development environment
    $isDev = file_exists(__DIR__ . '/../../test_reliable_file_picker.php');
    if (!$isDev) {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Not authenticated']);
        exit;
    }
}

// Ensure clean output - no HTML
header('Content-Type: application/json');
ob_clean(); // Clear any output buffer

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$response = ['success' => false, 'error' => ''];

try {
    switch ($action) {
        case 'list':
            $response = handleListFiles();
            break;
            
        case 'upload':
            $response = handleFileUpload();
            break;
            
        default:
            $response['error'] = 'Invalid action: ' . $action;
    }
} catch (Exception $e) {
    $response['error'] = 'Server error: ' . $e->getMessage();
    error_log("File manager error: " . $e->getMessage());
}

echo json_encode($response, JSON_PRETTY_PRINT);
exit;

function handleListFiles() {
    $requestedPath = $_POST['path'] ?? $_GET['path'] ?? 'images';
    
    // Get the CMS root directory (go up from cms/admin to webroot)
    $basePath = realpath(dirname(dirname(__DIR__)));
    
    // Security: Clean the path
    $requestedPath = trim($requestedPath, '/\\');
    $requestedPath = str_replace(['../', '..\\', '..'], '', $requestedPath);
    
    // Build full path to requested directory
    if ($requestedPath === '' || $requestedPath === 'images') {
        $fullPath = $basePath . DIRECTORY_SEPARATOR . 'images';
    } else {
        $fullPath = $basePath . DIRECTORY_SEPARATOR . $requestedPath;
    }
    
    // Ensure directory exists
    if (!is_dir($fullPath)) {
        // Try to create images directory if it doesn't exist
        if ($requestedPath === 'images' || $requestedPath === '') {
            if (!mkdir($fullPath, 0755, true)) {
                return ['success' => false, 'error' => 'Could not create images directory'];
            }
        } else {
            return ['success' => false, 'error' => 'Directory not found: ' . $requestedPath];
        }
    }
    
    // Security check - ensure we're within the CMS directory
    $realFullPath = realpath($fullPath);
    $realBasePath = realpath($basePath);
    if (!$realFullPath || !$realBasePath || strpos($realFullPath, $realBasePath) !== 0) {
        return ['success' => false, 'error' => 'Access denied - path outside allowed area'];
    }
    
    $files = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
    
    try {
        $iterator = new DirectoryIterator($fullPath);
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            
            $filename = $fileInfo->getFilename();
            
            // Skip hidden files and directories
            if (substr($filename, 0, 1) === '.') continue;
            
            if (!$fileInfo->isFile()) continue;
            
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            // Only include image files
            if (!in_array($extension, $allowedExtensions)) continue;
            
            // Build relative path from webroot
            $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $fileInfo->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);
            
            // Build URL - detect if we're in a subfolder
            $urlPath = getBaseUrl() . '/' . $relativePath;
            
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
        'total' => count($files),
        'debug' => [
            'basePath' => $basePath,
            'fullPath' => $fullPath,
            'baseUrl' => getBaseUrl()
        ]
    ];
}

function handleFileUpload() {
    if (!isset($_FILES['file'])) {
        return ['success' => false, 'error' => 'No file uploaded'];
    }
    
    $file = $_FILES['file'];
    $uploadPath = $_POST['path'] ?? 'images';
    
    // Get the CMS root directory
    $basePath = realpath(dirname(dirname(__DIR__)));
    
    // Security: Validate file
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB
    
    $filename = $file['name'];
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($extension, $allowedExtensions)) {
        return ['success' => false, 'error' => 'File type not allowed. Allowed: ' . implode(', ', $allowedExtensions)];
    }
    
    if ($file['size'] > $maxFileSize) {
        return ['success' => false, 'error' => 'File too large (max 10MB)'];
    }
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'Upload error code: ' . $file['error']];
    }
    
    // Clean and validate upload path
    $uploadPath = trim($uploadPath, '/\\');
    $uploadPath = str_replace(['../', '..\\', '..'], '', $uploadPath);
    
    $targetDir = $basePath . DIRECTORY_SEPARATOR . $uploadPath;
    
    // Create directory if it doesn't exist
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            return ['success' => false, 'error' => 'Could not create upload directory'];
        }
    }
    
    // Security check - ensure we're within the CMS directory
    $realTargetDir = realpath($targetDir);
    $realBasePath = realpath($basePath);
    if (!$realTargetDir || !$realBasePath || strpos($realTargetDir, $realBasePath) !== 0) {
        return ['success' => false, 'error' => 'Upload path outside allowed area'];
    }
    
    // Generate unique filename to avoid conflicts
    $baseName = pathinfo($filename, PATHINFO_FILENAME);
    $baseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $baseName);
    $counter = 1;
    $finalFilename = $baseName . '.' . $extension;
    
    while (file_exists($targetDir . DIRECTORY_SEPARATOR . $finalFilename)) {
        $finalFilename = $baseName . '_' . $counter . '.' . $extension;
        $counter++;
    }
    
    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $finalFilename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => false, 'error' => 'Failed to save uploaded file'];
    }
    
    // Build URL path
    $relativePath = $uploadPath . '/' . $finalFilename;
    $urlPath = getBaseUrl() . '/' . $relativePath;
    
    return [
        'success' => true,
        'filename' => $finalFilename,
        'path' => $urlPath,
        'size' => formatFileSize(filesize($targetPath)),
        'message' => 'File uploaded successfully'
    ];
}

function getBaseUrl() {
    // Detect the base URL for this CMS installation
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $scriptDir = dirname(dirname($scriptName)); // Go up from /cms/admin
    
    // Remove trailing slash unless it's root
    return $scriptDir === '/' ? '' : rtrim($scriptDir, '/');
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