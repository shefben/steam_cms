CREATE TABLE error_logs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(20),
    message TEXT,
    file TEXT,
    line INT,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);
