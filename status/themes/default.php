<div class="content" id="container">
<h1>STEAM NETWORK STATUS</h1>
<h2>STEAM IS <span style="color: <?php echo $steam_online ? '#00A000' : 'red'; ?>;"><?php echo $steam_online ? 'ONLINE' : 'OFFLINE'; ?></span></h2><img src="./img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="statusContent">
This page last updated: <?php echo date("g:ia, F d Y", strtotime($last_update)); ?> (Pacific Time, GMT -8)<br>
<hr class="status">
<div id="misc">
<table class="status" cellpadding="0" cellspacing="0">
<tr>
<td class="details">Total current system capacity</td>
<td><?php echo number_format($total_capacity,2); ?>Mbps</td>
</tr>
<tr>
<td class="details">Total available</td>
<td><?php echo number_format($total_available,2); ?>Mbps</td>
</tr>
</tbody></table>
</div><br>
<?php foreach ($servers as $s): ?>
<?php echo render_server_block($s, $max_capacity); ?>
<?php endforeach; ?>
</div>
</div>
