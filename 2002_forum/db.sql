-- ChatBear replica schema
CREATE TABLE users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(20) UNIQUE NOT NULL,
    passhash      CHAR(60) NOT NULL,
    email         VARCHAR(100),
    registered    DATETIME NOT NULL,
    last_login    DATETIME,
    signature     TEXT,
    is_mod        TINYINT(1) NOT NULL DEFAULT 0,
    is_admin      TINYINT(1) NOT NULL DEFAULT 0,
    banned        TINYINT(1) NOT NULL DEFAULT 0,
    reset_token   VARCHAR(64),
    reset_expires DATETIME
);

CREATE TABLE boards (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(80),
    description TEXT,
    ordering    INT DEFAULT 0,
    moderators  TEXT
);

CREATE TABLE threads (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    board_id  INT NOT NULL,
    subject   VARCHAR(120),
    user_id   INT,
    created   DATETIME,
    last_post DATETIME,
    locked    TINYINT(1) DEFAULT 0,
    sticky    TINYINT(1) DEFAULT 0,
    hidden    TINYINT(1) DEFAULT 0,
    FOREIGN KEY (board_id) REFERENCES boards(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id)  REFERENCES users(id)
);

CREATE TABLE posts (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT NOT NULL,
    user_id   INT,
    parent_id INT,
    message   MEDIUMTEXT,
    created   DATETIME,
    edited    DATETIME,
    ip_addr   VARCHAR(45),
    hidden    TINYINT(1) DEFAULT 0,
    FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id)   REFERENCES users(id)
);

-- Private Messages tables
CREATE TABLE private_messages (
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

CREATE INDEX idx_pm_to_user ON private_messages(to_user);
CREATE INDEX idx_pm_from_user ON private_messages(from_user);

-- Moderation log
CREATE TABLE mod_log (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    action      VARCHAR(50) NOT NULL,
    target_type VARCHAR(20) NOT NULL,
    target_id   INT NOT NULL,
    details     TEXT,
    created     DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_mod_log_created ON mod_log(created);

INSERT INTO boards(name,description,ordering) VALUES
 ('General Discussion','Talk about anything here', 1),
 ('Tech Support','Get help with tech stuff', 2);

-- Default admin user (password: admin)
INSERT INTO users(username, passhash, email, registered, is_admin, is_mod) VALUES
 ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com', NOW(), 1, 1);
