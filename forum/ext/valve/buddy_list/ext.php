<?php
/**
 * Steam Buddy List Extension
 *
 * Adds vBulletin-style buddy list functionality for Steam forums
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\buddy_list;

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
                $config->set('buddy_list_enabled', 1);
                $config->set('buddy_list_max_buddies', 100);
                $config->set('buddy_list_show_online_only', 0);
                $config->set('buddy_list_allow_notes', 1);

                return 'add_database_changes';

            case 'add_database_changes':
                // Create buddy list table
                $db = $this->container->get('dbal.conn');

                $sql = 'CREATE TABLE IF NOT EXISTS phpbb_buddylist (
                    buddy_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    user_id INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    buddy_user_id INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    buddy_note VARCHAR(255) DEFAULT "",
                    buddy_added INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    buddy_confirmed TINYINT(1) NOT NULL DEFAULT 0,
                    buddy_mutual TINYINT(1) NOT NULL DEFAULT 0,
                    PRIMARY KEY (buddy_id),
                    KEY user_buddy (user_id, buddy_user_id),
                    KEY buddy_user (buddy_user_id),
                    UNIQUE KEY unique_buddy (user_id, buddy_user_id)
                )';

                $db->sql_query($sql);

                // Create buddy requests table
                $sql = 'CREATE TABLE IF NOT EXISTS phpbb_buddy_requests (
                    request_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    requester_id INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    requested_id INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    request_message VARCHAR(255) DEFAULT "",
                    request_time INT(11) UNSIGNED NOT NULL DEFAULT 0,
                    request_status TINYINT(1) NOT NULL DEFAULT 0,
                    PRIMARY KEY (request_id),
                    KEY requester (requester_id),
                    KEY requested (requested_id),
                    UNIQUE KEY unique_request (requester_id, requested_id)
                )';

                $db->sql_query($sql);

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
                $config->delete('buddy_list_enabled');
                $config->delete('buddy_list_max_buddies');
                $config->delete('buddy_list_show_online_only');
                $config->delete('buddy_list_allow_notes');

                return 'remove_database_changes';

            case 'remove_database_changes':
                // Remove tables
                $db = $this->container->get('dbal.conn');

                $db->sql_query('DROP TABLE IF EXISTS phpbb_buddylist');
                $db->sql_query('DROP TABLE IF EXISTS phpbb_buddy_requests');

                return 'completed';
        }

        return parent::disable_step($old_state);
    }
}