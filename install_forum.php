<?php

declare(strict_types=1);

/**
 * Forum Installation Script
 * This script sets up the database tables and initial data for the Steam Forum system
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/database.php';

try {
    echo "Starting Steam Forum Installation...\n\n";
    
    // Read and execute the main forum tables migration
    echo "Creating forum tables...\n";
    $mainMigration = file_get_contents(__DIR__ . '/database/migrations/create_forum_tables.sql');
    if (!$mainMigration) {
        throw new Exception('Could not read main migration file');
    }
    
    // Split and execute each statement
    $statements = explode(';', $mainMigration);
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $db->exec($statement);
        }
    }
    echo "✓ Main forum tables created\n";
    
    // Read and execute the moderation migration
    echo "Adding moderation features...\n";
    $moderationMigration = file_get_contents(__DIR__ . '/database/migrations/add_forum_moderation.sql');
    if (!$moderationMigration) {
        throw new Exception('Could not read moderation migration file');
    }
    
    $statements = explode(';', $moderationMigration);
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $db->exec($statement);
        }
    }
    echo "✓ Moderation features added\n";
    
    // Create theme directory structure
    echo "Setting up theme structure...\n";
    $themeDir = __DIR__ . '/themes/2002_forum';
    $directories = [
        $themeDir,
        $themeDir . '/templates',
        $themeDir . '/templates/forum',
        $themeDir . '/templates/errors',
        $themeDir . '/assets',
        $themeDir . '/assets/images',
        $themeDir . '/assets/images/buttons',
        $themeDir . '/assets/images/buttons/grey',
        $themeDir . '/assets/images/shared'
    ];
    
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    echo "✓ Theme directories created\n";
    
    // Copy forum assets from archived files
    echo "Copying forum assets...\n";
    $sourceAssets = __DIR__ . '/archived_steampowered/2002/v2/forum';
    $targetAssets = $themeDir . '/assets';
    
    // Copy images
    if (is_dir($sourceAssets . '/images')) {
        copyDirectory($sourceAssets . '/images', $targetAssets . '/images');
    }
    
    if (is_dir($sourceAssets . '/support/Images')) {
        copyDirectory($sourceAssets . '/support/Images', $targetAssets . '/images');
    }
    
    echo "✓ Assets copied\n";
    
    // Verify installation
    echo "Verifying installation...\n";
    
    $tables = [
        'forum_categories',
        'forum_boards', 
        'forum_users',
        'forum_threads',
        'forum_posts',
        'forum_moderators',
        'forum_sessions',
        'forum_settings',
        'forum_private_messages',
        'forum_user_bans',
        'forum_moderation_log',
        'forum_permissions',
        'forum_user_warnings'
    ];
    
    foreach ($tables as $table) {
        $stmt = $db->query("SHOW TABLES LIKE '{$table}'");
        if ($stmt->rowCount() === 0) {
            throw new Exception("Table {$table} was not created");
        }
    }
    echo "✓ All tables verified\n";
    
    // Check if default data exists
    $stmt = $db->query("SELECT COUNT(*) FROM forum_boards");
    $boardCount = $stmt->fetchColumn();
    echo "✓ Found {$boardCount} forum boards\n";
    
    $stmt = $db->query("SELECT COUNT(*) FROM forum_users WHERE is_admin = 1");
    $adminCount = $stmt->fetchColumn();
    echo "✓ Found {$adminCount} admin users\n";
    
    echo "\n🎉 Steam Forum Installation Complete!\n\n";
    echo "Default Admin Credentials:\n";
    echo "Email: admin@steampowered.com\n";
    echo "Password: password\n\n";
    echo "Forum URL: /forum\n";
    echo "Ban User URL: /forum/ban/user/{user_id}?board_id={board_id}\n\n";
    echo "Features installed:\n";
    echo "- Full forum system with categories, boards, threads, posts\n";
    echo "- User authentication (login/logout/registration)\n";
    echo "- User profiles and private messaging\n";
    echo "- Administration panel with user management\n";
    echo "- Moderation tools including user banning\n";
    echo "- Pixel-perfect recreation of original Steam forum design\n";
    echo "- Customizable categories and boards\n\n";
    
} catch (Exception $e) {
    echo "❌ Installation failed: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}

function copyDirectory($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            copy($item, $target);
        }
    }
}