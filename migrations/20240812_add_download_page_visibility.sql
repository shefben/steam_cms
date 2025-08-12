CREATE TABLE IF NOT EXISTS download_page_visibility (
    theme VARCHAR(32) NOT NULL,
    version INT NOT NULL,
    file_id INT NOT NULL,
    PRIMARY KEY (theme, version, file_id),
    FOREIGN KEY (file_id) REFERENCES download_files(id)
);
