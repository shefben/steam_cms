<?php
require_once __DIR__.'/news.php';
function cms_render_template($path, $vars=[]){
    $tpl_dir = dirname($path);
    $config = [];
    if(file_exists($tpl_dir.'/config.php')){
        $config = include $tpl_dir.'/config.php';
    }
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
    eval('?>'.$html);
}
?>
