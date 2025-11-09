-- Rebuild tournaments schema with rich metadata and related lookup tables

DROP TABLE IF EXISTS tournament_game_selection;
DROP TABLE IF EXISTS tournament_registration_selection;
DROP TABLE IF EXISTS tournament_audit_log;
DROP TABLE IF EXISTS tournament_content_blocks;
DROP TABLE IF EXISTS tournament_games;
DROP TABLE IF EXISTS tournament_registration_options;
DROP TABLE IF EXISTS tournaments;

CREATE TABLE tournaments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_reference CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    organizer_name VARCHAR(255) DEFAULT NULL,
    organizer_first_name VARCHAR(100) DEFAULT NULL,
    organizer_last_name VARCHAR(100) DEFAULT NULL,
    organizer_company VARCHAR(255) DEFAULT NULL,
    organizer_type VARCHAR(100) DEFAULT NULL,
    organizer_is_cafe TINYINT(1) NOT NULL DEFAULT 0,
    organizer_email VARCHAR(255) NOT NULL,
    organizer_phone VARCHAR(50) DEFAULT NULL,
    organizer_fax VARCHAR(50) DEFAULT NULL,
    organizer_address1 VARCHAR(255) DEFAULT NULL,
    organizer_address2 VARCHAR(255) DEFAULT NULL,
    organizer_city VARCHAR(120) DEFAULT NULL,
    organizer_state VARCHAR(120) DEFAULT NULL,
    organizer_postal_code VARCHAR(32) DEFAULT NULL,
    organizer_country VARCHAR(120) DEFAULT NULL,
    venue_name VARCHAR(255) DEFAULT NULL,
    venue_address1 VARCHAR(255) DEFAULT NULL,
    venue_address2 VARCHAR(255) DEFAULT NULL,
    venue_city VARCHAR(120) DEFAULT NULL,
    venue_state VARCHAR(120) DEFAULT NULL,
    venue_postal_code VARCHAR(32) DEFAULT NULL,
    venue_country VARCHAR(120) DEFAULT NULL,
    is_online_only TINYINT(1) NOT NULL DEFAULT 0,
    event_website VARCHAR(255) DEFAULT NULL,
    event_email VARCHAR(255) DEFAULT NULL,
    lan_or_online ENUM('lan','online','both') DEFAULT NULL,
    expected_participants INT DEFAULT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    start_time TIME DEFAULT NULL,
    end_time TIME DEFAULT NULL,
    timezone VARCHAR(64) DEFAULT NULL,
    requested_calendar_listing TINYINT(1) NOT NULL DEFAULT 0,
    show_on_calendar TINYINT(1) NOT NULL DEFAULT 0,
    show_on_sidebar TINYINT(1) NOT NULL DEFAULT 0,
    show_on_landing TINYINT(1) NOT NULL DEFAULT 0,
    temporary_accounts_requested TINYINT(1) NOT NULL DEFAULT 0,
    temporary_accounts_quantity INT DEFAULT NULL,
    description MEDIUMTEXT,
    game_list_summary TEXT,
    registration_notes TEXT,
    status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
    moderator_notes MEDIUMTEXT,
    status_reason TEXT,
    status_changed_at DATETIME DEFAULT NULL,
    status_changed_by INT DEFAULT NULL,
    approved_at DATETIME DEFAULT NULL,
    rejected_at DATETIME DEFAULT NULL,
    confirmation_sent_at DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_start_date (start_date),
    INDEX idx_calendar_flag (show_on_calendar, start_date),
    INDEX idx_sidebar_flag (show_on_sidebar, start_date),
    UNIQUE KEY uniq_submission_reference (submission_reference)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_registration_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(32) NOT NULL,
    label VARCHAR(120) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    active TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE KEY uniq_tournament_registration_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_registration_selection (
    tournament_id INT NOT NULL,
    option_id INT NOT NULL,
    PRIMARY KEY (tournament_id, option_id),
    CONSTRAINT fk_tournament_registration_selection_tournament FOREIGN KEY (tournament_id)
        REFERENCES tournaments(id) ON DELETE CASCADE,
    CONSTRAINT fk_tournament_registration_selection_option FOREIGN KEY (option_id)
        REFERENCES tournament_registration_options(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(32) NOT NULL,
    label VARCHAR(150) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    active TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE KEY uniq_tournament_game_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_game_selection (
    tournament_id INT NOT NULL,
    game_id INT NOT NULL,
    PRIMARY KEY (tournament_id, game_id),
    CONSTRAINT fk_tournament_game_selection_tournament FOREIGN KEY (tournament_id)
        REFERENCES tournaments(id) ON DELETE CASCADE,
    CONSTRAINT fk_tournament_game_selection_game FOREIGN KEY (game_id)
        REFERENCES tournament_games(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_content_blocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_slug VARCHAR(64) NOT NULL,
    theme VARCHAR(64) NOT NULL,
    block_key VARCHAR(64) NOT NULL,
    block_label VARCHAR(255) NOT NULL,
    content MEDIUMTEXT NOT NULL,
    position INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_tournament_content_block (page_slug, theme, block_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tournament_audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tournament_id INT NOT NULL,
    admin_id INT DEFAULT NULL,
    action VARCHAR(64) NOT NULL,
    notes TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_tournament_audit_log_tournament FOREIGN KEY (tournament_id)
        REFERENCES tournaments(id) ON DELETE CASCADE,
    CONSTRAINT fk_tournament_audit_log_admin FOREIGN KEY (admin_id)
        REFERENCES admin_users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tournament_registration_options (slug, label, sort_order) VALUES
    ('email', 'Email-In Registration', 1),
    ('walk-in', 'Walk-In Registration', 2),
    ('web', 'Web Registration', 3)
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order), active = 1;

INSERT INTO tournament_games (slug, label, sort_order) VALUES
    ('all', 'All Games', 1),
    ('cs', 'Counter-Strike', 2),
    ('css', 'Counter-Strike: Source', 3),
    ('cscz', 'Counter-Strike: Condition Zero', 4),
    ('dod', 'Day of Defeat', 5),
    ('dods', 'Day of Defeat: Source', 6),
    ('dmc', 'Deathmatch Classic', 7),
    ('hl', 'Half-Life', 8),
    ('hldm', 'Half-Life Deathmatch', 9),
    ('hl2', 'Half-Life 2', 10),
    ('hl2dm', 'Half-Life 2 Deathmatch', 11),
    ('hls', 'Half-Life: Source', 12),
    ('rico', 'Ricochet', 13),
    ('tfc', 'Team Fortress Classic', 14)
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order), active = 1;
