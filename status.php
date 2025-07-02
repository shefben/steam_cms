<?php
$page_title = 'Network Status';

include __DIR__.'/cms/header.php';
require_once __DIR__.'/cms/utilities/functions.php';
require_once __DIR__.'/cms/db.php';
$theme = cms_get_setting('theme','2004');
if(!in_array($theme,['2003','2004','2005'])){
    readfile(__DIR__.'/archived_steampowered/2006+2007_statistics/index.html');
    include __DIR__.'/cms/footer.php';
    return;
}

$now   = time();
$start = $now - 48*3600;
$stepS = 20*60;           // 20-minute buckets (matches graphs)

[$pUsage, $pServers] = player_data($PTS = 144, $start, $stepS, 200_000);
[$bwUsage,  $bwCap]   = bw_data    ($PTS, $start, $stepS, 8_000);

// helpers
$curP = end($pUsage)['v'];               
$minP = min(array_column($pUsage,'v'));     
$maxP = max(array_column($pUsage,'v'));    // 💡 NOW it's defined

$curS = end($pServers);                   
$minS = min($pServers);                 
$maxS = max($pServers);

$curB = end($bwUsage)['v'];            
$minB = min(array_column($bwUsage,'v'));   
$maxB = max(array_column($bwUsage,'v'));

$curC = end($bwCap);                        
$minC = min($bwCap);                       
$maxC = max($bwCap);

/* ─── HEADLINE MONTHLY AVERAGES ─── */
$head = headline_stats($maxP);
$avgUsers   = $head['users'];
$avgMinutes = $head['minutes'];

// pretty timestamp
$tsNow = new DateTime('now', new DateTimeZone(TIMEZONE));
$tsGmt = clone $tsNow; $tsGmt->setTimeZone(new DateTimeZone('GMT'));
?>
<link rel="stylesheet" type="text/css" href="steampowered.css">
<style type="text/css">
	BODY	{color:#A0AA95; font-size:8pt;}
	.capsule	{ background: #2C3329; width: 100%; margin:8px 0px 8px 0px;}
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
	.content	 { background:#4C5844;
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
		\\background:red;
		line-height:18px;
		}

</style>
<div class="content">
                <h1>NETWORK STATUS</H1>
<span style="float:right;">
  Updated <?= $tsNow->format('g:ia T'); ?> (<?= $tsGmt->format('H:i'); ?> GMT),
  <?= $tsNow->format('F d Y'); ?>
</span>
                <b style="color:white;">Steam is: ONLINE</b>

                <div class="capsule" name="players">
                        <div class="captop"><div></div></div><div class="capcontent">
                                <b style="margin-left:42px;">STEAM PLAYERS & GAME SERVERS -- most recent 48 hours</b><br>
                                <a href="game_stats.html"><img src="player_graph.php"></a><br><br>


                                </div>
<div class="legendRight">
  Average unique users per month:
  <?= number_format($avgUsers); ?><br>

  Average player minutes per month:
  <?= human_unit_format($avgMinutes); ?><br>

  <a href="game_stats.html">View stats detail chart</a>
</div>

<div class="legend"><table>
<tr><td></td><td align="right">current</td><td align="right">min</td><td align="right">max</td></tr>
  <tr><td><span style="color:#BEAD45;font-family:wingdings;">n</span> Player Count</td>
<td align="right"><?=number_format($curP);?></td>
<td align="right"><?=number_format($minP);?></td>
<td align="right"><?=number_format($maxP);?></td></tr>
  <tr><td><span style="color:#A0AA95;font-family:wingdings;">n</span> Server Count</td>
<td align="right"><?=number_format($curS);?></td>
<td align="right"><?=number_format($minS);?></td>
<td align="right"><?=number_format($maxS);?></td></tr>
</table></div>
<div class="capbot"><div></div></div>
                </div>
                <br>
                <div class="capsule" name="content servers">
                        <div class="captop"><div></div></div><div class="capcontent">
                               <b style="margin-left:42px;">CONTENT SERVERS AGGREGATE BANDWIDTH USED -- most recent 48 hours</b><br>
                                <a href="content_servers.php"><img src="cs_graph.php"></a><br><br>

 </div><div class="legendRight"><br><br><a href="content_servers.php">View content server detail chart</a></div>
<div class="legend"><table>
<tr><td></td><td align="right">current</td><td align="right">min</td><td align="right">max</td></tr>
  <tr><td><span style="color:#BEAD45;font-family:wingdings;">n</span> Bandwidth Used</td>
<td align="right"><?=number_format($curB);?></td>
<td align="right"><?=number_format($minB);?></td>
<td align="right"><?=number_format($maxB);?></td></tr>
<tr><td><span style="color:#A0AA95;font-family:wingdings;">n</span> Bandwidth Available</td>
<td align="right"><?=number_format($curC);?></td>
<td align="right"><?=number_format($minC);?></td>
<td align="right"><?=number_format($maxC);?></td></tr>

</table></div>
<div class="capbot"><div></div></div>
                </div>
        </div>
<?php include __DIR__.'/cms/footer.php'; ?>
