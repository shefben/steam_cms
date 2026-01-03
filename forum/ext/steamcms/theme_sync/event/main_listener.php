<?php
/**
 * SteamCMS Theme Sync Event Listener
 *
 * Listens for user setup events and forces the forum style to match
 * the active CMS theme.
 *
 * @package steamcms/theme_sync
 * @copyright Valve Corporation
 * @license GPL-2.0-only
 */

namespace steamcms\theme_sync\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\config\config */
    protected $config;

    /** @var string */
    protected $phpbb_root_path;

    /** @var int|null Cached style ID */
    protected static $cached_style_id = null;

    /**
     * Constructor
     *
     * @param \phpbb\db\driver\driver_interface $db
     * @param \phpbb\config\config $config
     * @param string $phpbb_root_path
     */
    public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, $phpbb_root_path)
    {
        $this->db = $db;
        $this->config = $config;
        $this->phpbb_root_path = $phpbb_root_path;
    }

    /**
     * Define the events we subscribe to
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'core.user_setup' => 'force_cms_style',
        ];
    }

    /**
     * Force the forum style to match the CMS theme
     *
     * @param \phpbb\event\data $event
     */
    public function force_cms_style($event)
    {
        $style_id = $this->get_cms_matched_style_id();

        if ($style_id !== false)
        {
            // Override the style_id in the event data
            $event['style_id'] = $style_id;

            // Also update config to ensure consistency
            $this->config['override_user_style'] = 1;
        }
    }

    /**
     * Get the phpBB style ID that matches the current CMS theme
     *
     * @return int|false The style ID or false on failure
     */
    protected function get_cms_matched_style_id()
    {
        // Return cached value if available
        if (self::$cached_style_id !== null)
        {
            return self::$cached_style_id;
        }

        // Load CMS config
        $cms_config_path = dirname($this->phpbb_root_path) . '/cms/config.php';

        if (!file_exists($cms_config_path))
        {
            self::$cached_style_id = false;
            return false;
        }

        $cms_config = include($cms_config_path);

        if (!is_array($cms_config))
        {
            self::$cached_style_id = false;
            return false;
        }

        try
        {
            // Connect to database to read CMS settings
            $pdo = new \PDO(
                "mysql:host={$cms_config['host']};port={$cms_config['port']};dbname={$cms_config['dbname']};charset=utf8mb4",
                $cms_config['user'],
                $cms_config['pass'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );

            // Get current CMS theme
            $stmt = $pdo->prepare("SELECT value FROM settings WHERE `key` = 'theme' LIMIT 1");
            $stmt->execute();
            $cms_theme = $stmt->fetchColumn();

            if (!$cms_theme)
            {
                $pdo = null;
                self::$cached_style_id = false;
                return false;
            }

            // Map CMS theme to phpBB style name
            // 2003_v1, 2003_v2 -> Steam 2003
            // 2004 and later -> Steam 2004
            if (preg_match('/^2003/', $cms_theme))
            {
                $phpbb_style_name = 'Steam 2003';
            }
            else
            {
                $phpbb_style_name = 'Steam 2004';
            }

            // Look up the style_id from phpbb_styles table
            $stmt = $pdo->prepare("SELECT style_id FROM phpbb_styles WHERE style_name = ? AND style_active = 1 LIMIT 1");
            $stmt->execute([$phpbb_style_name]);
            $style_id = $stmt->fetchColumn();

            $pdo = null;

            if ($style_id)
            {
                self::$cached_style_id = (int) $style_id;
                return self::$cached_style_id;
            }
        }
        catch (\PDOException $e)
        {
            // Silently fail - use default phpBB style
        }

        self::$cached_style_id = false;
        return false;
    }
}
