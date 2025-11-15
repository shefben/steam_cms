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
    null,                      //page name
    'Steam Powered',           // title
    $content2002v1,              // content
    '2002_v1',                 // theme
    'index.twig',               // template
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2002v2 = <<<HTML
<!-- OVERVIEW SECTION -->
<div>
    <div style="margin-left: 2px">
        <p style="margin-bottom: 2px"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="#c4cabe"><b>OVER</b></font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="white"><b>VIEW</b></font></p>
        <img src="./Images/Graphic_box.jpg" width="33" border="0">
    </div>
    <div style="">
        <p style="margin-bottom: 1px; margin-top: 13px"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2" color="white">Steam is a broadband business platform for direct software delivery and content management. At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br><br><br>With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.<br><br><br>Steam consumers enjoy the benefit of starting their favorite applications within minutes of confirming their purchase. They can access their applications from any PC. They are no longer challenged to find the latest updates for these applications. And they no longer need to wonder if their device drivers are compatible with the latest software.<br><br><br>The Steam SDK also includes an integrated set of communications tools and Valve's Graphic User Interface (V-GUI) that provide built-in support for a variety of services such as instant messaging, configuration, and server browsing.<br><br></font></p><div align="center"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2" color="white"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white" size="4"><b><a href="index.php?area=getsteamnow">Try Steam Now!</a></b></font></font></div><p></p>
    </div>
</div>

<!-- IN THE NEWS SECTION -->
<div style="">
    <div style=" margin-left: 2px">
        <p style="margin-bottom:1px; margin-top: 31px;"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="#c4cabe"><b>IN&nbsp;THE&nbsp;</b></font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="white"><b>NEWS</b></font></p>
        
    <img src="./Images/Graphic_box.jpg" width="33" height="5" border="0"></div>
    <div style="margin-top: 12px;">
        <font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white">Steam unveiled<b> </b>at the <b>Game Developer's Conference</b>. View the <a href="Press_Release.html">Steam Press Release.<br></a>View GDC Steam Keynote Speech slides: <a href="./SteamKeynote_files/frame.htm" target="_blank">HTML</a><b><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="black"> | </font></b><a href="./SteamKeynote_files/SteamPowerpoint.ppt" target="_blank">Powerpoint Document</a><br></font>
        
    </div>
</div>

<!-- MORE INFORMATION SECTION -->
<div style="">
    <div style=" margin-left: 2px">
        <p style="margin-top: 31px; margin-bottom: 1px;"><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="#c4cabe"><b>MORE&nbsp;</b></font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="4" color="white"><b>INFORMATION</b></font></p>
        <img src="./Images/Graphic_box.jpg" width="33" height="5" border="0">
</div>
    <div style="">
        <p style="margin-top: 12px"><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white">For technical inquiries, please email:</font><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular"> <a href="mailto:tech@steampowered.com"><b>tech@steampowered.com</b></a></font></p>
        <p><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white">For press inquiries, please mail:</font><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular"> <a href="mailto:press@steampowered.com"><b>press@steampowered.com</b></a></font></p>
        <p><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white">For business inquires, please email: </font><font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular"><a href="mailto:biz@steampowered.com"><b>biz@steampowered.com</b></a></font></p>
    </div>
</div>
HTML;

$insertArray[] = [
    '2002v2_index',            // slug
    null,
    'Steam Powered',           // title
    $content2002v2,              // content
    '2002_v2',                 // theme
    'index.twig',               // template
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
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
<td><img border="0" height="5" src="./images/Graphic_box.jpg" width="33"></td>
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
<p><font color="#969f8e" size="2">The Steam SDK also includes an integrated set of communications tools and Valve�s Graphic User Interface (V-GUI) that provide built-in support for a variety of services such as instant messaging, configuration, and server browsing.<br>
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
<td background="Box_01.gif" height="211" width="382">
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
<td><img border="0" height="5" src="./images/Graphic_box.jpg" width="33"></td>
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
<td background="Box_01.gif" height="211" width="382">
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
<td><img border="0" height="5" src="./images/Graphic_box.jpg" width="33"></td>
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
    null,
    'Steam Powered',
    $content2003v1,
    '2003_v1',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2003v2 = <<<HTML
<img height="78" id="steam" src="steam_logo_alpha.gif" width="244"><br><br>
<h2 id="page1">BECOME <em>PART OF THE STEAM COMMUNITY</em></h2><img alt="" height="6" src="./images/Graphic_box.jpg" width="24"><br>
<ul>
<li>Play the latest Valve games (like Counter-Strike 1.6 beta!)</li>
<li>Get automatic updates (no more patching!)</li>
<li>Chat with friends, even while you play</li>
<li>Find the best servers &amp; find your friends&#39 games</li>
<li>Receive Steam-Only special offers</li>
</ul>
<a href="index.php?area=getsteamnow"><img alt="get steam now" height="24" src="but_getsteamnow.gif" width="124"></a><br><br>
<a href="index.php?area=features"><img alt="screenshots" height="214" id="screenshots" src="triple_screenshot.gif" width="535"></a><br>
<br><div class="boxTop">Latest News</div><br clear="all">
<div class="box">
{{ news_index_brief(3) }}
</div>
<h2 id="afterBox">WHAT <em>IS STEAM?</em></h2><img alt="" height="6" src="./images/Graphic_box.jpg" width="24"><br>
Steam is Valve&#39s new way of getting games into your hands ASAP. Games like <i>Half-Life</i>, <i>Counter-Strike</i>, and <i>Counter-Strike Condition Zero</i> are all being made available through Steam.<br>
<nobr>
<a href="http://half-life.com" onmouseout="out(5)" onmouseover="over(5)"><img align="absmiddle" alt="Half-Life" height="36" name="logo_hl" src="logo_hl.gif" width="36" style="vertical-align: baseline;"></a> &nbsp;
<a href="http://www.counter-strike.net" onmouseout="out(6)" onmouseover="over(6)"><img alt="Counter-Strike" height="36" name="logo_cs" src="logo_cs.gif" width="36"></a> &nbsp;
<a href="http://www.cs-conditionzero.com/" onmouseout="out(7)" onmouseover="over(7)"><img alt="Counter-Strike: Condition Zero" height="36" name="logo_cz" src="logo_cz.gif" width="45"></a> &nbsp;
<a href="http://www.teamfortressclassic.com" onmouseout="out(8)" onmouseover="over(8)"><img alt="Team Fortress Classic" height="36" name="logo_tfc" src="logo_tfc.gif" width="36"></a> &nbsp;</nobr>
<nobr>
<a href="http://hlopposingforce.sierra.com/" onmouseout="out(9)" onmouseover="over(9)"><img alt="Half-Life: Opposing Force" height="36" name="logo_opfor" src="logo_opfor.gif" width="36"></a> &nbsp;
<a href="http://www.dayofdefeatmod.com/" onmouseout="out(10)" onmouseover="over(10)"><img alt="Day of Defeat" height="36" name="logo_dod" src="logo_dod.gif" width="36"></a> &nbsp;&nbsp;
<a href="http://www.planethalflife.com/features/motw/ricochet.shtm" onmouseout="out(11)" onmouseover="over(11)"><img alt="Ricochet" height="36" name="logo_r" src="logo_r.gif" width="36"></a> &nbsp;&nbsp;
<a href="index.php" onmouseout="out(12)" onmouseover="over(12)"><img alt="Deathmatch Classic" height="36" name="logo_dmc" src="logo_dmc.gif" width="36"></a></nobr>
<br>
Steam games are automatically kept up-to-date with the latest content and revisions. Steam also includes an instant-message client which even works while you&#39re in-game.<br><br>
At its core, Steam is a distributed file system and shared set of technology components that can be implemented into any software application.<br><br>
With Steam, developers are given integrated tools for direct-content publishing, flexible billing, ensured-version control, anti-cheating, anti-piracy, and more.
Check out the full <a href="index.php?area=features">feature list</a>, and <a href="index.php?area=getsteamnow">install Steam</a> today!
HTML;

$insertArray[] = [
    '2003v2_index',
    null,
    'Welcome to Steam',
    $content2003v2,
    '2003_v2',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2004 = <<<HTML
<h2 >BECOME <em>PART OF THE STEAM COMMUNITY</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<ul>
	<li>Play the latest Valve games (like Counter-Strike: Condition Zero!)</li>
	<li>Get automatic updates (no more patching!)</li>
	<li>Chat with friends, even while you play</li>
	<li>Find the best servers &amp; find your friends' games</li>
	<li>Receive Steam-Only special offers</li>
</ul>
<!-- <h2 id="page1">PRELOAD <em>HALF-LIFE® 2 NOW!</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<ul>
	Pre-load now. Purchase when ready. Play the moment<br>
	Half-Life® 2 is made available! <br>
	Half-Life 2 is pre-loading around the clock <br>
	and around the globe. If you already have Steam, <br>
	<u>
	<a href="steam://preload/220">CLICK&nbsp;HERE</a></u> to pre-load now. <br>
	<br>
	If you don't already have Steam, <a href="index.php?area=getsteamnow">INSTALL  IT TODAY</a>!<br>
	<br>
</ul>-->
<a href="index.php?area=getsteamnow"><img src="but_getsteamnow.gif" height="24" width="124" alt="GET STEAM NOW"></a><br><br>
<br>
<a href="index.php?area=get_cz"><img width="483" height="133" src="cz_launch.gif" alt="Condition Zero now available for pre-order on Steam!"></a><br>

<br>
<br clear="all">
<h2 id="afterBox">HARDWARE <em>SURVEY</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
Check out the <a href="./status/survey.html">results of the "Half-Life 2 Hardware Survey"</a>. More than half a million respondents have taken part so far.<br>
<br>
<h2>WHAT <em>IS STEAM?</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
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
    null,
    'Welcome to Steam',
    $content2004,
    '2004',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2005v1 = <<<HTML
<table background="index02/TopBanner.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="75" showgridx="" showgridy="" width="800">
<tbody><tr height="22">
<td colspan="4" height="22" width="799"></td>
<td height="22" width="1"><spacer height="22" type="block" width="1"></spacer></td>
</tr>
<tr height="3">
<td height="52" rowspan="2" width="262"></td>
<td content="" csheight="29" height="52" rowspan="2" valign="top" width="391" xpos="262">
<div align="left">
<font size="2"><span class="statusContent">Steam delivers Valve s games to your desktop and connects you to a massive gaming community. Check out the full <a href="index.php?area=features">feature list</a> now.</span></font></div>
</td>
<td colspan="2" height="3" width="146"></td>
<td height="3" width="1"><spacer height="3" type="block" width="1"></spacer></td>
</tr>
<tr height="49">
<td height="49" width="9"></td>
<td align="left" height="49" valign="top" width="137" xpos="662"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="24" src="index02\but_getsteamnow02.gif" width="124"></a></td>
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
<td align="left" colspan="3" height="53" valign="top" width="173" xpos="0"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_01.gif" width="173"></td>
<!-- Begin Navigation Bar Area --> <td align="left" height="53" valign="top" width="28" xpos="173"><a href="index.php?area=news" onmouseout="changeImages( /*CMP*/'Banner_Nav_02',/*URL*/'index02/Banner_NAV/Banner_Nav_02.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_02',/*URL*/'index02/Banner_NAV/Banner_Nav_02-over.gif');return true"><img alt="news" border="0" height="41" name="Banner_Nav_02" src="index02/Banner_NAV/Banner_Nav_02.gif" width="28"></a></td>
<td align="left" height="53" valign="top" width="30" xpos="201"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_03.gif" width="30"></td>
<td align="left" colspan="3" height="53" valign="top" width="81" xpos="231"><a href="index.php?area=getsteamnow" onmouseout="changeImages( /*CMP*/'Banner_Nav_04',/*URL*/'index02/Banner_NAV/Banner_Nav_04.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_04',/*URL*/'index02/Banner_NAV/Banner_Nav_04-over.gif');return true"><img alt="getSteamNow" border="0" height="41" name="Banner_Nav_04" src="index02/Banner_NAV/Banner_Nav_04.gif" width="81"></a></td>
<td align="left" height="53" valign="top" width="32" xpos="312"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_05.gif" width="32"></td>
<td align="left" height="53" valign="top" width="66" xpos="344"><a href="index.php?area=cybercafes" onmouseout="changeImages( /*CMP*/'Banner_Nav_06',/*URL*/'index02/Banner_NAV/Banner_Nav_06.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_06',/*URL*/'index02/Banner_NAV/Banner_Nav_06-over.gif');return true"><img alt="Cyber Cafes" border="0" height="41" name="Banner_Nav_06" src="index02/Banner_NAV/Banner_Nav_06.gif" width="66"></a></td>
<td align="left" height="53" valign="top" width="32" xpos="410"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_07.gif" width="32"></td>
<td align="left" colspan="2" height="53" valign="top" width="45" xpos="442"><a href="http://steampowered.custhelp.com/cgi-bin/steampowered.cfg/php/enduser/entry.php" onmouseout="changeImages( /*CMP*/'Banner_Nav_08',/*URL*/'index02/Banner_NAV/Banner_Nav_08.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_08',/*URL*/'index02/Banner_NAV/Banner_Nav_08-over.gif');return true"><img alt="Support" border="0" height="41" name="Banner_Nav_08" src="index02/Banner_NAV/Banner_Nav_08.gif" width="45"></a></td>
<td align="left" height="53" valign="top" width="27" xpos="487"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_09.gif" width="27"></td>
<td align="left" height="53" valign="top" width="40" xpos="514"><a href="index.php?area=forums" onmouseout="changeImages( /*CMP*/'Banner_Nav_10',/*URL*/'index02/Banner_NAV/Banner_Nav_10.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_10',/*URL*/'index02/Banner_NAV/Banner_Nav_10-over.gif');return true"><img alt="Forums" border="0" height="41" name="Banner_Nav_10" src="index02\Banner_NAV\Banner_Nav_10.gif" width="40"></a></td>
<td align="left" height="53" valign="top" width="30" xpos="554"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_11.gif" width="30"></td>
<td align="left" height="53" valign="top" width="36" xpos="584"><a href="status/status.html" onmouseout="changeImages( /*CMP*/'Banner_Nav_12',/*URL*/'index02/Banner_NAV/Banner_Nav_12.gif');return true" onmouseover="changeImages( /*CMP*/'Banner_Nav_12',/*URL*/'index02/Banner_NAV/Banner_Nav_12-over.gif');return true"><img alt="Status" border="0" height="41" name="Banner_Nav_12" src="index02/Banner_NAV/Banner_Nav_12.gif" width="36"></a></td> <!-- End Navigation Bar Area --> 
<td align="left" colspan="2" height="53" valign="top" width="180" xpos="620"><img alt="" border="0" height="41" src="index02\Banner_NAV\Banner_Nav_13.gif" width="180"></td>
<td height="53" width="1"><spacer height="53" type="block" width="1"></spacer></td>
</tr>
<tr height="364">
<td height="394" rowspan="2" width="11"><spacer height="394" type="block" width="11"></spacer></td>
<td align="left" colspan="18" height="364" valign="top" width="789" xpos="11">
<table background="index02/gamesbar.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="349" showgridx="" showgridy="" width="779">
<tbody><tr height="9">
<td colspan="6" height="9" width="778"></td>
<td height="9" width="1"><spacer height="9" type="block" width="1"></spacer></td>
</tr>
<tr height="282">
<td colspan="3" height="282" width="264"></td>
<td align="left" height="339" rowspan="2" valign="top" width="171" xpos="264">
<table background="index02/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
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
<td align="left" colspan="3" height="11" valign="top" width="155" xpos="7"><img alt="" border="0" height="2" src="index02\rule01.gif" width="150"></td>
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
<span class="statusContent">? </span><font size="2"><span class="statusContent">Half-Life  2*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Counter-Strike :<br>
																	Source </span></font></p>
</td>
<td height="169" width="1"><spacer height="169" type="block" width="1"></spacer></td>
</tr>
<tr height="40">
<td align="left" colspan="4" height="40" valign="top" width="156" xpos="6"><a href="steam://purchase/9"><img alt="" border="0" height="35" src="index02\but_withsteam.gif" width="150"></a></td>
<td height="40" width="1"><spacer height="40" type="block" width="1"></spacer></td>
</tr>
<tr height="42">
<td align="left" colspan="4" height="42" valign="top" width="156" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="index02\but_withoutsteam.gif" width="150"></a></td>
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
<table background="index02/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
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
<td align="left" colspan="4" height="11" valign="top" width="151" xpos="7"><img alt="" border="0" height="2" src="index02\rule01.gif" width="150"></td>
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
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Day of Defeat :&nbsp;<br>
																	Source*<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent"><b>PLUS:</b> Valve's back catalog available on Steam!<br>
</span></font></p>
</td>
<td height="169" width="1"><spacer height="169" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="5" height="41" valign="top" width="152" xpos="6"><a href="steam://purchase/10"><img alt="" border="0" height="35" src="index02\but_withsteam.gif" width="150"></a></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="5" height="41" valign="top" width="152" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="index02\but_withoutsteam.gif" width="150"></a></td>
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
<table background="index02/GameCel_Empty.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="330" showgridx="" showgridy="" width="163">
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
<td align="left" colspan="3" height="11" valign="top" width="152" xpos="10"><img alt="" border="0" height="2" src="index02\rule01.gif" width="150"></td>
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
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent">Valve's back catalog available on Steam.<br>
</span></font><span class="statusContent">? </span><font size="2"><span class="statusContent"><b>PLUS:</b>&nbsp;HL2 posters, full strat guide, soundtrack, hat, collector's box, postcard &amp; more</span></font></p>
</td>
</tr>
<tr height="41">
<td align="left" colspan="3" height="41" valign="top" width="151" xpos="6"><a href="steam://purchase/13"><img alt="" border="0" height="35" src="index02\but_withsteam.gif" width="150"></a></td>
<td colspan="2" height="82" rowspan="2" width="6"></td>
<td height="41" width="1"><spacer height="41" type="block" width="1"></spacer></td>
</tr>
<tr height="41">
<td align="left" colspan="3" height="41" valign="top" width="151" xpos="6"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="35" src="index02\but_withoutsteam.gif" width="150"></a></td>
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
</span><span class="statusGetTheGamesText">Click <a href="?area=product_HL2bronsilvergold"><font color="black">here</font></a> for more details. &nbsp;</span></p>
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
<td align="left" colspan="6" height="30" valign="top" width="271" xpos="11"><img alt="" border="0" height="25" src="index02\Hed_LatestNews.gif" width="263"></td>
<td align="left" colspan="5" height="239" rowspan="2" valign="top" width="171" xpos="282">
<table background="index02/CEL_TechSupport.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
<tbody><tr height="30">
<td colspan="3" height="30" width="163"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="197">
<td height="197" width="7"></td>
<td content="" csheight="191" height="197" valign="top" width="149" xpos="7">
<div class="INDEX02Body">
<p class="Body"><font color="white" size="2"><span class="statusContent2"><b>Questions, Answers, Etc </b><br>
</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">Steam s support pages offer message boards, a list of frequently asked questions, and the Steam Troubleshooter to help identify and resolve any technical support issues you may be experiencing.</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">&gt; <a href="http://steampowered.custhelp.com/cgi-bin/steampowered.cfg/php/enduser/entry.php">visit support now</a> </span></font></p>
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
<table background="index02/CEL_CyberCafe.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
<tbody><tr height="30">
<td colspan="3" height="30" width="163"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="197">
<td height="197" width="6"></td>
<td content="" csheight="191" height="197" valign="top" width="151" xpos="6">
<div class="INDEX02Body">
<p class="Body"><font color="white" size="2"><span class="statusContent2"><b>Games Your Customers Want </b><br>
</span></font></p>
<p class="Body"><font size="2"><span class="statusContent">I</span></font><font size="2"><span class="statusContent">f you run a cyber caf  or gaming venue, Steam makes it easy for you to bring Valve s games to your customers. Over 1000 gaming venues have signed up for Valve s Cyber Caf  Program.</span></font></p>
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
<table background="index02/CEL_GetSteamNow.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="228" showgridx="" showgridy="" width="164">
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
<p class="Body"><font size="2"><span class="statusContent">S</span></font><span class="statusContent">tart playing Valve s award-winning games within minutes. With Steam, you'll also get access to an instant messenger, automatic updates, and more. If you don't already have Steam.</span></p>
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
<strong><a href="index.php?area=news&amp;id=327" style="text-decoration: none;">Half-Life 2 Steam Offers Ready</a></strong><br>The Half-Life 2 Steam offers are now ready for purchase. Those who purchase via Steam, will receive the final version of Counter-Strike: Source immediately.<br><br>
<strong><a href="index.php?area=news&amp;id=326" style="text-decoration: none;">Steam Client Update Released</a></strong><br>An update to the Steam client has just been released. Steam will update itself automatically when you restart.
<br><br>
<strong><a href="index.php?area=news&amp;id=325" style="text-decoration: none;">Half-Life 2 Steam Offers Ready Thursday</a></strong><br>Tomorrow at 11 am PST, the Half-Life 2 Steam offers will be ready for purchase. Those who purchase via Steam, will receive the final version of Counter-Strike: Source immediately. Half-Life 2 and other games in the Steam offerings will be made available to purchasers upon their release.<br><br>
<strong><a href="index.php?area=news&amp;id=324" style="text-decoration: none;">Half-Life 2 Pre-Loading Phase 5</a></strong><br>The fifth phase of the Half-Life 2 preload begins to Steam account holders today.<br><br>
<strong><a href="index.php?area=news&amp;id=323" style="text-decoration: none;">Half-Life 2 Pre-Loading Phase 4</a></strong><br>The fourth phase of the Half-Life 2 preload begins to Steam account holders today. 
<br>
<p align="right"><sub><a href="?area=news" style="text-decoration: none;">read more &gt;</a>&nbsp;</sub></p>
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
    null,
    'Welcome to Steam',
    $content2005v1,
    '2005_v1',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2005v2 = <<<HTML
<table background="TopBanner.gif" border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="75" showgridx="" showgridy="" width="800">
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
 <td align="left" height="49" valign="top" width="137" xpos="662"><a href="index.php?area=getsteamnow"><img alt="" border="0" height="24" src="but_getsteamnow02.gif" width="124"></a></td>
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
<td align="left" height="52" valign="top" width="173" xpos="2"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_01.gif" width="173"></td>
<td align="left" height="52" valign="top" width="28" xpos="175"><a href="index.php?area=news" onmouseout="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"Banner_NAV/Banner_Nav_02.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_02",/*URL*/"Banner_NAV/Banner_Nav_02-over.gif");return true" title="News"><img alt="news" border="0" height="41" name="Banner_Nav_02" src="Banner_NAV/Banner_Nav_02.gif" width="28"></a></td>
<td align="left" height="52" valign="top" width="30" xpos="203"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_03.gif" width="30"></td>
<td align="left" height="52" valign="top" width="81" xpos="233"><a href="index.php?area=getsteamnow" onmouseout="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"Banner_NAV/Banner_Nav_04.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_04",/*URL*/"Banner_NAV/Banner_Nav_04-over.gif");return true" title="Get Steam Now"><img alt="getSteamNow" border="0" height="41" name="Banner_Nav_04" src="Banner_NAV/Banner_Nav_04.gif" width="81"></a></td>
<td align="left" height="52" valign="top" width="32" xpos="314"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_05.gif" width="32"></td>
<td align="left" height="52" valign="top" width="66" xpos="346"><a href="index.php?area=cybercafes" onmouseout="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"Banner_NAV/Banner_Nav_06.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_06",/*URL*/"Banner_NAV/Banner_Nav_06-over.gif");return true" title="Cyber Cafes"><img alt="Cyber Cafes" border="0" height="41" name="Banner_Nav_06" src="Banner_NAV/Banner_Nav_06.gif" width="66"></a></td>
<td align="left" height="52" valign="top" width="32" xpos="412"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_07.gif" width="32"></td>
<td align="left" height="52" valign="top" width="45" xpos="444"><a href="support/entry.php" onmouseout="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"Banner_NAV/Banner_Nav_08.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_08",/*URL*/"Banner_NAV/Banner_Nav_08-over.gif");return true" title="Support"><img alt="Support" border="0" height="41" name="Banner_Nav_08" src="Banner_NAV/Banner_Nav_08.gif" width="45"></a></td>
<td align="left" height="52" valign="top" width="27" xpos="489"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_09.gif" width="27"></td>
<td align="left" height="52" valign="top" width="40" xpos="516"><a href="index.php?area=forums" onmouseout="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"Banner_NAV/Banner_Nav_10.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_10",/*URL*/"Banner_NAV/Banner_Nav_10-over.gif");return true" title="Forums"><img alt="Forums" border="0" height="41" name="Banner_Nav_10" src="Banner_NAV/Banner_Nav_10.gif" width="40"></a></td>
<td align="left" height="52" valign="top" width="30" xpos="556"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_11.gif" width="30"></td>
<td align="left" height="52" valign="top" width="36" xpos="586"><a href="status/status.html" onmouseout="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"Banner_NAV/Banner_Nav_12.gif");return true" onmouseover="changeImages( /*CMP*/"Banner_Nav_12",/*URL*/"Banner_NAV/Banner_Nav_12-over.gif");return true" title="Status"><img alt="Status" border="0" height="41" name="Banner_Nav_12" src="Banner_NAV/Banner_Nav_12.gif" width="36"></a></td>
<td align="left" height="52" valign="top" width="180" xpos="622"><img alt="" border="0" height="41" src="Banner_NAV/Banner_Nav_13.gif" width="180"></td>
<td height="52" width="1"><spacer height="52" type="block" width="1"></spacer></td>
</tr>
<tr height="868">
<td height="868" width="1"></td>
<td align="left" colspan="14" height="868" valign="top" width="801" xpos="1">
<table background="index04/Call2ActionBkg02.jpg" bgcolor="white" border="0" cellpadding="0" cellspacing="0" height="613" width="801">
<tbody><tr>
<td valign="top">
<table border="0" cellpadding="0" cellspacing="0" cool="" gridx="16" gridy="16" height="868" showgridx="" showgridy="" width="801">
<tbody><tr height="38">
<td colspan="22" height="38" width="800"></td>
<td height="38" width="1"><spacer height="38" type="block" width="1"></spacer></td>
</tr>
<tr height="2">
<td colspan="14" height="2" width="441"></td>
<td align="left" colspan="7" height="128" rowspan="2" valign="top" width="354" xpos="441"><a href="index.php?area=product_packageoffers" onmouseout="changeImages("LINK_PlayHL2Now_01",""index03/LINK_PlayHL2Now_01.gif");return true" onmouseover="changeImages("LINK_PlayHL2Now_01","index04/LINK_PlayHL2Now_01-over.gif");return true" title="Get the Games!"><img alt="" border="0" height="33" id="LINK_PlayHL2Now_01" name="LINK_PlayHL2Now_01" src="index03\LINK_PlayHL2Now_01.gif" width="328"></a></td>
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
<p><span>· <a href=index03/SOURCE_Info+Licensing.pdf" title="Source Licensing +&nbsp;Info"><font color="black"><b>Info+Licensing</b></font></a><font color="black"><b> </b>(PDF)</font><a href=index03/SOURCE_Info+Licensing.pdf" title="Source Licensing +&nbsp;Info"><font color="black"><br>
</font></a></span><span>· <a href="http://collective.valve-erc.com/" title="Valve-ERC"><font color="black"><b>MOD&nbsp;Resources<br>
</b></font></a></span><span>· <a href="http://www.valve-erc.com/srcsdk/" title="Source SDK Documentation"><font color="black"><b>SDK&nbsp;Documentation</b></font></a></span></p>
</div>
</td>
<td colspan="15" height="30" width="632"></td>
<td height="30" width="1"><spacer height="30" type="block" width="1"></spacer></td>
</tr>
<tr height="55">
<td colspan="10" height="55" width="372"></td>
<td align="left" height="55" valign="top" width="56" xpos="540"><img alt="" border="0" height="16" src="index04/LINK_ClickHere_01_01.gif" width="56"></td>
<td align="left" height="55" valign="top" width="50" xpos="596"><a href="index.php?area=product_packageoffers" onmouseout="changeImages("LINK_ClickHere_01_02","index04/LINK_ClickHere_01_02.gif");return true" onmouseover="changeImages("LINK_ClickHere_01_02","index04/LINK_ClickHere_01_02-over.gif");return true" title="Click here now!"><img alt="" border="0" height="16" id="LINK_ClickHere_01_02" name="LINK_ClickHere_01_02" src="index04/LINK_ClickHere_01_02.gif" width="48"></a></td>
<td align="left" colspan="2" height="55" valign="top" width="149" xpos="646"><img alt="" border="0" height="16" src="index04/LINK_ClickHere_01_03.gif" width="124"></td>
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
    null,
    'Welcome to Steam',
    $content2005v2,
    '2005_v2',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];


$insertArray[] = [
    '2006v1_index',
    null,
    'Welcome to Steam',
    "",
    '2006_v1',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$insertArray[] = [
    '2006v2_index',
    null,
    'Welcome to Steam',
    "",
    '2006_v2',
    'index.twig',
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
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
HTML;

$insertArray[] = [
    'subscriber_agreement',
    null,

    'Steam Subscriber Agreement',
    $sa_html,
    null,
    null,
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$cafe_setup = <<<HTML
<h1>CAFÉ SETUP INSTRUCTIONS</h1>
<h2>HOW TO<em> GET UP AND RUNNING WITH STEAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

Here are instructions for setting up Steam in your café. Before you begin this process, you must be a member of the <a href="./?area=cybercafes">official Valve Cyber Café Program</a>. For additional information not covered here, please check the <a href="./?area=faq&amp;section=cybercafe">café section of our FAQ</a>.<br>
<br>
<h3 style="text-transform:uppercase;">1. Download the Steam Installer (or use the supplied DVD-ROM)</h3>
When you join the Cyber Café Program, we will send you a DVD-ROM containing the Steam installer. If you would rather not wait for that to arrive, you can download the Steam client installer from the <a href="./?area=getsteamnow">Get Steam Now</a> page on this site. If you choose to download this installer rather than using the DVD-ROM, be sure to save the installer to disk -- you'll need to use it on each licensed computer in your café.<br>
<br>

<h3 style="text-transform:uppercase;">2. Run the Steam Installer</h3>
To make things simple, you will probably want to choose the same install location on every machine in your café. We recommend that you have at least 1GB of free space on the drive before installing Steam.<br>
<br>
<h3 style="text-transform:uppercase;">3. Create an Account</h3>
Follow these steps to create a Steam account:<br>
<br>
<img src="./images/square2.gif"> <strong>Email Address</strong><br>
The first thing the Create Account wizard will ask you to do is enter a valid email address. Please note that for café Steam accounts, the address that you enter into this box does not actually need to be a valid email address. Instead, it should be an address like "computer1@the_name_of_your_cafe.com". Again, this does NOT need to be a valid email address -- it only needs to uniquely identify the specific machine in your café. The second machine on which you install Steam can use the address "computer2@the_name_of_your_cafe.com", and so on.<br>
<br>
<img src="./images/square2.gif"> <strong style="margin-bottom:4px;">Choose a Password and Secret Question &amp; Answer</strong><br>
The normal security concerns apply when choosing your Steam password. Note that it is possible to use the same password on all of the machines in your café (but obviously, somewhat less secure).<br>
<br>
As an added security feature for cyber cafés, Steam will require this password to be entered in order to log OUT. A customer in your café will therefore not be able to log out of Steam or log in as a different user. Also, Steam will run automatically when your computer starts up, and will log in to the Steam servers using the credentials you've supplied during account creation.<br>
<br>
<img src="./images/square2.gif"> <strong>Enter a Nickname</strong><br>
When entering a "Nickname" for each of your café computers, you should again use the name of the computer ("computer1" or similar). It is not necessary to enter a First or Last name.<br>
<br>
<img src="./images/square2.gif"> <strong>Finished creating account</strong><br>
That's it for account creation. All that's left is entering your Product Keys.<br>
<br>
<h3 style="text-transform:uppercase;">4. Enter Your Cyber Café Product Key</h3>
When Valve adds you to the Official Cyber Café Program, you will receive (via email and/or FedEx) a set of Product Keys. You will receive one for each computer you wish to license.<br>
<br>
After Steam is installed, open the "My Games" list. There, you'll see a list of all Steam Games. Double-Click on one that you intend to offer in your café. Steam will ask you for a product key at this point. Each computer will use one of the keys in your list. (Once you have used each Product Key in this way, it will be associated with the Steam account that you've created on that computer. Your Product Keys will, from this point on, not be usable by other people to create accounts or to play Steam games.)<br>
<br>
<h3 style="text-transform:uppercase;">5. Repeat Steps 2-4 for Each Computer</h3>
Repeat these steps for every licensed computer on your network, using unique "email addresses" and Nicknames each time.<br>
<br>
<h3 style="text-transform:uppercase;">6. Configure Internet Ports</h3>
Note that Steam requires certain ports to be open from your gaming machines to the Internet. If you haven't already done so, check that the following ports must are "open":<br>
<br>
UDP 1200<br>
UDP 27000 to 27015 inclusive<br>
TCP 27030 to 27039 inclusive<br>
<br>
<h3 style="text-transform:uppercase;">7. Start Playing!</h3>
Log in to Steam and sit your first customer down. Be sure to have them try the Server Browser (for finding Internet game servers). Also, they can send instant messages through "Friends" to any other Steam user. Automatic updates will be sent to each of your computers automatically, and new games will be added as they become available. <a href="mailto:cafe@steampowered.com">Let us know</a> if you have any difficulty.<br>
<br>

<a href="./?area=cybercafes">Return to main Cyber Café page</a>
HTML;
$insertArray[] = [
    'cafe_setup',
    null,

    'Cyber Café Setup Instructions',
    $cafe_setup,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cybercafes_2003 = <<<HTML
<h1>CYBER CAFÉS</h1>
<h2>BRING<em> STEAM GAMES TO YOUR CUSTOMERS</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="box">
<div class="boxTop2">For Cyber Café<br>Program Members</div>
<strong><a href="./?area=cafe_setup" style="text-decoration: none;">Step-by-Step Instructions</a></strong><br>Read about <a href="./?area=cafe_setup">how to get your cafe up and running</a> with Steam.<br><br>
<strong><a href="./index.php?area=faq&amp;section=cybercafe" style="text-decoration: none;">Frequently Asked Questions</a></strong><br>Check the <a href="./index.php?area=faq&amp;section=cybercafe">FAQ</a> for info on cyber cafés, the official program, Steam, etc.<br>
<br>Members can <a href="mailto:cafe@valvesoftware.com">contact us</a> any time for assistance with Steam or any of the Steam games.
</div>
<br>

If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. There are currently over 800 gaming venues in our program, and more are signing up every day. Valve's cybercafé program is the only legal way to use Valve games in your cybercafé or gaming center.<br>
<br>

<h3 style="text-transform:uppercase;">APRIL CYBER CAFÉ PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="./?area=cybercafe_promotion">special offer to Cyber Cafés</a>. During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%. <a href="./?area=cybercafe_promotion">See this page for details</a>.<br><br>

<h3 style="text-transform:uppercase;">The Official Valve Cyber Café Program</h3>

<img src="./images/valve_maizelogo.gif" align="left">
The Official Valve Cyber Café Program is here. One low monthly fee gets you the most popular action games on the Internet, regular content updates, low maintenance, and fully legal licenses for all of your computers. Here are the details:<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cybercafe_program">Features and Benefits</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_pricing">Pricing and Licensing</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_signup">Cyber Café Sign-Up Form</a><br>
<br>

<br>
<br>
HTML;

$insertArray[] = [
    'cybercafes',
    null,

    'Cyber Cafés',
    $cybercafes_2003,
    "2003_v2",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cybercafes_20042005 = <<<HTML
<h1>CYBER CAFÉS</h1>
<h2>BRING<em> STEAM GAMES TO YOUR CUSTOMERS</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="box">
<div class="boxTop2">For Cyber Café<br>Program Members</div>

<strong><a href="./?area=cafe_setup" style="text-decoration: none;">Step-by-Step Instructions</a></strong><br>Read about <a href="./?area=cafe_setup">how to get your cafe up and running</a> with Steam.<br>
<br>
<strong><a href="./index.php?area=faq&amp;section=cybercafe" style="text-decoration: none;">Frequently Asked Questions</a></strong><br>
Check the <a href="./index.php?area=faq&amp;section=cybercafe">FAQ</a> for info on cyber cafés, the official program, Steam, etc.<br>
<br>
<strong><a href="./?area=support" style="text-decoration: none;">Support</a></strong><br>
Members can contact us via <a href="./cgi-bin/steampowered.cfg/php/enduser/entry.php">support</a> any time for assistance with Steam or any Steam game.<br>
<br>
<strong><a href="./?area=cybercafe_changeform" style="text-decoration: none;">Change Account Information</a></strong><br>
Members can contact us via <a href="mailto:cybercafes@valvesoftware.com">cybercafes@valvesoftware.com</a> to change contact information, café locations, number of seats, etc.<br>
<!-- <p align="right"><sub><a href="incdex.php?area=news" style="text-decoration: none;">read more &gt;</a></sub></p> -->
</div>
<br>

If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. There are currently over 800 gaming venues in our program, and more are signing up every day. Valve's cybercafé program is the only legal way to use Valve games in your cybercafé or gaming center.<br>
<br>

<!--
<h3 style="text-transform:uppercase;">APRIL CYBER CAF&Eacute; PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="./?area=cybercafe_promotion">special offer to Cyber Caf&eacute;s</a>. During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%. <a href="./?area=cybercafe_promotion">See this page for details</a>.<br><br>
-->

<h3 style="text-transform:uppercase;">The Official Valve Cyber Café Program</h3>

<img src="./images/valve_maizelogo.gif" align="left">
The Official Valve Cyber Café Program is here. One low monthly fee gets you the most popular action games on the Internet, regular content updates, low maintenance, and fully legal licenses for all of your computers. Here are the details:<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cybercafe_program">Features and Benefits</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_pricing">Pricing and Licensing</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_signup">Cyber Café Sign-Up Form</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Cyber Café Representatives</h3>

If you would like to participate in the Official Valve Cyber Café Program, contact the representative nearest you.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_representatives">Browse the Cyber Café Representatives</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Cyber Café Directory</h3>

Find an Official Valve Cyber Café and play our latest games.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="./?area=cafe_directory">Browse the Cyber Café Directory</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">For Immediate Release</h3>
<br>
Monday, November 29 at 4:52 pm PST.<br>
<br>
VALVE WINS SUMMARY JUDGMENT MOTIONS IN COPYRIGHT INFRINGEMENT CASE<br>
<br>
Valve today announced the U.S. Federal District Court in Seattle, WA granted its motion for summary judgment on the matters of Cyber Café Rights and Contractual Limitation of Liability in its copyright infringement suit with Sierra/Vivendi Universal Games.<br>
<br>
Judge Thomas S. Zilly ruled that Sierra/Vivendi Universal Games, and its affiliates, are not authorized to distribute (directly or indirectly) Valve games through cyber cafés to end users for pay-to-play activities pursuant to the parties' current publishing agreement. Valve games such as Counter-Strike, Counter-Strike: Condition Zero and the recently released Half-Life 2 and Counter-Strike: Source are all popular in cyber cafés.<br>
<br>
In addition, Judge Zilly ruled in favor of the Valve motion regarding the contractual limitation of liability, allowing Valve to recover copyright damages for any infringement as allowed by law without regard to the publishing agreement's limitation of liability clause. <br>
<br>
"We're happy the court has affirmed the meaning of our publishing contract. This is good news for Valve and its cyber café partners around the world," said Gabe Newell, founder and CEO of Valve. "We continue to add value to our program and we look forward to working with cafés to get them signed up and offering Valve's latest games to their customers." <br>
<br>
The Valve Cyber Café Program is the only legal way to use Valve games in your cyber café or gaming center. There are currently thousands of cyber cafés participating in the program throughout the world. <br>


<!-- Fill out <a href="#">the sign-up form</a> and we'll get back to you right away. Once you're a member, your customers can begin playing right away.<br>-->
<br>
HTML;

$insertArray[] = [
    'cybercafes',
    null,

    'Cyber Cafés',
    $cybercafes_20042005,
    "2004,2005_v1",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];
$hl2gold_context = <<<HTML
<h1>VALVE HQ TRIP GIVEAWAY</h1>
<h2>WIN<em> A TRIP TO VALVE'S OFFICES</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
So you want to see Valve's headquarters? Well, how about if we fly you to Valve HQ to tour the facility and meet some of the team members responsible for Half-Life 2 and Valve's other games?<br>
<br>
Beginning now and ending December 31, 2004, Valve will automatically enter each eligible purchaser of the Half-Life 2 Gold package in the Valve HQ Trip Giveaway. On January 19th, 2005, Valve will randomly select one lucky winner for every 5,000 copies of the Half-Life 2 Gold package purchased by customers through Steam between October 7, 2004 and December 31, 2004 -- it could be you!<br>
<br>
The trip to Valve's headquarters includes:<br>
<br>
<ul>
<li>Two nights' accommodation at a hotel of Valve's choice near Valve's Washington state headquarters.</li>
<li>Coach class airfare to Seattle, Washington.</li>
<li>A tour of Valve's facilities.</li>
<li>Lunch with a select group of Valve employees.</li>
<li>An autographed Half-Life 2 poster.</li>
</ul>
<br>
NO PURCHASE NECESSARY<br>
<br>
How to enter:<br>
<br>
You can enter the Giveaway in one of two ways.<br>
<br>
1. Purchase the Half-Life 2 Gold Package via Steam by December 31, 2004.<br>
2. Or if you are a United States resident you can enter by sending a postcard marked "Valve HQ Trip Giveaway" to the following address: PO Box 1688, Bellevue, WA 98009. Your postcard must be received by December 31, 2004 and include your full name, birth date, address, phone number and email. Incomplete or late entries will be rejected.<br>
<hr>
Conditions of Entry / Official Rules:<br>
<br>
1)      GIVEAWAY DESCRIPTION: Giveaway ends at 11:59 PM (PST) on December 31, 2004. The prize(s) will be awarded in a random drawing from eligible entries received. Only one entry per person accepted. Contestants must be over the age of 12.<br>
<br>
2)      HOW TO ENTER: You can enter the Giveaway in one of two ways.  You can purchase the Half-Life 2 Gold package via Steam by December 31, 2004. Or, if you are a United States resident, you can enter by sending a postcard marked "Valve HQ Giveaway" to the following address: PO Box 1688, Bellevue, WA 98009.  Your postcard must be received by 11:59 pm PST, December 31, 2004 and include your full name, birth date, address, phone number and email. Incomplete or late entries will be rejected.<br>
<br>
3)      WINNER SELECTION &amp; NOTIFICATION: A random drawing will be conducted by Valve on January 19, 2005. Valve's decision is final on all matters relating to the Giveaway. Odds of winning depend on the number of copies of the Half-Life 2 Gold package sold via Steam and the number of eligible entries received. The potential winner(s) will be notified by e-mail within one (1) week of prize drawing.<br>
<br>
4)      PRIZE: Valve will pay (i) two nights' accommodation at a hotel of Valve's choice near Valve's Washington state headquarters and (ii) coach class airfare to Seattle, Washington from either the major airport nearest to the winner's residence (if the winner resides in the United States) or the major international airport nearest to the winner's residence (if the winner does not reside in the United States).  Valve will give the prize winner(s) at least 8 weeks notice of the dates scheduled for the trip and prize winner(s) must provide Valve with any necessary information required for Valve to book air travel and hotel accommodations within 6 weeks of such date.  Any prize winner(s) under the age of 18 must travel with a parent or legal guardian.<br>
<br>
5)      GENERAL CONDITIONS: Giveaway entrants agree to be bound by the terms of these official rules.  The Giveaway is offered by Valve, which is not responsible for incompletion, illegible, or misdirected e-mail or postal mail, or for phone, electrical, network, computer, hardware or software program malfunctions, failures or difficulties. The laws of the United States govern this Giveaway. All Federal, State and Local laws and regulations apply. Acceptance of prize constitutes permission for Valve to use winner's name and likeness for advertising and promotional purposes without additional compensation unless prohibited by law. By entering, participants release and hold harmless Valve and its respective subsidiaries, affiliates, directors, officers, prize suppliers, employees and agents, including advertising and promotion agencies, from any and all liability or any injuries, loss or damage of any kind arising from or in connection with this Giveaway or acceptance or use of prize. Valve reserves the right to cancel or modify the Giveaway if fraud or technical failure destroys the integrity of the Giveaway, as determined by Valve in its sole discretion. Valve reserves the right to disqualify any winner, as determined by Valve in its sole discretion. No cash or other substitution for prizes except at the option of Valve, for a prize of equal or greater value. Taxes are the sole responsibility of the winners. Actual prizes may differ from images shown.<br>
<br>
<br>&nbsp;
HTML;

$insertArray[] = [
    'HL2GOLD_contest',
    null,

    'VALVE HQ TRIP GIVEAWAY',
    $hl2gold_context,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$get_cz = <<<HTML
<div class="content" id="container">
<br><img width="533" height="129" src="./images/cz_logo.gif" alt="Counter-Strike: Condition Zero"><br>
<br>
<div class="narrower">
<h3>GET COUNTER-STRIKE: CONDITION ZERO NOW FOR $29.95!</h3>
<br>
Counter-Strike: Condition Zero™ advances the world’s number one online action game by introducing new single-player game modes, the official CS bot, and special enhancements for online play. <br>
<br>
<div style="background:black;padding:8px;width:440px;"><center>
<img src="./images/01.cs_italy_cz0006-t.gif">&nbsp;
<img src="./images/03.de_dust_cz0006-t.gif">&nbsp;
<img src="./images/cz_screenshot.gif"></center>
</div>
<br>

Get CS:CZ directly from Valve, the creators of Counter-Strike and Half-Life. Order your copy on Steam for only $29.95 and start playing in minutes.<br>
<br>

<!--
<span style="color:#BFBA50;">
<b>Special offer extended for CS owners</b> - If you already have Counter-Strike, you can order Condition-Zero through April 1st for just $29.95, $10 off the regular price.<br>
</span>
-->

<br>
If you already have Steam, <a href="steam://purchase/7">Click here</a> to purchase now!<br><br>

If you don't already have Steam, <a href="./?area=getsteamnow">install it today</a>, and start playing within minutes. With Steam, you'll also get access to:
<ul>
<li>An instant messenger - chat with your friends while you play</li>
<li>Automatic updates - say good-bye to downloading patches</li>
<li>Server browser helps track friends and favorite servers </li>
<li>Easy and fast access to the best games in the world!</li>
</ul>
<a href="./?area=getsteamnow"><img src="./images/but_getsteamnow.gif" height="24" width="124" alt="get steam now"></a>
<br><br>

Note: CS:CZ is also available on CD-ROM from your local retailer.<br>

</div>
</div>
HTML;

$insertArray[] = [
    'get_cz',
    null,

    'Counter-Strike: Condition Zero',
    $get_cz,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cybercafe_program_2003 = <<<HTML
<h1>FEATURES AND BENEFITS</h1>
<h2>OF VALVE'S<em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

<img src="./images/valve_maizelogo.gif" align="left">If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. When you <a href="./?area=cafe_signup">sign up</a> and become a memeber of our Cybercafé program, you'll enjoy the following benefits:<br>
<br>
<h3 style="text-transform:uppercase;">Current &amp; future products</h3>
Cyber Café subscribers automatically receive access to newly released products in the Cyber Café program as long as they continue their regular monthly subscription.<br>
<br>

Products currently included in the Cyber Café Program are:<br>
<ul>
	<li>Counter-Strike: Condition Zero</li>
	<li>Counter-Strike</li>
	<li>Deathmatch Classic</li>
	<li>Day of Defeat</li>
	<li>Half-Life</li>
	<li>Opposing Force</li>
	<li>Half-Life Deathmatch</li>
	<li>Ricochet</li>
	<li>Team Fortress Classic</li>
</ul>
<br>

<h3 style="text-transform:uppercase;">Automatic Updates Delivered Via Steam</h3>
All of your game subscriptions will be kept up-to-date with the latest versions using Steam's distribution system. New content, bug fixes, and other items which have traditionally been distributed as "patches" will be handled automatically.<br>
<br>
<h3 style="text-transform:uppercase;">Fully licensed software and product keys</h3>
When you sign up and become a member of our Cybercafé program, Valve will provide you with software and product keys for each computer you have licensed. <br>
<!-- All commercial licensing of Valve's software is done directly with Valve Corporation -- games purchased at a retail store do not include a license for commercial cyber café use. -->
<br>
<h3 style="text-transform:uppercase;">Access to Valve Product Support</h3>
Members will have priority access to Valve's product support services, for Steam issues and any game-related problems.<br>
<br>
<h3 style="text-transform:uppercase;">Product Key Protection</h3>
Valve's Cyber Café program also protects members against banned accounts. We understand that it is sometimes difficult to prevent users from misusing your computers. To help combat this problem, cafés in the program can contact Valve to correct problems with "banned" accounts.<br>
<br>
<h3 style="text-transform:uppercase;">promotional materials</h3>
We've got plenty of posters for your walls and windows, and other fun stuff that we'll send you when you sign up.<br>
<br>
<h3 style="text-transform:uppercase;">Free Tournament License</h3>
Any time you'd like to host a gaming tournament or other local event, just drop us a line and let us know the details. We'll send you a tournament license right away, free of charge.<br>
<br>
<a href="./?area=cafe_signup">Sign up now!</a><br>
<br>
<a href="./?area=cybercafes">Return to main Cyber Café page</a>

</div>
HTML;


$insertArray[] = [
    'cybercafe_program',
    null,

    'Cyber Café Program',
    $cybercafe_program_2003,
    '2003_v2',
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];


$cybercafe_program_sourceengine = <<<HTML
<h1>FEATURES AND BENEFITS</h1>
<h2>OF VALVE'S<em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

<img src="./images/valve_maizelogo.gif" align="left">If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. When you <a href="./?area=cafe_signup">sign up</a> and become a memeber of our Cybercafé program, you'll enjoy the following benefits:<br>
<br>
<h3 style="text-transform:uppercase;">Current &amp; future products</h3>
Cyber Café subscribers automatically receive access to newly released products in the Cyber Café program as long as they continue their regular monthly subscription.<br>
<br>

Products currently included in the Cyber Café Program are:<br>
<ul>
    <li>Half-Life 2</li>
    <li>Half-Life 2: Deathmatch</li>
    <li>Half-Life: Source</li>
    <li>Counter-Strike: Source</li>
	<li>Counter-Strike: Condition Zero</li>
	<li>Counter-Strike</li>
	<li>Deathmatch Classic</li>
	<li>Day of Defeat</li>
	<li>Half-Life</li>
	<li>Opposing Force</li>
	<li>Half-Life Deathmatch</li>
	<li>Ricochet</li>
	<li>Team Fortress Classic</li>
</ul>
<br>

<h3 style="text-transform:uppercase;">Automatic Updates Delivered Via Steam</h3>
All of your game subscriptions will be kept up-to-date with the latest versions using Steam's distribution system. New content, bug fixes, and other items which have traditionally been distributed as "patches" will be handled automatically.<br>
<br>
<h3 style="text-transform:uppercase;">Fully licensed software and product keys</h3>
When you sign up and become a member of our Cybercafé program, Valve will provide you with software and product keys for each computer you have licensed. <br>
<!-- All commercial licensing of Valve's software is done directly with Valve Corporation -- games purchased at a retail store do not include a license for commercial cyber café use. -->
<br>
<h3 style="text-transform:uppercase;">Access to Valve Product Support</h3>
Members will have priority access to Valve's product support services, for Steam issues and any game-related problems.<br>
<br>
<h3 style="text-transform:uppercase;">Product Key Protection</h3>
Valve's Cyber Café program also protects members against banned accounts. We understand that it is sometimes difficult to prevent users from misusing your computers. To help combat this problem, cafés in the program can contact Valve to correct problems with "banned" accounts.<br>
<br>
<h3 style="text-transform:uppercase;">promotional materials</h3>
We've got plenty of posters for your walls and windows, and other fun stuff that we'll send you when you sign up.<br>
<br>
<h3 style="text-transform:uppercase;">Free Tournament License</h3>
Any time you'd like to host a gaming tournament or other local event, just drop us a line and let us know the details. We'll send you a tournament license right away, free of charge.<br>
<br>
<a href="./?area=cafe_signup">Sign up now!</a><br>
<br>
<a href="./?area=cybercafes">Return to main Cyber Café page</a>

</div>
HTML;

$insertArray[] = [
    'cybercafe_program',
    null,

    'Cyber Café Program',
    $cybercafe_program_sourceengine,
    "2004,2005_v1",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cybercafe_promotion = <<<HTML
<div class="narrower">
<h1>APRIL CYBER CAFÉ PROMOTION</h1>
<h2>VALVE'S<em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
During the month of April 2004, Valve is extending a special offer to Cyber Cafés. <b>During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%</b>. The license includes all of Valve’s available Steam content, including Counter-Strike: Condition Zero, Counter-Strike, Half-Life, Day of Defeat, Team Fortress Classic, and more. Licensed Cyber Café’s also receive product key protection, promotional materials, tournament licenses, and priority access to Valve support.<br>
<br>
This offer ends at 11:59 pm PST on April 30, 2004, is subject to change and is not available in every territory. For more information, please email <a href="mailto:cafe@valvesoftware.com">cafe@valvesoftware.com</a>.
<br><br><br><br>&nbsp;

</div>
HTML;

$insertArray[] = [
    'cybercafe_promotion',
    null,

    'Valve Announces April Cyber Café Promotion',
    $cybercafe_promotion,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cafe_pricing = <<<HTML
<h1>PRICING AND LICENSING</h1>
<h2>VALVE'S<em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

Valve's Official Cyber Café Program makes things simple for the café owner.<br>
<br>
<h3 style="text-transform:uppercase;">One low monthly fee</h3>
For a low monthly fee per licensed computer, your café gets access to all of Valve's games. See the <a href="./?area=cybercafe_program">full list of Features and Benefits</a> for the details of what's included. Payment is handled in three-month blocks, in advance, either by recurring automatic billing or by invoice. <!-- For full details about licensing, payment, and the details of the Caf&eacute; Program, please see the official <a href="./?area=cafe_signup">Valve Cyber Caf&eacute; Agreement</a>. --><br>
<br>
<h3 style="text-transform:uppercase;">APRIL CYBER CAFÉ PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="./?area=cybercafe_promotion">special offer to Cyber Cafés</a>. During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%. <a href="./?area=cybercafe_promotion">See this page for details</a>.<br>
<br>
<h3 style="text-transform:uppercase;">Fully licensed software</h3>
Software purchased at retail is not licensed for commercial use such as cyber café play. If you operate a gaming center, our program is the legal way to obtain a commercial license and offer Valve's games to your customers.<br>
<br>
<h3 style="text-transform:uppercase;">As Always, Tournament Licenses Are Free</h3>
If you'd like to host a LAN event or competition, just <a href="mailto:cafe@valvesoftware.com">let us know</a> and we'll issue you a Tournament License, free of charge.<br>
<br>
<a href="./?area=cafe_signup">Sign up now!</a><br>
<br>
<a href="./?area=cybercafes">Return to main Cyber Café page</a>

</div>
HTML;

$insertArray[] = [
    'cafe_pricing',
    null,

    'Cyber Café Pricing and Licensing',
    $cafe_pricing,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$cybercafe_changeform = <<<HTML
<h1>CYBER CAFÉ CHANGE FORM</h1>
<h2>FOR EXISTING <em>CUSTOMERS</em></h2>
<br>
<div class="narrower" style="width: 75%;">

Please Note: This form is for making updates to your existing cafés already registered in the Valve Cyber Café Program. If you are a new customer, please visit the <a href="./?area=cafe_signup">Cyber Café Program Sign-up</a> webpage.<br>
<br>



<!-- removed margins from textfield -->
<style>
<!--
    INPUT.textfield2{
        width:200px;
        background:#3E4637;
        border-style:solid;
        border-width:1px;
        border-top-color:#1C261E;
        border-right-color:#818D7C;
        border-bottom-color:#818D7C;
        border-left-color:#1C261E;
        color:#BFBA50;
        }
    INPUT.submitter3{
        height:24px;
        width:200px;
        text-align:center;
        padding-left:8px;
        margin:4px 0px 0px 0px;
        background:#4C5844;
        border-style:solid;
        border-width:1px;
        border-top-color:#818D7C;
        border-right-color:#1C261E;
        border-bottom-color:#1C261E;
        border-left-color:#818D7C;
        color:#C4CABE;
        }
-->
</style>

<script language="JavaScript">
function showBranch(branch){
    var objBranch = document.getElementById(branch).style;
    if(objBranch.display=="block")
    {
        objBranch.display="none";
    }
    else
    {
        objBranch.display="block";
    }
}
</script>

<form style="background:black;padding:6px;width:100%;" action="./index.php?area=cybercafe_changeform" method="post">
<input type="hidden" name="area" value="cybercafe_changeform">
<table cellspacing="6" width="100%" style="background:#4C5844;">
<tbody><tr>
    <td valign="middle" align="right" width="50%"><p class="bright"><strong>Cafe ID Number: </strong></p></td>
    <td width="50%" height="56">
    
        <input type="text" name="form_cafe_id" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td colspan="2">

        <p class="bright">
        <input type="checkbox" name="form_update_parent_info" value="checked">
        <strong>I would like to update my parent company name and/or address:</strong></p>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Company Name </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_company_name" value="" class="textfield2" maxlength="32">
        <sup></sup>
        
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Street Address </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_street_address" value="" class="textfield2" maxlength="32">
        <sup></sup>
        
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New City </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_city" value="" class="textfield2" maxlength="32">
        <sup></sup>
        
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Province/State </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_province_state" value="" class="textfield2" maxlength="64">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Country </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_country" value="" class="textfield2" maxlength="64">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Zip/Postal Code </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_new_postcode" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td colspan="2">
    
        <p class="bright">
        <input type="checkbox" name="form_update_billing_tech" value="checked">
        <strong>I would like to update my billing and/or technical contact information:</strong></p>

    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Billing Contact First Name </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_bill_fname" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Billing Contact Last Name </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_bill_lname" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Billing Contact Email Address</td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_bill_email" value="" class="textfield2" maxlength="32">

    </td>
</tr>
<tr>
    <td valign="middle" align="right" height="28" width="50%">New Billing Contact Phone Number </td>
    <td valign="middle" height="28" width="50%">
    
        <input type="text" name="form_bill_phone" value="" class="textfield2" maxlength="24">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Billing Contact Fax Number </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_bill_fax" value="" class="textfield2" maxlength="24">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%"><br>New Technical Contact First Name </td>
    <td valign="bottom" width="50%">
    
        <input type="text" name="form_tech_fname" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Technical Contact Last Name </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_tech_lname" value="" class="textfield2" maxlength="32">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Technical Contact Email Address</td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_tech_email" value="" class="textfield2" maxlength="32">

    </td>
</tr>
<tr>
    <td valign="middle" align="right" height="28" width="50%">New Technical Contact Phone Number </td>
    <td valign="middle" height="28" width="50%">
    
        <input type="text" name="form_tech_phone" value="" class="textfield2" maxlength="24">
        <sup></sup>
    
    </td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">New Technical Contact Fax Number </td>
    <td valign="middle" width="50%">
    
        <input type="text" name="form_tech_fax" value="" class="textfield2" maxlength="24">
        <sup></sup>
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td colspan="2">
    
        <p class="bright">
        <input type="checkbox" name="form_change_exist_seats" value="checked">
        <strong>I would like to change the number of seats at my existing cafe:</strong></p>

    </td>
</tr>
<tr>
    <td valign="middle" align="right">Current # of Seats:</td>
    <td>
        
        <input type="text" name="form_current_seats" value="" class="textfield2" maxlength="5" style="width:32px;">

    </td>
</tr>
<tr>
    <td valign="middle" align="right">New # of Seats:</td>
    <td>
    
        <input type="text" name="form_new_seats" value="" class="textfield2" maxlength="5" style="width:32px;">
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td colspan="2">

        <p class="bright">
        <input type="checkbox" name="form_add_cafe_locations" value="checked">
        <strong>I would like to add more cafe locations:</strong></p>
        
    </td>
</tr>
<tr>
    <td valign="middle" align="right">Current # of Locations:</td>
    <td>
    
        <input type="text" name="form_current_locations" value="" class="textfield2" maxlength="5" style="width:32px;">

    </td>
</tr>
<tr>
    <td valign="middle" align="right">New # of Locations:</td>
    <td><input type="text" name="form_new_locations" value="" class="textfield2" maxlength="5" style="width:32px;"></td>
</tr>
<tr>
    <td width="50%"></td>
    <td width="50%"><br><p class="bright"><strong>New Cafe Location</strong></p></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Name</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Street Address</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">City</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Province/State</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Country</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Zip/Postal Code</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Number of Computer Seats</td>
    <td valign="middle" width="50%"><input type="text" name="cafe2_stations" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
    <td width="50%"></td>
    <td width="50%"><br><p class="bright"><strong>2nd New Cafe Location</strong></p></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Name</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Street Address</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">City</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Province/State</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Country</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Zip/Postal Code</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
    <td valign="middle" align="right" width="50%">Number of Computer Seats</td>
    <td valign="middle" width="50%"><input type="text" name="cafe3_stations" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
    <td width="50%"></td>
    <td width="50%"><p><br><input type="submit" name="perform" value="Submit" class="submitter3"></p></td>
</tr>
<tr>
    <td width="50%">&nbsp;</td>
    <td width="50%"></td>
</tr>
</tbody></table>
</form><br>

<h3 style="text-transform:uppercase;">Next Steps</h3>

You will receive a confirmation when your updates have been made to your account.<br>
<br>
<a href=".?area=cybercafes">Return to main Cyber Café page</a>

</div>

HTML;

$insertArray[] = [
    'cybercafe_changeform',
    null,

    'Cyber Café Program Change Form',
    $cybercafe_changeform,
    null,
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$product_hl2bronzesilvergold_2004 = <<<HTML
<script>
function popup2(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>
<table width="800" align="center" border="0" cellspacing="0" cellpadding="0" background="./images//hl2_bronzesilvergoldpp/Background.jpg" cool="" gridx="16" gridy="16" height="668" showgridx="" showgridy="">
	<tbody><tr height="138">
		<td width="799" height="138" colspan="19"></td>
		<td width="1" height="138"><spacer type="block" width="1" height="138"></spacer></td>
	</tr>
	<tr height="97">
		<td width="193" height="97" colspan="3"></td>
		<td content="" csheight="69" width="587" height="97" colspan="15" valign="top" xpos="193"><span class="statusProductPageHed"><font class="statusProductPageHed" size="3" color="black">Purchase any one of the three Half-Life® 2 Steam packages listed below, start playing Counter-Strike™: Source™ immediately, and be ready to start playing Half-Life 2 the moment it is made available! </font></span></td>
		<td width="19" height="97"></td>
		<td width="1" height="97"><spacer type="block" width="1" height="97"></spacer></td>
	</tr>
	<tr height="37">
		<td width="200" height="46" colspan="4" rowspan="2"></td>
		<td content="" csheight="33" width="146" height="37" colspan="2" valign="top" xpos="200">
			<div align="left">
				<font color="white"><b><span class="offerBRONZE">HALF-LIFE 2 BRONZE</span></b></font></div>
		</td>
		<td width="51" height="37" colspan="2"></td>
		<td content="" csheight="33" width="137" height="37" colspan="2" valign="top" xpos="397"><font color="white"><b><span class="offerSILVER">HALF-LIFE&nbsp;2 SILVER</span></b></font></td>
		<td width="62" height="37" colspan="3"></td>
		<td content="" csheight="35" width="147" height="37" colspan="3" valign="top" xpos="596"><font color="white"><b><span class="offerGOLD">HALF-LIFE 2<br>
						GOLD</span></b></font></td>
		<td width="56" height="37" colspan="3"></td>
		<td width="1" height="37"><spacer type="block" width="1" height="37"></spacer></td>
	</tr>
	<tr height="9">
		<td width="197" height="9" colspan="4" valign="top" align="left" xpos="200"><img src="./images//index02/rule01.gif" alt="" width="166" height="2" border="0"></td>
		<td width="199" height="9" colspan="5" valign="top" align="left" xpos="397"><img src="./images//hl2_bronzesilvergoldpp/rule01.gif" alt="" width="166" height="2" border="0"></td>
		<td width="184" height="9" colspan="5" valign="top" align="left" xpos="596"><img src="./images//hl2_bronzesilvergoldpp/rule01.gif" alt="" width="166" height="2" border="0"></td>
		<td width="19" height="9"></td>
		<td width="1" height="9"><spacer type="block" width="1" height="9"></spacer></td>
	</tr>
	<tr height="1">
		<td width="397" height="2" colspan="8" rowspan="2"></td>
		<td content="" csheight="25" width="164" height="25" colspan="4" rowspan="3" valign="top" xpos="397"><font size="2" color="white"><b><span class="offerPRICE">$59.95<br>
					</span></b></font></td>
		<td width="238" height="1" colspan="7"></td>
		<td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
	</tr>
	<tr height="1">
		<td width="37" height="24" colspan="2" rowspan="2"></td>
		<td content="" csheight="25" width="145" height="25" colspan="2" rowspan="3" valign="top" xpos="598"><font size="2" color="white"><b><span class="offerPRICE">$89.95<br>
					</span></b></font></td>
		<td width="56" height="25" colspan="3" rowspan="3"></td>
		<td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
	</tr>
	<tr height="23">
		<td width="200" height="45" colspan="4" rowspan="4"></td>
		<td content="" csheight="25" width="164" height="25" colspan="3" rowspan="3" valign="top" xpos="200"><font size="2" color="white"><b><span class="offerPRICE">$49.95<br>
					</span></b></font></td>
		<td width="33" height="262" rowspan="5"></td>
		<td width="1" height="23"><spacer type="block" width="1" height="23"></spacer></td>
	</tr>
	<tr height="1">
		<td content="" csheight="106" width="163" height="239" colspan="3" rowspan="4" valign="top" xpos="397">
			<p><span class="statusContent3">INCLUDES:</span><br>
				<span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike: Source<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Day of Defeat™:&nbsp;Source*<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent"><b>PLUS:</b> Valve's back catalog (listed <a href="javascript:popup2('http://www.steampowered.com/backcatalog/', 'no', 300, 200, '_blank');">here</a>) available on Steam!<br>
					</span></font></p>
		</td>
		<td width="38" height="239" colspan="3" rowspan="4"></td>
		<td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
	</tr>
	<tr height="1">
		<td content="" csheight="223" width="159" height="238" colspan="3" rowspan="3" valign="top" xpos="598">
			<p><span class="statusContent3">INCLUDES:</span><br>
				<span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike:Source<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Day of Defeat:&nbsp;Source*<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Valve's back catalog available (listed <a href="javascript:popup2('http://www.steampowered.com/backcatalog/', 'no', 300, 200, '_blank');">here</a>).<br>
						<b>HL2 Merchandise:</b><br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 posters (3 total)<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 hat<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 soundtrack<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 sticker<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">City 17 postcard<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Prima's HL2 strat guide<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Special collector's box<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Chance to win trip to Valve! **</span></font></p>
		</td>
		<td width="42" height="360" colspan="2" rowspan="5"></td>
		<td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
	</tr>
	<tr height="20">
		<td content="" csheight="41" width="164" height="237" colspan="3" rowspan="2" valign="top" xpos="200">
			<p><span class="statusContent3">INCLUDES:</span><br>
				<span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
					</span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike: Source</span></font></p>
		</td>
		<td width="1" height="20"><spacer type="block" width="1" height="20"></spacer></td>
	</tr>
	<tr height="217">
		<td width="11" height="339" rowspan="3"></td>
		<td content="" csheight="321" width="154" height="339" rowspan="3" valign="top" xpos="11">
			<div align="left">
				<p><span class="statusGetTheGamesTextsmall"><b>ORDER&nbsp;NOW! </b>&nbsp;&gt;<br>
						Orders will be processed immediately. All sales are final. </span><span class="statusGetTheGamesTextsmall">Allow 6 to 8 weeks for delivery of Half-Life 2 Gold merchandise. Shipping, taxes, and duties not included.<br>
					</span><span class="statusGetTheGamesText"><br>
					</span><span class="statusGetTheGamesTextsmall">* This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
					</span><span class="statusGetTheGamesTextsmall">** 1 trip offered for every 5000 Gold packages purchased. For contest details, <a href="./?area=HL2GOLD_contest"><font color="black">click here</font></a>.<br>
					</span></p>
			</div>
		</td>
		<td width="35" height="217" colspan="2"></td>
		<td width="1" height="217"><spacer type="block" width="1" height="217"></spacer></td>
	</tr>
	<tr height="43">
		<td width="40" height="122" colspan="3" rowspan="2"></td>
		<td width="159" height="43" colspan="2" valign="top" align="left" xpos="205"><a href="steam://purchase/9"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="41" height="122" colspan="2" rowspan="2"></td>
		<td width="155" height="43" colspan="2" valign="top" align="left" xpos="405"><a href="steam://purchase/10"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="46" height="122" colspan="4" rowspan="2"></td>
		<td width="151" height="43" colspan="2" valign="top" align="left" xpos="606"><a href="steam://purchase/13"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="1" height="43"><spacer type="block" width="1" height="43"></spacer></td>
	</tr>
	<tr height="79">
		<td width="159" height="79" colspan="2" valign="top" align="left" xpos="205"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="155" height="79" colspan="2" valign="top" align="left" xpos="405"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="151" height="79" colspan="2" valign="top" align="left" xpos="606"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
		<td width="1" height="79"><spacer type="block" width="1" height="79"></spacer></td>
	</tr>
	<tr height="1" cntrlrow="">
		<td width="11" height="1"><spacer type="block" width="11" height="1"></spacer></td>
		<td width="154" height="1"><spacer type="block" width="154" height="1"></spacer></td>
		<td width="28" height="1"><spacer type="block" width="28" height="1"></spacer></td>
		<td width="7" height="1"><spacer type="block" width="7" height="1"></spacer></td>
		<td width="5" height="1"><spacer type="block" width="5" height="1"></spacer></td>
		<td width="141" height="1"><spacer type="block" width="141" height="1"></spacer></td>
		<td width="18" height="1"><spacer type="block" width="18" height="1"></spacer></td>
		<td width="33" height="1"><spacer type="block" width="33" height="1"></spacer></td>
		<td width="8" height="1"><spacer type="block" width="8" height="1"></spacer></td>
		<td width="129" height="1"><spacer type="block" width="129" height="1"></spacer></td>
		<td width="26" height="1"><spacer type="block" width="26" height="1"></spacer></td>
		<td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
		<td width="35" height="1"><spacer type="block" width="35" height="1"></spacer></td>
		<td width="2" height="1"><spacer type="block" width="2" height="1"></spacer></td>
		<td width="8" height="1"><spacer type="block" width="8" height="1"></spacer></td>
		<td width="137" height="1"><spacer type="block" width="137" height="1"></spacer></td>
		<td width="14" height="1"><spacer type="block" width="14" height="1"></spacer></td>
		<td width="23" height="1"><spacer type="block" width="23" height="1"></spacer></td>
		<td width="19" height="1"><spacer type="block" width="19" height="1"></spacer></td>
		<td width="1" height="1"></td>
	</tr>
</tbody></table>
HTML;

$insertArray[] = [
    'product_HL2bronsilvergold',
    null,

    'Welcome to Steam',
    $product_hl2bronzesilvergold_2004,
    "2004",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$product_hl2bronzesilvergold_2005 = <<<HTML
<table width="800" border="0" cellspacing="0" cellpadding="0" background="./images/hl2_bronzesilvergoldpp/Background02.jpg" cool="" gridx="16" gridy="16" height="667">
    <tbody><tr height="123">
        <td width="799" height="123" colspan="20"></td>
        <td width="1" height="123"><spacer type="block" width="1" height="123"></spacer></td>
    </tr>
    <tr height="104">
        <td width="23" height="104"></td>
        <td content="" csheight="99" width="590" height="104" colspan="16" valign="top" xpos="23"><font size="3" color="black"><span class="statusGetTheGamesSubhed">Featuring amazing digital actors, advanced AI, stunning graphics, and physical gameplay, </span><span class="statusGetTheGamesSubhedMod"><span>VALVE'S HALF-LIFE 2</span></span><span class="statusGetTheGamesSubhed"> has been called the greatest game ever made and earned over one dozen of the 2004 </span><span class="statusGetTheGamesSubhedMod"><span>GAME&nbsp;OF&nbsp;THE&nbsp;YEAR</span></span><span class="statusGetTheGamesSubhed"> Awards announced thus far. Purchase any one of the Steam packages listed below directly from Valve and </span><span class="statusGetTheGamesSubhedMod"><span>START&nbsp;PLAYING</span></span><span class="statusGetTheGamesSubhed"> the game </span><span class="statusGetTheGamesSubhedMod"><span>WITHIN&nbsp;MINUTES</span></span><span class="statusGetTheGamesSubhed">.</span></font></td>
        <td width="186" height="104" colspan="3"></td>
        <td width="1" height="104"><spacer type="block" width="1" height="104"></spacer></td>
    </tr>
    <tr height="37">
        <td width="39" height="39" colspan="2" rowspan="2"></td>
        <td content="" csheight="33" width="146" height="37" colspan="2" valign="top" xpos="39">
            <div align="left">
                <font color="white"><b><span class="offerBRONZE">HALF-LIFE 2 BRONZE</span></b></font></div>
        </td>
        <td width="50" height="37" colspan="2"></td>
        <td content="" csheight="33" width="137" height="37" colspan="2" valign="top" xpos="235"><font color="white"><b><span class="offerSILVER">HALF-LIFE&nbsp;2 SILVER</span></b></font></td>
        <td width="61" height="37" colspan="3"></td>
        <td content="" csheight="35" width="160" height="37" colspan="3" valign="top" xpos="433"><font color="white"><b><span class="offerGOLD">HALF-LIFE 2<br>
                        GOLD </span><span class="offerGOLD1">*NEW PRICE*</span></b></font></td>
        <td width="206" height="37" colspan="6"></td>
        <td width="1" height="37"><spacer type="block" width="1" height="37"></spacer></td>
    </tr>
    <tr height="2">
        <td width="196" height="2" colspan="4" valign="top" align="left" xpos="39"><img src="./images/rule01.gif" alt="" width="166" height="2" border="0"></td>
        <td width="168" height="2" colspan="4" valign="top" align="left" xpos="235"><img src="./images/hl2_bronzesilvergoldpp/rule01.gif" alt="" width="166" height="2" border="0"></td>
        <td width="30" height="2"></td>
        <td width="173" height="2" colspan="5" valign="top" align="left" xpos="433"><img src="./images/hl2_bronzesilvergoldpp/rule01.gif" alt="" width="166" height="2" border="0"></td>
        <td width="193" height="2" colspan="4"></td>
        <td width="1" height="2"><spacer type="block" width="1" height="2"></spacer></td>
    </tr>
    <tr height="1">
        <td width="235" height="2" colspan="6" rowspan="2"></td>
        <td content="" csheight="25" width="164" height="28" colspan="3" rowspan="3" valign="top" xpos="235"><font size="2" color="white"><b><span class="offerPRICE">$59.95<br>
                    </span></b></font></td>
        <td width="400" height="1" colspan="11"></td>
        <td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
    </tr>
    <tr height="1">
        <td width="36" height="27" colspan="3" rowspan="2"></td>
        <td content="" csheight="25" width="171" height="27" colspan="4" rowspan="2" valign="top" xpos="435"><font size="2" color="white"><b><span class="offerPRICE"><strike>$89.95</strike></span><span class="offerPRICE1"> $84.95</span></b></font></td>
        <td width="193" height="27" colspan="4" rowspan="2"></td>
        <td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
    </tr>
    <tr height="26">
        <td width="39" height="26" colspan="2"></td>
        <td content="" csheight="25" width="164" height="26" colspan="3" valign="top" xpos="39"><font size="2" color="white"><b><span class="offerPRICE">$49.95<br>
                    </span></b></font></td>
        <td width="32" height="26"></td>
        <td width="1" height="26"><spacer type="block" width="1" height="26"></spacer></td>
    </tr>
    <tr height="1">
        <td width="235" height="2" colspan="6" rowspan="2"></td>
        <td content="" csheight="119" width="168" height="260" colspan="4" rowspan="4" valign="top" xpos="235">
            <p><span class="statusContent3">INCLUDES:</span><br>
                <span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2: Deathmatch<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike: Source<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Day of Defeat™:&nbsp;Source*<br>
                        <br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent" onclick="CSAction(new Array(/*CMP*/'343C81630'));return CSClickReturn()" csclick="343C81630"><b>PLUS:</b> Valve's back catalog (listed <a href="(EmptyReference!)">here</a>)!<br>
                    </span></font></p>
        </td>
        <td width="396" height="1" colspan="10"></td>
        <td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
    </tr>
    <tr height="1">
        <td width="32" height="259" colspan="2" rowspan="3"></td>
        <td content="" csheight="249" width="159" height="259" colspan="3" rowspan="3" valign="top" xpos="435">
            <p><span class="statusContent3">INCLUDES:</span><br>
                <span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2: Deathmatch<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike:Source<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Day of Defeat:&nbsp;Source*<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Valve's back catalog (listed <a onclick="CSAction(new Array(/*CMP*/'343C81821'));return CSClickReturn()" href="#" csclick="343C81821">here</a>)!<br>
                        <br>
                        <b>HL2 Merchandise:</b><br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 posters (3 total)<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 hat<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 soundtrack<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">HL2 sticker<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">City 17 postcard<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Prima's HL2 strat guide<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Special collector's box<br>
                    </span></font></p>
        </td>
        <td width="205" height="47" colspan="5" rowspan="2"></td>
        <td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
    </tr>
    <tr height="46">
        <td width="39" height="46" colspan="2"></td>
        <td content="" csheight="41" width="164" height="46" colspan="3" valign="top" xpos="39">
            <p><span class="statusContent3">INCLUDES:</span><br>
                <span class="statusContent">▪ </span><font size="2"><span class="statusContent">Half-Life 2<br>
                    </span></font><span class="statusContent">▪ </span><font size="2"><span class="statusContent">Counter-Strike: Source</span></font></p>
        </td>
        <td width="32" height="46"></td>
        <td width="1" height="46"><spacer type="block" width="1" height="46"></spacer></td>
    </tr>
    <tr height="212">
        <td width="235" height="212" colspan="6"></td>
        <td width="39" height="212" colspan="3"></td>
        <td content="" csheight="303" width="157" height="324" rowspan="3" valign="top" xpos="633">
            <div align="left">
                <p><span class="statusGetTheGamesTextsmall"><b>ORDER&nbsp;NOW! </b>&nbsp;&gt;<br>
                        Orders will be processed immediately. All sales are final. Allow 6 to 8 weeks for delivery of Half-Life 2 Gold merchandise. Shipping, taxes, and duties not included.<br>
                        <br>
                        * This is an unreleased product and will be made available to purchasers upon its release. The release date for this product is uncertain and purchasers should not rely on any estimated release date.<br>
                    </span></p>
            </div>
        </td>
        <td width="9" height="324" rowspan="3"></td>
        <td width="1" height="212"><spacer type="block" width="1" height="212"></spacer></td>
    </tr>
    <tr height="41">
        <td width="44" height="112" colspan="3" rowspan="2"></td>
        <td width="159" height="41" colspan="2" valign="top" align="left" xpos="44"><a href="steam://purchase/9"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="40" height="112" colspan="2" rowspan="2"></td>
        <td width="156" height="41" colspan="2" valign="top" align="left" xpos="243"><a href="steam://purchase/10"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="44" height="112" colspan="4" rowspan="2"></td>
        <td width="150" height="41" valign="top" align="left" xpos="443"><a href="steam://purchase/13"><img src="./images/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="40" height="112" colspan="4" rowspan="2"></td>
        <td width="1" height="41"><spacer type="block" width="1" height="41"></spacer></td>
    </tr>
    <tr height="71">
        <td width="159" height="71" colspan="2" valign="top" align="left" xpos="44"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="156" height="71" colspan="2" valign="top" align="left" xpos="243"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="150" height="71" valign="top" align="left" xpos="443"><a href="./index.php?area=getsteamnow"><img src="./images/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
        <td width="1" height="71"><spacer type="block" width="1" height="71"></spacer></td>
    </tr>
    <tr height="1" cntrlrow="">
        <td width="23" height="1"><spacer type="block" width="23" height="1"></spacer></td>
        <td width="16" height="1"><spacer type="block" width="16" height="1"></spacer></td>
        <td width="5" height="1"><spacer type="block" width="5" height="1"></spacer></td>
        <td width="141" height="1"><spacer type="block" width="141" height="1"></spacer></td>
        <td width="18" height="1"><spacer type="block" width="18" height="1"></spacer></td>
        <td width="32" height="1"><spacer type="block" width="32" height="1"></spacer></td>
        <td width="8" height="1"><spacer type="block" width="8" height="1"></spacer></td>
        <td width="129" height="1"><spacer type="block" width="129" height="1"></spacer></td>
        <td width="27" height="1"><spacer type="block" width="27" height="1"></spacer></td>
        <td width="4" height="1"><spacer type="block" width="4" height="1"></spacer></td>
        <td width="30" height="1"><spacer type="block" width="30" height="1"></spacer></td>
        <td width="2" height="1"><spacer type="block" width="2" height="1"></spacer></td>
        <td width="8" height="1"><spacer type="block" width="8" height="1"></spacer></td>
        <td width="150" height="1"><spacer type="block" width="150" height="1"></spacer></td>
        <td width="1" height="1"><spacer type="block" width="1" height="1"></spacer></td>
        <td width="12" height="1"><spacer type="block" width="12" height="1"></spacer></td>
        <td width="7" height="1"><spacer type="block" width="7" height="1"></spacer></td>
        <td width="20" height="1"><spacer type="block" width="20" height="1"></spacer></td>
        <td width="157" height="1"><spacer type="block" width="157" height="1"></spacer></td>
        <td width="9" height="1"><spacer type="block" width="9" height="1"></spacer></td>
        <td width="1" height="1"></td>
    </tr>
</tbody></table>
HTML;

$insertArray[] = [
    'product_HL2bronsilvergold',
    null,

    'Welcome to Steam',
    $product_hl2bronzesilvergold_2005,
    "2005_v1,2005_v2",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$filtered_info = <<<HTML
	<title>CD Key instructions</title>
	<style>
	<!--
	body { scrollbar-base-color: #4C5844; }
	body, p, td, h1 { font-family: Verdana; font-size: 12px; }
	h1 { font-size: 14px; font-weight: bold; }
	body { background:#4C5844; color:#D8DED3; }
	.content { background:#3E4637; }
	a { color: White; }
	-->
	</style>

<body leftmargin="\&quot;20\&quot;" topmargin="\&quot;20\&quot;" rightmargin="\&quot;20\&quot;" bottommargin="\&quot;20\&quot;" marginwidth="\&quot;20\&quot;" marginheight="\&quot;20\&quot;">
 

<table width="\&quot;100%\&quot;" height="\&quot;100%\&quot;" cellspacing="\&quot;0\&quot;" cellpadding="\&quot;10\&quot;" class="\&quot;content\&quot;">
<tbody><tr>
	<td width="\&quot;100%\&quot;" align="\&quot;left\&quot;" valign="\&quot;top\&quot;" style="\&quot;border:" solid="" 1px="" #56634d;\"="">
	<h1>"Filtered" Content Servers</h1>
	Some content servers on Steam's network are not public. These servers are called "filtered" because they only serve content to a select group of users (filtering out all others). <br><br>
	On the content server status page, these servers are not counted in the Total Available Bandwidth or the Total Used Bandwidth numbers.<br>
	</td>
</tr>
</tbody></table>
HTML;

$insertArray[] = [
    'filtered_info',
    null,

    '"Filtered" Content Servers',
    $filtered_info,
    null,
    "none.twig",
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$steamworks_2007 = <<<HTML
<div class="contentBG_2">
    <div class="headerBG_2">
    
        <!-- Left Collumn Content -->
        <div class="leftCol_6">
    
            <center><img src="SteamworksBanner.jpg"><br>
            <img src="triple.jpg"></center>
    
            <div style="margin:0px 32px 12px 38px; font-size:108%;">
            <br>
            <br>
            <h3 style="margin:0px;">Focus on your game</h3><br>
            <br>
            Save months of development time and eliminate technology licensing fees.  Plus, all of the features of Steamworks can be used alone or in combination with each other or your own existing solution.<br>
            <br>
            Steamworks is not engine specific and will work with any underlying technology.  Whether you're publishing your games on Steam or not, Steamworks lets you take advantage of Steam features in retail products.<br>
            <br>
            <br>
            <hr style="border-style:dotted;height:2px;color:#232323;">
            <br>
            <br>
            <h3 style="margin:0px;">Watch this space</h3><br>
            <br>
            Much more information coming soon. In the meantime, please contact <a style="color:white;" href="mailto:%20jasonh@valvesoftware.com">Jason Holtman</a>, Valve's Director of Business Development.<br>
        </div>
    
            <br>
            <br clear="all">
    
            
    
            <br>
            <br clear="all">
    
        </div>
        <!-- End Left Collumn Content -->
    
        <!-- Right Collumn Content -->
        <div class="rightCol_2" style="padding-top:100px;">
        
            
    
            <div class="usr_edit_right_header"><div style="float:left; "> Game services </div></div>
    
            <div class="rightCol_2_Hr"></div>
             <ul>
             <li>Auto-updating</li>
            <li>Game stats collection and display</li>
            <li>Multiplayer matchmaking</li>
            <li>The Steam Community</li>
            <li>Voice chat</li>
        </ul>
        <br>
            <div class="usr_edit_right_header"><div style="float:left; "> Retail back-end services</div></div>
            <ul>
            <li>Key-based authentication</li>
            <li>Territory control</li>
            <li>Zero-day piracy protection</li>
            <li>DRM	</li>				
            </ul>
            <br>
            <div class="usr_edit_right_header"><div style="float:left; "> Development tools </div></div>
            <ul>
            <li>Rapid &amp; secure build distribution</li>
            <li>Crash testing, MDMP collection</li>
            <li>Testing &amp; usability data collection</li>
    
             </ul>
             <br>
             <br>
             <br>
    
    
            </div>
        </div>
        <!-- End Right Collumn Content -->
    
        <br clear="left">
    
    </div>
HTML;

$insertArray[] = [
    'steamworks',
    null,
    'SteamWorks',
    $steamworks_2007,
    "2007_v1,2007_v2",
    null,
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$stmtcp = $pdo->prepare(
    'INSERT IGNORE INTO custom_pages
    (slug, page_name, title, content, theme, template, header_image, created, updated, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "published")'
);

foreach ($insertArray as $row) {
    array_splice($row, 6, 0, [null]);
    $stmtcp->execute($row);
}

$tournamentLimitedBlocks = [
    'hero_title' => [
        'label' => 'Hero Title',
        'position' => 10,
        'content' => 'LIMITED GAME TOURNAMENT LICENSES',
    ],
    'hero_subtitle' => [
        'label' => 'Hero Subtitle',
        'position' => 20,
        'content' => 'BRING <em>STEAM GAMES</em> TO YOUR TOURNAMENT OR LAN PARTY!',
    ],
    'calendar_intro' => [
        'label' => 'Calendar Intro',
        'position' => 30,
        'content' => 'The calendar below displays all of the Valve licensed tournaments occurring in the next 90 days.  (Tournament organizers may opt out of having their events displayed on this calendar.)<br><br><img src="img/yellowSquare.gif" alt="">&nbsp;<a href="index.php?area=tourney_calendar">view the full calendar</a><br><br>',
    ],
    'section_license' => [
        'label' => 'What is a Limited Game Tournament License?',
        'position' => 40,
        'content' => <<<'HTML'
All tournaments where Valve games are played require you to complete and agree to the terms of our Limited Game Tournament License Agreement (Tournament Agreement).  Neither the retail licenses nor the Steam Subscriber Agreement terms allow a licensee to host a tournament.  The Tournament Agreement is free and grants you the license to use and display identified games (Games) in your tournament.  <a href="index.php?area=tourney_limited_license" target="_blank">Click here</a> to view a complete version of the Agreement.<br><br>
The Tournament Agreement grants you the right to use the Games to do the following activities:

<ul>
<li> Operate and use the Game(s) during the licensed tournament.
        <li> Publicly display and publicly perform the Game(s) during the tournament.
        <li> Record Game play at the tournament, and distribute and sublicense such recording for private linear viewing only.
        <li> Promote the use of the Game(s) in connection with the tournament. You may only use copies of the Game(s) that you have properly acquired and licensed, at retail or via Valves Steam distribution system.
</li></li></li></li></ul>

You should consider whether you need permission from tournament participants, the tournament venue, or other third parties to exercise any of these rights.<br><br><table align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3"><strong>Game(s) may include:</strong></td>
</tr>
<tr>
<td valign="top">
        Counter-Strike<br>
        Counter-Strike: Source<br>
        Counter-Strike: Condition Zero<br>
        Day of Defeat<br>
        Day of Defeat: Source<br>
        Deathmatch Classic<br>
</td>
<td valign="top">&nbsp;&nbsp;</td>
<td valign="top">
        Half-Life 2<br>
        Half-Life<br>
        Half-Life Deathmatch<br>
        Half-Life: Source<br>
        Ricochete<br>
        Team Fortress Classic<br>
</td>
</tr>
</table><br>
HTML
    ],
    'section_restrictions' => [
        'label' => 'Tournament Restrictions',
        'position' => 50,
        'content' => <<<'HTML'
The tournament license has the following restrictions:

<ol type="a">
<li> The tournament must occur within ninety (90) days after Valve receives the executed Agreement.
        <li> You shall not use or permit the use of illegal copies of the Game(s).
        <li> The tournament must be held at the physical location identified you identify in your application.
        <li> You will be limited to no more then four tournaments per year.
        <li> Each tournament will be limited to no more than one hundred (100) participants.
        <li> The duration of the tournament will be no longer than three (3) sequential days.
</li></li></li></li></li></li></ol>

Any tournaments that fall outside of the above restrictions, need to contact <a href="mailto:cybercafes@valvesoftware.com">Valve</a> for approval.<br><br>
HTML
    ],
    'section_calendar' => [
        'label' => 'Advertise on the Tournament Calendar',
        'position' => 60,
        'content' => 'If your event has been approved, we will post your event on our  <a href="index.php?area=tourney_calendar">Tournament Calendar</a>.<br><br>',
    ],
    'section_registration' => [
        'label' => 'How Do I Register My Tournament?',
        'position' => 70,
        'content' => 'If you are ready to register your tournament, please complete our <a href="index.php?area=tourney_limited_signup">Limited Game Tournament License Agreement Signup Form</a>.  If you agree to the terms of the <a href="index.php?area=tourney_limited_license" target="_blank">Tournament Agreement</a>, click Submit. If your tournament is approved, you will receive a confirmation email and your tournament will be added to our <a href="index.php?area=tourney_calendar">Tournament Calendar</a>. Please allow at least five (5) business days for your event to be approved.<br><br>',
    ],
    'section_temp_accounts' => [
        'label' => 'Temporary Tournament Steam Accounts',
        'position' => 80,
        'content' => 'Most tournaments held around the world require their players to bring their own software and/or PCs. However, if you are providing the Games for your players or need extra copies for your event, you can purchase Temporary Tournament Steam Accounts. These accounts will be active for the dates of your event.<br><br>How much does it cost? $2 USD per account per day (25 account, 2 day minimum required). Members of our Cyber Café Program may receive a discount. Please indicate on the <a href="index.php?area=tourney_limited_signup">Limited Game Tournament License Agreement Signup Form</a> how many temporary accounts you want to purchase. After you have agreed to the terms of the Tournament Agreement and submitted the Signup Form, you will receive a confirmation email if your tournament has been approved with a link to enter your credit card information to purchase the Temporary Tournament Steam Accounts.  Please allow at least (5) business days to allow enough time for your tournament application to be reviewed and for the set up and testing of your temporary accounts.<br><br>',
    ],
    'section_closing' => [
        'label' => 'Good Luck With Your Tournament',
        'position' => 90,
        'content' => '',
    ],
];

$tournamentCalendarBlocks = [
    'intro' => [
        'label' => 'Calendar Intro',
        'position' => 10,
        'content' => 'This calendar displays all Valve licensed tournaments occurring in the next 90 days. (Tournament organizers may opt out of having their events displayed on this calendar.)<br><br>To advertise your next event on our Tournament Calendar, please visit our <a href="index.php?area=tourney_limited">Tournament Website</a> for more information and to complete a Tournament Signup Form.',
    ],
];

$blockStmt = $pdo->prepare(
    'INSERT INTO tournament_content_blocks (page_slug, theme, block_key, block_label, content, position, created_at, updated_at)
     VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
     ON DUPLICATE KEY UPDATE block_label = VALUES(block_label), content = VALUES(content), position = VALUES(position)'
);

foreach (['2004', '2005_v1'] as $theme) {
    foreach ($tournamentLimitedBlocks as $key => $block) {
        $blockStmt->execute([
            'tourney_limited',
            $theme,
            $key,
            $block['label'],
            $block['content'],
            $block['position'],
        ]);
    }

    foreach ($tournamentCalendarBlocks as $key => $block) {
        $blockStmt->execute([
            'tourney_calendar',
            $theme,
            $key,
            $block['label'],
            $block['content'],
            $block['position'],
        ]);
    }
}
?>