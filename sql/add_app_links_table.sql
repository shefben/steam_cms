-- Migration: Add app_links table for demo-to-parent relationships
-- Also adds parent_appid column to store_apps for direct lookup

-- Create app_links table for linking apps (demos to parent games, etc)
CREATE TABLE IF NOT EXISTS app_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT NOT NULL,
    linked_appid INT NOT NULL,
    link_type VARCHAR(50) NOT NULL DEFAULT 'parent',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_link (appid, linked_appid, link_type),
    INDEX idx_appid (appid),
    INDEX idx_linked_appid (linked_appid)
);

-- Add parent_appid column to store_apps if it doesn't exist
-- Using IF NOT EXISTS equivalent workaround for MariaDB
SET @exist := (SELECT COUNT(*) FROM information_schema.columns
               WHERE table_schema = DATABASE()
               AND table_name = 'store_apps'
               AND column_name = 'parent_appid');
SET @query := IF(@exist <= 0,
              'ALTER TABLE store_apps ADD COLUMN parent_appid INT DEFAULT NULL AFTER appid',
              'SELECT 1');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Insert known demo-to-parent relationships
-- Half-Life 2 Demo (219) -> Half-Life 2 (220)
INSERT IGNORE INTO app_links (appid, linked_appid, link_type) VALUES (219, 220, 'parent');

-- Darwinia Demo (1502) -> Darwinia (1500)
INSERT IGNORE INTO app_links (appid, linked_appid, link_type) VALUES (1502, 1500, 'parent');

-- Shadowgrounds Demo (2510) -> Shadowgrounds (2500) - assumed parent
INSERT IGNORE INTO app_links (appid, linked_appid, link_type) VALUES (2510, 2500, 'parent');

-- Update store_apps parent_appid for demos (optional, for faster lookups)
UPDATE store_apps SET parent_appid = 220 WHERE appid = 219;
UPDATE store_apps SET parent_appid = 1500 WHERE appid = 1502;
