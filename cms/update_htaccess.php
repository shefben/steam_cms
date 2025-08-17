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
    if ($redirects) {
        $lines[] = 'RewriteEngine On';
        foreach ($redirects as $r) {
            $hasTrailingSlash = substr($r['slug'], -1) === '/';
            $slug = trim($r['slug'], '/');
            if ($slug === '') {
                continue;
            }
            $target = $r['target'];
            $pattern = '^' . preg_quote($slug, '#');
            if ($hasTrailingSlash) {
                $pattern .= '/?';
            }
            $pattern .= '$';
            $lines[] = 'RewriteRule ' . $pattern . ' ' . $target . ' [L,R=302,QSA]';
        }
    }

    file_put_contents($file, implode("\n", $lines) . "\n");
}

if (PHP_SAPI === 'cli') {
    cms_update_htaccess();
    echo ".htaccess updated\n";
}
