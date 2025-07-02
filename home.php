<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';

$theme = cms_get_setting('theme','2004');
$tpl = __DIR__."/themes/$theme/index_template.php";
if(!file_exists($tpl)){
    $tpl = __DIR__.'/themes/2004/index_template.php';
}

$page = cms_get_custom_page($theme.'_index',$theme);
if(!$page){
    $page = cms_get_custom_page('default_index',$theme);
}
if($page){
    $page_title = $page['title'];
    $content = $page['content'];
}else{
    $page_title = 'Welcome to Steam';
    $content = '';
}

cms_render_template($tpl, ['page_title'=>$page_title, 'content'=>$content]);
