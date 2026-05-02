<?php

namespace steamcms\forum_rules\acp;

class main_info
{
    public function module()
    {
        return [
            'filename' => '\steamcms\forum_rules\acp\main_module',
            'title'    => 'ACP_FORUM_RULES',
            'modes'    => [
                'settings' => [
                    'title' => 'ACP_FORUM_RULES_SETTINGS',
                    'auth'  => 'ext_steamcms/forum_rules && acl_a_board',
                    'cat'   => ['ACP_FORUM_RULES'],
                ],
            ],
        ];
    }
}
