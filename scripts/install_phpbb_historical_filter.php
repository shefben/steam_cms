<?php
/**
 * Install phpBB Historical Data Filter
 *
 * This script applies all necessary modifications to phpBB for historical data filtering.
 */

require_once __DIR__ . '/phpbb_historical_filter.php';

function install_historical_filter()
{
    echo "Installing phpBB Historical Data Filter...\n";
    echo "========================================\n\n";

    // Method 1: Create extension (recommended)
    echo "Creating phpBB extension...\n";
    if (create_phpbb_historical_extension()) {
        echo "✓ Extension created successfully\n";
    } else {
        echo "✗ Failed to create extension\n";
        return false;
    }

    // Method 2: Create helper functions
    echo "\nCreating helper functions...\n";
    if (create_phpbb_helper_functions()) {
        echo "✓ Helper functions created\n";
    } else {
        echo "✗ Failed to create helper functions\n";
        return false;
    }

    echo "\n✓ Installation complete!\n\n";
    echo "Next steps:\n";
    echo "1. Enable the extension in phpBB Admin Panel > Customise > Extensions\n";
    echo "2. The extension will automatically filter historical data based on active style\n";
    echo "3. Historical data will only show with Steam 2003/2004 styles\n";
    echo "4. Real users can still post replies to historical threads\n";

    return true;
}

if (php_sapi_name() === 'cli') {
    install_historical_filter();
}
