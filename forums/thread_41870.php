<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Bug Finding Help</title>
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
	window.open("member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;forumid=14">General</a> &gt; Bug Finding Help</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (3): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a>  </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;threadid=41870"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post261926"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Erik Johnson</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: <br>
	Posts: 104</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post261926"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Erik Johnson</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br><br>
                <img src="avatar.php?userid=1722&amp;dateline=1092283429" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Bug Finding Help</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >There are a couple of bugs that we're having a bit of trouble tracking down. It would be extremely helpful if someone in the community could help out.<br />
<br />
The bugs are:<br />
<br />
- Players starting the map either stuck in the floor or floating above ground.<br />
- Slow demo recording performance.<br />
- Crash on demo playback, possibly related to +showscores.<br />
<br />
If you'd like to help, record a demo that exhibits one or all of these behaviors and mail it to me at <a href="mailto:erik@valvesoftware.com">erik@valvesoftware.com</a>.<br />
<br />
Thanks.<br />
<br />
Erik</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=261926">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=261926">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-08-2003 <font color="#D8DED3">07:21 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Erik Johnson is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=1722" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Erik Johnson"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=1722"><img src="images/sendpm.gif" border="0" alt="Click here to Send Erik Johnson a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=1722"><img src="images/find.gif" border="0" alt="Find more posts by Erik Johnson"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=1722"><img src="images/buddy.gif" border="0" alt="Add Erik Johnson to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=261926"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=261926"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262086"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262086"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Hello Erik,<br />
<br />
Not sure if this will help you or not, but MiSmith7 has found a temporary solution that seems to help.  It involves a demo fix written by <a href="mailto:Martino@valvesoftware.com">Martino@valvesoftware.com</a> that was dated a little over a year ago.<br />
<br />
This was a fix for 1.5 demos that updated the <b>GameEditor.dll</b> and <b>GameUI.dll</b> in the <b>valve\cl_dlls</b> folder, and the <b>core.dll</b> in the <b>Counter Strike</b> folder.  It was a "viewdemo" fix, or something like that.<br />
<br />
The thread on how to watch demos without them crashing <a href="/forums/showthread.php?s=&amp;threadid=40705" target="_blank">can be found here.</a>  So far, following these steps at least allows us to watch demos without crashing, and also displays the scoreboard correctly.  (since the introduction of 1.6 they've been blank, so this should be a step in the right direction, at least)<br />
<br />
I'll test and see if demos work launched straight from console, but I think they still crash unless you start a listenserver on the map the demo was recorded on.<br />
<br />
But I figured maybe you could revisit these .dll's and figure out a way to combine them into 1.6 and maybe find the solution you're looking for.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by Fragalishus on 12-09-2003 at 12:02 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262086">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262086">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-08-2003 <font color="#D8DED3">11:42 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262086"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262086"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262112"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262112"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Also, as for the players floating in the air... someone in the bug list thread suggested this is caused by custom decals being downloaded to the client.  This makes perfect sense because generally the only time it happens is during the pistol round on a map change (when most decals are downloaded, obviously).  And I would bet money the random times it happens during a round is when a new player has just connected, and his decal is being uploaded.<br />
<br />
So far, the only testing of this theory I can provide is I have had<br />
<br />
cl_allowdownload "0"<br />
cl_download_ingame "0"<br />
cl_allowupload "0"<br />
<br />
set for about a week now, and haven't had it happen at all.<br />
<br />
So that's at least one area to look into for a fix.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262112">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262112">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">12:00 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262112"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262112"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262158"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262158"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Ok, scratch that first post.  On a whim I decided to delete the DemoEditor.dll and GameUI.dll, and replaced the core.dll with the default one.  These have nothing to do with the fix.<br />
<br />
Simply starting a listenserver on the map the demo was recorded on is what allows the scoreboard to display properly and doesn't crash the demo, either.<br />
<br />
So those .dll's had nothing to do with the demos working right.<br />
<br />
-edit- also tried launching demo straight from console via splash screen...and it crashed on first scoreboard viewing.<br />
<br />
starting a listenserver on the map the demo was made on is the key to them not crashing.  so i hope that helps figure out why...</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by Fragalishus on 12-09-2003 at 12:36 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262158">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262158">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">12:30 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262158"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262158"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262324"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[1337]Ph33r</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 559</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262324"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[1337]Ph33r</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >radar not always on even when drawradar "1" in console<br />
<br />
d3d not working and look at my specs i use opengl fine but i like d3d to!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262324">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262324">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">02:07 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[1337]Ph33r is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=24927" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [1337]Ph33r"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=24927"><img src="images/sendpm.gif" border="0" alt="Click here to Send [1337]Ph33r a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=24927"><img src="images/find.gif" border="0" alt="Find more posts by [1337]Ph33r"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=24927"><img src="images/buddy.gif" border="0" alt="Add [1337]Ph33r to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262324"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262324"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262607"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262607"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >dude, read the friggin' topic and the first post.  this isn't a bug list thread.  it's a thread for people to help narrow down <b>the 3 bugs that are listed</b>.  not to post new ones...or rather...very old ones.  use the bug report thread.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by Fragalishus on 12-09-2003 at 04:20 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262607">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262607">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">04:18 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262607"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262607"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262755"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Nebraska, USA<br>
	Posts: 2934</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262755"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Indeed, turns out the viewdemo fix has nothing to do with the problem.  The demos crashing is directly related to the +showscores command.  There are currently 2 methods of fixing this, hex-edit out all the +showscores and replace them with -showscores, or this:<br />
<br />
1) Load up CS from the 'Games' window of STEAM.<br />
<br />
2) Click on "New Server" (listen server) and load up the map the demo you are trying to view was recorded on.<br />
<br />
3) Wait for the server to load, then go into spectator mode.<br />
<br />
4) Bring up the console, and view the demo using the "viewdemo" command.<br />
<br />
Not only does this prevent the crash - it actually shows what the scores were.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262755">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262755">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">06:25 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="MiSmith7 is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=29593" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for MiSmith7"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=29593"><img src="images/sendpm.gif" border="0" alt="Click here to Send MiSmith7 a Private Message"></a>  <!--<a href="http://ass.mismith7-cvn.org" target="_blank"><img src="images/home.gif" alt="Visit MiSmith7's homepage!" border="0"></a>--> <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=29593"><img src="images/find.gif" border="0" alt="Find more posts by MiSmith7"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=29593"><img src="images/buddy.gif" border="0" alt="Add MiSmith7 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262755"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262755"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post262792"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[OCS]Viper</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Portland, Oregon<br>
	Posts: 99</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post262792"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[OCS]Viper</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Erik, your mail server is not being nice!</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Erik,<br />
I just emailed you three times, trying to send you a link to a demo. Your mail server wont accept attachments.<br />
<br />
Your email keeps bouncing back undeliverable, even without the demo.<br />
<br />
PM me and I'll give you my contact information, or anything else I can help with!<br />
And the link to this demo is <a href="http://216.240.145.190/~viper/ocs12.zip" target="_blank">http://216.240.145.190/~viper/ocs12.zip</a><br />
<br />
The beginning of the demo shows a player on the back deck of the militia house, when in fact, he is under the stairway, not on the deck. As I toggled between players and back to him, he was under the stairs where he should have been.<br />
<br />
The beginning of the next round shows the +scoreboard crash as soon as I enter the tunnel from CT spawn.<br />
<br />
 <br />
Thanks</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by [OCS]Viper on 12-09-2003 at 07:04 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=262792">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=262792">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-09-2003 <font color="#D8DED3">07:00 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[OCS]Viper is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=23439" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [OCS]Viper"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=23439"><img src="images/sendpm.gif" border="0" alt="Click here to Send [OCS]Viper a Private Message"></a>  <!--<a href="http://ocsclan.com" target="_blank"><img src="images/home.gif" alt="Visit [OCS]Viper's homepage!" border="0"></a>--> <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=23439"><img src="images/find.gif" border="0" alt="Find more posts by [OCS]Viper"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=23439"><img src="images/buddy.gif" border="0" alt="Add [OCS]Viper to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=262792"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=262792"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post263951"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 346</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post263951"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Erik Johnson, I have reported about the floating/sinking player model issue many times before.  I am almost certain it is because of this:<br />
<br />
Whenever I see a player(s) shoot up in the air or sink in the ground, I check my console.  There will be a message that says:<br />
<br />
"Requesting pldecal.wad file from the server"<br />
<br />
Every time this message appears in the console, floating/sinking player models appear.  EVERY TIME.  I have verified this throughly and many others on the same server, other servers, my friends and people on these forums have verified it before.  This doesn't just happen on pistol rounds/map starts.  It happens anytime the server requests a pldecal.wad file.<br />
<br />
The server requesting pldecal.wads from players is the cause of this issue.  I hope this helps.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=263951">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=263951">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-10-2003 <font color="#D8DED3">12:05 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SteamSoldier is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=25823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SteamSoldier"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=25823"><img src="images/sendpm.gif" border="0" alt="Click here to Send SteamSoldier a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=25823"><img src="images/find.gif" border="0" alt="Find more posts by SteamSoldier"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=25823"><img src="images/buddy.gif" border="0" alt="Add SteamSoldier to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=263951"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=263951"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post265554"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face=wingdings color=gold>J</font></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Outskirts of the Oort Cloud!<br>
	Posts: 4977</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post265554"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face=wingdings color=gold>J</font></font><br><br>
                <img src="avatar.php?userid=17801&amp;dateline=1092283820" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >^^ At first I was skeptical of that, but I validated it the other night.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=265554">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=265554">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-10-2003 <font color="#D8DED3">09:37 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ocarD is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=17801" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ocarD"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=17801"><img src="images/sendpm.gif" border="0" alt="Click here to Send ocarD a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=17801"><img src="images/find.gif" border="0" alt="Find more posts by ocarD"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=17801"><img src="images/buddy.gif" border="0" alt="Add ocarD to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=265554"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=265554"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post266975"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 346</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post266975"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Yes, I am so certain that the server requesting pldecal.wad's is the cause of this issue, that is why I didn't provide any screenshots or demos (which I can easily do).  If anybody thinks I am incorrect or if you are skeptical, see for yourself.  Next time you see your teammate shoot up into the sky, bring down your console.  I am 100% sure there will be a message saying "Requesting pldecal.wad from server".</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=266975">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=266975">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-11-2003 <font color="#D8DED3">12:27 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SteamSoldier is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=25823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SteamSoldier"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=25823"><img src="images/sendpm.gif" border="0" alt="Click here to Send SteamSoldier a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=25823"><img src="images/find.gif" border="0" alt="Find more posts by SteamSoldier"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=25823"><img src="images/buddy.gif" border="0" alt="Add SteamSoldier to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=266975"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=266975"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post267697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: Bellevue,Wa<br>
	Posts: 4406</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post267697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <img src="avatar.php?userid=12457&amp;dateline=1092283792" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Here is a little additional information.<br />
<br />
Last night during a 2x3 match in HLDM everything was fine until the match ended and we changed maps.<br />
<br />
During the first minute or so, one client out of the five of us saw one other player floating in midair.<br />
<br />
The player was moving around, then suddenly fell down and was normal again.<br />
<br />
During this time, the HLTV proxy was recording the entire thing, but when I went back and viewed the recording, there was nothing wrong and all players were on the ground running around like normal.<br />
<br />
This tells me that the player position data the server was sending out was good all the time, and the problem is a client related one only.<br />
<br />
The only client that saw the problem was also the client that was closest to the server, actually on a LAN so there was no internet connection issues at all.<br />
<br />
The rest of us were on Internet.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=267697">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=267697">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-11-2003 <font color="#D8DED3">10:39 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="qUiCkSiLvEr is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=12457" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for qUiCkSiLvEr"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=12457"><img src="images/sendpm.gif" border="0" alt="Click here to Send qUiCkSiLvEr a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=12457"><img src="images/find.gif" border="0" alt="Find more posts by qUiCkSiLvEr"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=12457"><img src="images/buddy.gif" border="0" alt="Add qUiCkSiLvEr to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=267697"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=267697"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post278028"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[OCS]Viper</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Portland, Oregon<br>
	Posts: 99</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278028"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[OCS]Viper</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Erik... any news? This thread is getting buried! Bump!!!!<br />
<br />
If you need any more demo samples, please let us know!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=278028">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=278028">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">01:55 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[OCS]Viper is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=23439" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [OCS]Viper"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=23439"><img src="images/sendpm.gif" border="0" alt="Click here to Send [OCS]Viper a Private Message"></a>  <!--<a href="http://ocsclan.com" target="_blank"><img src="images/home.gif" alt="Visit [OCS]Viper's homepage!" border="0"></a>--> <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=23439"><img src="images/find.gif" border="0" alt="Find more posts by [OCS]Viper"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=23439"><img src="images/buddy.gif" border="0" alt="Add [OCS]Viper to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=278028"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=278028"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post278153"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278153"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >just wondering if it's possible to separate the pldecal wad request into it's own cvar.  so instead of turning off allowing all downloads we could simply turn off decal downloading.  like<br />
<br />
cl_decaldownload "0"<br />
<br />
or something.  i know a large percentage of people could care less about seeing others decals, but would still be able to get maps and sounds, etc from the server.<br />
<br />
this would at least eliminate this bug.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=278153">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=278153">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">04:19 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=278153"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=278153"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post278373"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>pkb17cs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 2</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278373"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>pkb17cs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Hi Erik,<br />
<br />
I too have the same problem with demo playback. Only mine is varied slightly. about 4 days ago i could play demos. I even record some clips out of them for my cs movie. But recently I keep getting the crash problem. I took note that it only happened when +showscores was hit in the demo. Good lucky on fixing the glitch<br />
<br />
-clue</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;postid=278373">Report this post to a moderator</a> | IP: <a href="postings.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getip&amp;postid=278373">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">06:11 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="pkb17cs is offline" align="absmiddle">
			<a href="member.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=getinfo&amp;userid=31590" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for pkb17cs"></a> <a href="private.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newmessage&amp;userid=31590"><img src="images/sendpm.gif" border="0" alt="Click here to Send pkb17cs a Private Message"></a>   <a href="search.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=finduser&amp;userid=31590"><img src="images/find.gif" border="0" alt="Find more posts by pkb17cs"></a> <a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addlist&amp;userlist=buddy&amp;userid=31590"><img src="images/buddy.gif" border="0" alt="Add pkb17cs to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=editpost&amp;postid=278373"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;postid=278373"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 10:19 AM.</b></font></td>
		<td><a href="newthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=newreply&amp;threadid=41870"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (3): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a>  </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;threadid=41870">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=addsubscription&amp;threadid=41870">Subscribe to this Thread</a>
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
	<td align="right">&nbsp;</td>
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
		<a href="misc.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=882e139ffc20d58fddc2c5e5bcd8d0f2&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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