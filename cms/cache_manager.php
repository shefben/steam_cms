<?php
declare(strict_types=1);
/**
 * SteamCMS Cache Manager
 *
 * Centralized caching system with file timestamp validation and automatic invalidation.
 */

if (!defined('CMS_CACHE_MANAGER_LOADED')) {
    define('CMS_CACHE_MANAGER_LOADED', true);

class CacheManager
{
    private string $cache_dir;
    private array $cache_sources = [];
    
    public function __construct(string $cache_dir = null)
    {
        $this->cache_dir = $cache_dir ?? __DIR__ . '/cache';
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }

    /**
     * Get cache file path for a given key and namespace
     */
    private function getCacheFile(string $key, string $namespace = 'default'): string
    {
        $ns_dir = $this->cache_dir . '/' . $namespace;
        if (!is_dir($ns_dir)) {
            mkdir($ns_dir, 0755, true);
        }
        return $ns_dir . '/' . hash('sha256', $key) . '.cache';
    }

    /**
     * Get cache metadata file path
     */
    private function getMetaFile(string $cache_file): string
    {
        return $cache_file . '.meta';
    }

    /**
     * Register source files that this cache entry depends on
     */
    public function registerSourceFiles(string $key, array $source_files, string $namespace = 'default'): void
    {
        $cache_key = $namespace . ':' . $key;
        $this->cache_sources[$cache_key] = array_map('realpath', array_filter($source_files, 'file_exists'));
    }

    /**
     * Check if cache is valid based on source file timestamps
     */
    public function isCacheValid(string $key, string $namespace = 'default', int $ttl = 0): bool
    {
        $cache_file = $this->getCacheFile($key, $namespace);
        $meta_file = $this->getMetaFile($cache_file);
        
        if (!file_exists($cache_file) || !file_exists($meta_file)) {
            return false;
        }

        $cache_time = filemtime($cache_file);
        
        // Check TTL if specified
        if ($ttl > 0 && time() - $cache_time > $ttl) {
            return false;
        }

        // Read metadata
        $meta = json_decode(file_get_contents($meta_file), true);
        if (!$meta || !isset($meta['sources'])) {
            return false;
        }

        // Check if any source files are newer than cache
        foreach ($meta['sources'] as $source_file => $source_time) {
            if (!file_exists($source_file)) {
                // Source file was deleted, cache is invalid
                return false;
            }
            
            if (filemtime($source_file) > $source_time) {
                // Source file was modified after cache creation
                return false;
            }
        }

        return true;
    }

    /**
     * Get cached content if valid
     */
    public function get(string $key, string $namespace = 'default', int $ttl = 0): ?string
    {
        if (!$this->isCacheValid($key, $namespace, $ttl)) {
            return null;
        }

        $cache_file = $this->getCacheFile($key, $namespace);
        
        // Check file size before reading to prevent memory exhaustion
        $filesize = filesize($cache_file);
        if ($filesize === false || $filesize > 10 * 1024 * 1024) { // 10MB limit
            error_log("Cache file too large or unreadable: $cache_file ($filesize bytes)");
            return null;
        }
        
        $content = file_get_contents($cache_file);
        
        return $content !== false ? $content : null;
    }

    /**
     * Store content in cache with source file tracking
     */
    public function set(string $key, string $content, string $namespace = 'default'): bool
    {
        $cache_file = $this->getCacheFile($key, $namespace);
        $meta_file = $this->getMetaFile($cache_file);
        
        // Get source files for this cache key
        $cache_key = $namespace . ':' . $key;
        $source_files = $this->cache_sources[$cache_key] ?? [];
        
        // Build metadata with current source file timestamps
        $meta = [
            'created' => time(),
            'key' => $key,
            'namespace' => $namespace,
            'sources' => []
        ];
        
        foreach ($source_files as $source_file) {
            if (file_exists($source_file)) {
                $meta['sources'][$source_file] = filemtime($source_file);
            }
        }

        // Write cache and metadata atomically with exclusive locking
        $temp_cache = $cache_file . '.tmp';
        $temp_meta = $meta_file . '.tmp';
        
        if (file_put_contents($temp_cache, $content, LOCK_EX) === false) {
            return false;
        }
        
        if (file_put_contents($temp_meta, json_encode($meta, JSON_PRETTY_PRINT), LOCK_EX) === false) {
            unlink($temp_cache);
            return false;
        }
        
        // Atomic rename
        if (!rename($temp_cache, $cache_file) || !rename($temp_meta, $meta_file)) {
            @unlink($temp_cache);
            @unlink($temp_meta);
            return false;
        }
        
        return true;
    }

    /**
     * Clear specific cache entry
     */
    public function delete(string $key, string $namespace = 'default'): bool
    {
        $cache_file = $this->getCacheFile($key, $namespace);
        $meta_file = $this->getMetaFile($cache_file);
        
        $success = true;
        if (file_exists($cache_file)) {
            $success = unlink($cache_file);
        }
        if (file_exists($meta_file)) {
            $success = unlink($meta_file) && $success;
        }
        
        return $success;
    }

    /**
     * Clear all cache in a namespace or entire cache
     */
    public function clear(string $namespace = null): int
    {
        $cleared = 0;
        
        if ($namespace === null) {
            // Clear entire cache directory
            $pattern = $this->cache_dir . '/*';
        } else {
            // Clear specific namespace
            $pattern = $this->cache_dir . '/' . $namespace . '/*';
        }
        
        foreach (glob($pattern) as $item) {
            if (is_file($item)) {
                if (unlink($item)) {
                    $cleared++;
                }
            } elseif (is_dir($item) && $namespace === null) {
                // Recursively clear subdirectories when clearing all
                $this->clear(basename($item));
                if (count(glob($item . '/*')) === 0) {
                    rmdir($item);
                }
            }
        }
        
        // Clean up empty namespace directories
        if ($namespace !== null) {
            $ns_dir = $this->cache_dir . '/' . $namespace;
            if (is_dir($ns_dir) && count(glob($ns_dir . '/*')) === 0) {
                if (!rmdir($ns_dir)) {
                    error_log("Failed to remove empty namespace directory: $ns_dir");
                }
            }
        }
        
        return $cleared;
    }

    /**
     * Get cache statistics
     */
    public function getStats(): array
    {
        $stats = [
            'total_files' => 0,
            'total_size' => 0,
            'namespaces' => []
        ];
        
        foreach (glob($this->cache_dir . '/*') as $item) {
            if (is_dir($item)) {
                $namespace = basename($item);
                $files = glob($item . '/*.cache');
                $size = 0;
                
                foreach ($files as $file) {
                    $size += filesize($file);
                }
                
                $stats['namespaces'][$namespace] = [
                    'files' => count($files),
                    'size' => $size
                ];
                
                $stats['total_files'] += count($files);
                $stats['total_size'] += $size;
            }
        }
        
        return $stats;
    }
}

/**
 * Global cache manager instance
 */
function cms_cache_manager(): CacheManager
{
    static $instance = null;
    if ($instance === null) {
        $instance = new CacheManager();
    }
    return $instance;
}

/**
 * Clear all caches (called on admin saves)
 */
function cms_clear_all_caches(): int
{
    $manager = cms_cache_manager();
    $cleared = $manager->clear();
    
    // Also clear legacy cache files and directories
    $legacy_patterns = [
        __DIR__ . '/cache/*.html',
        __DIR__ . '/cache/*.css',
        __DIR__ . '/cache/news/*.html',
        __DIR__ . '/cache/twig/*/*'
    ];
    
    foreach ($legacy_patterns as $pattern) {
        foreach (glob($pattern) as $file) {
            if (is_file($file) && unlink($file)) {
                $cleared++;
            }
        }
    }
    
    // Clear Twig cache directories
    $twig_cache_dir = __DIR__ . '/cache/twig';
    if (is_dir($twig_cache_dir)) {
        foreach (glob($twig_cache_dir . '/*') as $subdir) {
            if (is_dir($subdir)) {
                foreach (glob($subdir . '/*') as $file) {
                    if (is_file($file) && unlink($file)) {
                        $cleared++;
                    }
                }
                if (!rmdir($subdir)) {
                    error_log("Failed to remove Twig cache directory: $subdir");
                }
            }
        }
    }
    
    return $cleared;
}

/**
 * Register cache invalidation hooks for admin saves
 */
function cms_init_cache_invalidation(): void
{
    // This will be called from admin_header.php to set up automatic cache clearing
    if (!function_exists('cms_register_save_hook')) {
        return;
    }
    
    cms_register_save_hook(function() {
        cms_clear_all_caches();
    });
}

} // End of include guard