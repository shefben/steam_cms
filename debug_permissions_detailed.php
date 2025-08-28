<?php
// Start session like admin pages do
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'cms/db.php';

$db = cms_get_db();

echo "<h2>Detailed Permission Debug</h2>";

try {
    // Session debugging
    echo "<h3>Session Info:</h3>";
    echo "Session ID: " . session_id() . "<br>";
    echo "Session Status: " . session_status() . "<br>";
    echo "Session admin_id: " . ($_SESSION['admin_id'] ?? 'Not set') . "<br>";
    echo "Session admin_logged_in: " . ($_SESSION['admin_logged_in'] ?? 'Not set') . "<br><br>";

    // Check current admin
    $current_admin = cms_current_admin();
    echo "<h3>Current Admin:</h3>";
    echo "Current Admin ID: " . ($current_admin ?: 'None') . "<br><br>";
    
    if ($current_admin) {
        echo "<h3>Step-by-step Permission Check for 'manage_store':</h3>";
        
        // Step 1: Get admin user info
        $row = $db->prepare('SELECT role_id, permissions FROM admin_users WHERE id=?');
        $row->execute([$current_admin]);
        $info = $row->fetch(PDO::FETCH_ASSOC);
        echo "1. Admin user info: " . json_encode($info) . "<br>";
        
        if (!$info) {
            echo "   ERROR: No admin user found!<br>";
        } else {
            // Step 2: Check direct permissions
            $perms = $info['permissions'];
            echo "2. Direct user permissions: '" . $perms . "'<br>";
            
            // Step 3: Check role permissions if role_id exists
            if ($info['role_id']) {
                echo "3. Role ID found: " . $info['role_id'] . "<br>";
                $stmt = $db->prepare('SELECT permissions FROM admin_roles WHERE id=?');
                $stmt->execute([$info['role_id']]);
                $role_perms = $stmt->fetchColumn();
                echo "4. Role permissions: '" . $role_perms . "'<br>";
                $perms = $role_perms;  // Override with role permissions
            } else {
                echo "3. No role ID found<br>";
            }
            
            // Step 4: Check permission logic
            echo "5. Final permissions to check: '" . $perms . "'<br>";
            
            if ($perms === false || $perms === '') {
                echo "6. FAIL: Permissions are false or empty<br>";
            } elseif ($perms === 'all') {
                echo "6. SUCCESS: Has 'all' permissions<br>";
            } else {
                $list = array_map('trim', explode(',', $perms));
                echo "6. Permission list: " . json_encode($list) . "<br>";
                echo "7. Looking for 'manage_store' in list: " . (in_array('manage_store', $list) ? 'FOUND' : 'NOT FOUND') . "<br>";
            }
        }
        
        // Final test
        echo "<br><h3>Final Permission Tests:</h3>";
        echo "Has 'manage_store' permission: " . (cms_has_permission('manage_store') ? 'YES' : 'NO') . "<br>";
        echo "Has 'all' permission check: " . (cms_has_permission('all') ? 'YES' : 'NO') . "<br>";
        
    } else {
        echo "<strong>User is not logged in - this is the problem!</strong><br>";
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "<br>";
}
?>