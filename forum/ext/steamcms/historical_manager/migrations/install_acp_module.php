<?php
/**
 * Historical Forum Manager - Migration
 *
 * Installs ACP module for managing historical forum data.
 */

namespace steamcms\historical_manager\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        $sql = "SELECT module_id FROM phpbb_modules
                WHERE module_class = 'acp'
                AND module_langname = 'ACP_HISTORICAL_MANAGER'";
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        return $row !== false;
    }

    public static function depends_on()
    {
        return ['\phpbb\db\migration\data\v320\v320'];
    }

    public function update_data()
    {
        return [
            // Add ACP category
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_HISTORICAL_MANAGER',
            ]],
            // Add Dashboard mode
            ['module.add', [
                'acp',
                'ACP_HISTORICAL_MANAGER',
                [
                    'module_basename'   => '\steamcms\historical_manager\acp\main_module',
                    'modes'             => ['dashboard', 'users', 'forums', 'topics', 'import'],
                ],
            ]],
        ];
    }
}
