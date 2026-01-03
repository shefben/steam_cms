<?php
/**
 * Forum Installation Script for 2002_forum
 * Sets up the database tables for the Chatbear-style Steam Forum system
 *
 * Note: Forum image assets are now in /images/2002_forum/ - no copying required
 */

// Tables for the 2002 Chatbear-style forum
try {
    $pdo->query('SELECT 1 FROM cb_boards LIMIT 1');
} catch (PDOException $e) {
    if ($e->getCode() === '42S02') {
        // Create Chatbear forum tables
        $pdo->exec("CREATE TABLE cb_boards (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            sort_order INT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        $pdo->exec("CREATE TABLE cb_threads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            board_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            author_id INT,
            author_name VARCHAR(100),
            author_email VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            last_post_at DATETIME,
            view_count INT DEFAULT 0,
            reply_count INT DEFAULT 0,
            is_sticky TINYINT(1) DEFAULT 0,
            is_locked TINYINT(1) DEFAULT 0,
            FOREIGN KEY (board_id) REFERENCES cb_boards(id) ON DELETE CASCADE
        )");

        $pdo->exec("CREATE TABLE cb_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            thread_id INT NOT NULL,
            author_id INT,
            author_name VARCHAR(100),
            author_email VARCHAR(255),
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME,
            is_first_post TINYINT(1) DEFAULT 0,
            FOREIGN KEY (thread_id) REFERENCES cb_threads(id) ON DELETE CASCADE
        )");

        $pdo->exec("CREATE TABLE cb_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0,
            is_moderator TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            last_login DATETIME,
            banned_until DATETIME,
            ban_reason TEXT
        )");

        $pdo->exec("CREATE TABLE cb_sessions (
            id VARCHAR(64) PRIMARY KEY,
            user_id INT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            expires_at DATETIME NOT NULL,
            FOREIGN KEY (user_id) REFERENCES cb_users(id) ON DELETE CASCADE
        )");

        $pdo->exec("CREATE TABLE private_messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            from_user INT NOT NULL,
            to_user INT NOT NULL,
            subject VARCHAR(255),
            body TEXT NOT NULL,
            sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            read_at DATETIME,
            deleted_by_sender TINYINT(1) DEFAULT 0,
            deleted_by_receiver TINYINT(1) DEFAULT 0,
            FOREIGN KEY (from_user) REFERENCES cb_users(id) ON DELETE CASCADE,
            FOREIGN KEY (to_user) REFERENCES cb_users(id) ON DELETE CASCADE
        )");

        // Seed default boards
        $pdo->exec("INSERT INTO cb_boards (name, description, sort_order) VALUES
            ('General Discussion', 'General Steam-related discussion', 1),
            ('Technical Support', 'Help with Steam technical issues', 2),
            ('Game Discussion', 'Discuss your favorite games', 3)
        ");

        // Create default admin user (password: admin)
        $adminHash = password_hash('admin', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO cb_users (username, email, password, is_admin) VALUES (?, ?, ?, 1)");
        $stmt->execute(['admin', 'admin@steampowered.com', $adminHash]);
    }
}
