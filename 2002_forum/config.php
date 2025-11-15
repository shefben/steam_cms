<?php
declare(strict_types=1);

/**
 * ChatBear-style forum configuration
 *
 * The 2002 forums reuse the CMS database credentials so we delegate to the
 * primary installer configuration instead of hard-coding connection details.
 */

$cmsConfigPath = dirname(__DIR__) . '/cms/config.php';

if (!file_exists($cmsConfigPath)) {
    throw new RuntimeException('CMS configuration not found. Run the installer first.');
}

$cmsConfig = require $cmsConfigPath;

if (!is_array($cmsConfig)) {
    throw new RuntimeException('CMS configuration file must return an array.');
}

$host   = $cmsConfig['host'] ?? '127.0.0.1';
$port   = isset($cmsConfig['port']) ? (int) $cmsConfig['port'] : 3306;
$dbname = $cmsConfig['dbname'] ?? 'steamcms';
$user   = $cmsConfig['user'] ?? '';
$pass   = $cmsConfig['pass'] ?? '';

define('CB_DB_DSN', sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
    $host,
    $port,
    $dbname
));
define('CB_DB_USER', $user);
define('CB_DB_PASS', $pass);
define('CB_SITE_NAME', 'Steam Support Forums');
define('CB_BASE_URL', '/forum'); // without trailing slash
define('CB_NEW_WINDOW', true);   // auto-links open in new tab?

require_once __DIR__ . '/includes/bootstrap.php';
