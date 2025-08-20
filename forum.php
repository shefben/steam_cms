<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/twig.php';

// Forum autoloader
spl_autoload_register(function ($class) {
    if (strpos($class, 'Forum\\') === 0) {
        $path = __DIR__ . '/Forum/' . str_replace('Forum\\', '', $class) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
});

use Forum\ForumController;

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Simple router
    $uri = $_SERVER['REQUEST_URI'] ?? '/forum';
    $path = parse_url($uri, PHP_URL_PATH);
    $query = parse_url($uri, PHP_URL_QUERY);
    
    // Parse query parameters
    $params = [];
    if ($query) {
        parse_str($query, $params);
    }
    
    // Initialize controller
    $controller = new ForumController($db, $twig);
    
    // Route handling
    if (preg_match('#^/forum/?$#', $path)) {
        // Forum index
        echo $controller->index();
        
    } elseif (preg_match('#^/forum/board/(\d+)/?$#', $path, $matches)) {
        // Board view
        $boardId = (int) $matches[1];
        $page = (int) ($params['page'] ?? 1);
        echo $controller->board($boardId, $page);
        
    } elseif (preg_match('#^/forum/board/(\d+)/post/?$#', $path, $matches)) {
        // Post new topic
        $boardId = (int) $matches[1];
        echo $controller->postNewTopic($boardId);
        
    } elseif (preg_match('#^/forum/post/submit/?$#', $path)) {
        // Handle post submission
        $controller->postSubmit();
        
    } elseif (preg_match('#^/forum/ban/user/(\d+)/?$#', $path, $matches)) {
        // Ban user form
        $userId = (int) $matches[1];
        $boardId = !empty($params['board_id']) ? (int) $params['board_id'] : null;
        echo $controller->banUser($userId, $boardId);
        
    } elseif (preg_match('#^/forum/ban/user/submit/?$#', $path)) {
        // Handle ban user submission
        $controller->banUserSubmit();
        
    } elseif (preg_match('#^/forum/login/?$#', $path)) {
        // Login form
        echo $controller->login();
        
    } elseif (preg_match('#^/forum/login/submit/?$#', $path)) {
        // Handle login submission
        $controller->loginSubmit();
        
    } elseif (preg_match('#^/forum/logout/?$#', $path)) {
        // Logout
        $controller->logout();
        
    } elseif (preg_match('#^/forum/register/?$#', $path)) {
        // Registration form
        echo $controller->register();
        
    } elseif (preg_match('#^/forum/register/submit/?$#', $path)) {
        // Handle registration submission
        $controller->registerSubmit();
        
    } else {
        // 404 Not Found
        http_response_code(404);
        echo $twig->render('errors/404.twig', [
            'message' => 'Forum page not found',
            'theme_path' => '/themes/2002_forum'
        ]);
    }
    
} catch (Exception $e) {
    // Error handling
    http_response_code($e->getCode() ?: 500);
    
    $errorData = [
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
        'theme_path' => '/themes/2002_forum'
    ];
    
    if ($e->getCode() === 403) {
        echo $twig->render('errors/403.twig', $errorData);
    } elseif ($e->getCode() === 404) {
        echo $twig->render('errors/404.twig', $errorData);
    } else {
        echo $twig->render('errors/500.twig', $errorData);
    }
}