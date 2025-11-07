<?php

/**
 * Full-Page Cache Bootstrap
 *
 * Include this at the very top of index.php (before any output)
 * to enable full-page caching for anonymous users
 *
 * Usage:
 * ```php
 * <?php
 * require_once __DIR__ . '/public_cache_bootstrap.php';
 * // ... rest of index.php
 * ```
 */

// Start output buffering early
ob_start();

// Load full-page cache
require_once __DIR__ . '/cms/full_page_cache.php';

// Try to serve from cache
if (FullPageCache::serve()) {
    // Page was served from cache, exit early
    exit;
}

// Not in cache, start capturing output
FullPageCache::start();

// Register shutdown function to save cache
register_shutdown_function(function() {
    // Flush output buffers
    while (ob_get_level() > 0) {
        ob_end_flush();
    }
});
