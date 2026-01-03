<?php
/**
 * Steam Forum Minimized Replies Extension - Helper Class
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies\helper;

/**
 * Helper class for minimized replies functionality
 */
class minimized_helper
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /**
     * Constructor
     */
    public function __construct(\phpbb\config\config $config, \phpbb\user $user, \phpbb\db\driver\driver_interface $db)
    {
        $this->config = $config;
        $this->user = $user;
        $this->db = $db;
    }

    /**
     * Build threaded post tree structure
     */
    public function build_post_tree($posts_data, $topic_id)
    {
        $tree = [];
        $depth_map = [];

        foreach ($posts_data as $post_data) {
            $post_id = $post_data['post_id'];

            // Since phpBB doesn't have native threading, simulate it based on post order
            $tree[$post_id] = [
                'post_id' => $post_id,
                'parent_id' => 0,
                'depth' => 0,
                'post_time' => $post_data['post_time'],
                'username' => $post_data['username'],
                'user_colour' => $post_data['user_colour'],
                'preview' => $this->create_post_preview($post_data['post_text']),
                'is_new' => $this->is_post_new($post_data['post_time']),
                'tree_icon' => $this->get_tree_icon(0), // depth 0 for all posts in basic mode
            ];
        }

        return $tree;
    }

    /**
     * Create post preview text (like vBulletin's truncated preview)
     */
    public function create_post_preview($post_text, $length = null)
    {
        if ($length === null) {
            $length = $this->config['minimized_replies_preview_length'] ?: 50;
        }

        // Strip BBCode
        $preview = preg_replace('/\[.*?\]/', '', $post_text);

        // Strip HTML
        $preview = strip_tags($preview);

        // Clean whitespace
        $preview = preg_replace('/\s+/', ' ', trim($preview));

        // Truncate
        if (strlen($preview) > $length) {
            $preview = substr($preview, 0, $length) . '...';
        }

        return htmlspecialchars($preview);
    }

    /**
     * Check if post is new (for post icon display)
     */
    public function is_post_new($post_time)
    {
        return ($post_time > $this->user->data['user_lastmark']);
    }

    /**
     * Get appropriate tree icon based on depth and position
     */
    public function get_tree_icon($depth, $is_last = false)
    {
        if ($depth === 0) {
            return 'tree_root.gif';
        } elseif ($is_last) {
            return 'tree_ltr.gif'; // Last reply in thread
        } else {
            return 'tree_t.gif'; // Middle reply
        }
    }

    /**
     * Generate JavaScript data for minimized posts
     */
    public function generate_js_data($post_tree)
    {
        $js_data = [];

        foreach ($post_tree as $post_id => $post_data) {
            $js_data[$post_id] = [
                'username' => addslashes($post_data['username']),
                'preview' => addslashes($post_data['preview']),
                'post_time' => $this->user->format_date($post_data['post_time']),
                'is_new' => $post_data['is_new'],
                'tree_icon' => $post_data['tree_icon'],
                'depth' => $post_data['depth'],
            ];
        }

        return json_encode($js_data);
    }

    /**
     * Check if minimized replies should be enabled for current user/topic
     */
    public function should_enable_minimized_replies($topic_data, $post_count)
    {
        // Check if extension is enabled
        if (!$this->config['minimized_replies_enabled']) {
            return false;
        }

        // Check if we're using a Steam theme
        $style_name = $this->user->style['style_name'];
        if (strpos($style_name, 'steam_') !== 0) {
            return false;
        }

        // Check if topic has enough posts to warrant minimized view
        $threshold = $this->config['minimized_replies_threshold'] ?: 3;
        if ($post_count < $threshold) {
            return false;
        }

        return true;
    }

    /**
     * Generate writeLink JavaScript function calls (like vBulletin)
     */
    public function generate_write_link_calls($post_tree)
    {
        $calls = [];

        foreach ($post_tree as $post_id => $post_data) {
            $calls[] = sprintf(
                'writeLink(%d, %d, %d, %d, "%s", "%s", "%s", "%s", %d);',
                $post_id,
                $post_data['parent_id'],
                $post_data['depth'],
                0, // user_id placeholder
                addslashes($post_data['tree_icon']),
                addslashes($post_data['preview']),
                date('m-d-Y', $post_data['post_time']),
                date('h:i A', $post_data['post_time']),
                $post_data['is_new'] ? 1 : 0
            );
        }

        return implode("\n  ", $calls);
    }
}