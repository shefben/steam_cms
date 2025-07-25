CREATE TABLE download_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    years TEXT,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE download_links(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50),
    category VARCHAR(255),
    label VARCHAR(255),
    url TEXT,
    ord INT DEFAULT 0,
    FOREIGN KEY(version) REFERENCES download_pages(version) ON DELETE CASCADE
);
