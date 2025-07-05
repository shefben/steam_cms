<?php
$page_title = $page_title ?? 'Steam Powered';
$base = cms_base_url();
$html = file_get_contents(__DIR__.'/empty_page.html');
$html = str_replace('steam.css',$base.'/themes/2003_v1/steam.css',$html);
$html = preg_replace('#images/#',$base.'/themes/2003_v1/images/', $html);
$html = preg_replace('#<!-- being content area --><!-- end content area -->#','{content}', $html);
echo $html;
?>
