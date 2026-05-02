<?php
/**
 * Historical Forum Manager - Admin Controller
 *
 * Handles all ACP operations for managing historical forum data.
 */

namespace steamcms\historical_manager\controller;

class admin_controller
{
    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\log\log */
    protected $log;

    /** @var string */
    protected $root_path;

    /** @var string */
    protected $php_ext;

    /** @var string */
    protected $u_action;

    /** @var int */
    protected $items_per_page = 25;

    public function __construct(
        \phpbb\db\driver\driver_interface $db,
        \phpbb\request\request $request,
        \phpbb\template\template $template,
        \phpbb\user $user,
        \phpbb\config\config $config,
        \phpbb\log\log $log,
        $root_path,
        $php_ext
    )
    {
        $this->db = $db;
        $this->request = $request;
        $this->template = $template;
        $this->user = $user;
        $this->config = $config;
        $this->log = $log;
        $this->root_path = $root_path;
        $this->php_ext = $php_ext;
    }

    public function set_u_action($u_action)
    {
        $this->u_action = $u_action;
    }

    // ========================================================================
    // DASHBOARD
    // ========================================================================

    public function handle_dashboard()
    {
        $this->user->add_lang_ext('steamcms/historical_manager', 'info_acp_historical_manager');
        add_form_key('historical_manager_dashboard');

        $action = $this->request->variable('action', '');

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_dashboard'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            switch ($action)
            {
                case 'recalculate':
                    $this->recalculate_counters();
                    trigger_error($this->user->lang('HISTORICAL_RECALCULATED') . adm_back_link($this->u_action));
                    break;

                case 'rebuild_tree':
                    $this->rebuild_forum_tree();
                    trigger_error($this->user->lang('HISTORICAL_TREE_REBUILT') . adm_back_link($this->u_action));
                    break;

                case 'fix_permissions':
                    $this->fix_permissions();
                    trigger_error($this->user->lang('HISTORICAL_PERMISSIONS_FIXED') . adm_back_link($this->u_action));
                    break;

                case 'purge':
                    if (confirm_box(true))
                    {
                        $this->purge_all_historical();
                        trigger_error($this->user->lang('HISTORICAL_PURGED') . adm_back_link($this->u_action));
                    }
                    else
                    {
                        confirm_box(false, $this->user->lang('HISTORICAL_PURGE_CONFIRM'), build_hidden_fields([
                            'action'    => 'purge',
                            'submit'    => true,
                        ]));
                    }
                    break;
            }
        }

        // Get statistics
        $stats = $this->get_statistics();

        $this->template->assign_vars([
            'HISTORICAL_USERS'          => $stats['users'],
            'HISTORICAL_FORUMS'         => $stats['forums'],
            'HISTORICAL_TOPICS'         => $stats['topics'],
            'HISTORICAL_POSTS'          => $stats['posts'],
            'HISTORICAL_ATTACHMENTS'    => $stats['attachments'],
            'U_ACTION'                  => $this->u_action,
        ]);
    }

    private function get_statistics()
    {
        $stats = ['users' => 0, 'forums' => 0, 'topics' => 0, 'posts' => 0, 'attachments' => 0];

        $tables = [
            'users'  => 'phpbb_users',
            'forums' => 'phpbb_forums',
            'topics' => 'phpbb_topics',
            'posts'  => 'phpbb_posts',
        ];

        foreach ($tables as $key => $table)
        {
            $sql = "SELECT COUNT(*) as cnt FROM $table WHERE is_historical = 1";
            $result = $this->db->sql_query($sql);
            $row = $this->db->sql_fetchrow($result);
            $stats[$key] = (int) $row['cnt'];
            $this->db->sql_freeresult($result);
        }

        // Attachments tied to historical posts
        $sql = "SELECT COUNT(*) as cnt FROM phpbb_attachments a
                INNER JOIN phpbb_posts p ON p.post_msg_id = a.post_msg_id
                WHERE p.is_historical = 1";
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        if ($row)
        {
            $stats['attachments'] = (int) $row['cnt'];
        }
        $this->db->sql_freeresult($result);

        return $stats;
    }

    private function recalculate_counters()
    {
        // Fix visibility
        $this->db->sql_query("UPDATE phpbb_topics SET topic_visibility = 1 WHERE is_historical = 1");
        $this->db->sql_query("UPDATE phpbb_posts SET post_visibility = 1 WHERE is_historical = 1");

        // Forum counters
        $this->db->sql_query("UPDATE phpbb_forums f SET
            forum_topics_approved = (SELECT COUNT(*) FROM phpbb_topics t WHERE t.forum_id = f.forum_id AND t.topic_visibility = 1),
            forum_posts_approved = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
        WHERE f.is_historical = 1");

        // Topic post counts
        $this->db->sql_query("UPDATE phpbb_topics t SET
            topic_posts_approved = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.topic_id = t.topic_id AND p.post_visibility = 1)
        WHERE t.is_historical = 1");

        // Topic first/last post references
        $this->db->sql_query("UPDATE phpbb_topics t SET
            topic_first_post_id = (SELECT MIN(post_id) FROM phpbb_posts p WHERE p.topic_id = t.topic_id),
            topic_last_post_id = (SELECT MAX(post_id) FROM phpbb_posts p WHERE p.topic_id = t.topic_id),
            topic_last_post_time = (SELECT MAX(post_time) FROM phpbb_posts p WHERE p.topic_id = t.topic_id)
        WHERE t.is_historical = 1");

        // Forum last post
        $this->db->sql_query("UPDATE phpbb_forums f SET
            forum_last_post_id = (SELECT MAX(post_id) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1),
            forum_last_post_time = (SELECT MAX(post_time) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
        WHERE f.is_historical = 1");

        // Poster names in posts table
        $this->db->sql_query("UPDATE phpbb_posts p
            INNER JOIN phpbb_users u ON p.poster_id = u.user_id
            SET p.post_username = u.username
        WHERE p.is_historical = 1 AND (p.post_username = '' OR p.post_username IS NULL)");

        // Topic first/last poster names
        $this->db->sql_query("UPDATE phpbb_topics t
            INNER JOIN phpbb_posts p ON p.post_id = t.topic_last_post_id
            INNER JOIN phpbb_users u ON u.user_id = p.poster_id
            SET t.topic_last_poster_id = p.poster_id,
                t.topic_last_poster_name = u.username,
                t.topic_last_poster_colour = ''
        WHERE t.is_historical = 1");

        $this->db->sql_query("UPDATE phpbb_topics t
            INNER JOIN phpbb_posts p ON p.post_id = t.topic_first_post_id
            INNER JOIN phpbb_users u ON u.user_id = p.poster_id
            SET t.topic_first_poster_name = u.username,
                t.topic_first_poster_colour = ''
        WHERE t.is_historical = 1");

        // Forum last poster names
        $this->db->sql_query("UPDATE phpbb_forums f
            INNER JOIN phpbb_posts p ON p.post_id = f.forum_last_post_id
            INNER JOIN phpbb_users u ON u.user_id = p.poster_id
            SET f.forum_last_poster_id = p.poster_id,
                f.forum_last_poster_name = u.username,
                f.forum_last_poster_colour = ''
        WHERE f.is_historical = 1");

        // User post counts
        $this->db->sql_query("UPDATE phpbb_users u SET
            user_posts = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.poster_id = u.user_id AND p.post_visibility = 1)
        WHERE u.is_historical = 1");

        // User group membership
        $this->db->sql_query("INSERT IGNORE INTO phpbb_user_group (group_id, user_id, user_pending, group_leader)
            SELECT 2, user_id, 0, 0 FROM phpbb_users WHERE is_historical = 1");

        // User lang/type
        $this->db->sql_query("UPDATE phpbb_users SET user_lang = 'en' WHERE is_historical = 1 AND (user_lang = '' OR user_lang IS NULL)");
        $this->db->sql_query("UPDATE phpbb_users SET user_type = 0 WHERE is_historical = 1 AND (user_type IS NULL OR user_type != 0)");

        // Forum type (must be postable)
        $this->db->sql_query("UPDATE phpbb_forums SET forum_type = 1 WHERE is_historical = 1");

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'HISTORICAL_RECALCULATED');
    }

    private function rebuild_forum_tree()
    {
        // Build parent->children map
        $sql = "SELECT forum_id, parent_id FROM phpbb_forums ORDER BY parent_id, forum_id";
        $result = $this->db->sql_query($sql);
        $children = [];
        while ($row = $this->db->sql_fetchrow($result))
        {
            $pid = (int) $row['parent_id'];
            $children[$pid][] = (int) $row['forum_id'];
        }
        $this->db->sql_freeresult($result);

        // Recursive nested set numbering
        $counter = 0;
        $updates = [];
        $rebuild = function($parent_id) use (&$rebuild, &$children, &$counter, &$updates) {
            if (empty($children[$parent_id])) return;
            foreach ($children[$parent_id] as $forum_id) {
                $counter++;
                $left = $counter;
                $rebuild($forum_id);
                $counter++;
                $right = $counter;
                $updates[] = ['id' => $forum_id, 'left' => $left, 'right' => $right];
            }
        };
        $rebuild(0);

        foreach ($updates as $u)
        {
            $sql = "UPDATE phpbb_forums SET left_id = " . (int) $u['left'] . ", right_id = " . (int) $u['right'] . " WHERE forum_id = " . (int) $u['id'];
            $this->db->sql_query($sql);
        }

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'HISTORICAL_TREE_REBUILT');
    }

    private function fix_permissions()
    {
        $sql = "SELECT forum_id FROM phpbb_forums WHERE is_historical = 1";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $fid = (int) $row['forum_id'];
            $perms = [
                [1, $fid, 17],  // GUESTS: readonly
                [2, $fid, 15],  // REGISTERED: standard
                [3, $fid, 15],  // REGISTERED_COPPA: standard
                [4, $fid, 21],  // GLOBAL_MODS: polls
                [5, $fid, 14],  // ADMINS: full forum
                [5, $fid, 10],  // ADMINS: full mod
                [6, $fid, 19],  // BOTS: bot
                [7, $fid, 24],  // NEW_MEMBERS: queue
            ];
            foreach ($perms as $p)
            {
                $this->db->sql_query("INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
                    VALUES ({$p[0]}, {$p[1]}, 0, {$p[2]}, 0)");
            }
        }
        $this->db->sql_freeresult($result);

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'HISTORICAL_PERMISSIONS_FIXED');
    }

    private function purge_all_historical()
    {
        // Delete in dependency order
        $this->db->sql_query("DELETE FROM phpbb_posts WHERE is_historical = 1");
        $this->db->sql_query("DELETE FROM phpbb_topics WHERE is_historical = 1");

        // Remove ACL for historical forums before deleting them
        $sql = "SELECT forum_id FROM phpbb_forums WHERE is_historical = 1";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->db->sql_query("DELETE FROM phpbb_acl_groups WHERE forum_id = " . (int) $row['forum_id']);
        }
        $this->db->sql_freeresult($result);

        $this->db->sql_query("DELETE FROM phpbb_forums WHERE is_historical = 1");

        // Remove user group membership before deleting users
        $sql = "SELECT user_id FROM phpbb_users WHERE is_historical = 1";
        $result = $this->db->sql_query($sql);
        $user_ids = [];
        while ($row = $this->db->sql_fetchrow($result))
        {
            $user_ids[] = (int) $row['user_id'];
        }
        $this->db->sql_freeresult($result);

        if (!empty($user_ids))
        {
            $this->db->sql_query("DELETE FROM phpbb_user_group WHERE " . $this->db->sql_in_set('user_id', $user_ids));
        }

        $this->db->sql_query("DELETE FROM phpbb_users WHERE is_historical = 1");

        // Rebuild tree for remaining forums
        $this->rebuild_forum_tree();

        $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'HISTORICAL_PURGED');
    }

    // ========================================================================
    // USERS MANAGEMENT
    // ========================================================================

    public function handle_users()
    {
        $this->user->add_lang_ext('steamcms/historical_manager', 'info_acp_historical_manager');
        add_form_key('historical_manager_users');

        $action = $this->request->variable('action', '');
        $user_id = $this->request->variable('user_id', 0);

        switch ($action)
        {
            case 'add':
            case 'edit':
                $this->handle_user_form($action, $user_id);
                return;

            case 'delete':
                $this->handle_user_delete($user_id);
                return;
        }

        // List users
        $start = $this->request->variable('start', 0);
        $search = $this->request->variable('search', '');

        $where = "WHERE is_historical = 1";
        if ($search)
        {
            $where .= " AND username_clean LIKE '%" . $this->db->sql_escape(utf8_clean_string($search)) . "%'";
        }

        // Count
        $sql = "SELECT COUNT(*) as cnt FROM phpbb_users $where";
        $result = $this->db->sql_query($sql);
        $total = (int) $this->db->sql_fetchfield('cnt');
        $this->db->sql_freeresult($result);

        // Fetch page
        $sql = "SELECT user_id, username, user_email, user_regdate, user_posts
                FROM phpbb_users $where
                ORDER BY user_id ASC";
        $result = $this->db->sql_query_limit($sql, $this->items_per_page, $start);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('users', [
                'USER_ID'       => $row['user_id'],
                'USERNAME'      => $row['username'],
                'EMAIL'         => $row['user_email'],
                'REGDATE'       => $this->user->format_date($row['user_regdate']),
                'POSTS'         => $row['user_posts'],
                'U_EDIT'        => $this->u_action . '&amp;action=edit&amp;user_id=' . $row['user_id'],
                'U_DELETE'      => $this->u_action . '&amp;action=delete&amp;user_id=' . $row['user_id'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'TOTAL_USERS'   => $total,
            'SEARCH'        => $search,
            'PAGINATION'    => $this->build_pagination($total, $start),
            'U_ACTION'      => $this->u_action,
            'U_ADD'         => $this->u_action . '&amp;action=add',
            'START'         => $start,
        ]);
    }

    private function handle_user_form($action, $user_id)
    {
        $user_data = [];
        if ($action === 'edit' && $user_id)
        {
            $sql = "SELECT * FROM phpbb_users WHERE user_id = " . (int) $user_id . " AND is_historical = 1";
            $result = $this->db->sql_query($sql);
            $user_data = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);
            if (!$user_data)
            {
                trigger_error('User not found.' . adm_back_link($this->u_action), E_USER_WARNING);
            }
        }

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_users'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $username = $this->request->variable('username', '', true);
            $email = $this->request->variable('email', '', true);
            $regdate = $this->request->variable('regdate', '');

            if (empty($username))
            {
                trigger_error('Username is required.' . adm_back_link($this->u_action . '&amp;action=' . $action . '&amp;user_id=' . $user_id), E_USER_WARNING);
            }

            // Add [2004] prefix if not present
            if (strpos($username, '[2004] ') !== 0)
            {
                $username = '[2004] ' . $username;
            }

            $username_clean = utf8_clean_string(str_replace('[2004] ', '', $username));
            $regdate_ts = $regdate ? strtotime($regdate) : time();
            if (!$regdate_ts) $regdate_ts = time();

            $data = [
                'username'          => $username,
                'username_clean'    => $username_clean,
                'user_email'        => $email ?: 'historical@steamforums.local',
                'user_regdate'      => $regdate_ts,
                'user_password'     => '',
                'user_type'         => 0,
                'user_lang'         => 'en',
                'is_historical'     => 1,
            ];

            if ($action === 'edit' && $user_id)
            {
                $sql = "UPDATE phpbb_users SET " . $this->db->sql_build_array('UPDATE', $data) . " WHERE user_id = " . (int) $user_id;
                $this->db->sql_query($sql);
            }
            else
            {
                // Generate next historical user ID (100000+)
                $sql = "SELECT MAX(user_id) as max_id FROM phpbb_users WHERE user_id >= 100000 AND user_id < 1000000";
                $result = $this->db->sql_query($sql);
                $max_id = (int) $this->db->sql_fetchfield('max_id');
                $this->db->sql_freeresult($result);
                $new_id = max($max_id + 1, 100001);

                $data['user_id'] = $new_id;
                $sql = "INSERT INTO phpbb_users " . $this->db->sql_build_array('INSERT', $data);
                $this->db->sql_query($sql);

                // Add to REGISTERED group
                $this->db->sql_query("INSERT IGNORE INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (2, $new_id, 0, 0)");
            }

            trigger_error($this->user->lang('HISTORICAL_USER_SAVED') . adm_back_link($this->u_action));
        }

        $this->template->assign_vars([
            'S_EDIT'        => ($action === 'edit'),
            'USER_ID'       => $user_data ? $user_data['user_id'] : 0,
            'USERNAME'      => $user_data ? $user_data['username'] : '[2004] ',
            'EMAIL'         => $user_data ? $user_data['user_email'] : 'historical@steamforums.local',
            'REGDATE'       => $user_data ? date('Y-m-d', $user_data['user_regdate']) : '2004-01-01',
            'U_ACTION'      => $this->u_action . '&amp;action=' . $action . '&amp;user_id=' . ($user_data ? $user_data['user_id'] : 0),
            'U_BACK'        => $this->u_action,
        ]);
    }

    private function handle_user_delete($user_id)
    {
        if (!$user_id)
        {
            trigger_error('Invalid user.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        if (confirm_box(true))
        {
            // Delete user's posts first
            $this->db->sql_query("DELETE FROM phpbb_posts WHERE poster_id = " . (int) $user_id . " AND is_historical = 1");
            $this->db->sql_query("DELETE FROM phpbb_user_group WHERE user_id = " . (int) $user_id);
            $this->db->sql_query("DELETE FROM phpbb_users WHERE user_id = " . (int) $user_id . " AND is_historical = 1");

            trigger_error($this->user->lang('HISTORICAL_USER_DELETED') . adm_back_link($this->u_action));
        }
        else
        {
            confirm_box(false, $this->user->lang('HISTORICAL_CONFIRM_DELETE'), build_hidden_fields([
                'action'    => 'delete',
                'user_id'   => $user_id,
            ]));
        }
    }

    // ========================================================================
    // FORUMS MANAGEMENT
    // ========================================================================

    public function handle_forums()
    {
        $this->user->add_lang_ext('steamcms/historical_manager', 'info_acp_historical_manager');
        add_form_key('historical_manager_forums');

        $action = $this->request->variable('action', '');
        $forum_id = $this->request->variable('forum_id', 0);

        switch ($action)
        {
            case 'add':
            case 'edit':
                $this->handle_forum_form($action, $forum_id);
                return;

            case 'delete':
                $this->handle_forum_delete($forum_id);
                return;
        }

        // List forums
        $sql = "SELECT f.forum_id, f.forum_name, f.forum_desc, f.parent_id,
                       f.forum_topics_approved, f.forum_posts_approved
                FROM phpbb_forums f
                WHERE f.is_historical = 1
                ORDER BY f.forum_id ASC";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('forums', [
                'FORUM_ID'      => $row['forum_id'],
                'FORUM_NAME'    => $row['forum_name'],
                'FORUM_DESC'    => $row['forum_desc'],
                'TOPICS'        => $row['forum_topics_approved'],
                'POSTS'         => $row['forum_posts_approved'],
                'U_EDIT'        => $this->u_action . '&amp;action=edit&amp;forum_id=' . $row['forum_id'],
                'U_DELETE'      => $this->u_action . '&amp;action=delete&amp;forum_id=' . $row['forum_id'],
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'U_ACTION'  => $this->u_action,
            'U_ADD'     => $this->u_action . '&amp;action=add',
        ]);
    }

    private function handle_forum_form($action, $forum_id)
    {
        $forum_data = [];
        if ($action === 'edit' && $forum_id)
        {
            $sql = "SELECT * FROM phpbb_forums WHERE forum_id = " . (int) $forum_id . " AND is_historical = 1";
            $result = $this->db->sql_query($sql);
            $forum_data = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);
            if (!$forum_data)
            {
                trigger_error('Forum not found.' . adm_back_link($this->u_action), E_USER_WARNING);
            }
        }

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_forums'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $forum_name = $this->request->variable('forum_name', '', true);
            $forum_desc = $this->request->variable('forum_desc', '', true);
            $parent_id = $this->request->variable('parent_id', 0);

            if (empty($forum_name))
            {
                trigger_error('Forum name is required.' . adm_back_link($this->u_action . '&amp;action=' . $action . '&amp;forum_id=' . $forum_id), E_USER_WARNING);
            }

            // Add [2004] prefix if not present
            if (strpos($forum_name, '[2004] ') !== 0)
            {
                $forum_name = '[2004] ' . $forum_name;
            }

            $data = [
                'forum_name'    => $forum_name,
                'forum_desc'    => $forum_desc,
                'parent_id'     => $parent_id,
                'forum_type'    => 1, // Postable forum
                'is_historical' => 1,
            ];

            if ($action === 'edit' && $forum_id)
            {
                $sql = "UPDATE phpbb_forums SET " . $this->db->sql_build_array('UPDATE', $data) . " WHERE forum_id = " . (int) $forum_id;
                $this->db->sql_query($sql);
            }
            else
            {
                // Generate next historical forum ID (1000+)
                $sql = "SELECT MAX(forum_id) as max_id FROM phpbb_forums WHERE forum_id >= 1000 AND forum_id < 10000";
                $result = $this->db->sql_query($sql);
                $max_id = (int) $this->db->sql_fetchfield('max_id');
                $this->db->sql_freeresult($result);
                $new_id = max($max_id + 1, 1001);

                $data['forum_id'] = $new_id;
                $sql = "INSERT INTO phpbb_forums " . $this->db->sql_build_array('INSERT', $data);
                $this->db->sql_query($sql);

                // Set ACL permissions
                $perms = [
                    [1, $new_id, 17], [2, $new_id, 15], [3, $new_id, 15],
                    [4, $new_id, 21], [5, $new_id, 14], [5, $new_id, 10],
                    [6, $new_id, 19], [7, $new_id, 24],
                ];
                foreach ($perms as $p)
                {
                    $this->db->sql_query("INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
                        VALUES ({$p[0]}, {$p[1]}, 0, {$p[2]}, 0)");
                }
            }

            // Rebuild tree
            $this->rebuild_forum_tree();

            trigger_error($this->user->lang('HISTORICAL_FORUM_SAVED') . adm_back_link($this->u_action));
        }

        // Get parent forum options
        $sql = "SELECT forum_id, forum_name FROM phpbb_forums WHERE is_historical = 1 ORDER BY forum_name";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            if ($forum_id && $row['forum_id'] == $forum_id) continue;
            $this->template->assign_block_vars('parent_options', [
                'FORUM_ID'  => $row['forum_id'],
                'FORUM_NAME' => $row['forum_name'],
                'SELECTED'  => ($forum_data && $row['forum_id'] == $forum_data['parent_id']),
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'S_EDIT'        => ($action === 'edit'),
            'FORUM_ID'      => $forum_data ? $forum_data['forum_id'] : 0,
            'FORUM_NAME'    => $forum_data ? $forum_data['forum_name'] : '[2004] ',
            'FORUM_DESC'    => $forum_data ? $forum_data['forum_desc'] : '',
            'PARENT_ID'     => $forum_data ? $forum_data['parent_id'] : 0,
            'U_ACTION'      => $this->u_action . '&amp;action=' . $action . '&amp;forum_id=' . ($forum_data ? $forum_data['forum_id'] : 0),
            'U_BACK'        => $this->u_action,
        ]);
    }

    private function handle_forum_delete($forum_id)
    {
        if (!$forum_id)
        {
            trigger_error('Invalid forum.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        if (confirm_box(true))
        {
            // Delete posts, topics, ACL, then forum
            $this->db->sql_query("DELETE FROM phpbb_posts WHERE forum_id = " . (int) $forum_id);
            $this->db->sql_query("DELETE FROM phpbb_topics WHERE forum_id = " . (int) $forum_id);
            $this->db->sql_query("DELETE FROM phpbb_acl_groups WHERE forum_id = " . (int) $forum_id);
            $this->db->sql_query("DELETE FROM phpbb_forums WHERE forum_id = " . (int) $forum_id . " AND is_historical = 1");
            $this->rebuild_forum_tree();

            trigger_error($this->user->lang('HISTORICAL_FORUM_DELETED') . adm_back_link($this->u_action));
        }
        else
        {
            confirm_box(false, $this->user->lang('HISTORICAL_CONFIRM_DELETE'), build_hidden_fields([
                'action'    => 'delete',
                'forum_id'  => $forum_id,
            ]));
        }
    }

    // ========================================================================
    // TOPICS MANAGEMENT
    // ========================================================================

    public function handle_topics()
    {
        $this->user->add_lang_ext('steamcms/historical_manager', 'info_acp_historical_manager');
        add_form_key('historical_manager_topics');

        $action = $this->request->variable('action', '');
        $topic_id = $this->request->variable('topic_id', 0);
        $filter_forum = $this->request->variable('forum_id', 0);

        switch ($action)
        {
            case 'add':
            case 'edit':
                $this->handle_topic_form($action, $topic_id);
                return;

            case 'delete':
                $this->handle_topic_delete($topic_id);
                return;

            case 'view_posts':
                $this->handle_topic_posts($topic_id);
                return;

            case 'add_post':
            case 'edit_post':
                $this->handle_post_form($action, $this->request->variable('post_id', 0), $topic_id);
                return;

            case 'delete_post':
                $this->handle_post_delete($this->request->variable('post_id', 0), $topic_id);
                return;
        }

        // List topics
        $start = $this->request->variable('start', 0);
        $search = $this->request->variable('search', '');

        $where = "WHERE t.is_historical = 1";
        if ($filter_forum)
        {
            $where .= " AND t.forum_id = " . (int) $filter_forum;
        }
        if ($search)
        {
            $where .= " AND t.topic_title LIKE '%" . $this->db->sql_escape($search) . "%'";
        }

        // Count
        $sql = "SELECT COUNT(*) as cnt FROM phpbb_topics t $where";
        $result = $this->db->sql_query($sql);
        $total = (int) $this->db->sql_fetchfield('cnt');
        $this->db->sql_freeresult($result);

        // Fetch page
        $sql = "SELECT t.topic_id, t.topic_title, t.forum_id, t.topic_poster,
                       t.topic_time, t.topic_posts_approved, t.topic_views,
                       f.forum_name, u.username
                FROM phpbb_topics t
                LEFT JOIN phpbb_forums f ON f.forum_id = t.forum_id
                LEFT JOIN phpbb_users u ON u.user_id = t.topic_poster
                $where
                ORDER BY t.topic_id ASC";
        $result = $this->db->sql_query_limit($sql, $this->items_per_page, $start);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('topics', [
                'TOPIC_ID'      => $row['topic_id'],
                'TOPIC_TITLE'   => $row['topic_title'],
                'FORUM_NAME'    => $row['forum_name'] ?: 'Unknown',
                'POSTER'        => $row['username'] ?: 'Unknown',
                'DATE'          => $this->user->format_date($row['topic_time']),
                'POSTS'         => $row['topic_posts_approved'],
                'VIEWS'         => $row['topic_views'],
                'U_EDIT'        => $this->u_action . '&amp;action=edit&amp;topic_id=' . $row['topic_id'],
                'U_DELETE'      => $this->u_action . '&amp;action=delete&amp;topic_id=' . $row['topic_id'],
                'U_VIEW_POSTS'  => $this->u_action . '&amp;action=view_posts&amp;topic_id=' . $row['topic_id'],
            ]);
        }
        $this->db->sql_freeresult($result);

        // Forum filter options
        $sql = "SELECT forum_id, forum_name FROM phpbb_forums WHERE is_historical = 1 ORDER BY forum_name";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('forum_filter', [
                'FORUM_ID'      => $row['forum_id'],
                'FORUM_NAME'    => $row['forum_name'],
                'SELECTED'      => ($row['forum_id'] == $filter_forum),
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'TOTAL_TOPICS'      => $total,
            'SEARCH'            => $search,
            'FILTER_FORUM'      => $filter_forum,
            'PAGINATION'        => $this->build_pagination($total, $start),
            'U_ACTION'          => $this->u_action,
            'U_ADD'             => $this->u_action . '&amp;action=add',
            'START'             => $start,
        ]);
    }

    private function handle_topic_form($action, $topic_id)
    {
        $topic_data = [];
        if ($action === 'edit' && $topic_id)
        {
            $sql = "SELECT * FROM phpbb_topics WHERE topic_id = " . (int) $topic_id . " AND is_historical = 1";
            $result = $this->db->sql_query($sql);
            $topic_data = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);
            if (!$topic_data)
            {
                trigger_error('Topic not found.' . adm_back_link($this->u_action), E_USER_WARNING);
            }
        }

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_topics'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $title = $this->request->variable('topic_title', '', true);
            $forum_id = $this->request->variable('forum_id', 0);
            $poster_id = $this->request->variable('poster_id', 0);
            $post_time = $this->request->variable('post_time', '');
            $post_text = $this->request->variable('post_text', '', true);

            if (empty($title) || !$forum_id)
            {
                trigger_error('Title and forum are required.' . adm_back_link($this->u_action . '&amp;action=' . $action), E_USER_WARNING);
            }

            // Add [2004] prefix if not present
            if (strpos($title, '[2004] ') !== 0)
            {
                $title = '[2004] ' . $title;
            }

            $time_ts = $post_time ? strtotime($post_time) : 1072936800; // Default: Jan 1 2004
            if (!$time_ts) $time_ts = 1072936800;

            if ($action === 'edit' && $topic_id)
            {
                $data = [
                    'topic_title'   => $title,
                    'forum_id'      => $forum_id,
                    'topic_poster'  => $poster_id ?: 100000,
                    'topic_time'    => $time_ts,
                ];
                $sql = "UPDATE phpbb_topics SET " . $this->db->sql_build_array('UPDATE', $data) . " WHERE topic_id = " . (int) $topic_id;
                $this->db->sql_query($sql);
            }
            else
            {
                // Generate next historical topic ID (100000+)
                $sql = "SELECT MAX(topic_id) as max_id FROM phpbb_topics WHERE topic_id >= 100000 AND topic_id < 10000000";
                $result = $this->db->sql_query($sql);
                $max_id = (int) $this->db->sql_fetchfield('max_id');
                $this->db->sql_freeresult($result);
                $new_topic_id = max($max_id + 1, 100001);

                $topic_data_insert = [
                    'topic_id'              => $new_topic_id,
                    'topic_title'           => $title,
                    'forum_id'              => $forum_id,
                    'topic_poster'          => $poster_id ?: 100000,
                    'topic_time'            => $time_ts,
                    'topic_visibility'      => 1,
                    'topic_posts_approved'  => 0,
                    'is_historical'         => 1,
                ];
                $sql = "INSERT INTO phpbb_topics " . $this->db->sql_build_array('INSERT', $topic_data_insert);
                $this->db->sql_query($sql);

                // If post text provided, create the first post
                if (!empty($post_text))
                {
                    $this->create_historical_post($new_topic_id, $forum_id, $poster_id ?: 100000, $title, $post_text, $time_ts);
                }
            }

            // Recalculate for this forum
            $this->recalculate_counters();

            trigger_error($this->user->lang('HISTORICAL_TOPIC_SAVED') . adm_back_link($this->u_action));
        }

        // Forum options
        $sql = "SELECT forum_id, forum_name FROM phpbb_forums WHERE is_historical = 1 ORDER BY forum_name";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('forum_options', [
                'FORUM_ID'      => $row['forum_id'],
                'FORUM_NAME'    => $row['forum_name'],
                'SELECTED'      => ($topic_data && $row['forum_id'] == $topic_data['forum_id']),
            ]);
        }
        $this->db->sql_freeresult($result);

        // User options
        $sql = "SELECT user_id, username FROM phpbb_users WHERE is_historical = 1 ORDER BY username LIMIT 200";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('user_options', [
                'USER_ID'   => $row['user_id'],
                'USERNAME'  => $row['username'],
                'SELECTED'  => ($topic_data && $row['user_id'] == $topic_data['topic_poster']),
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'S_EDIT'        => ($action === 'edit'),
            'TOPIC_ID'      => $topic_data ? $topic_data['topic_id'] : 0,
            'TOPIC_TITLE'   => $topic_data ? $topic_data['topic_title'] : '[2004] ',
            'POST_TIME'     => $topic_data ? date('Y-m-d', $topic_data['topic_time']) : '2004-01-01',
            'U_ACTION'      => $this->u_action . '&amp;action=' . $action . '&amp;topic_id=' . ($topic_data ? $topic_data['topic_id'] : 0),
            'U_BACK'        => $this->u_action,
        ]);
    }

    private function handle_topic_delete($topic_id)
    {
        if (!$topic_id)
        {
            trigger_error('Invalid topic.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        if (confirm_box(true))
        {
            $this->db->sql_query("DELETE FROM phpbb_posts WHERE topic_id = " . (int) $topic_id);
            $this->db->sql_query("DELETE FROM phpbb_topics WHERE topic_id = " . (int) $topic_id . " AND is_historical = 1");
            $this->recalculate_counters();

            trigger_error($this->user->lang('HISTORICAL_TOPIC_DELETED') . adm_back_link($this->u_action));
        }
        else
        {
            confirm_box(false, $this->user->lang('HISTORICAL_CONFIRM_DELETE'), build_hidden_fields([
                'action'    => 'delete',
                'topic_id'  => $topic_id,
            ]));
        }
    }

    // ========================================================================
    // POSTS (REPLIES) MANAGEMENT within a topic
    // ========================================================================

    private function handle_topic_posts($topic_id)
    {
        if (!$topic_id)
        {
            trigger_error('Invalid topic.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        // Get topic info
        $sql = "SELECT topic_title, forum_id FROM phpbb_topics WHERE topic_id = " . (int) $topic_id;
        $result = $this->db->sql_query($sql);
        $topic = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if (!$topic)
        {
            trigger_error('Topic not found.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        $start = $this->request->variable('start', 0);

        // Count posts
        $sql = "SELECT COUNT(*) as cnt FROM phpbb_posts WHERE topic_id = " . (int) $topic_id;
        $result = $this->db->sql_query($sql);
        $total = (int) $this->db->sql_fetchfield('cnt');
        $this->db->sql_freeresult($result);

        // Fetch posts
        $sql = "SELECT p.post_id, p.post_subject, p.post_text, p.post_time,
                       p.poster_id, p.is_historical, u.username
                FROM phpbb_posts p
                LEFT JOIN phpbb_users u ON u.user_id = p.poster_id
                WHERE p.topic_id = " . (int) $topic_id . "
                ORDER BY p.post_time ASC";
        $result = $this->db->sql_query_limit($sql, $this->items_per_page, $start);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('posts', [
                'POST_ID'       => $row['post_id'],
                'SUBJECT'       => $row['post_subject'],
                'TEXT_PREVIEW'  => utf8_substr(strip_tags($row['post_text']), 0, 150),
                'POSTER'        => $row['username'] ?: 'Unknown',
                'DATE'          => $this->user->format_date($row['post_time']),
                'IS_HISTORICAL' => $row['is_historical'],
                'U_EDIT'        => $this->u_action . '&amp;action=edit_post&amp;post_id=' . $row['post_id'] . '&amp;topic_id=' . $topic_id,
                'U_DELETE'      => $this->u_action . '&amp;action=delete_post&amp;post_id=' . $row['post_id'] . '&amp;topic_id=' . $topic_id,
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'TOPIC_ID'      => $topic_id,
            'TOPIC_TITLE'   => $topic['topic_title'],
            'TOTAL_POSTS'   => $total,
            'PAGINATION'    => $this->build_pagination($total, $start),
            'U_ACTION'      => $this->u_action,
            'U_ADD_POST'    => $this->u_action . '&amp;action=add_post&amp;topic_id=' . $topic_id,
            'U_BACK'        => $this->u_action,
            'START'         => $start,
        ]);
    }

    private function handle_post_form($action, $post_id, $topic_id)
    {
        $post_data = [];
        $real_action = ($action === 'edit_post') ? 'edit' : 'add';

        if ($real_action === 'edit' && $post_id)
        {
            $sql = "SELECT * FROM phpbb_posts WHERE post_id = " . (int) $post_id;
            $result = $this->db->sql_query($sql);
            $post_data = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);
            if (!$post_data)
            {
                trigger_error('Post not found.' . adm_back_link($this->u_action), E_USER_WARNING);
            }
            $topic_id = $post_data['topic_id'];
        }

        if (!$topic_id)
        {
            trigger_error('Topic ID required.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        // Get topic info
        $sql = "SELECT topic_title, forum_id FROM phpbb_topics WHERE topic_id = " . (int) $topic_id;
        $result = $this->db->sql_query($sql);
        $topic = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_topics'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $subject = $this->request->variable('post_subject', '', true);
            $text = $this->request->variable('post_text', '', true);
            $poster_id = $this->request->variable('poster_id', 0);
            $post_time = $this->request->variable('post_time', '');

            if (empty($text))
            {
                trigger_error('Post content is required.' . adm_back_link($this->u_action . '&amp;action=' . $action . '&amp;topic_id=' . $topic_id), E_USER_WARNING);
            }

            $time_ts = $post_time ? strtotime($post_time) : 1072936800;
            if (!$time_ts) $time_ts = 1072936800;

            if ($real_action === 'edit' && $post_id)
            {
                $data = [
                    'post_subject'  => $subject ?: 'Re: ' . $topic['topic_title'],
                    'post_text'     => $text,
                    'poster_id'     => $poster_id ?: ($post_data['poster_id'] ?: 100000),
                    'post_time'     => $time_ts,
                ];
                $sql = "UPDATE phpbb_posts SET " . $this->db->sql_build_array('UPDATE', $data) . " WHERE post_id = " . (int) $post_id;
                $this->db->sql_query($sql);
            }
            else
            {
                $this->create_historical_post($topic_id, $topic['forum_id'], $poster_id ?: 100000, $subject ?: 'Re: ' . $topic['topic_title'], $text, $time_ts);
            }

            $this->recalculate_counters();

            trigger_error($this->user->lang('HISTORICAL_POST_SAVED') . adm_back_link($this->u_action . '&amp;action=view_posts&amp;topic_id=' . $topic_id));
        }

        // User options
        $sql = "SELECT user_id, username FROM phpbb_users WHERE is_historical = 1 ORDER BY username LIMIT 200";
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('user_options', [
                'USER_ID'   => $row['user_id'],
                'USERNAME'  => $row['username'],
                'SELECTED'  => ($post_data && $row['user_id'] == $post_data['poster_id']),
            ]);
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars([
            'S_EDIT'        => ($real_action === 'edit'),
            'TOPIC_ID'      => $topic_id,
            'TOPIC_TITLE'   => $topic['topic_title'],
            'POST_ID'       => $post_data ? $post_data['post_id'] : 0,
            'POST_SUBJECT'  => $post_data ? $post_data['post_subject'] : 'Re: ' . $topic['topic_title'],
            'POST_TEXT'     => $post_data ? $post_data['post_text'] : '',
            'POST_TIME'     => $post_data ? date('Y-m-d', $post_data['post_time']) : '2004-01-01',
            'U_ACTION'      => $this->u_action . '&amp;action=' . $action . '&amp;post_id=' . ($post_data ? $post_data['post_id'] : 0) . '&amp;topic_id=' . $topic_id,
            'U_BACK'        => $this->u_action . '&amp;action=view_posts&amp;topic_id=' . $topic_id,
        ]);
    }

    private function handle_post_delete($post_id, $topic_id)
    {
        if (!$post_id)
        {
            trigger_error('Invalid post.' . adm_back_link($this->u_action), E_USER_WARNING);
        }

        if (confirm_box(true))
        {
            $this->db->sql_query("DELETE FROM phpbb_posts WHERE post_id = " . (int) $post_id);
            $this->recalculate_counters();

            trigger_error($this->user->lang('HISTORICAL_POST_DELETED') . adm_back_link($this->u_action . '&amp;action=view_posts&amp;topic_id=' . $topic_id));
        }
        else
        {
            confirm_box(false, $this->user->lang('HISTORICAL_CONFIRM_DELETE'), build_hidden_fields([
                'action'    => 'delete_post',
                'post_id'   => $post_id,
                'topic_id'  => $topic_id,
            ]));
        }
    }

    private function create_historical_post($topic_id, $forum_id, $poster_id, $subject, $text, $time_ts)
    {
        // Get poster username
        $sql = "SELECT username FROM phpbb_users WHERE user_id = " . (int) $poster_id;
        $result = $this->db->sql_query($sql);
        $poster_name = $this->db->sql_fetchfield('username') ?: '[2004] Unknown';
        $this->db->sql_freeresult($result);

        // Generate next historical post ID (1000000+)
        $sql = "SELECT MAX(post_id) as max_id FROM phpbb_posts WHERE post_id >= 1000000";
        $result = $this->db->sql_query($sql);
        $max_id = (int) $this->db->sql_fetchfield('max_id');
        $this->db->sql_freeresult($result);
        $new_post_id = max($max_id + 1, 1000001);

        $data = [
            'post_id'           => $new_post_id,
            'topic_id'          => (int) $topic_id,
            'forum_id'          => (int) $forum_id,
            'poster_id'         => (int) $poster_id,
            'post_username'     => $poster_name,
            'post_subject'      => $subject,
            'post_text'         => $text,
            'post_time'         => (int) $time_ts,
            'post_visibility'   => 1,
            'is_historical'     => 1,
            'bbcode_uid'        => '',
            'bbcode_bitfield'   => '',
            'post_checksum'     => md5($text),
        ];

        $sql = "INSERT INTO phpbb_posts " . $this->db->sql_build_array('INSERT', $data);
        $this->db->sql_query($sql);

        return $new_post_id;
    }

    // ========================================================================
    // IMPORT / REIMPORT
    // ========================================================================

    public function handle_import()
    {
        $this->user->add_lang_ext('steamcms/historical_manager', 'info_acp_historical_manager');
        add_form_key('historical_manager_import');

        $action = $this->request->variable('action', '');

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key('historical_manager_import'))
            {
                trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            $reimport = $this->request->variable('reimport', 0);
            $selected_file = $this->request->variable('selected_file', '');

            // Check for uploaded file
            $upload = $this->request->file('sql_file');
            $sql_content = '';

            if ($upload && $upload['error'] === UPLOAD_ERR_OK && $upload['size'] > 0)
            {
                $sql_content = file_get_contents($upload['tmp_name']);
            }
            elseif ($selected_file)
            {
                $scripts_dir = dirname($this->root_path) . '/scripts';
                $file_path = $scripts_dir . '/' . basename($selected_file);
                if (file_exists($file_path) && pathinfo($file_path, PATHINFO_EXTENSION) === 'sql')
                {
                    $sql_content = file_get_contents($file_path);
                }
            }

            if (empty($sql_content))
            {
                trigger_error($this->user->lang('HISTORICAL_IMPORT_NO_FILE') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            // Purge if reimporting
            if ($reimport)
            {
                $this->purge_all_historical();
            }

            // Execute SQL
            $ok = 0;
            $err = 0;
            $statements = $this->split_sql($sql_content);

            // Disable foreign key checks
            $this->db->sql_query("SET FOREIGN_KEY_CHECKS = 0");

            foreach ($statements as $stmt)
            {
                $stmt = trim($stmt);
                if ($stmt === '' || $stmt[0] === '#' || substr($stmt, 0, 2) === '--')
                {
                    continue;
                }

                try
                {
                    $this->db->sql_query($stmt);
                    $ok++;
                }
                catch (\Exception $e)
                {
                    $err++;
                    // Log but continue
                    error_log("Historical import error: " . $e->getMessage() . " | " . substr($stmt, 0, 200));
                }
            }

            $this->db->sql_query("SET FOREIGN_KEY_CHECKS = 1");

            // Post-import fixes
            $this->recalculate_counters();
            $this->rebuild_forum_tree();
            $this->fix_permissions();

            $msg = sprintf($this->user->lang('HISTORICAL_IMPORT_COMPLETE'), $ok, $err);
            trigger_error($msg . adm_back_link($this->u_action));
        }

        // List available SQL files
        $scripts_dir = dirname($this->root_path) . '/scripts';
        $available_files = [];
        if (is_dir($scripts_dir))
        {
            $files = glob($scripts_dir . '/historical_forum_data*.sql');
            foreach ($files as $file)
            {
                $fname = basename($file);
                $size = filesize($file);
                $this->template->assign_block_vars('available_files', [
                    'FILENAME'  => $fname,
                    'SIZE'      => $this->format_size($size),
                    'LINES'     => number_format(count(file($file))),
                ]);
            }
        }

        $this->template->assign_vars([
            'U_ACTION'  => $this->u_action,
        ]);
    }

    private function split_sql($sql)
    {
        $statements = [];
        $current = '';
        $in_string = false;
        $string_char = '';
        $len = strlen($sql);

        for ($i = 0; $i < $len; $i++)
        {
            $char = $sql[$i];

            if ($in_string)
            {
                $current .= $char;
                if ($char === $string_char && ($i === 0 || $sql[$i - 1] !== '\\'))
                {
                    $in_string = false;
                }
                continue;
            }

            if ($char === '\'' || $char === '"')
            {
                $in_string = true;
                $string_char = $char;
                $current .= $char;
                continue;
            }

            if ($char === ';')
            {
                $trimmed = trim($current);
                if ($trimmed !== '')
                {
                    $statements[] = $trimmed;
                }
                $current = '';
                continue;
            }

            // Skip line comments
            if ($char === '-' && $i + 1 < $len && $sql[$i + 1] === '-')
            {
                $eol = strpos($sql, "\n", $i);
                if ($eol === false)
                {
                    break;
                }
                $i = $eol;
                continue;
            }

            if ($char === '#')
            {
                $eol = strpos($sql, "\n", $i);
                if ($eol === false)
                {
                    break;
                }
                $i = $eol;
                continue;
            }

            $current .= $char;
        }

        $trimmed = trim($current);
        if ($trimmed !== '')
        {
            $statements[] = $trimmed;
        }

        return $statements;
    }

    private function format_size($bytes)
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    // ========================================================================
    // PAGINATION HELPER
    // ========================================================================

    private function build_pagination($total, $start)
    {
        $pages = ceil($total / $this->items_per_page);
        $current = floor($start / $this->items_per_page) + 1;

        if ($pages <= 1) return '';

        $html = '<div class="pagination">';

        if ($current > 1)
        {
            $html .= '<a href="' . $this->u_action . '&amp;start=' . (($current - 2) * $this->items_per_page) . '">&laquo; Prev</a> ';
        }

        // Show first 5 pages
        $show_start = max(1, $current - 2);
        $show_end = min($pages, $current + 2);

        if ($show_start > 1)
        {
            $html .= '<a href="' . $this->u_action . '&amp;start=0">1</a> ';
            if ($show_start > 2) $html .= '... ';
        }

        for ($p = $show_start; $p <= $show_end; $p++)
        {
            if ($p === $current)
            {
                $html .= '<strong>' . $p . '</strong> ';
            }
            else
            {
                $html .= '<a href="' . $this->u_action . '&amp;start=' . (($p - 1) * $this->items_per_page) . '">' . $p . '</a> ';
            }
        }

        if ($show_end < $pages)
        {
            if ($show_end < $pages - 1) $html .= '... ';
            $html .= '<a href="' . $this->u_action . '&amp;start=' . (($pages - 1) * $this->items_per_page) . '">' . $pages . '</a> ';
        }

        if ($current < $pages)
        {
            $html .= '<a href="' . $this->u_action . '&amp;start=' . ($current * $this->items_per_page) . '">Next &raquo;</a>';
        }

        $html .= '</div>';

        return $html;
    }
}
