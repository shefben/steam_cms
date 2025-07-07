<?php
require_once __DIR__.'/news.php';
require_once __DIR__.'/../includes/twig.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

function cms_theme_layout(?string $file, ?string $theme = null)
{
    $theme = $theme ?: cms_get_setting('theme', '2004');
    $file  = $file ?: 'default.twig';
    $file  = preg_replace('/\.tpl$/', '.twig', $file);

    $base = dirname(__DIR__)."/themes/$theme/layout/$file";
    if (!file_exists($base)) {
        $base = dirname(__DIR__)."/themes/$theme/layout/default.twig";
    }
    if (!file_exists($base)) {
        $base = dirname(__DIR__)."/themes/2004/layout/$file";
    }
    if (!file_exists($base)) {
        $base = dirname(__DIR__)."/themes/2004/layout/default.twig";
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
            $cfg   = cms_get_theme_config($theme);
            $count = $count ?? ($cfg['news_count'] ?? null);
            return cms_render_news($type, $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_index_brief', function(int $count = 3) {
            return cms_render_news('index_brief', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_index_bodygreen', function(int $count = 5) {
            return cms_render_news('index_bodygreen', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_index_2006', function(int $count = 5) {
            return cms_render_news('index_2006', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('join_steam_text', function() {
            return cms_get_setting('join_steam_text', 'Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('join_steam_block', function(string $style = '2006') {
            $text = cms_get_setting('join_steam_text', 'Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.');
            if ($style === '2007') {
                return '<table class="capsuleArea_header" height="73" width="574"><tr><td height="73" valign="middle" width="250"><div class="btn_getSteam_slvr" onclick="location.href=\'index.php?area=getsteamnow\'">Get Steam Now !</div></td><td height="73" valign="top"><p>'.$text.'</p></td></tr></table>';
            }
            return '<table class="capsuleArea_header" width="560"><tr><td width="172"><img src="img/logo_steam_main.jpg" width="172" height="63" alt=""></td><td valign="top"><p>'.$text.'</p></td></tr></table>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('new_on_steam_title', function() {
            return cms_get_setting('new_on_steam_title', 'New On Steam');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('latest_news_title', function() {
            return cms_get_setting('latest_news_title', 'Latest News');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('find_title', function() {
            return cms_get_setting('find_title', 'Find');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('browse_catalog_title', function() {
            return cms_get_setting('browse_catalog_title', 'Browse The Catalog');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('new_on_steam_list', function() {
            return cms_get_setting('new_on_steam_list', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('latest_news_list', function() {
            return cms_get_setting('latest_news_list', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('find_list', function() {
            return cms_get_setting('find_list', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('publisher_catalogs_title', function() {
            return cms_get_setting('publisher_catalogs_title', 'Publisher Catalogs');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('publisher_catalogs_list', function() {
            return cms_get_setting('publisher_catalogs_list', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('coming_soon_title', function() {
            return cms_get_setting('coming_soon_title', 'Coming Soon To Steam');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('coming_soon_list', function() {
            return cms_get_setting('coming_soon_list', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('capsule_block', function(string $key) {
            $theme = cms_get_setting('theme', '2006_v1');
            $useAll = cms_get_setting('capsules_same_all', '1') === '1';
            $db = cms_get_db();
            if ($useAll) {
                $stmt = $db->prepare('SELECT * FROM storefront_capsules_all WHERE position=?');
                $stmt->execute([$key]);
            } else {
                $stmt = $db->prepare('SELECT * FROM storefront_capsules_per_theme WHERE theme=? AND position=?');
                $stmt->execute([$theme, $key]);
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){ return ''; }
            $img = 'images/capsules/'.$row['image_path'];
            $url = 'index.php?area=app&id='.(int)$row['appid'];
            $price = $row['price'];
            return '<a href="'.$url.'"><img src="'.$img.'" alt=""></a><span class="price">$'.htmlspecialchars($price).'</span>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('gear_block', function() {
            return cms_get_setting('gear_block', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('free_block', function() {
            return cms_get_setting('free_block', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tabs_block', function() {
            $theme = cms_get_setting('theme', '2004');
            if ($theme !== '2007_v2') {
                return cms_get_setting('tabs_block', '');
            }
            $db = cms_get_db();
            $stmt = $db->prepare('SELECT * FROM storefront_tabs WHERE theme=? ORDER BY ord,id');
            $stmt->execute([$theme]);
            $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$tabs) { return ''; }
            $html = '<div class="tabs-block"><ul class="tab-links">';
            $content = '';
            foreach ($tabs as $i => $tab) {
                $active = $i === 0 ? ' class="active"' : '';
                $html .= '<li'.$active.'><a href="#tab_'.$tab['id'].'">'.htmlspecialchars($tab['title']).'</a></li>';
                $g = $db->prepare('SELECT g.appid,a.name,a.price FROM storefront_tab_games g JOIN store_apps a ON g.appid=a.appid WHERE g.tab_id=? ORDER BY g.ord');
                $g->execute([$tab['id']]);
                $content .= '<div id="tab_'.$tab['id'].'" class="tab-panel" style="display:'.($i? 'none':'block').'"><ul>';
                foreach ($g as $row) {
                    $url = 'index.php?area=app&id='.(int)$row['appid'];
                    $price = $row['price'];
                    $content .= '<li><a href="'.$url.'">'.htmlspecialchars($row['name']).'</a> - $'.htmlspecialchars($price).'</li>';
                }
                $content .= '</ul></div>';
            }
            $html .= '</ul>'.$content.'</div>';
            $html .= "<script>document.querySelectorAll('.tabs-block .tab-links a').forEach(function(a){a.addEventListener('click',function(e){e.preventDefault();var id=this.getAttribute('href');this.parentElement.parentElement.querySelectorAll('li').forEach(function(li){li.classList.remove('active');});this.parentElement.classList.add('active');var block=this.closest('.tabs-block');block.querySelectorAll('.tab-panel').forEach(function(p){p.style.display=p.id==id.substring(1)?'block':'none';});});});</script>";
            return $html;
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

    $theme_dir = dirname(__DIR__)."/themes/$theme";
    if (is_dir($theme_dir.'/css')) {
        $add = '';
        foreach (glob($theme_dir.'/css/*.css') as $css) {
            $name = basename($css);
            if (stripos($html, $name) === false) {
                $add .= '<link rel="stylesheet" type="text/css" href="'.$vars['THEME_URL'].'/css/'.$name.'">' . "\n";
            }
        }
        if ($add !== '') {
            if (stripos($html, '</head>') !== false) {
                $html = preg_replace('/<\/head>/i', $add.'</head>', $html, 1);
            } else {
                $html = $add.$html;
            }
        }
    }

    if (is_dir($theme_dir.'/js')) {
        $add = '';
        foreach (glob($theme_dir.'/js/*.js') as $js) {
            $name = basename($js);
            if (stripos($html, $name) === false) {
                $add .= '<script src="'.$vars['THEME_URL'].'/js/'.$name.'"></script>' . "\n";
            }
        }
        if ($add !== '') {
            if (stripos($html, '</body>') !== false) {
                $html = preg_replace('/<\/body>/i', $add.'</body>', $html, 1);
            } else {
                $html .= $add;
            }
        }
    }

    if ($cache_enabled) {
        if (!is_dir(__DIR__.'/cache')) {
            mkdir(__DIR__.'/cache');
        }
        file_put_contents($cache_file, $html);
    }
    echo $html;
}
