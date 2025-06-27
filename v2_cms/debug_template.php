<?php
/**
 * Debug Template Loading Script
 * Helps diagnose template loading issues
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'code/cms.php';

echo "<h1>Steam CMS Template Debug</h1>";

try {
    $cms = new SteamCMS();
    echo "<p>✓ CMS initialized successfully</p>";
    
    // Test theme setting
    $theme = $_GET['theme'] ?? '2004';
    $cms->setTheme($theme);
    echo "<p>✓ Theme set to: $theme</p>";
    
    // Check template files
    $template_engine = $cms->getTemplate();
    $themes_dir = 'themes';
    
    echo "<h2>Theme Directory Structure</h2>";
    if (is_dir($themes_dir)) {
        echo "<p>✓ Themes directory exists: $themes_dir</p>";
        
        $theme_path = "$themes_dir/$theme";
        if (is_dir($theme_path)) {
            echo "<p>✓ Theme directory exists: $theme_path</p>";
            
            $index_file = "$theme_path/index.tpl";
            $layout_file = "$theme_path/layouts/main.tpl";
            
            if (file_exists($index_file)) {
                echo "<p>✓ Index template exists: $index_file</p>";
                echo "<p>File size: " . filesize($index_file) . " bytes</p>";
            } else {
                echo "<p>✗ Index template missing: $index_file</p>";
            }
            
            if (file_exists($layout_file)) {
                echo "<p>✓ Layout template exists: $layout_file</p>";
                echo "<p>File size: " . filesize($layout_file) . " bytes</p>";
            } else {
                echo "<p>✗ Layout template missing: $layout_file</p>";
            }
            
        } else {
            echo "<p>✗ Theme directory missing: $theme_path</p>";
        }
    } else {
        echo "<p>✗ Themes directory missing: $themes_dir</p>";
    }
    
    echo "<h2>Template Rendering Test</h2>";
    
    // Test basic variables
    $cms->getTemplate()->assign('site_title', 'Steam Debug');
    $cms->getTemplate()->assign('logo_url', '/images/steam_logo.gif');
    $cms->getTemplate()->assign('current_theme', $theme);
    
    // Test arrays
    $navigation = [
        ['title' => 'Home', 'url' => '/', 'target' => '_self'],
        ['title' => 'Store', 'url' => '/store', 'target' => '_self']
    ];
    $cms->getTemplate()->assign('navigation_links', $navigation);
    
    $news = [
        [
            'title' => 'Debug Test Article',
            'content' => 'This is a debug test article.',
            'excerpt' => 'Debug excerpt',
            'author' => 'Debug System',
            'published_date' => '2004-11-16'
        ]
    ];
    $cms->getTemplate()->assign('news_articles', $news);
    
    echo "<p>✓ Test variables assigned</p>";
    
    // Try to render the template
    $output = $cms->renderPage('index');
    
    if (!empty($output)) {
        echo "<p>✅ Template rendered successfully!</p>";
        echo "<p>Output length: " . strlen($output) . " characters</p>";
        
        // Show preview
        echo "<h2>Template Output Preview</h2>";
        echo "<textarea style='width: 100%; height: 200px;'>" . htmlspecialchars(substr($output, 0, 1000)) . "...</textarea>";
        
        // Show full output
        echo "<h2>Full Rendered Page</h2>";
        echo "<iframe src='data:text/html;charset=utf-8," . urlencode($output) . "' style='width: 100%; height: 400px; border: 1px solid #ccc;'></iframe>";
        
    } else {
        echo "<p>✗ Template rendering returned empty output</p>";
    }
    
} catch (Exception $e) {
    echo "<div style='background: #ffe6e6; border: 1px solid #ff0000; padding: 20px; margin: 20px 0;'>";
    echo "<h2>Error Details</h2>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
h1, h2 { color: #333; }
p { margin: 10px 0; }
.success { color: #008000; }
.error { color: #ff0000; }
</style>
