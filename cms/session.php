<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    // Derive a unique session name per installation using the absolute path
    $sessionName = 'cms_' . substr(hash('sha256', __DIR__), 0, 16);
    session_name($sessionName);

    // Determine the base path for cookie scope
    $dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    if (str_ends_with($dir, '/cms/admin')) {
        $dir = substr($dir, 0, -10);
    } elseif (str_ends_with($dir, '/cms')) {
        $dir = substr($dir, 0, -4);
    }
    $path = $dir === '' ? '/' : $dir . '/';

    session_set_cookie_params([
        'path' => $path,
        'secure' => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}
