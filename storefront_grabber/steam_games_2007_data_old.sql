-- Steam Games 2007-2008 Data
-- Extracted from Wayback Machine archives
-- Generated: 08/25/2025 19:11:29

SOURCE steam_games_2007_schema.sql;

-- Data extraction begins

-- Counter-Strike (App ID: 10)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10, 'Counter-Strike', 88, 'http://www.metacritic.com/games/platforms/pc/halflifecounterstrike', 10, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 1');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 1');
INSERT IGNORE INTO publishers (name) VALUES ('2000 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 1'), '2000-11-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(10, (SELECT id FROM languages WHERE name = 'English')),
(10, (SELECT id FROM languages WHERE name = 'French')),
(10, (SELECT id FROM languages WHERE name = 'German')),
(10, (SELECT id FROM languages WHERE name = 'Italian')),
(10, (SELECT id FROM languages WHERE name = 'Korean')),
(10, (SELECT id FROM languages WHERE name = 'Spanish')),
(10, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(10, (SELECT id FROM languages WHERE name = 'Traditional Chinese Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(10, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10, 'website', 'http://www.counter-strike.net/'),
(10, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=7');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10, '0000002543.jpg', 0),
(10, '0000002542.jpg', 1),
(10, '0000002541.jpg', 2),
(10, '0000002540.jpg', 3),
(10, '0000002539.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10, 'Valve Anti-Cheat', 'enabled');

-- Team Fortress Classic (App ID: 20)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (20, 'Team Fortress Classic', 20, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : April 1');
INSERT IGNORE INTO developers (name) VALUES ('1999 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : April 1');
INSERT IGNORE INTO publishers (name) VALUES ('1999 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (20, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : April 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : April 1'), '1999-04-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(20, (SELECT id FROM languages WHERE name = 'English')),
(20, (SELECT id FROM languages WHERE name = 'French')),
(20, (SELECT id FROM languages WHERE name = 'German')),
(20, (SELECT id FROM languages WHERE name = 'Italian')),
(20, (SELECT id FROM languages WHERE name = 'Spanish Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(20, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(20, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(20, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=22');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(20, '0000000168.jpg', 0),
(20, '0000000167.jpg', 1),
(20, '0000000166.jpg', 2),
(20, '0000000165.jpg', 3),
(20, '0000000164.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (20, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (20, 'Valve Anti-Cheat', 'enabled');

-- Day of Defeat (App ID: 30)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (30, 'Day of Defeat', 79, 'http://www.metacritic.com/games/platforms/pc/dayofdefeat', 30, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (30, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(30, 'website', 'http://www.dayofdefeat.com/'),
(30, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=21');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(30, '0000000173.jpg', 0),
(30, '0000000172.jpg', 1),
(30, '0000000171.jpg', 2),
(30, '0000000170.jpg', 3),
(30, '0000000169.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (30, 'Multijoueur', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (30, 'Valve Anti-triche activé', 'enabled');

-- Deathmatch Classic (App ID: 40)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (40, 'Deathmatch Classic', 40, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : June 1');
INSERT IGNORE INTO developers (name) VALUES ('2001 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : June 1');
INSERT IGNORE INTO publishers (name) VALUES ('2001 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (40, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : June 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : June 1'), '2001-06-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(40, (SELECT id FROM languages WHERE name = 'English')),
(40, (SELECT id FROM languages WHERE name = 'French')),
(40, (SELECT id FROM languages WHERE name = 'German')),
(40, (SELECT id FROM languages WHERE name = 'Italian')),
(40, (SELECT id FROM languages WHERE name = 'Spanish Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(40, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(40, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(40, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=23');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(40, '0000000145.jpg', 0),
(40, '0000000144.jpg', 1),
(40, '0000000143.jpg', 2),
(40, '0000000142.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (40, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (40, 'Valve Anti-Cheat', 'enabled');

-- Opposing Force (App ID: 50)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (50, 'Opposing Force', 50, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Gearbox Software Publisher : Valve Release Date : November 1');
INSERT IGNORE INTO developers (name) VALUES ('1999 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Korean Single-player Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 1');
INSERT IGNORE INTO publishers (name) VALUES ('1999 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Korean Single-player Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (50, (SELECT id FROM developers WHERE name = 'Gearbox Software Publisher : Valve Release Date : November 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 1'), '1999-11-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(50, (SELECT id FROM languages WHERE name = 'English')),
(50, (SELECT id FROM languages WHERE name = 'French')),
(50, (SELECT id FROM languages WHERE name = 'German')),
(50, (SELECT id FROM languages WHERE name = 'Korean Single-player Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(50, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(50, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(50, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=24');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(50, '0000000159.jpg', 0),
(50, '0000000158.jpg', 1),
(50, '0000000157.jpg', 2),
(50, '0000000156.jpg', 3),
(50, '0000000155.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (50, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (50, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (50, 'Valve Anti-Cheat', 'enabled');

-- Ricochet (App ID: 60)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (60, 'Ricochet', 60, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 1');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 1');
INSERT IGNORE INTO publishers (name) VALUES ('2000 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (60, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 1'), '2000-11-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(60, (SELECT id FROM languages WHERE name = 'English')),
(60, (SELECT id FROM languages WHERE name = 'French')),
(60, (SELECT id FROM languages WHERE name = 'German')),
(60, (SELECT id FROM languages WHERE name = 'Italian')),
(60, (SELECT id FROM languages WHERE name = 'Spanish Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(60, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(60, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(60, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=25');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(60, '0000000163.jpg', 0),
(60, '0000000162.jpg', 1),
(60, '0000000161.jpg', 2),
(60, '0000000160.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (60, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (60, 'Valve Anti-Cheat', 'enabled');

-- Half-Life (App ID: 70)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (70, 'Half-Life', 96, 'http://www.metacritic.com/games/platforms/pc/halflife', 70, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 19');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 19');
INSERT IGNORE INTO publishers (name) VALUES ('1998 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (70, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 19'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 19'), '1998-11-19');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(70, (SELECT id FROM languages WHERE name = 'English')),
(70, (SELECT id FROM languages WHERE name = 'French')),
(70, (SELECT id FROM languages WHERE name = 'German')),
(70, (SELECT id FROM languages WHERE name = 'Italian')),
(70, (SELECT id FROM languages WHERE name = 'Korean')),
(70, (SELECT id FROM languages WHERE name = 'Spanish')),
(70, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(70, (SELECT id FROM languages WHERE name = 'Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(70, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(70, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(70, 'website', 'http://www.half-life.com/'),
(70, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=20');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(70, '0000002354.jpg', 0),
(70, '0000002352.jpg', 1),
(70, '0000002351.jpg', 2),
(70, '0000002350.jpg', 3),
(70, '0000002349.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (70, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (70, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (70, 'Valve Anti-Cheat', 'enabled');

-- Counter-Strike: Condition Zero (App ID: 80)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (80, 'Counter-Strike: Condition Zero', 65, 'http://www.metacritic.com/games/platforms/pc/counterstrikeconditionzero', 80, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : March 1');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : March 1');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (80, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : March 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : March 1'), '2004-03-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(80, (SELECT id FROM languages WHERE name = 'English')),
(80, (SELECT id FROM languages WHERE name = 'French')),
(80, (SELECT id FROM languages WHERE name = 'German')),
(80, (SELECT id FROM languages WHERE name = 'Italian')),
(80, (SELECT id FROM languages WHERE name = 'Korean')),
(80, (SELECT id FROM languages WHERE name = 'Spanish')),
(80, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(80, (SELECT id FROM languages WHERE name = 'Traditional Chinese Single-player Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(80, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(80, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(80, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=33');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(80, '0000002535.jpg', 0),
(80, '0000002534.jpg', 1),
(80, '0000002533.jpg', 2),
(80, '0000002532.jpg', 3),
(80, '0000002531.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (80, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (80, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (80, 'Valve Anti-Cheat', 'enabled');

-- Half-Life: Blue Shift (App ID: 130)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (130, 'Half-Life: Blue Shift', 71, 'http://www.metacritic.com/games/platforms/pc/halflifeblueshift', 130, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Gearbox Software Publisher : Valve Release Date : June 1');
INSERT IGNORE INTO developers (name) VALUES ('2001 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : June 1');
INSERT IGNORE INTO publishers (name) VALUES ('2001 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (130, (SELECT id FROM developers WHERE name = 'Gearbox Software Publisher : Valve Release Date : June 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : June 1'), '2001-06-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(130, (SELECT id FROM languages WHERE name = 'English')),
(130, (SELECT id FROM languages WHERE name = 'French')),
(130, (SELECT id FROM languages WHERE name = 'German Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(130, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(130, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(130, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=55');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(130, '0000000131.jpg', 0),
(130, '0000000130.jpg', 1),
(130, '0000000129.jpg', 2),
(130, '0000000128.jpg', 3),
(130, '0000000127.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (130, 'Single-player', 'enabled');

-- Half-Life 2: Demo (App ID: 219)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (219, 'Half-Life 2: Demo', 96, 'http://www.metacritic.com/games/platforms/pc/halflife2', 220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (219, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Valve Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(219, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(219, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(219, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(219, 'website', 'http://www.half-life2.com'),
(219, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=43');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(219, '0000000199.jpg', 0),
(219, '0000000198.jpg', 1),
(219, '0000000197.jpg', 2),
(219, '0000000196.jpg', 3),
(219, '0000000195.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (219, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (219, 'Game demo', 'enabled');

-- Half-Life 2 (App ID: 220)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (220, 'Half-Life 2', 96, 'http://www.metacritic.com/games/platforms/pc/halflife2', 220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 16');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English *');
INSERT IGNORE INTO developers (name) VALUES ('French *');
INSERT IGNORE INTO developers (name) VALUES ('German *');
INSERT IGNORE INTO developers (name) VALUES ('Italian *');
INSERT IGNORE INTO developers (name) VALUES ('Korean *');
INSERT IGNORE INTO developers (name) VALUES ('Spanish *');
INSERT IGNORE INTO developers (name) VALUES ('Russian *');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese *');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese *');
INSERT IGNORE INTO developers (name) VALUES ('Dutch');
INSERT IGNORE INTO developers (name) VALUES ('Danish');
INSERT IGNORE INTO developers (name) VALUES ('Finnish');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Norwegian');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Portuguese');
INSERT IGNORE INTO developers (name) VALUES ('Swedish');
INSERT IGNORE INTO developers (name) VALUES ('Thai * languages with full audio support Single-player Captions available Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 16');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English *');
INSERT IGNORE INTO publishers (name) VALUES ('French *');
INSERT IGNORE INTO publishers (name) VALUES ('German *');
INSERT IGNORE INTO publishers (name) VALUES ('Italian *');
INSERT IGNORE INTO publishers (name) VALUES ('Korean *');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish *');
INSERT IGNORE INTO publishers (name) VALUES ('Russian *');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese *');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese *');
INSERT IGNORE INTO publishers (name) VALUES ('Dutch');
INSERT IGNORE INTO publishers (name) VALUES ('Danish');
INSERT IGNORE INTO publishers (name) VALUES ('Finnish');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Norwegian');
INSERT IGNORE INTO publishers (name) VALUES ('Polish');
INSERT IGNORE INTO publishers (name) VALUES ('Portuguese');
INSERT IGNORE INTO publishers (name) VALUES ('Swedish');
INSERT IGNORE INTO publishers (name) VALUES ('Thai * languages with full audio support Single-player Captions available Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (220, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 16'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 16'), '2004-11-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(220, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(220, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(220, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(220, 'website', 'index.php?area=game&AppId=219&cc=US'),
(220, 'website', 'http://www.half-life2.com'),
(220, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=43');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(220, '0000001872.jpg', 0),
(220, '0000001871.jpg', 1),
(220, '0000001870.jpg', 2),
(220, '0000001869.jpg', 3),
(220, '0000001868.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (220, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (220, 'Captions available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (220, 'Includes Source SDK', 'enabled');

-- Counter-Strike: Source (App ID: 240)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (240, 'Counter-Strike: Source', 88, 'http://www.metacritic.com/games/platforms/pc/counterstrikesource', 240, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 1');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Russian');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Thai Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 1');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Russian');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Thai Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (240, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 1'), '2004-11-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(240, (SELECT id FROM languages WHERE name = 'English')),
(240, (SELECT id FROM languages WHERE name = 'French')),
(240, (SELECT id FROM languages WHERE name = 'German')),
(240, (SELECT id FROM languages WHERE name = 'Italian')),
(240, (SELECT id FROM languages WHERE name = 'Japanese')),
(240, (SELECT id FROM languages WHERE name = 'Korean')),
(240, (SELECT id FROM languages WHERE name = 'Spanish')),
(240, (SELECT id FROM languages WHERE name = 'Russian')),
(240, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(240, (SELECT id FROM languages WHERE name = 'Traditional Chinese')),
(240, (SELECT id FROM languages WHERE name = 'Thai Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(240, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(240, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(240, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=37');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(240, '0000000031.jpg', 0),
(240, '0000000030.jpg', 1),
(240, '0000000029.jpg', 2),
(240, '0000000028.jpg', 3),
(240, '0000000027.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (240, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (240, 'HDR available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (240, 'Valve Anti-Cheat', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (240, 'Includes Source SDK', 'enabled');

-- Half-Life: Source (App ID: 280)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (280, 'Half-Life: Source', 280, '', 'header.jpg');

INSERT IGNORE INTO publishers (name) VALUES ('Valve Erschienen am : Juni 1');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Sprachen : Englisch');
INSERT IGNORE INTO publishers (name) VALUES ('Französisch');
INSERT IGNORE INTO publishers (name) VALUES ('Deutsch');
INSERT IGNORE INTO publishers (name) VALUES ('Italienisch');
INSERT IGNORE INTO publishers (name) VALUES ('Japanisch');
INSERT IGNORE INTO publishers (name) VALUES ('Koreanisch');
INSERT IGNORE INTO publishers (name) VALUES ('Spanisch');
INSERT IGNORE INTO publishers (name) VALUES ('Russisch');
INSERT IGNORE INTO publishers (name) VALUES ('Chinesisch (vereinfacht)');
INSERT IGNORE INTO publishers (name) VALUES ('Chinesisch (traditionell)');
INSERT IGNORE INTO publishers (name) VALUES ('Thai Einzelspieler');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (280, NULL, (SELECT id FROM publishers WHERE name = 'Valve Erschienen am : Juni 1'), NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(280, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=20');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(280, '0000000190.jpg', 0),
(280, '0000000189.jpg', 1),
(280, '0000000188.jpg', 2),
(280, '0000000187.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (280, 'Einzelspieler', 'enabled');

-- Day of Defeat: Source (App ID: 300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (300, 'Day of Defeat: Source', 80, 'http://www.metacritic.com/games/platforms/pc/dayofdefeatsource', 918, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : September 26');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : September 26');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (300, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : September 26'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : September 26'), '2005-09-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(300, (SELECT id FROM languages WHERE name = 'English Multi-player HDR available Valve Anti-Cheat enabled Includes Source SDK'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(300, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(300, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(300, 'website', 'index.php?area=game&AppId=917&cc=US'),
(300, 'website', 'index.php?area=game&AppId=901&cc=US'),
(300, 'website', 'http://www.dayofdefeat.com/'),
(300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=56'),
(300, 'manual', 'index.php?area=manual&AppId=300&l=english'),
(300, 'stats', 'http://www.dayofdefeat.com/stats/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(300, '0000000045.jpg', 0),
(300, '0000000044.jpg', 1),
(300, '0000000043.jpg', 2),
(300, '0000000042.jpg', 3),
(300, '0000000023.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (300, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (300, 'HDR available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (300, 'Valve Anti-Cheat', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (300, 'Includes Source SDK', 'enabled');

-- Half-Life 2: Deathmatch (App ID: 320)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (320, 'Half-Life 2: Deathmatch', 320, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : November 1');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Multi-player Valve Anti-Cheat enabled Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : November 1');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Multi-player Valve Anti-Cheat enabled Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (320, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : November 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : November 1'), '2004-11-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(320, (SELECT id FROM languages WHERE name = 'English Multi-player Valve Anti-Cheat enabled Includes Source SDK'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(320, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(320, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(320, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=46');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (320, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (320, 'Valve Anti-Cheat', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (320, 'Includes Source SDK', 'enabled');

-- Half-Life 2: Lost Coast (App ID: 340)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (340, 'Half-Life 2: Lost Coast', 340, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (340, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(340, 'minimum', 'Pentium 4 2.4GHz or AMD 2800+ Processor, 1GB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(340, 'website', 'http://www.half-life2.com'),
(340, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=43');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(340, '0000000015.jpg', 0),
(340, '0000000014.jpg', 1),
(340, '0000000013.jpg', 2),
(340, '0000000011.jpg', 3),
(340, '0000000010.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (340, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (340, 'Comentario disponible', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (340, 'HDR disponible', 'enabled');

-- Half-Life Deathmatch: Source (App ID: 360)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (360, 'Half-Life Deathmatch: Source', 360, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : May 1');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Multi-player Valve Anti-Cheat enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : May 1');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (360, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : May 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : May 1'), '2006-05-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(360, (SELECT id FROM languages WHERE name = 'English Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(360, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=70');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (360, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (360, 'Valve Anti-Cheat', 'enabled');

-- Half-Life 2: Episode One (App ID: 380)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (380, 'Half-Life 2: Episode One', 87, 'http://www.metacritic.com/games/platforms/pc/halflife2episodeone', 915, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : June 1');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English *');
INSERT IGNORE INTO developers (name) VALUES ('French *');
INSERT IGNORE INTO developers (name) VALUES ('German *');
INSERT IGNORE INTO developers (name) VALUES ('Italian *');
INSERT IGNORE INTO developers (name) VALUES ('Korean *');
INSERT IGNORE INTO developers (name) VALUES ('Spanish *');
INSERT IGNORE INTO developers (name) VALUES ('Russian *');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese *');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese *');
INSERT IGNORE INTO developers (name) VALUES ('Dutch');
INSERT IGNORE INTO developers (name) VALUES ('Danish');
INSERT IGNORE INTO developers (name) VALUES ('Finnish');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Norwegian');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Portuguese');
INSERT IGNORE INTO developers (name) VALUES ('Swedish');
INSERT IGNORE INTO developers (name) VALUES ('Thai * languages with full audio support Single-player Commentary available Captions available HDR available Includes Source SDK Player Discretion Advised Blood & Gore');
INSERT IGNORE INTO developers (name) VALUES ('Intense Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : June 1');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English *');
INSERT IGNORE INTO publishers (name) VALUES ('French *');
INSERT IGNORE INTO publishers (name) VALUES ('German *');
INSERT IGNORE INTO publishers (name) VALUES ('Italian *');
INSERT IGNORE INTO publishers (name) VALUES ('Korean *');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish *');
INSERT IGNORE INTO publishers (name) VALUES ('Russian *');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese *');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese *');
INSERT IGNORE INTO publishers (name) VALUES ('Dutch');
INSERT IGNORE INTO publishers (name) VALUES ('Danish');
INSERT IGNORE INTO publishers (name) VALUES ('Finnish');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Norwegian');
INSERT IGNORE INTO publishers (name) VALUES ('Polish');
INSERT IGNORE INTO publishers (name) VALUES ('Portuguese');
INSERT IGNORE INTO publishers (name) VALUES ('Swedish');
INSERT IGNORE INTO publishers (name) VALUES ('Thai * languages with full audio support Single-player Commentary available Captions available HDR available Includes Source SDK Player Discretion Advised Blood & Gore');
INSERT IGNORE INTO publishers (name) VALUES ('Intense Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (380, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : June 1'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : June 1'), '2006-06-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(380, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(380, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(380, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(380, 'website', 'index.php?area=game&AppId=914&cc=US'),
(380, 'website', 'index.php?area=game&AppId=913&cc=US'),
(380, 'website', 'index.php?area=game&AppId=912&cc=US'),
(380, 'website', 'index.php?area=game&AppId=905&cc=US'),
(380, 'website', 'http://ep1.half-life2.com/'),
(380, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=69'),
(380, 'manual', 'index.php?area=manual&AppId=380&l=english'),
(380, 'stats', 'http://www.steampowered.com/status/ep1/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(380, '0000000407.jpg', 0),
(380, '0000000311.jpg', 1),
(380, '0000000310.jpg', 2),
(380, '0000000309.jpg', 3),
(380, '0000000308.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'Commentary available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'Captions available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'HDR available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'Includes Source SDK', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (380, 'Player Discretion Advised Blood & Gore, Intense Violence', 'enabled');

-- Portal (App ID: 400)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (400, 'Portal', 90, 'http://www.metacritic.com/games/platforms/pc/portal', 400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : October 10');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English *');
INSERT IGNORE INTO developers (name) VALUES ('French *');
INSERT IGNORE INTO developers (name) VALUES ('German *');
INSERT IGNORE INTO developers (name) VALUES ('Russian *');
INSERT IGNORE INTO developers (name) VALUES ('Danish');
INSERT IGNORE INTO developers (name) VALUES ('Dutch');
INSERT IGNORE INTO developers (name) VALUES ('Finnish');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Norwegian');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Portuguese');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Swedish');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese * languages with full audio support Single-player Commentary available Captions available HDR available Includes level editor Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : October 10');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English *');
INSERT IGNORE INTO publishers (name) VALUES ('French *');
INSERT IGNORE INTO publishers (name) VALUES ('German *');
INSERT IGNORE INTO publishers (name) VALUES ('Russian *');
INSERT IGNORE INTO publishers (name) VALUES ('Danish');
INSERT IGNORE INTO publishers (name) VALUES ('Dutch');
INSERT IGNORE INTO publishers (name) VALUES ('Finnish');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Norwegian');
INSERT IGNORE INTO publishers (name) VALUES ('Polish');
INSERT IGNORE INTO publishers (name) VALUES ('Portuguese');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Swedish');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese * languages with full audio support Single-player Commentary available Captions available HDR available Includes level editor Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (400, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : October 10'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : October 10'), '2007-10-10');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(400, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(400, 'minimum', '1.7 GHz Processor, 512MB RAM, DirectX� 8 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection'),
(400, 'recommended', 'Pentium 4 processor (3.0GHz, or better), 1GB RAM, DirectX� 9 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(400, 'website', 'http://www.whatistheorangebox.com/'),
(400, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=82');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(400, '0000002588.jpg', 0),
(400, '0000002587.jpg', 1),
(400, '0000002586.jpg', 2),
(400, '0000002585.jpg', 3),
(400, '0000002584.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'Commentary available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'Captions available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'HDR available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (400, 'Includes Source SDK', 'enabled');

-- Half-Life 2: Episode Two (App ID: 420)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (420, 'Half-Life 2: Episode Two', 90, 'http://www.metacritic.com/games/platforms/pc/halflife2episode2', 420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve Publisher : Valve Release Date : October 10');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English *');
INSERT IGNORE INTO developers (name) VALUES ('French *');
INSERT IGNORE INTO developers (name) VALUES ('German *');
INSERT IGNORE INTO developers (name) VALUES ('Russian *');
INSERT IGNORE INTO developers (name) VALUES ('Danish');
INSERT IGNORE INTO developers (name) VALUES ('Dutch');
INSERT IGNORE INTO developers (name) VALUES ('Finnish');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Norwegian');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Portuguese');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Swedish');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese * languages with full audio support Single-player Commentary available Captions available HDR available Includes level editor Includes Source SDK');
INSERT IGNORE INTO publishers (name) VALUES ('Valve Release Date : October 10');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English *');
INSERT IGNORE INTO publishers (name) VALUES ('French *');
INSERT IGNORE INTO publishers (name) VALUES ('German *');
INSERT IGNORE INTO publishers (name) VALUES ('Russian *');
INSERT IGNORE INTO publishers (name) VALUES ('Danish');
INSERT IGNORE INTO publishers (name) VALUES ('Dutch');
INSERT IGNORE INTO publishers (name) VALUES ('Finnish');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Norwegian');
INSERT IGNORE INTO publishers (name) VALUES ('Polish');
INSERT IGNORE INTO publishers (name) VALUES ('Portuguese');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Swedish');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese * languages with full audio support Single-player Commentary available Captions available HDR available Includes level editor Includes Source SDK');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (420, (SELECT id FROM developers WHERE name = 'Valve Publisher : Valve Release Date : October 10'), (SELECT id FROM publishers WHERE name = 'Valve Release Date : October 10'), '2007-10-10');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(420, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(420, 'minimum', '1.7 GHz Processor, 512MB RAM, DirectX� 8 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection'),
(420, 'recommended', 'Pentium 4 processor (3.0GHz, or better), 1GB RAM, DirectX� 9 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(420, 'website', 'index.php?area=game&AppId=937&cc=US'),
(420, 'website', 'index.php?area=game&AppId=936&cc=US'),
(420, 'website', 'index.php?area=game&AppId=934&cc=US'),
(420, 'website', 'index.php?area=game&AppId=933&cc=US'),
(420, 'website', 'index.php?area=game&AppId=930&cc=US'),
(420, 'website', 'index.php?area=game&AppId=916&cc=US'),
(420, 'website', 'http://www.whatistheorangebox.com/'),
(420, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=81'),
(420, 'stats', 'http://storefront.steampowered.com/status/ep2/ep2_stats.php');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(420, '0000002595.jpg', 0),
(420, '0000002594.jpg', 1),
(420, '0000002593.jpg', 2),
(420, '0000002592.jpg', 3),
(420, '0000002591.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'Commentary available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'Captions available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'HDR available', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (420, 'Includes Source SDK', 'enabled');

-- Team Fortress 2 (App ID: 440)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (440, 'Team Fortress 2', 93, 'http://www.metacritic.com/games/platforms/pc/teamfortress2', 440, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (440, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(440, 'minimum', '1.7 GHz Processor, 512MB RAM, DirectX� 8 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection'),
(440, 'recommended', 'Pentium 4 processor (3.0GHz, or better), 1GB RAM, DirectX� 9 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(440, 'website', 'index.php?area=game&AppId=5033&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=5034&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=5035&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=5036&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=5016&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=5015&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=997&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=994&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=987&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=985&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=960&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=931&l=spanish&cc=US'),
(440, 'website', 'index.php?area=game&AppId=923&l=spanish&cc=US'),
(440, 'website', 'http://www.whatistheorangebox.com/'),
(440, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=80'),
(440, 'manual', 'index.php?area=manual&AppId=440&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(440, '0000002581.jpg', 0),
(440, '0000002580.jpg', 1),
(440, '0000002579.jpg', 2),
(440, '0000002578.jpg', 3),
(440, '0000002577.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Comentario disponible', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Subtítulos disponibles', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'HDR disponible', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Sistema antitrampas de Valve activado', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Incluye editor de niveles', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (440, 'Incluye Source SDK', 'enabled');

-- Trailer: Zombie Movie (Media App ID: 900)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (900, 'Zombie Movie', '', NULL, '', '', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(900, 'website', 'http://www.2chums.com/zombie-movie.html'),
(900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=74');


-- Trailer: Day of Defeat: Prelude to Victory (Media App ID: 901)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (300, 901);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (901, 'Day of Defeat: Prelude to Victory', '', NULL, '', '', 'header.jpg', 'gfx/apps/901/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(901, 'website', 'http://www.dayofdefeat.com'),
(901, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=56');


-- Trailer: Dangerous Waters Trailer (Media App ID: 902)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1600, 902);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (902, 'Dangerous Waters Trailer', 'Sonalysts Languages : English Resolution : 640 x 480', NULL, '640x480', '', 'header.jpg', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(902, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(902, 'website', 'http://www.strategyfirst.com/en/games/DangerousWaters/'),
(902, 'forum', 'http://www.sonalystscombatsims.com/phpBB/index.php?c=1');


-- Trailer: Darwinia Trailer (Media App ID: 903)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1500, 903);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (903, 'Darwinia Trailer', 'Introversion Software Languages : English Resolution : 640 x 480', NULL, '640x480', '', 'header.jpg', 'gfx/apps/903/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(903, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(903, 'website', 'http://www.darwinia.co.uk/');


-- Trailer: Half-Life 2 Trailer (Media App ID: 904)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (220, 904);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (904, 'Half-Life 2 Trailer', 'Valve Publisher : Valve Languages : English Resolution : 640 x480 Length : 1:20', NULL, '640x480', '1:20', 'header.jpg', 'gfx/apps/904/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(904, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(904, 'website', 'http://www.half-life2.com'),
(904, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=43');


-- Trailer: Half-Life 2: Episode One Trailer (Media App ID: 905)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (380, 905);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (905, 'Half-Life 2: Episode One Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/905/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(905, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=69');


-- Trailer: Rag Doll Kung Fu Trailer (Media App ID: 906)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1002, 906);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (906, 'Rag Doll Kung Fu Trailer', '', NULL, '', '', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(906, 'website', 'http://www.ragdollkungfu.com/'),
(906, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=54');


-- Trailer: Red Orchestra Trailer (Media App ID: 907)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 907);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (907, 'Red Orchestra Trailer', 'Tripwire Interactive Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/907/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(907, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(907, 'website', 'http://www.redorchestragame.com/'),
(907, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: Shadowgrounds Trailer (Media App ID: 908)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2500, 908);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (908, 'Shadowgrounds Trailer', 'Frozenbyte Publisher : Meridian4 Languages : English Resolution : 640 x 480', NULL, '640x480', '', 'header.jpg', 'gfx/apps/908/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(908, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(908, 'website', 'http://www.shadowgroundsgame.com'),
(908, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=73');


-- Trailer: SiN Episode 1: Emergence Trailer (Media App ID: 909)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1300, 909);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (909, 'SiN Episode 1: Emergence Trailer', '', NULL, '', '', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(909, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=60');


-- Trailer: HL2:EP1 Launch Teaser 1 (Media App ID: 912)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (380, 912);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (912, 'HL2:EP1 Launch Teaser 1', '', NULL, '', '', 'header.jpg', 'gfx/apps/912/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(912, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=73');


-- Trailer: HL2:EP1 Launch Teaser 2 (Media App ID: 913)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (380, 913);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (913, 'HL2:EP1 Launch Teaser 2', '', NULL, '', '', 'header.jpg', 'gfx/apps/913/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(913, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=73');


-- Trailer: HL2:EP1 Launch Teaser 3 (Media App ID: 914)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (380, 914);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (914, 'HL2:EP1 Launch Teaser 3', '', NULL, '', '', 'header.jpg', 'gfx/apps/914/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(914, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=73');


-- Trailer: HL2:EP1 Launch Teaser 4 (Media App ID: 915)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (380, 915);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (915, 'HL2:EP1 Launch Teaser 4', 'Valve Publisher : Valve Languages : English Resolution : 1280 x720', NULL, '1280x720', '', 'header.jpg', 'gfx/apps/915/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(915, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(915, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=73');


-- Trailer: Half-Life 2: Episode Two Trailer (Media App ID: 916)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 916);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (916, 'Half-Life 2: Episode Two Trailer', 'Valve Publisher : Valve Languages : English Resolution : 1280 x 720', NULL, '1280x720', '', 'header.jpg', 'gfx/apps/916/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(916, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Day of Defeat: Jagd Trailer (Media App ID: 917)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (300, 917);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (917, 'Day of Defeat: Jagd Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/917/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(917, 'website', 'http://www.dayofdefeat.com'),
(917, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=56');


-- Trailer: Day of Defeat: Colmar Trailer (Media App ID: 918)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (300, 918);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (918, 'Day of Defeat: Colmar Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/918/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(918, 'website', 'http://www.dayofdefeat.com'),
(918, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=56');


-- Trailer: Dark Messiah: Warrior (Media App ID: 919)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2100, 919);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (919, 'Dark Messiah: Warrior', 'Arkane Studios Languages : English Resolution : 1024 x 576 Length : 1:27', NULL, '1024x576', '1:27', 'header.jpg', 'gfx/apps/919/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(919, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(919, 'website', 'http://www.arkane-studios.com/en/dark-messiah.php');


-- Trailer: Dark Messiah: Assassin (Media App ID: 920)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2100, 920);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (920, 'Dark Messiah: Assassin', 'Arkane Studios Languages : English Resolution : 1024 x 576 Length : 1:48', NULL, '1024x576', '1:48', 'header.jpg', 'gfx/apps/920/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(920, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(920, 'website', 'http://www.arkane-studios.com/en/dark-messiah.php');


-- Trailer: Dark Messiah: Wizard (Media App ID: 921)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2100, 921);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (921, 'Dark Messiah: Wizard', 'Arkane Studios Languages : English Resolution : 1024 x 576 Length : 1:25', NULL, '1024x576', '1:25', 'header.jpg', 'gfx/apps/921/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(921, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(921, 'website', 'http://www.arkane-studios.com/en/dark-messiah.php');


-- Trailer: Portal Trailer (Media App ID: 922)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (400, 922);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (922, 'Portal Trailer', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(922, 'website', 'http://ep2.half-life2.com'),
(922, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=82');


-- Trailer: Team Fortress 2 Trailer (Media App ID: 923)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 923);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (923, 'Team Fortress 2 Trailer', 'Valve Publisher : Valve Languages : English Resolution : 1280 x 720 Length : 1:12', NULL, '1280x720', '1:12', 'header.jpg', 'gfx/apps/923/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(923, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(923, 'website', 'http://ep2.half-life2.com'),
(923, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=80');


-- Trailer: Red Orchestra Infantry Tutorial (Media App ID: 924)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 924);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (924, 'Red Orchestra Infantry Tutorial', '', NULL, '', '', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(924, 'website', 'http://www.redorchestragame.com/'),
(924, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: Red Orchestra Vehicle Tutorial (Media App ID: 925)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 925);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (925, 'Red Orchestra Vehicle Tutorial', 'Tripwire Interactive Resolution : 640 x 480 Length : 3:05', NULL, '640x480', '3:05', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(925, 'website', 'http://www.redorchestragame.com/'),
(925, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: Red Orchestra Lyes Krovy Trailer (Media App ID: 926)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 926);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (926, 'Red Orchestra Lyes Krovy Trailer', '', NULL, '', '', 'header.jpg', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(926, 'website', 'http://www.redorchestragame.com/'),
(926, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: GTI Racing Trailer (Media App ID: 927)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (3000, 927);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (927, 'GTI Racing Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/927/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(927, 'website', 'http://www.gtiracingthegame.com/');


-- Trailer: Source Forts Trailer (Media App ID: 928)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (90034, 928);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (928, 'Source Forts Trailer', 'Source Forts Team Languages : English Resolution : 640 x 480 Length : 1:12', NULL, '640x480', '1:12', 'header.jpg', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(928, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(928, 'website', 'http://www.sourcefortsmod.com');


-- Trailer: Uplink Trailer (Media App ID: 929)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1510, 929);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (929, 'Uplink Trailer', 'Introversion Resolution : 640x360 Length : 1:22', NULL, '640x360', '1:22', 'header.jpg', 'gfx/apps/929/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(929, 'website', 'http://www.uplink.co.uk/');


-- Trailer: Half-Life 2: Episode Two Trailer 2 (Media App ID: 930)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 930);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (930, 'Half-Life 2: Episode Two Trailer 2', '', NULL, '', '', 'header.jpg', '');


-- Trailer: Team Fortress 2 Trailer 2 (Media App ID: 931)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 931);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (931, 'Team Fortress 2 Trailer 2', 'Valve Publisher : Valve Languages : English Resolution : 1280 x 720 Length : 3:28', NULL, '1280x720', '3:28', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(931, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(931, 'website', 'http://ep2.half-life2.com'),
(931, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=80');


-- Trailer: HL2:EP2 Gameplay Video 1 (Media App ID: 932)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 932);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (932, 'HL2:EP2 Gameplay Video 1', '', NULL, '', '', 'header.jpg', 'gfx/apps/932/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(932, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=81');


-- Trailer: HL2:EP2 Gameplay Video 2 (Media App ID: 933)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 933);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (933, 'HL2:EP2 Gameplay Video 2', '', NULL, '', '', 'header.jpg', 'gfx/apps/933/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(933, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=81');


-- Trailer: HL2:EP2 Gameplay Video 3 (Media App ID: 934)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 934);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (934, 'HL2:EP2 Gameplay Video 3', '', NULL, '', '', 'header.jpg', 'gfx/apps/934/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(934, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=81');


-- Trailer: Dark Messiah Gameplay Trailer (Media App ID: 935)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2100, 935);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (935, 'Dark Messiah Gameplay Trailer', 'Arkane Studios Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/935/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(935, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(935, 'website', 'http://www.darkmessiahmightandmagic.com');


-- Trailer: HL2:EP2 Gameplay Video 4 (Media App ID: 936)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 936);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (936, 'HL2:EP2 Gameplay Video 4', '', NULL, '', '', 'header.jpg', 'gfx/apps/936/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(936, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=81');


-- Trailer: HL2:EP2 Gameplay Video 5 (Media App ID: 937)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (420, 937);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (937, 'HL2:EP2 Gameplay Video 5', 'Valve Languages : English Resolution : 1280 x 720 Length : 3:18', NULL, '1280x720', '3:18', 'header.jpg', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(937, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(937, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=81');


-- Trailer: City Life Trailer (Media App ID: 938)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4410, 938);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (938, 'City Life Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/938/');


-- Trailer: X3: Reunion Trailer (Media App ID: 939)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2810, 939);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (939, 'X3: Reunion Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/939/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(939, 'website', 'http://www.egosoft.com/games/x3/info_en.php');


-- Trailer: Dark Messiah Launch Trailer (Media App ID: 940)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2100, 940);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (940, 'Dark Messiah Launch Trailer', 'Arkane Studios Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/940/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(940, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(940, 'website', 'http://www.darkmessiahmightandmagic.com');


-- Trailer: Red Orchestra Fall Update Trailer (Media App ID: 941)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 941);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (941, 'Red Orchestra Fall Update Trailer', 'Tripwire Interactive Languages : English Resolution : 720 x 484 Length : 1:44', NULL, '720x484', '1:44', 'header.jpg', 'gfx/apps/941/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(941, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(941, 'website', 'http://www.redorchestragame.com/'),
(941, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: Heroes of Annihilated Empires Trailer (Media App ID: 942)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4800, 942);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (942, 'Heroes of Annihilated Empires Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/942/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(942, 'website', 'http://www.heroesofae.com/');


-- Trailer: Prey Trailer (Media App ID: 943)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (3970, 943);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (943, 'Prey Trailer', 'Humanhead Studios', NULL, '', '', 'header.jpg', 'gfx/apps/943/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(943, 'website', 'http://www.prey.com/'),
(943, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=133');


-- Trailer: Left 4 Dead Teaser (Media App ID: 944)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (944, 'Left 4 Dead Teaser', '', NULL, '', '', 'header.jpg', 'gfx/apps/944/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(944, 'website', 'http://www.l4d.com'),
(944, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=130');


-- Trailer: X3: Reunion 2.0 Trailer (Media App ID: 945)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2810, 945);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (945, 'X3: Reunion 2.0 Trailer', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(945, 'website', 'http://www.egosoft.com/games/x3/info_en.php');


-- Trailer: Gumboy Trailer (Media App ID: 946)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2520, 946);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (946, 'Gumboy Trailer', '', NULL, '', '', 'header.jpg', 'gfx/apps/946/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(946, 'website', 'http://www.gumboycrazyadventures.com/'),
(946, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=137');


-- Trailer: Eets Trailer (Media App ID: 947)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6100, 947);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (947, 'Eets Trailer', 'Klei Entertainment', NULL, '', '', 'header.jpg', 'gfx/apps/947/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(947, 'website', 'http://www.eetsgame.com/'),
(947, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=139');


-- Trailer: Silverfall Trailer (Media App ID: 948)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4420, 948);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (948, 'Silverfall Trailer', 'Monte Cristo', NULL, '', '', 'header.jpg', 'gfx/apps/948/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(948, 'website', 'http://www.silverfall-game.com/');


-- Trailer: Joint Task Force Trailer (Media App ID: 949)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6400, 949);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (949, 'Joint Task Force Trailer', 'Most Wanted Entertainment', NULL, '', '', 'header.jpg', 'gfx/apps/949/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(949, 'website', 'http://www.jointtaskforce.com/');


-- Trailer: Hitman: Blood Money Trailer (Media App ID: 950)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6860, 950);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (950, 'Hitman: Blood Money Trailer', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(950, 'website', 'http://www.hitman.com/'),
(950, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=159');


-- Trailer: Just Cause Trailer (Media App ID: 951)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6880, 951);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (951, 'Just Cause Trailer', 'Avalanche Resolution : 1280 x 720 Length : 1:28', NULL, '1280x720', '1:28', 'header.jpg', 'gfx/apps/951/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(951, 'website', 'http://www.eidosinteractive.co.uk/gss/justcause/');


-- Trailer: TrackMania United Trailer (Media App ID: 953)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 953);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (953, 'TrackMania United Trailer', 'Nadeo', NULL, '', '', 'header.jpg', 'gfx/apps/953/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(953, 'website', 'http://www.tm-united.com');


-- Trailer: Runaway, The Dream of the Turtle Trailer (Media App ID: 954)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7220, 954);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (954, 'Runaway, The Dream of the Turtle Trailer', 'Pendulo Studios Languages : English Resolution : 720 x 384 Length : 1:59', NULL, '720x384', '1:59', 'header.jpg', 'gfx/apps/954/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(954, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(954, 'website', 'http://www.runaway-thegame.com/'),
(954, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=156');


-- Trailer: Battlestations: Midway Trailer (Media App ID: 955)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6870, 955);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (955, 'Battlestations: Midway Trailer', 'Eidos Interactive Languages : English Resolution : 1280 x 720 Length : 1:06', NULL, '1280x720', '1:06', 'header.jpg', 'gfx/apps/955/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(955, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(955, 'website', 'http://www.battlestations.net/');


-- Trailer: Project: Snowblind Trailer (Media App ID: 956)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7010, 956);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (956, 'Project: Snowblind Trailer', 'Crystal Dynamics Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/956/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(956, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(956, 'website', 'http://www.projectsnowblind.com/');


-- Trailer: Tomb Raider: Legend Trailer (Media App ID: 957)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7000, 957);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (957, 'Tomb Raider: Legend Trailer', 'Crystal Dynamics Languages : English Resolution : 1280 x 960 Length : 1:58', NULL, '1280x960', '1:58', 'header.jpg', 'gfx/apps/957/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(957, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(957, 'website', 'http://www.tombraider.com/legend/');


-- Trailer: Infernal Trailer 2 (Media App ID: 958)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7060, 958);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (958, 'Infernal Trailer 2', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(958, 'website', 'http://www.infernalgame.com');


-- Trailer: Infernal Trailer 1 (Media App ID: 959)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7060, 959);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (959, 'Infernal Trailer 1', 'Metropolis Software Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/959/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(959, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(959, 'website', 'http://www.infernalgame.com');


-- Trailer: Team Fortress 2: Meet the Heavy (Media App ID: 960)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 960);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (960, 'Team Fortress 2: Meet the Heavy', 'Valve Languages : English Resolution : 1280 x 720 Length : 01:28', NULL, '1280x720', '01:28', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(960, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(960, 'website', 'http://ep2.half-life2.com/'),
(960, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=80');


-- Trailer: Red Orchestra June ''07 Update Trailer (Media App ID: 961)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1200, 961);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (961, 'Red Orchestra June ''07 Update Trailer', 'Tripwire Interactive Languages : English Resolution : 720 x 486 Length : 01:50', NULL, '720x486', '01:50', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(961, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(961, 'website', 'http://www.redorchestragame.com/'),
(961, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62');


-- Trailer: TrackMania United Webisode 1 (Media App ID: 963)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 963);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (963, 'TrackMania United Webisode 1', 'Nadeo Resolution : 720 x 576 Length : 02:26', NULL, '720x576', '02:26', 'header.jpg', 'gfx/apps/963/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(963, 'website', 'http://www.tm-united.com');


-- Trailer: TrackMania United Webisode 2 (Media App ID: 964)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 964);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (964, 'TrackMania United Webisode 2', 'Nadeo Resolution : 720 x 576 Length : 02:41', NULL, '720x576', '02:41', 'header.jpg', 'gfx/apps/964/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(964, 'website', 'http://www.tm-united.com');


-- Trailer: TrackMania United Webisode 3 (Media App ID: 965)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 965);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (965, 'TrackMania United Webisode 3', 'Nadeo Resolution : 720 x 576 Length : 02:26', NULL, '720x576', '02:26', 'header.jpg', 'gfx/apps/965/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(965, 'website', 'http://www.tm-united.com');


-- Trailer: TrackMania United Webisode 4 (Media App ID: 966)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 966);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (966, 'TrackMania United Webisode 4', 'Nadeo Resolution : 720 x 576 Length : 03:17', NULL, '720x576', '03:17', 'header.jpg', 'gfx/apps/966/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(966, 'website', 'http://www.tm-united.com');


-- Trailer: TrackMania United Webisode 5 (Media App ID: 967)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7200, 967);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (967, 'TrackMania United Webisode 5', 'Nadeo Resolution : 720 x 576 Length : 03:11', NULL, '720x576', '03:11', 'header.jpg', 'gfx/apps/967/');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(967, 'website', 'http://www.tm-united.com');


-- Trailer: Sam & Max: Episode 1 Trailer (Media App ID: 968)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8200, 968);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (968, 'Sam & Max: Episode 1 Trailer', '', NULL, '', '', '', '');


-- Trailer: Sam & Max: Episode 2 Trailer (Media App ID: 969)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8210, 969);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (969, 'Sam & Max: Episode 2 Trailer', 'Telltale Games Resolution : 800 x 600 Length : 1:15', NULL, '800x600', '1:15', 'header.jpg', 'gfx/apps/969/');


-- Trailer: Sam & Max: Episode 3 Trailer (Media App ID: 970)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8220, 970);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (970, 'Sam & Max: Episode 3 Trailer', 'Telltale Games Resolution : 800 x 600 Length : 1:08', NULL, '800x600', '1:08', 'header.jpg', 'gfx/apps/970/');


-- Trailer: Sam & Max: Episode 4 Trailer (Media App ID: 971)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8230, 971);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (971, 'Sam & Max: Episode 4 Trailer', 'Telltale Games Resolution : 800 x 600 Length : 0:48', NULL, '800x600', '0:48', 'header.jpg', 'gfx/apps/971/');


-- Trailer: Sam & Max: Episode 5 Trailer (Media App ID: 972)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8240, 972);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (972, 'Sam & Max: Episode 5 Trailer', 'Telltale Games Resolution : 640 x 480 Length : 0:51', NULL, '640x480', '0:51', 'header.jpg', 'gfx/apps/972/');


-- Trailer: Sam & Max: Episode 6 Trailer (Media App ID: 973)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8250, 973);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (973, 'Sam & Max: Episode 6 Trailer', 'Telltale Games Resolution : 800 x 600 Length : 0:29', NULL, '800x600', '0:29', 'header.jpg', 'gfx/apps/973/');


-- Trailer: Lost Planet Trailer (Media App ID: 974)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6510, 974);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (974, 'Lost Planet Trailer', 'CAPCOM CO., LTD. Languages : English Resolution : 1280 x 720 Length : 00:33', NULL, '1280x720', '00:33', 'header.jpg', 'gfx/apps/974/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(974, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(974, 'website', 'http://www.lostplanet-thegame.com');


-- Trailer: ThreadSpace: Hyperbol Trailer (Media App ID: 977)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2720, 977);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (977, 'ThreadSpace: Hyperbol Trailer', 'Iocaine Studios Languages : English', NULL, '', '', 'header.jpg', 'gfx/apps/977/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(977, (SELECT id FROM languages WHERE name = 'English'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(977, 'website', 'http://www.hyperbol.com/');


-- Trailer: Titan Quest - Immortal Throne Trailer (Media App ID: 978)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4550, 978);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (978, 'Titan Quest - Immortal Throne Trailer', 'Iron Lore Entertainment Languages : English Resolution : 1280 x 720 Length : 00:52', NULL, '1280x720', '00:52', 'header.jpg', 'gfx/apps/978/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(978, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(978, 'website', 'http://www.titanquestgame.com/');


-- Trailer: S.T.A.L.K.E.R. Trailer (Media App ID: 979)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4500, 979);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (979, 'S.T.A.L.K.E.R. Trailer', '', NULL, '', '', '', '');


-- Trailer: SpaceForce Rogue Universe Trailer (Media App ID: 980)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (3220, 980);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (980, 'SpaceForce Rogue Universe Trailer', 'Provox Games Languages : English Resolution : 1280 x 720 Length : 02:34', NULL, '1280x720', '02:34', 'header.jpg', 'gfx/apps/980/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(980, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(980, 'website', 'http://www.spaceforce2.com');


-- Trailer: Civilization IV: Beyond the Sword Trailer (Media App ID: 981)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8800, 981);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (981, 'Civilization IV: Beyond the Sword Trailer', 'Firaxis Games Languages : English Resolution : 640 x 360 Length : 01:46', NULL, '640x360', '01:46', 'header.jpg', 'gfx/apps/981/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(981, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Gish Trailer (Media App ID: 982)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (9500, 982);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (982, 'Gish Trailer', 'Cryptic Sea Languages : English Resolution : 1024 x 768 Length : 02:23', NULL, '1024x768', '02:23', 'header.jpg', 'gfx/apps/982/');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(982, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(982, 'website', 'http://www.crypticsea.com/gish');


-- Trailer: Team Fortress 2: Meet the Soldier (Media App ID: 985)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 985);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (985, 'Team Fortress 2: Meet the Soldier', 'Valve Languages : English Resolution : 1280 x 720 Length : 01:26', NULL, '1280x720', '01:26', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(985, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(985, 'website', 'http://www.whatistheorangebox.com/');


-- Trailer: RACE 07 Trailer (Media App ID: 986)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4260, 986);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (986, 'RACE 07 Trailer', 'SimBin Languages : English Length : 01:14', NULL, '', '01:14', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(986, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Team Fortress 2: Meet the Engineer (Media App ID: 987)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 987);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (987, 'Team Fortress 2: Meet the Engineer', 'Valve Languages : English Resolution : 1280 x 720 Length : 01:26', NULL, '1280x720', '01:26', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(987, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(987, 'website', 'http://www.whatistheorangebox.com/');


-- Trailer: Enemy Territory: QUAKE Wars Trailer (Media App ID: 990)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10000, 990);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (990, 'Enemy Territory: QUAKE Wars Trailer', 'id Software , Splash Damage Languages : English Resolution : 1280 x 720 Length : 02:29', NULL, '1280x720', '02:29', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(990, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Loki HD Trailer (Media App ID: 991)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7260, 991);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (991, 'Loki HD Trailer', 'Cyanide Languages : English Resolution : 1280 x 720 Length : 00:44', NULL, '1280x720', '00:44', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(991, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Team Fortress 2: Meet the Heavy (Russian) (Media App ID: 994)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (994, 'Team Fortress 2: Meet the Heavy (Russian)', 'Valve Languages : English Resolution : 1280 x 720 Length : 1:29', NULL, '1280x720', '1:29', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(994, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: The Orange Box Commercial (Media App ID: 995)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (900546, 995);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (995, 'The Orange Box Commercial', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(995, 'website', 'http://www.whatistheorangebox.com/');


-- Trailer: Two Worlds Trailer (Media App ID: 996)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (1920, 996);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (996, 'Two Worlds Trailer', '', NULL, '', '', '', '');


-- Trailer: Team Fortress 2: Meet the Demoman (Media App ID: 997)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 997);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (997, 'Team Fortress 2: Meet the Demoman', '', NULL, '', '', '', '');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(997, 'website', 'http://www.whatistheorangebox.com/');


-- Trailer: Call of Duty 4 HD Trailer (Media App ID: 998)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7940, 998);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (998, 'Call of Duty 4 HD Trailer', '', NULL, '', '', '', '');


-- Trailer: Painkiller Overdose Trailer (Media App ID: 999)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (3270, 999);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (999, 'Painkiller Overdose Trailer', '', NULL, '', '', '', '');


-- Rag Doll Kung Fu (App ID: 1002)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1002, 'Rag Doll Kung Fu', 69, 'http://www.metacritic.com/games/platforms/pc/ragdollkungfu', 906, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Mark Healey Release Date : October 12');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1002, (SELECT id FROM developers WHERE name = 'Mark Healey Release Date : October 12'), NULL, '2005-10-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1002, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1002, 'minimum', 'Pentium3 800 MHz (or compatible), 256 MB RAM, GeForce 2 (or compatible), Windows 98, Internet connection for Steam Will be choppy with 8 AI players or in a big online game. Multi mice will only work with Windows XP'),
(1002, 'recommended', 'Pentium4 1500 MHz (or compatible), 512MB RAM, DirectX 9 compatible graphics card, Windows XP, Internet connection for Steam Will work fine with most DirectX 9 compatible graphics cards');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1002, 'website', 'index.php?area=game&AppId=906&cc=US'),
(1002, 'website', 'index.php?area=game&AppId=1003&cc=US'),
(1002, 'website', 'http://www.ragdollkungfu.com/'),
(1002, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=54');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1002, '0000000209.jpg', 0),
(1002, '0000000208.jpg', 1),
(1002, '0000000207.jpg', 2),
(1002, '0000000206.jpg', 3),
(1002, '0000000205.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1002, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1002, 'Multi-player', 'enabled');

-- Rag Doll Kung Fu Demo (App ID: 1003)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1003, 'Rag Doll Kung Fu Demo', 1002, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Mark Healey Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1003, (SELECT id FROM developers WHERE name = 'Mark Healey Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1003, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1003, 'minimum', 'Pentium3 800 MHz (or compatible), 256 MB RAM, GeForce 2 (or compatible), Windows 98, Internet connection for Steam Will be choppy with 8 AI players or in a big online game. Multi mice will only work with Windows XP'),
(1003, 'recommended', 'Pentium4 1500 MHz (or compatible), 512MB RAM, DirectX 9 compatible graphics card, Windows XP, Internet connection for Steam Will work fine with most DirectX 9 compatible graphics cards');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1003, 'website', 'http://www.ragdollkungfu.com/'),
(1003, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=54');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1003, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1003, 'Game demo', 'enabled');

-- Red Orchestra: Ostfront 41-45 (App ID: 1200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1200, 'Red Orchestra: Ostfront 41-45', 81, 'http://www.metacritic.com/games/platforms/pc/redorchestraostfront4145', 1200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Tripwire Interactive Release Date : March 14');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Russian Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1200, (SELECT id FROM developers WHERE name = 'Tripwire Interactive Release Date : March 14'), NULL, '2006-03-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1200, (SELECT id FROM languages WHERE name = 'English')),
(1200, (SELECT id FROM languages WHERE name = 'French')),
(1200, (SELECT id FROM languages WHERE name = 'Russian Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1200, 'minimum', 'CPU: 1.2 GHZ or Equivalent, 512 MB RAM, Video Card: 64 MB DX9 Compliant, 2 GB free hard drive space, DX 8.1 Compatible Audio, Windows 2000/XP'),
(1200, 'recommended', 'CPU: 2.4 GHZ, Video Card: 128 MB DX9 Compliant with PS 2.0 support, Sound Card: Eax Compatible');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1200, 'website', 'index.php?area=game&AppId=941&cc=US'),
(1200, 'website', 'index.php?area=game&AppId=924&cc=US'),
(1200, 'website', 'index.php?area=game&AppId=926&cc=US'),
(1200, 'website', 'index.php?area=game&AppId=925&cc=US'),
(1200, 'website', 'index.php?area=game&AppId=907&cc=US'),
(1200, 'website', 'http://www.redorchestragame.com/'),
(1200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=62'),
(1200, 'manual', 'index.php?area=manual&AppId=1200&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1200, '0000002635.jpg', 0),
(1200, '0000002634.jpg', 1),
(1200, '0000002633.jpg', 2),
(1200, '0000002632.jpg', 3),
(1200, '0000002631.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1200, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1200, 'Valve Anti-Cheat', 'enabled');

-- SiN Episodes: Emergence (App ID: 1300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1300, 'SiN Episodes: Emergence', 75, 'http://www.metacritic.com/games/platforms/pc/sinepisodesemergence', 909, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ritual Entertainment Publisher : Electronic Arts Release Date : May 10');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player Player Discretion Advised Blood & Gore');
INSERT IGNORE INTO developers (name) VALUES ('Intense Violence');
INSERT IGNORE INTO developers (name) VALUES ('Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('Electronic Arts Release Date : May 10');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Single-player Player Discretion Advised Blood & Gore');
INSERT IGNORE INTO publishers (name) VALUES ('Intense Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1300, (SELECT id FROM developers WHERE name = 'Ritual Entertainment Publisher : Electronic Arts Release Date : May 10'), (SELECT id FROM publishers WHERE name = 'Electronic Arts Release Date : May 10'), '2006-05-10');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1300, (SELECT id FROM languages WHERE name = 'English')),
(1300, (SELECT id FROM languages WHERE name = 'German')),
(1300, (SELECT id FROM languages WHERE name = 'Russian Single-player Player Discretion Advised Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1300, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(1300, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1300, 'website', 'index.php?area=game&AppId=909&cc=US'),
(1300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=60');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1300, '0000000292.jpg', 0),
(1300, '0000000291.jpg', 1),
(1300, '0000000290.jpg', 2),
(1300, '0000000289.jpg', 3),
(1300, '0000000288.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1300, 'Player Discretion Advised Blood & Gore, Intense Violence, Strong Language', 'enabled');

-- SiN 1 Multiplayer (App ID: 1309)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1309, 'SiN 1 Multiplayer', 1309, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ritual Entertainment Release Date : October 31');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1309, (SELECT id FROM developers WHERE name = 'Ritual Entertainment Release Date : October 31'), NULL, '1998-10-31');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1309, (SELECT id FROM languages WHERE name = 'English Multi-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1309, 'website', 'http://www.ritual.com/sin/'),
(1309, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=60');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1309, 'Multi-player', 'enabled');

-- SiN 1 (App ID: 1313)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1313, 'SiN 1', 1313, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ritual Entertainment Release Date : October 31');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1313, (SELECT id FROM developers WHERE name = 'Ritual Entertainment Release Date : October 31'), NULL, '1998-10-31');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1313, (SELECT id FROM languages WHERE name = 'English')),
(1313, (SELECT id FROM languages WHERE name = 'French Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1313, 'website', 'http://www.ritual.com/sin/'),
(1313, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=60');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1313, 'Single-player', 'enabled');

-- Darwinia (App ID: 1500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1500, 'Darwinia', 84, 'http://www.metacritic.com/games/platforms/pc/darwinia', 903, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Introversion Software Release Date : July 14');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1500, (SELECT id FROM developers WHERE name = 'Introversion Software Release Date : July 14'), NULL, '2005-07-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1500, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1500, 'recommended', 'Windows 98/Me/2000/XP, 600MHz CPU, 128MB RAM, DX7 based video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1500, 'website', 'index.php?area=game&AppId=1502&cc=US'),
(1500, 'website', 'http://www.darwinia.co.uk/'),
(1500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(1500, 'manual', 'index.php?area=manual&AppId=1500&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1500, '0000000231.jpg', 0),
(1500, '0000000230.jpg', 1),
(1500, '0000000229.jpg', 2),
(1500, '0000000228.jpg', 3),
(1500, '0000000227.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1500, 'Single-player', 'enabled');

-- Darwinia Demo (App ID: 1502)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1502, 'Darwinia Demo', 84, 'http://www.metacritic.com/games/platforms/pc/darwinia', 1500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Introversion Software Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1502, (SELECT id FROM developers WHERE name = 'Introversion Software Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1502, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1502, 'recommended', 'Windows 98/Me/2000/XP, 600MHz CPU, 128MB RAM, DX7 based video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1502, 'website', 'http://www.darwinia.co.uk/'),
(1502, 'manual', 'index.php?area=manual&AppId=1502&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1502, '0000000602.jpg', 0),
(1502, '0000000601.jpg', 1),
(1502, '0000000600.jpg', 2),
(1502, '0000000599.jpg', 3),
(1502, '0000000598.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1502, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1502, 'Game demo', 'enabled');

-- Uplink (App ID: 1510)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1510, 'Uplink', 75, 'http://www.metacritic.com/games/platforms/pc/uplink', 929, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Introversion Software Release Date : August 23');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1510, (SELECT id FROM developers WHERE name = 'Introversion Software Release Date : August 23'), NULL, '2006-08-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1510, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1510, 'website', 'http://www.uplink.co.uk/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1510, '0000000519.jpg', 0),
(1510, '0000000518.jpg', 1),
(1510, '0000000517.jpg', 2),
(1510, '0000000516.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1510, 'Single-player', 'enabled');

-- DEFCON (App ID: 1520)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1520, 'DEFCON', 84, 'http://www.metacritic.com/games/platforms/pc/defcon', 1522, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Introversion Software Release Date : September 29');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1520, (SELECT id FROM developers WHERE name = 'Introversion Software Release Date : September 29'), NULL, '2006-09-29');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1520, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1520, 'recommended', 'Windows 98/ME/2000/XP, P3-600-Geforce 2, 128 Mb RAM, 60 Mb Hard Disk, Internet connection for multiplayer games');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1520, 'website', 'index.php?area=game&AppId=1522&cc=US'),
(1520, 'website', 'http://www.everybody-dies.com/'),
(1520, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=244'),
(1520, 'manual', 'index.php?area=manual&AppId=1520&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1520, '0000000633.jpg', 0),
(1520, '0000000632.jpg', 1),
(1520, '0000000631.jpg', 2),
(1520, '0000000630.jpg', 3),
(1520, '0000000629.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1520, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1520, 'Multi-player', 'enabled');

-- DEFCON Demo (App ID: 1522)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1522, 'DEFCON Demo', 84, 'http://www.metacritic.com/games/platforms/pc/defcon', 1520, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Introversion Software Languages : English Single-player Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1522, (SELECT id FROM developers WHERE name = 'Introversion Software Languages : English Single-player Multi-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1522, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1522, 'recommended', 'Windows 98/ME/2000/XP, P3-600-Geforce 2, 128 Mb RAM, 60 Mb Hard Disk, Internet connection for multiplayer games');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1522, 'website', 'http://www.everybody-dies.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1522, '0000000657.jpg', 0),
(1522, '0000000656.jpg', 1),
(1522, '0000000655.jpg', 2),
(1522, '0000000654.jpg', 3),
(1522, '0000000653.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1522, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1522, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1522, 'Game demo', 'enabled');

-- Dangerous Waters (App ID: 1600)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1600, 'Dangerous Waters', 82, 'http://www.metacritic.com/games/platforms/pc/dangerouswaters', 1600, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1600, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1600, 'website', 'index.php?area=game&AppId=902&l=spanish&cc=US'),
(1600, 'website', 'http://www.scs-dangerouswaters.com/'),
(1600, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=250'),
(1600, 'manual', 'index.php?area=manual&AppId=1600&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1600, '0000000808.jpg', 0),
(1600, '0000000807.jpg', 1),
(1600, '0000000806.jpg', 2),
(1600, '0000000805.jpg', 3),
(1600, '0000000804.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1600, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1600, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1600, 'Violence', 'enabled');

-- Space Empires IV Deluxe (App ID: 1610)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1610, 'Space Empires IV Deluxe', 79, 'http://www.metacritic.com/games/platforms/pc/spaceempires4', 1610, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Malfador Machinations Publisher : Strategy First Release Date : February 7');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Mild Fantasy Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : February 7');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Mild Fantasy Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1610, (SELECT id FROM developers WHERE name = 'Malfador Machinations Publisher : Strategy First Release Date : February 7'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : February 7'), '2006-02-07');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1610, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Mild Fantasy Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1610, 'minimum', 'Pentium Processor; Windows 98/ME/2000/XP; 128MB RAM; 800x600 screen resolution; 16bit colour; 300 MB hard drive space; DirectX 8.1 or higher, Windows Compatible Sound Card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1610, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=257');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1610, '0000000247.jpg', 0),
(1610, '0000000246.jpg', 1),
(1610, '0000000245.jpg', 2),
(1610, '0000000243.jpg', 3),
(1610, '0000000242.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1610, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1610, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1610, 'Mild Fantasy Violence', 'enabled');

-- Jagged Alliance 2 Gold (App ID: 1620)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1620, 'Jagged Alliance 2 Gold', 1620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Strategy First Publisher : Strategy First Release Date : July 6');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Strong Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 6');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Blood Strong Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1620, (SELECT id FROM developers WHERE name = 'Strategy First Publisher : Strategy First Release Date : July 6'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 6'), '2006-07-06');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1620, (SELECT id FROM languages WHERE name = 'English Single-player Blood Strong Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1620, 'minimum', 'Configuration: Windows 95/98, Pentium 133 Mhz, 32 MB RAM minimum, 373 MB free hard drive space, Microsoft� compatible mouse, SVGA Graphics Adapter, DirectX compatible sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1620, 'website', 'http://www.jaggedalliance2.com/'),
(1620, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=253');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1620, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1620, 'Blood Strong Language Violence', 'enabled');

-- Disciples II: Rise of the Elves (App ID: 1630)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1630, 'Disciples II: Rise of the Elves', 80, 'http://www.metacritic.com/games/platforms/pc/disciples2riseoftheelves', 1630, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Strategy First Publisher : Strategy First Release Date : July 6');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Co-op Fantasy Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 6');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Co-op Fantasy Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1630, (SELECT id FROM developers WHERE name = 'Strategy First Publisher : Strategy First Release Date : July 6'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 6'), '2006-07-06');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1630, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Fantasy Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1630, 'minimum', 'Configuration: Windows 95/98/2000/XP, Pentium II 233 Mhz, 32 Mb RAM, 1200 MB hard disk space, DirectX 7.1, 16-bit sound card, Video Card with 8 MB RAM'),
(1630, 'recommended', 'Configuration: Windows 95/98/2000/XP, Pentium II 300 Mhz, 64 MB RAM, 1400 MB hard disk space, DirectX 7.1, 16-bit sound card, Video Card with 16 MB RAM');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1630, 'website', 'http://www.disciples2.com/D2/elves/'),
(1630, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=251');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1630, '0000000396.jpg', 0),
(1630, '0000000395.jpg', 1),
(1630, '0000000394.jpg', 2),
(1630, '0000000393.jpg', 3),
(1630, '0000000392.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1630, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1630, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1630, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1630, 'Fantasy Violence', 'enabled');

-- Disciples II: Galleans Return (App ID: 1640)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1640, 'Disciples II: Galleans Return', 84, 'http://www.metacritic.com/games/platforms/pc/disciples2darkprophecy', 1640, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Strategy First Publisher : Strategy First Release Date : July 6');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Co-op Fantasy Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 6');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Co-op Fantasy Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1640, (SELECT id FROM developers WHERE name = 'Strategy First Publisher : Strategy First Release Date : July 6'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 6'), '2006-07-06');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1640, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Fantasy Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1640, 'minimum', 'Configuration: Windows 95/98/2000/XP, Pentium II 233 Mhz, 32 Mb RAM, 1200 MB hard disk space, DirectX 7.1, 16-bit sound card, Video Card with 8 MB RAM'),
(1640, 'recommended', 'Configuration: Windows 95/98/2000/XP, Pentium II 300 Mhz, 64 MB RAM, 1400 MB hard disk space, DirectX 7.1, 16-bit sound card, Video Card with 16 MB RAM');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1640, 'website', 'http://www.disciples2.com/D2/elves/'),
(1640, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=251');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1640, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1640, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1640, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1640, 'Fantasy Violence', 'enabled');

-- Iron Warriors: T - 72 Tank Command (App ID: 1670)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1670, 'Iron Warriors: T - 72 Tank Command', 56, 'http://www.metacritic.com/games/platforms/pc/ironwarriorst72tankcommander', 1670, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Strategy First Publisher : Strategy First Release Date : July 26');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 26');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1670, (SELECT id FROM developers WHERE name = 'Strategy First Publisher : Strategy First Release Date : July 26'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 26'), '2006-07-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1670, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1670, 'minimum', 'System Requirements: Windows XP or Windows 2000, 1Ghz Athlon or Pentium III CPU, 256MB RAM; DirectX 9.0 Compatible Video Card (ex: Geforce 2/4MX or Radeon 7500), DirectX 9.0 Compatible Sound Card, 2 Gigabyte free space on Hard drive, DirectX 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1670, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=252'),
(1670, 'manual', 'index.php?area=manual&AppId=1670&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1670, '0000000463.jpg', 0),
(1670, '0000000442.jpg', 1),
(1670, '0000000441.jpg', 2),
(1670, '0000000439.jpg', 3),
(1670, '0000000438.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1670, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1670, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1670, 'Blood Violence', 'enabled');

-- Space Empires V (App ID: 1690)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1690, 'Space Empires V', 68, 'http://www.metacritic.com/games/platforms/pc/spaceempires5', 1690, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1690, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1690, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=257'),
(1690, 'manual', 'index.php?area=manual&AppId=1690&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1690, '0000000652.jpg', 0),
(1690, '0000000651.jpg', 1),
(1690, '0000000650.jpg', 2),
(1690, '0000000649.jpg', 3),
(1690, '0000000648.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1690, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1690, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1690, 'Mild Fantasy Violence', 'enabled');

-- Arx Fatalis (App ID: 1700)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1700, 'Arx Fatalis', 77, 'http://www.metacritic.com/games/platforms/pc/arxfatalis', 1700, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Arkane Studios Release Date : November 12');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1700, (SELECT id FROM developers WHERE name = 'Arkane Studios Release Date : November 12'), NULL, '2002-11-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1700, (SELECT id FROM languages WHERE name = 'English')),
(1700, (SELECT id FROM languages WHERE name = 'French')),
(1700, (SELECT id FROM languages WHERE name = 'German')),
(1700, (SELECT id FROM languages WHERE name = 'Italian')),
(1700, (SELECT id FROM languages WHERE name = 'Spanish')),
(1700, (SELECT id FROM languages WHERE name = 'Russian Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1700, 'minimum', 'Windows 98SE/ME/2000/XP, 500 MHz Pentium � III or compatible, 64 MB RAM , DirectX 8 or higher, DirectX 8 compatible sound- and graphics card with 16 MB, 750 MB fixed disks'),
(1700, 'recommended', '900 MHz Pentium � III or compatible, 256 MB RAM , DirectX 8 or higher, DirectX 8 compatible sound- and graphics card with 32MB, 750 MB fixed disks');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1700, 'website', 'index.php?area=game&AppId=1710&l=English&cc=US'),
(1700, 'website', 'http://www.arxfatalis-online.com/'),
(1700, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=170'),
(1700, 'manual', 'index.php?area=manual&AppId=1700&l=English');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1700, '0000000944.jpg', 0),
(1700, '0000000943.jpg', 1),
(1700, '0000000942.jpg', 2),
(1700, '0000000941.jpg', 3),
(1700, '0000000940.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1700, 'Single-player', 'enabled');

-- Arx Fatalis Demo (App ID: 1710)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1710, 'Arx Fatalis Demo', 77, 'http://www.metacritic.com/games/platforms/pc/arxfatalis', 1700, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Arkane Studios Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1710, (SELECT id FROM developers WHERE name = 'Arkane Studios Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1710, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1710, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=170');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1710, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1710, 'Game demo', 'enabled');

-- Earth 2160 (App ID: 1900)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1900, 'Earth 2160', 73, 'http://www.metacritic.com/games/platforms/pc/earth2160', 1900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Reality Pump Studios Publisher : Topware Interactive Release Date : April 1');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Topware Interactive Release Date : April 1');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1900, (SELECT id FROM developers WHERE name = 'Reality Pump Studios Publisher : Topware Interactive Release Date : April 1'), (SELECT id FROM publishers WHERE name = 'Topware Interactive Release Date : April 1'), '2006-04-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1900, (SELECT id FROM languages WHERE name = 'English')),
(1900, (SELECT id FROM languages WHERE name = 'French')),
(1900, (SELECT id FROM languages WHERE name = 'German')),
(1900, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(1900, 'minimum', 'PC with Pentium IV processor or equal AMD (1500+ processor), Windows 2000 or XP, 512 MB RAM, DirectX TM 8.1 compatible Video card with 128 MB RAM, DirectX compatible sound card, 1.5 GB free disk space'),
(1900, 'recommended', 'PC with Pentium IV processor or equal AMD (1500+ processor), Windows XP, 512 MB RAM, DirectX 9.0c compatible Video card with 256 MB RAM, DirectX TM compatible sound card, 2 GB free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1900, 'website', 'http://www.earth2160.com'),
(1900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=259');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1900, '0000000282.jpg', 0),
(1900, '0000000281.jpg', 1),
(1900, '0000000280.jpg', 2),
(1900, '0000000279.jpg', 3),
(1900, '0000000278.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1900, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1900, 'Multi-player', 'enabled');

-- Two Worlds (App ID: 1920)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (1920, 'Two Worlds', 66, 'http://www.metacritic.com/games/platforms/pc/twoworlds', 1920, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Reality Pump Studios Publisher : Topware Interactive Release Date : August 23');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Topware Interactive Release Date : August 23');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (1920, (SELECT id FROM developers WHERE name = 'Reality Pump Studios Publisher : Topware Interactive Release Date : August 23'), (SELECT id FROM publishers WHERE name = 'Topware Interactive Release Date : August 23'), '2007-08-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(1920, (SELECT id FROM languages WHERE name = 'English')),
(1920, (SELECT id FROM languages WHERE name = 'French')),
(1920, (SELECT id FROM languages WHERE name = 'German Single-player Multi-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(1920, 'website', 'http://www.2-worlds.com/'),
(1920, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=327'),
(1920, 'manual', 'index.php?area=manual&AppId=1920&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(1920, '0000002898.jpg', 0),
(1920, '0000002897.jpg', 1),
(1920, '0000002896.jpg', 2),
(1920, '0000002895.jpg', 3),
(1920, '0000002894.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1920, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (1920, 'Multi-player', 'enabled');

-- Dark Messiah Might and Magic (App ID: 2100)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2100, 'Dark Messiah Might and Magic', 72, 'http://www.metacritic.com/games/platforms/pc/darkmessiahofmightandmagic', 2100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Arkane Studios Publisher : Ubisoft Release Date : October 25');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Valve Anti-Cheat enabled Blood and Gore Intense Violence Language Partial Nudity');
INSERT IGNORE INTO publishers (name) VALUES ('Ubisoft Release Date : October 25');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Valve Anti-Cheat enabled Blood and Gore Intense Violence Language Partial Nudity');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2100, (SELECT id FROM developers WHERE name = 'Arkane Studios Publisher : Ubisoft Release Date : October 25'), (SELECT id FROM publishers WHERE name = 'Ubisoft Release Date : October 25'), '2006-10-25');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2100, (SELECT id FROM languages WHERE name = 'English')),
(2100, (SELECT id FROM languages WHERE name = 'French')),
(2100, (SELECT id FROM languages WHERE name = 'German')),
(2100, (SELECT id FROM languages WHERE name = 'Italian')),
(2100, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Valve Anti-Cheat enabled Blood and Gore Intense Violence Language Partial Nudity'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2100, 'minimum', 'AMD Athlon, Pentium� 2.4 GHz, 512MB RAM, 128MB video card, 7GB HDD Space, Windows XP, Mouse, Keyboard, Internet Connection'),
(2100, 'recommended', 'AMD Athlon, Pentium� 3.0 GHz, 256mb dx9 video card, 7GB HDD Space, Windows XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2100, 'website', 'index.php?area=game&AppId=935&cc=US'),
(2100, 'website', 'index.php?area=game&AppId=921&cc=US'),
(2100, 'website', 'index.php?area=game&AppId=920&cc=US'),
(2100, 'website', 'index.php?area=game&AppId=919&cc=US'),
(2100, 'website', 'index.php?area=game&AppId=2120&cc=US'),
(2100, 'website', 'http://www.darkmessiahmightandmagic.com'),
(2100, 'forum', 'http://forums.ubi.com/groupee/forums/a/frm/f/808101043'),
(2100, 'manual', 'index.php?area=manual&AppId=2100&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2100, '0000000757.jpg', 0),
(2100, '0000000614.jpg', 1),
(2100, '0000000607.jpg', 2),
(2100, '0000000606.jpg', 3),
(2100, '0000000604.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2100, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2100, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2100, 'Valve Anti-Cheat', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2100, 'Blood and Gore Intense Violence Language Partial Nudity', 'enabled');

-- Dark Messiah Singleplayer Demo (App ID: 2120)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2120, 'Dark Messiah Singleplayer Demo', 72, 'http://www.metacritic.com/games/platforms/pc/darkmessiahofmightandmagic', 2100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Arkane Studios Publisher : Ubisoft Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Portuguese');
INSERT IGNORE INTO developers (name) VALUES ('Russian');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Thai Single-player Game demo Blood and Gore Violence Language Partial Nudity');
INSERT IGNORE INTO publishers (name) VALUES ('Ubisoft Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese');
INSERT IGNORE INTO publishers (name) VALUES ('Korean');
INSERT IGNORE INTO publishers (name) VALUES ('Portuguese');
INSERT IGNORE INTO publishers (name) VALUES ('Russian');
INSERT IGNORE INTO publishers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Thai Single-player Game demo Blood and Gore Violence Language Partial Nudity');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2120, (SELECT id FROM developers WHERE name = 'Arkane Studios Publisher : Ubisoft Languages : English'), (SELECT id FROM publishers WHERE name = 'Ubisoft Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2120, (SELECT id FROM languages WHERE name = 'English')),
(2120, (SELECT id FROM languages WHERE name = 'French')),
(2120, (SELECT id FROM languages WHERE name = 'German')),
(2120, (SELECT id FROM languages WHERE name = 'Italian')),
(2120, (SELECT id FROM languages WHERE name = 'Japanese')),
(2120, (SELECT id FROM languages WHERE name = 'Korean')),
(2120, (SELECT id FROM languages WHERE name = 'Portuguese')),
(2120, (SELECT id FROM languages WHERE name = 'Russian')),
(2120, (SELECT id FROM languages WHERE name = 'Traditional Chinese')),
(2120, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(2120, (SELECT id FROM languages WHERE name = 'Spanish')),
(2120, (SELECT id FROM languages WHERE name = 'Thai Single-player Game demo Blood and Gore Violence Language Partial Nudity'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2120, 'minimum', 'AMD Athlon, Pentium� 2.4 GHz, 512MB RAM, 128MB video card, 3GB HDD Space, Windows XP, Mouse, Keyboard, Internet Connection'),
(2120, 'recommended', 'AMD Athlon, Pentium� 3.0 GHz, 1GB RAM, 256mb dx9 video card, 3GB HDD Space, Windows XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2120, 'website', 'http://www.darkmessiahmightandmagic.com'),
(2120, 'forum', 'http://forums.ubi.com/groupee/forums/a/frm/f/808101043');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2120, '0000000613.jpg', 0),
(2120, '0000000612.jpg', 1),
(2120, '0000000611.jpg', 2),
(2120, '0000000609.jpg', 3),
(2120, '0000000608.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2120, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2120, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2120, 'Blood and Gore Violence Language Partial Nudity', 'enabled');

-- Quake III Arena (App ID: 2200)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2200, 'Quake III Arena', 9080, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2200, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2200, 'website', 'index.php?area=game&AppId=9080&l=spanish&cc=US'),
(2200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=285');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2200, '0000000287.jpg', 0),
(2200, '0000000286.jpg', 1),
(2200, '0000000285.jpg', 2),
(2200, '0000000284.jpg', 3),
(2200, '0000000283.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2200, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2200, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2200, 'Animated Blood and Gore Animated Violence', 'enabled');

-- Wolfenstein 3D (App ID: 2270)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2270, 'Wolfenstein 3D', 2270, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : id Software Release Date : August 3');
INSERT IGNORE INTO developers (name) VALUES ('1994 Languages : English Single-player Animated Blood and Gore Animated Violence');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : August 3');
INSERT IGNORE INTO publishers (name) VALUES ('1994 Languages : English Single-player Animated Blood and Gore Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2270, (SELECT id FROM developers WHERE name = 'id Software Publisher : id Software Release Date : August 3'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : August 3'), '1994-08-03');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2270, (SELECT id FROM languages WHERE name = 'English Single-player Animated Blood and Gore Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2270, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2270, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=292');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2270, '0000002417.jpg', 0),
(2270, '0000002416.jpg', 1),
(2270, '0000002415.jpg', 2),
(2270, '0000002414.jpg', 3),
(2270, '0000002413.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2270, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2270, 'Animated Blood and Gore Animated Violence', 'enabled');

-- Ultimate DOOM (App ID: 2280)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2280, 'Ultimate DOOM', 2280, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : April 30');
INSERT IGNORE INTO developers (name) VALUES ('1995 Languages : English Single-player Blood Gore Animated Violence Realistic Blood');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2280, (SELECT id FROM developers WHERE name = 'id Software Release Date : April 30'), NULL, '1995-04-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2280, (SELECT id FROM languages WHERE name = 'English Single-player Blood Gore Animated Violence Realistic Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2280, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2280, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=293'),
(2280, 'manual', 'index.php?area=manual&AppId=2280&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2280, '0000002396.jpg', 0),
(2280, '0000002395.jpg', 1),
(2280, '0000002394.jpg', 2),
(2280, '0000002393.jpg', 3),
(2280, '0000002391.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2280, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2280, 'Blood Gore Animated Violence Realistic Blood', 'enabled');

-- Final DOOM (App ID: 2290)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2290, 'Final DOOM', 2290, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : id Software Release Date : June 17');
INSERT IGNORE INTO developers (name) VALUES ('1996 Languages : English Single-player Blood Gore Animated Violence');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : June 17');
INSERT IGNORE INTO publishers (name) VALUES ('1996 Languages : English Single-player Blood Gore Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2290, (SELECT id FROM developers WHERE name = 'id Software Publisher : id Software Release Date : June 17'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : June 17'), '1996-06-17');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2290, (SELECT id FROM languages WHERE name = 'English Single-player Blood Gore Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2290, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2290, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=294'),
(2290, 'manual', 'index.php?area=manual&AppId=2290&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2290, '0000002479.jpg', 0),
(2290, '0000002477.jpg', 1),
(2290, '0000002476.jpg', 2),
(2290, '0000002475.jpg', 3),
(2290, '0000002474.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2290, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2290, 'Blood Gore Animated Violence', 'enabled');

-- DOOM II (App ID: 2300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2300, 'DOOM II', 83, 'http://www.metacritic.com/games/platforms/pc/doom2', 2300, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : May 5');
INSERT IGNORE INTO developers (name) VALUES ('1994 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2300, (SELECT id FROM developers WHERE name = 'id Software Release Date : May 5'), NULL, '1994-05-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2300, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2300, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=277'),
(2300, 'manual', 'index.php?area=manual&AppId=2300&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2300, '0000002382.jpg', 0),
(2300, '0000002381.jpg', 1),
(2300, '0000002380.jpg', 2),
(2300, '0000002379.jpg', 3),
(2300, '0000002378.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2300, 'Multi-player', 'enabled');

-- QUAKE (App ID: 2310)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2310, 'QUAKE', 94, 'http://www.metacritic.com/games/platforms/pc/quake', 2310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : id Software Release Date : May 31');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Co-op');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : May 31');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Co-op');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2310, (SELECT id FROM developers WHERE name = 'id Software Publisher : id Software Release Date : May 31'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : May 31'), '2007-05-31');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2310, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2310, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2310, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=281'),
(2310, 'manual', 'index.php?area=manual&AppId=2310&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2310, '0000002450.jpg', 0),
(2310, '0000002449.jpg', 1),
(2310, '0000002448.jpg', 2),
(2310, '0000002447.jpg', 3),
(2310, '0000002446.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2310, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2310, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2310, 'Co-op', 'enabled');

-- QUAKE II (App ID: 2320)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2320, 'QUAKE II', 9130, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : November 11');
INSERT IGNORE INTO developers (name) VALUES ('1997 Languages : English Single-player Multi-player Blood Gore Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2320, (SELECT id FROM developers WHERE name = 'id Software Release Date : November 11'), NULL, '1997-11-11');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2320, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Gore Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2320, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2320, 'website', 'index.php?area=game&AppId=9130&cc=US'),
(2320, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=278'),
(2320, 'manual', 'index.php?area=manual&AppId=2320&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2320, '0000002454.jpg', 0),
(2320, '0000002453.jpg', 1),
(2320, '0000002452.jpg', 2),
(2320, '0000002451.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2320, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2320, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2320, 'Blood Gore Animated Violence', 'enabled');

-- QUAKE II Mission Pack: The Reckoning (App ID: 2330)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2330, 'QUAKE II Mission Pack: The Reckoning', 2330, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Xatrix Entertainment Release Date : May 31');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Single-player Multi-player Blood Gore Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2330, (SELECT id FROM developers WHERE name = 'Xatrix Entertainment Release Date : May 31'), NULL, '1998-05-31');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2330, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Gore Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2330, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2330, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=278'),
(2330, 'manual', 'index.php?area=manual&AppId=2330&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2330, '0000002462.jpg', 0),
(2330, '0000002461.jpg', 1),
(2330, '0000002460.jpg', 2),
(2330, '0000002459.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2330, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2330, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2330, 'Blood Gore Animated Violence', 'enabled');

-- QUAKE II Mission Pack: Ground Zero (App ID: 2340)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2340, 'QUAKE II Mission Pack: Ground Zero', 2340, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Rogue Entertainment Release Date : September 1');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Single-player Multi-player Blood Gore Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2340, (SELECT id FROM developers WHERE name = 'Rogue Entertainment Release Date : September 1'), NULL, '1998-09-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2340, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Gore Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2340, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2340, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=278');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2340, '0000002458.jpg', 0),
(2340, '0000002457.jpg', 1),
(2340, '0000002456.jpg', 2),
(2340, '0000002455.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2340, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2340, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2340, 'Blood Gore Animated Violence', 'enabled');

-- QUAKE III: Team Arena (App ID: 2350)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2350, 'QUAKE III: Team Arena', 69, 'http://www.metacritic.com/games/platforms/pc/quake3teamarena', 9090, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : December 19');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English Single-player Multi-player Realistic Violence Blood and Gore');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2350, (SELECT id FROM developers WHERE name = 'id Software Release Date : December 19'), NULL, '2000-12-19');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2350, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Realistic Violence Blood and Gore'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2350, 'website', 'index.php?area=game&AppId=9090&cc=US'),
(2350, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=282');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2350, '0000002464.jpg', 0),
(2350, '0000002463.jpg', 1);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2350, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2350, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2350, 'Realistic Violence Blood and Gore', 'enabled');

-- HeXen (App ID: 2360)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2360, 'HeXen', 2360, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Raven Software Publisher : id Software Release Date : October 1');
INSERT IGNORE INTO developers (name) VALUES ('1995 Languages : English Single-player Multi-player Animated Violence Animated Blood');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : October 1');
INSERT IGNORE INTO publishers (name) VALUES ('1995 Languages : English Single-player Multi-player Animated Violence Animated Blood');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2360, (SELECT id FROM developers WHERE name = 'Raven Software Publisher : id Software Release Date : October 1'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : October 1'), '1995-10-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2360, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Animated Violence Animated Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2360, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2360, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=287');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2360, '0000002431.jpg', 0),
(2360, '0000002430.jpg', 1),
(2360, '0000002429.jpg', 2),
(2360, '0000002428.jpg', 3),
(2360, '0000002427.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2360, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2360, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2360, 'Animated Violence Animated Blood', 'enabled');

-- HeXen: Deathkings of the Dark Citadel (App ID: 2370)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2370, 'HeXen: Deathkings of the Dark Citadel', 2370, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Raven Software Publisher : id Software Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('1996 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : January 1');
INSERT IGNORE INTO publishers (name) VALUES ('1996 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2370, (SELECT id FROM developers WHERE name = 'Raven Software Publisher : id Software Release Date : January 1'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : January 1'), '1996-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2370, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2370, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2370, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=289');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2370, '0000002507.jpg', 0),
(2370, '0000002506.jpg', 1),
(2370, '0000002505.jpg', 2),
(2370, '0000002504.jpg', 3),
(2370, '0000002503.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2370, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2370, 'Multi-player', 'enabled');

-- Heretic: Shadow of the Serpent Riders (App ID: 2390)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2390, 'Heretic: Shadow of the Serpent Riders', 2390, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Raven Software Publisher : id Software Release Date : August 3');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : August 3');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2390, (SELECT id FROM developers WHERE name = 'Raven Software Publisher : id Software Release Date : August 3'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : August 3'), '2007-08-03');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2390, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2390, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2390, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=286');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2390, '0000002445.jpg', 0),
(2390, '0000002444.jpg', 1),
(2390, '0000002443.jpg', 2),
(2390, '0000002442.jpg', 3),
(2390, '0000002441.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2390, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2390, 'Multi-player', 'enabled');

-- The Ship (App ID: 2400)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2400, 'The Ship', 76, 'http://www.metacritic.com/games/platforms/pc/ship', 2400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Outerlight Ltd. Release Date : July 11');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Russian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese Multi-player Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2400, (SELECT id FROM developers WHERE name = 'Outerlight Ltd. Release Date : July 11'), NULL, '2006-07-11');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2400, (SELECT id FROM languages WHERE name = 'English')),
(2400, (SELECT id FROM languages WHERE name = 'French')),
(2400, (SELECT id FROM languages WHERE name = 'German')),
(2400, (SELECT id FROM languages WHERE name = 'Italian')),
(2400, (SELECT id FROM languages WHERE name = 'Spanish')),
(2400, (SELECT id FROM languages WHERE name = 'Polish')),
(2400, (SELECT id FROM languages WHERE name = 'Russian')),
(2400, (SELECT id FROM languages WHERE name = 'Japanese Multi-player Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2400, 'minimum', '1.8 GHz Processor, 512MB RAM, DirectX 8 level graphics card (1024x768), Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection, DirectX 9.0c'),
(2400, 'recommended', '2.8 GHz Processor, 1024MB RAM, DirectX 9 capable Graphics Card (1024x768), Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection, DirectX 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2400, 'website', 'http://www.theshiponline.com/'),
(2400, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=76');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2400, '0000001286.jpg', 0),
(2400, '0000001285.jpg', 1),
(2400, '0000001284.jpg', 2),
(2400, '0000000412.jpg', 3),
(2400, '0000000411.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2400, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2400, 'Valve Anti-Cheat', 'enabled');

-- The Ship Single Player (App ID: 2420)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2420, 'The Ship Single Player', 76, 'http://www.metacritic.com/games/platforms/pc/ship', 2420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Outerlight Ltd. Release Date : November 20');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Russian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese Single-player HDR available');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2420, (SELECT id FROM developers WHERE name = 'Outerlight Ltd. Release Date : November 20'), NULL, '2006-11-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2420, (SELECT id FROM languages WHERE name = 'English')),
(2420, (SELECT id FROM languages WHERE name = 'French')),
(2420, (SELECT id FROM languages WHERE name = 'German')),
(2420, (SELECT id FROM languages WHERE name = 'Italian')),
(2420, (SELECT id FROM languages WHERE name = 'Spanish')),
(2420, (SELECT id FROM languages WHERE name = 'Polish')),
(2420, (SELECT id FROM languages WHERE name = 'Russian')),
(2420, (SELECT id FROM languages WHERE name = 'Japanese Single-player HDR available'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2420, 'minimum', '1.8 GHz Processor, 512MB RAM, DirectX 8 level graphics card (1024x768), Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection, DirectX 9.0c'),
(2420, 'recommended', '2.8 GHz Processor, 1024MB RAM, DirectX 9 capable Graphics Card (1024x768), Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection, DirectX 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2420, 'website', 'http://www.theshiponline.com/'),
(2420, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=76');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2420, '0000000949.jpg', 0),
(2420, '0000000948.jpg', 1),
(2420, '0000000947.jpg', 2),
(2420, '0000000946.jpg', 3),
(2420, '0000000945.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2420, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2420, 'HDR available', 'enabled');

-- Shadowgrounds (App ID: 2500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2500, 'Shadowgrounds', 74, 'http://www.metacritic.com/games/platforms/pc/shadowgrounds', 908, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frozenbyte Publisher : Meridian4 Release Date : May 8');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Co-op Blood and Gore Violence Language');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : May 8');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Co-op Blood and Gore Violence Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2500, (SELECT id FROM developers WHERE name = 'Frozenbyte Publisher : Meridian4 Release Date : May 8'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : May 8'), '2006-05-08');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2500, (SELECT id FROM languages WHERE name = 'English')),
(2500, (SELECT id FROM languages WHERE name = 'French')),
(2500, (SELECT id FROM languages WHERE name = 'German')),
(2500, (SELECT id FROM languages WHERE name = 'Spanish Single-player Co-op Blood and Gore Violence Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2500, 'minimum', '1.3 GHZ or Equivalent, 384 MB RAM, GeForce 4 Ti 4200* or ATi Radeon 9000 or better, 1 GB free hard drive space, Windows 2000/XP'),
(2500, 'recommended', '2.0 GHz, 512 MB RAM, GeForce FX 5900 Ultra or ATi Radeon 9500 Pro or better');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2500, 'website', 'index.php?area=game&AppId=2510&cc=US'),
(2500, 'website', 'http://www.shadowgroundsgame.com/'),
(2500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=67');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2500, '0000000297.jpg', 0),
(2500, '0000000296.jpg', 1),
(2500, '0000000295.jpg', 2),
(2500, '0000000294.jpg', 3),
(2500, '0000000293.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2500, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2500, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2500, 'Blood and Gore Violence Language', 'enabled');

-- Shadowgrounds Demo (App ID: 2510)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2510, 'Shadowgrounds Demo', 2500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frozenbyte Publisher : Meridian4 Languages : English Single-player Game demo Blood and Gore Violence Language');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Languages : English Single-player Game demo Blood and Gore Violence Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2510, (SELECT id FROM developers WHERE name = 'Frozenbyte Publisher : Meridian4 Languages : English Single-player Game demo Blood and Gore Violence Language'), (SELECT id FROM publishers WHERE name = 'Meridian4 Languages : English Single-player Game demo Blood and Gore Violence Language'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2510, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood and Gore Violence Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2510, 'minimum', '1.3 GHZ or Equivalent, 384 MB RAM, GeForce 4 Ti 4200* or ATi Radeon 9000 or better, 1 GB free hard drive space, Windows 2000/XP'),
(2510, 'recommended', '2.0 GHz, 512 MB RAM, GeForce FX 5900 Ultra or ATi Radeon 9500 Pro or better');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2510, 'website', 'http://shadowgroundsgame.com/'),
(2510, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=67');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2510, '0000000322.jpg', 0),
(2510, '0000000321.jpg', 1),
(2510, '0000000320.jpg', 2),
(2510, '0000000319.jpg', 3),
(2510, '0000000318.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2510, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2510, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2510, 'Blood and Gore Violence Language', 'enabled');

-- Gumboy - Crazy Adventures (App ID: 2520)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2520, 'Gumboy - Crazy Adventures', 69, 'http://www.metacritic.com/games/platforms/pc/gumboycrazyadventures', 2520, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cinemax Publisher : Meridian4 Release Date : December 19');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('Polish');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : December 19');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('Polish');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2520, (SELECT id FROM developers WHERE name = 'Cinemax Publisher : Meridian4 Release Date : December 19'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : December 19'), '2006-12-19');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2520, (SELECT id FROM languages WHERE name = 'English')),
(2520, (SELECT id FROM languages WHERE name = 'Polish')),
(2520, (SELECT id FROM languages WHERE name = 'Russian Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2520, 'minimum', 'Windows 2000/XP SP2, 1 GHz Processor, 256 MB System RAM, 32 MB OpenGL 3D Video Card, 50 MB Available hard disk space, DirectX 8.0 or higher'),
(2520, 'recommended', '1.6 GHz Processor, GeForce 5200 / Radeon 9600 or better video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2520, 'website', 'index.php?area=game&AppId=2535&cc=US'),
(2520, 'website', 'http://www.gumboycrazyadventures.com/'),
(2520, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=137'),
(2520, 'manual', 'index.php?area=manual&AppId=2520&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2520, '0000001034.jpg', 0),
(2520, '0000001033.jpg', 1),
(2520, '0000001032.jpg', 2),
(2520, '0000001031.jpg', 3),
(2520, '0000001030.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2520, 'Single-player', 'enabled');

-- Gumboy Demo (App ID: 2530)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2530, 'Gumboy Demo', 2520, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cinemax Publisher : Meridian4 Release Date : December 19');
INSERT IGNORE INTO developers (name) VALUES ('2006 Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : December 19');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2530, (SELECT id FROM developers WHERE name = 'Cinemax Publisher : Meridian4 Release Date : December 19'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : December 19'), '2006-12-19');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2530, 'minimum', 'Windows 2000/XP SP2, 1 GHz Processor, 256 MB System RAM, 32 MB OpenGL 3D Video Card, 50 MB Available hard disk space, DirectX 8.0 or higher'),
(2530, 'recommended', '1.6 GHz Processor, GeForce 5200 / Radeon 9600 or better video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2530, 'website', 'http://www.gumboycrazyadventures.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2530, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2530, 'Game demo', 'enabled');

-- Gumboy Demo (App ID: 2535)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2535, 'Gumboy Demo', 2520, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cinemax Publisher : Meridian4 Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2535, (SELECT id FROM developers WHERE name = 'Cinemax Publisher : Meridian4 Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Meridian4 Single-player Game demo'), NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2535, 'minimum', 'Windows 2000/XP SP2, 1 GHz Processor, 256 MB System RAM, 32 MB OpenGL 3D Video Card, 50 MB Available hard disk space, DirectX 8.0 or higher'),
(2535, 'recommended', '1.6 GHz Processor, GeForce 5200 / Radeon 9600 or better video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2535, 'website', 'http://www.gumboycrazyadventures.com/'),
(2535, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=137');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2535, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2535, 'Game demo', 'enabled');

-- RIP - Trilogy (App ID: 2540)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2540, 'RIP - Trilogy', 2540, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Elephant Games Publisher : Meridian4 Release Date : June 1');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Co-op Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : June 1');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Co-op Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2540, (SELECT id FROM developers WHERE name = 'Elephant Games Publisher : Meridian4 Release Date : June 1'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : June 1'), '2007-06-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2540, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2540, 'minimum', 'Windows XP/2000, 1 GHz Processor, 256 MB RAM, 128 MB 3D Video Card, DirectX 9.0c, 50 MB of available Hard Disk Space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2540, 'website', 'index.php?area=game&AppId=2560&cc=US'),
(2540, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=200'),
(2540, 'manual', 'index.php?area=manual&AppId=2540&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2540, '0000002034.jpg', 0),
(2540, '0000002033.jpg', 1),
(2540, '0000002032.jpg', 2),
(2540, '0000002031.jpg', 3),
(2540, '0000002030.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2540, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2540, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2540, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2540, 'Blood Violence', 'enabled');

-- RIP 3 Demo (App ID: 2560)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2560, 'RIP 3 Demo', 2540, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Elephant Games Publisher : Meridian4 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2560, (SELECT id FROM developers WHERE name = 'Elephant Games Publisher : Meridian4 Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Meridian4 Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2560, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2560, 'minimum', 'Windows Vista/XP/2000, 1 GHz Processor, 256 MB RAM, 128 MB 3D Video Card, DirectX 9.0c, 50 MB of available Hard Disk Space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2560, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=200');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2560, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2560, 'Game demo', 'enabled');

-- Vigil - Blood Bitterness (App ID: 2570)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2570, 'Vigil - Blood Bitterness', 2570, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Freegamer Publisher : Meridian4 Release Date : June 29');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : June 29');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2570, (SELECT id FROM developers WHERE name = 'Freegamer Publisher : Meridian4 Release Date : June 29'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : June 29'), '2007-06-29');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2570, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2570, 'website', 'index.php?area=game&AppId=2580&cc=US'),
(2570, 'website', 'http://www.freegamer.net/'),
(2570, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=263');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2570, '0000002252.jpg', 0),
(2570, '0000002251.jpg', 1),
(2570, '0000002250.jpg', 2),
(2570, '0000002249.jpg', 3),
(2570, '0000002248.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2570, 'Single-player', 'enabled');

-- Vigil - Blood Bitterness Demo (App ID: 2580)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2580, 'Vigil - Blood Bitterness Demo', 2570, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Freegamer Publisher : Meridian4 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2580, (SELECT id FROM developers WHERE name = 'Freegamer Publisher : Meridian4 Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Meridian4 Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2580, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2580, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2580, 'Game demo', 'enabled');

-- Alpha Prime (App ID: 2590)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2590, 'Alpha Prime', 60, 'http://www.metacritic.com/games/platforms/pc/alphaprime', 2590, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2590, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2590, 'website', 'index.php?area=game&AppId=11210&l=french&cc=US'),
(2590, 'website', 'http://www.alpha-prime.com/'),
(2590, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=328'),
(2590, 'manual', 'index.php?area=manual&AppId=2590&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2590, '0000002876.jpg', 0),
(2590, '0000002875.jpg', 1),
(2590, '0000002874.jpg', 2),
(2590, '0000002873.jpg', 3),
(2590, '0000002872.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2590, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2590, 'Violence Blood and Gore Strong Language', 'enabled');

-- Call of Duty (App ID: 2620)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2620, 'Call of Duty', 91, 'http://www.metacritic.com/games/platforms/pc/callofduty', 2620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Infinity Ward Publisher : Activision Release Date : October 29');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : October 29');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2620, (SELECT id FROM developers WHERE name = 'Infinity Ward Publisher : Activision Release Date : October 29'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : October 29'), '2003-10-29');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2620, (SELECT id FROM languages WHERE name = 'English')),
(2620, (SELECT id FROM languages WHERE name = 'French')),
(2620, (SELECT id FROM languages WHERE name = 'German')),
(2620, (SELECT id FROM languages WHERE name = 'Italian Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2620, 'minimum', '3D hardware accelerator card required - 100% DirectX 9.0b compatible 32MB hardware T&L-capable video card and latest drivers*, Microsoft Windows 98/ME/2000/XP, Pentium III 600MHz or Athlon 600MHz processor or higher for systems with Windows 98/ME, Pentium III 700MHz or Athlon 700MHz processor or higher for systems with Windows 2000/XP, 128MB RAM, 1.4GB of uncompressed free hard disk space (plus 400MB for Windows 98/ME swap file, 600MB for Windows 2000/XP swap file), 100% DirectX 9.0b compatible 16-bit sound card and latest drivers, 100% Windows 98/ME/2000/XP compatible mouse, keyboard and latest drivers, DirectX 9.0b (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2620, 'website', 'http://www.callofduty.com/'),
(2620, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=226'),
(2620, 'manual', 'index.php?area=manual&AppId=2620&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2620, '0000000690.jpg', 0),
(2620, '0000000689.jpg', 1),
(2620, '0000000688.jpg', 2),
(2620, '0000000687.jpg', 3),
(2620, '0000000686.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2620, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2620, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2620, 'Blood Violence', 'enabled');

-- Call of Duty� 2 (App ID: 2630)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2630, 'Call of Duty� 2', 86, 'http://www.metacritic.com/games/platforms/pc/callofduty2', 2630, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Infinity Ward Publisher : Activision Release Date : October 25');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Mild Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : October 25');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Mild Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2630, (SELECT id FROM developers WHERE name = 'Infinity Ward Publisher : Activision Release Date : October 25'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : October 25'), '2005-10-25');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2630, (SELECT id FROM languages WHERE name = 'English')),
(2630, (SELECT id FROM languages WHERE name = 'French')),
(2630, (SELECT id FROM languages WHERE name = 'German')),
(2630, (SELECT id FROM languages WHERE name = 'Italian')),
(2630, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Mild Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2630, 'minimum', '3D hardware accelerator card required - 100% DirectX 9.0c compatible 64MB hardware accelerator video card and the latest drivers*, Microsoft Windows 2000/XP, Pentium IV 1.4GHz or AMD Athlon XP 1700+ processor or higher, 256MB RAM (512MB RAM recommended), 100% DirectX 9.0c compatible 16-bit sound card and latest drivers, 100% Windows 2000/XP compatible mouse, keyboard and latest drivers, 4.0GB of uncompressed free hard disk space (plus 600MB for Windows 2000/XP swap file)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2630, 'website', 'http://www.callofduty.com/'),
(2630, 'manual', 'index.php?area=manual&AppId=2630&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2630, '0000000696.jpg', 0),
(2630, '0000000695.jpg', 1),
(2630, '0000000694.jpg', 2),
(2630, '0000000693.jpg', 3),
(2630, '0000000692.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2630, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2630, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2630, 'Blood Mild Language Violence', 'enabled');

-- Call of Duty: United Offensive (App ID: 2640)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2640, 'Call of Duty: United Offensive', 87, 'http://www.metacritic.com/games/platforms/pc/callofdutyunitedoffensive', 2620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Gray Matter Studios Publisher : Activision Release Date : September 15');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Italian Single-player Multi-player Blood Mild Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : September 15');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Italian Single-player Multi-player Blood Mild Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2640, (SELECT id FROM developers WHERE name = 'Gray Matter Studios Publisher : Activision Release Date : September 15'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : September 15'), '2004-09-15');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2640, (SELECT id FROM languages WHERE name = 'English')),
(2640, (SELECT id FROM languages WHERE name = 'French')),
(2640, (SELECT id FROM languages WHERE name = 'Italian Single-player Multi-player Blood Mild Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2640, 'minimum', 'Full Version of original Call of Duty, 3D hardware accelerator card required - 100% DirectX 9.0c compatible 32MB hardware T&L-capable video card and the latest drivers*, Microsoft Windows 2000/XP, Pentium III 800MHz or Athlon 800MHz processor or higher, 128MB RAM (256MB Recommended), 1150MB of uncompressed free hard disk space (plus 600MB for Windows 2000/XP swap file), 100% DirectX 9.0c compatible 16-bit sound card and latest drivers, 100% Windows 2000/XP compatible mouse, keyboard and latest drivers, DirectX 9.0c (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2640, 'website', 'http://www.callofduty.com/'),
(2640, 'manual', 'index.php?area=manual&AppId=2640&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2640, '0000000701.jpg', 0),
(2640, '0000000700.jpg', 1),
(2640, '0000000699.jpg', 2),
(2640, '0000000698.jpg', 3),
(2640, '0000000697.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2640, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2640, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2640, 'Blood Mild Language Violence', 'enabled');

-- The History Channel�: Civil War (App ID: 2680)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2680, 'The History Channel�: Civil War', 2680, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cauldron Publisher : Activision Value Release Date : November 14');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Value Release Date : November 14');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2680, (SELECT id FROM developers WHERE name = 'Cauldron Publisher : Activision Value Release Date : November 14'), (SELECT id FROM publishers WHERE name = 'Activision Value Release Date : November 14'), '2006-11-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2680, (SELECT id FROM languages WHERE name = 'English Single-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2680, 'minimum', 'Windows(R) 98SE/2000/XP/ME * , Pentium™ 111 1.0 GHz, 256 MB RAM, 64MB DirectX(R) 9.0c Compatible 3D accelerated video card with pixel/vertex shaders, DirectX(R) 9.c (INCLUDED), Mouse and Keyboard, 2.3GB uncompressed Hard Drive Space, DirectX(R) 9.0c Compatible Sound Card'),
(2680, 'recommended', 'PentiumTM 4 2.5 GHz, 512 MB RAM, 256MB DirectX(R) 9.0c Compatible 3D accelerated video card with pixel/vertex shaders. ATI(R) Radeon Nvidia(R) GEForce preferred');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2680, 'website', 'http://www.activisionvalue.com/titles/CivilWar'),
(2680, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=228'),
(2680, 'manual', 'index.php?area=manual&AppId=2680&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2680, '0000001747.jpg', 0),
(2680, '0000001746.jpg', 1),
(2680, '0000001745.jpg', 2),
(2680, '0000001744.jpg', 3),
(2680, '0000001743.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2680, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2680, 'Blood Violence', 'enabled');

-- Empires: Dawn of the Modern World (App ID: 2690)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2690, 'Empires: Dawn of the Modern World', 81, 'http://www.metacritic.com/games/platforms/pc/empiresdawnofthemodernworld', 2690, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Stainless Steel Studios Publisher : Activision Release Date : October 21');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : October 21');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2690, (SELECT id FROM developers WHERE name = 'Stainless Steel Studios Publisher : Activision Release Date : October 21'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : October 21'), '2003-10-21');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2690, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2690, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2690, 'manual', 'index.php?area=manual&AppId=2690&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2690, '0000002527.jpg', 0),
(2690, '0000002526.jpg', 1),
(2690, '0000002525.jpg', 2),
(2690, '0000002524.jpg', 3),
(2690, '0000002523.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2690, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2690, 'Multi-player', 'enabled');

-- RollerCoaster Tycoon� 3: Platinum (App ID: 2700)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2700, 'RollerCoaster Tycoon� 3: Platinum', 81, 'http://www.metacritic.com/games/platforms/pc/rollercoastertycoon3', 2700, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frontier Publisher : Atari Release Date : October 26');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : October 26');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2700, (SELECT id FROM developers WHERE name = 'Frontier Publisher : Atari Release Date : October 26'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : October 26'), '2006-10-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2700, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2700, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2700, 'website', 'http://www.atari.com/rollercoastertycoon/us/index.php'),
(2700, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=372');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2700, '0000002706.jpg', 0),
(2700, '0000002705.jpg', 1),
(2700, '0000002704.jpg', 2),
(2700, '0000002703.jpg', 3),
(2700, '0000002702.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2700, 'Single-player', 'enabled');

-- Act of War: Direct Action (App ID: 2710)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2710, 'Act of War: Direct Action', 82, 'http://www.metacritic.com/games/platforms/pc/actofwardirectaction', 2710, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Eugen Systems Publisher : Atari Release Date : March 14');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Multi-player Blood Violence Language');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : March 14');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Single-player Multi-player Blood Violence Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2710, (SELECT id FROM developers WHERE name = 'Eugen Systems Publisher : Atari Release Date : March 14'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : March 14'), '2005-03-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2710, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Violence Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2710, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2710, 'website', 'http://www.atari.com/actofwar'),
(2710, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=369'),
(2710, 'manual', 'index.php?area=manual&AppId=2710&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2710, '0000003457.jpg', 0),
(2710, '0000003456.jpg', 1),
(2710, '0000003455.jpg', 2),
(2710, '0000003454.jpg', 3),
(2710, '0000003453.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2710, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2710, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2710, 'Blood Violence Language', 'enabled');

-- ThreadSpace: Hyperbol (App ID: 2720)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2720, 'ThreadSpace: Hyperbol', 2720, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Iocaine Studios Publisher : Atari');
INSERT IGNORE INTO developers (name) VALUES ('Inc Release Date : July 12');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Includes level editor');
INSERT IGNORE INTO publishers (name) VALUES ('Atari');
INSERT IGNORE INTO publishers (name) VALUES ('Inc Release Date : July 12');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Includes level editor');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2720, (SELECT id FROM developers WHERE name = 'Iocaine Studios Publisher : Atari'), (SELECT id FROM publishers WHERE name = 'Atari'), '2007-07-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2720, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Includes level editor'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2720, 'minimum', 'Windows 2000/XP/Vista, DirectX9.0c or higher, Graphics Accelerator with 32-bit color support (DirectX9-Supported Accelerator recommended), 1.0GHz or faster processor, 256MB of RAM, 400MB of hard disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2720, 'website', 'index.php?area=game&AppId=2730&cc=US'),
(2720, 'website', 'http://www.Hyperbol.com'),
(2720, 'manual', 'index.php?area=manual&AppId=2720&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2720, '0000002198.jpg', 0),
(2720, '0000002197.jpg', 1),
(2720, '0000002196.jpg', 2),
(2720, '0000002195.jpg', 3),
(2720, '0000002194.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2720, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2720, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2720, 'Includes level editor', 'enabled');

-- ThreadSpace: Hyperbol Demo (App ID: 2730)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2730, 'ThreadSpace: Hyperbol Demo', 2720, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Iocaine Studios Publisher : Atari');
INSERT IGNORE INTO developers (name) VALUES ('Inc Languages : English Single-player Multi-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Atari');
INSERT IGNORE INTO publishers (name) VALUES ('Inc Languages : English Single-player Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2730, (SELECT id FROM developers WHERE name = 'Iocaine Studios Publisher : Atari'), (SELECT id FROM publishers WHERE name = 'Atari'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2730, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2730, 'minimum', 'Windows 2000/XP/Vista, DirectX9.0c or higher, Graphics Accelerator with 32-bit color support (DirectX9-Supported Accelerator recommended), 1.0GHz or faster processor, 256MB of RAM, 400MB of hard disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2730, 'website', 'http://www.Hyperbol.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2730, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2730, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2730, 'Game demo', 'enabled');

-- ArmA: Combat Operations (App ID: 2780)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2780, 'ArmA: Combat Operations', 74, 'http://www.metacritic.com/games/platforms/pc/armedassault', 2780, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Bohemia Interactive Publisher : Atari Release Date : May 8');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Multi-player Includes level editor Blood Strong Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : May 8');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Multi-player Includes level editor Blood Strong Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2780, (SELECT id FROM developers WHERE name = 'Bohemia Interactive Publisher : Atari Release Date : May 8'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : May 8'), '2007-05-08');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2780, (SELECT id FROM languages WHERE name = 'English Multi-player Includes level editor Blood Strong Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2780, 'minimum', ':'),
(2780, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2780, 'website', 'http://www.armedassault.com'),
(2780, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=368'),
(2780, 'manual', 'index.php?area=manual&AppId=2780&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2780, '0000002725.jpg', 0),
(2780, '0000002724.jpg', 1),
(2780, '0000002723.jpg', 2),
(2780, '0000002722.jpg', 3),
(2780, '0000002721.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2780, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2780, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2780, 'Blood Strong Language Violence', 'enabled');

-- Atari 80 Classics in One (App ID: 2790)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2790, 'Atari 80 Classics in One', 70, 'http://www.metacritic.com/games/platforms/pc/atari80classicgamesinone', 2790, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Atari Publisher : Atari Release Date : November 11');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Single-player Multi-player Gambling');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : November 11');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Single-player Multi-player Gambling');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2790, (SELECT id FROM developers WHERE name = 'Atari Publisher : Atari Release Date : November 11'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : November 11'), '2003-11-11');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2790, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Gambling'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2790, 'minimum', ':');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2790, '0000002792.jpg', 0),
(2790, '0000002791.jpg', 1),
(2790, '0000002790.jpg', 2),
(2790, '0000002789.jpg', 3),
(2790, '0000002788.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2790, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2790, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2790, 'Gambling', 'enabled');

-- X2: The Threat (App ID: 2800)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2800, 'X2: The Threat', 72, 'http://www.metacritic.com/games/platforms/pc/x2thethreat', 2800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Egosoft Release Date : July 21');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Use of Alcohol Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2800, (SELECT id FROM developers WHERE name = 'Egosoft Release Date : July 21'), NULL, '2006-07-21');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2800, (SELECT id FROM languages WHERE name = 'English Single-player Blood Use of Alcohol Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2800, 'website', 'http://www.enlight.com/x2/'),
(2800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=83'),
(2800, 'manual', 'index.php?area=manual&AppId=2800&l=english'),
(2800, 'website', 'index.php?area=quickref&AppId=2800&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2800, '0000000401.jpg', 0),
(2800, '0000000400.jpg', 1),
(2800, '0000000399.jpg', 2),
(2800, '0000000398.jpg', 3),
(2800, '0000000397.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2800, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2800, 'Blood Use of Alcohol Violence', 'enabled');

-- X3: Reunion (App ID: 2810)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2810, 'X3: Reunion', 71, 'http://www.metacritic.com/games/platforms/pc/x3reunion', 2810, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2810, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2810, 'website', 'index.php?area=game&AppId=939&l=french&cc=US'),
(2810, 'website', 'http://www.egosoft.com/games/x3/info_en.php'),
(2810, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=83'),
(2810, 'manual', 'index.php?area=manual&AppId=2810&l=french'),
(2810, 'website', 'index.php?area=quickref&AppId=2810&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2810, '0000000966.jpg', 0),
(2810, '0000000965.jpg', 1),
(2810, '0000000964.jpg', 2),
(2810, '0000000883.jpg', 3),
(2810, '0000000882.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2810, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2810, 'Drug Reference Mild Fantasy Violence', 'enabled');

-- 688(I) Hunter-Killer (App ID: 2900)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2900, '688(I) Hunter-Killer', 2900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sonalysts Publisher : Strategy First Release Date : July 4');
INSERT IGNORE INTO developers (name) VALUES ('1997 Single-player Multi-player Violence Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 4');
INSERT IGNORE INTO publishers (name) VALUES ('1997 Single-player Multi-player Violence Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2900, (SELECT id FROM developers WHERE name = 'Sonalysts Publisher : Strategy First Release Date : July 4'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 4'), '1997-07-04');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2900, 'recommended', 'Windows 2000/XP, Pentium III, 256MB RAM, 1.5G Hard drive space, 32MB video card (Nvidia Geforce or ATI Radeon) DirectX 8.1 compatible sound card');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2900, '0000000802.jpg', 0),
(2900, '0000000801.jpg', 1),
(2900, '0000000800.jpg', 2),
(2900, '0000000799.jpg', 3),
(2900, '0000000798.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2900, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2900, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2900, 'Violence Mild Violence', 'enabled');

-- Fleet Command (App ID: 2910)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2910, 'Fleet Command', 2910, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sonalysts Publisher : Strategy First Release Date : May 15');
INSERT IGNORE INTO developers (name) VALUES ('1999 Single-player Violence Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : May 15');
INSERT IGNORE INTO publishers (name) VALUES ('1999 Single-player Violence Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2910, (SELECT id FROM developers WHERE name = 'Sonalysts Publisher : Strategy First Release Date : May 15'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : May 15'), '1999-05-15');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2910, 'recommended', 'Windows 2000/XP, Pentium III, 256MB RAM, 1.5G Hard drive space, 32MB video card (Nvidia Geforce or ATI Radeon) DirectX 8.1 compatible sound card');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2910, '0000000813.jpg', 0),
(2910, '0000000812.jpg', 1),
(2910, '0000000811.jpg', 2),
(2910, '0000000810.jpg', 3),
(2910, '0000000809.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2910, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2910, 'Violence Mild Violence', 'enabled');

-- Sub Command (App ID: 2920)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2920, 'Sub Command', 84, 'http://www.metacritic.com/games/platforms/pc/subcommand', 2920, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sonalysts Publisher : Strategy First Release Date : October 1');
INSERT IGNORE INTO developers (name) VALUES ('2001 Single-player Violence Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : October 1');
INSERT IGNORE INTO publishers (name) VALUES ('2001 Single-player Violence Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2920, (SELECT id FROM developers WHERE name = 'Sonalysts Publisher : Strategy First Release Date : October 1'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : October 1'), '2001-10-01');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2920, 'recommended', 'Windows 2000/XP, Pentium III, 256MB RAM, 1.5G Hard drive space, 32MB video card (Nvidia Geforce or ATI Radeon) DirectX 8.1 compatible sound card');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2920, '0000000820.jpg', 0),
(2920, '0000000819.jpg', 1),
(2920, '0000000818.jpg', 2),
(2920, '0000000817.jpg', 3),
(2920, '0000000816.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2920, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2920, 'Violence Mild Violence', 'enabled');

-- Birth Of America (App ID: 2930)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2930, 'Birth Of America', 71, 'http://www.metacritic.com/games/platforms/pc/birthofamerica', 2930, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Strategy First Publisher : Strategy First Release Date : July 26');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : July 26');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2930, (SELECT id FROM developers WHERE name = 'Strategy First Publisher : Strategy First Release Date : July 26'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : July 26'), '2006-07-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(2930, (SELECT id FROM languages WHERE name = 'English Single-player Mild Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(2930, 'minimum', 'System Requirements: Windows 2000/XP � Intel Pentium III or AMD Athlon, 1200 MHz, 384 MB RAM � 64MB video card, compatible DirectX 8.1 � 1 GB free HD space for installation'),
(2930, 'recommended', 'System Requirements: Windows XP � Intel Pentium IV or AMD Athlon, 1800 MHz � 768 MB RAM � 128 MB video card, compatible DirectX 8.1 � 2 GB free HD space for installation');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2930, 'website', 'http://www.birth-of-america.com/'),
(2930, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=249');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2930, '0000000437.jpg', 0),
(2930, '0000000436.jpg', 1),
(2930, '0000000435.jpg', 2),
(2930, '0000000434.jpg', 3),
(2930, '0000000433.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2930, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2930, 'Mild Violence', 'enabled');

-- FlatOut 2 (App ID: 2990)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (2990, 'FlatOut 2', 76, 'http://www.metacritic.com/games/platforms/pc/flatout2', 2990, '', 'header.jpg');

INSERT IGNORE INTO publishers (name) VALUES ('Empire Interactive Erschienen am : August 1');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Sprachen : Englisch');
INSERT IGNORE INTO publishers (name) VALUES ('Französisch');
INSERT IGNORE INTO publishers (name) VALUES ('Deutsch');
INSERT IGNORE INTO publishers (name) VALUES ('Italienisch');
INSERT IGNORE INTO publishers (name) VALUES ('Spanisch');
INSERT IGNORE INTO publishers (name) VALUES ('Niederländisch Einzelspieler Mehrspieler Mild Lyrics Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (2990, NULL, (SELECT id FROM publishers WHERE name = 'Empire Interactive Erschienen am : August 1'), NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(2990, 'website', 'http://www.FlatOutGame.com'),
(2990, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=254'),
(2990, 'manual', 'index.php?area=manual&AppId=2990&l=german');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(2990, '0000001064.jpg', 0),
(2990, '0000001063.jpg', 1),
(2990, '0000001062.jpg', 2),
(2990, '0000001061.jpg', 3),
(2990, '0000001060.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2990, 'Einzelspieler', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2990, 'Mehrspieler', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (2990, 'Mild Lyrics Violence', 'enabled');

-- GTI Racing (App ID: 3000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3000, 'GTI Racing', 927, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Techland Publisher : Topware Interactive Release Date : August 24');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Topware Interactive Release Date : August 24');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3000, (SELECT id FROM developers WHERE name = 'Techland Publisher : Topware Interactive Release Date : August 24'), (SELECT id FROM publishers WHERE name = 'Topware Interactive Release Date : August 24'), '2006-08-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3000, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3000, 'minimum', 'System Requirements: Windows 98/ME/2000/XP, P IV/AMD Athlon processor with 1.8 GHz, 256 MB RAM, Video card with 64 MB, DX 8.0 compatible (GeForce 3 or ATI Radeon 9200)*, Sound card DX 8.0 compatible, 2,5 GB of free space on hard drive, DirectX 9.0c, 56k Modem (for Internet multiplayer mode)'),
(3000, 'recommended', 'System Requirements: Windows 98/ME/2000/XP, P IV/AMD Athlon processor with 2.5 GHz, 512 MB RAM, Video card with 128 MB, DX 9.0 compatible (GeForce 5700 or ATI Radeon 9600)*, Sound card DX 8.0 compatible, 2,5 GB of free space on hard drive, DirectX 9.0c, ISDN Internet connection (for Internet multiplayer mode)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3000, 'website', 'http://www.gtiracingthegame.com'),
(3000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=260');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3000, '0000000468.jpg', 0),
(3000, '0000000467.jpg', 1),
(3000, '0000000466.jpg', 2),
(3000, '0000000465.jpg', 3),
(3000, '0000000464.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3000, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3000, 'Multi-player', 'enabled');

-- Xpand Rally (App ID: 3010)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3010, 'Xpand Rally', 82, 'http://www.metacritic.com/games/platforms/pc/xpandrally', 3010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Techland Publisher : Topware Interactive Release Date : August 24');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Topware Interactive Release Date : August 24');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3010, (SELECT id FROM developers WHERE name = 'Techland Publisher : Topware Interactive Release Date : August 24'), (SELECT id FROM publishers WHERE name = 'Topware Interactive Release Date : August 24'), '2006-08-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3010, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3010, 'minimum', 'System Requirements: Windows 98/ME/2000/XP, P III/AMD Athlon processor with 1.3 GHz, 256 MB RAM, Video card with, 64 MB, DX 8.0 compatible (GeForce 3 or ATI Radeon 9200), Sound card DX 8.0 compatible, 1 GB of free space on hard drive, DirectX 9.0c, 56k Modem (for Internet multiplayer mode)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3010, 'website', 'http://www.xpandrally.com'),
(3010, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=261');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3010, '0000001255.jpg', 0),
(3010, '0000001254.jpg', 1),
(3010, '0000001253.jpg', 2),
(3010, '0000000485.jpg', 3),
(3010, '0000000484.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3010, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3010, 'Multi-player', 'enabled');

-- Painkiller Gold Edition (App ID: 3200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3200, 'Painkiller Gold Edition', 81, 'http://www.metacritic.com/games/platforms/pc/painkiller', 3200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('People Can Fly Publisher : Dreamcatcher Interactive Release Date : April 12');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Single-player Multi-player Blood and Gore Intense Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Dreamcatcher Interactive Release Date : April 12');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Single-player Multi-player Blood and Gore Intense Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3200, (SELECT id FROM developers WHERE name = 'People Can Fly Publisher : Dreamcatcher Interactive Release Date : April 12'), (SELECT id FROM publishers WHERE name = 'Dreamcatcher Interactive Release Date : April 12'), '2004-04-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3200, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood and Gore Intense Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3200, 'minimum', 'Requirements: Win 98/2000/Me/XP, 1GHz Processor, 256MB RAM, DirextX 9.0 64MB Video Card, 3.4GB HDD Space'),
(3200, 'recommended', 'Requirements: 3GHz Processor, 512MB RAM, 128MB Video Card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3200, 'website', 'index.php?area=game&AppId=3210&cc=US'),
(3200, 'website', 'http://www.painkillergame.com'),
(3200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=146'),
(3200, 'manual', 'index.php?area=manual&AppId=3200&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3200, '0000000880.jpg', 0),
(3200, '0000000879.jpg', 1),
(3200, '0000000878.jpg', 2),
(3200, '0000000877.jpg', 3),
(3200, '0000000876.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3200, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3200, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3200, 'Blood and Gore Intense Violence', 'enabled');

-- Painkiller Demo (App ID: 3210)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3210, 'Painkiller Demo', 81, 'http://www.metacritic.com/games/platforms/pc/painkiller', 3200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('People Can Fly Publisher : DreamCatcher Games Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('DreamCatcher Games Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3210, (SELECT id FROM developers WHERE name = 'People Can Fly Publisher : DreamCatcher Games Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'DreamCatcher Games Single-player Game demo'), NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3210, 'minimum', 'Requirements: Win 98/2000/Me/XP, 1GHz Processor, 256MB RAM, DirextX 9.0 64MB Video Card, 3.4GB HDD Space'),
(3210, 'recommended', 'Requirements: 3GHz Processor, 512MB RAM, 128MB Video Card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3210, 'website', 'http://www.painkillergame.com'),
(3210, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=146');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3210, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3210, 'Game demo', 'enabled');

-- SpaceForce Rogue Universe (App ID: 3220)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3220, 'SpaceForce Rogue Universe', 62, 'http://www.metacritic.com/games/platforms/pc/spaceforcerogueuniverse', 3220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Provox Games Publisher : DreamCatcher Games Release Date : June 5');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Drug Reference Fantasy Violence Mild Language');
INSERT IGNORE INTO publishers (name) VALUES ('DreamCatcher Games Release Date : June 5');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Drug Reference Fantasy Violence Mild Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3220, (SELECT id FROM developers WHERE name = 'Provox Games Publisher : DreamCatcher Games Release Date : June 5'), (SELECT id FROM publishers WHERE name = 'DreamCatcher Games Release Date : June 5'), '2007-06-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3220, (SELECT id FROM languages WHERE name = 'English Single-player Drug Reference Fantasy Violence Mild Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3220, 'minimum', 'Windows 2000/XP/Vista, 2.0 GHz Intel Pentium 4 or equivalent/ faster processor, 768 MB of RAM, 3 GB of hard disk space, DirectX 9.0c or higher, DirectX 9 compatible video card (Radeon 9500, GeForce 5800), 16-bit sound card, mouse, keyboard, speakers'),
(3220, 'recommended', 'Windows 2000/XP/ Vista, 2.6 GHz Intel Pentium 4 or equivalent/faster, 1 GB RAM, 3 GB of hard drive space, DirectX 9 compatible video card (Radeon x800, GeForce 6800), DirectX 9.0c, 3D compatible sound card, mouse, keyboard, 5.1 speakers');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3220, 'website', 'http://www.spaceforce2.com'),
(3220, 'manual', 'index.php?area=manual&AppId=3220&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3220, '0000002298.jpg', 0),
(3220, '0000002297.jpg', 1),
(3220, '0000002296.jpg', 2),
(3220, '0000002295.jpg', 3),
(3220, '0000002294.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3220, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3220, 'Drug Reference Fantasy Violence Mild Language', 'enabled');

-- Genesis Rising (App ID: 3230)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3230, 'Genesis Rising', 57, 'http://www.metacritic.com/games/platforms/pc/genesisrisingtheuniversalcrusade', 3230, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Metamorf Publisher : DreamCatcher Games Release Date : March 20');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Blood Fantasy Violence Mild Suggestive Themes Use of Alcohol');
INSERT IGNORE INTO publishers (name) VALUES ('DreamCatcher Games Release Date : March 20');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Blood Fantasy Violence Mild Suggestive Themes Use of Alcohol');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3230, (SELECT id FROM developers WHERE name = 'Metamorf Publisher : DreamCatcher Games Release Date : March 20'), (SELECT id FROM publishers WHERE name = 'DreamCatcher Games Release Date : March 20'), '2007-03-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3230, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Fantasy Violence Mild Suggestive Themes Use of Alcohol'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3230, 'minimum', 'Windows 2000/XP/XP 64/Vista, 1.5 GHz Intel or equivalent/faster processor, 512 MB of RAM, 2.5 GB of hard disk space, DirectX9.0c or higher, 128 MB GeForce 4 4200 Ti/Radeon 9500, DirectSound compatible sound card, Keyboard and two-button mouse with scroll wheel, Multiplayer: LAN or 56K Internet connection'),
(3230, 'recommended', 'Windows 2000/XP/XP 64/Vista, 2.5 GHz Intel or equivalent/faster, 1 GB RAM, 2.5 GB of free hard drive space, 256 MB GeForce 6600/Radeon X1600, DirectX 9.0c, DirectSound compatible sound card with 5.1 speaker output, Keyboard and two-button mouse with scroll wheel');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3230, 'website', 'http://www.GenesisRisingGame.com'),
(3230, 'manual', 'index.php?area=manual&AppId=3230&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3230, '0000002303.jpg', 0),
(3230, '0000002302.jpg', 1),
(3230, '0000002301.jpg', 2),
(3230, '0000002300.jpg', 3),
(3230, '0000002299.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3230, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3230, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3230, 'Blood Fantasy Violence Mild Suggestive Themes Use of Alcohol', 'enabled');

-- Painkiller Overdose (App ID: 3270)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3270, 'Painkiller Overdose', 66, 'http://www.metacritic.com/games/platforms/pc/painkilleroverdose', 3270, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Mindware Studios Publisher : Dreamcatcher Interactive Release Date : October 30');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Dreamcatcher Interactive Release Date : October 30');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3270, (SELECT id FROM developers WHERE name = 'Mindware Studios Publisher : Dreamcatcher Interactive Release Date : October 30'), (SELECT id FROM publishers WHERE name = 'Dreamcatcher Interactive Release Date : October 30'), '2007-10-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3270, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3270, 'website', 'index.php?area=game&AppId=999&cc=US'),
(3270, 'website', 'index.php?area=game&AppId=3280&cc=US'),
(3270, 'website', 'http://www.painkilleroverdose.com'),
(3270, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=146');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3270, '0000002951.jpg', 0),
(3270, '0000002950.jpg', 1),
(3270, '0000002949.jpg', 2),
(3270, '0000002948.jpg', 3),
(3270, '0000002947.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3270, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3270, 'Multi-player', 'enabled');

-- Painkiller Overdose Demo (App ID: 3280)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3280, 'Painkiller Overdose Demo', 3270, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3280, NULL, NULL, NULL);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3280, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3280, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3280, 'Демо-версия игры', 'enabled');

-- Bejeweled 2 Deluxe (App ID: 3300)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3300, 'Bejeweled 2 Deluxe', 3300, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3300, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3300, '0000000529.jpg', 0),
(3300, '0000000528.jpg', 1),
(3300, '0000000527.jpg', 2),
(3300, '0000000526.jpg', 3),
(3300, '0000000525.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3300, 'Jeden gracz', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3300, 'Wersja demonstracyjna', 'enabled');

-- Chuzzle Deluxe (App ID: 3310)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3310, 'Chuzzle Deluxe', 3310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3310, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3310, (SELECT id FROM languages WHERE name = 'English')),
(3310, (SELECT id FROM languages WHERE name = 'French')),
(3310, (SELECT id FROM languages WHERE name = 'German')),
(3310, (SELECT id FROM languages WHERE name = 'Italian')),
(3310, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3310, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3310, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3310, '0000000539.jpg', 0),
(3310, '0000000538.jpg', 1),
(3310, '0000000537.jpg', 2),
(3310, '0000000536.jpg', 3),
(3310, '0000000535.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3310, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3310, 'Game demo', 'enabled');

-- Insaniquarium Deluxe (App ID: 3320)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3320, 'Insaniquarium Deluxe', 3320, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3320, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3320, (SELECT id FROM languages WHERE name = 'English')),
(3320, (SELECT id FROM languages WHERE name = 'French')),
(3320, (SELECT id FROM languages WHERE name = 'German')),
(3320, (SELECT id FROM languages WHERE name = 'Italian')),
(3320, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3320, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3320, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3320, '0000000534.jpg', 0),
(3320, '0000000533.jpg', 1),
(3320, '0000000532.jpg', 2),
(3320, '0000000531.jpg', 3),
(3320, '0000000530.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3320, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3320, 'Game demo', 'enabled');

-- Zuma Deluxe (App ID: 3330)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3330, 'Zuma Deluxe', 3330, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3330, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3330, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3330, '0000000524.jpg', 0),
(3330, '0000000523.jpg', 1),
(3330, '0000000522.jpg', 2),
(3330, '0000000521.jpg', 3),
(3330, '0000000520.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3330, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3330, 'Démo du jeu', 'enabled');

-- AstroPop Deluxe (App ID: 3340)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3340, 'AstroPop Deluxe', 3340, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3340, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3340, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3340, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3340, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3340, '0000000544.jpg', 0),
(3340, '0000000543.jpg', 1),
(3340, '0000000542.jpg', 2),
(3340, '0000000541.jpg', 3),
(3340, '0000000540.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3340, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3340, 'Game demo', 'enabled');

-- Bejeweled Deluxe (App ID: 3350)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3350, 'Bejeweled Deluxe', 3350, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3350, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3350, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3350, '0000000547.jpg', 0),
(3350, '0000000546.jpg', 1),
(3350, '0000000545.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3350, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3350, 'Démo du jeu', 'enabled');

-- BigMoney Deluxe (App ID: 3360)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3360, 'BigMoney Deluxe', 3360, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3360, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3360, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3360, '0000000550.jpg', 0),
(3360, '0000000549.jpg', 1),
(3360, '0000000548.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3360, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3360, 'Démo du jeu', 'enabled');

-- Bookworm Deluxe (App ID: 3370)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3370, 'Bookworm Deluxe', 3370, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3370, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3370, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3370, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3370, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3370, '0000000647.jpg', 0),
(3370, '0000000646.jpg', 1),
(3370, '0000000645.jpg', 2),
(3370, '0000000644.jpg', 3),
(3370, '0000000555.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3370, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3370, 'Game demo', 'enabled');

-- Dynomite Deluxe (App ID: 3380)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3380, 'Dynomite Deluxe', 3380, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3380, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3380, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3380, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3380, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3380, '0000000558.jpg', 0),
(3380, '0000000557.jpg', 1),
(3380, '0000000556.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3380, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3380, 'Game demo', 'enabled');

-- Feeding Frenzy 2 Deluxe (App ID: 3390)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3390, 'Feeding Frenzy 2 Deluxe', 3390, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3390, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3390, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3390, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3390, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3390, '0000000563.jpg', 0),
(3390, '0000000562.jpg', 1),
(3390, '0000000561.jpg', 2),
(3390, '0000000560.jpg', 3),
(3390, '0000000559.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3390, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3390, 'Game demo', 'enabled');

-- Hammer Heads Deluxe (App ID: 3400)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3400, 'Hammer Heads Deluxe', 3400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3400, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3400, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3400, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3400, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3400, '0000000568.jpg', 0),
(3400, '0000000567.jpg', 1),
(3400, '0000000566.jpg', 2),
(3400, '0000000565.jpg', 3),
(3400, '0000000564.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3400, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3400, 'Game demo', 'enabled');

-- Heavy Weapon Deluxe (App ID: 3410)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3410, 'Heavy Weapon Deluxe', 3410, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3410, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3410, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3410, '0000000573.jpg', 0),
(3410, '0000000572.jpg', 1),
(3410, '0000000571.jpg', 2),
(3410, '0000000570.jpg', 3),
(3410, '0000000569.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3410, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3410, 'Démo du jeu', 'enabled');

-- Iggle Pop Deluxe (App ID: 3420)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3420, 'Iggle Pop Deluxe', 3420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3420, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3420, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3420, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3420, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3420, '0000000578.jpg', 0),
(3420, '0000000577.jpg', 1),
(3420, '0000000576.jpg', 2),
(3420, '0000000575.jpg', 3),
(3420, '0000000574.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3420, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3420, 'Game demo', 'enabled');

-- Pizza Frenzy Deluxe (App ID: 3430)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3430, 'Pizza Frenzy Deluxe', 3430, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3430, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3430, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3430, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3430, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3430, '0000000583.jpg', 0),
(3430, '0000000582.jpg', 1),
(3430, '0000000581.jpg', 2),
(3430, '0000000580.jpg', 3),
(3430, '0000000579.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3430, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3430, 'Game demo', 'enabled');

-- Rocket Mania Deluxe (App ID: 3440)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3440, 'Rocket Mania Deluxe', 3440, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3440, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3440, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3440, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3440, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3440, '0000000586.jpg', 0),
(3440, '0000000585.jpg', 1),
(3440, '0000000584.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3440, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3440, 'Game demo', 'enabled');

-- Typer Shark Deluxe (App ID: 3450)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3450, 'Typer Shark Deluxe', 3450, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3450, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3450, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3450, '0000000597.jpg', 0),
(3450, '0000000589.jpg', 1),
(3450, '0000000588.jpg', 2),
(3450, '0000000587.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3450, 'Jeden gracz', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3450, 'Wersja demonstracyjna', 'enabled');

-- Talismania Deluxe (App ID: 3460)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3460, 'Talismania Deluxe', 3460, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3460, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3460, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3460, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3460, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3460, '0000000596.jpg', 0),
(3460, '0000000595.jpg', 1),
(3460, '0000000594.jpg', 2),
(3460, '0000000592.jpg', 3),
(3460, '0000000590.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3460, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3460, 'Game demo', 'enabled');

-- Bookworm Adventures Deluxe (App ID: 3470)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3470, 'Bookworm Adventures Deluxe', 83, 'http://www.metacritic.com/games/platforms/pc/bookwormadventures', 3470, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : December 14');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : December 14');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3470, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2006-12-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3470, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3470, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3470, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3470, '0000001108.jpg', 0),
(3470, '0000001107.jpg', 1),
(3470, '0000001106.jpg', 2),
(3470, '0000001105.jpg', 3),
(3470, '0000001104.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3470, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3470, 'Game demo', 'enabled');

-- Peggle Deluxe (App ID: 3480)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3480, 'Peggle Deluxe', 86, 'http://www.metacritic.com/games/platforms/pc/peggle', 3480, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : February 27');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : February 27');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3480, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2007-02-27');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3480, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3480, 'minimum', 'Requirements: Windows 98/ME/2000/XP/Vista, 256 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3480, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3480, '0000001539.jpg', 0),
(3480, '0000001538.jpg', 1),
(3480, '0000001537.jpg', 2),
(3480, '0000001536.jpg', 3),
(3480, '0000001535.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3480, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3480, 'Game demo', 'enabled');

-- Peggle Extreme (App ID: 3483)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3483, 'Peggle Extreme', 3480, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : September 11');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : September 11');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3483, (SELECT id FROM developers WHERE name = 'PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2007-09-11');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3483, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3483, 'minimum', 'Requirements: Windows 2000/XP/Vista, 256 MB RAM, 700MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3483, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=315');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3483, '0000002657.jpg', 0),
(3483, '0000002656.jpg', 1),
(3483, '0000002655.jpg', 2),
(3483, '0000002654.jpg', 3),
(3483, '0000002653.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3483, 'Single-player', 'enabled');

-- Venice Deluxe (App ID: 3490)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3490, 'Venice Deluxe', 3490, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Retro64');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : June 26');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : June 26');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3490, (SELECT id FROM developers WHERE name = 'Retro64'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2007-06-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3490, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3490, 'minimum', 'Requirements: Windows 98/ME/2000/XP, 128 MB RAM, 500MHz or faster, DirectX: 7.0');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3490, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3490, '0000001994.jpg', 0),
(3490, '0000001993.jpg', 1),
(3490, '0000001992.jpg', 2),
(3490, '0000001991.jpg', 3),
(3490, '0000001990.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3490, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3490, 'Game demo', 'enabled');

-- Mystery P.I. - The Lottery Ticket (App ID: 3500)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3500, 'Mystery P.I. - The Lottery Ticket', 3500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('SpinTop Games Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : October 16');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : October 16');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3500, (SELECT id FROM developers WHERE name = 'SpinTop Games Publisher : PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2007-10-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3500, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3500, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=90');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3500, '0000002956.jpg', 0),
(3500, '0000002955.jpg', 1),
(3500, '0000002954.jpg', 2),
(3500, '0000002953.jpg', 3),
(3500, '0000002952.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3500, 'Single-player', 'enabled');

-- Amazing Adventures The Lost Tomb (App ID: 3510)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3510, 'Amazing Adventures The Lost Tomb', 3510, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('SpinTop Games Publisher : PopCap Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : November 5');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('PopCap Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : November 5');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3510, (SELECT id FROM developers WHERE name = 'SpinTop Games Publisher : PopCap Games'), (SELECT id FROM publishers WHERE name = 'PopCap Games'), '2007-11-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3510, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3510, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3510, 'website', 'http://amazingadventuresgame.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3510, '0000003232.jpg', 0),
(3510, '0000003231.jpg', 1),
(3510, '0000003230.jpg', 2),
(3510, '0000003229.jpg', 3),
(3510, '0000003228.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3510, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3510, 'Game demo', 'enabled');

-- Advent Rising (App ID: 3800)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3800, 'Advent Rising', 70, 'http://www.metacritic.com/games/platforms/pc/adventrising', 3800, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3800, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3800, 'website', 'http://www.adventtrilogy.com/'),
(3800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=246');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3800, '0000000619.jpg', 0),
(3800, '0000000618.jpg', 1),
(3800, '0000000617.jpg', 2),
(3800, '0000000616.jpg', 3),
(3800, '0000000615.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3800, 'Jeden gracz', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3800, 'Blood Mild Violence Language', 'enabled');

-- BloodRayne (App ID: 3810)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3810, 'BloodRayne', 65, 'http://www.metacritic.com/games/platforms/pc/bloodrayne', 3810, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Terminal Reality Publisher : Majesco Release Date : September 9');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Single-player Blood and Gore Strong Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Majesco Release Date : September 9');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Single-player Blood and Gore Strong Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3810, (SELECT id FROM developers WHERE name = 'Terminal Reality Publisher : Majesco Release Date : September 9'), (SELECT id FROM publishers WHERE name = 'Majesco Release Date : September 9'), '2003-09-09');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3810, (SELECT id FROM languages WHERE name = 'English Single-player Blood and Gore Strong Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3810, 'minimum', 'Windows 98/2000/XP, 733 MHz processor, 128MB RAM, 200MB virtual memory, 2 GB free hard disc space, DirectX 8.1 or higher (included with game), DirectX compatible sound card, 100% DirectX 8.1 compatible video card, ATI Radeon, GeForce 2 or higher, with Hardware T&L (Transform & Lighting). Excludes GeForce MX and Go series cards. See full list below'),
(3810, 'recommended', 'Windows XP, Pentium 4 2.53 GHz or AMD equivalent, 512 MB RAM, 200MB virtual memory, 2 GB free hard disc space, 64MB nVidia GeForce 3, GeForce 4 Ti or ATI Radeon 8500 video card, DirectX 8.1 or higher (included with game), Sound Blaster Audigy sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3810, 'website', 'http://www.bloodrayne.com'),
(3810, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=247');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3810, '0000000623.jpg', 0),
(3810, '0000000622.jpg', 1),
(3810, '0000000621.jpg', 2),
(3810, '0000000620.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3810, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3810, 'Blood and Gore Strong Language Violence', 'enabled');

-- BloodRayne 2 (App ID: 3820)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3820, 'BloodRayne 2', 67, 'http://www.metacritic.com/games/platforms/pc/bloodrayne2', 3850, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Terminal Reality Publisher : Majesco Release Date : August 2');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Blood and Gore Intense Violence Sexual Themes Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('Majesco Release Date : August 2');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Single-player Blood and Gore Intense Violence Sexual Themes Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3820, (SELECT id FROM developers WHERE name = 'Terminal Reality Publisher : Majesco Release Date : August 2'), (SELECT id FROM publishers WHERE name = 'Majesco Release Date : August 2'), '2005-08-02');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3820, (SELECT id FROM languages WHERE name = 'English Single-player Blood and Gore Intense Violence Sexual Themes Strong Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3820, 'minimum', 'Windows 98 SE/2000/XP, 1.2 GHz processor, 256MB RAM, 200MB virtual memory, 5 GB free hard disc space, DirectX 8.1 or higher (included with game), DirectX compatible sound card, 100% DirectX 8.1 compatible video card, GeForce 3 or higher, with Hardware T&L (Transform & Lighting). Excludes GeForce MX and Go series cards. See full list below'),
(3820, 'recommended', 'Windows XP, Pentium 4 2.0 GHz or AMD equivalent, 512 MB RAM, 200MB virtual memory, 5 GB free hard disc space, 100% DirectX 8.1 compatible video card, Matrox Pahrelia, Nvidia GeForce 6800, ATI Radeon X800, 9600, 9700, 9800 or better, DirectX 8.1 or higher, DirectX compatible sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3820, 'website', 'index.php?area=game&AppId=3850&l=English&cc=US'),
(3820, 'website', 'http://www.bloodrayne2.com/'),
(3820, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=247');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3820, '0000000628.jpg', 0),
(3820, '0000000627.jpg', 1),
(3820, '0000000626.jpg', 2),
(3820, '0000000625.jpg', 3),
(3820, '0000000624.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3820, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3820, 'Blood and Gore Intense Violence Sexual Themes Strong Language', 'enabled');

-- Psychonauts (App ID: 3830)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3830, 'Psychonauts', 87, 'http://www.metacritic.com/games/platforms/pc/psychonauts', 3840, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3830, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3830, 'website', 'index.php?area=game&AppId=3840&l=french&cc=US'),
(3830, 'website', 'http://www.psychonauts.com/'),
(3830, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=248'),
(3830, 'manual', 'index.php?area=manual&AppId=3830&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3830, '0000000638.jpg', 0),
(3830, '0000000637.jpg', 1),
(3830, '0000000636.jpg', 2),
(3830, '0000000635.jpg', 3),
(3830, '0000000634.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3830, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3830, 'Manette activée', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3830, 'Cartoon Violence Crude Humor Language', 'enabled');

-- Psychonauts Demo (App ID: 3840)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3840, 'Psychonauts Demo', 87, 'http://www.metacritic.com/games/platforms/pc/psychonauts', 3830, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Double Fine Publisher : Majesco Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German Single-player Game demo Cartoon Violence Crude Humor Language');
INSERT IGNORE INTO publishers (name) VALUES ('Majesco Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German Single-player Game demo Cartoon Violence Crude Humor Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3840, (SELECT id FROM developers WHERE name = 'Double Fine Publisher : Majesco Languages : English'), (SELECT id FROM publishers WHERE name = 'Majesco Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3840, (SELECT id FROM languages WHERE name = 'English')),
(3840, (SELECT id FROM languages WHERE name = 'French')),
(3840, (SELECT id FROM languages WHERE name = 'German Single-player Game demo Cartoon Violence Crude Humor Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3840, 'minimum', 'Windows 98 SE/2000/XP, 1.0 GHz Pentium(R) III and AMD Athlon(tm), 256 MB of RAM, 64 MB GeForce (tm) 3 or higher or ATI(R) Radeon 8500 or higher (except GeForce 4 MX and Go series), DirectX(R) 9.0 or higher compatible sound card, DirectX(R) version 9.0 or higher (included with game), 3.75 GB minimum hard drive space, Windows-compatible keyboard and mouse'),
(3840, 'recommended', 'Windows 2000/XP, 2.0 GHz Pentium(R) IV and AMD Athlon(tm), 512 MB of RAM, 128 MB GeForce FX 5600 or higher or ATI(R) Radeon 9600 or higher, DirectX(R) 9.0 or higher and Sound Blaster Audigy 2 series sound card, DirectX(R) version 9.0 or higher (included with game), 6.0 GB minimum hard drive space, Game Pad (optional)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3840, 'website', 'http://www.psychonauts.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3840, '0000000721.jpg', 0),
(3840, '0000000720.jpg', 1),
(3840, '0000000719.jpg', 2),
(3840, '0000000718.jpg', 3),
(3840, '0000000717.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3840, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3840, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3840, 'Cartoon Violence Crude Humor Language', 'enabled');

-- BloodRayne 2 Demo (App ID: 3850)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3850, 'BloodRayne 2 Demo', 67, 'http://www.metacritic.com/games/platforms/pc/bloodrayne2', 3820, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Terminal Reality Publisher : Majesco Languages : English Single-player Game demo Blood and Gore Intense Violence Sexual Themes Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('Majesco Languages : English Single-player Game demo Blood and Gore Intense Violence Sexual Themes Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3850, (SELECT id FROM developers WHERE name = 'Terminal Reality Publisher : Majesco Languages : English Single-player Game demo Blood and Gore Intense Violence Sexual Themes Strong Language'), (SELECT id FROM publishers WHERE name = 'Majesco Languages : English Single-player Game demo Blood and Gore Intense Violence Sexual Themes Strong Language'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3850, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood and Gore Intense Violence Sexual Themes Strong Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3850, 'minimum', 'Windows 98 SE/2000/XP, 1.2 GHz processor, 256MB RAM, 200MB virtual memory, 5 GB free hard disc space, DirectX 8.1 or higher (included with game), DirectX compatible sound card, 100% DirectX 8.1 compatible video card, GeForce 3 or higher, with Hardware T&L (Transform & Lighting). Excludes GeForce MX and Go series cards. See full list below'),
(3850, 'recommended', 'Windows XP, Pentium 4 2.0 GHz or AMD equivalent, 512 MB RAM, 200MB virtual memory, 5 GB free hard disc space, 100% DirectX 8.1 compatible video card, Matrox Pahrelia, Nvidia GeForce 6800, ATI Radeon X800, 9600, 9700, 9800 or better, DirectX 8.1 or higher, DirectX compatible sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3850, 'website', 'http://www.bloodrayne2.com/'),
(3850, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?forumid=92');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3850, '0000000835.jpg', 0),
(3850, '0000000834.jpg', 1),
(3850, '0000000833.jpg', 2),
(3850, '0000000832.jpg', 3),
(3850, '0000000831.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3850, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3850, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3850, 'Blood and Gore Intense Violence Sexual Themes Strong Language', 'enabled');

-- Sid Meier''s Civilization� IV (App ID: 3900)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3900, 'Sid Meier''s Civilization� IV', 94, 'http://www.metacritic.com/games/platforms/pc/civilization4', 3900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Release Date : October 25');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Multi-player Includes level editor Violence');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : October 25');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Single-player Multi-player Includes level editor Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3900, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Release Date : October 25'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : October 25'), '2005-10-25');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3900, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Includes level editor Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3900, 'minimum', 'Windows 2000/XP, 1.2GHz Intel Pentium 4 or AMD Athlon processor or equivalent, 256MB RAM, 64 MB Video Card w/ Hardware T&L (GeForce 2/Radeon 7500 or better) DirectX7 compatible sound card, 1.7GB of free hard drive space, DirectX9.0c (included)'),
(3900, 'recommended', 'Windows 2000/XP, 1.8GHz Intel Pentium 4 or AMD Athlon processor or equivalent/better, 512 MB RAM, 128 MB Video Card w/ DirectX 8 support (pixel and vertex shaders), DirectX7 compatible sound card, 1.7GB of free hard drive space, DirectX9.0c (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3900, 'website', 'http://www.2kgames.com/civ4/home.htm'),
(3900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=221'),
(3900, 'manual', 'index.php?area=manual&AppId=3900&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3900, '0000000716.jpg', 0),
(3900, '0000000715.jpg', 1),
(3900, '0000000714.jpg', 2),
(3900, '0000000713.jpg', 3),
(3900, '0000000712.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3900, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3900, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3900, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3900, 'Violence', 'enabled');

-- Sid Meier''s Civilization� III Complete (App ID: 3910)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3910, 'Sid Meier''s Civilization� III Complete', 90, 'http://www.metacritic.com/games/platforms/pc/civilization3', 3910, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3910, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3910, 'recommended', 'Windows� 98/Me/2000/XP, Pentium� II 400 MHz, 128 MB RAM, 1.7 GB Free HDD space, Windows� 98/Me/2000/XP compatible video card*, Windows� 98/Me/2000/XP compatible sound card*, DirectX� version 9.0b (included) or highter');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3910, 'website', 'http://www.civ3.com/'),
(3910, 'manual', 'index.php?area=manual&AppId=3910&l=russian');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3910, '0000000726.jpg', 0),
(3910, '0000000725.jpg', 1),
(3910, '0000000724.jpg', 2),
(3910, '0000000723.jpg', 3),
(3910, '0000000722.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3910, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3910, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3910, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3910, 'Animated Blood Violence', 'enabled');

-- Sid Meier''s Pirates! (App ID: 3920)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3920, 'Sid Meier''s Pirates!', 88, 'http://www.metacritic.com/games/platforms/pc/sidmeierspirates', 3920, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3920, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3920, 'website', 'http://www.2kgames.com/pirates/pirates/home.php'),
(3920, 'manual', 'index.php?area=manual&AppId=3920&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3920, '0000000680.jpg', 0),
(3920, '0000000679.jpg', 1),
(3920, '0000000678.jpg', 2),
(3920, '0000000677.jpg', 3),
(3920, '0000000676.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3920, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3920, 'Alcohol Reference Suggestive Themes Violence', 'enabled');

-- Shattered Union (App ID: 3960)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3960, 'Shattered Union', 67, 'http://www.metacritic.com/games/platforms/pc/shatteredunion', 3960, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3960, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3960, 'recommended', 'Intel P4 1.8 GHz or AMD Athlon XP 1800+, 256 MB RAM, 128MB video card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3960, 'website', 'http://www.2kgames.com/shatteredunion/'),
(3960, 'manual', 'index.php?area=manual&AppId=3960&l=russian');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3960, '0000000711.jpg', 0),
(3960, '0000000710.jpg', 1),
(3960, '0000000709.jpg', 2),
(3960, '0000000708.jpg', 3),
(3960, '0000000707.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3960, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3960, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3960, 'Violence', 'enabled');

-- Prey (App ID: 3970)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3970, 'Prey', 83, 'http://www.metacritic.com/games/platforms/pc/prey', 3970, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Humanhead Studios Publisher : 2K Games Release Date : July 10');
INSERT IGNORE INTO developers (name) VALUES ('2006 Single-player Multi-player Blood and Gore Intense Violence Partial Nudity Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : July 10');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Single-player Multi-player Blood and Gore Intense Violence Partial Nudity Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3970, (SELECT id FROM developers WHERE name = 'Humanhead Studios Publisher : 2K Games Release Date : July 10'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : July 10'), '2006-07-10');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3970, 'minimum', 'Intel Pentium 4 2.0Ghz / AMD Athlon XP 2000+ processor 512MB system RAM 100% DirectX 9.0c compatible 64MB video card with latest manufacturer drivers (see supported chipsets below) 100% DirectX 9.0c compatible 16-bit sound card 2.2GB of uncompressed free hard drive space Microsoft Windows 2000 or XP with latest service pack installed DirectX 9.0c (included)'),
(3970, 'recommended', 'Intel Pentium 4 2.5Ghz / AMD Athlon XP 2500+ processor 1GB system RAM ATI Radeon X800 series or higher video card with latest manufacturer drivers Creative Sound Blaster X-Fi series sound card Broadband internet connection or LAN required for multiplayer');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3970, 'website', 'http://www.prey.com/'),
(3970, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=219');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3970, '0000000963.jpg', 0),
(3970, '0000000962.jpg', 1),
(3970, '0000000961.jpg', 2),
(3970, '0000000960.jpg', 3),
(3970, '0000000959.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3970, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3970, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3970, 'Blood and Gore Intense Violence Partial Nudity Strong Language', 'enabled');

-- CivCity: Rome (App ID: 3980)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3980, 'CivCity: Rome', 67, 'http://www.metacritic.com/games/platforms/pc/civcityrome', 3980, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('FireFly Studios / Firaxis Publisher : 2K Games Release Date : July 24');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Mild Realistic Violence');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : July 24');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Mild Realistic Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3980, (SELECT id FROM developers WHERE name = 'FireFly Studios / Firaxis Publisher : 2K Games Release Date : July 24'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : July 24'), '2006-07-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3980, (SELECT id FROM languages WHERE name = 'English')),
(3980, (SELECT id FROM languages WHERE name = 'French')),
(3980, (SELECT id FROM languages WHERE name = 'Spanish Single-player Mild Realistic Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3980, 'minimum', 'Windows 2000/XP, 1.6 GHz processor, 512 MB RAM, 2.5 GB uncompressed space, 64 MB video card (with Hardware T&L, nVidia GeForce 3/ATI Radeon 8500 or better), DirectX 7 compatible sound card, DirectX Version 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3980, 'website', 'http://www.2kgames.com/civcityrome/civcity.html'),
(3980, 'manual', 'index.php?area=manual&AppId=3980&l=English');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3980, '0000001473.jpg', 0),
(3980, '0000001472.jpg', 1),
(3980, '0000001471.jpg', 2),
(3980, '0000001470.jpg', 3),
(3980, '0000001469.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3980, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3980, 'Mild Realistic Violence', 'enabled');

-- Civilization IV�: Warlords (App ID: 3990)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (3990, 'Civilization IV�: Warlords', 84, 'http://www.metacritic.com/games/platforms/pc/civilization4warlords', 3990, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Release Date : July 24');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Violence');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : July 24');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (3990, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Release Date : July 24'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : July 24'), '2006-07-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(3990, (SELECT id FROM languages WHERE name = 'English')),
(3990, (SELECT id FROM languages WHERE name = 'French')),
(3990, (SELECT id FROM languages WHERE name = 'German')),
(3990, (SELECT id FROM languages WHERE name = 'Italian')),
(3990, (SELECT id FROM languages WHERE name = 'Spanish Single-player Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(3990, 'minimum', '1.2GHz Intel Pentium 4 or AMD Athlon processor or equivalent, 256MB RAM, 64 MB Video Card w/Hardware T&L (GeForce 2/Radeon 7500 or better), DirectX 9.0c compatible sound card, 1.7 GB of free hard drive space, Direct X 9.0c (included)'),
(3990, 'recommended', '1.8GHz Intel Pentium 4 or AMD Athlon processor or equivalent/better, 512 MB RAM, 128 MB Video Card w/ DirectX 8 support (pixel and vertex shaders), DirectX 9.0c compatible sound card, 1.7GB of free hard drive space, DirectX 9.0c (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(3990, 'website', 'http://www.2kgames.com/civ4/warlords/warlords.html'),
(3990, 'manual', 'index.php?area=manual&AppId=3990&l=English');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(3990, '0000001430.jpg', 0),
(3990, '0000001429.jpg', 1),
(3990, '0000001428.jpg', 2),
(3990, '0000001427.jpg', 3),
(3990, '0000001426.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3990, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (3990, 'Violence', 'enabled');

-- Garry''s Mod (App ID: 4000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4000, 'Garry''s Mod', 4000, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4000, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4000, 'minimum', '1.7 GHz Processor, 512MB RAM, DirectX� 8 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection'),
(4000, 'recommended', 'Pentium 4 processor (3.0GHz, or better), 1GB RAM, DirectX� 9 level Graphics Card, Windows� Vista/XP/2000, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4000, 'website', 'http://www.garrysmod.com/'),
(4000, 'forum', 'http://forums.facepunchstudios.com/'),
(4000, 'manual', 'index.php?area=manual&AppId=4000&l=thai');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4000, '0000000830.jpg', 0),
(4000, '0000000829.jpg', 1),
(4000, '0000000828.jpg', 2),
(4000, '0000000827.jpg', 3),
(4000, '0000000826.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4000, 'ผู้เล่นคนเดียว', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4000, 'ผู้เล่นหลายคน', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4000, 'มี HDR', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4000, 'มีโปรแกรมแก้ไขระดับการเล่น', 'enabled');

-- Poker Superstars II (App ID: 4100)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4100, 'Poker Superstars II', 4100, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4100, NULL, NULL, NULL);

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4100, '0000000643.jpg', 0),
(4100, '0000000642.jpg', 1),
(4100, '0000000641.jpg', 2),
(4100, '0000000640.jpg', 3),
(4100, '0000000639.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4100, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4100, 'Demo del juego', 'enabled');

-- RACE - The WTCC Game (App ID: 4230)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4230, 'RACE - The WTCC Game', 81, 'http://www.metacritic.com/games/platforms/pc/racethewtccgame', 4230, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('SimBin Publisher : Eidos Interactive Release Date : November 24');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : November 24');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4230, (SELECT id FROM developers WHERE name = 'SimBin Publisher : Eidos Interactive Release Date : November 24'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : November 24'), '2006-11-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4230, (SELECT id FROM languages WHERE name = 'English')),
(4230, (SELECT id FROM languages WHERE name = 'French')),
(4230, (SELECT id FROM languages WHERE name = 'German')),
(4230, (SELECT id FROM languages WHERE name = 'Italian')),
(4230, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4230, 'minimum', 'Microsoft Windows XP Home/Pro, 1.7 GHz Intel Pentium 4 or 100% compatible Processor, 512 MB RAM, 2.5 GB free space, DirectX 9 compatible graphics card with 128 MB memory, DirectX 9 compatible Sound Card, Keyboard and Mouse, DirectX Version 9'),
(4230, 'recommended', '3 GHz Intel Pentium IV or 100% compatible Processor, 1 GB RAM, DirectX 9 compatible graphics card with 256 MB memory, DirectX 9 compatible force feedback steering wheel');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4230, 'website', 'http://www.race-game.org/'),
(4230, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=115'),
(4230, 'manual', 'index.php?area=manual&AppId=4230&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4230, '0000000906.jpg', 0),
(4230, '0000000905.jpg', 1),
(4230, '0000000904.jpg', 2),
(4230, '0000000903.jpg', 3),
(4230, '0000000902.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4230, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4230, 'Multi-player', 'enabled');

-- RACE: Caterham Expansion (App ID: 4290)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4290, 'RACE: Caterham Expansion', 4290, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('SimBin Publisher : Eidos Interactive Release Date : June 22');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : June 22');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4290, (SELECT id FROM developers WHERE name = 'SimBin Publisher : Eidos Interactive Release Date : June 22'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : June 22'), '2007-06-22');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4290, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4290, 'minimum', 'Microsoft Windows XP Home/Pro, 1.7 GHz Intel Pentium 4 or 100% compatible Processor, 512 MB RAM, 2.5 GB free space, DirectX 9 compatible graphics card with 128 MB memory, DirectX 9 compatible Sound Card, Keyboard and Mouse, DirectX Version 9'),
(4290, 'recommended', '3 GHz Intel Pentium IV or 100% compatible Processor, 1 GB RAM, DirectX 9 compatible graphics card with 256 MB memory, DirectX 9 compatible force feedback steering wheel');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4290, 'website', 'http://www.race-game.org/'),
(4290, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=115');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4290, '0000002202.jpg', 0),
(4290, '0000002201.jpg', 1),
(4290, '0000002200.jpg', 2),
(4290, '0000002199.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4290, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4290, 'Multi-player', 'enabled');

-- RoboBlitz (App ID: 4300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4300, 'RoboBlitz', 80, 'http://www.metacritic.com/games/platforms/pc/roboblitz', 4310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Naked Sky Entertainment Release Date : November 7');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Includes level editor Fantasy Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4300, (SELECT id FROM developers WHERE name = 'Naked Sky Entertainment Release Date : November 7'), NULL, '2006-11-07');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4300, (SELECT id FROM languages WHERE name = 'English')),
(4300, (SELECT id FROM languages WHERE name = 'French')),
(4300, (SELECT id FROM languages WHERE name = 'German')),
(4300, (SELECT id FROM languages WHERE name = 'Italian')),
(4300, (SELECT id FROM languages WHERE name = 'Japanese')),
(4300, (SELECT id FROM languages WHERE name = 'Korean')),
(4300, (SELECT id FROM languages WHERE name = 'Traditional Chinese')),
(4300, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(4300, (SELECT id FROM languages WHERE name = 'Spanish Single-player Includes level editor Fantasy Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4300, 'minimum', 'Microsoft® Windows® XP SP2, Intel® Pentium® 4 2.0GHz or AMD Athlon™ XP 2000+, 512 MB RAM, 400MB Hard Disk Space, nVidia® Geforce® 6600 or ATI Radeon® X800 Video Card with 256 MB RAM, DirectX Version 9.0c'),
(4300, 'recommended', 'Microsoft® Windows® XP SP2, Intel® Pentium® Extreme Edition 3.2GHz or AMD Athlon™ 64 X2 3800+, 1 GB RAM, 400MB Hard Disk Space, nVidia® Geforce® 7800 or ATI Radeon® X1800 Video Card with 256 MB RAM, DirectX Version: 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4300, 'website', 'index.php?area=game&AppId=4310&cc=US'),
(4300, 'website', 'http://www.roboblitz.com/'),
(4300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=114');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4300, '0000000685.jpg', 0),
(4300, '0000000684.jpg', 1),
(4300, '0000000683.jpg', 2),
(4300, '0000000682.jpg', 3),
(4300, '0000000681.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4300, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4300, 'Fantasy Violence', 'enabled');

-- RoboBlitz Demo (App ID: 4310)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4310, 'RoboBlitz Demo', 80, 'http://www.metacritic.com/games/platforms/pc/roboblitz', 4300, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Naked Sky Entertainment Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Japanese');
INSERT IGNORE INTO developers (name) VALUES ('Korean');
INSERT IGNORE INTO developers (name) VALUES ('Traditional Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Simplified Chinese');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo Fantasy Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4310, (SELECT id FROM developers WHERE name = 'Naked Sky Entertainment Languages : English'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4310, (SELECT id FROM languages WHERE name = 'English')),
(4310, (SELECT id FROM languages WHERE name = 'French')),
(4310, (SELECT id FROM languages WHERE name = 'German')),
(4310, (SELECT id FROM languages WHERE name = 'Italian')),
(4310, (SELECT id FROM languages WHERE name = 'Japanese')),
(4310, (SELECT id FROM languages WHERE name = 'Korean')),
(4310, (SELECT id FROM languages WHERE name = 'Traditional Chinese')),
(4310, (SELECT id FROM languages WHERE name = 'Simplified Chinese')),
(4310, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo Fantasy Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4310, 'minimum', 'Microsoft® Windows® XP SP2, Intel® Pentium® 4 2.0GHz or AMD Athlon™ XP 2000+, 512 MB RAM, 400MB Hard Disk Space, nVidia® Geforce® 6600 or ATI Radeon® X800 Video Card with 256 MB RAM, DirectX Version 9.0c'),
(4310, 'recommended', 'Microsoft® Windows® XP SP2, Intel® Pentium® Extreme Edition 3.2GHz or AMD Athlon™ 64 X2 3800+, 1 GB RAM, 400MB Hard Disk Space, nVidia® Geforce® 7800 or ATI Radeon® X1800 Video Card with 256 MB RAM, DirectX Version: 9.0c');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4310, 'website', 'http://www.roboblitz.com/'),
(4310, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=114');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4310, '0000000840.jpg', 0),
(4310, '0000000839.jpg', 1),
(4310, '0000000838.jpg', 2),
(4310, '0000000837.jpg', 3),
(4310, '0000000836.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4310, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4310, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4310, 'Fantasy Violence', 'enabled');

-- City Life Deluxe (App ID: 4410)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4410, 'City Life Deluxe', 75, 'http://www.metacritic.com/games/platforms/pc/citylifeworldedition', 4410, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4410, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4410, 'website', 'index.php?area=game&AppId=938&l=french&cc=US'),
(4410, 'website', 'http://www.citylife-game.com'),
(4410, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=98'),
(4410, 'manual', 'index.php?area=manual&AppId=4410&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4410, '0000001168.jpg', 0),
(4410, '0000001167.jpg', 1),
(4410, '0000001166.jpg', 2),
(4410, '0000001165.jpg', 3),
(4410, '0000001164.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4410, 'Joueur solo', 'enabled');

-- Silverfall (App ID: 4420)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4420, 'Silverfall', 62, 'http://www.metacritic.com/games/platforms/pc/silverfall', 4420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Monte Cristo Publisher : Monte Cristo Release Date : March 20');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Monte Cristo Release Date : March 20');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4420, (SELECT id FROM developers WHERE name = 'Monte Cristo Publisher : Monte Cristo Release Date : March 20'), (SELECT id FROM publishers WHERE name = 'Monte Cristo Release Date : March 20'), '2007-03-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4420, (SELECT id FROM languages WHERE name = 'English')),
(4420, (SELECT id FROM languages WHERE name = 'French')),
(4420, (SELECT id FROM languages WHERE name = 'German')),
(4420, (SELECT id FROM languages WHERE name = 'Italian')),
(4420, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4420, 'minimum', 'Windows® XP Intel Pentium 4 2.8 Ghz or AMD Athlon XP +2800 higher 512 MB RAM ATI Radeon 9800 256MB VRAM or Nvidia 6600 GT with 256 MB of VRAM or better DirectX version 9.0c-compatible sound card DirectX® 9.0c Network Interface (only for multiplayer games) 10 GB available HD space'),
(4420, 'recommended', 'Intel Pentium 4 3 Ghz or AMD Athlon XP +3000 1 GB RAM 256MB ATI Radeon X850 or Nvidia GeForce 6800GT');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4420, 'website', 'index.php?area=game&AppId=4440&cc=US'),
(4420, 'website', 'http://www.silverfall-game.com/'),
(4420, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=155'),
(4420, 'manual', 'index.php?area=manual&AppId=4420&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4420, '0000001496.jpg', 0),
(4420, '0000001495.jpg', 1),
(4420, '0000001494.jpg', 2),
(4420, '0000001493.jpg', 3),
(4420, '0000001492.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4420, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4420, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4420, 'Blood Violence', 'enabled');

-- Silverfall Demo (App ID: 4440)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4440, 'Silverfall Demo', 4420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Monte Cristo Publisher : Monte Cristo Languages : English Single-player Game demo Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Monte Cristo Languages : English Single-player Game demo Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4440, (SELECT id FROM developers WHERE name = 'Monte Cristo Publisher : Monte Cristo Languages : English Single-player Game demo Blood Violence'), (SELECT id FROM publishers WHERE name = 'Monte Cristo Languages : English Single-player Game demo Blood Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4440, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4440, 'minimum', 'Windows® XP Intel Pentium 4 2.8 Ghz or AMD Athlon XP +2800 higher 512 MB RAM ATI Radeon 9800 256MB VRAM or Nvidia 6600 GT with 256 MB of VRAM or better DirectX version 9.0c-compatible sound card DirectX® 9.0c Network Interface (only for multiplayer games) 10 GB available HD space'),
(4440, 'recommended', 'Intel Pentium 4 3 Ghz or AMD Athlon XP +3000 1 GB RAM 256MB ATI Radeon X850 or Nvidia GeForce 6800GT');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4440, 'website', 'http://www.silverfall-game.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4440, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4440, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4440, 'Blood Violence', 'enabled');

-- S.T.A.L.K.E.R.: Shadow of Chernobyl (App ID: 4500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4500, 'S.T.A.L.K.E.R.: Shadow of Chernobyl', 82, 'http://www.metacritic.com/games/platforms/pc/stalkershadowofchernobyl', 4500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('GSC Game World Publisher : THQ Release Date : March 20');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Intense Violence Strong Language Use of Alcohol');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : March 20');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Intense Violence Strong Language Use of Alcohol');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4500, (SELECT id FROM developers WHERE name = 'GSC Game World Publisher : THQ Release Date : March 20'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : March 20'), '2007-03-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4500, (SELECT id FROM languages WHERE name = 'English')),
(4500, (SELECT id FROM languages WHERE name = 'French')),
(4500, (SELECT id FROM languages WHERE name = 'Italian')),
(4500, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood and Gore Intense Violence Strong Language Use of Alcohol'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4500, 'minimum', 'Microsoft� Windows� XP (Service Pack 2)/Microsoft� Windows� 2000 SP4, Intel Pentium 4 2 Ghz/AMD XP 2200+, 512 MB RAM, 10 GB available hard drive space, 128 MB DirectX� 9c compatible card/ nVIDIA� GeForce 5700/ATI Radeon� 9600, DirectX� 9 compatible sound card, LAN/ Internet connection with Cable/DSL speeds for multiplayer, Keyboard, Mouse Recommended: Intel Core 2 Duo E6400/AMD Athlon 64 X2 4200+, 1 GB RAM or better, 256 MB DirectX� 9c compatible card/ nVIDIA� GeForce 7900/ ATI Radeon� X1850'),
(4500, 'recommended', 'Intel Core 2 Duo E6400/AMD Athlon 64 X2 4200+, 1 GB RAM or better, 256 MB DirectX� 9c compatible card/ nVIDIA� GeForce 7900/ ATI Radeon� X1850');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4500, 'website', 'http://www.stalker-game.com/'),
(4500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=313'),
(4500, 'manual', 'index.php?area=manual&AppId=4500&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4500, '0000002190.jpg', 0),
(4500, '0000002189.jpg', 1),
(4500, '0000002188.jpg', 2),
(4500, '0000002187.jpg', 3),
(4500, '0000002186.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4500, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4500, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4500, 'Blood and Gore Intense Violence Strong Language Use of Alcohol', 'enabled');

-- Full Spectrum Warrior (App ID: 4520)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4520, 'Full Spectrum Warrior', 80, 'http://www.metacritic.com/games/platforms/pc/fullspectrumwarrior', 4520, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pandemic Studios Publisher : THQ Release Date : September 21');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Korean Single-player Multi-player Blood Strong Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : September 21');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Korean Single-player Multi-player Blood Strong Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4520, (SELECT id FROM developers WHERE name = 'Pandemic Studios Publisher : THQ Release Date : September 21'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : September 21'), '2004-09-21');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4520, (SELECT id FROM languages WHERE name = 'English')),
(4520, (SELECT id FROM languages WHERE name = 'French')),
(4520, (SELECT id FROM languages WHERE name = 'German')),
(4520, (SELECT id FROM languages WHERE name = 'Italian')),
(4520, (SELECT id FROM languages WHERE name = 'Spanish')),
(4520, (SELECT id FROM languages WHERE name = 'Korean Single-player Multi-player Blood Strong Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4520, 'minimum', 'Windows 98/Me/2000/XP (only), AMD Athlon 1 GHz or Pentium III 1 GHz, 256 MB RAM, DirectX 9.0b-compatible graphics card from NVIDIA or ATI, GeForce 3 and higher, ATI Radeon 8500 and higher, DirectX 9.0b-compatible sound card, 1.5 GB Free Hard Drive Space, Broadband Internet Connection (for multiplayer) Recommended: Windows XP, AMD Athlon XP 2000+ and above OR Pentium 4 2GHz and above, 512 MB RAM or greater, GeForce 4 Ti and higher or ATI Radeon 9500 and higher, DirectX 9.0b-compatible sound card, SoundBlaster Audigy preferred'),
(4520, 'recommended', 'Windows XP, AMD Athlon XP 2000+ and above OR Pentium 4 2GHz and above, 512 MB RAM or greater, GeForce 4 Ti and higher or ATI Radeon 9500 and higher, DirectX 9.0b-compatible sound card, SoundBlaster Audigy preferred');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4520, 'website', 'http://www.fullspectrumwarrior.com/'),
(4520, 'manual', 'index.php?area=manual&AppId=4520&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4520, '0000002083.jpg', 0),
(4520, '0000002082.jpg', 1),
(4520, '0000002081.jpg', 2),
(4520, '0000002080.jpg', 3),
(4520, '0000002079.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4520, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4520, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4520, 'Blood Strong Language Violence', 'enabled');

-- Full Spectrum Warrior: Ten Hammers (App ID: 4530)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4530, 'Full Spectrum Warrior: Ten Hammers', 70, 'http://www.metacritic.com/games/platforms/pc/fullspectrumwarriortenhammers', 4530, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pandemic Studios Publisher : THQ Release Date : March 27');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Violence Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : March 27');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Violence Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4530, (SELECT id FROM developers WHERE name = 'Pandemic Studios Publisher : THQ Release Date : March 27'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : March 27'), '2006-03-27');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4530, (SELECT id FROM languages WHERE name = 'English')),
(4530, (SELECT id FROM languages WHERE name = 'French')),
(4530, (SELECT id FROM languages WHERE name = 'German')),
(4530, (SELECT id FROM languages WHERE name = 'Italian')),
(4530, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood and Gore Violence Strong Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4530, 'minimum', 'Windows 2000/XP (only), AMD Athlon XP or Pentium III 1.5 GHz, 256 MB RAM, DirectX 9.0b-compatible graphics card from NVIDIA® GeForce® 3 and higher (excluding GeForce® 4MX) or ATI® Radeon® 8500 and higher, DirectX 9.0c-compatible sound card, DirectX 9.0c (included), 2.56 GB Free Hard Drive Space, MS Compatible mouse, Broadband Internet Connection (for multiplayer)'),
(4530, 'recommended', 'Windows XP, AMD Athlon 64; or Pentium 4 2.8GHz+; 1 GB RAM, DirectX 9.0c-compatible graphics card from NVIDIA® (GeForce® 6600 and above), DirectX 9.0c-compatible sound card - Sound Blaster® X-Fi™ series preferred');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4530, 'website', 'http://www.fullspectrumwarrior.com/'),
(4530, 'manual', 'index.php?area=manual&AppId=4530&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4530, '0000002090.jpg', 0),
(4530, '0000002089.jpg', 1),
(4530, '0000002088.jpg', 2),
(4530, '0000002087.jpg', 3),
(4530, '0000002086.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4530, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4530, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4530, 'Blood and Gore Violence Strong Language', 'enabled');

-- Titan Quest (App ID: 4540)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4540, 'Titan Quest', 77, 'http://www.metacritic.com/games/platforms/pc/titanquest', 4540, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Iron Lore Entertainment Publisher : THQ Release Date : June 26');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Includes level editor Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : June 26');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Includes level editor Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4540, (SELECT id FROM developers WHERE name = 'Iron Lore Entertainment Publisher : THQ Release Date : June 26'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : June 26'), '2007-06-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4540, (SELECT id FROM languages WHERE name = 'English')),
(4540, (SELECT id FROM languages WHERE name = 'French')),
(4540, (SELECT id FROM languages WHERE name = 'German')),
(4540, (SELECT id FROM languages WHERE name = 'Italian')),
(4540, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Includes level editor Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4540, 'minimum', 'Windows® 2000 or XP, 1.8 Ghz Intel Pentium IV or equivalent or AMD Athlon XP or equivalent , 512 MB RAM, 5 GB free hard drive space, 64 MB NVIDIA GeForce 3 or equivalent or ATI Radeon 8500 series with Pixel Shader 1.1 support or equivalent, DirectX® 9.0c compatible 16-bit sound card, Keyboard, Mouse'),
(4540, 'recommended', 'Windows XP, 3.0 Ghz Intel Pentium IV or equivalent, 1 GB RAM, 128 MB NVIDIA GeForce 6800 series or ATI Radeon X800 series or equivalent, Soundblaster X-Fi series sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4540, 'website', 'index.php?area=game&AppId=4590&cc=US'),
(4540, 'website', 'http://original.titanquestgame.com/'),
(4540, 'manual', 'index.php?area=manual&AppId=4540&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4540, '0000002050.jpg', 0),
(4540, '0000002049.jpg', 1),
(4540, '0000002048.jpg', 2),
(4540, '0000002047.jpg', 3),
(4540, '0000002046.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4540, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4540, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4540, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4540, 'Suggestive Themes Violence', 'enabled');

-- Titan Quest - Immortal Throne (App ID: 4550)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4550, 'Titan Quest - Immortal Throne', 80, 'http://www.metacritic.com/games/platforms/pc/titanquestimmortalthrone', 4550, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Iron Lore Entertainment Publisher : THQ Release Date : March 5');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : March 5');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4550, (SELECT id FROM developers WHERE name = 'Iron Lore Entertainment Publisher : THQ Release Date : March 5'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : March 5'), '2007-03-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4550, (SELECT id FROM languages WHERE name = 'English')),
(4550, (SELECT id FROM languages WHERE name = 'French')),
(4550, (SELECT id FROM languages WHERE name = 'German')),
(4550, (SELECT id FROM languages WHERE name = 'Italian')),
(4550, (SELECT id FROM languages WHERE name = 'Spanish Single-player Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4550, 'minimum', 'Windows® 2000 or XP, 1.8 Ghz Intel Pentium IV or equivalent or AMD Athlon XP or equivalent , 512 MB RAM, 5 GB free hard drive space, 64 MB NVIDIA GeForce 3 or equivalent or ATI Radeon 8500 series with Pixel Shader 1.1 support or equivalent, DirectX® 9.0c compatible 16-bit sound card, Keyboard, Mouse'),
(4550, 'recommended', 'Windows XP, 3.0 Ghz Intel Pentium IV or equivalent, 1 GB RAM, 128 MB NVIDIA GeForce 6800 series or ATI Radeon X800 series or equivalent, Soundblaster X-Fi series sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4550, 'website', 'http://www.titanquestgame.com/'),
(4550, 'manual', 'index.php?area=manual&AppId=4550&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4550, '0000002059.jpg', 0),
(4550, '0000002058.jpg', 1),
(4550, '0000002057.jpg', 2),
(4550, '0000002056.jpg', 3),
(4550, '0000002055.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4550, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4550, 'Suggestive Themes Violence', 'enabled');

-- Company of Heroes (App ID: 4560)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4560, 'Company of Heroes', 93, 'http://www.metacritic.com/games/platforms/pc/companyofheroes', 4560, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4560, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4560, 'minimum', 'Windows� XP or Vista, 2.0 Ghz Intel Pentium IV or equivalent or AMD Athlon XP or equivalent, 512 MB RAM, DirectX 9.0c compatible 64MB video card with Pixel Shader 1.1 support or equivalent and latest manufacturer drivers, DirectX� 9.0c compatible 16-bit sound card, Keyboard, Mouse, 6.5 GB of uncompressed free hard drive space (We recommend having 1 gigabyte of free space after installation)'),
(4560, 'recommended', '3.0 Ghz Intel Pentium IV or equivalent, 1 GB RAM, 256 MB NVIDIA GeForce 6800 series or better');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4560, 'website', 'index.php?area=game&AppId=9300&l=spanish&cc=US'),
(4560, 'website', 'http://www.companyofheroesgame.com/'),
(4560, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=270'),
(4560, 'manual', 'index.php?area=manual&AppId=4560&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4560, '0000002016.jpg', 0),
(4560, '0000002015.jpg', 1),
(4560, '0000002014.jpg', 2),
(4560, '0000002013.jpg', 3),
(4560, '0000002012.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4560, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4560, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4560, 'Strong Language Blood and Gore Intense Violence', 'enabled');

-- Titan Quest Demo (App ID: 4590)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4590, 'Titan Quest Demo', 4540, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Iron Lore Entertainment Publisher : THQ Languages : English Single-player Game demo Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Languages : English Single-player Game demo Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4590, (SELECT id FROM developers WHERE name = 'Iron Lore Entertainment Publisher : THQ Languages : English Single-player Game demo Suggestive Themes Violence'), (SELECT id FROM publishers WHERE name = 'THQ Languages : English Single-player Game demo Suggestive Themes Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4590, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Suggestive Themes Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4590, 'website', 'http://original.titanquestgame.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4590, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4590, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4590, 'Suggestive Themes Violence', 'enabled');

-- Full Pipe (App ID: 4600)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4600, 'Full Pipe', 4600, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PipeStudio Publisher : 1C Company Release Date : December 18');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('1C Company Release Date : December 18');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4600, (SELECT id FROM developers WHERE name = 'PipeStudio Publisher : 1C Company Release Date : December 18'), (SELECT id FROM publishers WHERE name = '1C Company Release Date : December 18'), '2006-12-18');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4600, (SELECT id FROM languages WHERE name = 'English')),
(4600, (SELECT id FROM languages WHERE name = 'German')),
(4600, (SELECT id FROM languages WHERE name = 'Russian Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4600, 'website', 'index.php?area=game&AppId=4610&l=English&cc=US'),
(4600, 'website', 'http://www.pipestudio.ru/fullpipe_new/index.php?PageId=world&Lang=en'),
(4600, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=138'),
(4600, 'manual', 'index.php?area=manual&AppId=4600&l=English');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4600, '0000000978.jpg', 0),
(4600, '0000000977.jpg', 1),
(4600, '0000000976.jpg', 2),
(4600, '0000000975.jpg', 3),
(4600, '0000000974.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4600, 'Single-player', 'enabled');

-- Full Pipe Demo (App ID: 4610)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4610, 'Full Pipe Demo', 4600, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PipeStudio Publisher : 1C Company Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('1C Company Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4610, (SELECT id FROM developers WHERE name = 'PipeStudio Publisher : 1C Company Languages : English'), (SELECT id FROM publishers WHERE name = '1C Company Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4610, (SELECT id FROM languages WHERE name = 'English')),
(4610, (SELECT id FROM languages WHERE name = 'German')),
(4610, (SELECT id FROM languages WHERE name = 'Russian Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4610, 'website', 'http://www.pipestudio.ru/fullpipe_new/index.php?PageId=world&Lang=en'),
(4610, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=138');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4610, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4610, 'Game demo', 'enabled');

-- Medieval II: Total War (App ID: 4700)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4700, 'Medieval II: Total War', 88, 'http://www.metacritic.com/games/platforms/pc/medieval2totalwar', 4700, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Creative Assembly Publisher : SEGA Release Date : November 15');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('SEGA Release Date : November 15');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4700, (SELECT id FROM developers WHERE name = 'The Creative Assembly Publisher : SEGA Release Date : November 15'), (SELECT id FROM publishers WHERE name = 'SEGA Release Date : November 15'), '2006-11-15');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4700, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4700, 'minimum', 'System Requirements: Microsoft� Windows� 2000/XP Celeron 1.5GHz Pentium 4� (1500MHz) or equivalent AMD� processor 512MB RAM 11GB of uncompressed free hard disk space 100% DirectX� 9.0c compatible 16-bit sound cardand latest drivers 100% Windows� 2000/XP compatible mouse,keyboard and latest drivers DirectX� 9.0c 128MB Hardware Accelerated video card with Shader 1 support and the latest drivers. Must be 100% DirectX� 9.0c compatible 1024 x 768 minimum display resolution Internet (TCP / IP) play supported; Internet play requires broadband connection and latest drivers; LAN play requires Network card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4700, 'website', 'index.php?area=game&AppId=4710&cc=US'),
(4700, 'website', 'http://www.totalwar.com'),
(4700, 'manual', 'index.php?area=manual&AppId=4700&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4700, '0000000850.jpg', 0),
(4700, '0000000849.jpg', 1),
(4700, '0000000848.jpg', 2),
(4700, '0000000847.jpg', 3),
(4700, '0000000846.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4700, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4700, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4700, 'Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence', 'enabled');

-- Medieval II: Total War Demo (App ID: 4710)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4710, 'Medieval II: Total War Demo', 88, 'http://www.metacritic.com/games/platforms/pc/medieval2totalwar', 4700, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Creative Assembly Publisher : SEGA Single-player Game demo Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('SEGA Single-player Game demo Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4710, (SELECT id FROM developers WHERE name = 'The Creative Assembly Publisher : SEGA Single-player Game demo Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence'), (SELECT id FROM publishers WHERE name = 'SEGA Single-player Game demo Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence'), NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4710, 'minimum', 'System Requirements: Microsoft® Windows® 2000/XP Celeron 1.5GHz Pentium 4® (1500MHz) or equivalent AMD® processor 512MB RAM 11GB of uncompressed free hard disk space 100% DirectX� 9.0c compatible 16-bit sound cardand latest drivers 100% Windows� 2000/XP compatible mouse,keyboard and latest drivers DirectX� 9.0c 128MB Hardware Accelerated video card with Shader 1 support and the latest drivers. Must be 100% DirectX� 9.0c compatible 1024 x 768 minimum display resolution Internet (TCP / IP) play supported; Internet play requires broadband connection and latest drivers; LAN play requires Network card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4710, 'website', 'http://www.totalwar.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4710, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4710, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4710, 'Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence', 'enabled');

-- Outrun 2006: Coast 2 Coast (App ID: 4730)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4730, 'Outrun 2006: Coast 2 Coast', 81, 'http://www.metacritic.com/games/platforms/pc/outrun2006coast2coast', 4730, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4730, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4730, 'minimum', 'Requirements: Win 2000/XP, P4 1.3 GHz or equivalent Athlon, 256MB RAM, 128MB video RAM nVidia GeforceFX 5600 or equivalent ATI Radeon, DirectX 8.1 Compatible Sound Card'),
(4730, 'recommended', 'Requirements: P4 2.0 GHz or equivalent Athlon, 512MB RAM, nVidia Geforce 6200 or equivalent ATI Radeon');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4730, 'website', 'http://www.sega.com/gamesite/outrun2006/en/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4730, '0000000916.jpg', 0),
(4730, '0000000915.jpg', 1),
(4730, '0000000914.jpg', 2),
(4730, '0000000913.jpg', 3),
(4730, '0000000912.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4730, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4730, 'Multijoueur', 'enabled');

-- Rome: Total War - Gold (App ID: 4760)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4760, 'Rome: Total War - Gold', 92, 'http://www.metacritic.com/games/platforms/pc/rometotalwar', 4760, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4760, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4760, 'minimum', 'Microsoft� Windows� 98SE/ME/2000/XP, processeur Pentium III 1.0GHz ou Athlon 1.0GHz ou supérieur, 256 Mo RAM, 2.9Go d''espace disque, carte son compatible 100% DirectX� 9.0c, souris compatible 100% Windows� 98SE/ME/2000/XP, clavier, carte graphique 64 Mo compatible DirectX� 9.0b, connexion internet haut débit');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4760, 'website', 'http://www.totalwar.com/'),
(4760, 'manual', 'index.php?area=manual&AppId=4760&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4760, '0000001710.jpg', 0),
(4760, '0000001709.jpg', 1),
(4760, '0000001708.jpg', 2),
(4760, '0000001707.jpg', 3),
(4760, '0000001706.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4760, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4760, 'Multijoueur', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4760, 'Violence', 'enabled');

-- Medieval 2: Total War Kingdoms (App ID: 4780)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4780, 'Medieval 2: Total War Kingdoms', 4780, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Creative Assembly Publisher : SEGA Release Date : August 28');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('SEGA Release Date : August 28');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4780, (SELECT id FROM developers WHERE name = 'The Creative Assembly Publisher : SEGA Release Date : August 28'), (SELECT id FROM publishers WHERE name = 'SEGA Release Date : August 28'), '2007-08-28');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4780, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4780, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4780, 'website', 'http://www.totalwar.com/'),
(4780, 'manual', 'index.php?area=manual&AppId=4780&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4780, '0000002609.jpg', 0),
(4780, '0000002608.jpg', 1),
(4780, '0000002607.jpg', 2),
(4780, '0000002606.jpg', 3),
(4780, '0000002605.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4780, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4780, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4780, 'Alcohol and Tobacco Reference Blood Mild Language Sexual Themes Violence', 'enabled');

-- SEGA Rally Revo (App ID: 4790)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4790, 'SEGA Rally Revo', 74, 'http://www.metacritic.com/games/platforms/pc/segarallyrevo', 4790, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4790, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4790, 'minimum', ':'),
(4790, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4790, 'website', 'http://www.sega.com/gamesite/segarallyrevo/index.html');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4790, '0000003032.jpg', 0),
(4790, '0000003031.jpg', 1),
(4790, '0000003030.jpg', 2),
(4790, '0000003029.jpg', 3),
(4790, '0000003028.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4790, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4790, 'Multijugador', 'enabled');

-- Heroes of Annihilated Empires (App ID: 4800)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4800, 'Heroes of Annihilated Empires', 64, 'http://www.metacritic.com/games/platforms/pc/heroesofannihilatedempires', 4800, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4800, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4800, 'website', 'index.php?area=game&AppId=4810&l=french&cc=US'),
(4800, 'website', 'index.php?area=game&AppId=4820&l=french&cc=US'),
(4800, 'website', 'http://www.heroesofae.com/'),
(4800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=116'),
(4800, 'manual', 'index.php?area=manual&AppId=4800&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4800, '0000000871.jpg', 0),
(4800, '0000000870.jpg', 1),
(4800, '0000000869.jpg', 2),
(4800, '0000000868.jpg', 3),
(4800, '0000000867.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4800, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4800, 'Multijoueur', 'enabled');

-- Heroes of Annihilated Empires Demo (App ID: 4810)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4810, 'Heroes of Annihilated Empires Demo', 64, 'http://www.metacritic.com/games/platforms/pc/heroesofannihilatedempires', 4800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('GSC Game World Publisher : GSC Game World Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Russian Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('GSC Game World Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4810, (SELECT id FROM developers WHERE name = 'GSC Game World Publisher : GSC Game World Languages : English'), (SELECT id FROM publishers WHERE name = 'GSC Game World Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4810, (SELECT id FROM languages WHERE name = 'English')),
(4810, (SELECT id FROM languages WHERE name = 'French')),
(4810, (SELECT id FROM languages WHERE name = 'German')),
(4810, (SELECT id FROM languages WHERE name = 'Russian Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4810, 'minimum', 'Intel Pentium 4 2Ghz or AMD Athlon XP 2000+, nVidia GeForce FX5200 or ATI Radeon 9000 Video card with 128MB Memory, 512MB RAM, DirectX 8.0 compatible Sound, 2.5 Gb Free Hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4810, 'website', 'http://www.heroesofae.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4810, '0000000929.jpg', 0),
(4810, '0000000928.jpg', 1),
(4810, '0000000927.jpg', 2),
(4810, '0000000926.jpg', 3),
(4810, '0000000925.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4810, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4810, 'Game demo', 'enabled');

-- Heroes... Multiplayer Demo (App ID: 4820)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4820, 'Heroes... Multiplayer Demo', 4800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('GSC Game World Publisher : GSC Game World Multi-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('GSC Game World Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4820, (SELECT id FROM developers WHERE name = 'GSC Game World Publisher : GSC Game World Multi-player Game demo'), (SELECT id FROM publishers WHERE name = 'GSC Game World Multi-player Game demo'), NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(4820, 'minimum', 'Intel Pentium 4 2Ghz or AMD Athlon XP 2000+, nVidia GeForce FX5200 or ATI Radeon 9000 Video card with 128MB Memory, 512MB RAM, DirectX 8.0 compatible Sound, 2.5 Gb Free Hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4820, 'website', 'http://www.heroesofae.com/'),
(4820, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=116');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4820, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4820, 'Game demo', 'enabled');

-- Zen of Sudoku (App ID: 4900)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4900, 'Zen of Sudoku', 4900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Unknown Worlds Release Date : December 14');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4900, (SELECT id FROM developers WHERE name = 'Unknown Worlds Release Date : December 14'), NULL, '2006-12-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4900, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4900, 'website', 'index.php?area=game&AppId=4910&cc=US'),
(4900, 'website', 'http://www.zenofsudoku.com'),
(4900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=136');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(4900, '0000001011.jpg', 0),
(4900, '0000001010.jpg', 1),
(4900, '0000001009.jpg', 2),
(4900, '0000001008.jpg', 3),
(4900, '0000001007.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4900, 'Single-player', 'enabled');

-- Zen of Sudoku Demo (App ID: 4910)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (4910, 'Zen of Sudoku Demo', 4900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Unknown Worlds Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (4910, (SELECT id FROM developers WHERE name = 'Unknown Worlds Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(4910, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(4910, 'website', 'http://www.zenofsudoku.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4910, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (4910, 'Game demo', 'enabled');

-- Trailer: Painkiller Overdose Teaser (Media App ID: 5000)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (3270, 5000);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5000, 'Painkiller Overdose Teaser', '', NULL, '', '', '', '');


-- Trailer: Overlord Trailer (Media App ID: 5001)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (11450, 5001);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5001, 'Overlord Trailer', 'Triumph Studios Languages : English Resolution : 1280 x 720 Length : 02:47', NULL, '1280x720', '02:47', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5001, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Clive Barker''s Jericho HD Trailer (Media App ID: 5002)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (11420, 5002);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5002, 'Clive Barker''s Jericho HD Trailer', '', NULL, '', '', '', '');


-- Trailer: Shadowgrounds Survivor HD Trailer (Media App ID: 5003)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (11200, 5003);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5003, 'Shadowgrounds Survivor HD Trailer', 'Frozenbyte Languages : English Resolution : 1280 x 720 Length : 00:44', NULL, '1280x720', '00:44', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5003, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Alpha Prime Trailer (Media App ID: 5008)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (2590, 5008);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5008, 'Alpha Prime Trailer', '', NULL, '', '', '', '');


-- Trailer: Speedball 2  Tournament Trailer (Media App ID: 5009)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10700, 5009);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5009, 'Speedball 2  Tournament Trailer', '', NULL, '', '', '', '');


-- Trailer: Universe at War: Earth Assault Trailer (Media App ID: 5010)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10430, 5010);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5010, 'Universe at War: Earth Assault Trailer', 'Petroglyph Publisher : SEGA Languages : English Resolution : 1280 x 720 Length : 02:37', NULL, '1280x720', '02:37', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5010, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: INSURGENCY Trailer (Media App ID: 5011)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (90043, 5011);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5011, 'INSURGENCY Trailer', 'Insurgency Team Languages : English Resolution : 1280 x 720 Length : 00:57', NULL, '1280x720', '00:57', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5011, (SELECT id FROM languages WHERE name = 'English Resolution'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(5011, 'website', 'http://www.insurgencymod.net/');


-- Trailer: Speedball 2 Tutorial Video (Media App ID: 5012)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10700, 5012);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5012, 'Speedball 2 Tutorial Video', 'Kylotonn Entertainment Publisher : Frogster Interactive Pictures AG Languages : English Resolution : 1024 x 768 Length : 5:09', NULL, '1024x768', '5:09', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5012, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: The Golden Compass Trailer (Media App ID: 5013)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10440, 5013);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5013, 'The Golden Compass Trailer', 'Shiny Entertainment Publisher : SEGA Languages : English Resolution : 1280 x 720 Length : 00:30', NULL, '1280x720', '00:30', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5013, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Frontlines: Fuel of War Trailer (Media App ID: 5014)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (900566, 5014);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5014, 'Frontlines: Fuel of War Trailer', 'Kaos Studios Languages : English Resolution : 1280 x 720 Length : 01:30', NULL, '1280x720', '01:30', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5014, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Team Fortress 2: Meet the Heavy (German) (Media App ID: 5015)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5015, 'Team Fortress 2: Meet the Heavy (German)', 'Valve Publisher : Valve Languages : German Resolution : 1280 x 720 Length : 1:29', NULL, '1280x720', '1:29', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5015, (SELECT id FROM languages WHERE name = 'German Resolution'));


-- Trailer: Team Fortress 2: Meet the Heavy (French) (Media App ID: 5016)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5016, 'Team Fortress 2: Meet the Heavy (French)', 'Valve Publisher : Valve Languages : French Resolution : 1280 x 720 Length : 1:29', NULL, '1280x720', '1:29', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5016, (SELECT id FROM languages WHERE name = 'French Resolution'));


-- Trailer: EVE Online HD Trailer (Media App ID: 5017)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8500, 5017);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5017, 'EVE Online HD Trailer', 'CCP Languages : English Resolution : 1280 x 720 Length : 02:07', NULL, '1280x720', '02:07', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5017, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: The Club HD Trailer (Media App ID: 5019)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (10460, 5019);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5019, 'The Club HD Trailer', 'Bizarre Creations Languages : English Resolution : 1280 x 720 Length : 02:09', NULL, '1280x720', '02:09', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5019, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Dawn of War - Soulstorm HD Trailer (Media App ID: 5020)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (9450, 5020);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5020, 'Dawn of War - Soulstorm HD Trailer', '', NULL, '', '', '', '');


-- Trailer: Frontlines: Fuel of War Multiplayer Trailer (Media App ID: 5023)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (9460, 5023);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5023, 'Frontlines: Fuel of War Multiplayer Trailer', '', NULL, '', '', '', '');


-- Trailer: Tom Clancy''s Rainbow Six� Vegas 2 Trailer (Media App ID: 5024)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (15120, 5024);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5024, 'Tom Clancy''s Rainbow Six� Vegas 2 Trailer', 'Ubisoft Montreal Publisher : Ubisoft Languages : English Resolution : 1280 x 720 Length : 01:59', NULL, '1280x720', '01:59', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5024, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Tom Clancy''s Rainbow Six� Vegas Trailer (Media App ID: 5025)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (13540, 5025);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5025, 'Tom Clancy''s Rainbow Six� Vegas Trailer', 'Ubisoft Montreal Publisher : Ubisoft Languages : English Resolution : 1280 x 720 Length : 01:01', NULL, '1280x720', '01:01', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5025, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Assassin''s Creed HD Trailer (Media App ID: 5030)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (15100, 5030);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5030, 'Assassin''s Creed HD Trailer', 'Ubisoft Montreal Publisher : Ubisoft Languages : English Resolution : 1280 x 720 Length : 02:07', NULL, '1280x720', '02:07', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(5030, (SELECT id FROM languages WHERE name = 'English Resolution'));


-- Trailer: Team Fortress 2: Meet the Scout (English) (Media App ID: 5032)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 5032);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5032, 'Team Fortress 2: Meet the Scout (English)', '', NULL, '', '', '', '');


-- Trailer: Team Fortress 2: Meet the Scout (French) (Media App ID: 5033)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 5033);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5033, 'Team Fortress 2: Meet the Scout (French)', '', NULL, '', '', '', '');


-- Trailer: Team Fortress 2: Meet the Scout (German) (Media App ID: 5034)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 5034);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5034, 'Team Fortress 2: Meet the Scout (German)', '', NULL, '', '', '', '');


-- Trailer: Team Fortress 2: Meet the Scout (Russian) (Media App ID: 5035)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 5035);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5035, 'Team Fortress 2: Meet the Scout (Russian)', '', NULL, '', '', '', '');


-- Trailer: Team Fortress 2: Meet the Scout (Spanish) (Media App ID: 5036)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (440, 5036);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5036, 'Team Fortress 2: Meet the Scout (Spanish)', '', NULL, '', '', '', '');


-- Trailer: S.T.A.L.K.E.R.: Clear Sky Tech Demo (Media App ID: 5037)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (9390, 5037);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (5037, 'S.T.A.L.K.E.R.: Clear Sky Tech Demo', '', NULL, '', '', '', '');


-- Eets (App ID: 6100)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6100, 'Eets', 81, 'http://www.metacritic.com/games/platforms/pc/eets', 6100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Klei Entertainment Publisher : Klei Entertainment Release Date : March 29');
INSERT IGNORE INTO developers (name) VALUES ('2006 Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Klei Entertainment Release Date : March 29');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6100, (SELECT id FROM developers WHERE name = 'Klei Entertainment Publisher : Klei Entertainment Release Date : March 29'), (SELECT id FROM publishers WHERE name = 'Klei Entertainment Release Date : March 29'), '2006-03-29');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6100, 'minimum', 'Pentium III - 500 or equivalent CPU, 128MB of System Ram, 32MB Video Card, DirectX 8.1 or higher, Win 98 / ME / 2000 / XP / Vista');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6100, 'website', 'index.php?area=game&AppId=6110&cc=US'),
(6100, 'website', 'http://www.eetsgame.com'),
(6100, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=139');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6100, '0000001087.jpg', 0),
(6100, '0000001086.jpg', 1),
(6100, '0000001085.jpg', 2),
(6100, '0000001084.jpg', 3),
(6100, '0000001083.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6100, 'Single-player', 'enabled');

-- Eets Demo (App ID: 6110)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6110, 'Eets Demo', 81, 'http://www.metacritic.com/games/platforms/pc/eets', 6100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Klei Entertainment Publisher : Klei Entertainment Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Klei Entertainment Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6110, (SELECT id FROM developers WHERE name = 'Klei Entertainment Publisher : Klei Entertainment Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Klei Entertainment Single-player Game demo'), NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6110, 'minimum', 'Pentium III - 500 or equivalent CPU, 128MB of System Ram, 32MB Video Card, DirectX 8.1 or higher, Win 98 / ME / 2000 / XP / Vista');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6110, 'website', 'http://www.eetsgame.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6110, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6110, 'Game demo', 'enabled');

-- Ghost Master� (App ID: 6200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6200, 'Ghost Master�', 81, 'http://www.metacritic.com/games/platforms/pc/ghostmaster', 6200, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6200, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6200, 'minimum', 'Pentium� III 450. Windows� 98,ME,XP,2000. NVIDIA� TNT2 3D card. 128MB of RAM. 750MB of free hard disc space. DirectX� 8.1. Mouse, keyboard'),
(6200, 'recommended', 'Pentium� IV 1.5GHz. ATI� Radeon7500/NVIDIA� GeForce2 3D card. 256MB of RAM');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6200, 'website', 'http://www.ghostmaster.com'),
(6200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=255'),
(6200, 'manual', 'index.php?area=manual&AppId=6200&l=russian');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6200, '0000001075.jpg', 0),
(6200, '0000001074.jpg', 1),
(6200, '0000001073.jpg', 2),
(6200, '0000001072.jpg', 3),
(6200, '0000001071.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6200, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6200, 'Blood Mild Violence', 'enabled');

-- Vegas Make It Big (App ID: 6210)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6210, 'Vegas Make It Big', 76, 'http://www.metacritic.com/games/platforms/pc/vegasmakeitbig', 6210, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6210, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6210, 'minimum', 'Pentium� III 600MHz, Windows� 98, 16MB 3D graphics card, 192MB of RAM. 500MB of free hard disc space. DirectX� 9.0, mouse, keyboard'),
(6210, 'recommended', 'Pentium� III 800MHz, 32MB 3D graphics card, 256MB of RAM, 8x CD drive speed, mouse with wheel');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6210, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=256'),
(6210, 'manual', 'index.php?area=manual&AppId=6210&l=russian');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6210, '0000001054.jpg', 0),
(6210, '0000001053.jpg', 1),
(6210, '0000001052.jpg', 2),
(6210, '0000001051.jpg', 3),
(6210, '0000001050.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6210, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6210, 'Suggestive Themes', 'enabled');

-- FlatOut (App ID: 6220)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6220, 'FlatOut', 72, 'http://www.metacritic.com/games/platforms/pc/flatout', 6220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Bugbear Entertainment Publisher : Empire Interactive Release Date : July 12');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Empire Interactive Release Date : July 12');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6220, (SELECT id FROM developers WHERE name = 'Bugbear Entertainment Publisher : Empire Interactive Release Date : July 12'), (SELECT id FROM publishers WHERE name = 'Empire Interactive Release Date : July 12'), '2005-07-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6220, (SELECT id FROM languages WHERE name = 'English')),
(6220, (SELECT id FROM languages WHERE name = 'French')),
(6220, (SELECT id FROM languages WHERE name = 'German')),
(6220, (SELECT id FROM languages WHERE name = 'Italian')),
(6220, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6220, 'minimum', '1.5 GHz Pentium 4 or AMD Equivalent, 256 MB RAM, 64 MB Graphics Card, DirectX Compatible Sound Card, 1.1 GB of free Hard Drive Space, Win 98/ME/2000/XP, DirectX9.0c'),
(6220, 'recommended', '2.0 GHz Pentium 4 or AMD 2000+, 512 MB RAM, 128 MB Graphics Card, DirectX Compatible Sound Card, Gamepad or Steering Wheel, Windows XP SP2');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6220, 'website', 'index.php?area=game&AppId=6230&cc=US'),
(6220, 'website', 'http://flatout.vugames.com/site.html'),
(6220, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=254');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6220, '0000001240.jpg', 0),
(6220, '0000001239.jpg', 1),
(6220, '0000001238.jpg', 2),
(6220, '0000001237.jpg', 3),
(6220, '0000001236.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6220, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6220, 'Multi-player', 'enabled');

-- FlatOut Demo (App ID: 6230)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6230, 'FlatOut Demo', 6220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Bugbear Entertainment Publisher : Empire Interactive Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Empire Interactive Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6230, (SELECT id FROM developers WHERE name = 'Bugbear Entertainment Publisher : Empire Interactive Languages : English'), (SELECT id FROM publishers WHERE name = 'Empire Interactive Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6230, (SELECT id FROM languages WHERE name = 'English')),
(6230, (SELECT id FROM languages WHERE name = 'French')),
(6230, (SELECT id FROM languages WHERE name = 'Italian')),
(6230, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6230, 'minimum', '1.5 GHz Pentium 4 or AMD Equivalent, 256 MB RAM, 64 MB Graphics Card, DirectX Compatible Sound Card, 1.1 GB of free Hard Drive Space, Win 98/ME/2000/XP, DirectX9.0c'),
(6230, 'recommended', '2.0 GHz Pentium 4 or AMD 2000+, 512 MB RAM, 128 MB Graphics Card, DirectX Compatible Sound Card, Gamepad or Steering Wheel, Windows XP SP2');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6230, 'website', 'http://flatout.vugames.com/site.html');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6230, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6230, 'Game demo', 'enabled');

-- Making History: The Calm & the Storm (App ID: 6250)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6250, 'Making History: The Calm & the Storm', 70, 'http://www.metacritic.com/games/platforms/pc/makinghistorythecalmandthestorm', 6250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Muzzy Lane Publisher : Strategy First Release Date : March 13');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : March 13');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6250, (SELECT id FROM developers WHERE name = 'Muzzy Lane Publisher : Strategy First Release Date : March 13'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : March 13'), '2007-03-13');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6250, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Mild Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6250, 'minimum', 'Windows XP, 2000 or Vista Operating System, Pentium III or Athlon 1.0GHz Processor, 512 MB RAM, 850 MB available hard drive space, 32 MB Video Card, Internet connection for multiplayer');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6250, 'website', 'index.php?area=game&AppId=6260&cc=US'),
(6250, 'website', 'http://www.making-history.com/'),
(6250, 'forum', 'http://www.muzzylane.com/forum/ '),
(6250, 'manual', 'index.php?area=manual&AppId=6250&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6250, '0000001501.jpg', 0),
(6250, '0000001481.jpg', 1),
(6250, '0000001480.jpg', 2),
(6250, '0000001479.jpg', 3),
(6250, '0000001477.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6250, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6250, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6250, 'Mild Violence', 'enabled');

-- Making History Demo (App ID: 6260)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6260, 'Making History Demo', 70, 'http://www.metacritic.com/games/platforms/pc/makinghistorythecalmandthestorm', 6250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Muzzy Lane Publisher : Strategy First Languages : English Single-player Game demo Mild Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Languages : English Single-player Game demo Mild Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6260, (SELECT id FROM developers WHERE name = 'Muzzy Lane Publisher : Strategy First Languages : English Single-player Game demo Mild Violence'), (SELECT id FROM publishers WHERE name = 'Strategy First Languages : English Single-player Game demo Mild Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6260, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Mild Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6260, 'website', 'http://www.making-history.com/'),
(6260, 'forum', 'http://www.muzzylane.com/forum/ ');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6260, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6260, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6260, 'Mild Violence', 'enabled');

-- Ducati World Championship (App ID: 6270)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6270, 'Ducati World Championship', 6270, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6270, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6270, 'website', 'http://www.artematica.com/index.php?lang=en&sezione=gamesdetails&idGame=3'),
(6270, 'manual', 'index.php?area=manual&AppId=6270&l=polish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6270, '0000002624.jpg', 0),
(6270, '0000002623.jpg', 1),
(6270, '0000002622.jpg', 2),
(6270, '0000002621.jpg', 3),
(6270, '0000002620.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6270, 'Jeden gracz', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6270, 'Wieloosobowa', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6270, 'Mild Suggestive Themes', 'enabled');

-- Alien Shooter - Vengeance (App ID: 6290)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6290, 'Alien Shooter - Vengeance', 67, 'http://www.metacritic.com/games/platforms/pc/alienshootervengeance', 99026, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sigma Team Inc. Publisher : Strategy First Release Date : February 5');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : February 5');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6290, (SELECT id FROM developers WHERE name = 'Sigma Team Inc. Publisher : Strategy First Release Date : February 5'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : February 5'), '2007-02-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6290, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6290, 'minimum', ':'),
(6290, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6290, 'website', 'http://alienshooter.cdvusa.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6290, '0000003334.jpg', 0),
(6290, '0000003333.jpg', 1),
(6290, '0000003332.jpg', 2),
(6290, '0000003331.jpg', 3),
(6290, '0000003330.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6290, 'Single-player', 'enabled');

-- Dreamfall: The Longest Journey (App ID: 6300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6300, 'Dreamfall: The Longest Journey', 75, 'http://www.metacritic.com/games/platforms/pc/dreamfall', 6300, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Funcom Publisher : Funcom Release Date : April 17');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Strong Violence Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Funcom Release Date : April 17');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Blood Strong Violence Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6300, (SELECT id FROM developers WHERE name = 'Funcom Publisher : Funcom Release Date : April 17'), (SELECT id FROM publishers WHERE name = 'Funcom Release Date : April 17'), '2006-04-17');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6300, (SELECT id FROM languages WHERE name = 'English Single-player Blood Strong Violence Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6300, 'minimum', 'Windows XP (with service pack 2), Intel Pentium 4 1.6 GHz or AMD Sempron 2800+ or higher, 512 MB RAM, 7 GB free disk space, DirectX 9.0c compatible sound, 3D Hardware Accelerator Card Required: 100% DirectX 9.0c compatible 128 MB with latest drivers'),
(6300, 'recommended', 'Intel Pentium 4 2.5 GHz or AMD Athlon XP 3500+');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6300, 'website', 'http://www.dreamfall.com/'),
(6300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=145'),
(6300, 'manual', 'index.php?area=manual&AppId=6300&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6300, '0000001148.jpg', 0),
(6300, '0000001147.jpg', 1),
(6300, '0000001146.jpg', 2),
(6300, '0000001145.jpg', 3),
(6300, '0000001144.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6300, 'Blood Strong Violence Suggestive Themes Violence', 'enabled');

-- The Longest Journey (App ID: 6310)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6310, 'The Longest Journey', 91, 'http://www.metacritic.com/games/platforms/pc/longestjourney', 6310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Funcom Publisher : Funcom Release Date : November 17');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Funcom Release Date : November 17');
INSERT IGNORE INTO publishers (name) VALUES ('2000 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6310, (SELECT id FROM developers WHERE name = 'Funcom Publisher : Funcom Release Date : November 17'), (SELECT id FROM publishers WHERE name = 'Funcom Release Date : November 17'), '2000-11-17');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6310, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6310, 'minimum', 'Windows 95/98, 2000, XP, Pentium 166 MMX , 32 MB RAM, Mouse and Keyboard, 640x480 SVGA high colour (16bit) video card with 2 MB RAM, Windows compatible sound device, 300 MB free hard drive space'),
(6310, 'recommended', 'Pentium II, 266 mhz, 64 MB RAM , 3d accelarator card ( Direct 3d compatible ) with 4 MB RAM, 1GB free hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6310, 'website', 'index.php?area=game&AppId=6320&cc=US'),
(6310, 'website', 'http://www.longestjourney.com'),
(6310, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=178'),
(6310, 'manual', 'index.php?area=manual&AppId=6310&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6310, '0000001845.jpg', 0),
(6310, '0000001844.jpg', 1),
(6310, '0000001843.jpg', 2),
(6310, '0000001842.jpg', 3),
(6310, '0000001841.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6310, 'Single-player', 'enabled');

-- The Longest Journey Demo (App ID: 6320)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6320, 'The Longest Journey Demo', 6310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Funcom Publisher : Funcom Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Funcom Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6320, (SELECT id FROM developers WHERE name = 'Funcom Publisher : Funcom Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Funcom Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6320, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6320, 'website', 'http://www.longestjourney.com'),
(6320, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=145');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6320, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6320, 'Game demo', 'enabled');

-- Joint Task Force (App ID: 6400)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6400, 'Joint Task Force', 68, 'http://www.metacritic.com/games/platforms/pc/jointtaskforce', 6400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Most Wanted Entertainment Publisher : HD Publishing Release Date : September 12');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Drug Reference Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('HD Publishing Release Date : September 12');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Drug Reference Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6400, (SELECT id FROM developers WHERE name = 'Most Wanted Entertainment Publisher : HD Publishing Release Date : September 12'), (SELECT id FROM publishers WHERE name = 'HD Publishing Release Date : September 12'), '2006-09-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6400, (SELECT id FROM languages WHERE name = 'English')),
(6400, (SELECT id FROM languages WHERE name = 'French')),
(6400, (SELECT id FROM languages WHERE name = 'German')),
(6400, (SELECT id FROM languages WHERE name = 'Italian')),
(6400, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Drug Reference Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6400, 'minimum', 'Win XP / Win XP 64 bit / Windows 2000, Intel P4 2 GHz / AMD Athlon XP2000+, 512 Mb RAM, 2,5 Gb uncompressed space / 4 Gb of free space on drive C: during installation, NVidia GeForce 4 128 Mb / Ati Radeon 9500 128 Mb, DirectX compatible soundcard, 10 Mbit for LAN / 56K for Internet, Mouse and keyboard');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6400, 'website', 'index.php?area=game&AppId=6410&cc=US'),
(6400, 'website', 'http://www.jointtaskforce.com/'),
(6400, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=164'),
(6400, 'manual', 'index.php?area=manual&AppId=6400&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6400, '0000001309.jpg', 0),
(6400, '0000001308.jpg', 1),
(6400, '0000001307.jpg', 2),
(6400, '0000001306.jpg', 3),
(6400, '0000001305.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6400, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6400, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6400, 'Blood Drug Reference Language Violence', 'enabled');

-- Joint Task Force Demo (App ID: 6410)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6410, 'Joint Task Force Demo', 68, 'http://www.metacritic.com/games/platforms/pc/jointtaskforce', 6400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Most Wanted Entertainment Publisher : HD Publishing Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('HD Publishing Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6410, (SELECT id FROM developers WHERE name = 'Most Wanted Entertainment Publisher : HD Publishing Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'HD Publishing Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6410, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6410, 'minimum', 'Win XP / Win XP 64 bit / Windows 2000, Intel P4 2 GHz / AMD Athlon XP2000+, 512 Mb RAM, 2,5 Gb uncompressed space / 4 Gb of free space on drive C: during installation, NVidia GeForce 4 128 Mb / Ati Radeon 9500 128 Mb, DirectX compatible soundcard, 10 Mbit for LAN / 56K for Internet, Mouse and keyboard');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6410, 'website', 'http://www.jointtaskforce.com/'),
(6410, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=164');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6410, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6410, 'Game demo', 'enabled');

-- Nexus - The Jupiter Incident (App ID: 6420)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6420, 'Nexus - The Jupiter Incident', 77, 'http://www.metacritic.com/games/platforms/pc/nexusthejupiterincident', 6420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Mithis Games Publisher : HD Publishing Release Date : November 5');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Single-player Multi-player Alcohol Reference Fantasy Violence Mild Language Sexual Themes');
INSERT IGNORE INTO publishers (name) VALUES ('HD Publishing Release Date : November 5');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Single-player Multi-player Alcohol Reference Fantasy Violence Mild Language Sexual Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6420, (SELECT id FROM developers WHERE name = 'Mithis Games Publisher : HD Publishing Release Date : November 5'), (SELECT id FROM publishers WHERE name = 'HD Publishing Release Date : November 5'), '2004-11-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6420, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Alcohol Reference Fantasy Violence Mild Language Sexual Themes'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6420, 'minimum', 'Windows 98SE/2000/XP, Celeron 1 GHz processor, 128 MB RAM, GeForce2 MX or comparable graphics adapter, MS DirectX compatible soundcard, MS Windows compatible mouse and keyboard, 500 MB free HD space, MS DirectX 8.1+');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6420, 'website', 'http://www.nexusthegame.com/'),
(6420, 'manual', 'index.php?area=manual&AppId=6420&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6420, '0000002241.jpg', 0),
(6420, '0000002240.jpg', 1),
(6420, '0000002239.jpg', 2),
(6420, '0000002238.jpg', 3),
(6420, '0000002237.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6420, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6420, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6420, 'Alcohol Reference Fantasy Violence Mild Language Sexual Themes', 'enabled');

-- Lost Planet: Extreme Condition (App ID: 6510)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6510, 'Lost Planet: Extreme Condition', 66, 'http://www.metacritic.com/games/platforms/pc/lostplanet', 6510, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6510, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6510, 'minimum', 'Windows� XP, Intel� Pentium� 4 supporting HT technology or AMD Athlon 64 3500+ or greater, 512 MB RAM (Windows XP) / 1 GB RAM (Windows Vista), 8.0 GB free disk space, 640x480 minimum resolution, 256 MB VRAM, DirectX�9.0c / Shader3.0*, NVIDIA� GeForce� 6600 or greater**, DirectSound compatible. DirectX�9.0c, Mouse, Keyboard, Broadband connection (Internet connection required to play.)'),
(6510, 'recommended', 'Windows Vista, Intel� Core2 Duo, 1 GB RAM (Windows XP) / 2 GB RAM (Windows Vista), 1280x720 or higher resolution, 256 MB VRAM, NVIDIA� GeForce� 8600 or greater, Gamepad, Xbox 360 Controller for Windows�');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6510, 'website', 'index.php?area=game&AppId=6580&l=spanish&cc=US'),
(6510, 'website', 'http://www.lostplanet-thegame.com'),
(6510, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=242'),
(6510, 'manual', 'index.php?area=manual&AppId=6510&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6510, '0000001920.jpg', 0),
(6510, '0000001919.jpg', 1),
(6510, '0000001918.jpg', 2),
(6510, '0000001917.jpg', 3),
(6510, '0000001916.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6510, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6510, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6510, 'Sistema antitrampas de Valve activado', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6510, 'Controlador activado', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6510, 'Animated Blood Mild Language Violence', 'enabled');

-- Lost Planet Demo (App ID: 6530)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6530, 'Lost Planet Demo', 6510, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('CAPCOM CO.');
INSERT IGNORE INTO developers (name) VALUES ('LTD. Publisher : CAPCOM� ENTERTAINMENT');
INSERT IGNORE INTO developers (name) VALUES ('INC. Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('CAPCOM� ENTERTAINMENT');
INSERT IGNORE INTO publishers (name) VALUES ('INC. Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6530, (SELECT id FROM developers WHERE name = 'CAPCOM CO.'), (SELECT id FROM publishers WHERE name = 'CAPCOM� ENTERTAINMENT'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6530, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6530, 'minimum', 'Windows® XP, Intel® Pentium® 4 supporting HT technology, 512 MB RAM (Windows XP) / 1 GB RAM (Windows Vista), 8.0 GB free disk space, 640x480 minimum resolution, 256 MB VRAM, DirectX®9.0c / Shader3.0*, NVIDIA® GeForce® 6600 or greater**, DirectSound compatible. DirectX®9.0c, Mouse, Keyboard, Broadband connection (Internet connection required to play.)'),
(6530, 'recommended', 'Windows Vista™, Intel® Core™2 Duo, 1 GB RAM (Windows XP) / 2 GB RAM (Windows Vista), 1280x720 or higher resolution, 256 MB VRAM, NVIDIA® GeForce® 8600 or greater, Gamepad, Xbox 360™ Controller for Windows®');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6530, 'website', 'http://www.lostplanet-thegame.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6530, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6530, 'Game demo', 'enabled');

-- Devil May Cry� 3 Special Edition (App ID: 6550)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6550, 'Devil May Cry� 3 Special Edition', 66, 'http://www.metacritic.com/games/platforms/pc/devilmaycry3se', 6550, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('CAPCOM CO.');
INSERT IGNORE INTO developers (name) VALUES ('LTD. Publisher : CAPCOM® ENTERTAINMENT');
INSERT IGNORE INTO developers (name) VALUES ('INC. Release Date : May 23');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Italian Single-player Controller enabled Blood Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('CAPCOM® ENTERTAINMENT');
INSERT IGNORE INTO publishers (name) VALUES ('INC. Release Date : May 23');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Italian Single-player Controller enabled Blood Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6550, (SELECT id FROM developers WHERE name = 'CAPCOM CO.'), (SELECT id FROM publishers WHERE name = 'CAPCOM® ENTERTAINMENT'), '2006-05-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6550, (SELECT id FROM languages WHERE name = 'English')),
(6550, (SELECT id FROM languages WHERE name = 'French')),
(6550, (SELECT id FROM languages WHERE name = 'German')),
(6550, (SELECT id FROM languages WHERE name = 'Spanish')),
(6550, (SELECT id FROM languages WHERE name = 'Italian Single-player Controller enabled Blood Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6550, 'minimum', 'Windows XP/2000 * , Intel Pentium III Processor, 1.0 Ghz and above, 256 MB RAM, DirecX 9.0n and above video card, 128MB VRAM, Shader 2.0, DirectX 9.0 Soundcard, Mouse/keyboard, 2.0 GB free disk space'),
(6550, 'recommended', 'Intel Premium 4 Processor 2.0 Ghz or better, 512 MB RAM, VRAM 256 MB and above, game pad with 4 wheel-12 button analogue stick, 4.7 GB Free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6550, 'website', 'http://www.devilmaycry.com/dmc3/main.html'),
(6550, 'manual', 'index.php?area=manual&AppId=6550&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6550, '0000002178.jpg', 0),
(6550, '0000002177.jpg', 1),
(6550, '0000002176.jpg', 2),
(6550, '0000002169.jpg', 3),
(6550, '0000002168.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6550, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6550, 'Controller', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6550, 'Blood Suggestive Themes Violence', 'enabled');

-- Onimusha 3: Demon Siege (App ID: 6570)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6570, 'Onimusha 3: Demon Siege', 69, 'http://www.metacritic.com/games/platforms/pc/onimusha3dungeonsiege', 6570, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6570, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6570, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6570, 'website', 'http://www.onimusha3.co.uk/'),
(6570, 'manual', 'index.php?area=manual&AppId=6570&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6570, '0000002572.jpg', 0),
(6570, '0000002571.jpg', 1),
(6570, '0000002570.jpg', 2),
(6570, '0000002569.jpg', 3),
(6570, '0000002568.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6570, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6570, 'Manette activée', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6570, 'Blood and Gore Intense Violence', 'enabled');

-- Bullet Candy (App ID: 6600)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6600, 'Bullet Candy', 6600, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6600, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6600, 'minimum', ':'),
(6600, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6600, 'website', 'http://www.charliesgames.com'),
(6600, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=152'),
(6600, 'manual', 'index.php?area=manual&AppId=6600&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6600, '0000001273.jpg', 0),
(6600, '0000001272.jpg', 1),
(6600, '0000001271.jpg', 2),
(6600, '0000001270.jpg', 3),
(6600, '0000001269.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6600, 'Un jugador', 'enabled');

-- Bullet Candy Demo (App ID: 6610)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6610, 'Bullet Candy Demo', 6600, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('R C Knight Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6610, (SELECT id FROM developers WHERE name = 'R C Knight Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6610, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6610, 'minimum', '1.25GHz processor, Integrated/shared memory graphics chip, 256MB RAM, 20MB disk space'),
(6610, 'recommended', '2GHz or better processor, dedicated 128MB graphics card, 512MB RAM,20MB disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6610, 'website', 'http://www.charliesgames.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6610, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6610, 'Game demo', 'enabled');

-- Commandos: Behind Enemy Lines (App ID: 6800)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6800, 'Commandos: Behind Enemy Lines', 6800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pyro Studios Publisher : Eidos Interactive Release Date : August 28');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : August 28');
INSERT IGNORE INTO publishers (name) VALUES ('1998 Languages : English Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6800, (SELECT id FROM developers WHERE name = 'Pyro Studios Publisher : Eidos Interactive Release Date : August 28'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : August 28'), '1998-08-28');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6800, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6800, 'minimum', 'IBM PC or 100% compatible, Windows 9X/ME, Pentium II 300 MHz (or equivalent), 64 MB RAM, 100% DirectX® 8 compatible 3D Accelerator card with at least 12 MB VRAM, 100% DirectX® 8 compatible (or higher) Sound card, DirectX® 8 (DirectX 8.0a included), 4X CD-ROM drive, 2 GB uncompressed hard drive space, 100% Windows 95/98 compatible Keyboard and Mouse'),
(6800, 'recommended', 'Pentium II 450 MHz, Windows 98SE/ME, 128 MB RAM, 100% DirectX® 8 compatible 3D Accelerator card with 32 MB VRAM, 3 GB uncompressed hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(6800, 'manual', 'index.php?area=manual&AppId=6800&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6800, '0000001358.jpg', 0),
(6800, '0000001357.jpg', 1),
(6800, '0000001356.jpg', 2),
(6800, '0000001355.jpg', 3),
(6800, '0000001354.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6800, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6800, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6800, 'Blood Violence', 'enabled');

-- Commandos: Beyond the Call of Duty (App ID: 6810)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6810, 'Commandos: Beyond the Call of Duty', 6810, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pyro Studios Publisher : Eidos Interactive Release Date : April 7');
INSERT IGNORE INTO developers (name) VALUES ('1999 Languages : English Single-player Multi-player Animated Blood Animated Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : April 7');
INSERT IGNORE INTO publishers (name) VALUES ('1999 Languages : English Single-player Multi-player Animated Blood Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6810, (SELECT id FROM developers WHERE name = 'Pyro Studios Publisher : Eidos Interactive Release Date : April 7'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : April 7'), '1999-04-07');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6810, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Animated Blood Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6810, 'minimum', 'Microsoft Windows 95/98, P166MHz, 32MB RAM, 1MB SVGA card, DirectX 6.1 compatible sound card, DirectX 6.1, 225MB hard drive space'),
(6810, 'recommended', 'Pentium II 233 MHz, 64 MB RAM');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6810, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(6810, 'manual', 'index.php?area=manual&AppId=6810&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6810, '0000001500.jpg', 0),
(6810, '0000001499.jpg', 1),
(6810, '0000001498.jpg', 2),
(6810, '0000001497.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6810, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6810, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6810, 'Animated Blood Animated Violence', 'enabled');

-- Commandos: Strike Force (App ID: 6820)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6820, 'Commandos: Strike Force', 62, 'http://www.metacritic.com/games/platforms/pc/commandosstrikeforce', 6820, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pyro Studios Publisher : Eidos Interactive Release Date : April 4');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Language Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : April 4');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Language Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6820, (SELECT id FROM developers WHERE name = 'Pyro Studios Publisher : Eidos Interactive Release Date : April 4'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : April 4'), '2006-04-04');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6820, (SELECT id FROM languages WHERE name = 'English')),
(6820, (SELECT id FROM languages WHERE name = 'French')),
(6820, (SELECT id FROM languages WHERE name = 'German')),
(6820, (SELECT id FROM languages WHERE name = 'Italian')),
(6820, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Language Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6820, 'minimum', 'Microsoft Windows 2000/Windows XP, Pentium IV 1.8GHz or Athlon XP equivalent, 512MB System Memory, 100% DirectX 9.0c-compatible 64 MB 3D Accelerated Card with Pixel Shader v1.1 and Hardware TnL Support (GeForce 4Ti / Radeon 9 series), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c-compatible), Quad-speed (4x) DVD-ROM drive, 3.46Gb free disk space, 100% Windows 2000/XP compatible mouse and keyboard, Broadband connection required for online play'),
(6820, 'recommended', 'Pentium 4 2.4GHz or Athlon XP equivalent, 512MB System Memory, 100% DirectX 9.0c-compatible 128 MB 3D Accelerated Card with Pixel Shader v1.1 and Hardware TnL Support (GeForce 6000 Series / Radeon X series), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c-compatible), Eight-speed (8x) DVD-ROM drive or faster, 3.46Gb free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6820, 'website', 'http://www.commandosstrikeforce.com/'),
(6820, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(6820, 'manual', 'index.php?area=manual&AppId=6820&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6820, '0000001377.jpg', 0),
(6820, '0000001376.jpg', 1),
(6820, '0000001375.jpg', 2),
(6820, '0000001374.jpg', 3),
(6820, '0000001373.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6820, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6820, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6820, 'Blood Language Suggestive Themes Violence', 'enabled');

-- Commandos 2: Men of Courage (App ID: 6830)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6830, 'Commandos 2: Men of Courage', 87, 'http://www.metacritic.com/games/platforms/pc/commandos2', 6830, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pyro Studios Publisher : Eidos Interactive Release Date : August 30');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Single-player Multi-player Co-op Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : August 30');
INSERT IGNORE INTO publishers (name) VALUES ('2002 Languages : English Single-player Multi-player Co-op Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6830, (SELECT id FROM developers WHERE name = 'Pyro Studios Publisher : Eidos Interactive Release Date : August 30'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : August 30'), '2002-08-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6830, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6830, 'minimum', 'IBM PC or 100% compatible, Windows 9X/ME, Pentium II 300 MHz (or equivalent), 64 MB RAM, 100% DirectX® 8 compatible 3D Accelerator card with at least 12 MB VRAM, 100% DirectX® 8 compatible (or higher) Sound card, DirectX® 8 (DirectX 8.0a included), 4X CD-ROM drive, 2 GB uncompressed hard drive space, 100% Windows 95/98 compatible Keyboard and Mouse'),
(6830, 'recommended', 'Pentium II 450 MHz, Windows 98SE/ME, 128 MB RAM, 100% DirectX® 8 compatible 3D Accelerator card with 32 MB VRAM, 3 GB uncompressed hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6830, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(6830, 'manual', 'index.php?area=manual&AppId=6830&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6830, '0000001333.jpg', 0),
(6830, '0000001332.jpg', 1),
(6830, '0000001331.jpg', 2),
(6830, '0000001330.jpg', 3),
(6830, '0000001329.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6830, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6830, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6830, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6830, 'Blood Violence', 'enabled');

-- Commandos 3: Destination Berlin (App ID: 6840)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6840, 'Commandos 3: Destination Berlin', 72, 'http://www.metacritic.com/games/platforms/pc/commandos3', 6840, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pyro Studios Publisher : Eidos Interactive Release Date : October 14');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : October 14');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6840, (SELECT id FROM developers WHERE name = 'Pyro Studios Publisher : Eidos Interactive Release Date : October 14'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : October 14'), '2003-10-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6840, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6840, 'recommended', 'Pentium® 4 2.0 GHz (or Athlon(tm) XP equivalent), 512 MB, 128 MB GeForce 4ti or ATI Radeon 9xxx equivalent');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6840, 'website', 'http://www.commandosgame.com/'),
(6840, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=232'),
(6840, 'manual', 'index.php?area=manual&AppId=6840&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6840, '0000001353.jpg', 0),
(6840, '0000001352.jpg', 1),
(6840, '0000001351.jpg', 2),
(6840, '0000001350.jpg', 3),
(6840, '0000001349.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6840, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6840, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6840, 'Blood Violence', 'enabled');

-- Hitman 2: Silent Assassin (App ID: 6850)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6850, 'Hitman 2: Silent Assassin', 87, 'http://www.metacritic.com/games/platforms/pc/hitman2silentassassin', 6850, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Io Interactive Publisher : Eidos Interactive Release Date : October 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Single-player Violence Strong Sexual Content Blood');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : October 1');
INSERT IGNORE INTO publishers (name) VALUES ('2002 Languages : English Single-player Violence Strong Sexual Content Blood');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6850, (SELECT id FROM developers WHERE name = 'Io Interactive Publisher : Eidos Interactive Release Date : October 1'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : October 1'), '2002-10-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6850, (SELECT id FROM languages WHERE name = 'English Single-player Violence Strong Sexual Content Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6850, 'minimum', 'Microsoft Windows 98/ME/XP, Pentium 3 450 MHz or equivalent, 100% DirectX 8.1 compatible video card with at least 16 megabytes of video memory, 128 MB system RAM, 100% DirectX 8.1 compatible sound card, 800 MB uncompressed free hard drive space, 100% Windows 98/ME/XP compatible mouse and keyboard'),
(6850, 'recommended', 'Pentium 3 1GHz equivalent or greater, 256 MB system RAM, 100% DirectX 8.1 compatible 3D Accelerator video card with 32 MB video RAM, 100% DirectX 8.1 compatible EAX Advanced HD Sound Card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6850, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=234'),
(6850, 'manual', 'index.php?area=manual&AppId=6850&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6850, '0000001530.jpg', 0),
(6850, '0000001529.jpg', 1),
(6850, '0000001528.jpg', 2),
(6850, '0000001527.jpg', 3),
(6850, '0000001526.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6850, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6850, 'Violence Strong Sexual Content Blood', 'enabled');

-- Hitman: Blood Money (App ID: 6860)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6860, 'Hitman: Blood Money', 82, 'http://www.metacritic.com/games/platforms/pc/hitmanbloodmoney', 6860, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Io Interactive Publisher : Eidos Interactive Release Date : May 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Intense Violence Partial Nudity Sexual Themes Strong Language Use of Drugs');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : May 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Blood Intense Violence Partial Nudity Sexual Themes Strong Language Use of Drugs');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6860, (SELECT id FROM developers WHERE name = 'Io Interactive Publisher : Eidos Interactive Release Date : May 30'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : May 30'), '2006-05-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6860, (SELECT id FROM languages WHERE name = 'English Single-player Blood Intense Violence Partial Nudity Sexual Themes Strong Language Use of Drugs'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6860, 'minimum', 'Microsoft Windows� 2000/XP (Windows 95/98/ME/NT Not Supported) Pentium 4 1.5Ghz or Athlon XP Equivalent 512MB RAM 100% DirectX 9.0c compatible video card which supports Hardware TnL and Pixel Shader 2.0 (GeForce FX / Radeon 9500 or higher) 100% DirectX 9.0c Compatible Sound Card 5.0GB free disk space 100% Windows 2000/XP compatible Mouse and Keyboard (Gamepads and controller are not supported)'),
(6860, 'recommended', 'Pentium 4 2.4Ghz or Athlon XP/64-bit equivalent 1024MB RAM ATI X800 series, Nvidia GeForce 6800 series or higher video card 100% DirectX 9.0c Compatible Sound Card, Sound Blaster X-Fi series 5.0GB free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6860, 'website', 'index.php?area=game&AppId=6950&cc=US'),
(6860, 'website', 'http://www.hitman.com/'),
(6860, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=234'),
(6860, 'manual', 'index.php?area=manual&AppId=6860&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6860, '0000001415.jpg', 0),
(6860, '0000001414.jpg', 1),
(6860, '0000001413.jpg', 2),
(6860, '0000001412.jpg', 3),
(6860, '0000001411.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6860, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6860, 'Blood Intense Violence Partial Nudity Sexual Themes Strong Language Use of Drugs', 'enabled');

-- Battlestations: Midway (App ID: 6870)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6870, 'Battlestations: Midway', 76, 'http://www.metacritic.com/games/platforms/pc/battlestationsmidway', 6870, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6870, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6870, 'minimum', '(640x480, detail reduced), Windows XP Home, Pro, 64bit edition, Windows Vista, Intel Pentium 4 2Ghz or AMD Athlon XP 1800+, 512 MB RAM, 64MB RAM DirectX 9.0c compatible video card supporting Pixel shader 1.3 (GeForce4 series (not including MX cards) or Radeon 9000), DirectX 9 compatible, 6GB of Hard Drive Space, 100% Windows 2000/XP compatible mouse and keyboard'),
(6870, 'recommended', '(Up to 1280x960, all features on), Windows XP Home, Pro, 64bit edition, Windows Vista, Intel Pentium 4 2.5Ghz or AMD Athlon XP 2400+, 1 GB RAM, 128MB RAM DirectX 9.0c compatible video card supporting Pixel & Vertex shader 2.0 (nVidia 6800 Series or Radeon X800), 6GB of Hard Drive Space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6870, 'website', 'index.php?area=game&AppId=6940&l=spanish&cc=US'),
(6870, 'website', 'http://www.battlestations.net/'),
(6870, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=231'),
(6870, 'manual', 'index.php?area=manual&AppId=6870&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6870, '0000002004.jpg', 0),
(6870, '0000002003.jpg', 1),
(6870, '0000002002.jpg', 2),
(6870, '0000002001.jpg', 3),
(6870, '0000002000.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6870, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6870, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6870, 'Language Use of Alcohol Mild Suggestive Themes Violence', 'enabled');

-- Just Cause (App ID: 6880)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6880, 'Just Cause', 75, 'http://www.metacritic.com/games/platforms/pc/justcause', 6880, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Avalanche Publisher : Eidos Interactive Release Date : September 22');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Blood Drug Reference Intense Violence Language Sexual Themes');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : September 22');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Blood Drug Reference Intense Violence Language Sexual Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6880, (SELECT id FROM developers WHERE name = 'Avalanche Publisher : Eidos Interactive Release Date : September 22'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : September 22'), '2006-09-22');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6880, (SELECT id FROM languages WHERE name = 'English')),
(6880, (SELECT id FROM languages WHERE name = 'French')),
(6880, (SELECT id FROM languages WHERE name = 'German')),
(6880, (SELECT id FROM languages WHERE name = 'Italian')),
(6880, (SELECT id FROM languages WHERE name = 'Spanish Single-player Blood Drug Reference Intense Violence Language Sexual Themes'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6880, 'minimum', 'Microsoft Windows� 2000/XP. (Windows� 95/98/ME/NT not supported) Pentium IV 1.4GHz (or AMD AthlonXP 1700+ processor or higher). 256MB System Memory. 3D Hardware Accelerator Card Required - 100% DirectX� 9.0c compatible with 128 MB and Shader model 2.0. (GF FX 5700 or ATI 9500) 100% DirectX� 9.0c compatible 16-bit sound card and latest drivers 4.0GB of uncompressed free disk space (plus 600MB for Windows� 2000/XP swap file) 100% Windows� 2000/XP compatible mouse, keyboard and latest drivers'),
(6880, 'recommended', 'Pentium� IV 2.8GHz with Dual Core Technology (or Athlon 64 series). 512MB System Memory. 3D Hardware Accelerator Card Required - 100% DirectX� 9.0c compatible with 256 MB and Shader model 2.0. All nVidia� GeForce 7 series or higher. Sound Blaster� X-Fi series or higher');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6880, 'website', 'index.php?area=game&AppId=6930&cc=US'),
(6880, 'website', 'http://www.eidosinteractive.co.uk/gss/justcause/'),
(6880, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=236');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6880, '0000001407.jpg', 0),
(6880, '0000001406.jpg', 1),
(6880, '0000001405.jpg', 2),
(6880, '0000001404.jpg', 3),
(6880, '0000001403.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6880, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6880, 'Blood Drug Reference Intense Violence Language Sexual Themes', 'enabled');

-- Hitman: Codename 47 (App ID: 6900)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6900, 'Hitman: Codename 47', 73, 'http://www.metacritic.com/games/platforms/pc/hitmancodename47', 6900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Io Interactive Publisher : Eidos Interactive Release Date : November 23');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English Single-player Animated Blood Animated Violence Strong Sexual Content');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : November 23');
INSERT IGNORE INTO publishers (name) VALUES ('2000 Languages : English Single-player Animated Blood Animated Violence Strong Sexual Content');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6900, (SELECT id FROM developers WHERE name = 'Io Interactive Publisher : Eidos Interactive Release Date : November 23'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : November 23'), '2000-11-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6900, (SELECT id FROM languages WHERE name = 'English Single-player Animated Blood Animated Violence Strong Sexual Content'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6900, 'minimum', 'IBM PC or 100% compatible Microsoft Windows 95/98/ME Pentium II 300 MHz 64 MB System RAM 100% DirectX 7.0a-compatible 3d Accelerated Card with 12MB VRAM 100% DirectX 7.0a-compatible Sound Card 400Mb free uncompressed hard drive space 100% Windows 95/98/ME compatible mouse and keyboard'),
(6900, 'recommended', 'Pentium III equivalent or greater 128 MB System RAM 100% DirectX 7.0a-compatible 3d Accelerated Card with 32 MB VRAM 100% DirectX 7.0a-compatible Sound Card 400 MB free uncompressed hard drive space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=159'),
(6900, 'manual', 'index.php?area=manual&AppId=6900&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6900, '0000001544.jpg', 0),
(6900, '0000001543.jpg', 1),
(6900, '0000001542.jpg', 2),
(6900, '0000001541.jpg', 3),
(6900, '0000001540.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6900, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6900, 'Animated Blood Animated Violence Strong Sexual Content', 'enabled');

-- Deus Ex: Game of the Year Edition (App ID: 6910)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6910, 'Deus Ex: Game of the Year Edition', 90, 'http://www.metacritic.com/games/platforms/pc/deusex', 6910, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ion Storm Publisher : Eidos Interactive Release Date : June 22');
INSERT IGNORE INTO developers (name) VALUES ('2000 Languages : English Single-player Multi-player Animated Blood Animated Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : June 22');
INSERT IGNORE INTO publishers (name) VALUES ('2000 Languages : English Single-player Multi-player Animated Blood Animated Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6910, (SELECT id FROM developers WHERE name = 'Ion Storm Publisher : Eidos Interactive Release Date : June 22'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : June 22'), '2000-06-22');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6910, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Animated Blood Animated Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6910, 'minimum', '300 MHz Pentium II or equlivalent, Windows 95/98, 64 MB RAM, DirectX 7.0a compliant 3D accelerated video card 16MB VRAM, Direct X 7.0a compliant sound card, Direct X 7.0a or higher (included), 150MB uncompressed hard drive space, Keyboard and Mouse');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6910, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=233'),
(6910, 'manual', 'index.php?area=manual&AppId=6910&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6910, '0000001641.jpg', 0),
(6910, '0000001640.jpg', 1),
(6910, '0000001639.jpg', 2),
(6910, '0000001638.jpg', 3),
(6910, '0000001637.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6910, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6910, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6910, 'Animated Blood Animated Violence', 'enabled');

-- Deus Ex: Invisible War (App ID: 6920)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6920, 'Deus Ex: Invisible War', 80, 'http://www.metacritic.com/games/platforms/pc/deusexinvisiblewar', 6920, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ion Storm Publisher : Eidos Interactive Release Date : March 5');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Single-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : March 5');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Single-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6920, (SELECT id FROM developers WHERE name = 'Ion Storm Publisher : Eidos Interactive Release Date : March 5'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : March 5'), '2004-03-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6920, (SELECT id FROM languages WHERE name = 'English Single-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6920, 'minimum', ':'),
(6920, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6920, 'website', 'http://www.eidos.co.uk/gss/dxiw/'),
(6920, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=233'),
(6920, 'manual', 'index.php?area=manual&AppId=6920&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6920, '0000001648.jpg', 0),
(6920, '0000001647.jpg', 1),
(6920, '0000001646.jpg', 2),
(6920, '0000001645.jpg', 3),
(6920, '0000001644.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6920, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6920, 'Blood Violence', 'enabled');

-- Just Cause Demo (App ID: 6930)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6930, 'Just Cause Demo', 6880, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Avalanche Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Drug Reference Intense Violence Language Sexual Themes');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Game demo Blood Drug Reference Intense Violence Language Sexual Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6930, (SELECT id FROM developers WHERE name = 'Avalanche Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Drug Reference Intense Violence Language Sexual Themes'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Game demo Blood Drug Reference Intense Violence Language Sexual Themes'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6930, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood Drug Reference Intense Violence Language Sexual Themes'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6930, 'website', 'http://www.eidosinteractive.co.uk/gss/justcause/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6930, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6930, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6930, 'Blood Drug Reference Intense Violence Language Sexual Themes', 'enabled');

-- Battlestations: Midway Demo (App ID: 6940)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6940, 'Battlestations: Midway Demo', 6870, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Eidos Interactive Publisher : Eidos Interactive Languages : English Multi-player Game demo Language Use of Alcohol Mild Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Multi-player Game demo Language Use of Alcohol Mild Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6940, (SELECT id FROM developers WHERE name = 'Eidos Interactive Publisher : Eidos Interactive Languages : English Multi-player Game demo Language Use of Alcohol Mild Suggestive Themes Violence'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Multi-player Game demo Language Use of Alcohol Mild Suggestive Themes Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6940, (SELECT id FROM languages WHERE name = 'English Multi-player Game demo Language Use of Alcohol Mild Suggestive Themes Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6940, 'website', 'http://www.battlestations.net/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6940, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6940, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6940, 'Language Use of Alcohol Mild Suggestive Themes Violence', 'enabled');

-- Hitman Blood Money Demo (App ID: 6950)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6950, 'Hitman Blood Money Demo', 6860, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Io Interactive Publisher : Eidos Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6950, (SELECT id FROM developers WHERE name = 'Io Interactive Publisher : Eidos Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(6950, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6950, 'website', 'http://www.hitman.com/'),
(6950, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=234');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6950, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6950, 'Game demo', 'enabled');

-- Thief: Deadly Shadows (App ID: 6980)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (6980, 'Thief: Deadly Shadows', 85, 'http://www.metacritic.com/games/platforms/pc/thiefdeadlyshadows', 6980, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (6980, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(6980, 'minimum', 'IBM PC or 100% compatible, Windows 2000 or Windows XP, Intel Pentium IV 1.5 GHz (or AMD Athlon XP equivalent), 256 MB system memory, 64 MB video memory, Direct3D 9.0, and Pixel Shader 1.1, 100% DirectSound 9 compatible sound card, 3,000 MB free hard disk space, Keyboard and mouse'),
(6980, 'recommended', 'Intel Pentium IV 2.0 GHz (or AMD Athlon XP equivalent), 512 MB system memory, 128 MB video memory, Direct3D 9.0, and Pixel Shader 1.1');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(6980, 'website', 'http://www.eidos.co.uk/gss/thief_ds/'),
(6980, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=240'),
(6980, 'manual', 'index.php?area=manual&AppId=6980&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(6980, '0000001581.jpg', 0),
(6980, '0000001580.jpg', 1),
(6980, '0000001579.jpg', 2),
(6980, '0000001578.jpg', 3),
(6980, '0000001577.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6980, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (6980, 'Blood Violence', 'enabled');

-- Tomb Raider: Legend (App ID: 7000)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7000, 'Tomb Raider: Legend', 82, 'http://www.metacritic.com/games/platforms/pc/tombraiderlegend', 7000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Release Date : April 7');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Blood Language Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : April 7');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Blood Language Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7000, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Release Date : April 7'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : April 7'), '2006-04-07');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7000, (SELECT id FROM languages WHERE name = 'English Single-player Blood Language Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7000, 'minimum', 'Microsoft Windows 2000, XP, Pentium 3 1.0Ghz or Athlon XP Equivalent, 256MB RAM, 100% DirectX 9.0c -compatible 64 MB 3D Accelerated Card with TnL (GeForce 3Ti / Radeon 9 series), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c -compatible), 9.9GB free disk space, 100% Windows 2000/XP compatible mouse and keyboard'),
(7000, 'recommended', 'Pentium 4 2.0Ghz or Athlon XP Equivalent, 512MB RAM, 100% DirectX 9.0c -compatible 256MB 3D Accelerated Card (Nvidia GeForce 5900 / Ati 9800XT), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c -compatible), 9.9GB free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7000, 'website', 'index.php?area=game&AppId=7030&cc=US'),
(7000, 'website', 'http://www.tombraider.com/legend/'),
(7000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=241'),
(7000, 'manual', 'index.php?area=manual&AppId=7000&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7000, '0000001602.jpg', 0),
(7000, '0000001601.jpg', 1),
(7000, '0000001600.jpg', 2),
(7000, '0000001599.jpg', 3),
(7000, '0000001598.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7000, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7000, 'Blood Language Suggestive Themes Violence', 'enabled');

-- Project: Snowblind (App ID: 7010)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7010, 'Project: Snowblind', 76, 'http://www.metacritic.com/games/platforms/pc/projectsnowblind', 7010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Release Date : February 22');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : February 22');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7010, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Release Date : February 22'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : February 22'), '2005-02-22');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7010, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7010, 'minimum', 'IBM PC or 100% compatible, Microsoft Windows 2000/XP (Windows 95, 98, ME and NT are NOT SUPPORTED), Pentium IV, 1.5 GHz (Or AMD Athlon XP equivalent) processor, 100% DirectX 64 MB 3D Accelerated video card with Pixel Shader v1.1 Capability, 256 MB System RAM, 100% DirectX 9 Compatible Sound Card, 3GB free uncompressed hard drive space (additional space may be necessary for saved games), 100% Windows 2000/XP compatible Mouse and Keyboard'),
(7010, 'recommended', 'Pentium IV, 2.4 Ghz (or AMD Athlon XPequivalent) or greater processor, 512 MB System RAM, 100% DirectX 9 128MB 3D Graphics Card with Pixel Shader 2.0 support, 3GB of Hard Drive Space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7010, 'website', 'index.php?area=game&AppId=7050&cc=US'),
(7010, 'website', 'http://www.projectsnowblind.com/'),
(7010, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=237'),
(7010, 'manual', 'index.php?area=manual&AppId=7010&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7010, '0000001658.jpg', 0),
(7010, '0000001657.jpg', 1),
(7010, '0000001656.jpg', 2),
(7010, '0000001655.jpg', 3),
(7010, '0000001654.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7010, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7010, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7010, 'Blood Violence', 'enabled');

-- Rogue Trooper (App ID: 7020)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7020, 'Rogue Trooper', 69, 'http://www.metacritic.com/games/platforms/pc/roguetrooper', 7020, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Rebellion Publisher : Eidos Interactive Release Date : May 23');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Use of Alcohol Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : May 23');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Use of Alcohol Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7020, (SELECT id FROM developers WHERE name = 'Rebellion Publisher : Eidos Interactive Release Date : May 23'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : May 23'), '2006-05-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7020, (SELECT id FROM languages WHERE name = 'English')),
(7020, (SELECT id FROM languages WHERE name = 'French')),
(7020, (SELECT id FROM languages WHERE name = 'German')),
(7020, (SELECT id FROM languages WHERE name = 'Italian')),
(7020, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Use of Alcohol Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7020, 'minimum', 'IBM PC or 100% compatible, Microsoft Windows XP or 2000, Intel Pentium 4 or equivalent, 256MB RAM, 100% DirectX 9.0c-compatible 64MB 3D Accelerated Card supporting v1.1 pixel and vertex shaders, Windows XP- or 2000-compatible sound card (100% DirectX 9.0c-compatible), 3GB free disk space, 100% Windows XP- or 2000-compatible mouse and keyboard'),
(7020, 'recommended', 'Intel Pentium 4 2.0GHz or equivalent, 512MB RAM, 100% DirectX 9.0c-compatible 128MB 3D Accelerated Card supporting v2.0 pixel and vertex shaders, Windows XP- or 2000-compatible sound card (100% DirectX 9.0c-compatible), 3GB free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7020, 'website', 'http://www.eidos.co.uk/gss/roguetrooper/'),
(7020, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=239'),
(7020, 'manual', 'index.php?area=manual&AppId=7020&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7020, '0000001590.jpg', 0),
(7020, '0000001589.jpg', 1),
(7020, '0000001588.jpg', 2),
(7020, '0000001587.jpg', 3),
(7020, '0000001586.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7020, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7020, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7020, 'Blood Use of Alcohol Violence', 'enabled');

-- Tomb Raider: Legend Demo (App ID: 7030)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7030, 'Tomb Raider: Legend Demo', 7000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Language Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Game demo Blood Language Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7030, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Language Suggestive Themes Violence'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Game demo Blood Language Suggestive Themes Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7030, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood Language Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7030, 'minimum', 'Microsoft Windows 2000, XP, Pentium 3 1.0Ghz or Athlon XP Equivalent, 256MB RAM, 100% DirectX 9.0c -compatible 64 MB 3D Accelerated Card with TnL (GeForce 3Ti / Radeon 9 series), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c -compatible), 9.9GB free disk space, 100% Windows 2000/XP compatible mouse and keyboard'),
(7030, 'recommended', 'Pentium 4 2.0Ghz or Athlon XP Equivalent, 512GB RAM, 100% DirectX 9.0c -compatible 256MB 3D Accelerated Card (Nvidia GeForce 5900 / Ati 9800XT), Microsoft Windows 2000/XP compatible sound card (100% DirectX 9.0c -compatible), 9.9GB free disk space');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7030, 'website', 'http://www.tombraider.com/legend/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7030, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7030, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7030, 'Blood Language Suggestive Themes Violence', 'enabled');

-- Project: Snowblind Demo (App ID: 7050)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7050, 'Project: Snowblind Demo', 7010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7050, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7050, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7050, 'website', 'http://www.projectsnowblind.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7050, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7050, 'Game demo', 'enabled');

-- Infernal (App ID: 7060)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7060, 'Infernal', 61, 'http://www.metacritic.com/games/platforms/pc/diaboliquelicensetosin', 7060, '', 'header.jpg');

INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Erschienen am : Mai 8');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Sprachen : Englisch Einzelspieler Blood Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7060, NULL, (SELECT id FROM publishers WHERE name = 'Eidos Interactive Erschienen am : Mai 8'), NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7060, 'website', 'index.php?area=game&AppId=958&l=german&cc=US'),
(7060, 'website', 'index.php?area=game&AppId=7080&l=german&cc=US'),
(7060, 'website', 'http://www.infernalgame.com'),
(7060, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=235'),
(7060, 'manual', 'index.php?area=manual&AppId=7060&l=german');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7060, '0000001684.jpg', 0),
(7060, '0000001683.jpg', 1),
(7060, '0000001682.jpg', 2),
(7060, '0000001681.jpg', 3),
(7060, '0000001680.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7060, 'Einzelspieler', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7060, 'Blood Language Violence', 'enabled');

-- Infernal Demo (App ID: 7080)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7080, 'Infernal Demo', 7060, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Metropolis Software Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Game demo Blood Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7080, (SELECT id FROM developers WHERE name = 'Metropolis Software Publisher : Eidos Interactive Languages : English Single-player Game demo Blood Language Violence'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Game demo Blood Language Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7080, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Blood Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7080, 'minimum', 'WINDOWS 2000/XP/Vista, Pixel Shader 2.0 compatible, ATI Radeon 9600/NVidia 5950 class or better, Pentium IV 1.7 GHz or equivalent, 512 MB RAM, 2 GB Hard disk, Direct Sound compatible'),
(7080, 'recommended', 'WINDOWS 2000/XP/Vista, Pixel Shader 3.0 compatible, Dual core 3.0 GHz processor, 1024 MB RAM, 2 GB Hard disk, Direct Sound compatible');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7080, 'website', 'steam://openurl/http://www.infernalgame.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7080, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7080, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7080, 'Blood Language Violence', 'enabled');

-- Jade Empire: Special Edition (App ID: 7110)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7110, 'Jade Empire: Special Edition', 81, 'http://www.metacritic.com/games/platforms/pc/jadeempire', 7110, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7110, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7110, 'minimum', 'Windows XP, Pentium 4 1.8 GHz or AMD Athlon 1800XP, 512MB RAM, 8 GB Free HD Space, DirectX 9.0, NVIDIA GeForce 6200 or ATI 9500 or better (Shader Model 2.0 required), 100% DirectX 9.0 compatible sound card and drivers'),
(7110, 'recommended', '3 GHz Intel Pentium 4 or equivalent processor, 1GB RAM, DirectX 9.0 February 2006, ATI X600 series, NVIDIA GeForce 6800 series, or higher recommended');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7110, 'website', 'http://www.jade-empire.com'),
(7110, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=153'),
(7110, 'manual', 'index.php?area=manual&AppId=7110&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7110, '0000001324.jpg', 0),
(7110, '0000001323.jpg', 1),
(7110, '0000001322.jpg', 2),
(7110, '0000001321.jpg', 3),
(7110, '0000001320.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7110, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7110, 'Controlador activado', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7110, 'Blood and Gore Intense Violence Mild Language Suggestive Themes', 'enabled');

-- Trackmania United Forever (App ID: 7200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7200, 'Trackmania United Forever', 80, 'http://www.metacritic.com/games/platforms/pc/trackmaniaunited', 7200, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7200, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7200, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7200, 'website', 'index.php?area=game&AppId=963&l=spanish&cc=US'),
(7200, 'website', 'index.php?area=game&AppId=964&l=spanish&cc=US'),
(7200, 'website', 'index.php?area=game&AppId=965&l=spanish&cc=US'),
(7200, 'website', 'index.php?area=game&AppId=966&l=spanish&cc=US'),
(7200, 'website', 'index.php?area=game&AppId=967&l=spanish&cc=US'),
(7200, 'website', 'http://www.tm-united.com/'),
(7200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=201'),
(7200, 'manual', 'index.php?area=manual&AppId=7200&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7200, '0000004027.jpg', 0),
(7200, '0000004026.jpg', 1),
(7200, '0000004025.jpg', 2),
(7200, '0000004024.jpg', 3),
(7200, '0000004023.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7200, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7200, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7200, 'Incluye editor de niveles', 'enabled');

-- Runaway, A Road Adventure (App ID: 7210)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7210, 'Runaway, A Road Adventure', 74, 'http://www.metacritic.com/games/platforms/pc/runawayaroadadventure', 7210, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pendulo Studios Publisher : Focus Home Interactive Release Date : August 18');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Single-player Mild Violence Use of Drugs');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Release Date : August 18');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Single-player Mild Violence Use of Drugs');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7210, (SELECT id FROM developers WHERE name = 'Pendulo Studios Publisher : Focus Home Interactive Release Date : August 18'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Release Date : August 18'), '2003-08-18');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7210, (SELECT id FROM languages WHERE name = 'English Single-player Mild Violence Use of Drugs'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7210, 'minimum', 'Windows 95/98/ME/2000/XP, Pentium™ 200 MMX, 64 MB RAM, 630 MB hard disk drive, Monitor and graphics card (DirectX™ compatible) with support for 1024x768 and 16-bit color, DirectX™ compatible sound card, Mouse and keyboard');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7210, 'website', 'http://www.runaway-thegame.com/'),
(7210, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=156');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7210, '0000001554.jpg', 0),
(7210, '0000001553.jpg', 1),
(7210, '0000001552.jpg', 2),
(7210, '0000001551.jpg', 3),
(7210, '0000001550.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7210, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7210, 'Mild Violence Use of Drugs', 'enabled');

-- Runaway, The Dream of The Turtle (App ID: 7220)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7220, 'Runaway, The Dream of The Turtle', 67, 'http://www.metacritic.com/games/platforms/pc/runaway2thedreamoftheturtle', 7220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pendulo Studios Publisher : Focus Home Interactive Release Date : March 12');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Crude Humor Language Mild Violence Sexual Themes Use of Drugs');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Release Date : March 12');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Crude Humor Language Mild Violence Sexual Themes Use of Drugs');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7220, (SELECT id FROM developers WHERE name = 'Pendulo Studios Publisher : Focus Home Interactive Release Date : March 12'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Release Date : March 12'), '2007-03-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7220, (SELECT id FROM languages WHERE name = 'English Single-player Crude Humor Language Mild Violence Sexual Themes Use of Drugs'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7220, 'minimum', 'Windows 98/ME/2000/XP Pentium IV 1.6 GHz / Athlon XP 1600+ 128 MB RAM (256 MB for Windows 2000/XP) 32 MB DirectX 9-compliant video card (min 1024x768 16Bit) DirectX 9-compliant sound card DirectX 9 or higher (included on the disc) 2.5 GB free disk space(for minimal installation) Windows-compatible keyboard and mouse');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7220, 'website', 'index.php?area=game&AppId=7230&cc=US'),
(7220, 'website', 'http://www.runaway-thegame.com/'),
(7220, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=156');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7220, '0000001567.jpg', 0),
(7220, '0000001566.jpg', 1),
(7220, '0000001565.jpg', 2),
(7220, '0000001564.jpg', 3),
(7220, '0000001563.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7220, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7220, 'Crude Humor Language Mild Violence Sexual Themes Use of Drugs', 'enabled');

-- Runaway, The Dream of The Turtle Demo (App ID: 7230)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7230, 'Runaway, The Dream of The Turtle Demo', 7220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pendulo Studios Publisher : Focus Home Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7230, (SELECT id FROM developers WHERE name = 'Pendulo Studios Publisher : Focus Home Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7230, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7230, 'website', 'http://www.runaway-thegame.com/'),
(7230, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=156');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7230, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7230, 'Game demo', 'enabled');

-- Sherlock Holmes - The Awakened (App ID: 7250)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7250, 'Sherlock Holmes - The Awakened', 72, 'http://www.metacritic.com/games/platforms/pc/sherlockholmestheawakened', 7250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frogwares Publisher : Focus Home Interactive Release Date : February 16');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Release Date : February 16');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7250, (SELECT id FROM developers WHERE name = 'Frogwares Publisher : Focus Home Interactive Release Date : February 16'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Release Date : February 16'), '2007-02-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7250, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7250, 'website', 'index.php?area=game&AppId=7290&cc=US'),
(7250, 'website', 'http://www.sherlockholmes-thegame.com'),
(7250, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=318'),
(7250, 'manual', 'index.php?area=manual&AppId=7250&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7250, '0000001617.jpg', 0),
(7250, '0000001616.jpg', 1),
(7250, '0000001615.jpg', 2),
(7250, '0000001614.jpg', 3),
(7250, '0000001613.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7250, 'Single-player', 'enabled');

-- Loki (App ID: 7260)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7260, 'Loki', 62, 'http://www.metacritic.com/games/platforms/pc/loki', 7260, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7260, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7260, 'minimum', 'Windows XP/Vista 32/64-bit, Pentium4 2GHz/AthlonXP 2000+, 512 MB RAM, 64 MB DirectX 9 compatible (GeForce4 Ti/Radeon 9000), DirectX 9 compatible, DirectX: 9.0c or higher (supplied on the game DVD), Hard disk space: 7 GB, Multiplayer: LAN/broadband Internet for online play and 1 GB RAM');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7260, 'website', 'index.php?area=game&AppId=11000&l=dutch&cc=US'),
(7260, 'website', 'index.php?area=game&AppId=7280&l=dutch&cc=US'),
(7260, 'website', 'http://www.loki-game.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7260, '0000002772.jpg', 0),
(7260, '0000002771.jpg', 1),
(7260, '0000002770.jpg', 2),
(7260, '0000002769.jpg', 3),
(7260, '0000002768.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7260, 'Één speler', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7260, 'Meerdere spelers', 'enabled');

-- Loki Demo - Egyptian Sorcerer (App ID: 7280)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7280, 'Loki Demo - Egyptian Sorcerer', 7260, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cyanide Publisher : Focus Home Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7280, (SELECT id FROM developers WHERE name = 'Cyanide Publisher : Focus Home Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7280, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7280, 'minimum', 'Windows XP/Vista 32/64-bit, Pentium4 2GHz/AthlonXP 2000+, 512 MB RAM, 64 MB DirectX 9 compatible (GeForce4 Ti/Radeon 9000), DirectX 9 compatible, DirectX: 9.0c or higher (supplied on the game DVD), Hard disk space: 7 GB, Multiplayer: LAN/broadband Internet for online play and 1 GB RAM');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7280, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7280, 'Game demo', 'enabled');

-- Sherlock Holmes - The Awakened Demo (App ID: 7290)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7290, 'Sherlock Holmes - The Awakened Demo', 7250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frogwares Publisher : Focus Home Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7290, (SELECT id FROM developers WHERE name = 'Frogwares Publisher : Focus Home Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7290, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7290, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7290, 'Game demo', 'enabled');

-- Ricochet: Lost Worlds (App ID: 7400)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7400, 'Ricochet: Lost Worlds', 7400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Reflexive� Entertainment Publisher : Reflexive� Entertainment Release Date : April 20');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Reflexive� Entertainment Release Date : April 20');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7400, (SELECT id FROM developers WHERE name = 'Reflexive� Entertainment Publisher : Reflexive� Entertainment Release Date : April 20'), (SELECT id FROM publishers WHERE name = 'Reflexive� Entertainment Release Date : April 20'), '2007-04-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7400, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7400, 'website', 'index.php?area=game&AppId=7410&cc=US'),
(7400, 'manual', 'index.php?area=manual&AppId=7400&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7400, '0000001726.jpg', 0),
(7400, '0000001725.jpg', 1),
(7400, '0000001724.jpg', 2),
(7400, '0000001723.jpg', 3),
(7400, '0000001722.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7400, 'Single-player', 'enabled');

-- Ricochet: Lost Worlds Demo (App ID: 7410)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7410, 'Ricochet: Lost Worlds Demo', 7400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Reflexive� Entertainment Publisher : Reflexive� Entertainment Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Reflexive� Entertainment Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7410, (SELECT id FROM developers WHERE name = 'Reflexive� Entertainment Publisher : Reflexive� Entertainment Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Reflexive� Entertainment Single-player Game demo'), NULL);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7410, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7410, 'Game demo', 'enabled');

-- Wik & The Fable of Souls (App ID: 7420)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7420, 'Wik & The Fable of Souls', 7420, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Reflexive� Entertainment Publisher : Reflexive� Entertainment Release Date : October 19');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Reflexive� Entertainment Release Date : October 19');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7420, (SELECT id FROM developers WHERE name = 'Reflexive� Entertainment Publisher : Reflexive� Entertainment Release Date : October 19'), (SELECT id FROM publishers WHERE name = 'Reflexive� Entertainment Release Date : October 19'), '2004-10-19');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7420, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7420, 'website', 'http://www.wikgame.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7420, '0000001198.jpg', 0),
(7420, '0000001197.jpg', 1),
(7420, '0000001196.jpg', 2),
(7420, '0000001195.jpg', 3),
(7420, '0000001194.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7420, 'Single-player', 'enabled');

-- UFO: Afterlight (App ID: 7500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7500, 'UFO: Afterlight', 71, 'http://www.metacritic.com/games/platforms/pc/ufoafterlight', 7500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('ALTAR Games Publisher : Topware Interactive Release Date : February 9');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Topware Interactive Release Date : February 9');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7500, (SELECT id FROM developers WHERE name = 'ALTAR Games Publisher : Topware Interactive Release Date : February 9'), (SELECT id FROM publishers WHERE name = 'Topware Interactive Release Date : February 9'), '2007-02-09');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7500, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7500, 'minimum', 'Windows 2000/XP with DirectX 8.1, 1 GHz CPU, 512 MB RAM, 5 GB Hard Disk Space, Nvidia 5700 or ATI Radeon 9500 video card, Sound Blaster compatible sound card'),
(7500, 'recommended', 'Windows 2000/XP with DirectX 9.0c, 2 GHz CPU, 768 MB RAM, 5 GB Hard Disk Space, Nvidia 6600 GT, or ATI Radeon 9800 video card, Sound Blaster® X-Fi™ sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7500, 'website', 'http://www.ufo-afterlight.com/pages/hq.html'),
(7500, 'manual', 'index.php?area=manual&AppId=7500&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7500, '0000001856.jpg', 0),
(7500, '0000001855.jpg', 1),
(7500, '0000001854.jpg', 2),
(7500, '0000001853.jpg', 3),
(7500, '0000001852.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7500, 'Single-player', 'enabled');

-- Sid Meier''s Railroads! (App ID: 7600)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7600, 'Sid Meier''s Railroads!', 77, 'http://www.metacritic.com/games/platforms/pc/sidmeiersrailroads', 7600, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Release Date : October 16');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Alcohol Reference');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : October 16');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Alcohol Reference');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7600, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Release Date : October 16'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : October 16'), '2006-10-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7600, (SELECT id FROM languages WHERE name = 'English')),
(7600, (SELECT id FROM languages WHERE name = 'French')),
(7600, (SELECT id FROM languages WHERE name = 'German')),
(7600, (SELECT id FROM languages WHERE name = 'Italian')),
(7600, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Alcohol Reference'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7600, 'minimum', 'Windows 2000 (plus Service Pack 1 or higher), Windows XP Home or Professional (plus Service Pack 1 or higher), 1.4GHz Intel Pentium 4 or AMD Athlon processor or equivalent, 512MB RAM, 64 MB video card with hardware pixel and vertex shaders (GeForce 3, Radeon 8500 or better), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)'),
(7600, 'recommended', '2.0 GHz Intel Pentium 4 or AMD Athlon processor or equivalent (or better), 1Gb RAM, 128 MB video card with pixel shader 2.0 support (Radeon x800, nVidia 6800)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7600, 'website', 'index.php?area=game&AppId=7630&cc=US'),
(7600, 'website', 'http://www.2kgames.com/railroads/railroads.html'),
(7600, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=182'),
(7600, 'manual', 'index.php?area=manual&AppId=7600&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7600, '0000001768.jpg', 0),
(7600, '0000001767.jpg', 1),
(7600, '0000001766.jpg', 2),
(7600, '0000001765.jpg', 3),
(7600, '0000001764.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7600, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7600, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7600, 'Alcohol Reference', 'enabled');

-- Railroad Tycoon 3 (App ID: 7610)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7610, 'Railroad Tycoon 3', 80, 'http://www.metacritic.com/games/platforms/pc/railroadtycoon3', 7610, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopTop Publisher : 2K Games Release Date : October 23');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Alcohol Reference');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : October 23');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Alcohol Reference');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7610, (SELECT id FROM developers WHERE name = 'PopTop Publisher : 2K Games Release Date : October 23'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : October 23'), '2003-10-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7610, (SELECT id FROM languages WHERE name = 'English')),
(7610, (SELECT id FROM languages WHERE name = 'French')),
(7610, (SELECT id FROM languages WHERE name = 'German')),
(7610, (SELECT id FROM languages WHERE name = 'Italian')),
(7610, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Alcohol Reference'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7610, 'minimum', 'Windows 98/Me/2000/XP, 400 mhz, 128 MB RAM, 1.2 GB Free Disk Space, 16 MB 3D Video Card, mouse, and keyboard, DirectX compatible sound card with speakers/headphones recommended');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7610, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=220'),
(7610, 'manual', 'index.php?area=manual&AppId=7610&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7610, '0000001815.jpg', 0),
(7610, '0000001814.jpg', 1),
(7610, '0000001813.jpg', 2),
(7610, '0000001812.jpg', 3),
(7610, '0000001811.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7610, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7610, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7610, 'Alcohol Reference', 'enabled');

-- Railroad Tycoon II Platinum (App ID: 7620)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7620, 'Railroad Tycoon II Platinum', 89, 'http://www.metacritic.com/games/platforms/pc/railroadtycoon2', 7620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('PopTop Publisher : 2K Games Release Date : October 31');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : October 31');
INSERT IGNORE INTO publishers (name) VALUES ('1998 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7620, (SELECT id FROM developers WHERE name = 'PopTop Publisher : 2K Games Release Date : October 31'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : October 31'), '1998-10-31');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7620, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7620, 'minimum', 'Windows 95/98, Pentium 133 (recommended 166), 16 MB Ram, 100 MB disk space, 1024x768 capable video card AND a monitor capable of this resolution');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7620, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=220'),
(7620, 'manual', 'index.php?area=manual&AppId=7620&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7620, '0000001801.jpg', 0),
(7620, '0000001800.jpg', 1),
(7620, '0000001799.jpg', 2),
(7620, '0000001798.jpg', 3),
(7620, '0000001797.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7620, 'Single-player', 'enabled');

-- Sid Meier''s Railroads! Demo (App ID: 7630)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7630, 'Sid Meier''s Railroads! Demo', 77, 'http://www.metacritic.com/games/platforms/pc/sidmeiersrailroads', 7600, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7630, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = '2K Games Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7630, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7630, 'minimum', 'Windows 2000 (plus Service Pack 1 or higher), Windows XP Home or Professional (plus Service Pack 1 or higher), 1.4GHz Intel Pentium 4 or AMD Athlon processor or equivalent, 512MB RAM, 64 MB video card with hardware pixel and vertex shaders (GeForce 3, Radeon 8500 or better), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)'),
(7630, 'recommended', '2.0 GHz Intel Pentium 4 or AMD Athlon processor or equivalent (or better), 1Gb RAM, 128 MB video card with pixel shader 2.0 support (Radeon x800, nVidia 6800)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7630, 'website', 'http://www.2kgames.com/railroads/railroads.html');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7630, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7630, 'Game demo', 'enabled');

-- X-COM: Terror From the Deep (App ID: 7650)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7650, 'X-COM: Terror From the Deep', 7650, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('MicroProse Software');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : 2K Games Release Date : April 1');
INSERT IGNORE INTO developers (name) VALUES ('1995 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : April 1');
INSERT IGNORE INTO publishers (name) VALUES ('1995 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7650, (SELECT id FROM developers WHERE name = 'MicroProse Software'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : April 1'), '1995-04-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7650, (SELECT id FROM languages WHERE name = 'English')),
(7650, (SELECT id FROM languages WHERE name = 'French')),
(7650, (SELECT id FROM languages WHERE name = 'German')),
(7650, (SELECT id FROM languages WHERE name = 'Spanish Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7650, 'minimum', 'Windows XP*, 33MHz 386, 4MB RAM, 520KB Free Disk Space, DirectX 6.1 or later');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7650, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=225'),
(7650, 'manual', 'index.php?area=manual&AppId=7650&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7650, '0000001863.jpg', 0),
(7650, '0000001862.jpg', 1),
(7650, '0000001861.jpg', 2),
(7650, '0000001860.jpg', 3),
(7650, '0000001859.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7650, 'Single-player', 'enabled');

-- BioShock Demo (App ID: 7710)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7710, 'BioShock Demo', 95, 'http://www.metacritic.com/games/platforms/pc/bioshock', 7670, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7710, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7710, 'minimum', 'Operating System: Windows XP (with Service Pack 2) or Windows Vista, CPU: Intel single-core Pentium 4 processor at 2.4GHz, System RAM: 1 GB, Video Card: Direct X 9.0c compliant video card with 128MB RAM and Pixel Shader 3.0 (NVIDIA 6600 or better/ATI X1300 or better, excluding ATI X1550), Sound Card: 100% direct X 9.0c compatible sound card, 8GB of free hard drive space'),
(7710, 'recommended', 'CPU: Intel Core 2 Duo processor; System RAM: 2GB; Video Card: DX 9 - Direct X 9.0c compliant video card with 512 MB RAM and Pixel Shader 3.0 (NVIDIA GeForce 7900 GT or better), DX 10 - NVIDIA GeForce 8600 or better; Sound Card: SoundBlaster(r) X-Fi(tm) series (optimized foruse with Creative Labs EAX ADVANCED HD 4.0 or EAX ADVANCED HD 5.0 compatible sound cards);');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7710, 'website', 'http://www.BioShockGame.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7710, 'Één speler', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7710, 'Speldemo', 'enabled');

-- Top Spin 2 (App ID: 7810)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7810, 'Top Spin 2', 70, 'http://www.metacritic.com/games/platforms/pc/topspin2', 7810, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Aspyr Studios Publisher : Aspyr Media');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : December 1');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Controller enabled');
INSERT IGNORE INTO publishers (name) VALUES ('Aspyr Media');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : December 1');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Controller enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7810, (SELECT id FROM developers WHERE name = 'Aspyr Studios Publisher : Aspyr Media'), (SELECT id FROM publishers WHERE name = 'Aspyr Media'), '2006-12-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7810, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Controller enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7810, 'minimum', 'Windows XP with Service Pack 2, Intel Pentium 4 2.0 GHz or AMD Athlon 64 3200+, 512 MB RAM, 4.5 GB of free disk space, DirectX 9.0c compatible sound card, 3D Hardware Accelerator Card Required – 100% DirectX 9.0c compatible 128 MB with latest drivers, Windows XP compatible mouse and keyboard with latest drivers'),
(7810, 'recommended', '3D Hardware Accelerator Card Required – 100% DirectX 9.0c compatible 256 MB with latest drivers, Geforce 6800 or Radeon X800, 1024 MB RAM, Internet play requires broadband connection and latest drivers');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7810, 'website', 'http://www.aspyr.com/product/info/58'),
(7810, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=197'),
(7810, 'manual', 'index.php?area=manual&AppId=7810&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7810, '0000001886.jpg', 0),
(7810, '0000001885.jpg', 1),
(7810, '0000001884.jpg', 2),
(7810, '0000001883.jpg', 3),
(7810, '0000001882.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7810, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7810, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7810, 'Controller', 'enabled');

-- The Movies (App ID: 7900)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7900, 'The Movies', 84, 'http://www.metacritic.com/games/platforms/pc/movies', 7900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Lionhead Studios Publisher : Activision Release Date : November 8');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Dutch');
INSERT IGNORE INTO developers (name) VALUES ('Polish Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : November 8');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Dutch');
INSERT IGNORE INTO publishers (name) VALUES ('Polish Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7900, (SELECT id FROM developers WHERE name = 'Lionhead Studios Publisher : Activision Release Date : November 8'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : November 8'), '2005-11-08');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7900, (SELECT id FROM languages WHERE name = 'English')),
(7900, (SELECT id FROM languages WHERE name = 'French')),
(7900, (SELECT id FROM languages WHERE name = 'German')),
(7900, (SELECT id FROM languages WHERE name = 'Italian')),
(7900, (SELECT id FROM languages WHERE name = 'Spanish')),
(7900, (SELECT id FROM languages WHERE name = 'Dutch')),
(7900, (SELECT id FROM languages WHERE name = 'Polish Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7900, 'minimum', 'Microsoft Windows 98SE/ME/2000/XP, 800MHz processor or higher, 256MB RAM, 2.4 GB free hard disk space, DirectX 9.0c compatible 16-bit sound card, Mouse, Keyboard, DirectX® 9.0c (included) Updated Windows Media® Player 9 Codecs (included), 800 x 600 Monitor Resolution, 3D Hardware Accelerator Card required, Updated drivers for all hardware');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7900, 'website', 'index.php?area=game&AppId=7920&cc=US'),
(7900, 'website', 'http://movies.lionhead.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7900, '0000001935.jpg', 0),
(7900, '0000001934.jpg', 1),
(7900, '0000001933.jpg', 2),
(7900, '0000001932.jpg', 3),
(7900, '0000001931.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7900, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7900, 'Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence', 'enabled');

-- The Movies: Stunts and Effects (App ID: 7910)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7910, 'The Movies: Stunts and Effects', 78, 'http://www.metacritic.com/games/platforms/pc/moviesstuntsandeffects', 7910, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Lionhead Studios Publisher : Activision Release Date : June 6');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : June 6');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7910, (SELECT id FROM developers WHERE name = 'Lionhead Studios Publisher : Activision Release Date : June 6'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : June 6'), '2006-06-06');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7910, (SELECT id FROM languages WHERE name = 'English')),
(7910, (SELECT id FROM languages WHERE name = 'German Single-player Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(7910, 'minimum', 'Microsoft Windows 98SE/ME/2000/XP, 800MHz processor or higher, 256MB RAM, 100% DirectX 9.0c compatible 16-bit sound card and latest drivers, 100% Windows 98SE/ME/2000/XP compatible mouse, keyboard and latest drivers, DirectX 9.0c (included), Updated Windows Media Player 9 Codecs (included), 800 x 600 Monitor Resolution, 3D Hardware Accelerator Card required - 100% DirectX 9.0c compatible 32MB Hardware T&L-capable video card and latest drivers*');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7910, 'website', 'http://movies.lionhead.com/'),
(7910, 'manual', 'index.php?area=manual&AppId=7910&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(7910, '0000001954.jpg', 0),
(7910, '0000001953.jpg', 1),
(7910, '0000001952.jpg', 2),
(7910, '0000001951.jpg', 3),
(7910, '0000001950.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7910, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7910, 'Blood and Gore Crude Humor Mild Language Sexual Themes Use of Alcohol and Tobacco Violence', 'enabled');

-- The Movies Demo (App ID: 7920)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (7920, 'The Movies Demo', 7900, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Lionhead Studios Publisher : Activision Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (7920, (SELECT id FROM developers WHERE name = 'Lionhead Studios Publisher : Activision Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Activision Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(7920, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(7920, 'website', 'http://movies.lionhead.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7920, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (7920, 'Game demo', 'enabled');

-- Tomb Raider: Anniversary (App ID: 8000)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8000, 'Tomb Raider: Anniversary', 83, 'http://www.metacritic.com/games/platforms/pc/laracrofttombraideranniversary', 8000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Release Date : June 5');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Controller enabled Mild Suggestive Themes Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : June 5');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Controller enabled Mild Suggestive Themes Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8000, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Release Date : June 5'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : June 5'), '2007-06-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8000, (SELECT id FROM languages WHERE name = 'English')),
(8000, (SELECT id FROM languages WHERE name = 'French')),
(8000, (SELECT id FROM languages WHERE name = 'German')),
(8000, (SELECT id FROM languages WHERE name = 'Italian')),
(8000, (SELECT id FROM languages WHERE name = 'Spanish Single-player Controller enabled Mild Suggestive Themes Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8000, 'minimum', 'Microsoft Windows Vista, 2000, or XP, Pentium 3 1.4Ghz or Athlon XP 1500+, 4GB free space, 100% DirectX 9.0c compatible 64 MB 3D Accelerated Card with TnL (GeForce 3TI / Radeon 9 series), 512MB RAM (Windows Vista) or 256MB RAM (Windows 2000/XP), Microsoft Windows 2000/XP/Vista compatible sound card (100% DirectX 9.0c –compatible), 100% Windows 2000/XP/Vista compatible mouse and keyboard'),
(8000, 'recommended', 'Microsoft Windows XP, Vista, Pentium 4 3.0Ghz or Athlon 64 3000+, Microsoft Windows XP/Vista compatible sound card (100% DirectX 9.0c –compatible), 1GB RAM, 100% DirectX 9.0c compatible 64MB 3D Accelerated Card with Pixel Shader 2.0 (GeForce 6000 series / Radeon X series)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8000, 'website', 'index.php?area=game&AppId=8030&cc=US'),
(8000, 'website', 'http://www.tombraider.com/anniversary/'),
(8000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=241'),
(8000, 'manual', 'index.php?area=manual&AppId=8000&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8000, '0000002096.jpg', 0),
(8000, '0000002095.jpg', 1),
(8000, '0000002094.jpg', 2),
(8000, '0000002093.jpg', 3),
(8000, '0000002092.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8000, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8000, 'Controller', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8000, 'Mild Suggestive Themes Violence', 'enabled');

-- Ancient Wars: Sparta (App ID: 8010)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8010, 'Ancient Wars: Sparta', 59, 'http://www.metacritic.com/games/platforms/pc/ancientwarssparta', 8010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('World Forge Publisher : Eidos Interactive Release Date : April 24');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German Single-player Multi-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : April 24');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German Single-player Multi-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8010, (SELECT id FROM developers WHERE name = 'World Forge Publisher : Eidos Interactive Release Date : April 24'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : April 24'), '2007-04-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8010, (SELECT id FROM languages WHERE name = 'English')),
(8010, (SELECT id FROM languages WHERE name = 'French')),
(8010, (SELECT id FROM languages WHERE name = 'German Single-player Multi-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8010, 'minimum', 'Microsoft Windows Vista, 2000 or XP (admin rights required) Windows 95/98/ME/NT4 are not supported, Intel Pentium®4 2.4 GHz or equivalent, 512 MB RAM, GeForce 6600GT/ATI Radeon X800Pro or better with 128 MB, Direct X 9.0c compatible sound card, 4 GB Free Space'),
(8010, 'recommended', 'Pentium Intel Pentium®4 3.0 GHz or equivalent, 2048 MB RAM, GeForce 7900GTX/ATI Radeon X1900XT with 256 MB or higher, Direct X 9.0c compatible sound card');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8010, 'website', 'http://www.ancientwarssparta.com/'),
(8010, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=230'),
(8010, 'manual', 'index.php?area=manual&AppId=8010&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8010, '0000001694.jpg', 0),
(8010, '0000001693.jpg', 1),
(8010, '0000001692.jpg', 2),
(8010, '0000001691.jpg', 3),
(8010, '0000001690.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8010, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8010, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8010, 'Blood Violence', 'enabled');

-- Tomb Raider: Anniversary Demo (App ID: 8030)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8030, 'Tomb Raider: Anniversary Demo', 8000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Crystal Dynamics Publisher : Eidos Interactive Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8030, (SELECT id FROM developers WHERE name = 'Crystal Dynamics Publisher : Eidos Interactive Languages : English'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8030, (SELECT id FROM languages WHERE name = 'English')),
(8030, (SELECT id FROM languages WHERE name = 'French')),
(8030, (SELECT id FROM languages WHERE name = 'German')),
(8030, (SELECT id FROM languages WHERE name = 'Italian')),
(8030, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8030, 'minimum', 'Microsoft Windows Vista, 2000, or XP, Pentium 3 1.4Ghz or Athlon XP 1500+, 4GB free space, 100% DirectX 9.0c compatible 64 MB 3D Accelerated Card with TnL (GeForce 3TI / Radeon 9 series), 512MB RAM (Windows Vista) or 256MB RAM (Windows 2000/XP), Microsoft Windows 2000/XP/Vista compatible sound card (100% DirectX 9.0c �compatible), 100% Windows 2000/XP/Vista compatible mouse and keyboard'),
(8030, 'recommended', 'Microsoft Windows XP, Vista, Pentium 4 3.0Ghz or Athlon 64 3000+, Microsoft Windows XP/Vista compatible sound card (100% DirectX 9.0c �compatible), 1GB RAM, 100% DirectX 9.0c compatible 64MB 3D Accelerated Card with Pixel Shader 2.0 (GeForce 6000 series / Radeon X series)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8030, 'website', 'http://www.tombraider.com/anniversary/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8030, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8030, 'Game demo', 'enabled');

-- Conflict: Denied Ops Demo (App ID: 8090)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8090, 'Conflict: Denied Ops Demo', 8100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pivotal Games Publisher : Eidos Interactive Languages : English Single-player Multi-player Co-op Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Languages : English Single-player Multi-player Co-op Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8090, (SELECT id FROM developers WHERE name = 'Pivotal Games Publisher : Eidos Interactive Languages : English Single-player Multi-player Co-op Game demo'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Languages : English Single-player Multi-player Co-op Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8090, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8090, 'minimum', ':'),
(8090, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8090, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=347');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8090, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8090, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8090, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8090, 'Game demo', 'enabled');

-- Conflict: Denied Ops (App ID: 8100)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8100, 'Conflict: Denied Ops', 57, 'http://www.metacritic.com/games/platforms/pc/crossfire', 8100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pivotal Games Publisher : Eidos Interactive Release Date : February 8');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Italian Single-player Multi-player Co-op');
INSERT IGNORE INTO publishers (name) VALUES ('Eidos Interactive Release Date : February 8');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Italian Single-player Multi-player Co-op');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8100, (SELECT id FROM developers WHERE name = 'Pivotal Games Publisher : Eidos Interactive Release Date : February 8'), (SELECT id FROM publishers WHERE name = 'Eidos Interactive Release Date : February 8'), '2008-02-08');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8100, (SELECT id FROM languages WHERE name = 'English')),
(8100, (SELECT id FROM languages WHERE name = 'Spanish')),
(8100, (SELECT id FROM languages WHERE name = 'French')),
(8100, (SELECT id FROM languages WHERE name = 'Italian Single-player Multi-player Co-op'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8100, 'minimum', ':'),
(8100, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8100, 'website', 'index.php?area=game&AppId=8090&cc=US'),
(8100, 'website', 'http://www.conflictdeniedops.com/'),
(8100, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=347'),
(8100, 'manual', 'index.php?area=manual&AppId=8100&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8100, '0000003192.jpg', 0),
(8100, '0000003191.jpg', 1),
(8100, '0000003190.jpg', 2),
(8100, '0000003189.jpg', 3),
(8100, '0000003188.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8100, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8100, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8100, 'Co-op', 'enabled');

-- Sam & Max: Episode 1 (App ID: 8200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8200, 'Sam & Max: Episode 1', 81, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode1cultureshock', 8200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : October 17');
INSERT IGNORE INTO developers (name) VALUES ('2006 Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : October 17');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8200, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : October 17'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : October 17'), '2006-10-17');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8200, 'website', 'http://www.telltalegames.com/samandmax/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8200, '0000002136.jpg', 0),
(8200, '0000002135.jpg', 1),
(8200, '0000002134.jpg', 2),
(8200, '0000002133.jpg', 3),
(8200, '0000002132.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8200, 'Single-player', 'enabled');

-- Sam & Max: Episode 2 (App ID: 8210)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8210, 'Sam & Max: Episode 2', 79, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode2situationcomedy', 8210, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : December 20');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : December 20');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8210, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : December 20'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : December 20'), '2006-12-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8210, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8210, 'website', 'http://www.telltalegames.com/samandmax');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8210, '0000002148.jpg', 0),
(8210, '0000002147.jpg', 1),
(8210, '0000002146.jpg', 2),
(8210, '0000002145.jpg', 3),
(8210, '0000002144.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8210, 'Single-player', 'enabled');

-- Sam & Max: Episode 3 (App ID: 8220)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8220, 'Sam & Max: Episode 3', 74, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode3themole', 8220, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : January 25');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : January 25');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8220, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : January 25'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : January 25'), '2007-01-25');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8220, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8220, 'website', 'http://www.telltalegames.com/samandmax');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8220, '0000002154.jpg', 0),
(8220, '0000002153.jpg', 1),
(8220, '0000002152.jpg', 2),
(8220, '0000002151.jpg', 3),
(8220, '0000002150.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8220, 'Single-player', 'enabled');

-- Sam & Max: Episode 4 (App ID: 8230)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8230, 'Sam & Max: Episode 4', 80, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode4abelincolnmustdie', 8230, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : February 22');
INSERT IGNORE INTO developers (name) VALUES ('2007 Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : February 22');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8230, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : February 22'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : February 22'), '2007-02-22');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8230, 'website', 'http://www.telltalegames.com/samandmax/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8230, '0000002160.jpg', 0),
(8230, '0000002159.jpg', 1),
(8230, '0000002158.jpg', 2),
(8230, '0000002157.jpg', 3),
(8230, '0000002156.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8230, 'Single-player', 'enabled');

-- Sam & Max: Episode 5 (App ID: 8240)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8240, 'Sam & Max: Episode 5', 82, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode5reality20', 972, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : March 29');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : March 29');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8240, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : March 29'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : March 29'), '2007-03-29');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8240, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8240, 'website', 'http://www.telltalegames.com/samandmax');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8240, '0000002165.jpg', 0),
(8240, '0000002164.jpg', 1),
(8240, '0000002163.jpg', 2),
(8240, '0000002162.jpg', 3),
(8240, '0000002161.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8240, 'Single-player', 'enabled');

-- Sam & Max: Episode 6 (App ID: 8250)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8250, 'Sam & Max: Episode 6', 79, 'http://www.metacritic.com/games/platforms/pc/samandmaxepisode6brightsideofthemoon', 8250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Telltale Games Publisher : Telltale Games Release Date : April 26');
INSERT IGNORE INTO developers (name) VALUES ('2007 Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('Telltale Games Release Date : April 26');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8250, (SELECT id FROM developers WHERE name = 'Telltale Games Publisher : Telltale Games Release Date : April 26'), (SELECT id FROM publishers WHERE name = 'Telltale Games Release Date : April 26'), '2007-04-26');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8250, 'website', 'http://www.telltalegames.com/samandmax/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8250, '0000002175.jpg', 0),
(8250, '0000002174.jpg', 1),
(8250, '0000002173.jpg', 2),
(8250, '0000002172.jpg', 3),
(8250, '0000002171.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8250, 'Single-player', 'enabled');

-- Geometry Wars: Retro Evolved (App ID: 8400)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8400, 'Geometry Wars: Retro Evolved', 76, 'http://www.metacritic.com/games/platforms/pc/geometrywarsretroevolved', 8400, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8400, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8400, 'minimum', 'Windows XP, 1 GHz 32-bit (x86) or 64-bit (x64) CPU, 512MB RAM, DirectX 9.0c, DirectX Video Card (128MB memory - Shader Model 2.0 support required), DirectSound-compatible sound card, 150MB free HD space, WEI Rating: 4.0 (3.0 required)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8400, 'website', 'http://www.bizarrecreations.com/gwre.php'),
(8400, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=216');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8400, '0000002232.jpg', 0),
(8400, '0000002231.jpg', 1),
(8400, '0000002230.jpg', 2),
(8400, '0000002226.jpg', 3),
(8400, '0000002225.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8400, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8400, 'Controlador activado', 'enabled');

-- EVE Online (App ID: 8500)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8500, 'EVE Online', 8500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('CCP Publisher : CCP Release Date : May 1');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Russian Multi-player Violence');
INSERT IGNORE INTO publishers (name) VALUES ('CCP Release Date : May 1');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Russian Multi-player Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8500, (SELECT id FROM developers WHERE name = 'CCP Publisher : CCP Release Date : May 1'), (SELECT id FROM publishers WHERE name = 'CCP Release Date : May 1'), '2003-05-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8500, (SELECT id FROM languages WHERE name = 'English')),
(8500, (SELECT id FROM languages WHERE name = 'German')),
(8500, (SELECT id FROM languages WHERE name = 'Russian Multi-player Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8500, 'minimum', ':'),
(8500, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8500, 'website', 'http://www.eve-online.com'),
(8500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=344'),
(8500, 'manual', 'index.php?area=manual&AppId=8500&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8500, '0000003482.jpg', 0),
(8500, '0000003481.jpg', 1),
(8500, '0000003480.jpg', 2),
(8500, '0000003479.jpg', 3),
(8500, '0000003478.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8500, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8500, 'Violence', 'enabled');

-- RACE 07 (App ID: 8600)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8600, 'RACE 07', 83, 'http://www.metacritic.com/games/platforms/pc/race07theofficialwtccgame', 8600, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8600, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8600, 'minimum', ':'),
(8600, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8600, 'website', 'index.php?area=game&AppId=99001&l=spanish&cc=US'),
(8600, 'website', 'index.php?area=game&AppId=4260&l=spanish&cc=US'),
(8600, 'website', 'http://www.race-game.org/race07/index.htm'),
(8600, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=115'),
(8600, 'manual', 'index.php?area=manual&AppId=8600&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8600, '0000002666.jpg', 0),
(8600, '0000002665.jpg', 1),
(8600, '0000002664.jpg', 2),
(8600, '0000002663.jpg', 3),
(8600, '0000002662.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8600, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8600, 'Multijugador', 'enabled');

-- Attack on Pearl Harbor (App ID: 8620)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8620, 'Attack on Pearl Harbor', 64, 'http://www.metacritic.com/games/platforms/pc/attackonpearlharbor', 8620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Legendo Entertainment AB Publisher : SimBin Game ‘n Gear AB Release Date : June 22');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Violence');
INSERT IGNORE INTO publishers (name) VALUES ('SimBin Game ‘n Gear AB Release Date : June 22');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8620, (SELECT id FROM developers WHERE name = 'Legendo Entertainment AB Publisher : SimBin Game ‘n Gear AB Release Date : June 22'), (SELECT id FROM publishers WHERE name = 'SimBin Game ‘n Gear AB Release Date : June 22'), '2007-06-22');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8620, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8620, 'minimum', 'Windows 2000/XP/Vista, 2.0 Ghz CPU, 512MB RAM, 500MB free HD space, 3D card with 64MB RAM (128 recommended), DirectX 9.0 or later');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8620, 'website', 'index.php?area=game&AppId=900514&l=English&cc=US'),
(8620, 'website', 'index.php?area=game&AppId=8630&l=English&cc=US'),
(8620, 'website', 'http://www.pearlharbor-game.com/'),
(8620, 'manual', 'index.php?area=manual&AppId=8620&l=English');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8620, '0000001974.jpg', 0),
(8620, '0000001973.jpg', 1),
(8620, '0000001972.jpg', 2),
(8620, '0000001971.jpg', 3),
(8620, '0000001970.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8620, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8620, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8620, 'Violence', 'enabled');

-- Attack on Pearl Harbor Demo (App ID: 8630)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8630, 'Attack on Pearl Harbor Demo', 8620, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Legendo Entertainment AB Publisher : SimBin Game ‘n Gear AB Languages : English Single-player Multi-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('SimBin Game ‘n Gear AB Languages : English Single-player Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8630, (SELECT id FROM developers WHERE name = 'Legendo Entertainment AB Publisher : SimBin Game ‘n Gear AB Languages : English Single-player Multi-player Game demo'), (SELECT id FROM publishers WHERE name = 'SimBin Game ‘n Gear AB Languages : English Single-player Multi-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8630, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8630, 'minimum', 'Windows 2000/XP/Vista, 2.0 Ghz CPU, 512MB RAM, 500MB free HD space, 3D card with 64MB RAM (128 recommended), DirectX 9.0 or later');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8630, 'website', 'http://www.pearlharbor-game.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8630, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8630, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8630, 'Game demo', 'enabled');

-- Civilization IV: Beyond the Sword (App ID: 8800)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8800, 'Civilization IV: Beyond the Sword', 86, 'http://www.metacritic.com/games/platforms/pc/civilization4beyondthesword', 8800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Release Date : July 24');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Violence');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Release Date : July 24');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8800, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Release Date : July 24'), (SELECT id FROM publishers WHERE name = '2K Games Release Date : July 24'), '2007-07-24');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8800, (SELECT id FROM languages WHERE name = 'English')),
(8800, (SELECT id FROM languages WHERE name = 'French')),
(8800, (SELECT id FROM languages WHERE name = 'German')),
(8800, (SELECT id FROM languages WHERE name = 'Italian')),
(8800, (SELECT id FROM languages WHERE name = 'Spanish Single-player Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8800, 'minimum', 'Windows 2000 (plus Service Pack 1 or higher), Windows XP Home or Professional (plus Service Pack 1 or higher), or Windows Vista; 1.2GHz Intel Pentium 4 or AMD Athlon processor, 256 MB RAM, 64 MB video card with hardware T&L (GeForce 2, Radeon 7500 or better), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)'),
(8800, 'recommended', '1.8GHz Intel Pentium 4 or AMD Athlon processor or equivalent (or better), 512 MB RAM, 128 MB video card with DirectX 8 support (pixel and vertex shaders), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8800, 'website', 'index.php?area=game&AppId=8820&cc=US'),
(8800, 'website', 'http://www.2kgames.com/civ4/beyondthesword/'),
(8800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=221'),
(8800, 'manual', 'index.php?area=manual&AppId=8800&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(8800, '0000002330.jpg', 0),
(8800, '0000002329.jpg', 1),
(8800, '0000002328.jpg', 2),
(8800, '0000002327.jpg', 3),
(8800, '0000002326.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8800, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8800, 'Violence', 'enabled');

-- Civilization IV: Beyond the Sword Demo (App ID: 8820)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (8820, 'Civilization IV: Beyond the Sword Demo', 8800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Firaxis Games Publisher : 2K Games Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('2K Games Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (8820, (SELECT id FROM developers WHERE name = 'Firaxis Games Publisher : 2K Games Languages : English'), (SELECT id FROM publishers WHERE name = '2K Games Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(8820, (SELECT id FROM languages WHERE name = 'English')),
(8820, (SELECT id FROM languages WHERE name = 'French')),
(8820, (SELECT id FROM languages WHERE name = 'German')),
(8820, (SELECT id FROM languages WHERE name = 'Italian')),
(8820, (SELECT id FROM languages WHERE name = 'Spanish Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(8820, 'minimum', 'Windows 2000 (plus Service Pack 1 or higher), Windows XP Home or Professional (plus Service Pack 1 or higher), or Windows Vista; 1.2GHz Intel Pentium 4 or AMD Athlon processor, 256 MB RAM, 64 MB video card with hardware T&L (GeForce 2, Radeon 7500 or better), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)'),
(8820, 'recommended', '1.8GHz Intel Pentium 4 or AMD Athlon processor or equivalent (or better), 512 MB RAM, 128 MB video card with DirectX 8 support (pixel and vertex shaders), DirectX 7 compatible sound card, 1.7 GB of free hard drive space, DirectX 9.0c (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(8820, 'website', 'http://www.2kgames.com/civ4/beyondthesword/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8820, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (8820, 'Game demo', 'enabled');

-- Spear of Destiny (App ID: 9000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9000, 'Spear of Destiny', 9000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : October 10');
INSERT IGNORE INTO developers (name) VALUES ('1993 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9000, (SELECT id FROM developers WHERE name = 'id Software Release Date : October 10'), NULL, '1993-10-10');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9000, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9000, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=291');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9000, '0000002423.jpg', 0),
(9000, '0000002422.jpg', 1),
(9000, '0000002421.jpg', 2),
(9000, '0000002420.jpg', 3),
(9000, '0000002419.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9000, 'Single-player', 'enabled');

-- Return to Castle Wolfenstein (App ID: 9010)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9010, 'Return to Castle Wolfenstein', 88, 'http://www.metacritic.com/games/platforms/pc/returntocastlewolfenstein', 9010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Gray Matter Release Date : November 20');
INSERT IGNORE INTO developers (name) VALUES ('2001 Languages : English Single-player Multi-player Blood and Gore Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9010, (SELECT id FROM developers WHERE name = 'Gray Matter Release Date : November 20'), NULL, '2001-11-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9010, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood and Gore Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9010, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=290');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9010, '0000002412.jpg', 0),
(9010, '0000002411.jpg', 1),
(9010, '0000002410.jpg', 2),
(9010, '0000002409.jpg', 3),
(9010, '0000002408.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9010, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9010, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9010, 'Blood and Gore Violence', 'enabled');

-- QUAKE Mission Pack 2: Dissolution of Eternity (App ID: 9030)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9030, 'QUAKE Mission Pack 2: Dissolution of Eternity', 9030, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Rogue Entertainment Release Date : August 3');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9030, (SELECT id FROM developers WHERE name = 'Rogue Entertainment Release Date : August 3'), NULL, '2007-08-03');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9030, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9030, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9030, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=281');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9030, '0000002472.jpg', 0),
(9030, '0000002471.jpg', 1),
(9030, '0000002470.jpg', 2),
(9030, '0000002469.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9030, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9030, 'Multi-player', 'enabled');

-- QUAKE Mission Pack 1: Scourge of Armagon (App ID: 9040)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9040, 'QUAKE Mission Pack 1: Scourge of Armagon', 9040, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ritual Entertainment Release Date : February 28');
INSERT IGNORE INTO developers (name) VALUES ('1997 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9040, (SELECT id FROM developers WHERE name = 'Ritual Entertainment Release Date : February 28'), NULL, '1997-02-28');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9040, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9040, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9040, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=281');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9040, '0000002468.jpg', 0),
(9040, '0000002467.jpg', 1),
(9040, '0000002466.jpg', 2),
(9040, '0000002465.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9040, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9040, 'Multi-player', 'enabled');

-- DOOM 3 (App ID: 9050)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9050, 'DOOM 3', 87, 'http://www.metacritic.com/games/platforms/pc/doom3', 9050, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : Activision Release Date : August 3');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('French Single-player Multi-player Blood and Gore Intense Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Release Date : August 3');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('French Single-player Multi-player Blood and Gore Intense Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9050, (SELECT id FROM developers WHERE name = 'id Software Publisher : Activision Release Date : August 3'), (SELECT id FROM publishers WHERE name = 'Activision Release Date : August 3'), '2004-08-03');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9050, (SELECT id FROM languages WHERE name = 'English')),
(9050, (SELECT id FROM languages WHERE name = 'German')),
(9050, (SELECT id FROM languages WHERE name = 'Italian')),
(9050, (SELECT id FROM languages WHERE name = 'Spanish')),
(9050, (SELECT id FROM languages WHERE name = 'French Single-player Multi-player Blood and Gore Intense Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9050, 'minimum', '3D Hardware Accelerator Card Required - 100% DirectX� 9.0b compatible 64MB Hardware Accelerated video card and the lateset drivers; English verision of Microsoft� Windows� 2000/XP, Pentium�IV 1.5 GHz or Athlon� XP 1500+ processor or higher, 384 MB RAM, 2.2GB of uncompressed free hard disk space (plus 400MB for Windows� swap file), 100% DirectX� 9.0b compatible 16-bit sound card and the latest drivers, 100% Windows� compatible mouse, keyboard, and latest drivers, DirectX� 9.0b (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9050, 'website', 'index.php?area=game&AppId=9100&cc=US'),
(9050, 'website', 'http://www.doom3.com/'),
(9050, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=297'),
(9050, 'manual', 'index.php?area=manual&AppId=9050&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9050, '0000002390.jpg', 0),
(9050, '0000002389.jpg', 1),
(9050, '0000002388.jpg', 2),
(9050, '0000002387.jpg', 3),
(9050, '0000002386.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9050, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9050, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9050, 'Blood and Gore Intense Violence', 'enabled');

-- HeXen II (App ID: 9060)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9060, 'HeXen II', 9060, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9060, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9060, 'minimum', 'Ordinateur équipé et 100% compatible Windows 2000/XP/Vista');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9060, 'website', 'index.php?area=game&AppId=9120&l=french&cc=US'),
(9060, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=288');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9060, '0000002437.jpg', 0),
(9060, '0000002436.jpg', 1),
(9060, '0000002435.jpg', 2),
(9060, '0000002434.jpg', 3),
(9060, '0000002433.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9060, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9060, 'Animated Blood Animated Violence', 'enabled');

-- DOOM 3 Resurrection of Evil (App ID: 9070)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9070, 'DOOM 3 Resurrection of Evil', 78, 'http://www.metacritic.com/games/platforms/pc/doom3resurrectionofevil', 9070, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9070, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9070, 'minimum', 'Full version of Doom 3, 3D Hardware Accelerator Card Required - 100% DirectX� 9.0b compatible 64MB Hardware Accelerated video card and the lateset drivers; English verision of Microsoft� Windows� 2000/XP, Pentium�IV 1.5 GHz or Athlon� XP 1500+ processor or higher, 384 MB RAM, 2.2GB of uncompressed free hard disk space (plus 400MB for Windows� swap file), 100% DirectX� 9.0b compatible 16-bit sound card and the latest drivers, 100% Windows� compatible mouse, keyboard, and latest drivers, DirectX� 9.0b (included)');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9070, 'website', 'http://www.doom3.com/'),
(9070, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=297');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9070, '0000002374.jpg', 0),
(9070, '0000002373.jpg', 1),
(9070, '0000002372.jpg', 2),
(9070, '0000002371.jpg', 3),
(9070, '0000002370.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9070, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9070, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9070, 'Blood and Gore Intense Violence', 'enabled');

-- Quake III Arena Demo (App ID: 9080)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9080, 'Quake III Arena Demo', 2200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Languages : English Single-player Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9080, (SELECT id FROM developers WHERE name = 'id Software Languages : English Single-player Multi-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9080, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9080, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9080, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9080, 'Game demo', 'enabled');

-- Quake III Team Arena Demo (App ID: 9090)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9090, 'Quake III Team Arena Demo', 2350, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Languages : English Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9090, (SELECT id FROM developers WHERE name = 'id Software Languages : English Multi-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9090, (SELECT id FROM languages WHERE name = 'English Multi-player Game demo'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9090, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9090, 'Game demo', 'enabled');

-- Doom 3 Demo (App ID: 9100)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9100, 'Doom 3 Demo', 9050, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : Activision Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9100, (SELECT id FROM developers WHERE name = 'id Software Publisher : Activision Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Activision Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9100, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9100, 'minimum', '3D Hardware Accelerator Card Required - 100% DirectX® 9.0b compatible 64MB Hardware Accelerated video card and the lateset drivers; English verision of Microsoft® Windows® 2000/XP, Pentium®IV 1.5 GHz or Athlon® XP 1500+ processor or higher, 384 MB RAM, 2.2GB of uncompressed free hard disk space (plus 400MB for Windows® swap file), 100% DirectX® 9.0b compatible 16-bit sound card and the latest drivers, 100% Windows® compatible mouse, keyboard, and latest drivers, DirectX® 9.0b (included)');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9100, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9100, 'Game demo', 'enabled');

-- Hexen II Demo (App ID: 9120)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9120, 'Hexen II Demo', 9060, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9120, (SELECT id FROM developers WHERE name = 'id Software Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9120, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9120, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9120, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9120, 'Game demo', 'enabled');

-- Quake II Demo (App ID: 9130)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9130, 'Quake II Demo', 2320, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9130, (SELECT id FROM developers WHERE name = 'id Software Languages : English Single-player Game demo'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9130, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9130, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9130, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9130, 'Game demo', 'enabled');

-- Master Levels for Doom II (App ID: 9160)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9160, 'Master Levels for Doom II', 9160, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Publisher : id Software Release Date : June 1');
INSERT IGNORE INTO developers (name) VALUES ('1995 Languages : English Single-player');
INSERT IGNORE INTO publishers (name) VALUES ('id Software Release Date : June 1');
INSERT IGNORE INTO publishers (name) VALUES ('1995 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9160, (SELECT id FROM developers WHERE name = 'id Software Publisher : id Software Release Date : June 1'), (SELECT id FROM publishers WHERE name = 'id Software Release Date : June 1'), '1995-06-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9160, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9160, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9160, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=277');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9160, '0000002487.jpg', 0),
(9160, '0000002486.jpg', 1),
(9160, '0000002485.jpg', 2),
(9160, '0000002484.jpg', 3),
(9160, '0000002483.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9160, 'Single-player', 'enabled');

-- Commander Keen (App ID: 9180)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9180, 'Commander Keen', 9180, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software Release Date : December 14');
INSERT IGNORE INTO developers (name) VALUES ('1990 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9180, (SELECT id FROM developers WHERE name = 'id Software Release Date : December 14'), NULL, '1990-12-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9180, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9180, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9180, '0000002403.jpg', 0),
(9180, '0000002402.jpg', 1),
(9180, '0000002401.jpg', 2),
(9180, '0000002400.jpg', 3),
(9180, '0000002399.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9180, 'Single-player', 'enabled');

-- Company of Heroes Singleplayer Demo (App ID: 9300)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9300, 'Company of Heroes Singleplayer Demo', 4560, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Relic Entertainment Languages : English Single-player Game demo Strong Language Blood and Gore Intense Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9300, (SELECT id FROM developers WHERE name = 'Relic Entertainment Languages : English Single-player Game demo Strong Language Blood and Gore Intense Violence'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9300, (SELECT id FROM languages WHERE name = 'English Single-player Game demo Strong Language Blood and Gore Intense Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9300, 'website', 'http://www.companyofheroesgame.com/');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9300, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9300, 'Strong Language Blood and Gore Intense Violence', 'enabled');

-- Dawn of War Demo (App ID: 9320)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9320, 'Dawn of War Demo', 4570, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Relic Publisher : THQ Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9320, (SELECT id FROM developers WHERE name = 'Relic Publisher : THQ Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'THQ Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9320, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9320, 'minimum', 'Windows 2000/XP, 1.8 Ghz Intel Pentium III or equivalent AMD Athlon XP, 256 MB RAM, 4.5 GB free hard drive space, 32 MB DirectX 9.0c compatible AGP video card with Hardware Transformation and Lighting, 16-bit DirectX 9.0b compatible sound card, Mouse, Keyboard'),
(9320, 'recommended', '2.4 GHz Intel Pentium 4 or equivalent, 512 MB system RAM (required for 8-player multiplayer games), nVidia GeForce 3 or ATI Radeon 8500 or equivalent with 64 MB of Video RAM');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9320, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9320, 'Game demo', 'enabled');

-- Dawn of War - Winter Assult Demo (App ID: 9330)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9330, 'Dawn of War - Winter Assult Demo', 4570, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Relic Publisher : THQ Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9330, (SELECT id FROM developers WHERE name = 'Relic Publisher : THQ Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'THQ Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9330, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9330, 'minimum', 'Windows 98SE/2000/XP/ME, 1.8 Ghz Intel Pentium III or equivalent AMD Athlon XP, 256 MB RAM, 4.5 GB free hard drive space, 32 MB DirectX 9.0c compatible AGP video card with Hardware Transformation and Lighting, 16-bit DirectX 9.0b compatible sound card, Mouse, Keyboard'),
(9330, 'recommended', '2.4 GHz Intel Pentium 4 or equivalent, 512 MB system RAM (required for 8-player multiplayer games), nVidia GeForce 3 or ATI Radeon 8500 or equivalent with 64 MB of Video RAM');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9330, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9330, 'Game demo', 'enabled');

-- S.T.A.L.K.E.R.: Clear Sky (App ID: 9390)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9390, 'S.T.A.L.K.E.R.: Clear Sky', 9390, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9390, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9390, 'website', 'index.php?area=game&AppId=99002&l=spanish&cc=US'),
(9390, 'website', 'http://www.stalker-game.com/'),
(9390, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=313');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9390, '0000003756.jpg', 0),
(9390, '0000003755.jpg', 1),
(9390, '0000003754.jpg', 2),
(9390, '0000003753.jpg', 3),
(9390, '0000003752.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9390, 'Un jugador', 'enabled');

-- Juiced 2: Hot Import Nights (App ID: 9400)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9400, 'Juiced 2: Hot Import Nights', 64, 'http://www.metacritic.com/games/platforms/pc/juiced2hotimportnights', 9400, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Juice Games Publisher : THQ Release Date : December 10');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : December 10');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9400, (SELECT id FROM developers WHERE name = 'Juice Games Publisher : THQ Release Date : December 10'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : December 10'), '2007-12-10');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9400, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9400, 'minimum', ':'),
(9400, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9400, 'website', 'http://www.juiced2hin.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9400, '0000002799.jpg', 0),
(9400, '0000002798.jpg', 1),
(9400, '0000002797.jpg', 2),
(9400, '0000002796.jpg', 3),
(9400, '0000002795.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9400, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9400, 'Multi-player', 'enabled');

-- Warhammer 40,000: Dawn of War  Soulstorm Demo (App ID: 9440)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9440, 'Warhammer 40,000: Dawn of War  Soulstorm Demo', 72, 'http://www.metacritic.com/games/platforms/pc/warhammer40000dawnofwarsoulstorm', 9450, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Relic Entertainment Publisher : THQ Languages : English Single-player Multi-player Game demo Blood and Gore Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Languages : English Single-player Multi-player Game demo Blood and Gore Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9440, (SELECT id FROM developers WHERE name = 'Relic Entertainment Publisher : THQ Languages : English Single-player Multi-player Game demo Blood and Gore Violence'), (SELECT id FROM publishers WHERE name = 'THQ Languages : English Single-player Multi-player Game demo Blood and Gore Violence'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9440, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo Blood and Gore Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9440, 'minimum', ':'),
(9440, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9440, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=303');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9440, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9440, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9440, 'Game demo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9440, 'Blood and Gore Violence', 'enabled');

-- Warhammer 40,000: Dawn of War  Soulstorm (App ID: 9450)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9450, 'Warhammer 40,000: Dawn of War  Soulstorm', 9450, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Relic Entertainment Publisher : THQ Release Date : March 5');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player Multi-player Blood and Gore Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : March 5');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English Single-player Multi-player Blood and Gore Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9450, (SELECT id FROM developers WHERE name = 'Relic Entertainment Publisher : THQ Release Date : March 5'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : March 5'), '2008-03-05');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9450, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood and Gore Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9450, 'minimum', ':'),
(9450, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9450, 'website', 'index.php?area=game&AppId=9440&cc=US'),
(9450, 'website', 'http://www.dawnofwargame.com'),
(9450, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=303'),
(9450, 'manual', 'index.php?area=manual&AppId=9450&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9450, '0000003508.jpg', 0),
(9450, '0000003507.jpg', 1),
(9450, '0000003506.jpg', 2),
(9450, '0000003505.jpg', 3),
(9450, '0000003504.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9450, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9450, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9450, 'Blood and Gore Violence', 'enabled');

-- Frontlines: Fuel of War (App ID: 9460)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9460, 'Frontlines: Fuel of War', 72, 'http://www.metacritic.com/games/platforms/pc/frontlinesfuelofwar', 9460, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Kaos Studios Publisher : THQ Release Date : February 27');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('THQ Release Date : February 27');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9460, (SELECT id FROM developers WHERE name = 'Kaos Studios Publisher : THQ Release Date : February 27'), (SELECT id FROM publishers WHERE name = 'THQ Release Date : February 27'), '2008-02-27');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9460, (SELECT id FROM languages WHERE name = 'English')),
(9460, (SELECT id FROM languages WHERE name = 'French')),
(9460, (SELECT id FROM languages WHERE name = 'Italian')),
(9460, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9460, 'minimum', ':'),
(9460, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9460, 'website', 'index.php?area=game&AppId=5014&cc=US'),
(9460, 'website', 'http://www.frontlines.com/'),
(9460, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=362');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9460, '0000003358.jpg', 0),
(9460, '0000003357.jpg', 1),
(9460, '0000003356.jpg', 2),
(9460, '0000003355.jpg', 3),
(9460, '0000003354.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9460, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9460, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9460, 'Blood Language Violence', 'enabled');

-- Gish (App ID: 9500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9500, 'Gish', 80, 'http://www.metacritic.com/games/platforms/pc/gish', 9500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cryptic Sea Publisher : Chronic Logic Release Date : May 4');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Chronic Logic Release Date : May 4');
INSERT IGNORE INTO publishers (name) VALUES ('2004 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9500, (SELECT id FROM developers WHERE name = 'Cryptic Sea Publisher : Chronic Logic Release Date : May 4'), (SELECT id FROM publishers WHERE name = 'Chronic Logic Release Date : May 4'), '2004-05-04');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9500, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9500, 'minimum', 'Windows 2000/XP/Vista, Linux or OSX 10.1+, AMD, Intel or G3 1000+ Mhz processor; OpenGL Compatible 3D Graphics adaptor (ATI, NVIDIA, Intel, etc.) with 32 mb of video memory; 256MB of memory'),
(9500, 'recommended', 'AMD, Intel, or G4 1500+ Mhz processor; OpenGL Compatible 3D Graphics adaptor (ATI, NVIDIA, Intel, etc.) with 64 mb of video memory, 256MB of memory');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9500, 'website', 'index.php?area=game&AppId=9510&cc=US'),
(9500, 'website', 'http://www.crypticsea.com/gish'),
(9500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=274');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9500, '0000003383.jpg', 0),
(9500, '0000003382.jpg', 1),
(9500, '0000002341.jpg', 2),
(9500, '0000002340.jpg', 3),
(9500, '0000002339.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9500, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9500, 'Multi-player', 'enabled');

-- Gish Demo (App ID: 9510)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9510, 'Gish Demo', 9500, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cryptic Sea Publisher : Chronic Logic Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Chronic Logic Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9510, (SELECT id FROM developers WHERE name = 'Cryptic Sea Publisher : Chronic Logic Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Chronic Logic Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9510, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9510, 'minimum', 'Windows 2000/XP/Vista, Linux or OSX 10.1+, AMD, Intel or G3 1000+ Mhz processor; OpenGL Compatible 3D Graphics adaptor (ATI, NVIDIA, Intel, etc.) with 32 mb of video memory; 256MB of memory'),
(9510, 'recommended', 'AMD, Intel, or G4 1500+ Mhz processor; OpenGL Compatible 3D Graphics adaptor (ATI, NVIDIA, Intel, etc.) with 64 mb of video memory, 256MB of memory');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9510, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9510, 'Game demo', 'enabled');

-- Desperados 2: Cooper''s Revenge (App ID: 9710)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9710, 'Desperados 2: Cooper''s Revenge', 66, 'http://www.metacritic.com/games/platforms/pc/desperados2coopersrevenge', 9710, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Spellbound Publisher : Atari Release Date : May 2');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Language Suggestive Themes Use of Alcohol Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : May 2');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Language Suggestive Themes Use of Alcohol Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9710, (SELECT id FROM developers WHERE name = 'Spellbound Publisher : Atari Release Date : May 2'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : May 2'), '2006-05-02');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9710, (SELECT id FROM languages WHERE name = 'English Single-player Language Suggestive Themes Use of Alcohol Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9710, 'manual', 'index.php?area=manual&AppId=9710&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9710, '0000002714.jpg', 0),
(9710, '0000002713.jpg', 1),
(9710, '0000002712.jpg', 2),
(9710, '0000002711.jpg', 3),
(9710, '0000002710.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9710, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9710, 'Language Suggestive Themes Use of Alcohol Violence', 'enabled');

-- Tycoon City: New York (App ID: 9730)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9730, 'Tycoon City: New York', 67, 'http://www.metacritic.com/games/platforms/pc/tycooncitynewyork', 9730, '', 'header.jpg');

INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : February 21');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Alcohol Reference Crude Humor Suggestive Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9730, NULL, (SELECT id FROM publishers WHERE name = 'Atari Release Date : February 21'), '2006-02-21');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9730, (SELECT id FROM languages WHERE name = 'English Single-player Alcohol Reference Crude Humor Suggestive Themes'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9730, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9730, 'website', 'http://www.atari.com/tycooncity/'),
(9730, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=373'),
(9730, 'manual', 'index.php?area=manual&AppId=9730&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9730, '0000002672.jpg', 0),
(9730, '0000002671.jpg', 1),
(9730, '0000002670.jpg', 2),
(9730, '0000002669.jpg', 3),
(9730, '0000002668.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9730, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9730, 'Alcohol Reference Crude Humor Suggestive Themes', 'enabled');

-- Indigo Prophecy (App ID: 9740)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9740, 'Indigo Prophecy', 85, 'http://www.metacritic.com/games/platforms/pc/fahrenheit', 9740, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Quantic Dream Publisher : Atari Release Date : September 20');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Single-player Blood Partial Nudity Sexual Themes Strong Language Use of Drugs and Alcohol Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : September 20');
INSERT IGNORE INTO publishers (name) VALUES ('2005 Languages : English Single-player Blood Partial Nudity Sexual Themes Strong Language Use of Drugs and Alcohol Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9740, (SELECT id FROM developers WHERE name = 'Quantic Dream Publisher : Atari Release Date : September 20'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : September 20'), '2005-09-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9740, (SELECT id FROM languages WHERE name = 'English Single-player Blood Partial Nudity Sexual Themes Strong Language Use of Drugs and Alcohol Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9740, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9740, 'website', 'http://www.atari.com/indigo/'),
(9740, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=370'),
(9740, 'manual', 'index.php?area=manual&AppId=9740&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9740, '0000002719.jpg', 0),
(9740, '0000002718.jpg', 1),
(9740, '0000002717.jpg', 2),
(9740, '0000002716.jpg', 3),
(9740, '0000002715.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9740, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9740, 'Blood Partial Nudity Sexual Themes Strong Language Use of Drugs and Alcohol Violence', 'enabled');

-- Act of War: High Treason (App ID: 9760)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9760, 'Act of War: High Treason', 74, 'http://www.metacritic.com/games/platforms/pc/actofwarhightreason', 9760, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Eugen Systems Publisher : Atari Release Date : May 30');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Violence Language');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : May 30');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Violence Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9760, (SELECT id FROM developers WHERE name = 'Eugen Systems Publisher : Atari Release Date : May 30'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : May 30'), '2006-05-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9760, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Violence Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9760, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9760, 'website', 'http://www.atari.com/actofwar/addon/'),
(9760, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=369'),
(9760, 'manual', 'index.php?area=manual&AppId=9760&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9760, '0000002746.jpg', 0),
(9760, '0000002745.jpg', 1),
(9760, '0000002744.jpg', 2),
(9760, '0000002743.jpg', 3),
(9760, '0000002742.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9760, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9760, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9760, 'Violence Language', 'enabled');

-- Death to Spies (App ID: 9800)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (9800, 'Death to Spies', 70, 'http://www.metacritic.com/games/platforms/pc/deathtospies', 9800, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Haggard Games Publisher : Atari Release Date : October 16');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Atari Release Date : October 16');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (9800, (SELECT id FROM developers WHERE name = 'Haggard Games Publisher : Atari Release Date : October 16'), (SELECT id FROM publishers WHERE name = 'Atari Release Date : October 16'), '2007-10-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(9800, (SELECT id FROM languages WHERE name = 'English Single-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(9800, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(9800, 'website', 'http://www.deathtospies-thegame.com'),
(9800, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=371'),
(9800, 'manual', 'index.php?area=manual&AppId=9800&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(9800, '0000002853.jpg', 0),
(9800, '0000002852.jpg', 1),
(9800, '0000002851.jpg', 2),
(9800, '0000002850.jpg', 3),
(9800, '0000002849.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9800, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (9800, 'Blood Violence', 'enabled');

-- Enemy Territory: QUAKE Wars (App ID: 10000)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10000, 'Enemy Territory: QUAKE Wars', 84, 'http://www.metacritic.com/games/platforms/pc/enemyterritoryquakewars', 10000, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10000, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10000, 'website', 'index.php?area=game&AppId=10050&l=spanish&cc=US'),
(10000, 'website', 'http://www.enemyterritory.com/'),
(10000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=321'),
(10000, 'manual', 'index.php?area=manual&AppId=10000&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10000, '0000002735.jpg', 0),
(10000, '0000002734.jpg', 1),
(10000, '0000002733.jpg', 2),
(10000, '0000002732.jpg', 3),
(10000, '0000002731.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10000, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10000, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10000, 'Mild Blood Mild Language Violence', 'enabled');

-- Enemy Territory: QUAKE Wars Demo 2.0 (App ID: 10050)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10050, 'Enemy Territory: QUAKE Wars Demo 2.0', 10000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('id Software');
INSERT IGNORE INTO developers (name) VALUES ('Splash Damage Publisher : Activision Languages : English Single-player Multi-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Activision Languages : English Single-player Multi-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10050, (SELECT id FROM developers WHERE name = 'id Software'), (SELECT id FROM publishers WHERE name = 'Activision Languages : English Single-player Multi-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(10050, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Game demo'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10050, 'website', 'http://www.enemyterritory.com');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10050, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10050, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10050, 'Game demo', 'enabled');

-- Universe at War: Earth Assault (App ID: 10430)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10430, 'Universe at War: Earth Assault', 77, 'http://www.metacritic.com/games/platforms/pc/universeatwarearthassault', 10430, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Petroglyph Publisher : SEGA Release Date : December 12');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Multi-player Mild Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('SEGA Release Date : December 12');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Multi-player Mild Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10430, (SELECT id FROM developers WHERE name = 'Petroglyph Publisher : SEGA Release Date : December 12'), (SELECT id FROM publishers WHERE name = 'SEGA Release Date : December 12'), '2007-12-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(10430, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Mild Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10430, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10430, 'website', 'http://www.universeatwargame.com'),
(10430, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=332');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10430, '0000003138.jpg', 0),
(10430, '0000003137.jpg', 1),
(10430, '0000003136.jpg', 2),
(10430, '0000003135.jpg', 3),
(10430, '0000003134.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10430, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10430, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10430, 'Mild Language Violence', 'enabled');

-- The Golden Compass (App ID: 10440)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10440, 'The Golden Compass', 22, 'http://www.metacritic.com/games/platforms/pc/goldencompass', 10440, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Shiny Entertainment Publisher : SEGA Release Date : December 14');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Controller enabled');
INSERT IGNORE INTO publishers (name) VALUES ('SEGA Release Date : December 14');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Controller enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10440, (SELECT id FROM developers WHERE name = 'Shiny Entertainment Publisher : SEGA Release Date : December 14'), (SELECT id FROM publishers WHERE name = 'SEGA Release Date : December 14'), '2007-12-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(10440, (SELECT id FROM languages WHERE name = 'English')),
(10440, (SELECT id FROM languages WHERE name = 'French')),
(10440, (SELECT id FROM languages WHERE name = 'German')),
(10440, (SELECT id FROM languages WHERE name = 'Italian')),
(10440, (SELECT id FROM languages WHERE name = 'Spanish Single-player Controller enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10440, 'minimum', ':'),
(10440, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10440, 'website', 'http://www.goldencompassgame.com');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10440, '0000003210.jpg', 0),
(10440, '0000003209.jpg', 1),
(10440, '0000003208.jpg', 2),
(10440, '0000003207.jpg', 3),
(10440, '0000003206.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10440, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10440, 'Controller', 'enabled');

-- The Club (App ID: 10460)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10460, 'The Club', 67, 'http://www.metacritic.com/games/platforms/pc/club', 5019, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Bizarre Creations Publisher : Sega Release Date : February 20');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player Multi-player Controller enabled Blood Strong Language Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Sega Release Date : February 20');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English Single-player Multi-player Controller enabled Blood Strong Language Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10460, (SELECT id FROM developers WHERE name = 'Bizarre Creations Publisher : Sega Release Date : February 20'), (SELECT id FROM publishers WHERE name = 'Sega Release Date : February 20'), '2008-02-20');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(10460, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Controller enabled Blood Strong Language Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10460, 'minimum', ':'),
(10460, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10460, 'website', 'http://www.theclubgame.com'),
(10460, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=348');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10460, '0000003528.jpg', 0),
(10460, '0000003527.jpg', 1),
(10460, '0000003526.jpg', 2),
(10460, '0000003525.jpg', 3),
(10460, '0000003524.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10460, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10460, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10460, 'Controller', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10460, 'Blood Strong Language Violence', 'enabled');

-- Happy Tree Friends False Alarm (App ID: 10470)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10470, 'Happy Tree Friends False Alarm', 10470, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10470, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10470, 'minimum', ':'),
(10470, 'recommended', ':');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10470, '0000003877.jpg', 0),
(10470, '0000003876.jpg', 1),
(10470, '0000003875.jpg', 2),
(10470, '0000003874.jpg', 3),
(10470, '0000003873.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10470, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10470, 'Blood and Gore Violence', 'enabled');

-- Speedball 2  Tournament (App ID: 10700)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (10700, 'Speedball 2  Tournament', 60, 'http://www.metacritic.com/games/platforms/pc/speedball2tournament', 10700, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (10700, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(10700, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(10700, 'website', 'index.php?area=game&AppId=5009&l=spanish&cc=US'),
(10700, 'website', 'http://www.speedball2.com/'),
(10700, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=330'),
(10700, 'manual', 'index.php?area=manual&AppId=10700&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(10700, '0000003074.jpg', 0),
(10700, '0000003073.jpg', 1),
(10700, '0000003072.jpg', 2),
(10700, '0000003071.jpg', 3),
(10700, '0000003070.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10700, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10700, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (10700, 'Controlador activado', 'enabled');

-- Loki Demo - Norse Warrior (App ID: 11000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11000, 'Loki Demo - Norse Warrior', 7260, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Cyanide Publisher : Focus Home Interactive Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Focus Home Interactive Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11000, (SELECT id FROM developers WHERE name = 'Cyanide Publisher : Focus Home Interactive Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Focus Home Interactive Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(11000, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11000, 'minimum', 'Windows XP/Vista 32/64-bit, Pentium4 2GHz/AthlonXP 2000+, 512 MB RAM, 64 MB DirectX 9 compatible (GeForce4 Ti/Radeon 9000), DirectX 9 compatible, DirectX: 9.0c or higher (supplied on the game DVD), Hard disk space: 7 GB, Multiplayer: LAN/broadband Internet for online play and 1 GB RAM');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11000, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11000, 'Game demo', 'enabled');

-- Shadowgrounds Survivor (App ID: 11200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11200, 'Shadowgrounds Survivor', 82, 'http://www.metacritic.com/games/platforms/pc/shadowgroundssurvivor', 11200, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frozenbyte Publisher : Meridian4 Release Date : November 14');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Co-op Includes level editor Violence Blood and Gore Language');
INSERT IGNORE INTO publishers (name) VALUES ('Meridian4 Release Date : November 14');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Co-op Includes level editor Violence Blood and Gore Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11200, (SELECT id FROM developers WHERE name = 'Frozenbyte Publisher : Meridian4 Release Date : November 14'), (SELECT id FROM publishers WHERE name = 'Meridian4 Release Date : November 14'), '2007-11-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(11200, (SELECT id FROM languages WHERE name = 'English Single-player Co-op Includes level editor Violence Blood and Gore Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11200, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(11200, 'website', 'http://www.shadowgroundssurvivor.com/'),
(11200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=67'),
(11200, 'manual', 'index.php?area=manual&AppId=11200&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(11200, '0000002888.jpg', 0),
(11200, '0000002887.jpg', 1),
(11200, '0000002886.jpg', 2),
(11200, '0000002885.jpg', 3),
(11200, '0000002884.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11200, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11200, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11200, 'Includes level editor', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11200, 'Violence Blood and Gore Language', 'enabled');

-- Alpha Prime Demo (App ID: 11210)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11210, 'Alpha Prime Demo', 2590, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11210, NULL, NULL, NULL);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11210, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11210, 'Demo del juego', 'enabled');

-- Shadowgrounds Survivor Demo (App ID: 11220)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11220, 'Shadowgrounds Survivor Demo', 11200, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11220, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11220, 'minimum', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11220, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11220, 'Démo du jeu', 'enabled');

-- Clive Barker''s Jericho (App ID: 11420)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11420, 'Clive Barker''s Jericho', 11420, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11420, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11420, 'minimum', ':'),
(11420, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(11420, 'website', 'index.php?area=game&AppId=11460&l=russian&cc=US'),
(11420, 'website', 'http://www.jericho-game.com');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(11420, '0000002933.jpg', 0),
(11420, '0000002931.jpg', 1),
(11420, '0000002930.jpg', 2),
(11420, '0000002929.jpg', 3),
(11420, '0000002928.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11420, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11420, 'Blood and Gore Intense Violence Sexual Themes Strong Language', 'enabled');

-- Overlord (App ID: 11450)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11450, 'Overlord', 81, 'http://www.metacritic.com/games/platforms/pc/overlord', 11450, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Triumph Studios Publisher : Codemasters Release Date : June 26');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Crude Humor Suggestive Themes Use of Alcohol Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Codemasters Release Date : June 26');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish Single-player Multi-player Blood and Gore Crude Humor Suggestive Themes Use of Alcohol Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11450, (SELECT id FROM developers WHERE name = 'Triumph Studios Publisher : Codemasters Release Date : June 26'), (SELECT id FROM publishers WHERE name = 'Codemasters Release Date : June 26'), '2007-06-26');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(11450, (SELECT id FROM languages WHERE name = 'English')),
(11450, (SELECT id FROM languages WHERE name = 'French')),
(11450, (SELECT id FROM languages WHERE name = 'German')),
(11450, (SELECT id FROM languages WHERE name = 'Italian')),
(11450, (SELECT id FROM languages WHERE name = 'Spanish Single-player Multi-player Blood and Gore Crude Humor Suggestive Themes Use of Alcohol Violence'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(11450, 'website', 'index.php?area=game&AppId=11470&cc=US'),
(11450, 'website', 'http://www.codemasters.com/overlord'),
(11450, 'manual', 'index.php?area=manual&AppId=11450&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(11450, '0000002970.jpg', 0),
(11450, '0000002969.jpg', 1),
(11450, '0000002968.jpg', 2),
(11450, '0000002967.jpg', 3),
(11450, '0000002966.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11450, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11450, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11450, 'Blood and Gore Crude Humor Suggestive Themes Use of Alcohol Violence', 'enabled');

-- Clive Barker''s Jericho Demo (App ID: 11460)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11460, 'Clive Barker''s Jericho Demo', 11420, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11460, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11460, 'minimum', ':'),
(11460, 'recommended', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11460, 'Для одного игрока', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11460, 'Демо-версия игры', 'enabled');

-- Overlord Demo (App ID: 11470)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11470, 'Overlord Demo', 11450, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Triumph Studios Publisher : Codemasters Languages : English Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Codemasters Languages : English Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11470, (SELECT id FROM developers WHERE name = 'Triumph Studios Publisher : Codemasters Languages : English Single-player Game demo'), (SELECT id FROM publishers WHERE name = 'Codemasters Languages : English Single-player Game demo'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(11470, (SELECT id FROM languages WHERE name = 'English Single-player Game demo'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11470, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11470, 'Game demo', 'enabled');

-- LUMINES (App ID: 11900)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11900, 'LUMINES', 11900, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11900, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11900, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(11900, 'website', 'index.php?area=game&AppId=11910&l=spanish&cc=US');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(11900, '0000003598.jpg', 0),
(11900, '0000003597.jpg', 1),
(11900, '0000003596.jpg', 2),
(11900, '0000003595.jpg', 3),
(11900, '0000003594.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11900, 'Un jugador', 'enabled');

-- LUMINES Demo (App ID: 11910)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11910, 'LUMINES Demo', 11900, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11910, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11910, 'minimum', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11910, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11910, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11910, 'Demo del juego', 'enabled');

-- LUMINES Advance Pack (App ID: 11911)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (11911, 'LUMINES Advance Pack', 11911, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (11911, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(11911, 'minimum', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (11911, 'Un jugador', 'enabled');

-- Midnight Club 2 (App ID: 12160)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12160, 'Midnight Club 2', 81, 'http://www.metacritic.com/games/platforms/pc/midnightclub2', 12160, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Rockstar San Diego Publisher : Rockstar Games Release Date : July 1');
INSERT IGNORE INTO developers (name) VALUES ('2003 Languages : English Mild Lyrics Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Rockstar Games Release Date : July 1');
INSERT IGNORE INTO publishers (name) VALUES ('2003 Languages : English Mild Lyrics Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12160, (SELECT id FROM developers WHERE name = 'Rockstar San Diego Publisher : Rockstar Games Release Date : July 1'), (SELECT id FROM publishers WHERE name = 'Rockstar Games Release Date : July 1'), '2003-07-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12160, (SELECT id FROM languages WHERE name = 'English Mild Lyrics Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12160, 'minimum', ':'),
(12160, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12160, 'website', 'http://www.rockstargames.com/midnightclub2 '),
(12160, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=340'),
(12160, 'manual', 'index.php?area=manual&AppId=12160&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12160, '0000003290.jpg', 0),
(12160, '0000003289.jpg', 1),
(12160, '0000003288.jpg', 2),
(12160, '0000003287.jpg', 3),
(12160, '0000003286.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12160, 'Mild Lyrics Violence', 'enabled');

-- Baseball Mogul 2008 (App ID: 12300)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12300, 'Baseball Mogul 2008', 74, 'http://www.metacritic.com/games/platforms/pc/baseballmogul2008', 12300, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sports Mogul Inc. Publisher : Strategy First Release Date : February 12');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player Drug Reference Mild Language Mild Suggestive Themes');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : February 12');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English Single-player Drug Reference Mild Language Mild Suggestive Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12300, (SELECT id FROM developers WHERE name = 'Sports Mogul Inc. Publisher : Strategy First Release Date : February 12'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : February 12'), '2008-02-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12300, (SELECT id FROM languages WHERE name = 'English Single-player Drug Reference Mild Language Mild Suggestive Themes'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12300, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12300, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=359');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12300, '0000003602.jpg', 0),
(12300, '0000003601.jpg', 1),
(12300, '0000003600.jpg', 2),
(12300, '0000003599.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12300, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12300, 'Drug Reference Mild Language Mild Suggestive Themes', 'enabled');

-- Culpa Innata (App ID: 12310)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12310, 'Culpa Innata', 66, 'http://www.metacritic.com/games/platforms/pc/culpainnata', 12310, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Momentum Digital Media Technologies Publisher : Strategy First Release Date : October 23');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Blood Language Strong Sexual Content Violence');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : October 23');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Blood Language Strong Sexual Content Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12310, (SELECT id FROM developers WHERE name = 'Momentum Digital Media Technologies Publisher : Strategy First Release Date : October 23'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : October 23'), '2007-10-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12310, (SELECT id FROM languages WHERE name = 'English Single-player Blood Language Strong Sexual Content Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12310, 'minimum', ':'),
(12310, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12310, 'website', 'http://www.culpainnata.com'),
(12310, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=342'),
(12310, 'manual', 'index.php?area=manual&AppId=12310&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12310, '0000003472.jpg', 0),
(12310, '0000003471.jpg', 1),
(12310, '0000003470.jpg', 2),
(12310, '0000003469.jpg', 3),
(12310, '0000003468.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12310, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12310, 'Blood Language Strong Sexual Content Violence', 'enabled');

-- Darkstar One (App ID: 12330)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12330, 'Darkstar One', 71, 'http://www.metacritic.com/games/platforms/pc/darkstarone', 12330, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ascaron Entertainment ltd. Publisher : Strategy First Release Date : August 14');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Drug and Alcohol Reference Fantasy Violence Language Mild Blood');
INSERT IGNORE INTO publishers (name) VALUES ('Strategy First Release Date : August 14');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Drug and Alcohol Reference Fantasy Violence Language Mild Blood');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12330, (SELECT id FROM developers WHERE name = 'Ascaron Entertainment ltd. Publisher : Strategy First Release Date : August 14'), (SELECT id FROM publishers WHERE name = 'Strategy First Release Date : August 14'), '2006-08-14');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12330, (SELECT id FROM languages WHERE name = 'English Single-player Drug and Alcohol Reference Fantasy Violence Language Mild Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12330, 'minimum', ':'),
(12330, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12330, 'website', 'http://www.darkstar-one.com/'),
(12330, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=358'),
(12330, 'manual', 'index.php?area=manual&AppId=12330&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12330, '0000003571.jpg', 0),
(12330, '0000003570.jpg', 1),
(12330, '0000003569.jpg', 2),
(12330, '0000003568.jpg', 3),
(12330, '0000003567.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12330, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12330, 'Drug and Alcohol Reference Fantasy Violence Language Mild Blood', 'enabled');

-- PuzzleQuest: Challenge of the Warlords (App ID: 12500)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12500, 'PuzzleQuest: Challenge of the Warlords', 84, 'http://www.metacritic.com/games/platforms/pc/puzzlequestchallengeofthewarlords', 12500, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12500, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12500, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12500, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=345');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12500, '0000003429.jpg', 0),
(12500, '0000003428.jpg', 1),
(12500, '0000003427.jpg', 2),
(12500, '0000003426.jpg', 3),
(12500, '0000003425.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12500, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12500, 'Multijugador', 'enabled');

-- Prison Tycoon 3: Lockdown (App ID: 12510)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12510, 'Prison Tycoon 3: Lockdown', 12510, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12510, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12510, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12510, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=346');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12510, '0000003438.jpg', 0),
(12510, '0000003437.jpg', 1),
(12510, '0000003436.jpg', 2),
(12510, '0000003435.jpg', 3),
(12510, '0000003434.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12510, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12510, 'Mild Violence', 'enabled');

-- 18 Wheels of Steel American Long Haul (App ID: 12520)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12520, '18 Wheels of Steel American Long Haul', 12520, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12520, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12520, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12520, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=346');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12520, '0000003445.jpg', 0),
(12520, '0000003444.jpg', 1),
(12520, '0000003443.jpg', 2),
(12520, '0000003442.jpg', 3),
(12520, '0000003441.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12520, 'Un jugador', 'enabled');

-- Hunting Unlimited 2008 (App ID: 12530)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12530, 'Hunting Unlimited 2008', 12530, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('SCS Software Publisher : ValuSoft Release Date : September 1');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Single-player Blood Violence');
INSERT IGNORE INTO publishers (name) VALUES ('ValuSoft Release Date : September 1');
INSERT IGNORE INTO publishers (name) VALUES ('2007 Languages : English Single-player Blood Violence');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12530, (SELECT id FROM developers WHERE name = 'SCS Software Publisher : ValuSoft Release Date : September 1'), (SELECT id FROM publishers WHERE name = 'ValuSoft Release Date : September 1'), '2007-09-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12530, (SELECT id FROM languages WHERE name = 'English Single-player Blood Violence'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12530, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12530, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=346');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12530, '0000003463.jpg', 0),
(12530, '0000003462.jpg', 1),
(12530, '0000003461.jpg', 2),
(12530, '0000003460.jpg', 3),
(12530, '0000003459.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12530, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12530, 'Blood Violence', 'enabled');

-- AudioSurf (App ID: 12900)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12900, 'AudioSurf', 86, 'http://www.metacritic.com/games/platforms/pc/audiosurf', 12910, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Dylan Fitterer Release Date : February 15');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12900, (SELECT id FROM developers WHERE name = 'Dylan Fitterer Release Date : February 15'), NULL, '2008-02-15');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(12900, (SELECT id FROM languages WHERE name = 'English Single-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12900, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(12900, 'website', 'index.php?area=game&AppId=12910&cc=US'),
(12900, 'website', 'http://www.audio-surf.com/'),
(12900, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=357');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(12900, '0000003584.jpg', 0),
(12900, '0000003583.jpg', 1),
(12900, '0000003582.jpg', 2),
(12900, '0000003581.jpg', 3),
(12900, '0000003580.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12900, 'Single-player', 'enabled');

-- AudioSurf Demo (App ID: 12910)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (12910, 'AudioSurf Demo', 12900, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (12910, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(12910, 'minimum', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12910, 'Joueur solo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (12910, 'Démo du jeu', 'enabled');

-- Ninja Reflex: Steamworks Edition (App ID: 13000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13000, 'Ninja Reflex: Steamworks Edition', 13000, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13000, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13000, 'website', 'index.php?area=game&AppId=99039&l=spanish&cc=US'),
(13000, 'website', 'index.php?area=game&AppId=13010&l=spanish&cc=US'),
(13000, 'website', 'http://www.nunchuckgames.com/ninjareflex/'),
(13000, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=379');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13000, '0000003863.jpg', 0),
(13000, '0000003862.jpg', 1),
(13000, '0000003861.jpg', 2),
(13000, '0000003860.jpg', 3),
(13000, '0000003859.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13000, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13000, 'Multijugador', 'enabled');

-- Ninja Reflex Demo (App ID: 13010)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13010, 'Ninja Reflex Demo', 13000, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Sanzaru Games Publisher : Nunchuck Games Languages : English');
INSERT IGNORE INTO developers (name) VALUES ('French');
INSERT IGNORE INTO developers (name) VALUES ('German');
INSERT IGNORE INTO developers (name) VALUES ('Italian');
INSERT IGNORE INTO developers (name) VALUES ('Spanish');
INSERT IGNORE INTO developers (name) VALUES ('Japanese (all with full audio support) Single-player Game demo');
INSERT IGNORE INTO publishers (name) VALUES ('Nunchuck Games Languages : English');
INSERT IGNORE INTO publishers (name) VALUES ('French');
INSERT IGNORE INTO publishers (name) VALUES ('German');
INSERT IGNORE INTO publishers (name) VALUES ('Italian');
INSERT IGNORE INTO publishers (name) VALUES ('Spanish');
INSERT IGNORE INTO publishers (name) VALUES ('Japanese (all with full audio support) Single-player Game demo');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13010, (SELECT id FROM developers WHERE name = 'Sanzaru Games Publisher : Nunchuck Games Languages : English'), (SELECT id FROM publishers WHERE name = 'Nunchuck Games Languages : English'), NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(13010, (SELECT id FROM languages WHERE name = 'English')),
(13010, (SELECT id FROM languages WHERE name = 'French')),
(13010, (SELECT id FROM languages WHERE name = 'German')),
(13010, (SELECT id FROM languages WHERE name = 'Italian')),
(13010, (SELECT id FROM languages WHERE name = 'Spanish')),
(13010, (SELECT id FROM languages WHERE name = 'Japanese (all with full audio support) Single-player Game demo'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13010, 'minimum', ':');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13010, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13010, 'Game demo', 'enabled');

-- Unreal 2: The Awakening (App ID: 13200)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13200, 'Unreal 2: The Awakening', 75, 'http://www.metacritic.com/games/platforms/pc/unreal2theawakening', 13200, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13200, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13200, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13200, 'website', 'http://www.unrealtournament3.com'),
(13200, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=377'),
(13200, 'manual', 'index.php?area=manual&AppId=13200&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13200, '0000003781.jpg', 0),
(13200, '0000003780.jpg', 1),
(13200, '0000003779.jpg', 2),
(13200, '0000003778.jpg', 3),
(13200, '0000003777.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13200, 'Un jugador', 'enabled');

-- Unreal Tournament 3 (App ID: 13210)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13210, 'Unreal Tournament 3', 83, 'http://www.metacritic.com/games/platforms/pc/unrealtournament2007', 13210, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13210, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13210, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13210, 'website', 'http://www.unrealtournament3.com'),
(13210, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=377');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13210, '0000003801.jpg', 0),
(13210, '0000003800.jpg', 1),
(13210, '0000003799.jpg', 2),
(13210, '0000003798.jpg', 3),
(13210, '0000003797.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13210, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13210, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13210, 'Cooperativo', 'enabled');

-- Unreal Tournament 2004: Editor''s Choice Edition (App ID: 13230)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13230, 'Unreal Tournament 2004: Editor''s Choice Edition', 93, 'http://www.metacritic.com/games/platforms/pc/unrealtournament2004', 13230, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13230, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13230, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13230, 'website', 'http://www.ut2004.com/ut2004/index.html'),
(13230, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=377');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13230, '0000003811.jpg', 0),
(13230, '0000003810.jpg', 1),
(13230, '0000003809.jpg', 2),
(13230, '0000003808.jpg', 3),
(13230, '0000003807.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13230, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13230, 'Multijugador', 'enabled');

-- Unreal Tournament: Game of the Year Edition (App ID: 13240)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13240, 'Unreal Tournament: Game of the Year Edition', 92, 'http://www.metacritic.com/games/platforms/pc/unrealtournament', 13240, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13240, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13240, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13240, 'website', 'http://http://www.ut2004.com/utgoty/index.html'),
(13240, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=377'),
(13240, 'manual', 'index.php?area=manual&AppId=13240&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13240, '0000003791.jpg', 0),
(13240, '0000003790.jpg', 1),
(13240, '0000003789.jpg', 2),
(13240, '0000003788.jpg', 3),
(13240, '0000003787.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13240, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13240, 'Multijugador', 'enabled');

-- Unreal Gold (App ID: 13250)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13250, 'Unreal Gold', 13250, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Epic Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Publisher : Epic Games');
INSERT IGNORE INTO developers (name) VALUES ('Inc. Release Date : April 30');
INSERT IGNORE INTO developers (name) VALUES ('1998 Languages : English Single-player Multi-player');
INSERT IGNORE INTO publishers (name) VALUES ('Epic Games');
INSERT IGNORE INTO publishers (name) VALUES ('Inc. Release Date : April 30');
INSERT IGNORE INTO publishers (name) VALUES ('1998 Languages : English Single-player Multi-player');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13250, (SELECT id FROM developers WHERE name = 'Epic Games'), (SELECT id FROM publishers WHERE name = 'Epic Games'), '1998-04-30');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(13250, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13250, 'minimum', 'A 100% Windows 2000/XP/Vista-compatible computer system');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13250, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=377');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13250, '0000003771.jpg', 0),
(13250, '0000003770.jpg', 1),
(13250, '0000003769.jpg', 2),
(13250, '0000003768.jpg', 3),
(13250, '0000003767.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13250, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13250, 'Multi-player', 'enabled');

-- Far Cry� (App ID: 13520)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13520, 'Far Cry�', 89, 'http://www.metacritic.com/games/platforms/pc/farcry', 99037, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13520, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13520, 'minimum', ':'),
(13520, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13520, 'website', 'http://www.farcrygame.com/'),
(13520, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=382'),
(13520, 'manual', 'index.php?area=manual&AppId=13520&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13520, '0000003761.jpg', 0),
(13520, '0000003760.jpg', 1),
(13520, '0000003759.jpg', 2),
(13520, '0000003758.jpg', 3),
(13520, '0000003757.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13520, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13520, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13520, 'Blood Intense Violence', 'enabled');

-- Tom Clancy''s Rainbow Six� Vegas (App ID: 13540)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13540, 'Tom Clancy''s Rainbow Six� Vegas', 85, 'http://www.metacritic.com/games/platforms/pc/tomclancysrainbowsixvegas', 13540, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ubisoft Montreal Publisher : Ubisoft Release Date : December 12');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Single-player Multi-player Blood Intense Violence Strong Language Suggestive Themes');
INSERT IGNORE INTO publishers (name) VALUES ('Ubisoft Release Date : December 12');
INSERT IGNORE INTO publishers (name) VALUES ('2006 Languages : English Single-player Multi-player Blood Intense Violence Strong Language Suggestive Themes');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13540, (SELECT id FROM developers WHERE name = 'Ubisoft Montreal Publisher : Ubisoft Release Date : December 12'), (SELECT id FROM publishers WHERE name = 'Ubisoft Release Date : December 12'), '2006-12-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(13540, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Blood Intense Violence Strong Language Suggestive Themes'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13540, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13540, 'website', 'http://rainbowsixgame.uk.ubi.com/vegas/'),
(13540, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=384'),
(13540, 'manual', 'index.php?area=manual&AppId=13540&l=english');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13540, '0000003731.jpg', 0),
(13540, '0000003730.jpg', 1),
(13540, '0000003729.jpg', 2),
(13540, '0000003728.jpg', 3),
(13540, '0000003727.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13540, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13540, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13540, 'Blood Intense Violence Strong Language Suggestive Themes', 'enabled');

-- Tom Clancys Splinter Cell (App ID: 13560)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, trailer_app_id, about_game_description, header_image_filename) 
VALUES (13560, 'Tom Clancys Splinter Cell', 91, 'http://www.metacritic.com/games/platforms/pc/tomclancyssplintercell', 13560, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (13560, NULL, NULL, NULL);

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(13560, 'minimum', ':'),
(13560, 'recommended', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(13560, 'website', 'http://splintercell.us.ubi.com/'),
(13560, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=383'),
(13560, 'manual', 'index.php?area=manual&AppId=13560&l=spanish');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(13560, '0000003891.jpg', 0),
(13560, '0000003890.jpg', 1),
(13560, '0000003889.jpg', 2),
(13560, '0000003888.jpg', 3),
(13560, '0000003887.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13560, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (13560, 'Blood and Gore Violence', 'enabled');

-- Assassin''s Creed (App ID: 15100)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (15100, 'Assassin''s Creed', 15100, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ubisoft Montreal Publisher : Ubisoft Release Date : April 9');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player Controller enabled Violence Strong Language Blood');
INSERT IGNORE INTO publishers (name) VALUES ('Ubisoft Release Date : April 9');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English Single-player Controller enabled Violence Strong Language Blood');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (15100, (SELECT id FROM developers WHERE name = 'Ubisoft Montreal Publisher : Ubisoft Release Date : April 9'), (SELECT id FROM publishers WHERE name = 'Ubisoft Release Date : April 9'), '2008-04-09');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(15100, (SELECT id FROM languages WHERE name = 'English Single-player Controller enabled Violence Strong Language Blood'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(15100, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(15100, 'website', 'http://www.assassinscreed.com'),
(15100, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=381');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(15100, '0000003847.jpg', 0),
(15100, '0000003846.jpg', 1),
(15100, '0000003845.jpg', 2),
(15100, '0000003844.jpg', 3),
(15100, '0000003843.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15100, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15100, 'Controller', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15100, 'Violence Strong Language Blood', 'enabled');

-- Tom Clancy''s Rainbow Six� Vegas 2 (App ID: 15120)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (15120, 'Tom Clancy''s Rainbow Six� Vegas 2', 15120, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Ubisoft Montreal Publisher : Ubisoft Release Date : April 16');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Single-player Multi-player Co-op Blood Intense Violence Strong Language');
INSERT IGNORE INTO publishers (name) VALUES ('Ubisoft Release Date : April 16');
INSERT IGNORE INTO publishers (name) VALUES ('2008 Languages : English Single-player Multi-player Co-op Blood Intense Violence Strong Language');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (15120, (SELECT id FROM developers WHERE name = 'Ubisoft Montreal Publisher : Ubisoft Release Date : April 16'), (SELECT id FROM publishers WHERE name = 'Ubisoft Release Date : April 16'), '2008-04-16');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(15120, (SELECT id FROM languages WHERE name = 'English Single-player Multi-player Co-op Blood Intense Violence Strong Language'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(15120, 'minimum', ':');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(15120, 'website', 'http://rainbowsixgame.us.ubi.com/home.php'),
(15120, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?f=384');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(15120, '0000003725.jpg', 0),
(15120, '0000003724.jpg', 1),
(15120, '0000003723.jpg', 2),
(15120, '0000003722.jpg', 3),
(15120, '0000003721.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15120, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15120, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15120, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (15120, 'Blood Intense Violence Strong Language', 'enabled');

-- MINERVA (App ID: 90000)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90000, 'MINERVA', 90000, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90000, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90000, 'website', 'http://www.hylobatidae.org/minerva/index.shtml');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90000, '0000000048.jpg', 0),
(90000, '0000000047.jpg', 1),
(90000, '0000000046.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90000, 'Un jugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90000, 'Mod de Half-Life 2', 'enabled');

-- Alien Swarm: Infested (App ID: 90001)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90001, 'Alien Swarm: Infested', 90001, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Black Cat Games Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90001, (SELECT id FROM developers WHERE name = 'Black Cat Games Languages : English Multi-player Half-Life 2 Mod'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90001, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90001, 'website', 'http://www.blackcatgames.com/swarm/index'),
(90001, 'forum', 'http://forums.blackcatgames.com/forumdisplay.php?f=34');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90001, '0000000221.jpg', 0),
(90001, '0000000220.jpg', 1),
(90001, '0000000219.jpg', 2),
(90001, '0000000218.jpg', 3),
(90001, '0000000217.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90001, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90001, 'Half-Life 2 Mod', 'enabled');

-- Natural Selection (App ID: 90002)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90002, 'Natural Selection', 90002, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90002, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90002, 'website', 'http://www.unknownworlds.com/ns/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90002, '0000000211.jpg', 0),
(90002, '0000000210.jpg', 1),
(90002, '0000000202.jpg', 2),
(90002, '0000000201.jpg', 3),
(90002, '0000000200.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90002, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90002, 'Mod de Half-Life', 'enabled');

-- Earth''s Special Forces (App ID: 90003)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90003, 'Earth''s Special Forces', 90003, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Earth''s Special Forces Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90003, (SELECT id FROM developers WHERE name = 'Earth''s Special Forces Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90003, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90003, '0000000178.jpg', 0),
(90003, '0000000177.jpg', 1),
(90003, '0000000176.jpg', 2),
(90003, '0000000175.jpg', 3),
(90003, '0000000174.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90003, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90003, 'Half-Life Mod', 'enabled');

-- The Specialists (App ID: 90004)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90004, 'The Specialists', 90004, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Specialists Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90004, (SELECT id FROM developers WHERE name = 'The Specialists Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90004, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90004, 'website', 'http://www.specialistsmod.net/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90004, '0000000053.jpg', 0),
(90004, '0000000052.jpg', 1),
(90004, '0000000051.jpg', 2),
(90004, '0000000050.jpg', 3),
(90004, '0000000049.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90004, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90004, 'Half-Life Mod', 'enabled');

-- Sven Co-Op (App ID: 90005)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90005, 'Sven Co-Op', 90005, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90005, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90005, 'website', 'http://www.svencoop.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90005, '0000000058.jpg', 0),
(90005, '0000000057.jpg', 1),
(90005, '0000000056.jpg', 2),
(90005, '0000000055.jpg', 3),
(90005, '0000000054.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90005, 'Multijugador', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90005, 'Cooperativo', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90005, 'Mod de Half-Life', 'enabled');

-- BrainBread (App ID: 90006)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90006, 'BrainBread', 90006, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('BrainBread Team Release Date : September 1');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90006, (SELECT id FROM developers WHERE name = 'BrainBread Team Release Date : September 1'), NULL, '2004-09-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90006, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90006, 'website', 'http://www.ironoak.ch/BB/'),
(90006, 'forum', 'http://ironoak.ch/BB/index.php?page=forum');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90006, '0000000063.jpg', 0),
(90006, '0000000062.jpg', 1),
(90006, '0000000061.jpg', 2),
(90006, '0000000060.jpg', 3),
(90006, '0000000059.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90006, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90006, 'Half-Life Mod', 'enabled');

-- International Online Soccer (App ID: 90007)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90007, 'International Online Soccer', 90007, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('I.O.S. Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90007, (SELECT id FROM developers WHERE name = 'I.O.S. Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90007, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90007, 'website', 'http://ios.planethalflife.gamespy.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90007, '0000000068.jpg', 0),
(90007, '0000000067.jpg', 1),
(90007, '0000000066.jpg', 2),
(90007, '0000000065.jpg', 3),
(90007, '0000000064.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90007, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90007, 'Half-Life Mod', 'enabled');

-- The Battle Grounds (App ID: 90008)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90008, 'The Battle Grounds', 90008, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Battle Grounds Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90008, (SELECT id FROM developers WHERE name = 'The Battle Grounds Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90008, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90008, 'website', 'http://www.bgmod.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90008, '0000000073.jpg', 0),
(90008, '0000000072.jpg', 1),
(90008, '0000000071.jpg', 2),
(90008, '0000000070.jpg', 3),
(90008, '0000000069.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90008, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90008, 'Half-Life Mod', 'enabled');

-- Adrenaline Gamer (App ID: 90009)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90009, 'Adrenaline Gamer', 90009, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Adrenaline Gamer Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90009, (SELECT id FROM developers WHERE name = 'Adrenaline Gamer Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90009, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90009, 'website', 'http://www.planethalflife.com/agmod/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90009, '0000000078.jpg', 0),
(90009, '0000000077.jpg', 1),
(90009, '0000000076.jpg', 2),
(90009, '0000000075.jpg', 3),
(90009, '0000000074.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90009, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90009, 'Half-Life Mod', 'enabled');

-- Digital Paintball (App ID: 90010)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90010, 'Digital Paintball', 90010, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Digital Paintball Team Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90010, (SELECT id FROM developers WHERE name = 'Digital Paintball Team Languages : English Multi-player Half-Life Mod'), NULL, NULL);

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90010, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90010, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90010, 'Half-Life Mod', 'enabled');

-- Plan of Attack (App ID: 90011)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90011, 'Plan of Attack', 90011, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Plan of Attack Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90011, (SELECT id FROM developers WHERE name = 'Plan of Attack Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90011, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90011, 'website', 'steam://openurl/http://www.planofattackgame.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90011, '0000000083.jpg', 0),
(90011, '0000000082.jpg', 1),
(90011, '0000000081.jpg', 2),
(90011, '0000000080.jpg', 3),
(90011, '0000000079.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90011, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90011, 'Half-Life 2 Mod', 'enabled');

-- Zombie Panic: Source (App ID: 90012)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90012, 'Zombie Panic: Source', 90012, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Zombie Panic Team Release Date : December 28');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Multi-player Co-op Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90012, (SELECT id FROM developers WHERE name = 'Zombie Panic Team Release Date : December 28'), NULL, '2007-12-28');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90012, (SELECT id FROM languages WHERE name = 'English Multi-player Co-op Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90012, 'website', 'http://www.zombiepanic.org/site/index.php');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90012, '0000003518.jpg', 0),
(90012, '0000003517.jpg', 1),
(90012, '0000003516.jpg', 2),
(90012, '0000003515.jpg', 3),
(90012, '0000003514.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90012, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90012, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90012, 'Half-Life 2 Mod', 'enabled');

-- Half-Life 2: Capture the Flag (App ID: 90013)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90013, 'Half-Life 2: Capture the Flag', 90013, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90013, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90013, 'website', 'http://hl2ctf.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90013, '0000000191.jpg', 0);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90013, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90013, 'Модификация для Half-Life 2', 'enabled');

-- Frontline Force (App ID: 90014)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90014, 'Frontline Force', 90014, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Frontline Force Team Release Date : February 1');
INSERT IGNORE INTO developers (name) VALUES ('2004 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90014, (SELECT id FROM developers WHERE name = 'Frontline Force Team Release Date : February 1'), NULL, '2004-02-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90014, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90014, '0000000088.jpg', 0),
(90014, '0000000087.jpg', 1),
(90014, '0000000086.jpg', 2),
(90014, '0000000085.jpg', 3),
(90014, '0000000084.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90014, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90014, 'Half-Life 2 Mod', 'enabled');

-- Science and Industry (App ID: 90017)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90017, 'Science and Industry', 90017, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Science and Industry Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90017, (SELECT id FROM developers WHERE name = 'Science and Industry Team Release Date : January 1'), NULL, '2002-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90017, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90017, 'website', 'http://www.planethalflife.com/si/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90017, '0000000098.jpg', 0),
(90017, '0000000097.jpg', 1),
(90017, '0000000096.jpg', 2),
(90017, '0000000095.jpg', 3),
(90017, '0000000094.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90017, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90017, 'Half-Life Mod', 'enabled');

-- The Trenches (App ID: 90018)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90018, 'The Trenches', 90018, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('The Trenches Team Release Date : October 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90018, (SELECT id FROM developers WHERE name = 'The Trenches Team Release Date : October 1'), NULL, '2002-10-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90018, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90018, 'website', 'http://www.thetrenches.net/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90018, '0000000186.jpg', 0),
(90018, '0000000185.jpg', 1),
(90018, '0000000184.jpg', 2),
(90018, '0000000183.jpg', 3),
(90018, '0000000182.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90018, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90018, 'Half-Life Mod', 'enabled');

-- Vampire Slayer (App ID: 90020)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90020, 'Vampire Slayer', 90020, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Vampire Slayer Release Date : September 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90020, (SELECT id FROM developers WHERE name = 'Vampire Slayer Release Date : September 1'), NULL, '2002-09-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90020, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90020, 'website', 'http://vampire.planethalflife.gamespy.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90020, '0000000181.jpg', 0),
(90020, '0000000180.jpg', 1),
(90020, '0000000179.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90020, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90020, 'Half-Life Mod', 'enabled');

-- Action Half-Life (App ID: 90021)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90021, 'Action Half-Life', 90021, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Action Half-Life Team Release Date : July 1');
INSERT IGNORE INTO developers (name) VALUES ('2002 Languages : English Multi-player Half-Life Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90021, (SELECT id FROM developers WHERE name = 'Action Half-Life Team Release Date : July 1'), NULL, '2002-07-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90021, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90021, 'website', 'http://ahl.telefragged.com/'),
(90021, 'forum', 'http://www.ministryofaction.net/phpBB2/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90021, '0000000108.jpg', 0),
(90021, '0000000107.jpg', 1),
(90021, '0000000106.jpg', 2),
(90021, '0000000105.jpg', 3),
(90021, '0000000104.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90021, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90021, 'Half-Life Mod', 'enabled');

-- Dystopia (App ID: 90023)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90023, 'Dystopia', 90023, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90023, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90023, 'website', 'http://dystopia-game.com/'),
(90023, 'manual', 'index.php?area=manual&AppId=90023&l=russian');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90023, '0000000213.jpg', 0),
(90023, '0000000212.jpg', 1);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90023, 'Сетевые игры', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90023, 'Модификация для Half-Life 2', 'enabled');

-- Garry''s MOD 9 (App ID: 90024)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90024, 'Garry''s MOD 9', 4000, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90024, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90024, 'website', 'http://www.garrysmod.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90024, '0000000216.jpg', 0),
(90024, '0000000215.jpg', 1),
(90024, '0000000214.jpg', 2);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90024, 'ผู้เล่นคนเดียว', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90024, 'Half-Life 2 Mod', 'enabled');

-- Hidden: Source (App ID: 90025)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90025, 'Hidden: Source', 90025, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Hidden: Source Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90025, (SELECT id FROM developers WHERE name = 'Hidden: Source Team Release Date : January 1'), NULL, '2005-01-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90025, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90025, 'website', 'http://www.hidden-source.com');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90025, '0000000495.jpg', 0),
(90025, '0000000494.jpg', 1),
(90025, '0000000493.jpg', 2),
(90025, '0000000492.jpg', 3),
(90025, '0000000491.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90025, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90025, 'Half-Life 2 Mod', 'enabled');

-- Battle Grounds 2 (beta) (App ID: 90026)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90026, 'Battle Grounds 2 (beta)', 90026, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('BG2 Team Release Date : August 12');
INSERT IGNORE INTO developers (name) VALUES ('2005 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90026, (SELECT id FROM developers WHERE name = 'BG2 Team Release Date : August 12'), NULL, '2005-08-12');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90026, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90026, 'website', 'http://www.bgmod.com/'),
(90026, 'forum', 'http://www.bgmod.com/index.php?include=pre_forums');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90026, '0000000235.jpg', 0),
(90026, '0000000234.jpg', 1),
(90026, '0000000233.jpg', 2),
(90026, '0000000232.jpg', 3);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90026, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90026, 'Half-Life 2 Mod', 'enabled');

-- Source Forts (App ID: 90034)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90034, 'Source Forts', 928, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Source Forts Team Release Date : August 1');
INSERT IGNORE INTO developers (name) VALUES ('2006 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90034, (SELECT id FROM developers WHERE name = 'Source Forts Team Release Date : August 1'), NULL, '2006-08-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90034, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90034, 'website', 'index.php?area=game&AppId=928&cc=US'),
(90034, 'website', 'http://www.sourcefortsmod.com/'),
(90034, 'forum', 'http://www.sourcefortsmod.com/boards/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90034, '0000000510.jpg', 0),
(90034, '0000000509.jpg', 1),
(90034, '0000000508.jpg', 2),
(90034, '0000000507.jpg', 3),
(90034, '0000000506.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90034, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90034, 'Half-Life 2 Mod', 'enabled');

-- Rock 24 (App ID: 90035)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90035, 'Rock 24', 90035, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Rock 24 Team Release Date : November 17');
INSERT IGNORE INTO developers (name) VALUES ('2006 Single-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90035, (SELECT id FROM developers WHERE name = 'Rock 24 Team Release Date : November 17'), NULL, '2006-11-17');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90035, 'website', 'http://developer.valvesoftware.com/wiki/Rock_24');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90035, '0000001093.jpg', 0),
(90035, '0000001092.jpg', 1),
(90035, '0000001091.jpg', 2),
(90035, '0000001090.jpg', 3),
(90035, '0000001089.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90035, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90035, 'Half-Life 2 Mod', 'enabled');

-- Synergy (App ID: 90036)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90036, 'Synergy', 90036, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Synergy Team Release Date : September 1');
INSERT IGNORE INTO developers (name) VALUES ('2005 Multi-player Co-op Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90036, (SELECT id FROM developers WHERE name = 'Synergy Team Release Date : September 1'), NULL, '2005-09-01');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90036, 'website', 'steam://openurl/http://synergymod.com');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90036, '0000001120.jpg', 0),
(90036, '0000001119.jpg', 1),
(90036, '0000001118.jpg', 2),
(90036, '0000001117.jpg', 3),
(90036, '0000001116.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90036, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90036, 'Co-op', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90036, 'Half-Life 2 Mod', 'enabled');

-- Pirates, Vikings and Knights II (App ID: 90037)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90037, 'Pirates, Vikings and Knights II', 90037, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Pirates');
INSERT IGNORE INTO developers (name) VALUES ('Vikings and Knights II Team Release Date : January 1');
INSERT IGNORE INTO developers (name) VALUES ('2007 Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90037, (SELECT id FROM developers WHERE name = 'Pirates'), NULL, '2007-01-01');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90037, '0000001128.jpg', 0),
(90037, '0000001127.jpg', 1),
(90037, '0000001126.jpg', 2),
(90037, '0000001125.jpg', 3),
(90037, '0000001124.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90037, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90037, 'Half-Life 2 Mod', 'enabled');

-- Insects Infestation (App ID: 90038)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90038, 'Insects Infestation', 90038, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Insects Infestation Team Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90038, (SELECT id FROM developers WHERE name = 'Insects Infestation Team Multi-player Half-Life 2 Mod'), NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90038, 'website', 'http://www.insectsinfestation.com'),
(90038, 'forum', 'http://www.insectsinfestation.com/forum/index.php'),
(90038, 'stats', 'http://www.steampowered.com/v/index.php?area=stats');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90038, '0000001175.jpg', 0),
(90038, '0000001174.jpg', 1),
(90038, '0000001173.jpg', 2),
(90038, '0000001172.jpg', 3),
(90038, '0000001171.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90038, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90038, 'Half-Life 2 Mod', 'enabled');

-- Eternal Silence (App ID: 90039)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90039, 'Eternal Silence', 90039, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('ES Team Release Date : March 1');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90039, (SELECT id FROM developers WHERE name = 'ES Team Release Date : March 1'), NULL, '2007-03-01');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90039, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(90039, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection'),
(90039, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90039, 'website', 'http://www.eternal-silence.net');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90039, '0000001572.jpg', 0),
(90039, '0000001571.jpg', 1),
(90039, '0000001570.jpg', 2),
(90039, '0000001569.jpg', 3),
(90039, '0000001568.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90039, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90039, 'Half-Life 2 Mod', 'enabled');

-- Awakening (App ID: 90040)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90040, 'Awakening', 90040, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Bluestrike Release Date : June 4');
INSERT IGNORE INTO developers (name) VALUES ('2007 Single-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90040, (SELECT id FROM developers WHERE name = 'Bluestrike Release Date : June 4'), NULL, '2007-06-04');

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(90040, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection'),
(90040, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90040, 'website', 'http://awakening.hl2files.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90040, '0000002112.jpg', 0),
(90040, '0000002111.jpg', 1),
(90040, '0000002110.jpg', 2),
(90040, '0000002109.jpg', 3),
(90040, '0000002108.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90040, 'Single-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90040, 'Half-Life 2 Mod', 'enabled');

-- Revolt The Decimation (App ID: 90041)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90041, 'Revolt The Decimation', 90041, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Lanclan Development Release Date : June 15');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90041, (SELECT id FROM developers WHERE name = 'Lanclan Development Release Date : June 15'), NULL, '2007-06-15');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90041, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(90041, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection'),
(90041, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90041, 'website', 'http://thedecimation.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90041, '0000002207.jpg', 0),
(90041, '0000002206.jpg', 1),
(90041, '0000002205.jpg', 2),
(90041, '0000002204.jpg', 3),
(90041, '0000002203.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90041, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90041, 'Half-Life 2 Mod', 'enabled');

-- INSURGENCY (App ID: 90043)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90043, 'INSURGENCY', 90043, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Insurgency Team Release Date : October 23');
INSERT IGNORE INTO developers (name) VALUES ('2007 Languages : English Multi-player Half-Life 2 Mod Valve Anti-Cheat enabled');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90043, (SELECT id FROM developers WHERE name = 'Insurgency Team Release Date : October 23'), NULL, '2007-10-23');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90043, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod Valve Anti-Cheat enabled'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(90043, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(90043, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90043, 'website', 'http://www.insurgencymod.net/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90043, '0000003052.jpg', 0),
(90043, '0000003051.jpg', 1),
(90043, '0000003050.jpg', 2),
(90043, '0000003049.jpg', 3),
(90043, '0000003048.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90043, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90043, 'Half-Life 2 Mod', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90043, 'Valve Anti-Cheat', 'enabled');

-- Age of Chivalry (App ID: 90045)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90045, 'Age of Chivalry', 90045, '', 'header.jpg');


INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90045, NULL, NULL, NULL);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90045, 'website', 'http://www.age-of-chivalry.com/'),
(90045, 'manual', 'index.php?area=manual&AppId=90045&l=french');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90045, '0000003699.jpg', 0),
(90045, '0000003698.jpg', 1),
(90045, '0000003697.jpg', 2),
(90045, '0000003696.jpg', 3),
(90045, '0000003695.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90045, 'Multijoueur', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90045, 'Mod Half-Life 2', 'enabled');

-- D.I.P.R.I.P. (App ID: 90046)
INSERT IGNORE INTO games (app_id, title, trailer_app_id, about_game_description, header_image_filename) 
VALUES (90046, 'D.I.P.R.I.P.', 90046, '', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Exor Team Release Date : March 18');
INSERT IGNORE INTO developers (name) VALUES ('2008 Languages : English Multi-player Half-Life 2 Mod');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (90046, (SELECT id FROM developers WHERE name = 'Exor Team Release Date : March 18'), NULL, '2008-03-18');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES 
(90046, (SELECT id FROM languages WHERE name = 'English Multi-player Half-Life 2 Mod'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(90046, 'minimum', '1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(90046, 'recommended', '2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(90046, 'website', 'http://diprip.com/');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(90046, '0000003836.jpg', 0),
(90046, '0000003835.jpg', 1),
(90046, '0000003834.jpg', 2),
(90046, '0000003833.jpg', 3),
(90046, '0000003832.jpg', 4);

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90046, 'Multi-player', 'enabled');
INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES (90046, 'Half-Life 2 Mod', 'enabled');

-- Trailer: RACE 07 TV Commercial (Media App ID: 99001)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4260, 99001);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99001, 'RACE 07 TV Commercial', 'SimBin Languages : English Length : 00:30', NULL, '', '00:30', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99001, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Ducati World Championship Trailer (Media App ID: 99004)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6270, 99004);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99004, 'Ducati World Championship Trailer', 'Artematica Entertainment Languages : English Length : 01:11', NULL, '', '01:11', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99004, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Sherlock Holmes Trailer (Media App ID: 99005)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (7250, 99005);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99005, 'Sherlock Holmes Trailer', 'Frogwares Languages : English Length : 01:48', NULL, '', '01:48', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99005, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: SEGA Rally Revo Trailer (Media App ID: 99008)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4790, 99008);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99008, 'SEGA Rally Revo Trailer', 'Sega Racing Studio Publisher : SEGA Languages : English Length : 01:52', NULL, '', '01:52', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99008, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Conflict: Denied Ops Trailer (Media App ID: 99012)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8100, 99012);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99012, 'Conflict: Denied Ops Trailer', 'Pivotal Games Publisher : Eidos Interactive Languages : English Length : 01:08', NULL, '', '01:08', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99012, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Max Payne Trailer (Media App ID: 99019)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (12140, 99019);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99019, 'Max Payne Trailer', 'Remedy Entertainment Publisher : Rockstar Games Languages : English Length : 00:30', NULL, '', '00:30', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99019, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Grand Theft Auto: San Andreas Trailer (Media App ID: 99024)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (12120, 99024);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99024, 'Grand Theft Auto: San Andreas Trailer', 'Rockstar Games Publisher : Rockstar Games Languages : English Length : 1:13', NULL, '', '1:13', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99024, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Death to Spies Trailer (Media App ID: 99029)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (9800, 99029);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99029, 'Death to Spies Trailer', 'Haggard Games Languages : English Length : 02:50', NULL, '', '02:50', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99029, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Culpa Innata Trailer (Media App ID: 99030)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (12310, 99030);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99030, 'Culpa Innata Trailer', 'Momentum Digital Media Technologies Languages : English', NULL, '', '', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99030, (SELECT id FROM languages WHERE name = 'English'));


-- Trailer: Darkstar One Trailer (Media App ID: 99032)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (12330, 99032);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99032, 'Darkstar One Trailer', 'Ascaron Entertainment ltd. Languages : English Length : 01:51', NULL, '', '01:51', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99032, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Gametrailers TV Episode 106 Promo (Media App ID: 99033)
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99033, 'Gametrailers TV Episode 106 Promo', 'Spike TV Languages : English Length : 00:22', NULL, '', '00:22', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99033, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Far Cry Trailer (Media App ID: 99037)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (13520, 99037);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99037, 'Far Cry Trailer', 'Crytek Studios Languages : English Length : 02:14', NULL, '', '02:14', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99037, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Ninja Reflex: Katana Gameplay Video (Media App ID: 99038)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (13000, 99038);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99038, 'Ninja Reflex: Katana Gameplay Video', 'Sanzaru Games Publisher : Nunchuck Games Languages : English Length : 00:22', NULL, '', '00:22', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99038, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Ninja Reflex: Hashi Gameplay Video (Media App ID: 99039)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (13000, 99039);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99039, 'Ninja Reflex: Hashi Gameplay Video', 'Sanzaru Games Publisher : Nunchuck Games Languages : English Length : 00:18', NULL, '', '00:18', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(99039, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Bullet Candy Gameplay Trailer (Media App ID: 99048)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (6600, 99048);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (99048, 'Bullet Candy Gameplay Trailer', '', NULL, '', '', '', '');


-- Trailer: Attack on Pearl Harbor Trailer 1 (Media App ID: 900514)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8620, 900514);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (900514, 'Attack on Pearl Harbor Trailer 1', 'Legendo Entertainment AB Languages : English Length : 01:00', NULL, '', '01:00', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(900514, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Attack on Pearl Harbor Trailer 2 (Media App ID: 900515)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (8620, 900515);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (900515, 'Attack on Pearl Harbor Trailer 2', 'Legendo Entertainment AB Languages : English Length : 02:08', NULL, '', '02:08', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(900515, (SELECT id FROM languages WHERE name = 'English Length'));


-- Trailer: Medieval 2: Total War Kingdoms Trailer (Media App ID: 900520)
INSERT IGNORE INTO game_trailers (app_id, trailer_app_id) VALUES (4780, 900520);
INSERT IGNORE INTO trailers (trailer_app_id, title, producer, release_date, resolution, length, header_image_filename, video_asset_path)
VALUES (900520, 'Medieval 2: Total War Kingdoms Trailer', 'The Creative Assembly Languages : English', NULL, '', '', '', '');

INSERT IGNORE INTO trailer_languages (trailer_app_id, language_id) VALUES 
(900520, (SELECT id FROM languages WHERE name = 'English'));

