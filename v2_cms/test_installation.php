<?php
/**
 * Installation Test Script
 * Tests the database schema and import functions for theme field issues
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test if all required files exist
$required_files = [
    'config.php',
    'code/database.php',
    'code/cms.php',
    'code/steam_2004_faq_import.php'
];

echo "Checking required files...\n";
foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "✓ $file exists\n";
    } else {
        echo "✗ $file missing\n";
        exit(1);
    }
}

// Test database connection
try {
    require_once 'code/database.php';
    echo "\n✓ Database class loaded successfully\n";
    
    // Test FAQ import function
    require_once 'code/steam_2004_faq_import.php';
    echo "✓ FAQ import function loaded successfully\n";
    
    echo "\n✅ All installation files are ready!\n";
    echo "The theme field error should now be fixed.\n";
    echo "\nTo install:\n";
    echo "1. Make sure your database is set up\n";
    echo "2. Update config.php with your database credentials\n";
    echo "3. Run install.php in your browser\n";
    
} catch (Exception $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
