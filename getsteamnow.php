<?php
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/template_engine.php';

$page_title = 'Get Steam Now!';
$theme = cms_get_setting('theme','2004');
$page = cms_get_download_page($theme);
$files = cms_get_all_download_files($theme, $page ? $page['version'] : null);

ob_start();
if ($page) {
    echo $page['content'];
} else {
    echo '<p>Download page not available.</p>';
}
if ($files) {
    function mirror_button($host,$url){
        $u = htmlspecialchars($url);
        $h = htmlspecialchars($host);
        return '<table cellspacing="0" cellpadding="0"><tr>'
            .'<td nowrap><img src="./getsteamnow_older_files/black_button2_leftside.gif" width="10" height="20"></td>'
            ."<td bgcolor='#000000' nowrap width='150'><a class='maize' href='$u' style='font-size: 11px;'>$h</a></td>"
            .'<td nowrap><img src="./getsteamnow_older_files/black_button2_rightside.gif" width="10" height="20"></td>'
            .'</tr></table>';
    }
    $ver = $page ? $page['version'] : '';
    if ($theme === '2003_v2') {
        if ($ver === '2003_v2_dlv3') {
            foreach ($files as $f) {
                echo '<br><h2>'.htmlspecialchars($f['title']).': ('.htmlspecialchars($f['file_size']).')</h2>';
                foreach ($f['mirrors'] as $i=>$m) {
                    $host = ($i+1).': '.htmlspecialchars($m['host']);
                    echo '<a class="maize" href="'.htmlspecialchars($m['url']).'" style="font-size: 11px;">'.$host.'</a><br>';
                }
                echo '<br>';
            }
        } else { // versions 1 or 2 use button tables
            foreach ($files as $f) {
                if ($ver === '2003_v2_dlv2') {
                    // no title
                } else {
                    echo '<br><h3>'.htmlspecialchars($f['title']).': ('.htmlspecialchars($f['file_size']).')</h3><br>';
                }
                echo '<table width="525" cellpadding="0" cellspacing="0"><tr>';
                $cols = array_chunk($f['mirrors'], 2);
                foreach ([0,1,2] as $c) {
                    echo '<td valign="top" width="33%">';
                    if(isset($cols[$c])){
                        foreach($cols[$c] as $m){
                            echo mirror_button($m['host'],$m['url']);
                            echo '<br>';
                        }
                    }
                    echo '</td>';
                }
                echo '</tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table><br>';
            }
        }
    } else { // 2004 theme
        $buttonMode = in_array($ver, ['2004_dlv2','2004_dlv3']);
        foreach ($files as $f) {
            $url = htmlspecialchars($f['main_url']);
            $size = htmlspecialchars($f['file_size']);
            if ($f['usingbutton'] && $buttonMode) {
                require_once __DIR__.'/cms/utilities/text_styler.php';
                $text = $f['buttonText'] !== '' ? $f['buttonText'] : "  CLICK HERE TO DOWNLOAD THE STEAM INSTALLER ( $size )";
                echo "<a href='$url'>".renderGetSteamNowButton($text)."</a><br>";
            } else {
                echo '<h2>'.htmlspecialchars($f['title']).': ('.htmlspecialchars($f['file_size']).')</h2>';
                echo '<a class="maize" href="'.$url.'" style="font-size:11px;">'.$f['title'].'</a><br>';
            }
            if (!empty($f['mirrors'])) {
                echo '<div class="box">';
                foreach ($f['mirrors'] as $i=>$m) {
                    $host = ($i+1).'. '.htmlspecialchars($m['host']);
                    echo '<a class="maize" href="'.htmlspecialchars($m['url']).'" style="font-size: 11px;">'.$host.'</a><br>';
                }
                echo '</div><br>';
            }
        }
    }
}
$content = ob_get_clean();
$tpl = cms_theme_layout(null, $theme);
cms_render_template($tpl, ['page_title'=>$page_title,'content'=>$content]);
