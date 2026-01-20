<?php
/**
 * Historical Data Filter - Event Listener
 *
 * Filters historical forum data based on active phpBB style.
 */

namespace steamcms\historical_filter\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\template\template */
    protected $template;

    /**
     * Constructor
     *
     * @param \phpbb\user $user
     * @param \phpbb\template\template $template
     */
    public function __construct(\phpbb\user $user, \phpbb\template\template $template)
    {
        $this->user = $user;
        $this->template = $template;
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
     * any 2003 or 2004 era theme. Style names must match what
     * get_steam_theme_by_date() returns in functions_steam_theme.php
     *
     * @return bool
     */
    private function is_historical_style_active()
    {
        $style_name = isset($this->user->style['style_name']) ? $this->user->style['style_name'] : '';

        // All styles that should show historical forum data
        // These names match the style_name values in phpbb_styles table
        $allowed_styles = array(
            // Date-based theme names (from functions_steam_theme.php)
            'steam_2003_v1',
            'steam_2003_v2',
            'steam_2004',
            // Legacy style names for backwards compatibility
            'Steam 2003',
            'Steam 2004',
            'steam_2003',
            '2003_v2',
            '2004',
        );

        return in_array($style_name, $allowed_styles, true);
    }

    /**
     * Filter historical topics from forum view
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_topics($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_where = $event['sql_where'];
            $sql_where .= ' AND (t.is_historical IS NULL OR t.is_historical = 0)';
            $event['sql_where'] = $sql_where;
        }
    }

    /**
     * Filter historical posts from topic view
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_posts($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_where = $event['sql_where'];
            $sql_where .= ' AND (p.is_historical IS NULL OR p.is_historical = 0)';
            $event['sql_where'] = $sql_where;
        }
    }

    /**
     * Filter historical forums from index
     *
     * @param \phpbb\event\data $event
     */
    public function filter_historical_forums($event)
    {
        if (!$this->is_historical_style_active())
        {
            $sql_where = $event['sql_where'];
            $sql_where .= ' AND (f.is_historical IS NULL OR f.is_historical = 0)';
            $event['sql_where'] = $sql_where;
        }
    }
}
