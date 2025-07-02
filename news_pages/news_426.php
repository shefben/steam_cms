<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
	<title>Steam News</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="ROBOTS" content="ALL">
	<meta name="DESCRIPTION" content="SteamPowered">
	<meta name="KEYWORDS" content="Steam, account, account creation, signup">
	<meta name="AUTHOR" content="Valve LLC">
	<link rel="stylesheet" type="text/css" href="steampowered.css">
	<!-- css2 --> 
	<link rel="Shortcut Icon" type="image/png" href="/webicon.png">
	<script language="JavaScript" src="nav.js"></script>
	<link href="http://www.steampowered.com/rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>

<body>

<!-- begin header -->
<div class="header">
<nobr><a href="index.php"><img src="/img/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152"></a>
<span class="navBar">
	<a href="http://storefront.steampowered.com/v2/"><img name="games" valign="bottom" height="22" width="66" src="img/games.gif"
		onMouseOut="this.src='img/games.gif';" onMouseOver="this.src='img/MOgames.gif';"
		alt="news"></a> 

	<a href="index.php?area=news"><img name="news" valign="bottom" height="22" width="54" src="img/news.gif"
		onMouseOut="this.src='img/news.gif';" onMouseOver="this.src='img/MOnews.gif';"
		alt="news"></a>

	<a href="index.php?area=getsteamnow"><img valign="bottom" height="22" width="108" src="img/getSteamNow.gif"
		onMouseOut="this.src='img/getSteamNow.gif'" onMouseOver="this.src='img/MOgetSteamNow.gif'"
		alt="getSteamNow"></a>

	<a href="index.php?area=cybercafes"><img valign="bottom" height="22" width="95" src="img/cafes.gif"
		onMouseOut="this.src='img/cafes.gif'" onMouseOver="this.src='img/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="http://support.steampowered.com/"><img valign="bottom" height="22" width="68" src="img/support.gif"
		onMouseOut="this.src='img/support.gif'" onMouseOver="this.src='img/MOsupport.gif'"
		alt="Support"></a>

	<a href="index.php?area=forums"><img valign="bottom" height="22" width="68" src="img/forums.gif"
		onMouseOut="this.src='img/forums.gif'" onMouseOver="this.src='img/MOforums.gif'"
		alt="Forums"></a>

	<a href="status/status.html"><img valign="bottom" height="22" width="65" src="img/status.gif"
		onMouseOut="this.src='img/status.gif'" onMouseOver="this.src='img/MOstatus.gif'"
		alt="Status"></a>
</span>
</nobr>
</div>
<!-- end header -->


	<!-- news -->

	<div class="content" id="container">
	<h1>STEAM NEWS</H1>
	<h2>VALVE <em>NEWS</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
	<br>
	<div class="narrower">
	<p><h3><a href="index.php?area=news&id=426" style="text-decoration: none; color: #BFBA50;">Counter-Strike: Source and Source Engine Updates Available</a></h3>
<span style="font-size: 9px;">July 6, 2005, 2:55 pm &middot; <a href="mailto:contact@valvesoftware.com" style="text-decoration: none;">Alfred Reynolds</a><table width="100%" cellpadding="0" cellspacing="0"><tr><td height="1" width="100%" bgcolor="#808080"></td></tr><tr><td height="10" width="100%"></td></tr></table></span>
Updates to Counter-Strike: Source and the Source Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br><br><b>Counter-Strike: Source</b><br><br><b>New Features/Improvements</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>New Source remake of classic Counter-Strike map cs_assault<br><li>New "Phoenix Connection" Terrorist model (replaces existing model)<br></ul><br><b>New Player Animations</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Walk/run cycles now include whole-body motion<br><li>Players automatically raise their weapon and aim through the sights when they stop to fire <br><li>Weapon-specific reload animations with removable ammo clips added<br><li>Shotgun reloads animate each individual shell reload<br><li>Animated the bolt pull for each shot of the AWP<br><li>Added upper-body recoil animations for shotguns and AWP<br><li>New grenade throw and knife animations<br><li>Spectator UI now resizes controls to account for long map names<br><li>A notification is now displayed to all players when auto-balancing teams<br><li>Added message for players who try to defuse the bomb while another player is already doing so<br><li>Added item_nvgs and item_<ammotype> entities for fy_ maps<br><li>Can no longer stab with the knife while defusing or during freeze time at the start of a round<br><li>Player count in dedicated server interface now includes bots<br><li>Dedicated servers can now use the "timeleft" command<br><li>Dedicated servers are now secure by default, add "-insecure" to the command line to run in insecure mode.<br></ul><br><b>Bug fixes</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Dedicated servers no longer crash when setting "name" via the console<br><li>Fixed bug that would occasionally make player weapons disappear<br><li>Low-violence death animations no longer float if the player dies while in the air<br><li>Fixed bug that caused the grenade throw animation to incorrectly play when spectating in the game<br><li>Fixed view jitter caused by prediction errors when near physics objects <br><li>Spectators now hear weapon pickup sounds<br><li>Armor is now given with game_player_equip<br><li>Extra pistol ammo no longer given at round restart<br><li>Weaker flashbangs effects no longer cancel out stronger ones<br><li>maps/cfg/<mapname>.cfg aren't exec'd if they don't exist (fixes console warnings)<br><li>Fixed bug that caused hostage scenario HUD icon showing 1 hostage left when all were rescued or dead<br><li>game_player_equip removes player equipment before adding new items<br></ul><br><b>Bot Changes</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Bots can use sloped ladders now<br><li>Bots open +use doors better<br><li>Bots don't think they're stuck when hiding<br><li>Bots using knives can break breakables while pursuing enemies now<br></ul><br><b>Navigation Mesh generation improvements</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Nav generation ignores doors and breakables better<br><li>Non-planar nav areas aren't merged into larger areas<br><li>Added nav_generate_incremental to generate additional nav areas starting from a walkable marker, without destroying existing mesh<br><li>Areas no longer get connected to ladders multiple times (caused a crash if the ladder was deleted)<br><li>Added nav_restart_after_analysis<br><li>Fixed bug where some areas would be incorrectly marked as crouch<br></ul><br><b>Navigation Mesh Editor changes</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Nav areas draw a background color, making them more visible<br><li>Nav_update_blocked warps the local player to the first blocked area <br><li>Added nav_build_ladder (point at a climbable surface so the cursor is green, and type nav_build_ladder to automatically create a nav ladder) <br><li>Added nav_no_hostages, to mark an area as not suitable for hostage navigation <br><li>Added nav_remove_unused_jump_areas to remove extraneous jump areas <br><li>Fixed a crash caused by manually creating an area before doing a nav_generate on a new map <br></ul><br></p>

<ul><li> <a href="index.php?area=news" style="text-decoration: none;"><i>return to news page</i></a></ul>
	</div>
	</div>
	

<!-- begin footer -->
<div class="footer">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td><a href="http://www.valvesoftware.com"><img src="img/valve_greenlogo.gif"></a></td>
		<td>&nbsp;</td>
		<td><span class="footerfix">&copy; 2005 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="http://www.valvesoftware.com/privacy.htm">Privacy Policy</a>. <a href="http://www.valvesoftware.com/legal.htm">Legal</a>. <a href="/index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.</span></td>
		<td width="15%">&nbsp;</td>
	</tr>
	</table>
</div>
<!-- end footer -->

</body>
</html>