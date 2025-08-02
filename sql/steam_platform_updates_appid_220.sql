-- Steam Platform Update History
-- App ID: 220
-- Generated on: 2025-08-01 23:34:20
-- MySQL/MariaDB Format



INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES
(220, '2004-08-26', NULL, '<div class=\"details\" id=\"August 26, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Made available for pre-load</li> </ul>
</div>'),
(220, '2004-11-16', 'Half-life® 2 Released For Play', '<div class=\"post_content\" id=\"content_345\" style=\"display: none;\">
<p>Half-Life 2 is available now for purchase and to play. Those who pre-purchased their copy via Steam may access the game by restarting Steam, then double-clicking on the Half-Life 2 icon in their Steam Games directory. To purchase your copy via Steam, <a href=\"http://steampowered.com/index.php?area=getsteamnow\">get Steam now</a>.<br/><br/>We hope you enjoy it!</p>
<br clear=\"left\"/>
</div>'),
(220, '2004-11-24', 'Half-life 2 Update', '<div class=\"post_content\" id=\"content_356\" style=\"display: none;\">
<p>The changes in this release are directed at reducing the problem some users are experiencing with sound stuttering. The sound stuttering is not indicative of a sound problem, sound stuttering is only a symptom of texture thrashing on your video card or AGP memory. For information on how to reduce texture thrashing visit this link on our support site:<br/> <br/><a href=\"http://steampowered.custhelp.com/cgi-bin/steampowered.cfg/php/enduser/std_adp.php?p_faqid=280\">http://steampowered.custhelp.com/cgi-bin/steampowered.cfg/php/enduser/std_adp.php?p_faqid=280</a><br/> <br/>This update will fix sound stuttering that users were experiencing that would last for longer than a few seconds during normal gameplay. This update will also eliminate this same behavior following a quicksave or autosave. There will still be a short pause while the autosave happens, but not the more drawn out stuttering behavior.<br/> <br/>We are still investigating another performance problem on some hardware, which will manifest where the game is getting into a state where performance drops to less than 5 fps and does not recover or crashes.<br/> <br/>Next week we will be releasing the Source SDK, along with a surprise for the community.</p>
<br clear=\"left\"/>
</div>'),
(220, '2004-11-30', NULL, '<div class=\"details\" id=\"November 30, 2004\" style=\"display: none;\">
Bug fixes
	<ul>
<li> fixed graphics card crash caused by incorrect buffer allocations</li> </ul>
</div>'),
(220, '2004-12-10', NULL, '<div class=\"details\" id=\"December 10, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Solved disc in drive incompatibility error</li> </ul>
</div>'),
(220, '2004-12-14', NULL, '<div class=\"details\" id=\"December 14, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Optimization to the Steam filesystem to reduce game launch and level transition time</li> </ul>
</div>'),
(220, '2004-12-22', NULL, '<div class=\"details\" id=\"December 22, 2004\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Fixed sound stuttering problems caused by thread contention in sound system</li> </ul>
</div>'),
(220, '2005-01-10', NULL, '<div class=\"details\" id=\"January 10, 2005\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Weapon script files are preloaded at startup, instead of when they are accessed. This will reduce some hitches while playing Half-Life 2.</li> <li> Improved the performance of writing out save games. This will reduce the pause when you pass over an autosave trigger in Half-Life 2, or when you press the quicksave button.</li> <li> Improved the performance of writing out the thumbnail image for save games. This will also reduce the pause when passing over an autosave trigger or pressing the quicksave button.</li> <li> Increased cache memory usage for machines that have greater than 512MB of physical memory. This will reduce hitching due to cache thrashing.</li> <li> Optimized the sound cache manager, which will reduce hitching as a result of sound cache thrashing.</li> <li> Minor optimization to the world renderer and world collision.</li> <li> Minor optimization to the way that asynchronous sound files are loaded.</li> <li> Optimization to the way that sounds were loaded that are trigged by acting sequences.</li> <li> Optimization to reduced the number of times model sequences are iterated on per frame.</li> </ul>
</div>'),
(220, '2005-05-12', NULL, '<div class=\"details\" id=\"May 12, 2005\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed some NPC actions not being properly randomized</li> </ul>
</div>'),
(220, '2005-05-13', 'Counter-strike: Source, Half-life 2 And Source Engine Updates Available', '<div class=\"post_content\" id=\"content_416\" style=\"display: none;\">
<p>An update is available for Counter-Strike: Source, Half-Life 2 and the Source Engine. The update will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>CS:S</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>New map: de_inferno<br/><li>New map: de_port<br/><li>Updated Counter-Terrorists player model with new headgear and color scheme <br/><li>C4 red flash displays properly if the bomb is planted under water now<br/><li>C4 explosion damage is no longer affected by water<br/><li>When a map is loaded, an associated .cfg file is automatically evaluated.  This cfg file must be located in the cstrike/maps/cfg folder and be named &lt;mapname&gt;.cfg.  For instance, the file cstrike/maps/cfg/de_dust.cfg will be evaluated when the map de_dust is loaded.  This is useful for per-map rules, bot rosters, etc.<br/><li>Added new route to roof of hostage shack in cs_compound, and improved bot navigation in the map<br/><li>Players must now target another player for at least a half second before the player ID text hint shows up<br/><li>Grates/chain link fences no longer affect bullets<br/><li>Counter-Strike player ragdolls are now affected by ragdoll magnets<br/><li>Fixed a bot crash caused by finding too many hiding spots in a region<br/><li>Bots no longer attack enemies that are very far away unless they have a sniper rifle, or the enemies are shooting at them. Instead, they track the enemy and move to a better attack position<br/><li>Bots understand +use doors now and will pause to open a door before continuing through it on their way to whatever they were doing<br/><li>Bots use less CPU now, especially when in combat with far away enemies<br/><li>Extended the syntax of the bot_add, bot_kick, and bot_kill commands to also accept \"t\" or \"ct\" arguments.<br/><li>Fixed bug where bots would stop and become unresponsive if they wanted to hide in an area with no hiding spots<br/><li>Improved bot navigation on the windows and ledges of cs_italy<br/><li>Fixed recording value of cl_interp in demo files and restore value during playback<br/></li></li></li></li></li></li></li></li></li></li></li></li></li></li></li></li></li></li></ul><br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>HTTP downloads from the game server system support downloading .bz2-compressed files<br/><li>Disable old style (non-challenged) server queries by default (use the sv_enableoldqueries cvar to change this behavior)<br/><li>Added cvar tv_delaymapchange to delay map changes caused by frag/time limit until the whole game is broadcasted via SourceTV <br/><li>Fixed lag compensation invalidating bone cache for players moved back in time.<br/><li>Fixed lag compensation interpolation error between 2 ticks<br/></li></li></li></li></li></ul><br/><b>Half-Life 2</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed some NPC actions not being properly randomized<br/></li></ul><br/><b>SourceTV <i>(part of the Source Dedicated Server)<br/></i></b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed memory leak in relay servers by releasing receive tables correctly<br/><li>Bandwidth output in tv_status in kB/sec rather than bytes/sec<br/><li>Running a new map command (spawning a server) shuts down TV relay in same process<br/><li>Fixed SourceTV chase cam following ragdolls of dead secondary targets<br/></li></li></li></li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2005-05-23', NULL, '<div class=\"details\" id=\"May 23, 2005\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed an intermittent crash (\"failed to open models\gman_high.vvd\") in Half-Life 2</li> </ul>
</div>'),
(220, '2005-09-12', 'Half-life 2: Game Of The Year Available At North America Retail Outlets Now', '<div class=\"post_content\" id=\"content_442\" style=\"display: none;\">
<p>Valve Corporation today announced that <a href=\"#\" onclick=\"ImagePopup(\'/img/HL2GY.jpg\', 335, 468);\">Half-Life® 2: Game of the Year</a> has started shipping to retail outlets in North America.  Half-Life 2: Game of the Year is a special edition release of the best-selling and critically acclaimed title that includes Half-Life 2, Counter-Strike: Source, plus Half-Life 2: Deathmatch, and Half-Life: Source.  Half-Life 2: Game of the Year will begin shipping to other territories worldwide in the coming weeks.</p>
<br clear=\"left\"/>
</div>'),
(220, '2005-10-03', 'Source Engine And Half-life 1: Engine Updates Available', '<div class=\"post_content\" id=\"content_452\" style=\"display: none;\">
<p>Updates to the Source Engine and Half-Life 1: Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed loading error when trying to debug Source MODs using the SDK<br/><li>Fixed a startup crash in Windows 98<br/></li></li></ul><br/><b>Half-Life 1: Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed name exploit causing client crash</li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2005-12-02', 'Source Engine Update Available', '<div class=\"post_content\" id=\"content_489\" style=\"display: none;\">
<p>Updates to the Source Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed \"Extra App ID set to 211, but no SteamAppId\" error when launching Source SDK tools</li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2005-12-20', 'Counter-strike: Source Update Available', '<div class=\"post_content\" id=\"content_495\" style=\"display: none;\">
<p>Updates to Counter-Strike: Source have been released. The updates will be applied automatically when your Steam client is restarted.</p>
<br clear=\"left\"/>
</div>'),
(220, '2006-01-09', 'Source Engine Update Available', '<div class=\"post_content\" id=\"content_498\" style=\"display: none;\">
<p>Updates to the Source Engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Source engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed problem users with ATI cards were experiencing with overly shiny cube maps</li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2006-01-17', 'Source Engine Sdk Update Released', '<div class=\"post_content\" id=\"content_500\" style=\"display: none;\">
<p>A major update to the Source SDK has been released on Steam. Included in this update are several features and fixes for the tools in the Source SDK. <br/><br/><b>New SDK Features</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>High Dynamic Range lighting now supported in the tools<br/><li>Day of Defeat: Source support now included<br/><li>New Hammer Editor features:<br/> <ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>VGUI Model browser with real-time 3D view<br/> <li>Map autosave/backup<br/> <li>Model and displacement rendering in 2D views<br/> <li>Many other small improvements and bug fixes <br/></li></li></li></li></ul></li></li></li></ul><br/>For a full list of changes, see the <a href=\"http://developer.valvesoftware.com/wiki/Source_SDK_Release_Notes\">Source SDK Changelist</a> on the <a href=\"http://developer.valvesoftware.com/\">Valve Developer Community site</a></p>
<br clear=\"left\"/>
</div>'),
(220, '2006-03-20', 'Source Engine And Dedicated Server Update', '<div class=\"post_content\" id=\"content_524\" style=\"display: none;\">
<p>Updates to the Source Engine and Windows Dedicated Servers have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed Garry\'s Mod failing to spawn new entities (was failing due to \"userinfo\" command change)<br/><li>Fixed background music playing after joining a game if the game was launched via a desktop shortcut<br/></li></li></ul><br/><b>Source/Half-Life 1 Dedicated Server</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>(win32) Fixed \"Steam Validation Rejected\" error when connecting to a game server<br/></li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2006-04-19', NULL, '<div class=\"details\" id=\"April 19, 2006\" style=\"display: block;\">
Changes/Additions
	<ul>
<li> Fixed bug where NPCs would ignore hintbrushes that should block line of sight.</li> </ul>
</div>'),
(220, '2006-04-19', 'Counter-strike: Source, Half-life 2, And Source Engine Updates Available', '<div class=\"post_content\" id=\"content_581\" style=\"display: none;\">
<p>Updates to CS:S, HL2, and the Source engine have been released. The updates will be applied automatically when your Steam client is restarted. The specific changes include:<br/><br/><b>Counter-Strike: Source</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Removed FCVAR_ARCHIVE from cl_minmodels<br/><li>Added a workaround for linux servers sometimes being frozen after changelevel<br/><li>Linux dedicated server -condebug captures all console output now<br/><li>Fixed an exploit when joining a team that could spawn live spectators<br/><li>Fixed mp3 player advancing more than 1 song during level transitions<br/></li></li></li></li></li></ul> <br/><b>Half-Life 2</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed bug where NPCs would ignore hintbrushes that should block line of sight<br/></li></ul> <br/><b>Source Engine</b><br/><ul style=\"padding-bottom: 0px; margin-bottom: 0px;\"><li>Fixed really long game directories not being able to upload game statistics<br/><li>Fixed listen server host not being able to hear sounds from bsp .zip files<br/><li>Fixed demo smoother not being able to select samples in certain demo files<br/><li>Fixed partial-HDR exploit in DX7 allowing wireframe materials<br/></li></li></li></li></ul></p>
<br clear=\"left\"/>
</div>'),
(220, '2006-06-01', 'Half-life 2: Episode One Available Now', '<div class=\"post_content\" id=\"content_643\" style=\"display: none;\">
<p>Valve Launches First of an Episodic Trilogy<br/><br/>Bellevue, WA, June 1, 2006 - Valve®, developer of the blockbuster series Half-Life® and Counter-StrikeTM, announced <a href=\"http://storefront.steampowered.com/v2/index.php?area=game&amp;AppId=380\">Half-Life® 2: Episode One</a> is now available via <a href=\"http://www.steamgames.com/\">Steamgames.com</a> for just $19.95 and at retail outlets around the world. <br/><br/>The first in a trilogy of episodic games, Episode One reveals the aftermath of Half-Life 2 and launches a journey beyond City 17. Episode One does not require Half-Life 2 to play and also includes a first look at Episode Two, which will ship by year\'s end.<br/><br/>In addition to the new single player experience, two multiplayer games are included. And those who purchase Episode One will have free access via Steam (<a href=\"http://www.steamgames.com/\">www.steamgames.com</a>) to Half-Life 2: Lost Coast, the interactive technology demo that introduces High Dynamic Range lighting to the SourceTM Engine, Valve\'s award-winning game technology.</p>
<br clear=\"left\"/>
</div>'),
(220, '2007-10-01', 'Team Fortress 2: Meet The Heavy...in Russian', '<div class=\"post_content\" id=\"content_1227\" style=\"display: none;\">
<p>The first of the Team Fortress 2 character shorts, Meet the Heavy, <a href=\"index.php?area=game&amp;AppId=994\">has been translated to Russian</a>. Now you (and millions of his homelanders) can hear Heavy\'s deepest thoughts in his own words, in his own way, in his first language. <br/><br/>Team Fortress 2 is the multiplayer component of The Orange Box, a unique collection of new games from Valve for the PC and Xbox 360. The PC edition of The Orange Box - which also features Half-Life 2: Episode Two, Portal, as well as the complete Half-Life 2 experience to date - is now available for <a href=\"index.php?area=package&amp;SubId=469\">pre-purchase via Steam </a> through October 10th for 10% off the $49.95 regular price.</p>
<br clear=\"left\"/>
</div>'),
(220, '2007-10-10', 'Valve Uncrates The Orange Box', '<div class=\"post_content\" id=\"content_1237\" style=\"display: ;\">
<p>Valve is pleased to announce the official \'uncrating\' of <a href=\"http://www.steampowered.com/v/index.php?area=package&amp;SubId=469\">The Orange Box</a>, now available on Steam. <br/><br/>The Orange Box features three top-rated new games by Valve: Half-Life® 2: Episode Two, the second installment in the Half-Life 2 episodic trilogy; Team Fortress® 2, the sequel to the game that put class-based, multiplayer team warfare on the map; and Portal, the game that blends puzzles, first person action, and adventure gaming to produce an experience like no other. <br/><br/>To bring gamers up to date with the Half-Life 2 universe, The Orange Box also includes Half-Life 2, the best-selling and highest-rated action game series of all time, and the episodic debut Half-Life® 2: Episode One—together, more than 30 hours of award-winning gameplay. Purchasers of the PC version of The Orange Box who already own Half-Life 2 and Half-Life 2: Episode One can conveniently “gift” them to a friend from within Steam. <br/><br/>All games included in <a href=\"http://www.steampowered.com/v/index.php?area=package&amp;SubId=469\">The Orange Box</a> are available separately or as part of two exclusive Steam collections: <a href=\"http://storefront.steampowered.com/v/index.php?area=package&amp;SubId=479\">The Source Premier Pack</a> and <a href=\"http://storefront.steampowered.com/v/index.php?area=package&amp;SubId=478\">The Valve Complete Pack</a>.</p>
<br clear=\"left\"/>
</div>');
