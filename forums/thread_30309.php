<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Potential Fix for 1.6 FPS problem ?!</title>
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
	window.open("member.php?s=34bdf799f9f2d40e30720b2fa404e500&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=34bdf799f9f2d40e30720b2fa404e500">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=5">Valve Back Catalog Discussions</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=7">Counter-Strike</a> &gt; Potential Fix for 1.6 FPS problem ?!</b></font></td>
	<td align="right" valign="bottom"><img src="images/5stars.gif" alt="Thread Rating: 2 votes, 5.00 average."></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (7): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=7" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newthread&amp;forumid=7"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=30309"><img src="images/closed.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post190398"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Hage</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Bavaria/Germany<br>
	Posts: 2</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190398"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Hage</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Potential Fix for 1.6 FPS problem ?!</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >The guys from #take2 (quakenet) seem to found out what the problem for the fps problems in 1.6 was. Valve is using an old opengl driver.<br />
<br />
Here is their way to fix it:<br />
- Go to the Windows\System32 directory and look for your opengl.dll<br />
<br />
If you're using a nvidia card the nvoglnt.dll is the right one.<br />
For Ati cards it's the atioglxx.dll.<br />
And for the rest the opengl32.dll.<br />
<br />
- copy that file to your ..\SteamApps\user@user.de\counter-strike\gldrv directory.<br />
<br />
- open the drvmap.txt in that directory and change the text to the following:<br />
<br />
Default Default<br />
gldrv/YOURFILENAME.dll OpenGL Driver<br />
<br />
I havent tested it so far, but it might work</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190398">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190398">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">04:33 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Hage is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=34139" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Hage"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=34139"><img src="images/find.gif" border="0" alt="Find more posts by Hage"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=34139"><img src="images/buddy.gif" border="0" alt="Add Hage to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190398"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190398"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190479"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SpIt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: <br>
	Posts: 387</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190479"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SpIt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >ill test that and ill tell you if it really works</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190479">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190479">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">05:33 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SpIt is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=12831" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SpIt"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=12831"><img src="images/find.gif" border="0" alt="Find more posts by SpIt"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=12831"><img src="images/buddy.gif" border="0" alt="Add SpIt to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190479"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190479"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190483"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>germanjulian</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 44</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190483"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>germanjulian</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >god i just posted that as well lol<br />
<br />
works fine by the way</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190483">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190483">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">05:37 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="germanjulian is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=26805" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for germanjulian"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=26805"><img src="images/find.gif" border="0" alt="Find more posts by germanjulian"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=26805"><img src="images/buddy.gif" border="0" alt="Add germanjulian to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190483"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190483"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190545"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190545"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Is that normal ????</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >The only thing i have in my windows/systems32 is gm.dls     <br />
<br />
and my drvmap default is Default Default<br />
gldrv/3dfxgl.dll 3Dfx Mini Driver      <br />
<br />
e... is that normal !!!    I run CS on Opengl !!!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190545">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190545">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:18 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Pilami is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=27821" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Pilami"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=27821"><img src="images/find.gif" border="0" alt="Find more posts by Pilami"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=27821"><img src="images/buddy.gif" border="0" alt="Add Pilami to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190545"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190545"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190551"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 58</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190551"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon14.gif" alt="Thumbs up" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >YES THIS WORKS FINE NO PROBS!!!!<br />
<br />
I RECCOMEND THAT IF AN ADMIN/MODERATOR SEE'S THIS POST THAT THEY MAKE IT A STICKY AS IT IS THE ANSWER TO EVERYONES PROBLEMS WITH THIER FPS!!!<br />
<br />
<br />
<br />
MAKE THIS A STICKY!!!!!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190551">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190551">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:22 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[s-as]Darkangel is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10530" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [s-as]Darkangel"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10530"><img src="images/find.gif" border="0" alt="Find more posts by [s-as]Darkangel"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10530"><img src="images/buddy.gif" border="0" alt="Add [s-as]Darkangel to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190551"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190551"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190555"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 346</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190555"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Whenever you download new video drivers, it updates the OpenGL driver for you...</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190555">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190555">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:23 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SteamSoldier is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=25823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SteamSoldier"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=25823"><img src="images/find.gif" border="0" alt="Find more posts by SteamSoldier"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=25823"><img src="images/buddy.gif" border="0" alt="Add SteamSoldier to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190555"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190555"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190561"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190561"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Ok so your telling me every thing is fine !!! Good!!! :P</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190561">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190561">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:25 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Pilami is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=27821" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Pilami"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=27821"><img src="images/find.gif" border="0" alt="Find more posts by Pilami"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=27821"><img src="images/buddy.gif" border="0" alt="Add Pilami to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190561"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190561"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190565"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 58</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190565"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >yeah mate it does, but take ya time to read what it sez up there.<br />
<br />
steam uses its own opengl dll file in the steam directory, which is an old version. if you follow the instructions at the top, and replace this old 3dfxGL.dll or whatever, the fps goes to what it should be!!! my fps is flawless now!!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190565">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190565">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[s-as]Darkangel is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10530" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [s-as]Darkangel"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10530"><img src="images/find.gif" border="0" alt="Find more posts by [s-as]Darkangel"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10530"><img src="images/buddy.gif" border="0" alt="Add [s-as]Darkangel to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190565"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190565"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190568"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 346</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190568"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SteamSoldier</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Why would STEAM use a old OpenGL.dll file?  That's beyond me.  Either your wrong or VALVe overlooked something again.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190568">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190568">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:30 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SteamSoldier is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=25823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SteamSoldier"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=25823"><img src="images/find.gif" border="0" alt="Find more posts by SteamSoldier"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=25823"><img src="images/buddy.gif" border="0" alt="Add SteamSoldier to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190568"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190568"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190574"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 58</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190574"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon7.gif" alt="Smile" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >valve HAVE overlooked something! i just tried this and my FPS is perfect, b4 it was very bad and i had at least a 33% loss of frame rate. Valve CAN make mistakes it isnt impossible, if you dont believe me try it yourself. or stick with what you have if your FPS is ok.<br />
<br />
thats my final word on this <br />
<br />
<br />
TRY IT! :P</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190574">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190574">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:34 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[s-as]Darkangel is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10530" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [s-as]Darkangel"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10530"><img src="images/find.gif" border="0" alt="Find more posts by [s-as]Darkangel"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10530"><img src="images/buddy.gif" border="0" alt="Add [s-as]Darkangel to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190574"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190574"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190579"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[AFB]-Mauser-</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: <br>
	Posts: 65</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190579"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[AFB]-Mauser-</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon5.gif" alt="Question" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >hmm i tried to remove the old 3dfxGL.dll  with my new nvoglnt.dll (for nvidia detornator), but as soon as i start CS, the old file is back again and cs loads the 3dfx... driver ??? <br />
<br />
hmm any suggestions?<br />
<br />
<br />
many tnx 4 your help</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190579">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190579">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:36 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[AFB]-Mauser- is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=8936" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [AFB]-Mauser-"></a>   <!--<a href="http://afb.strikenet.at" target="_blank"><img src="images/home.gif" alt="Visit [AFB]-Mauser-'s homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=8936"><img src="images/find.gif" border="0" alt="Find more posts by [AFB]-Mauser-"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=8936"><img src="images/buddy.gif" border="0" alt="Add [AFB]-Mauser- to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190579"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190579"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190584"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 58</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190584"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[s-as]Darkangel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i dont know if it woks with the nvidia openGL file<br />
<br />
i have an Nvidia Gforce 4 MX 440 and i also use the detonator drivers, i went to; <br />
<br />
"C:/windows/system32"<br />
<br />
and copied the file opengl32.dll to the gldrv folder instead, and edited the txt file to say:<br />
<br />
Default Default <br />
gldrv/opengl32.dll OpenGL Driver <br />
<br />
it works fine now, i think you are best off using that file instead <img src="images/smilies/biggrin.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190584">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190584">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:41 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[s-as]Darkangel is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10530" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [s-as]Darkangel"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10530"><img src="images/find.gif" border="0" alt="Find more posts by [s-as]Darkangel"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10530"><img src="images/buddy.gif" border="0" alt="Add [s-as]Darkangel to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190584"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190584"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190593"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190593"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Pilami</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Your opinion !!!</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >The only file that I have in my "C:/windows/system32"  is <br />
<br />
Gm.dls ???   how come I don't have the opengl file or the <br />
<br />
nvoglnt.dll because i use a nvidia card ? Strange to me !!!   and <br />
<br />
my default in drvmap is  gldrv/3dfxgl.dll 3Dfx Mini Driver !!! <br />
<br />
i run cs on opengl but i cant find a damn opengl file even if i do a <br />
<br />
search on opengl !!!    Help plz !!!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190593">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190593">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:48 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Pilami is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=27821" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Pilami"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=27821"><img src="images/find.gif" border="0" alt="Find more posts by Pilami"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=27821"><img src="images/buddy.gif" border="0" alt="Add Pilami to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190593"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190593"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190602"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>REDIAL2</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: here<br>
	Posts: 15</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190602"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>REDIAL2</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >wow i really need to update my 5 year old computer.....<br />
<br />
good thing I am!!!<br />
<br />
w00t<br />
<br />
&lt;is happy&gt;</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190602">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190602">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">06:54 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="REDIAL2 is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=31060" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for REDIAL2"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=31060"><img src="images/find.gif" border="0" alt="Find more posts by REDIAL2"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=31060"><img src="images/buddy.gif" border="0" alt="Add REDIAL2 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190602"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190602"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190680"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NightStalker</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 22</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190680"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NightStalker</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Re: Your opinion !!!</b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Pilami </i><br />
<b>The only file that I have in my "C:/windows/system32"  is <br />
<br />
Gm.dls ???   how come I don't have the opengl file or the <br />
<br />
nvoglnt.dll because i use a nvidia card ? Strange to me !!!   and <br />
<br />
my default in drvmap is  gldrv/3dfxgl.dll 3Dfx Mini Driver !!! <br />
<br />
i run cs on opengl but i cant find a damn opengl file even if i do a <br />
<br />
search on opengl !!!    Help plz !!! </b><hr></blockquote> <br />
<br />
Mine is the same, there are no .dll files in my system32 driver folder either and the rest of your info is the same as mine.  I have also downloaded the other day the newest detonater drivers for my card.  The only thing I can find is a nvopenGl.dll in my NVIDEA folder but I'm not sure if this would be the one to use.<br />
Can anybody help?  Thank You</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190680">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190680">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">08:11 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="NightStalker is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=30963" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for NightStalker"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=30963"><img src="images/find.gif" border="0" alt="Find more posts by NightStalker"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=30963"><img src="images/buddy.gif" border="0" alt="Add NightStalker to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190680"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190680"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 04:22 PM.</b></font></td>
		<td><a href="newthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newthread&amp;forumid=7"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=30309"><img src="images/closed.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (7): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;perpage=15&amp;pagenumber=7" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=30309">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addsubscription&amp;threadid=30309">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="34bdf799f9f2d40e30720b2fa404e500">
	<input type="hidden" name="threadid" value="30309">
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
		<a href="misc.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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