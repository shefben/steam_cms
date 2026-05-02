<?php
/**
 * Historical Forum Manager - ACP Module
 */

namespace steamcms\historical_manager\acp;

class main_module
{
    public $page_title;
    public $tpl_name;
    public $u_action;

    public function main($id, $mode)
    {
        global $phpbb_container;

        $controller = $phpbb_container->get('steamcms.historical_manager.admin_controller');
        $controller->set_u_action($this->u_action);

        switch ($mode)
        {
            case 'dashboard':
                $this->page_title = 'ACP_HISTORICAL_MANAGER_DASHBOARD';
                $this->tpl_name = 'acp_historical_dashboard';
                $controller->handle_dashboard();
                break;

            case 'users':
                $this->page_title = 'ACP_HISTORICAL_MANAGER_USERS';
                $this->tpl_name = 'acp_historical_users';
                $controller->handle_users();
                break;

            case 'forums':
                $this->page_title = 'ACP_HISTORICAL_MANAGER_FORUMS';
                $this->tpl_name = 'acp_historical_forums';
                $controller->handle_forums();
                break;

            case 'topics':
                $this->page_title = 'ACP_HISTORICAL_MANAGER_TOPICS';
                $this->tpl_name = 'acp_historical_topics';
                $controller->handle_topics();
                break;

            case 'import':
                $this->page_title = 'ACP_HISTORICAL_MANAGER_IMPORT';
                $this->tpl_name = 'acp_historical_import';
                $controller->handle_import();
                break;
        }
    }
}
