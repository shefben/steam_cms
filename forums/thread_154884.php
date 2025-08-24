<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - CVARs, tweaks, etc. for CS:S</title>
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


<script language="javascript" type="text/javascript">
<!--
function aimwindow(aimid) {
	window.open("member.php?s=0f82ae65372aad269af3dc79be5a21d5&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


}
// -->
</script>
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
	<a href="/index.php"><img src="/img/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152" border="0"></a>&nbsp;
	</td>
	<td width="100%" height="54" valign="bottom" align="left" bgcolor="#000000">
	<span style="margin-left:64px;position:absolute;top:32px;">
	<a href="/index.php?area=news"><img name="news" valign="bottom" height="22" width="54" src="/img/news.gif" border="0" 
		onMouseOut="this.src='/img/news.gif';" onMouseOver="this.src='/img/MOnews.gif';" 
		alt="news"></a>

	<a href="/index.php?area=getsteamnow"><img valign="bottom" height="22" width="108" src="/img/getSteamNow.gif" border="0" 
		onMouseOut="this.src='/img/getSteamNow.gif'" onMouseOver="this.src='/img/MOgetSteamNow.gif'" 
		alt="getSteamNow"></a>

	<a href="/index.php?area=cybercafes"><img valign="bottom" height="22" width="95" src="/img/cafes.gif" border="0"
		onMouseOut="this.src='/img/cafes.gif'" onMouseOver="this.src='/img/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="/support.php"><img valign="bottom" height="22" width="68" src="/img/support.gif" border="0" 
		onMouseOut="this.src='/img/support.gif'" onMouseOver="this.src='/img/MOsupport.gif'" 
		alt="Support"></a>

	<a href="/index.php?area=forums"><img valign="bottom" height="22" width="68" src="/img/forums.gif" border="0" 
		onMouseOut="this.src='/img/forums.gif'" onMouseOver="this.src='/img/MOforums.gif'" 
		alt="Forums"></a>

	<a href="/status/status.html"><img valign="bottom" height="22" width="65" src="/img/status.gif" border="0" 
		onMouseOut="this.src='/img/status.gif'" onMouseOver="this.src='/img/MOstatus.gif'" 
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


<!-- breadcrumb, nav links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><img src="images/vb_bullet.gif" border="0" align="middle" alt="Steam Users Forums : Powered by vBulletin version 2.3.3">
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=0f82ae65372aad269af3dc79be5a21d5">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;forumid=40">Source Game Discussions</a> &gt; <a href="forumdisplay.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;forumid=37">Counter-Strike: Source</a> &gt; CVARs, tweaks, etc. for CS:S</b></font></td>
	<td align="right" valign="bottom"><img src="images/5stars.gif" alt="Thread Rating: 99 votes, 4.82 average."></td>
</tr>
</table>
<!-- /breadcrumb, nav links -->

<a name="posttop"></a>

<!-- End content area table (CREATED IN HEADER!!) -->   
	</td>
</tr>
</table>

<!-- spacer -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0">
<tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%">
<!-- /spacer -->



<!-- first unread and next/prev -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><font face="verdana,arial,helvetica" size="1" >Pages (12): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=12" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;goto=nextnewest">Next Thread</a>
	<img src="images/next.gif" alt="" border="0">
	</font></td>
</tr>
</table>
<!-- first unread and next/prev -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" width="175" nowrap><font face="verdana,arial,helvetica" size="1"  color="#D8DED3" class="thtcolor"><b>Author</b></font></td>
	<td bgcolor="#3E4637" width="100%">
	<!-- Thread nav and post images -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3" class="thtcolor"><b>Thread</b></font></td>
		<td><a href="newthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;threadid=154884"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
	</tr>
	</table>
	<!-- /Thread nav and post images -->
	</td>
</tr>
</table>
</td></tr></table>

<!-- /spacer -->
</td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<!-- /spacer -->

<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284501"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: Canada<br>
	Posts: 469</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284501"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>List of CVARs, CS:S tweaks, etc.</b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><font color="red"><b>CVARs --&gt; Client VARiables</font></b><br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
--&gt; They are the variables that affect how your game is viewed and played. Some CVARs are totally configurable and are free to use. And the others are cheats CVARs, and you can modify them only when cheats are enabled on the server by sv_cheats 1. In this thread, i give you a full list of these commands and useful configurations for them.<br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
--&gt; Right now we have 3 sections:<br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
<font color="orange"><b>Here's a list of all CVARs available in CS:S:</font></b><br />
<a href="http://veal.lurkcorp.com/cvar2.txt" target="_blank">Hosting site <font color="yellow">(v 2.0)</font></a><br />
<a href="http://www.neonblu.com/public/cvar2.txt" target="_blank">Mirror #1 <font color="yellow">(v 2.0)</font></a><br />
<a href="http://www.lawgiver.us/downloads/cvar2.txt" target="_blank">Mirror #2 <font color="yellow">(v 2.0)</font></a><br />
<a href="http://nwgat.net/files/cvar2.txt" target="_blank">Mirror #3 <font color="yellow">(v 2.0)</font></a><br />
<a href="http://www.fraghunter.net/attach/csscvarslist.txt" target="_blank">Mirror #4 <font color="yellow">(v 2.0)</font></a><br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
<font color="orange"><b>To make your CS:S look even better:</font></b><br />
<a href="http://www.neonblu.com/public/cvarmaxgrp.txt" target="_blank">Mirror #1 <font color="yellow">(v 2.5)</font></a><br />
<a href="http://www.lawgiver.us/downloads/cvarmaxgrp.txt" target="_blank">Mirror #2 <font color="yellow">(v 2.5)</font></a><br />
<a href="http://nwgat.net/files/cvarmaxgrp.txt" target="_blank">Mirror #3 <font color="yellow">(v 2.5)</font></a><br />
<a href="http://www.fraghunter.net/attach/cvarmaxgrp.txt" target="_blank">Mirror #4 <font color="yellow">(v 2.5)</font></a><br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
<font color="orange"><b>Useful for gameplay and low fps commands:</font></b><br />
<a href="http://www.neonblu.com/public/useful.txt" target="_blank">Mirror #1 <font color="yellow">(v 3.1)</font></a><br />
<a href="http://www.lawgiver.us/downloads/useful.txt" target="_blank">Mirror #2 <font color="yellow">(v 3.1)</font></a><br />
<a href="http://nwgat.net/files/useful.txt" target="_blank">Mirror #3 <font color="yellow">(v 3.1)</font></a><br />
<a href="http://www.fraghunter.net/attach/useful.txt" target="_blank">Mirror #4 <font color="yellow">(v 3.1)</font></a><br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
Use them well!<br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
--&gt; Please rate this thread 5, so it doesn't get deleted. Beleive me, when you know how to use this, it's of a great use.<br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
--&gt; To contact me, PM or email at <font color="red"><a href="mailto:dinisik@hotmail.com">dinisik@hotmail.com</a></font><br />
<font color="blue">------------------------------------------------------------------------------------</font><br />
<font color="yellow"><b>Denis.</font></b></font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by bloody_devil on 11-24-2004 at 09:37 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284501">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284501">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">03:48 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bloody_devil is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=104151" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bloody_devil"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=104151"><img src="images/sendpm.gif" border="0" alt="Click here to Send bloody_devil a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=104151"><img src="images/find.gif" border="0" alt="Find more posts by bloody_devil"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=104151"><img src="images/buddy.gif" border="0" alt="Add bloody_devil to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284501"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284501"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284506"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[Myst]</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: New Zealand<br>
	Posts: 209</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284506"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[Myst]</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284506">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284506">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">03:50 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[Myst] is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=118676" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [Myst]"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=118676"><img src="images/sendpm.gif" border="0" alt="Click here to Send [Myst] a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=118676"><img src="images/find.gif" border="0" alt="Find more posts by [Myst]"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=118676"><img src="images/buddy.gif" border="0" alt="Add [Myst] to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284506"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284506"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284509"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Kn!fe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: <br>
	Posts: 160</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284509"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Kn!fe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Oh nevermind i see it now, thanks <img src="images/smilies/biggrin.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284509">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284509">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">03:50 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Kn!fe is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=133703" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Kn!fe"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=133703"><img src="images/sendpm.gif" border="0" alt="Click here to Send Kn!fe a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=133703"><img src="images/find.gif" border="0" alt="Find more posts by Kn!fe"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=133703"><img src="images/buddy.gif" border="0" alt="Add Kn!fe to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284509"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284509"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284571"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>rnawky</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 147</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284571"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>rnawky</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >SPAM SPAM SPAM</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284571">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284571">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:00 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="rnawky is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=12114" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for rnawky"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=12114"><img src="images/sendpm.gif" border="0" alt="Click here to Send rnawky a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=12114"><img src="images/find.gif" border="0" alt="Find more posts by rnawky"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=12114"><img src="images/buddy.gif" border="0" alt="Add rnawky to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284571"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284571"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284598"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: Canada<br>
	Posts: 469</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284598"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >there we go, it's finished, and please don't spoil this thread by useless posts. thanks</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284598">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284598">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:03 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bloody_devil is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=104151" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bloody_devil"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=104151"><img src="images/sendpm.gif" border="0" alt="Click here to Send bloody_devil a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=104151"><img src="images/find.gif" border="0" alt="Find more posts by bloody_devil"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=104151"><img src="images/buddy.gif" border="0" alt="Add bloody_devil to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284598"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284598"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284665"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 165</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284665"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >there's a lot missing actually</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284665">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284665">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:15 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="BakeSnake is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=115439" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for BakeSnake"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=115439"><img src="images/sendpm.gif" border="0" alt="Click here to Send BakeSnake a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=115439"><img src="images/find.gif" border="0" alt="Find more posts by BakeSnake"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=115439"><img src="images/buddy.gif" border="0" alt="Add BakeSnake to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284665"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284665"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284672"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: Corona, California, USA<br>
	Posts: 9455</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284672"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br><br>
                <img src="avatar.php?userid=41245&amp;dateline=1092878248" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I'm going to make a cvar.txt for you so this thread dosen't look so cluttered.  <img src="images/smilies/biggrin.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284672">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284672">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:16 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="smash is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=41245" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for smash"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=41245"><img src="images/sendpm.gif" border="0" alt="Click here to Send smash a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=41245"><img src="images/find.gif" border="0" alt="Find more posts by smash"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=41245"><img src="images/buddy.gif" border="0" alt="Add smash to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284672"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284672"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284686"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: Canada<br>
	Posts: 469</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284686"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >ill go through it, if i missed much stuff, ill add it</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284686">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284686">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:18 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bloody_devil is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=104151" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bloody_devil"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=104151"><img src="images/sendpm.gif" border="0" alt="Click here to Send bloody_devil a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=104151"><img src="images/find.gif" border="0" alt="Find more posts by bloody_devil"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=104151"><img src="images/buddy.gif" border="0" alt="Add bloody_devil to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284686"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284686"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 165</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >net_graph stuff, all the cl_ stuff. theres a lot. if console logging worked we could all make our own list, but it doesn't <img src="images/smilies/frown.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284697">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284697">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:20 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="BakeSnake is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=115439" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for BakeSnake"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=115439"><img src="images/sendpm.gif" border="0" alt="Click here to Send BakeSnake a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=115439"><img src="images/find.gif" border="0" alt="Find more posts by BakeSnake"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=115439"><img src="images/buddy.gif" border="0" alt="Add BakeSnake to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284697"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284697"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284704"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: Canada<br>
	Posts: 469</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284704"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >you're right... ill get it don't worry</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284704">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284704">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:22 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bloody_devil is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=104151" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bloody_devil"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=104151"><img src="images/sendpm.gif" border="0" alt="Click here to Send bloody_devil a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=104151"><img src="images/find.gif" border="0" alt="Find more posts by bloody_devil"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=104151"><img src="images/buddy.gif" border="0" alt="Add bloody_devil to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284704"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284704"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284716"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ChaosKnight</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004<br>
	Location: <br>
	Posts: 1252</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284716"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ChaosKnight</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >just so other people know, type cvarlist in console to get a list of all cvars (unless theres some super secret evil waldoh4ked ones <img src="images/smilies/wink.gif" border="0" alt="">)</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284716">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284716">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:24 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ChaosKnight is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=92810" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ChaosKnight"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=92810"><img src="images/sendpm.gif" border="0" alt="Click here to Send ChaosKnight a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=92810"><img src="images/find.gif" border="0" alt="Find more posts by ChaosKnight"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=92810"><img src="images/buddy.gif" border="0" alt="Add ChaosKnight to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284716"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284716"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284719"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 165</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284719"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BakeSnake</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >if u want to email it all to me, i can alphabetize it all and email it back to u (i wrote a php alphabetizer script) PM me for my email addy<br />
<br />
chaos: but the console buffer is too small to hold them all, and console logging is broken</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by BakeSnake on 10-11-2004 at 04:26 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284719">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284719">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:24 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="BakeSnake is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=115439" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for BakeSnake"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=115439"><img src="images/sendpm.gif" border="0" alt="Click here to Send BakeSnake a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=115439"><img src="images/find.gif" border="0" alt="Find more posts by BakeSnake"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=115439"><img src="images/buddy.gif" border="0" alt="Add BakeSnake to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284719"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284719"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284729"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: Corona, California, USA<br>
	Posts: 9455</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284729"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br><br>
                <img src="avatar.php?userid=41245&amp;dateline=1092878248" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><b>Bloody_devil</b> - I put the .txt in your first post.<br />
<br />
If you add more, post here and then I will add it to the .txt and then I will remove the post.<br />
<br />
Also, is it ok if I remove the privious posts you made full of CVAR's?  They're in the .txt right now.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284729">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284729">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:26 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="smash is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=41245" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for smash"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=41245"><img src="images/sendpm.gif" border="0" alt="Click here to Send smash a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=41245"><img src="images/find.gif" border="0" alt="Find more posts by smash"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=41245"><img src="images/buddy.gif" border="0" alt="Add smash to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284729"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284729"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284746"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: Canada<br>
	Posts: 469</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284746"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bloody_devil</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >rofl, you bastard didn't even alphabatise them!! :P<br />
of course you can delete those</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284746">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284746">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:28 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bloody_devil is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=104151" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bloody_devil"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=104151"><img src="images/sendpm.gif" border="0" alt="Click here to Send bloody_devil a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=104151"><img src="images/find.gif" border="0" alt="Find more posts by bloody_devil"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=104151"><img src="images/buddy.gif" border="0" alt="Add bloody_devil to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284746"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284746"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284751"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: Corona, California, USA<br>
	Posts: 9455</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1284751"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br><br>
                <img src="avatar.php?userid=41245&amp;dateline=1092878248" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by bloody_devil </i><br />
<b>rofl, you bastard didn't even alphabatise them!! :P<br />
of course you can delete those </b><hr></blockquote> <br />
<br />
I just copied em from your posts...  <img src="images/smilies/frown.gif" border="0" alt=""><br />
<br />
But I think I missed a post.  <img src="images/smilies/biggrin.gif" border="0" alt="">  Hold on...</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;postid=1284751">Report this post to a moderator</a> | IP: <a href="postings.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getip&amp;postid=1284751">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-11-2004 <font color="#D8DED3">04:29 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="smash is offline" align="absmiddle">
			<a href="member.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=getinfo&amp;userid=41245" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for smash"></a> <a href="private.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newmessage&amp;userid=41245"><img src="images/sendpm.gif" border="0" alt="Click here to Send smash a Private Message"></a>   <a href="search.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=finduser&amp;userid=41245"><img src="images/find.gif" border="0" alt="Find more posts by smash"></a> <a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addlist&amp;userlist=buddy&amp;userid=41245"><img src="images/buddy.gif" border="0" alt="Add smash to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=editpost&amp;postid=1284751"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;postid=1284751"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>


<!-- spacer -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0">
<tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%">
<!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" width="100%">
	<!-- time zone and post buttons -->
	<table border="0" cellspacing="0" cellpadding="0" bgcolor="#3E4637">
	<tr>
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 10:57 AM.</b></font></td>
		<td><a href="newthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=newreply&amp;threadid=154884"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
	</tr>
	</table>
	<!-- /time zone and post buttons -->
	</td>
</tr>
</table>
</td></tr></table>

<!-- first unread and next/prev -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><font face="verdana,arial,helvetica" size="1" >Pages (12): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;perpage=15&amp;pagenumber=12" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884&amp;goto=nextnewest">Next Thread</a>
	<img src="images/next.gif" alt="" border="0">
	</font></td>
</tr>
</table>
<!-- first unread and next/prev -->

<!-- /spacer -->
</td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<!-- /spacer -->

<!-- restart content table from header -->
<table cellpadding="10" cellspacing="0" border="0" width="800" bgcolor="#4C5844" align="center">
<tr>
    <td>

<!-- thread options links -->
<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"   align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" align="center"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/printer.gif" alt="" border="0" align="absmiddle">
	<a href="printthread.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;threadid=154884">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=addsubscription&amp;threadid=154884">Subscribe to this Thread</a>
	</font></td>
</tr>
</table>
</td></tr></table>
<!-- /thread options links -->
	
<br>

<!-- forum jump and rate thread -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td></td>
	<td align="right"><table cellpadding="0" cellspacing="0" border="0">
<form action="threadrate.php" method="get"><tr><td>
	<font face="verdana,arial,helvetica" size="1" >
	<input type="hidden" name="s" value="0f82ae65372aad269af3dc79be5a21d5">
	<input type="hidden" name="threadid" value="154884">
	<b>Rate This Thread:</b><br>
	<select name="vote">
		<option value="-1" selected>Select a rating...</option>
		<option value="5">5 .. Best</option>
		<option value="4">4</option>
		<option value="3">3 .. Average</option>
		<option value="2">2</option>
		<option value="1">1 .. Worst</option>
	</select><!-- go button -->
<input type="image" src="images/go.gif" border="0" 
align="absbottom">
	</font>
</td></tr></form>
</table></td>
</tr>
</table>
<!-- /Rate this thread -->

<br>

<!-- forum rules and admin links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr valign="bottom">
	<td><font face="verdana,arial,helvetica" size="1" ><b>Forum Rules:</b><table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"><tr><td>
<table cellpadding="4" cellspacing="1" border="0">
<tr>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1" >
		You <b>may not</b> post new threads<br>
		You <b>may not</b> post replies<br>
		You <b>may not</b> post attachments<br>
		You <b>may not</b> edit your posts
	</font></td>
	<td bgcolor="#3E4637"><font face="verdana,arial,helvetica" size="1" >
		HTML code is <b>OFF</b><br>
		<a href="misc.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=0f82ae65372aad269af3dc79be5a21d5&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
	</font></td>
</tr>
</table>
</td></tr></table></font></td>
	<td align="right">
	&nbsp;
	</td>
</tr>
</table>
<!-- /forum rules and admin links -->

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
<td width="555" height="34" valign="top" xpos="356"><img src="../img/valve_greenlogo.gif" width="136" height="30" align="center" border="0"></td>
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