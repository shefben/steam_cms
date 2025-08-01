CREATE TABLE download_files(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description MEDIUMTEXT,
    file_size VARCHAR(50),
    main_url TEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE download_file_mirrors(
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_id INT NOT NULL,
    url TEXT,
    ord INT DEFAULT 0,
    FOREIGN KEY(file_id) REFERENCES download_files(id) ON DELETE CASCADE
);
