-- Steam Platform Update History
-- App ID: 20
-- Generated on: 2025-08-01 23:33:33
-- MySQL/MariaDB Format



INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES
(20, '2003-01-16', NULL, '<div class=\"details\" id=\"January 16, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Complete rework of launcher UI.</li> <li> Added support for Valve Anti-Cheat.</li> <li> Added ability for Engineer to build teleporter (entrance and exit).</li> <li> Added new map \"Ravelin\".</li> <li> Updated version of Dustbowl.</li> <li> Changed initial sniper armor from 0 to 25.</li> <li> Damaged buildings (sentries, dispensers, teleporters) will now spark and smoke.</li> <li> Engine supports masked and additive textures modes on models.</li> <li> Added widescreen monitor support (16:9 and 5:4).</li> <li> HLTV log files has time stamp in file name</li> <li> Don\'t relay admin_mod commands to spectators like rate, cl_updaterate, etc.</li> <li> If connected to HLTV, allow higher ex_interp values.</li> <li> Improved load times to join servers.</li> <li> Changed \"Press duck for menu\" message to HUD style message and made it last for 6 seconds.</li> <li> Reduced default sv_maxupdaterate value from 60 to 30.</li> <li> Added \"timeleft\" TFC client command to query the amount of time left before the server cycles the map.</li> <li> Default HLTV updaterate will be 10 (not 20) to save bandwidth.</li> <li> Changed default network rate to match max rate allowed (from 9999 to 20000), for LAN servers.</li> <li> Added server cvar \"sv_lan_rate\" which specifies the rate to use for all clients on a lan server, default is 20000.</li> <li> Added \"sv_log_onefile\" to determine whether one log file is created (total) or one log file for each map change, which is how it currently is. The default is the current behavior (one for each map change).</li> </ul>
Bug fixes
	<ul>
<li> Fixed bug where players who were frozen could travel up ladders.</li> <li> Fixed spy being able to move up ladders while feigned.</li> <li> Fixed teledeath messsage for telefrag death to include \"teledeath\" as the weapon.</li> <li> Fixed problem with looping Assault Cannon sound getting stuck</li> <li> Fixed problem with AC gun never dry firing</li> <li> Fixed a bug with view model colors and first-person spectator mode.</li> <li> Fixed bug where defensive demoman could lay pipebombs/detpack in spawn room (on maps like Dustbowl) and kill offensive team when teams cycle to the next area.</li> <li> Fixed engineer not being able to build while ducking.</li> <li> Fixed Status Bar not showing player IDs correctly.</li> <li> Fixed bug in TFC armor hud graphic where the percentage armor shown wasn\'t correct for each class.</li> <li> Fixed spectator mode switching your view to a new player if the player you\'re watching dies.</li> <li> Fixed not being able to pick team \"Spectator\" when you first join the TFC server.</li> <li> Fixed not being able to pick your own class again if you have hud_classautokill set to 0 (in TFC)</li> <li> Fixed TFC green say_team command buttons for Hunted and Dustbowl.</li> <li> Fixed TFC bug where players could change teams/classes quickly and end up with the wrong weapons for their class.</li> <li> Fixed TFC bug where sentry gun could become detached from the base and still work.</li> <li> Fixed TFC spies, hw guys, and scouts not being able to drop their cells.</li> <li> Fixed demo playback for demos containing svc_filetxferfailed messages.</li> <li> Fixed bug with HLTV director command \'stufftext\'</li> <li> Removed command \"dem_edit\", use \"hl.exe -demoedit\" instead.</li> <li> HLTV now handles svc_setview correctly</li> <li> Fixed demo recording after changelevel.</li> <li> Fixed bug where players could duck while traveling up ladders and not lose any speed (but the sound volume was reduced).</li> <li> Fixed players being able to move up ladders faster than their maxspeed.</li> <li> Fixed bug with chat input and PIP overlapping while in spectator mode.</li> <li> Fixed spectator bug where you can\'t always cycle forwards and backwards through the players (you can only cycle one direction).</li> <li> Fixed sv_visiblemaxplayers setting not working for info/details query response.</li> </ul>
</div>'),
(20, '2003-03-03', NULL, '<div class=\"details\" id=\"March 3, 2003\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed where game would freeze during gameplay</li> </ul>
</div>'),
(20, '2003-06-05', NULL, '<div class=\"details\" id=\"June 5, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Valve Anti-Cheat is now active in the Steam beta</li> <li> Added \"servercfgfile\" cvar back into the engine.</li> <li> Changed references from woncomm.lst to valvecomm.lst.</li> <li> Added disconnect and resume buttons to the main menu.</li> <li> Added in Steam monitoring tool. This will display Steam activity on your machine.</li> <li> Update news is displayed during the launch of the game if content is being downloaded.</li> <li> Optimized protocol for Steam content delivery.</li> <li> Server browser can be refreshed using the F5 key.</li> <li> Moved muting and friends status out of the scoreboard. This is handled in the Player List section of the UI.</li> <li> You can run multiple copies of the same application now. This is most useful for Dedicated Servers.</li> <li> Added Hearts and Spades to Friends mini-games.</li> <li> HLTV: New command \"clearbanns\" - removes all IPs from bann list.</li> <li> Added \"mapchangecfgfile\" cvar. Set this to the filename of the file you want run on map change.</li> </ul>
Bug fixes
	<ul>
<li> Fixed bug with custom decals.</li> <li> Fixed bug where CD Audio CD tracks were never being played even if there was a valid CD in the drive.</li> <li> Fixed bug with pausing/starting MP3 streams when console/UI is brought up and closed again.</li> <li> Fixed bug where game could crash when initializing MSS sound thread.</li> <li> Fixed bug in server browser if you uparrow or downarrow in an empty list and then \"connect\".</li> <li> Fixed a number of bugs related to Friends messages.</li> <li> Fixed format string crash bug when logging.</li> <li> Fixed server freeze/crash exploit caused by malformed userinfo information in connect packets.</li> <li> Fixed potential exploits due to buffer overflows in infostring handling.</li> <li> HLTV: Fixed \"NULL\" player names in HLTV demos.</li> <li> Fixed bug where TFC dedicated servers would not show up in the server browser.</li> </ul>
</div>'),
(20, '2003-06-24', NULL, '<div class=\"details\" id=\"June 24, 2003\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed bug where ping times could be displayed incorrectly for game servers.</li> <li> Fixed bug that made server list appear slowly for server browser.</li> </ul>
</div>'),
(20, '2003-07-22', NULL, '<div class=\"details\" id=\"July 22, 2003\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed bug where voice initialization would not work properly.</li> <li> Added support for speex voice codec.</li> </ul>
</div>'),
(20, '2003-08-11', NULL, '<div class=\"details\" id=\"August 11, 2003\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed problem with clients getting \"could not load gfx.wad\" errors.</li> <li> Fixed infinite loop due to malformed infostring.</li> <li> Fixed format string crash bug in logging.</li> <li> Fixed screen becoming corrupt when using alt-tab with ATI cards.</li> <li> Fixed crash when using alt-tab while a sentence was playing.</li> </ul>
</div>'),
(20, '2003-09-09', NULL, '<div class=\"details\" id=\"September 9, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Added skins support to Steam (\platform\skins).</li> <li> Added new cvar \"sv_region\" to describe the region the server is in.</li> <li> Added \"region\" concept to server browser.</li> <li> Added range check for \"gamma\" cvar.</li> <li> Removed dependency on WON protocols.</li> <li> HLTV: Maximum number of connected spectators is tracked (\'status\' command).</li> <li> HLTV: Switched \'autoretry\' behavior back to the way it was in 1.1.1.0.</li> <li> HLTV: Added \'hltv\' to heartbeat.</li> <li> HLTV: Removed dependency on Won protocols.</li> </ul>
Bug fixes
	<ul>
<li> Fixed bug with MOTD not being displayed.</li> <li> Fixed talk icon not displaying sometimes.</li> <li> Fixed MP3s being looked for in the wrong folder.</li> <li> Fixed MP3 playback in being cutoff sometimes.</li> <li> Fixed bug with the \"kick\" command.</li> <li> Fixed bug where you couldn\'t enter a hostname that started with a number.</li> <li> Fixed mouse support for 3dfx cards.</li> <li> Fixed HTML scrollbars not showing up sometimes.</li> <li> Fixed \"hostname\" being initialized to \"Half-Life\" for Listen servers (for all Mods).</li> <li> HLTV: Fixed \'record\' to continue recording demos after reconnect.</li> <li> HLTV: Fixed cheering bug.</li> </ul>
</div>'),
(20, '2003-09-15', 'Status Update: New Installers To Be Released Tomorrow', '<div class=\"post_content\" id=\"content_185\" style=\"display: none;\">
<p>Well, the release process last week and over the weekend was pretty rocky. The community managed to get 500,000 accounts created and are currently seeing about 15,000 people playing Counter-Strike 1.6 at any given time. We know that the conversion process has been anything but smooth for many of our users. We\'re going to get this fixed. We\'ve done our best to support the Half-Life community over the past 5 years, and we\'re still committed to doing whatever it takes to make the community happy. We\'ve listened to the response, and we\'ll be repairing the problems with Steam until it performs the way we all want it to.<br/><br/>Tomorrow we will release new installers which include the cache files for all of the games available via Steam (Day of Defeat, Team Fortress Classic, the dedicated server, etc). If you haven\'t already done so, please use the installer that includes Counter-Strike and Half-Life.<br/><br/>Here\'s what\'s going on at Steam HQ:<br/><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li> We ran into some pretty serious bandwidth and server limitations after the release last week, which has caused several other problems like long wait times and UI unresponsiveness. The load is starting to die down now and we\'re getting more content servers lined up, so these problems are becoming less frequent. As more people begin using the new installers which include the game caches, their experience using Steam will improve greatly. If you\'re having problems connecting to Steam or launching Counter-Strike, please download the latest version of the installer and give it a try. <br/><li> Some other Steam problems -- \"JIT\" error messages, expired ticket errors, etc -- will be fixed with a Steam update this week.<br/></li></li></ul><br/>Other stuff:<br/><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li> Counter-Strike 1.5 is still available, and will be for a couple of weeks. After we\'re confident that the Steam authentication servers are functioning as they should (and not before), we\'ll be turning off the WON servers and migrating everyone over to the new system. <br/><li> There have been some reports of the Conversion Wizard failing during account creation. If this happens for you, please try downloading and installing the most recent version of the Steam client from one of the mirrors listed on this site. <br/><li> We\'re preparing a new installer on CD for cyber-cafe owners. Contact biz@steampowered.com if you\'re interested in receiving this. <br/><li> We\'ve heard from several people who are having trouble getting their MODs working with Steam. We\'ve updated our FAQ with new information about this. Check it out and then email us if you\'re still having trouble.<br/></li></li></li></li></ul><br/>Feel free to get in touch with us you\'re having difficulty, or for whatever reason. Thanks for hanging in there with us through these first few days.</p>
<br clear=\"left\"/>
</div>'),
(20, '2003-10-10', NULL, '<div class=\"details\" id=\"October 10, 2003\" style=\"display: none;\">
Bug fixes
	<ul>
<li> fixed teleporter crash</li> <li> fixed spectator crash</li> </ul>
</div>'),
(20, '2003-10-10', 'Counter-strike And Team Fortress Classic Updates Released', '<div class=\"post_content\" id=\"content_202\" style=\"display: none;\">
<p>Updates for Counter-Strike and Team Fortress Classic have just been released through Steam. These are server updates, so once admins have restarted their servers the update will take effect. Here is what\'s included:<br/><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><b>Team Fortress Classic</b><br/><li>fixed teleporter crash</li><br/><li>fixed spectator crash</li><br/><br/><b>Counter-Strike</b><br/><li>fixed shield not resetting player max speed when dropped</li><br/><li>fixed being able to throw shield through walls if close enough</li><br/><li>fixed dropping shield while reloading pistol causing the reload to happen faster</li><br/><li>fixed case where shield could become invisible to other users</li><br/><li>fixed typos in de_aztec and de_airstrip map descriptions</li><br/></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2003-11-12', NULL, '<div class=\"details\" id=\"November 12, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Added check to make sure only one instance of the game is running</li> <li> Added code to try help diagnose the \'filesystem dll not found\' sporadic error</li> <li> Added some more info to help debug \'could not load filesystem\' error</li> <li> Added fallback to software mode if selected video mode is not supported when game tries to start</li> <li> Added compression to server-&gt;client file transfers, reduces connection time downloading security module -- controlled by \"sv_filetransfercompression\" cvar.</li> <li> Changed error string \"BADPASSWORD\" to be a friendly string</li> <li> Changed default player name to be the users\' friends name</li> <li> Fixed \"condump\" command</li> <li> Fixed corrupted VGUI2 text when using the TriAPI (only happened in mods)</li> <li> Added greater control of game startup background &amp; layout -- controlled by resource/BackgroundLayout.txt, BackgroundLoadingLayout.txt</li> <li> Increase MAX_HUD_SPRITES from 128 to 256</li> <li> Added avi playback option to game startup - the text file media/StartupVids.txt contains the list of avi\'s to play</li> <li> Changed missing models to only be fatal error when developer cvar &gt; 1</li> </ul>
Bug fixes
	<ul>
<li> Fixed a Steam authentication error (\"Invalid User ID Ticket\") that occurred when connecting to any server which was run from the Steam Games list</li> <li> Fixed startup crash where the text file buffer wasn\'t always terminated correctly causing bad info to be parsed out</li> <li> Fixed mouse cursor staying visible when alt-tabbing back into the game when in windowed mode</li> <li> Fixed corrupted VGUI2 text when using the TriAPI</li> <li> Fixed bug where singleplayer games were listed in the Mods list for HLDS.</li> <li> Fixed bug where the Mod previously used wasn\'t being loaded properly (and saved) the next time you ran HLDS.</li> <li> Fixed \'load failed\' error causing players to timeout from server during level changes</li> <li> Fixed problem pulling crates in half-life</li> <li> Fixed mp3 volume slider not taking effect immediately</li> <li> Fixed changing the bitdepth in video options not making the apply button show up</li> <li> Fixed downloading of custom content from a server never saying \'complete\'</li> <li> Fixed sponsor banner never being shown in the game</li> <li> Fixed game menus still be clickable even when hidden by game load dialog</li> <li> Fixed crash opening options dialog if \"voice_enable 0\" was in the config.cfg file</li> <li> Fixed timer graphic not displaying in Counter-Strike</li> </ul>
</div>'),
(20, '2003-11-26', NULL, '<div class=\"details\" id=\"November 26, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Added extra progress indicators for downloading &amp; initializing VAC security modules</li> <li> Removed \'cmd dlfile\' console command from being accessed directly from the console</li> </ul>
Bug fixes
	<ul>
<li> Fixed servers not being in world list if they specified a region on startup</li> </ul>
</div>'),
(20, '2003-12-10', NULL, '<div class=\"details\" id=\"December 10, 2003\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Optimized some of the particle drawing code</li> <li> For mod makers - debugging mods no longer requires the steam.dll to be copied into the game directory</li> </ul>
Bug fixes
	<ul>
<li> Fixed problem in Direct3D mode where the game would be unavailable for some users. Direct3D mode should work now, but note that OpenGL will provide a better play experience if your video card is capable</li> <li> Fixed regression that was causing the \'load failed\' crash to happen on level change</li> <li> Fixed icon for ALT-TAB menu and window title bar not being displayed properly</li> <li> Moved flaginfo to the chat text area so it will work properly</li> </ul>
</div>'),
(20, '2003-12-10', 'Steam Games - Update Released', '<div class=\"post_content\" id=\"content_220\" style=\"display: none;\">
<p>An update for all Steam games has just been released. As always, Steam will update your games automatically -- you don\'t need to take any special action. <br/><br/>Dedicated server admins can get the update normally via the HLDS update tool, or the dedicated server update can be downloaded directly from <a href=\"http://www.steampowered.com/?area=dedicated_server\">this page</a>.<br/><br/>Here\'s a complete list of the changes:<br/><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><b>ALL GAMES:</b><br/><li>Fixed problem in Direct3D mode where the game would be unavailable for some users. Direct3D mode should work now, but note that OpenGL will provide a better play experience if your video card is capable</li><br/><li>Fixed regression that was causing the \'load failed\' crash to happen on level change</li><br/><li>Optimized some of the particle drawing code</li><br/><li>For mod makers - debugging mods no longer requires the steam.dll to be copied into the game directory</li><br/><br/><b>DAY OF DEFEAT</b><br/><li>Added client side env_models for static prop type models</li><br/><li>Random class now abides by class limits</li><br/><li>No random class in clan matches</li><br/><li>Added exit decal on gunshots</li><br/><li>Restored door opening behavior to original style ( face the door and it opens away from you, face away and it opens towards you )</li><br/><li>Fixed sniper rifle lowering when a sniper moved, even though he was still scoped</li><br/><li>Fixed a bug where you would drop your weapon, pick it back up and it would have less ammo</li><br/><li>Re-added weapon names to console death messages ( bob killed fred with garand )</li><br/><li>Added \"teamkill\" text to the console death messages ( bob teamkilled chuck with kar )</li><br/><li>Fixed being able to jumpshoot if the minimap was open fullscreen</li><br/><li>Fixed a cut off label in scoreboard</li><br/><li>Now cannot +use grenades while deployed</li><br/><li>\"hud_draw 0\" now hides the spectator bar</li><br/><li>Fixed player animation being 90 degrees off on mg sandbag deploy</li><br/><li>Fixed spectator angles on minimap player icons</li><br/><li>Fixed strange health numbers drawing in the spec bar</li><br/><li>Fixed gunshot decal on subsequent bullet hits</li><br/><li>Added control point name to log file cap messages</li><br/><li>Fixed hud reset on stop demo recording</li><br/><li>Fixed ammo on mg42 and 30cal view model not showing above 8 bullets</li><br/><li>Fixed player models jittering because of animation blend</li><br/><li>Fixed an evil evil hack that stopped the player from shooting when their mg42 overheated</li><br/><li>Fixed some more empty cells in the scoreboard showing up as squares</li><br/><br/><b>DOD HLTV</b><br/><li>Fixed client env_models drawing</li><br/><li>Fixed brit sleeves</li><br/><li>Draw objective icons on hud and in minimap</li><br/><li>Draw grenades on the minimap for both teams</li><br/><li>Fixed teams and playerclass in the scoreboard</li><br/><li>Added timeleft and number of hltv spectators to the spec bar</li><br/><li>Fixed weather effects not drawing</li><br/><li>No vgui menus in hltv spec</li><br/><br/><b>COUNTER-STRIKE:</b><br/><li>Fixed shield exploit that involved dropping a weapon and buying a pistol in a specific order; you must restart your dedicated server to pick up this change</li><br/><br/><b>TEAM FORTRESS CLASSIC:</b><br/><li>Fixed icon for ALT-TAB menu and window title bar not being displayed properly</li><br/><li>Moved flaginfo to the chat text area so it will work properly</li><br/></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2004-01-15', NULL, '<div class=\"details\" id=\"January 15, 2004\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed custom decals not being downloaded from the server correctly</li> <li> Fixed custom decals drawing incorrectly for the host of a listen server after another player joins</li> <li> Fixed vgui textures being corrupted after going over a number of level changes</li> <li> Fixed problem where player would be sometimes be forced to look straight up after task switching in and out of game in fullscreen d3d mode</li> <li> Fixed problem in sound system where it wouldnt properly be shutdown at the end of a .wav file</li> <li> Fixed banner picture not working correctly in HLTV</li> <li> Fixed error message that was cut off when a player was disconnected from a game server</li> <li> Changed the way that Asian fonts are displayed in game for compatibility on more platforms</li> </ul>
</div>'),
(20, '2004-02-09', NULL, '<div class=\"details\" id=\"February 9, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Small CPU optimizations</li> <li> Stop motdfile from having \"..\", \"\\", \"/\" or \":\" characters in its filename</li> <li> Added new command line option \"-dll\". Syntax is -dll [game_dll_to_load]</li> </ul>
Bug fixes
	<ul>
<li> Fix for updated files on the server not getting to the client when using compression</li> <li> Fixed extremely large rcon packets not being returned correctly</li> </ul>
</div>'),
(20, '2004-03-09', NULL, '<div class=\"details\" id=\"March 9, 2004\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Changed HTTP download behavior to retry connections using old trickle download method if it can\'t download all files.</li> <li> Fixed a crash bug when connecting to a dedicated server with an empty mapcycle.</li> <li> Fixed a bug where MP3 volume wasn\'t working properly.</li> <li> Fixed \"STEAM UserID 0:0:1 is already in use on this server\" message when connecting to LAN servers in offline mode.</li> <li> Fixed memory leak in HLTV.</li> </ul>
</div>'),
(20, '2004-03-23', NULL, '<div class=\"details\" id=\"March 23, 2004\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Prevent the \"connection to server lost due to level change\" error</li> </ul>
</div>'),
(20, '2004-04-02', NULL, '<div class=\"details\" id=\"April 2, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Added a command line option (\"-noaafonts\") to disable anti-aliasing on fonts</li> <li> Replace \"#\" with \" \" if it is the first character in a player\'s in-game name</li> </ul>
</div>'),
(20, '2004-04-28', NULL, '<div class=\"details\" id=\"April 28, 2004\" style=\"display: block;\">
Changes/Additions
	<ul>
<li> Improved game demo recording performance under Steam</li> </ul>
</div>'),
(20, '2005-08-12', 'Half-life 1: Engine Update Available', '<div class=\"post_content\" id=\"content_435\" style=\"display: none;\">
<p>Updates to the Half-Life 1: Engine for Linux have been released. Run the hldsupdatetool to apply the update. The specific changes include:<br/><br/><b>Half-Life 1: Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed crash on startup due to bad hostname settings<br/><li>Fixed crash on startup in threading library<br/></li></li></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2005-09-15', 'Half-life 1: Engine Update Available', '<div class=\"post_content\" id=\"content_445\" style=\"display: none;\">
<p>Updates to the Half-Life 1: Engine have been released. The update will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Half-Life 1: Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed MOTD crash when viewing HTML pages with iframes</li></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2005-10-03', 'Source Engine And Half-life 1: Engine Updates Available', '<div class=\"post_content\" id=\"content_452\" style=\"display: none;\">
<p>Updates to the Source Engine and Half-Life 1: Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed loading error when trying to debug Source MODs using the SDK<br/><li>Fixed a startup crash in Windows 98<br/></li></li></ul><br/><b>Half-Life 1: Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed name exploit causing client crash</li></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2005-11-21', 'Half-life 1 Engine Update Released', '<div class=\"post_content\" id=\"content_481\" style=\"display: none;\">
<p>Updates to the Half-Life 1 Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Half-Life 1 Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed Asian language versions displaying corrupt characters<br/><li>Fixed Condition Zero: Deleted Scenes not loading cz_alamo2 correctly<br/><li>Fixed being unable to launch Half-Life: Blue Shift if you didn\'t own Half-Life 1<br/></li></li></li></ul><br/><b>Half-Life 1 Dedicated Server</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Added new clientcvar2 cvar query interface for developers<br/><li>Fixed \"-sport\" and \"+ip\" command line options being ignored on startup<br/></li></li></ul><br/><i><b>Linux users</b> - Hldsupdatetool and our game engines now require <b>GLIBC 2.3.2</b> or later, the update tool will verify you meet this requirement before installing the game software.</i></p>
<br clear=\"left\"/>
</div>'),
(20, '2006-03-08', 'Source And Half-life 1 Dedicated Server Update Released', '<div class=\"post_content\" id=\"content_514\" style=\"display: none;\">
<p>Updates to the Source and Half-Life 1 Dedicated Server have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Both</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Reduced CPU spikes and overall load during server operation<br/><li>Fixed serveral crash bugs on Linux systems running older GLIBC versions<br/></li></li></ul><br/><b>Half-Life 1 Dedicated Server</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Clamped the size of the WeaponList network message to prevent a potential buffer overflow exploit (found by Niall FitzGibbon)</li></ul></p>
<br clear=\"left\"/>
</div>'),
(20, '2007-04-23', 'Half-life 1 Deathmatch And Team Fortress Classic Update Released', '<div class=\"post_content\" id=\"content_1019\" style=\"display: ;\">
<p>Updates to Half-Life 1 Deathmatch and Team Fortress Classic have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Half-Life 1 Deathmatch and Team Fortress Classic</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed game server crash when lastinv was inappropriately used</li></ul></p>
<br clear=\"left\"/>
</div>');
