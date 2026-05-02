<?php

namespace steamcms\account_activation\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	protected $root_path;
	protected $php_ext;

	public function __construct($root_path, $php_ext)
	{
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.ucp_register_welcome_email_before' => 'add_activation_code_to_email',
		];
	}

	/**
	 * Add the activation code as a separate template variable in the welcome email
	 * so users can manually enter it on the activation form page.
	 */
	public function add_activation_code_to_email($event)
	{
		$user_actkey = $event['user_actkey'];
		$messenger = $event['messenger'];
		$server_url = $event['server_url'];

		if (!empty($user_actkey))
		{
			$messenger->assign_vars([
				'ACTIVATION_CODE'	=> $user_actkey,
				'U_ACTIVATE_FORM'	=> $server_url . '/app.' . $this->php_ext . '/activate',
			]);
		}
	}
}
