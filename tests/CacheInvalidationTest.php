<?php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$config = __DIR__ . '/../cms/config.php';
file_put_contents($config, "<?php return ['host'=>'localhost','port'=>3306,'dbname'=>'test','user'=>'root','pass'=>''];");
$theme = 'cache_test_theme';
$themeDir = __DIR__ . '/../themes/' . $theme;
@mkdir($themeDir . '/templates', 0777, true);
file_put_contents($themeDir . '/templates/test.twig', "<link rel='stylesheet' href='style.css'>v1");
file_put_contents($themeDir . '/style.css', 'body{}');

require __DIR__ . '/../cms/template_engine.php';

$cms_theme_css_cache[$theme] = 'style.css';
$cms_settings_cache['root_path'] = '';
$cms_settings_cache['enable_cache'] = '1';
$cms_settings_cache['theme'] = $theme;

$tpl = $themeDir . '/templates/test.twig';
ob_start();
cms_render_template($tpl);
ob_end_clean();
$cacheFile = __DIR__ . '/../cms/cache/' . md5($tpl) . '.html';
$time1 = filemtime($cacheFile);

sleep(1);
file_put_contents($tpl, "<link rel='stylesheet' href='style.css'>v2");
clearstatcache();
touch($tpl, time()+2);
ob_start();
cms_render_template($tpl);
ob_end_clean();
$time2 = filemtime($cacheFile);
assert($time2 > $time1);

sleep(1);
file_put_contents($themeDir . '/style.css', 'body{color:red;}');
clearstatcache();
touch($themeDir . '/style.css', time()+2);
ob_start();
cms_render_template($tpl);
ob_end_clean();
$time3 = filemtime($cacheFile);
assert($time3 > $time2);

$news = __DIR__ . '/../cms/news.php';
$orig = filemtime($news);
sleep(1);
touch($news, time()+2);
clearstatcache();
ob_start();
cms_render_template($tpl);
ob_end_clean();
$time4 = filemtime($cacheFile);
assert($time4 > $time3);
touch($news, $orig);

unlink($cacheFile);
rrmdir(__DIR__ . '/../cms/cache');
unlink($config);
rrmdir($themeDir);

function rrmdir($dir){
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $f){
        if ($f === '.' || $f === '..') continue;
        $p = "$dir/$f";
        if (is_dir($p)) rrmdir($p); else unlink($p);
    }
    rmdir($dir);
}
?>
