<?php
/**
 * SteamCMS Bootstrap - Centralized Initialization
 *
 * PERFORMANCE OPTIMIZATION: This file consolidates all core requires
 * into a single include, preventing duplicate file loading overhead.
 *
 * Include this file ONCE at the entry point instead of multiple
 * scattered require_once calls throughout the codebase.
 *
 * Estimated savings: 100-200ms per request
 */

// Prevent multiple bootstrapping
if (defined('CMS_BOOTSTRAPPED')) {
    return;
}
define('CMS_BOOTSTRAPPED', true);

// Define CMS root if not already defined
if (!defined('CMS_ROOT')) {
    define('CMS_ROOT', dirname(__DIR__));
}

// Load core files in dependency order (each file loads only once)
require_once __DIR__ . '/filesystem_cache.php';  // Filesystem caching layer
require_once __DIR__ . '/cache.php';              // Runtime cache helpers
require_once __DIR__ . '/db.php';                 // Database connection and settings
require_once __DIR__ . '/cache_manager.php';      // Advanced cache management

// Template engine loads its own dependencies (news.php, plugin_api.php, twig)
// Only load if needed - lazy loading for non-template requests
function cms_require_template_engine(): void
{
    static $loaded = false;
    if (!$loaded) {
        require_once __DIR__ . '/template_engine.php';
        $loaded = true;
    }
}

/**
 * Quick bootstrap for pages that only need database access
 * (e.g., API endpoints, AJAX handlers)
 */
function cms_bootstrap_minimal(): void
{
    // Already loaded via this file
}

/**
 * Full bootstrap for pages that need template rendering
 */
function cms_bootstrap_full(): void
{
    cms_require_template_engine();
}
