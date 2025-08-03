<?php
require_once __DIR__.'/news.php';
require_once __DIR__.'/../includes/twig.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

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
    $stmt = $db->prepare('SELECT c.content FROM random_content c JOIN random_groups g ON c.group_id = g.id WHERE g.name=?');
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

    $dirs     = ['layouts', 'layout'];
    $subdirs  = ['', 'storefront'];

    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/$theme/".($sub ? "$sub/" : '')."$dir/$file";
            if (file_exists($path)) {
                return $path;
            }
        }
    }
    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/$theme/".($sub ? "$sub/" : '')."$dir/default.twig";
            if (file_exists($path)) {
                return $path;
            }
        }
    }
    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/2004/".($sub ? "$sub/" : '')."$dir/$file";
            if (file_exists($path)) {
                return $path;
            }
        }
    }
    return dirname(__DIR__)."/themes/2004/layout/default.twig";
}

function cms_render_tabbed_games_column(array $games): string
{
    $html = '';
    foreach ($games as $row) {
        $appid = (int)$row['appid'];
        $url   = 'index.php?area=game&amp;AppId=' . $appid . '&amp;';
        $img   = 'gfx/apps/' . $appid . '/capsule_sm_120.jpg';
        $name  = htmlspecialchars($row['name'] ?? '', ENT_QUOTES);
        $price = number_format((float)($row['price'] ?? 0), 2);
        $html .= '<div class="listArea_game" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'listArea_game\';" onmouseover="this.className=\'listArea_game_ovr\';">'
            . '<div class="listArea_gameImage"><img alt="' . $name . '" border="0" height="45" src="' . $img . '" width="120"></div>'
            . '<div class="listArea_gameTitle">' . $name . '</div><br>'
            . '<div class="listArea_gamePrice">$' . $price . '</div>'
            . '</div>';
    }
    return $html;
}

function cms_render_tabs(string $theme): string
{
    $db = cms_get_db();
    $stmt = $db->prepare('SELECT id,title FROM storefront_tabs WHERE theme=? ORDER BY ord');
    $stmt->execute([$theme]);
    $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$tabs) {
        return '';
    }
    $html = '<div class="listArea"><br clear="all">';
    foreach ($tabs as $i => $tab) {
        $id    = $i + 1;
        $focus = $i === 0;
        $class = $focus ? 'listArea_tab_focus' : 'listArea_tab';
        $l = $focus ? 'listArea_tab_focus_l.gif' : 'listArea_tab_l.gif';
        $r = $focus ? 'listArea_tab_focus_r.gif' : 'listArea_tab_r.gif';
        $html .= '<div class="' . $class . '" id="tab_' . $id . '">'
            . '<img align="absmiddle" id="tab_' . $id . '_image_l" src="img/home/' . $l . '"><span class="listArea_tab_txt">' . htmlspecialchars($tab['title']) . '</span><img align="absmiddle" id="tab_' . $id . '_image_r" src="img/home/' . $r . '">'
            . '</div>';
    }
    $html .= '<br clear="left"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td height="6"><img height="6" src="img/_spacer.gif" width="6"></td><td align="right" height="6"><img height="6" src="img/home/listArea_tr.gif" width="6"></td></tr>';
    foreach ($tabs as $i => $tab) {
        $display = $i === 0 ? '' : ' style="display: none;"';
        $html .= '<tr id="tab_' . ($i + 1) . '_content"' . $display . '><td valign="top">';
        $g = $db->prepare('SELECT a.appid,a.name,a.price FROM storefront_tab_games g JOIN store_apps a ON g.appid=a.appid WHERE g.tab_id=? ORDER BY g.ord');
        $g->execute([$tab['id']]);
        $games = $g->fetchAll(PDO::FETCH_ASSOC);
        $half = (int)ceil(count($games) / 2);
        $html .= cms_render_tabbed_games_column(array_slice($games, 0, $half));
        $html .= '</td><td valign="top">';
        $html .= cms_render_tabbed_games_column(array_slice($games, $half));
        $html .= '</td></tr>';
    }
    $html .= '<tr><td height="6"><img height="6" src="img/home/listArea_bl.gif" width="6"></td><td align="right" height="6"><img height="6" src="img/home/listArea_br.gif" width="6"></td></tr></tbody></table></div>';
    $html .= "<script type=\"text/javascript\">document.querySelectorAll('.listArea_tab, .listArea_tab_focus').forEach(function(tab,idx){tab.addEventListener('click',function(){document.querySelectorAll('.listArea_tab_focus,.listArea_tab').forEach(function(t,i){var focus=i===idx;t.className=focus?'listArea_tab_focus':'listArea_tab';document.getElementById('tab_'+(i+1)+'_content').style.display=focus?'':'none';document.getElementById('tab_'+(i+1)+'_image_l').src='img/home/'+(focus?'listArea_tab_focus_l.gif':'listArea_tab_l.gif');document.getElementById('tab_'+(i+1)+'_image_r').src='img/home/'+(focus?'listArea_tab_focus_r.gif':'listArea_tab_r.gif');});});});</script>";
    return $html;
}
function cms_twig_env(string $tpl_dir): Environment
{
    static $env;
    if (!$env) {
        $loader = new FilesystemLoader($tpl_dir);
        $cacheDir = __DIR__ . '/cache/twig';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }
        $env = new Environment($loader, ['cache' => $cacheDir]);
        $env->addFunction(new TwigFunction('header', function(bool $withButtons = true) {
            $theme = cms_get_current_theme();
            return cms_render_header($theme, $withButtons);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('header_logo', function(string $path) {
            cms_set_header_logo_override($path);
            return '';
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('logo', function() {
            $theme = cms_get_current_theme();
            $data  = cms_get_theme_header_data($theme);
            $logo  = $data['logo'] ?: '/img/steam_logo_onblack.gif';
            $base  = cms_base_url();
            $logo  = str_ireplace('{BASE}', $base, $logo);
            if ($logo && $logo[0] == '/') {
                $logo = $base . $logo;
            }
            return '<img src="'.htmlspecialchars($logo).'" alt="logo">';
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('footer', function() {
            $theme = cms_get_current_theme();
            $html  = cms_get_theme_footer($theme);
            $html  = str_ireplace('{BASE}', '{{ BASE }}', $html);
            $env   = cms_twig_env('.');
            return $env->createTemplate($html)->render(['BASE' => cms_base_url()]);
        }, ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('nav_buttons', function(string $theme = '', string $style = '', ?string $spacer = null, ?string $color = null) {
            $theme = $theme !== '' ? $theme : cms_get_current_theme();
            return cms_nav_buttons_html($theme, $style, $spacer, $color);
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

        $env->addFunction(new TwigFunction('browse_catalog_list', function() {
            return cms_get_setting('browse_catalog_list', '');
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

        $env->addFunction(new TwigFunction('support_email', function() {
            return cms_get_setting('supportemail', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('split_title', function(string $title) {
            return cms_split_title($title);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('split_title_entry', function(string $name) {
            return cms_split_title_entry($name);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sitetitle', function() {
            $slug  = cms_get_current_page();
            $theme = cms_get_current_theme();
            $page  = cms_get_custom_page($slug, $theme);
            if($page && !empty($page['page_name'])){
                require_once __DIR__.'/utilities/text_styler.php';
                return render0203PageTitle($page['page_name']);
            }
            return '';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('2002_page_title', function() {
            $slug  = cms_get_current_page();
            $theme = cms_get_current_theme();
            $page  = cms_get_custom_page($slug, $theme);
            if ($page && !empty($page['page_name'])) {
                require_once __DIR__.'/utilities/text_styler.php';
                return render2002Title([[18, $page['page_name']]]);
            }
            return '';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('current_theme', function() {
            return cms_get_current_theme();
        }));

        $env->addFunction(new TwigFunction('current_page', function() {
            return cms_get_current_page();
        }));

        $env->addFunction(new TwigFunction('theme_specific_content_start', function(string $themes) {
            $list = array_filter(array_map('trim', explode(',', $themes)));
            if (!isset($GLOBALS['_cms_theme_specific_stack'])) {
                $GLOBALS['_cms_theme_specific_stack'] = [];
            }
            $GLOBALS['_cms_theme_specific_stack'][] = $list;
            ob_start();
            return '';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('theme_specific_content_end', function() {
            $content = ob_get_clean();
            $list = $GLOBALS['_cms_theme_specific_stack'] ? array_pop($GLOBALS['_cms_theme_specific_stack']) : [];
            $current = cms_get_current_theme();
            if ($list && in_array($current, $list, true)) {
                return $content;
            }
            return '';
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
            $base = cms_base_url();
            $base = $base ? rtrim($base, '/'). '/' : '';
            $img = $base.'storefront/images/capsules/'.$row['image_path'];
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
            $base = cms_base_url();
            $base = $base ? rtrim($base, '/'). '/' : '';
            $img = $base.'storefront/images/capsules/'.$row['image_path'];
            $url = 'index.php?area=app&id='.(int)$row['appid'];
            $price = $row['price'];
            return '<div class="large-capsule"><a href="'.$url.'"><img src="'.$img.'" alt=""></a><span class="price">$'.htmlspecialchars($price).'</span></div>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('store_sidebar', function () {
            $file  = $_SERVER['SCRIPT_NAME'] ?? '';
            $links = cms_load_store_links($file);
            $out   = '';
            $base = cms_base_url();
            foreach ($links as $ln) {
                if ($ln['type'] === 'spacer') {
                    $out .= '<div class="menu_spacer"></div>';
                    continue;
                }
                $label = htmlspecialchars($ln['label']);
                $url   = $ln['url'];
                if (str_starts_with($url, '/')) {
                    $url = ($base ? rtrim($base, '/') : '') . $url;
                }
                $url = htmlspecialchars($url);
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
            $db = cms_get_db();
            $caps = [];
            foreach ($db->query('SELECT position,appid,image FROM store_capsules') as $row) {
                $caps[$row['position']] = $row;
            }
            $base = cms_base_url();
            $baseUrl = $base ? rtrim($base, '/'). '/' : '';
            $html = '<div style="position: relative; width: 590px; height: 511px;">';
            if (!empty($caps['top'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['top']['appid'].'">'
                    .'<img src="'.$baseUrl.'storefront/images/capsules/'.$caps['top']['image'].'" '
                    .'style="position: absolute; left: 1px; top: 1px; width: 588px; height: 98px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="'.$baseUrl.'storefront/images/capsules/2006_08-August/horizontal_top_middle.png" '
                .'style="position: absolute; left: 0; top: 99px; width: 590px; height: 13px; border: 0;">';
            if (!empty($caps['middle'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['middle']['appid'].'">'
                    .'<img src="'.$baseUrl.'storefront/images/capsules/'.$caps['middle']['image'].'" '
                    .'style="position: absolute; left: 0; top: 112px; width: 589px; height: 228px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="'.$baseUrl.'storefront/images/capsules/2006_08-August/horizontal_bar_lower.png" '
                .'style="position: absolute; left: 0; top: 340px; width: 590px; height: 12px; border: 0;">';
            if (!empty($caps['bottom_left'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['bottom_left']['appid'].'">'
                    .'<img src="'.$baseUrl.'storefront/images/capsules/'.$caps['bottom_left']['image'].'" '
                    .'style="position: absolute; left: 0; top: 352px; width: 288px; height: 158px; border: 0;" alt=""></a>';
            }
            $html .= '<img src="'.$baseUrl.'storefront/images/capsules/2006_08-August/btm_middle_bar.png" '
                .'style="position: absolute; left: 288px; top: 352px; width: 13px; height: 158px; border: 0;">';
            if (!empty($caps['bottom_right'])) {
                $html .= '<a href="'.$base.'/index.php?area=game&AppId='.(int)$caps['bottom_right']['appid'].'">'
                    .'<img src="'.$baseUrl.'storefront/images/capsules/'.$caps['bottom_right']['image'].'" '
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

        $env->addFunction(new TwigFunction('storefront_capsules', function () {
            $theme = cms_get_current_theme();
            $useAll = cms_get_setting('capsules_same_all', '1') === '1';
            $db = cms_get_db();
            if ($useAll) {
                $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsule_items c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme IS NULL ORDER BY ord');
                $stmt->execute();
            } else {
                $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsule_items c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme=? ORDER BY ord');
                $stmt->execute([$theme]);
            }
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $base = cms_base_url();
            $base = $base ? rtrim($base, '/') . '/' : '';
            $html = '';
            $open = false;
            $count = 0;
            $is2006 = in_array($theme, ['2006_v1', '2006_v2'], true);
            $is2007 = in_array($theme, ['2007_v1', '2007_v2'], true);
            foreach ($rows as $row) {
                $priceVal = $row['price'] !== null ? (float)$row['price'] : (float)$row['app_price'];
                $price = number_format($priceVal, 2);
                $name = htmlspecialchars($row['app_name'] ?? '', ENT_QUOTES);
                switch ($row['type']) {
                    case 'small':
                        if (!$open) {
                            $html .= '<div class="capsuleGroup">';
                            $open = true;
                            $count = 0;
                        }
                        if ($is2006) {
                            $imgPath = $row['image_path'];
                            if (!str_starts_with($imgPath, 'gfx/')) {
                                $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                            }
                            $img = $imgPath;
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);">'
                                . '<div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"></div>'
                                . '<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>';
                        } elseif ($is2007) {
                            $imgPath = $row['image_path'];
                            if (!str_starts_with($imgPath, 'gfx/')) {
                                $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                            }
                            $img = $imgPath;
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsule\'; window.status=\'\';" onmouseover="this.className=\'capsule_ovr\'; window.status=\'' . $url . '\';">'
                                . '<div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"><div style="position: absolute; width: 280px; height: 105px; top: 0px; left: 0px;"><img src="img/corners/smallcap_corners.png" width="280" height="105" border="0"></div></div>'
                                . '<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '</div></div>';
                        } else {
                            $img = $base . 'storefront/images/capsules/' . $row['image_path'];
                            $url = 'index.php?area=app&id=' . (int)$row['appid'];
                            $html .= '<div class="capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div>';
                        }
                        $count++;
                        if ($count === 2) {
                            $html .= '<br clear="all"></div>';
                            $open = false;
                        }
                        break;
                    case 'large':
                        if ($open) {
                            $html .= '<br clear="all"></div>';
                            $open = false;
                        }
                        if ($is2006) {
                            $imgPath = $row['image_path'];
                            if (!str_starts_with($imgPath, 'gfx/')) {
                                $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                            }
                            $img = $imgPath;
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);">'
                                . '<div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"></div>'
                                . '<div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>'
                                . '<br clear="all">';
                        } elseif ($is2007) {
                            $imgPath = $row['image_path'];
                            if (!str_starts_with($imgPath, 'gfx/')) {
                                $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                            }
                            $img = $imgPath;
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="inline" id="capsule_large"><br clear="all"><div class="capsule_large_area"><div id="capsule_large_content">'
                                . '<div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsuleLarge\'; window.status=\'\';" onmouseover="this.className=\'capsuleLarge_ovr\'; window.status=\'' . $url . '\';">'
                                . '<div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"><div style="position: absolute; width: 572px; height: 221px; top: 0px; left: 0px;"><img src="img/corners/largecap_corners.png" width="572" height="221" border="0"></div></div>'
                                . '<div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '</div></div>'
                                . '</div></div></div>'
                                . '<script type="text/javascript">var so=new SWFObject("swf/capsule_lg.swf","movie","578","255","8","#282828");so.addVariable("img1","' . (int)$row['appid'] . '");so.addVariable("txt1","' . addslashes($name) . '");so.addVariable("price1","&#36;' . htmlspecialchars($price) . '");so.addVariable("type1","apps");so.write("capsule_large_content");</script>';
                        } else {
                            $img = $base . 'storefront/images/capsules/' . $row['image_path'];
                            $url = 'index.php?area=app&id=' . (int)$row['appid'];
                            $html .= '<div class="capsuleLarge"><div class="large-capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div><br clear="all"></div>';
                        }
                        break;
                    case 'gear':
                        if ($open) {
                            $html .= '<br clear="all"></div>';
                            $open = false;
                        }
                        if ($is2006) {
                            $html .= '<div align="center" class="capsuleGear"><div class="capsuleGearTitle">Get The Gear!</div><div class="capsuleGearText">Check out the new Logitech® MOMO® Racing wheel! Visit the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> for official shirts, posters, hats and more!</div></div>';
                        } elseif ($is2007) {
                            $html .= '<div align="center" class="Gear"><div class="GearTitle">Get The Gear!</div><div class="GearText">Get your hands on the brand-new Half-Life® 2: Episode Two poster at the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> now!!! Also featuring official shirts, posters, hats and more!</div></div>';
                        } else {
                            $html .= cms_get_setting('gear_block', '');
                        }
                        break;
                    case 'free':
                        if ($open) {
                            $html .= '<br clear="all"></div>';
                            $open = false;
                        }
                        if ($is2006) {
                            $html .= '<div align="center" class="capsuleStuff"><div class="capsuleStuffTitle">Free Stuff!</div><div class="capsuleStuffText">In addition to a catalog of great games, your free Steam account gives you access to <a href="http://storefront.steampowered.com/v/index.php?area=search&amp;browse=1&amp;category=&amp;price=1&amp;">games + demos</a>, <a href="http://storefront.steampowered.com/v/index.php?area=media&amp;">HD movies + trailers</a>, and more.</div></div>';
                        } elseif ($is2007) {
                            $html .= '<div align="center" class="Stuff"><div class="StuffTitle">Free Stuff!</div><div class="StuffText">In addition to a catalog of great games, your free Steam account gives you access to game <a href="v/index.php?area=free&amp;tab=demos&amp;">demos</a>, <a href="v/index.php?area=free&amp;tab=mods&amp;">mods</a>, <a href="v/index.php?area=free&amp;tab=videos&amp;">trailers</a> and more. Browse our <a href="v/index.php?area=free&amp;">Free Stuff</a> page for more details.</div></div>';
                        } else {
                            $html .= cms_get_setting('free_block', '');
                        }
                        break;
                    case 'tabbed':
                        if ($open) {
                            $html .= '<br clear="all"></div>';
                            $open = false;
                        }
                        $html .= cms_render_tabs($theme);
                        break;
                }
            }
            if ($open) {
                $html .= '<br clear="all"></div>';
            }
            return $html;
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tabs_block', function() {
            $theme = cms_get_current_theme();
            if (str_starts_with($theme, '2007')) {
                return cms_render_tabs($theme);
            }
            return cms_get_setting('tabs_block', '');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('platform_update_news', function () {
            $appid = $GLOBALS['platform_update_appid'] ?? 0;
            if (!$appid) { return ''; }
            $db = cms_get_db();
            $stmt = $db->prepare('SELECT date,title,content FROM platform_update_history WHERE appid=? ORDER BY date DESC');
            $stmt->execute([$appid]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $out = '';
            $i = 1;
            foreach ($rows as $row) {
                $date = date('F j, Y', strtotime($row['date']));
                $title = htmlspecialchars($row['title'] ?? '');
                $content = $row['content'] ?? '';
                $open = $i === 1;
                $button = $open ? '[-]' : '[+]';
                $display = $open ? '' : 'none';
                $out .= '<div class="post_header" onclick="togglePost('.$i.')">'
                    .'<div id="button_'.$i.'" class="post_pmbutton">'.$button.'</div>'
                    .'<div class="post_date">'.$date.' - <strong class="post_title">'.$title.'</strong></div>'
                    .'<br clear="all" />'
                    .'</div>'
                    .'<div class="post_content" id="content_'.$i.'" style="display: '.$display.';">'
                    .$content
                    .'<br clear="left" />'
                    .'</div>';
                $i++;
            }
            return $out;
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tournament_calendar', function(int $months = 4) {
            $db = cms_get_db();
            $start = new DateTime('first day of this month');
            $end = (clone $start)->modify('+' . $months . ' months');
            $stmt = $db->prepare('SELECT event_date,title FROM tournaments WHERE event_date >= ? AND event_date < ?');
            $stmt->execute([$start->format('Y-m-d'), $end->format('Y-m-d')]);
            $events = [];
            foreach ($stmt as $row) {
                $events[$row['event_date']][] = $row['title'];
            }
            $html = '<table align="center" cellspacing="0" cellpadding="0"><tr><td>';
            for ($m = 0; $m < $months; $m++) {
                $month = (clone $start)->modify('+' . $m . ' months');
                $days = (int)$month->format('t');
                $html .= '<b>'.$month->format('F Y').'</b><br><span style="font-family: courier new;">';
                $firstDow = (int)$month->format('w');
                for ($i=0;$i<$firstDow;$i++) {
                    $html .= '<span style="border: 1px solid #282E22;" title="">&nbsp;&nbsp;</span>&nbsp;';
                }
                for ($d=1;$d<=$days;$d++) {
                    $date = $month->format('Y-m-') . str_pad((string)$d,2,'0',STR_PAD_LEFT);
                    $dow = ($firstDow + $d -1) % 7;
                    if (isset($events[$date])) {
                        $count = count($events[$date]);
                        $title = $count.' event'.($count>1?'s':'').' is running today';
                        $html .= '<a href="index.php?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="'.htmlspecialchars($title).'">'.($d<10?'&nbsp;'.$d:$d).'</span></a>';
                    } else {
                        $html .= '<span style="border: 1px solid #282E22;;">'.($d<10?'&nbsp;'.$d:$d).'</span>';
                    }
                    $html .= ($dow===6)?' <br>':' ';
                }
                $html .= '</span><br><br>';
            }
            $html .= '</td></tr></table>';
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
    $cache_enabled = cms_get_setting('enable_cache', '0') === '1';
    $cache_file = __DIR__.'/cache/'.md5($path).'.html';
    if ($cache_enabled && file_exists($cache_file) && filemtime($cache_file) >= filemtime($path)) {
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
            $clean = ltrim($path, './');
            if (str_starts_with($clean, 'storefront/')) {
                $clean = substr($clean, 11);
            }
            if (str_starts_with($clean, 'images/')) {
                $clean = substr($clean, 7);
            }
            if (str_starts_with($clean, 'capsules/')) {
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return $m[1].'="'.$base.'storefront/images/'.$clean.'"';
            }
            $path = preg_replace('~^(?:img|images)/~', '', $clean);
            $path = preg_replace('~^storefront/~', '', $path);
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
            $clean = ltrim($path, './');
            if (str_starts_with($clean, 'storefront/')) {
                $clean = substr($clean, 11);
            }
            if (str_starts_with($clean, 'images/')) {
                $clean = substr($clean, 7);
            }
            if (str_starts_with($clean, 'capsules/')) {
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return 'url('.$m[1].$base.'storefront/images/'.$clean.$m[1].')';
            }
            $path = $clean;
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return 'url('.$m[1].$vars['THEME_URL'].'/'.$path.$m[1].')';
    }, $html);

    $html = preg_replace_callback('/newImage\((["\'])([^"\']+)\1\)/i', function ($m) use ($vars) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return 'newImage('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $images = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $images, true)) {
            return $m[0];
        }
        $clean = ltrim($path, './');
        if (str_starts_with($clean, 'storefront/')) {
            $clean = substr($clean, 11);
        }
        if (str_starts_with($clean, 'images/')) {
            $clean = substr($clean, 7);
        }
        if (str_starts_with($clean, 'capsules/')) {
            $base = cms_base_url();
            $base = $base ? rtrim($base, '/'). '/' : '';
            return 'newImage('.$m[1].$base.'storefront/images/'.$clean.$m[1].')';
        }
        $path = preg_replace('~^(?:img|images)/~', '', $clean);
        $path = preg_replace('~^storefront/~', '', $path);
        return 'newImage('.$m[1].$vars['THEME_URL'].'/images/'.$path.$m[1].')';
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
            $clean = ltrim($path, './');
            if (str_starts_with($clean, 'storefront/')) {
                $clean = substr($clean, 11);
            }
            if (str_starts_with($clean, 'images/')) {
                $clean = substr($clean, 7);
            }
            if (str_starts_with($clean, 'capsules/')) {
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return $m[1].'="'.$base.'storefront/images/'.$clean.'"';
            }
            $path = preg_replace('~^(?:img|images)/~', '', $clean);
            $path = preg_replace('~^storefront/~', '', $path);
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
            $clean = ltrim($path, './');
            if (str_starts_with($clean, 'storefront/')) {
                $clean = substr($clean, 11);
            }
            if (str_starts_with($clean, 'images/')) {
                $clean = substr($clean, 7);
            }
            if (str_starts_with($clean, 'capsules/')) {
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return 'url('.$m[1].$base.'storefront/images/'.$clean.$m[1].')';
            }
            $path = $clean;
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return 'url('.$m[1].$vars['THEME_URL'].'/'.$path.$m[1].')';
    }, $html);

    $html = preg_replace_callback('/newImage\((["\'])([^"\']+)\1\)/i', function ($m) use ($vars) {
        $path = $m[2];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return 'newImage('.$m[1].$path.$m[1].')';
        }
        $p   = parse_url($path, PHP_URL_PATH) ?? '';
        $ext = strtolower(pathinfo($p, PATHINFO_EXTENSION));
        $images = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
        if (!in_array($ext, $images, true)) {
            return $m[0];
        }
        $clean = ltrim($path, './');
        if (str_starts_with($clean, 'storefront/')) {
            $clean = substr($clean, 11);
        }
        if (str_starts_with($clean, 'images/')) {
            $clean = substr($clean, 7);
        }
        if (str_starts_with($clean, 'capsules/')) {
            $base = cms_base_url();
            $base = $base ? rtrim($base, '/'). '/' : '';
            return 'newImage('.$m[1].$base.'storefront/images/'.$clean.$m[1].')';
        }
        $path = preg_replace('~^(?:img|images)/~', '', $clean);
        $path = preg_replace('~^storefront/~', '', $path);
        return 'newImage('.$m[1].$vars['THEME_URL'].'/images/'.$path.$m[1].')';
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
            $clean = ltrim($path, './');
            if (str_starts_with($clean, 'storefront/')) {
                $clean = substr($clean, 11);
            }
            if (str_starts_with($clean, 'images/')) {
                $clean = substr($clean, 7);
            }
            if (str_starts_with($clean, 'capsules/')) {
                $base = $base_url ? rtrim($base_url, '/'). '/' : '';
                return 'url('.$m[1].$base.'storefront/images/'.$clean.$m[1].')';
            }
            $path = preg_replace('~^(?:img|images)/~', '', $clean);
            $path = preg_replace('~^storefront/~', '', $path);
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
