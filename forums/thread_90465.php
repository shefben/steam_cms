<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - VALVe, HL2 and CS source comp specification?</title>
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
</style>


<script language="javascript" type="text/javascript">
<!--
function aimwindow(aimid) {
	window.open("member.php?s=e355db1a82b004534aaca4c509c293fd&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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

	<a href="/index.php?area=support"><img valign="bottom" height="22" width="68" src="/img/support.gif" border="0" 
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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=e355db1a82b004534aaca4c509c293fd">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=e355db1a82b004534aaca4c509c293fd&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=e355db1a82b004534aaca4c509c293fd&amp;forumid=14">General</a> &gt; VALVe, HL2 and CS source comp specification?</b></font></td>
	
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
	<a href="showthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;threadid=90465"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post641872"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mentality</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: <br>
	Posts: 53</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post641872"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>mentality</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>VALVe, HL2 and CS source comp specification?</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I was wondering if AMD 64 bit 3200 with 512 mb ram, ATI 9800 XT 256 mb be good enough for HL2 at a consistent 100 fps?<br />
<br />
I've had people showing me screenshot on IRC of their FPS in Hl2, somehow they got the leaked version and test it.<br />
<br />
The comp for that was something like ATI 9800 XT 256 MB, 3.2 ghz intel ht 1 gb ram, RAID hd, etc...<br />
<br />
and it would drop to 30 fps in open areas.<br />
<br />
I'm hoping thats only due to the non retail version they got and hoping the retail version will be optimized.<br />
<br />
I mean 9800 XT 256 mb intel 3.2 ghz is pretty much top of the line, and if it won't run the game smoothly at a consistent rate, then how will people move onto that game for competition in leagues and tournaments?<br />
<br />
Perhaps you guys can fill us in on the specification required to run HL2 and cs source smoothly at a consistent 100 fps rate in all areas? <br />
<br />
Some information would be kindly appreciated. Thank you.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=641872">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=641872">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">08:02 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="mentality is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=19553" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for mentality"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=19553"><img src="images/sendpm.gif" border="0" alt="Click here to Send mentality a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=19553"><img src="images/find.gif" border="0" alt="Find more posts by mentality"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=19553"><img src="images/buddy.gif" border="0" alt="Add mentality to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=641872"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=641872"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post641891"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>seanBro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: UK<br>
	Posts: 35</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post641891"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>seanBro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >that wont run at 100fps - thats really unlikely. do you need it at 100? won't 60 do?</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
"Wake up Mr Freeman, wake up and smell the ashes" - Gman</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=641891">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=641891">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">08:09 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="seanBro is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=14080" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for seanBro"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=14080"><img src="images/sendpm.gif" border="0" alt="Click here to Send seanBro a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=14080"><img src="images/find.gif" border="0" alt="Find more posts by seanBro"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=14080"><img src="images/buddy.gif" border="0" alt="Add seanBro to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=641891"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=641891"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post641934"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>PsychicX</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004<br>
	Location: <br>
	Posts: 442</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post641934"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>PsychicX</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >It's hard to predict, mainly because most of the final graphics engine optimizations are probably still in progress. Your guess is as good as anyone's.<br />
<br />
And remember FPS depends on how high the settings for detail are. 9800's are decent cards though.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=641934">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=641934">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">08:22 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="PsychicX is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=91534" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for PsychicX"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=91534"><img src="images/sendpm.gif" border="0" alt="Click here to Send PsychicX a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=91534"><img src="images/find.gif" border="0" alt="Find more posts by PsychicX"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=91534"><img src="images/buddy.gif" border="0" alt="Add PsychicX to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=641934"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=641934"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post641936"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DiSTuRbEdofX</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 782</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post641936"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DiSTuRbEdofX</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >It won't get 100fps with full detail, but my X800 series card will <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=641936">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=641936">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">08:23 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/on.gif" border="0" alt="DiSTuRbEdofX is online now" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=12087" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DiSTuRbEdofX"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=12087"><img src="images/sendpm.gif" border="0" alt="Click here to Send DiSTuRbEdofX a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=12087"><img src="images/find.gif" border="0" alt="Find more posts by DiSTuRbEdofX"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=12087"><img src="images/buddy.gif" border="0" alt="Add DiSTuRbEdofX to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=641936"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=641936"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post642174"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Maxey</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: Portugal<br>
	Posts: 184</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post642174"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Maxey</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Even if we all had a super uber computers that run all games  at 5000 FPS with all settings at insane, we are still limited to the refresh rate of our screens.<br />
<br />
If you have a PC that runs HL2 at steady 100 FPS at 1024 x 768, but a screen that only supports 75 Hz at that resolution, then you're screwed, because 35 FPS get wasted.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
/forums/showthread.php?s=&amp;threadid=90249<br />
^ Worst. Thread. Ever. ^</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=642174">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=642174">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">09:39 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Maxey is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=52310" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Maxey"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=52310"><img src="images/sendpm.gif" border="0" alt="Click here to Send Maxey a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=52310"><img src="images/find.gif" border="0" alt="Find more posts by Maxey"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=52310"><img src="images/buddy.gif" border="0" alt="Add Maxey to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=642174"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=642174"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post642284"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Seraph_UK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 46</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post642284"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Seraph_UK</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Unlikely to get constant 100fps, but dont expect to be in trouble with those specs.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=642284">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=642284">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">10:17 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Seraph_UK is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=36486" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Seraph_UK"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=36486"><img src="images/sendpm.gif" border="0" alt="Click here to Send Seraph_UK a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=36486"><img src="images/find.gif" border="0" alt="Find more posts by Seraph_UK"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=36486"><img src="images/buddy.gif" border="0" alt="Add Seraph_UK to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=642284"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=642284"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post642325"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>redragon525</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: <br>
	Posts: 171</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post642325"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>redragon525</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Are you kidding me?  I've seen some people's computers (not mine of course, no no) get 100fps with like a 9600xt and a 3200 baton...with 512mb of ddr400 ram, and a normal 7200rpm hard drive.  <br />
<br />
You'll be fine and then some.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Chieftec Server Chassis w/ side window, Silver<br />
Abit NF7-S *Nvidia and Abit split up..:(*<br />
AMD Athlon XP 2500+ Overclocked to 3200+ (about 2.2Ghz)<br />
512MB of PC3200 DDR RAM<br />
ATi Radeon 9600XT<br />
120GB 7200rpm 8mb cache Maxtor HDD</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=642325">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=642325">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">10:36 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="redragon525 is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=8838" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for redragon525"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=8838"><img src="images/sendpm.gif" border="0" alt="Click here to Send redragon525 a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=8838"><img src="images/find.gif" border="0" alt="Find more posts by redragon525"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=8838"><img src="images/buddy.gif" border="0" alt="Add redragon525 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=642325"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=642325"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post642331"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>redragon525</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: <br>
	Posts: 171</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post642331"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>redragon525</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Maxey </i><br />
<b>Even if we all had a super uber computers that run all games  at 5000 FPS with all settings at insane, we are still limited to the refresh rate of our screens.<br />
<br />
If you have a PC that runs HL2 at steady 100 FPS at 1024 x 768, but a screen that only supports 75 Hz at that resolution, then you're screwed, because 35 FPS get wasted. </b><hr></blockquote> <br />
<br />
cl_showfps 1 with developer 1 on and fps_max set to 2000 shows that I have around 200-300fps in CS and I only have a monitor with a refresh rate of 75.<br />
<br />
The correct thing to say would be "You wouldn't see the difference between 100 and 75 unless you turned v-sync off, when then it probably wouldn't matter because above 60 you really can't tell the difference"</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Chieftec Server Chassis w/ side window, Silver<br />
Abit NF7-S *Nvidia and Abit split up..:(*<br />
AMD Athlon XP 2500+ Overclocked to 3200+ (about 2.2Ghz)<br />
512MB of PC3200 DDR RAM<br />
ATi Radeon 9600XT<br />
120GB 7200rpm 8mb cache Maxtor HDD</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=642331">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=642331">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">10:38 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="redragon525 is offline" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=8838" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for redragon525"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=8838"><img src="images/sendpm.gif" border="0" alt="Click here to Send redragon525 a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=8838"><img src="images/find.gif" border="0" alt="Find more posts by redragon525"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=8838"><img src="images/buddy.gif" border="0" alt="Add redragon525 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=642331"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=642331"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post642442"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>gopatriots03</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 51</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post642442"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>gopatriots03</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >u really should worry about getting anything +60 FPS. unless u have really good eyes, u cant tell the difference.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Pentium 4 HT 3 ghz<br />
512 mb ram<br />
120 gb hard drive<br />
Nvidia geforce fx 5200<br />
SB Audigy 2<br />
win xp sp1<br />
15 inch LCD 75 hertz</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=e355db1a82b004534aaca4c509c293fd&amp;postid=642442">Report this post to a moderator</a> | IP: <a href="postings.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getip&amp;postid=642442">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	05-31-2004 <font color="#D8DED3">11:29 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/on.gif" border="0" alt="gopatriots03 is online now" align="absmiddle">
			<a href="member.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=getinfo&amp;userid=41666" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for gopatriots03"></a> <a href="private.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newmessage&amp;userid=41666"><img src="images/sendpm.gif" border="0" alt="Click here to Send gopatriots03 a Private Message"></a>   <a href="search.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=finduser&amp;userid=41666"><img src="images/find.gif" border="0" alt="Find more posts by gopatriots03"></a> <a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addlist&amp;userlist=buddy&amp;userid=41666"><img src="images/buddy.gif" border="0" alt="Add gopatriots03 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=editpost&amp;postid=642442"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;postid=642442"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 11:42 PM.</b></font></td>
		<td><a href="newthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newthread&amp;forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=newreply&amp;threadid=90465"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=e355db1a82b004534aaca4c509c293fd&amp;threadid=90465">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=addsubscription&amp;threadid=90465">Subscribe to this Thread</a>
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
		<a href="misc.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=e355db1a82b004534aaca4c509c293fd&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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
<p><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"><a href="/">Home</a> | <a href="/index.php?area=news">News</a> | <a href="/getsteamnow.php">Get Steam Now</a> | <a href="/index.php?area=support">Support</a> | <a href="/index.php?area=forums">Forums</a> |&nbsp;<a href="/status.html">Status</a><br>
									</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="1">(c) 2004 Valve Corporation. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve Corporation.</font></p
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