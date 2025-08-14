<style type="text/css">
 div.statsTop {
        width:auto;
        text-align:center;
 }
 .statsTop table {
        margin-left:15px;
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:16px;
        font-weight:normal;
        color:#787878;
 }
 .statsTop td {
        padding-top:2px;
        padding-bottom:3px;
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:11px;
 }
 .statsTopHi {
        color:#c98d33;
        font-weight:bold;
 }
 .statsTopSmall {
        font-size:11px;
 }
 TABLE.statusGraph {
        cell-spacing:0px;
        cell-padding:0px;
        height:4px;
        margin:4px 0px 0px 0px;
 }
 TD.CurrentLoad {
        background:#C98D33;
        height:4px;
 }
 TD.AvailableBytesPerSecond {
        background:#5B5B5B;
 }
 a#detailLink{
        color:#c98d33;
        font-size:13px;
 }
 .capsule {
        width:611px;
        margin-bottom:8px;
        padding-top:14px;
 }
 .capsule a,.capsule a:visited, .capsule a:hover {
        color:#c98d33;
 }
 a.filter_link, a:visited.filter_link {
        color:#5B5B5B;
 }
 .capsuleRegionName {
        font-size:14px;
        font-weight:bold;
        padding-bottom:4px;
        padding-top:5px;
        font-family:Verdana, Arial, Helvetica, sans-serif;
 }
 .capsule_table td {
        font-size:11px;
        font-family:Verdana, Arial, Helvetica, sans-serif;
 }
</style>
<script src="/pop.js"></script>
<p>&nbsp;</p>
<h1>CONTENT SERVER STATS</h1>
<p><img height="10" src="img/hr_stats_clr.gif" width="636"/></p>
<div class="statsTop">
<table border="0" cellpadding="0" cellspacing="0" width="612">
<tr>
<td align="left" width="100%"><table border="0" cellpadding="5" cellspacing="0">
<tr>
<td align="left">&nbsp;</td>
<td align="right" width="85">current</td>
<td align="right" width="85">peak</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="left">Used Bandwidth:</td>
<td align="right"><span class="statsTopHi"><?php echo number_format($total_capacity - $total_available); ?></span></td>
<td align="right"><span class="statsTopHi"><?php echo number_format($total_capacity - $total_available); ?></span></td>
<td align="left">&nbsp;&nbsp;Mbit</td>
</tr>
<tr>
<td align="left">Available Bandwidth:</td>
<td align="right"><span class="statsTopHi"><?php echo number_format($total_available); ?></span></td>
<td align="right"><span class="statsTopHi"><?php echo number_format($total_available); ?></span></td>
<td align="left">&nbsp;&nbsp;Mbit</td>
</tr>
</table></td>
</tr>
</table>
</div>
<script type="text/javascript">
function toggleDetailStats()
{
        var thediv = document.getElementById('detailStats');
        if(thediv.style.display === 'block')
        {
                thediv.style.display = 'none';
        }
        else
        {
                thediv.style.display = 'block';
        }
}
</script>
<p align="center" style="width:auto; text-align:center;"><a href="javascript:void(0)" id="detailLink" onclick="toggleDetailStats()" onmouseout="window.status='';return true" onmouseover="window.status='Show Detailed Statistics';return true">View individual server statistics</a></p>
<div id="detailStats" style="display:none; width:630px; margin-left:40px;">
<?php
$regions = [];
$maxCapacity = 0.0;
foreach ($servers as $srv) {
    $reg = $srv['region'] ?? 'Unknown';
    $regions[$reg][] = $srv;
    if (($srv['total_capacity'] ?? 0) > $maxCapacity) {
        $maxCapacity = $srv['total_capacity'];
    }
}
ksort($regions, SORT_NATURAL | SORT_FLAG_CASE);
foreach ($regions as &$list) {
    usort($list, fn($a, $b) => strcasecmp($a['name'], $b['name']));
}
unset($list);
foreach ($regions as $region => $list) {
?>
<div class="capsule" name="<?php echo htmlspecialchars($region); ?>">
<table align="center" border="0" cellpadding="5" cellspacing="0" class="capsule_table" width="630">
<tr><td align="center" colspan="2"><span class="capsuleRegionName"><?php echo htmlspecialchars($region); ?></span></td></tr>
<?php foreach ($list as $s) {
    $used = ($s['total_capacity'] ?? 0) - ($s['available_bandwidth'] ?? 0);
    $load = ($s['total_capacity'] ?? 0) > 0 ? ($used / $s['total_capacity']) * 100 : 0;
    $load = max(0, min(100, $load));
    $avail = 100 - $load;
?>
<tr>
<td align="right" width="210">
<?php if (!empty($s['website'])): ?>
    <a href="<?php echo htmlspecialchars($s['website']); ?>"><?php echo htmlspecialchars($s['name']); ?></a>
<?php else: ?>
    <?php echo htmlspecialchars($s['name']); ?>
<?php endif; ?>
<?php if(!empty($s['filtered'])): ?> <font color="#5B5B5B">[<a class="filter_link" href="javascript:popUp('filtered_servers.php')">filtered</a>]</font><?php endif; ?>&nbsp;&nbsp;
</td>
<td align="left" width="420"><table cellspacing="0" class="statusGraph" width="405">
<tr><td class="CurrentLoad" width="<?php echo (int) $load; ?>%"></td><td class="AvailableBytesPerSecond" width="<?php echo (int) $avail; ?>%"></td></tr></table></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
</div>
<p><img height="10" src="img/hr_stats.gif" width="636"/></p>
<div class="statsOverview">
<table border="0" cellpadding="2" cellspacing="0" width="638">
<tr>
<td width="302"><img src="img/ico/ico_arrow_blue.gif"/> <a href="http://www.steampowered.com/v/index.php?area=stats">Player and Server Statistics</a></td>
<td width="328"><img src="img/ico/ico_arrow_blue.gif"/> <a href="http://www.dayofdefeat.com/stats/">Day of Defeat Gameplay Stats </a></td>
</tr>
<tr>
<td><img src="img/ico/ico_arrow_blue.gif"/> <a href="http://www.steampowered.com/status/survey.html">Steam Hardware Survey</a></td>
<td><img src="img/ico/ico_arrow_blue.gif"/> <a href="stats/ep1/">Half-Life 2: Episode One Gameplay Stats </a></td>
</tr>
<tr>
<td><img src="img/ico/ico_arrow_blue.gif"/> <a href="http://steampowered.com/stats/csmarket">Counter-Strike Weapons Market</a></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</div>
