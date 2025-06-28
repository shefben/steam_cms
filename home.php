<?php
require_once __DIR__.'/cms/template_engine.php';
$page_title = 'Welcome to Steam';
cms_render_template(__DIR__.'/themes/2004/index_template.php',[ 'page_title'=>$page_title ]);
