<html>

<head>
	<title>Browse Games</title>
	<link rel="stylesheet" type="text/css" href="storefront.css">
	<script language=JavaScript>
	<!--

	//Disable right mouse click Script
	//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
	//For full source code, visit http://www.dynamicdrive.com

	var message="Function Disabled!";

	///////////////////////////////////
	function clickIE4(){
		if (event.button==2){
			return false;
		}
	}

	function clickNS4(e){
		if (document.layers||document.getElementById&&!document.all){
			if (e.which==2||e.which==3){
				return false;
			}
		}
	}

	if (document.layers){
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown=clickNS4;
	}
	else if (document.all&&!document.getElementById){
		document.onmousedown=clickIE4;
	}

	document.oncontextmenu=new Function("return false")
	// -->
	</script>
</head>

<body>

<?php
if (isset($_GET['i'])) {
	$i = $_GET['i'];
}
if (isset($_GET['s'])) {
	$s = $_GET['s'];
}
?>

<table bgcolor="black" width="100%" cellspacing="0">
<tr><td>&nbsp;</td></tr>
<tr>
	<td width="100%" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_active">PACKAGE OFFERS</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('games.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english&ver=0', '_top');"
		style="cursor: hand;"
		>INDIVIDUAL GAMES</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('3rdparty.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english&ver=0', '_top');"
		style="cursor: hand;"
		>THIRD-PARTY GAMES</td>
	<td nowrap width="20" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
</tr>
</table>

<!-- begin capsule -->
<div class="capsule">
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="/pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('/backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <span class="maize">HALF-LIFE 2 MERCHANDISE:</span>
 <ul>
 <li>HL2 posters (3 total)</li>
 <li>HL2 soundtrack</li>
 <li>HL2 hat</li>
 <li>HL2 sticker</li>
 <li>City 17 postcard</li>
 <li>Prima's HL2 Strategy Guide</li>
 <li>Special collector's box</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">Allow 6-8 weeks for delivery of merchandise included in the Half-Life 2 gold package.<br>
 * This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="/Steam/Messages/minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0" width=190>
					<?php
					if (strpos($s, ',9')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',10')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',13')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					else {
						$purchased13 = 'PURCHASE THIS PACKAGE';
						require("sub_13.php");
					}
					?>
					</table>
					</div></td>
			</tr>
			</table>
			
		</td>
	</tr>
	</table>
	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->

<!-- begin capsule -->
<div class="capsule">
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 SILVER</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p51.gif"></td>
		<td><span class="maize">HALF-LIFE 2 SILVER INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('/backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="/Steam/Messages/minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0" width=190>
					<?php
					if (strpos($s, ',9')) {
						$purchased = 'Thank you!<br>You have already purchased<br>Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',10')) {
						$purchased = 'Thank you!<br>You have already purchased<br>Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',13')) {
						$purchased = 'Thank you!<br>You have already purchased<br>Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					else {
						$purchased10 = 'PURCHASE THIS PACKAGE';
						require("sub_10.php");
					}
					?>
					</table>
					</div></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->

<!-- begin capsule -->
<div class="capsule">
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 BRONZE</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p52.gif"></td>
		<td><span class="maize">HALF-LIFE 2 BRONZE INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="/Steam/Messages/minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2">&nbsp</div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0" width=190>
					<?php
					if (strpos($s, ',5')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',9')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',10')) {
						$purchased = 'Thank you!<br>You have already purchased Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					elseif (strpos($s, ',13')) {
						$purchased = 'Thank you!<br>You have already purchased<br>Half-Life 2 on Steam. At this time, you can only purchase one HL2 offer per Steam account.';
						require("sub_purchased.php");
					}
					else {
						$purchased9 = 'PURCHASE THIS PACKAGE';
						require("sub_9.php");
					}
					?>
					</table>
					</div></td><td />
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->

<!-- begin capsule -->
<div class="capsule">
	<div class="captop"><div> &nbsp; &nbsp;CONDITION ZERO</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p43.gif"></td>
		<td><span class="maize">CONDITION ZERO INCLUDES:</span><br>
 <ul>
 <li>Counter-Strike: Condition Zero</li>
 <li>Condition Zero Deleted Scenes</li>
 <li>Counter-Strike Multiplayer</li>
 </ul>
 <hr>
 Counter-Strike&trade;: Condition Zero&trade; features all of the award winning-games in the Counter-Strike franchise. Log onto the world's number 1 online action game. Play online or offline with the official CS Bot. Or enjoy the single player Deleted Scenes.</td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2">&nbsp;</div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0" width=190>
					<?php
					if (strpos($s, ',3') or strpos($s, ',4') or strpos($s, ',6') or strpos($s, ',7') or strpos($s, ',10') or strpos($s, ',13') or strpos($s, ',14')){
						$purchased = 'Thank you!<br>You have already purchased Condition Zero on Steam.';
						require("sub_purchased.php");
					}
					else {
						$purchased7 = 'PURCHASE THIS PACKAGE';
						require("sub_7.php");
					}
					?>
					</table>
					</div></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->

<!-- begin capsule -->
<div class="capsule">
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p44.gif"></td>
		<td><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $19.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0" width=190>
					<?php
					if (strpos($s, ',1') or strpos($s, ',2') or strpos($s, ',4') or strpos($s, ',5') or strpos($s, ',8') or strpos($s, ',10') or strpos($s, ',13') or strpos($s, ',14')){
						$purchased = 'Thank you!<br>You have already purchased the Valve Premier Pack on Steam.';
						require("sub_purchased.php");
					}
					else {
						$purchased8 = 'PURCHASE THIS PACKAGE';
						require("sub_8.php");
					}
					?>
					</table>
					</div></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->


</body>
</html>