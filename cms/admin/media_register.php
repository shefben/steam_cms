<?php
require_once 'admin_header.php';

// Ensure admin permissions
cms_require_permission('manage_pages');

header('Content-Type: application/json');

$response = ['success' => false, 'error' => ''];

try {
    $filename = $_POST['filename'] ?? '';
    
    if (empty($filename)) {
        $response['error'] = 'No filename provided';
    } else {
        $db = cms_get_db();
        
        // Check if file already exists in database
        $stmt = $db->prepare('SELECT id FROM media WHERE filename = ?');
        $stmt->execute([$filename]);
        
        if ($stmt->fetch()) {
            $response['success'] = true;
            $response['message'] = 'File already registered';
        } else {
            // Register the new file
            $stmt = $db->prepare('INSERT INTO media(filename, uploaded) VALUES(?, NOW())');
            $stmt->execute([$filename]);
            
            $response['success'] = true;
            $response['message'] = 'File registered successfully';
            $response['id'] = $db->lastInsertId();
            
            cms_admin_log("Registered media file: $filename");
        }
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    cms_admin_log('Media register error: ' . $e->getMessage());
}

echo json_encode($response);
exit;
?>