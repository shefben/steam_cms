<?php
/**
 * Steam CMS Configuration File
 * 
 * Update these settings to match your environment
 */

return [
    // Database Configuration
    'database' => [
        'host' => 'localhost',
        'name' => 'steam_cms',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ],
    
    // Site Configuration
    'site' => [
        'title' => 'Steam',
        'root' => '', // Set to subfolder if not in domain root (e.g., '/steam' for domain.com/steam/)
        'timezone' => 'America/New_York',
        'debug' => true
    ],
    
    // Theme Configuration
    'theme' => [
        'default' => '2004',
        'cache_enabled' => false,
        'template_cache_dir' => 'cache/templates'
    ],
    
    // Security Configuration
    'security' => [
        'session_name' => 'steam_cms_session',
        'csrf_protection' => true,
        'admin_timeout' => 3600 // 1 hour in seconds
    ],
    
    // Upload Configuration
    'uploads' => [
        'max_file_size' => 5242880, // 5MB in bytes
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif'],
        'upload_dir' => 'uploads/'
    ],
    
    // Features Configuration
    'features' => [
        'registration_enabled' => false,
        'comments_enabled' => true,
        'maintenance_mode' => false
    ]
];
