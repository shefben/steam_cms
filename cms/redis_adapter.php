<?php

declare(strict_types=1);

/**
 * Redis/Memcached Adapter (Optimization #28)
 *
 * Distributed caching layer for multi-server deployments
 * Falls back to APCu if Redis/Memcached unavailable
 *
 * PERFORMANCE IMPACT: Enables horizontal scaling, shared cache across servers
 * Better than APCu for multi-server setups
 */

class DistributedCache
{
    private const DEFAULT_TTL = 300;

    private static $instance = null;
    private $client = null;
    private $type = 'none';

    /**
     * Get singleton instance
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Initialize connection to Redis or Memcached
     */
    private function __construct()
    {
        // Try Redis first
        if ($this->initRedis()) {
            return;
        }

        // Try Memcached next
        if ($this->initMemcached()) {
            return;
        }

        // Fallback to APCu (already implemented)
        error_log('[DistributedCache] No Redis/Memcached available, using APCu fallback');
    }

    /**
     * Initialize Redis connection
     */
    private function initRedis(): bool
    {
        if (!extension_loaded('redis')) {
            return false;
        }

        try {
            $redis = new Redis();

            // Get configuration from environment or config
            $host = getenv('REDIS_HOST') ?: 'localhost';
            $port = (int)(getenv('REDIS_PORT') ?: 6379);
            $password = getenv('REDIS_PASSWORD') ?: null;
            $database = (int)(getenv('REDIS_DB') ?: 0);

            if (!$redis->connect($host, $port, 2.5)) {
                return false;
            }

            if ($password && !$redis->auth($password)) {
                return false;
            }

            if (!$redis->select($database)) {
                return false;
            }

            $this->client = $redis;
            $this->type = 'redis';

            error_log('[DistributedCache] Using Redis at ' . $host . ':' . $port);
            return true;
        } catch (Exception $e) {
            error_log('[DistributedCache] Redis connection failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Initialize Memcached connection
     */
    private function initMemcached(): bool
    {
        if (!extension_loaded('memcached')) {
            return false;
        }

        try {
            $memcached = new Memcached();

            $host = getenv('MEMCACHED_HOST') ?: 'localhost';
            $port = (int)(getenv('MEMCACHED_PORT') ?: 11211);

            $memcached->addServer($host, $port);

            // Test connection
            $version = $memcached->getVersion();
            if (!$version) {
                return false;
            }

            $this->client = $memcached;
            $this->type = 'memcached';

            error_log('[DistributedCache] Using Memcached at ' . $host . ':' . $port);
            return true;
        } catch (Exception $e) {
            error_log('[DistributedCache] Memcached connection failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get value from cache
     */
    public function get(string $key, $default = null)
    {
        try {
            switch ($this->type) {
                case 'redis':
                    $value = $this->client->get($key);
                    return $value !== false ? unserialize($value) : $default;

                case 'memcached':
                    $value = $this->client->get($key);
                    return $value !== false ? $value : $default;

                default:
                    // Fallback to APCu
                    return cms_cache_get($key, $default);
            }
        } catch (Exception $e) {
            error_log('[DistributedCache] Get failed: ' . $e->getMessage());
            return $default;
        }
    }

    /**
     * Set value in cache
     */
    public function set(string $key, $value, int $ttl = self::DEFAULT_TTL): bool
    {
        try {
            switch ($this->type) {
                case 'redis':
                    return $this->client->setex($key, $ttl, serialize($value));

                case 'memcached':
                    return $this->client->set($key, $value, $ttl);

                default:
                    // Fallback to APCu
                    return cms_cache_set($key, $value, $ttl);
            }
        } catch (Exception $e) {
            error_log('[DistributedCache] Set failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete value from cache
     */
    public function delete(string $key): bool
    {
        try {
            switch ($this->type) {
                case 'redis':
                    return $this->client->del($key) > 0;

                case 'memcached':
                    return $this->client->delete($key);

                default:
                    return cms_cache_delete($key);
            }
        } catch (Exception $e) {
            error_log('[DistributedCache] Delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Increment counter (atomic operation)
     */
    public function increment(string $key, int $step = 1): int
    {
        try {
            switch ($this->type) {
                case 'redis':
                    return $this->client->incrBy($key, $step);

                case 'memcached':
                    $value = $this->client->increment($key, $step);
                    return $value !== false ? $value : 0;

                default:
                    // APCu fallback (not atomic)
                    $value = (int)cms_cache_get($key, 0);
                    $value += $step;
                    cms_cache_set($key, $value);
                    return $value;
            }
        } catch (Exception $e) {
            error_log('[DistributedCache] Increment failed: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Flush all cache
     */
    public function flush(): bool
    {
        try {
            switch ($this->type) {
                case 'redis':
                    return $this->client->flushDB();

                case 'memcached':
                    return $this->client->flush();

                default:
                    return ApcuCache::clearAll() > 0;
            }
        } catch (Exception $e) {
            error_log('[DistributedCache] Flush failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get cache statistics
     */
    public function getStats(): array
    {
        try {
            switch ($this->type) {
                case 'redis':
                    $info = $this->client->info();
                    return [
                        'type' => 'redis',
                        'connected' => $this->client->isConnected(),
                        'used_memory' => $info['used_memory_human'] ?? 'N/A',
                        'total_commands' => $info['total_commands_processed'] ?? 'N/A',
                        'hit_rate' => $this->calculateHitRate($info),
                    ];

                case 'memcached':
                    $stats = $this->client->getStats();
                    $server = array_values($stats)[0] ?? [];
                    return [
                        'type' => 'memcached',
                        'connected' => !empty($stats),
                        'used_memory' => ($server['bytes'] ?? 0) / 1024 / 1024 . ' MB',
                        'total_items' => $server['curr_items'] ?? 0,
                        'hit_rate' => $this->calculateMemcachedHitRate($server),
                    ];

                default:
                    return [
                        'type' => 'apcu',
                        'connected' => function_exists('apcu_enabled') && apcu_enabled(),
                    ];
            }
        } catch (Exception $e) {
            return [
                'type' => $this->type,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate Redis hit rate
     */
    private function calculateHitRate(array $info): string
    {
        $hits = (int)($info['keyspace_hits'] ?? 0);
        $misses = (int)($info['keyspace_misses'] ?? 0);
        $total = $hits + $misses;

        if ($total === 0) {
            return 'N/A';
        }

        return round(($hits / $total) * 100, 2) . '%';
    }

    /**
     * Calculate Memcached hit rate
     */
    private function calculateMemcachedHitRate(array $stats): string
    {
        $hits = (int)($stats['get_hits'] ?? 0);
        $misses = (int)($stats['get_misses'] ?? 0);
        $total = $hits + $misses;

        if ($total === 0) {
            return 'N/A';
        }

        return round(($hits / $total) * 100, 2) . '%';
    }

    /**
     * Get cache type
     */
    public function getType(): string
    {
        return $this->type;
    }
}

/**
 * Global helper functions
 */

function distributed_cache_get(string $key, $default = null)
{
    return DistributedCache::getInstance()->get($key, $default);
}

function distributed_cache_set(string $key, $value, int $ttl = 300): bool
{
    return DistributedCache::getInstance()->set($key, $value, $ttl);
}

function distributed_cache_delete(string $key): bool
{
    return DistributedCache::getInstance()->delete($key);
}

function distributed_cache_increment(string $key, int $step = 1): int
{
    return DistributedCache::getInstance()->increment($key, $step);
}

/**
 * Configuration:
 *
 * Set environment variables:
 * REDIS_HOST=localhost
 * REDIS_PORT=6379
 * REDIS_PASSWORD=secret
 * REDIS_DB=0
 *
 * Or for Memcached:
 * MEMCACHED_HOST=localhost
 * MEMCACHED_PORT=11211
 *
 * Installation:
 * - Redis: pecl install redis && echo "extension=redis.so" > /etc/php/conf.d/redis.ini
 * - Memcached: pecl install memcached && echo "extension=memcached.so" > /etc/php/conf.d/memcached.ini
 */
