<?php

declare(strict_types=1);

/**
 * Database Connection for Steam CMS
 * Provides PDO database connection using configuration from cms/config.php
 */

// Include config from includes directory
require_once __DIR__ . '/config.php';

try {
    // Create PDO connection using config values
    $dsn = "mysql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['database']};charset=utf8mb4";
    
    $db = new PDO(
        $dsn,
        $config['database']['username'],
        $config['database']['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ]
    );
    
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    
    // In production, show a generic error
    if (!defined('DEBUG') || !DEBUG) {
        die('Database connection failed. Please try again later.');
    } else {
        die('Database Error: ' . $e->getMessage());
    }
}