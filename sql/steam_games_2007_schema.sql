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

-- Trailers table (for media/trailer content)
CREATE TABLE IF NOT EXISTS trailers (
    trailer_app_id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    producer VARCHAR(255) NULL,
    release_date DATE NULL,
    resolution VARCHAR(50) NULL,
    length VARCHAR(20) NULL,
    header_image_filename VARCHAR(255) NULL,
    video_asset_path TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Game trailers junction table
CREATE TABLE IF NOT EXISTS game_trailers (
    app_id INT,
    trailer_app_id INT,
    PRIMARY KEY (app_id, trailer_app_id),
    FOREIGN KEY (app_id) REFERENCES games(app_id) ON DELETE CASCADE,
    FOREIGN KEY (trailer_app_id) REFERENCES trailers(trailer_app_id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Trailer languages table
CREATE TABLE IF NOT EXISTS trailer_languages (
    trailer_app_id INT,
    language_id INT,
    PRIMARY KEY (trailer_app_id, language_id),
    FOREIGN KEY (trailer_app_id) REFERENCES trailers(trailer_app_id) ON DELETE CASCADE,
    FOREIGN KEY (language_id) REFERENCES languages(id) ON DELETE CASCADE
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