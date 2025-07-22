<?php
require_once __DIR__.'/news.php';
require_once __DIR__.'/../includes/twig.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

function cms_init_output_buffer(): void
{
    static $started = false;
    if ($started) {
        return;
    }
    $started = true;
    if (cms_get_setting('gzip', '0') === '1' && extension_loaded('zlib')) {
        ob_start('ob_gzhandler');
    } else {
        ob_start();
    }
}

function cms_twig_cache_dir(): string
{
    return __DIR__.'/cache/twig';
}

function cms_clear_twig_cache(): void
{
    $dir = cms_twig_cache_dir();
    if (!is_dir($dir)) {
        return;
    }
    foreach (glob($dir.'/*') as $file) {
        @unlink($file);
    }
}

function cms_split_title(string $title): string
{
    $words = preg_split('/\s+/', trim($title));
    $wordCount = count($words);

    if ($wordCount === 1) {
        $len = strlen($words[0]);
        $half = (int)ceil($len / 2);
        $first = substr($words[0], 0, $half);
        $second = substr($words[0], $half);
    } elseif ($wordCount === 2) {
        $first = $words[0];
        $second = $words[1];
    } else {
        $firstCount = (int)ceil($wordCount / 3);
        $first = implode(' ', array_slice($words, 0, $firstCount));
        $second = implode(' ', array_slice($words, $firstCount));
    }

    $firstEsc = htmlspecialchars($first, ENT_QUOTES);
    $secondEsc = htmlspecialchars($second, ENT_QUOTES);

    return '<h2 id="page1">' . $firstEsc . '<em>' . $secondEsc . '</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt="">';
}

function cms_split_title_entry(string $name): string
{
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT title_content FROM custom_titles WHERE title_name=? LIMIT 1');
    $stmt->execute([$name]);
    $title = $stmt->fetchColumn();
    if ($title === false) {
        return '';
    }
    return cms_split_title((string)$title);
}

function cms_random_content(string $tag): string
{
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT content FROM random_content WHERE tag_name=?');
    $stmt->execute([$tag]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (!$rows) {
        return '';
    }
    return $rows[array_rand($rows)];
}

function cms_scheduled_content(string $tag): string
{
    $db  = cms_get_db();
    $stmt = $db->prepare('SELECT * FROM scheduled_content WHERE tag_name=? AND active=1');
    $stmt->execute([$tag]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $out  = '';
    $now  = new DateTime();
    foreach ($rows as $row) {
        $start = $row['start_date'] ? new DateTime($row['start_date']) : null;
        $end   = $row['end_date'] ? new DateTime($row['end_date']) : null;
        if ($start && $now < $start) {
            continue;
        }
        if ($end && $now > $end) {
            continue;
        }

        switch ($row['schedule_type']) {
            case 'every_n_days':
                $n = (int)($row['every_n_days'] ?? 0);
                if ($n <= 0) {
                    continue 2;
                }
                $base = $start ?: new DateTime($row['created_at']);
                $diff = $base->diff($now)->days;
                if ($diff % $n !== 0) {
                    continue 2;
                }
                break;
            case 'day_of_month':
                if ((int)$now->format('j') !== (int)$row['day_of_month']) {
                    continue 2;
                }
                break;
            case 'fixed_range':
                $s = $row['fixed_start_datetime'] ? new DateTime($row['fixed_start_datetime']) : null;
                $e = $row['fixed_end_datetime'] ? new DateTime($row['fixed_end_datetime']) : null;
                if (($s && $now < $s) || ($e && $now > $e)) {
                    continue 2;
                }
                break;
        }
        $out .= $row['content'];
    }
    return $out;
}

function cms_theme_layout(?string $file, ?string $theme = null)
{
    $theme = $theme ?: cms_get_setting('theme', '2004');
    $file  = $file ?: 'default.twig';
    $file  = preg_replace('/\.tpl$/', '.twig', $file);

    $dirs = ['layouts', 'layout'];
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__)."/themes/$theme/$dir/$file";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__)."/themes/$theme/$dir/default.twig";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__)."/themes/2004/$dir/$file";
        if (file_exists($path)) {
            return $path;
        }
    }
    return dirname(__DIR__)."/themes/2004/layout/default.twig";
}
function cms_twig_env(string $tpl_dir): Environment
{
    static $env;
    if (!$env) {
        $loader = new FilesystemLoader($tpl_dir);
        $cacheDir = cms_twig_cache_dir();
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }
        $env = new Environment($loader, ['cache' => $cacheDir, 'auto_reload' => true]);
        $env->addFunction(new TwigFunction('header', function(bool $withButtons = true) {
            $theme = cms_get_current_theme();
            return cms_render_header($theme, $withButtons);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('header_logo', function(string $path) {
            cms_set_header_logo_override($path);
            return '';
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('footer', function() {
            $theme = cms_get_current_theme();
            $html  = cms_get_theme_footer($theme);
            $html  = str_ireplace('{BASE}', '{{ BASE }}', $html);
            $env   = cms_twig_env('.');
            return $env->createTemplate($html)->render(['BASE' => cms_base_url()]);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('nav_buttons', function(string $theme = '', string $style = '', ?string $spacer = null) {
            $theme = $theme !== '' ? $theme : cms_get_current_theme();
            return cms_nav_buttons_html($theme, $style, $spacer);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('news', function(string $type, ?int $count = null) {
            $theme = cms_get_current_theme();
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

        $env->addFunction(new TwigFunction('split_title', function(string $title) {
            return cms_split_title($title);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('split_title_entry', function(string $name) {
            return cms_split_title_entry($name);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('categories_list', function() {
            $db = cms_get_db();
            $rows = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
            $out = '<div class="categories_list">';
            foreach ($rows as $row) {
                $id = (int)$row['id'];
                $name = htmlspecialchars($row['name']);
                $out .= '<a class="category_link" href="index.php?area=search&browse=1&category='.$id.'">'.$name.'</a><br/>';
            }
            $out .= '</div>';
            return $out;
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
            $theme = cms_get_current_theme();
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

        $env->addFunction(new TwigFunction('large_capsule_block', function(string $key = 'large') {
            $theme = cms_get_current_theme();
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
            return '<div class="large-capsule"><a href="'.$url.'"><img src="'.$img.'" alt=""></a><span class="price">$'.htmlspecialchars($price).'</span></div>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('store_sidebar', function () {
            $file  = $_SERVER['SCRIPT_NAME'] ?? '';
            $links = cms_load_store_links($file);
            $out   = '';
            foreach ($links as $ln) {
                if ($ln['type'] === 'spacer') {
                    $out .= '<div class="menu_spacer"></div>';
                    continue;
                }
                $label = htmlspecialchars($ln['label']);
                $url   = htmlspecialchars($ln['url']);
                if (!empty($ln['current'])) {
                    $out .= '<span><font face="Wingdings 3"><span class="menu_pointer">&#132;</span></font> '
                        .'<a class="menu_item_current" href="'.$url.'">'.$label.'</a></span><br/>';
                } else {
                    $out .= '<span><a class="menu_item" href="'.$url.'">'.$label.'</a></span><br/>';
                }
            }
            return $out;
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('featured_capsules', function () {
            $caps = [];
            foreach (cms_get_store_capsules() as $row) {
                $caps[$row['position']] = $row;
            }
            $base = cms_base_url();
            $html = '<div style="position: relative; width: 590px; height: 511px;">';
            if (!empty($caps['top'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['top']['appid'].'">'
                    .'<img src="images/capsules/'.$caps['top']['image'].'" '
                    .'style="position: absolute; left: 1px; top: 1px; width: 588px; height: 98px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="images/capsules/2006_08-August/horizontal_top_middle.png" '
                .'style="position: absolute; left: 0; top: 99px; width: 590px; height: 13px; border: 0;">';
            if (!empty($caps['middle'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['middle']['appid'].'">'
                    .'<img src="images/capsules/'.$caps['middle']['image'].'" '
                    .'style="position: absolute; left: 0; top: 112px; width: 589px; height: 228px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="images/capsules/2006_08-August/horizontal_bar_lower.png" '
                .'style="position: absolute; left: 0; top: 340px; width: 590px; height: 12px; border: 0;">';
            if (!empty($caps['bottom_left'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['bottom_left']['appid'].'">'
                    .'<img src="images/capsules/'.$caps['bottom_left']['image'].'" '
                    .'style="position: absolute; left: 0; top: 352px; width: 288px; height: 158px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="images/capsules/2006_08-August/btm_middle_bar.png" '
                .'style="position: absolute; left: 288px; top: 352px; width: 13px; height: 158px; border: 0;">';
            if (!empty($caps['bottom_right'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['bottom_right']['appid'].'">'
                    .'<img src="images/capsules/'.$caps['bottom_right']['image'].'" '
                    .'style="position: absolute; left: 301px; top: 352px; width: 289px; height: 158px; border: 0;" alt=""></a>';
            }
            $html .= '</div>';
            return $html;
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('gear_block', function() {
            return cms_get_setting('gear_block', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('free_block', function() {
            return cms_get_setting('free_block', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tabs_block', function() {
            $theme = cms_get_current_theme();
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
        $env->registerUndefinedFunctionCallback(function (string $name) {
            if (str_starts_with($name, 'random_')) {
                $tag = substr($name, 7);
                return new TwigFunction($name, function () use ($tag) {
                    return cms_random_content($tag);
                }, ['is_safe' => ['html']]);
            }
            if (str_starts_with($name, 'scheduled_')) {
                $tag = substr($name, 10);
                return new TwigFunction($name, function () use ($tag) {
                    return cms_scheduled_content($tag);
                }, ['is_safe' => ['html']]);
            }
            return false;
        });
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
    cms_init_output_buffer();
    $cache_enabled = cms_get_setting('enable_cache', '0') === '1';
    $cache_file = __DIR__.'/cache/'.md5($path).'.html';
    if ($cache_enabled && file_exists($cache_file)
        && filemtime($cache_file) >= filemtime($path)
        && filemtime($cache_file) >= cms_cache_version()) {
        readfile($cache_file);
        return;
    }

    $theme = cms_get_setting('theme', '2004');
    cms_set_current_theme($theme);
    $tpl_dir = dirname($path);
    $subdir = $vars['theme_subdir'] ?? '';
    $base_url = cms_base_url();

    $vars += [
        'CMS_ROOT'  => __DIR__,
        'THEME_DIR' => $tpl_dir,
        'THEME_URL' => ($base_url ? rtrim($base_url, '/'). '/' : '') . "themes/$theme" . ($subdir ? "/$subdir" : ''),
        'CSS_PATH'  => ($base_url ? rtrim($base_url, '/'). '/' : '') . "themes/$theme/" . ltrim(cms_get_theme_css($theme), '/'),
        'BASE'      => $base_url,
    ];

    if (isset($vars['content'])) {
        $vars['content'] = cms_render_string($vars['content'], $vars, $tpl_dir);
    }

    $env = cms_twig_env($tpl_dir);
    cms_set_current_template(basename($path));
    $html = $env->render(basename($path), $vars);

    $css_file = cms_get_theme_css($theme);
    $css_base = basename($css_file);
    $css_dir  = trim(dirname($css_file), '/');
    if ($css_dir === '.') {
        $css_dir = '';
    }
    $attrCache = [];
    $html = preg_replace_callback('/(src|href)=["\']([^"\']+)["\']/', function ($m) use ($vars, $css_dir, $base_url, $theme, &$attrCache) {
        $path = $m[2];
        if (isset($attrCache[$path])) {
            return $m[1].'="'.$attrCache[$path].'"';
        }
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            $attrCache[$path] = $path;
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            $attrCache[$path] = $path;
            return $m[1].'="'.$path.'"';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $assets, true)) {
            $attrCache[$path] = $path;
            return $m[0];
        }
        if ($ext === 'css') {
            if (str_starts_with($path, './')) {
                $path = ltrim(substr($path, 2), '/');
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                $attrCache[$m[2]] = $base.$path;
                return $m[1].'="'.$attrCache[$m[2]].'"';
            }
            $dir  = $css_dir;
            $file = basename($path);
            $new  = cms_rewrite_css_file($theme, ($dir ? $dir.'/' : '').$file, $vars['THEME_URL'], $base_url);
            $attrCache[$m[2]] = $new;
            return $m[1].'="'.$new.'"';
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        $attrCache[$m[2]] = $vars['THEME_URL'].'/'.$path;
        return $m[1].'="'.$attrCache[$m[2]].'"';
    }, $html);

    $urlCache = [];
    $html = preg_replace_callback('/url\((["\']?)([^"\)]*)\1\)/i', function ($m) use ($vars, $css_dir, $base_url, &$urlCache) {
        $path = $m[2];
        if (isset($urlCache[$path])) {
            return 'url('.$m[1].$urlCache[$path].$m[1].')';
        }
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            $urlCache[$path] = $path;
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            $urlCache[$path] = $path;
            return 'url('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $assets, true)) {
            $urlCache[$path] = $path;
            return $m[0];
        }
        if ($ext === 'css') {
            if (str_starts_with($path, './')) {
                $path = ltrim(substr($path, 2), '/');
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                $urlCache[$m[2]] = $base.$path;
                return 'url('.$m[1].$urlCache[$m[2]].$m[1].')';
            }
            $dir  = $css_dir;
            $path = basename($path);
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        $urlCache[$m[2]] = $vars['THEME_URL'].'/'.$path;
        return 'url('.$m[1].$urlCache[$m[2]].$m[1].')';
    }, $html);

    $imgCache = [];
    $html = preg_replace_callback('/newImage\((["\'])([^"\']+)\1\)/i', function ($m) use ($vars, &$imgCache) {
        $path = $m[2];
        if (isset($imgCache[$path])) {
            return 'newImage('.$m[1].$imgCache[$path].$m[1].')';
        }
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            $imgCache[$path] = $path;
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            $imgCache[$path] = $path;
            return 'newImage('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $images = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $images, true)) {
            $imgCache[$path] = $path;
            return $m[0];
        }
        $path = ltrim($path, './');
        $path = preg_replace('~^(?:img|images)/~', '', $path);
        $imgCache[$m[2]] = $vars['THEME_URL'].'/images/'.$path;
        return 'newImage('.$m[1].$imgCache[$m[2]].$m[1].')';
    }, $html);


    if ($cache_enabled) {
        if (!is_dir(__DIR__.'/cache')) {
            mkdir(__DIR__.'/cache');
        }
        file_put_contents($cache_file, $html);
    }
    echo $html;
}

function cms_render_template_theme(string $path, string $theme, array $vars = []): void
{
    cms_init_output_buffer();
    cms_set_current_theme($theme);
    $tpl_dir = dirname($path);
    $subdir   = $vars['theme_subdir'] ?? '';
    $base_url = cms_base_url();

    $vars += [
        'CMS_ROOT'  => __DIR__,
        'THEME_DIR' => $tpl_dir,
        'THEME_URL' => ($base_url ? rtrim($base_url, '/'). '/' : '') . "themes/$theme" . ($subdir ? "/$subdir" : ''),
        'CSS_PATH'  => ($base_url ? rtrim($base_url, '/'). '/' : '') . "themes/$theme/" . ltrim(cms_get_theme_css($theme), '/'),
        'BASE'      => $base_url,
    ];

    if (isset($vars['content'])) {
        $vars['content'] = cms_render_string($vars['content'], $vars, $tpl_dir);
    }

    $env = cms_twig_env($tpl_dir);
    cms_set_current_template(basename($path));
    $html = $env->render(basename($path), $vars);

    $css_file = cms_get_theme_css($theme);
    $css_base = basename($css_file);
    $css_dir  = trim(dirname($css_file), '/');
    if ($css_dir === '.') {
        $css_dir = '';
    }
    $html = preg_replace_callback('/(src|href)=["\']([^"\']+)["\']/', function ($m) use ($vars, $css_dir, $base_url, $theme) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return $m[1].'="'.$path.'"';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $assets, true)) {
            return $m[0];
        }
        if ($ext === 'css') {
            if (str_starts_with($path, './')) {
                $path = ltrim(substr($path, 2), '/');
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return $m[1].'="'.$base.$path.'"';
            }
            $dir  = $css_dir;
            $path = basename($path);
            $path = cms_rewrite_css_file($theme, ($dir ? $dir.'/' : '').$path, $vars['THEME_URL'], $base_url);
            return $m[1].'="'.$path.'"';
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return $m[1].'="'.$vars['THEME_URL'].'/'.$path.'"';
    }, $html);

    $html = preg_replace_callback('/url\((["\']?)([^"\)]*)\1\)/i', function ($m) use ($vars, $css_dir, $base_url) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return 'url('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $assets, true)) {
            return $m[0];
        }
        if ($ext === 'css') {
            if (str_starts_with($path, './')) {
                $path = ltrim(substr($path, 2), '/');
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return 'url('.$m[1].$base.$path.$m[1].')';
            }
            $dir  = $css_dir;
            $path = basename($path);
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return 'url('.$m[1].$vars['THEME_URL'].'/'.$path.$m[1].')';
    }, $html);

    $imgCache = [];
    $html = preg_replace_callback('/newImage\((["\'])([^"\']+)\1\)/i', function ($m) use ($vars, &$imgCache) {
        $path = $m[2];
        if (isset($imgCache[$path])) {
            return 'newImage('.$m[1].$imgCache[$path].$m[1].')';
        }
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            $imgCache[$path] = $path;
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            $imgCache[$path] = $path;
            return 'newImage('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $images = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $images, true)) {
            $imgCache[$path] = $path;
            return $m[0];
        }
        $path = ltrim($path, './');
        $path = preg_replace('~^(?:img|images)/~', '', $path);
        $imgCache[$m[2]] = $vars['THEME_URL'].'/images/'.$path;
        return 'newImage('.$m[1].$imgCache[$m[2]].$m[1].')';
    }, $html);

    echo $html;
}

function cms_rewrite_css_urls(string $css, string $theme_url, string $css_dir, string $base_url): string
{
    return preg_replace_callback('/url\((["\']?)([^"\)]*)\1\)/i', function ($m) use ($theme_url, $css_dir, $base_url) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return 'url('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $assets, true)) {
            return $m[0];
        }
        if ($ext === 'css') {
            if (str_starts_with($path, './')) {
                $path = ltrim(substr($path, 2), '/');
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return 'url('.$m[1].$base.$path.$m[1].')';
            }
            $dir  = $css_dir;
            $path = basename($path);
        } elseif ($ext === 'js') {
            $dir = 'js';
        } else {
            $dir = 'images';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return 'url('.$m[1].$theme_url.'/'.$path.$m[1].')';
    }, $css);
}

function cms_rewrite_css_file(string $theme, string $css_path, string $theme_url, string $base_url): string
{
    $full = dirname(__DIR__)."/themes/$theme/".ltrim($css_path, '/');
    if (!file_exists($full)) {
        return $theme_url.'/'.ltrim($css_path, '/');
    }
    $hash = md5($full.filemtime($full));
    $cache_dir = __DIR__.'/cache';
    $cached = $cache_dir.'/'.$hash.'.css';
    if (!file_exists($cached)) {
        $css = file_get_contents($full);
        $css_dir = trim(dirname($css_path), '/');
        if ($css_dir === '.') {
            $css_dir = '';
        }
        $css = cms_rewrite_css_urls($css, $theme_url, $css_dir, $base_url);
        if (!is_dir($cache_dir)) {
            mkdir($cache_dir);
        }
        file_put_contents($cached, $css);
    }
    return ($base_url ? rtrim($base_url, '/'). '/' : '').'cms/cache/'.basename($cached);
}
