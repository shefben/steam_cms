<?php
/**
 * Historical Data Filter - Event Listener
 *
 * Filters historical forum data based on active phpBB style.
 * When a non-historical style (e.g. prosilver, Steam 2006+) is active,
 * forums/topics/posts marked is_historical=1 are hidden from queries.
 */

namespace steamcms\historical_filter\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /**
     * Constructor
     *
     * @param \phpbb\user $user
     * @param \phpbb\template\template $template
     * @param \phpbb\db\driver\driver_interface $db
     */
    public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\db\driver\driver_interface $db)
    {
        $this->user = $user;
        $this->template = $template;
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'core.viewforum_get_topic_data'     => 'filter_historical_topics',
            'core.viewtopic_get_post_data'      => 'filter_historical_posts',
            'core.display_forums_modify_sql'    => 'filter_historical_forums',
        );
    }

    /**
     * Check if current style allows historical data
     *
     * Historical data (2004 Steam forums) should be visible when using
     * any 2003 or 2004 era theme.
     *
     * @return bool
     */
    private function is_historical_style_active()
    {
        $style_name = '';

        if (isset($this->user->style['style_name']))
        {
            $style_name = $this->user->style['style_name'];
        }

        // All styles that should show historical forum data
        $allowed_styles = array(
            'steam_2003_v1',
            'steam_2003_v2',
            'steam_2004',
            'Steam 2003',
            'Steam 2003 v1',
            'Steam 2003 v2',
            'Steam 2004',
            'steam_2003',
            '2003_v1',
            '2003_v2',
            '2004',
        );

        return in_array($style_name, $allowed_styles, true);
    }

    /**
     * Filter historical topics from forum view
     *
     * Event: core.viewforum_get_topic_data
     * Available vars: forum_data, sql_array, forum_id, topics_count, sort_days, sort_key, sort_dir
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_topics($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_array = $event['sql_array'];

            if (isset($sql_array['WHERE']) && !empty($sql_array['WHERE']))
            {
                $sql_array['WHERE'] .= ' AND (t.is_historical IS NULL OR t.is_historical = 0)';
            }
            else
            {
                $sql_array['WHERE'] = '(t.is_historical IS NULL OR t.is_historical = 0)';
            }

            $event['sql_array'] = $sql_array;
        }
    }

    /**
     * Filter historical posts from topic view
     *
     * Event: core.viewtopic_get_post_data
     * Available vars: sort_key, sort_dir, start, sql_ary
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_posts($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_ary = $event['sql_ary'];

            if (isset($sql_ary['WHERE']) && !empty($sql_ary['WHERE']))
            {
                $sql_ary['WHERE'] .= ' AND (p.is_historical IS NULL OR p.is_historical = 0)';
            }
            else
            {
                $sql_ary['WHERE'] = '(p.is_historical IS NULL OR p.is_historical = 0)';
            }

            $event['sql_ary'] = $sql_ary;
        }
    }

    /**
     * Filter historical forums from index
     *
     * Event: core.display_forums_modify_sql
     * Available vars: sql_ary
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_forums($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_ary = $event['sql_ary'];

            if (isset($sql_ary['WHERE']) && !empty($sql_ary['WHERE']))
            {
                $sql_ary['WHERE'] .= ' AND (f.is_historical IS NULL OR f.is_historical = 0)';
            }
            else
            {
                $sql_ary['WHERE'] = '(f.is_historical IS NULL OR f.is_historical = 0)';
            }

            $event['sql_ary'] = $sql_ary;
        }
    }
}
