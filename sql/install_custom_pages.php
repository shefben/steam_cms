<?php
//INSERT INTO custom_pages(slug,title,content,theme,template,created,updated) VALUES
$insertArray = [];

$content2002v1 = <<<HTML
<ul>
<li type="square"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>*** SERVER ARE ONLINE!&nbsp;***</b><br>
</font><font size="3"><br>
</font>
</li><li type="square"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>*DoD beta 2.0 is available</b><b>*</b><b><br>
</b></font><font size="3"><br>
</font>
</li><li type="square"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>Become A Beta Tester!</b></font><font size="3"><br>


                                        If you&#39re interested in becoming a Beta Tester, fill out our <a href="index.php?area=betatest" target="_new">Survey</a><br>
</font><font size="2"></font><font size="3"><br>
</font>
</li><li type="square"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>From the Dev Team:<br>
</b></font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>Planned Changes/Additions:</b><b><br>
</b></font><font face="Times New Roman,Georgia,Times" size="3">--------------------------<br>
                                        - Hostage AI upgrade<br>
                                        - New Counter-Strike hostage rescue map<br>
                                        - Vote/Kick<br>
                                        - General code optimization pass (client and server)<br>
                                        - Anti-Cheating system incorporated<br>
                                        - Allow server administrators to bind server to specific IP<br>
                                        - Allow server administrators to bind server to specific port<br>
                                        - Allow command line switches for server administrators<br>
                                        - Rework Para accuracy<br>
                                        - Make left and right handed models switchable on the fly<br>
                                        - Incorporate Tracker into Steam beta<br>
                                        - Remove "Use Shooting" from Counter-Strike<br>
                                        - Remove speed penalty when falling off an object.Will only apply when jumping.<br>
                                        - Allow muting of other player&#39s text messages.<br>
<br>
</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>Planned Bug fixes:</b><b><br>
</b></font><font face="Times New Roman,Georgia,Times" size="3">--------------------------<br>
                                        - Default voice to use DirectSound by default<br>
                                        - Allow Steam to autoupdate itself<br>
                                        - Fix demo playback.<br>
                                        - Fix bug that allows a player automatically chosen as the VIP to keep their weapon.<br>
                                        - Fix exploit that allows Counter-Terrorists to look like Terrorists in certain maps.<br>
                                        - Fix missing entries in the spectator menu.<br>
<br>
</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>Recent Changes/Additions:</b><b><br>
</b></font><font face="Times New Roman,Georgia,Times" size="3">--------------------------<br>
                                        - HLTV UI upgrade<br>
                                        - Returned crosshairs for C4 and the knife<br>
                                        - Added de_chateau to mapcycle<br>
<br>
</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="3"><b>Recent Bugfixes:</b><b><br>
</b></font><font face="Times New Roman,Georgia,Times" size="3">--------------------------<br>
                                        - Fixed jittery jump bug<br>
                                        - Fixed server list filtering bug in which the game filter attribute was lost<br>
                                        - Fixed string 595 error when clicking server list filter button<br>
                                        - Fixed problem with Terrorist and Counter-Terrorist menus not looking correct after changing teams<br>
</font>
<p></p>
</li></ul>
HTML;

$insertArray[] = [
    '2002v1_index',            // slug
    'Steam Powered',           // title
    $content2002v1,              // content
    '2002_v1',                 // theme
    'index.twig',               // template
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2002v2 = <<<HTML
<td align="left" colspan="4" content="" csheight="441" height="444" valign="top" width="769" xpos="15">
<div align="center">
<div align="left">
<p><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>OVER</b></font><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>VIEW</b></font></p>
<p><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">Steam is a broadband business platform for direct software delivery and content management. At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br>
<br>
</font></p>
<p><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.<br>
<br>
</font></p>
<p><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">Steam consumers enjoy the benefit of starting their favorite applications within minutes of confirming their purchase. They can access their applications from any PC. They are no longer challenged to find the latest updates for these applications. And they no longer need to wonder if their device drivers are compatible with the latest software.<br>
<br>
</font></p>
<p><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">The Steam SDK also includes an integrated set of communications tools and Valve&#39s Graphic User Interface (V-GUI) that provide built-in support for a variety of services such as instant messaging, configuration, and server browsing.</font><font color="black" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"><br>
</font></p>
</div>
<p><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b><a href="index.php?area=getsteamnow">Try Steam Now!</a></b></font></p>
<p><font size="4"><a href="(Empty Reference!)"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular"><br>
</font></a></font></p>
<div align="left" style="width: 762; height: 178">
<p><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>MORE</b></font><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>&nbsp;INFORMATION</b></font></p>
<p style="margin-bottom: 0"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">For
technical inquiries, please email:</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"> <a href="mailto:tech@steampowered.com"><b>tech@steampowered.com</b></a></font></p>
<p style="margin-bottom: 0"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">For press inquiries, please mail:</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"> <a href="mailto:press@steampowered.com"><b>press@steampowered.com</b></a></font></p>
<p style="margin-bottom: 0"><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">For
business inquires, please email: </font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"><a href="mailto:biz@steampowered.com"><b>biz@steampowered.com</b></a></font></p>
</div>
</div>
</td>
HTML;

$insertArray[] = [
    '2002v2_index',            // slug
    'Steam Powered',           // title
    $content2002v2,              // content
    '2002_v2',                 // theme
    'index.twig',               // template
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2003v1 = <<<HTML
<tr height="373">
<td colspan="2" height="373" width="81"><spacer height="373" type="block" width="81"></spacer></td>
<td align="left" colspan="2" content="" csheight="356" height="373" valign="top" width="636" xpos="81">
<div align="center">
<div align="left">
<table border="0" cellpadding="0" cellspacing="2" width="141">
<tbody><tr>
<td>
<p><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>OVER</b></font><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>VIEW</b></font></p>
</td>
</tr>
<tr>
<td><img border="0" height="5" src="images/Graphic_box.jpg" width="33"></td>
</tr>
</tbody></table>
<p><font color="#969f8e" size="2">Steam is a broadband business platform for direct software delivery and content management. At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br>
<br>
</font></p>
<p><font color="#969f8e" size="2">With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.<br>
<br>
</font></p>
<p><font color="#969f8e" size="2">Steam consumers enjoy the benefit of starting their favorite applications within minutes of confirming their purchase. They can access their applications from any PC. They are no longer challenged to find the latest updates for these applications. And they no longer need to wonder if their device drivers are compatible with the latest software.<br>
<br>
</font></p>
<p><font color="#969f8e" size="2">The Steam SDK also includes an integrated set of communications tools and Valve&#39s Graphic User Interface (V-GUI) that provide built-in support for a variety of services such as instant messaging, configuration, and server browsing.<br>
</font></p>
</div>
<p><font color="#bfba50" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>Coming Soon!</b></font></p>
</div>
</td>
<td height="373" width="82"><spacer height="373" type="block" width="82"></spacer></td>
<td height="373" width="1"><spacer height="373" type="block" width="1"></spacer></td>
</tr>
<tr height="225">
<td height="225" width="15"><spacer height="225" type="block" width="15"></spacer></td>
<td align="left" colspan="2" height="225" valign="top" width="387" xpos="15">
<table border="0" cellpadding="0" cellspacing="0" height="211" width="382">
<tbody><tr height="211">
<td background="themes/2003_v1/images/Box_01.gif" height="211" width="382">
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="208" showgridx="" showgridy="" width="360">
<tbody><tr height="10">
<td colspan="3" height="10" width="359"></td>
<td height="10" width="1"><spacer height="10" type="block" width="1"></spacer></td>
</tr>
<tr height="197">
<td height="197" width="3"></td>
<td align="left" content="" csheight="193" height="197" valign="top" width="336" xpos="3">
<div align="left">
<table border="0" cellpadding="0" cellspacing="2" width="64">
<tbody><tr>
<td>
<p><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>MORE&nbsp;</b></font><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>INFORMATION</b></font></p>
</td>
</tr>
<tr>
<td><img border="0" height="5" src="images/Graphic_box.jpg" width="33"></td>
</tr>
</tbody></table>
<a name="contactanchor2"></a>
<p><font color="#969f8e" size="2">For technical inquiries, please email:</font><font color="#c4cabe" size="2"><br>
</font><font size="2"><a href="mailto:tech@steampowered.com">tech@steampowered.com</a><a href="mailto:tech@steampowered.com"><br>
</a><a href="mailto:tech@steampowered.com"><br>
</a></font><font color="#969f8e" size="2">For press inquiries, please mail:</font><font size="2"><br>
<a href="mailto:press@steampowered.com">press@steampowered.com</a><a href="mailto:press@steampowered.com"><br>
</a><a href="mailto:press@steampowered.com"><br>
</a></font><font color="#969f8e" size="2">For business inquires, please email:</font><font color="white" size="2"><br>
</font><font size="2"><a href="mailto:biz@steampowered.com">biz@steampowered.com</a></font></p>
</div>
</td>
<td height="197" width="20"></td>
<td height="197" width="1"><spacer height="197" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="3"><spacer height="1" type="block" width="3"></spacer></td>
<td height="1" width="336"><spacer height="1" type="block" width="336"></spacer></td>
<td height="1" width="20"><spacer height="1" type="block" width="20"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</div>
</td>
</tr>
</tbody></table>
</td>
<td align="left" colspan="2" height="225" valign="top" width="397" xpos="402">
<table border="0" cellpadding="0" cellspacing="0" height="211" width="382">
<tbody><tr height="211">
<td background="themes/2003_v1/images/Box_01.gif" height="211" width="382">
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="196" showgridx="" showgridy="" width="360">
<tbody><tr height="4">
<td colspan="3" height="4" width="359"></td>
<td height="4" width="1"><spacer height="4" type="block" width="1"></spacer></td>
</tr>
<tr height="191">
<td height="191" width="3"></td>
<td align="left" content="" csheight="191" height="191" valign="top" width="347" xpos="3">
<div align="left">
<table border="0" cellpadding="0" cellspacing="2" width="249">
<tbody><tr>
<td>
<p><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>STEAM </b></font><font color="white" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>PARTNERS</b></font><font color="#c4cabe" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4"><b>&nbsp;</b></font></p>
</td>
</tr>
<tr>
<td><img border="0" height="5" src="images/Graphic_box.jpg" width="33"></td>
</tr>
</tbody></table>
<br>
<b><span class="2ndword">Become a Steam content provider!</span></b><font color="#c4cabe" size="2"><br>
<br>
</font><font color="#969f8e" size="2"><b>Basic Requirements:</b></font><font color="#c4cabe" size="2"><br>
</font><font color="black" size="2"><b>::</b></font><font color="#c4cabe" size="2"> </font><font color="#969f8e" size="2">100 megabits of bandwidth (OC-3 level)</font><font color="#c4cabe" size="2"><br>
</font><font color="black" size="2"><b>::</b></font><font color="#c4cabe" size="2"> </font><font color="#969f8e" size="2">1 gigabyte RAM</font><font color="#c4cabe" size="2"><br>
</font><font color="black" size="2"><b>::</b> </font><font color="#969f8e" size="2">1GHz processor (or better</font><font color="#c4cabe" size="2">)<br>
</font><font color="black" size="2"><b>::</b> </font><font color="#969f8e" size="2">WINDOWS&nbsp;2000 SERVER</font><font color="#c4cabe" size="2"><br>
</font><font color="#969f8e" size="2">Contact: <a href="mailto:biz@steampowered.com">biz@steampowered.com</a></font></div>
</td>
<td height="191" width="9"></td>
<td height="191" width="1"><spacer height="191" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="3"><spacer height="1" type="block" width="3"></spacer></td>
<td height="1" width="347"><spacer height="1" type="block" width="347"></spacer></td>
<td height="1" width="9"><spacer height="1" type="block" width="9"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</div>
</td>
</tr>
</tbody></table>
</td>
<td height="225" width="1"><spacer height="225" type="block" width="1"></spacer></td>
</tr>
HTML;

$insertArray[] = [
    '2003v1_index',
    'Steam Powered',
    $content2003v1,
    '2003_v1',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2003v2 = <<<HTML
<div class="content" id="container" style="background-image:url(themes/2003_v2/images/shieldguy.gif); background-position:top right; background-repeat:no-repeat;">
<img height="78" id="steam" src="themes/2003_v2/images/steam_logo_alpha.gif" width="244"><br><br>
<h2 id="page1">BECOME <em>PART OF THE STEAM COMMUNITY</em></h2><img alt="" height="6" src="images/Graphic_box.jpg" width="24"><br>
<ul>
<li>Play the latest Valve games (like Counter-Strike 1.6 beta!)</li>
<li>Get automatic updates (no more patching!)</li>
<li>Chat with friends, even while you play</li>
<li>Find the best servers &amp; find your friends&#39 games</li>
<li>Receive Steam-Only special offers</li>
</ul>
<a href="index.php?area=getsteamnow"><img alt="get steam now" height="24" src="themes/2003_v2/images/but_getsteamnow.gif" width="124"></a><br><br>
<a href="index.php?area=features"><img alt="screenshots" height="214" id="screenshots" src="themes/2003_v2/images/triple_screenshot.gif" width="535"></a><br>
<br><div class="boxTop">Latest News</div><br clear="all">
<div class="box">
{news_index_brief(3)}
</div>
<h2 id="afterBox">WHAT <em>IS STEAM?</em></h2><img alt="" height="6" src="images/Graphic_box.jpg" width="24"><br>
Steam is Valve&#39s new way of getting games into your hands ASAP. Games like <i>Half-Life</i>, <i>Counter-Strike</i>, and <i>Counter-Strike Condition Zero</i> are all being made available through Steam.<br>
<nobr>
<a href="http://half-life.com" onmouseout="out(5)" onmouseover="over(5)"><img align="absmiddle" alt="Half-Life" height="36" name="logo_hl" src="themes/2003_v2/images/logo_hl.gif" vspace="8" width="36"></a> &nbsp;
<a href="http://www.counter-strike.net" onmouseout="out(6)" onmouseover="over(6)"><img alt="Counter-Strike" height="36" name="logo_cs" src="themes/2003_v2/images/logo_cs.gif" width="36"></a> &nbsp;
<a href="http://www.cs-conditionzero.com/" onmouseout="out(7)" onmouseover="over(7)"><img alt="Counter-Strike: Condition Zero" height="36" name="logo_cz" src="themes/2003_v2/images/logo_cz.gif" width="45"></a> &nbsp;
<a href="http://www.teamfortressclassic.com" onmouseout="out(8)" onmouseover="over(8)"><img alt="Team Fortress Classic" height="36" name="logo_tfc" src="themes/2003_v2/images/logo_tfc.gif" width="36"></a> &nbsp;</nobr>
<nobr>
<a href="http://hlopposingforce.sierra.com/" onmouseout="out(9)" onmouseover="over(9)"><img alt="Half-Life: Opposing Force" height="36" name="logo_opfor" src="themes/2003_v2/images/logo_opfor.gif" width="36"></a> &nbsp;
<a href="http://www.dayofdefeatmod.com/" onmouseout="out(10)" onmouseover="over(10)"><img alt="Day of Defeat" height="36" name="logo_dod" src="themes/2003_v2/images/logo_dod.gif" width="36"></a> &nbsp;&nbsp;
<a href="http://www.planethalflife.com/features/motw/ricochet.shtm" onmouseout="out(11)" onmouseover="over(11)"><img alt="Ricochet" height="36" name="logo_r" src="themes/2003_v2/images/logo_r.gif" width="36"></a> &nbsp;&nbsp;
<a href="index.php" onmouseout="out(12)" onmouseover="over(12)"><img alt="Deathmatch Classic" height="36" name="logo_dmc" src="themes/2003_v2/images/logo_dmc.gif" width="36"></a></nobr>
<br>
Steam games are automatically kept up-to-date with the latest content and revisions. Steam also includes an instant-message client which even works while you&#39re in-game.<br><br>
At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br><br>
With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.
Check out the full <a href="index.php?area=features">feature list</a>, and <a href="index.php?area=getsteamnow">install Steam</a> today!
</div>
HTML;

$insertArray[] = [
    '2003v2_index',
    'Welcome to Steam',
    $content2003v2,
    '2003_v2',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2004 = <<<HTML
<h2 >BECOME <em>PART OF THE STEAM COMMUNITY</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<ul>
	<li>Play the latest Valve games (like Counter-Strike: Condition Zero!)</li>
	<li>Get automatic updates (no more patching!)</li>
	<li>Chat with friends, even while you play</li>
	<li>Find the best servers &amp; find your friends' games</li>
	<li>Receive Steam-Only special offers</li>
</ul>
<!-- <h2 id="page1">PRELOAD <em>HALF-LIFE® 2 NOW!</em></h2><img src="/web/20040920021739im_/http://www.steampowered.com/images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<ul>
	Pre-load now. Purchase when ready. Play the moment<br>
	Half-Life® 2 is made available! <br>
	Half-Life 2 is pre-loading around the clock <br>
	and around the globe. If you already have Steam, <br>
	<u>
	<a href="https://web.archive.org/web/20040920021739/steam://preload/220">CLICK&nbsp;HERE</a></u> to pre-load now. <br>
	<br>
	If you don't already have Steam, <a href="/web/20040920021739/http://www.steampowered.com/?area=getsteamnow">INSTALL  IT TODAY</a>!<br>
	<br>
</ul>-->
<a href="index.php?area=getsteamnow"><img src="images/but_getsteamnow.gif" height="24" width="124" alt="GET STEAM NOW"></a><br><br>
<br>
<a href="http://steampowered.com/?area=get_cz"><img width="483" height="133" src="images/cz_launch.gif" alt="Condition Zero now available for pre-order on Steam!"></a><br>

<br>
<br clear="all">
<h2 id="afterBox">HARDWARE <em>SURVEY</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
Check out the <a href="http://steampowered.com/status/survey.html">results of the "Half-Life 2 Hardware Survey"</a>. More than half a million respondents have taken part so far.<br>
<br>
<h2>WHAT <em>IS STEAM?</em></h2><img src="images/Graphic_box.jpg" height="6" width="24" alt=""><br>
Steam is Valve's new way of getting games into your hands ASAP. Games like Half-Life, Counter-Strike, and Counter-Strike: Condition Zero are all being made available through Steam.<br>
<br>
Steam games are automatically kept up-to-date with the latest content and revisions. Steam also includes an instant-message client which even works while you're in-game.<br>
<br>
<!--
At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br>
<br>
With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.<br>
<br>
-->
Check out the full <a href="/index.php?area=features">feature list</a>, and <a href="/index.php?area=getsteamnow">install Steam</a> today!<br>
HTML;

$insertArray[] = [
    '2004_index',
    'Welcome to Steam',
    $content2004,
    '2004',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2005v1 = <<<HTML
<table background="themes/2005_v1/images/TopBanner.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="75" showgridx="" showgridy="" width="800">
<tbody><tr height="22">
<td colspan="4" height="22" width="799"></td>
<td height="22" width="1"><spacer height="22" type="block" width="1"></spacer></td>
</tr>
<tr height="3">
<td height="52" rowspan="2" width="262"></td>
<td content="" csheight="29" height="52" rowspan="2" valign="top" width="391" xpos="262">
<div align="left">
<font size="2"><span class="statusContent">Steam delivers Valve&#39s games to your desktop and connects you to a massive gaming community. Check out the full <a href="index.php?area=features">feature list</a> now.</span></font></div>
</td>
<td colspan="2" height="3" width="146"></td>
<td height="3" width="1"><spacer height="3" type="block" width="1"></spacer></td>
</tr>
<tr height="49">
<td height="49" width="9"></td>
<td align="left" height="49" valign="top" width="137" xpos="662"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="24" src="themes/2005_v1/images/but_getsteamnow02.gif" width="124"></a></td>
<td height="49" width="1"><spacer height="49" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="262"><spacer height="1" type="block" width="262"></spacer></td>
<td height="1" width="391"><spacer height="1" type="block" width="391"></spacer></td>
<td height="1" width="9"><spacer height="1" type="block" width="9"></spacer></td>
<td height="1" width="137"><spacer height="1" type="block" width="137"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
<table bgcolor="#3e4637" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="657" showgridx="" showgridy="" width="801">
<tbody><tr height="53">
<td align="left" colspan="3" height="53" valign="top" width="173" xpos="0"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_01.gif" width="173"></td>
<td align="left" height="53" valign="top" width="28" xpos="173"><a href="index.php?area=news" onmouseout="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_02.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_02-over.gif");return true"><img alt="news" border="0" height="41" name="Banner_Nav_02" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_02.gif" width="28"></a></td>
<td align="left" height="53" valign="top" width="30" xpos="201"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_03.gif" width="30"></td>
<td align="left" colspan="3" height="53" valign="top" width="81" xpos="231"><a href="index.php?area=getsteamnow" onmouseout="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_04.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_04-over.gif");return true"><img alt="getSteamNow" border="0" height="41" name="Banner_Nav_04" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_04.gif" width="81"></a></td>
<td align="left" height="53" valign="top" width="32" xpos="312"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_05.gif" width="32"></td>
<td align="left" height="53" valign="top" width="66" xpos="344"><a href="index.php?area=cybercafes" onmouseout="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_06.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_06-over.gif");return true"><img alt="Cyber Cafes" border="0" height="41" name="Banner_Nav_06" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_06.gif" width="66"></a></td>
<td align="left" height="53" valign="top" width="32" xpos="410"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_07.gif" width="32"></td>
<td align="left" colspan="2" height="53" valign="top" width="45" xpos="442"><a href="support/entry.php" onmouseout="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_08.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_08-over.gif");return true"><img alt="Support" border="0" height="41" name="Banner_Nav_08" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_08.gif" width="45"></a></td>
<td align="left" height="53" valign="top" width="27" xpos="487"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_09.gif" width="27"></td>
<td align="left" height="53" valign="top" width="40" xpos="514"><a href="index.php?area=forums" onmouseout="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_10.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_10-over.gif");return true"><img alt="Forums" border="0" height="41" name="Banner_Nav_10" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_10.gif" width="40"></a></td>
<td align="left" height="53" valign="top" width="30" xpos="554"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_11.gif" width="30"></td>
<td align="left" height="53" valign="top" width="36" xpos="584"><a href="status/status.html" onmouseout="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_12.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"themes/2005_v1/images/Banner_NAV/Banner_Nav_12-over.gif");return true"><img alt="Status" border="0" height="41" name="Banner_Nav_12" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_12.gif" width="36"></a></td>
<td align="left" colspan="2" height="53" valign="top" width="180" xpos="620"><img alt="" border="0" height="41" src="themes/2005_v1/images/Banner_NAV/Banner_Nav_13.gif" width="180"></td>
<td height="53" width="1"><spacer height="53" type="block" width="1"></spacer></td>
</tr>
<tr height="364">
<td height="394" rowspan="2" width="11"><spacer height="394" type="block" width="11"></spacer></td>
<td align="left" colspan="18" height="364" valign="top" width="789" xpos="11">
<table background="themes/2005_v1/images/gamesbar.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="349" showgridx="" showgridy="" width="779">
<tbody><tr height="9">
<td colspan="6" height="9" width="778"></td>
<td height="9" width="1"><spacer height="9" type="block" width="1"></spacer></td>
</tr>
<tr height="282">
<td colspan="3" height="282" width="264"></td>
<td align="left" height="339" rowspan="2" valign="top" width="171" xpos="264">
<table background="themes/2005_v1/images/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
<tbody><tr height="5">
<td height="329" rowspan="7" width="6"></td>
<td height="247" rowspan="5" width="1"></td>
<td colspan="2" height="5" width="146"></td>
<td height="42" rowspan="2" width="9"></td>
<td height="5" width="1"><spacer height="5" type="block" width="1"></spacer></td>
</tr>
<tr height="37">
<td colspan="2" content="" csheight="33" height="37" valign="top" width="146" xpos="7">
<div align="left">
<font color="white"><b><span class="offerBRONZE">HALF-LIFE 2 BRONZE</span></b></font></div>
</td>
<td height="37" width="1"><spacer height="37" type="block" width="1"></spacer></td>
</tr>
<tr height="11">
<td align="left" colspan="3" height="11" valign="top" width="155" xpos="7"><img alt="" border="0" height="2" src="themes/2005_v1/images/rule01.gif" width="150"></td>
<td height="11" width="1"><spacer height="11" type="block" width="1"></spacer></td>
</tr>
<tr height="25">
<td content="" csheight="25" height="25" valign="top" width="145" xpos="7"><font color="white" size="2"><b><span class="offerPRICE">$49.95<br>
</span></b></font></td>
<td height="25" width="1"></td>
<td height="194" rowspan="2" width="9"></td>
<td height="25" width="1"><spacer height="25" type="block" width="1"></spacer></td>
</tr>
<tr height="169">
<td colspan="2" content="" csheight="146" height="169" valign="top" width="146" xpos="7">
<p><span class="statusContent3">INCLUDES:</span><br>
<span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life® 2*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Counter-Strike?:<br>
                                                        Source?</span></font></p>
</td>
<td height="169" width="1"><spacer height="169" type="block" width="1"></spacer></td>
</tr>
<tr height="40">
<td align="left" colspan="4" height="40" valign="top" width="156" xpos="6"><a href="steam://purchase/9"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withsteam.gif" width="150"></a></td>
<td height="40" width="1"><spacer height="40" type="block" width="1"></spacer></td>
</tr>
<tr height="42">
<td align="left" colspan="4" height="42" valign="top" width="156" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withoutsteam.gif" width="150"></a></td>
<td height="42" width="1"><spacer height="42" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="145"><spacer height="1" type="block" width="145"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="9"><spacer height="1" type="block" width="9"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td align="left" height="339" rowspan="2" valign="top" width="170" xpos="435">
<table background="themes/2005_v1/images/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
<tbody><tr height="5">
<td height="329" rowspan="7" width="6"></td>
<td height="247" rowspan="5" width="1"></td>
<td height="42" rowspan="2" width="3"></td>
<td height="5" width="137"></td>
<td colspan="2" height="42" rowspan="2" width="11"></td>
<td height="329" rowspan="7" width="4"></td>
<td height="5" width="1"><spacer height="5" type="block" width="1"></spacer></td>
</tr>
<tr height="37">
<td content="" csheight="33" height="37" valign="top" width="137" xpos="10"><font color="white"><b><span class="offerSILVER">HALF-LIFE&nbsp;2 SILVER</span></b></font></td>
<td height="37" width="1"><spacer height="37" type="block" width="1"></spacer></td>
</tr>
<tr height="11">
<td align="left" colspan="4" height="11" valign="top" width="151" xpos="7"><img alt="" border="0" height="2" src="themes/2005_v1/images/rule01.gif" width="150"></td>
<td height="11" width="1"><spacer height="11" type="block" width="1"></spacer></td>
</tr>
<tr height="25">
<td colspan="3" content="" csheight="25" height="25" valign="top" width="145" xpos="7"><font color="white" size="2"><b><span class="offerPRICE">$59.95<br>
</span></b></font></td>
<td height="25" width="6"></td>
<td height="25" width="1"><spacer height="25" type="block" width="1"></spacer></td>
</tr>
<tr height="169">
<td colspan="4" content="" csheight="119" height="169" valign="top" width="151" xpos="7">
<p><span class="statusContent3">INCLUDES:</span><br>
<span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life 2*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Counter-Strike:&nbsp;Source<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source*</span></font><font size="2"><span class="statusContent"><br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Day of Defeat?:&nbsp;<br>
                                                        Source*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent"><b>PLUS:</b> Valve&#39s back catalog available on Steam!<br>
</span></font></p>
</td>
<td height="169" width="1"><spacer height="169" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="5" height="41" valign="top" width="152" xpos="6"><a href="steam://purchase/10"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withsteam.gif" width="150"></a></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="5" height="41" valign="top" width="152" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withoutsteam.gif" width="150"></a></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="3"><spacer height="1" type="block" width="3"></spacer></td>
<td height="1" width="137"><spacer height="1" type="block" width="137"></spacer></td>
<td height="1" width="5"><spacer height="1" type="block" width="5"></spacer></td>
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="4"><spacer height="1" type="block" width="4"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td align="left" height="339" rowspan="2" valign="top" width="173" xpos="605">
<table background="themes/2005_v1/images/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
<tbody><tr height="5">
<td height="329" rowspan="7" width="6"></td>
<td height="247" rowspan="5" width="4"></td>
<td colspan="2" height="5" width="147"></td>
<td height="42" rowspan="2" width="5"></td>
<td height="78" rowspan="4" width="1"></td>
<td height="5" width="1"><spacer height="5" type="block" width="1"></spacer></td>
</tr>
<tr height="37">
<td colspan="2" content="" csheight="35" height="37" valign="top" width="147" xpos="10"><font color="white"><b><span class="offerGOLD">HALF-LIFE 2<br>
                                                        GOLD</span></b></font></td>
<td height="37" width="1"><spacer height="37" type="block" width="1"></spacer></td>
</tr>
<tr height="11">
<td align="left" colspan="3" height="11" valign="top" width="152" xpos="10"><img alt="" border="0" height="2" src="themes/2005_v1/images/rule01.gif" width="150"></td>
<td height="11" width="1"><spacer height="11" type="block" width="1"></spacer></td>
</tr>
<tr height="25">
<td content="" csheight="25" height="25" valign="top" width="145" xpos="10"><font color="white" size="2"><b><span class="offerPRICE">$89.95<br>
</span></b></font></td>
<td colspan="2" height="25" width="7"></td>
<td height="25" width="1"><spacer height="25" type="block" width="1"></spacer></td>
</tr>
<tr height="169">
<td colspan="5" content="" csheight="165" height="169" valign="top" width="154" xpos="10">
<p><span class="statusContent3">INCLUDES:</span><br>
<span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life 2*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Counter-Strike:Source<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source*</span></font><font size="2"><span class="statusContent"><br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Day of Defeat:&nbsp;Source*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Valve&#39s back catalog available on Steam.<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent"><b>PLUS:</b>&nbsp;HL2 posters, full strat guide, soundtrack, hat, collector&#39s box, postcard &amp; more</span></font></p>
</td>
</tr>
<tr height="41">
<td align="left" colspan="3" height="41" valign="top" width="151" xpos="6"><a href="steam://purchase/13"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withsteam.gif" width="150"></a></td>
<td colspan="2" height="82" rowspan="2" width="6"></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="3" height="41" valign="top" width="151" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="themes/2005_v1/images/but_withoutsteam.gif" width="150"></a></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="4"><spacer height="1" type="block" width="4"></spacer></td>
<td height="1" width="145"><spacer height="1" type="block" width="145"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="5"><spacer height="1" type="block" width="5"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td height="282" width="1"><spacer height="282" type="block" width="1"></spacer></td>
</tr>
<tr height="57">
<td height="57" width="130"></td>
<td content="" csheight="49" height="57" valign="top" width="122" xpos="130">
<div align="left">
<p><span class="statusGetTheGamesSubhed">ORDER&nbsp;NOW &gt;<br>
</span><span class="statusGetTheGamesText">Click <a href="index.php?area=product_HL2bronsilvergold"><font color="black">here</font></a> for more details. &nbsp;</span></p>
</div>
</td>
<td height="57" width="12"></td>
<td height="57" width="1"><spacer height="57" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="130"><spacer height="1" type="block" width="130"></spacer></td>
<td height="1" width="122"><spacer height="1" type="block" width="122"></spacer></td>
<td height="1" width="12"><spacer height="1" type="block" width="12"></spacer></td>
<td height="1" width="171"><spacer height="1" type="block" width="171"></spacer></td>
<td height="1" width="170"><spacer height="1" type="block" width="170"></spacer></td>
<td height="1" width="173"><spacer height="1" type="block" width="173"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td height="364" width="1"><spacer height="364" type="block" width="1"></spacer></td>
</tr>
<tr height="30">
<td align="left" colspan="6" height="30" valign="top" width="271" xpos="11"><img alt="" border="0" height="25" src="themes/2005_v1/images/Hed_LatestNews.gif" width="263"></td>
<td align="left" colspan="5" height="239" rowspan="2" valign="top" width="171" xpos="282">
<table background="themes/2005_v1/images/CEL_TechSupport.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
<tbody><tr height="30">
<td colspan="3" height="30" width="163"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="197">
<td height="197" width="7"></td>
<td content="" csheight="191" height="197" valign="top" width="149" xpos="7">
<div class="INDEX02Body">
<p class="Body"><font color="white" size="2"><span class="statusContent2"><b>Questions, Answers, Etc?</b><br>
</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">Steam&#39s support pages offer message boards, a list of frequently asked questions, and the Steam Troubleshooter to help identify and resolve any technical support issues you may be experiencing.</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">&gt; <a href="support/entry.php">visit support now</a> </span></font></p>
</div>
</td>
<td height="197" width="7"></td>
<td height="197" width="1"><spacer height="197" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="7"><spacer height="1" type="block" width="7"></spacer></td>
<td height="1" width="149"><spacer height="1" type="block" width="149"></spacer></td>
<td height="1" width="7"><spacer height="1" type="block" width="7"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td align="left" colspan="5" height="239" rowspan="2" valign="top" width="167" xpos="453">
<table background="themes/2005_v1/images/CEL_CyberCafe.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
<tbody><tr height="30">
<td colspan="3" height="30" width="163"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="197">
<td height="197" width="6"></td>
<td content="" csheight="191" height="197" valign="top" width="151" xpos="6">
<div class="INDEX02Body">
<p class="Body"><font color="white" size="2"><span class="statusContent2"><b>Games Your Customers Want?</b><br>
</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">I</span></font><font size="2"><span class="statusContent">f you run a cyber café or gaming venue, Steam makes it easy for you to bring Valve&#39s games to your customers. Over 1000 gaming venues have signed up for Valve?s Cyber Café Program.</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">&gt;&nbsp;<a href="index.php?area=cybercafes">find out more now</a></span></font></p>
</div>
</td>
<td height="197" width="6"></td>
<td height="197" width="1"><spacer height="197" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="151"><spacer height="1" type="block" width="151"></spacer></td>
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td height="239" rowspan="2" width="6"><spacer height="239" type="block" width="6"></spacer></td>
<td align="left" height="239" rowspan="2" valign="top" width="174" xpos="626">
<table background="themes/2005_v1/images/CEL_GetSteamNow.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
<tbody><tr height="29">
<td colspan="3" height="29" width="163"></td>
<td height="29" width="1"><spacer height="29" type="block" width="1"></spacer></td>
</tr>
<tr height="198">
<td height="198" width="6"></td>
<td content="" csheight="191" height="198" valign="top" width="154" xpos="6">
<div class="INDEX02Body">
<p class="Body"><font color="white" size="2"><span class="statusContent2"><b>Sign Up and Play Games Today!</b><br>
</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">S</span></font><span class="statusContent">tart playing Valve&#39s award-winning games within minutes. With Steam, you&#39ll also get access to an instant messenger, automatic updates, and more. If you don&#39t already have Steam.</span></p>
</div>
<p><font size="2"><span class="statusContent">&gt;&nbsp;</span></font><span class="statusContent"><a href="index.php?area=getsteamnow">install it now</a></span></p>
</td>
<td height="198" width="3"></td>
<td height="198" width="1"><spacer height="198" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="154"><spacer height="1" type="block" width="154"></spacer></td>
<td height="1" width="3"><spacer height="1" type="block" width="3"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="209">
<td colspan="2" height="209" width="13"><spacer height="209" type="block" width="13"></spacer></td>
<td colspan="4" content="" csheight="198" height="209" valign="top" width="260" xpos="13">
<div class="statusContent" style="
                    overflow: auto;
                    width: 100%;
                    height: 198px;
                    scrollbar-base-color: #4C5844;
                    scrollbar-arrow-color: #969F8E;
                    padding-right: 5px;
                ">
{news_index_brief(5)}
</div>
</td>
<td height="209" width="9"><spacer height="209" type="block" width="9"></spacer></td>
<td height="209" width="1"><spacer height="209" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="11"><spacer height="1" type="block" width="11"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="160"><spacer height="1" type="block" width="160"></spacer></td>
<td height="1" width="28"><spacer height="1" type="block" width="28"></spacer></td>
<td height="1" width="30"><spacer height="1" type="block" width="30"></spacer></td>
<td height="1" width="42"><spacer height="1" type="block" width="42"></spacer></td>
<td height="1" width="9"><spacer height="1" type="block" width="9"></spacer></td>
<td height="1" width="30"><spacer height="1" type="block" width="30"></spacer></td>
<td height="1" width="32"><spacer height="1" type="block" width="32"></spacer></td>
<td height="1" width="66"><spacer height="1" type="block" width="66"></spacer></td>
<td height="1" width="32"><spacer height="1" type="block" width="32"></spacer></td>
<td height="1" width="11"><spacer height="1" type="block" width="11"></spacer></td>
<td height="1" width="34"><spacer height="1" type="block" width="34"></spacer></td>
<td height="1" width="27"><spacer height="1" type="block" width="27"></spacer></td>
<td height="1" width="40"><spacer height="1" type="block" width="40"></spacer></td>
<td height="1" width="30"><spacer height="1" type="block" width="30"></spacer></td>
<td height="1" width="36"><spacer height="1" type="block" width="36"></spacer></td>
<td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
<td height="1" width="174"><spacer height="1" type="block" width="174"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
</tr>
</tbody></table>
HTML;

$insertArray[] = [
    '2005v1_index',
    'Welcome to Steam',
    $content2005v1,
    '2005_v1',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$content2005v2 = <<<HTML
<table background="themes/2005_v2/images/TopBanner.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="75" showgridx="" showgridy="" width="800">
 <tbody><tr height="22">
 <td colspan="4" height="22" width="799"></td>
 <td height="22" width="1"><spacer height="22" type="block" width="1"></spacer></td>
 </tr>
 <tr height="3">
 <td height="52" rowspan="2" width="251"></td>
 <td content="" csheight="29" height="52" rowspan="2" valign="top" width="405" xpos="251">
 <div align="left">
 <font size="2"><span class="statusContent">Steam delivers Valve?s games to your desktop and connects you to a massive gaming community. Check out the full <a href="index.php?area=features"><b>FEATURE LIST</b></a> now.</span></font></div>
 </td>
 <td colspan="2" height="3" width="143"></td>
 <td height="3" width="1"><spacer height="3" type="block" width="1"></spacer></td>
 </tr>
 <tr height="49">
 <td height="49" width="6"></td>
 <td align="left" height="49" valign="top" width="137" xpos="662"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="24" src="themes/2005_v2/images/but_getsteamnow02.gif" width="124"></a></td>
 <td height="49" width="1"><spacer height="49" type="block" width="1"></spacer></td>
 </tr>
 <tr cntrlrow="" height="1">
 <td height="1" width="251"><spacer height="1" type="block" width="251"></spacer></td>
 <td height="1" width="405"><spacer height="1" type="block" width="405"></spacer></td>
 <td height="1" width="6"><spacer height="1" type="block" width="6"></spacer></td>
 <td height="1" width="137"><spacer height="1" type="block" width="137"></spacer></td>
 <td height="1" width="1"></td>
 </tr>
 </tbody></table>
<table border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="921" showgridx="" showgridy="" width="803">
<tbody><tr height="52">
<td colspan="2" height="52" width="2"></td>
<td align="left" height="52" valign="top" width="173" xpos="2"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_01.gif" width="173"></td>
<td align="left" height="52" valign="top" width="28" xpos="175"><a href="index.php?area=news" onmouseout="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"themes/2005_v2/images/index02/Banner_NAV/Banner_Nav_02.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_02-over.gif");return true" title="News"><img alt="news" border="0" height="41" name="Banner_Nav_02" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_02.gif" width="28"></a></td>
<td align="left" height="52" valign="top" width="30" xpos="203"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_03.gif" width="30"></td>
<td align="left" height="52" valign="top" width="81" xpos="233"><a href="index.php?area=getsteamnow" onmouseout="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"themes/2005_v2/images/index02/Banner_NAV/Banner_Nav_04.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_04-over.gif");return true" title="Get Steam Now"><img alt="getSteamNow" border="0" height="41" name="Banner_Nav_04" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_04.gif" width="81"></a></td>
<td align="left" height="52" valign="top" width="32" xpos="314"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_05.gif" width="32"></td>
<td align="left" height="52" valign="top" width="66" xpos="346"><a href="index.php?area=cybercafes" onmouseout="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_06.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_06-over.gif");return true" title="Cyber Cafes"><img alt="Cyber Cafes" border="0" height="41" name="Banner_Nav_06" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_06.gif" width="66"></a></td>
<td align="left" height="52" valign="top" width="32" xpos="412"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_07.gif" width="32"></td>
<td align="left" height="52" valign="top" width="45" xpos="444"><a href="support/entry.php" onmouseout="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_08.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_08-over.gif");return true" title="Support"><img alt="Support" border="0" height="41" name="Banner_Nav_08" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_08.gif" width="45"></a></td>
<td align="left" height="52" valign="top" width="27" xpos="489"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_09.gif" width="27"></td>
<td align="left" height="52" valign="top" width="40" xpos="516"><a href="index.php?area=forums" onmouseout="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_10.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_10-over.gif");return true" title="Forums"><img alt="Forums" border="0" height="41" name="Banner_Nav_10" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_10.gif" width="40"></a></td>
<td align="left" height="52" valign="top" width="30" xpos="556"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_11.gif" width="30"></td>
<td align="left" height="52" valign="top" width="36" xpos="586"><a href="status/status.html" onmouseout="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_12.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"themes/2005_v2/images/Banner_NAV/Banner_Nav_12-over.gif");return true" title="Status"><img alt="Status" border="0" height="41" name="Banner_Nav_12" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_12.gif" width="36"></a></td>
<td align="left" height="52" valign="top" width="180" xpos="622"><img alt="" border="0" height="41" src="themes/2005_v2/images/Banner_NAV/Banner_Nav_13.gif" width="180"></td>
<td height="52" width="1"><spacer height="52" type="block" width="1"></spacer></td>
</tr>
<tr height="868">
<td height="868" width="1"></td>
<td align="left" colspan="14" height="868" valign="top" width="801" xpos="1">
<table background="themes/2005_v2/images/index04/Call2ActionBkg02.jpg" bgcolor="white" border="0" cellpadding="0" cellspacing="0" height="613" width="801">
<tbody><tr>
<td valign="top">
<table border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="868" showgridx="" showgridy="" width="801">
<tbody><tr height="38">
<td colspan="22" height="38" width="800"></td>
<td height="38" width="1"><spacer height="38" type="block" width="1"></spacer></td>
</tr>
<tr height="2">
<td colspan="14" height="2" width="441"></td>
<td align="left" colspan="7" height="128" rowspan="2" valign="top" width="354" xpos="441"><a href="index.php?area=product_packageoffers" onmouseout="changeImages("LINK_PlayHL2Now_01",""themes/2005_v2/images/index03/LINK_PlayHL2Now_01.gif");return true" onmouseover="changeImages("LINK_PlayHL2Now_01","themes/2005_v2/images/index04/LINK_PlayHL2Now_01-over.gif");return true" title="Get the Games!"><img alt="" border="0" height="33" id="LINK_PlayHL2Now_01" name="LINK_PlayHL2Now_01" src="img\index03\LINK_PlayHL2Now_01.gif" width="328"></a></td>
<td height="128" rowspan="2" width="5"></td>
<td height="2" width="1"><spacer height="2" type="block" width="1"></spacer></td>
</tr>
<tr height="126">
<td height="211" rowspan="3" width="18"></td>
<td class="BODYGreen" colspan="4" content="" csheight="92" height="126" valign="top" width="146" xpos="18">
<div class="BODYGreen">
<p><span>Visit the official sites:<br>
</span><span>· <a href="http://www.half-life.com/" title="Half-Life 2"><font color="black"><b>Half-Life 2<br>
</b></font></a></span><span>· <a href="http://www.counter-strike.net/" title="Counter-Strike"><font color="black"><b>Counter-Strike<br>
</b></font></a></span><span>· <a href="http://www.dayofdefeat.com"><font color="black"><b>Day of Defeat<br>
<br>
</b></font></a></span><span>Buy the games <a href="index.php?area=product_packageoffers" title="Buy the Games!"><font color="black"><b>HERE</b></font></a></span><span class="BODYGreen"><span class="BODYGreen">!</span></span><span class="INDEX02Body2"><span class="BODYGreen"> </span></span></p>
</div>
</td>
<td colspan="9" height="126" width="277"></td>
<td height="126" width="1"><spacer height="126" type="block" width="1"></spacer></td>
</tr>
<tr height="30">
<td class="BODYGreen" colspan="6" content="" csheight="40" height="85" rowspan="2" valign="top" width="150" xpos="18">
<div class="BODYGreen">
<p><span>· <a href=themes/2005_v2/images/index03/SOURCE_Info+Licensing.pdf" title="Source Licensing +&nbsp;Info"><font color="black"><b>Info+Licensing</b></font></a><font color="black"><b> </b>(PDF)</font><a href=themes/2005_v2/images/index03/SOURCE_Info+Licensing.pdf" title="Source Licensing +&nbsp;Info"><font color="black"><br>
</font></a></span><span>· <a href="http://collective.valve-erc.com/" title="Valve-ERC"><font color="black"><b>MOD&nbsp;Resources<br>
</b></font></a></span><span>· <a href="http://www.valve-erc.com/srcsdk/" title="Source SDK Documentation"><font color="black"><b>SDK&nbsp;Documentation</b></font></a></span></p>
</div>
</td>
<td colspan="15" height="30" width="632"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="55">
<td colspan="10" height="55" width="372"></td>
<td align="left" height="55" valign="top" width="56" xpos="540"><img alt="" border="0" height="16" src="themes/2005_v2/images/index04/LINK_ClickHere_01_01.gif" width="56"></td>
<td align="left" height="55" valign="top" width="50" xpos="596"><a href="index.php?area=product_packageoffers" onmouseout="changeImages("LINK_ClickHere_01_02","themes/2005_v2/images/index04/LINK_ClickHere_01_02.gif");return true" onmouseover="changeImages("LINK_ClickHere_01_02","themes/2005_v2/images/index04/LINK_ClickHere_01_02-over.gif");return true" title="Click here now!"><img alt="" border="0" height="16" id="LINK_ClickHere_01_02" name="LINK_ClickHere_01_02" src="themes/2005_v2/images/index04/LINK_ClickHere_01_02.gif" width="48"></a></td>
<td align="left" colspan="2" height="55" valign="top" width="149" xpos="646"><img alt="" border="0" height="16" src="themes/2005_v2/images/index04/LINK_ClickHere_01_03.gif" width="124"></td>
<td height="55" width="5"></td>
<td height="55" width="1"><spacer height="55" type="block" width="1"></spacer></td>
</tr>
<tr height="39">
<td colspan="3" height="225" rowspan="2" width="20"></td>
<td colspan="3" content="" csheight="33" height="39" valign="top" width="146" xpos="20">
<p><font color="white" size="2"><span class="offerGOLD1"><span class="statusContent2"><b class="offerGOLD1">Now You Can Get the Official Gear!</b><br>
</span></span></font></p>
</td>
<td colspan="16" height="39" width="634"></td>
<td height="39" width="1"><spacer height="39" type="block" width="1"></spacer></td>
</tr>
<tr height="186">
<td colspan="5" content="" csheight="64" height="186" valign="top" width="150" xpos="20"><font size="2"><span class="statusContent"><span class="statusContent">Visit the Valve Store and check out the offical shirts, posters, and more</span></span><span class="statusContent2">. </span></font><span class="statusContent"><a href="http://store.valvesoftware.com/" title="The Valve Store"><b><font color="white">Go there now!</font></b></a></span></td>
<td colspan="14" height="186" width="630"></td>
<td height="186" width="1"><spacer height="186" type="block" width="1"></spacer></td>
</tr>
<tr height="24">
<td colspan="16" height="24" width="503"></td>
<td class="BODYGreen" colspan="4" content="" csheight="92" height="110" rowspan="3" valign="top" width="189" xpos="503">
<div class="BODYGreen">
<p><span>Featuring 6 incredible games from Valve. Click <a href="index.php?area=product_packageoffers" title="Buy the Games!"><font color="black"><b>HERE</b></font></a></span><span class="BODYGreen"><span class="BODYGreen"> now!</span></span><span class="INDEX02Body2"><span class="BODYGreen"> </span></span></p>
</div>
</td>
<td colspan="2" height="110" rowspan="3" width="108"></td>
<td height="24" width="1"><spacer height="24" type="block" width="1"></spacer></td>
</tr>
<tr height="47">
<td colspan="9" height="47" width="192"></td>
<td class="BODYGreen" colspan="3" content="" csheight="92" height="156" rowspan="3" valign="top" width="148" xpos="192">
<div class="BODYGreen">
<p><span>Includes Counter-Strike 1.6, the world&#39s #1 online action game, plus single player games. Get your copy <a href="index.php?area=product_packageoffers" title="Buy the Games!"><font color="black"><b>NOW</b></font></a>.</span></p>
</div>
</td>
<td colspan="4" height="86" rowspan="2" width="163"></td>
<td height="47" width="1"><spacer height="47" type="block" width="1"></spacer></td>
</tr>
<tr height="39">
<td height="109" rowspan="2" width="18"></td>
<td class="BODYGreen" colspan="3" content="" csheight="40" height="109" rowspan="2" valign="top" width="144" xpos="18">
<div class="BODYGreen">
<p><span>· <a href="http://www.valvesoftware.com" title="Valve Homepage"><font color="black"><b>About Valve<br>
</b></font></a></span><span>· <a href="http://www.valvesoftware.com/awardslist.htm" title="Awards"><font color="black"><b>Awards<br>
</b></font></a></span><span>· <a href="index.php?area=contact" title="Contact Us"><font color="black"><b>Contact Us</b></font></a></span></p>
</div>
</td>
<td colspan="5" height="109" rowspan="2" width="30"></td>
<td height="39" width="1"><spacer height="39" type="block" width="1"></spacer></td>
</tr>
<tr height="70">
<td colspan="3" height="70" width="153"></td>
<td class="BODYGreen" colspan="6" content="" csheight="21" height="70" valign="top" width="302" xpos="493">
<div align="center" class="BODYGreen">
<p><span>Includes Half-Life,  Day of Defeat, and more!</span></p>
</div>
</td>
<td height="281" rowspan="4" width="5"></td>
<td height="70" width="1"><spacer height="70" type="block" width="1"></spacer></td>
</tr>
<tr height="4">
<td colspan="13" height="4" width="360"></td>
<td align="left" colspan="8" height="211" rowspan="3" valign="top" width="435" xpos="360">
<table border="0" cellpadding="0" cellspacing="0" height="194" width="432">
<tbody><tr>
<td align="left" valign="top">
<div class="statusContent" style="overflow: auto;
                                    width: 430px;
                                    height: 198px;

                                    scrollbar-face-color: #CDCDCD;
                                    scrollbar-shadow-color: #CDCDCD;
                                    scrollbar-highlight-color: #CDCDCD;
                                    scrollbar-3dlight-color: #FFFFFF;
                                    scrollbar-darkshadow-color: #A4A4A4;
                                    scrollbar-track-color: #DFDFDF;
                                    scrollbar-arrow-color: #FFFFFF;

                                    padding-right: 5px;
                                ">
 {news_index_bodygreen(5)}
</div>
</td>
</tr>
</tbody></table>
</td>
<td height="4" width="1"><spacer height="4" type="block" width="1"></spacer></td>
</tr>
<tr height="110">
<td height="110" width="18"></td>
<td colspan="9" content="" csheight="67" height="110" valign="top" width="316" xpos="18">
<p><span class="BODYGreen"><b>Questions, Answers, Etc.</b></span><br>
<span class="BODYGreen">Steam?s <a href="support/" title="Customer Service"><font color="black"><b>Support Pages</b></font></a> offer message boards, a list of frequently asked questions, and the Steam Troubleshooter to help identify and resolve any technical support issues you may be experiencing.</span></p>
</td>
<td colspan="3" height="110" width="26"></td>
<td height="110" width="1"><spacer height="110" type="block" width="1"></spacer></td>
</tr>
<tr height="97">
<td colspan="2" height="97" width="19"></td>
<td colspan="9" content="" csheight="69" height="97" valign="top" width="316" xpos="19">
<p><b><span class="BODYGreen"><span class="BODYGreen">Games Your Customers Want</span></span><br>
</b><span class="INDEX02Body2"><span class="BODYGreen">If you run a cyber café or gaming venue, Steam makes it easy for you to bring Valve?s games to your customers. Over 1000 gaming venues have signed up for Valve?s <a href="index.php?area=cybercafes" title="Cyber Cafe Program"><b><font color="black">Cyber Café&nbsp;Program</font></b></a></span></span><span class="BODYGreen"><span class="BODYGreen">.</span></span><span class="INDEX02Body2"><span class="BODYGreen"> </span></span></p>
</td>
<td colspan="2" height="97" width="25"></td>
<td height="97" width="1"><spacer height="97" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="18"><spacer height="1" type="block" width="18"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="142"><spacer height="1" type="block" width="142"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="2"><spacer height="1" type="block" width="2"></spacer></td>
<td height="1" width="22"><spacer height="1" type="block" width="22"></spacer></td>
<td height="1" width="142"><spacer height="1" type="block" width="142"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="5"><spacer height="1" type="block" width="5"></spacer></td>
<td height="1" width="20"><spacer height="1" type="block" width="20"></spacer></td>
<td height="1" width="81"><spacer height="1" type="block" width="81"></spacer></td>
<td height="1" width="52"><spacer height="1" type="block" width="52"></spacer></td>
<td height="1" width="10"><spacer height="1" type="block" width="10"></spacer></td>
<td height="1" width="37"><spacer height="1" type="block" width="37"></spacer></td>
<td height="1" width="56"><spacer height="1" type="block" width="56"></spacer></td>
<td height="1" width="50"><spacer height="1" type="block" width="50"></spacer></td>
<td height="1" width="46"><spacer height="1" type="block" width="46"></spacer></td>
<td height="1" width="103"><spacer height="1" type="block" width="103"></spacer></td>
<td height="1" width="5"><spacer height="1" type="block" width="5"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
<td height="868" width="1"><spacer height="868" type="block" width="1"></spacer></td>
</tr>
<tr cntrlrow="" height="1">
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="1"><spacer height="1" type="block" width="1"></spacer></td>
<td height="1" width="173"><spacer height="1" type="block" width="173"></spacer></td>
<td height="1" width="28"><spacer height="1" type="block" width="28"></spacer></td>
<td height="1" width="30"><spacer height="1" type="block" width="30"></spacer></td>
<td height="1" width="81"><spacer height="1" type="block" width="81"></spacer></td>
<td height="1" width="32"><spacer height="1" type="block" width="32"></spacer></td>
<td height="1" width="66"><spacer height="1" type="block" width="66"></spacer></td>
<td height="1" width="32"><spacer height="1" type="block" width="32"></spacer></td>
<td height="1" width="45"><spacer height="1" type="block" width="45"></spacer></td>
<td height="1" width="27"><spacer height="1" type="block" width="27"></spacer></td>
<td height="1" width="40"><spacer height="1" type="block" width="40"></spacer></td>
<td height="1" width="30"><spacer height="1" type="block" width="30"></spacer></td>
<td height="1" width="36"><spacer height="1" type="block" width="36"></spacer></td>
<td height="1" width="180"><spacer height="1" type="block" width="180"></spacer></td>
<td height="1" width="1"></td>
</tr>
</tbody></table>
HTML;

$insertArray[] = [
    '2005v2_index',
    'Welcome to Steam',
    $content2005v2,
    '2005_v2',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$sa_html = <<<HTML
<h1>STEAM SUBSCRIBER AGREEMENT</h1>
<br>
<p>Steam is an online service ("Steam") offered by Valve Corporation ("Valve"). </p>
<p>You become a subscriber of Steam ("Subscriber") by installing the Steam client software and completing the Steam registration. Additionally, as a Subscriber you may obtain one or more subscriptions to certain software and content ("Subscriptions") available to Subscribers. This Steam Subscriber Agreement ("Agreement") is a legal document that explains your rights and obligations as a Subscriber. Please read it carefully. </p>
<p>Each Subscription allows you access to certain software and other content under the terms of each such Subscription and this Agreement. Additional terms provided with each such Subscription ("Subscription Terms") may apply to the use of a given Subscription, and are incorporated into this Agreement. Further, additional terms (for example, fees and billing procedures) may be posted on <a href="https://web.archive.org/web/20040212023250/http://www.steampowered.com/">http://www.steampowered.com</a> or within the Steam service ("Rules of Use"), and are incorporated into this Agreement. As a Subscriber, you agree to all of the terms and conditions of the Valve Privacy Policy, which are also incorporated into this Agreement. A copy of the Valve Privacy Policy can be found at <a href="https://web.archive.org/web/20040212023250/http://www.valvesoftware.com/privacy.htm">http://www.valvesoftware.com/privacy.htm</a>. A copy of the online conduct rules can be found at <a href="https://web.archive.org/web/20040212023250/http://www.steampowered.com/steam_online_conduct.htm">http://www.steampowered.com/steam_online_conduct.htm</a>.</p>
<p>When you complete Steam's registration process, you create a Steam account (&quot;Account&quot;). Your Account also includes the billing information you provide to us for the purchase of Subscriptions. Accounts are only available to individuals over the age of 12. If you are under the age of 13, a parent or guardian must obtain an Account on your behalf, and such parent or guardian agrees to take full responsibility for all liabilities and obligations under this Agreement. You are solely responsible for all activity on your Account and for the security of your computer system. You agree not to reveal your password to other users. If you permit others to use your Account, you are responsible for their illegal or improper use by. Your Account and Subscription(s) are subject to the Agreement and any Subscription Terms. You may not sell or charge others for the right to use your Account, or otherwise share or transfer your Account. </p>
<br>
<h2>SOFTWARE LICENSE</h2>
<p>Steam and your Subscription(s) require the installation of the Steam client and the automatic download of software, other content and updates thereto onto your computer (&quot;Steam Software&quot;). You may not use Steam Software for any purpose other than the permitted access to Steam and your Subscriptions. You understand that Steam may update, create new versions or otherwise enhance the Steam Software and accordingly, the system requirements to use the Steam Software may change over time. You understand that neither this Agreement nor the terms associated with a particular Subscription entitles you to future updates, new versions or other enhancements of the Steam Software associated with a particular Subscription although Valve may choose to provide certain future updates, new versions or other enhancements of the Steam Software in its sole discretion. </p>
<p>Valve hereby grants, and you accept, a limited, non-exclusive license and right to use the Steam Software for your personal use in accordance with this Agreement and the Subscription Terms. The Steam Software is licensed, not sold. Your license confers no title or ownership in the Steam Software. This license is effective until termination in accordance with this Agreement. </p>
<p>The Steam Software is the copyrighted work of Valve Corporation and/or its licensors. All rights reserved, except as expressly stated herein. The Steam Software is protected by the copyright laws of the United States, international copyright treaties and conventions and other laws. The Steam Software contains certain licensed materials and Valve's licensors may protect their rights in the event of any violation of this Agreement. </p>
<p>You may not, in whole or in part, copy, photocopy, reproduce, translate, reverse engineer, derive source code, modify, disassemble, decompile, create derivative works based on, or remove any proprietary notices or labels from the Steam Software without the prior consent, in writing, of Valve. <strong></strong></p>
<p>You are entitled to use the Steam Software for your own use, but you are not entitled to: (i) sell, grant a security interest in or transfer reproductions of the Steam Software to other parties in any way, nor to rent, lease or license the Steam Software to others without the prior written consent of Valve; (ii) host or provide matchmaking services for the Steam Software or emulate or redirect the communication protocols used by Valve in any network feature of the Steam Software, through protocol emulation, tunneling, modifying or adding components to the Steam Software, use of a utility program or any other techniques now known or hereafter developed, for any purpose including, but not limited to network play over the Internet, network play utilizing commercial or non-commercial gaming networks or as part of content aggregation networks, without the prior written consent of Valve; or (iii) exploit the Steam Software or any of its parts for any commercial purpose including, but not limited to, use at a cyber caf&eacute;, computer gaming center or any other location-based site. <strong></strong></p>
<br>
<h2>BILLING, PAYMENT AND OTHER SUBSCRIPTIONS </h2>
<p>You may become a Subscriber of Steam without paying Valve to access any services, software and other content Valve offers for free. However, Valve will charge Subscription fees to access certain services, software and content areas of Steam. You must be a Subscriber of Steam and pay any required Subscription fees to use such services, software and other content. If you must pay a Subscription fee to access part of Steam this information will be posted in the Rules of Use. All fees are stated in U.S. dollars unless otherwise specified. You may subscribe by providing us with a valid payment and billing information. Current Subscription fees and other billing information is available at http://www.steampowered.com </p>
<p>A. Payment by Credit Card</p>
<p>You may use a credit card to pay for your Subscription(s). When you provide credit card information to Valve, you represent to Valve that you are the authorized user of the credit card that is used to pay Subscription or other fees and authorize Valve to charge your credit card for any Subscription or other fees incurred by you. For recurring monthly Subscriptions, each month that you use such Subscription(s), you agree and reaffirm that Valve is authorized to charge your credit card for the Subscription fee. You agree to notify Valve promptly of any changes to your credit card account number, its expiration date and/or your billing address, and you agree to notify Valve promptly if your credit card expires or is canceled for any reason. </p>
<p>B. Charges to Your Credit Card</p>
<p><strong>YOUR SUBSCRIPTION FEES ARE PAYABLE IN ADVANCE AND ARE NOT REFUNDABLE IN WHOLE OR IN PART </strong>. Valve reserves the right to change our fees or billing methods at any time and Valve will provide notice of any such change at least thirty (30) days advance. All changes will be posted as amendments to this Agreement or in the Rules of Use and you are responsible for reviewing the billing section of Steam to obtain timely notice of such changes. Your non-cancellation of your Account thirty (30) days after posting of the changes on Steam means that you accept such changes. If any change is unacceptable to you, you may cancel your Account or a particular Subscription at any time as described below, but Valve will not refund any fees that may have accrued to your Account before cancellation of your Account or Subscription, and Valve will not prorate fees for any cancellation. If your use of Steam is subject to use or sales tax, then Valve may also charge you for any such taxes, in addition to the Subscription or other fees published in the Rules of Use.. </p>
<p>As the Account holder, you are responsible for all charges incurred, including applicable taxes, and all purchases made by you or anyone that uses your Account, including your family or friends. Information on how to cancel your Account or a particular Subscription can be found at http://www.steampowered.com/. Valve reserves the right to collect fees, surcharges or costs incurred before you cancel your Account or a particular Subscription. In the event that your Account or a particular subscription is terminated or canceled, no refund, including any Subscription fees, will be granted. Any delinquent or unpaid Accounts must be settled before Valve will allow you to register again. </p>
<p>C. Retail Purchase</p>
<p>In some cases, Valve may offer a Subscription to purchasers of retail packaged product versions of Valve products. In such event, your "CD-Key" or "Product Key" accompanying such product will be used to validate your Subscription. </p>
<p>D. Free Subscriptions</p>
<p>In some cases, Valve may offer a free Subscription to certain services, software and content. As with all Subscriptions, You are always responsible for any Internet service provider, telephone, and other connection fees that you may incur when using Steam, even when Valve offers a free Subscription. <br>
    <br>
<p>E. Third Party Sites</p>
Steam may provide links to other third party sites. Some of these sites may charge separate fees, which are not included in any Subscription or other fees that you may pay to Valve. Steam may also provide access to third-party vendors, who provide content, goods and/or services on Steam or the Internet. Any separate charges or obligations you incur in your dealings with these third parties are your responsibility.</p>
<br>
<h2>ONLINE CONDUCT, CHEATING AND ILLEGAL BEHAVIOR </h2>
<p>You agree that you will be personally responsible for the use of your Account and for all of the communication and activity on Steam that results from use of your Account. Your online conduct and interaction with other subscribers should be guided by common sense and basic etiquette. Specific requirements may also be found in the Rules of Use, the Subscription Terms, or in terms of use required by third parties who host particular games or other services. </p>
<p>Steam and the Steam Software may include functionality designed to identify software or hardware processes or functionality that may give a player an unfair competitive advantage when playing multiplayer versions of any Steam Software, other Valve products, or modifications thereof (" Cheats "). You agree that you will not directly or indirectly disable, circumvent, or otherwise interfere with the operation of software designed to prevent or report the use of Cheats. You acknowledge and agree that either Valve or any online multiplayer host may refuse to allow you to participate in certain online multiplayer games if you use Cheats in connection with Steam or the Steam Software. Further, you acknowledge and agree that an online multiplayer host may report your use of Cheats to Valve, and Valve may communicate your history of use of Cheats to other online multiplayer hosts for Valve products. </p>
<p>Valve may terminate your Account or a particular Subscription for any conduct or activity that Valve believes is illegal, Cheating or otherwise negatively affects the enjoyment of Steam by other Subscribers. You acknowledge that Valve is not required to provide you notice before terminating your Subscriptions(s) and/or Account, but it may choose to do so. <strong></strong></p>
<br>
<h2>THIRD PARTY CONTENT </h2>
<p>&quot;Third Party Content&quot; means software and other content provided by third parties, other then Valve, that is designed to work in conjunction with the Steam Software (e.g. mods of Valve game products). Valve does not screen Third Party Content available on Steam or through other sources. You bear the entire risk for any use of Third Party Content including any Third Party Content made available via Steam. Valve does not assume any responsibility or liability for Third Party Content. </p>
<br>
<h2>USER GENERATED CONTENT </h2>
<p>"User Generated Content" means any content made available to other users through your use of multi-user features of Steam and may include, but is not limited to, chat, forum posts, screen names, game selections and player performances. You expressly grant Valve the complete and irrevocable right to quote, re-post, use, reproduce, modify, distribute, transmit, broadcast, and otherwise communicate, and publicly display and perform the User Generated Content in any form, anywhere, with or without attribution to you, and without any notice or compensation to you of any kind. <strong></strong></p>
<br>
<h2>DEDICATED SERVER </h2>
<p>Your Subscription(s) may contain access to the Valve Dedicated Server. You may use the Valve Dedicated Server on an unlimited number of computers for the purpose of hosting online multiplayer games of Valve products. If you wish to operate the Valve Dedicated Server, you will be solely responsible for procuring any Internet access, bandwidth, or hardware for such activities and will bear all costs associated therewith. <strong></strong></p>
<br>
<h2>WARRANTIES AND LIMITATION OF LIABILITY </h2>
<p>The entire risk arising out of use or performance of Steam and the Steam Software remains with you, the user. Valve expressly disclaim any warranty for Steam and the Steam Software. STEAM AND The STEAM SOFTWARE IS provided ON AN &quot;as is&quot; AND "AS AVAILABLE" BASIS without warranty of any kind, either express or implied, including, without limitation, the implied warranties of merchantability, fitness for a particular purpose, or noninfringement. ANY WARRANTY AGAINST INFRINGEMENT THAT MAY BE PROVIDED IN SECTION 2-312(3) OF THE UNIFORM COMMERCIAL CODE AND/OR IN ANY OTHER COMPARABLE STATE STATUTE IS EXPRESSLY DISCLAIMED. </p>
<p>VALVE DOES NOT GUARANTEE CONTINOUS, ERROR-FREE, VIRUS-FREE OR SECURE OPERATION AND ACCESS TO STEAM, THE STEAM SOFTWARE, YOUR ACCOUNT AND YOUR SUBSCRIPTIONS(S). YOU ASSUME THE ENTIRE RISK WITH RESPECT TO THE PERFORMANCE AND RESULTS OF THE STEAM SOFTWARE IN CONNECTION WITH YOUR HARDWARE. </p>
<p>NEITHER VALVE, ITS LICENSORS, AND THEIR AFFILIATES SHALL BE LIABLE IN ANY WAY FOR LOSS OR DAMAGE OF ANY KIND RESULTING FROM THE USE OR INABILITY TO USE STEAM, YOUR ACCOUNT, YOUR SUBSCRIPTIONS AND THE STEAM SOFTWARE INCLUDING, BUT NOT LIMITED TO, LOSS OF GOODWILL, WORK STOPPAGE, COMPUTER FAILURE OR MALFUNCTION, OR ANY AND ALL OTHER COMMERCIAL DAMAGES OR LOSSES . yOU ACKNOWLEDGE AND AGREE THAT YOUR SOLE AND EXCLUSIVE REMEDY FOR ANY DISPUTE WITH vALVE IS TO DISCONTINUE USE OF sTEAM AND CANCEL YOUR ACCOUNT. BECAUSE SOME STATES OR JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR THE LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, IN SUCH STATES OR JURISDICTIONS, VALVE, ITS LICENSORS, AND THEIR AFFILIATES LIABILITY SHALL BE LIMITED TO THE FULL EXTENT PERMITTED BY LAW. </p>
<br>
<h2>INDEMNIFICATION </h2>
<p>You agree to defend, indemnify and hold harmless Valve, its licensors and their affiliates from all liabilities, claims and expenses, including attorneys' fees, that arise from or in connection with breach of this Agreement, use of Steam or any Subscription, , or any User Generated Content by you or any person(s) using your Account. Valve reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you. In that event, you shall have no further obligation to provide indemnification to Valve in that matter. This Section regarding Indemnification shall survive termination of this Agreement. <strong></strong></p>
<br>
<h2>AMENDMENTS TO THIS AGREEMENT </h2>
<p>Valve may amend this Agreement at any time in its sole discretion. As a Subscriber, you agree that Valve may amend the terms of this Agreement. If Valve amends the Agreement, such amendment shall be effective thirty (30) days after posting the new amended Agreement on Steam. You agree to review the Agreement periodically to become aware of such amendments. You can view the Agreement at any time at http://www.steampowered.com/. Your failure to cancel your Account thirty (30) days after an amended Agreement is posted on Steam will mean that you accept all such amendments. If you don't agree to the amendments, or to any of the terms in this Agreement, your only remedy is to cancel your Account or a particular Subscription. <strong></strong></p>
<br>
<h2>TERMINATION </h2>
<p>Either you or Valve has the right to terminate or cancel your Account or a particular Subscription at any time. You understand and agree that the cancellation of your Account or a particular Subscription is your sole right and remedy with respect to any dispute with Valve. </p>
<p>Information on how to cancel your Account or a particular Subscription can be found at http://www.steampowered.com/. Valve reserves the right to collect fees, surcharges or costs incurred prior to the cancellation of your Account or a particular Subscription. In addition, you are responsible for any charges incurred to third-party vendors or content providers before your cancellation. In the event that your Account or a particular subscription is terminated or canceled by you, no refund, including any Subscription fees, will be granted. In the event that your Account or a particular Subscription is terminated or cancelled by Valve for a violation of this Agreement or improper or illegal activity, no refund, including any Subscription fees, will be granted. In the event that your Account or a particular Subscription is terminated or cancelled by Valve for convenience, Valve may, but is not obligated to, provide a prorated refund of any prepaid Subscription fees paid to Valve. <strong></strong></p>
<br>
<h2>MISCELLANEOUS </h2>
<p>You agree that this Agreement shall be deemed to have been made and executed in the State of Washington, and any dispute arising hereunder shall be resolved in accordance with the law of Washington. You agree that any claim asserted in any legal proceeding by you against Valve shall be commenced and maintained in any state or federal court located in King County, Washington, having subject matter jurisdiction with respect to the dispute between the parties. In the event that any provision of this Agreement shall be held by a court or other tribunal of competent jurisdiction to be unenforceable, such provision will be enforced to the maximum extent permissible and the remaining portions of this Agreement shall remain in full force and effect. This Agreement constitutes and contains the entire agreement between the parties with respect to the subject matter hereof and supersedes any prior oral or written agreements. You agree that this Agreement is not intended to confer and does not confer any rights or remedies upon any person other than the parties to this Agreement. </p>
<p align="left">You agree to comply with all applicable import/export laws and regulations of the United States and its governmental and regulatory agencies (including, without limitation, the Bureau of Export Administration and the U.S. Department of Commerce). You agree not to export the Steam Software or allow use of your Account by individuals of any terrorist supporting countries to which encryption exports are restricted by the Bureau of Export Administration, currently, Cuba, Iran, Iraq, Libya, North Korea, Sudan or Syria. You represent and warrant that you are not located in, under the control of, or a national or resident of any such prohibited country. </p>
<p>I hereby agree to be bound by the Agreement. I also acknowledge and agree that this Agreement (including the Subscription Terms, Rules of Use, and Privacy Policy) is the complete and exclusive statement of the agreement between Valve and me, and that the Agreement supersedes any prior or contemporaneous agreement, or other communications, whether oral or written, between Valve and myself. </p>

</div>
HTML;

$insertArray[] = [
    'subscriber_agreement',
    'Steam Subscriber Agreement',
    $sa_html,
    null,
    null,
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
    'published',
];

$stmtcp = $pdo->prepare(
    'INSERT INTO custom_pages
    (slug, title, content, theme, template, created, updated, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
);

foreach ($insertArray as $row) {
    $stmtcp->execute($row);
}
?>