<?php
require_once __DIR__.'/news.php';
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
    $base_url = cms_base_url();
    $vars['THEME_URL'] = ($base_url ? $base_url : '') . "/themes/$theme";
    $html = file_get_contents($path);
    $process = function($text) use ($config){
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
        return $text;
    };
    $html = $process($html);
    // ensure theme-specific stylesheet paths
    $css_path = $vars['THEME_URL'] . '/steampowered02.css';
    $html = preg_replace('~(?:\.\./)?steampowered02\.css~i', $css_path, $html);
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
