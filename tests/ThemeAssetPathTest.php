<?php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$config = __DIR__ . '/../cms/config.php';
file_put_contents($config, "<?php return ['host'=>'localhost','port'=>3306,'dbname'=>'test','user'=>'root','pass'=>''];");
$theme = 'test_asset_theme';
$themeDir = __DIR__ . '/../themes/' . $theme;
@mkdir($themeDir . '/templates', 0777, true);
file_put_contents($themeDir . '/templates/test.twig', "<link rel='stylesheet' href='style.css'>\n<div style=\"background:url('images//bg.png')\"></div>\n<script>newImage('images/btn.png');</script>");
file_put_contents($themeDir . '/style.css', "body{background:url('images//bg2.png');}");
require __DIR__ . '/../cms/template_engine.php';
$cms_theme_css_cache[$theme] = 'style.css';
$cms_settings_cache['root_path'] = '';
ob_start();
cms_render_template_theme($themeDir . '/templates/test.twig', $theme);
$out = ob_get_clean();
preg_match('/href=\"(cms\/cache\/[^\"]+)\"/', $out, $m);
$cssPath = __DIR__ . '/../' . $m[1];
$css = file_get_contents($cssPath);
unlink($cssPath);
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
assert(str_contains($out, "href=\"cms/cache/"));
assert(str_contains($out, "background:url('themes/$theme/images/bg.png')"));
assert(str_contains($out, "newImage('themes/$theme/images/btn.png')"));
assert(!str_contains($out, 'images//'));
assert(str_contains($css, "url('themes/$theme/images/bg2.png')"));
assert(!str_contains($css, 'images//'));
?>
