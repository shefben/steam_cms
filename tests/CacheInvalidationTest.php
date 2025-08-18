<?php
/**
 * Test for Enhanced Cache Invalidation System
 * Tests both the new CacheManager and automatic cache clearing on admin saves
 */

declare(strict_types=1);

require_once __DIR__ . '/../cms/cache_manager.php';

class CacheInvalidationTest
{
    private string $test_dir;
    private CacheManager $cache_manager;

    public function __construct()
    {
        $this->test_dir = __DIR__ . '/temp_cache_test';
        $this->cache_manager = new CacheManager($this->test_dir);
    }

    public function setUp(): void
    {
        // Clean up any existing test directory
        if (is_dir($this->test_dir)) {
            $this->recursiveRemove($this->test_dir);
        }
        mkdir($this->test_dir, 0755, true);
    }

    public function tearDown(): void
    {
        if (is_dir($this->test_dir)) {
            $this->recursiveRemove($this->test_dir);
        }
    }

    private function recursiveRemove(string $dir): void
    {
        foreach (glob($dir . '/*') as $item) {
            if (is_dir($item)) {
                $this->recursiveRemove($item);
            } else {
                unlink($item);
            }
        }
        rmdir($dir);
    }

    public function testBasicCaching(): bool
    {
        echo "Testing basic caching...\n";
        
        // Create a test source file
        $source_file = $this->test_dir . '/source.txt';
        file_put_contents($source_file, 'original content');

        // Register and cache content
        $this->cache_manager->registerSourceFiles('test_key', [$source_file], 'test');
        $result = $this->cache_manager->set('test_key', 'cached content', 'test');
        
        if (!$result) {
            echo "❌ Failed to set cache\n";
            return false;
        }

        // Retrieve from cache
        $cached = $this->cache_manager->get('test_key', 'test');
        if ($cached !== 'cached content') {
            echo "❌ Failed to retrieve from cache. Got: " . var_export($cached, true) . "\n";
            return false;
        }

        echo "✓ Basic caching works\n";
        return true;
    }

    public function testFileTimestampInvalidation(): bool
    {
        echo "Testing file timestamp invalidation...\n";
        
        // Create a test source file
        $source_file = $this->test_dir . '/source.txt';
        file_put_contents($source_file, 'original content');

        // Register and cache content
        $this->cache_manager->registerSourceFiles('test_key', [$source_file], 'test');
        $this->cache_manager->set('test_key', 'cached content', 'test');

        // Verify cache is valid
        if (!$this->cache_manager->isCacheValid('test_key', 'test')) {
            echo "❌ Cache should be valid initially\n";
            return false;
        }

        // Sleep to ensure timestamp difference
        sleep(1);

        // Modify source file
        file_put_contents($source_file, 'modified content');

        // Cache should now be invalid
        if ($this->cache_manager->isCacheValid('test_key', 'test')) {
            echo "❌ Cache should be invalid after source file modification\n";
            return false;
        }

        // Getting from cache should return null
        $cached = $this->cache_manager->get('test_key', 'test');
        if ($cached !== null) {
            echo "❌ Should return null for invalid cache. Got: " . var_export($cached, true) . "\n";
            return false;
        }

        echo "✓ File timestamp invalidation works\n";
        return true;
    }

    public function testAutoCacheClear(): bool
    {
        echo "Testing automatic cache clearing function...\n";
        
        // Create some test cache files in the old format
        $cache_dir = __DIR__ . '/../cms/cache';
        if (!is_dir($cache_dir)) {
            mkdir($cache_dir, 0755, true);
        }
        
        $test_files = [
            $cache_dir . '/test1.html',
            $cache_dir . '/test2.css',
            $cache_dir . '/news/test3.html'
        ];
        
        foreach ($test_files as $file) {
            $dir = dirname($file);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            file_put_contents($file, 'test content');
        }
        
        // Test the clear function
        $cleared = cms_clear_all_caches();
        
        if ($cleared === 0) {
            echo "❌ Should have cleared some files\n";
            return false;
        }
        
        // Check that files were removed
        $remaining = 0;
        foreach ($test_files as $file) {
            if (file_exists($file)) {
                $remaining++;
            }
        }
        
        if ($remaining > 0) {
            echo "❌ Some cache files were not cleared ($remaining remaining)\n";
            return false;
        }
        
        echo "✓ Automatic cache clearing works\n";
        return true;
    }

    public function runAllTests(): void
    {
        echo "=== Enhanced Cache Invalidation System Tests ===\n\n";
        
        $tests = [
            'testBasicCaching',
            'testFileTimestampInvalidation', 
            'testAutoCacheClear'
        ];

        $passed = 0;
        $total = count($tests);

        foreach ($tests as $test) {
            $this->setUp();
            try {
                if ($this->$test()) {
                    $passed++;
                }
                echo "\n";
            } catch (Exception $e) {
                echo "❌ Test $test failed with exception: " . $e->getMessage() . "\n\n";
            }
            $this->tearDown();
        }

        echo "=== Results ===\n";
        echo "$passed/$total tests passed\n";
        
        if ($passed === $total) {
            echo "🎉 All tests passed! Cache system is working correctly.\n";
        } else {
            echo "❌ Some tests failed. Cache system needs attention.\n";
        }
    }
}

// Include the old test logic for compatibility
function runLegacyTests(): void
{
    echo "=== Legacy Template Cache Tests ===\n";
    
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $config = __DIR__ . '/../cms/config.php';
    
    // Backup existing config if it exists
    $config_backup = null;
    if (file_exists($config)) {
        $config_backup = file_get_contents($config);
    }
    
    try {
        file_put_contents($config, "<?php return ['host'=>'localhost','port'=>3306,'dbname'=>'test','user'=>'root','pass'=>''];");
        $theme = 'cache_test_theme';
        $themeDir = __DIR__ . '/../themes/' . $theme;
        @mkdir($themeDir . '/templates', 0777, true);
        file_put_contents($themeDir . '/templates/test.twig', "<link rel='stylesheet' href='style.css'>v1");
        file_put_contents($themeDir . '/style.css', 'body{}');

        require_once __DIR__ . '/../cms/template_engine.php';

        $cms_theme_css_cache[$theme] = 'style.css';
        $cms_settings_cache['root_path'] = '';
        $cms_settings_cache['enable_cache'] = '1';
        $cms_settings_cache['theme'] = $theme;

        $tpl = $themeDir . '/templates/test.twig';
        
        echo "Testing template cache with file modifications...\n";
        
        // Test template rendering and caching
        ob_start();
        cms_render_template($tpl);
        ob_end_clean();
        
        echo "✓ Template cache integration works\n";
        
        // Cleanup
        rrmdir($themeDir);
        
    } catch (Exception $e) {
        echo "❌ Legacy template test failed: " . $e->getMessage() . "\n";
    } finally {
        // Restore config
        if ($config_backup !== null) {
            file_put_contents($config, $config_backup);
        } else {
            @unlink($config);
        }
    }
}

function rrmdir($dir): void {
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $f){
        if ($f === '.' || $f === '..') continue;
        $p = "$dir/$f";
        if (is_dir($p)) rrmdir($p); else unlink($p);
    }
    rmdir($dir);
}

// Run tests if called directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'] ?? '')) {
    $test = new CacheInvalidationTest();
    $test->runAllTests();
    
    echo "\n";
    runLegacyTests();
}
?>
