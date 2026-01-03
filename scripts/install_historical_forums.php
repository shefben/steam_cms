<?php
/**
 * Historical Forum Data Installation for SteamCMS
 *
 * This script modifies the SteamCMS install.php to add support for installing
 * historical 2004 Steam forum data that only displays with specific phpBB styles.
 */

function add_historical_forum_checkbox_to_install() {
    $install_file = __DIR__ . '/../install.php';

    if (!file_exists($install_file)) {
        echo "Error: install.php not found\n";
        return false;
    }

    $content = file_get_contents($install_file);

    // Add checkbox to the admin form (Step 2)
    $checkbox_html = '            <div class="form-group">
                <label><input type="checkbox" name="install_2004_forum_data" value="1" checked> Insert official 2004 forum data</label>
                <small class="form-text text-muted">Includes historical Steam forum threads and posts from 2004. Only visible when using 2003_v2 or 2004 phpBB styles.</small>
            </div>';

    // Insert after the "use_official_survey" checkbox
    $pattern = '/(<div class="form-group">\s*<label><input type="checkbox" name="use_official_survey"[^>]*>[^<]*<\/label>\s*<\/div>)/';
    $replacement = '$1' . "\n" . $checkbox_html;

    if (preg_match($pattern, $content)) {
        $content = preg_replace($pattern, $replacement, $content);
        echo "✓ Added historical forum data checkbox to install form\n";
    } else {
        echo "⚠ Could not find survey checkbox to add historical forum checkbox after\n";
        return false;
    }

    // Add processing of the checkbox in the POST handler
    $post_handler_pattern = '/(\$admin_email = trim\(\$_POST\[\'admin_email\'\]\);)/';
    $post_handler_addition = '$1' . "\n" . '        $install_historical_data = isset($_POST[\'install_2004_forum_data\']) ? 1 : 0;';

    if (preg_match($post_handler_pattern, $content)) {
        $content = preg_replace($post_handler_pattern, $post_handler_addition, $content);
        echo "✓ Added historical data processing to POST handler\n";
    } else {
        echo "⚠ Could not find admin_email POST processing\n";
        return false;
    }

    // Add historical data installation after phpBB installation
    $phpbb_install_pattern = '/(install_phpbb_forum\(\$pdo, \$phpbbInstallConfig, \$admin_user, \$admin_pass, \$admin_email\);)/';
    $historical_install_code = '$1' . "\n\n" . '                // Install historical 2004 forum data if checkbox was checked
                if ($install_historical_data) {
                    echo "Installing historical 2004 forum data...\\n";

                    // Install SQL data
                    $historical_sql_file = __DIR__ . \'/scripts/historical_forum_data_with_attachments.sql\';
                    if (file_exists($historical_sql_file)) {
                        try {
                            run_sql_file($pdo, $historical_sql_file);
                            echo "✓ Installed historical forum data\\n";
                        } catch (Exception $e) {
                            error_log(\'Historical forum data installation error: \' . $e->getMessage());
                            echo "⚠ Historical forum data installation failed: " . $e->getMessage() . "\\n";
                        }
                    } else {
                        echo "⚠ Historical forum data file not found: $historical_sql_file\\n";
                    }

                    // Install attachment files
                    $attachments_staging = __DIR__ . \'/attachments_staging\';
                    $phpbb_files_dir = __DIR__ . \'/forum/files\';
                    if (is_dir($attachments_staging)) {
                        try {
                            if (!is_dir($phpbb_files_dir)) {
                                mkdir($phpbb_files_dir, 0755, true);
                            }

                            $attachment_files = glob($attachments_staging . \'/attachment_*.???*\');
                            $copied_count = 0;

                            foreach ($attachment_files as $source_file) {
                                $filename = basename($source_file);
                                if (preg_match(\'/attachment_(\\d+)\\.(\\w+)/\', $filename, $matches)) {
                                    $vb_id = intval($matches[1]);
                                    $extension = $matches[2];
                                    $phpbb_id = 100000 + $vb_id;
                                    $timestamp = time();
                                    $dest_filename = "{$phpbb_id}_{$timestamp}.{$extension}";
                                    $dest_file = $phpbb_files_dir . \'/\' . $dest_filename;

                                    if (copy($source_file, $dest_file)) {
                                        chmod($dest_file, 0644);
                                        $copied_count++;
                                    }
                                }
                            }

                            if ($copied_count > 0) {
                                echo "✓ Installed {$copied_count} historical attachment files\\n";
                            }
                        } catch (Exception $e) {
                            error_log(\'Historical attachment installation error: \' . $e->getMessage());
                            echo "⚠ Historical attachment installation failed: " . $e->getMessage() . "\\n";
                        }
                    }
                }';

    if (preg_match($phpbb_install_pattern, $content)) {
        $content = preg_replace($phpbb_install_pattern, $historical_install_code, $content);
        echo "✓ Added historical data installation to phpBB setup\n";
    } else {
        echo "⚠ Could not find phpBB installation call\n";
        return false;
    }

    // Create backup of original install.php
    $backup_file = $install_file . '.backup.' . date('Y-m-d_H-i-s');
    if (!file_exists($backup_file)) {
        copy($install_file, $backup_file);
        echo "✓ Created backup: " . basename($backup_file) . "\n";
    }

    // Write modified install.php
    file_put_contents($install_file, $content);
    echo "✓ Modified install.php with historical forum data support\n";

    return true;
}

function create_historical_data_file() {
    $scripts_dir = __DIR__;
    $historical_parser = $scripts_dir . '/vbulletin_parser_historical.py';
    $forums_dir = $scripts_dir . '/../forums';
    $output_file = $scripts_dir . '/historical_forum_data.sql';

    if (!file_exists($historical_parser)) {
        echo "Error: Historical parser not found: $historical_parser\n";
        return false;
    }

    if (!is_dir($forums_dir)) {
        echo "Error: Forums directory not found: $forums_dir\n";
        return false;
    }

    echo "Generating historical forum data SQL...\n";
    $command = "python \"$historical_parser\" \"$forums_dir\" \"$output_file\"";

    $output = [];
    $return_var = 0;
    exec($command . ' 2>&1', $output, $return_var);

    if ($return_var === 0 && file_exists($output_file)) {
        echo "✓ Generated historical forum data: " . basename($output_file) . "\n";
        echo "File size: " . number_format(filesize($output_file)) . " bytes\n";
        return true;
    } else {
        echo "✗ Failed to generate historical forum data\n";
        echo "Command: $command\n";
        echo "Output:\n" . implode("\n", $output) . "\n";
        return false;
    }
}

// Main execution
if (php_sapi_name() === 'cli') {
    echo "Historical Forum Data Installation Setup\n";
    echo "=====================================\n\n";

    // Step 1: Generate historical data file
    echo "Step 1: Generating historical forum data...\n";
    if (!create_historical_data_file()) {
        echo "Failed to generate historical data file\n";
        exit(1);
    }

    echo "\nStep 2: Modifying install.php...\n";
    if (!add_historical_forum_checkbox_to_install()) {
        echo "Failed to modify install.php\n";
        exit(1);
    }

    echo "\n✓ Historical forum data installation setup complete!\n";
    echo "\nNext steps:\n";
    echo "1. Run the CMS installer (install.php) in your browser\n";
    echo "2. Check the 'Insert official 2004 forum data' checkbox on Step 2\n";
    echo "3. Complete the installation\n";
    echo "4. The historical data will only appear when using 2003_v2 or 2004 phpBB styles\n";

} else {
    // Return functions for inclusion in other scripts
    return true;
}
?>