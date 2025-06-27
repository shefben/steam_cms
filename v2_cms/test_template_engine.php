<?php
/**
 * Template Engine Test Script
 * Tests the template engine fixes for theme loading issues
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'code/template_engine.php';

echo "Testing Template Engine...\n\n";

try {
    // Initialize template engine
    $template = new TemplateEngine('themes');
    $template->setTheme('2004');
    
    echo "✓ Template engine initialized\n";
    
    // Test basic variable assignment
    $template->assign('site_title', 'Steam Test');
    $template->assign('logo_url', '/images/steam_logo.gif');
    
    // Test navigation array
    $navigation = [
        ['title' => 'Home', 'url' => '/', 'target' => '_self'],
        ['title' => 'Store', 'url' => '/store', 'target' => '_self'],
        ['title' => 'Community', 'url' => '/community', 'target' => '_self']
    ];
    $template->assign('navigation_links', $navigation);
    
    // Test news articles array
    $news = [
        [
            'title' => 'Test Article',
            'content' => 'This is a test article content.',
            'excerpt' => 'Test excerpt',
            'author' => 'Test Author',
            'published_date' => '2004-11-16'
        ]
    ];
    $template->assign('news_articles', $news);
    
    echo "✓ Variables assigned\n";
    
    // Check if template files exist
    $theme_dir = 'themes/2004';
    $index_file = $theme_dir . '/index.tpl';
    $layout_file = $theme_dir . '/layouts/main.tpl';
    
    if (file_exists($index_file)) {
        echo "✓ Index template exists: $index_file\n";
    } else {
        echo "✗ Index template missing: $index_file\n";
    }
    
    if (file_exists($layout_file)) {
        echo "✓ Layout template exists: $layout_file\n";
    } else {
        echo "✗ Layout template missing: $layout_file\n";
    }
    
    // Test template rendering
    echo "\nTesting template rendering...\n";
    $output = $template->render('index');
    
    if (!empty($output)) {
        echo "✓ Template rendered successfully!\n";
        echo "✓ Output length: " . strlen($output) . " characters\n";
        
        // Check for key elements
        if (strpos($output, '<html>') !== false) {
            echo "✓ HTML structure found\n";
        }
        if (strpos($output, 'Steam Test') !== false) {
            echo "✓ Site title variable rendered\n";
        }
        if (strpos($output, 'Test Article') !== false) {
            echo "✓ News article rendered\n";
        }
        
        echo "\n✅ Template engine is working correctly!\n";
    } else {
        echo "✗ Template rendering returned empty output\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "✗ Template engine test failed\n";
}
?>
