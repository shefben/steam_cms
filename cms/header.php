<?php
require_once __DIR__.'/db.php';
$theme = cms_get_current_theme();
echo cms_render_header($theme);
