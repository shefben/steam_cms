<?php
require_once __DIR__.'/news.php';

function cms_theme_layout(string $file, ?string $theme = null){
    $theme = $theme ?? cms_get_setting('theme','2004');
    $base = dirname(__DIR__)."/themes/$theme/layouts/$file";
    if(!file_exists($base)){
        $base = dirname(__DIR__)."/themes/2004/layouts/$file";
    }
    return $base;
}
function cms_render_template($path, $vars=[]){
    $cache_enabled = cms_get_setting('enable_cache','0')==='1';
    $cache_file = __DIR__.'/cache/'.md5($path).'.html';
    if($cache_enabled && file_exists($cache_file) && filemtime($cache_file) >= filemtime($path)){
        readfile($cache_file);
        return;
    }
    $tpl_dir = dirname($path);
    $config = [];
    if(file_exists($tpl_dir.'/config.php')){
        $config = include $tpl_dir.'/config.php';
    }
    // expose useful paths to templates
    $vars['CMS_ROOT'] = __DIR__;
    $vars['THEME_DIR'] = $tpl_dir;
    $theme = cms_get_setting('theme', '2004');
    $subdir = $vars['theme_subdir'] ?? '';
    $base_url = cms_base_url();
    $vars['THEME_URL'] = ($base_url ? $base_url : '') . "/themes/$theme" . ($subdir ? "/$subdir" : '');
    $css_file = cms_get_theme_css($theme);
    $vars['CSS_PATH'] = ($base_url ? $base_url : '') . "/themes/$theme/" . ltrim($css_file, '/');
    $html = file_get_contents($path);
    $process = function($text) use ($config, $theme, &$process){
        $text = preg_replace_callback('/\{news_(full_article|partial_article|small_abstract|link_only|index_summary|index_summary_date|index_brief)(?:\((\d+)\))?\}/i',
            function($m) use ($config){
                $type = strtolower($m[1]);
                $count = isset($m[2])? (int)$m[2] : ($config['news_count'] ?? null);
                return cms_render_news($type,$count);
            }, $text);
        $text = preg_replace_callback('/\{nav_buttons(?:\(([^}]+)\))?\}/i',
            function($m){
                $args = isset($m[1]) ? array_map('trim', explode(',', $m[1], 2)) : [];
                $theme = $args[0] !== '' ? $args[0] : cms_get_setting('theme','2004');
                $style = $args[1] ?? '';
                return cms_header_buttons_html($theme, $style);
            }, $text);
        $text = preg_replace('/\{footer\}/i', cms_get_theme_footer($theme), $text);
        $text = preg_replace_callback('/\{partial_([a-zA-Z0-9_-]+)\}/i', function($m) use($theme, $subdir, &$process){
            $suffix = $subdir ? "/$subdir" : '';
            $file = dirname(__DIR__)."/themes/$theme{$suffix}/partials/{$m[1]}.tpl";
            if(!file_exists($file)){
                $file = dirname(__DIR__)."/themes/2004{$suffix}/partials/{$m[1]}.tpl";
                if(!file_exists($file)) return '';
            }
            $c = file_get_contents($file);
            return $process($c);
        }, $text);
        return $text;
    };
    $html = $process($html);
    // ensure theme-specific stylesheet paths
    $css_base = basename($css_file);
    $css_path = $vars['CSS_PATH'];
    $html = preg_replace('~(?:\.\./)?' . preg_quote($css_base, '~') . '~i', $css_path, $html);
    $html = preg_replace_callback('/(src|href)=["\']([^"\']+)["\']/', function($m) use($vars){
        $path = $m[2];
        if(preg_match('~^(?:https?:)?//|^/~', $path)) return $m[0];
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if($ext === 'css'){ $dir = 'css'; }
        elseif($ext === 'js'){ $dir = 'js'; }
        else { $dir = 'images'; }
        if(!preg_match('~^(css|js|images)/~', $path)) $path = $dir.'/'.$path;
        return $m[1].'="'.$vars['THEME_URL'].'/'.$path.'"';
    }, $html);
    if(isset($vars['content'])){
        $vars['content'] = $process($vars['content']);
        $html = str_replace('{content}', $vars['content'], $html);
    }
    extract($vars);
    ob_start();
    eval('?>'.$html);
    $output = ob_get_clean();
    if($cache_enabled){
        if(!is_dir(__DIR__.'/cache')) mkdir(__DIR__.'/cache');
        file_put_contents($cache_file, $output);
    }
    echo $output;
}
?>
