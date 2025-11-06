-- Create multicapsule table for multi-app large capsules (2006+ themes)
CREATE TABLE IF NOT EXISTS multicapsule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `group` VARCHAR(100) NOT NULL,
    `order` INT NOT NULL DEFAULT 0,
    appid INT,
    image_path VARCHAR(255),
    price DECIMAL(10,2),
    INDEX idx_group (`group`),
    INDEX idx_group_order (`group`, `order`)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;