<?php
require_once __DIR__.'/cms/db.php';
$theme = cms_get_setting('theme','2004');
$tpl = cms_theme_layout('map_contest.twig', $theme);
cms_render_template($tpl, ['page_title'=>'Invalid Area']);
?>
