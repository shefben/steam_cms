<?php
/**
 * Steam User Status Extension - Event Listener
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\user_status\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener for user status integration
 */
class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \valve\user_status\helper\status_helper */
    protected $helper;

    /**
     * Constructor
     */
    public function __construct(
        \phpbb\config\config $config,
        \phpbb\template\template $template,
        \phpbb\user $user,
        \phpbb\db\driver\driver_interface $db,
        \valve\user_status\helper\status_helper $helper
    ) {
        $this->config = $config;
        $this->template = $template;
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }

    /**
     * Assign functions defined in this class to event listeners in the core
     */
    static public function getSubscribedEvents()
    {
        return [
            'core.user_setup' => 'load_user_status',
            'core.viewtopic_modify_page_title' => 'viewtopic_add_user_status',
            'core.memberlist_view_profile' => 'memberlist_add_user_status',
            'core.posting_modify_template_vars' => 'posting_add_status_options',
            'core.index_modify_page_title' => 'index_show_online_users_with_status',
            'core.viewforum_modify_page_title' => 'viewforum_add_user_status',
        ];
    }

    /**
     * Load user status data on user setup
     */
    public function load_user_status($event)
    {
        if (!$this->config['user_status_enabled'])
        {
            return;
        }

        // Load current user's status
        if ($this->user->data['user_id'] != ANONYMOUS)
        {
            $status_data = $this->helper->get_user_status($this->user->data['user_id']);
            if ($status_data)
            {
                $this->template->assign_vars([
                    'S_USER_STATUS_ENABLED' => true,
                    'USER_STATUS_MESSAGE' => $status_data['status_message'],
                    'USER_STATUS_MODE' => $status_data['status_mode'],
                    'USER_STEAM_STATUS' => $status_data['steam_status'],
                    'USER_CURRENT_GAME' => $status_data['current_game'],
                ]);
            }
        }
    }

    /**
     * Add user status indicators to viewtopic
     */
    public function viewtopic_add_user_status($event)
    {
        if (!$this->config['user_status_enabled'])
        {
            return;
        }

        $post_list = $event['post_list'];
        $user_cache = $event['user_cache'];

        // Get status for all users in the topic
        if (!empty($post_list))
        {
            $user_ids = [];
            foreach ($post_list as $post_id)
            {
                if (isset($user_cache[$post_id]))
                {
                    $user_ids[] = $user_cache[$post_id]['user_id'];
                }
            }

            if (!empty($user_ids))
            {
                $this->add_status_to_posts($user_ids);
            }
        }
    }

    /**
     * Add user status to memberlist profile view
     */
    public function memberlist_add_user_status($event)
    {
        if (!$this->config['user_status_enabled'])
        {
            return;
        }

        $member = $event['member'];
        if ($member)
        {
            $status_data = $this->helper->get_user_status($member['user_id']);
            if ($status_data)
            {
                $this->template->assign_vars([
                    'MEMBER_STATUS_INDICATOR' => $this->helper->get_status_indicator($status_data),
                    'MEMBER_STATUS_MESSAGE' => $status_data['status_message'],
                    'MEMBER_STEAM_STATUS' => $status_data['steam_status'],
                    'MEMBER_CURRENT_GAME' => $status_data['current_game'],
                    'MEMBER_LAST_VISIT_FORMATTED' => $status_data['formatted_last_visit'],
                ]);
            }
        }
    }

    /**
     * Add status options to posting form
     */
    public function posting_add_status_options($event)
    {
        if (!$this->config['user_status_enabled'] || $this->user->data['user_id'] == ANONYMOUS)
        {
            return;
        }

        $status_modes = $this->helper->get_status_mode_options();
        $status_data = $this->helper->get_user_status($this->user->data['user_id']);

        $this->template->assign_vars([
            'S_USER_STATUS_OPTIONS' => true,
            'USER_STATUS_MODES' => $status_modes,
            'USER_CURRENT_STATUS_MODE' => $status_data ? $status_data['status_mode'] : 0,
            'USER_CURRENT_STATUS_MESSAGE' => $status_data ? $status_data['status_message'] : '',
        ]);
    }

    /**
     * Show online users with status on index page
     */
    public function index_show_online_users_with_status($event)
    {
        if (!$this->config['user_status_enabled'])
        {
            return;
        }

        $online_users = $this->helper->get_online_users_with_status(25);

        $this->template->assign_vars([
            'S_ONLINE_USERS_STATUS' => !empty($online_users),
        ]);

        foreach ($online_users as $user_data)
        {
            $this->template->assign_block_vars('online_users_status', [
                'USER_ID' => $user_data['user_id'],
                'USERNAME' => $user_data['username'],
                'USER_COLOUR' => $user_data['user_colour'],
                'STATUS_INDICATOR' => $user_data['status_indicator'],
                'STATUS_MESSAGE' => $user_data['status_message'],
                'STEAM_STATUS' => $user_data['steam_status'],
                'CURRENT_GAME' => $user_data['current_game'],
            ]);
        }
    }

    /**
     * Add user status to viewforum (for last post info)
     */
    public function viewforum_add_user_status($event)
    {
        if (!$this->config['user_status_enabled'])
        {
            return;
        }

        // This could be used to show status indicators next to last post authors
        // Implementation depends on specific requirements
    }

    /**
     * Add status indicators to post data
     */
    protected function add_status_to_posts($user_ids)
    {
        if (empty($user_ids))
        {
            return;
        }

        $user_ids = array_unique($user_ids);
        $status_cache = [];

        foreach ($user_ids as $user_id)
        {
            $status_data = $this->helper->get_user_status($user_id);
            if ($status_data)
            {
                $status_cache[$user_id] = [
                    'indicator' => $this->helper->get_status_indicator($status_data, false),
                    'message' => $status_data['status_message'],
                    'steam_status' => $status_data['steam_status'],
                    'current_game' => $status_data['current_game'],
                ];
            }
        }

        // Assign status data to template
        $this->template->assign_var('USER_STATUS_CACHE', json_encode($status_cache));
    }
}