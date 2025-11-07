<?php

declare(strict_types=1);

/**
 * APCu Cache Wrapper
 *
 * Replaces global cache arrays with APCu-backed caching
 * Provides better memory management and automatic eviction
 *
 * PERFORMANCE IMPACT: Reduces memory usage, faster lookups than global arrays
 */

class ApcuCache
{
    private const DEFAULT_TTL = 300; // 5 minutes
    private const CACHE_PREFIX = 'cms_';

    private static $localCache = [];
    private static $useApcu = null;

    /**
     * Check if APCu is available
     */
    private static function hasApcu(): bool
    {
        if (self::$useApcu === null) {
            self::$useApcu = function_exists('apcu_enabled') && apcu_enabled();
        }
        return self::$useApcu;
    }

    /**
     * Get value from cache
     *
     * @param string $key Cache key
     * @param mixed $default Default value if not found
     * @param int $ttl Time to live in seconds (used if value needs to be computed)
     * @return mixed
     */
    public static function get(string $key, $default = null, int $ttl = self::DEFAULT_TTL)
    {
        $fullKey = self::CACHE_PREFIX . $key;

        // Check local request cache first
        if (array_key_exists($fullKey, self::$localCache)) {
            return self::$localCache[$fullKey];
        }

        // Try APCu if available
        if (self::hasApcu()) {
            $value = apcu_fetch($fullKey, $success);
            if ($success) {
                self::$localCache[$fullKey] = $value;
                return $value;
            }
        }

        return $default;
    }

    /**
     * Set value in cache
     *
     * @param string $key Cache key
     * @param mixed $value Value to cache
     * @param int $ttl Time to live in seconds
     * @return bool Success
     */
    public static function set(string $key, $value, int $ttl = self::DEFAULT_TTL): bool
    {
        $fullKey = self::CACHE_PREFIX . $key;

        // Store in local cache
        self::$localCache[$fullKey] = $value;

        // Store in APCu if available
        if (self::hasApcu()) {
            return apcu_store($fullKey, $value, $ttl);
        }

        return true;
    }

    /**
     * Get or compute value (memoization pattern)
     *
     * @param string $key Cache key
     * @param callable $callback Function to compute value if not cached
     * @param int $ttl Time to live in seconds
     * @return mixed
     */
    public static function remember(string $key, callable $callback, int $ttl = self::DEFAULT_TTL)
    {
        $value = self::get($key);

        if ($value === null) {
            $value = $callback();
            self::set($key, $value, $ttl);
        }

        return $value;
    }

    /**
     * Delete value from cache
     *
     * @param string $key Cache key
     * @return bool Success
     */
    public static function delete(string $key): bool
    {
        $fullKey = self::CACHE_PREFIX . $key;

        unset(self::$localCache[$fullKey]);

        if (self::hasApcu()) {
            return apcu_delete($fullKey);
        }

        return true;
    }

    /**
     * Clear all cache with given prefix
     *
     * @param string $prefix Cache key prefix (without 'cms_')
     * @return int Number of entries deleted
     */
    public static function clearPrefix(string $prefix): int
    {
        $pattern = self::CACHE_PREFIX . $prefix;
        $cleared = 0;

        // Clear local cache
        foreach (self::$localCache as $key => $value) {
            if (strpos($key, $pattern) === 0) {
                unset(self::$localCache[$key]);
                $cleared++;
            }
        }

        // Clear APCu
        if (self::hasApcu()) {
            $iterator = new APCUIterator('/^' . preg_quote($pattern, '/') . '/');
            if ($iterator) {
                $deleted = apcu_delete($iterator);
                if (is_int($deleted)) {
                    $cleared += $deleted;
                }
            }
        }

        return $cleared;
    }

    /**
     * Clear all CMS caches
     *
     * @return int Number of entries deleted
     */
    public static function clearAll(): int
    {
        self::$localCache = [];

        if (self::hasApcu()) {
            $iterator = new APCUIterator('/^' . preg_quote(self::CACHE_PREFIX, '/') . '/');
            if ($iterator) {
                $deleted = apcu_delete($iterator);
                return is_int($deleted) ? $deleted : 0;
            }
        }

        return 0;
    }

    /**
     * Get cache statistics
     *
     * @return array
     */
    public static function stats(): array
    {
        return [
            'apcu_available' => self::hasApcu(),
            'local_cache_size' => count(self::$localCache),
            'apcu_info' => self::hasApcu() ? apcu_cache_info() : null,
        ];
    }
}

/**
 * Global helper functions for backward compatibility
 */

if (!function_exists('cms_cache_get')) {
    function cms_cache_get(string $key, $default = null)
    {
        return ApcuCache::get($key, $default);
    }
}

if (!function_exists('cms_cache_set')) {
    function cms_cache_set(string $key, $value, int $ttl = 300): bool
    {
        return ApcuCache::set($key, $value, $ttl);
    }
}

if (!function_exists('cms_cache_remember')) {
    function cms_cache_remember(string $key, callable $callback, int $ttl = 300)
    {
        return ApcuCache::remember($key, $callback, $ttl);
    }
}

if (!function_exists('cms_cache_delete')) {
    function cms_cache_delete(string $key): bool
    {
        return ApcuCache::delete($key);
    }
}

if (!function_exists('cms_cache_clear_prefix')) {
    function cms_cache_clear_prefix(string $prefix): int
    {
        return ApcuCache::clearPrefix($prefix);
    }
}

/**
 * Migration helpers - wrap common caching patterns
 */

/**
 * Get CMS setting with caching
 */
function cms_get_setting_cached(string $key, ?string $default = null): ?string
{
    return cms_cache_remember('setting_' . $key, function() use ($key, $default) {
        $db = cms_get_db();
        $stmt = $db->prepare('SELECT value FROM cms_settings WHERE name=?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value !== false ? (string)$value : $default;
    }, 600); // 10 minutes
}

/**
 * Get theme config with caching
 */
function cms_get_theme_config_cached(string $theme): array
{
    return cms_cache_remember('theme_config_' . $theme, function() use ($theme) {
        $db = cms_get_db();
        $stmt = $db->prepare('SELECT name, value FROM theme_settings WHERE theme=?');
        $stmt->execute([$theme]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $config = [];
        foreach ($rows as $row) {
            $config[$row['name']] = $row['value'];
        }
        return $config;
    }, 600); // 10 minutes
}

/**
 * Get theme header data with caching
 */
function cms_get_theme_header_cached(string $theme, string $page = 'news'): array
{
    $cacheKey = 'theme_header_' . $theme . '_' . $page;

    return cms_cache_remember($cacheKey, function() use ($theme, $page) {
        $db = cms_get_db();
        $stmt = $db->prepare('SELECT header_content FROM theme_headers WHERE theme=? AND page=? LIMIT 1');
        $stmt->execute([$theme, $page]);
        $content = $stmt->fetchColumn();

        if ($content === false) {
            // Try default page
            $stmt->execute([$theme, 'default']);
            $content = $stmt->fetchColumn();
        }

        return [
            'content' => $content ?: '',
            'theme' => $theme,
            'page' => $page,
        ];
    }, 600); // 10 minutes
}
