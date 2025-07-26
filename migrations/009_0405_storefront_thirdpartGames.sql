CREATE TABLE `0405_storefront_thirdpartGames` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    websiteUrl TEXT,
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);
