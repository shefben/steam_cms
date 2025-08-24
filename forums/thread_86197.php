<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Hlds_proc, process manager for HLDS</title>
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
	window.open("member.php?s=eaa6b3058647cf73e889e564c90ce4b8&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=eaa6b3058647cf73e889e564c90ce4b8">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;forumid=5">Valve Back Catalog Discussions</a> &gt; <a href="forumdisplay.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;forumid=16">Windows Dedicated Server</a> &gt; Hlds_proc, process manager for HLDS</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=4" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newthread&amp;forumid=16"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;threadid=86197"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post602945"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RobGP</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: UK<br>
	Posts: 197</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post602945"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RobGP</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Hlds_proc, process manager for HLDS</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I have made a nice tool, Hlds_proc which is a process manager for HLDS. Heres a list of some features.<br />
<br />
+ Can manage multiple HLDS processes at once.<br />
+ Runs as both a Windows user application or system service.<br />
+ Automatically restarts servers that crash or hang.<br />
+ Optional web interface for starting/stopping/setting up servers.<br />
+ Automatically detects Steam updates and will update your servers for you.<br />
+ Ability to schedule servers to stop/start/restart, even send server commands at specific times.<br />
+ Compatible with WON and STEAM versions of HLDS.<br />
<br />
And much more..<br />
<br />
You can download it from the links below:<br />
<br />
Hlds_proc Beta 2<br />
<a href="http://hldsproc.vugaming.com/hlds_proc_beta2.zip" target="_blank">http://hldsproc.vugaming.com/hlds_proc_beta2.zip</a><br />
<br />
Hlds_proc Beta 2 Web Extensions<br />
<a href="http://hldsproc.vugaming.com/hlds_proc_beta2_webx.zip" target="_blank">http://hldsproc.vugaming.com/hlds_proc_beta2_webx.zip</a><br />
<br />
Forum for discussion ishere:<br />
<a href="http://gpaspforums.gpsites.org/tt.asp?appid=4" target="_blank">http://gpaspforums.gpsites.org/tt.asp?appid=4</a><br />
<br />
thanks,</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=602945">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=602945">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-13-2004 <font color="#D8DED3">03:51 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="RobGP is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=26846" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for RobGP"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=26846"><img src="images/sendpm.gif" border="0" alt="Click here to Send RobGP a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=26846"><img src="images/find.gif" border="0" alt="Find more posts by RobGP"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=26846"><img src="images/buddy.gif" border="0" alt="Add RobGP to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=602945"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=602945"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post616991"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Austin, TX<br>
	Posts: 277</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post616991"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Nice! Must have if you run multiple remote servers. Runs circles around Serverdoc.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=616991">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=616991">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:18 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="mob is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=72085" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for mob"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=72085"><img src="images/sendpm.gif" border="0" alt="Click here to Send mob a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=72085"><img src="images/find.gif" border="0" alt="Find more posts by mob"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=72085"><img src="images/buddy.gif" border="0" alt="Add mob to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=616991"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=616991"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post617001"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: Bellevue,Wa<br>
	Posts: 4403</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post617001"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <img src="avatar.php?userid=12457&amp;dateline=1092283792" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I added a link in my Stickied Help FAQ for this post Rob, Thanks for all your hard work.<br />
<br />
<font color="white"><font size="3"><a href="/forums/showthread.php?threadid=85158" target="_blank">qUiCkSiLvEr Help FAQs</a></font></font><br />
<br />
Look in the Server section.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=617001">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=617001">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:35 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="qUiCkSiLvEr is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=12457" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for qUiCkSiLvEr"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=12457"><img src="images/sendpm.gif" border="0" alt="Click here to Send qUiCkSiLvEr a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=12457"><img src="images/find.gif" border="0" alt="Find more posts by qUiCkSiLvEr"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=12457"><img src="images/buddy.gif" border="0" alt="Add qUiCkSiLvEr to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=617001"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=617001"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post617008"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>golden3159</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: <br>
	Posts: 436</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post617008"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>golden3159</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >link down??<img src="images/smilies/frown.gif" border="0" alt=""><img src="images/smilies/frown.gif" border="0" alt=""><img src="images/smilies/frown.gif" border="0" alt=""><img src="images/smilies/frown.gif" border="0" alt="">: 404</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=617008">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=617008">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:41 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="golden3159 is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=58671" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for golden3159"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=58671"><img src="images/sendpm.gif" border="0" alt="Click here to Send golden3159 a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=58671"><img src="images/find.gif" border="0" alt="Find more posts by golden3159"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=58671"><img src="images/buddy.gif" border="0" alt="Add golden3159 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=617008"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=617008"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post617015"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: Bellevue,Wa<br>
	Posts: 4403</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post617015"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <img src="avatar.php?userid=12457&amp;dateline=1092283792" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><font size="3"><font color="yellow">Hlds_proc Beta 3 available</font></font><br />
<br />
New installer and (optional) Web Extensions all included.<br />
<br />
-Updated web extensions with new functionality.<br />
-Added users and permissions system to web extensions.<br />
-More priority options are available (above/below normal, realtime).<br />
-Added about dialog box to hlds_proc_run that displays version info.<br />
-"ver" command at console shows version of all components.<br />
-Reworked general protection fault handling to work with Windows 2000 and below.<br />
-Moved the communications functionality out of hlds_proc_sv into hlds_proc_d.<br />
-Web extensions and the console applet now work with hlds_proc_run as well as the service.<br />
-Updated docs.<br />
<br />
Mirrors:<br />
<a href="http://www.shiversoftware.net/downloads/hlds_proc_beta3.exe" target="_blank">http://www.shiversoftware.net/downl..._proc_beta3.exe</a><br />
<a href="http://hldsproc.vugaming.com/hlds_proc_beta3.exe" target="_blank">http://hldsproc.vugaming.com/hlds_proc_beta3.exe</a><br />
<br />
You will need the .NET framework as it's written in Managed C# (with one small part in managed C++).<br />
<br />
Here is the readme in HTML format:<br />
<a href="http://home.covad.net/~k25125/Server/HLDS_Proc/HLDS_Proc_Readme.htm" target="_blank">HLDS_Proc Readme</a><br />
<br />
As a comment, don't install the web extensions unless you have IIS installed on your system.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=617015">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=617015">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:52 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="qUiCkSiLvEr is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=12457" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for qUiCkSiLvEr"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=12457"><img src="images/sendpm.gif" border="0" alt="Click here to Send qUiCkSiLvEr a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=12457"><img src="images/find.gif" border="0" alt="Find more posts by qUiCkSiLvEr"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=12457"><img src="images/buddy.gif" border="0" alt="Add qUiCkSiLvEr to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=617015"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=617015"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post617056"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>gabenewell</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: USA<br>
	Posts: 1</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post617056"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>gabenewell</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Also, if you install IIS after the .NET framework, you will need to reinstall the framework otherwise ASP applications (including Hlds_proc web extensions) will fail to load.<br />
<br />
Thanks for updatng the thread Quicksilver.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=617056">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=617056">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">12:32 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="gabenewell is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=59290" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for gabenewell"></a>   <!--<a href="/valvesoftware" target="_blank"><img src="images/home.gif" alt="Visit gabenewell's homepage!" border="0"></a>--> <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=59290"><img src="images/find.gif" border="0" alt="Find more posts by gabenewell"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=59290"><img src="images/buddy.gif" border="0" alt="Add gabenewell to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=617056"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=617056"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post617310"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DeathLord666</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: <br>
	Posts: 1360</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post617310"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DeathLord666</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I tried to install beta3 but it keeps getting interupted somehow even though &amp; didn't do anything while it's trying to install. I don't use a firewall so has anyone got any ideas?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=617310">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=617310">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">04:44 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DeathLord666 is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=57812" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DeathLord666"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=57812"><img src="images/sendpm.gif" border="0" alt="Click here to Send DeathLord666 a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=57812"><img src="images/find.gif" border="0" alt="Find more posts by DeathLord666"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=57812"><img src="images/buddy.gif" border="0" alt="Add DeathLord666 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=617310"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=617310"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618018"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 16</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618018"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >It seems to be working well right now.  Now to see if it updates my DoD server to v1.2 tonight.<br />
<br />
Thanks.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618018">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618018">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">10:32 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="m0r0n is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=68808" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for m0r0n"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=68808"><img src="images/sendpm.gif" border="0" alt="Click here to Send m0r0n a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=68808"><img src="images/find.gif" border="0" alt="Find more posts by m0r0n"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=68808"><img src="images/buddy.gif" border="0" alt="Add m0r0n to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618018"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618018"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618037"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 16</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618037"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >One thing I just noticed is that when the service is running and even though <b>interact with desktop</b> is checked I still cannot see the gui.  I am connecting through terminal server (remote desktop) but I'm connecting to the /console which usually works with most other services.  I'm running Windows 2003 Server by the way.<br />
<br />
<br />
<b>UPDATE:</b><br />
Nevermind, I just read that the service console thing doesn't have much functionality just yet.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by m0r0n on 05-19-2004 at 10:56 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618037">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618037">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">10:47 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="m0r0n is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=68808" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for m0r0n"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=68808"><img src="images/sendpm.gif" border="0" alt="Click here to Send m0r0n a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=68808"><img src="images/find.gif" border="0" alt="Find more posts by m0r0n"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=68808"><img src="images/buddy.gif" border="0" alt="Add m0r0n to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618037"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618037"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618049"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Austin, TX<br>
	Posts: 277</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618049"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >In the Beta 2 version, you could only run either the Application (w/ no web extensions), or the service (w/ no interaction with the GUI). In this beta, all you need to do is run the App. You can run the web extensions with the Application version now and just minimize it to the system tray. Running it as a service is kind of pointless now that you can run the App mode and still have web extensions.<br />
<br />
 On my Win2K3 server, I run hlds_proc in App mode and the web extensions function just fine. Just make sure you have IIS 6.0 installed AND ASP.net installed.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618049">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618049">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">10:54 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="mob is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=72085" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for mob"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=72085"><img src="images/sendpm.gif" border="0" alt="Click here to Send mob a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=72085"><img src="images/find.gif" border="0" alt="Find more posts by mob"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=72085"><img src="images/buddy.gif" border="0" alt="Add mob to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618049"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618049"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618054"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 16</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618054"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by mob </i><br />
Running it as a service is kind of pointless now that you can run the App mode and still have web extensions.<hr></blockquote> <br />
<br />
Except that you have to actually be logged in to do that.  I prefer to run things as services.  It would be nice to be able to use the gui when the service is running but since that isn't possible at this time I'll see what the service console can do.<br />
<br />
Thanks.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618054">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618054">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">10:58 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="m0r0n is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=68808" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for m0r0n"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=68808"><img src="images/sendpm.gif" border="0" alt="Click here to Send m0r0n a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=68808"><img src="images/find.gif" border="0" alt="Find more posts by m0r0n"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=68808"><img src="images/buddy.gif" border="0" alt="Add m0r0n to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618054"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618054"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618061"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Austin, TX<br>
	Posts: 277</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618061"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mob</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Cool cool. Also, this is only a beta and the programer takes a lot of suggestions in the forums. Pretty much everything I suggested for beta 3 was put in! If you want something in there, I suggest you post in their forums.<br />
<br />
Also, if you run the web extensions, you pretty much have the GUI right there. I don't think there is much you cannot do via the web extensions (given you have complete access) that can be done via the App.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618061">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618061">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:02 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="mob is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=72085" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for mob"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=72085"><img src="images/sendpm.gif" border="0" alt="Click here to Send mob a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=72085"><img src="images/find.gif" border="0" alt="Find more posts by mob"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=72085"><img src="images/buddy.gif" border="0" alt="Add mob to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618061"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618061"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618070"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 16</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618070"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>m0r0n</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >mob, thanks for the info.  I didn't install the web stuff actually cause I run a web server off the same machine and I didn't know how it would effect it.  I'll take this to their forums. <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618070">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618070">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:07 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="m0r0n is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=68808" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for m0r0n"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=68808"><img src="images/sendpm.gif" border="0" alt="Click here to Send m0r0n a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=68808"><img src="images/find.gif" border="0" alt="Find more posts by m0r0n"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=68808"><img src="images/buddy.gif" border="0" alt="Add m0r0n to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618070"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618070"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618150"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Demokill</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: <br>
	Posts: 191</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618150"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Demokill</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Wow, you are awesome, this tool is amazing, I now have less cpu usage, less clutter and an easier to use interface, Thank you so much.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618150">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618150">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:47 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Demokill is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=9610" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Demokill"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=9610"><img src="images/sendpm.gif" border="0" alt="Click here to Send Demokill a Private Message"></a>  <!--<a href="http://www.VulcanServers.com" target="_blank"><img src="images/home.gif" alt="Visit Demokill's homepage!" border="0"></a>--> <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=9610"><img src="images/find.gif" border="0" alt="Find more posts by Demokill"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=9610"><img src="images/buddy.gif" border="0" alt="Add Demokill to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618150"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618150"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post618152"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RobGP</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: UK<br>
	Posts: 197</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post618152"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>RobGP</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >DeathLord666: You will have to further your explanation if you want help, give error messages etc.<br />
<br />
m0r0n: Checking "interact with service" will do nothing as there is no UI built into the service. The service loader is just a bootstrapper for the hlds_proc engine thats just gets it running. You will need to use hlds_proc_con or hlds_proc_web to use it. A good idea is to use hlds_proc_run (the app mode) to set up your servers, then when you are happy with your config switch to using service mode.<br />
<br />
The console applet is getting a complete redesign for Beta4 which will also expand its functionality.<br />
<br />
The UI for the service mode is really the web extensions. There are no current plans for a UI to be built for the service mode that uses Windows forms.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;postid=618152">Report this post to a moderator</a> | IP: <a href="postings.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getip&amp;postid=618152">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-19-2004 <font color="#D8DED3">11:48 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="RobGP is offline" align="absmiddle">
			<a href="member.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=getinfo&amp;userid=26846" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for RobGP"></a> <a href="private.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newmessage&amp;userid=26846"><img src="images/sendpm.gif" border="0" alt="Click here to Send RobGP a Private Message"></a>   <a href="search.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=finduser&amp;userid=26846"><img src="images/find.gif" border="0" alt="Find more posts by RobGP"></a> <a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addlist&amp;userlist=buddy&amp;userid=26846"><img src="images/buddy.gif" border="0" alt="Add RobGP to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=editpost&amp;postid=618152"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;postid=618152"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 09:44 PM.</b></font></td>
		<td><a href="newthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newthread&amp;forumid=16"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=newreply&amp;threadid=86197"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;perpage=15&amp;pagenumber=4" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;threadid=86197">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=addsubscription&amp;threadid=86197">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="eaa6b3058647cf73e889e564c90ce4b8">
	<input type="hidden" name="threadid" value="86197">
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
		<a href="misc.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=eaa6b3058647cf73e889e564c90ce4b8&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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