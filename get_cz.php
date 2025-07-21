<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';
$theme = cms_get_setting('theme','2004');
$page = cms_get_custom_page('get_cz',$theme);
$page_title = $page['title'] ?? 'Counter-Strike: Condition Zero';
$tpl = cms_theme_layout('default.twig', $theme);
$content = $page['content'] ?? '';
cms_render_template($tpl,['page_title'=>$page_title,'content'=>$content]);
