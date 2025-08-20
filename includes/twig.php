<?php

declare(strict_types=1);

/**
 * Twig Environment Setup for Steam CMS
 */

// Twig autoloader
spl_autoload_register(function(string $class){
    if (strpos($class, 'Twig\\') === 0) {
        $path = __DIR__.'/thirdparty/Twig-3.21.1/src/'.str_replace('\\','/',substr($class,5)).'.php';
        if (file_exists($path)) {
            require $path;
        }
    }
});

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use Twig\TwigFunction;

// Set up Twig loader with template directories
$loader = new FilesystemLoader([
    __DIR__ . '/../themes/2002_forum/templates',
    __DIR__ . '/../themes', // For theme switching
]);

// Create Twig environment
$twigConfig = [
    'cache' => __DIR__ . '/../cms/cache/twig',
    'debug' => defined('DEBUG') ? DEBUG : false,
    'auto_reload' => true,
];

$twig = new Environment($loader, $twigConfig);

// Add debug extension if in debug mode
if ($twigConfig['debug']) {
    $twig->addExtension(new DebugExtension());
}

// Add custom functions for forum URLs
$twig->addFunction(new TwigFunction('url', function($route, $params = []) {
    // Simple URL builder for forum routes
    $routes = [
        'home' => '/',
        'support' => '/support.php',
        'bugs' => '/bugreport.php',
        'troubleshooting' => '/support.php#troubleshooting',
        'contact' => '/support.php#contact',
        'donations' => '/donations.php',
        'terms' => '/terms.php',
        'forum.index' => '/forum',
        'forum.board' => function($params) {
            return '/forum/board/' . $params['board_id'] . (!empty($params['page']) ? '?page=' . $params['page'] : '');
        },
        'forum.thread' => function($params) {
            return '/forum/thread/' . $params['thread_id'];
        },
        'forum.post_new_topic' => function($params) {
            return '/forum/board/' . $params['board_id'] . '/post';
        },
        'forum.post_submit' => '/forum/post/submit',
        'forum.ban_user' => function($params) {
            $url = '/forum/ban/user/' . $params['user_id'];
            if (!empty($params['board_id'])) {
                $url .= '?board_id=' . $params['board_id'];
            }
            return $url;
        },
        'forum.ban_user_submit' => '/forum/ban/user/submit',
        'forum.login' => '/forum/login',
        'forum.login_submit' => '/forum/login/submit',
        'forum.logout' => '/forum/logout',
        'forum.register' => '/forum/register',
        'forum.register_submit' => '/forum/register/submit',
        'forum.account' => '/forum/account',
        'forum.private_messages' => '/forum/messages',
        'forum.forgot_password' => '/forum/forgot-password',
        'forum.user_profile' => function($params) {
            return '/forum/user/' . urlencode($params['username']);
        },
        'forum.search' => function($params) {
            $url = '/forum/search';
            if (!empty($params['board_id'])) {
                $url .= '?board_id=' . $params['board_id'];
            }
            return $url;
        }
    ];
    
    if (!isset($routes[$route])) {
        return '#';
    }
    
    if (is_callable($routes[$route])) {
        return $routes[$route]($params);
    }
    
    return $routes[$route];
}));

// Add function to get current date/time
$twig->addFunction(new TwigFunction('now', function() {
    return new DateTime();
}));
