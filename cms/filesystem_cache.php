<?php

declare(strict_types=1);

/**
 * Filesystem Cache Helper
 *
 * Provides lightweight request-level caching for filesystem checks without
 * requiring APCu or other optional PHP extensions.
 */
class FilesystemCache
{
    /**
     * @var array<string, mixed>
     */
    private static array $localCache = [];

    /**
     * Retrieve a cached value.
     *
     * @param string $key
     * @param bool   $found Populated with true when the cache entry exists.
     * @return mixed
     */
    private static function getCache(string $key, bool &$found)
    {
        if (array_key_exists($key, self::$localCache)) {
            $found = true;
            return self::$localCache[$key];
        }
        $found = false;
        return null;
    }

    /**
     * Store a value in the cache.
     *
     * @param string $key
     * @param mixed  $value
     */
    private static function setCache(string $key, $value): void
    {
        self::$localCache[$key] = $value;
    }

    /**
     * Cached file_exists().
     */
    public static function fileExists(string $path): bool
    {
        $key = 'exists_' . md5($path);
        $found = false;
        $cached = self::getCache($key, $found);

        if ($found) {
            return (bool) $cached;
        }

        $exists = file_exists($path);
        self::setCache($key, $exists);

        return $exists;
    }

    /**
     * Cached is_file().
     */
    public static function isFile(string $path): bool
    {
        $key = 'isfile_' . md5($path);
        $found = false;
        $cached = self::getCache($key, $found);

        if ($found) {
            return (bool) $cached;
        }

        $isFile = is_file($path);
        self::setCache($key, $isFile);

        return $isFile;
    }

    /**
     * Cached is_dir().
     */
    public static function isDir(string $path): bool
    {
        $key = 'isdir_' . md5($path);
        $found = false;
        $cached = self::getCache($key, $found);

        if ($found) {
            return (bool) $cached;
        }

        $isDir = is_dir($path);
        self::setCache($key, $isDir);

        return $isDir;
    }

    /**
     * Cached filemtime().
     * Note: Returns false on error, just like filemtime().
     */
    public static function filemtime(string $path)
    {
        $key = 'mtime_' . md5($path);
        $found = false;
        $cached = self::getCache($key, $found);

        if ($found) {
            return $cached;
        }

        $mtime = @filemtime($path);
        self::setCache($key, $mtime);

        return $mtime;
    }

    /**
     * Cached filesize().
     */
    public static function filesize(string $path)
    {
        $key = 'size_' . md5($path);
        $found = false;
        $cached = self::getCache($key, $found);

        if ($found) {
            return $cached;
        }

        $size = @filesize($path);
        self::setCache($key, $size);

        return $size;
    }

    /**
     * Clear all filesystem caches.
     * Call this when files are modified (e.g., after admin saves).
     */
    public static function clearAll(): void
    {
        self::$localCache = [];
    }

    /**
     * Clear cache for specific path.
     */
    public static function clearPath(string $path): void
    {
        $pathHash = md5($path);
        $keys = [
            'exists_' . $pathHash,
            'isfile_' . $pathHash,
            'isdir_' . $pathHash,
            'mtime_' . $pathHash,
            'size_' . $pathHash,
        ];

        foreach ($keys as $key) {
            unset(self::$localCache[$key]);
        }
    }

    /**
     * Get cache statistics.
     */
    public static function getStats(): array
    {
        return [
            'local_cache_size' => count(self::$localCache),
            'uses_extensions' => false,
        ];
    }
}

/**
 * Global helper functions for easy use throughout codebase.
 * These are drop-in replacements for standard PHP filesystem functions.
 */

if (!function_exists('cms_file_exists')) {
    function cms_file_exists(string $path): bool
    {
        return FilesystemCache::fileExists($path);
    }
}

if (!function_exists('cms_is_file')) {
    function cms_is_file(string $path): bool
    {
        return FilesystemCache::isFile($path);
    }
}

if (!function_exists('cms_is_dir')) {
    function cms_is_dir(string $path): bool
    {
        return FilesystemCache::isDir($path);
    }
}

if (!function_exists('cms_filemtime')) {
    function cms_filemtime(string $path)
    {
        return FilesystemCache::filemtime($path);
    }
}

if (!function_exists('cms_filesize')) {
    function cms_filesize(string $path)
    {
        return FilesystemCache::filesize($path);
    }
}
