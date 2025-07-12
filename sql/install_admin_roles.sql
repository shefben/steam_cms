CREATE TABLE IF NOT EXISTS admin_roles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE,
    permissions TEXT
);
ALTER TABLE admin_users ADD COLUMN IF NOT EXISTS role_id INT DEFAULT NULL;
INSERT INTO admin_roles(name,permissions) VALUES('Administrator','all');
