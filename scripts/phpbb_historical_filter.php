<?php
/**
 * phpBB Historical Data Filter
 *
 * This script creates the necessary phpBB modifications to conditionally
 * display historical 2004 Steam forum data only when using specific styles.
 */

/**
 * Create phpBB extension for historical data filtering
 */
function create_phpbb_historical_extension() {
    $forum_dir = __DIR__ . '/../forum';
    $ext_dir = $forum_dir . '/ext/steamcms/historical_filter';

    if (!is_dir($forum_dir)) {
        echo "Error: phpBB forum directory not found: $forum_dir\n";
        return false;
    }

    // Create extension directory structure
    $directories = [
        $ext_dir,
        $ext_dir . '/event',
        $ext_dir . '/migrations',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            echo "Created directory: " . str_replace(__DIR__ . '/../', '', $dir) . "\n";
        }
    }

    // Create composer.json for the extension
    $composer_json = [
        'name' => 'steamcms/historical_filter',
        'type' => 'phpbb-extension',
        'description' => 'Filters historical 2004 Steam forum data based on active style',
        'homepage' => '',
        'version' => '1.0.0',
        'time' => date('Y-m-d'),
        'license' => 'GPL-2.0',
        'authors' => [
            [
                'name' => 'SteamCMS',
                'email' => '',
                'homepage' => '',
                'role' => 'Developer'
            ]
        ],
        'require' => [
            'php' => '>=7.0'
        ],
        'extra' => [
            'display-name' => 'Historical Data Filter',
            'soft-require' => [
                'phpbb/phpbb' => '>=3.1.0,<4.0.0@dev'
            ]
        ]
    ];

    file_put_contents($ext_dir . '/composer.json', json_encode($composer_json, JSON_PRETTY_PRINT));

    // Create extension configuration
    $ext_config = '<?php
if (!defined(\'IN_PHPBB\'))
{
    exit;
}

return array(
    \'name\'        => \'Historical Data Filter\',
    \'description\' => \'Filters historical 2004 Steam forum data based on active style\',
    \'version\'     => \'1.0.0\',
    \'time\'        => \'' . date('Y-m-d') . '\',
    \'vendor\'      => \'steamcms\',
    \'authors\'     => array(
        \'SteamCMS\' => array(
            \'name\'     => \'SteamCMS\',
            \'email\'    => \'\',
            \'homepage\' => \'\',
            \'role\'     => \'Developer\'
        ),
    ),
);
';

    file_put_contents($ext_dir . '/ext.php', $ext_config);

    // Create event listener for historical data filtering
    $event_listener = '<?php
namespace steamcms\historicalfilter\event;

use phpbb\event\dispatcher_interface;
use phpbb\user;
use phpbb\template\template;

class main_listener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $user;
    protected $template;

    public function __construct(user $user, template $template)
    {
        $this->user = $user;
        $this->template = $template;
    }

    public static function getSubscribedEvents()
    {
        return array(
            \'core.viewforum_get_topic_data\'     => \'filter_historical_topics\',
            \'core.viewtopic_get_post_data\'      => \'filter_historical_posts\',
            \'core.index_modify_page_title\'      => \'filter_historical_forums\',
        );
    }

    /**
     * Check if current style allows historical data
     */
    private function is_historical_style_active()
    {
        $style_name = $this->user->style[\'style_name\'] ?? \'\';
        $allowed_styles = [\'Steam 2003\', \'Steam 2004\', \'steam_2003\', \'steam_2004\', \'2003_v2\', \'2004\'];

        return in_array($style_name, $allowed_styles, true);
    }

    /**
     * Filter historical topics from forum view
     */
    public function filter_historical_topics($event)
    {
        if (!$this->is_historical_style_active()) {
            $sql_where = $event[\'sql_where\'];
            $sql_where .= \' AND (t.is_historical IS NULL OR t.is_historical = 0)\';
            $event[\'sql_where\'] = $sql_where;
        }
    }

    /**
     * Filter historical posts from topic view
     */
    public function filter_historical_posts($event)
    {
        if (!$this->is_historical_style_active()) {
            $sql_where = $event[\'sql_where\'];
            $sql_where .= \' AND (p.is_historical IS NULL OR p.is_historical = 0)\';
            $event[\'sql_where\'] = $sql_where;
        }
    }

    /**
     * Filter historical forums from index
     */
    public function filter_historical_forums($event)
    {
        global $db;

        if (!$this->is_historical_style_active()) {
            // This will be handled by the forum permissions system
            // Historical forums should have special permissions set
        }
    }
}
';

    file_put_contents($ext_dir . '/event/main_listener.php', $event_listener);

    // Create services configuration
    $services_yml = 'services:
    steamcms.historicalfilter.listener:
        class: steamcms\historicalfilter\event\main_listener
        arguments:
            - "@user"
            - "@template"
        tags:
            - { name: event.listener }
';

    file_put_contents($ext_dir . '/config/services.yml', $services_yml);

    // Create migration to add historical columns
    $migration = '<?php
namespace steamcms\historicalfilter\migrations;

class add_historical_columns extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return $this->db_tools->sql_column_exists($this->table_prefix . \'users\', \'is_historical\');
    }

    static public function depends_on()
    {
        return array(\'\phpbb\db\migration\data\v31x\v314\');
    }

    public function update_schema()
    {
        return array(
            \'add_columns\' => array(
                $this->table_prefix . \'users\' => array(
                    \'is_historical\' => array(\'TINT:1\', 0),
                ),
                $this->table_prefix . \'forums\' => array(
                    \'is_historical\' => array(\'TINT:1\', 0),
                ),
                $this->table_prefix . \'topics\' => array(
                    \'is_historical\' => array(\'TINT:1\', 0),
                ),
                $this->table_prefix . \'posts\' => array(
                    \'is_historical\' => array(\'TINT:1\', 0),
                ),
            ),
            \'add_index\' => array(
                $this->table_prefix . \'users\' => array(
                    \'is_historical\' => array(\'is_historical\'),
                ),
                $this->table_prefix . \'topics\' => array(
                    \'is_historical\' => array(\'is_historical\'),
                ),
                $this->table_prefix . \'posts\' => array(
                    \'is_historical\' => array(\'is_historical\'),
                ),
            ),
        );
    }

    public function revert_schema()
    {
        return array(
            \'drop_columns\' => array(
                $this->table_prefix . \'users\' => array(
                    \'is_historical\',
                ),
                $this->table_prefix . \'forums\' => array(
                    \'is_historical\',
                ),
                $this->table_prefix . \'topics\' => array(
                    \'is_historical\',
                ),
                $this->table_prefix . \'posts\' => array(
                    \'is_historical\',
                ),
            ),
        );
    }
}
';

    file_put_contents($ext_dir . '/migrations/add_historical_columns.php', $migration);

    echo "✓ Created phpBB historical filter extension\n";
    return true;
}

/**
 * Create direct phpBB core modifications (alternative approach)
 */
function create_phpbb_core_modifications() {
    $forum_dir = __DIR__ . '/../forum';
    $modifications = [];

    // Modification 1: Update viewforum.php to filter historical topics
    $viewforum_file = $forum_dir . '/viewforum.php';
    if (file_exists($viewforum_file)) {
        $content = file_get_contents($viewforum_file);

        // Find the SQL query that gets topics
        $pattern = '/(\$sql = "SELECT[^"]*FROM[^"]*topics[^"]*WHERE[^"]*)/i';

        if (preg_match($pattern, $content)) {
            $replacement = '$1 . $this->get_historical_filter_sql(\'t\') . ';
            $content = preg_replace($pattern, $replacement, $content);

            $modifications['viewforum.php'] = $content;
        }
    }

    // Modification 2: Update viewtopic.php to filter historical posts
    $viewtopic_file = $forum_dir . '/viewtopic.php';
    if (file_exists($viewtopic_file)) {
        $content = file_get_contents($viewtopic_file);

        // Find the SQL query that gets posts
        $pattern = '/(\$sql = "SELECT[^"]*FROM[^"]*posts[^"]*WHERE[^"]*)/i';

        if (preg_match($pattern, $content)) {
            $replacement = '$1 . $this->get_historical_filter_sql(\'p\') . ';
            $content = preg_replace($pattern, $replacement, $content);

            $modifications['viewtopic.php'] = $content;
        }
    }

    return $modifications;
}

/**
 * Create helper functions for phpBB integration
 */
function create_phpbb_helper_functions() {
    $helper_file = __DIR__ . '/../forum/includes/historical_filter.php';

    $helper_code = '<?php
/**
 * Historical Data Filter Helper Functions
 * Include this file in phpBB global scope for historical data filtering
 */

if (!defined(\'IN_PHPBB\'))
{
    exit;
}

/**
 * Check if current style allows historical data display
 */
function is_historical_style_active()
{
    global $user;

    $style_name = isset($user->style[\'style_name\']) ? $user->style[\'style_name\'] : \'\';
    $allowed_styles = [
        \'Steam 2003\', \'Steam 2004\',
        \'steam_2003\', \'steam_2004\',
        \'2003_v2\', \'2004\'
    ];

    return in_array($style_name, $allowed_styles, true);
}

/**
 * Get SQL filter clause for historical data
 */
function get_historical_filter_sql($table_alias = \'\')
{
    if (is_historical_style_active()) {
        return \'\'; // Show all data including historical
    }

    $prefix = $table_alias ? $table_alias . \'.\' : \'\';
    return \' AND (\' . $prefix . \'is_historical IS NULL OR \' . $prefix . \'is_historical = 0)\';
}

/**
 * Apply historical filter to SQL WHERE clause
 */
function apply_historical_filter($sql_where, $table_alias = \'\')
{
    $filter = get_historical_filter_sql($table_alias);
    return $sql_where . $filter;
}

/**
 * Filter array of data based on historical status
 */
function filter_historical_data($data_array, $is_historical_key = \'is_historical\')
{
    if (is_historical_style_active()) {
        return $data_array; // Return all data
    }

    return array_filter($data_array, function($item) use ($is_historical_key) {
        return !isset($item[$is_historical_key]) || !$item[$is_historical_key];
    });
}
';

    file_put_contents($helper_file, $helper_code);
    echo "✓ Created phpBB helper functions: " . basename($helper_file) . "\n";

    return true;
}

/**
 * Create installation script for phpBB modifications
 */
function create_phpbb_installation_script() {
    $install_script = __DIR__ . '/install_phpbb_historical_filter.php';

    $script_content = '<?php
/**
 * Install phpBB Historical Data Filter
 *
 * This script applies all necessary modifications to phpBB for historical data filtering.
 */

require_once __DIR__ . \'/phpbb_historical_filter.php\';

function install_historical_filter()
{
    echo "Installing phpBB Historical Data Filter...\\n";
    echo "========================================\\n\\n";

    // Method 1: Create extension (recommended)
    echo "Creating phpBB extension...\\n";
    if (create_phpbb_historical_extension()) {
        echo "✓ Extension created successfully\\n";
    } else {
        echo "✗ Failed to create extension\\n";
        return false;
    }

    // Method 2: Create helper functions
    echo "\\nCreating helper functions...\\n";
    if (create_phpbb_helper_functions()) {
        echo "✓ Helper functions created\\n";
    } else {
        echo "✗ Failed to create helper functions\\n";
        return false;
    }

    echo "\\n✓ Installation complete!\\n\\n";
    echo "Next steps:\\n";
    echo "1. Enable the extension in phpBB Admin Panel > Customise > Extensions\\n";
    echo "2. The extension will automatically filter historical data based on active style\\n";
    echo "3. Historical data will only show with Steam 2003/2004 styles\\n";
    echo "4. Real users can still post replies to historical threads\\n";

    return true;
}

if (php_sapi_name() === \'cli\') {
    install_historical_filter();
}
';

    file_put_contents($install_script, $script_content);
    echo "✓ Created phpBB installation script: " . basename($install_script) . "\n";

    return true;
}

// Main execution
if (php_sapi_name() === 'cli') {
    echo "phpBB Historical Data Filter Setup\n";
    echo "=================================\n\n";

    // Create extension
    echo "Creating phpBB extension...\n";
    if (!create_phpbb_historical_extension()) {
        echo "Failed to create extension\n";
        exit(1);
    }

    // Create helper functions
    echo "\nCreating helper functions...\n";
    if (!create_phpbb_helper_functions()) {
        echo "Failed to create helper functions\n";
        exit(1);
    }

    // Create installation script
    echo "\nCreating installation script...\n";
    if (!create_phpbb_installation_script()) {
        echo "Failed to create installation script\n";
        exit(1);
    }

    echo "\n✓ phpBB Historical Data Filter setup complete!\n";
    echo "\nThe extension will:\n";
    echo "- Only show historical 2004 forum data when using Steam 2003/2004 styles\n";
    echo "- Hide historical data when using other phpBB styles\n";
    echo "- Allow real users to reply to historical threads\n";
    echo "- Maintain separate historical and real user accounts\n";

} else {
    // Return functions for inclusion
    return true;
}
?>