<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../db.php';

// Check admin authentication
if (!cms_current_admin()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

// Ensure admin permissions
cms_require_permission('admin');

header('Content-Type: application/json');

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
            
        case 'delete':
            $response = handleFileDelete();
            break;
            
        case 'create_folder':
            $response = handleCreateFolder();
            break;
            
        default:
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    cms_admin_log('File manager error: ' . $e->getMessage());
}

echo json_encode($response);
exit;

function handleListFiles() {
    $requestedPath = $_POST['path'] ?? $_GET['path'] ?? 'images';
    $basePath = getBasePath();
    
    // Security: Normalize and validate path
    $requestedPath = trim($requestedPath, '/\\');
    $requestedPath = str_replace(['../', '..\\'], '', $requestedPath);
    
    // Define allowed upload directories
    $allowedPaths = [
        'images' => '/images',
        'storefront/images' => '/storefront/images',
        'storefront/images/capsules' => '/storefront/images/capsules',
        'storefront/images/apps' => '/storefront/images/apps',
        'themes' => '/themes',
        'platform/banner' => '/platform/banner',
        'media' => '/media',
        'uploads' => '/uploads'
    ];
    
    // Check if requested path is allowed
    $fullPath = null;
    foreach ($allowedPaths as $key => $dir) {
        if (strpos($requestedPath, $key) === 0) {
            $fullPath = $basePath . $dir;
            if ($requestedPath !== $key) {
                $subPath = substr($requestedPath, strlen($key));
                $fullPath .= $subPath;
            }
            break;
        }
    }
    
    if (!$fullPath || !is_dir($fullPath)) {
        // Default to images directory
        $fullPath = $basePath . '/images';
        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
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
            
            // Create proper URL path
            $urlPath = cms_base_url() . '/' . $relativePath;
            
            $files[] = [
                'name' => $filename,
                'path' => $urlPath,
                'size' => formatFileSize($fileInfo->getSize()),
                'modified' => date('Y-m-d H:i', $fileInfo->getMTime()),
                'thumbnail' => generateThumbnailPath($urlPath),
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

function handleFileUpload() {
    if (!isset($_FILES['file'])) {
        return ['success' => false, 'error' => 'No file uploaded'];
    }
    
    $file = $_FILES['file'];
    $uploadPath = $_POST['path'] ?? 'images';
    $basePath = getBasePath();
    
    // Security: Validate file
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB
    
    $filename = $file['name'];
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($extension, $allowedExtensions)) {
        return ['success' => false, 'error' => 'File type not allowed'];
    }
    
    if ($file['size'] > $maxFileSize) {
        return ['success' => false, 'error' => 'File too large (max 10MB)'];
    }
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'Upload error: ' . $file['error']];
    }
    
    // Validate and create target directory
    $uploadPath = trim($uploadPath, '/\\');
    $uploadPath = str_replace(['../', '..\\'], '', $uploadPath);
    
    $targetDir = $basePath . '/' . $uploadPath;
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            return ['success' => false, 'error' => 'Could not create upload directory'];
        }
    }
    
    // Generate unique filename to avoid conflicts
    $baseName = pathinfo($filename, PATHINFO_FILENAME);
    $baseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $baseName);
    $counter = 1;
    $finalFilename = $baseName . '.' . $extension;
    
    while (file_exists($targetDir . '/' . $finalFilename)) {
        $finalFilename = $baseName . '_' . $counter . '.' . $extension;
        $counter++;
    }
    
    $targetPath = $targetDir . '/' . $finalFilename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => false, 'error' => 'Failed to save uploaded file'];
    }
    
    // Generate relative path
    $relativePath = $uploadPath . '/' . $finalFilename;
    
    // Create proper URL path
    $urlPath = cms_base_url() . '/' . $relativePath;
    
    cms_admin_log("Uploaded file: $relativePath");
    
    return [
        'success' => true,
        'filename' => $finalFilename,
        'path' => $urlPath,
        'size' => formatFileSize(filesize($targetPath)),
        'message' => 'File uploaded successfully'
    ];
}

function handleFileDelete() {
    $filePath = $_POST['path'] ?? '';
    if (empty($filePath)) {
        return ['success' => false, 'error' => 'No file specified'];
    }
    
    $basePath = getBasePath();
    $fullPath = $basePath . '/' . ltrim($filePath, '/');
    
    // Security checks
    if (strpos($fullPath, $basePath) !== 0) {
        return ['success' => false, 'error' => 'Invalid file path'];
    }
    
    if (!file_exists($fullPath)) {
        return ['success' => false, 'error' => 'File not found'];
    }
    
    if (!is_file($fullPath)) {
        return ['success' => false, 'error' => 'Not a file'];
    }
    
    if (!unlink($fullPath)) {
        return ['success' => false, 'error' => 'Failed to delete file'];
    }
    
    cms_admin_log("Deleted file: $filePath");
    
    return ['success' => true, 'message' => 'File deleted successfully'];
}

function handleCreateFolder() {
    $folderName = $_POST['name'] ?? '';
    $parentPath = $_POST['path'] ?? 'images';
    
    if (empty($folderName)) {
        return ['success' => false, 'error' => 'Folder name required'];
    }
    
    // Sanitize folder name
    $folderName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $folderName);
    
    $basePath = getBasePath();
    $parentPath = trim($parentPath, '/\\');
    $parentPath = str_replace(['../', '..\\'], '', $parentPath);
    
    $targetDir = $basePath . '/' . $parentPath . '/' . $folderName;
    
    if (file_exists($targetDir)) {
        return ['success' => false, 'error' => 'Folder already exists'];
    }
    
    if (!mkdir($targetDir, 0755, true)) {
        return ['success' => false, 'error' => 'Failed to create folder'];
    }
    
    cms_admin_log("Created folder: $parentPath/$folderName");
    
    return ['success' => true, 'message' => 'Folder created successfully'];
}

function getBasePath() {
    return dirname(__DIR__, 2);
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

function generateThumbnailPath($imagePath) {
    // For now, just return the original image path
    // In a production environment, you might want to generate actual thumbnails
    return $imagePath;
}
?>