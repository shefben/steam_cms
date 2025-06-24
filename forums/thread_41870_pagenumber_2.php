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
	window.open("member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=faa56b9e5bc05568aeb1122a39fdbfa6">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;forumid=14">General</a> &gt; Bug Finding Help</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (3): <b>   <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=1" title="previous page">&laquo;</a>   <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=1">1</a>  <font size="2">[2]</font>  <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3" title="next page">&raquo;</a>  </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;threadid=41870"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post279576"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Master_America</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: Durham, CA<br>
	Posts: 1045</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post279576"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Master_America</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Fragalishus </i><br />
<b>just wondering if it's possible to separate the pldecal wad request into it's own cvar.  so instead of turning off allowing all downloads we could simply turn off decal downloading.  like<br />
<br />
cl_decaldownload "0"<br />
<br />
or something.  i know a large percentage of people could care less about seeing others decals, but would still be able to get maps and sounds, etc from the server.<br />
<br />
this would at least eliminate this bug. </b><hr></blockquote> <br />
<br />
The cvar is cl_download_ingame. It's 1 by default. It was already posted on the first page.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=279576">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=279576">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-19-2003 <font color="#D8DED3">06:37 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Master_America is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=3821" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Master_America"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=3821"><img src="images/sendpm.gif" border="0" alt="Click here to Send Master_America a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=3821"><img src="images/find.gif" border="0" alt="Find more posts by Master_America"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=3821"><img src="images/buddy.gif" border="0" alt="Add Master_America to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=279576"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=279576"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post279626"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>raxzore</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 28</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post279626"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>raxzore</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Maybe you can compare with TFC and see the differans in the source code and fix it</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=279626">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=279626">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-19-2003 <font color="#D8DED3">07:45 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="raxzore is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=30325" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for raxzore"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=30325"><img src="images/sendpm.gif" border="0" alt="Click here to Send raxzore a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=30325"><img src="images/find.gif" border="0" alt="Find more posts by raxzore"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=30325"><img src="images/buddy.gif" border="0" alt="Add raxzore to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=279626"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=279626"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post280405"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 613</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post280405"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Fragalishus</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Master_America </i><br />
<b>The cvar is cl_download_ingame. It's 1 by default. It was already posted on the first page. </b><hr></blockquote> <br />
<br />
and did you read who posted it?<br />
<br />
i'm not entirely sure that has solely to do with decals.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=280405">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=280405">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-19-2003 <font color="#D8DED3">10:52 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Fragalishus is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=11883" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Fragalishus"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=11883"><img src="images/sendpm.gif" border="0" alt="Click here to Send Fragalishus a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=11883"><img src="images/find.gif" border="0" alt="Find more posts by Fragalishus"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=11883"><img src="images/buddy.gif" border="0" alt="Add Fragalishus to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=280405"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=280405"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post280684"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Glatcher</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: <br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post280684"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Glatcher</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >yea i have the players stuck in the ground or in mid-air.  But it usually doesnt happen at the start of a map it happens during the middle of the map.  usually i fix this by looking away from all players for a few seconds then it seems to be fixed.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=280684">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=280684">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-20-2003 <font color="#D8DED3">02:11 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Glatcher is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=48253" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Glatcher"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=48253"><img src="images/sendpm.gif" border="0" alt="Click here to Send Glatcher a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=48253"><img src="images/find.gif" border="0" alt="Find more posts by Glatcher"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=48253"><img src="images/buddy.gif" border="0" alt="Add Glatcher to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=280684"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=280684"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post307506"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Gr1mRe4pEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 145</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post307506"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Gr1mRe4pEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >One thing I noticed is that I have never seen the floating model bug on an insecure server, but then again it may just be luck.  Since alot of people have narrowed this problem to the downloading of custom spray decals, im thinking that the download of the pldecal.wad  may be triggering, in part,  the security modules anti-wall hack.  On the other hand, I may have seen this problem before the awhack was installed back in 1.4.  Im sure I never seen the problem in cs 1.3.  <br />
<br />
A 2nd possibility is the use of colour custom sprays which are generally larger in size then the defaults.  <br />
<br />
A 3rd possibility is that the download of decals is somehow interfering with the clients model interpolation.  A mod called "Laser Mod" confirmed for me that the interpolation of visible models was causing the model to delay behind where the server tells the client where the player is. This laser mod enabled a laser showing exactly what a player was looking at while you were dead.  The laser would always lead the model, but was more accurate with a lower ex_interp value.  I noticed that the 1st person camera locks onto the interpolated model and not the exact positional data recieved from the server. 1st person is also affected by this floating models bug.  <br />
<br />
Whatever the problem is, it has to be client side as random people are affected at different times.<br />
<br />
<br />
As for the slow demo recording performance,  I have so far managed to narrow the problem to people using 33MHz hard-drives/hard-drive cables.  So maybe the recording process is sending alot more data then is required, using excessive processor power thus causing the drop in performance while recording.  Again this could be luck, but its a working theory for now.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=307506">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=307506">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	01-09-2004 <font color="#D8DED3">09:01 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Gr1mRe4pEr is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=11872" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Gr1mRe4pEr"></a>    <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=11872"><img src="images/find.gif" border="0" alt="Find more posts by Gr1mRe4pEr"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=11872"><img src="images/buddy.gif" border="0" alt="Add Gr1mRe4pEr to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=307506"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=307506"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post321536"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RedTiger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: NC<br>
	Posts: 279</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post321536"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RedTiger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >lol..the demo crash is from 1.6 demos before that update the week they started..i forgot which update but, after that update previous 1.6 demos always crash upon the point where the person or w/e hits scoreboard (+showscores)~<br />
<br />
it never occurs on demos after that update<br />
<br />
the simple fix which was known fairly common (so easy that someone made a 'utility' to get credit for fixing everyone's problem, for the 'computer' illiterate ppl i guess)..the workaround, not really a fix, was to change all the +showscores to -showscores -- so therefore +showscore never occurs during the demo (hence no crash) -- this of course was done using a hexeditor and Find&amp;replace ^^<br />
<br />
(way to drag stuff out of proportion guys..)<br />
<br />
as for the others, neva experienced those bugs (i don't pub too much)</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=321536">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=321536">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	01-17-2004 <font color="#D8DED3">11:28 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="RedTiger is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=43159" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for RedTiger"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=43159"><img src="images/sendpm.gif" border="0" alt="Click here to Send RedTiger a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=43159"><img src="images/find.gif" border="0" alt="Find more posts by RedTiger"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=43159"><img src="images/buddy.gif" border="0" alt="Add RedTiger to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=321536"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=321536"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post321538"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RedTiger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: NC<br>
	Posts: 279</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post321538"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RedTiger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i forgot to mention, i have allowupload and dl set to 0, so maybe that's why...but y would the uploading affect anything (of a pldecal) unless maybe its a custom decal :o<br />
<br />
i think uh, custom decals are fishy nowadays aren't they...?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=321538">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=321538">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	01-17-2004 <font color="#D8DED3">11:31 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="RedTiger is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=43159" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for RedTiger"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=43159"><img src="images/sendpm.gif" border="0" alt="Click here to Send RedTiger a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=43159"><img src="images/find.gif" border="0" alt="Find more posts by RedTiger"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=43159"><img src="images/buddy.gif" border="0" alt="Add RedTiger to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=321538"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=321538"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post333918"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pauly</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: Ohio<br>
	Posts: 1616</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post333918"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pauly</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I dont know much but it seems to only  happen at the beginning of the round(usually on counter-strike)  and they dont notice it...and it is only noticable to you.  No one else seems to notice.  And it dosent appear as much as it did when steam first came out.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=333918">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=333918">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	01-24-2004 <font color="#D8DED3">01:01 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Pauly is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=59184" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Pauly"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=59184"><img src="images/sendpm.gif" border="0" alt="Click here to Send Pauly a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=59184"><img src="images/find.gif" border="0" alt="Find more posts by Pauly"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=59184"><img src="images/buddy.gif" border="0" alt="Add Pauly to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=333918"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=333918"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post338137"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>twal</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: <br>
	Posts: 152</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post338137"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>twal</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >jap</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=338137">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=338137">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	01-25-2004 <font color="#D8DED3">11:46 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="twal is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=52182" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for twal"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=52182"><img src="images/sendpm.gif" border="0" alt="Click here to Send twal a Private Message"></a>  <!--<a href="http://www.twal.de" target="_blank"><img src="images/home.gif" alt="Visit twal's homepage!" border="0"></a>--> <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=52182"><img src="images/find.gif" border="0" alt="Find more posts by twal"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=52182"><img src="images/buddy.gif" border="0" alt="Add twal to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=338137"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=338137"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post354067"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Venom6</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: bite me<br>
	Posts: 13</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post354067"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Venom6</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >wen i watching a demo it hapens somethimes that ct player have the skin of terror and the HEgranade is a smokegranate<br />
<br />
and wen i play cs and dod, some players are invisible (cant se them ) when they are front of me its lame its like walking and than i cant go anny furder like i going in a invisible wall and gett killet <br />
some thimes i can se all walking in the sky <br />
i have readed an article that if you se people walking in the sky<br />
it means that one player are trying to hack the server or have turned the cheats on ...<br />
thanks</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=354067">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=354067">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	02-03-2004 <font color="#D8DED3">12:48 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Venom6 is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=56737" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Venom6"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=56737"><img src="images/sendpm.gif" border="0" alt="Click here to Send Venom6 a Private Message"></a>  <!--<a href="http://www.cheats2000.tk" target="_blank"><img src="images/home.gif" alt="Visit Venom6's homepage!" border="0"></a>--> <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=56737"><img src="images/find.gif" border="0" alt="Find more posts by Venom6"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=56737"><img src="images/buddy.gif" border="0" alt="Add Venom6 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=354067"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=354067"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post375109"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EndYmioN</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004<br>
	Location: Europe, Sweden<br>
	Posts: 311</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post375109"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EndYmioN</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I get the scoreboard in viewdemo... maybe i'm just lucky?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=375109">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=375109">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	02-15-2004 <font color="#D8DED3">05:53 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="EndYmioN is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=63499" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for EndYmioN"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=63499"><img src="images/sendpm.gif" border="0" alt="Click here to Send EndYmioN a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=63499"><img src="images/find.gif" border="0" alt="Find more posts by EndYmioN"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=63499"><img src="images/buddy.gif" border="0" alt="Add EndYmioN to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=375109"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=375109"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post377017"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>vippor</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: omnipresent                  Status: 1337 haxor<br>
	Posts: 166</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post377017"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>vippor</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Start a server with the same map as the demo before you play back the demo and the showscores will work..?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=377017">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=377017">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	02-16-2004 <font color="#D8DED3">06:34 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="vippor is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=34956" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for vippor"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=34956"><img src="images/sendpm.gif" border="0" alt="Click here to Send vippor a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=34956"><img src="images/find.gif" border="0" alt="Find more posts by vippor"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=34956"><img src="images/buddy.gif" border="0" alt="Add vippor to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=377017"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=377017"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post385576"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pyro911</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004<br>
	Location: <br>
	Posts: 34</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post385576"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pyro911</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I found a bug with steam, when I login into steam it asks me to put in my cd key. The problem is when I made the account I put in my cd key. Why does it want me to put in my cd key again.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=385576">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=385576">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	02-21-2004 <font color="#D8DED3">07:24 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Pyro911 is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=64907" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Pyro911"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=64907"><img src="images/sendpm.gif" border="0" alt="Click here to Send Pyro911 a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=64907"><img src="images/find.gif" border="0" alt="Find more posts by Pyro911"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=64907"><img src="images/buddy.gif" border="0" alt="Add Pyro911 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=385576"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=385576"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post406291"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>P-Wolf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: Washington, DC<br>
	Posts: 5398</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post406291"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>P-Wolf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by vippor </i><br />
<b>Start a server with the same map as the demo before you play back the demo and the showscores will work..? </b><hr></blockquote><br />
<br />
Its even easier - load up ANY map and then viewdemo in console.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=406291">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=406291">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	03-04-2004 <font color="#D8DED3">10:17 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="P-Wolf is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=52480" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for P-Wolf"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=52480"><img src="images/sendpm.gif" border="0" alt="Click here to Send P-Wolf a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=52480"><img src="images/find.gif" border="0" alt="Find more posts by P-Wolf"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=52480"><img src="images/buddy.gif" border="0" alt="Add P-Wolf to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=406291"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=406291"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post406591"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>running-man</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: Florida<br>
	Posts: 13</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post406591"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>running-man</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>demo record/playback</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >my problem is some how demos seem to record only at 30 fps or lower. when i play my dmeos back they are very slow. during game play i have 100 fps at all times. so i know its not recording 100 fps. is anyone else getting this problem, and if so how can i make the demo record at more frames (30 fps is ugly for demos)<br />
<br />
thanks</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;postid=406591">Report this post to a moderator</a> | IP: <a href="postings.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getip&amp;postid=406591">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	03-05-2004 <font color="#D8DED3">02:03 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="running-man is offline" align="absmiddle">
			<a href="member.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=getinfo&amp;userid=59044" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for running-man"></a> <a href="private.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newmessage&amp;userid=59044"><img src="images/sendpm.gif" border="0" alt="Click here to Send running-man a Private Message"></a>   <a href="search.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=finduser&amp;userid=59044"><img src="images/find.gif" border="0" alt="Find more posts by running-man"></a> <a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addlist&amp;userlist=buddy&amp;userid=59044"><img src="images/buddy.gif" border="0" alt="Add running-man to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=editpost&amp;postid=406591"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;postid=406591"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 10:20 AM.</b></font></td>
		<td><a href="newthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=newreply&amp;threadid=41870"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (3): <b>   <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=1" title="previous page">&laquo;</a>   <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=1">1</a>  <font size="2">[2]</font>  <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;perpage=15&amp;pagenumber=3" title="next page">&raquo;</a>  </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;threadid=41870">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=addsubscription&amp;threadid=41870">Subscribe to this Thread</a>
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
		<a href="misc.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=faa56b9e5bc05568aeb1122a39fdbfa6&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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