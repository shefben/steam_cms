-- ChatBear replica schema
CREATE TABLE users (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    username  VARCHAR(20) UNIQUE NOT NULL,
    passhash  CHAR(60) NOT NULL,
    email     VARCHAR(100),
    registered DATETIME NOT NULL,
    last_login DATETIME,
    signature TEXT,
    is_mod    TINYINT(1) NOT NULL DEFAULT 0,
    banned    TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE boards (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(80),
    description TEXT,
    ordering  INT DEFAULT 0
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
    FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id)   REFERENCES users(id)
);

INSERT INTO boards(name,description) VALUES
 ('General Discussion','Talk about anything here'),
 ('Tech Support','Get help with tech stuff');
