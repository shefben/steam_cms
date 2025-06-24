<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - New Update: SDK and pre-load</title>
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
	window.open("member.php?s=2657646321195ac0b56f129b1e2739da&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=2657646321195ac0b56f129b1e2739da">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=2657646321195ac0b56f129b1e2739da&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=2657646321195ac0b56f129b1e2739da&amp;forumid=14">General</a> &gt; New Update: SDK and pre-load</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (5): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=5" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;threadid=169357"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post1454586"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>cliffe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2004<br>
	Location: <br>
	Posts: 392</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454586"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>cliffe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br><br>
                <img src="avatar.php?userid=83316&amp;dateline=1092283640" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>New Update: SDK and pre-load</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Source SDK Tools Available Now<br />
November 5, 2004, 1:52 pm ╖ valve <br />
 <br />
Valve has released the Source Software Development Kit (SDK) Tools via Steam. A precursor to the release of the full SDK, which will be released shortly after Half-Life 2 is made available, the Source SDK Tools release offers a comprehensive toolset for starting production on Source-based MODs, including Hammer, XSI EXP for Half-Life 2, compiling tools, the Source Model Viewer, documentation on programming, modeling, building materials, and more. For more information, please visit collective.valve-erc.com<br />
<br />
 <br />
<br />
<br />
<br />
<br />
Half-Life 2 Pre-Loading Phase 7<br />
November 5, 2004, 9:00 am ╖ valve <br />
 <br />
The seventh phase of the Half-Life 2 preload begins to Steam account holders today. This will allow users to download localized Half-Life 2 content and other content in encrypted form. No purchase is required to pre-load Half-Life 2, but is required to activate the game. The moment the game is made available, those who have pre-loaded and purchased the game via Steam will be ready to start playing.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454586">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454586">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:11 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="cliffe is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=83316" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for cliffe"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=83316"><img src="images/sendpm.gif" border="0" alt="Click here to Send cliffe a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=83316"><img src="images/find.gif" border="0" alt="Find more posts by cliffe"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=83316"><img src="images/buddy.gif" border="0" alt="Add cliffe to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454586"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454586"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454593"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bl4h</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: PA, USA<br>
	Posts: 917</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454593"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bl4h</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >yaaaaay</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454593">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454593">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:12 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/on.gif" border="0" alt="bl4h is online now" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=72759" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bl4h"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=72759"><img src="images/sendpm.gif" border="0" alt="Click here to Send bl4h a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=72759"><img src="images/find.gif" border="0" alt="Find more posts by bl4h"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=72759"><img src="images/buddy.gif" border="0" alt="Add bl4h to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454593"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454593"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454611"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Varsity</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004<br>
	Location: England<br>
	Posts: 3033</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454611"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Varsity</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><b><font size="5">GET MAPPING! <img src="images/smilies/biggrin.gif" border="0" alt=""></font></b></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454611">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454611">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:14 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Varsity is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=101707" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Varsity"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=101707"><img src="images/sendpm.gif" border="0" alt="Click here to Send Varsity a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=101707"><img src="images/find.gif" border="0" alt="Find more posts by Varsity"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=101707"><img src="images/buddy.gif" border="0" alt="Add Varsity to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454611"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454611"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454621"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>StimPakAddict</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004<br>
	Location: Vancouver, BC, Canada<br>
	Posts: 275</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454621"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>StimPakAddict</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Excellent. <br />
<br />
Anyone got a good link to a mapping FAQ/tutorial site?<br />
<br />
I'd really like to get into using hammer.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454621">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454621">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:15 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="StimPakAddict is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=102720" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for StimPakAddict"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=102720"><img src="images/sendpm.gif" border="0" alt="Click here to Send StimPakAddict a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=102720"><img src="images/find.gif" border="0" alt="Find more posts by StimPakAddict"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=102720"><img src="images/buddy.gif" border="0" alt="Add StimPakAddict to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454621"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454621"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454627"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>grim32</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 208</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454627"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>grim32</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >About how many more preloads, do you guys at valve think you will have??</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454627">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454627">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:16 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="grim32 is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=29986" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for grim32"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=29986"><img src="images/sendpm.gif" border="0" alt="Click here to Send grim32 a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=29986"><img src="images/find.gif" border="0" alt="Find more posts by grim32"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=29986"><img src="images/buddy.gif" border="0" alt="Add grim32 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454627"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454627"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454639"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>generic</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Crawley, UK<br>
	Posts: 1350</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454639"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>generic</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Wooo! <img src="images/smilies/biggrin.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454639">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454639">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:17 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="generic is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=11676" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for generic"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=11676"><img src="images/sendpm.gif" border="0" alt="Click here to Send generic a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=11676"><img src="images/find.gif" border="0" alt="Find more posts by generic"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=11676"><img src="images/buddy.gif" border="0" alt="Add generic to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454639"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454639"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454644"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>kingkpcs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004<br>
	Location: <br>
	Posts: 16</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454644"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>kingkpcs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >great news i cant wait to see what the community does with the tools.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454644">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454644">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:18 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="kingkpcs is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=106431" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for kingkpcs"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=106431"><img src="images/sendpm.gif" border="0" alt="Click here to Send kingkpcs a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=106431"><img src="images/find.gif" border="0" alt="Find more posts by kingkpcs"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=106431"><img src="images/buddy.gif" border="0" alt="Add kingkpcs to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454644"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454644"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454651"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>giuseppe.cerqui</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 345</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454651"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>giuseppe.cerqui</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I love Steam and Cliffe that has given us this GREAT News! Thanks Again!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454651">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454651">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:19 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="giuseppe.cerqui is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=75682" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for giuseppe.cerqui"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=75682"><img src="images/sendpm.gif" border="0" alt="Click here to Send giuseppe.cerqui a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=75682"><img src="images/find.gif" border="0" alt="Find more posts by giuseppe.cerqui"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=75682"><img src="images/buddy.gif" border="0" alt="Add giuseppe.cerqui to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454651"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454651"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454653"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>shadowwh</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004<br>
	Location: Tlaxcala, Mщxico.<br>
	Posts: 206</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454653"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>shadowwh</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Woohooooooooooo!!!!!!! SDK Maps maps maps and more maaaaapss<br />
<br />
Hl2 phase 7 woohoo!<br />
<br />
i cant wait!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454653">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454653">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:19 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="shadowwh is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=62476" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for shadowwh"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=62476"><img src="images/sendpm.gif" border="0" alt="Click here to Send shadowwh a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=62476"><img src="images/find.gif" border="0" alt="Find more posts by shadowwh"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=62476"><img src="images/buddy.gif" border="0" alt="Add shadowwh to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454653"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454653"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454654"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>farcelet</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 67</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454654"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>farcelet</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Hurray!<br />
<br />
(just thought I'd take this occasion to be one of the first to reply in a thread that'll reach the hundreds by tomorrow <img src="images/smilies/tongue.gif" border="0" alt="">)</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454654">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454654">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:19 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="farcelet is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=114778" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for farcelet"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=114778"><img src="images/sendpm.gif" border="0" alt="Click here to Send farcelet a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=114778"><img src="images/find.gif" border="0" alt="Find more posts by farcelet"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=114778"><img src="images/buddy.gif" border="0" alt="Add farcelet to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454654"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454654"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454657"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Varsity</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004<br>
	Location: England<br>
	Posts: 3033</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454657"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Varsity</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by StimPakAddict </i><br />
<b>Excellent. <br />
<br />
Anyone got a good link to a mapping FAQ/tutorial site?<br />
<br />
I'd really like to get into using hammer. </b><hr></blockquote> It's in the news post: <a href="http://collective.valve-erc.com/" target="_blank">http://collective.valve-erc.com/</a>. Seems to be down now - presumably Chris is putting up the new version.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454657">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454657">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Varsity is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=101707" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Varsity"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=101707"><img src="images/sendpm.gif" border="0" alt="Click here to Send Varsity a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=101707"><img src="images/find.gif" border="0" alt="Find more posts by Varsity"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=101707"><img src="images/buddy.gif" border="0" alt="Add Varsity to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454657"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454657"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454660"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>rancid-Milk-Man</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: <br>
	Posts: 2957</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454660"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>rancid-Milk-Man</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="4" color="white">╡</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >whoooooooooooooooooooooooo<br />
<br />
I can finally start my MOD<br />
<br />
I LOVE YOU CLIFFE<br />
<br />
<br />
Time to convert 1.6 Maps also</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454660">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454660">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="rancid-Milk-Man is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=51051" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for rancid-Milk-Man"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=51051"><img src="images/sendpm.gif" border="0" alt="Click here to Send rancid-Milk-Man a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=51051"><img src="images/find.gif" border="0" alt="Find more posts by rancid-Milk-Man"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=51051"><img src="images/buddy.gif" border="0" alt="Add rancid-Milk-Man to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454660"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454660"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454663"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Snarkbait</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: Norcal<br>
	Posts: 346</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454663"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Snarkbait</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Silly question, but where will this appear on steam? under tools?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454663">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454663">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Snarkbait is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=143411" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Snarkbait"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=143411"><img src="images/sendpm.gif" border="0" alt="Click here to Send Snarkbait a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=143411"><img src="images/find.gif" border="0" alt="Find more posts by Snarkbait"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=143411"><img src="images/buddy.gif" border="0" alt="Add Snarkbait to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454663"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454663"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454664"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>giuseppe.cerqui</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 345</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454664"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>giuseppe.cerqui</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >PLEASE STICKY THIS!!!!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454664">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454664">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="giuseppe.cerqui is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=75682" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for giuseppe.cerqui"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=75682"><img src="images/sendpm.gif" border="0" alt="Click here to Send giuseppe.cerqui a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=75682"><img src="images/find.gif" border="0" alt="Find more posts by giuseppe.cerqui"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=75682"><img src="images/buddy.gif" border="0" alt="Add giuseppe.cerqui to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454664"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454664"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1454665"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>12guage</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 70</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1454665"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>12guage</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >About the localized content, is stuff being pre-loaded to those with the english version?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2657646321195ac0b56f129b1e2739da&amp;postid=1454665">Report this post to a moderator</a> | IP: <a href="postings.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getip&amp;postid=1454665">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-05-2004 <font color="#D8DED3">10:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="12guage is offline" align="absmiddle">
			<a href="member.php?s=2657646321195ac0b56f129b1e2739da&amp;action=getinfo&amp;userid=117499" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 12guage"></a> <a href="private.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newmessage&amp;userid=117499"><img src="images/sendpm.gif" border="0" alt="Click here to Send 12guage a Private Message"></a>   <a href="search.php?s=2657646321195ac0b56f129b1e2739da&amp;action=finduser&amp;userid=117499"><img src="images/find.gif" border="0" alt="Find more posts by 12guage"></a> <a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addlist&amp;userlist=buddy&amp;userid=117499"><img src="images/buddy.gif" border="0" alt="Add 12guage to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2657646321195ac0b56f129b1e2739da&amp;action=editpost&amp;postid=1454665"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;postid=1454665"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 06:50 PM.</b></font></td>
		<td><a href="newthread.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=2657646321195ac0b56f129b1e2739da&amp;action=newreply&amp;threadid=169357"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (5): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;perpage=15&amp;pagenumber=5" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=2657646321195ac0b56f129b1e2739da&amp;threadid=169357">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=2657646321195ac0b56f129b1e2739da&amp;action=addsubscription&amp;threadid=169357">Subscribe to this Thread</a>
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
		<a href="misc.php?s=2657646321195ac0b56f129b1e2739da&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=2657646321195ac0b56f129b1e2739da&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=2657646321195ac0b56f129b1e2739da&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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