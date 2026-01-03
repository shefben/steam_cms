<?php
/**
 * SteamCMS Theme Sync Extension
 *
 * @package steamcms/theme_sync
 * @copyright Valve Corporation
 * @license GPL-2.0-only
 */

namespace steamcms\theme_sync;

class ext extends \phpbb\extension\base
{
    /**
     * Check if the extension can be enabled
     *
     * @return bool
     */
    public function is_enableable()
    {
        // Check if CMS config exists
        $cms_config_path = dirname(dirname(dirname(__DIR__))) . '/cms/config.php';
        return file_exists($cms_config_path);
    }
}
