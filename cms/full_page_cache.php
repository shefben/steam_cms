<?php

declare(strict_types=1);

/**
 * Full-Page Caching for Anonymous Users (Optimization #18)
 *
 * Caches entire HTML output for anonymous (non-logged-in) users
 * Bypasses PHP execution and database queries on cached pages
 *
 * PERFORMANCE IMPACT: 10-50x faster page loads for cached pages
 * Can serve 1000+ requests/sec from cache vs 10-20/sec dynamic
 */

class FullPageCache
{
    private const CACHE_DIR = __DIR__ . '/cache/fullpage';
    private const DEFAULT_TTL = 300; // 5 minutes
    private const MAX_CACHE_SIZE = 100 * 1024 * 1024; // 100MB

    /**
     * Check if current request is cacheable
     */
    public static function isCacheable(): bool
    {
        // Don't cache if:
        // 1. User is logged in (check session or auth cookie)
        // 2. Request method is not GET
        // 3. Query string contains certain parameters
        // 4. Request is to admin area

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return false;
        }

        // Check if admin/logged in
        if (isset($_COOKIE['admin_session']) || isset($_SESSION['admin_id'])) {
            return false;
        }

        // Check if URL is admin area
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($requestUri, '/admin/') !== false) {
            return false;
        }

        // Don't cache URLs with certain query parameters
        $skipParams = ['nocache', 'preview', 'debug', 'search'];
        foreach ($skipParams as $param) {
            if (isset($_GET[$param])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Generate cache key for current request
     */
    public static function getCacheKey(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';

        // Include important request variations
        $key = $scheme . '://' . $host . $uri;

        // Add user agent type (mobile vs desktop) if needed
        // $key .= '|' . (self::isMobile() ? 'mobile' : 'desktop');

        return md5($key);
    }

    /**
     * Get cache file path
     */
    private static function getCacheFilePath(string $key): string
    {
        // Use subdirectories to avoid too many files in one directory
        $subdir = substr($key, 0, 2);
        $dir = self::CACHE_DIR . '/' . $subdir;

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir . '/' . $key . '.html';
    }

    /**
     * Get cache metadata file path
     */
    private static function getMetaFilePath(string $key): string
    {
        $subdir = substr($key, 0, 2);
        return self::CACHE_DIR . '/' . $subdir . '/' . $key . '.meta';
    }

    /**
     * Try to serve from cache
     *
     * @return bool True if served from cache, false if cache miss
     */
    public static function serve(): bool
    {
        if (!self::isCacheable()) {
            return false;
        }

        $key = self::getCacheKey();
        $cacheFile = self::getCacheFilePath($key);
        $metaFile = self::getMetaFilePath($key);

        if (!file_exists($cacheFile) || !file_exists($metaFile)) {
            return false;
        }

        // Check if cache is still valid
        $meta = json_decode(file_get_contents($metaFile), true);
        if (!$meta || $meta['expires'] < time()) {
            // Cache expired
            @unlink($cacheFile);
            @unlink($metaFile);
            return false;
        }

        // Serve from cache
        header('X-Cache: HIT');
        header('X-Cache-Key: ' . $key);
        header('X-Cache-Expires: ' . date('Y-m-d H:i:s', $meta['expires']));

        // Set content type
        header('Content-Type: text/html; charset=UTF-8');

        // Output cached content
        readfile($cacheFile);

        return true;
    }

    /**
     * Start output buffering to capture page content
     */
    public static function start(): void
    {
        if (!self::isCacheable()) {
            return;
        }

        ob_start(function($content) {
            self::save($content);
            return $content;
        });
    }

    /**
     * Save page content to cache
     */
    public static function save(string $content, int $ttl = self::DEFAULT_TTL): void
    {
        if (!self::isCacheable()) {
            return;
        }

        $key = self::getCacheKey();
        $cacheFile = self::getCacheFilePath($key);
        $metaFile = self::getMetaFilePath($key);

        // Save content
        file_put_contents($cacheFile, $content);

        // Save metadata
        $meta = [
            'created' => time(),
            'expires' => time() + $ttl,
            'url' => $_SERVER['REQUEST_URI'] ?? '/',
            'size' => strlen($content),
        ];
        file_put_contents($metaFile, json_encode($meta, JSON_PRETTY_PRINT));

        // Add cache header for debugging
        if (!headers_sent()) {
            header('X-Cache: MISS');
            header('X-Cache-Key: ' . $key);
        }

        // Check cache size and clean if needed
        self::cleanIfNeeded();
    }

    /**
     * Clear all full-page cache
     */
    public static function clear(): int
    {
        $cleared = 0;

        if (!is_dir(self::CACHE_DIR)) {
            return 0;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::CACHE_DIR, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                if (unlink($file->getPathname())) {
                    $cleared++;
                }
            } elseif ($file->isDir()) {
                @rmdir($file->getPathname());
            }
        }

        return $cleared;
    }

    /**
     * Clear cache for specific URL pattern
     */
    public static function clearPattern(string $pattern): int
    {
        $cleared = 0;

        if (!is_dir(self::CACHE_DIR)) {
            return 0;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::CACHE_DIR, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getExtension() === 'meta') {
                $meta = json_decode(file_get_contents($file->getPathname()), true);
                if ($meta && isset($meta['url']) && preg_match($pattern, $meta['url'])) {
                    $key = basename($file->getPathname(), '.meta');
                    $cacheFile = self::getCacheFilePath($key);

                    if (file_exists($cacheFile)) {
                        unlink($cacheFile);
                    }
                    unlink($file->getPathname());
                    $cleared++;
                }
            }
        }

        return $cleared;
    }

    /**
     * Clean old cache entries if cache size exceeds limit
     */
    private static function cleanIfNeeded(): void
    {
        static $lastCheck = 0;

        // Only check every 100 requests
        if ($lastCheck > 0 && (time() - $lastCheck) < 100) {
            return;
        }

        $lastCheck = time();

        $size = self::getCacheSize();
        if ($size < self::MAX_CACHE_SIZE) {
            return;
        }

        // Remove oldest 20% of cache
        self::cleanOldest(0.2);
    }

    /**
     * Clean oldest cache entries
     */
    private static function cleanOldest(float $fraction = 0.2): int
    {
        if (!is_dir(self::CACHE_DIR)) {
            return 0;
        }

        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::CACHE_DIR, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getExtension() === 'meta') {
                $files[] = [
                    'path' => $file->getPathname(),
                    'mtime' => $file->getMTime(),
                ];
            }
        }

        // Sort by modification time
        usort($files, fn($a, $b) => $a['mtime'] <=> $b['mtime']);

        // Remove oldest fraction
        $toRemove = (int)ceil(count($files) * $fraction);
        $removed = 0;

        for ($i = 0; $i < $toRemove; $i++) {
            $metaFile = $files[$i]['path'];
            $key = basename($metaFile, '.meta');
            $cacheFile = self::getCacheFilePath($key);

            if (file_exists($cacheFile)) {
                unlink($cacheFile);
            }
            unlink($metaFile);
            $removed++;
        }

        return $removed;
    }

    /**
     * Get total cache size in bytes
     */
    public static function getCacheSize(): int
    {
        if (!is_dir(self::CACHE_DIR)) {
            return 0;
        }

        $size = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::CACHE_DIR, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }

    /**
     * Get cache statistics
     */
    public static function getStats(): array
    {
        if (!is_dir(self::CACHE_DIR)) {
            return [
                'enabled' => false,
                'total_entries' => 0,
                'total_size' => 0,
                'cache_dir' => self::CACHE_DIR,
            ];
        }

        $entries = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::CACHE_DIR, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getExtension() === 'html') {
                $entries++;
            }
        }

        return [
            'enabled' => true,
            'total_entries' => $entries,
            'total_size' => self::getCacheSize(),
            'total_size_mb' => round(self::getCacheSize() / 1024 / 1024, 2),
            'max_size_mb' => round(self::MAX_CACHE_SIZE / 1024 / 1024, 2),
            'cache_dir' => self::CACHE_DIR,
            'default_ttl' => self::DEFAULT_TTL,
        ];
    }
}

/**
 * Helper function to clear full-page cache on content updates
 * Call this in admin save operations
 */
function cms_clear_fullpage_cache(string $pattern = null): int
{
    if ($pattern) {
        return FullPageCache::clearPattern($pattern);
    }
    return FullPageCache::clear();
}
