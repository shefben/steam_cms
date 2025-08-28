<?php
// Start session like admin pages do
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'cms/db.php';

$db = cms_get_db();

echo "<h2>Admin Permissions Debug</h2>";

try {
    // Session debugging
    echo "<h3>Session Info:</h3>";
    echo "Session ID: " . session_id() . "<br>";
    echo "Session Status: " . session_status() . "<br>";
    echo "Session admin_id: " . ($_SESSION['admin_id'] ?? 'Not set') . "<br>";
    echo "Session admin_logged_in: " . ($_SESSION['admin_logged_in'] ?? 'Not set') . "<br><br>";

    // Check current admin
    $current_admin = cms_current_admin();
    echo "Current Admin ID: " . ($current_admin ?: 'None') . "<br><br>";
    
    // Check admin users and their permissions
    $stmt = $db->query('SELECT id, username, role_id, permissions FROM admin_users');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Admin Users:</h3>";
    foreach($users as $user) {
        echo "ID: {$user['id']}, Username: {$user['username']}, Role: {$user['role_id']}, Permissions: {$user['permissions']}<br>";
    }
    echo "<br>";
    
    // Check admin roles
    $stmt = $db->query('SELECT id, name, permissions FROM admin_roles');
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Admin Roles:</h3>";
    foreach($roles as $role) {
        echo "ID: {$role['id']}, Name: {$role['name']}, Permissions: {$role['permissions']}<br>";
    }
    
    // Test specific permission
    echo "<br><h3>Permission Tests:</h3>";
    echo "Has 'manage_store' permission: " . (cms_has_permission('manage_store') ? 'YES' : 'NO') . "<br>";
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "<br>";
}
?>