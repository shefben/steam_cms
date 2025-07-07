REPLACE INTO theme_settings(theme,name,value) VALUES
('2006_v1','join_steam_text','Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.');

REPLACE INTO theme_settings(theme,name,value) VALUES
('2006_v1','new_on_steam_list',
'<a class="rightLink" href="index.php?area=game&AppId=3000"><img align="absmiddle" border="0" src="img/ico/ico_mouse_13.gif"> GTI Racing <span class="rightLink_newDate_gr"> (Aug 24, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=3010"><img align="absmiddle" border="0" src="img/ico/ico_mouse_13.gif"> Xpand Rally <span class="rightLink_newDate_gr"> (Aug 24, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=927"><img align="absmiddle" border="0" src="img/ico/ico_film_13.gif"> GTI Racing Trailer <span class="rightLink_newDate_gr"> (Aug 24, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=1510"><img align="absmiddle" border="0" src="img/ico/ico_mouse_13.gif"> Uplink <span class="rightLink_newDate_gr"> (Aug 23, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=929"><img align="absmiddle" border="0" src="img/ico/ico_film_13.gif"> Uplink Trailer <span class="rightLink_newDate_gr"> (Aug 23, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=928"><img align="absmiddle" border="0" src="img/ico/ico_film_13.gif"> Source Forts Trailer <span class="rightLink_newDate_gr"> (Aug 4, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=90034"><img align="absmiddle" border="0" src="img/ico/ico_mouse_13.gif"> Source Forts <span class="rightLink_newDate_gr"> (Aug 1, 2006)</span></a>\n'
 '<a class="rightLink" href="index.php?area=game&AppId=924"><img align="absmiddle" border="0" src="img/ico/ico_film_13.gif"> Red Orchestra Infantry Tutorial <span class="rightLink_newDate_gr"> (Jul 28, 2006)</span></a>');

REPLACE INTO theme_settings(theme,name,value) VALUES
('2006_v1','find_list',
'<div class="rightLink_find_area">\n<a class="rightLink_find" href="index.php?area=all"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> All Games </a>\n<a class="rightLink_find" href="index.php?area=browse"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> Browse Games </a>\n<a class="rightLink_find" href="index.php?area=search"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> Search</a>\n</div>\n<div class="rightLink_find_area">\n<a class="rightLink_find" href="index.php?area=media"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> Videos </a>\n<a class="rightLink_find" href="index.php?area=search&browse=1&category=10"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> Demos </a>\n<a class="rightLink_find" href="http://store.valvesoftware.com" target="_blank"><img border="0" height="7" src="img/ico/ico_arrow_yellow.gif" width="7"> Gear </a>\n</div>');

-- use dynamic news for latest items
REPLACE INTO theme_settings(theme,name,value) VALUES('2006_v1','latest_news_list','');
