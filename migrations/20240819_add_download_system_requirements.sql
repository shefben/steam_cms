CREATE TABLE IF NOT EXISTS download_system_requirements (
    theme VARCHAR(32) NOT NULL,
    version INT NOT NULL,
    content TEXT NOT NULL,
    PRIMARY KEY(theme, version)
);
