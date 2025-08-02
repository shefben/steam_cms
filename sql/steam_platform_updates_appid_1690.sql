-- Steam Platform Update History
-- App ID: 1690
-- Generated on: 2025-08-01 23:44:48
-- MySQL/MariaDB Format



INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES
(1690, '2006-10-16', NULL, '<div class=\"details\" id=\"October 16, 2006\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Released on Steam</li> </ul>
</div>'),
(1690, '2006-10-17', NULL, '<div class=\"details\" id=\"October 17, 2006\" style=\"display: none;\">
Changes/Additions
	<ul>
<li> Updated to version 1.08</li> </ul>
</div>'),
(1690, '2006-11-20', NULL, '<div class=\"details\" id=\"November 20, 2006\" style=\"display: none;\">
Bug fixes
	<ul>
<li> Fixed memory leak in Game Setup</li> <li> Tweak to increase numbers of AI Attack ships with size of empire</li> <li> Fix to add more than 1 Space Yard to a planet using the Build # setting</li> <li> Fixed ground combat was not occuring in Simultaneous Games</li> <li> Fixed ground combat taking place at the end of all player\'s turns but before the end of all player\'s turns processing</li> <li> Fixed ground combat only occuring once per turn in Turn Based</li> <li> Fixed launching the Sector View on sectors you couldn\'t currently see</li> </ul>
</div>'),
(1690, '2007-01-29', NULL, '<div class=\"details\" id=\"January 29, 2007\" style=\"display: block;\">
Bug fixes
	<ul>
<li> Fixed   - Surrendered empires would suddenly lose all of their population</li> <li> Fixed   - Subjugated populations should not migrate</li> <li> Fixed   - Hitting cancel on the Load / Save Game window during a game would send you to the Game Start window and not back to your game</li> <li> Fixed   - Mouse pointer would still be hidden after the first ground combat</li> <li> Fixed   - If you turned on the \"View Names\" and the \"View Damage\" in combat, then they would overlap</li> <li> Fixed   - Improved AI\'s use of fleets (they don\'t sit waiting for ships as much).</li> <li> Fixed   - AI will now check to be sure safe locations to move are still safe</li> <li> Fixed   - AI Satellite design tweaked towards heavier weapons</li> <li> Fixed   - AI was not building as many units as it should</li> <li> Fixed   - The Ships List and Planets List windows were not showing reduced flag sizes correctly</li> <li> Fixed   - In a Simultaneous Game, if you created a design, saved the game, ended your turn, then processed the game turn, the game would have two copies of your new design</li> <li> Fixed   - Ships moving to their destination on their last movement point were not clearing their orders</li> <li> Fixed   - \"Planet Utilization\" tech area increased to 40 levels</li> </ul>
</div>');
