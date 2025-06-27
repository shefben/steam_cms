<?php

require_once 'database.php';
require_once 'template_engine.php';

/**
 * SteamCMS Main Class
 * Core CMS functionality for managing content across multiple Steam eras
 * Author: MiniMax Agent
 */

class SteamCMS {
    private $db;
    private $template;
    private $current_theme = '2004'; // Default theme
    private $config;
    
    public function __construct($db_config = null) {
        // Load configuration
        $configPath = dirname(__DIR__) . '/config.php';
        if (file_exists($configPath)) {
            $this->config = require $configPath;
        } else {
            $this->config = [
                'database' => $db_config ?: ['host' => 'localhost', 'username' => 'root', 'password' => '', 'database' => 'steamcms'],
                'site' => ['root' => '', 'base_url' => ''],
                'templates' => ['default_theme' => '2004']
            ];
        }
        
        // Initialize database
        if ($db_config) {
            $this->db = new Database($db_config);
        } else {
            $this->db = new Database();
        }
        
        // Set default theme from config
        $this->current_theme = $this->config['templates']['default_theme'] ?? '2004';
        
        // Initialize template engine
        $this->template = new TemplateEngine();
        $this->template->setTheme($this->current_theme);
    }
    
    /**
     * Get configuration value
     */
    public function getConfig($key = null, $default = null) {
        if ($key === null) {
            return $this->config;
        }
        
        $keys = explode('.', $key);
        $value = $this->config;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
    
    /**
     * Get site root path
     */
    public function getSiteRoot() {
        return $this->getConfig('site.root', '');
    }
    
    /**
     * Get full URL with site root
     */
    public function getUrl($path = '') {
        $root = $this->getSiteRoot();
        return $root . '/' . ltrim($path, '/');
    }
    
    /**
     * Set current theme
     */
    public function setTheme($theme) {
        $this->current_theme = $theme;
        $this->template->setTheme($theme);
        return $this;
    }
    
    /**
     * Get database instance
     */
    public function getDatabase() {
        return $this->db;
    }
    
    /**
     * Get template engine instance
     */
    public function getTemplate() {
        return $this->template;
    }
    
    /**
     * Install CMS (create schema and initial data)
     */
    public function install($admin_user = null) {
        try {
            // Create database schema
            $this->db->createSchema();
            
            // Insert historical news data
            $this->db->insertHistoricalNews();
            
            // Create admin user if provided
            if ($admin_user) {
                $this->createAdminUser($admin_user);
            }
            
            // Create theme directories
            $themes = ['2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009'];
            foreach ($themes as $theme) {
                $this->template->createThemeStructure($theme);
            }
            
            return true;
        } catch (Exception $e) {
            throw new Exception("Installation failed: " . $e->getMessage());
        }
    }
    
    /**
     * Create admin user
     */
    private function createAdminUser($user_data) {
        $hashed_password = password_hash($user_data['password'], PASSWORD_DEFAULT);
        
        $this->db->insert('users', [
            'username' => $user_data['username'],
            'password' => $hashed_password,
            'email' => $user_data['email'] ?? '',
            'role' => 'admin'
        ]);
    }
    
    /**
     * Render frontend page
     */
    public function renderPage($page = 'index', $data = []) {
        // Get theme-specific data
        $theme_data = $this->getThemeData();
        $data = array_merge($theme_data, $data);
        
        // Assign data to template
        $this->template->assignMultiple($data);
        
        // Render the page
        return $this->template->render($page, $data);
    }
    
    /**
     * Get theme-specific data
     */
    private function getThemeData() {
        $data = [
            'current_theme' => $this->current_theme,
            'site_title' => 'Steam',
            'logo_url' => '/images/steam_logo.gif',
            'news_articles' => [],
            'navigation_links' => [],
            'theme_config' => []
        ];
        
        // Try to load data from database, but don't fail if it's not available
        try {
            $data['site_title'] = $this->getSetting('site_title', 'Steam');
            $data['logo_url'] = $this->getSetting('logo_url', '/images/steam_logo.gif');
            $data['news_articles'] = $this->getNews();
            $data['navigation_links'] = $this->getNavigation();
            $data['theme_config'] = $this->getThemeConfig();
        } catch (Exception $e) {
            // Database might not be set up yet, use defaults
            error_log("CMS: Could not load theme data from database: " . $e->getMessage());
        }
        
        return $data;
    }
    
    /**
     * Get setting value
     */
    public function getSetting($key, $default = null) {
        $result = $this->db->queryOne(
            "SELECT setting_value FROM site_settings WHERE theme = ? AND setting_key = ?",
            [$this->current_theme, $key]
        );
        
        return $result ? $result['setting_value'] : $default;
    }
    
    /**
     * Set setting value
     */
    public function setSetting($key, $value, $type = 'text') {
        // Check if setting exists
        $existing = $this->db->queryOne(
            "SELECT id FROM site_settings WHERE theme = ? AND setting_key = ?",
            [$this->current_theme, $key]
        );
        
        if ($existing) {
            $this->db->update(
                'site_settings',
                ['setting_value' => $value, 'setting_type' => $type],
                'id = ?',
                [$existing['id']]
            );
        } else {
            $this->db->insert('site_settings', [
                'theme' => $this->current_theme,
                'setting_key' => $key,
                'setting_value' => $value,
                'setting_type' => $type
            ]);
        }
        
        return true;
    }
    
    /**
     * Get news articles for current theme
     */
    public function getNews($limit = 10) {
        return $this->db->query(
            "SELECT * FROM news_articles 
             WHERE theme = ? AND is_active = 1 
             ORDER BY published_date DESC, sort_order ASC 
             LIMIT ?",
            [$this->current_theme, $limit]
        );
    }
    
    /**
     * Get navigation links for current theme
     */
    public function getNavigation() {
        return $this->db->query(
            "SELECT * FROM navigation_links 
             WHERE theme = ? AND is_active = 1 AND parent_id IS NULL 
             ORDER BY sort_order ASC",
            [$this->current_theme]
        );
    }
    
    /**
     * Get theme configuration
     */
    public function getThemeConfig() {
        return $this->db->queryOne(
            "SELECT * FROM theme_configs WHERE theme = ?",
            [$this->current_theme]
        );
    }
}

/**
 * News Management Model
 */
class NewsModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Get all news articles
     */
    public function getAll($theme = null, $limit = null) {
        $sql = "SELECT * FROM news_articles";
        $params = [];
        
        if ($theme) {
            $sql .= " WHERE theme = ?";
            $params[] = $theme;
        }
        
        $sql .= " ORDER BY published_date DESC";
        
        if ($limit) {
            $sql .= " LIMIT ?";
            $params[] = $limit;
        }
        
        return $this->db->query($sql, $params);
    }
    
    /**
     * Get single news article
     */
    public function getById($id) {
        return $this->db->queryOne(
            "SELECT * FROM news_articles WHERE id = ?",
            [$id]
        );
    }
    
    /**
     * Create new news article
     */
    public function create($data) {
        return $this->db->insert('news_articles', $data);
    }
    
    /**
     * Update news article
     */
    public function update($id, $data) {
        return $this->db->update('news_articles', $data, 'id = ?', [$id]);
    }
    
    /**
     * Delete news article
     */
    public function delete($id) {
        return $this->db->delete('news_articles', 'id = ?', [$id]);
    }
    
    /**
     * Toggle article active status
     */
    public function toggleActive($id) {
        $article = $this->getById($id);
        if ($article) {
            $new_status = $article['is_active'] ? 0 : 1;
            return $this->update($id, ['is_active' => $new_status]);
        }
        return false;
    }
}

/**
 * FAQ Management Model
 */
class FAQModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Get all FAQ categories
     */
    public function getCategories($theme = null) {
        $sql = "SELECT * FROM faq_categories";
        $params = [];
        
        if ($theme) {
            $sql .= " WHERE theme = ?";
            $params[] = $theme;
        }
        
        $sql .= " ORDER BY sort_order ASC";
        
        return $this->db->query($sql, $params);
    }
    
    /**
     * Get FAQ entries by category
     */
    public function getEntriesByCategory($category_id) {
        return $this->db->query(
            "SELECT * FROM faq_entries 
             WHERE category_id = ? AND is_active = 1 
             ORDER BY sort_order ASC",
            [$category_id]
        );
    }
    
    /**
     * Create FAQ category
     */
    public function createCategory($data) {
        return $this->db->insert('faq_categories', $data);
    }
    
    /**
     * Create FAQ entry
     */
    public function createEntry($data) {
        return $this->db->insert('faq_entries', $data);
    }
    
    /**
     * Update FAQ category
     */
    public function updateCategory($id, $data) {
        return $this->db->update('faq_categories', $data, 'id = ?', [$id]);
    }
    
    /**
     * Update FAQ entry
     */
    public function updateEntry($id, $data) {
        return $this->db->update('faq_entries', $data, 'id = ?', [$id]);
    }
    
    /**
     * Delete FAQ category and its entries
     */
    public function deleteCategory($id) {
        return $this->db->delete('faq_categories', 'id = ?', [$id]);
    }
    
    /**
     * Delete FAQ entry
     */
    public function deleteEntry($id) {
        return $this->db->delete('faq_entries', 'id = ?', [$id]);
    }
}

/**
 * Navigation Management Model
 */
class NavigationModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Get navigation links for theme
     */
    public function getByTheme($theme) {
        return $this->db->query(
            "SELECT * FROM navigation_links 
             WHERE theme = ? 
             ORDER BY sort_order ASC",
            [$theme]
        );
    }
    
    /**
     * Create navigation link
     */
    public function create($data) {
        return $this->db->insert('navigation_links', $data);
    }
    
    /**
     * Update navigation link
     */
    public function update($id, $data) {
        return $this->db->update('navigation_links', $data, 'id = ?', [$id]);
    }
    
    /**
     * Delete navigation link
     */
    public function delete($id) {
        return $this->db->delete('navigation_links', 'id = ?', [$id]);
    }
    
    /**
     * Reorder navigation links
     */
    public function reorder($theme, $link_ids) {
        foreach ($link_ids as $index => $id) {
            $this->update($id, ['sort_order' => $index + 1]);
        }
        return true;
    }
}

/**
 * Media Management Model
 */
class MediaModel {
    private $db;
    private $upload_dir = 'uploads/';
    
    public function __construct($database) {
        $this->db = $database;
        
        // Create upload directory if it doesn't exist
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }
    }
    
    /**
     * Upload file
     */
    public function upload($file, $theme = null, $user_id = null) {
        $filename = $this->generateFilename($file['name']);
        $file_path = $this->upload_dir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            $file_type = $this->getFileType($file['type']);
            
            $media_id = $this->db->insert('media_files', [
                'filename' => $filename,
                'original_name' => $file['name'],
                'file_path' => $file_path,
                'file_size' => $file['size'],
                'mime_type' => $file['type'],
                'file_type' => $file_type,
                'theme' => $theme,
                'uploaded_by' => $user_id
            ]);
            
            return $media_id;
        }
        
        return false;
    }
    
    /**
     * Generate unique filename
     */
    private function generateFilename($original_name) {
        $extension = pathinfo($original_name, PATHINFO_EXTENSION);
        return uniqid() . '_' . time() . '.' . $extension;
    }
    
    /**
     * Determine file type
     */
    private function getFileType($mime_type) {
        if (strpos($mime_type, 'image/') === 0) {
            return 'image';
        } elseif (in_array($mime_type, ['application/pdf', 'text/plain'])) {
            return 'document';
        }
        return 'other';
    }
    
    /**
     * Get media files
     */
    public function getByTheme($theme = null) {
        $sql = "SELECT * FROM media_files";
        $params = [];
        
        if ($theme) {
            $sql .= " WHERE theme = ?";
            $params[] = $theme;
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        return $this->db->query($sql, $params);
    }
    
    /**
     * Delete media file
     */
    public function delete($id) {
        $file = $this->db->queryOne("SELECT file_path FROM media_files WHERE id = ?", [$id]);
        
        if ($file && file_exists($file['file_path'])) {
            unlink($file['file_path']);
        }
        
        return $this->db->delete('media_files', 'id = ?', [$id]);
    }
}

?>
