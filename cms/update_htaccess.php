<?php

require_once __DIR__ . '/db.php';

/**
 * Update the root .htaccess file with storefront and custom redirects.
 */
function cms_update_htaccess(): void
{
    $theme = '2004';
    if (file_exists(__DIR__ . '/config.php')) {
        $theme = cms_get_setting('theme', '2004');
    }
    $root = dirname(__DIR__);
    $file = $root . '/.htaccess';

    $storefrontRedirect = in_array($theme, ['2004', '2005_v1'], true);

    $redirects = [];
    try {
        $db = cms_get_db();
        $redirects = $db->query('SELECT slug,target FROM redirects')->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        if ($e->getCode() !== '42S02') {
            throw $e;
        }
    }

    $lines = ['ErrorDocument 404 /error.php'];
    if ($storefrontRedirect || $redirects) {
        $lines[] = 'RewriteEngine On';
        if ($storefrontRedirect) {
            $lines[] = 'RewriteRule ^storefront/(.*)$ 04-05v1_storefront/$1 [L,R=302]';
        }
        foreach ($redirects as $r) {
            $slug = trim($r['slug'], '/');
            if ($slug === '') {
                continue;
            }
            $target = $r['target'];
            $lines[] = 'RewriteRule ^' . preg_quote($slug, '#') . '$ ' . $target . ' [L,R=302]';
        }
    }

    file_put_contents($file, implode("\n", $lines) . "\n");
}

if (PHP_SAPI === 'cli') {
    cms_update_htaccess();
    echo ".htaccess updated\n";
}
