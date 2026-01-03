<?php
/**
 * Steam Forum Minimized Replies Extension - ACP Module
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies\acp;

/**
 * ACP module for minimized replies configuration
 */
class main_module
{
    /** @var string */
    public $page_title;

    /** @var string */
    public $tpl_name;

    /** @var string */
    public $u_action;

    /**
     * Main ACP module
     */
    public function main($id, $mode)
    {
        global $config, $request, $template, $user, $phpbb_log;

        $user->add_lang_ext('valve/minimized_replies', 'acp_minimized_replies');

        $this->page_title = $user->lang('ACP_MINIMIZED_REPLIES');
        $this->tpl_name = 'acp_minimized_replies_body';

        // Form validation
        add_form_key('acp_minimized_replies');

        if ($request->is_set_post('submit'))
        {
            if (!check_form_key('acp_minimized_replies'))
            {
                trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            // Save configuration
            $config->set('minimized_replies_enabled', $request->variable('minimized_replies_enabled', 0));
            $config->set('minimized_replies_threshold', $request->variable('minimized_replies_threshold', 3));
            $config->set('minimized_replies_preview_length', $request->variable('minimized_replies_preview_length', 50));
            $config->set('minimized_replies_use_threading', $request->variable('minimized_replies_use_threading', 0));

            $phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'ACP_MINIMIZED_REPLIES_UPDATED');

            trigger_error($user->lang('CONFIG_UPDATED') . adm_back_link($this->u_action));
        }

        // Template variables
        $template->assign_vars([
            'MINIMIZED_REPLIES_ENABLED'        => $config['minimized_replies_enabled'],
            'MINIMIZED_REPLIES_THRESHOLD'      => $config['minimized_replies_threshold'],
            'MINIMIZED_REPLIES_PREVIEW_LENGTH' => $config['minimized_replies_preview_length'],
            'MINIMIZED_REPLIES_USE_THREADING'  => $config['minimized_replies_use_threading'],
            'U_ACTION'                         => $this->u_action,
        ]);
    }
}