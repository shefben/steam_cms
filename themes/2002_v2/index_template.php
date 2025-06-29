<?php
$page_title = $page_title ?? 'Welcome to Steam';
$html = file_get_contents(__DIR__.'/../../archived_steampowered/2002/v2/index.html');
// fix relative asset paths
$html = str_replace('Images/','/archived_steampowered/2002/v2/Images/',$html);
// inject dynamic title
$html = preg_replace('/<title>.*?<\/title>/', '<title>'.htmlspecialchars($page_title).'</title>', $html);
echo $html;
?>
