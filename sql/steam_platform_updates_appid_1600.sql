-- Steam Platform Update History
-- App ID: 1600
-- Generated on: 2025-08-01 23:44:26
-- MySQL/MariaDB Format



INSERT INTO `platform_update_history` (`appid`, `date`, `title`, `content`) VALUES
(1600, '2007-02-12', NULL, '<div class=\"details\" id=\"February 12, 2007\" style=\"display: block;\">
Changes/Additions
	<ul>
<li> Added variable in \"dangerouswaters.ini\" which controls the likelihood of torpedos exploding 
  on countermeasures (e.g. \".PercentTorpsExplodeOnCM 0\" up to \".PercentTorpsExplodeOnCM 100\"). 
  In multi-player matches, the host\'s .INI setting will be used by all players. By default 
  the value is set to \".PercentTorpsExplodeOnCM 50\".</li> <li> Added variable in \"dangerouswaters.ini\" which controls the likelihood of all weapons acquiring 
  dead/sinking platforms (e.g. \".PercentDeadPlatformsIgnored 0\" up to \".PercentDeadPlatformsIgnored 100\"). 	  
  In multi-player matches, the host\'s .INI setting will be used by all players. By default 
  the value is set to \".PercentDeadPlatformsIgnored 10\".</li> <li> Updated MH-60 model and AQS-22 on Dipping Sonar (addressed the reversed normals issue 
  which was causing issues with the self-shadowing paradigm).</li> <li> Updated the Freighter model and textures with the one used in the Steam trailer</li> <li> Updated FFG model and textures</li> <li> Updated 688(I) model, textures, and masts</li> <li> Strike missiles were modified so that their approach angles yielded a more effective result 
  against their respective land targets</li> <li> Addressed torpedo anomaly which caused the torpedos to not behave as expected</li> <li> Refined the buoyancy model to allow a more stable ascent and descent in the submarines 
  and to allow them to maintain their depth without unnecessary oscillation</li> <li> The Akula Towed Array should no longer be accidentally severed by the propeller</li> <li> Fixed speed/pitch issues on the FFG when player issues hard rudder orders</li> <li> Corrected a pathfinding issue fixed which could sometimes cause the game to crash if
  a waypoint was deemed to be incorrect or unreachable by the algorithm</li> <li> QuickRepair and QuickAircraftLaunch now controlled correctly in multiplayer</li> </ul>
Bug fixes
	<ul>
<li> Corrected an issue in which the Kilo was capable of creating Sonar contacts at excessively long ranges</li> <li> Fixed an issue in which AI aircraft were not dropping contacts when they had lost sensor contact</li> <li> Modified buoyancy model so that ships do not rock excessively at Sea State 1</li> <li> Fixed crash when launching the DSRV from submarine platforms</li> <li> Corrected AI aircraft order persistence, which makes them more decisive during attacks</li> <li> Fixed issue in which passive self-noise was being considered by active sensors</li> <li> Torpedo speed vs. fuel issue was corrected</li> <li> Corrected an issue which prohibited \"nested tactics at waypoints\" from being invoked properly</li> <li> Fixed a crash in the Towed Array station on the FFG</li> </ul>
</div>');
