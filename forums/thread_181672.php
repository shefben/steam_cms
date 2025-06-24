<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Hl2 crashes, my fix</title>
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
	window.open("member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=d0a3df57e5e7408b7711965ef0ebb5f1">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;forumid=17">Community Help and Tips</a> &gt; Hl2 crashes, my fix</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" > &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;threadid=181672"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post1570007"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Tu17</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: <br>
	Posts: 10</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1570007"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Tu17</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Hl2 crash ---FIX---</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >hello,<br />
i  like many of you had hl2 crashing to desktop when i tried to load it, but when i was looking for a solution i came across something at another forum, and here it is. <br />
<br />
Originally Posted by fireflaie<br />
Hi all <br />
Here is the translation of a solution to have the game working !!<br />
<br />
Part 1 :<br />
--------------<br />
Go in the directory :<br />
E:\Valve\Steam\SteamApps\STEAM _ACCOUNT_NAME\half-life 2<br />
there is a directory named "bin" that contains many .dll etc<br />
<br />
Part 2 :<br />
--------------<br />
Enter the "bin" directory and copy all the files (ctrl+A, ctrl+C)<br />
<br />
go back at E:\Valve\Steam\SteamApps\STEAM _ACCOUNT_NAME\half-life 2<br />
then paste the files here (Ctrl+V)<br />
<br />
Part 3 :<br />
--------------<br />
Select all the files and directorys (EXCEPT THE "BIN" DIRECTORY) in <br />
<br />
E:\Valve\Steam\SteamApps\STEAM _ACCOUNT_NAME\half-life 2 <br />
<br />
Copy it !!!<br />
<br />
Part 4 :<br />
--------------<br />
No Go back in the "bin" directory then Paste the files and dir you've just copy<br />
if windows tell you that there is files that have the same name so just overwrite it, as you want that's not seams to be a problem if you don't<br />
<br />
Part 5 :<br />
--------------<br />
Quit Steam<br />
=&gt; Reload Steam, right click : Games, right click on Half-Life 2 and Launch the game <br />
Enjoy if that works , sorry if that don't <br />
<br />
This worked perfectly for me, and i hope it does for you guys too !</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by Tu17 on 11-22-2004 at 08:54 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;postid=1570007">Report this post to a moderator</a> | IP: <a href="postings.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getip&amp;postid=1570007">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-20-2004 <font color="#D8DED3">11:36 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Tu17 is offline" align="absmiddle">
			<a href="member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getinfo&amp;userid=154500" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Tu17"></a> <a href="private.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newmessage&amp;userid=154500"><img src="images/sendpm.gif" border="0" alt="Click here to Send Tu17 a Private Message"></a>   <a href="search.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=finduser&amp;userid=154500"><img src="images/find.gif" border="0" alt="Find more posts by Tu17"></a> <a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addlist&amp;userlist=buddy&amp;userid=154500"><img src="images/buddy.gif" border="0" alt="Add Tu17 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=editpost&amp;postid=1570007"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;postid=1570007"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1570726"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Saiyaman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 11</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1570726"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Saiyaman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >you are my hero. the steam fix didnt work but this sure did.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;postid=1570726">Report this post to a moderator</a> | IP: <a href="postings.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getip&amp;postid=1570726">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-21-2004 <font color="#D8DED3">12:33 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Saiyaman is offline" align="absmiddle">
			<a href="member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getinfo&amp;userid=16936" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Saiyaman"></a> <a href="private.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newmessage&amp;userid=16936"><img src="images/sendpm.gif" border="0" alt="Click here to Send Saiyaman a Private Message"></a>  <!--<a href="http://www.tksdigiworld.com" target="_blank"><img src="images/home.gif" alt="Visit Saiyaman's homepage!" border="0"></a>--> <a href="search.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=finduser&amp;userid=16936"><img src="images/find.gif" border="0" alt="Find more posts by Saiyaman"></a> <a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addlist&amp;userlist=buddy&amp;userid=16936"><img src="images/buddy.gif" border="0" alt="Add Saiyaman to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=editpost&amp;postid=1570726"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;postid=1570726"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1570760"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>KrAzY_Kyle</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">«</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: <br>
	Posts: 80</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1570760"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>KrAzY_Kyle</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">«</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Thanks for the advice, was able to help a friend out.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;postid=1570760">Report this post to a moderator</a> | IP: <a href="postings.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getip&amp;postid=1570760">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-21-2004 <font color="#D8DED3">12:35 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="KrAzY_Kyle is offline" align="absmiddle">
			<a href="member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getinfo&amp;userid=48405" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for KrAzY_Kyle"></a> <a href="private.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newmessage&amp;userid=48405"><img src="images/sendpm.gif" border="0" alt="Click here to Send KrAzY_Kyle a Private Message"></a>   <a href="search.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=finduser&amp;userid=48405"><img src="images/find.gif" border="0" alt="Find more posts by KrAzY_Kyle"></a> <a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addlist&amp;userlist=buddy&amp;userid=48405"><img src="images/buddy.gif" border="0" alt="Add KrAzY_Kyle to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=editpost&amp;postid=1570760"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;postid=1570760"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1595504"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Tu17</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: <br>
	Posts: 10</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1595504"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Tu17</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Your Welcome</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Heh i thought it would help some people.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;postid=1595504">Report this post to a moderator</a> | IP: <a href="postings.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getip&amp;postid=1595504">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-22-2004 <font color="#D8DED3">08:52 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Tu17 is offline" align="absmiddle">
			<a href="member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getinfo&amp;userid=154500" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Tu17"></a> <a href="private.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newmessage&amp;userid=154500"><img src="images/sendpm.gif" border="0" alt="Click here to Send Tu17 a Private Message"></a>   <a href="search.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=finduser&amp;userid=154500"><img src="images/find.gif" border="0" alt="Find more posts by Tu17"></a> <a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addlist&amp;userlist=buddy&amp;userid=154500"><img src="images/buddy.gif" border="0" alt="Add Tu17 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=editpost&amp;postid=1595504"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;postid=1595504"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1605381"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>poison_994</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: <br>
	Posts: 1</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1605381"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>poison_994</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>It fixed mine</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Hey mate thanks for postin that info as it has fixed hl2 but csc still wont play but hey thanks man<br />
<br />
Poison<br />
 Perth WA  Aust</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;postid=1605381">Report this post to a moderator</a> | IP: <a href="postings.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getip&amp;postid=1605381">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">11:50 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="poison_994 is offline" align="absmiddle">
			<a href="member.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=getinfo&amp;userid=158988" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for poison_994"></a> <a href="private.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newmessage&amp;userid=158988"><img src="images/sendpm.gif" border="0" alt="Click here to Send poison_994 a Private Message"></a>   <a href="search.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=finduser&amp;userid=158988"><img src="images/find.gif" border="0" alt="Find more posts by poison_994"></a> <a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addlist&amp;userlist=buddy&amp;userid=158988"><img src="images/buddy.gif" border="0" alt="Add poison_994 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=editpost&amp;postid=1605381"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;postid=1605381"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 05:40 PM.</b></font></td>
		<td><a href="newthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=newreply&amp;threadid=181672"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;threadid=181672">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=addsubscription&amp;threadid=181672">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="d0a3df57e5e7408b7711965ef0ebb5f1">
	<input type="hidden" name="threadid" value="181672">
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
		<a href="misc.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=d0a3df57e5e7408b7711965ef0ebb5f1&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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