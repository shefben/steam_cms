<?php
require_once "functions.php";
$db=db_connect();
$main_ip=get_setting($db,"main_network_ip");
$main_port=get_setting($db,"main_network_port");
$steam_online=check_online($main_ip,$main_port);
$servers=get_servers($db);
foreach($servers as &$srv){update_server_stats($db,$srv);}
$last_update=get_last_update($db);
$total_capacity=get_total_capacity($servers);
$total_available=get_total_available($servers);
$max_capacity=0;foreach($servers as $s){if($s["total_capacity"]>$max_capacity)$max_capacity=$s["total_capacity"];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
		<title>Steam Network Status</title>
		
		<meta http-equiv="pragma" content="no-cache">
		<meta name="ROBOTS" content="ALL">
		<meta name="DESCRIPTION" content="Valve - Steam account signup">
		<meta name="KEYWORDS" content="Steam, account, account creation, signup">
		<meta name="AUTHOR" content="Valve LLC">
		<link rel="stylesheet" type="text/css" href="./css/steampowered.css">
		<script language="JavaScript">
		var minusImg = new Image();
			minusImg.src = "./img/minus.gif";
		var plusImg = new Image();
			plusImg.src = "./img/plus.gif";

		function showBranch(branch){
			var objBranch = document.getElementById(branch).style;
			if(objBranch.display=="block")
				objBranch.display="none";
			else
				objBranch.display="block";
		}
		function swapPlus(img){
			objImg = document.getElementById(img);
			if(objImg.src.indexOf('./img/plus.gif')>-1)
				objImg.src = minusImg.src;
			else
				objImg.src = plusImg.src;
		}
		</script><style type="text/css" id="operaUserStyle"></style>

	<body>
	<!-- begin header -->
	<div class="header">
	<nobr><a href="./"><img src="./img//steam_logo_onblack.gif" align="top" alt="[Valve]" height="54" width="152"></a>
	<span class="navBar">

	<a href="./news.htm"><img name="news" valign="bottom" height="22" width="54" src="./img//news.gif" onmouseout="this.src=&#39;img/news.gif&#39;;" onmouseover="this.src=&#39;img/MOnews.gif&#39;;" alt="news"></a>

	<a href="./getsteamnow.htm"><img valign="bottom" height="22" width="108" src="./img//getSteamNow.gif" onmouseout="this.src=&#39;img/getSteamNow.gif&#39;" onmouseover="this.src=&#39;img/MOgetSteamNow.gif&#39;" alt="getSteamNow"></a>

	<a href="./support.htm"><img valign="bottom" height="22" width="68" src="./img//support.gif" onmouseout="this.src=&#39;img/support.gif&#39;" onmouseover="this.src=&#39;img/MOsupport.gif&#39;" alt="Support"></a>

	<a href="./forums.htm"><img valign="bottom" height="22" width="68" src="./img//forums.gif" onmouseout="this.src=&#39;img/forums.gif&#39;" onmouseover="this.src=&#39;img/MOforums.gif&#39;" alt="Forums"></a>

	<a href="./status.html"><img valign="bottom" height="22" width="65" src="./img//status.gif" onmouseout="this.src=&#39;img/status.gif&#39;" onmouseover="this.src=&#39;img/MOstatus.gif&#39;" alt="Status"></a>

	</span>
	</nobr>
	</div>
	<!-- end header -->

	<!-- support -->

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



	<!-- begin footer -->
	<div class="footer">
		<a name="http://www.valvesoftware.com"><img src="./img//valve_greenlogo.gif" align="left"></a> 2003 Valve Corporation. All rights reserved. Read our <a name="http://www.valvesoftware.com/privacy.htm">privacy policy</a>.<br>
		Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve Corporation.
	</div>
	<!-- end footer -->

	
	
	
</body></html>
