<?php

declare(strict_types=1);

/**
 * Simple in-memory cache for the current request lifecycle.
 *
 * Provides the same helper API that previously proxied to APCu so the rest of
 * the codebase can continue to call cms_cache_* functions without requiring
 * any optional PHP extensions.
 */
class CmsRuntimeCache
{
    /**
     * @var array<string, array{value:mixed, expires_at:int|null}>
     */
    private static array $store = [];

    public static function get(string $key, $default = null)
    {
        if (array_key_exists($key, self::$store)) {
            $entry = self::$store[$key];
            if ($entry['expires_at'] === null || $entry['expires_at'] > time()) {
                return $entry['value'];
            }
            unset(self::$store[$key]);
        }
        return $default;
    }

    public static function set(string $key, $value, int $ttl = 300): bool
    {
        $expiresAt = $ttl > 0 ? time() + $ttl : null;
        self::$store[$key] = [
            'value' => $value,
            'expires_at' => $expiresAt,
        ];
        return true;
    }

    public static function remember(string $key, callable $callback, int $ttl = 300)
    {
        $cached = self::get($key, null);
        if ($cached !== null) {
            return $cached;
        }
        $value = $callback();
        self::set($key, $value, $ttl);
        return $value;
    }

    public static function delete(string $key): bool
    {
        if (array_key_exists($key, self::$store)) {
            unset(self::$store[$key]);
            return true;
        }
        return false;
    }

    public static function clearPrefix(string $prefix): int
    {
        $removed = 0;
        foreach (array_keys(self::$store) as $key) {
            if (str_starts_with($key, $prefix)) {
                unset(self::$store[$key]);
                $removed++;
            }
        }
        return $removed;
    }

    public static function clearAll(): void
    {
        self::$store = [];
    }

    public static function getStats(): array
    {
        return [
            'entries' => count(self::$store),
        ];
    }
}

if (!function_exists('cms_cache_get')) {
    function cms_cache_get(string $key, $default = null)
    {
        return CmsRuntimeCache::get($key, $default);
    }
}

if (!function_exists('cms_cache_set')) {
    function cms_cache_set(string $key, $value, int $ttl = 300): bool
    {
        return CmsRuntimeCache::set($key, $value, $ttl);
    }
}

if (!function_exists('cms_cache_remember')) {
    function cms_cache_remember(string $key, callable $callback, int $ttl = 300)
    {
        return CmsRuntimeCache::remember($key, $callback, $ttl);
    }
}

if (!function_exists('cms_cache_delete')) {
    function cms_cache_delete(string $key): bool
    {
        return CmsRuntimeCache::delete($key);
    }
}

if (!function_exists('cms_cache_clear_prefix')) {
    function cms_cache_clear_prefix(string $prefix): int
    {
        return CmsRuntimeCache::clearPrefix($prefix);
    }
}

if (!function_exists('cms_cache_clear_all')) {
    function cms_cache_clear_all(): void
    {
        CmsRuntimeCache::clearAll();
    }
}

if (!function_exists('cms_cache_stats')) {
    function cms_cache_stats(): array
    {
        return CmsRuntimeCache::getStats();
    }
}
