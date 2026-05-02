<?php
/**
 * Historical Forum Manager - ACP Module Info
 */

namespace steamcms\historical_manager\acp;

class main_info
{
    public function module()
    {
        return [
            'filename'  => '\steamcms\historical_manager\acp\main_module',
            'title'     => 'ACP_HISTORICAL_MANAGER',
            'modes'     => [
                'dashboard' => [
                    'title' => 'ACP_HISTORICAL_MANAGER_DASHBOARD',
                    'auth'  => 'ext_steamcms/historical_manager && acl_a_board',
                    'cat'   => ['ACP_HISTORICAL_MANAGER'],
                ],
                'users' => [
                    'title' => 'ACP_HISTORICAL_MANAGER_USERS',
                    'auth'  => 'ext_steamcms/historical_manager && acl_a_board',
                    'cat'   => ['ACP_HISTORICAL_MANAGER'],
                ],
                'forums' => [
                    'title' => 'ACP_HISTORICAL_MANAGER_FORUMS',
                    'auth'  => 'ext_steamcms/historical_manager && acl_a_board',
                    'cat'   => ['ACP_HISTORICAL_MANAGER'],
                ],
                'topics' => [
                    'title' => 'ACP_HISTORICAL_MANAGER_TOPICS',
                    'auth'  => 'ext_steamcms/historical_manager && acl_a_board',
                    'cat'   => ['ACP_HISTORICAL_MANAGER'],
                ],
                'import' => [
                    'title' => 'ACP_HISTORICAL_MANAGER_IMPORT',
                    'auth'  => 'ext_steamcms/historical_manager && acl_a_board',
                    'cat'   => ['ACP_HISTORICAL_MANAGER'],
                ],
            ],
        ];
    }
}
