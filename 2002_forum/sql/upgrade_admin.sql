-- Upgrade script for 2002_forum admin panel
-- Run this script to add admin features to an existing database

-- Add is_admin column to users table
ALTER TABLE users ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0 AFTER is_mod;

-- Add reset_token and reset_expires columns to users table (if not already present)
ALTER TABLE users ADD COLUMN reset_token VARCHAR(64) AFTER banned;
ALTER TABLE users ADD COLUMN reset_expires DATETIME AFTER reset_token;

-- Add moderators column to boards table
ALTER TABLE boards ADD COLUMN moderators TEXT AFTER ordering;

-- Add hidden column to threads table
ALTER TABLE threads ADD COLUMN hidden TINYINT(1) DEFAULT 0 AFTER sticky;

-- Add hidden column to posts table
ALTER TABLE posts ADD COLUMN hidden TINYINT(1) DEFAULT 0 AFTER ip_addr;

-- Create moderation log table
CREATE TABLE IF NOT EXISTS mod_log (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    action      VARCHAR(50) NOT NULL,
    target_type VARCHAR(20) NOT NULL,
    target_id   INT NOT NULL,
    details     TEXT,
    created     DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_mod_log_created ON mod_log(created);

-- Create private_messages table (if not already present)
CREATE TABLE IF NOT EXISTS private_messages (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    from_user   INT NOT NULL,
    to_user     INT NOT NULL,
    subject     VARCHAR(120),
    message     MEDIUMTEXT,
    sent_at     DATETIME NOT NULL,
    read_at     DATETIME,
    deleted_by_sender   TINYINT(1) NOT NULL DEFAULT 0,
    deleted_by_receiver TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (from_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (to_user)   REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_pm_to_user ON private_messages(to_user);
CREATE INDEX IF NOT EXISTS idx_pm_from_user ON private_messages(from_user);

-- To make an existing user an admin, run:
-- UPDATE users SET is_admin = 1, is_mod = 1 WHERE username = 'yourusername';
