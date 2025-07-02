<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Steam - News</title>
	<link href="styles_global.css" rel="stylesheet" type="text/css" />
	<link href="styles_content.css" rel="stylesheet" type="text/css" />
	<link href="styles_lists.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="swfobject.js"></script>
	<script language="JavaScript" src="cookies.js"></script>
	<script language="JavaScript" src="collapse.js"></script>
	<script language="JavaScript" src="height_fixer.js"></script>
</head>

<body>

<!-- header bar -->

	<div style="min-width:850px;" >
	<div class="globalHeadBar_logo"><a href="http://www.steampowered.com"><img src="img/logo_steam_header.jpg" alt="Steam main" border="0" /></a></div>
	<div class="globalHeadBar">
		<div class="globalNavItem"><a href="index.php?cc=--" title="Home"><span class="globalNavLink">HOME</span></a></div>
		<div class="globalNavItem"><a href="index.php?area=news&cc=--" title="News"><span class="globalNavLink">NEWS</span></a></div>
		<div class="globalNavItem"><a href="index.php?area=getsteamnow&cc=--" title="Get Steam"><span class="globalNavLink">GET STEAM NOW</span></a></div>
		<div class="globalNavItem"><a href="https://cafe.steampowered.com/" title="Cyber Cafes"><span class="globalNavLink">CYBER CAF&Eacute;S</span></a></div>
		<div class="globalNavItem"><a href="http://support.steampowered.com/" title="Support"><span class="globalNavLink">SUPPORT</span></a></div>
		<div class="globalNavItem"><a href="index.php?area=forums&cc=--" title="Forums"><span class="globalNavLink">FORUMS</span></a></div>
		<div class="globalNavItem"><a href="/v/index.php?area=stats&cc=--" title="Status"><span class="globalNavLink">STATS</span></a></div>
	</div>
	</div>
	<br clear="all" />

<!-- end header bar -->

<center>

	<div class="contentBG_2">

		<div class="headerBG_2">

			<!-- Left Menu -->
			<div class="leftMenu_2"><div class="menu_item"><a href="index.php?cc=--">Home</a></div>
<hr class="menu_spacer" />
<div class="menu_item"><a href="index.php?area=all&cc=--">All Games</a></div>
<div class="menu_item"><a href="index.php?area=browse&cc=--">Browse Games</a></div>
<div class="menu_item"><a href="index.php?area=search&cc=--">Search</a></div>
<hr class="menu_spacer" />
<div class="menu_item"><a href="index.php?area=free&cc=--">Free Stuff</a></div>
<div class="menu_item"><a href="index.php?area=media&cc=--">Videos</a></div>
</div>
			<!-- End Left Menu -->

			<!-- Left Collumn Content -->
			<div class="leftCol_news">

				<table width="462" cellpadding="0" cellspacing="0" background="img/headers/header_news.jpg">
				<tr>
					<td width="462" height="105"><span class="leftCol_news_header">&nbsp;Steam News </span></td>
				</tr>
				</table>

				<a href="index.php?area=news&id=637&cc=--" style="text-decoration: none;"><h1 style="line-height: 15px;">Source Engine and Dedicated Server update</h1></a>
<h2>May 30, 2006, 6:25 pm - Alfred Reynolds</h2>
<hr />
<p>An update to the Source Engine and Dedicated server has been released. The update will be applied automatically when your Steam client is restarted. The changes are:<br><br><b>Source Engine</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Fixed bug in receive proxies due to a mismatched structure change<br><li>Fixed crash in SourceTV if AUTO_DISPATCH_MODE was full, had no relays and a new client tried to connect<br></ul><br><b>Media</b><br><ul style="padding-bottom: 0px; margin-bottom: 0px;" ><li>Released Episode One launch teaser #3</ul></p>


<br />
				<br  clear="all" />

			</div>
			<!-- End Left Collumn Content -->

			<!-- Right Collumn Content -->
			<div class="rightCol_2">

				<div class="rightCol_2_top_soon" style="height: 40px;">

					<form action="index.php" id="searchform" name="searchform">
					<input type="hidden" name="area" value="news">
					<input type="hidden" name="cc" value="--">

					<table width="190" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20" nowrap>&nbsp;</td>
						<td width="190"><input id="searchterm" name="term" value="" type="text" size="25" maxlength="64"></td>
						<td>&nbsp;<a href="#" onClick="document.searchform.submit();" class="btn_search" style="">Search</a></td>
					</tr>
					</table><br clear="all" />
					</form>
				
				</div>

				<div id="rss_feeds_display">
					<div id="rss_feeds" class="usr_edit_right_header" onClick="toggle_section( 'rss_feeds' );" style="cursor: pointer;">
						<div style="float:left; ">
							RSS FEEDS
						</div>
						<div class="usr_edit_right_control" style="cursor: pointer;">
							<img id="rss_feeds_header" width="14" height="14" border="0" >
						</div>
					</div>
					<div id="rss_feeds_content">
						<div class="rightLink_news_area" style=" width: 240px; height: auto;">
						<ul>
						<li><a href="http://www.steampowered.com/rss.xml" target="_blank" class="rightLink_news"><img src="img/ico/ico_rss2.gif" border="0" align="absmiddle"> &nbsp;STEAM NEWS</a></li>
						</ul>
						</div>
						<br clear="all">
					</div>
				</div>
				<script>check_section( 'rss_feeds', 'open' );</script>

				
				<div id="filter_news_display" style="display: none;">
					<div id="filter_news" class="usr_edit_right_header" onClick="toggle_section( 'filter_news' );" style="cursor: pointer;">
						<div style="float:left; ">
							PRODUCT NEWS
						</div>
						<div class="usr_edit_right_control" style="cursor: pointer;">
							<img id="filter_news_header" width="14" height="14" border="0" >
						</div>
					</div>
					<div id="filter_news_content">
						<form action="index.php" id="product_filter_form" name="product_filter_form">
						<input type="hidden" name="area" value="news">
						<p>View news for:<br>
						<select name="AppId" onChange="document.product_filter_form.submit();" style="width: 225px;">
						<option value="">--</option>
						<option value="2900" >688(I) Hunter-Killer</option>
<option value="3800" >Advent Rising</option>
<option value="3340" >AstroPop Deluxe</option>
<option value="3300" >Bejeweled 2 Deluxe</option>
<option value="3350" >Bejeweled Deluxe</option>
<option value="3360" >BigMoney Deluxe</option>
<option value="2930" >Birth Of America </option>
<option value="3810" >BloodRayne</option>
<option value="3820" >BloodRayne 2</option>
<option value="3850" >BloodRayne 2 Demo</option>
<option value="3370" >Bookworm Deluxe</option>
<option value="2620" >Call of Duty</option>
<option value="2630" >Call of Duty&reg; 2</option>
<option value="2640" >Call of Duty: United Offensive</option>
<option value="3310" >Chuzzle Deluxe</option>
<option value="4400" >City Life</option>
<option value="92" >Codename Gordon</option>
<option value="10" >Counter-Strike</option>
<option value="80" >Counter-Strike: Condition Zero</option>
<option value="240" >Counter-Strike: Source</option>
<option value="1600" >Dangerous Waters</option>
<option value="2100" >Dark Messiah Might and Magic&trade;</option>
<option value="2120" >Dark Messiah Singleplayer Demo</option>
<option value="1500" >Darwinia</option>
<option value="1502" >Darwinia Demo</option>
<option value="30" >Day of Defeat</option>
<option value="300" >Day of Defeat: Source</option>
<option value="40" >Deathmatch Classic</option>
<option value="1520" >DEFCON</option>
<option value="1522" >DEFCON Demo</option>
<option value="1640" >Disciples II: Galleans Return</option>
<option value="1630" >Disciples II: Rise of the Elves </option>
<option value="3380" >Dynomite Deluxe</option>
<option value="1900" >Earth 2160</option>
<option value="3390" >Feeding Frenzy 2 Deluxe</option>
<option value="2910" >Fleet Command</option>
<option value="3000" >GTI Racing</option>
<option value="2610" >GUN&trade;</option>
<option value="70" >Half-Life</option>
<option value="220" >Half-Life 2</option>
<option value="320" >Half-Life 2: Deathmatch</option>
<option value="219" >Half-Life 2: Demo</option>
<option value="380" >Half-Life 2: Episode One</option>
<option value="340" >Half-Life 2: Lost Coast</option>
<option value="360" >Half-Life Deathmatch: Source</option>
<option value="130" >Half-Life: Blue Shift</option>
<option value="280" >Half-Life: Source</option>
<option value="3400" >Hammer Heads Deluxe</option>
<option value="3410" >Heavy Weapon Deluxe</option>
<option value="4800" >Heroes of Annihilated Empires</option>
<option value="3420" >Iggle Pop Deluxe</option>
<option value="3320" >Insaniquarium Deluxe</option>
<option value="1670" >Iron Warriors: T - 72 Tank Command </option>
<option value="1620" >Jagged Alliance 2 Gold</option>
<option value="4700" >Medieval II: Total War&trade;</option>
<option value="4710" >Medieval II: Total War&trade; Demo</option>
<option value="50" >Opposing Force</option>
<option value="3430" >Pizza Frenzy Deluxe</option>
<option value="4100" >Poker Superstars II</option>
<option value="3830" >Psychonauts</option>
<option value="3840" >Psychonauts Demo</option>
<option value="1002" >Rag Doll Kung Fu</option>
<option value="1200" >Red Orchestra: Ostfront 41-45</option>
<option value="60" >Ricochet</option>
<option value="4300" >RoboBlitz</option>
<option value="4310" >RoboBlitz Demo</option>
<option value="3440" >Rocket Mania Deluxe</option>
<option value="2500" >Shadowgrounds</option>
<option value="2510" >Shadowgrounds Demo</option>
<option value="3960" >Shattered Union</option>
<option value="3910" >Sid Meier's Civilization&reg; III Complete</option>
<option value="3900" >Sid Meier's Civilization&reg; IV</option>
<option value="3920" >Sid Meier's Pirates!</option>
<option value="1313" >SiN 1</option>
<option value="1309" >SiN 1 Multiplayer</option>
<option value="1300" >SiN Episodes: Emergence</option>
<option value="1610" >Space Empires IV Deluxe</option>
<option value="1690" >Space Empires V</option>
<option value="2920" >Sub Command</option>
<option value="3460" >Talismania Deluxe</option>
<option value="20" >Team Fortress Classic</option>
<option value="2400" >The Ship</option>
<option value="3450" >Typer Shark Deluxe</option>
<option value="1510" >Uplink</option>
<option value="2800" >X2: The Threat</option>
<option value="2810" >X3: Reunion</option>
<option value="3010" >Xpand Rally</option>
<option value="3330" >Zuma Deluxe</option>

						</select></p>
						</form>
					</div>
				</div>
				<script>check_section( 'filter_news', 'closed' );</script>


				<div id="news_archives_display" style="display: none;">
					<div id="news_archives" class="usr_edit_right_header" onClick="toggle_section( 'news_archives' );" style="cursor: pointer;">
						<div style="float:left; ">
							
						</div>
						<div class="usr_edit_right_control" style="cursor: pointer;">
							<img id="news_archives_header" width="14" height="14" border="0" >
						</div>
					</div>
					<div id="news_archives_content">
						<div class="rightLink_news_area" style=" width: 240px; height: auto;">
						<ul>
						
						</ul>
						<a href="index.php?area=news&cc=--" class="rightLink_moreUpdates"><img src="img/ico/ico_arrow_blue_wd.gif" width="22" height="7" border="0" /> &nbsp;Back To Current News </a>
						</div>
					</div>
				</div>
				<script>check_section( 'news_archives', 'open' );</script>


				<div class="rightLink_update_area" id="secondary_link">
					<a href="index.php?area=news&cc=--" class="rightLink_moreUpdates"><img src="img/ico/ico_arrow_blue_wd.gif" width="22" height="7" border="0" /> &nbsp;Back To Current News </a>
				</div>

			</div>

			<!-- End Right Collumn Content -->

			<br clear="left" />
		
		</div>

	<br clear="all" />

	</div>

	<!-- Footer Content -->
	
	<div class="footer">
	<form action="index.php">
	<input type="hidden" name="area" value="news">
	
	
	<input type="hidden" name="cc" value="--">

	<table width="910px"  border="0" cellpadding="0" cellspacing="0" background="img/img_footer_bg.jpg">
	<tr>
		<td width="12" height="73" background="img/img_footer_l.jpg">&nbsp;</td>
		<td width="110" align="center"><a href="http://www.valvesoftware.com"><img src="img/logo_valve_footer.jpg" alt="link: Valve Software" width="92" height="26" border="0" /></a></td>
		<td>
		
			<div class="legal">

				<select name="l" onChange="submit();">
					<option value="english"		selected>English</option>
					<option value="french"		id="l_french">French</option>
					<option value="german"		id="l_german">German</option>
					<option value="italian"		id="l_italian">Italian</option>
					<option value="japanese"	id="l_japanese">Japanese</option>
					<option value="korean"		id="l_korean">Korean</option>
					<option value="portuguese"	id="l_portuguese">Portuguese</option>
					<option value="russian"		id="l_russian">Russian</option>
					<option value="schinese"	id="l_schinese">Simplified Chinese</option>
					<option value="tchinese"	id="l_tchinese">Traditional Chinese</option>
					<option value="spanish"		id="l_spanish">Spanish</option>
					<option value="thai"		id="l_thai">Thai</option>
				</select><br />

				&copy; 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br />
				<a href="http://www.valvesoftware.com/privacy.htm"> Privacy Policy.</a> <a href="http://www.valvesoftware.com/legal.htm">Legal.</a> <a href="http://www.steampowered.com/index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a>
				
			</div>
			
		</td>
		<td width="14" height="73" background="img/img_footer_r.jpg">&nbsp;</td>
	</tr>
	</table>
	</form>
	</div>
<br />
	<!-- End Footer Content -->

</center>

</body>
</html>
<!-- 1.65 1.62 1.67 -->
<!-- fatigo server -->
