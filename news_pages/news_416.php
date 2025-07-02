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
	<p><h3><a href="index.php?area=news&id=416" style="text-decoration: none; color: #BFBA50;">Counter-Strike: Source, Half-Life 2 and Source Engine Updates Available</a></h3>
<span style="font-size: 9px;">May 13, 2005, 12:00 am &middot; <a href="mailto:contact@valvesoftware.com" style="text-decoration: none;">Alfred Reynolds</a><table width="100%" cellpadding="0" cellspacing="0"><tr><td height="1" width="100%" bgcolor="#808080"></td></tr><tr><td height="10" width="100%"></td></tr></table></span>
An update is available for Counter-Strike: Source, Half-Life 2 and the Source Engine. The update will be applied automatically when your Steam client is restarted. The specific changes include:<br><br><b>CS:S</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>New map: de_inferno<br><li>New map: de_port<br><li>Updated Counter-Terrorists player model with new headgear and color scheme <br><li>C4 red flash displays properly if the bomb is planted under water now<br><li>C4 explosion damage is no longer affected by water<br><li>When a map is loaded, an associated .cfg file is automatically evaluated.  This cfg file must be located in the cstrike/maps/cfg folder and be named &lt;mapname&gt;.cfg.  For instance, the file cstrike/maps/cfg/de_dust.cfg will be evaluated when the map de_dust is loaded.  This is useful for per-map rules, bot rosters, etc.<br><li>Added new route to roof of hostage shack in cs_compound, and improved bot navigation in the map<br><li>Players must now target another player for at least a half second before the player ID text hint shows up<br><li>Grates/chain link fences no longer affect bullets<br><li>Counter-Strike player ragdolls are now affected by ragdoll magnets<br><li>Fixed a bot crash caused by finding too many hiding spots in a region<br><li>Bots no longer attack enemies that are very far away unless they have a sniper rifle, or the enemies are shooting at them. Instead, they track the enemy and move to a better attack position<br><li>Bots understand +use doors now and will pause to open a door before continuing through it on their way to whatever they were doing<br><li>Bots use less CPU now, especially when in combat with far away enemies<br><li>Extended the syntax of the bot_add, bot_kick, and bot_kill commands to also accept "t" or "ct" arguments.<br><li>Fixed bug where bots would stop and become unresponsive if they wanted to hide in an area with no hiding spots<br><li>Improved bot navigation on the windows and ledges of cs_italy<br><li>Fixed recording value of cl_interp in demo files and restore value during playback<br></ul><br><b>Source Engine</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>HTTP downloads from the game server system support downloading .bz2-compressed files<br><li>Disable old style (non-challenged) server queries by default (use the sv_enableoldqueries cvar to change this behavior)<br><li>Added cvar tv_delaymapchange to delay map changes caused by frag/time limit until the whole game is broadcasted via SourceTV <br><li>Fixed lag compensation invalidating bone cache for players moved back in time.<br><li>Fixed lag compensation interpolation error between 2 ticks<br></ul><br><b>Half-Life 2</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Fixed some NPC actions not being properly randomized<br></ul><br><b>SourceTV <i>(part of the Source Dedicated Server)<br></i></b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Fixed memory leak in relay servers by releasing receive tables correctly<br><li>Bandwidth output in tv_status in kB/sec rather than bytes/sec<br><li>Running a new map command (spawning a server) shuts down TV relay in same process<br><li>Fixed SourceTV chase cam following ragdolls of dead secondary targets<br></ul><br></p>

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