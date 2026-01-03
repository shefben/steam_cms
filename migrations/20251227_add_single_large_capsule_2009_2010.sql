-- Migration: Add single_large_capsule entries for 2009 and 2010 themes
-- These themes use the 2008 style capsule (grey background, smaller dimensions)

-- Insert sample data for 2009 theme
INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`) VALUES
('2009', 220, '2009/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1),
('2009', 240, '2009/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2),
('2009', 300, '2009/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3)
ON DUPLICATE KEY UPDATE
    image_path = VALUES(image_path),
    description = VALUES(description),
    url = VALUES(url),
    `order` = VALUES(`order`);

-- Insert sample data for 2010 theme
INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`) VALUES
('2010', 220, '2010/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1),
('2010', 240, '2010/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2),
('2010', 300, '2010/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3)
ON DUPLICATE KEY UPDATE
    image_path = VALUES(image_path),
    description = VALUES(description),
    url = VALUES(url),
    `order` = VALUES(`order`);
