<?php

namespace steamcms\forum_rules\migrations;

class install_forum_rules extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['steamcms_forum_rules_enabled']);
    }

    public static function depends_on()
    {
        return ['\phpbb\db\migration\data\v330\v330'];
    }

    public function update_data()
    {
        return [
            ['config.add', ['steamcms_forum_rules_enabled', 0]],
            ['config_text.add', ['steamcms_forum_rules_text', '']],

            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_FORUM_RULES',
            ]],
            ['module.add', [
                'acp',
                'ACP_FORUM_RULES',
                [
                    'module_basename' => '\steamcms\forum_rules\acp\main_module',
                    'modes'           => ['settings'],
                ],
            ]],
        ];
    }
}
