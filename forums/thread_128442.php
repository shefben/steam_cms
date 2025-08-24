<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - How to convert you old 1.6 buyscript</title>
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
	window.open("member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
	<a href="/"><img src="/img/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152" border="0"></a>&nbsp;
	</td>
	<td width="100%" height="54" valign="bottom" align="left" bgcolor="#000000">
	<span style="margin-left:64px;position:absolute;top:32px;">
	<a href="/?area=news"><img name="news" valign="bottom" height="22" width="54" src="/img/news.gif" border="0" 
		onMouseOut="this.src='/img/news.gif';" onMouseOver="this.src='/img/MOnews.gif';" 
		alt="news"></a>

	<a href="/?area=getsteamnow"><img valign="bottom" height="22" width="108" src="/img/getSteamNow.gif" border="0" 
		onMouseOut="this.src='/img/getSteamNow.gif'" onMouseOver="this.src='/img/MOgetSteamNow.gif'" 
		alt="getSteamNow"></a>

	<a href="/?area=cybercafes"><img valign="bottom" height="22" width="95" src="/img/cafes.gif" border="0"
		onMouseOut="this.src='/img/cafes.gif'" onMouseOver="this.src='/img/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="/support.php"><img valign="bottom" height="22" width="68" src="/img/support.gif" border="0" 
		onMouseOut="this.src='/img/support.gif'" onMouseOver="this.src='/img/MOsupport.gif'" 
		alt="Support"></a>

	<a href="/?area=forums"><img valign="bottom" height="22" width="68" src="/img/forums.gif" border="0" 
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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=c8a21e3a8e2552330a36088d16bc5d4e">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;forumid=40">Source Game Discussions</a> &gt; <a href="forumdisplay.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;forumid=37">Counter-Strike: Source</a> &gt; How to convert you old 1.6 buyscript</b></font></td>
	
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
	<a href="showthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;threadid=128442"><img src="images/closed.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post1007846"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EKS</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: Norway<br>
	Posts: 220</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1007846"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EKS</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>How to convert you old 1.6 buyscript</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >This post was made to explain to players of Counter-strike source how to<br />
convert their old buy script from CS 1.6. Its painfully easy realy, what you <br />
have to do it edit old script and add "buy" infront of the weapon your are buying.<br />
<br />
Here is a example:<br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>The Old 1.6 way</i><br />
alias buyteamheavy "sg552;primammo"<br />
<hr></blockquote> <br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>How to do it in CS S</i><br />
alias buyteamheavy "buy aug;buy sg552;buy primammo"<br />
<hr></blockquote> <br />
<br />
Here is a list of all the commands the buy command supports:<br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><br />
usage: buy &lt;item&gt;<br />
  primammo<br />
  secammo<br />
  vest<br />
  vesthelm<br />
  defuser<br />
  nvgs<br />
  flashbang<br />
  hegrenade<br />
  smokegrenade<br />
  galil<br />
  ak47<br />
  scout<br />
  sg552<br />
  awp<br />
  g3sg1<br />
  famas<br />
  m4a1<br />
  aug<br />
  sg550<br />
  glock<br />
  usp<br />
  p228<br />
  deagle<br />
  elite<br />
  fiveseven<br />
  m3<br />
  xm1014<br />
  mac10<br />
  tmp<br />
  mp5navy<br />
  ump45<br />
  p90<br />
  m249<br />
<hr></blockquote><br />
<br />
<b>How to install your newly made buy script</b><br />
First off find your steam folder, then got to: Valve Steam\SteamApps\Your@MailAddy.com\counter-strike source beta\cstrike\cfg<br />
place your buyscript in this folder ( or the one you can download from the bottom off the post).<br />
Then edit your config.cfg and add <blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr>exec buyscript.cfg<hr></blockquote> ( Notice that you dont have to add exec cfg/buyscript.cfg, it assumes your running a config inside the cfg folder)<br />
<br />
<a href="http://eks.wtfux.com/buyscript.cfg" target="_blank">Download example buyscript</a> ( Hosted by: <a href="http://www.clanhq.com" target="_blank">www.clanhq.com</a> )<br />
<br />
EDIT:<br />
Also note that the source engine will not allow you to load as big "scripts" as HL1 did. You will get a error message "<br />
Cbuf_AddText: buffer overflow", this means in my xp that the file you executed is to big. Just cut you script into several files (HL1 allowed me to exec files around 15kb but source only allows about 7kb)</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by EKS on 08-23-2004 at 12:32 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1007846">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1007846">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">12:21 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="EKS is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=5412" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for EKS"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=5412"><img src="images/sendpm.gif" border="0" alt="Click here to Send EKS a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=5412"><img src="images/find.gif" border="0" alt="Find more posts by EKS"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=5412"><img src="images/buddy.gif" border="0" alt="Add EKS to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1007846"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1007846"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1007954"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dank</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: mn<br>
	Posts: 809</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1007954"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dank</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >thx but there are many of these</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1007954">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1007954">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">12:34 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Dank is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=5216" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Dank"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=5216"><img src="images/sendpm.gif" border="0" alt="Click here to Send Dank a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=5216"><img src="images/find.gif" border="0" alt="Find more posts by Dank"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=5216"><img src="images/buddy.gif" border="0" alt="Add Dank to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1007954"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1007954"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1007963"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>skot</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Right'Here/Right'Now<br>
	Posts: 271</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1007963"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>skot</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon11.gif" alt="Red face" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Old</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1007963">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1007963">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">12:35 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="skot is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=77368" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for skot"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=77368"><img src="images/sendpm.gif" border="0" alt="Click here to Send skot a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=77368"><img src="images/find.gif" border="0" alt="Find more posts by skot"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=77368"><img src="images/buddy.gif" border="0" alt="Add skot to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1007963"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1007963"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1007964"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EKS</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: Norway<br>
	Posts: 220</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1007964"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>EKS</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by Dank </i><br />
<b>thx but there are many of these </b><hr></blockquote> <br />
i dident notice any, now there is one more <img src="images/smilies/smile.gif" border="0" alt=""> Hopefully it will helpsomeone <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1007964">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1007964">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">12:35 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="EKS is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=5412" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for EKS"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=5412"><img src="images/sendpm.gif" border="0" alt="Click here to Send EKS a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=5412"><img src="images/find.gif" border="0" alt="Find more posts by EKS"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=5412"><img src="images/buddy.gif" border="0" alt="Add EKS to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1007964"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1007964"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1007974"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dank</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: mn<br>
	Posts: 809</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1007974"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Dank</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >try the seach button ..</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1007974">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1007974">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">12:36 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Dank is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=5216" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Dank"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=5216"><img src="images/sendpm.gif" border="0" alt="Click here to Send Dank a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=5216"><img src="images/find.gif" border="0" alt="Find more posts by Dank"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=5216"><img src="images/buddy.gif" border="0" alt="Add Dank to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1007974"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1007974"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1009221"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>V3n0m666</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Brazil<br>
	Posts: 288</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1009221"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>V3n0m666</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">лл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I used to use some buyammo1 and buyammo2 on 1.6 for some weapons like awp.<br />
<br />
How can I do this on CSS??? <br />
"buy buyammo1" <br />
or <br />
"buy ammo1"<br />
<br />
I cant test now brecause CCS just crashes to desktop after loading map.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1009221">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1009221">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">03:27 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="V3n0m666 is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=11482" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for V3n0m666"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=11482"><img src="images/sendpm.gif" border="0" alt="Click here to Send V3n0m666 a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=11482"><img src="images/find.gif" border="0" alt="Find more posts by V3n0m666"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=11482"><img src="images/buddy.gif" border="0" alt="Add V3n0m666 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1009221"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1009221"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1009225"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003<br>
	Location: Corona, California, USA<br>
	Posts: 9641</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1009225"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>smash</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Super Moderator <font face='wingdings'>a</font></font><br><br>
                <img src="avatar.php?userid=41245&amp;dateline=1092878248" border="0" alt=""><p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Very helpful, yes.  But there are too many of these threads.  Thanks though.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;postid=1009225">Report this post to a moderator</a> | IP: <a href="postings.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getip&amp;postid=1009225">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	08-23-2004 <font color="#D8DED3">03:29 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="smash is offline" align="absmiddle">
			<a href="member.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=getinfo&amp;userid=41245" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for smash"></a> <a href="private.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newmessage&amp;userid=41245"><img src="images/sendpm.gif" border="0" alt="Click here to Send smash a Private Message"></a>   <a href="search.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=finduser&amp;userid=41245"><img src="images/find.gif" border="0" alt="Find more posts by smash"></a> <a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addlist&amp;userlist=buddy&amp;userid=41245"><img src="images/buddy.gif" border="0" alt="Add smash to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=editpost&amp;postid=1009225"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;postid=1009225"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 02:30 PM.</b></font></td>
		<td><a href="newthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newthread&amp;forumid=37"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=newreply&amp;threadid=128442"><img src="images/closed.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;threadid=128442">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=addsubscription&amp;threadid=128442">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="c8a21e3a8e2552330a36088d16bc5d4e">
	<input type="hidden" name="threadid" value="128442">
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
		<a href="misc.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=c8a21e3a8e2552330a36088d16bc5d4e&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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
<td width="555" height="34" valign="top" xpos="356"><img src="/img/valve_greenlogo.gif" width="136" height="30" align="center" border="0"></td>
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