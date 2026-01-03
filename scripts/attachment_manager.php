<?php
/**
 * Attachment File Manager for Historical Forum Data
 *
 * This script manages attachment files for the historical forum system:
 * 1. Creates staging area for attachments during distribution
 * 2. Copies attachments to correct phpBB location during installation
 * 3. Manages file permissions and directory structure
 */

class HistoricalAttachmentManager {

    private $forums_dir;
    private $staging_dir;
    private $phpbb_attachments_dir;

    public function __construct($forums_dir, $staging_dir = null, $phpbb_attachments_dir = null) {
        $this->forums_dir = rtrim($forums_dir, '/\\');
        $this->staging_dir = $staging_dir ?: $this->forums_dir . '/../attachments_staging';
        $this->phpbb_attachments_dir = $phpbb_attachments_dir ?: $this->forums_dir . '/../forum/files';
    }

    /**
     * Create staging area and copy attachment files for distribution
     */
    public function prepareForDistribution() {
        echo "Preparing historical attachments for distribution...\n";

        // Create staging directory
        if (!is_dir($this->staging_dir)) {
            mkdir($this->staging_dir, 0755, true);
            echo "Created staging directory: {$this->staging_dir}\n";
        }

        // Find attachment files
        $attachment_files = glob($this->forums_dir . '/attachment_*.*');
        $copied_count = 0;

        foreach ($attachment_files as $source_file) {
            $filename = basename($source_file);
            $dest_file = $this->staging_dir . '/' . $filename;

            if (copy($source_file, $dest_file)) {
                echo "Copied: {$filename}\n";
                $copied_count++;
            } else {
                echo "Failed to copy: {$filename}\n";
            }
        }

        // Create README for staging directory
        $readme_content = "Historical Forum Attachment Files\n";
        $readme_content .= "================================\n\n";
        $readme_content .= "These attachment files are from the archived 2004 Steam forums.\n";
        $readme_content .= "They will be copied to the phpBB attachments directory during installation\n";
        $readme_content .= "if the user chooses to install historical forum data.\n\n";
        $readme_content .= "Files: {$copied_count} attachments\n";
        $readme_content .= "Generated on: " . date('Y-m-d H:i:s') . "\n\n";
        $readme_content .= "File mapping:\n";

        foreach ($attachment_files as $source_file) {
            $filename = basename($source_file);
            $file_size = number_format(filesize($source_file));
            $readme_content .= "- {$filename} ({$file_size} bytes)\n";
        }

        file_put_contents($this->staging_dir . '/README.txt', $readme_content);

        echo "Prepared {$copied_count} attachment files for distribution\n";
        echo "Staging directory: {$this->staging_dir}\n";

        return $copied_count;
    }

    /**
     * Copy attachments to phpBB directory during installation
     */
    public function installAttachments() {
        echo "Installing historical attachments to phpBB...\n";

        if (!is_dir($this->staging_dir)) {
            echo "Error: Staging directory not found: {$this->staging_dir}\n";
            return false;
        }

        // Create phpBB attachments directory if it doesn't exist
        if (!is_dir($this->phpbb_attachments_dir)) {
            mkdir($this->phpbb_attachments_dir, 0755, true);
            echo "Created phpBB attachments directory: {$this->phpbb_attachments_dir}\n";
        }

        // Find staging files
        $staging_files = glob($this->staging_dir . '/attachment_*.*');
        $installed_count = 0;

        foreach ($staging_files as $source_file) {
            $filename = basename($source_file);

            // Generate phpBB-style filename
            $attachment_id = $this->extractAttachmentId($filename);
            if (!$attachment_id) {
                continue;
            }

            $phpbb_attachment_id = 100000 + $attachment_id; // Historical offset
            $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            $timestamp = time();
            $phpbb_filename = "{$phpbb_attachment_id}_{$timestamp}.{$file_extension}";

            $dest_file = $this->phpbb_attachments_dir . '/' . $phpbb_filename;

            if (copy($source_file, $dest_file)) {
                chmod($dest_file, 0644);
                echo "Installed: {$filename} -> {$phpbb_filename}\n";
                $installed_count++;
            } else {
                echo "Failed to install: {$filename}\n";
            }
        }

        echo "Installed {$installed_count} attachment files to phpBB\n";
        echo "Attachments directory: {$this->phpbb_attachments_dir}\n";

        return $installed_count;
    }

    /**
     * Update SQL file with correct phpBB physical filenames
     */
    public function updateAttachmentSQL($sql_file) {
        echo "Updating attachment SQL with actual phpBB filenames...\n";

        if (!file_exists($sql_file)) {
            echo "Error: SQL file not found: {$sql_file}\n";
            return false;
        }

        $content = file_get_contents($sql_file);
        $timestamp = time();

        // Update physical filenames to match what was actually created
        $attachment_pattern = '/\((\d+), 0, \'(attachment_\d+\.\w+)\', \'([^\']+)\', \'(\d+)_(\d+)\.(\w+)\'/';

        $content = preg_replace_callback($attachment_pattern, function($matches) use ($timestamp) {
            $attach_id = $matches[1];
            $real_filename = $matches[2];
            $comment = $matches[3];
            $extension = $matches[6];

            $new_physical_filename = "{$attach_id}_{$timestamp}.{$extension}";

            return "({$attach_id}, 0, '{$real_filename}', '{$comment}', '{$new_physical_filename}'";
        }, $content);

        file_put_contents($sql_file, $content);
        echo "Updated SQL file with actual phpBB filenames\n";

        return true;
    }

    /**
     * Extract attachment ID from filename
     */
    private function extractAttachmentId($filename) {
        if (preg_match('/attachment_(\d+)\./', $filename, $matches)) {
            return intval($matches[1]);
        }
        return null;
    }

    /**
     * Get summary of attachment files
     */
    public function getSummary() {
        $forum_files = glob($this->forums_dir . '/attachment_*.*');
        $staging_files = is_dir($this->staging_dir) ? glob($this->staging_dir . '/attachment_*.*') : [];
        $phpbb_files = is_dir($this->phpbb_attachments_dir) ? glob($this->phpbb_attachments_dir . '/*_*.???') : [];

        return [
            'source_files' => count($forum_files),
            'staged_files' => count($staging_files),
            'installed_files' => count($phpbb_files),
            'staging_dir' => $this->staging_dir,
            'phpbb_dir' => $this->phpbb_attachments_dir
        ];
    }
}

/**
 * CLI execution
 */
function main() {
    if (php_sapi_name() !== 'cli') {
        die("This script must be run from command line\n");
    }

    $action = $argv[1] ?? 'prepare';
    $forums_dir = $argv[2] ?? __DIR__ . '/../forums';

    $manager = new HistoricalAttachmentManager($forums_dir);

    switch ($action) {
        case 'prepare':
            echo "Preparing attachments for distribution...\n";
            $count = $manager->prepareForDistribution();
            echo "Complete! Prepared {$count} attachment files.\n";
            break;

        case 'install':
            echo "Installing attachments to phpBB...\n";
            $count = $manager->installAttachments();
            echo "Complete! Installed {$count} attachment files.\n";
            break;

        case 'summary':
            echo "Attachment Summary:\n";
            $summary = $manager->getSummary();
            foreach ($summary as $key => $value) {
                echo "  {$key}: {$value}\n";
            }
            break;

        default:
            echo "Usage: php attachment_manager.php [prepare|install|summary] [forums_dir]\n";
            echo "\n";
            echo "Actions:\n";
            echo "  prepare - Copy attachments from forums to staging area\n";
            echo "  install - Copy attachments from staging to phpBB directory\n";
            echo "  summary - Show attachment file counts and locations\n";
            echo "\n";
            echo "Example:\n";
            echo "  php attachment_manager.php prepare ./forums\n";
            break;
    }
}

if (php_sapi_name() === 'cli') {
    main();
}
?>