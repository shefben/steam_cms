<?php
/**
 * Steam User Status Extension - Helper Class
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\user_status\helper;

/**
 * Helper class for user status functionality
 */
class status_helper
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\request\request */
    protected $request;

    /**
     * Status mode constants
     */
    const STATUS_ONLINE = 0;
    const STATUS_AWAY = 1;
    const STATUS_BUSY = 2;
    const STATUS_INVISIBLE = 3;

    /**
     * Steam status constants
     */
    const STEAM_OFFLINE = 'offline';
    const STEAM_ONLINE = 'online';
    const STEAM_BUSY = 'busy';
    const STEAM_AWAY = 'away';
    const STEAM_SNOOZE = 'snooze';
    const STEAM_IN_GAME = 'in-game';

    /**
     * Constructor
     */
    public function __construct(\phpbb\config\config $config, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request)
    {
        $this->config = $config;
        $this->user = $user;
        $this->db = $db;
        $this->request = $request;
    }

    /**
     * Get user status information
     */
    public function get_user_status($user_id)
    {
        $sql = 'SELECT user_id, username, user_colour, user_lastvisit, user_type,
                       user_status_message, user_status_mode, user_steam_status,
                       user_current_game, user_status_updated
                FROM ' . USERS_TABLE . '
                WHERE user_id = ' . (int) $user_id;
        $result = $this->db->sql_query($sql);
        $user_data = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$user_data)
        {
            return false;
        }

        return [
            'user_id' => $user_data['user_id'],
            'username' => $user_data['username'],
            'user_colour' => $user_data['user_colour'],
            'is_online' => $this->is_user_online($user_data['user_lastvisit']),
            'last_visit' => $user_data['user_lastvisit'],
            'status_message' => $user_data['user_status_message'],
            'status_mode' => $user_data['user_status_mode'],
            'steam_status' => $user_data['user_steam_status'],
            'current_game' => $user_data['user_current_game'],
            'status_updated' => $user_data['user_status_updated'],
            'formatted_last_visit' => $this->user->format_date($user_data['user_lastvisit']),
        ];
    }

    /**
     * Update user status
     */
    public function update_user_status($user_id, $status_message = '', $status_mode = self::STATUS_ONLINE, $steam_status = '', $current_game = '')
    {
        $sql_data = [
            'user_status_message' => $status_message,
            'user_status_mode' => (int) $status_mode,
            'user_steam_status' => $steam_status,
            'user_current_game' => $current_game,
            'user_status_updated' => time(),
        ];

        $sql = 'UPDATE ' . USERS_TABLE . '
                SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . '
                WHERE user_id = ' . (int) $user_id;
        $this->db->sql_query($sql);

        return true;
    }

    /**
     * Check if user is currently online
     */
    public function is_user_online($last_visit)
    {
        $online_time = $this->config['load_online_time'] * 60;
        return (time() - $last_visit) <= $online_time;
    }

    /**
     * Get status indicator HTML
     */
    public function get_status_indicator($user_data, $show_text = true)
    {
        if (!$user_data)
        {
            return '';
        }

        $status_class = 'user-status-offline';
        $status_text = 'Offline';
        $status_icon = 'icon_user_offline.gif';

        if ($this->is_user_online($user_data['last_visit']))
        {
            switch ($user_data['status_mode'])
            {
                case self::STATUS_ONLINE:
                    $status_class = 'user-status-online';
                    $status_text = 'Online';
                    $status_icon = 'icon_user_online.gif';
                    break;

                case self::STATUS_AWAY:
                    $status_class = 'user-status-away';
                    $status_text = 'Away';
                    $status_icon = 'icon_user_away.gif';
                    break;

                case self::STATUS_BUSY:
                    $status_class = 'user-status-busy';
                    $status_text = 'Busy';
                    $status_icon = 'icon_user_busy.gif';
                    break;

                case self::STATUS_INVISIBLE:
                    if ($this->user->data['user_id'] == $user_data['user_id'] || $this->user->data['user_type'] == USER_FOUNDER)
                    {
                        $status_class = 'user-status-invisible';
                        $status_text = 'Invisible';
                        $status_icon = 'icon_user_invisible.gif';
                    }
                    else
                    {
                        $status_class = 'user-status-offline';
                        $status_text = 'Offline';
                        $status_icon = 'icon_user_offline.gif';
                    }
                    break;
            }
        }

        // Steam status integration
        $steam_status_html = '';
        if ($this->config['user_status_show_steam'] && !empty($user_data['steam_status']))
        {
            $steam_status_html = $this->get_steam_status_html($user_data);
        }

        $html = '<span class="user-status ' . $status_class . '">';
        $html .= '<img src="' . $this->user->style['style_path'] . '/theme/images/' . $status_icon . '" alt="' . $status_text . '" title="' . $status_text . '" /> ';

        if ($show_text)
        {
            $html .= $status_text;

            if (!empty($user_data['status_message']))
            {
                $html .= ': ' . htmlspecialchars($user_data['status_message']);
            }
        }

        $html .= '</span>';

        if ($steam_status_html)
        {
            $html .= ' ' . $steam_status_html;
        }

        return $html;
    }

    /**
     * Get Steam status HTML
     */
    protected function get_steam_status_html($user_data)
    {
        if (empty($user_data['steam_status']))
        {
            return '';
        }

        $steam_class = 'steam-status-' . $user_data['steam_status'];
        $steam_text = ucfirst($user_data['steam_status']);

        if ($user_data['steam_status'] === self::STEAM_IN_GAME && !empty($user_data['current_game']))
        {
            $steam_text = 'Playing: ' . htmlspecialchars($user_data['current_game']);
        }

        return '<span class="steam-status ' . $steam_class . '">' . $steam_text . '</span>';
    }

    /**
     * Get online users with status
     */
    public function get_online_users_with_status($limit = 50)
    {
        $online_time = time() - ($this->config['load_online_time'] * 60);

        $sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_type, u.user_lastvisit,
                       u.user_status_message, u.user_status_mode, u.user_steam_status, u.user_current_game
                FROM ' . USERS_TABLE . ' u
                WHERE u.user_lastvisit >= ' . $online_time . '
                    AND u.user_type <> ' . USER_IGNORE . '
                ORDER BY u.username ASC
                LIMIT ' . (int) $limit;
        $result = $this->db->sql_query($sql);

        $online_users = [];
        while ($row = $this->db->sql_fetchrow($result))
        {
            $online_users[] = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'user_colour' => $row['user_colour'],
                'last_visit' => $row['user_lastvisit'],
                'status_message' => $row['user_status_message'],
                'status_mode' => $row['user_status_mode'],
                'steam_status' => $row['user_steam_status'],
                'current_game' => $row['user_current_game'],
                'status_indicator' => $this->get_status_indicator($row),
            ];
        }
        $this->db->sql_freeresult($result);

        return $online_users;
    }

    /**
     * Get status mode options for forms
     */
    public function get_status_mode_options()
    {
        return [
            self::STATUS_ONLINE => 'Online',
            self::STATUS_AWAY => 'Away',
            self::STATUS_BUSY => 'Busy',
            self::STATUS_INVISIBLE => 'Invisible',
        ];
    }
}