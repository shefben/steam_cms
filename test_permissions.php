<?php
// Start session like admin pages do
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'cms/db.php';

echo "<h2>Testing Permission System</h2>";

// Function to debug cms_has_permission step by step
function debug_cms_has_permission($perm) {
    echo "<h3>Debug cms_has_permission('$perm')</h3>";
    
    $id = cms_current_admin();
    echo "1. Current admin ID: $id<br>";
    if(!$id) {
        echo "2. FAIL: No admin ID<br>";
        return false;
    }
    
    $db = cms_get_db();
    $row = $db->prepare('SELECT role_id, permissions FROM admin_users WHERE id=?');
    $row->execute([$id]);
    $info = $row->fetch(PDO::FETCH_ASSOC);
    echo "2. Admin info: " . json_encode($info) . "<br>";
    if(!$info) {
        echo "3. FAIL: No admin info found<br>";
        return false;
    }

    $perms = $info['permissions'];
    echo "3. Direct permissions: '$perms'<br>";
    
    if($info['role_id']){
        echo "4. Role ID: {$info['role_id']}<br>";
        $stmt = $db->prepare('SELECT permissions FROM admin_roles WHERE id=?');
        $stmt->execute([$info['role_id']]);
        $role_perms = $stmt->fetchColumn();
        echo "5. Role permissions: '$role_perms'<br>";
        $perms = $role_perms;
    } else {
        echo "4. No role ID<br>";
    }

    echo "6. Final permissions: '$perms'<br>";
    if($perms===false || $perms==='') {
        echo "7. FAIL: Empty permissions<br>";
        return false;
    }
    if($perms==='all') {
        echo "7. SUCCESS: Has 'all' permissions<br>";
        return true;
    }
    
    $list = array_map('trim', explode(',', $perms));
    echo "7. Permission list: " . json_encode($list) . "<br>";
    
    if(in_array($perm,$list)) {
        echo "8. SUCCESS: Found '$perm' in list<br>";
        return true;
    }
    
    // Check parents
    $parents = [
        'news_create'  => 'manage_news',
        'news_edit'    => 'manage_news', 
        'news_delete'  => 'manage_news',
        'faq_add'      => 'manage_faq',
        'faq_edit'     => 'manage_faq',
        'faq_delete'   => 'manage_faq',
        'faqcat_add'   => 'manage_faq',
        'faqcat_edit'  => 'manage_faq',
        'faqcat_delete'=> 'manage_faq'
    ];
    
    if(isset($parents[$perm])) {
        $parent = $parents[$perm];
        echo "8. Checking parent permission: '$parent'<br>";
        if(in_array($parent, $list)) {
            echo "9. SUCCESS: Found parent '$parent' in list<br>";
            return true;
        }
    }
    
    echo "8. FAIL: Permission not found<br>";
    return false;
}

// Test the permission
$result = debug_cms_has_permission('manage_store');
echo "<br><strong>Final result: " . ($result ? 'TRUE' : 'FALSE') . "</strong><br>";

echo "<br><h3>System Function Results:</h3>";
echo "cms_has_permission('manage_store'): " . (cms_has_permission('manage_store') ? 'TRUE' : 'FALSE') . "<br>";
echo "cms_current_admin(): " . cms_current_admin() . "<br>";
?>