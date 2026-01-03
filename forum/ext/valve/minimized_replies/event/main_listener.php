<?php
/**
 * Steam Forum Minimized Replies Extension - Main Event Listener
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener for minimized replies functionality
 */
class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\path_helper */
    protected $path_helper;

    /**
     * Constructor
     */
    public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\request\request $request, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\path_helper $path_helper)
    {
        $this->config = $config;
        $this->template = $template;
        $this->request = $request;
        $this->user = $user;
        $this->db = $db;
        $this->path_helper = $path_helper;
    }

    /**
     * Get subscribed events
     */
    public static function getSubscribedEvents()
    {
        return [
            'core.viewtopic_modify_page_title'          => 'modify_viewtopic_page',
            'core.viewtopic_assign_template_vars_before' => 'prepare_minimized_data',
            'core.viewtopic_modify_post_data'          => 'process_post_data',
        ];
    }

    /**
     * Modify viewtopic page to include minimized replies functionality
     */
    public function modify_viewtopic_page($event)
    {
        // Only enable for Steam themes
        $style_name = $this->user->style['style_name'];
        $is_steam_theme = (strpos($style_name, 'steam_') === 0);

        if (!$this->config['minimized_replies_enabled'] || !$is_steam_theme) {
            return;
        }

        // Add CSS and JavaScript for minimized replies
        $this->template->assign_vars([
            'S_MINIMIZED_REPLIES_ENABLED' => true,
            'MINIMIZED_REPLIES_THRESHOLD' => $this->config['minimized_replies_threshold'],
            'MINIMIZED_REPLIES_PREVIEW_LENGTH' => $this->config['minimized_replies_preview_length'],
        ]);

        // Load additional JavaScript
        $this->template->assign_vars([
            'MINIMIZED_REPLIES_JS_PATH' => $this->path_helper->update_web_root_path(generate_board_url() . '/ext/valve/minimized_replies/styles/assets/js/'),
        ]);
    }

    /**
     * Prepare minimized replies data structure
     */
    public function prepare_minimized_data($event)
    {
        if (!$this->config['minimized_replies_enabled']) {
            return;
        }

        $topic_data = $event['topic_data'];
        $forum_id = $topic_data['forum_id'];
        $topic_id = $topic_data['topic_id'];

        // Get view mode (threaded or linear)
        $view_mode = $this->request->variable('mode', 'threaded');

        if ($view_mode === 'threaded') {
            // Generate threaded view data
            $this->template->assign_vars([
                'S_THREADED_MODE' => true,
                'S_LINEAR_MODE' => false,
            ]);
        }
    }

    /**
     * Process post data for minimized display
     */
    public function process_post_data($event)
    {
        if (!$this->config['minimized_replies_enabled']) {
            return;
        }

        $post_list = $event['post_list'];
        $rowset = $event['rowset'];
        $topic_data = $event['topic_data'];

        // Build threaded structure and minimized data
        $minimized_posts = [];
        $post_tree = [];

        foreach ($rowset as $post_id => $post_data) {
            // Create minimized version of each post
            $minimized_posts[$post_id] = $this->create_minimized_post($post_data);

            // Build tree structure (simplified for this implementation)
            $post_tree[$post_id] = [
                'post_id' => $post_id,
                'parent_id' => 0, // phpBB doesn't have native threading, so we'll simulate it
                'depth' => 0,
                'username' => $post_data['username'],
                'post_time' => $post_data['post_time'],
                'preview' => $this->create_post_preview($post_data['post_text']),
            ];
        }

        // Store in template variables
        $this->template->assign_vars([
            'MINIMIZED_POSTS' => json_encode($minimized_posts),
            'POST_TREE_DATA' => json_encode($post_tree),
        ]);
    }

    /**
     * Create minimized post representation
     */
    private function create_minimized_post($post_data)
    {
        $preview_length = $this->config['minimized_replies_preview_length'];

        return [
            'post_id' => $post_data['post_id'],
            'username' => $post_data['username'],
            'user_colour' => $post_data['user_colour'],
            'post_time' => $this->user->format_date($post_data['post_time']),
            'preview' => $this->create_post_preview($post_data['post_text'], $preview_length),
            'is_new' => ($post_data['post_time'] > $this->user->data['user_lastmark']),
        ];
    }

    /**
     * Create post preview text
     */
    private function create_post_preview($post_text, $length = 50)
    {
        // Strip BBCode and HTML
        $preview = strip_tags($post_text);

        // Remove BBCode tags
        $preview = preg_replace('/\[.*?\]/', '', $preview);

        // Trim whitespace
        $preview = trim($preview);

        // Truncate to specified length
        if (strlen($preview) > $length) {
            $preview = substr($preview, 0, $length) . '...';
        }

        return htmlspecialchars($preview);
    }
}