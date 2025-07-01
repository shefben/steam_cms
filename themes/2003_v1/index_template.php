<?php
$page_title = $page_title ?? 'Welcome to Steam';
$html = file_get_contents(__DIR__.'/../../archived_steampowered/2003/v1/index.html');
$html = str_replace('steam.css','/archived_steampowered/2003/v1/steam.css',$html);
$html = str_replace('images/','/archived_steampowered/2003/v1/images/',$html);
// inject dynamic title
$html = preg_replace('/<title>.*?<\/title>/', '<title>'.htmlspecialchars($page_title).'</title>', $html);
echo $html;
?>
