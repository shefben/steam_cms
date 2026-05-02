-- Fix Historical Forum Categories and Hierarchy
-- Matches the original vBulletin forum structure from forum_home.html
-- Original forum IDs + 1000 offset for phpBB

SET FOREIGN_KEY_CHECKS = 0;

-- ========================================
-- Step 1: Remove orphan forums that don't match the original structure
-- ========================================
-- IDs 1001, 1002, 1008, 1011, 1018 were catch-all forums for threads
-- that couldn't be matched to a real forum. Reassign their topics to General (1014).
UPDATE phpbb_topics SET forum_id = 1014 WHERE forum_id IN (1001, 1002, 1008, 1011, 1018) AND is_historical = 1;
UPDATE phpbb_posts SET forum_id = 1014 WHERE forum_id IN (1001, 1002, 1008, 1011, 1018) AND is_historical = 1;
DELETE FROM phpbb_forums WHERE forum_id IN (1001, 1002, 1008, 1011, 1018);

-- Also reassign 1026 (Server Discussions) topics to Windows Dedicated Server (1016)
UPDATE phpbb_topics SET forum_id = 1016 WHERE forum_id = 1026 AND is_historical = 1;
UPDATE phpbb_posts SET forum_id = 1016 WHERE forum_id = 1026 AND is_historical = 1;
DELETE FROM phpbb_forums WHERE forum_id = 1026;

-- Also reassign 1012 (Support / Help) to Community Help and Tips (1017)
UPDATE phpbb_topics SET forum_id = 1017 WHERE forum_id = 1012 AND is_historical = 1;
UPDATE phpbb_posts SET forum_id = 1017 WHERE forum_id = 1012 AND is_historical = 1;
DELETE FROM phpbb_forums WHERE forum_id = 1012;

-- ========================================
-- Step 2: Create/update the 4 categories
-- ========================================

-- Category: Steam Discussions (vBulletin forumid=13)
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1013, '[2004] Steam Discussions', '', 0, 0, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Steam Discussions', forum_desc = '', parent_id = 0, forum_type = 0;

-- Category: Source Game Discussions (vBulletin forumid=40)
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1040, '[2004] Source Game Discussions', '', 0, 0, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Source Game Discussions', forum_desc = '', parent_id = 0, forum_type = 0;

-- Category: Valve Back Catalog Discussions (vBulletin forumid=5)
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1005, '[2004] Valve Back Catalog Discussions', '', 0, 0, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Valve Back Catalog Discussions', forum_desc = '', parent_id = 0, forum_type = 0;

-- Category: Cyber Cafe Discussions (vBulletin forumid=42)
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1042, '[2004] Cyber Cafe Discussions', '', 0, 0, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Cyber Cafe Discussions', forum_desc = '', parent_id = 0, forum_type = 0;

-- ========================================
-- Step 3: Create/update forums under Steam Discussions (parent=1013)
-- ========================================

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1014, '[2004] General', 'General discussion about Steam', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] General', forum_desc = 'General discussion about Steam', parent_id = 1013, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1035, '[2004] VAC', 'Valve''s Anti Cheat (VAC) system', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] VAC', forum_desc = 'Valve''s Anti Cheat (VAC) system', parent_id = 1013, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1017, '[2004] Community Help and Tips', 'Users helping other users with Steam issues', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Community Help and Tips', forum_desc = 'Users helping other users with Steam issues', parent_id = 1013, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1015, '[2004] Suggestions / Ideas', 'Post all your suggestions about Steam and ideas for future releases', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Suggestions / Ideas', forum_desc = 'Post all your suggestions about Steam and ideas for future releases', parent_id = 1013, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1039, '[2004] Hardware', 'Discuss computer hardware related to Steam games', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Hardware', forum_desc = 'Discuss computer hardware related to Steam games', parent_id = 1013, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1034, '[2004] Off Topic', 'Chat about off topic stuff! Keep it clean, keep it nice!', 1013, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Off Topic', forum_desc = 'Chat about off topic stuff! Keep it clean, keep it nice!', parent_id = 1013, forum_type = 1;

-- ========================================
-- Step 4: Create/update forums under Source Game Discussions (parent=1040)
-- ========================================

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1043, '[2004] Half-Life 2', 'General discussions about Half-Life 2', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Half-Life 2', forum_desc = 'General discussions about Half-Life 2', parent_id = 1040, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1046, '[2004] Half-Life 2: Deathmatch', 'Discussions about Half-Life 2: Deathmatch', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Half-Life 2: Deathmatch', forum_desc = 'Discussions about Half-Life 2: Deathmatch', parent_id = 1040, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1037, '[2004] Counter-Strike: Source', 'General discussions about Counter-Strike: Source', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Counter-Strike: Source', forum_desc = 'General discussions about Counter-Strike: Source', parent_id = 1040, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1044, '[2004] Source DS (Windows)', 'Source Dedicated Server running on Windows', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Source DS (Windows)', forum_desc = 'Source Dedicated Server running on Windows', parent_id = 1040, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1045, '[2004] Source DS (Linux)', 'Source Dedicated Server running on Linux', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Source DS (Linux)', forum_desc = 'Source Dedicated Server running on Linux', parent_id = 1040, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1041, '[2004] Source SDK', 'General discussion about the Source SDK', 1040, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Source SDK', forum_desc = 'General discussion about the Source SDK', parent_id = 1040, forum_type = 1;

-- ========================================
-- Step 5: Create/update forums under Valve Back Catalog Discussions (parent=1005)
-- ========================================

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1033, '[2004] CS: Condition Zero', 'Discussions about Counter-Strike: Condition Zero', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] CS: Condition Zero', forum_desc = 'Discussions about Counter-Strike: Condition Zero', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1007, '[2004] Counter-Strike', 'General discussions about Counter-Strike', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Counter-Strike', forum_desc = 'General discussions about Counter-Strike', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1020, '[2004] Half-Life', 'General discussions about Half-Life', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Half-Life', forum_desc = 'General discussions about Half-Life', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1021, '[2004] Day of Defeat', 'General discussions about Day of Defeat', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Day of Defeat', forum_desc = 'General discussions about Day of Defeat', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1022, '[2004] Team Fortress Classic', 'General discussions about Team Fortress Classic', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Team Fortress Classic', forum_desc = 'General discussions about Team Fortress Classic', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1023, '[2004] Deathmatch Classic', 'General discussions about Deathmatch Classic', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Deathmatch Classic', forum_desc = 'General discussions about Deathmatch Classic', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1024, '[2004] Opposing Force', 'General discussions about Opposing Force', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Opposing Force', forum_desc = 'General discussions about Opposing Force', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1025, '[2004] Ricochet', 'General discussions about Ricochet', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Ricochet', forum_desc = 'General discussions about Ricochet', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1016, '[2004] Windows Dedicated Server', 'Server administrators discuss issues relating to Steam and dedicated servers', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Windows Dedicated Server', forum_desc = 'Server administrators discuss issues relating to Steam and dedicated servers', parent_id = 1005, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1019, '[2004] Linux Dedicated Server', 'Server administrators discuss issues relating to using the Linux Steam client', 1005, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Linux Dedicated Server', forum_desc = 'Server administrators discuss issues relating to using the Linux Steam client', parent_id = 1005, forum_type = 1;

-- ========================================
-- Step 6: Create/update forums under Cyber Cafe Discussions (parent=1042)
-- ========================================

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1031, '[2004] Cyber Cafe Program - Discussion', 'Discussions about the Steam Cyber Cafe Program', 1042, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Cyber Cafe Program - Discussion', forum_desc = 'Discussions about the Steam Cyber Cafe Program', parent_id = 1042, forum_type = 1;

INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, parent_id, forum_type, is_historical)
VALUES (1032, '[2004] Cyber Cafe Program - Support', 'Support for the Steam Cyber Cafe Program', 1042, 1, 1)
ON DUPLICATE KEY UPDATE forum_name = '[2004] Cyber Cafe Program - Support', forum_desc = 'Support for the Steam Cyber Cafe Program', parent_id = 1042, forum_type = 1;

-- ========================================
-- Step 7: Rebuild nested set tree (left_id / right_id)
-- ========================================
-- This must be done by PHP code in install.php since SQL can't do recursive tree traversal easily.
-- For the live database, we'll compute it inline here.

-- Order: categories first (parent=0), then children by forum_id
-- phpBB uses modified preorder tree traversal

-- Default phpBB forums first
-- 1. Your first category (id=1, parent=0) -> left=1
--    2. Your first forum (id=2, parent=1) -> left=2, right=3
--    right=4

-- Then historical categories in order: 1005, 1013, 1040, 1042
-- We need to compute this properly. Let's set it manually.

-- Root level order: 1 (default cat), 1013 (Steam), 1040 (Source), 1005 (Back Catalog), 1042 (Cyber Cafe)

-- Default category
UPDATE phpbb_forums SET left_id = 1, right_id = 4 WHERE forum_id = 1;
UPDATE phpbb_forums SET left_id = 2, right_id = 3 WHERE forum_id = 2;

-- Steam Discussions (1013) - 6 child forums
UPDATE phpbb_forums SET left_id = 5, right_id = 18 WHERE forum_id = 1013;
UPDATE phpbb_forums SET left_id = 6, right_id = 7 WHERE forum_id = 1014;   -- General
UPDATE phpbb_forums SET left_id = 8, right_id = 9 WHERE forum_id = 1035;   -- VAC
UPDATE phpbb_forums SET left_id = 10, right_id = 11 WHERE forum_id = 1017; -- Community Help
UPDATE phpbb_forums SET left_id = 12, right_id = 13 WHERE forum_id = 1015; -- Suggestions
UPDATE phpbb_forums SET left_id = 14, right_id = 15 WHERE forum_id = 1039; -- Hardware
UPDATE phpbb_forums SET left_id = 16, right_id = 17 WHERE forum_id = 1034; -- Off Topic

-- Source Game Discussions (1040) - 6 child forums
UPDATE phpbb_forums SET left_id = 19, right_id = 32 WHERE forum_id = 1040;
UPDATE phpbb_forums SET left_id = 20, right_id = 21 WHERE forum_id = 1043; -- HL2
UPDATE phpbb_forums SET left_id = 22, right_id = 23 WHERE forum_id = 1046; -- HL2:DM
UPDATE phpbb_forums SET left_id = 24, right_id = 25 WHERE forum_id = 1037; -- CS:S
UPDATE phpbb_forums SET left_id = 26, right_id = 27 WHERE forum_id = 1044; -- Source DS Win
UPDATE phpbb_forums SET left_id = 28, right_id = 29 WHERE forum_id = 1045; -- Source DS Linux
UPDATE phpbb_forums SET left_id = 30, right_id = 31 WHERE forum_id = 1041; -- Source SDK

-- Valve Back Catalog Discussions (1005) - 10 child forums
UPDATE phpbb_forums SET left_id = 33, right_id = 54 WHERE forum_id = 1005;
UPDATE phpbb_forums SET left_id = 34, right_id = 35 WHERE forum_id = 1033; -- CS:CZ
UPDATE phpbb_forums SET left_id = 36, right_id = 37 WHERE forum_id = 1007; -- CS
UPDATE phpbb_forums SET left_id = 38, right_id = 39 WHERE forum_id = 1020; -- HL
UPDATE phpbb_forums SET left_id = 40, right_id = 41 WHERE forum_id = 1021; -- DoD
UPDATE phpbb_forums SET left_id = 42, right_id = 43 WHERE forum_id = 1022; -- TFC
UPDATE phpbb_forums SET left_id = 44, right_id = 45 WHERE forum_id = 1023; -- DMC
UPDATE phpbb_forums SET left_id = 46, right_id = 47 WHERE forum_id = 1024; -- OpFor
UPDATE phpbb_forums SET left_id = 48, right_id = 49 WHERE forum_id = 1025; -- Ricochet
UPDATE phpbb_forums SET left_id = 50, right_id = 51 WHERE forum_id = 1016; -- Win DS
UPDATE phpbb_forums SET left_id = 52, right_id = 53 WHERE forum_id = 1019; -- Linux DS

-- Cyber Cafe Discussions (1042) - 2 child forums
UPDATE phpbb_forums SET left_id = 55, right_id = 60 WHERE forum_id = 1042;
UPDATE phpbb_forums SET left_id = 56, right_id = 57 WHERE forum_id = 1031; -- CC Discussion
UPDATE phpbb_forums SET left_id = 58, right_id = 59 WHERE forum_id = 1032; -- CC Support

-- ========================================
-- Step 8: Update forum counters
-- ========================================

UPDATE phpbb_forums f SET
    forum_topics_approved = (SELECT COUNT(*) FROM phpbb_topics t WHERE t.forum_id = f.forum_id AND t.topic_visibility = 1),
    forum_posts_approved = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
WHERE f.is_historical = 1;

-- Update forum last post info
UPDATE phpbb_forums f SET
    forum_last_post_id = (SELECT MAX(post_id) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1),
    forum_last_post_time = (SELECT MAX(post_time) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
WHERE f.is_historical = 1;

-- Update forum last poster name
UPDATE phpbb_forums f
    INNER JOIN phpbb_posts p ON p.post_id = f.forum_last_post_id
    INNER JOIN phpbb_users u ON u.user_id = p.poster_id
    SET f.forum_last_poster_id = p.poster_id,
        f.forum_last_poster_name = u.username,
        f.forum_last_poster_colour = ''
WHERE f.is_historical = 1;

-- ========================================
-- Step 9: Set ACL permissions for new forums
-- ========================================

-- Guests: readonly (role 17), Registered: standard (role 15), COPPA: standard (role 15),
-- Global Mods: polls (role 21), Admins: full (role 14) + mod full (role 10),
-- Bots: bot access (role 19), New Members: on queue (role 24)

INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 1, f.forum_id, 0, 17, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 2, f.forum_id, 0, 15, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 3, f.forum_id, 0, 15, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 4, f.forum_id, 0, 21, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 5, f.forum_id, 0, 14, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 5, f.forum_id, 0, 10, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 6, f.forum_id, 0, 19, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;
INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
SELECT 7, f.forum_id, 0, 24, 0 FROM phpbb_forums f WHERE f.is_historical = 1 AND f.forum_type = 1;

SET FOREIGN_KEY_CHECKS = 1;
