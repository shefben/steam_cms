-- Migration: Create single_large_capsule table for 2007+/2008 theme large capsules
-- Each entry contains: appid, image_path, description, url
-- Title and price are looked up from store_apps table

CREATE TABLE IF NOT EXISTS single_large_capsule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(50) NOT NULL,
    appid INT DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL DEFAULT '',
    description TEXT,
    url VARCHAR(255) NOT NULL DEFAULT '',
    `order` INT NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_theme (theme),
    INDEX idx_theme_order (theme, `order`),
    CONSTRAINT fk_single_large_capsule_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE SET NULL
);

-- Insert sample data for 2007_v1 theme
INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`) VALUES
('2007_v1', 220, '2007_v1/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1),
('2007_v1', 240, '2007_v1/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2),
('2007_v1', 300, '2007_v1/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3);

-- Insert sample data for 2007_v2 theme
INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`) VALUES
('2007_v2', 220, '2007_v2/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1),
('2007_v2', 240, '2007_v2/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2),
('2007_v2', 300, '2007_v2/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3);

-- Insert sample data for 2008 theme
INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`) VALUES
('2008', 220, '2008/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1),
('2008', 240, '2008/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2),
('2008', 300, '2008/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3);
