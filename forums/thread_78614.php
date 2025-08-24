<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Debug Assertion [READ]</title>
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
	window.open("member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=fbb2a360f0bbdc17e1cb67ce89355e33">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;forumid=17">Steam Support / Help</a> &gt; Debug Assertion [READ]</b></font></td>
	
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
	<a href="showthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;threadid=78614"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post541035"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bLOobeaR</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: australia<br>
	Posts: 63</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post541035"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bLOobeaR</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Debug Assertion [READ]</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >ERROR here:<br />
<br />
Program:C:\program files\steam\steam.exe<br />
File:Src\CSClientConnection.ccp<br />
Line:1197<br />
<br />
(<font color="#D8DED3">closesocket</font>( m_socket )) ==0<br />
<br />
(Press Retry to debug the application - JIT debugging must b enabled)<br />
 __________________________________________________<br />
<br />
<br />
<br />
err watz that?????????//...<br />
<br />
ive just relized 2 day my cpu is wierd, i ran a virus scan, no viruses<br />
<br />
3 problems ive noticed<br />
- cant play online game called Nitto 1320 becuase it wont let me join<br />
-MSN Messenger wont let me sign in, it says service is down, and i cant check if da service is down cuz the site wont opne eithe<br />
-this steam error<br />
<br />
wats rong?? anyone know??????? i can play Gunbound online perfectly, can browse sites ok, buts..just those?? I WANNA GO MSN MESSENGER..gRRR</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
...( ' ""()      haLoO !               <br />
("( 'o',  )<br />
 (")(")(,,)       <br />
<br />
 *  *  ( ' ""() bAi<br />
   * ("( 'o',  )   baii<br />
 *   (")(")(,,)  * *<br />
<br />
copyrited Tashiro.Inc c[=</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=541035">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=541035">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-25-2004 <font color="#D8DED3">05:30 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bLOobeaR is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=54405" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bLOobeaR"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=54405"><img src="images/sendpm.gif" border="0" alt="Click here to Send bLOobeaR a Private Message"></a>   <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=54405"><img src="images/find.gif" border="0" alt="Find more posts by bLOobeaR"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=54405"><img src="images/buddy.gif" border="0" alt="Add bLOobeaR to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=541035"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=541035"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post541080"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>FrozenHalo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 20</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post541080"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>FrozenHalo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >This is what happened.<br />
<br />
You went into a server in either CS, CZ, OR someother 3rdparty mod.<br />
<br />
You got hacked. its as simple as that. I hope you have a good internet cus your going to have to RE-INSTALL steam.<br />
<br />
I got the same error. Some Taylor dude told me to reinstall. its the only way to fix that.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
-----<br />
FrozenHalo<br />
Alex Schneider</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=541080">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=541080">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-25-2004 <font color="#D8DED3">06:15 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="FrozenHalo is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=73049" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for FrozenHalo"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=73049"><img src="images/sendpm.gif" border="0" alt="Click here to Send FrozenHalo a Private Message"></a>  <!--<a href="http://www.oc-clan.us" target="_blank"><img src="images/home.gif" alt="Visit FrozenHalo's homepage!" border="0"></a>--> <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=73049"><img src="images/find.gif" border="0" alt="Find more posts by FrozenHalo"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=73049"><img src="images/buddy.gif" border="0" alt="Add FrozenHalo to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=541080"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=541080"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post542505"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bLOobeaR</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: australia<br>
	Posts: 63</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post542505"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>bLOobeaR</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>no..</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >look, my msn messenger does not sign in, it goes, service is unavailable, but usually, it would sign in for a few secs, den say service is unavailable, not once clikc sign in. And wen i go to check the service status..the site wont work, and that browser would stuff up, i cant go 2 differnt sites from that browser.<br />
<br />
And in nitto, i get another problem, cant log in as well, ggoes game is full, but it never says that, only if i just got d/c frOm the net.<br />
<br />
Steam doesnt work, cuz of that error. It says something about socket.<br />
<br />
&gt;&lt;"<br />
<br />
CAN someone tell me what ezactly is the problem and tell me how 2 fix all of this</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
...( ' ""()      haLoO !               <br />
("( 'o',  )<br />
 (")(")(,,)       <br />
<br />
 *  *  ( ' ""() bAi<br />
   * ("( 'o',  )   baii<br />
 *   (")(")(,,)  * *<br />
<br />
copyrited Tashiro.Inc c[=</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=542505">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=542505">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-26-2004 <font color="#D8DED3">01:16 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="bLOobeaR is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=54405" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for bLOobeaR"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=54405"><img src="images/sendpm.gif" border="0" alt="Click here to Send bLOobeaR a Private Message"></a>   <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=54405"><img src="images/find.gif" border="0" alt="Find more posts by bLOobeaR"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=54405"><img src="images/buddy.gif" border="0" alt="Add bLOobeaR to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=542505"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=542505"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post542514"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: Bellevue,Wa<br>
	Posts: 2913</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post542514"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>qUiCkSiLvEr</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >You might have some spyware on your system, try running some of the programs here:<br />
<a href="/forums/showthread.php?threadid=76462" target="_blank">What to Do About SpyWare &amp; Virus Problems FAQ</a></font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Would you like a little Cheeze with that Whine?</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=542514">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=542514">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-26-2004 <font color="#D8DED3">01:18 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="qUiCkSiLvEr is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=12457" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for qUiCkSiLvEr"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=12457"><img src="images/sendpm.gif" border="0" alt="Click here to Send qUiCkSiLvEr a Private Message"></a>   <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=12457"><img src="images/find.gif" border="0" alt="Find more posts by qUiCkSiLvEr"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=12457"><img src="images/buddy.gif" border="0" alt="Add qUiCkSiLvEr to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=542514"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=542514"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post542573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Outskirts of the Oort Cloud!<br>
	Posts: 2678</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post542573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ocarD</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by FrozenHalo </i><br />
<b>Some Taylor dude told me to reinstall. its the only way to fix that. </b><hr></blockquote> <br />
You mean Taylor Sherman who works at VALVe?  Show some respect!</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
"I'm pretty sure at least here a lot more people could be helped if we dnd't have to deal with cheat posters, "OMG VALVE SUCKS" posters, not to mention the people that PM us with clearly keygen'ed keys that "don't work". Not everyone's doing that, but so many do it makes it pretty hard to help the people who have legit issues and legit problems." <br />
- Waldo</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=542573">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=542573">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-26-2004 <font color="#D8DED3">01:37 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ocarD is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=17801" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ocarD"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=17801"><img src="images/sendpm.gif" border="0" alt="Click here to Send ocarD a Private Message"></a>   <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=17801"><img src="images/find.gif" border="0" alt="Find more posts by ocarD"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=17801"><img src="images/buddy.gif" border="0" alt="Add ocarD to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=542573"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=542573"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post542609"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Hampster</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003<br>
	Location: Fragging location<br>
	Posts: 398</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post542609"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Hampster</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Sep 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >*hails Mr. Taylor*</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
No one sees the Hampster w/Radioactive Bananas... unless he's the bait.  o.O</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;postid=542609">Report this post to a moderator</a> | IP: <a href="postings.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getip&amp;postid=542609">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-26-2004 <font color="#D8DED3">01:46 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Hampster is offline" align="absmiddle">
			<a href="member.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=getinfo&amp;userid=27104" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Hampster"></a> <a href="private.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newmessage&amp;userid=27104"><img src="images/sendpm.gif" border="0" alt="Click here to Send Hampster a Private Message"></a>   <a href="search.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=finduser&amp;userid=27104"><img src="images/find.gif" border="0" alt="Find more posts by Hampster"></a> <a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addlist&amp;userlist=buddy&amp;userid=27104"><img src="images/buddy.gif" border="0" alt="Add Hampster to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=editpost&amp;postid=542609"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;postid=542609"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 10:03 AM.</b></font></td>
		<td><a href="newthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=newreply&amp;threadid=78614"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;threadid=78614">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=addsubscription&amp;threadid=78614">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="fbb2a360f0bbdc17e1cb67ce89355e33">
	<input type="hidden" name="threadid" value="78614">
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
		<a href="misc.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=fbb2a360f0bbdc17e1cb67ce89355e33&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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