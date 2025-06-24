<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - New Shield/Colt Bug *Demo Included*</title>
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
	window.open("member.php?s=c436211363f25f0d67f8acf831883696&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


}
// -->
</script>
</head>
<body bgcolor="#4C5844" text="#A0AA95" id="all" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000020" vlink="#000020" alink="#000020">
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
<table bgcolor="#4C5844" width="95%" cellpadding="10" cellspacing="0" border="0">
<tr>
  <td>


<!-- breadcrumb, nav links -->
<table cellpadding="2" cellspacing="0" border="0" width="100%"  align="center">
<tr>
	<td><img src="images/vb_bullet.gif" border="0" align="middle" alt="Steam Users Forums : Powered by vBulletin version 2.2.9">
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=c436211363f25f0d67f8acf831883696">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=c436211363f25f0d67f8acf831883696&forumid=13">Steam Beta 2.0 Discussions</a> &gt; <a href="forumdisplay.php?s=c436211363f25f0d67f8acf831883696&forumid=14">General</a> &gt; New Shield/Colt Bug *Demo Included*</b></font></td>
	
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
	<a href="showthread.php?s=c436211363f25f0d67f8acf831883696&threadid=7678&goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c436211363f25f0d67f8acf831883696&threadid=7678&goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=c436211363f25f0d67f8acf831883696&action=newthread&forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&threadid=7678"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47549"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>3ffici3nt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: VALVe's Lunch Box<br>
	Posts: 209</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon4.gif" alt="Exclamation" border="0"> <b>New Shield/Colt Bug *Demo Included*</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I was a Terrorist holding a shield, but I happen to walk over a colt and it Picked It Up!  I could use shield and the colt!  The primary weapon was the colt, and if I switched to Secondary, it would switch to shield.  It was crazy because people thought I was cheating.  I recorded a demo for proof.  Hope you fix this bug Erik, but I really like this bug, owning with shield and colt at same time.<img src="images/smilies/biggrin.gif" border="0" alt="">   <br />
<br />
Here is the link to the demo:<br />
<br />
<a href="http://www.clan69.org/pics/demo.dem" target="_blank">http://www.clan69.org/pics/demo.dem</a></font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
3ffici3nt~<br />
/forums</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47549">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47549">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">06:11 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="3ffici3nt is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2544" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 3ffici3nt"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2544"><img src="images/sendpm.gif" border="0" alt="Click here to Send 3ffici3nt a Private Message"></a>  <a href="http://www.steampowered.com" target="_blank"><img src="images/home.gif" alt="Visit 3ffici3nt's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2544"><img src="images/find.gif" border="0" alt="Find more posts by 3ffici3nt"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2544"><img src="images/buddy.gif" border="0" alt="Add 3ffici3nt to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47549"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47549"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47555"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>3ffici3nt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: VALVe's Lunch Box<br>
	Posts: 209</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Please post replies, are u getting this bug too?</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
3ffici3nt~<br />
/forums</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47555">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47555">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">06:20 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="3ffici3nt is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2544" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 3ffici3nt"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2544"><img src="images/sendpm.gif" border="0" alt="Click here to Send 3ffici3nt a Private Message"></a>  <a href="http://www.steampowered.com" target="_blank"><img src="images/home.gif" alt="Visit 3ffici3nt's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2544"><img src="images/find.gif" border="0" alt="Find more posts by 3ffici3nt"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2544"><img src="images/buddy.gif" border="0" alt="Add 3ffici3nt to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47555"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47555"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47580"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>3ffici3nt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: VALVe's Lunch Box<br>
	Posts: 209</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Please reply.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
3ffici3nt~<br />
/forums</font></p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by 3ffici3nt on 07-05-2003 at 08:12 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47580">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47580">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">07:01 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="3ffici3nt is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2544" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 3ffici3nt"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2544"><img src="images/sendpm.gif" border="0" alt="Click here to Send 3ffici3nt a Private Message"></a>  <a href="http://www.steampowered.com" target="_blank"><img src="images/home.gif" alt="Visit 3ffici3nt's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2544"><img src="images/find.gif" border="0" alt="Find more posts by 3ffici3nt"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2544"><img src="images/buddy.gif" border="0" alt="Add 3ffici3nt to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47580"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47580"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47649"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>g0d</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: cali<br>
	Posts: 134</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>well..</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Im guessing that'll be fixed tonight with the new update or sometime very soon...tired of people exploiting the shield...g0d mode anyone?</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Area 51<br />
Intel Pentium 4 CPU 3.00GHz, 2.99GHz (x2)<br />
1023MB ram<br />
80.1GB HD x2<br />
NVIDIA GeForce FX 5900 Ultra (256MB)<br />
Creative SB Audigy</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47649">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47649">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">08:21 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="g0d is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=8674" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for g0d"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=8674"><img src="images/sendpm.gif" border="0" alt="Click here to Send g0d a Private Message"></a>  <a href="http://ps.snoogins.net" target="_blank"><img src="images/home.gif" alt="Visit g0d's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=8674"><img src="images/find.gif" border="0" alt="Find more posts by g0d"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=8674"><img src="images/buddy.gif" border="0" alt="Add g0d to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47649"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47649"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47658"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Raging_Wulf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Badass Steam User</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: in the closet, hiding from &quot;them&quot;<br>
	Posts: 497</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >lol, that's a weird bug you're using. Mayhap you've changed some settings in steam/cs or your controls in such a way that it was caused?</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
If you ever see anything wrong about my posts, please, admin_slap me and correct me</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47658">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47658">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">08:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Raging_Wulf is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=9811" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Raging_Wulf"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=9811"><img src="images/sendpm.gif" border="0" alt="Click here to Send Raging_Wulf a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=9811"><img src="images/find.gif" border="0" alt="Find more posts by Raging_Wulf"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=9811"><img src="images/buddy.gif" border="0" alt="Add Raging_Wulf to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47658"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47658"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47659"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>s-p</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: <br>
	Posts: 616</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Post in the right forum and you may get the sort of replies you require.  <br />
<br />
* This is a Steam forum, you wanna be posting in here:<br />
<a href="/forums/forumdisplay.php?s=&forumid=12" target="_blank">/forums/...p?s=&forumid=12</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47659">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47659">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">08:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="s-p is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2009" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for s-p"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2009"><img src="images/sendpm.gif" border="0" alt="Click here to Send s-p a Private Message"></a>  <a href="http://sahn.co.uk" target="_blank"><img src="images/home.gif" alt="Visit s-p's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2009"><img src="images/find.gif" border="0" alt="Find more posts by s-p"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2009"><img src="images/buddy.gif" border="0" alt="Add s-p to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47659"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47659"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47679"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Raging_Wulf</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Badass Steam User</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: in the closet, hiding from &quot;them&quot;<br>
	Posts: 497</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >DAMMIT cant find the right command for viewing a demo, lol <img src="images/smilies/tongue.gif" border="0" alt=""></font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
If you ever see anything wrong about my posts, please, admin_slap me and correct me</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47679">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47679">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">09:00 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Raging_Wulf is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=9811" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Raging_Wulf"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=9811"><img src="images/sendpm.gif" border="0" alt="Click here to Send Raging_Wulf a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=9811"><img src="images/find.gif" border="0" alt="Find more posts by Raging_Wulf"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=9811"><img src="images/buddy.gif" border="0" alt="Add Raging_Wulf to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47679"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47679"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47682"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>JayBee</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2003<br>
	Location: <br>
	Posts: 44</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Raging_Wulf </i><br />
<b>DAMMIT cant find the right command for viewing a demo, lol <img src="images/smilies/tongue.gif" border="0" alt=""> </b><hr></blockquote> <br />
<br />
"playdemo demo.dem" or "viewdemo demo.dem" if you extra features such as pause, slowmotion....and more.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47682">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47682">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">09:03 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="JayBee is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=6975" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for JayBee"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=6975"><img src="images/sendpm.gif" border="0" alt="Click here to Send JayBee a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=6975"><img src="images/find.gif" border="0" alt="Find more posts by JayBee"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=6975"><img src="images/buddy.gif" border="0" alt="Add JayBee to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47682"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47682"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47683"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>3ffici3nt</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Moderator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: VALVe's Lunch Box<br>
	Posts: 209</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by s-p </i><br />
<b>Post in the right forum and you may get the sort of replies you require.  <br />
<br />
* This is a Steam forum, you wanna be posting in here:<br />
<a href="/forums/forumdisplay.php?s=&forumid=12" target="_blank">/forums/...p?s=&forumid=12</a> </b><hr></blockquote> <br />
<br />
This is a General forum. Which can be pretty much about anything.  Plus, there is hardly any posters in Support forum.  And no I did not do any exploit or command to use colt and shield, I swear.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
3ffici3nt~<br />
/forums</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47683">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47683">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">09:06 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="3ffici3nt is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2544" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 3ffici3nt"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2544"><img src="images/sendpm.gif" border="0" alt="Click here to Send 3ffici3nt a Private Message"></a>  <a href="http://www.steampowered.com" target="_blank"><img src="images/home.gif" alt="Visit 3ffici3nt's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2544"><img src="images/find.gif" border="0" alt="Find more posts by 3ffici3nt"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2544"><img src="images/buddy.gif" border="0" alt="Add 3ffici3nt to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47683"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47683"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47708"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>vh1</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Senior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: <br>
	Posts: 133</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I've seen the sheild colt bug before, thanks for taking a demo of it!<br />
I'll try to get one of the general sheild bug that people keep using</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47708">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47708">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">10:34 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="vh1 is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=1280" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for vh1"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=1280"><img src="images/sendpm.gif" border="0" alt="Click here to Send vh1 a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=1280"><img src="images/find.gif" border="0" alt="Find more posts by vh1"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=1280"><img src="images/buddy.gif" border="0" alt="Add vh1 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47708"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47708"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47718"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>82ross</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2003<br>
	Location: <br>
	Posts: 73</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Just make one yourself. You should know how todo the exploit by now. Its getting around. And it sucks the ass.<br />
<br />
Why cant i attatch a zip that is less than 500k?<br />
<br />
Anyway heres a demo of the the first bug.<br />
<br />
<a href="http://Whoops didnt see that whole other thread with demos :P" target="_blank">Whoops didnt see that whole other thread with demos :P</a><br />
<br />
Dunno how reliable me space is.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by 82ross on 07-06-2003 at 12:08 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47718">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47718">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-05-2003 <font color="#D8DED3">11:14 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="82ross is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=9314" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for 82ross"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=9314"><img src="images/sendpm.gif" border="0" alt="Click here to Send 82ross a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=9314"><img src="images/find.gif" border="0" alt="Find more posts by 82ross"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=9314"><img src="images/buddy.gif" border="0" alt="Add 82ross to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47718"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47718"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47782"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ReutherMonkey</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Steam Ad/\/\inistrator</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: TEJAS AMIGO!!!<br>
	Posts: 202</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by 3ffici3nt </i><br />
<b>This is a General forum. Which can be pretty much about anything.  Plus, there is hardly any posters in Support forum.  And no I did not do any exploit or command to use colt and shield, I swear. </b><hr></blockquote> <br />
<br />
general forum usually is for things that dont fit in other forums. if you post in a support forum, people will reply.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
----Currently Down ----<br />
38.113.32.114:27035 Kansas City | CS 1.6  - 18 players<br />
38.113.32.114:27045 Kansas City | TFC 1.5 - 32 players</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47782">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47782">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-06-2003 <font color="#D8DED3">01:42 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ReutherMonkey is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=5427" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ReutherMonkey"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=5427"><img src="images/sendpm.gif" border="0" alt="Click here to Send ReutherMonkey a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=5427"><img src="images/find.gif" border="0" alt="Find more posts by ReutherMonkey"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=5427"><img src="images/buddy.gif" border="0" alt="Add ReutherMonkey to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47782"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47782"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47820"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>iG | frequency</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Virginia<br>
	Posts: 37</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i got that bug too....  but its not just with the shield/colt i think... i had a galil when i picked up the shield.  it was pretty f-ing tight though. lol       w/e</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
whats your frequency?</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47820">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47820">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-06-2003 <font color="#D8DED3">03:47 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="iG | frequency is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=10164" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for iG | frequency"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=10164"><img src="images/sendpm.gif" border="0" alt="Click here to Send iG | frequency a Private Message"></a>  <a href="http://www.immortalgeneration.tk" target="_blank"><img src="images/home.gif" alt="Visit iG | frequency's homepage!" border="0"></a> <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=10164"><img src="images/find.gif" border="0" alt="Find more posts by iG | frequency"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=10164"><img src="images/buddy.gif" border="0" alt="Add iG | frequency to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47820"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47820"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post47923"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dark Player</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2003<br>
	Location: <br>
	Posts: 26</font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >This is an OLD bug. I already posted it like a month ago but nobody reply. And yes it works with every guns.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c436211363f25f0d67f8acf831883696&postid=47923">Report this post to a moderator</a> | IP: <a href="postings.php?s=c436211363f25f0d67f8acf831883696&action=getip&postid=47923">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	07-06-2003 <font color="#D8DED3">08:49 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Dark Player is offline" align="absmiddle">
			<a href="member.php?s=c436211363f25f0d67f8acf831883696&action=getinfo&userid=2076" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Dark Player"></a> <a href="private.php?s=c436211363f25f0d67f8acf831883696&action=newmessage&userid=2076"><img src="images/sendpm.gif" border="0" alt="Click here to Send Dark Player a Private Message"></a>   <a href="search.php?s=c436211363f25f0d67f8acf831883696&action=finduser&userid=2076"><img src="images/find.gif" border="0" alt="Find more posts by Dark Player"></a> <a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addlist&userlist=buddy&userid=2076"><img src="images/buddy.gif" border="0" alt="Add Dark Player to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c436211363f25f0d67f8acf831883696&action=editpost&postid=47923"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&postid=47923"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 05:35 AM.</b></font></td>
		<td><a href="newthread.php?s=c436211363f25f0d67f8acf831883696&action=newthread&forumid=14"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c436211363f25f0d67f8acf831883696&action=newreply&threadid=7678"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=c436211363f25f0d67f8acf831883696&threadid=7678&goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c436211363f25f0d67f8acf831883696&threadid=7678&goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=c436211363f25f0d67f8acf831883696&threadid=7678">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=c436211363f25f0d67f8acf831883696&threadid=7678">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=c436211363f25f0d67f8acf831883696&action=addsubscription&threadid=7678">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="c436211363f25f0d67f8acf831883696">
	<input type="hidden" name="daysprune" value="">
	<b>Forum Jump:</b><br>
	<select name="forumid"
	onchange="window.location=('forumdisplay.php?s=c436211363f25f0d67f8acf831883696&daysprune=&forumid='+this.options[this.selectedIndex].value)">
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
	<input type="hidden" name="s" value="c436211363f25f0d67f8acf831883696">
	<input type="hidden" name="threadid" value="7678">
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
		<a href="misc.php?s=c436211363f25f0d67f8acf831883696&action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=c436211363f25f0d67f8acf831883696&action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=c436211363f25f0d67f8acf831883696&action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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