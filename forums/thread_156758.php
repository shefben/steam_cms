<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Tutorial : How To Install Cs:Source On Linux Debian</title>
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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=34bdf799f9f2d40e30720b2fa404e500">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=26">Server Discussions</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=19">Linux Dedicated Server</a> &gt; Tutorial : How To Install Cs:Source On Linux Debian</b></font></td>
	
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
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newthread&amp;forumid=19"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=156758"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post1304573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>servmcs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004<br>
	Location: <br>
	Posts: 6</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1304573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>servmcs</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon4.gif" alt="Exclamation" border="0"> <b>Tutorial : How To Install Cs:Source On Linux Debian</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >This is a little tutorial to help with cs:source on debian, thanx to person wich help me on this forum<br />
<br />
1°) edit /etc/apt/sources.list<br />
<br />
modify version :<br />
<br />
woody or stable or other to sarge<br />
<br />
       exemple :<br />
            deb <a href="ftp://ftp.fr.debian.org/debian/" target="_blank">ftp://ftp.fr.debian.org/debian/</a> sarge main non-free<br />
            deb-src <a href="ftp://ftp.fr.debian.org/debian/" target="_blank">ftp://ftp.fr.debian.org/debian/</a> sarge main non-free<br />
            deb <a href="http://non-us.debian.org/debian-non-US" target="_blank">http://non-us.debian.org/debian-non-US</a> sarge/non-US main non-free<br />
            deb-src <a href="http://non-us.debian.org/debian-non-US" target="_blank">http://non-us.debian.org/debian-non-US</a> sarge/non-US main non-free<br />
           deb <a href="http://security.debian.org/" target="_blank">http://security.debian.org/</a> sarge/updates main non-free<br />
<br />
Then do :<br />
<br />
apt-get update<br />
apt-get upgrade<br />
<br />
then <br />
<br />
apt-get install libc6  gdb<br />
<br />
when asking updata to glic to new version say : Yes<br />
<br />
then your cs:source server will work with command line :<br />
<br />
then make a linux user called steam (or other name or use an existant user)<br />
<br />
exemple : useradd steam<br />
<br />
then : su steam<br />
<br />
cd<br />
<br />
mkdir hl2ds<br />
<br />
cd hl2ds<br />
<br />
wget <a href="http://www.servmcs.com/serveurs/steam.tar.gz" target="_blank">http://www.servmcs.com/serveurs/steam.tar.gz</a><br />
<br />
tar xvzf steam.tar.gz<br />
<br />
rm steam.tar.gz<br />
<br />
./steam (steam client will upgrade to version 10)<br />
<br />
** if you don't have a steam account do : <br />
**  ./steam -command create -username YourUsername -email <a href="mailto:you@isp.com">you@isp.com</a> -password YourPassword -question "who is servmcs ?" -answer myhoster<br />
<br />
** exemple : ( ./steam -command create -username SteamServmcs -email <a href="mailto:steam@servmcs.com">steam@servmcs.com</a> -password steam4servmcs -question "who is servmcs ?" -answer myhoster )<br />
<br />
Now you have to download your cs:source server using your steam account :<br />
<br />
exemple :<br />
<br />
./steam -command update -game "Counter-Strike Source"  -dir /home/steam/hl2ds/ -username SteamServmcs -password steam4servmcs<br />
<br />
<br />
** NOW Cs:Source Is installed **<br />
<br />
don't forget to put a server.cfg to your cstrike/cfg/ directory<br />
<br />
then launch server like this :<br />
<br />
./srcds_run -game cstrike +ip XXX.XXX.XXX.XXX +hostport 270XX +maxplayers 14 +map de_dust2<br />
<br />
if you've got some error like :<br />
<br />
many :<br />
<br />
 free(): invalid pointer 0x401c7d00!<br />
<br />
and other :<br />
<br />
 Executing dedicated server config file<br />
CMaterial::GetNumAnimationFrames:<br />
no representative texture for material sprites/zerogxplode<br />
<br />
server will work !<br />
<br />
don't forget to update hlsw to v1.0.0.31 beta or newer to see cs:source server up<br />
<br />
if you've got any problem post here, i will help you <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1304573">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1304573">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-13-2004 <font color="#D8DED3">11:34 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="servmcs is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=136598" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for servmcs"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=136598"><img src="images/find.gif" border="0" alt="Find more posts by servmcs"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=136598"><img src="images/buddy.gif" border="0" alt="Add servmcs to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1304573"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1304573"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1309863"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ricsto</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">«</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004<br>
	Location: <br>
	Posts: 36</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1309863"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ricsto</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">«</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: May 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Cheers, this worked perfect for me, finally got a source server up <img src="images/smilies/smile.gif" border="0" alt=""></font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1309863">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1309863">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-14-2004 <font color="#D8DED3">07:27 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ricsto is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=91901" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ricsto"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=91901"><img src="images/find.gif" border="0" alt="Find more posts by ricsto"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=91901"><img src="images/buddy.gif" border="0" alt="Add ricsto to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1309863"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1309863"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1331341"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1331341"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>ahh plz help</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >CMaterial::GetNumAnimationFrames:<br />
no representative texture for material sprites/glow<br />
The Navigation Mesh was built using a different version of this map.<br />
Unknown command "mp_logmessages"<br />
Unknown command "allow_spectators"<br />
Unknown command "mp_logmessages"<br />
Adding master server 207.173.177.12:27011<br />
Adding master server 207.173.177.11:27011<br />
"Relentlesch&lt;STEAM_0:0:4126441&gt;" STEAM USERID validated<br />
"GroundSqurl&lt;STEAM_0:1:4564911&gt;" STEAM USERID validated<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: player: Out-of-range value (nan) in SendPropFloat 'm_vecVelocity[0]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2058.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2148.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2238.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2058.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2283.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2081.250000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2328.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2126.250000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2373.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2171.250000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2396.250000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2238.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
DataTable warning: (class player): Out-of-range value (-2463.750000) in SendPropFloat 'm_vecVelocity[2]', clamping.<br />
they just fall forever    redhat 9 amd</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1331341">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1331341">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-17-2004 <font color="#D8DED3">05:11 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="yoshi5 is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=114329" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for yoshi5"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=114329"><img src="images/find.gif" border="0" alt="Find more posts by yoshi5"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=114329"><img src="images/buddy.gif" border="0" alt="Add yoshi5 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1331341"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1331341"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1333573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>krupx</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004<br>
	Location: <br>
	Posts: 6</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1333573"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>krupx</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Mar 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >kernel 2.4 or 2.6 with source ds</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1333573">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1333573">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-17-2004 <font color="#D8DED3">09:51 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="krupx is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=72379" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for krupx"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=72379"><img src="images/find.gif" border="0" alt="Find more posts by krupx"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=72379"><img src="images/buddy.gif" border="0" alt="Add krupx to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1333573"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1333573"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1339316"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1339316"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>grrr</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >how do i know</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1339316">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1339316">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-18-2004 <font color="#D8DED3">03:33 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="yoshi5 is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=114329" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for yoshi5"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=114329"><img src="images/find.gif" border="0" alt="Find more posts by yoshi5"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=114329"><img src="images/buddy.gif" border="0" alt="Add yoshi5 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1339316"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1339316"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1339736"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>taz_frag</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 1</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1339736"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>taz_frag</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>thx for info</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >even though the tutorial was to upgrade debian to sarge is it still possible to run CSS on stable or will it only work on sarge from now on ?<br />
<br />
Thx<br />
<br />
Taz</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1339736">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1339736">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-18-2004 <font color="#D8DED3">04:45 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="taz_frag is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=122025" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for taz_frag"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=122025"><img src="images/find.gif" border="0" alt="Find more posts by taz_frag"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=122025"><img src="images/buddy.gif" border="0" alt="Add taz_frag to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1339736"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1339736"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1341985"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1341985"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>hey</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Linux version 2.4.20-8 (bhcompile@stripples.devel.redhat.com) (gcc version 3.2.2<br />
 20030222 (Red Hat Linux 3.2.2-5)) #1 Thu Mar 13 17:18:24 EST 2003</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1341985">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1341985">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-18-2004 <font color="#D8DED3">09:26 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="yoshi5 is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=114329" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for yoshi5"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=114329"><img src="images/find.gif" border="0" alt="Find more posts by yoshi5"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=114329"><img src="images/buddy.gif" border="0" alt="Add yoshi5 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1341985"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1341985"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1344222"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ReNdo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1344222"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>ReNdo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >thnx man!</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1344222">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1344222">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-19-2004 <font color="#D8DED3">01:12 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="ReNdo is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=116623" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for ReNdo"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=116623"><img src="images/find.gif" border="0" alt="Find more posts by ReNdo"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=116623"><img src="images/buddy.gif" border="0" alt="Add ReNdo to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1344222"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1344222"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post1348671"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004<br>
	Location: <br>
	Posts: 8</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post1348671"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>yoshi5</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Aug 2004</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b>hey</b></font>
	<p><font face="verdana, arial, helvetica" size="2" >any ideas i would like to get my server running</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=1348671">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=1348671">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-19-2004 <font color="#D8DED3">03:48 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="yoshi5 is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=114329" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for yoshi5"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=114329"><img src="images/find.gif" border="0" alt="Find more posts by yoshi5"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=114329"><img src="images/buddy.gif" border="0" alt="Add yoshi5 to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=1348671"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=1348671"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 09:27 PM.</b></font></td>
		<td><a href="newthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newthread&amp;forumid=19"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=156758"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=156758">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addsubscription&amp;threadid=156758">Subscribe to this Thread</a>
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
	<input type="hidden" name="threadid" value="156758">
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