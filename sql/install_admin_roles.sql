ALTER TABLE admin_users ADD COLUMN IF NOT EXISTS role_id INT DEFAULT NULL;
ALTER TABLE admin_users ADD COLUMN IF NOT EXISTS language VARCHAR(8) DEFAULT 'en';
INSERT INTO admin_roles(name,permissions) VALUES('Administrator','all');
