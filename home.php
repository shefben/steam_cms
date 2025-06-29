<?php
require_once __DIR__.'/cms/template_engine.php';
$page_title = 'Welcome to Steam';
$theme = cms_get_setting('theme','2004');
cms_render_template(__DIR__.'/themes/'.$theme.'/index_template.php',[ 'page_title'=>$page_title ]);
