<link rel="stylesheet" href="/static_pages/2007_contentserver_stats/css/styles_content.css">
<style type="text/css">
.capsule{width:611px;margin-bottom:8px;padding-top:14px;}
.capsule_table td{font-size:11px;font-family:Verdana, Arial, Helvetica, sans-serif;}
.capsuleRegionName{font-size:14px;font-weight:bold;padding-bottom:4px;padding-top:5px;font-family:Verdana, Arial, Helvetica, sans-serif;}
.CurrentLoad{background:#c98d33;height:4px;}
.AvailableBytesPerSecond{background:#5b5b5b;}
</style>
<h1>CONTENT SERVER STATS</h1>
<span style="float:right;" class="statsTopSmall">Updated: <?php echo date('M j, Y - g:ia', strtotime($last_update)); ?></span>
<p><span class="copyHead">Content Server Bandwidth</span> (most recent 48 hours)</p>
<img src="/status/2007_graph.php" width="670" height="310" alt="graph"><br>
<script>
function toggleDetailStats(){var d=document.getElementById('detailStats');d.style.display=d.style.display=='block'?'none':'block';}
</script>
<p align="center"><a id="detailLink" href="javascript:void(0)" onclick="toggleDetailStats()">View individual server statistics</a></p>
<div id="detailStats" style="display:block;width:630px;margin-left:40px;">
<?php $regions=[];foreach($servers as $srv){$reg=$srv['region']??'Unknown';$regions[$reg][]=$srv;}foreach($regions as $region=>$list){?>
    <div class="capsule" name="<?php echo htmlspecialchars($region); ?>">
        <table border="0" align="center" class="capsule_table" width="630" cellspacing="0" cellpadding="5">
            <tr><td colspan="2" align="center"><span class="capsuleRegionName"><?php echo htmlspecialchars($region); ?></span></td></tr>
            <?php foreach($list as $s){ $load=$s['total_capacity']?(1-$s['available_bandwidth']/$s['total_capacity'])*100:0;$avail=100-$load; ?>
            <tr>
                <td width="210" align="right"><?php echo htmlspecialchars($s['name']); ?>&nbsp;&nbsp;</td>
                <td width="420" align="left">
                    <table class="statusGraph" width="405" cellspacing="0">
                        <tr><td class="CurrentLoad" width="<?php echo (int)$load; ?>%"></td><td class="AvailableBytesPerSecond" width="<?php echo (int)$avail; ?>%"></td></tr>
                    </table>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>
</div>
