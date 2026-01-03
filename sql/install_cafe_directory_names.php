<?php
/**
 * Preprocesses cafe directory country and state names from archived_steampowered into database
 * This allows distributing the CMS without the archived_steampowered folder
 */

// Create table if not exists
try {
    $pdo->query('SELECT 1 FROM cafe_directory_names LIMIT 1');
} catch (PDOException $e) {
    if ($e->getCode() === '42S02') {
        $pdo->exec('CREATE TABLE cafe_directory_names (
            id INT AUTO_INCREMENT PRIMARY KEY,
            country_code CHAR(2) NOT NULL,
            state_code VARCHAR(20) DEFAULT NULL,
            name VARCHAR(100) NOT NULL,
            type ENUM("country", "state") NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_location (country_code, state_code, type)
        )');
    }
}

$stmt = $pdo->prepare('INSERT IGNORE INTO cafe_directory_names (country_code, state_code, name, type) VALUES (?, ?, ?, ?)');

// Extract country names from cafe_directory.html
$cafeDirectoryFile = __DIR__ . '/../archived_steampowered/2004/cafe_directory.html';
if (file_exists($cafeDirectoryFile)) {
    $html = file_get_contents($cafeDirectoryFile);
    preg_match_all('/country=([A-Z]{2})[^>]*>([^<]+)/', $html, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $countryCode = $match[1];
        $countryName = trim(html_entity_decode($match[2], ENT_QUOTES));
        $stmt->execute([$countryCode, null, $countryName, 'country']);
    }
}

// Extract state names from each country file
$cafeDirectoryDir = __DIR__ . '/../archived_steampowered/2004/cafe_directory';
if (is_dir($cafeDirectoryDir)) {
    $files = glob($cafeDirectoryDir . '/*.txt');
    foreach ($files as $file) {
        $countryCode = basename($file, '.txt');
        $html = file_get_contents($file);
        preg_match_all('/state=([^"&]+)[^>]*>([^<]+)/', $html, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $stateCode = $match[1];
            // Skip uncategorized entries (state=?)
            if ($stateCode === '?') {
                continue;
            }
            $stateName = trim(html_entity_decode($match[2], ENT_QUOTES));
            $stmt->execute([$countryCode, $stateCode, $stateName, 'state']);
        }
    }
}
