<?php

namespace steamcms\forum_rules\acp;

class main_module
{
    public $page_title;
    public $tpl_name;
    public $u_action;

    public function main($id, $mode)
    {
        global $phpbb_container, $request, $template;

        /** @var \phpbb\config\config $config */
        $config = $phpbb_container->get('config');

        /** @var \phpbb\config\db_text $config_text */
        $config_text = $phpbb_container->get('config_text');

        /** @var \phpbb\language\language $language */
        $language = $phpbb_container->get('language');

        /** @var \phpbb\textformatter\s9e\parser $parser */
        $parser = $phpbb_container->get('text_formatter.parser');

        $language->add_lang('info_acp_forum_rules', 'steamcms/forum_rules');

        $this->page_title = $language->lang('ACP_FORUM_RULES_SETTINGS');
        $this->tpl_name = 'acp_forum_rules';

        add_form_key('steamcms_forum_rules');

        if ($request->is_set_post('submit'))
        {
            if (!check_form_key('steamcms_forum_rules'))
            {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }

            $enabled = $request->variable('steamcms_forum_rules_enabled', 0);
            $rules_text = $request->variable('steamcms_forum_rules_text', '', true);

            $config->set('steamcms_forum_rules_enabled', $enabled);

            // Parse BBCode for storage
            $parsed_text = '';
            if (!empty($rules_text))
            {
                $parsed_text = $parser->parse($rules_text);
            }
            $config_text->set('steamcms_forum_rules_text', $parsed_text);

            trigger_error($language->lang('ACP_FORUM_RULES_SAVED') . adm_back_link($this->u_action));
        }

        $rules_text_raw = $this->unparse_text($phpbb_container, $config_text->get('steamcms_forum_rules_text'));

        $template->assign_vars([
            'STEAMCMS_FORUM_RULES_ENABLED' => (int) $config['steamcms_forum_rules_enabled'],
            'STEAMCMS_FORUM_RULES_TEXT'    => $rules_text_raw,
            'U_ACTION'                     => $this->u_action,
        ]);
    }

    /**
     * Unparse stored XML back to BBCode text for editing
     */
    private function unparse_text($container, $text)
    {
        if (empty($text))
        {
            return '';
        }

        try
        {
            /** @var \phpbb\textformatter\s9e\utils $text_formatter_utils */
            $text_formatter_utils = $container->get('text_formatter.utils');
            return $text_formatter_utils->unparse($text);
        }
        catch (\Exception $e)
        {
            return $text;
        }
    }
}
