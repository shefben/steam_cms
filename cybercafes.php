<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';
$theme = cms_get_current_theme();
$page = cms_get_custom_page('cybercafes',$theme);
$page_title = $page['title'] ?? 'Cyber Cafés';
$tpl = cms_theme_layout('default.twig', $theme);
$content = $page['content'] ?? '';
cms_render_template($tpl,['page_title'=>$page_title,'content'=>$content]);
