<?php
namespace steamcms\historicalfilter\event;

use phpbb\event\dispatcher_interface;
use phpbb\user;
use phpbb\template\template;

class main_listener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $user;
    protected $template;

    public function __construct(user $user, template $template)
    {
        $this->user = $user;
        $this->template = $template;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'core.viewforum_get_topic_data'     => 'filter_historical_topics',
            'core.viewtopic_get_post_data'      => 'filter_historical_posts',
            'core.index_modify_page_title'      => 'filter_historical_forums',
        );
    }

    /**
     * Check if current style allows historical data
     */
    private function is_historical_style_active()
    {
        $style_name = $this->user->style['style_name'] ?? '';
        $allowed_styles = ['Steam 2003', 'Steam 2004', 'steam_2003', 'steam_2004', '2003_v2', '2004'];

        return in_array($style_name, $allowed_styles, true);
    }

    /**
     * Filter historical topics from forum view
     */
    public function filter_historical_topics($event)
    {
        if (!$this->is_historical_style_active()) {
            $sql_where = $event['sql_where'];
            $sql_where .= ' AND (t.is_historical IS NULL OR t.is_historical = 0)';
            $event['sql_where'] = $sql_where;
        }
    }

    /**
     * Filter historical posts from topic view
     */
    public function filter_historical_posts($event)
    {
        if (!$this->is_historical_style_active()) {
            $sql_where = $event['sql_where'];
            $sql_where .= ' AND (p.is_historical IS NULL OR p.is_historical = 0)';
            $event['sql_where'] = $sql_where;
        }
    }

    /**
     * Filter historical forums from index
     */
    public function filter_historical_forums($event)
    {
        global $db;

        if (!$this->is_historical_style_active()) {
            // This will be handled by the forum permissions system
            // Historical forums should have special permissions set
        }
    }
}
