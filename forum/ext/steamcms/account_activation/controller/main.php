<?php

namespace steamcms\account_activation\controller;

use phpbb\db\driver\driver_interface;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use phpbb\config\config;
use phpbb\auth\auth;
use phpbb\log\log;
use phpbb\event\dispatcher_interface;
use Symfony\Component\HttpFoundation\Response;

class main
{
	protected $db;
	protected $request;
	protected $template;
	protected $user;
	protected $config;
	protected $auth;
	protected $log;
	protected $dispatcher;
	protected $root_path;
	protected $php_ext;

	public function __construct(
		driver_interface $db,
		request $request,
		template $template,
		user $user,
		config $config,
		auth $auth,
		log $log,
		dispatcher_interface $dispatcher,
		$root_path,
		$php_ext
	)
	{
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->config = $config;
		$this->auth = $auth;
		$this->log = $log;
		$this->dispatcher = $dispatcher;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function handle()
	{
		$submit = $this->request->is_set_post('submit');
		$error = '';
		$success = '';
		$username_value = '';

		if ($submit)
		{
			$username = $this->request->variable('username', '', true);
			$activation_code = $this->request->variable('activateid', '', true);
			$username_value = $username;

			if (empty($username) || empty($activation_code))
			{
				$error = 'Please fill in both fields.';
			}
			else
			{
				$sql = 'SELECT user_id, username, user_type, user_email, user_newpasswd, user_lang, user_notify_type, user_actkey, user_inactive_reason
					FROM ' . USERS_TABLE . "
					WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";
				$result = $this->db->sql_query($sql);
				$user_row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if (!$user_row)
				{
					$error = 'The user name you entered does not exist. Please go back and try again.';
				}
				else if ($user_row['user_type'] != USER_INACTIVE)
				{
					$error = 'This account has already been activated.';
				}
				else if ($user_row['user_inactive_reason'] == INACTIVE_MANUAL)
				{
					$error = 'Your account has been deactivated by an administrator. Please contact the board administrator for further information.';
				}
				else if ($user_row['user_actkey'] === '' || $user_row['user_actkey'] !== $activation_code)
				{
					$error = 'The activation code you entered is incorrect. Please check your email and try again.';
				}
				else
				{
					// Valid activation - activate the account
					if (!function_exists('user_active_flip'))
					{
						include_once($this->root_path . 'includes/functions_user.' . $this->php_ext);
					}

					user_active_flip('activate', $user_row['user_id']);

					$sql_ary = [
						'user_actkey'				=> '',
						'reset_token'				=> '',
						'reset_token_expiration'	=> 0,
					];

					$sql = 'UPDATE ' . USERS_TABLE . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE user_id = ' . (int) $user_row['user_id'];
					$this->db->sql_query($sql);

					$this->log->add('user', $this->user->data['user_id'], $this->user->ip, 'LOG_USER_ACTIVE_USER', false, [
						'reportee_id' => $user_row['user_id'],
					]);

					// Send admin notification if admin activation is configured
					if ($this->config['require_activation'] == USER_ACTIVATION_ADMIN)
					{
						// Admin activation - notify admins that user self-activated with code
						// The user's account is now active
					}

					$success = 'Thank you, your account is now active. You may now log in with the user name and password you entered during registration.';
				}
			}
		}

		$this->template->assign_vars([
			'ACTIVATE_ERROR'	=> $error,
			'ACTIVATE_SUCCESS'	=> $success,
			'USERNAME_VALUE'	=> $username_value,
			'S_ACTIVATE_ACTION'	=> append_sid($this->root_path . 'app.' . $this->php_ext . '/activate'),
		]);

		page_header('Activate Your Account');
		$this->template->set_filenames([
			'body' => 'steamcms_activate_account.html',
		]);
		page_footer();
	}
}
