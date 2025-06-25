<?php
$page_title = 'Network Status';
include __DIR__.'/../cms/header.php';
?>
<style type="text/css">
        BODY    {color:#A0AA95; font-size:8pt;}
        .capsule        { background: #2C3329; width: 100%; margin:8px 0px 8px 0px;}
        .captop div  { background: url(/img/tl.gif) no-repeat top left; }
        .captop      { background: url(/img/tr.gif) no-repeat top right; }
        .capbot div  { background: url(/img/bl.gif) no-repeat bottom left; }
        .capbot      { background: url(/img/br.gif) no-repeat bottom right; }
        .captop div, .captop, .capbot div, .capbot {
                width: 100%;
                height: 7px;
                font-size: 1px;
                }
        .capcontent  { margin: 0 7px; border-bottom-style:solid;border-bottom-color:#4C5844;border-bottom-width:2px;}
        .content         { background:#4C5844;
                padding:8px 0px 32px 0px;
                margin:0px 0px 24px 68px;
                width:760px;}
        TABLE {
                margin:0px 0px 0px 0px;
                border:none;
                }
        TD {
                font-size:8pt;
                padding:0px 32px 0px 0px;
                }
        .legend {
                margin:0px 0px 0px 16px;
                padding:4px 4px 4px 4px;
                margin: 0 7px;
                }
        .legendRight {
                float:right;
                text-align:right;
                margin: 4px 7px;
                line-height:18px;
                }
</style>
<div class="content">
                <h1>NETWORK STATUS</H1>
                <span style="float:right;">This page last updated: 4:55am PST (12:55 GMT), November 02 2004</span>
                <b style="color:white;">Steam is: ONLINE</b>

                <div class="capsule" name="players">
                        <div class="captop"><div></div></div><div class="capcontent">
                                <b style="margin-left:42px;">STEAM PLAYERS & GAME SERVERS -- most recent 48 hours</b><br>
                                <a href="game_stats.html"><img src="player_graph.php"></a><br><br>
                                </div><div class="legendRight">Average unique users per month: 1,823,314<br>Average player minutes per month: 4.201 billion<br><a href="game_stats.html">View stats detail chart</a></div><div class="legend"><table><tr><td></td><td align="right">current</td><td align="right">min</td><td align="right">max</td></tr><tr><td><span style="color:#BEAD45;font-family:wingdings;">n</span> Player Count</td><td align="right">103,466 </td><td align="right">59,040 </td><td align="right">160,646 </td></tr><tr><td><span style="color:#A0AA95;font-family:wingdings;">n</span> Server Count</td><td align="right">62,615 </td><td align="right">52,605 </td><td align="right">71,948 </td></tr></table></div><div class="capbot"><div></div></div>
                </div>
                <br>
                <div class="capsule" name="content servers">
                        <div class="captop"><div></div></div><div class="capcontent">
                                <b style="margin-left:42px;">CONTENT SERVERS AGGREGATE BANDWIDTH USED -- most recent 48 hours</b><br>
                                <a href="content_servers.php"><img src="cs_graph.php"></a><br><br>
                                </div><div class="legendRight"><br><br><a href="content_servers.php">View content server detail chart</a></div><div class="legend"><table><tr><td></td><td align="right">current</td><td align="right">min</td><td align="right">max</td></tr><tr><td><span style="color:#BEAD45;font-family:wingdings;">n</span> Bandwidth Used</td><td align="right">1,774 Mbps</td><td align="right">1,263 Mbps</td><td align="right">3,064 Mbps</td></tr><tr><td><span style="color:#A0AA95;font-family:wingdings;">n</span> Bandwidth Available</td><td align="right">10,460 Mbps</td><td align="right">9,560 Mbps</td><td align="right">12,080 Mbps</td></tr></table></div><div class="capbot"><div></div></div>
                </div>
        </div>
<?php include __DIR__.'/../cms/footer.php'; ?>
