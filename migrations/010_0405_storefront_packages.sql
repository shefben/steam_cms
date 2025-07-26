CREATE TABLE `0405_storefront_packages` (
    subid INT PRIMARY KEY,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    price TEXT,
    steamOnlyBadge TINYINT(1) NOT NULL DEFAULT 0,
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);
