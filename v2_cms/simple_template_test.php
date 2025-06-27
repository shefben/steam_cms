<?php
/**
 * Simple Template Engine Test
 * Tests template engine without database dependencies
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'code/template_engine.php';

$theme = $_GET['theme'] ?? '2004';

echo "<h1>Simple Template Test for Theme: $theme</h1>";

try {
    // Initialize template engine directly
    $template = new TemplateEngine('themes');
    $template->setTheme($theme);
    
    echo "<p>✓ Template engine initialized</p>";
    
    // Set up basic test data
    $template->assign('site_title', 'Steam Test');
    $template->assign('logo_url', '/images/steam_logo.gif');
    $template->assign('current_theme', $theme);
    
    // Test navigation
    $navigation = [
        ['title' => 'Home', 'url' => '/', 'target' => '_self'],
        ['title' => 'Store', 'url' => '/store', 'target' => '_self'],
        ['title' => 'Community', 'url' => '/community', 'target' => '_self']
    ];
    $template->assign('navigation_links', $navigation);
    
    // Test news
    $news = [
        [
            'title' => 'Test News Article',
            'content' => 'This is test content for the news article.',
            'excerpt' => 'Test excerpt',
            'author' => 'Test Author',
            'published_date' => '2004-11-16'
        ],
        [
            'title' => 'Another Test Article',
            'content' => 'Another test article content.',
            'excerpt' => 'Another excerpt',
            'author' => 'Another Author',
            'published_date' => '2004-11-17'
        ]
    ];
    $template->assign('news_articles', $news);
    
    echo "<p>✓ Test data assigned</p>";
    
    // Check file existence
    $theme_path = "themes/$theme";
    $index_file = "$theme_path/index.tpl";
    $layout_file = "$theme_path/layouts/main.tpl";
    
    echo "<h2>File Check</h2>";
    echo "<p>Theme path: $theme_path - " . (is_dir($theme_path) ? "✓ EXISTS" : "✗ MISSING") . "</p>";
    echo "<p>Index file: $index_file - " . (file_exists($index_file) ? "✓ EXISTS" : "✗ MISSING") . "</p>";
    echo "<p>Layout file: $layout_file - " . (file_exists($layout_file) ? "✓ EXISTS" : "✗ MISSING") . "</p>";
    
    // Try to render
    echo "<h2>Template Rendering</h2>";
    $start_time = microtime(true);
    $output = $template->render('index');
    $end_time = microtime(true);
    
    $render_time = round(($end_time - $start_time) * 1000, 2);
    
    if (!empty($output)) {
        echo "<p>✅ SUCCESS! Template rendered in {$render_time}ms</p>";
        echo "<p>Output length: " . strlen($output) . " characters</p>";
        
        // Quick content checks
        $checks = [
            'HTML structure' => strpos($output, '<html>') !== false,
            'Site title' => strpos($output, 'Steam Test') !== false,
            'Navigation' => strpos($output, 'Home') !== false && strpos($output, 'Store') !== false,
            'News content' => strpos($output, 'Test News Article') !== false,
        ];
        
        echo "<h3>Content Verification</h3>";
        foreach ($checks as $name => $passed) {
            echo "<p>$name: " . ($passed ? "✓ PASS" : "✗ FAIL") . "</p>";
        }
        
        // Show a preview
        echo "<h3>Output Preview (first 500 chars)</h3>";
        echo "<pre style='background: #f0f0f0; padding: 10px; border: 1px solid #ccc; overflow: auto;'>";
        echo htmlspecialchars(substr($output, 0, 500));
        echo "</pre>";
        
        // Render full page
        echo "<h3>Full Rendered Page</h3>";
        echo "<div style='border: 2px solid #007cba; padding: 10px;'>";
        echo $output;
        echo "</div>";
        
    } else {
        echo "<p>✗ FAILED - Empty output returned</p>";
    }
    
} catch (Exception $e) {
    echo "<div style='background: #ffe6e6; border: 1px solid #ff0000; padding: 15px; margin: 10px 0;'>";
    echo "<h3>❌ Error</h3>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
    echo "</div>";
}

echo "<hr>";
echo "<p><a href='?theme=2002'>Test 2002</a> | ";
echo "<a href='?theme=2003'>Test 2003</a> | ";
echo "<a href='?theme=2004'>Test 2004</a> | ";
echo "<a href='?theme=2005'>Test 2005</a> | ";
echo "<a href='?theme=2006'>Test 2006</a> | ";
echo "<a href='?theme=2007'>Test 2007</a> | ";
echo "<a href='?theme=2008'>Test 2008</a> | ";
echo "<a href='?theme=2009'>Test 2009</a></p>";
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1, h2, h3 { color: #333; }
p { margin: 8px 0; }
pre { font-size: 12px; }
</style>
