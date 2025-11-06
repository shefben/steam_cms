-- Steam Games 2007-2008 Archive Database Schema
-- Extracted from Wayback Machine archives of steampowered.com
-- Normalized structure following SteamCMS project guidelines

-- Create database if needed
-- CREATE DATABASE steam_cms_2007;
-- USE steam_cms_2007;

-- Main games table
CREATE TABLE IF NOT EXISTS games (
    app_id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    metascore INT NULL,
    metascore_url TEXT NULL,
    trailer_app_id INT NULL,
    about_game_description TEXT NULL,
    header_image_filename VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_title (title),
    INDEX idx_metascore (metascore)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Developers table
CREATE TABLE IF NOT EXISTS developers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Publishers table  
CREATE TABLE IF NOT EXISTS publishers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game details table
CREATE TABLE IF NOT EXISTS game_details (
    app_id INT PRIMARY KEY,
    developer_id INT NULL,
    publisher_id INT NULL,
    release_date DATE NULL,
    game_rating VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    FOREIGN KEY (developer_id) REFERENCES developers(id),
    FOREIGN KEY (publisher_id) REFERENCES publishers(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game categories junction table
CREATE TABLE IF NOT EXISTS game_categories (
    app_id INT,
    category_id INT,
    PRIMARY KEY (app_id, category_id),
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Languages table
CREATE TABLE IF NOT EXISTS languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    code VARCHAR(10) NOT NULL UNIQUE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game languages junction table
CREATE TABLE IF NOT EXISTS game_languages (
    app_id INT,
    language_id INT,
    PRIMARY KEY (app_id, language_id),
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    FOREIGN KEY (language_id) REFERENCES languages(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game options/features table
CREATE TABLE IF NOT EXISTS game_options (
    app_id INT,
    option_name VARCHAR(100),
    option_value VARCHAR(255),
    PRIMARY KEY (app_id, option_name),
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- System requirements table
CREATE TABLE IF NOT EXISTS system_requirements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_id INT NOT NULL,
    requirement_type ENUM('minimum', 'recommended') NOT NULL,
    os VARCHAR(255) NULL,
    processor VARCHAR(255) NULL,
    memory VARCHAR(100) NULL,
    graphics VARCHAR(255) NULL,
    directx VARCHAR(100) NULL,
    hard_drive VARCHAR(100) NULL,
    sound VARCHAR(255) NULL,
    network VARCHAR(255) NULL,
    other_notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    UNIQUE KEY unique_req_type (app_id, requirement_type)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Screenshots table
CREATE TABLE IF NOT EXISTS screenshots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    INDEX idx_app_order (app_id, sort_order)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Media links table
CREATE TABLE IF NOT EXISTS media_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_id INT NOT NULL,
    link_type VARCHAR(50) NOT NULL, -- 'forum', 'media', 'video', 'trailer', etc.
    url TEXT NOT NULL,
    title VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    INDEX idx_app_type (app_id, link_type)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game packages table (modern Steam format)
CREATE TABLE IF NOT EXISTS game_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_id INT NOT NULL,
    sub_id INT NULL,
    package_name VARCHAR(255) NULL,
    price VARCHAR(50) NULL,
    discount_percent INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    INDEX idx_app_sub (app_id, sub_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Insert some common languages
INSERT IGNORE INTO languages (name, code) VALUES 
('English', 'en'),
('French', 'fr'),
('German', 'de'),
('Spanish', 'es'),
('Italian', 'it'),
('Russian', 'ru'),
('Japanese', 'ja'),
('Korean', 'ko'),
('Chinese (Simplified)', 'zh-cn'),
('Chinese (Traditional)', 'zh-tw'),
('Portuguese', 'pt'),
('Polish', 'pl'),
('Dutch', 'nl'),
('Swedish', 'sv'),
('Norwegian', 'no'),
('Danish', 'da'),
('Finnish', 'fi'),
('Thai', 'th');

-- EXTRACTED DATA

INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (130, 'Half-Life: Blue Shift', 71, 'http://www.metacritic.com/games/platforms/pc/halflifeblueshift', 'Made by Gearbox Software and originally released in 2001 as an add-on to Half-Life, Blue Shift is a return to the Black Mesa Research Facility in which you play as Barney Calhoun, the security guard sidekick who helped Gordon out of so many sticky situations.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Gearbox Software');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (130, (SELECT id FROM developers WHERE name = 'Gearbox Software'), (SELECT id FROM publishers WHERE name = 'Valve'), '2001-06-01');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (130, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (130, (SELECT id FROM languages WHERE name = 'French'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (130, (SELECT id FROM languages WHERE name = 'German'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (130, '0000000131.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (130, '0000000130.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (130, '0000000129.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (130, '0000000128.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (130, '0000000127.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (219, 'Half-Life 2: Demo', 96, 'http://www.metacritic.com/games/platforms/pc/halflife2', 'Half-Life 2 defines a new benchmark in gaming with startling realism and responsiveness. Powered by Source™ technology, Half-Life 2 features the most sophisticated in-game characters ever witnessed, advanced AI, stunning graphics and physical gameplay.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (219, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), NULL);
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (219, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (219, '0000000199.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (219, '0000000198.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (219, '0000000197.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (219, '0000000196.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (219, '0000000195.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (300, 'Day of Defeat: Source', 80, 'http://www.metacritic.com/games/platforms/pc/dayofdefeatsource', 'Day of Defeat offers intense online action gameplay set in Europe during WWII. Assume the role of infantry, sniper or machine-gunner classes, and more. DoD:S features enhanced graphics and sounds design to leverage the power of Source, Valve\'s new engine technology.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (300, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2005-09-26');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (300, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (300, '0000000045.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (300, '0000000044.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (300, '0000000043.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (300, '0000000042.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (300, '0000000023.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (320, 'Half-Life 2: Deathmatch', NULL, '%metacritic_url%', 'Fast multiplayer action set in the Half-Life 2 universe! HL2\'s physics adds a new dimension to deathmatch play. Play straight deathmatch or try Combine vs. Resistance teamplay. Toss a toilet at your friend today!', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (320, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2004-11-01');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (320, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (340, 'Half-Life 2: Lost Coast', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (340, '0000000015.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (340, '0000000014.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (340, '0000000013.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (340, '0000000011.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (340, '0000000010.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (360, 'Half-Life Deathmatch: Source', NULL, '%metacritic_url%', 'Half-Life Deathmatch: Source is a recreation of the first multiplayer game set in the Half-Life universe. Features all the classic weapons and most-played maps, now running on the Source engine.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (360, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2006-05-01');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (360, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (380, 'Half-Life 2: Episode One', 87, 'http://www.metacritic.com/games/platforms/pc/halflife2episodeone', 'Half-Life 2 has sold over 4 million copies worldwide, and earned over 35 Game of the Year Awards. Episode One is the first in a series of games that reveal the aftermath of Half-Life 2 and launch a journey beyond City 17. Also features two multiplayer games. Half-Life 2 not required.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (380, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2006-06-01');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (380, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (380, '0000000407.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (380, '0000000311.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (380, '0000000310.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (380, '0000000309.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (380, '0000000308.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (400, 'Portal', 90, 'http://www.metacritic.com/games/platforms/pc/portal', 'Portal™ is a new single player game from Valve. Set in the mysterious Aperture Science Laboratories, Portal has been called one of the most innovative new games on the horizon and will offer gamers hours of unique gameplay.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (400, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2007-10-10');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (400, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (400, '0000002588.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (400, '0000002587.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (400, '0000002586.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (400, '0000002585.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (400, '0000002584.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (420, 'Half-Life 2: Episode Two', 90, 'http://www.metacritic.com/games/platforms/pc/halflife2episode2', 'Half-Life® 2: Episode Two is the second in a trilogy of new games created by Valve that extends the award-winning and best-selling Half-Life® adventure.', 'header.jpg');
INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');
INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES (420, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '2007-10-10');
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (420, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (420, '0000002595.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (420, '0000002594.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (420, '0000002593.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (420, '0000002592.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (420, '0000002591.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (440, 'Team Fortress 2', 93, 'http://www.metacritic.com/games/platforms/pc/teamfortress2', NULL, 'header.jpg');
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (440, '0000002581.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (440, '0000002580.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (440, '0000002579.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (440, '0000002578.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (440, '0000002577.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (900, 'Zombie Movie', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (901, 'Day of Defeat: Prelude to Victory', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (901, '0000000317.jpg', 0);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (901, '0000000316.jpg', 1);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (901, '0000000315.jpg', 2);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (901, '0000000314.jpg', 3);
INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES (901, '0000000313.jpg', 4);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (902, 'Dangerous Waters Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (903, 'Darwinia Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (904, 'Half-Life 2 Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (905, 'Half-Life 2: Episode One Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (906, 'Rag Doll Kung Fu Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (907, 'Red Orchestra Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (908, 'Shadowgrounds Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (909, 'SiN Episode 1: Emergence Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (912, 'HL2:EP1 Launch Teaser 1', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (913, 'HL2:EP1 Launch Teaser 2', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (914, 'HL2:EP1 Launch Teaser 3', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (915, 'HL2:EP1 Launch Teaser 4', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (916, 'Half-Life 2: Episode Two Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (917, 'Day of Defeat: Jagd Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (918, 'Day of Defeat: Colmar Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (919, 'Dark Messiah: Warrior', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (920, 'Dark Messiah: Assassin', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (921, 'Dark Messiah: Wizard', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (922, 'Portal Trailer', NULL, '%metacritic_url%', NULL, NULL);
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (923, 'Team Fortress 2 Trailer', NULL, '%metacritic_url%', NULL, 'header.jpg');
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES (924, 'Red Orchestra Infantry Tutorial', NULL, '%metacritic_url%', NULL, 'header.jpg');

-- CONTINUED EXTRACTION FROM WAYBACK URLs

-- Half-Life (App ID: 70)
INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) 
VALUES (70, 'Half-Life', 96, 'http://www.metacritic.com/games/platforms/pc/halflife', 'Named Game of the Year by over 50 publications, Valve''s debut title blends action and adventure with award-winning technology to create a frighteningly realistic world where players must think to survive. Also includes an exciting multiplayer mode that allows you to play against friends and enemies around the world.', 'header.jpg');

INSERT IGNORE INTO developers (name) VALUES ('Valve');
INSERT IGNORE INTO publishers (name) VALUES ('Valve');

INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) 
VALUES (70, (SELECT id FROM developers WHERE name = 'Valve'), (SELECT id FROM publishers WHERE name = 'Valve'), '1998-11-19');

INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'English'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'French'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'German'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'Italian'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'Korean'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'Spanish'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'Chinese (Simplified)'));
INSERT IGNORE INTO game_languages (app_id, language_id) VALUES (70, (SELECT id FROM languages WHERE name = 'Chinese (Traditional)'));

INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES 
(70, 'minimum', '500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection'),
(70, 'recommended', '800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection');

INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES 
(70, '0000002354.jpg', 0),
(70, '0000002352.jpg', 1),
(70, '0000002351.jpg', 2),
(70, '0000002350.jpg', 3),
(70, '0000002349.jpg', 4);

INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES 
(70, 'website', 'http://www.half-life.com/'),
(70, 'forum', 'http://forums.steampowered.com/forums/forumdisplay.php?s=&forumid=20');

INSERT IGNORE INTO game_options (app_id, option_name, option_value) VALUES 
(70, 'Single-player', 'enabled'),
(70, 'Multi-player', 'enabled'),
(70, 'Valve Anti-Cheat', 'enabled');

-- Game packages for Half-Life
INSERT IGNORE INTO game_packages (app_id, sub_id, package_name, price, discount_percent) VALUES 
(70, 34, 'Half-Life 1', '$9.95', NULL),
(70, 40, 'Half-Life 1 Anthology', '$14.95', NULL),
(70, 478, 'Valve Complete Pack', '$99.95', NULL);
