<!-- BEGIN TEMPLATE: showthread -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Win32 StructuredException</title>
<!-- BEGIN TEMPLATE: headinclude -->
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


<!-- END TEMPLATE: headinclude -->
<script language="javascript" type="text/javascript">
<!--
function aimwindow(aimid) {
	window.open("member.php?s=217b8367d82da9e717a39442543e4acf&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


}
// -->
</script>
</head>
<body bgcolor="#4C5844" text="#A0AA95" id="all" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000020" vlink="#000020" alink="#000020">
<!-- BEGIN TEMPLATE: header -->
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

<!-- END TEMPLATE: header -->

<!-- breadcrumb, nav links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><!-- BEGIN TEMPLATE: navbar -->
<img src="images/vb_bullet.gif" border="0" align="middle" alt="Steam Users Forums : Powered by vBulletin version 2.3.3">
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=217b8367d82da9e717a39442543e4acf">Steam Users Forums</a> &gt; <!-- BEGIN TEMPLATE: nav_linkon -->
<a href="forumdisplay.php?s=217b8367d82da9e717a39442543e4acf&amp;forumid=13">Steam Discussions</a>
<!-- END TEMPLATE: nav_linkon --><!-- BEGIN TEMPLATE: nav_joiner -->
 &gt; 
<!-- END TEMPLATE: nav_joiner --><!-- BEGIN TEMPLATE: nav_linkon -->
<a href="forumdisplay.php?s=217b8367d82da9e717a39442543e4acf&amp;forumid=17">Steam Support / Help</a>
<!-- END TEMPLATE: nav_linkon --><!-- BEGIN TEMPLATE: nav_joiner -->
 &gt; 
<!-- END TEMPLATE: nav_joiner --><!-- BEGIN TEMPLATE: nav_linkoff -->
Win32 StructuredException
<!-- END TEMPLATE: nav_linkoff --></b></font>
<!-- END TEMPLATE: navbar --></td>
	
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
	<a href="showthread.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;threadid=33966"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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

<!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215336"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215336"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon9.gif" alt="Unhappy" border="0"> <b>Win32 StructuredException</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I'm having a problem when i try to update counter-strike.<br />
Whenever i go to update it i get this error message:<br />
<br />
Steam.exe (main exception): Win32 StructuredException at 5FF32419 : Attempt to read from virtual address 0 without appropriate access rights<br />
<br />
then when i hit 'ok' i get:<br />
<br />
The instruction at "0x100037bd" referenced memory at "0x01f3aae0". The memory could not be "read".<br />
<br />
I tried that panda thing but my IE doesnt work and i use msn explorer and when it asks to d/l the things during the panda scan, it wont do it cause i dont know how to set my default web browser in windows XP.<br />
<br />
please help somebody :\</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215336">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215336">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">07:31 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Stevem is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=39929" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Stevem"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=39929"><img src="images/sendpm.gif" border="0" alt="Click here to Send Stevem a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=39929"><img src="images/find.gif" border="0" alt="Find more posts by Stevem"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=39929"><img src="images/buddy.gif" border="0" alt="Add Stevem to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215336"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215336"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215423"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[W.S]Blue</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: http://clanws.no-ip.org/<br>
	Posts: 190</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215423"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[W.S]Blue</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >You have Win 98?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215423">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215423">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">09:50 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_online -->
<img src="images/on.gif" border="0" alt="[W.S]Blue is online now" align="absmiddle">
<!-- END TEMPLATE: postbit_online -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=36595" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [W.S]Blue"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=36595"><img src="images/sendpm.gif" border="0" alt="Click here to Send [W.S]Blue a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=36595"><img src="images/find.gif" border="0" alt="Find more posts by [W.S]Blue"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=36595"><img src="images/buddy.gif" border="0" alt="Add [W.S]Blue to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215423"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215423"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215433"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215433"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >no, windows XP professional</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215433">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215433">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">10:06 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Stevem is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=39929" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Stevem"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=39929"><img src="images/sendpm.gif" border="0" alt="Click here to Send Stevem a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=39929"><img src="images/find.gif" border="0" alt="Find more posts by Stevem"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=39929"><img src="images/buddy.gif" border="0" alt="Add Stevem to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215433"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215433"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215545"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Intrepid00</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: PA, USA<br>
	Posts: 3598</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215545"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Intrepid00</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <!-- BEGIN TEMPLATE: postbit_avatar -->
<img src="avatar.php?userid=11064&amp;dateline=1092283751" border="0" alt="">
<!-- END TEMPLATE: postbit_avatar --><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >If your running as a standard user go to Computer Administrator level.<br />
<br />
If your parents don't want to do that they could add you to the power user group via the computer management tool under administrator tools.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215545">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215545">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">02:03 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Intrepid00 is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=11064" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Intrepid00"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=11064"><img src="images/sendpm.gif" border="0" alt="Click here to Send Intrepid00 a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=11064"><img src="images/find.gif" border="0" alt="Find more posts by Intrepid00"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=11064"><img src="images/buddy.gif" border="0" alt="Add Intrepid00 to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215545"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215545"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215582"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215582"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Stevem</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i have full access to the computer and admin tools...<br />
<br />
how do i get rid of this error message that comes up when steam tries to update my counter-strike??</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215582">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215582">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">02:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Stevem is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=39929" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Stevem"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=39929"><img src="images/sendpm.gif" border="0" alt="Click here to Send Stevem a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=39929"><img src="images/find.gif" border="0" alt="Find more posts by Stevem"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=39929"><img src="images/buddy.gif" border="0" alt="Add Stevem to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215582"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215582"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215587"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Intrepid00</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: PA, USA<br>
	Posts: 3598</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post215587"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Intrepid00</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator</font><br><br>
                <!-- BEGIN TEMPLATE: postbit_avatar -->
<img src="avatar.php?userid=11064&amp;dateline=1092283751" border="0" alt="">
<!-- END TEMPLATE: postbit_avatar --><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Test for memory failure<br />
<br />
<a href="http://www.memtest86.com/" target="_blank">http://www.memtest86.com/</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=215587">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=215587">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-10-2003 <font color="#D8DED3">02:30 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Intrepid00 is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=11064" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Intrepid00"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=11064"><img src="images/sendpm.gif" border="0" alt="Click here to Send Intrepid00 a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=11064"><img src="images/find.gif" border="0" alt="Find more posts by Intrepid00"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=11064"><img src="images/buddy.gif" border="0" alt="Add Intrepid00 to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=215587"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=215587"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278624"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>l0bster</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Australia, Brisbane<br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278624"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>l0bster</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >yeah im getting same problem, steam was working fine last night. Then this morning after it updated it gave me that **** error message. So its not my computer thats the issue, it was fine last night.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278624">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278624">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">10:46 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="l0bster is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=27452" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for l0bster"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=27452"><img src="images/sendpm.gif" border="0" alt="Click here to Send l0bster a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->  <!-- BEGIN TEMPLATE: postbit_homepage -->
<!--<a href="http://wuxia.uacn.net" target="_blank"><img src="images/home.gif" alt="Visit l0bster's homepage!" border="0"></a>-->
<!-- END TEMPLATE: postbit_homepage --> <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=27452"><img src="images/find.gif" border="0" alt="Find more posts by l0bster"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=27452"><img src="images/buddy.gif" border="0" alt="Add l0bster to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278624"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278624"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278657"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>robinnydestedt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: sweden<br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278657"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>robinnydestedt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i think its funny for 1 week it oesnt work and now its just worked!<br />
so sometimes i works sometimes not, why?<br />
the forum is more effective then the spport!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278657">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278657">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">11:44 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="robinnydestedt is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=36505" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for robinnydestedt"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=36505"><img src="images/sendpm.gif" border="0" alt="Click here to Send robinnydestedt a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->  <!-- BEGIN TEMPLATE: postbit_homepage -->
<!--<a href="http://www.ssb.be/students/robnyd" target="_blank"><img src="images/home.gif" alt="Visit robinnydestedt's homepage!" border="0"></a>-->
<!-- END TEMPLATE: postbit_homepage --> <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=36505"><img src="images/find.gif" border="0" alt="Find more posts by robinnydestedt"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=36505"><img src="images/buddy.gif" border="0" alt="Add robinnydestedt to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278657"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278657"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278664"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Nebraska, USA<br>
	Posts: 2934</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278664"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Read the stickies:<br />
<br />
<a href="/forums/showthread.php?s=&amp;threadid=44186" target="_blank">/forums/...;threadid=44186</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278664">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278664">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">11:51 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="MiSmith7 is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=29593" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for MiSmith7"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=29593"><img src="images/sendpm.gif" border="0" alt="Click here to Send MiSmith7 a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->  <!-- BEGIN TEMPLATE: postbit_homepage -->
<!--<a href="http://ass.mismith7-cvn.org" target="_blank"><img src="images/home.gif" alt="Visit MiSmith7's homepage!" border="0"></a>-->
<!-- END TEMPLATE: postbit_homepage --> <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=29593"><img src="images/find.gif" border="0" alt="Find more posts by MiSmith7"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=29593"><img src="images/buddy.gif" border="0" alt="Add MiSmith7 to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278664"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278664"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278679"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>watchinthewheel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003<br>
	Location: <br>
	Posts: 21</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278679"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>watchinthewheel</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >yeh just found that too thanks for the help</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278679">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278679">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">12:07 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="watchinthewheel is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=12268" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for watchinthewheel"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=12268"><img src="images/sendpm.gif" border="0" alt="Click here to Send watchinthewheel a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=12268"><img src="images/find.gif" border="0" alt="Find more posts by watchinthewheel"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=12268"><img src="images/buddy.gif" border="0" alt="Add watchinthewheel to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278679"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278679"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ikir</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: Italy<br>
	Posts: 140</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278697"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ikir</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon8.gif" alt="Angry" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I have the same problem after the update :-(</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278697">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278697">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">01:49 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="ikir is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=563" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ikir"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=563"><img src="images/sendpm.gif" border="0" alt="Click here to Send ikir a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=563"><img src="images/find.gif" border="0" alt="Find more posts by ikir"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=563"><img src="images/buddy.gif" border="0" alt="Add ikir to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278697"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278697"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278699"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Nebraska, USA<br>
	Posts: 2934</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278699"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>MiSmith7</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Banned</font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by ikir </i><br />
<b>I have the same problem after the update :-( </b><hr></blockquote> <br />
<br />
Then click the link I posted... it fixes it.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278699">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278699">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">02:15 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="MiSmith7 is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=29593" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for MiSmith7"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=29593"><img src="images/sendpm.gif" border="0" alt="Click here to Send MiSmith7 a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->  <!-- BEGIN TEMPLATE: postbit_homepage -->
<!--<a href="http://ass.mismith7-cvn.org" target="_blank"><img src="images/home.gif" alt="Visit MiSmith7's homepage!" border="0"></a>-->
<!-- END TEMPLATE: postbit_homepage --> <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=29593"><img src="images/find.gif" border="0" alt="Find more posts by MiSmith7"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=29593"><img src="images/buddy.gif" border="0" alt="Add MiSmith7 to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278699"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278699"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit --><!-- BEGIN TEMPLATE: postbit -->
<table bgcolor="#4C5844" width="800" cellpadding="0" cellspacing="0" border="0"><tr><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td><td width="100%"><!-- spacer -->

<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"  width="100%" align="center"><tr><td>
<table cellpadding="4" cellspacing="1" border="0"  width="100%">
<tr>

<!--
 	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278701"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Gabriel Melo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: <br>
	Posts: 4</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post278701"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Gabriel Melo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon14.gif" alt="Thumbs up" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >tks MiSmith7...<br />
i have the same problem after the update.. now its ok.<br />
<img src="images/smilies/biggrin.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=217b8367d82da9e717a39442543e4acf&amp;postid=278701">Report this post to a moderator</a> | <!-- BEGIN TEMPLATE: postbit_ip_hidden -->
IP: <a href="postings.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getip&amp;postid=278701">Logged</a>
<!-- END TEMPLATE: postbit_ip_hidden --></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	12-18-2003 <font color="#D8DED3">02:19 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><!-- BEGIN TEMPLATE: postbit_offline -->
<img src="images/off.gif" border="0" alt="Gabriel Melo is offline" align="absmiddle">
<!-- END TEMPLATE: postbit_offline -->
			<!-- BEGIN TEMPLATE: postbit_profile -->
<a href="member.php?s=217b8367d82da9e717a39442543e4acf&amp;action=getinfo&amp;userid=44989" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Gabriel Melo"></a>
<!-- END TEMPLATE: postbit_profile --> <!-- BEGIN TEMPLATE: postbit_sendpm -->
<a href="private.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newmessage&amp;userid=44989"><img src="images/sendpm.gif" border="0" alt="Click here to Send Gabriel Melo a Private Message"></a>
<!-- END TEMPLATE: postbit_sendpm -->   <!-- BEGIN TEMPLATE: postbit_search -->
<a href="search.php?s=217b8367d82da9e717a39442543e4acf&amp;action=finduser&amp;userid=44989"><img src="images/find.gif" border="0" alt="Find more posts by Gabriel Melo"></a>
<!-- END TEMPLATE: postbit_search --> <!-- BEGIN TEMPLATE: postbit_buddy -->
<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addlist&amp;userlist=buddy&amp;userid=44989"><img src="images/buddy.gif" border="0" alt="Add Gabriel Melo to your buddy list"></a>
<!-- END TEMPLATE: postbit_buddy -->
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=217b8367d82da9e717a39442543e4acf&amp;action=editpost&amp;postid=278701"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;postid=278701"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
			</font></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</td></tr></table>

<!-- spacer --></td><td width="10"><img width="10" height="1" src="images/space.gif" alt=""></td></tr></table>

<!-- END TEMPLATE: postbit -->

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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b><!-- BEGIN TEMPLATE: timezone -->
All times are GMT. The time now is 09:57 AM.
<!-- END TEMPLATE: timezone --></b></font></td>
		<td><a href="newthread.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=217b8367d82da9e717a39442543e4acf&amp;action=newreply&amp;threadid=33966"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=217b8367d82da9e717a39442543e4acf&amp;threadid=33966">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=217b8367d82da9e717a39442543e4acf&amp;action=addsubscription&amp;threadid=33966">Subscribe to this Thread</a>
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
	<td align="right"><!-- BEGIN TEMPLATE: showthread_threadrate -->
<table cellpadding="0" cellspacing="0" border="0">
<form action="threadrate.php" method="get"><tr><td>
	<font face="verdana,arial,helvetica" size="1" >
	<input type="hidden" name="s" value="217b8367d82da9e717a39442543e4acf">
	<input type="hidden" name="threadid" value="33966">
	<b>Rate This Thread:</b><br>
	<select name="vote">
		<option value="-1" selected>Select a rating...</option>
		<option value="5">5 .. Best</option>
		<option value="4">4</option>
		<option value="3">3 .. Average</option>
		<option value="2">2</option>
		<option value="1">1 .. Worst</option>
	</select><!-- BEGIN TEMPLATE: gobutton -->
<!-- go button -->
<input type="image" src="images/go.gif" border="0" 
align="absbottom">
<!-- END TEMPLATE: gobutton -->
	</font>
</td></tr></form>
</table>
<!-- END TEMPLATE: showthread_threadrate --></td>
</tr>
</table>
<!-- /Rate this thread -->

<br>

<!-- forum rules and admin links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr valign="bottom">
	<td><font face="verdana,arial,helvetica" size="1" ><b>Forum Rules:</b><!-- BEGIN TEMPLATE: forumrules -->
<table cellpadding="0" cellspacing="0" border="0" bgcolor="#282E22"><tr><td>
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
		<a href="misc.php?s=217b8367d82da9e717a39442543e4acf&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=217b8367d82da9e717a39442543e4acf&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=217b8367d82da9e717a39442543e4acf&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
	</font></td>
</tr>
</table>
</td></tr></table>
<!-- END TEMPLATE: forumrules --></font></td>
	<td align="right">
	&nbsp;
	</td>
</tr>
</table>
<!-- /forum rules and admin links -->

<!-- BEGIN TEMPLATE: footer -->
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
									</font><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="1">&copy; 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Counter-Strike: Source, and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation.</font></p
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
<!-- END TEMPLATE: footer -->

</body>
</html>
<!-- END TEMPLATE: showthread -->