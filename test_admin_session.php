<?php
// Test script to check admin session - simulates admin_header.php logic
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';

echo "<h2>Admin Session Test</h2>";

echo "<h3>Session Data:</h3>";
echo "Session ID: " . session_id() . "<br>";
echo "Admin ID in session: " . ($_SESSION['admin_id'] ?? 'NOT SET') . "<br>";
echo "Admin logged in flag: " . ($_SESSION['admin_logged_in'] ?? 'NOT SET') . "<br>";

// Test current admin function
$current_admin = cms_current_admin();
echo "<br><h3>Admin Functions:</h3>";
echo "cms_current_admin(): " . ($current_admin ?: 'NULL/FALSE') . "<br>";

if (!$current_admin) {
    echo "<strong>No admin logged in!</strong><br>";
    
    // Check for admin token in cookies (like admin_header.php does)
    if (isset($_COOKIE['cms_admin_token'])) {
        echo "Found admin token cookie, attempting validation...<br>";
        $uid = cms_validate_admin_token($_COOKIE['cms_admin_token']);
        echo "Token validation result: " . ($uid ?: 'FAILED') . "<br>";
        
        if ($uid) {
            echo "Setting session from token...<br>";
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $uid;
            
            // Test again
            $current_admin = cms_current_admin();
            echo "After token validation - cms_current_admin(): " . ($current_admin ?: 'STILL NULL') . "<br>";
        }
    } else {
        echo "No admin token cookie found<br>";
    }
    
    if (!$current_admin) {
        echo "<br><strong>PROBLEM: Admin is not logged in!</strong><br>";
        echo "You need to log in at: <a href='cms/login.php'>cms/login.php</a><br>";
        exit;
    }
}

echo "<br><h3>Permission Tests:</h3>";
echo "Has manage_store: " . (cms_has_permission('manage_store') ? 'YES' : 'NO') . "<br>";
echo "Has manage_news: " . (cms_has_permission('manage_news') ? 'YES' : 'NO') . "<br>";
echo "Has all: " . (cms_has_permission('all') ? 'YES' : 'NO') . "<br>";

// Get admin details
$db = cms_get_db();
$stmt = $db->prepare('SELECT username, role_id FROM admin_users WHERE id=?');
$stmt->execute([$current_admin]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin) {
    echo "<br><h3>Admin Details:</h3>";
    echo "Username: " . htmlspecialchars($admin['username']) . "<br>";
    echo "Role ID: " . $admin['role_id'] . "<br>";
    
    // Get role permissions
    if ($admin['role_id']) {
        $stmt = $db->prepare('SELECT name, permissions FROM admin_roles WHERE id=?');
        $stmt->execute([$admin['role_id']]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($role) {
            echo "Role: " . htmlspecialchars($role['name']) . "<br>";
            echo "Permissions: " . htmlspecialchars($role['permissions']) . "<br>";
        }
    }
}

echo "<br><strong>If all looks good above, then you should be able to access admin pages!</strong>";
?>