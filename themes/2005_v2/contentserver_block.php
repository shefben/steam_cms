<style type="text/css">
BODY {color:#A0AA95; font-size:8pt;}
.capsule { background:#2C3329; width:100%; margin:8px 0;}
.captop div{ background:url(/img/tl.gif) no-repeat top left; }
.captop{ background:url(/img/tr.gif) no-repeat top right; }
.capbot div{ background:url(/img/bl.gif) no-repeat bottom left; }
.capbot{ background:url(/img/br.gif) no-repeat bottom right; }
.captop div,.captop,.capbot div,.capbot{ width:100%; height:7px; font-size:1px; }
.capcontent{ margin:0 7px; }
.content{ background:#4C5844; padding:8px 0 32px; margin:0 0 24px 68px; width:760px; }
TABLE{ margin:0; border:none; }
TD{ font-size:8pt; padding:0 16px 0 0; }
.legend{ margin:0 0 0 16px; padding:4px; margin:0 7px; }
.legendRight{ float:right; text-align:right; margin:4px 7px; line-height:18px; }
</style>
<script src="/pop.js"></script>
<div class="content">
<h1>CONTENT SERVERS</h1>
<span style="float:right;">This page last updated: <?php echo date('g:ia \P\S\T (O), F d Y', strtotime($last_update)); ?></span>
Total Available Bandwidth: <?php echo number_format($total_available,2); ?>Mbps<br>
Total Used Bandwidth: <?php echo number_format($total_capacity-$total_available,2); ?>Mbps
<?php
$regions=[];
foreach($servers as $srv){
    $reg = $srv['region'] ?? 'Unknown';
    $regions[$reg][]=$srv;
}
foreach($regions as $region=>$list){?>
<div class="capsule" name="<?php echo htmlspecialchars($region); ?>">
<div class="captop"><div></div></div>
<div class="capcontent">
<table width="100%">
<tr><td align="right" width="260"></td><td><b><?php echo htmlspecialchars($region); ?></b></td></tr>
<?php foreach($list as $s){
    $load = $s['total_capacity']? (1 - $s['available_bandwidth']/$s['total_capacity'])*100 : 0;
    $avail = 100 - $load; ?>
<tr>
<td align="right">
<?php if(!empty($s['website'])): ?>
    <a href="<?php echo htmlspecialchars($s['website']); ?>"><?php echo htmlspecialchars($s['name']); ?></a>
<?php else: ?>
    <?php echo htmlspecialchars($s['name']); ?>
<?php endif; ?>
<?php if(!empty($s['filtered'])): ?> <font color="#5B5B5B">[<a class="filter_link" href="javascript:popUp('filtered_servers.php')">filtered</a>]</font><?php endif; ?>
</td>
<td>
<table class="statusGraph" width="<?php echo max(1,(int)$load); ?>%" cellspacing="0">
<tr><td class="CurrentLoad" width="<?php echo (int)$load; ?>%"></td><td class="AvailableBytesPerSecond" width="<?php echo (int)$avail; ?>%"></td></tr>
</table>
</td>
</tr>
<?php } ?>
</table>
</div>
<div class="capbot"><div></div></div>
</div>
<?php } ?>
</div>
