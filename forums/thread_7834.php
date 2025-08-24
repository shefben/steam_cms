<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Steam 7/7 Release #2</title>
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
	COLOR: #969F8E;
	BACKGROUND-COLOR: #CFCFCF
}
TEXTAREA, .bginput {
	FONT-SIZE: 12px;
	FONT-FAMILY: Verdana,Arial,Helvetica,sans-serif;
	COLOR: #000000;
	BACKGROUND-COLOR: #CFCFCF
}
A:link, A:visited, A:active {
	COLOR: #C4CABE;
}
A:hover {
	COLOR: #FFFFFF;
}
#cat A:link, #cat A:visited, #cat A:active {
	COLOR: #B4BA50;
	TEXT-DECORATION: none;
}
#cat A:hover {
	COLOR: #B4BA50;
	TEXT-DECORATION: underline;
}
#ltlink A:link, #ltlink A:visited, #ltlink A:active {
	COLOR: #C4CABE;
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
	window.open("member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


}
// -->
</script>
</head>
<body bgcolor="#626d5c" text="#000000" id="all" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000020" vlink="#000020" alink="#000020">
<!-- header -->

<script language="JavaScript">
//
// preload all mouseover images. the order of this array sets the number of the image to call in the html.
//
var base= "/img/"
var nrm = new Array();
var mo = new Array();
var toLoad = new Array('getSteamNow','forums','support','partners','contact','logo_hl','logo_cs','logo_cz','logo_tfc','logo_opfor','logo_dod','logo_r','logo_dmc', 'main', 'status');

if (document.images){
	for (i=0;i<toLoad.length;i++){
		nrm[i] = new Image;
		nrm[i].src = base + toLoad[i] + ".gif"
		mo[i] = new Image;
		mo[i].src = base + "MO" +toLoad[i] + ".gif";
	}
}

function over(no){
	if (document.images){
		document.images[toLoad[no]].src = mo[no].src
	}
}

function out(no){
	if (document.images){
		document.images[toLoad[no]].src = nrm[no].src
	}
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
	<span style="margin-left:100px;position:absolute;top:32px;">
	<a href="/index.php?area=getsteamnow" onMouseOver="over(0)" onMouseOut="out(0)"><img name="getSteamNow" height="22" width="108" src="/img/getSteamNow.gif" alt="getSteamNow" border="0"></a>
	<a href="/index.php?area=forums" onMouseOver="over(1)" onMouseOut="out(1)"><img name="forums" height="22" width="68" src="/img/forums.gif" alt="Forums" border="0"></a>
	<a href="/index.php?area=support" onMouseOver="over(2)" onMouseOut="out(2)"><img name="support" height="22" width="68" src="/img/support.gif" alt="Support" border="0"></a>
	<a href="/index.php?area=status" onMouseOver="over(14)" onMouseOut="out(14)"><img name="status" height="22" width="65" src="/img/status.gif" alt="Status" border="0"></a>
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
<table bgcolor="#626d5c" width="95%" cellpadding="10" cellspacing="0" border="0">
<tr>
  <td>


<!-- breadcrumb, nav links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><img src="images/vb_bullet.gif" border="0" align="middle" alt="Steam Users Forums : Powered by vBulletin version 2.2.9">
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=a3335f3269bb2ce16b5ef08a8f74460b">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=a3335f3269bb2ce16b5ef08a8f74460b&forumid=13">Steam Beta 2.0 Discussions</a> &gt; <a href="forumdisplay.php?s=a3335f3269bb2ce16b5ef08a8f74460b&forumid=14">General</a> &gt; Steam 7/7 Release #2</b></font></td>
	
</tr>
</table>
<!-- /breadcrumb, nav links -->

<a name="posttop"></a>

<!-- End content area table (CREATED IN HEADER!!) -->   
	</td>
</tr>
</table>

<!-- spacer -->
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0">
<tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%">
<!-- /spacer -->



<!-- first unread and next/prev -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=2">2</a>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=3">3</a>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=4" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&goto=nextnewest">Next Thread</a>
	<img src="images/next.gif" alt="" border="0">
	</font></td>
</tr>
</table>
<!-- first unread and next/prev -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" width="175" nowrap><font face="verdana,arial,helvetica" size="1"  color="#D8DED3" class="thtcolor"><b>Author</b></font></td>
	<td bgcolor="#3E4637" width="100%">
	<!-- Thread nav and post images -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3" class="thtcolor"><b>Thread</b></font></td>
		<td><a href="newthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newthread&forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&threadid=7834"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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

<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48713"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Erik Johnson</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Administrator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: <br>
	Posts: 82</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Steam 7/7 Release #2</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >We've released another version of Counter-Strike today. This will fix the problem with some of the fonts drawing incorrectly (in italics) and fix some of the prices for weapons.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48713">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48713">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">10:53 PM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Erik Johnson is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=1722" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Erik Johnson"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=1722"><img src="images/sendpm.gif" border="0" alt="Click here to Send Erik Johnson a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=1722"><img src="images/find.gif" border="0" alt="Find more posts by Erik Johnson"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=1722"><img src="images/buddy.gif" border="0" alt="Add Erik Johnson to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48713"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48713"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48716"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>GunInHand</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2003<br>
	Location: Iowa<br>
	Posts: 74</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Thanks for the update and the news about the update...i think that everyone in those "MY FONTS DONT WORK" threads should take the time to actually thank Erik...you had plenty of time to complain...and he fixed it...and thank you</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
http://steamskinners.gamercentralclan.com/<br />
<br />
<br />
For All Your Steam Skin Needs</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48716">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48716">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:05 PM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="GunInHand is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=6892" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for GunInHand"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=6892"><img src="images/sendpm.gif" border="0" alt="Click here to Send GunInHand a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=6892"><img src="images/find.gif" border="0" alt="Find more posts by GunInHand"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=6892"><img src="images/buddy.gif" border="0" alt="Add GunInHand to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48716"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48716"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48719"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>VUGaming</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >VUGaming Networks</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: Virginia<br>
	Posts: 113</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Awesome</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Nathan Dodd<br />
VUGaming Networks<br />
www.VUGaming.com</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48719">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48719">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:12 PM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="VUGaming is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=8760" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for VUGaming"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=8760"><img src="images/sendpm.gif" border="0" alt="Click here to Send VUGaming a Private Message"></a>  <a href="http://www.VUGaming.com" target="_blank"><img src="images/home.gif" alt="Visit VUGaming's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=8760"><img src="images/find.gif" border="0" alt="Find more posts by VUGaming"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=8760"><img src="images/buddy.gif" border="0" alt="Add VUGaming to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48719"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48719"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48722"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dingle</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Playing since DuckHunt :P</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: Oregon<br>
	Posts: 247</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >can u explain the "fix for some of the gun prices"?  is it juist altered prices or was there a bug or what?</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
&gt;&lt;&lt;&gt;&gt;&lt;&lt;&gt;&gt;&lt;&lt;&gt;&gt;&lt;<br />
The Mouse<br />
#&lt;:3)~<br />
cdsslipy@hotmail.com<br />
__________________</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48722">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48722">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:14 PM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Dingle is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=346" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Dingle"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=346"><img src="images/sendpm.gif" border="0" alt="Click here to Send Dingle a Private Message"></a>  <a href="http://www.steampowered.com" target="_blank"><img src="images/home.gif" alt="Visit Dingle's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=346"><img src="images/find.gif" border="0" alt="Find more posts by Dingle"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=346"><img src="images/buddy.gif" border="0" alt="Add Dingle to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48722"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48722"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48726"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Ava3ar</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2003<br>
	Location: UK<br>
	Posts: 36</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >//big shout out to all the Steam team at Valve, good work<br />
<br />
I can't belive all the people that used to compalin that valve was doing nothing between cs releases, well i hope that this and hl2 makes them eat crow</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48726">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48726">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:29 PM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Ava3ar is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=7215" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Ava3ar"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=7215"><img src="images/sendpm.gif" border="0" alt="Click here to Send Ava3ar a Private Message"></a>  <a href="http://www.clan-dj.co.uk" target="_blank"><img src="images/home.gif" alt="Visit Ava3ar's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=7215"><img src="images/find.gif" border="0" alt="Find more posts by Ava3ar"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=7215"><img src="images/buddy.gif" border="0" alt="Add Ava3ar to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48726"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48726"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48729"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>KonG</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Sweden<br>
	Posts: 5</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I didn´t complain in the font-tread but i will thank erik and the others for a job well done =) ...</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48729">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48729">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:35 PM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="KonG is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=10325" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for KonG"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=10325"><img src="images/sendpm.gif" border="0" alt="Click here to Send KonG a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=10325"><img src="images/find.gif" border="0" alt="Find more posts by KonG"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=10325"><img src="images/buddy.gif" border="0" alt="Add KonG to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48729"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48729"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48736"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>g0d</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: cali<br>
	Posts: 130</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Re: Steam 7/7 Release #2</b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Erik Johnson </i><br />
<b>We've released another version of Counter-Strike today. This will fix the problem with some of the fonts drawing incorrectly (in italics) and fix some of the prices for weapons. </b><hr></blockquote> <br />
<br />
Erik ur g0dly...</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Area 51<br />
Intel Pentium 4 CPU 3.00GHz, 2.99GHz (x2)<br />
1023MB ram<br />
80.1GB HD x2<br />
NVIDIA GeForce FX 5900 Ultra (256MB)<br />
Creative SB Audigy</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48736">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48736">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:53 PM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="g0d is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=8674" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for g0d"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=8674"><img src="images/sendpm.gif" border="0" alt="Click here to Send g0d a Private Message"></a>  <a href="http://ps.snoogins.net" target="_blank"><img src="images/home.gif" alt="Visit g0d's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=8674"><img src="images/find.gif" border="0" alt="Find more posts by g0d"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=8674"><img src="images/buddy.gif" border="0" alt="Add g0d to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48736"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48736"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48737"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>JayBee</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2003<br>
	Location: <br>
	Posts: 44</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Oh yeah. This one rocks!<br />
I like that the font is bold. Now you can play the game and read the msg. at the same time. Dont need to stop and use the magnifying glass to read the msg. <img src="images/smilies/cool.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48737">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48737">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:55 PM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="JayBee is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=6975" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for JayBee"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=6975"><img src="images/sendpm.gif" border="0" alt="Click here to Send JayBee a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=6975"><img src="images/find.gif" border="0" alt="Find more posts by JayBee"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=6975"><img src="images/buddy.gif" border="0" alt="Add JayBee to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48737"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48737"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48738"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>hotbot</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: Germany<br>
	Posts: 53</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon3.gif" alt="Lightbulb" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >font now works fine for me but i think it's to big and bold</font></p>
	<p><font face="verdana, arial, helvetica" size="2" ><img src="images/attach/jpg.gif" width="16" height="16" border="0" alt="">Attachment: <a href="attachment.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48738" target="_blank">de_dust20003.jpg</a></font><br>
<font face="verdana,arial,helvetica" size="1" >This has been downloaded 669 time(s).</font></p>
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48738">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48738">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-07-2003 <font color="#969F8E">11:55 PM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="hotbot is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=9647" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for hotbot"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=9647"><img src="images/sendpm.gif" border="0" alt="Click here to Send hotbot a Private Message"></a>  <a href="http://www.eightytwo.tk" target="_blank"><img src="images/home.gif" alt="Visit hotbot's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=9647"><img src="images/find.gif" border="0" alt="Find more posts by hotbot"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=9647"><img src="images/buddy.gif" border="0" alt="Add hotbot to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48738"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48738"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48747"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>VUGaming</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >VUGaming Networks</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: Virginia<br>
	Posts: 113</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by hotbot </i><br />
<b>font now works fine for me but i think it's to big and bold </b><hr></blockquote> <br />
Nah it ain't. It's perfect!</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Nathan Dodd<br />
VUGaming Networks<br />
www.VUGaming.com</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48747">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48747">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:04 AM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="VUGaming is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=8760" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for VUGaming"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=8760"><img src="images/sendpm.gif" border="0" alt="Click here to Send VUGaming a Private Message"></a>  <a href="http://www.VUGaming.com" target="_blank"><img src="images/home.gif" alt="Visit VUGaming's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=8760"><img src="images/find.gif" border="0" alt="Find more posts by VUGaming"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=8760"><img src="images/buddy.gif" border="0" alt="Add VUGaming to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48747"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48747"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48749"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BaTaTa</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Brasil<br>
	Posts: 106</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >it's not <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Half Life 2.....</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48749">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48749">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:08 AM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="BaTaTa is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=10396" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for BaTaTa"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=10396"><img src="images/sendpm.gif" border="0" alt="Click here to Send BaTaTa a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=10396"><img src="images/find.gif" border="0" alt="Find more posts by BaTaTa"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=10396"><img src="images/buddy.gif" border="0" alt="Add BaTaTa to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48749"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48749"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48750"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Ava3ar</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2003<br>
	Location: UK<br>
	Posts: 36</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >the kill fonts look abit big</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48750">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48750">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:09 AM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Ava3ar is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=7215" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Ava3ar"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=7215"><img src="images/sendpm.gif" border="0" alt="Click here to Send Ava3ar a Private Message"></a>  <a href="http://www.clan-dj.co.uk" target="_blank"><img src="images/home.gif" alt="Visit Ava3ar's homepage!" border="0"></a> <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=7215"><img src="images/find.gif" border="0" alt="Find more posts by Ava3ar"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=7215"><img src="images/buddy.gif" border="0" alt="Add Ava3ar to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48750"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48750"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48754"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>kujOn</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Master of all Shield Bugs</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: Germany<br>
	Posts: 45</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >not in 800*600<br />
<br />
dunno what resolution you're playing in...</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48754">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48754">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:13 AM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="kujOn is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=5134" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for kujOn"></a>    <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=5134"><img src="images/find.gif" border="0" alt="Find more posts by kujOn"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=5134"><img src="images/buddy.gif" border="0" alt="Add kujOn to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48754"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48754"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" width="175" valign="top" nowrap>
	<a name="post48757"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>BaTaTa</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Brasil<br>
	Posts: 106</font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >im playing 1152*864<br />
but in 800x600 they look even bigger</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Half Life 2.....</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48757">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48757">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#545F4E" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:15 AM</font></font></td>
	
	<td bgcolor="#545F4E" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="BaTaTa is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=10396" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for BaTaTa"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=10396"><img src="images/sendpm.gif" border="0" alt="Click here to Send BaTaTa a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=10396"><img src="images/find.gif" border="0" alt="Find more posts by BaTaTa"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=10396"><img src="images/buddy.gif" border="0" alt="Add BaTaTa to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48757"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48757"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#626d5c" width="175" valign="top" nowrap>
	<a name="post48762"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[sPaDe]Fe$$</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Canada<br>
	Posts: 26</font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Thanks for actually listening to us and make everything to satisfy our nasty whinings about these fonts<br />
<br />
P.S. Sorry for my bad english.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=a3335f3269bb2ce16b5ef08a8f74460b&postid=48762">Report this post to a moderator</a> | IP: <a href="postings.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getip&postid=48762">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#626d5c" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-08-2003 <font color="#969F8E">12:24 AM</font></font></td>
	
	<td bgcolor="#626d5c" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[sPaDe]Fe$$ is offline" align="absmiddle">
			<a href="member.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=getinfo&userid=10291" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [sPaDe]Fe$$"></a> <a href="private.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newmessage&userid=10291"><img src="images/sendpm.gif" border="0" alt="Click here to Send [sPaDe]Fe$$ a Private Message"></a>   <a href="search.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=finduser&userid=10291"><img src="images/find.gif" border="0" alt="Find more posts by [sPaDe]Fe$$"></a> <a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addlist&userlist=buddy&userid=10291"><img src="images/buddy.gif" border="0" alt="Add [sPaDe]Fe$$ to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=editpost&postid=48762"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&postid=48762"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>


<!-- spacer -->
<table bgcolor="#626d5c" width="800" cellpadding="0" cellspacing="0" border="0">
<tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%">
<!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#3E4637" width="100%">
	<!-- time zone and post buttons -->
	<table border="0" cellspacing="0" cellpadding="0" bgcolor="#3E4637">
	<tr>
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 09:55 AM.</b></font></td>
		<td><a href="newthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newthread&forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=newreply&threadid=7834"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=2">2</a>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=3">3</a>  <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&perpage=15&pagenumber=4" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834&goto=nextnewest">Next Thread</a>
	<img src="images/next.gif" alt="" border="0">
	</font></td>
</tr>
</table>
<!-- first unread and next/prev -->

<!-- /spacer -->
</td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>
<!-- /spacer -->

<!-- restart content table from header -->
<table cellpadding="10" cellspacing="0" border="0" width="800" bgcolor="#626d5c" align="center">
<tr>
    <td>

<!-- thread options links -->
<table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"   align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>
	<td bgcolor="#545F4E" align="center"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/printer.gif" alt="" border="0" align="absmiddle">
	<a href="printthread.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=a3335f3269bb2ce16b5ef08a8f74460b&threadid=7834">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=addsubscription&threadid=7834">Subscribe to this Thread</a>
	</font></td>
</tr>
</table>
</td></tr></table>
<!-- /thread options links -->
	
<br>

<!-- forum jump and rate thread -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><table cellpadding="0" cellspacing="0" border="0">
<form action="forumdisplay.php" method="get"><tr><td>
	<font face="verdana,arial,helvetica" size="1" >
	<input type="hidden" name="s" value="a3335f3269bb2ce16b5ef08a8f74460b">
	<input type="hidden" name="daysprune" value="">
	<b>Forum Jump:</b><br>
	<select name="forumid"
	onchange="window.location=('forumdisplay.php?s=a3335f3269bb2ce16b5ef08a8f74460b&daysprune=&forumid='+this.options[this.selectedIndex].value)">
		<option value="-1" >Please select one:</option>
		<option value="-1">--------------------</option>
		<option value="pm" >Private Messages</option>
		<option value="cp" >User Control Panel</option>
		<option value="wol" >Who's Online</option>
		<option value="search" >Search Forums</option>
		<option value="home" >Forums Home</option>
		<option value="-1">--------------------</option>
		<option value="13" > Steam Beta 2.0 Discussions</option><option value="14" selected>-- General</option><option value="15" >-- Suggestions / Ideas</option><option value="16" >-- Server Feedback</option><option value="17" >-- Steam 2.0 Support / Help</option><option value="19" >-- Linux Server</option><option value="18" >-- Friends Support / Help</option><option value="5" > Counter-Strike Discussions</option><option value="7" >-- General</option><option value="8" >-- Suggestions / Ideas</option><option value="11" >-- Servers</option><option value="12" >-- Support / Help</option>
	</select><!-- go button -->
<input type="image" src="images/go.gif" border="0" 
align="absbottom">
	</font>
</td></tr></form>
</table></td>
	<td align="right"><table cellpadding="0" cellspacing="0" border="0">
<form action="threadrate.php" method="get"><tr><td>
	<font face="verdana,arial,helvetica" size="1" >
	<input type="hidden" name="s" value="a3335f3269bb2ce16b5ef08a8f74460b">
	<input type="hidden" name="threadid" value="7834">
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
	<td><font face="verdana,arial,helvetica" size="1" ><b>Forum Rules:</b><table cellpadding="0" cellspacing="0" border="0" bgcolor="3E4637"><tr><td>
<table cellpadding="4" cellspacing="1" border="0">
<tr>
	<td bgcolor="#545F4E"><font face="verdana,arial,helvetica" size="1" >
		You <b>may not</b> post new threads<br>
		You <b>may not</b> post replies<br>
		You <b>may not</b> post attachments<br>
		You <b>may not</b> edit your posts
	</font></td>
	<td bgcolor="#545F4E"><font face="verdana,arial,helvetica" size="1" >
		HTML code is <b>OFF</b><br>
		<a href="misc.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=a3335f3269bb2ce16b5ef08a8f74460b&action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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


<table width="95%" height="77" border="0" cellspacing="0" cellpadding="0" align="center" cool="" showgridx="" SHOWGRIDY="" GRIDX="16" gridy="16">
<tr height="2">
<td width="802" height="2" colspan="4"></td>
<td width="1" height="2"><spacer type="block" width="1" height="2"></td>
</tr>
<tr height="34">
<td width="356" height="34" colspan="2"></td>
<td width="420" height="34" valign="top" align="left" xpos="356"><img src="/support/Images/LOGO_Valve.01.gif" width="82" height="23" border="0"></td>
<td width="26" height="74" rowspan="2"></td>
<td width="1" height="34"><spacer type="block" width="1" height="34"></td>
</tr>
<tr height="40">
<td width="24" height="40"></td>
<td width="752" height="40" colspan="2" align="left" xpos="24" content valign="top" csheight="40">
<div align="center">
<p><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2"><a href="/index.html">Home</a> | <a href="/support/supportindex.html">Support</a> | <a href="/forums/?boardid=1041">Forums</a> | <a href="/support/bugfixes.html">Bugs</a> | <a href="/support/supportindex.html">Troubleshooting</a> |&nbsp;<a href="/support/supportindex.html">Contact</a>&nbsp;<a href="file:/STEAM_SupportRedo/01.GoLiveFiles/SteamSupport%20folder/SteamSupport/(Empty Reference!)"><br>
									</a></font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="1">(c) 2003 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.</font></p
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