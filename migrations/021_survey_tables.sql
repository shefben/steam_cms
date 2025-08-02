CREATE TABLE survey_info(
    id INT AUTO_INCREMENT PRIMARY KEY,
    unique_samples INT,
    start_date DATETIME,
    last_updated VARCHAR(100)
);
CREATE TABLE survey_categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) UNIQUE,
    title VARCHAR(255),
    ord INT DEFAULT 0
);
CREATE TABLE survey_entries(
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    label VARCHAR(255),
    percentage DECIMAL(5,2),
    count INT,
    ord INT DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES survey_categories(id) ON DELETE CASCADE
);
