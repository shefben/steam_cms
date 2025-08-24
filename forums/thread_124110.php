<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - CSS Bugs!  8/18/04</title>
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
	window.open("member.php?s=c4b0c770d753ba08783b9ee32a0883ef&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=c4b0c770d753ba08783b9ee32a0883ef">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;forumid=40">Source Game Discussions</a> &gt; <a href="forumdisplay.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;forumid=37">Counter-Strike: Source</a> &gt; CSS Bugs!  8/18/04</b></font></td>
	<td align="right" valign="bottom"><img src="images/3stars.gif" alt="Thread Rating: 10 votes, 2.90 average."></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (45): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=45" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;threadid=124110"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post969924"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Outskirts of the Oort Cloud!<br>
	Posts: 4852</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969924"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <img src="avatar.php?userid=17801&amp;dateline=1092283820" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>CSS Bugs!  8/18/04</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Its better to report them through the in-game 'Bug' system, but if not then report them here.  leave the spam and useless comments out please.  if you can re-create it (and its not an exploit) then list the step-by-step.<br />
<br />
thanks.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969924">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969924">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:04 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ocarD is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=17801" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ocarD"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=17801"><img src="images/sendpm.gif" border="0" alt="Click here to Send ocarD a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=17801"><img src="images/find.gif" border="0" alt="Find more posts by ocarD"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=17801"><img src="images/buddy.gif" border="0" alt="Add ocarD to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969924"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969924"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969931"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>master chiefff</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: new jersey<br>
	Posts: 112</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969931"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>master chiefff</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i have black colored barrels and cars and walls &gt;:O its discusting</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969931">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969931">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:04 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="master chiefff is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=76974" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for master chiefff"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=76974"><img src="images/sendpm.gif" border="0" alt="Click here to Send master chiefff a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=76974"><img src="images/find.gif" border="0" alt="Find more posts by master chiefff"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=76974"><img src="images/buddy.gif" border="0" alt="Add master chiefff to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969931"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969931"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969940"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SonRK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 47</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969940"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SonRK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Crashes to desktop after loading for 5 seconds and it shows the background iamge.<br />
<br />
Try to run it in window mode with the command "-window" and it actually gives me an error as demonstrated in this picture:<br />
<br />
<a href="http://img49.exs.cx/img49/5719/Error.gif" target="_blank">http://img49.exs.cx/img49/5719/Error.gif</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969940">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969940">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:05 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SonRK is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=113960" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SonRK"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=113960"><img src="images/sendpm.gif" border="0" alt="Click here to Send SonRK a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=113960"><img src="images/find.gif" border="0" alt="Find more posts by SonRK"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=113960"><img src="images/buddy.gif" border="0" alt="Add SonRK to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969940"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969940"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969943"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Outskirts of the Oort Cloud!<br>
	Posts: 4852</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969943"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <img src="avatar.php?userid=17801&amp;dateline=1092283820" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by master chiefff </i><br />
<b>i have black colored barrels and cars and walls &gt;:O its discusting </b><hr></blockquote> <br />
Sounds like you need new drivers.  Try and update and see if that fixes it.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969943">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969943">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:05 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ocarD is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=17801" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ocarD"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=17801"><img src="images/sendpm.gif" border="0" alt="Click here to Send ocarD a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=17801"><img src="images/find.gif" border="0" alt="Find more posts by ocarD"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=17801"><img src="images/buddy.gif" border="0" alt="Add ocarD to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969943"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969943"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969944"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>I Need $$$</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: Tx<br>
	Posts: 153</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969944"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>I Need $$$</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >When I click connect to any server it the server list goes away and I see the two CS guys and all the little arrows to my desktop shortcuts and my comp locks up.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969944">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969944">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:05 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="I Need $$$ is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=52250" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for I Need $$$"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=52250"><img src="images/sendpm.gif" border="0" alt="Click here to Send I Need $$$ a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=52250"><img src="images/find.gif" border="0" alt="Find more posts by I Need $$$"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=52250"><img src="images/buddy.gif" border="0" alt="Add I Need $$$ to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969944"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969944"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969946"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>kyosai</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 76</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969946"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>kyosai</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Yes! thank you. Someone agrees with me! Now watch more flames come!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969946">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969946">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:06 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="kyosai is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=32723" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for kyosai"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=32723"><img src="images/sendpm.gif" border="0" alt="Click here to Send kyosai a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=32723"><img src="images/find.gif" border="0" alt="Find more posts by kyosai"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=32723"><img src="images/buddy.gif" border="0" alt="Add kyosai to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969946"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969946"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969953"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Crossedxeroxed</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Palmer, Alaska<br>
	Posts: 67</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969953"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Crossedxeroxed</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Here is my problem.<br />
<br />
<a href="http://img34.exs.cx/img34/4712/problem.gif" target="_blank">http://img34.exs.cx/img34/4712/problem.gif</a><br />
<br />
All the objects being black are without flashlight. All the objects being normal are with flashlight.<br />
<br />
Yeah I know I need a new video card but I really don't think it is seeing how if the flashlight is on it works fine.<br />
<br />
I have all the latest stuff for my video card.<br />
<br />
Direct X 9.0c<br />
ATI Drivers 4.8, did the same on 4.7's and 4.9 beta.<br />
<br />
ATI Radeon 7500.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969953">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969953">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:06 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Crossedxeroxed is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=75575" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Crossedxeroxed"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=75575"><img src="images/sendpm.gif" border="0" alt="Click here to Send Crossedxeroxed a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=75575"><img src="images/find.gif" border="0" alt="Find more posts by Crossedxeroxed"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=75575"><img src="images/buddy.gif" border="0" alt="Add Crossedxeroxed to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969953"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969953"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post969965"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Charlie100</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Australia The land OF HAXORS<br>
	Posts: 788</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post969965"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Charlie100</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >well i cant even start up my steam...<br />
its just stuck here at the "Connecting Steam account: (emai address)" i mean wtf ive been stuck on this screen for like 15 min already...nothings happening..</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=969965">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=969965">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:07 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Charlie100 is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=28716" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Charlie100"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=28716"><img src="images/sendpm.gif" border="0" alt="Click here to Send Charlie100 a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=28716"><img src="images/find.gif" border="0" alt="Find more posts by Charlie100"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=28716"><img src="images/buddy.gif" border="0" alt="Add Charlie100 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=969965"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=969965"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970014"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Crash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: Australia<br>
	Posts: 5</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970014"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Crash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >If you stand back and throw a smoke grenade for example, at the barrles...It gets stuck and just sits there until you move the barrel</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970014">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970014">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:10 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Crash is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=1624" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Crash"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=1624"><img src="images/sendpm.gif" border="0" alt="Click here to Send Crash a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=1624"><img src="images/find.gif" border="0" alt="Find more posts by Crash"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=1624"><img src="images/buddy.gif" border="0" alt="Add Crash to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970014"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970014"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970030"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Death of Rats</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: <br>
	Posts: 38</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970030"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Death of Rats</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I'm having trouble with the video stress test. CS:S runs fine, except for when I try to run the VST. What it will do, is goto the level loading screen, say that it's connecting to a server, and then go back to the main menu.<br />
<br />
My specs are as follows :<br />
<br />
P4 2.4 ghz (on an asus motherboard)<br />
512 megs ram<br />
Ati Radeon 9600 pro<br />
<br />
It's 100% uploaded at 435 megs.<br />
<br />
I tried running it from the graphics options, the main menu, and also trying to load up the level when starting a server.<br />
<br />
Also, if I try to run the stress test two times in a row, CS:S crashes to desktop. I'm currently re-downloading CS:S. If that works, good.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970030">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970030">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:11 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Death of Rats is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=56283" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Death of Rats"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=56283"><img src="images/sendpm.gif" border="0" alt="Click here to Send Death of Rats a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=56283"><img src="images/find.gif" border="0" alt="Find more posts by Death of Rats"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=56283"><img src="images/buddy.gif" border="0" alt="Add Death of Rats to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970030"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970030"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970048"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>l33t_wolf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: united states<br>
	Posts: 1351</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970048"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>l33t_wolf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >crash back to desktop, with no error reports or error itself<br />
<br />
all i see is CS:S background and my mouse coursor, then in like 2 seconds it crahses back to desktop</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970048">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970048">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:12 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="l33t_wolf is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=78133" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for l33t_wolf"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=78133"><img src="images/sendpm.gif" border="0" alt="Click here to Send l33t_wolf a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=78133"><img src="images/find.gif" border="0" alt="Find more posts by l33t_wolf"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=78133"><img src="images/buddy.gif" border="0" alt="Add l33t_wolf to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970048"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970048"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970077"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Confisk8d131</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 4</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970077"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Confisk8d131</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i think that there should be different folders for different problems...<br />
<br />
like<br />
<br />
GAMEPLAY BUGS<br />
CARSHING BEFORE PLAY BUGS<br />
FSP BUGS<br />
<br />
Becasue there are soo many people creating new threads of the same stuff. its annoying....but anyways, my system craches and freezes of the startup of the CS S, but again, its beta, no biggie</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970077">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970077">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:14 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Confisk8d131 is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=46855" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Confisk8d131"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=46855"><img src="images/sendpm.gif" border="0" alt="Click here to Send Confisk8d131 a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=46855"><img src="images/find.gif" border="0" alt="Find more posts by Confisk8d131"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=46855"><img src="images/buddy.gif" border="0" alt="Add Confisk8d131 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970077"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970077"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970091"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Cram1nBLAZE</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 47</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970091"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Cram1nBLAZE</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by l33t_wolf </i><br />
<b>crash back to desktop, with no error reports or error itself<br />
<br />
all i see is CS:S background and my mouse coursor, then in like 2 seconds it crahses back to desktop </b><hr></blockquote> <br />
<br />
same here<br />
<br />
AMD Athlon XP 3000+ Barton<br />
ASUS A7N8X Deluxe <br />
Built by ATi Radeon 9600Pro 128mb (4.2 cats)<br />
512mb PC3200 DDR<br />
win98se</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970091">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970091">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:15 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Cram1nBLAZE is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=114252" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Cram1nBLAZE"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=114252"><img src="images/sendpm.gif" border="0" alt="Click here to Send Cram1nBLAZE a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=114252"><img src="images/find.gif" border="0" alt="Find more posts by Cram1nBLAZE"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=114252"><img src="images/buddy.gif" border="0" alt="Add Cram1nBLAZE to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970091"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970091"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970098"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Charlie100</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Australia The land OF HAXORS<br>
	Posts: 788</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970098"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Charlie100</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Steam not loading</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >ive been stuck on this screen for nearly 20 min now<br />
its the thing that pops up just after u start steam <br />
"Connecting Steam Account: 'username' @hotmail.com..."<br />
i am stuck at this screen ^ <br />
can someone tell me y i cant start steam cause i really want to play CS:S</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970098">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970098">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:15 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Charlie100 is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=28716" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Charlie100"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=28716"><img src="images/sendpm.gif" border="0" alt="Click here to Send Charlie100 a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=28716"><img src="images/find.gif" border="0" alt="Find more posts by Charlie100"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=28716"><img src="images/buddy.gif" border="0" alt="Add Charlie100 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970098"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970098"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post970118"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SonRK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 47</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post970118"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>SonRK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by l33t_wolf </i><br />
<b>crash back to desktop, with no error reports or error itself<br />
<br />
all i see is CS:S background and my mouse coursor, then in like 2 seconds it crahses back to desktop </b><hr></blockquote> <br />
<br />
I ran CS:S In a Window and it gave me an actual error by :<br />
<br />
play game &gt; css &gt; properties &gt; launch options &gt; and add a "-window"<br />
<br />
<br />
It should actually give an error message this time!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;postid=970118">Report this post to a moderator</a> | IP: <a href="postings.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getip&amp;postid=970118">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-19-2004 <font color="#D8DED3">06:16 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="SonRK is offline" align="absmiddle">
			<a href="member.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=getinfo&amp;userid=113960" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for SonRK"></a> <a href="private.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newmessage&amp;userid=113960"><img src="images/sendpm.gif" border="0" alt="Click here to Send SonRK a Private Message"></a>   <a href="search.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=finduser&amp;userid=113960"><img src="images/find.gif" border="0" alt="Find more posts by SonRK"></a> <a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addlist&amp;userlist=buddy&amp;userid=113960"><img src="images/buddy.gif" border="0" alt="Add SonRK to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=editpost&amp;postid=970118"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;postid=970118"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 03:13 AM.</b></font></td>
		<td><a href="newthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=newreply&amp;threadid=124110"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (45): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;perpage=15&amp;pagenumber=45" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;threadid=124110">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=addsubscription&amp;threadid=124110">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="c4b0c770d753ba08783b9ee32a0883ef">
	<input type="hidden" name="threadid" value="124110">
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
		<a href="misc.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=c4b0c770d753ba08783b9ee32a0883ef&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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