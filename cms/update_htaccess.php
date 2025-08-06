<?php

require_once __DIR__ . '/db.php';

/**
 * Update the root .htaccess file to redirect storefront paths
 * to the legacy 04-05 directory when applicable.
 */
function cms_update_htaccess_storefront_redirect(): void
{
    $theme = '2004';
    if (file_exists(__DIR__ . '/config.php')) {
        $theme = cms_get_setting('theme', '2004');
    }
    $redirect = in_array($theme, ['2004', '2005_v1'], true);
    $root = dirname(__DIR__);
    $file = $root . '/.htaccess';

    $lines = ['ErrorDocument 404 /error.php'];
    if ($redirect) {
        $lines[] = 'RewriteEngine On';
        $lines[] = 'RewriteRule ^storefront/(.*)$ 04-05v1_storefront/$1 [L,R=302]';
    }
    file_put_contents($file, implode("\n", $lines) . "\n");
}

if (PHP_SAPI === 'cli') {
    cms_update_htaccess_storefront_redirect();
    echo ".htaccess updated\n";
}
