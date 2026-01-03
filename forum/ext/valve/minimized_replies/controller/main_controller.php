<?php
/**
 * Steam Forum Minimized Replies Extension - Main Controller
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

namespace valve\minimized_replies\controller;

/**
 * Main controller for AJAX operations
 */
class main_controller
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

    /** @var \phpbb\auth\auth */
    protected $auth;

    /**
     * Constructor
     */
    public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\request\request $request, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\auth\auth $auth)
    {
        $this->config = $config;
        $this->template = $template;
        $this->request = $request;
        $this->user = $user;
        $this->db = $db;
        $this->auth = $auth;
    }

    /**
     * Get full post content for expansion
     */
    public function get_post($post_id)
    {
        $post_id = (int) $post_id;

        if (!$post_id) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(['error' => 'Invalid post ID'], 400);
        }

        // Get post data
        $sql = 'SELECT p.*, t.topic_title, f.forum_id, u.username, u.user_colour
                FROM ' . POSTS_TABLE . ' p
                LEFT JOIN ' . TOPICS_TABLE . ' t ON t.topic_id = p.topic_id
                LEFT JOIN ' . FORUMS_TABLE . ' f ON f.forum_id = t.forum_id
                LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = p.poster_id
                WHERE p.post_id = ' . $post_id;

        $result = $this->db->sql_query($sql);
        $post_data = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$post_data) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(['error' => 'Post not found'], 404);
        }

        // Check permissions
        if (!$this->auth->acl_get('f_read', $post_data['forum_id'])) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(['error' => 'Access denied'], 403);
        }

        // Format post for display
        $formatted_post = $this->format_post_for_display($post_data);

        return new \Symfony\Component\HttpFoundation\JsonResponse([
            'success' => true,
            'post' => $formatted_post,
        ]);
    }

    /**
     * Format post data for display
     */
    private function format_post_for_display($post_data)
    {
        // Parse BBCode and generate formatted message
        $message = generate_text_for_display($post_data['post_text'], $post_data['bbcode_uid'], $post_data['bbcode_bitfield'], 7);

        return [
            'post_id' => $post_data['post_id'],
            'username' => $post_data['username'],
            'user_colour' => $post_data['user_colour'],
            'post_time' => $this->user->format_date($post_data['post_time']),
            'post_subject' => censor_text($post_data['post_subject']),
            'message' => $message,
            'poster_posts' => $post_data['poster_posts'],
            'poster_joined' => $this->user->format_date($post_data['poster_joined'], 'M d, Y'),
            'signature' => ($post_data['enable_sig']) ? generate_text_for_display($post_data['post_signature'], $post_data['bbcode_uid'], $post_data['bbcode_bitfield'], 7) : '',
        ];
    }

    /**
     * Toggle thread view mode (threaded/linear)
     */
    public function toggle_view_mode()
    {
        $mode = $this->request->variable('mode', 'threaded');
        $topic_id = $this->request->variable('t', 0);

        if (!$topic_id) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(['error' => 'Invalid topic ID'], 400);
        }

        // Store preference in session or user data
        $this->request->overwrite('mode', $mode, \phpbb\request\request_interface::SESSION);

        return new \Symfony\Component\HttpFoundation\JsonResponse([
            'success' => true,
            'mode' => $mode,
            'redirect_url' => append_sid('viewtopic.' . 'php', "t={$topic_id}&mode={$mode}"),
        ]);
    }
}