CREATE TABLE `0405_storefront_games` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT UNIQUE,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    purchaseButtonStr VARCHAR(255),
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);
