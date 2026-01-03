<?php
/**
 * Steam User Status Extension - Main Controller
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\user_status\controller;

/**
 * Main controller for user status operations
 */
class main_controller
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\controller\helper */
    protected $helper;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \valve\user_status\helper\status_helper */
    protected $status_helper;

    /** @var string */
    protected $root_path;

    /** @var string */
    protected $php_ext;

    /**
     * Constructor
     */
    public function __construct(
        \phpbb\config\config $config,
        \phpbb\controller\helper $helper,
        \phpbb\template\template $template,
        \phpbb\user $user,
        \phpbb\request\request $request,
        \phpbb\db\driver\driver_interface $db,
        \valve\user_status\helper\status_helper $status_helper,
        $root_path,
        $php_ext
    ) {
        $this->config = $config;
        $this->helper = $helper;
        $this->template = $template;
        $this->user = $user;
        $this->request = $request;
        $this->db = $db;
        $this->status_helper = $status_helper;
        $this->root_path = $root_path;
        $this->php_ext = $php_ext;
    }

    /**
     * Update user status via AJAX
     */
    public function update_status()
    {
        if (!$this->config['user_status_enabled'] || $this->user->data['user_id'] == ANONYMOUS)
        {
            return $this->json_response(['success' => false, 'error' => 'Access denied']);
        }

        if (!check_form_key('user_status'))
        {
            return $this->json_response(['success' => false, 'error' => 'Invalid form token']);
        }

        $status_message = $this->request->variable('status_message', '', true);
        $status_mode = $this->request->variable('status_mode', 0);
        $steam_status = $this->request->variable('steam_status', '');
        $current_game = $this->request->variable('current_game', '', true);

        // Validate input
        if (strlen($status_message) > 255)
        {
            return $this->json_response(['success' => false, 'error' => 'Status message too long']);
        }

        $valid_modes = array_keys($this->status_helper->get_status_mode_options());
        if (!in_array($status_mode, $valid_modes))
        {
            $status_mode = \valve\user_status\helper\status_helper::STATUS_ONLINE;
        }

        // Update status
        $result = $this->status_helper->update_user_status(
            $this->user->data['user_id'],
            $status_message,
            $status_mode,
            $steam_status,
            $current_game
        );

        if ($result)
        {
            // Get updated status for response
            $status_data = $this->status_helper->get_user_status($this->user->data['user_id']);
            $status_indicator = $this->status_helper->get_status_indicator($status_data);

            return $this->json_response([
                'success' => true,
                'status_indicator' => $status_indicator,
                'status_message' => $status_message,
                'status_mode' => $status_mode,
                'steam_status' => $steam_status,
                'current_game' => $current_game,
            ]);
        }

        return $this->json_response(['success' => false, 'error' => 'Failed to update status']);
    }

    /**
     * Get user status information
     */
    public function get_status($user_id)
    {
        if (!$this->config['user_status_enabled'])
        {
            return $this->json_response(['success' => false, 'error' => 'Feature disabled']);
        }

        $user_id = (int) $user_id;
        if (!$user_id)
        {
            return $this->json_response(['success' => false, 'error' => 'Invalid user ID']);
        }

        $status_data = $this->status_helper->get_user_status($user_id);
        if (!$status_data)
        {
            return $this->json_response(['success' => false, 'error' => 'User not found']);
        }

        return $this->json_response([
            'success' => true,
            'user_id' => $status_data['user_id'],
            'username' => $status_data['username'],
            'is_online' => $status_data['is_online'],
            'status_indicator' => $this->status_helper->get_status_indicator($status_data),
            'status_message' => $status_data['status_message'],
            'status_mode' => $status_data['status_mode'],
            'steam_status' => $status_data['steam_status'],
            'current_game' => $status_data['current_game'],
            'last_visit' => $status_data['formatted_last_visit'],
        ]);
    }

    /**
     * Get online users with status
     */
    public function get_online_users()
    {
        if (!$this->config['user_status_enabled'])
        {
            return $this->json_response(['success' => false, 'error' => 'Feature disabled']);
        }

        $limit = $this->request->variable('limit', 25);
        $limit = max(1, min(100, $limit)); // Limit between 1 and 100

        $online_users = $this->status_helper->get_online_users_with_status($limit);

        return $this->json_response([
            'success' => true,
            'users' => $online_users,
            'total' => count($online_users),
        ]);
    }

    /**
     * Status settings page (for UCP integration)
     */
    public function settings()
    {
        if (!$this->config['user_status_enabled'] || $this->user->data['user_id'] == ANONYMOUS)
        {
            throw new \phpbb\exception\http_exception(403, 'NO_AUTH');
        }

        add_form_key('user_status_settings');

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('user_status_settings'))
            {
                trigger_error('FORM_INVALID');
            }

            $status_message = $this->request->variable('status_message', '', true);
            $status_mode = $this->request->variable('status_mode', 0);
            $auto_status = $this->request->variable('auto_status', 0);

            // Update user preferences
            $sql_data = [
                'user_status_message' => $status_message,
                'user_status_mode' => $status_mode,
                'user_status_auto' => $auto_status,
                'user_status_updated' => time(),
            ];

            $sql = 'UPDATE ' . USERS_TABLE . '
                    SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . '
                    WHERE user_id = ' . $this->user->data['user_id'];
            $this->db->sql_query($sql);

            meta_refresh(1, $this->helper->route('valve_user_status_settings'));
            $message = 'Status settings updated successfully.';
            trigger_error($message);
        }

        // Get current status data
        $status_data = $this->status_helper->get_user_status($this->user->data['user_id']);
        $status_modes = $this->status_helper->get_status_mode_options();

        $this->template->assign_vars([
            'S_USER_STATUS_SETTINGS' => true,
            'USER_STATUS_MESSAGE' => $status_data ? $status_data['status_message'] : '',
            'USER_STATUS_MODE' => $status_data ? $status_data['status_mode'] : 0,
            'STATUS_MODE_OPTIONS' => $status_modes,
            'U_ACTION' => $this->helper->route('valve_user_status_settings'),
        ]);

        return $this->helper->render('user_status_settings.html', 'User Status Settings');
    }

    /**
     * Return JSON response
     */
    protected function json_response($data)
    {
        $response = new \Symfony\Component\HttpFoundation\JsonResponse($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}