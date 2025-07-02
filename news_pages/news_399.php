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
	<p><h3><a href="index.php?area=news&id=399" style="text-decoration: none; color: #BFBA50;">Counter-Strike: Source, Source Engine, and Half-Life 2: Deathmatch Update Available</a></h3>
<span style="font-size: 9px;">February 24, 2005, 5:21 pm &middot; <a href="mailto:contact@valvesoftware.com" style="text-decoration: none;">cliffe</a><table width="100%" cellpadding="0" cellspacing="0"><tr><td height="1" width="100%" bgcolor="#808080"></td></tr><tr><td height="10" width="100%"></td></tr></table></span>
Counter-Strike: Source, Source Engine, and Half-Life 2: Deathmatch updates are available and will be applied automatically when Steam is restarted. The changes include:<br><br><b>Counter-Strike: Source</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>New hostage rescue map cs_compound</li><br><li>Added Source version of de_train</li><br><li>Upgraded version of the CT player model</li><br><li>Location names are shown in radio/team chat, and under the radar</li><br><li>Server tickrate can be specified with -tickrate</li><br><li>Added radio command aliases</li><br><li>Added mp_humanteam cvar [any | ct | t] (forces human players onto specified team - useful for humans vs bots)</li><br><li>Added new "match" mode for bot_quota --  If bot_quota_mode = "match", bot count = (human count) * bot_quota</li><br><li>Bots no longer automatically follow humans (bot_auto_follow now defaults to 0)</li><br><li>Bots are balanced before humans with mp_autoteambalance</li><br><li>Bots can open simple +use doors</li><br><li>Bots change their names to match the prefix when bot_prefix changes</li><br><li>Several improvements to bot behavior when paths become blocked -- solves problems specific to cs_havana</li><br><li>Bots won't throw grenades if something is blocking their throw</li><br><li>Bots are better at only breaking objects that are in their way</li><br><li>Fixed bug where a bot occasionally "dithered" rapidly between two or more targets without firing</li><br><li>bot_kick and bot_kill console commands use the bot's base name without the bot_prefix</li><br><li>de_piranesi - bots avoid the breakable crates better.</li><br><li>A bomb exploding just as the round restarts no longer kills players at the start of the next round</li><br><li>Grenades being thrown when the player dies no longer disappear</li><br><li>Increased mp_limitteams bounds to 0-30, where 0 will disable this functionality</li><br><li>Players' arms and hands can be hit by bullets now</li><br><li>Target ID font is proportional, and it doesn't resize incorrectly after a resolution change</li><br><li>Overviews don't show player locations when mp_fadetoblack is on</li><br><li>Players with spaces in their names can be selected in the spectator GUI</li><br><li>Observers can change their name at round restart</li><br><li>Throwing a grenade right at round restart no longer results in holding a "ghost" grenade viewmodel at respawn</li><br><br></ul><br><b>Source Engine</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Fixed a bug where snd_mixahead was not working properly. Should fix some sound popping problems for certain sound hardware when running at a low framerate</li><br><li>Added support for a new surround sound buffering technique that streams six discrete channels instead of using DirectSound3D.  Use snd_digital_surround in the console to enable this.  This allows for support of Dolby Digital 5.1 on nForce2 hardware</li><br><li>Allow mp3 playback at rates other than 44100Hz. This was requested by the MOD community</li><br><br></ul><br><b>Master Server Query Protocol</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Added a challenge number to A2S_PLAYER and A2S_RULES server queries<br>* setting "sv_enableoldqueries" to 1 (default) allows old style (no challenge/response) queries to work. By default queries don't require a challenge number for clients on the same B class network, change "sv_allowlocalquery" to 0 to disable this functionality</li><br><li>Changed A2S_INFO server query to require the string "Source Engine Query" appended to the end of the query packet.</li><br><br></ul><br><b>Half_life 2: Deathmatch</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Fixed model exploit that would allow players to select an invalid player model</li><br><li>Added weapon type to server log</li><br><br></ul><br></p>

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