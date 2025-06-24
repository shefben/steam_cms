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
	<p><h3><a href="index.php?area=news&id=213" style="text-decoration: none; color: #BFBA50;">Game Engine Update</a></h3>
<span style="font-size: 9px;">November 12, 2003, 4:41 pm &middot; <a href="mailto:contact@valvesoftware.com" style="text-decoration: none;">valve</a><table width="100%" cellpadding="0" cellspacing="0"><tr><td height="1" width="100%" bgcolor="#808080"></td></tr><tr><td height="10" width="100%"></td></tr></table></span>
We have released a game engine update via Steam this evening. This release includes a number of additions and bug fixes, including one which should clear up the remaining cases of the authentication error people have been getting today.<br><br>Server admins please note that this release will require all game servers to restart. If you run a server on Windows, you'll need to restart manually; Linux servers will restart automatically if the server admin has enabled that option.<br><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><b>GAME & ENGINE CHANGES:</b><br><li>Fixed a Steam authentication error ("Invalid User ID Ticket") that occurred when connecting to any server which was run from the Steam Games list</li><br><li>Added check to make sure only one instance of the game is running</li><br><li>Added code to try help diagnose the 'filesystem dll not found' sporadic error</li><br><li>Fixed startup crash where the text file buffer wasn't always terminated correctly causing bad info to be parsed out</li><br><li>Changed error string "BADPASSWORD" to be a friendly string</li><br><li>Added some more info to help debug 'could not load filesystem' error</li><br><li>Fixed mouse cursor staying visible when alt-tabbing back into the game when in windowed mode</li><br><li>Fixed corrupted VGUI2 text when using the TriAPI</li><br><li>Added fallback to software mode if selected video mode is not supported when game tries to start</li><br><li>Fixed bug where singleplayer games were listed in the Mods list for HLDS.</li><br><li>Fixed bug where the Mod previously used wasn't being loaded properly (and saved) the next time you ran HLDS.</li><br><li>Fixed 'load failed' error causing players to timeout from server during level changes</li><br><li>Fixed problem pulling crates in half-life</li><br><li>Fixed mp3 volume slider not taking effect immediately</li><br><li>Fixed changing the bitdepth in video options not making the apply button show up</li><br><li>Fixed downloading of custom content from a server never saying 'complete'</li><br><li>Fixed sponsor banner never being shown in the game</li><br><li>Fixed game menus still be clickable even when hidden by game load dialog</li><br><li>Added compression to server->client file transfers, reduces connection time downloading security module -- controlled by "sv_filetransfercompression" cvar.</li><br><li>Fixed crash opening options dialog if "voice_enable 0" was in the config.cfg file</li><br><li>Changed default player name to be the users' friends name</li><br><li>Fixed timer graphic not displaying in Counter-Strike</li><br><br><b>MOD MAKER CHANGES:</b><br><li>Fixed "condump" command</li><br><li>Fixed corrupted VGUI2 text when using the TriAPI (only happened in mods)</li><br><li>Added greater control of game startup background & layout -- controlled by resource/BackgroundLayout.txt, BackgroundLoadingLayout.txt</li><br><li>Increase MAX_HUD_SPRITES from 128 to 256</li><br><li>Added avi playback option to game startup - the text file media/StartupVids.txt contains the list of avi's to play</li><br><li>Changed missing models to only be fatal error when developer cvar > 1</li><br></ul><br></p>

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