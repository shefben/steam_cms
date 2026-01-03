<?php
/**
 * Steam Forum Minimized Replies Extension
 *
 * Replicates vBulletin-style minimized replies system for Steam forums
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies;

/**
 * Extension base
 */
class ext extends \phpbb\extension\base
{
    /**
     * Check whether the extension can be enabled.
     *
     * @return bool
     */
    public function is_enableable()
    {
        $config = $this->container->get('config');
        return version_compare($config['version'], '3.3.0', '>=');
    }

    /**
     * Enable step - add default configuration settings
     */
    public function enable_step($old_state)
    {
        switch ($old_state)
        {
            case '': // Empty means nothing has run yet
                // Set default configuration
                $config = $this->container->get('config');
                $config->set('minimized_replies_enabled', 1);
                $config->set('minimized_replies_threshold', 3); // Show minimized after 3 replies
                $config->set('minimized_replies_preview_length', 50); // Preview text length
                $config->set('minimized_replies_use_threading', 1); // Enable threaded view

                return 'add_permissions';

            case 'add_permissions':
                // Add permission settings if needed
                return 'completed';
        }

        return parent::enable_step($old_state);
    }

    /**
     * Disable step - remove configuration settings
     */
    public function disable_step($old_state)
    {
        switch ($old_state)
        {
            case '': // Empty means nothing has run yet
                // Remove configuration
                $config = $this->container->get('config');
                $config->delete('minimized_replies_enabled');
                $config->delete('minimized_replies_threshold');
                $config->delete('minimized_replies_preview_length');
                $config->delete('minimized_replies_use_threading');

                return 'remove_permissions';

            case 'remove_permissions':
                // Remove any custom permissions if added
                return 'completed';
        }

        return parent::disable_step($old_state);
    }
}