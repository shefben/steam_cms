<?php
/**
 * Preprocesses legacy form pages from archived_steampowered into database
 * This allows distributing the CMS without the archived_steampowered folder
 */

// Create table if not exists
try {
    $pdo->query('SELECT 1 FROM legacy_form_pages LIMIT 1');
} catch (PDOException $e) {
    if ($e->getCode() === '42S02') {
        $pdo->exec('CREATE TABLE legacy_form_pages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            form_type VARCHAR(50) NOT NULL,
            version VARCHAR(50) NOT NULL,
            content MEDIUMTEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_form_version (form_type, version)
        )');
    }
}

/**
 * Extract body content from legacy HTML and rewrite paths
 */
function extract_legacy_body(string $html): string {
    // Try to extract just the body content
    if (preg_match('/<body[^>]*>(.*)<\/body>/is', $html, $m)) {
        $html = $m[1];
    }

    // Remove header and footer divs
    $html = preg_replace('/<div class="header">.*?<\/div>\s*<!-- end header -->/is', '', $html);
    $html = preg_replace('/<!-- begin footer -->.*?<\/div>\s*<!-- end footer -->/is', '', $html);

    return trim($html);
}

/**
 * Rewrite legacy image/css paths to use theme assets
 */
function rewrite_legacy_paths(string $html): string {
    // Rewrite img/ and images/ paths to use ./images/ prefix (root images)
    $html = preg_replace('/src="(?:\.\/)?(?:img|images)\/([^"]+)"/i', 'src="./images/$1"', $html);
    $html = preg_replace('/href="(?:\.\/)?(?:img|images)\/([^"]+\.(?:css|gif|jpg|png))"/i', 'href="./images/$1"', $html);

    // Remove web.archive.org URLs
    $html = preg_replace('/https?:\/\/web\.archive\.org\/web\/\d+(?:id_)?\//', '', $html);

    // Fix relative links to use CMS routes
    $html = preg_replace('/href="(?:\.\/)?index\.php/', 'href="index.php', $html);

    return $html;
}

$stmt = $pdo->prepare('INSERT IGNORE INTO legacy_form_pages (form_type, version, content) VALUES (?, ?, ?)');

// Cafe Signup Pages
$cafeSignupFiles = [
    '2004_signup_v1' => __DIR__ . '/../archived_steampowered/2004/Cyber Café Sign-up_version_1.html',
    '2004_signup_v2' => __DIR__ . '/../archived_steampowered/2004/Cyber Café Sign-up_version_2.html',
];

foreach ($cafeSignupFiles as $version => $file) {
    if (file_exists($file)) {
        $html = file_get_contents($file);
        $html = rewrite_legacy_paths($html);
        $content = extract_legacy_body($html);
        $stmt->execute(['cafe_signup', $version, $content]);
    }
}

// Cheat Form Pages
$cheatFormFiles = [
    '2004_cheat_v1' => __DIR__ . '/../archived_steampowered/2004/cheat_form_version_1.html',
    '2004_cheat_v2' => __DIR__ . '/../archived_steampowered/2004/cheat_form_version_2.html',
];

foreach ($cheatFormFiles as $version => $file) {
    if (file_exists($file)) {
        $html = file_get_contents($file);
        $html = rewrite_legacy_paths($html);
        $content = extract_legacy_body($html);
        $stmt->execute(['cheat_form', $version, $content]);
    }
}

// CD Account Form Pages
$cdAccountFiles = [
    '2004_cd_v1' => __DIR__ . '/../archived_steampowered/2004/cd_account_form_version_1.html',
    '2004_cd_v2' => __DIR__ . '/../archived_steampowered/2004/cd_account_form_version_2.html',
];

foreach ($cdAccountFiles as $version => $file) {
    if (file_exists($file)) {
        $html = file_get_contents($file);
        $html = rewrite_legacy_paths($html);
        $content = extract_legacy_body($html);
        $stmt->execute(['cd_account', $version, $content]);
    }
}
