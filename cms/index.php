<?php
/**
 * CMS Directory Index
 * Redirects to login.php if not logged in, or admin/index.php if logged in
 */

session_start();
require_once __DIR__ . '/db.php';

// Check for existing session
$isLoggedIn = cms_current_admin() ? true : false;

// If not logged in via session, check for remember-me cookie
if (!$isLoggedIn && isset($_COOKIE['cms_admin_token'])) {
    $uid = cms_validate_admin_token($_COOKIE['cms_admin_token']);
    if ($uid) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $uid;
        $_SESSION['admin_logged_in'] = true;
        $isLoggedIn = true;
    }
}

// Redirect based on login status
if ($isLoggedIn) {
    header('Location: admin/index.php');
} else {
    header('Location: login.php');
}
exit;
