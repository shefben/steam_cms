-- Steam Platform Update History
-- App ID: 2730
-- Generated on: 2025-08-01 23:47:22
-- MySQL/MariaDB Format



INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES
(2730, '2007-06-25', 'Threadspace: Hyperbol \"stress Test\" Now Open', '<div class=\"post_content\" id=\"content_1107\" style=\"display: none;\">
<p>Iocaine Studios is looking for a few (5,000, actually) gamers to help<a href=\"http://www.hyperbol.com\"> \"stress test\"</a> its debut action-strategy game, ThreadSpace Hyperbol, slated for release on Steam in the next few weeks. <br/><br/>The goal of the Stress Test is to ensure the game is ready to host massive numbers of players and servers, as well as to offer a sneak peek at the unique gameplay. <br/><br/>ThreadSpace: Hyperbol is an action-strategy game set in the distant future. Players battle each other on roads in space as they pilot massive ships capable of firing a wide variety of weapons. Create defenses, coordinate with your team, and launch an assault against your opponents to achieve victory. <br/><br/><a href=\"http://www.hyperbol.com\">Click here</a> to sign up today. The Stress Test will run for one week, concluding at midnight on Sunday, July 1. Be sure to play through the tutorials to get a feel for the game. Note that characters created during the Stress Test will be wiped before the game is released.</p>
<br clear=\"left\"/>
</div>'),
(2730, '2007-06-29', NULL, '<div class=\"details\" id=\"June 29, 2007\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Greatly improved turret logic</li> <li> Larger aiming reticle and longer aiming line for straight shots</li> <li> Objective servers no longer force teams - you can now choose your team</li> <li> Join screen no longer limits to 15 servers</li> <li> Safe mode now forces windowed mode</li> <li> When you earn a new Award you will be notified immediately at round end</li> </ul>
Bug fixes
	<ul>
<li> Fixed the player tag from mouseing over friendlies being red</li> <li> Crashbug from too many walls being deployed fixed</li> <li> Unable to surface bug fixed</li> <li> Typos in several awards fixed</li> <li> HBLauncher and redists now work in Vista</li> <li> A few other minor bugs and annoyances fixed</li> </ul>
</div>'),
(2730, '2007-07-06', NULL, '<div class=\"details\" id=\"July 6, 2007\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Released ThreadSpace: Hyperbol Demo</li> </ul>
</div>'),
(2730, '2007-07-09', NULL, '<div class=\"details\" id=\"July 9, 2007\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> When you\'re out of lives, the choose your start point and ship screen will no longer tell you that it would unbalance teams.  Instead, the play button says \'0 lives\' and has an appropriate tooltip</li> <li> Some GUI sounds were not playing when they should (like Starport login noise)</li> <li> (Related) The \'warning siren\' will now correctly play when your ship is very low on armor.</li> <li> Load time improved</li> <li> Prod stations should no longer have zero fuel on create</li> <li> Demo time expiring will now show the appropriate message instead of authorization fail message</li> <li> You can no longer attempt to vote for the same sector twice (it was being denied by the server, with a confusing message)</li> <li> Mining Facility - Given the attackers an easier time at getting past the first portion of the map</li> </ul>
Bug fixes
	<ul>
<li> Game now correctly reports the number of players on each team in the team selection screen</li> <li> Auto team bug fixed whereby it\'d place you on the wrong team</li> <li> Servers no longer erronously appear red in the join screen</li> <li> Applied Many fixes for possible random crashes.</li> <li> Removed a few more alt-tab / task switch issues</li> <li> Fixed a bug where players would not be allowed to join a team or surface because it thought the teams were unbalanced.</li> <li> Fixed a bug whereby it would (correctly) disallow you from joining a pro game unless you\'re a pro, but would show the wrong message.</li> <li> Fixed some Steam related connection issues - at least, added code to reduce them</li> </ul>
</div>'),
(2730, '2007-07-11', NULL, '<div class=\"details\" id=\"July 11, 2007\" style=\"display: block;\">
Changes/Additions
	<ul>
<li> Stability improvements in terms of rendering and effects, for extreme edge cases</li> <li> Sound loading stability improvements for systems with unexpectedly incompatible sound cards</li> <li> Demo Map Change:  Hyperon Energy Plant - surface points have been moved to encourage attackers to take the final point if winning</li> <li> Demo Map Change:  Mining Facility  chokepoints and start positions reworked to favor attackers in the beginning.</li> <li> You are now notified why the resurface/reinforcement timer is resetting in objective games (A teammate was destroyed).</li> <li> Warning messages should no longer appear when you first join, such as Production Station under attack</li> <li> You are now notified that you are invulnerable until you attack or move, when appropriate.  You are also notified when this invulnerability is broken due to your actions or because the invulnerability time ran out.</li> <li> The Production Station can now be recycled while invulnerable.  Doing so will make you vulnerable, though.</li> <li> Players will no longer appear as level 1 when the map starts.  Unless they are level 1</li> <li> Some award typos have been fixed.</li> <li> Fighter swarms will no longer attack shielded production stations</li> <li> Stats are now viewable for each different game types</li> <li> Earned Awards, as well as requirements for remaining awards are now visible on a characters Starport page</li> <li> Retail maps added to map cycle.  Server admins can now make retail servers by reconfiguring their servers!</li> <li> Increased number of viewable game histories</li> <li> Increased number of viewable kills in the recently killed/killed by list</li> </ul>
Bug fixes
	<ul>
<li> Covert Ops award duration requirements fixed</li> </ul>
</div>'),
(2730, '2007-07-12', 'Threadspace: Hyperbol Now Available', '<div class=\"post_content\" id=\"content_1123\" style=\"display: ;\">
<p><a href=\"http://storefront.steampowered.com/v/index.php?area=game&amp;AppId=2720\">ThreadSpace: Hyperbol</a>, Iocaine Studios\' multiplayer action-strategy game, is now available for purchase and download. <br/><br/>ThreadSpace: Hyperbol is an action-strategy game set in the distant future. Players battle each other on roads in space as they pilot massive ships capable of firing a wide variety of weapons. Create defenses, coordinate with your team, and launch an assault against your opponents to achieve victory. <a href=\"http://storefront.steampowered.com/v/index.php?area=game&amp;AppId=2720\">Check it out!</a></p>
<br clear=\"left\"/>
</div>');
