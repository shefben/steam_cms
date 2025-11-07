<?php

declare(strict_types=1);

/**
 * Asset Versioning and Fingerprinting (Optimization #14)
 *
 * Automatically adds version hashes to asset URLs for effective cache busting
 * Generates manifest file mapping original paths to versioned paths
 *
 * PERFORMANCE IMPACT: Enables aggressive browser caching without manual cache invalidation
 */

class AssetVersioning
{
    private const MANIFEST_FILE = __DIR__ . '/cache/asset_manifest.json';
    private const HASH_LENGTH = 8;

    private static $manifest = null;

    /**
     * Initialize or load asset manifest
     */
    private static function loadManifest(): array
    {
        if (self::$manifest !== null) {
            return self::$manifest;
        }

        if (file_exists(self::MANIFEST_FILE)) {
            $json = file_get_contents(self::MANIFEST_FILE);
            self::$manifest = json_decode($json, true) ?: [];
        } else {
            self::$manifest = [];
        }

        return self::$manifest;
    }

    /**
     * Save manifest to disk
     */
    private static function saveManifest(): void
    {
        $dir = dirname(self::MANIFEST_FILE);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(
            self::MANIFEST_FILE,
            json_encode(self::$manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    /**
     * Generate version hash for a file
     */
    private static function generateHash(string $filepath): string
    {
        if (!file_exists($filepath)) {
            return substr(md5($filepath), 0, self::HASH_LENGTH);
        }

        // Use file modification time + size for hash (faster than content hashing)
        $mtime = filemtime($filepath);
        $size = filesize($filepath);
        $hash = md5($filepath . $mtime . $size);

        return substr($hash, 0, self::HASH_LENGTH);
    }

    /**
     * Get versioned asset path
     *
     * @param string $path Original asset path (e.g., '/themes/2004/css/style.css')
     * @return string Versioned path (e.g., '/themes/2004/css/style.abc12345.css')
     */
    public static function version(string $path): string
    {
        self::loadManifest();

        // Check if already in manifest and file hasn't changed
        if (isset(self::$manifest[$path])) {
            $versionedPath = self::$manifest[$path]['versioned'];
            $lastHash = self::$manifest[$path]['hash'];

            // Verify file hasn't changed
            $fullPath = dirname(__DIR__) . $path;
            $currentHash = self::generateHash($fullPath);

            if ($lastHash === $currentHash) {
                return $versionedPath;
            }
        }

        // Generate new versioned path
        $fullPath = dirname(__DIR__) . $path;
        $hash = self::generateHash($fullPath);

        $pathInfo = pathinfo($path);
        $dirname = $pathInfo['dirname'] !== '.' ? $pathInfo['dirname'] : '';
        $filename = $pathInfo['filename'];
        $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';

        $versionedPath = ($dirname ? $dirname . '/' : '') . $filename . '.' . $hash . $extension;

        // Update manifest
        self::$manifest[$path] = [
            'versioned' => $versionedPath,
            'hash' => $hash,
            'mtime' => file_exists($fullPath) ? filemtime($fullPath) : time(),
        ];

        self::saveManifest();

        return $versionedPath;
    }

    /**
     * Get original path from versioned path
     */
    public static function resolve(string $versionedPath): ?string
    {
        self::loadManifest();

        foreach (self::$manifest as $original => $data) {
            if ($data['versioned'] === $versionedPath) {
                return $original;
            }
        }

        // Try to extract original path by removing hash
        // e.g., style.abc12345.css -> style.css
        if (preg_match('/^(.+)\.[a-f0-9]{' . self::HASH_LENGTH . '}(\.[a-z0-9]+)$/i', $versionedPath, $matches)) {
            return $matches[1] . $matches[2];
        }

        return null;
    }

    /**
     * Rebuild entire asset manifest
     * Scans all theme directories for assets
     */
    public static function rebuildManifest(): int
    {
        self::$manifest = [];
        $count = 0;

        $themesDir = dirname(__DIR__) . '/themes';
        $extensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'woff', 'woff2', 'ttf', 'eot'];

        foreach (glob($themesDir . '/*', GLOB_ONLYDIR) as $themeDir) {
            $themeName = basename($themeDir);

            foreach ($extensions as $ext) {
                // Scan multiple directories
                $patterns = [
                    "$themeDir/*.$ext",
                    "$themeDir/css/*.$ext",
                    "$themeDir/js/*.$ext",
                    "$themeDir/images/*.$ext",
                    "$themeDir/fonts/*.$ext",
                    "$themeDir/storefront/css/*.$ext",
                    "$themeDir/storefront/js/*.$ext",
                    "$themeDir/storefront/images/*.$ext",
                ];

                foreach ($patterns as $pattern) {
                    foreach (glob($pattern) as $file) {
                        $relativePath = str_replace(dirname(__DIR__), '', $file);
                        self::version($relativePath);
                        $count++;
                    }
                }
            }
        }

        self::saveManifest();

        return $count;
    }

    /**
     * Clear asset manifest
     */
    public static function clearManifest(): void
    {
        self::$manifest = [];
        if (file_exists(self::MANIFEST_FILE)) {
            unlink(self::MANIFEST_FILE);
        }
    }

    /**
     * Get manifest statistics
     */
    public static function getStats(): array
    {
        self::loadManifest();

        return [
            'total_assets' => count(self::$manifest),
            'manifest_file' => self::MANIFEST_FILE,
            'manifest_exists' => file_exists(self::MANIFEST_FILE),
            'manifest_size' => file_exists(self::MANIFEST_FILE) ? filesize(self::MANIFEST_FILE) : 0,
        ];
    }
}

/**
 * Global helper function for easy use in templates
 */
if (!function_exists('asset')) {
    /**
     * Get versioned asset URL
     */
    function asset(string $path): string
    {
        return AssetVersioning::version($path);
    }
}

/**
 * Twig function for asset versioning
 * Add this to cms_twig_env() function:
 *
 * $env->addFunction(new TwigFunction('asset', function(string $path) {
 *     return AssetVersioning::version($path);
 * }));
 */
