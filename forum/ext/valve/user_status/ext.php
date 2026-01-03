<?php
/**
 * Steam User Status Indicators Extension
 *
 * Adds vBulletin-style user status indicators and Steam integration
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\user_status;

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
     * Enable step - add default configuration settings and database changes
     */
    public function enable_step($old_state)
    {
        switch ($old_state)
        {
            case '':
                // Add configuration settings
                $config = $this->container->get('config');
                $config->set('user_status_enabled', 1);
                $config->set('user_status_show_steam', 1);
                $config->set('user_status_show_game', 1);
                $config->set('user_status_update_interval', 60);

                return 'add_database_changes';

            case 'add_database_changes':
                // Add custom user status fields to user table
                $db = $this->container->get('dbal.conn');

                $sql_queries = [
                    'ALTER TABLE ' . USERS_TABLE . ' ADD COLUMN user_status_message VARCHAR(255) DEFAULT ""',
                    'ALTER TABLE ' . USERS_TABLE . ' ADD COLUMN user_status_mode TINYINT(1) DEFAULT 0',
                    'ALTER TABLE ' . USERS_TABLE . ' ADD COLUMN user_steam_status VARCHAR(50) DEFAULT ""',
                    'ALTER TABLE ' . USERS_TABLE . ' ADD COLUMN user_current_game VARCHAR(255) DEFAULT ""',
                    'ALTER TABLE ' . USERS_TABLE . ' ADD COLUMN user_status_updated INT(11) DEFAULT 0'
                ];

                foreach ($sql_queries as $sql)
                {
                    try
                    {
                        $db->sql_query($sql);
                    }
                    catch (\Exception $e)
                    {
                        // Column might already exist, continue
                    }
                }

                return 'add_permissions';

            case 'add_permissions':
                return 'completed';
        }

        return parent::enable_step($old_state);
    }

    /**
     * Disable step - remove configuration settings and database changes
     */
    public function disable_step($old_state)
    {
        switch ($old_state)
        {
            case '':
                // Remove configuration
                $config = $this->container->get('config');
                $config->delete('user_status_enabled');
                $config->delete('user_status_show_steam');
                $config->delete('user_status_show_game');
                $config->delete('user_status_update_interval');

                return 'remove_database_changes';

            case 'remove_database_changes':
                // Remove custom columns
                $db = $this->container->get('dbal.conn');

                $sql_queries = [
                    'ALTER TABLE ' . USERS_TABLE . ' DROP COLUMN user_status_message',
                    'ALTER TABLE ' . USERS_TABLE . ' DROP COLUMN user_status_mode',
                    'ALTER TABLE ' . USERS_TABLE . ' DROP COLUMN user_steam_status',
                    'ALTER TABLE ' . USERS_TABLE . ' DROP COLUMN user_current_game',
                    'ALTER TABLE ' . USERS_TABLE . ' DROP COLUMN user_status_updated'
                ];

                foreach ($sql_queries as $sql)
                {
                    try
                    {
                        $db->sql_query($sql);
                    }
                    catch (\Exception $e)
                    {
                        // Column might not exist, continue
                    }
                }

                return 'completed';
        }

        return parent::disable_step($old_state);
    }
}