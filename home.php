<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';

$theme = cms_get_setting('theme','2004');
$tpl = cms_theme_layout('index.twig', $theme);

$slug_clean  = str_replace('_','',$theme).'_index';
$slug_legacy = $theme.'_index';
$page = cms_get_custom_page($slug_clean,$theme);
if(!$page && $slug_clean!==$slug_legacy){
    $page = cms_get_custom_page($slug_legacy,$theme);
}
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

// Explicitly render using the resolved theme to avoid stale cached settings
// that can lead to the wrong layout being used (e.g. missing main content).
cms_render_template_theme($tpl, $theme, ['page_title'=>$page_title, 'content'=>$content]);
