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
else {
	$i = 0;
}
if (isset($_GET['s'])) {
	$s = $_GET['s'];
}
else {
	$s = 0;
}
if (isset($_GET['gId'])) {
	$gId = $_GET['gId'];
}
else {
	$gId = 0;
}
$s_list = explode(",", $s);
$i_list = explode(",", $i);
?>

<table bgcolor="black" width="100%" cellspacing="0">
<tr><td>&nbsp;</td></tr>
<tr>
	<td width="20" style="border-bottom: 2px Solid #889180;" nowrap>&nbsp;</td>
	<td <?php if ($gId == 0) echo " style='display: none';"; ?>
	onMouseOver="this.style.color='#BDBE52'"
	onMouseOut="this.style.color='white'"
	onClick="window.open('games.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
	style="cursor: hand;"
	nowrap class="tab_active_sm"
>&lt; &nbsp;&nbsp;BACK</td>
	
	<td width="100%" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('packs.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
		style="cursor: hand;"
		>GAME PACKAGES</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_active">INDIVIDUAL GAMES</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('3rdparty.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
		style="cursor: hand;"
		>THIRD-PARTY GAMES</td>
	<td nowrap width="20" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
</tr>
</table>

<!-- begin capsule -->
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_220.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Half-Life 2 defines a new benchmark in gaming with startling realism and responsiveness. Powered by Source&trade; technology, Half-Life 2 features the most sophisticated in-game characters ever witnessed, advanced AI, stunning graphics and physical gameplay.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_220.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '4') or ($s_value == '5') or ($s_value == '9') or ($s_value == '10') or ($s_value == '11') or ($s_value == '12') or ($s_value == '13') or ($s_value == '14') or ($s_value == '15')) {
						$found_sub_220 = true;
						break;
					}
					else {
						$found_sub_220 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '220') {
						$found_app_220 = true;
						break;
					}
					else {
						$found_app_220 = false;
					}
				}
				if ($found_app_220 == true) {
					$purchased220 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_220 == true) {
					$purchased220 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased220 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/220', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased220 ?></td>
					<td nowrap class="purchase1">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;COUNTER-STRIKE: SOURCE</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_240.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">THE NEXT INSTALLMENT OF THE WORLD'S # 1 ONLINE ACTION GAME
Counter-Strike: Source blends Counter-Strike's award-winning teamplay action with the advanced technology of Source&trade; technology. Featuring state of the art graphics, all new sounds, and introducing physics, Counter-Strike: Source is a must-have for every action gamer.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_240.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '4') or ($s_value == '5') or ($s_value == '9') or ($s_value == '10') or ($s_value == '11') or ($s_value == '12') or ($s_value == '13') or ($s_value == '14') or ($s_value == '15')) {
						$found_sub_240 = true;
						break;
					}
					else {
						$found_sub_240 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '240') {
						$found_app_240 = true;
						break;
					}
					else {
						$found_app_240 = false;
					}
				}
				if ($found_app_240 == true) {
					$purchased240 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_240 == true) {
					$purchased240 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased240 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/240', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased240 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE: SOURCE</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_280.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Winner of over 50 Game of the Year awards, Half-Life set new standards for action games when it was released in 1998. Half-Life: Source is a digitally remastered version of the critically acclaimed and best selling PC game, enhanced via Source&trade; technology to include physics simulation, enhanced effects, and more.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_280.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '4') or ($s_value == '10') or ($s_value == '12') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_280 = true;
						break;
					}
					else {
						$found_sub_280 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '280') {
						$found_app_280 = true;
						break;
					}
					else {
						$found_app_280 = false;
					}
				}
				if ($found_app_280 == true) {
					$purchased280 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_280 == true) {
					$purchased280 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased280 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/280', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased280 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_5.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Named Game of the Year by over 50 publications, Valve&apos;s debut title blends action and adventure with award-winning technology to create a frighteningly realistic world where players must think to survive. Also includes an exciting multiplayer mode that allows you to play against friends and enemies around the world.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_5.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_70 = true;
						break;
					}
					else {
						$found_sub_70 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '70') {
						$found_app_70 = true;
						break;
					}
					else {
						$found_app_70 = false;
					}
				}
				if ($found_app_70 == true) {
					$purchased70 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_70 == true) {
					$purchased70 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased70 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/70', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased70 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;COUNTER-STRIKE</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_7.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Play the world&apos;s number 1 online action game. Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. Ally with teammates to complete strategic missions. Take out enemy sites. Rescue hostages. Your role affects your team&apos;s success. Your team's success affects your role.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_7.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '3') or ($s_value == '4') or ($s_value == '5') or ($s_value == '6') or ($s_value == '7') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_10 = true;
						break;
					}
					else {
						$found_sub_10 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '10') {
						$found_app_10 = true;
						break;
					}
					else {
						$found_app_10 = false;
					}
				}
				if ($found_app_10 == true) {
					$purchased10 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_10 == true) {
					$purchased10 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased10 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/10', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased10 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;COUNTER-STRIKE: CONDITION ZERO</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_8.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">With its extensive Tour of Duty campaign, a near-limitless number of skirmish modes, updates and new content for Counter-Strike's award-winning multiplayer game play, plus over 12 bonus single player missions, Counter-Strike: Condition Zero is a tremendous offering of single and multiplayer content.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_8.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '3') or ($s_value == '4') or ($s_value == '6') or ($s_value == '7') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_80 = true;
						break;
					}
					else {
						$found_sub_80 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '80') {
						$found_app_80 = true;
						break;
					}
					else {
						$found_app_80 = false;
					}
				}
				if ($found_app_80 == true) {
					$purchased80 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_80 == true) {
					$purchased80 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased80 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/80', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased80 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;CONDITION ZERO DELETED SCENES</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_10.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">A series of stand-alone, single-player missions for Counter-Strike, Condition Zero Deleted Scenes assigns players to over one dozen standoffs around the globe. Features exclusive items and weapons.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_10.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '3') or ($s_value == '4') or ($s_value == '6') or ($s_value == '7') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_100 = true;
						break;
					}
					else {
						$found_sub_100 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '100') {
						$found_app_100 = true;
						break;
					}
					else {
						$found_app_100 = false;
					}
				}
				if ($found_app_100 == true) {
					$purchased100 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_100 == true) {
					$purchased100 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased100 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/100', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased100 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;DAY OF DEFEAT</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_9.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Enlist in an intense brand of Axis vs. Allied teamplay set in the WWII European Theatre of Operations. Players assume the role of light/assault/heavy infantry, sniper or machine-gunner class, each with a unique arsenal of historical weaponry at their disposal. Missions are based on key historical operations. And, as war rages, players must work together with their squad to accomplish a variety of mission-specific objectives.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_9.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_30 = true;
						break;
					}
					else {
						$found_sub_30 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '30') {
						$found_app_30 = true;
						break;
					}
					else {
						$found_app_30 = false;
					}
				}
				if ($found_app_30 == true) {
					$purchased30 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_30 == true) {
					$purchased30 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased30 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/30', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased30 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;TEAM FORTRESS CLASSIC</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_11.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">One of the most popular online action games of all time, Team Fortress Classic features over nine character classes -- from Medic to Spy to Demolition Man -- enlisted in a unique style of online team warfare. Each character class possesses unique weapons, items, and abilities, as teams compete online in a variety of game play modes.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_11.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_20 = true;
						break;
					}
					else {
						$found_sub_20 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '20') {
						$found_app_20 = true;
						break;
					}
					else {
						$found_app_20 = false;
					}
				}
				if ($found_app_20 == true) {
					$purchased20 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_20 == true) {
					$purchased20 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased20 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/20', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased20 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;DEATHMATCH CLASSIC</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_12.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Enjoy fast-paced multiplayer gaming with Deathmatch Classic (a.k.a. DMC). Valve's tribute to the work of id software, DMC invites players to grab their rocket launchers and put their reflexes to the test in a collection of futuristic settings.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_12.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_40 = true;
						break;
					}
					else {
						$found_sub_40 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '40') {
						$found_app_40 = true;
						break;
					}
					else {
						$found_app_40 = false;
					}
				}
				if ($found_app_40 == true) {
					$purchased40 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_40 == true) {
					$purchased40 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased40 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/40', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased40 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;OPPOSING FORCE</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_13.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Return to the Black Mesa Research Facility as one of the military specialists assigned to eliminate Gordon Freeman. Experience an entirely new episode of single player action. Meet fierce alien opponents, and experiment with new weaponry. Named 'Game of the Year' by the Academy of Interactive Arts and Sciences.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_13.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_50 = true;
						break;
					}
					else {
						$found_sub_50 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '50') {
						$found_app_50 = true;
						break;
					}
					else {
						$found_app_50 = false;
					}
				}
				if ($found_app_50 == true) {
					$purchased50 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_50 == true) {
					$purchased50 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased50 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/50', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased50 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;RICOCHET</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_14.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">A futuristic action game that challenges your agility as well as your aim, Ricochet features one-on-one and team matches played in a variety of futuristic battle arenas.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_14.gif"></div><div></div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($s_list as $s_value) {
					if (($s_value == '1') or ($s_value == '2') or ($s_value == '4') or ($s_value == '5') or ($s_value == '8') or ($s_value == '10') or ($s_value == '13') or ($s_value == '14')) {
						$found_sub_60 = true;
						break;
					}
					else {
						$found_sub_60 = false;
					}
				}
				foreach ($i_list as $i_value) {
					if ($i_value == '60') {
						$found_app_60 = true;
						break;
					}
					else {
						$found_app_60 = false;
					}
				}
				if ($found_app_60 == true) {
					$purchased60 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				elseif ($found_sub_60 == true) {
					$purchased60 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased60 = 'CLICK for PURCHASE OPTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/60', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase"><?php echo $purchased60 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
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
<div <?php if ($gId != 0) echo " style='display: none';"; else echo " class='capsule';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;CODENAME GORDON</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_17.gif"></td>
		<td nowrap>&nbsp;</td>
		<td style="padding-left:12px;" width="100%">Created by <a target="_new"href="http://www.nuclearvision.de/">Nuclearvision Entertainment</a>, Codename Gordon takes players through dozens of levels inspired by Half-Life and Half-Life 2, challenges players to a slew of puzzles, and showcases many of the familiar creatures in an all new, 2 dimensional playing field.</td>
		<td height="100%">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div></div><div>&nbsp;</div></td>
			</tr>
			<tr>
				<td>

				<table cellspacing="0" width="100%">
				<tr>
					<td height="10"><spacer></td>
				</tr>
				<?php
				foreach ($i_list as $i_value) {
					if ($i_value == '92') {
						$found_app_92 = true;
						break;
					}
					else {
						$found_app_92 = false;
					}
				}
				if ($found_app_92 == true) {
					$purchased92 = 'PLAY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				else {
					$purchased92 = 'DOWNLOAD & INSTALL NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				<tr
					onMouseOver="this.style.color='#BDBE52'"
					onMouseOut="this.style.color='white'"
					onClick="window.open('steam://run/92', '_top');"
					style="cursor: hand;"
				>
					<td nowrap class="purchase" width='194'><?php echo $purchased92 ?></td>
					<td nowrap class="purchase2">&nbsp;</td>
				</tr>
				</table>

				</td>
			</tr>
			</table>

		</td>
	</tr>
	</table>

	</div><!-- end capcontent -->
	<div class="capbot"><div></div></div>
</div>
<!-- end capsule -->

<!-- begin individual game capsule -->
<div <?php if ($gId == 20) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_11.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_11.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">One of the most popular online action games of all time, Team Fortress Classic features over nine character classes -- from Medic to Spy to Demolition Man -- enlisted in a unique style of online team warfare. Each character class possesses unique weapons, items, and abilities, as teams compete online in a variety of game play modes.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_11.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Team Fortress Classic on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 20) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 30) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_9.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_9.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Enlist in an intense brand of Axis vs. Allied teamplay set in the WWII European Theatre of Operations. Players assume the role of light/assault/heavy infantry, sniper or machine-gunner class, each with a unique arsenal of historical weaponry at their disposal. Missions are based on key historical operations. And, as war rages, players must work together with their squad to accomplish a variety of mission-specific objectives.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_9.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Day of Defeat on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 30) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 40) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div class="captop2"><div>DEATHMATCH CLASSIC</div></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_12.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Enjoy fast-paced multiplayer gaming with Deathmatch Classic (a.k.a. DMC). Valve's tribute to the work of id software, DMC invites players to grab their rocket launchers and put their reflexes to the test in a collection of futuristic settings.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_12.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Deathmatch Classic on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 40) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 50) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div class="captop2"><div>OPPOSING FORCE</div></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_13.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Return to the Black Mesa Research Facility as one of the military specialists assigned to eliminate Gordon Freeman. Experience an entirely new episode of single player action. Meet fierce alien opponents, and experiment with new weaponry. Named 'Game of the Year' by the Academy of Interactive Arts and Sciences.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_13.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Opposing Force on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 50) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 60) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div class="captop2"><div>RICOCHET</div></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_14.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">A futuristic action game that challenges your agility as well as your aim, Ricochet features one-on-one and team matches played in a variety of futuristic battle arenas.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_14.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Ricochet on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 60) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 70) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_5.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_5.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Named Game of the Year by over 50 publications, Valve&apos;s debut title blends action and adventure with award-winning technology to create a frighteningly realistic world where players must think to survive. Also includes an exciting multiplayer mode that allows you to play against friends and enemies around the world.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_5.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Half-Life on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 70) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;VALVE PREMIER PACK</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p44.gif"></td>
		<td width="30%"><span class="maize">VALVE PREMIER PACK INCLUDES:</span>
 <ul>
 <li>Half-Life</li>
 <li>Half-Life: Opposing Force</li>
 <li>Day of Defeat</li>
 <li>Team Fortress Classic</li>
 <li>Deathmatch Classic</li>
 <li>Ricochet</li>
 </ul>
 <hr>
 With six incredible games from Valve, including Half-Life and Day of Defeat, the Valve Premier Pack is an incredible value at just $39.95. Included products are a mix of single player and multiplayer games. Order your copy now.<br>&nbsp;</td>
		<td align="right">

			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><img src="images/screen_premier.gif"></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$34.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $34.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/8', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 80) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_8.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_8.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">With its extensive Tour of Duty campaign, a near-limitless number of skirmish modes, updates and new content for Counter-Strike's award-winning multiplayer game play, plus over 12 bonus single player missions, Counter-Strike: Condition Zero is a tremendous offering of single and multiplayer content.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_8.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Counter-Strike: Condition Zero on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 80) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;CONDITION ZERO</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p43.gif"></td>
		<td width="30%"><span class="maize">CONDITION ZERO INCLUDES:</span><br>
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
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$29.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $29.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/7', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 10) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_7.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_7.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Play the world&apos;s number 1 online action game. Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. Ally with teammates to complete strategic missions. Take out enemy sites. Rescue hostages. Your role affects your team&apos;s success. Your team's success affects your role.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_7.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can purchase Counter-Strike on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 10) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
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
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$89.95</td>
					</tr>
					<?php $fullprice = 89.95 ?>
					<?php $finalprice = 89.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX+S&H</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/13', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 10) echo " class='capsule';"; else echo " style='display: none';"; ?>>
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
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 10) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;CONDITION ZERO</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p43.gif"></td>
		<td width="30%"><span class="maize">CONDITION ZERO INCLUDES:</span><br>
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
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$29.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $29.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/7', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 100) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_10.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_10.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">A series of stand-alone, single-player missions for Counter-Strike, Condition Zero Deleted Scenes assigns players to over one dozen standoffs around the globe. Features exclusive items and weapons.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_10.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Condition Zero Deleted Scenes on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 100) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;CONDITION ZERO</div></div>
	<div class="capcontent">

	<table width="96%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/p43.gif"></td>
		<td width="30%"><span class="maize">CONDITION ZERO INCLUDES:</span><br>
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
							<table cellspacing="0">
							<tr>
								<td nowrap class="arithmetic">Package price</td>
								<td nowrap align="right" class="arithmetic">$29.95</td>
							</tr>
							
							<tr>
								<td
									nowrap class="arithmetic"
									colspan="2"
									style="border-top: 2px Solid #293021;"
								>FINAL PRICE:<span class="total"> $29.95</span> +TAX</td>
							</tr>
							<tr
								onMouseOver="this.style.color='#BDBE52'"
								onMouseOut="this.style.color='white'"
								onClick="window.open('steam://purchase/7', '_top');"
								style="cursor: hand;"
							><td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
							<td nowrap class="purchase6">&nbsp;</td>
							</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 220) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_220.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_220.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Half-Life 2 defines a new benchmark in gaming with startling realism and responsiveness. Powered by Source&trade; technology, Half-Life 2 features the most sophisticated in-game characters ever witnessed, advanced AI, stunning graphics and physical gameplay.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_220.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Half-Life 2 on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 220) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
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
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$89.95</td>
					</tr>
					<?php $fullprice = 89.95 ?>
					<?php $finalprice = 89.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX+S&H</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/13', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 220) echo " class='capsule';"; else echo " style='display: none';"; ?>>
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
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 220) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 BRONZE</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p52.gif"></td>
		<td><span class="maize">HALF-LIFE 2 BRONZE INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;"><a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2">&nbsp</div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$49.95</td>
					</tr>
					
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $49.95</span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/9', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 240) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_240.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_240.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">THE NEXT INSTALLMENT OF THE WORLD'S # 1 ONLINE ACTION GAME
Counter-Strike: Source blends Counter-Strike's award-winning teamplay action with the advanced technology of Source&trade; technology. Featuring state of the art graphics, all new sounds, and introducing physics, Counter-Strike: Source is a must-have for every action gamer.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_240.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Counter-Strike: Source on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 240) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
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
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$89.95</td>
					</tr>
					<?php $fullprice = 89.95 ?>
					<?php $finalprice = 89.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX+S&H</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/13', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 240) echo " class='capsule';"; else echo " style='display: none';"; ?>>
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
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 240) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 BRONZE</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p52.gif"></td>
		<td><span class="maize">HALF-LIFE 2 BRONZE INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;"><a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2">&nbsp</div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$49.95</td>
					</tr>
					
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $49.95</span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/9', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 280) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_280.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_280.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Winner of over 50 Game of the Year awards, Half-Life set new standards for action games when it was released in 1998. Half-Life: Source is a digitally remastered version of the critically acclaimed and best selling PC game, enhanced via Source&trade; technology to include physics simulation, enhanced effects, and more.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_280.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Half-Life: Source on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 280) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
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
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$89.95</td>
					</tr>
					<?php $fullprice = 89.95 ?>
					<?php $finalprice = 89.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX+S&H</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/13', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 280) echo " class='capsule';"; else echo " style='display: none';"; ?>>
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
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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

<!-- begin individual game capsule -->
<div <?php if ($gId == 300) echo " class='capsule2';"; else echo " style='display: none';"; ?>>
	<div style="text-align:left;"><img src="images/gn_300.gif"></div>
	<div>

	<table width="100%">
	<tr>
		<td valign="bottom" height="100%"><img src="images/gi1_300.gif"></td>
		<td nowrap>&nbsp;</td>
		<td width="100%">Day of Defeat offers intense online action gameplay set in Europe during WWII. Assume the role of infantry, sniper or machine-gunner classes, and more. DoD:S features enhanced graphics and sounds design to leverage the power of Source, Valve's new engine technology.</td>
		<td height="100%">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td><div><img src="images/gi2_300.gif"></div><div></div></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<br><hr class="gamerule">
			<h3 style="text-align:left;"><img width="16" height="16" align="absmiddle" src="gfx/asterisk.gif">&nbsp;Here's how you can subscribe to Day of Defeat: Source on Steam:</h3>
		</td>
	</tr>
	</table>

	</div>
</div>
<!-- end individual game capsule -->

<!-- begin capsule -->
<div <?php if ($gId == 300) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;HALF-LIFE 2 GOLD</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p50.gif"></td>
		<td>
<script language="JavaScript"src="pop.js"></script>


<span class="maize">HALF-LIFE 2 GOLD INCLUDES:</span><br>
 <ul>
 <li>Half-Life 2</li>
 <li>Counter-Strike: Source</li>
 <li>Half-Life: Source</li>
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li><a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
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
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$89.95</td>
					</tr>
					<?php $fullprice = 89.95 ?>
					<?php $finalprice = 89.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX+S&H</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/13', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 300) echo " class='capsule';"; else echo " style='display: none';"; ?>>
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
 <li>Half-Life 2: Deathmatch</li>
 <li>Day of Defeat: Source*</li>
 <li>PLUS: <a style="text-decoration:underline;"href="javascript:popUp('backcatalog/')">Valve's back catalog</a> available on Steam</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
 <a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2"><br><br><div class="discount"align="right"style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$59.95</td>
					</tr>
					<?php $fullprice = 59.95 ?>
					<?php $finalprice = 59.95 ?>
					<?php $discount = 0 ?>
					<?php if (strpos($s, ',5')) echo 
					'<tr>
						<td nowrap class="arithmetic">ATI HL2 coupon</td>
						<td nowrap align="right" class="arithmetic">-$49.95</td>
					</tr>'
					?>
					<?php if (strpos($s, ',5')) $discount = 49.95 ?>
					<?php $finalprice = $fullprice - $discount ?>
					<?php if (strlen($finalprice) == 2) $finalprice .= '.00' ?>
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $<?php echo $finalprice ?></span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/10', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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
<div <?php if ($gId == 300) echo " class='capsule';"; else echo " style='display: none';"; ?>>
	<div class="captop"><div> &nbsp; &nbsp;DAY OF DEFEAT: SOURCE</div></div>
	<div class="capcontent">
	<table width="96%">
	<tr>
		<td valign="bottom" height="100%" width="177"><img src="images/p53.gif"></td>
		<td><span class="maize">DAY OF DEFEAT: SOURCE:</span><br>
 <ul>
 <li>Day of Defeat: Source</li>
 </ul>
 <hr>
 <div style="font-weight:normal;color:#A4AD9D;"><a style="text-decoration:underline;color:#A4AD9D;"target="_new"href="minimum_req/index.php?l=english">HL2 system requirements</a></div></td>
		<td align="right">
			<table height="100%" cellspacing="0" cellpadding="0">
			<tr height="100%">
				<td class="pricing2">&nbsp</div></td>
			</tr>
			<tr>
				<td class="pricing"><div>
					<table cellspacing="0">
					<tr>
						<td nowrap class="arithmetic">Package price</td>
						<td nowrap align="right" class="arithmetic">$19.95</td>
					</tr>
					
					<tr>
						<td
							nowrap class="arithmetic"
							colspan="2"
							style="border-top: 2px Solid #293021;"
						>FINAL PRICE:<span class="total"> $19.95</span> +TAX</td>
					</tr>
					<tr
						onMouseOver="this.style.color='#BDBE52'"
						onMouseOut="this.style.color='white'"
						onClick="window.open('steam://purchase/25', '_top');"
						style="cursor: hand;"
					>
						<td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
						<td nowrap class="purchase6">&nbsp;</td>
					</tr>
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