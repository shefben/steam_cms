-- Steam Theme Date-Based Selection Setup
-- Creates the settings table and sample data for CDRDATE-based theme selection

-- Create settings table if it doesn't exist
CREATE TABLE IF NOT EXISTS `settings` (
  `key` varchar(255) NOT NULL PRIMARY KEY,
  `value` text NOT NULL,
  UNIQUE KEY `key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert or update CDRDATE setting
-- Example dates for testing different themes:

-- For 2002_v1 theme (2001-12-01 to 2002-06-03)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '3/15/2002') ON DUPLICATE KEY UPDATE `value` = '3/15/2002';

-- For 2002_v2 theme (2002-06-04 to 2002-12-31)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '9/20/2002') ON DUPLICATE KEY UPDATE `value` = '9/20/2002';

-- For 2003_v1 theme (2003-01-01 to 2003-06-15)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '4/10/2003') ON DUPLICATE KEY UPDATE `value` = '4/10/2003';

-- For 2003_v2 theme (2003-06-16 to 2003-09-15)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '8/25/2003') ON DUPLICATE KEY UPDATE `value` = '8/25/2003';

-- For 2004 theme (2003-09-16 to 2008-06-15)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '12/31/2005') ON DUPLICATE KEY UPDATE `value` = '12/31/2005';

-- For 2008 theme (2008-06-16 to 2010-04-15)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '1/15/2009') ON DUPLICATE KEY UPDATE `value` = '1/15/2009';

-- For 2011 theme (2010-04-16 to 2017-01-01)
-- INSERT INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '7/20/2012') ON DUPLICATE KEY UPDATE `value` = '7/20/2012';

-- Default: Only set CDRDATE if it does not already exist (preserve CMS installer value)
INSERT IGNORE INTO `settings` (`key`, `value`) VALUES ('CDRDATE', '3/15/2002');

-- Optional: Add other settings that might be useful
INSERT INTO `settings` (`key`, `value`) VALUES
    ('STEAM_THEME_CACHE_ENABLED', '1'),
    ('STEAM_THEME_CACHE_DURATION', '900')
ON DUPLICATE KEY UPDATE
    `value` = VALUES(`value`);