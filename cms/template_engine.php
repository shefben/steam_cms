<?php
require_once __DIR__.'/news.php';
require_once __DIR__.'/../includes/twig.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

function cms_theme_layout(string $file, ?string $theme = null)
{
    $theme = $theme ?? cms_get_setting('theme', '2004');
    $file = preg_replace('/\.tpl$/', '.twig', $file);
    $base = dirname(__DIR__)."/themes/$theme/layout/$file";
    if (!file_exists($base)) {
        $base = dirname(__DIR__)."/themes/2004/layout/$file";
    }
    return $base;
}
function cms_twig_env(string $tpl_dir): Environment
{
    static $env;
    if (!$env) {
        $loader = new FilesystemLoader($tpl_dir);
        $env = new Environment($loader);
        $env->addFunction(new TwigFunction('header', function(bool $withButtons = true) {
            $theme = cms_get_setting('theme', '2004');
            return cms_render_header($theme, $withButtons);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('footer', function() {
            $theme = cms_get_setting('theme', '2004');
            $html  = cms_get_theme_footer($theme);
            $html  = str_ireplace('{BASE}', '{{ BASE }}', $html);
            $env   = cms_twig_env('.');
            return $env->createTemplate($html)->render(['BASE' => cms_base_url()]);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('nav_buttons', function(string $theme = '', string $style = '') {
            $theme = $theme !== '' ? $theme : cms_get_setting('theme', '2004');
            return cms_header_buttons_html($theme, $style);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('news', function(string $type, ?int $count = null) {
            $theme = cms_get_setting('theme', '2004');
            $cfg = cms_get_theme_config($theme);
            $count = $count ?? ($cfg['news_count'] ?? null);
            return cms_render_news($type, $count);
        }, ['is_safe' => ['html']]));
    } else {
        /** @var FilesystemLoader $loader */
        $loader = $env->getLoader();
        $loader->setPaths([$tpl_dir]);
    }
    return $env;
}

function cms_render_string(string $html, array $vars, string $tpl_dir): string
{
    $html = str_ireplace('{BASE}', '{{ BASE }}', $html);
    $env  = cms_twig_env($tpl_dir);
    return $env->createTemplate($html)->render($vars);
}

function cms_render_template(string $path, array $vars = []): void
{
    $cache_enabled = cms_get_setting('enable_cache', '0') === '1';
    $cache_file = __DIR__.'/cache/'.md5($path).'.html';
    if ($cache_enabled && file_exists($cache_file) && filemtime($cache_file) >= filemtime($path)) {
        readfile($cache_file);
        return;
    }

    $theme = cms_get_setting('theme', '2004');
    $tpl_dir = dirname($path);
    $subdir = $vars['theme_subdir'] ?? '';
    $base_url = cms_base_url();

    $vars += [
        'CMS_ROOT'  => __DIR__,
        'THEME_DIR' => $tpl_dir,
        'THEME_URL' => ($base_url ? $base_url : '') . "/themes/$theme" . ($subdir ? "/$subdir" : ''),
        'CSS_PATH'  => ($base_url ? $base_url : '') . "/themes/$theme/" . ltrim(cms_get_theme_css($theme), '/'),
        'BASE'      => $base_url,
    ];

    if (isset($vars['content'])) {
        $vars['content'] = cms_render_string($vars['content'], $vars, $tpl_dir);
    }

    $env = cms_twig_env($tpl_dir);
    $html = $env->render(basename($path), $vars);

    $css_base = basename(cms_get_theme_css($theme));
    $css_path = $vars['CSS_PATH'];
    $html = preg_replace('~(?:\.\./)?' . preg_quote($css_base, '~') . '~i', $css_path, $html);
    $html = preg_replace_callback('/(src|href)=["\']([^"\']+)["\']/', function ($m) use ($vars) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ($ext === 'css') {
            $dir = 'css';
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if (!preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return $m[1].'="'.$vars['THEME_URL'].'/'.$path.'"';
    }, $html);

    if ($cache_enabled) {
        if (!is_dir(__DIR__.'/cache')) {
            mkdir(__DIR__.'/cache');
        }
        file_put_contents($cache_file, $html);
    }
    echo $html;
}
