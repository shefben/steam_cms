<?php
require_once __DIR__.'/news.php';
require_once __DIR__.'/../includes/twig.php';
require_once __DIR__.'/plugin_api.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * Wrap a Twig callback with plugin hook support.
 */
function cms_hookable(callable $fn, string $name): callable
{
    return function (...$args) use ($fn, $name) {
        $args = cms_apply_tag_hooks($name, 'before', $args);
        $out  = $fn(...$args);
        return cms_apply_tag_hooks($name, 'after', $out);
    };
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
    $stmt = $db->prepare(
        'SELECT c.content FROM random_content c '
        . 'JOIN random_groups g ON c.group_id = g.id '
        . 'WHERE g.name=?'
    );
    $stmt->execute([$tag]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (!$rows) {
        return '';
    }

    $index   = random_int(0, count($rows) - 1);
    $content = $rows[$index];

    $rewrite = function (array $m): string {
        return $m[1] . './images/' . $m[2];
    };

    $content = preg_replace_callback(
        "#((?:src|href)=[\"'])(?![./])images/([^\"']+)#i",
        $rewrite,
        $content
    );

    $content = preg_replace_callback(
        "#(url\\([\"']?)(?![./])images/([^)\"']+)#i",
        $rewrite,
        $content
    );

    return $content;
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

function cms_news_search_bar(): string
{
    return <<<HTML
<div class="rightCol_2_top_soon" style="height: 40px;">
    <form action="index.php" id="searchform" name="searchform">
    <input type="hidden" name="area" value="news">
    <input type="hidden" name="cc" value="--">
    <table width="190" border="0" cellspacing="0" cellpadding="0">
    <tbody><tr>
        <td width="20" nowrap="">&nbsp;</td>
        <td width="190"><input id="searchterm" name="term" value="" type="text" size="25" maxlength="64"></td>
        <td>&nbsp;<a href="#" onclick="document.searchform.submit();" class="btn_search" style="">Search</a></td>
    </tr>
    </tbody></table><br clear="all">
    </form>
</div>
HTML;
}


function cms_find_more_list(int $rows = 1): string
{
    $row = <<<ROW
        <tr>
            <td align="center"></td>
            <td align="center" width="90"><a href="index.php?area=all"><img border="0" height="16" src="ico/ico_mouse_lg.gif" width="26"><br>Games</a></td>
            <td align="center" width="90"><a href="index.php?area=free&tab=demos"><img border="0" height="16" src="ico/ico_demo.gif" width="26"><br>Demos</a></td>
            <td align="center" width="90"><a href="index.php?area=free&tab=videos"><img border="0" height="16" src="ico/ico_film_lg.gif" width="26"><br>Trailers</a></td>
            <td align="center"></td>
        </tr>
ROW;
    $rowsHtml = str_repeat($row, max(1, $rows));
    return '<div class="rightFindMore"><table align="center" border="0" cellpadding="0" cellspacing="0" height="57" width="310">'
        . $rowsHtml . '</table></div>';
}


function cms_spotlight_content(): string
{
    return cms_get_setting('spotlight_content', '<p>Spotlight content</p>');
}

function cms_get_sidebar_entries(string $sidebarName, string $theme): array
{
    $stmt = cms_get_prepared_statement(
        'SELECT e.entry_content FROM sidebar_section_entries e '
        . 'JOIN sidebar_section_variants v ON e.parent_variant_id = v.variant_id '
        . 'JOIN sidebar_sections s ON v.section_id = s.section_id '
        . 'WHERE s.sidebar_name=? AND FIND_IN_SET(?, v.theme_list) '
        . 'AND (e.theme_list IS NULL OR e.theme_list="" OR FIND_IN_SET(?, e.theme_list)) '
        . 'ORDER BY e.entry_order'
    );
    $stmt->execute([$sidebarName, $theme, $theme]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Retrieve sidebar entry field data for plugin-defined sections.
 *
 * @param string $sidebarName Section slug.
 * @param string $theme       Active theme.
 * @return array<int,array<string,string>>
 */
function cms_get_sidebar_entry_data(string $sidebarName, string $theme): array
{
    $stmt = cms_get_prepared_statement(
        'SELECT e.entry_id, f.field_key, f.field_value FROM sidebar_section_entries e '
        . 'JOIN sidebar_section_variants v ON e.parent_variant_id = v.variant_id '
        . 'JOIN sidebar_sections s ON v.section_id = s.section_id '
        . 'LEFT JOIN sidebar_section_entry_fields f ON e.entry_id = f.entry_id '
        . 'WHERE s.sidebar_name=? AND FIND_IN_SET(?, v.theme_list) '
        . 'ORDER BY e.entry_order, f.field_key'
    );
    $stmt->execute([$sidebarName, $theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $entries = [];
    foreach ($rows as $row) {
        $entries[$row['entry_id']][$row['field_key']] = $row['field_value'];
    }
    return array_values($entries);
}

function cms_render_sidebar_section(Environment $env, string $section, array $params = []): string
{
    switch ($section) {
        case 'search':
            return $env->render('layouts/sidebar_sections/search.twig', $params);
        case 'get_steam_now':
            return $env->render('layouts/sidebar_sections/get_steam_now.twig', $params);
        case 'new_on_steam':
            $theme = cms_get_current_theme();
            $items = cms_get_sidebar_entries('new_on_steam', $theme);
            if (in_array($theme, ['2006_v1', '2006_v2'])) {
                $items[] = '<a class="rightLink_moreNews" href="new.xml" target="_blank"><img border="0" height="11" src="ico/ico_arrow_green_wd.gif" width="22">&nbsp;&nbsp;<img align="absmiddle" border="0" src="ico/ico_rss2.gif"/>&nbsp;&nbsp;New on Steam RSS feed</a>';
            }
            return $env->render('layouts/sidebar_sections/new_on_steam.twig', ['items' => $items]);
        case 'find':
            $theme = cms_get_current_theme();
            $entries = cms_get_sidebar_entries('find', $theme);
            $html = implode('', $entries);
            return $env->render('layouts/sidebar_sections/find.twig', ['html' => $html]);
        case 'find_more':
            $rows = (int)($params['rows'] ?? 1);
            $html = cms_find_more_list($rows);
            return $env->render('layouts/sidebar_sections/find_more.twig', ['html' => $html]);
        case 'spotlight':
            $content = cms_spotlight_content();
            return $env->render('layouts/sidebar_sections/spotlight.twig', ['content' => $content]);
        case 'latest_news':
            $theme = cms_get_current_theme();
            $entries = cms_get_sidebar_entries('latest_news', $theme);
            if (in_array($theme, ['2007_v1', '2007_v2'])) {
                $html = '<div class="rightLink_news_area" style="height: auto;">' . implode('', $entries) . '</div>';
            } else {
                $html = '<div class="rightLink_news_area" style="height: auto;">' . implode('', $entries) . '</div>'
                    . '<a class="rightLink" href="index.php?area=news"><img align="absmiddle" border="0" height="7" src="img/ico/ico_arrow_blue_wd.gif" width="22"> Read more news</a>';
            }
            return $env->render('layouts/sidebar_sections/latest_news.twig', ['html' => $html]);
        case 'publisher_catalogs':
            $theme = cms_get_current_theme();
            $entries = cms_get_sidebar_entries('publisher_catalogs', $theme);
            $html = implode('', $entries);
            return $env->render('layouts/sidebar_sections/publisher_catalogs.twig', ['html' => $html]);
        case 'browse_catalog':
            $theme = cms_get_current_theme();
            $entries = cms_get_sidebar_entries('browse_catalog', $theme);
            $html = implode('', $entries);
            return $env->render('layouts/sidebar_sections/browse_catalog.twig', ['html' => $html]);
        case 'coming_soon':
            $theme = cms_get_current_theme();
            $entries = cms_get_sidebar_entries('coming_soon', $theme);
            $html = implode('', $entries);
            return $env->render('layouts/sidebar_sections/coming_soon.twig', ['html' => $html]);
    }
    global $cms_plugins;
    if (isset($cms_plugins['sidebar_renderers'][$section])) {
        $theme = cms_get_current_theme();
        $data = cms_get_sidebar_entry_data($section, $theme);
        $renderer = $cms_plugins['sidebar_renderers'][$section];
        return $renderer($env, $data);
    }
    return '';
}

function cms_news_archive_months(int $year, int $months = 12): string
{
    $names = ['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];
    $current = (int)date('n');
    $html = '';
    for ($i = 0; $i < $months; $i++) {
        $m = $current - $i;
        if ($m <= 0) {
            $m += 12;
        }
        $label = $names[$m - 1];
        $html .= '<a href="index.php?area=news_archive&amp;date=' . $m . '" class="rightLink"><img src="ico/ico_arrow_blue_wd.gif" width="22" height="7" border="0">&nbsp; ' . $label . ' </a>';
    }
    return $html;
}

function cms_theme_layout(?string $file, ?string $theme = null)
{
    static $pathCache = [];
    $theme = $theme ?: cms_get_setting('theme', '2004');
    $file  = $file ?: 'default.twig';
    $file  = preg_replace('/\.tpl$/', '.twig', $file);
    $cacheKey = $theme . '|' . $file;
    if (isset($pathCache[$cacheKey])) {
        return $pathCache[$cacheKey];
    }

    $dirs     = ['layouts', 'layout'];
    $subdirs  = ['', 'storefront'];

    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/$theme/".($sub ? "$sub/" : '')."$dir/$file";
            if (file_exists($path)) {
                return $pathCache[$cacheKey] = $path;
            }
        }
    }
    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/$theme/".($sub ? "$sub/" : '')."$dir/default.twig";
            if (file_exists($path)) {
                return $pathCache[$cacheKey] = $path;
            }
        }
    }
    foreach ($subdirs as $sub) {
        foreach ($dirs as $dir) {
            $path = dirname(__DIR__)."/themes/2004/".($sub ? "$sub/" : '')."$dir/$file";
            if (file_exists($path)) {
                return $pathCache[$cacheKey] = $path;
            }
        }
    }
    $fallback = dirname(__DIR__)."/themes/2004/layout/default.twig";
    $pathCache[$cacheKey] = $fallback;
    return $fallback;
}

function cms_theme_page_template(string $page, ?string $theme = null, ?string $version = null): string
{
    static $pathCache = [];
    $theme = $theme ?: cms_get_setting('theme', '2004');
    $page  = preg_replace('/\.twig$/', '', $page);
    $cacheKey = $theme . '|' . $page . '|' . ($version ?? '');
    if (isset($pathCache[$cacheKey])) {
        return $pathCache[$cacheKey];
    }

    $dirs   = ['layouts', 'layout'];
    $themes = [$theme, '2004'];

    foreach ($themes as $t) {
        foreach ($dirs as $dir) {
            $baseDir = dirname(__DIR__) . "/themes/{$t}/{$dir}";
            if ($version !== null) {
                $verPath = $baseDir . "/{$page}_v{$version}.twig";
                if (file_exists($verPath)) {
                    return $pathCache[$cacheKey] = $verPath;
                }
            }

            $pagePath = $baseDir . "/{$page}.twig";
            if (file_exists($pagePath)) {
                return $pathCache[$cacheKey] = $pagePath;
            }
        }
    }

    foreach ($themes as $t) {
        foreach ($dirs as $dir) {
            $defaultPath = dirname(__DIR__) . "/themes/{$t}/{$dir}/default.twig";
            if (file_exists($defaultPath)) {
                return $pathCache[$cacheKey] = $defaultPath;
            }
        }
    }

    $fallback = dirname(__DIR__) . '/themes/2004/layout/default.twig';
    $pathCache[$cacheKey] = $fallback;
    return $fallback;
}

function cms_admin_layout(string $file, ?string $theme = null): ?string
{
    $theme = $theme ?: cms_get_setting('admin_theme', 'v2');
    $file  = $file ?: 'default.twig';
    $file  = preg_replace('/\.tpl$/', '.twig', $file);

    $dirs = ['layouts', 'layout'];

    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/{$theme}_admin/$dir/$file";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/{$theme}_admin/$dir/default.twig";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/default_admin/$dir/$file";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/default_admin/$dir/default.twig";
        if (file_exists($path)) {
            return $path;
        }
    }
    return null;
}

function cms_admin_tag_path(string $tag, ?string $theme = null): ?string
{
    $theme = $theme ?: cms_get_setting('admin_theme', 'v2');
    $dirs  = ['tag_layout', 'tag_layouts', 'tags'];
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/{$theme}_admin/$dir/$tag.twig";
        if (file_exists($path)) {
            return $path;
        }
    }
    foreach ($dirs as $dir) {
        $path = dirname(__DIR__) . "/themes/default_admin/$dir/$tag.twig";
        if (file_exists($path)) {
            return $path;
        }
    }
    return null;
}

function cms_admin_tag(string $tag, array $vars = [], ?string $theme = null): string
{
    $path = cms_admin_tag_path($tag, $theme);
    if (!$path) {
        return '';
    }
    $tpl_dir = dirname($path);
    $vars['BASE'] = cms_base_url();
    $env = cms_twig_env($tpl_dir);
    return $env->render(basename($path), $vars);
}

function cms_render_tabbed_games_column(array $games): string
{
    $html = '';
    foreach ($games as $row) {
        $appid = (int)$row['appid'];
        $url   = 'index.php?area=game&amp;AppId=' . $appid . '&amp;';
        $imgPath = $row['image_path'] ?? '';
        if ($imgPath) {
            if (str_starts_with($imgPath, 'gfx/')) {
                $img = $imgPath;
            } else {
                $base = cms_base_url();
                $img = $base . 'storefront/images/capsules/' . ltrim($imgPath, '/');
            }
        } else {
            $img = 'gfx/apps/' . $appid . '/capsule_sm_120.jpg';
        }
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
    $db  = cms_get_db();
    $sql = 'SELECT t.id AS tab_id,t.title,g.appid,g.image_path,g.ord AS g_ord,a.name,a.price '
        . 'FROM storefront_tabs t '
        . 'LEFT JOIN storefront_tab_games g ON t.id=g.tab_id '
        . 'LEFT JOIN store_apps a ON g.appid=a.appid '
        . 'WHERE t.theme=? ORDER BY t.ord,g.ord';
    $stmt = $db->prepare($sql);
    $stmt->execute([$theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        return '';
    }
    $tabs = [];
    foreach ($rows as $row) {
        $id = (int) $row['tab_id'];
        if (!isset($tabs[$id])) {
            $tabs[$id] = ['id' => $id, 'title' => $row['title'], 'games' => []];
        }
        if ($row['appid'] !== null) {
            $tabs[$id]['games'][] = [
                'appid'      => $row['appid'],
                'image_path' => $row['image_path'],
                'name'       => $row['name'],
                'price'      => $row['price'],
            ];
        }
    }
    $html = '<div class="leftCol_home_indent"><div class="listArea"><br clear="all">';
    $i    = 0;
    foreach ($tabs as $tab) {
        $i++;
        $focus = $i === 1;
        $class = $focus ? 'listArea_tab_focus' : 'listArea_tab';
        $l     = $focus ? 'listArea_tab_focus_l.gif' : 'listArea_tab_l.gif';
        $r     = $focus ? 'listArea_tab_focus_r.gif' : 'listArea_tab_r.gif';
        $html .= '<div class="' . $class . '" id="tab_' . $i . '">'
            . '<img align="absmiddle" id="tab_' . $i . '_image_l" src="home/' . $l . '"><span class="listArea_tab_txt">' . htmlspecialchars($tab['title']) . '</span><img align="absmiddle" id="tab_' . $i . '_image_r" src="home/' . $r . '">'
            . '</div>';
    }
    $html .= '<br clear="left"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td height="6"><img height="6" src="_spacer.gif" width="6"></td><td align="right" height="6"><img height="6" src="home/listArea_tr.gif" width="6"></td></tr>';
    $i = 0;
    foreach ($tabs as $tab) {
        $i++;
        $display = $i === 1 ? '' : ' style="display: none;"';
        $html   .= '<tr id="tab_' . $i . '_content"' . $display . '><td valign="top">';
        $half   = (int) ceil(count($tab['games']) / 2);
        $html   .= cms_render_tabbed_games_column(array_slice($tab['games'], 0, $half));
        $html   .= '</td><td valign="top">';
        $html   .= cms_render_tabbed_games_column(array_slice($tab['games'], $half));
        $html   .= '</td></tr>';
    }
    $html .= '<tr><td height="6"><img height="6" src="home/listArea_bl.gif" width="6"></td><td align="right" height="6"><img height="6" src="home/listArea_br.gif" width="6"></td></tr></tbody></table></div></div>';
    $html .= "<script type=\"text/javascript\">document.querySelectorAll('.listArea_tab, .listArea_tab_focus').forEach(function(tab,idx){tab.addEventListener('click',function(){document.querySelectorAll('.listArea_tab_focus,.listArea_tab').forEach(function(t,i){var focus=i===idx;t.className=focus?'listArea_tab_focus':'listArea_tab';document.getElementById('tab_'+(i+1)+'_content').style.display=focus?'':'none';document.getElementById('tab_'+(i+1)+'_image_l').src='home/'+(focus?'listArea_tab_focus_l.gif':'listArea_tab_l.gif');document.getElementById('tab_'+(i+1)+'_image_r').src='home/'+(focus?'listArea_tab_focus_r.gif':'listArea_tab_r.gif');});});});</script>";
    return $html;
}
function cms_twig_env(string $tpl_dir): Environment
{
    static $env;
    if (!$env instanceof Environment) {
        $env = function_exists('apcu_fetch') ? apcu_fetch('cms_twig_env') : null;
        if (!$env instanceof Environment) {
            $loader = new FilesystemLoader($tpl_dir);
            require_once __DIR__ . '/utilities/text_styler.php';
            $cacheDir = __DIR__ . '/cache/twig';
            if (!is_dir($cacheDir)) {
                mkdir($cacheDir, 0777, true);
            }
            cms_load_plugins();
            $env = new Environment($loader, ['cache' => $cacheDir, 'auto_reload' => true]);
        $env->addFunction(new TwigFunction('header', cms_hookable(function(bool $withButtons = true) {
            $theme = cms_get_current_theme();
            return cms_render_header($theme, $withButtons);
        }, 'header'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('header_logo', cms_hookable(function(string $path) {
            cms_set_header_logo_override($path);
            return '';
        }, 'header_logo'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('content_header_image', cms_hookable(function() {
            $img = cms_get_content_header_image();
            if (!$img) {
                return '';
            }
            $base = cms_base_url();
            if (strncasecmp($img, 'http', 4) !== 0) {
                if ($img !== '' && $img[0] !== '/') {
                    $img = '/' . $img;
                }
                $img = $base . $img;
            }
            return '<img src="' . htmlspecialchars($img) . '" alt="">';
        }, 'content_header_image'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('logo', cms_hookable(function() {
            $theme = cms_get_current_theme();
            $data  = cms_get_theme_header_data($theme);
            $logo  = $data['logo'] ?: '/img/steam_logo_onblack.gif';
            $base  = cms_base_url();
            $logo  = str_ireplace('{BASE}', $base, $logo);
            if ($logo && $logo[0] == '/') {
                $logo = $base . $logo;
            }
            return '<img src="'.htmlspecialchars($logo).'" alt="logo">';
        }, 'logo'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('footer', cms_hookable(function() {
            $theme = cms_get_current_theme();
            $html  = cms_get_theme_footer($theme);
            $html  = str_ireplace('{BASE}', '{{ BASE }}', $html);
            $env   = cms_twig_env('.');
            return $env->createTemplate($html)->render(['BASE' => cms_base_url()]);
        }, 'footer'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('nav_buttons', cms_hookable(function(string $theme = '', string $style = '', ?string $spacer = null, ?string $color = null) {
            $theme = $theme !== '' ? $theme : cms_get_current_theme();
            return cms_nav_buttons_html($theme, $style, $spacer, $color);
        }, 'nav_buttons'), ['is_safe' => ['html']]));
        $env->addFunction(new TwigFunction('news', cms_hookable(function(string $type, ?int $count = null) {
            $theme = cms_get_current_theme();
            $cfg   = cms_get_theme_config($theme);
            $count = $count ?? ($cfg['news_count'] ?? null);
            return cms_render_news($type, $count);
        }, 'news'), ['is_safe' => ['html']]));

        // allow plugins to register additional Twig tags
        cms_register_plugin_template_tags($env);

        $env->addFunction(new TwigFunction('news_index_brief', function(int $count = 3) {
            return cms_render_news('index_brief', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_index_bodygreen', function(int $count = 5) {
            return cms_render_news('index_bodygreen', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_index_2006', function(int $count = 5) {
            return cms_render_news('index_2006', $count);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_archive_months', function(int $year, int $months = 12) {
            return cms_news_archive_months($year, $months);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('html_title', function() {
            return cms_get_setting('html_title', 'Welcome to Steam');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('steam_news_title', function() {
            return cms_get_setting('steam_news_title', 'STEAM NEWS');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('rss_feed_title', function() {
            return cms_get_setting('rss_feed_title', 'RSS FEED');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_archive_title', function(int $year) {
            $tpl = cms_get_setting('news_archive_title', 'NEWS ARCHIVE (%d)');
            return sprintf($tpl, $year);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('full_archive_title', function() {
            return cms_get_setting('full_archive_title', 'FULL ARCHIVE');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('news_search_bar', function() {
            return cms_news_search_bar();
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('getsteamnow_button', function(string $text) {
            return renderGetSteamNowButton($text);
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_right', function(int $year, string $page = 'news') {
            if ($page === 'news') {
                if ($year >= 2007) {
                    return cms_news_search_bar();
                }
                $steamNews = cms_get_setting('steam_news_title', 'STEAM NEWS');
                $rss = cms_get_setting('rss_feed_title', 'RSS FEED');
                $archiveTitle = sprintf(cms_get_setting('news_archive_title', 'NEWS ARCHIVE (%d)'), $year);
                $fullArchive = cms_get_setting('full_archive_title', 'FULL ARCHIVE');
                $months = cms_news_archive_months($year);
                return '<div class="rightCol_2_top_soon">' . $steamNews . '</div>'
                    . '<a href="rss.xml" class="rightLink"><img src="ico/ico_rss.gif" width="28" height="13" border="0" align="absmiddle">&nbsp; ' . $rss . '</a>'
                    . '<h1> ' . $archiveTitle . ' </h1>'
                    . $months
                    . '<div class="rightCol_2_Hr"></div>'
                    . '<a href="index.php?area=news_archive" class="rightLink"><img src="ico/ico_arrow_blue_wd.gif" width="22" height="7" border="0">&nbsp; ' . $fullArchive . ' </a>'
                    . '<div class="rightCol_2_Hr"></div>';
            }
            return '';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('join_steam_text', function() {
            return cms_get_setting('join_steam_text', 'Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.');
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('join_steam_block', function(string $style = '2006') {
            $text = cms_get_setting('join_steam_text', 'Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.');
            if ($style === '2007') {
                return '<table class="capsuleArea_header" height="73" width="574"><tr><td height="73" valign="middle" width="250"><div class="btn_getSteam_slvr" onclick="location.href=\'index.php?area=getsteamnow\'">Get Steam Now !</div></td><td height="73" valign="top"><p>'.$text.'</p></td></tr></table>';
            }
            return '<table class="capsuleArea_header" width="560"><tr><td width="172"><img src="logo_steam_main.jpg" width="172" height="63" alt=""></td><td valign="top"><p>'.$text.'</p></td></tr></table>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_section', function(string $name, array $params = []) use ($env) {
            return cms_render_sidebar_section($env, $name, $params);
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

        $env->addFunction(new TwigFunction('page_title_2002', function() {
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
            static $out = null;
            if ($out !== null) {
                return $out;
            }
            $db   = cms_get_db();
            $rows = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
            $html = '<div class="categories_list">';
            foreach ($rows as $row) {
                $id   = (int) $row['id'];
                $name = htmlspecialchars($row['name']);
                $html .= '<a class="category_link" href="index.php?area=search&browse=1&category='.$id.'">'.$name.'</a><br/>';
            }
            $html .= '</div>';
            return $out = $html;
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('capsule_block', function(string $key) {
            $theme  = cms_get_current_theme();
            $db     = cms_get_db();
            $useAll = cms_get_setting('capsules_same_all', '1') === '1';

            $ordMap = ['top1'=>1,'top2'=>2,'large'=>3,'under1'=>4,'under2'=>5,'bottom1'=>6,'bottom2'=>7,'gear'=>8,'free'=>9,'tabbed'=>10];
            $ord = $ordMap[$key] ?? 0;
            $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsules_per_theme c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme=? AND c.ord=?');
            $stmt->execute([$theme, $ord]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row && $useAll) {
                $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsules_all c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.position=?');
                $stmt->execute([$key]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if (!$row) {
                return '';
            }

            $priceVal = $row['price'] !== null ? (float)$row['price'] : (float)$row['app_price'];
            $price = number_format($priceVal, 2);
            $name = htmlspecialchars($row['app_name'] ?? '', ENT_QUOTES);
            $imgPath = $row['image_path'];

            if (in_array($theme, ['2006_v1', '2006_v2', '2007_v1', '2007_v2'], true)) {
                if (!str_starts_with($imgPath, 'gfx/')) {
                    $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                }
                $img = $imgPath;
                $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                if (in_array($theme, ['2007_v1', '2007_v2'], true)) {
                    return '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsule\'; window.status=\'\';" onmouseover="this.className=\'capsule_ovr\'; window.status=\'' . $url . '\';"><div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"><div style="position: absolute; width: 280px; height: 105px; top: 0px; left: 0px;"><img src="corners/smallcap_corners.png" width="280" height="105" border="0"></div></div><div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '</div></div>';
                }
                return '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);"><div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"></div><div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>';
            }

            $base = cms_base_url();
            $base = $base ? rtrim($base, '/') . '/' : '';
            $img  = $base . 'storefront/images/capsules/' . $imgPath;
            $url  = 'index.php?area=app&id=' . (int)$row['appid'];
            return '<div class="capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div>';
        }, ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('large_capsule_block', function(string $key = 'large') {
            $theme  = cms_get_current_theme();
            $db     = cms_get_db();
            $useAll = cms_get_setting('capsules_same_all', '1') === '1';

            $ordMap = ['top1'=>1,'top2'=>2,'large'=>3,'under1'=>4,'under2'=>5,'bottom1'=>6,'bottom2'=>7,'gear'=>8,'free'=>9,'tabbed'=>10];
            $ord = $ordMap[$key] ?? 0;
            $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsules_per_theme c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme=? AND c.ord=?');
            $stmt->execute([$theme, $ord]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row && $useAll) {
                $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsules_all c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.position=?');
                $stmt->execute([$key]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if (!$row) {
                return '';
            }

            $priceVal = $row['price'] !== null ? (float)$row['price'] : (float)$row['app_price'];
            $price = number_format($priceVal, 2);
            $name = htmlspecialchars($row['app_name'] ?? '', ENT_QUOTES);
            $imgPath = $row['image_path'];

            if (in_array($theme, ['2006_v1', '2006_v2', '2007_v1', '2007_v2'], true)) {
                if (!str_starts_with($imgPath, 'gfx/')) {
                    $imgPath = 'gfx/apps/' . ltrim($imgPath, '/');
                }
                $img = $imgPath;
                $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                if (in_array($theme, ['2007_v1', '2007_v2'], true)) {
                    return '<div id="capsule_large_content"><div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsuleLarge\'; window.status=\'\';" onmouseover="this.className=\'capsuleLarge_ovr\'; window.status=\'' . $url . '\';"><div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"><div style="position: absolute; width: 572px; height: 221px; top: 0px; left: 0px;"><img src="corners/largecap_corners.png" width="572" height="221" border="0"></div></div><div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '</div></div></div>';
                }
                return '<div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);"><div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"></div><div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>';
            }

            $base = cms_base_url();
            $base = $base ? rtrim($base, '/') . '/' : '';
            $img  = $base . 'storefront/images/capsules/' . $imgPath;
            $url  = 'index.php?area=app&id=' . (int)$row['appid'];
            return '<div class="capsuleLarge"><div class="large-capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div></div>';
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

        $env->addFunction(new TwigFunction('custom_index_sidebar_configurations', function () {
            $theme = cms_get_setting('theme', '2004');
            return cms_get_sidebar_sections_html($theme);
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
            $theme  = cms_get_current_theme();
            $useAll = cms_get_setting('capsules_same_all', '1') === '1';
            $db     = cms_get_db();

            // Try theme-specific capsule items first
            $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsule_items c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme=? ORDER BY ord');
            $stmt->execute([$theme]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // If none and sharing enabled, fall back to global capsule items
            if (!$rows && $useAll) {
                $stmt = $db->prepare('SELECT c.*, a.name AS app_name, a.price AS app_price FROM storefront_capsule_items c LEFT JOIN store_apps a ON a.appid=c.appid WHERE c.theme IS NULL ORDER BY ord');
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            if (!$rows) {
                return '';
            }
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
                            $html .= $is2007 ? '<div class="inline">' : '<div class="capsuleGroup">';
                            $open = true;
                            $count = 0;
                        }
                        if ($is2006) {
                            $imgPath = $row['image_path'];
                            if (str_starts_with($imgPath, 'gfx/')) {
                                $img = $imgPath;
                            } else {
                                $img = $base . 'storefront/images/capsules/' . ltrim($imgPath, '/');
                            }
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);">'
                                . '<div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"></div>'
                                . '<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>';
                        } elseif ($is2007) {
                            $imgPath = $row['image_path'];
                            if (str_starts_with($imgPath, 'gfx/')) {
                                $img = $imgPath;
                            } else {
                                $img = $base . 'storefront/images/capsules/' . ltrim($imgPath, '/');
                            }
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsule" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsule\'; window.status=\'\';" onmouseover="this.className=\'capsule_ovr\'; window.status=\'' . $url . '\';">'
                                . '<div class="capsuleImage"><img alt="' . $name . '" border="0" height="105" src="' . $img . '" width="280"><div style="position: absolute; width: 280px; height: 105px; top: 0px; left: 0px;"><img src="corners/smallcap_corners.png" width="280" height="105" border="0"></div></div>'
                                . '<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$' . htmlspecialchars($price) . '</div></div>';
                        } else {
                            $img = $base . 'storefront/images/capsules/' . $row['image_path'];
                            $url = 'index.php?area=app&id=' . (int)$row['appid'];
                            $html .= '<div class="capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div>';
                        }
                        $count++;
                        if ($count === 2) {
                            $html .= $is2007 ? '</div>' : '<br clear="all"></div>';
                            $open = false;
                        }
                        break;
                    case 'large':
                        if ($open) {
                            $html .= $is2007 ? '</div>' : '<br clear="all"></div>';
                            $open = false;
                        }
                        if ($is2006) {
                            $imgPath = $row['image_path'];
                            if (str_starts_with($imgPath, 'gfx/')) {
                                $img = $imgPath;
                            } else {
                                $img = $base . 'storefront/images/capsules/' . ltrim($imgPath, '/');
                            }
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.style.background=\'#000000\'; window.status=\'\';" onmouseover="this.style.background=\'#666666\'; window.status=\'' . $url . '\';" style="background: rgb(0, 0, 0);">'
                                . '<div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"></div>'
                                . '<div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '&nbsp;</div></div>'
                                . '<br clear="all">';
                        } elseif ($is2007) {
                            $imgPath = $row['image_path'];
                            if (str_starts_with($imgPath, 'gfx/')) {
                                $img = $imgPath;
                            } else {
                                $img = $base . 'storefront/images/capsules/' . ltrim($imgPath, '/');
                            }
                            $url = 'index.php?area=game&amp;AppId=' . (int)$row['appid'] . '&amp;';
                            $html .= '<div id="capsule_large_content">'
                                . '<div class="capsuleLarge" onclick="location.href=\'' . $url . '\';" onmouseout="this.className=\'capsuleLarge\'; window.status=\'\';" onmouseover="this.className=\'capsuleLarge_ovr\'; window.status=\'' . $url . '\';">'
                                . '<div class="capsuleLargeImage"><img alt="' . $name . '" border="0" galleryimg="no" height="221" src="' . $img . '" width="572"><div style="position: absolute; width: 572px; height: 221px; top: 0px; left: 0px;"><img src="corners/largecap_corners.png" width="572" height="221" border="0"></div></div>'
                                . '<div class="capsuleLargeText"></div><div class="capsuleLargeCost">$' . htmlspecialchars($price) . '</div></div>'
                                . '</div>';
                        } else {
                            $img = $base . 'storefront/images/capsules/' . $row['image_path'];
                            $url = 'index.php?area=app&id=' . (int)$row['appid'];
                            $html .= '<div class="capsuleLarge"><div class="large-capsule"><a href="' . $url . '"><img src="' . $img . '" alt="' . $name . '"></a><span class="price">$' . htmlspecialchars($price) . '</span></div><br clear="all"></div>';
                        }
                        break;
                    case 'multi-large':
                        $group = $row['image_path'];
                        $base = cms_base_url();
                        $capsuleUrl = $base ? rtrim($base, '/') . '/' : '';
                        $capsuleUrl .= 'cms/multi_app_large_capsule.php?group=' . urlencode($group);
                        $html .= '<iframe src="' . $capsuleUrl . '" width="589" height="267" frameborder="0" style="display: block;"></iframe>';
                        break;
                    case 'gear':
                    case 'free':
                        if ($is2007) {
                            if ($open) {
                                $html .= '</div>';
                                $open = false;
                            }
                            if ($row['type'] === 'gear') {
                                $cTitle = htmlspecialchars($row['title'] ?? 'Get The Gear!', ENT_QUOTES);
                                $defaultContent = 'Get your hands on the brand-new Half-Life® 2: Episode Two poster at the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> now!!! Also featuring official shirts, posters, hats and more!';
                                $cContent = $row['content'] ?? $defaultContent;
                                $html .= '<div class="leftCol_home_indent"><div align="center" class="Gear"><div class="GearTitle">' . $cTitle . '</div><div class="GearText">' . $cContent . '</div></div></div>';
                            } else {
                                $cTitle = htmlspecialchars($row['title'] ?? 'Free Stuff!', ENT_QUOTES);
                                $defaultContent = 'In addition to a catalog of great games, your free Steam account gives you access to game <a href="v/index.php?area=free&amp;tab=demos&amp;">demos</a>, <a href="v/index.php?area=free&amp;tab=mods&amp;">mods</a>, <a href="v/index.php?area=free&amp;tab=videos&amp;">trailers</a> and more. Browse our <a href="v/index.php?area=free&amp;">Free Stuff</a> page for more details.';
                                $cContent = $row['content'] ?? $defaultContent;
                                $html .= '<div class="leftCol_home_indent"><div align="center" class="Stuff"><div class="StuffTitle">' . $cTitle . '</div><div class="StuffText">' . $cContent . '</div></div></div>';
                            }
                        } else {
                            if (!$open) {
                                $html .= '<div class="capsuleGroup">';
                                $open = true;
                                $count = 0;
                            }
                            if ($row['type'] === 'gear') {
                                $cTitle = htmlspecialchars($row['title'] ?? 'Get The Gear!', ENT_QUOTES);
                                $defaultContent = $is2006
                                    ? 'Check out the new Logitech® MOMO® Racing wheel! Visit the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> for official shirts, posters, hats and more!'
                                    : '';
                                $cContent = $row['content'] ?? $defaultContent;
                                if ($is2006) {
                                    $html .= '<div align="center" class="capsuleGear"><div class="capsuleGearTitle">' . $cTitle . '</div><div class="capsuleGearText">' . $cContent . '</div></div>';
                                } else {
                                    $html .= '<div class="gear-block"><h3>' . $cTitle . '</h3><div>' . $cContent . '</div></div>';
                                }
                            } else {
                                $cTitle = htmlspecialchars($row['title'] ?? 'Free Stuff!', ENT_QUOTES);
                                $defaultContent = $is2006
                                    ? 'In addition to a catalog of great games, your free Steam account gives you access to <a href="http://storefront.steampowered.com/v/index.php?area=search&amp;browse=1&amp;category=&amp;price=1&amp;">games + demos</a>, <a href="http://storefront.steampowered.com/v/index.php?area=media&amp;">HD movies + trailers</a>, and more.'
                                    : '';
                                $cContent = $row['content'] ?? $defaultContent;
                                if ($is2006) {
                                    $html .= '<div align="center" class="capsuleStuff"><div class="capsuleStuffTitle">' . $cTitle . '</div><div class="capsuleStuffText">' . $cContent . '</div></div>';
                                } else {
                                    $html .= '<div class="free-block"><h3>' . $cTitle . '</h3><div>' . $cContent . '</div></div>';
                                }
                            }
                            $count++;
                            if ($count === 2) {
                                $html .= '<br clear="all"></div>';
                                $open = false;
                            }
                        }
                        break;
                    case 'tabbed':
                        if ($open) {
                            $html .= $is2007 ? '</div>' : '<br clear="all"></div>';
                            $open = false;
                        }
                        $tabContent = cms_render_tabs($theme);
                        if ($is2007) {
                            $html .= '<div class="inline">' . $tabContent . '</div>';
                        } else {
                            $html .= $tabContent;
                        }
                        break;
                }
            }
            if ($open) {
                $html .= $is2007 ? '</div>' : '<br clear="all"></div>';
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

        // 2008 Theme Functions
        $env->addFunction(new TwigFunction('header_2008', cms_hookable(function() {
            $theme = cms_get_current_theme();
            return cms_render_header_2008($theme);
        }, 'header_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('cart_status', cms_hookable(function() {
            return '';
        }, 'cart_status'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_search', cms_hookable(function() {
            return cms_render_2008_search_section();
        }, 'sidebar_2008_search'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_browse', cms_hookable(function() {
            return cms_render_2008_browse_section();
        }, 'sidebar_2008_browse'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_install_steam', cms_hookable(function() {
            return cms_render_2008_install_steam_section();
        }, 'sidebar_2008_install_steam'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_freeloads', cms_hookable(function() {
            return cms_render_2008_freeloads_section();
        }, 'sidebar_2008_freeloads'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_news', cms_hookable(function() {
            return cms_render_2008_news_section();
        }, 'sidebar_2008_news'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_catalogs', cms_hookable(function() {
            return cms_render_2008_catalogs_section();
        }, 'sidebar_2008_catalogs'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_2008_steam_info', cms_hookable(function() {
            return cms_render_2008_steam_info_section();
        }, 'sidebar_2008_steam_info'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('large_capsule_flash_2008', cms_hookable(function() {
            return cms_render_2008_large_capsule();
        }, 'large_capsule_flash_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('small_capsules_2008', cms_hookable(function() {
            return cms_render_2008_small_capsules();
        }, 'small_capsules_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tabbed_single_column_capsule', cms_hookable(function() {
            return cms_render_tabbed_single_column_capsule();
        }, 'tabbed_single_column_capsule'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('extras_section_2008', cms_hookable(function() {
            return cms_render_2008_extras_section();
        }, 'extras_section_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('sidebar_right_2008', cms_hookable(function() {
            return cms_render_2008_sidebar_right();
        }, 'sidebar_right_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('footer_2008', cms_hookable(function() {
            return cms_render_footer_2008();
        }, 'footer_2008'), ['is_safe' => ['html']]));

        $env->addFunction(new TwigFunction('tab_switching_script', cms_hookable(function() {
            return cms_render_tab_switching_script();
        }, 'tab_switching_script'), ['is_safe' => ['html']]));

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
        if (function_exists('apcu_store')) {
            apcu_store('cms_twig_env', $env);
        }
    }
}
    /** @var FilesystemLoader $loader */
    $loader = $env->getLoader();
    $loader->setPaths([$tpl_dir]);
    // Allow plugins to interact with the Twig environment before use
    $env = cms_apply_hooks('twig_environment', $env);
    return $env;
}

// 2008 Theme Implementation Functions
function cms_render_header_2008(string $theme): string
{
    return '<div id="v4headerBar">
<div id="steamLogo"><img border="0" height="54" src="themes/2008/images/steamLogo.jpg" width="105"/></div>
<div id="steamText">
<img border="0" height="35" src="themes/2008/images/steamText.jpg" width="72"/>
</div>
<div id="v4headerLinks">
<p>
<span id="v4headerMenuItems">
<a class="v4headerLinkActive nav_button_2008" href="index.php">Home</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=about">What is Steam</a>   
<a class="v4headerLink nav_button_2008_secondary" href="https://steamcommunity.com/" target="_blank">Community</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=news">News</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=cybercafes">Cyber Cafés</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=forums">Forums</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=support">Support</a>   
<a class="v4headerLink nav_button_2008_secondary" href="index.php?area=stats">Stats</a>
</span>
</p>
</div>
<div id="v4headerStatusItems">
<p>
<a class="nav_button_2008" href="index.php?area=login">Login</a>
</p>
</div>
</div>';
}

function cms_render_2008_search_section(): string
{
    return '<div id="global_area_search">
<form action="index.php" id="searchform" method="get" name="searchform">
<input type="hidden" name="area" value="search">
<input id="searchterm" name="term" onblur="SetDefaultSearchText();" onclick="ClearDefaultSearchText();" size="22" type="text" value="enter search term"/>
<img align="top" alt="Steam Search" height="22" onclick="document.searchform.submit();" src="themes/2008/images/btn_search.gif" width="22"/>
</form>
</div>
<script language="JavaScript">
function ClearDefaultSearchText()
{
    var text = document.getElementById( \'searchterm\' ).value;
    if ( text == \'enter search term\' )
    {
        document.getElementById( \'searchterm\' ).value = \'\';
    }
}
function SetDefaultSearchText()
{
    var text = document.getElementById( \'searchterm\' ).value;
    if ( text == \'\' )
    {
        document.getElementById( \'searchterm\' ).value = \'enter search term\';
    }
}
</script>';
}

function cms_render_2008_browse_section(): string
{
    return '<div id="global_area_browse"><h2>Browse Games</h2></div>
<ul id="global_area_browse_list">
<li><a href="index.php?area=search&showall=1">All</a></li>
<li><a href="index.php?area=genre&type=Action">Action</a></li>
<li><a href="index.php?area=genre&type=Adventure">Adventure</a></li>
<li><a href="index.php?area=genre&type=Strategy">Strategy</a></li>
<li><a href="index.php?area=genre&type=RPG">RPG</a></li>
<li><a href="index.php?area=genre&type=Casual">Casual</a></li>
<li><a href="index.php?area=genre&type=Indie">Indie</a></li>
<li><a href="index.php?area=genre&type=Racing">Racing</a></li>
<li><a href="index.php?area=genre&type=Sports">Sports</a></li>
<li><a href="index.php?area=genre&type=Simulation">Simulation</a></li>
</ul>';
}

function cms_render_2008_install_steam_section(): string
{
    return '<div id="global_area_install_steam">
<a href="index.php?area=getsteamnow"><img alt="Get Steam Now" border="0" height="36" src="themes/2008/images/btn_getSteam_english.gif" width="163"/></a>
</div>';
}

function cms_render_2008_freeloads_section(): string
{
    return '<div id="global_area_freeloads"><h2>Free Stuff</h2></div>
<ul id="global_area_freeloads_list">
<li><a href="index.php?area=freestuff&type=demos">Game Demos</a></li>
<li><a href="index.php?area=freestuff&type=videos">Videos/Trailers</a></li>
<li><a href="index.php?area=freestuff&type=mods">Game Mods</a></li>
</ul>';
}

function cms_render_2008_news_section(): string
{
    return '<div id="home_area_news"><h2>Steam News</h2></div>
<ul id="global_area_news_list">
<li><a href="index.php?area=news">All Steam News</a></li>
<li><a href="index.php?area=news&filter=releases">Game Releases</a></li>
</ul>';
}

function cms_render_2008_catalogs_section(): string
{
    $db = cms_get_db();
    $stmt = $db->prepare("SELECT DISTINCT publisher FROM store_apps WHERE publisher IS NOT NULL AND publisher != '' ORDER BY publisher LIMIT 20");
    $stmt->execute();
    $publishers = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $html = '<div id="home_area_catalogs"><h2>Publisher Catalogs</h2></div>
<ul id="global_area_catalogs_list">';
    
    foreach ($publishers as $publisher) {
        $encoded = urlencode($publisher);
        $html .= '<li><a href="index.php?area=publisher&name=' . $encoded . '">' . htmlspecialchars($publisher) . '</a></li>';
    }
    
    $html .= '</ul>';
    return $html;
}

function cms_render_2008_steam_info_section(): string
{
    return '<div id="home_area_steam">
<img alt="Get Steam Now" src="themes/2008/images/col_left_logo_steam.jpg"/>
<p>Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.</p>
<br/>
<a class="btn_blue" href="index.php?area=about">More about Steam</a>
</div>';
}

function cms_render_2008_large_capsule(): string
{
    return '<div id="capsule_large_content">
<p>Large capsule content will be displayed here with Flash or HTML5 content</p>
</div>';
}

function cms_render_2008_small_capsules(): string
{
    $db = cms_get_db();
    $stmt = $db->prepare("SELECT * FROM store_apps ORDER BY release_date DESC LIMIT 2");
    $stmt->execute();
    $apps = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';
    foreach ($apps as $app) {
        $price = number_format((float)$app['price'], 2);
        $name = htmlspecialchars($app['name']);
        $appid = (int)$app['appid'];
        
        $html .= '<div class="home_area_capsule_sm">
<a href="index.php?area=app&id=' . $appid . '">
<img alt="' . $name . '" border="0" src="themes/2008/images/capsules/capsule_231x87_default.jpg">
<h5>$' . $price . '</h5>
<h4> </h4>
</img></a>
</div>';
    }
    
    return $html;
}

function cms_render_tabbed_single_column_capsule(): string
{
    $db = cms_get_db();
    
    // Get tabbed capsule data
    $stmt = $db->prepare("SELECT * FROM tabbed_capsules ORDER BY tab_order");
    $stmt->execute();
    $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($tabs)) {
        // Default tabs if none exist
        $tabs = [
            ['id' => 1, 'tab_name' => 'New releases', 'tab_order' => 1],
            ['id' => 2, 'tab_name' => 'Top Sellers', 'tab_order' => 2],
            ['id' => 3, 'tab_name' => 'Top Rated', 'tab_order' => 3],
            ['id' => 4, 'tab_name' => 'Coming soon', 'tab_order' => 4]
        ];
    }
    
    $html = '<div>
<ul id="main_tab_list">';
    
    foreach ($tabs as $i => $tab) {
        $active = $i === 0 ? 'main_tab_on' : 'main_tab_off';
        $tabId = $tab['id'] ?? ($i + 1);
        $tabName = htmlspecialchars($tab['tab_name'] ?? 'Tab ' . ($i + 1));
        
        $html .= '<li class="' . $active . '" id="tab_' . $tabId . '_li"><a class="tab_link" href="javascript:SelectTab(' . $tabId . ');" id="tab_' . $tabId . '">' . $tabName . '</a></li>';
    }
    
    $html .= '</ul>
</div>
<br clear="all"/>
<div class="global_area_tabs_ctn_norm" id="global_area_tabs_ctn">
<div></div>';
    
    // Add tab content
    foreach ($tabs as $i => $tab) {
        $tabId = $tab['id'] ?? ($i + 1);
        $display = $i === 0 ? '' : 'style="display: none;"';
        
        $html .= '<div id="tab_' . $tabId . '_content" ' . $display . '>';
        $html .= cms_render_tab_games($tabId);
        $html .= '</div>';
    }
    
    $html .= '</div>';
    return $html;
}

function cms_render_tab_games(int $tabId): string
{
    $db = cms_get_db();
    $stmt = $db->prepare("SELECT tg.*, a.name, a.price, a.release_date FROM tabbed_capsule_games tg 
                         LEFT JOIN store_apps a ON a.appid = tg.appid 
                         WHERE tg.tab_id = ? ORDER BY tg.game_order LIMIT 10");
    $stmt->execute([$tabId]);
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($games)) {
        // Default sample games
        $stmt = $db->prepare("SELECT * FROM store_apps ORDER BY RAND() LIMIT 10");
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $html = '';
    foreach ($games as $game) {
        $name = htmlspecialchars($game['name']);
        $price = number_format((float)$game['price'], 2);
        $appid = (int)$game['appid'];
        $releaseDate = $game['release_date'] ? date('M j, Y', strtotime($game['release_date'])) : '';
        
        $html .= '<div class="global_area_tabs_item" onclick="location.href=\'index.php?area=app&id=' . $appid . '\';">
<div class="global_area_tabs_item_img"><img alt="Buy ' . $name . '" height="45" src="themes/2008/images/capsules/capsule_sm_120_default.jpg" width="120"/></div>
<div class="global_area_tabs_item_txt"><h3>' . $name . '</h3>' . ($releaseDate ? 'Released: ' . $releaseDate : '') . '</div>
<div class="global_area_tabs_item_rating"></div>
<div class="global_area_tabs_item_price">$' . $price . '</div>
<br clear="all"/>
</div>';
    }
    
    return $html;
}

function cms_render_2008_extras_section(): string
{
    return '<div class="home_area_extras_header"><h2>Gifting on Steam</h2></div>
<div class="home_area_extras_bg">
<a href="index.php?area=support&topic=gifts" target="_blank"><img align="left" alt="Gifting on Steam" border="0" height="65" src="themes/2008/images/home_area_extras_gifts.jpg" width="113"/></a>
<a href="index.php?area=support&topic=gifts" target="_blank">Give the gift of game</a><br/>
Gift purchasing is available on Steam. Simply indicate your purchase is a gift during checkout, write a little gift message for your friend, and we\'ll do the rest.
</div>
<div class="home_area_extras_header"><h2>Merchandise</h2></div>
<div class="home_area_extras_bg">
<a href="http://store.valvesoftware.com" target="_blank"><img align="left" alt="Merchandise" border="0" height="65" src="themes/2008/images/home_area_extras_merch.jpg" width="113"/></a>
<a href="http://store.valvesoftware.com" target="_blank">Valve store </a><img align="bottom" border="0" src="themes/2008/images/ico/iconExternalLink.gif"/><br/>
Open 24/7, The Valve Store is your source for swagalicious apparel, posters, books, and collectibles for all your favorite Valve games.
</div>';
}

function cms_render_2008_sidebar_right(): string
{
    $db = cms_get_db();
    
    // Get recent news
    $stmt = $db->prepare("SELECT id, title FROM news ORDER BY date_created DESC LIMIT 8");
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<div id="home_area_steam_news">
<h2>Steam News</h2>
<ul id="home_area_news_list">';
    
    foreach ($news as $article) {
        $title = htmlspecialchars($article['title']);
        $id = (int)$article['id'];
        $html .= '<li><a href="index.php?area=news&id=' . $id . '">' . $title . '</a></li>';
    }
    
    $html .= '</ul>
<br/>
<a class="btn_blue" href="index.php?area=news">View all news</a>
</div>
<div id="home_area_videos">
<div id="home_area_videos_banner"> </div>
<h2>Videos/Trailers</h2>
<ul id="home_area_videos_list">';
    
    // Add sample video links
    $html .= '<li><a href="index.php?area=video&id=1">Sample Video 1</a></li>
<li><a href="index.php?area=video&id=2">Sample Video 2</a></li>
<li><a href="index.php?area=video&id=3">Sample Video 3</a></li>';
    
    $html .= '</ul>
<br/>
<a class="btn_blue" href="index.php?area=freestuff&type=videos">Browse all videos</a>
</div>
<div id="home_area_demos">
<div id="home_area_demos_banner"> </div>
<h2>Demos</h2>
<ul id="home_area_demos_list">';
    
    // Add sample demo links
    $html .= '<li><a href="index.php?area=demo&id=1">Sample Demo 1</a></li>
<li><a href="index.php?area=demo&id=2">Sample Demo 2</a></li>
<li><a href="index.php?area=demo&id=3">Sample Demo 3</a></li>';
    
    $html .= '</ul>
<br/>
<a class="btn_blue" href="index.php?area=freestuff&type=demos">Browse all demos</a>
</div>';
    
    return $html;
}

function cms_render_footer_2008(): string
{
    return '<div id="footer">
<div id="footer_logo"><a href="http://www.valvesoftware.com"><img alt="Valve Software" border="0" src="themes/2008/images/logo_valve_footer.jpg"/></a></div>
<div id="footer_text">
<form action="index.php">
<select name="l" onchange="submit();" style="width: 200px;">
<option value="english" selected>English</option>
<option value="french">French</option>
<option value="german">German</option>
<option value="spanish">Spanish</option>
<option value="italian">Italian</option>
<option value="japanese">Japanese</option>
<option value="korean">Korean</option>
<option value="portuguese">Portuguese</option>
<option value="russian">Russian</option>
<option value="schinese">Simplified Chinese</option>
<option value="tchinese">Traditional Chinese</option>
</select><br>
</form>
<p>© 2008 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.
<a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=ssa">Steam Subscriber Agreement</a>.
</p>
<p>
<br/>
<a href="http://www.valvesoftware.com/about.html" target="_blank">About Valve</a> | <a href="http://www.valvesoftware.com/business/" target="_blank">Business Solutions</a> | <a href="http://www.valvesoftware.com/jobs.html" target="_blank">Jobs</a> | <a href="index.php?area=cybercafes" target="_blank">Cyber Cafés</a>
</p>
</div>
</div>';
}

function cms_render_tab_switching_script(): string
{
    return 'function SelectTab( selected )
{
    // set tab
    document.getElementById( \'tab_1_li\' ).className = \'main_tab_off\';
    document.getElementById( \'tab_2_li\' ).className = \'main_tab_off\';
    document.getElementById( \'tab_3_li\' ).className = \'main_tab_off\';
    document.getElementById( \'tab_4_li\' ).className = \'main_tab_off\';
    document.getElementById( \'tab_\'+selected+\'_li\' ).className = \'main_tab_on\';

    // set content area
    document.getElementById( \'tab_1_content\' ).style.display = \'none\';
    document.getElementById( \'tab_2_content\' ).style.display = \'none\';
    document.getElementById( \'tab_3_content\' ).style.display = \'none\';
    document.getElementById( \'tab_4_content\' ).style.display = \'none\';
    document.getElementById( \'tab_\'+selected+\'_content\' ).style.display = \'\';
}';
}

function cms_render_string(string $html, array $vars, string $tpl_dir): string
{
    $hook = ['type' => 'string', 'template' => $html, 'vars' => $vars, 'path' => null];
    $hook = cms_apply_hooks('template_pre_render', $hook);
    $html = str_ireplace('{BASE}', '{{ BASE }}', $hook['template']);
    $env  = cms_twig_env($tpl_dir);
    $out  = $env->createTemplate($html)->render($hook['vars']);
    return cms_apply_hooks('template_post_render', $out);
}

function cms_cache_last_modified(string $path, string $theme): int
{
    $key = 'cms_last_mod|' . $theme . '|' . $path;
    if (function_exists('apcu_fetch')) {
        $cached = apcu_fetch($key);
        if ($cached !== false) {
            return (int) $cached;
        }
    }

    static $manifest;
    static $localCache = [];
    if (isset($localCache[$key])) {
        return $localCache[$key];
    }
    if ($manifest === null) {
        $file = __DIR__ . '/cache/manifest.json';
        $manifest = is_file($file) ? json_decode(file_get_contents($file), true) : [];
    }

    $times = [];
    if (isset($manifest[$theme]) && is_array($manifest[$theme])) {
        $times = array_map('intval', $manifest[$theme]);
    }

    if (is_file($path)) {
        $times[] = filemtime($path);
    }

    $cssFile = cms_get_theme_css($theme);
    $cssPath = dirname(__DIR__) . "/themes/$theme/" . ltrim($cssFile, '/');
    if (is_file($cssPath)) {
        $times[] = filemtime($cssPath);
    }

    $last = $times ? max($times) : 0;
    if (function_exists('apcu_store')) {
        apcu_store($key, $last, 60);
    }
    $localCache[$key] = $last;
    return $last;
}

function cms_process_all_assets(string $html, array $vars, string $theme, string $base_url): string
{
    static $assetCache = [];
    $cssFile = cms_get_theme_css($theme);
    $cssDir  = trim(dirname($cssFile), '/');
    if ($cssDir === '.') {
        $cssDir = '';
    }

    $pattern = '/(?:(?<attr>(?:src|href|background)=)(["\'])(?<path>[^"\']+)\2|url\((["\']?)(?<urlpath>[^)"\']+)\4\)|newImage\((["\'])(?<imgpath>[^"\']+)\6\))/i';

    return preg_replace_callback($pattern, function ($m) use ($vars, $cssDir, $base_url, $theme, &$assetCache) {
        if (!empty($m['attr'])) {
            $path     = $m['path'];
            $cacheKey = $theme . '|' . $path;
            if (isset($assetCache[$cacheKey])) {
                return $m['attr'] . '"' . $assetCache[$cacheKey] . '"';
            }
            if (preg_match('~^(?:https?:)?//|^/~', $path)) {
                return $m['attr'] . '"' . ($assetCache[$cacheKey] = $path) . '"';
            }
            if (preg_match('~^/?themes/~i', $path)) {
                return $m['attr'] . '"' . ($assetCache[$cacheKey] = $path) . '"';
            }
            $p      = parse_url($path, PHP_URL_PATH) ?? '';
            $ext    = strtolower(pathinfo($p, PATHINFO_EXTENSION));
            $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
            if (!in_array($ext, $assets, true)) {
                return $m['attr'] . '"' . ($assetCache[$cacheKey] = $path) . '"';
            }
            $dir = '';
            if ($ext === 'css') {
                if (str_starts_with($path, './')) {
                    $path = ltrim(substr($path, 2), '/');
                    $base = $base_url ? rtrim($base_url, '/') . '/' : '';
                    return $m['attr'] . '"' . ($assetCache[$cacheKey] = $base . $path) . '"';
                }
                $dir  = $cssDir;
                $path = basename($path);
                $path = cms_rewrite_css_file($theme, ($dir ? $dir . '/' : '') . $path, $vars['THEME_URL'], $base_url);
                return $m['attr'] . '"' . ($assetCache[$cacheKey] = $path) . '"';
            }
            if ($ext === 'js') {
                $dir = 'js';
            } else {
                $clean = ltrim($path, './');
                if (str_starts_with($clean, 'storefront/')) {
                    $clean = substr($clean, 11);
                }
                if (str_starts_with($clean, 'images/')) {
                    $clean = substr($clean, 7);
                }
                if (str_starts_with($clean, 'capsules/')) {
                    $base = $base_url ? rtrim($base_url, '/') . '/' : '';
                    return $m['attr'] . '"' . ($assetCache[$cacheKey] = $base . 'storefront/images/' . $clean) . '"';
                }
                $path = preg_replace('~^(?:img|images)/~', '', $clean);
                $path = preg_replace('~^storefront/~', '', $path);
                $path = ltrim($path, '/');
                $url  = cms_resolve_image($path, $theme, $vars['THEME_URL'], $base_url);
                return $m['attr'] . '"' . ($assetCache[$cacheKey] = $url) . '"';
            }
            if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
                $path = $dir . '/' . $path;
            }
            return $m['attr'] . '"' . ($assetCache[$cacheKey] = $vars['THEME_URL'] . '/' . $path) . '"';
        }
        if (isset($m['urlpath']) && $m['urlpath'] !== '') {
            $path = $m['urlpath'];
            if (preg_match('~^(?:https?:)?//|^/~', $path)) {
                return $m[0];
            }
            if (preg_match('~^/?themes/~i', $path)) {
                return 'url(' . $m[4] . $path . $m[4] . ')';
            }
            $p      = parse_url($path, PHP_URL_PATH) ?? '';
            $ext    = strtolower(pathinfo($p, PATHINFO_EXTENSION));
            $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];
            if (!in_array($ext, $assets, true)) {
                return 'url(' . $m[4] . $path . $m[4] . ')';
            }
            $dir = '';
            if ($ext === 'css') {
                if (str_starts_with($path, './')) {
                    $path = ltrim(substr($path, 2), '/');
                    $base = $base_url ? rtrim($base_url, '/') . '/' : '';
                    return 'url(' . $m[4] . $base . $path . $m[4] . ')';
                }
                $dir  = $cssDir;
                $path = basename($path);
            } elseif ($ext === 'js') {
                $dir = 'js';
            } else {
                $clean = ltrim($path, './');
                if (str_starts_with($clean, 'storefront/')) {
                    $clean = substr($clean, 11);
                }
                if (str_starts_with($clean, 'images/')) {
                    $clean = substr($clean, 7);
                }
                if (str_starts_with($clean, 'capsules/')) {
                    $base = $base_url ? rtrim($base_url, '/') . '/' : '';
                    return 'url(' . $m[4] . $base . 'storefront/images/' . $clean . $m[4] . ')';
                }
                $path = ltrim($clean, '/');
                $url  = cms_resolve_image($path, $theme, $vars['THEME_URL'], $base_url);
                return 'url(' . $m[4] . $url . $m[4] . ')';
            }
            if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
                $path = $dir . '/' . $path;
            }
            return 'url(' . $m[4] . $vars['THEME_URL'] . '/' . $path . $m[4] . ')';
        }
        $path = $m['imgpath'];
        if (preg_match('~^(?:https?:)?//|^/~', $path)) {
            return $m[0];
        }
        if (preg_match('~^/?themes/~i', $path)) {
            return 'newImage(' . $m[6] . $path . $m[6] . ')';
        }
        $p      = parse_url($path, PHP_URL_PATH) ?? '';
        $ext    = strtolower(pathinfo($p, PATHINFO_EXTENSION));
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
            $base = $base_url ? rtrim($base_url, '/') . '/' : '';
            return 'newImage(' . $m[6] . $base . 'storefront/images/' . $clean . $m[6] . ')';
        }
        $path = preg_replace('~^(?:img|images)/~', '', $clean);
        $path = preg_replace('~^storefront/~', '', $path);
        $path = ltrim($path, '/');
        $url  = cms_resolve_image($path, $theme, $vars['THEME_URL'], $base_url);
        return 'newImage(' . $m[6] . $url . $m[6] . ')';
    }, $html);
}

function cms_render_template(string $path, array $vars = []): void
{
    $theme = cms_get_setting('theme', '2004');
    $cache_enabled = cms_get_setting('enable_cache', '0') === '1';
    $cache_file = __DIR__ . '/cache/' . md5($path) . '.html';
    $lastModified = cms_cache_last_modified($path, $theme);
    if ($cache_enabled && file_exists($cache_file) && filemtime($cache_file) >= $lastModified) {
        readfile($cache_file);
        return;
    }

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

    $hook = ['type' => 'file', 'template' => basename($path), 'vars' => $vars, 'path' => $path];
    $hook = cms_apply_hooks('template_pre_render', $hook);

    $env = cms_twig_env($tpl_dir);
    cms_set_current_template($hook['template']);
    $html = $env->render($hook['template'], $hook['vars']);
    $html = cms_apply_hooks('template_post_render', $html);

    $html = cms_process_all_assets($html, $vars, $theme, $base_url);


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

    $hook = ['type' => 'file', 'template' => basename($path), 'vars' => $vars, 'path' => $path];
    $hook = cms_apply_hooks('template_pre_render', $hook);

    $env = cms_twig_env($tpl_dir);
    cms_set_current_template($hook['template']);
    $html = $env->render($hook['template'], $hook['vars']);
    $html = cms_apply_hooks('template_post_render', $html);

    $html = cms_process_all_assets($html, $vars, $theme, $base_url);

    echo $html;
}

function cms_resolve_image(string $path, string $theme, string $theme_url, string $base_url): string
{
    static $imageCache = [];
    $path = ltrim($path, '/');
    $key  = $theme . '|' . $path . '|' . $theme_url . '|' . $base_url;
    if (isset($imageCache[$key])) {
        return $imageCache[$key];
    }

    $themeFile = dirname(__DIR__) . "/themes/$theme/images/" . $path;
    if (is_file($themeFile)) {
        return $imageCache[$key] = $theme_url . '/images/' . $path;
    }

    $rootFile = dirname(__DIR__) . '/images/' . $path;
    if (is_file($rootFile)) {
        $base = $base_url ? rtrim($base_url, '/') . '/' : '';
        return $imageCache[$key] = $base . 'images/' . $path;
    }

    $base = $base_url ? rtrim($base_url, '/') . '/' : '';
    return $imageCache[$key] = $base . 'image_not_found.jpg';
}

function cms_rewrite_css_urls(string $css, string $theme, string $theme_url, string $css_dir, string $base_url): string
{
    return preg_replace_callback('/url\((["\']?)([^"\)]*)\1\)/i', function ($m) use ($theme, $theme_url, $css_dir, $base_url) {
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
            $path = ltrim($path, '/');
            $url  = cms_resolve_image($path, $theme, $theme_url, $base_url);
            return 'url('.$m[1].$url.$m[1].')';
        }
        if ($dir !== '' && !preg_match('~^(css|js|images)/~', $path)) {
            $path = $dir.'/'.$path;
        }
        return 'url('.$m[1].$theme_url.'/'.$path.$m[1].')';
    }, $css);
}

function cms_rewrite_css_file(string $theme, string $css_path, string $theme_url, string $base_url): string
{
    static $cache = [];
    $key  = $theme . '|' . $css_path . '|' . $theme_url . '|' . $base_url;
    if (isset($cache[$key])) {
        return $cache[$key];
    }

    $full = dirname(__DIR__)."/themes/$theme/".ltrim($css_path, '/');
    if (!file_exists($full)) {
        return $cache[$key] = $theme_url.'/'.ltrim($css_path, '/');
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
        $css = cms_rewrite_css_urls($css, $theme, $theme_url, $css_dir, $base_url);
        if (!is_dir($cache_dir)) {
            mkdir($cache_dir);
        }
        file_put_contents($cached, $css);
    }
    return $cache[$key] = ($base_url ? rtrim($base_url, '/'). '/' : '').'cms/cache/'.basename($cached);
}
