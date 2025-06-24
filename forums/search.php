<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums Search Page</title>
<link rel="Shortcut Icon" type="image/png" href="/webicon.png" />
<link href="rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
<meta http-equiv="MSThemeCompatible" content="Yes">
<style type="text/css">
BODY {
	margin-top:0px;
	margin-left:0px;
	margin-right:0px;
	SCROLLBAR-BASE-COLOR: #4C5844;
	SCROLLBAR-ARROW-COLOR: #969F8E;
}
SELECT {
	FONT-FAMILY: Verdana,Arial,Helvetica,sans-serif;
	FONT-SIZE: 11px;
	COLOR: #D8DED3;
	BACKGROUND-COLOR: #3E4637
}
TEXTAREA, .bginput {
	FONT-SIZE: 12px;
	FONT-FAMILY: Verdana,Arial,Helvetica,sans-serif;
	COLOR: #D8DED3;
	BACKGROUND-COLOR: #3E4637
}
A:link, A:visited, A:active {
	COLOR: #D8DED3;
}
A:hover {
	COLOR: #FFFFFF;
}
#cat A:link, #cat A:visited, #cat A:active {
	COLOR: #C4B550;
	TEXT-DECORATION: none;
}
#cat A:hover {
	COLOR: #C4B550;
	TEXT-DECORATION: underline;
}
#ltlink A:link, #ltlink A:visited, #ltlink A:active {
	COLOR: #D8DED3;
	TEXT-DECORATION: none;
}
#ltlink A:hover {
	COLOR: #FFFFFF;
	TEXT-DECORATION: underline;
}
.thtcolor {
	COLOR: #D8DED3;
}
.spoiler {COLOR: black; TEXT-DECORATION: none; background-color: black; font-weight: normal;}
</style>


</head>
<body bgcolor="#4C5844" text="#A0AA95" id="all" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000020" vlink="#000020" alink="#000020">
<!-- header -->

<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>

<!-- logo and buttons -->
<center>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td nowrap bgcolor="#000000">
	<a href="/"><img src="/forums/images/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152" border="0"></a>&nbsp;
	</td>
	<td width="100%" height="54" valign="bottom" align="left" bgcolor="#000000">
	<span style="margin-left:64px;position:absolute;top:32px;">
	<a href="/?area=news"><img name="news" valign="bottom" height="22" width="54" src="/forums/images/news.gif" border="0" 
		onMouseOut="this.src='/forums/images/news.gif';" onMouseOver="this.src='/forums/images/MOnews.gif';" 
		alt="news"></a>

	<a href="/?area=getsteamnow"><img valign="bottom" height="22" width="108" src="/forums/images/getSteamNow.gif" border="0" 
		onMouseOut="this.src='/forums/images/getSteamNow.gif'" onMouseOver="this.src='/forums/images/MOgetSteamNow.gif'" 
		alt="getSteamNow"></a>

	<a href="/?area=cybercafes"><img valign="bottom" height="22" width="95" src="/forums/images/cafes.gif" border="0"
		onMouseOut="this.src='/forums/images/cafes.gif'" onMouseOver="this.src='/forums/images/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="/support.php"><img valign="bottom" height="22" width="68" src="/forums/images/support.gif" border="0" 
		onMouseOut="this.src='/forums/images/support.gif'" onMouseOver="this.src='/forums/images/MOsupport.gif'" 
		alt="Support"></a>

	<a href="/?area=forums"><img valign="bottom" height="22" width="68" src="/forums/images/forums.gif" border="0" 
		onMouseOut="this.src='/forums/images/forums.gif'" onMouseOver="this.src='/forums/images/MOforums.gif'" 
		alt="Forums"></a>

	<a href="/status/status.html"><img valign="bottom" height="22" width="65" src="/forums/images/status.gif" border="0" 
		onMouseOut="this.src='/forums/images/status.gif'" onMouseOver="this.src='/forums/images/MOstatus.gif'" 
		alt="Status"></a>
	</span>
	</td>
</tr>
<tr height="10">
	<td colspan="2" valign="top" align="left" height="10"></td>
</tr>
<tr>
	<td colspan="2" valign="top" align="left">

		<div align="center">
		<a href="usercp.php"><img src="images/top_profile.gif" alt="Here you can view your subscribed threads, work with private messages and edit your profile and preferences" border="0" width="53" height="25"></a>
		<a href="register.php?action=signup"><img src="images/top_register.gif" alt="Registration is free!" border="0" width="53" height="25"></a> 
		<a href="memberlist.php"><img src="images/top_members.gif" alt="Find other members" border="0" width="53" height="25"></a>
		<a href="misc.php?action=faq"><img src="images/top_faq.gif" alt="Frequently Asked Questions" border="0" width="53" height="25"></a>
		<a href="search.php"><img src="images/top_search.gif" alt="Search" border="0" width="53" height="25"></a>
		<a href="index.php"><img src="images/top_home.gif" alt="Home" border="0" width="53" height="25"></a> &nbsp; </div>
	
	</td>
</tr>
</table>
<!-- /logo and buttons -->

<!-- content table -->
<table bgcolor="#4C5844" width="95%" cellpadding="10" cellspacing="0" border="0">
<tr>
  <td>


<!-- breadcrumb -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td width="100%"><img src="images/vb_bullet.gif" border="0" align="middle" alt="Steam Users Forums : Powered by vBulletin version 2.3.3">
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=d87d8e5a81ec434b00521bfd0189dd69">Steam Users Forums</a> &gt; <a href="search.php?s=d87d8e5a81ec434b00521bfd0189dd69">Search</a></b></font></td>
</tr>
</table>
<!-- /breadcrumb -->

<br>

<form action="search.php" method="post">
<input type="hidden" name="s" value="d87d8e5a81ec434b00521bfd0189dd69">

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" colspan="2"><font face="verdana, arial, helvetica" size="2"  color="#C4B550"><b>
	Steam Users Forums Search Engine
	</b></font></td>
</tr>
<tr>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>Search By Keyword</b></font></td>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>Search By User Name</b></font></td>
</tr>
<tr valign="top">
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1" >
	<br><input type="text" class="bginput" name="query" size="35">
	<br><br>
	<b>Basic query:</b>
	separate your search terms with spaces.<br>
	<br>
	<b>Advanced query:</b>
	Join words with AND, OR and NOT to control your search in more detail.<br>
	Add asterisks (*) to use wild cards in your search
	(<i>*bullet*</i> matches <i>vBulletin</i> etc.)
	</font></td>
	<!-- *** -->
	<td bgcolor="#3E4637"><p><font face="verdana,arial,helvetica" size="1" >
	<br><input type="text" class="bginput" name="searchuser" size="25" maxlength="25">
	<br><br>
	<input type="radio" name="exactname" value="yes" checked> Match exact name<br>
	<input type="radio" name="exactname" value="no"> Match partial name
	</font></p></td>
</tr>
</table>
</td></tr></table>

<br>

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" colspan="3"><font face="verdana, arial, helvetica" size="2"  color="#C4B550"><b>
	Search Options
	</b></font></td>
</tr>
<tr>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>Search Forum...</b></font></td>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>Search For Posts From...</b></font></td>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>Sort Results By...</b></font></td>
</tr>
<tr valign="top">
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1" >
	<br><select name="forumchoice">
		<option value="-1">Search All Open Forums</option>
		<option value="13" > Steam Discussions</option><option value="14" >-- General</option><option value="35" >-- VAC</option><option value="17" >-- Community Help and Tips</option><option value="15" >-- Suggestions / Ideas</option><option value="39" >-- Hardware</option><option value="34" >-- Off Topic</option><option value="40" > Source Game Discussions</option><option value="43" >-- Half-Life 2</option><option value="46" >-- Half-Life 2: Deathmatch</option><option value="37" >-- Counter-Strike: Source</option><option value="44" >-- Source DS (Windows)</option><option value="45" >-- Source DS (Linux)</option><option value="41" >-- Source SDK</option><option value="5" > Valve Back Catalog Discussions</option><option value="33" >-- Counter-Strike: Condition Zero</option><option value="7" >-- Counter-Strike</option><option value="20" >-- Half-Life</option><option value="21" >-- Day of Defeat</option><option value="22" >-- Team Fortress Classic</option><option value="23" >-- Deathmatch Classic</option><option value="24" >-- Opposing Force</option><option value="25" >-- Ricochet</option><option value="16" >-- Windows Dedicated Server</option><option value="19" >-- Linux Dedicated Server</option><option value="42" > Cyber Cafe Discussions</option><option value="31" >-- Cyber Caf&eacute; Program - Discussion</option><option value="32" >-- Cyber Caf&eacute; Program - Support</option>
	</select><br><br>
	<table cellpadding="0" cellspacing="0" border="0"><tr>
		<td><font face="verdana,arial,helvetica" size="1" >
		<input type="radio" name="titleonly" value="" checked> Search entire posts&nbsp;<br>
		<input type="radio" name="titleonly" value="yes"> Search titles only&nbsp;
		</font></td>
		<td><font face="verdana,arial,helvetica" size="1" >
		<input type="radio" value="1" name="showposts"> Show results as  posts&nbsp;<br>
		<input type="radio" value="" name="showposts" checked> Show results as threads&nbsp;
		</font></td>
	</tr></table>
	</font></td>
	<!-- *** -->
	<td bgcolor="#3E4637"><p><font face="verdana,arial,helvetica" size="1" >
	<br><select name="searchdate">
		<option value="-1">any date</option>
		<option value="1">yesterday</option>
		<option value="5">a week ago</option>
		<option value="10">2 weeks ago</option>
		<option value="30">a month ago</option>
		<option value="90">3 months ago</option>
		<option value="180">6 months ago</option>
		<option value="365">a year ago</option>
	</select><br><br>
	<input type="radio" name="beforeafter" value="after" checked> and newer<br>
	<input type="radio" name="beforeafter" value="before"> and older</font></p></td>
	<!-- *** -->
	<td bgcolor="#3E4637"><p><font face="verdana,arial,helvetica" size="1" >
	<br><select name="sortby">
		<option value="title">title</option>
		<option value="replies">number of replies</option>
		<option value="views">number of views</option>
		<option value="lastpost" selected>last posting date</option>
		<option value="poster">poster</option>
		<option value="forum">forum</option>
	</select><br><br>
	<input type="radio" name="sortorder" value="ascending"> in ascending order<br>
	<input type="radio" name="sortorder" value="descending" checked> in descending order
	</font></p></td>
</tr>
</table>
</td></tr></table>

<br>

<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td align="center"><font face="verdana, arial, helvetica" size="2" >
	<input type="hidden" name="action" value="simplesearch">
	<input type="submit" class="bginput" name="Submit" value="Perform Search" accesskey="s">
	<input type="reset" class="bginput" name="Reset" value="Reset Fields">
	</font></td>
</tr>
</table>

</form>

<!-- footer -->

  </td>
</tr>
</table>
<!-- /content area table -->
</center>


<table width="802" height="77" border="0" cellspacing="0" cellpadding="0" align="center" cool="" showgridx="" SHOWGRIDY="" GRIDX="16" gridy="16">
<tr height="2">
<td width="802" height="2" colspan="4"></td>
<td width="1" height="2"><spacer type="block" width="1" height="2"></td>
</tr>
<tr height="34">
<td width="356" height="34" colspan="2"></td>
<td width="555" height="34" valign="top" xpos="356"><img src="/img/valve_greenlogo.gif" width="136" height="30" align="center" border="0"></td>
<td width="26" height="74" rowspan="2"></td>
<td width="1" height="34"><spacer type="block" width="1" height="34"></td>
</tr>
</td>
</tr>
<tr height="40">
<td width="24" height="40"></td>
<td width="752" height="40" colspan="2" align="left" xpos="24" content valign="top" csheight="40">
<div align="center">
<p><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"><a href="/">Home</a> | <a href="/index.php?area=news">News</a> | <a href="/getsteamnow.php">Get Steam Now</a> | <a href="/cybercafes.php">Cyber Cafes</a> | <a href="/support.php">Support</a> | <a href="/index.php?area=forums">Forums</a> |&nbsp;<a href="/status/status.html">Status</a><br>
									</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="1">&copy; 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation.</font></p
</div>
</td>
<td width="1" height="40"><spacer type="block" width="1" height="40"></td>
</tr>
<tr height="1" cntrlrow>
<td width="24" height="1"><spacer type="block" width="24" height="1"></td>
<td width="332" height="1"><spacer type="block" width="332" height="1"></td>
<td width="420" height="1"><spacer type="block" width="420" height="1"></td>
<td width="26" height="1"><spacer type="block" width="26" height="1"></td>
<td width="1" height="1"></td>
</tr>
</table>

</body>
</html>