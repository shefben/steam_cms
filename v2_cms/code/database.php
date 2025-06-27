<?php

/**
 * SteamCMS Database Manager
 * Handles MySQL database operations and schema management
 * Author: MiniMax Agent
 */

class Database {
    private $connection;
    private $host;
    private $username;
    private $password;
    private $database;
    private $config;
    
    public function __construct($config = null) {
        // Load configuration
        if ($config === null) {
            $configPath = dirname(__DIR__) . '/config.php';
            if (file_exists($configPath)) {
                $this->config = require $configPath;
                $dbConfig = $this->config['database'];
                // Ensure 'name' maps to 'database' for compatibility
                if (isset($dbConfig['name'])) {
                    $dbConfig['database'] = $dbConfig['name'];
                }
            } else {
                // Fallback to default values
                $dbConfig = [
                    'host' => 'localhost',
                    'username' => 'root',
                    'password' => '',
                    'database' => 'steamcms'
                ];
            }
        } else {
            $dbConfig = $config;
        }
        
        $this->host = $dbConfig['host'];
        $this->username = $dbConfig['username'];
        $this->password = $dbConfig['password'];
        $this->database = $dbConfig['database'];
        
        $this->connect();
    }
    
    /**
     * Establish database connection
     */
    private function connect() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get PDO connection instance
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Create database schema
     */
    public function createSchema() {
        $queries = [
            // Users table for admin authentication
            "CREATE TABLE IF NOT EXISTS users (
                id INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(50) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(100),
                role ENUM('admin', 'editor') DEFAULT 'editor',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )",
            
            // News articles table
            "CREATE TABLE IF NOT EXISTS news_articles (
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                excerpt TEXT,
                theme VARCHAR(10) NOT NULL,
                author VARCHAR(100),
                published_date DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                is_active BOOLEAN DEFAULT true,
                sort_order INT DEFAULT 0,
                featured_image VARCHAR(255),
                INDEX idx_theme (theme),
                INDEX idx_published_date (published_date),
                INDEX idx_active (is_active)
            )",
            
            // FAQ categories table
            "CREATE TABLE IF NOT EXISTS faq_categories (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(100) NOT NULL,
                description TEXT,
                theme VARCHAR(10) NOT NULL,
                sort_order INT DEFAULT 0,
                is_active BOOLEAN DEFAULT true,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_theme (theme),
                INDEX idx_sort_order (sort_order)
            )",
            
            // FAQ entries table
            "CREATE TABLE IF NOT EXISTS faq_entries (
                id INT PRIMARY KEY AUTO_INCREMENT,
                category_id INT NOT NULL,
                question VARCHAR(500) NOT NULL,
                answer TEXT NOT NULL,
                sort_order INT DEFAULT 0,
                is_active BOOLEAN DEFAULT true,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (category_id) REFERENCES faq_categories(id) ON DELETE CASCADE,
                INDEX idx_category (category_id),
                INDEX idx_sort_order (sort_order)
            )",
            
            // Navigation links table
            "CREATE TABLE IF NOT EXISTS navigation_links (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) NOT NULL,
                title VARCHAR(100) NOT NULL,
                url VARCHAR(255),
                link_type ENUM('text', 'image') DEFAULT 'text',
                image_path VARCHAR(255),
                image_alt VARCHAR(255),
                target VARCHAR(20) DEFAULT '_self',
                sort_order INT DEFAULT 0,
                is_active BOOLEAN DEFAULT true,
                parent_id INT DEFAULT NULL,
                css_class VARCHAR(100),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (parent_id) REFERENCES navigation_links(id) ON DELETE CASCADE,
                INDEX idx_theme (theme),
                INDEX idx_sort_order (sort_order),
                INDEX idx_parent (parent_id)
            )",
            
            // Site settings table
            "CREATE TABLE IF NOT EXISTS site_settings (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) NOT NULL,
                setting_key VARCHAR(100) NOT NULL,
                setting_value TEXT,
                setting_type ENUM('text', 'image', 'json', 'boolean') DEFAULT 'text',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY unique_theme_key (theme, setting_key),
                INDEX idx_theme (theme)
            )",
            
            // Theme configurations table
            "CREATE TABLE IF NOT EXISTS theme_configs (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) UNIQUE NOT NULL,
                display_name VARCHAR(100) NOT NULL,
                description TEXT,
                layout_type ENUM('table', 'css') DEFAULT 'table',
                has_navigation BOOLEAN DEFAULT true,
                header_style VARCHAR(50),
                color_scheme VARCHAR(50),
                is_active BOOLEAN DEFAULT true,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )",
            
            // Media files table
            "CREATE TABLE IF NOT EXISTS media_files (
                id INT PRIMARY KEY AUTO_INCREMENT,
                filename VARCHAR(255) NOT NULL,
                original_name VARCHAR(255) NOT NULL,
                file_path VARCHAR(500) NOT NULL,
                file_size INT NOT NULL,
                mime_type VARCHAR(100) NOT NULL,
                file_type ENUM('image', 'document', 'other') DEFAULT 'other',
                theme VARCHAR(10),
                uploaded_by INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL,
                INDEX idx_theme (theme),
                INDEX idx_file_type (file_type)
            )",
            
            // Custom pages table
            "CREATE TABLE IF NOT EXISTS custom_pages (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) NOT NULL,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(100) NOT NULL,
                content LONGTEXT NOT NULL,
                exclude_header BOOLEAN DEFAULT false,
                exclude_footer BOOLEAN DEFAULT false,
                exclude_navigation BOOLEAN DEFAULT false,
                is_active BOOLEAN DEFAULT true,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY unique_theme_slug (theme, slug),
                INDEX idx_theme (theme),
                INDEX idx_active (is_active)
            )",
            
            // Game capsules table for modern themes (2007+)
            "CREATE TABLE IF NOT EXISTS game_capsules (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                image_url VARCHAR(500),
                game_url VARCHAR(500),
                price VARCHAR(50),
                release_date DATE,
                sort_order INT DEFAULT 0,
                is_featured BOOLEAN DEFAULT false,
                is_active BOOLEAN DEFAULT true,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_theme (theme),
                INDEX idx_featured (is_featured),
                INDEX idx_sort_order (sort_order)
            )",
            
            // Main page content for early themes (2002-2004)
            "CREATE TABLE IF NOT EXISTS main_page_content (
                id INT PRIMARY KEY AUTO_INCREMENT,
                theme VARCHAR(10) UNIQUE NOT NULL,
                content LONGTEXT NOT NULL,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                updated_by INT,
                FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
            )"
        ];
        
        foreach ($queries as $query) {
            try {
                $this->connection->exec($query);
            } catch (PDOException $e) {
                throw new Exception("Schema creation failed: " . $e->getMessage());
            }
        }
        
        // Insert initial theme configurations
        $this->insertInitialThemeConfigs();
        
        return true;
    }
    
    /**
     * Insert initial theme configurations
     */
    private function insertInitialThemeConfigs() {
        $themes = [
            ['2002', 'Steam 2002', 'Early Steam beta with simple table layout', 'table', true, 'simple', 'dark'],
            ['2003', 'Steam 2003', 'Two-column layout with navigation', 'table', true, 'two-column', 'dark'],
            ['2004', 'Steam 2004', 'Multi-column with Half-Life 2 promotion', 'table', true, 'promotional', 'dark'],
            ['2005', 'Steam 2005', 'Refined promotional layout', 'table', true, 'refined', 'dark'],
            ['2006', 'Steam 2006', 'Early store transition', 'css', true, 'modern', 'green'],
            ['2007', 'Steam 2007', 'Established store layout', 'css', true, 'store', 'green'],
            ['2008', 'Steam 2008', 'Enhanced store features', 'css', true, 'enhanced', 'green'],
            ['2009', 'Steam 2009', 'Semantic HTML store design', 'css', true, 'semantic', 'green']
        ];
        
        $stmt = $this->connection->prepare(
            "INSERT IGNORE INTO theme_configs (theme, display_name, description, layout_type, has_navigation, header_style, color_scheme) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        
        foreach ($themes as $theme) {
            $stmt->execute($theme);
        }
    }
    
    /**
     * Insert historical news data for each theme
     */
    public function insertHistoricalNews() {
        $historical_news = [
            // 2002 News
            [
                'theme' => '2002',
                'title' => 'Steam Beta Launch',
                'content' => 'Valve announces the beta launch of Steam, a new digital distribution platform for PC games. Steam aims to provide automatic updates, anti-piracy technology, and a seamless gaming experience.',
                'excerpt' => 'Valve announces the beta launch of Steam platform.',
                'author' => 'Valve Corporation',
                'published_date' => '2002-09-12'
            ],
            [
                'theme' => '2002',
                'title' => 'Counter-Strike 1.6 Beta',
                'content' => 'Counter-Strike 1.6 is now available for beta testing through the Steam platform. This version includes improved anti-cheat protection and enhanced server browser functionality.',
                'excerpt' => 'Counter-Strike 1.6 beta now available on Steam.',
                'author' => 'Valve Corporation',
                'published_date' => '2002-10-15'
            ],
            
            // 2003 News
            [
                'theme' => '2003',
                'title' => 'Steam Public Beta Opens',
                'content' => 'Steam opens its doors to the public with an expanded beta program. Users can now download and install Steam to access their favorite Valve games with automatic updates and improved multiplayer features.',
                'excerpt' => 'Steam public beta now available for download.',
                'author' => 'Valve Corporation',
                'published_date' => '2003-05-12'
            ],
            [
                'theme' => '2003',
                'title' => 'Day of Defeat Steam Integration',
                'content' => 'Day of Defeat is now fully integrated with Steam, providing players with automatic updates, statistics tracking, and enhanced anti-cheat protection.',
                'excerpt' => 'Day of Defeat now available through Steam.',
                'author' => 'Valve Corporation',
                'published_date' => '2003-08-20'
            ],
            
            // 2004 News
            [
                'theme' => '2004',
                'title' => 'Half-Life 2 Gold Master Complete',
                'content' => 'Valve announces that Half-Life 2 has reached gold master status and will be available through Steam on November 16th. Pre-purchasing is now available with multiple package options.',
                'excerpt' => 'Half-Life 2 reaches gold master, launching November 16th.',
                'author' => 'Valve Corporation',
                'published_date' => '2004-10-15'
            ],
            [
                'theme' => '2004',
                'title' => 'Source Engine Powers New Games',
                'content' => 'The Source Engine debuts with Half-Life 2, featuring advanced physics, realistic graphics, and innovative gameplay mechanics that will power the next generation of Valve games.',
                'excerpt' => 'Source Engine debuts with revolutionary features.',
                'author' => 'Valve Corporation',
                'published_date' => '2004-11-16'
            ],
            
            // 2005 News
            [
                'theme' => '2005',
                'title' => 'Lost Coast Released',
                'content' => 'Half-Life 2: Lost Coast is now available as a free download for owners of Half-Life 2. This technical demonstration showcases HDR lighting and commentary mode features.',
                'excerpt' => 'Half-Life 2: Lost Coast now available for free.',
                'author' => 'Valve Corporation',
                'published_date' => '2005-10-27'
            ],
            [
                'theme' => '2005',
                'title' => 'Steam Platform Enhancements',
                'content' => 'Steam receives major updates including improved friends system, better download management, and enhanced user interface based on community feedback.',
                'excerpt' => 'Steam platform receives major enhancements.',
                'author' => 'Valve Corporation',
                'published_date' => '2005-12-15'
            ]
        ];
        
        // Continue with more years...
        $this->insertNewsData($historical_news);
    }
    
    /**
     * Insert news data into database
     */
    private function insertNewsData($news_data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO news_articles (theme, title, content, excerpt, author, published_date) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        
        foreach ($news_data as $news) {
            $stmt->execute([
                $news['theme'],
                $news['title'],
                $news['content'],
                $news['excerpt'],
                $news['author'],
                $news['published_date']
            ]);
        }
    }
    
    /**
     * Execute a query and return results
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }
    
    /**
     * Execute a query and return single result
     */
    public function queryOne($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }
    
    /**
     * Insert data and return last insert ID
     */
    public function insert($table, $data) {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($data);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }
    
    /**
     * Update data
     */
    public function update($table, $data, $where, $where_params = []) {
        $set_clause = [];
        foreach (array_keys($data) as $key) {
            $set_clause[] = "{$key} = :{$key}";
        }
        $set_clause = implode(', ', $set_clause);
        
        $sql = "UPDATE {$table} SET {$set_clause} WHERE {$where}";
        
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge($data, $where_params));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Update failed: " . $e->getMessage());
        }
    }
    
    /**
     * Delete data
     */
    public function delete($table, $where, $where_params = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($where_params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }
}

?>
