<?php
/**
 * Steam Forum Minimized Replies Extension - ACP Module Info
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies\acp;

/**
 * ACP module info for minimized replies
 */
class main_info
{
    /**
     * Return module info
     */
    public function module()
    {
        return [
            'filename'    => '\valve\minimized_replies\acp\main_module',
            'title'       => 'ACP_MINIMIZED_REPLIES',
            'modes'       => [
                'settings' => [
                    'title' => 'ACP_MINIMIZED_REPLIES_SETTINGS',
                    'auth'  => 'ext_valve/minimized_replies && acl_a_board',
                    'cat'   => ['ACP_MINIMIZED_REPLIES']
                ],
            ],
        ];
    }
}