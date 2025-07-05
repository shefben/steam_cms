<?php
$page_title = $page_title ?? 'Welcome to Steam';
$base = cms_base_url();
$html = file_get_contents(__DIR__.'/../../archived_steampowered/2003/v2/index.html');
$html = preg_replace('/<!-- begin header -->.*<!-- end header -->/s','',$html);
$html = preg_replace('/<!-- begin footer -->.*<!-- end footer -->/s','',$html);
$html = str_replace('steampowered.css',$base.'/themes/2003_v2/steampowered.css',$html);
$html = str_replace('nav.js',$base.'/themes/2003_v2/nav.js',$html);
$html = preg_replace('#img\\/#',$base.'/themes/2003_v2/img/', $html);
$html = preg_replace('#<div class="box">.*?</div>#s','{news_index_summary(5)}',$html,1);
include $THEME_DIR.'/header_nobuttons.php';
echo $html;
include $CMS_ROOT.'/footer.php';
?>
