<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Server runs, but player falls through floor? Plus some errors...</title>
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
	window.open("member.php?s=17b00214c962ecc623f329889041253d&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=17b00214c962ecc623f329889041253d">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=17b00214c962ecc623f329889041253d&amp;forumid=40">Source Game Discussions</a> &gt; <a href="forumdisplay.php?s=17b00214c962ecc623f329889041253d&amp;forumid=45">Source DS (Linux)</a> &gt; Server runs, but player falls through floor? Plus some errors...</b></font></td>
	<td align="right" valign="bottom"><img src="images/5stars.gif" alt="Thread Rating: 3 votes, 5.00 average."></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=4" title="last page">Last &raquo;</a> </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=17b00214c962ecc623f329889041253d&amp;action=newthread&amp;forumid=45"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;threadid=184741"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post1598729"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: Halmstad, Sweden<br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1598729"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon5.gif" alt="Question" border="0"> <b>Server runs, but player falls through floor? Plus some errors...</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >System is now updated to Debian Sarge, without any major issues. I'm also running 2.6.8-1-k7 now. I only had to downgrade psybnc to 3.2, otherwise everything's as it used to be.<br />
<br />
The source server now starts. But I get these errors:<br />
<br />
</font><blockquote><pre><font face="verdana,arial,helvetica" size="1" >code:</font><hr>halflife@amiga:/usr/steam/cs_source$ ./srcds_run -game cstrike +map de_dust +maxplayers 8 +ip 217.209.15.255
Auto detecting CPU
Using AMD Optimised binary.
Auto-restarting the server on crash

Console initialized.
Attempted to create unknown entity type event_queue_saveload_proxy!
Game .dll loaded for "Counter-Strike: Source"
Error parsing 'BotProfile.db' - invalid template reference 'bsite'
maxplayers set to 8
Network: IP 217.209.15.255, mode MP, dedicated Yes, ports 27015 SV / 27005 CL
Executing dedicated server config file
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/zerogxplode
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/wxplo1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/steam1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/bubble
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/bloodspray
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/blood
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/laserbeam
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/laserdot
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/fire1
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/cable
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/cable_lit
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/chain
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/rope
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/blueglow1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/purpleglow1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/purplelaser1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/white
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/physbeam
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/gunsmoke
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/radio
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/ledglow
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/glow01
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/glow
The Navigation Mesh was built using a different version of this map.
couldn't exec server.cfg
Adding master server 207.173.177.12:27011
Adding master server 207.173.177.11:27011
status
hostname:  Counter-Strike: Source
build   :  2187
udp/ip  :  217.209.15.255:27015
map     :  de_dust at: 0 x, 0 y, 0 z
players :  0 (8 max)

#    name userid connected ping loss state adr
<hr></pre></blockquote><font face="verdana, arial, helvetica" size="2" ><br />
<br />
Everything is updated and verified with the steam program. When a player joins, he just falls through the floor and falls into all eternity. Any clues? <img src="images/smilies/confused.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1598729">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1598729">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">12:50 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="fackamato is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=159631" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for fackamato"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=159631"><img src="images/sendpm.gif" border="0" alt="Click here to Send fackamato a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=159631"><img src="images/find.gif" border="0" alt="Find more posts by fackamato"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=159631"><img src="images/buddy.gif" border="0" alt="Add fackamato to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1598729"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1598729"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1602835"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guyver1</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: UK<br>
	Posts: 20</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1602835"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guyver1</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >i get EXACTLY this problem with my server!<br />
<br />
it wouldappear to be an issue with old athlon chips??<br />
<br />
im using an old athlon thunderbird 1.4 Ghz</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1602835">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1602835">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">06:34 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="guyver1 is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=47823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for guyver1"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=47823"><img src="images/sendpm.gif" border="0" alt="Click here to Send guyver1 a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=47823"><img src="images/find.gif" border="0" alt="Find more posts by guyver1"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=47823"><img src="images/buddy.gif" border="0" alt="Add guyver1 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1602835"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1602835"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1605994"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>HeX314</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004<br>
	Location: Klamath Falls, OR<br>
	Posts: 1230</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1605994"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>HeX314</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jan 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Now that we have revived this issue, I would like to make it known that there are several other posts with this issue at hand.  Valve is currently working on a solution, but in my talks with Alfred Reynolds, he claims that he is unable to reproduce the problem.<br />
<br />
I would like to ask that anyone who is experiencing this problem please post the following information:<br />
<br />
CPU type,<br />
Motherboard chipset,<br />
Linux distribution and kernel version.<br />
<br />
My server has the same problem, and my specs are as follows:<br />
<br />
AMD Athlon (Thunderbird) 1.4GHz<br />
KT266 chipset<br />
Gentoo Linux (2.6.8-r8)<br />
<br />
Hopefully, this information can aid Valve in reproducing the problem so that it can be resolved.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1605994">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1605994">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">01:00 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="HeX314 is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=59008" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for HeX314"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=59008"><img src="images/sendpm.gif" border="0" alt="Click here to Send HeX314 a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=59008"><img src="images/find.gif" border="0" alt="Find more posts by HeX314"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=59008"><img src="images/buddy.gif" border="0" alt="Add HeX314 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1605994"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1605994"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1606245"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guyver1</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003<br>
	Location: UK<br>
	Posts: 20</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1606245"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guyver1</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Dec 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Athlon Thunderbird 1.4 Ghz<br />
1Gb RAM<br />
AMD 761 chipset<br />
Motherboard = Giga-Byte GA-7DXR<br />
BIOS F7<br />
Suse 9.2 pro (updated over Yast on sunday to get the latest updates and patches so kernal etcv is whatever is current for Suse Update)<br />
<br />
can check tonight when i get home</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by guyver1 on 11-23-2004 at 01:30 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1606245">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1606245">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">01:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="guyver1 is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=47823" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for guyver1"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=47823"><img src="images/sendpm.gif" border="0" alt="Click here to Send guyver1 a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=47823"><img src="images/find.gif" border="0" alt="Find more posts by guyver1"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=47823"><img src="images/buddy.gif" border="0" alt="Add guyver1 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1606245"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1606245"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1607342"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: Halmstad, Sweden<br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1607342"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >AMD Athlon Thunderbird 1.1ghz 100mhz FSB<br />
ABIT KT7A (KT133A chipset)<br />
Debian Sarge running 2.6.8-1-k7<br />
<br />
The latest BIOS for it (checked yesterday).</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1607342">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1607342">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">03:30 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="fackamato is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=159631" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for fackamato"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=159631"><img src="images/sendpm.gif" border="0" alt="Click here to Send fackamato a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=159631"><img src="images/find.gif" border="0" alt="Find more posts by fackamato"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=159631"><img src="images/buddy.gif" border="0" alt="Add fackamato to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1607342"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1607342"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1607956"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: Brighton - UK<br>
	Posts: 54</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1607956"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Yeah I am getting the same kind of problems.<br />
<br />
This is the output that I get when I run the server.<br />
<br />
<a href="http://www.clan-moss.co.uk/server/output.txt" target="_blank">http://www.clan-moss.co.uk/server/output.txt</a><br />
<br />
I am running a SUSE 9.1 Box, with all the lastest updates aswell.<br />
<br />
AMD Duron 750Mhz,<br />
SiS Chipset Mobo,<br />
256Mb RAM.<br />
<br />
Hope this can help valve solve the problem. I have been reading that it might be a incomaptiblity with glibc2.3.3.<br />
<br />
We will see what valve have to say about it.<br />
<br />
Thanks, Nossta<br />
<br />
<a href="http://www.clan-moss.co.uk" target="_blank">www.clan-moss.co.uk</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1607956">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1607956">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-23-2004 <font color="#D8DED3">04:52 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="NosstaZenith is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=138201" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for NosstaZenith"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=138201"><img src="images/sendpm.gif" border="0" alt="Click here to Send NosstaZenith a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=138201"><img src="images/find.gif" border="0" alt="Find more posts by NosstaZenith"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=138201"><img src="images/buddy.gif" border="0" alt="Add NosstaZenith to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1607956"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1607956"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1615652"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ivinghoe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2004<br>
	Location: <br>
	Posts: 2</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1615652"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ivinghoe</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >This problem seems to be caused by the older amd  cpu`s as it still remains despite updating glibc for users running the amd cpu.<br />
As posted in threads elsewhere  it seems we will have to wait for valve to update the amd srcds files.<br />
For your info I too have the same errors of players falling through the map floor  or being "clamped"<br />
My box runs whitebox enterprise (ie redhat enterprise in all but name) with a AMD Athlon Thunderbird 1ghz cpu and ABIT KT7A mobo etc</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1615652">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1615652">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-24-2004 <font color="#D8DED3">01:23 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ivinghoe is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=84649" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ivinghoe"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=84649"><img src="images/sendpm.gif" border="0" alt="Click here to Send ivinghoe a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=84649"><img src="images/find.gif" border="0" alt="Find more posts by ivinghoe"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=84649"><img src="images/buddy.gif" border="0" alt="Add ivinghoe to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1615652"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1615652"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1616248"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>v3ga</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: <br>
	Posts: 2</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1616248"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>v3ga</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Same problem here.<br />
<br />
1,2 GHz AMD (Thunderbird)<br />
Abit KT7 mobo (KT133 chipset)<br />
Trustix (redhat based distribution)<br />
glibc 2.3.2<br />
<br />
Hope it helps</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1616248">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1616248">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-24-2004 <font color="#D8DED3">02:35 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="v3ga is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=162183" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for v3ga"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=162183"><img src="images/sendpm.gif" border="0" alt="Click here to Send v3ga a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=162183"><img src="images/find.gif" border="0" alt="Find more posts by v3ga"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=162183"><img src="images/buddy.gif" border="0" alt="Add v3ga to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1616248"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1616248"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1625190"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guurk</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 2</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1625190"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>guurk</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>Same issue</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Athlon 1.6 Ghz<br />
KT7 motherboard<br />
Linux 2.4.20-8 Redhat 9<br />
glibc 2.3.2-11.9</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1625190">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1625190">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-25-2004 <font color="#D8DED3">03:25 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="guurk is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=112513" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for guurk"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=112513"><img src="images/sendpm.gif" border="0" alt="Click here to Send guurk a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=112513"><img src="images/find.gif" border="0" alt="Find more posts by guurk"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=112513"><img src="images/buddy.gif" border="0" alt="Add guurk to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1625190"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1625190"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1634573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>probe_79</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: Belgium<br>
	Posts: 1</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1634573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>probe_79</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >vendor_id       : AuthenticAMD<br />
cpu family      : 6<br />
model           : 4<br />
model name      : AMD Athlon(tm) Processor stepping        : 2<br />
cpu MHz         : 996.110<br />
cache size      : 256 KB<br />
<br />
Suse Linux 9.1 Pro<br />
glibc: 2.3.3<br />
<br />
MB: MSI K7T, VIA chipset</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1634573">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1634573">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-25-2004 <font color="#D8DED3">08:43 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="probe_79 is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=75701" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for probe_79"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=75701"><img src="images/sendpm.gif" border="0" alt="Click here to Send probe_79 a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=75701"><img src="images/find.gif" border="0" alt="Find more posts by probe_79"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=75701"><img src="images/buddy.gif" border="0" alt="Add probe_79 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1634573"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1634573"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1634793"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: Brighton - UK<br>
	Posts: 54</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1634793"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon12.gif" alt="Wink" border="0"> <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Guys, can you all do what I did and post a text document of the output of the server when you start it.<br />
<br />
This is will help valve track down what is going on. Also if you can add the switch "-debug debug.log"<br />
<br />
Then post that debug.log too. This will make it quicker and easier for valve to go about solving the problem. You that is what we all want right <img src="images/smilies/wink.gif" border="0" alt=""><br />
<br />
Thanks <br />
<br />
Nosssta<br />
<br />
<a href="http://www.clan-moss.co.uk" target="_blank">www.clan-moss.co.uk</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1634793">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1634793">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-25-2004 <font color="#D8DED3">09:03 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="NosstaZenith is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=138201" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for NosstaZenith"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=138201"><img src="images/sendpm.gif" border="0" alt="Click here to Send NosstaZenith a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=138201"><img src="images/find.gif" border="0" alt="Find more posts by NosstaZenith"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=138201"><img src="images/buddy.gif" border="0" alt="Add NosstaZenith to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1634793"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1634793"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1643399"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004<br>
	Location: Halmstad, Sweden<br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1643399"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fackamato</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Nov 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><i>Originally posted by NosstaZenith </i><br />
<b>Guys, can you all do what I did and post a text document of the output of the server when you start it.<br />
<br />
This is will help valve track down what is going on. Also if you can add the switch "-debug debug.log"<br />
<br />
Then post that debug.log too. This will make it quicker and easier for valve to go about solving the problem. You that is what we all want right <img src="images/smilies/wink.gif" border="0" alt=""><br />
<br />
Thanks <br />
<br />
Nosssta<br />
<br />
<a href="http://www.clan-moss.co.uk" target="_blank">www.clan-moss.co.uk</a> </b><hr></blockquote> <br />
<br />
relevant information here:<br />
<br />
</font><blockquote><pre><font face="verdana,arial,helvetica" size="1" >code:</font><hr>halflife@amiga:/usr/steam/cs_source$ ./server
Auto detecting CPU
Using AMD Optimised binary.
Auto-restarting the server on crash

Console initialized.
Attempted to create unknown entity type event_queue_saveload_proxy!
Game .dll loaded for "Counter-Strike: Source"
Error parsing 'BotProfile.db' - invalid template reference 'bsite'
Unknown command "#"
maxplayers set to 8
Network: IP 217.209.15.155, mode MP, dedicated Yes, ports 27015 SV / 27005 CL
Executing dedicated server config file
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/zerogxplode
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/wxplo1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/steam1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/bubble
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/bloodspray
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/blood
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/laserbeam
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/laserdot
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/fire1
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/cable
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/cable_lit
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/chain
CMaterial::GetNumAnimationFrames:
no representative texture for material cable/rope
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/blueglow1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/purpleglow1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/purplelaser1
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/white
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/physbeam
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/gunsmoke
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/radio
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/ledglow
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/glow01
CMaterial::GetNumAnimationFrames:
no representative texture for material sprites/glow
The Navigation Mesh was built using a different version of this map.
Master server communication disabled.
status
hostname:  Counter-Strike: Source
build   :  2187
udp/ip  :  217.209.15.155:27015
map     :  de_dust at: 0 x, 0 y, 0 z
players :  0 (8 max)

#    name userid connected ping loss state adr
quit
Memory leak: mempool blocks left in memory: 12
Memory leak: mempool blocks left in memory: 368
Fri Nov 26 15:16:39 CET 2004: Server Quit
<hr></pre></blockquote><font face="verdana, arial, helvetica" size="2" ><br />
<br />
contents of server:<br />
<br />
</font><blockquote><pre><font face="verdana,arial,helvetica" size="1" >code:</font><hr>
#!/bin/sh
#
# tehjunkyard.net's Counter-Strike: Source server
#
# ./srcds_run -binary ./srcds_i486 -game cstrike +map de_dust +maxplayers 8 +ip 217.209.15.155 +sv_lan 1
./srcds_run -game cstrike -insecure -nomaster +map de_dust +maxplayers 8 +ip 217.209.15.155 +sv_lan 1
<hr></pre></blockquote><font face="verdana, arial, helvetica" size="2" ><br />
<br />
Tried the debug option, and I didn't get a debug file.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1643399">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1643399">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-26-2004 <font color="#D8DED3">02:21 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="fackamato is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=159631" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for fackamato"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=159631"><img src="images/sendpm.gif" border="0" alt="Click here to Send fackamato a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=159631"><img src="images/find.gif" border="0" alt="Find more posts by fackamato"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=159631"><img src="images/buddy.gif" border="0" alt="Add fackamato to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1643399"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1643399"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1644055"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: Brighton - UK<br>
	Posts: 54</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1644055"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>NosstaZenith</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Yeah I also had the same problem with the debug command. It has worked before, when I had freebsd installed.<br />
<br />
It must be another bug with the AMD binary. I hope valve notices and fixes it soon. I have got a temp windows box up at the moment. I get the same kinda errors in regards to the map errors. So the problem must be with the invalid pointers.<br />
<br />
Nossta<br />
<br />
<a href="http://www.clan-moss.co.uk" target="_blank">www.clan-moss.co.uk</a></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1644055">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1644055">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-26-2004 <font color="#D8DED3">03:56 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="NosstaZenith is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=138201" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for NosstaZenith"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=138201"><img src="images/sendpm.gif" border="0" alt="Click here to Send NosstaZenith a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=138201"><img src="images/find.gif" border="0" alt="Find more posts by NosstaZenith"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=138201"><img src="images/buddy.gif" border="0" alt="Add NosstaZenith to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1644055"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1644055"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1647662"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>white_rabbit</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: southern california<br>
	Posts: 61</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1647662"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>white_rabbit</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >same problem here, has anyeone emailed valve about this? ive noticed the problem coming up and being discussed in some other forums as well... <a href="http://server.counter-strike.net/forums/showthread.php?s=&amp;threadid=34481" target="_blank">http://server.counter-strike.net/fo...;threadid=34481</a><br />
<br />
maybe valve doesnt even know of it.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1647662">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1647662">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-26-2004 <font color="#D8DED3">09:44 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="white_rabbit is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=77484" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for white_rabbit"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=77484"><img src="images/sendpm.gif" border="0" alt="Click here to Send white_rabbit a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=77484"><img src="images/find.gif" border="0" alt="Find more posts by white_rabbit"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=77484"><img src="images/buddy.gif" border="0" alt="Add white_rabbit to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1647662"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1647662"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1655747"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[ade]p00p</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004<br>
	Location: no.<br>
	Posts: 86</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1655747"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>[ade]p00p</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jun 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Valve knows of the problem.<br />
<br />
I experience it with a 1.1ghz Athlon T-bird on Slackware 10.  Glibc 2.3.2.  I think my motherboard has a SiS chipset, but I'll edit this post later and put my motherboard model and chipset.<br />
<br />
The problem is not just with the AMD binary for me, it seems it's with any binary on an AMD system.<br />
<br />
<b>Edit:</b> My motherboard is an MSI MS-6378.  Unsure of the chipset.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by [ade]p00p on 11-28-2004 at 07:02 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=17b00214c962ecc623f329889041253d&amp;postid=1655747">Report this post to a moderator</a> | IP: <a href="postings.php?s=17b00214c962ecc623f329889041253d&amp;action=getip&amp;postid=1655747">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-27-2004 <font color="#D8DED3">04:09 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="[ade]p00p is offline" align="absmiddle">
			<a href="member.php?s=17b00214c962ecc623f329889041253d&amp;action=getinfo&amp;userid=98478" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for [ade]p00p"></a> <a href="private.php?s=17b00214c962ecc623f329889041253d&amp;action=newmessage&amp;userid=98478"><img src="images/sendpm.gif" border="0" alt="Click here to Send [ade]p00p a Private Message"></a>   <a href="search.php?s=17b00214c962ecc623f329889041253d&amp;action=finduser&amp;userid=98478"><img src="images/find.gif" border="0" alt="Find more posts by [ade]p00p"></a> <a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addlist&amp;userlist=buddy&amp;userid=98478"><img src="images/buddy.gif" border="0" alt="Add [ade]p00p to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=17b00214c962ecc623f329889041253d&amp;action=editpost&amp;postid=1655747"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;postid=1655747"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 07:05 AM.</b></font></td>
		<td><a href="newthread.php?s=17b00214c962ecc623f329889041253d&amp;action=newthread&amp;forumid=45"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=17b00214c962ecc623f329889041253d&amp;action=newreply&amp;threadid=184741"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (4): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=3">3</a>  <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a> ... <a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;perpage=15&amp;pagenumber=4" title="last page">Last &raquo;</a> </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=17b00214c962ecc623f329889041253d&amp;threadid=184741">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=17b00214c962ecc623f329889041253d&amp;action=addsubscription&amp;threadid=184741">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="17b00214c962ecc623f329889041253d">
	<input type="hidden" name="threadid" value="184741">
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
		<a href="misc.php?s=17b00214c962ecc623f329889041253d&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=17b00214c962ecc623f329889041253d&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=17b00214c962ecc623f329889041253d&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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