<?php
require_once __DIR__ . '/db.php';

/**
 * Get country code to name mapping from database.
 * Falls back to archived file during installation if DB not populated.
 */
function cms_cafe_country_names(): array {
    static $map = null;
    if ($map !== null) {
        return $map;
    }

    // Try database first
    try {
        $db = cms_get_db();
        $stmt = $db->query("SELECT country_code, name FROM cafe_directory_names WHERE type = 'country' ORDER BY name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($rows)) {
            $map = [];
            foreach ($rows as $row) {
                $map[$row['country_code']] = $row['name'];
            }
            return $map;
        }
    } catch (PDOException $e) {
        // Table doesn't exist yet (during installation) - fall through to file fallback
    }

    // Fallback to archived file (for installation/migration)
    $archiveFile = __DIR__ . '/../archived_steampowered/2004/cafe_directory.html';
    if (file_exists($archiveFile)) {
        $html = file_get_contents($archiveFile);
        preg_match_all('/country=([A-Z]{2})[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
        $map = [];
        foreach ($m as $row) {
            $map[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
        }
        return $map;
    }

    return $map = [];
}

/**
 * Get state code to name mapping for a country from database.
 * Falls back to archived file during installation if DB not populated.
 */
function cms_cafe_state_names(string $country): array {
    static $cache = [];
    if (isset($cache[$country])) {
        return $cache[$country];
    }

    // Try database first
    try {
        $db = cms_get_db();
        $stmt = $db->prepare("SELECT state_code, name FROM cafe_directory_names WHERE type = 'state' AND country_code = ? ORDER BY name");
        $stmt->execute([$country]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($rows)) {
            $states = [];
            foreach ($rows as $row) {
                $states[$row['state_code']] = $row['name'];
            }
            return $cache[$country] = $states;
        }
    } catch (PDOException $e) {
        // Table doesn't exist yet (during installation) - fall through to file fallback
    }

    // Fallback to archived file (for installation/migration)
    $file = __DIR__ . '/../archived_steampowered/2004/cafe_directory/' . $country . '.txt';
    if (!is_file($file)) {
        return $cache[$country] = [];
    }
    $html = file_get_contents($file);
    preg_match_all('/state=([^"&]+)[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
    $states = [];
    foreach ($m as $row) {
        if ($row[1] === '?') {
            continue;
        }
        $states[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
    }
    return $cache[$country] = $states;
}
