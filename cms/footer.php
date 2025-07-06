<?php
require_once __DIR__.'/db.php';
$theme = cms_get_setting('theme','2004');
echo cms_get_theme_footer($theme);
