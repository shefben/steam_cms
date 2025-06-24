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
	<LINK rel="stylesheet" type="text/css" href="steampowered.css">
	<link rel="Shortcut Icon" type="image/png" href="/webicon.png">
	<script language="JavaScript" src="nav.js"></script>
	<link href="rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>

<body>

<!-- begin header -->
<div class="header">
<nobr><a href="index.php"><img src="/img/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152"></a>
<span class="navBar">
	<a href="news.php"><img name="news" valign="bottom" height="22" width="54" src="img/news.gif"
		onMouseOut="this.src='img/news.gif';" onMouseOver="this.src='img/MOnews.gif';"
		alt="news"></a>

	<a href="getsteamnow.php"><img valign="bottom" height="22" width="108" src="img/getSteamNow.gif"
		onMouseOut="this.src='img/getSteamNow.gif'" onMouseOver="this.src='img/MOgetSteamNow.gif'"
		alt="getSteamNow"></a>

	<a href="cybercafes.php"><img valign="bottom" height="22" width="95" src="img/cafes.gif"
		onMouseOut="this.src='img/cafes.gif'" onMouseOver="this.src='img/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="support.php"><img valign="bottom" height="22" width="68" src="img/support.gif"
		onMouseOut="this.src='img/support.gif'" onMouseOver="this.src='img/MOsupport.gif'"
		alt="Support"></a>

	<a href="forums.php"><img valign="bottom" height="22" width="68" src="img/forums.gif"
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
	<p><h3><a href="index.php?area=news&id=220" style="text-decoration: none; color: #BFBA50;">Steam Games - Update Released</a></h3>
<span style="font-size: 9px;">December 10, 2003, 7:03 pm &middot; <a href="mailto:contact@valvesoftware.com" style="text-decoration: none;">valve</a><table width="100%" cellpadding="0" cellspacing="0"><tr><td height="1" width="100%" bgcolor="#808080"></td></tr><tr><td height="10" width="100%"></td></tr></table></span>
An update for all Steam games has just been released. As always, Steam will update your games automatically -- you don't need to take any special action. <br><br>Dedicated server admins can get the update normally via the HLDS update tool, or the dedicated server update can be downloaded directly from <a href="/?area=dedicated_server">this page</a>.<br><br>Here's a complete list of the changes:<br><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><b>ALL GAMES:</b><br><li>Fixed problem in Direct3D mode where the game would be unavailable for some users. Direct3D mode should work now, but note that OpenGL will provide a better play experience if your video card is capable</li><br><li>Fixed regression that was causing the 'load failed' crash to happen on level change</li><br><li>Optimized some of the particle drawing code</li><br><li>For mod makers - debugging mods no longer requires the steam.dll to be copied into the game directory</li><br><br><b>DAY OF DEFEAT</b><br><li>Added client side env_models for static prop type models</li><br><li>Random class now abides by class limits</li><br><li>No random class in clan matches</li><br><li>Added exit decal on gunshots</li><br><li>Restored door opening behavior to original style ( face the door and it opens away from you, face away and it opens towards you )</li><br><li>Fixed sniper rifle lowering when a sniper moved, even though he was still scoped</li><br><li>Fixed a bug where you would drop your weapon, pick it back up and it would have less ammo</li><br><li>Re-added weapon names to console death messages ( bob killed fred with garand )</li><br><li>Added "teamkill" text to the console death messages ( bob teamkilled chuck with kar )</li><br><li>Fixed being able to jumpshoot if the minimap was open fullscreen</li><br><li>Fixed a cut off label in scoreboard</li><br><li>Now cannot +use grenades while deployed</li><br><li>"hud_draw 0" now hides the spectator bar</li><br><li>Fixed player animation being 90 degrees off on mg sandbag deploy</li><br><li>Fixed spectator angles on minimap player icons</li><br><li>Fixed strange health numbers drawing in the spec bar</li><br><li>Fixed gunshot decal on subsequent bullet hits</li><br><li>Added control point name to log file cap messages</li><br><li>Fixed hud reset on stop demo recording</li><br><li>Fixed ammo on mg42 and 30cal view model not showing above 8 bullets</li><br><li>Fixed player models jittering because of animation blend</li><br><li>Fixed an evil evil hack that stopped the player from shooting when their mg42 overheated</li><br><li>Fixed some more empty cells in the scoreboard showing up as squares</li><br><br><b>DOD HLTV</b><br><li>Fixed client env_models drawing</li><br><li>Fixed brit sleeves</li><br><li>Draw objective icons on hud and in minimap</li><br><li>Draw grenades on the minimap for both teams</li><br><li>Fixed teams and playerclass in the scoreboard</li><br><li>Added timeleft and number of hltv spectators to the spec bar</li><br><li>Fixed weather effects not drawing</li><br><li>No vgui menus in hltv spec</li><br><br><b>COUNTER-STRIKE:</b><br><li>Fixed shield exploit that involved dropping a weapon and buying a pistol in a specific order; you must restart your dedicated server to pick up this change</li><br><br><b>TEAM FORTRESS CLASSIC:</b><br><li>Fixed icon for ALT-TAB menu and window title bar not being displayed properly</li><br><li>Moved flaginfo to the chat text area so it will work properly</li><br></ul><br></p>

<ul><li> <a href="news.php" style="text-decoration: none;"><i>return to news page</i></a></ul>
	</div>
	</div>
	

<!-- begin footer -->
<div class="footer">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td><a href="/valvesoftware"><img src="img/valve_greenlogo.gif"></a></td>
		<td>&nbsp;</td>
		<td><span class="footerfix">&copy; 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="/valvesoftware/privacy.htm">Privacy Policy</a>. <a href="/valvesoftware/legal.htm">Legal</a>. <a href="subscriber_agreement.php">Steam Subscriber Agreement</a>.</span></td>
		<td width="15%">&nbsp;</td>
	</tr>
	</table>
</div>
<!-- end footer -->

</body>
</html>