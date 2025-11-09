-- Create table to store historical Steam game statistics and seed default data

CREATE TABLE IF NOT EXISTS game_stats (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(255) NOT NULL,
    game_website VARCHAR(255) DEFAULT NULL,
    current_players INT UNSIGNED NOT NULL DEFAULT 0,
    current_servers INT UNSIGNED NOT NULL DEFAULT 0,
    player_minutes_per_month BIGINT UNSIGNED NOT NULL DEFAULT 0,
    display_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_game_stats_name (game_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings (`key`, value) VALUES
    ('game_stats_avg_users', '2357340'),
    ('game_stats_avg_minutes', '9434000000'),
    ('game_stats_last_updated_text', '9:19pm PST (05:19 GMT), April 13 2005'),
    ('game_stats_current_players_total', '90468'),
    ('game_stats_peak_players_total', '90468'),
    ('game_stats_current_servers_total', '72473'),
    ('game_stats_peak_servers_total', '72473')
ON DUPLICATE KEY UPDATE value = VALUES(value);

INSERT INTO game_stats (game_name, game_website, current_players, current_servers, player_minutes_per_month, display_order)
VALUES
    ('Counter-Strike', 'http://www.counter-strike.net/', 56612, 46507, 3454000000, 1),
    ('Counter-Strike: Source', 'http://www.steampowered.com/index.php?area=productnews_CSS', 17803, 12845, 1133000000, 2),
    ('Counter-Strike Condition Zero', 'http://www.cs-conditionzero.com/', 8337, 7126, 563782000, 3),
    ('Day of Defeat', 'http://www.dayofdefeatmod.com/', 3833, 2505, 186834000, 4),
    ('Half-Life 2: Deathmatch', 'http://www.half-life2.com/', 1095, 1014, 51511000, 5),
    ('Natural Selection', 'http://www.unknownworlds.com/ns', 818, 506, 40480000, 6),
    ('TeamFortress Classic', 'http://www.valvesoftware.com/', 687, 719, 31122000, 7),
    ('The Specialists', 'http://www.specialistsmod.net/', 237, 120, 10122000, 8),
    ('Half-Life DeathMatch', 'http://www.valvesoftware.com/', 217, 294, 17651000, 9),
    ('Sven Co-Op', 'http://www.svencoop.com/', 104, 78, 6467000, 10),
    ('Earth''s Special Forces', 'http://www.esforces.com/', 92, 80, 6809000, 11),
    ('Garry''s Mod', 'http://www.garry.tv/garrysmod/', 82, 53, 4204000, 12),
    ('Digital Paintball', 'http://www.digitalpaintball.net/', 74, 39, 2719000, 13),
    ('BrainBread', 'http://www.ironoak.de/BB/', 49, 25, 2352000, 14),
    ('The Battle Grounds', 'http://www.bgmod.com/', 46, 22, 1869000, 15),
    ('Firearms', 'http://firearmsmod.com/', 40, 37, 2149000, 16),
    ('Opposing Force', 'http://games.sierra.com/games/opposingforce/', 37, 39, 2117000, 17),
    ('Half Life 2 Capture The Flag', 'http://www.hl2ctf.com/', 37, 37, 2076000, 18),
    ('SourceForts', 'http://knd.org.uk/sourceforts/', 33, 12, 2140000, 19),
    ('Garry''s Mod for Counter-Strike: Source', 'http://www.garry.tv/garrysmod/', 30, 16, 1587000, 20),
    ('Hostile Intent', 'http://www.hostileintent.org/', 29, 23, 1186000, 21),
    ('Adrenaline Gamer', 'http://www.planethalflife.com/agmod/', 17, 43, 1040000, 22),
    ('trackirhldm', NULL, 13, 13, 542000, 23),
    ('Vampire Slayer', 'http://www.planethalflife.com/vampire', 13, 12, 718000, 24),
    ('Deathmatch Classic', 'http://www.valvesoftware.com/', 12, 34, 938000, 25),
    ('The Trenches', 'http://www.thetrenches.net/', 12, 17, 404000, 26),
    ('International Online Soccer', 'http://www.planethalflife.com/ios/', 11, 23, 934000, 27),
    ('Action Half-Life', 'http://ahl.telefragged.com/', 9, 18, 247000, 28),
    ('cs13', NULL, 7, 15, 351000, 29),
    ('csv15', NULL, 1, 18, 175000, 30),
    ('HalfLife-Rally Beta 1.0', 'http://www.hlrally.net/', 1, 17, 170000, 31),
    ('Ricochet', 'http://www.valvesoftware.com/', 1, 16, 464000, 32)
ON DUPLICATE KEY UPDATE
    game_website = VALUES(game_website),
    current_players = VALUES(current_players),
    current_servers = VALUES(current_servers),
    player_minutes_per_month = VALUES(player_minutes_per_month),
    display_order = VALUES(display_order);
