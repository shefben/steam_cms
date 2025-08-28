<?php
// Direct test of file_manager.php without authentication issues
echo "Testing file_manager.php directly...\n";

// Set up minimal session for testing
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mock admin authentication for testing
$_SESSION['admin_id'] = 1;

// Include required files
require_once __DIR__ . '/cms/db.php';

// Test the file manager functions directly
require_once __DIR__ . '/cms/admin/file_manager.php';
?>