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
    $html = file_get_contents($path);
    $html = preg_replace_callback('/\{news_(full_article|partial_article|small_abstract|link_only)(?:\((\d+)\))?\}/i',
        function($m) use ($config){
            $type = strtolower($m[1]);
            $count = isset($m[2])? (int)$m[2] : ($config['news_count'] ?? null);
            return cms_render_news($type,$count);
        }, $html);
    if(isset($vars['content'])){
        $html = str_replace('{content}',$vars['content'],$html);
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
