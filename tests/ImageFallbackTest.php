<?php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$config = __DIR__ . '/../cms/config.php';
file_put_contents($config, "<?php return ['host'=>'localhost','port'=>3306,'dbname'=>'test','user'=>'root','pass'=>''];");
$theme = 'fallback_theme';
$themeDir = __DIR__ . '/../themes/' . $theme;
@mkdir($themeDir . '/templates', 0777, true);
@mkdir($themeDir . '/images', 0777, true);
file_put_contents($themeDir . '/images/theme.png', '1');
file_put_contents($themeDir . '/templates/test.twig', "<img src='images/theme.png'>\n<img src='images/root.png'>\n<img src='images/missing.png'>");
file_put_contents(__DIR__ . '/../images/root.png', '1');
require __DIR__ . '/../cms/template_engine.php';
$cms_theme_css_cache[$theme] = '';
$cms_settings_cache['root_path'] = '';
ob_start();
cms_render_template_theme($themeDir . '/templates/test.twig', $theme);
$out = ob_get_clean();
unlink($config);
@unlink(__DIR__ . '/../images/root.png');
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
assert(str_contains($out, "src=\"themes/$theme/images/theme.png\""));
assert(str_contains($out, "src=\"images/root.png\""));
assert(str_contains($out, 'src="image_not_found.jpg"'));
?>
