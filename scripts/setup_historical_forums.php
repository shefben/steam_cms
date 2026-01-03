#!/usr/bin/env php
<?php
/**
 * Complete Historical Forum Data Setup Script
 *
 * This script sets up everything needed for conditional historical 2004 Steam forum data:
 * 1. Generates historical forum data SQL
 * 2. Modifies install.php to include historical data checkbox
 * 3. Creates phpBB extension for style-based filtering
 * 4. Provides complete installation instructions
 */

require_once __DIR__ . '/install_historical_forums.php';
require_once __DIR__ . '/phpbb_historical_filter.php';

function main() {
    echo "Historical Steam Forum Data Setup\n";
    echo "================================\n";
    echo "This script will set up conditional display of 2004 Steam forum data\n";
    echo "that only appears when using 2003_v2 or 2004 phpBB styles.\n\n";

    $steps_completed = 0;
    $total_steps = 5;

    // Step 1: Generate historical forum data
    echo "Step 1/$total_steps: Generating historical forum data...\n";
    echo "-----------------------------------------------\n";

    $scripts_dir = __DIR__;
    $historical_parser = $scripts_dir . '/vbulletin_parser_historical_with_attachments.py';
    $forums_dir = $scripts_dir . '/../forums';
    $output_file = $scripts_dir . '/historical_forum_data_with_attachments.sql';

    if (!file_exists($historical_parser)) {
        echo "✗ Historical parser not found: $historical_parser\n";
        echo "Please ensure vbulletin_parser_historical.py exists in the scripts directory.\n";
        return false;
    }

    if (!is_dir($forums_dir)) {
        echo "✗ Forums directory not found: $forums_dir\n";
        echo "Please ensure the forums directory with VBulletin archives exists.\n";
        return false;
    }

    echo "Running parser: python \"$historical_parser\" \"$forums_dir\" \"$output_file\"\n";
    $command = "python \"$historical_parser\" \"$forums_dir\" \"$output_file\"";
    $output = [];
    $return_var = 0;
    exec($command . ' 2>&1', $output, $return_var);

    if ($return_var === 0 && file_exists($output_file)) {
        echo "✓ Generated historical forum data: " . basename($output_file) . "\n";
        echo "  File size: " . number_format(filesize($output_file)) . " bytes\n";
        $steps_completed++;
    } else {
        echo "✗ Failed to generate historical forum data\n";
        echo "Command output:\n" . implode("\n", $output) . "\n";
        return false;
    }

    echo "\n";

    // Step 1.5: Prepare attachments
    echo "Step 1.5/$total_steps: Preparing attachment files...\n";
    echo "--------------------------------------------\n";

    $attachment_manager = $scripts_dir . '/attachment_manager.php';
    if (file_exists($attachment_manager)) {
        $command = "php \"$attachment_manager\" prepare \"$forums_dir\"";
        $output = [];
        $return_var = 0;
        exec($command . ' 2>&1', $output, $return_var);

        if ($return_var === 0) {
            echo "✓ Prepared attachment files for distribution\n";
        } else {
            echo "✗ Failed to prepare attachment files\n";
            echo "Command output:\n" . implode("\n", $output) . "\n";
        }
    } else {
        echo "⚠ Attachment manager not found: $attachment_manager\n";
    }

    echo "\n";

    // Step 2: Modify install.php
    echo "Step 2/$total_steps: Modifying install.php...\n";
    echo "--------------------------------------\n";

    if (add_historical_forum_checkbox_to_install()) {
        echo "✓ Modified install.php with historical forum data checkbox\n";
        $steps_completed++;
    } else {
        echo "✗ Failed to modify install.php\n";
        return false;
    }

    echo "\n";

    // Step 3: Create phpBB extension
    echo "Step 3/$total_steps: Creating phpBB historical filter extension...\n";
    echo "---------------------------------------------------\n";

    if (create_phpbb_historical_extension()) {
        echo "✓ Created phpBB historical filter extension\n";
        $steps_completed++;
    } else {
        echo "✗ Failed to create phpBB extension\n";
        return false;
    }

    echo "\n";

    // Step 4: Create helper functions
    echo "Step 4/$total_steps: Creating phpBB helper functions...\n";
    echo "--------------------------------------------\n";

    if (create_phpbb_helper_functions()) {
        echo "✓ Created phpBB helper functions\n";
        $steps_completed++;
    } else {
        echo "✗ Failed to create helper functions\n";
        return false;
    }

    echo "\n";

    // Step 5: Create documentation
    echo "Step 5/$total_steps: Creating documentation...\n";
    echo "-----------------------------------\n";

    if (create_installation_documentation()) {
        echo "✓ Created installation documentation\n";
        $steps_completed++;
    } else {
        echo "✗ Failed to create documentation\n";
        return false;
    }

    echo "\n";

    // Summary
    echo "Setup Complete!\n";
    echo "===============\n";
    echo "Successfully completed $steps_completed/$total_steps steps.\n\n";

    echo "Files created:\n";
    echo "- historical_forum_data_with_attachments.sql (Forum data with attachments)\n";
    echo "- attachments_staging/ (Historical attachment files ready for installation)\n";
    echo "- install.php.backup.* (Backup of original install.php)\n";
    echo "- forum/ext/steamcms/historical_filter/ (phpBB extension)\n";
    echo "- forum/includes/historical_filter.php (Helper functions)\n";
    echo "- HISTORICAL_FORUMS_INSTALLATION_GUIDE.txt (Complete guide)\n\n";

    echo "Next Steps:\n";
    echo "1. Run the CMS installer (install.php) in your browser\n";
    echo "2. On Step 2, check 'Insert official 2004 forum data'\n";
    echo "3. Complete the installation\n";
    echo "4. Enable the 'Historical Data Filter' extension in phpBB Admin Panel\n";
    echo "5. Test with different phpBB styles to verify filtering\n\n";

    echo "How it works:\n";
    echo "- Historical data only appears with Steam 2003/2004 styles\n";
    echo "- Real users can post replies to historical threads\n";
    echo "- Historical users have '[2004]' prefix and special email domains\n";
    echo "- Historical attachments are automatically copied to phpBB files directory\n";
    echo "- No avatar files are needed (historical users have no avatars)\n";

    return true;
}

function create_installation_documentation() {
    $doc_file = __DIR__ . '/../HISTORICAL_FORUMS_INSTALLATION_GUIDE.txt';

    $documentation = "Historical Steam Forums Installation Guide
==========================================

This guide explains how to install and use the historical 2004 Steam forum data
that conditionally displays based on the active phpBB style.

OVERVIEW
--------
The historical forum system adds authentic 2004 Steam forum content to your phpBB
installation while keeping it separate from modern user content. Historical data
only appears when using the 2003_v2 or 2004 phpBB styles, creating an authentic
period-appropriate experience.

FEATURES
--------
✓ Historical forum data only visible with specific styles
✓ Real users can reply to historical threads
✓ No avatar dependencies (historical users have no avatars)
✓ Separate ID ranges prevent conflicts with real users
✓ Automatic filtering based on active style

INSTALLATION STEPS
------------------

1. SETUP HISTORICAL DATA
   Run: php scripts/setup_historical_forums.php
   This generates all necessary files and modifications.

2. RUN CMS INSTALLER
   - Open install.php in your browser
   - Complete Step 1 (Database Configuration)
   - On Step 2, CHECK 'Insert official 2004 forum data'
   - Complete the installation

3. ENABLE PHPBB EXTENSION
   - Log into phpBB Admin Panel
   - Go to Customise > Extensions
   - Find 'Historical Data Filter' and click Enable
   - Clear phpBB cache

4. TEST THE SYSTEM
   - Switch to Steam 2003 or 2004 style - historical data appears
   - Switch to other styles - historical data hidden
   - Create test posts as real users - they appear in all styles

TECHNICAL DETAILS
-----------------

Historical Data Identification:
- Users: ID 100000+ with '[2004]' prefix
- Forums: ID 1000+ with historical descriptions
- Threads: ID 100000+ with '[2004]' prefix in title
- Posts: ID 1000000+ with historical content

Database Schema:
- Added 'is_historical' column to users, forums, topics, posts tables
- Historical data marked with is_historical = 1
- Real data has is_historical = 0 or NULL

Style Detection:
- Extension checks active style name
- Allowed styles: 'Steam 2003', 'Steam 2004', 'steam_2003', 'steam_2004', '2003_v2', '2004'
- SQL queries filtered automatically via event listeners

TROUBLESHOOTING
---------------

Historical data not appearing:
- Verify style name matches allowed list
- Check extension is enabled in Admin Panel
- Confirm historical data was imported during installation

Historical data appearing in wrong styles:
- Clear phpBB cache
- Check extension event listeners are working
- Verify style names are correct

Database errors:
- Ensure is_historical columns exist in all tables
- Run extension migration if needed
- Check SQL queries include proper filtering

Real users can't post:
- This is normal behavior - extension only filters display
- Real users can always post new content
- Their posts appear in all styles

FILES AND DIRECTORIES
---------------------

Generated Files:
- scripts/historical_forum_data.sql (Historical data SQL)
- forum/ext/steamcms/historical_filter/ (phpBB extension)
- forum/includes/historical_filter.php (Helper functions)
- install.php.backup.* (Original install.php backup)

Extension Structure:
- composer.json (Extension metadata)
- ext.php (Extension configuration)
- config/services.yml (Service definitions)
- event/main_listener.php (Event handlers)
- migrations/add_historical_columns.php (Database schema)

MAINTENANCE
-----------

To update historical data:
1. Regenerate: php scripts/vbulletin_parser_historical.py
2. Run SQL updates in database
3. Clear phpBB cache

To add new allowed styles:
1. Edit event/main_listener.php
2. Update \$allowed_styles array
3. Clear phpBB cache

To disable historical data:
1. Disable extension in Admin Panel
2. Historical data becomes hidden in all styles

SUPPORT
-------

Common issues and solutions are documented in this guide.
For additional help, check:
- phpBB logs in Admin Panel
- Web server error logs
- Database query logs

The system is designed to be safe - if anything fails, historical
data simply becomes hidden without affecting real forum operation.

Generated on: " . date('Y-m-d H:i:s') . "
";

    file_put_contents($doc_file, $documentation);
    echo "✓ Created installation guide: " . basename($doc_file) . "\n";

    return true;
}

// Execute if run from command line
if (php_sapi_name() === 'cli') {
    if (!main()) {
        exit(1);
    }
} else {
    echo "This script must be run from the command line.\n";
    echo "Usage: php " . basename(__FILE__) . "\n";
}
?>