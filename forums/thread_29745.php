<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - FATAL ERROR (shutting down): File read failure</title>
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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=34bdf799f9f2d40e30720b2fa404e500">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=26">Server Discussions</a> &gt; <a href="forumdisplay.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;forumid=19">Linux Dedicated Server</a> &gt; FATAL ERROR (shutting down): File read failure</b></font></td>
	
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (2): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a>  </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=29745"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<a name="post186963"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post186963"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" ><img src="images/icons/icon2.gif" alt="Arrow" border="0"> <b>FATAL ERROR (shutting down): File read failure</b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><br />
[lambda@dorm213-155 lambda]$ su root<br />
Password:<br />
[root@dorm213-155 lambda]# cd /<br />
[root@dorm213-155 /]# cd usr/steam/hlds_l<br />
[root@dorm213-155 hlds_l]# ./hlds_run -debug -game ns +port 27030 +maxplayers 12 +map ns_eclipse<br />
Auto detecting CPU<br />
Using Pentium II Optimised binary.<br />
Enabling debug mode<br />
./hlds_run: line 1: gdb: command not found<br />
Please install gdb first.<br />
goto <a href="http://www.gnu.org/software/gdb/" target="_blank">http://www.gnu.org/software/gdb/</a><br />
Auto-restarting the server on crash<br />
<br />
Console initialized.<br />
scandir failed:/usr/steam/hlds_l/./platform/SAVE<br />
Protocol version 46<br />
Exe version 1.1.2.0/Stdio (valve)<br />
Exe build: 16:27:22 Oct 13 2003 (2545)<br />
couldn't exec language.cfg<br />
Server IP address 155.31.213.155:27030<br />
<br />
   Metamod version 1.16.2  Copyright (c) 2001-2003 Will Day &lt;willday@metamod.org&gt;<br />
   Metamod comes with ABSOLUTELY NO WARRANTY; for details type `meta gpl'.<br />
   This is free software, and you are welcome to redistribute it<br />
   under certain conditions; type `meta gpl' for details.<br />
<br />
scandir failed:/usr/steam/hlds_l/./platform/SAVE<br />
FATAL ERROR (shutting down): File read failure<br />
Add "-debug" to the ./hlds_run command line to generate a debug.log to help with solving this problem<br />
Sat Oct 25 04:17:26 EDT 2003: Server restart in 10 seconds<br />
<hr></blockquote><br />
<br />
And I'm activating hlds_run with this: <br />
<br />
</font><blockquote><pre><font face="verdana,arial,helvetica" size="1" >code:</font><hr>
#!/bin/sh
cd /usr/steam/hlds_l
echo `date` &gt;&gt; lognsserverstartup.txt
sleep 1
echo "now starting the server"
sleep 1
./hlds_run -debug -pingboost 1 -game ns \
+maxplayers 18 +map ns_eclipse +port 27017 -debug
<hr></pre></blockquote><font face="verdana, arial, helvetica" size="2" ><br />
<br />
So I got my CS 1.6 Linux server w/amx mod running like a champ, but I added an ns server w/amx and everytime I try to run it it gives me this error and then restarts continuously. I know that AMX mod and Metamod are not the problem, because I set the "liblist.gam" back to "dll/ns_i386.so" and it gave me the same error. Not to mention you can see that Metamod loads in the quote above. <br />
<br />
I downloaded GDB in some fruitless attempt to "debug" the problem, but that is beyond me. Does anyone have any ideas?<br />
<br />
been working on this server for the last two days stright... lol<br />
-Rick<br />
<br />
****I edited this msg and added the above 2nd quote at 10:33am on Octover 25th, 2003****</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by DSC-Mutter on 10-25-2003 at 03:33 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=186963">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=186963">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-25-2003 <font color="#D8DED3">09:29 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=186963"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=186963"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post186977"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 17</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post186977"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >chmod -Rv 777 ? maybe?</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=186977">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=186977">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-25-2003 <font color="#D8DED3">09:48 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="She Said Destro is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35215" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for She Said Destro"></a>   <!--<a href="http://www.hivelan.com" target="_blank"><img src="images/home.gif" alt="Visit She Said Destro's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35215"><img src="images/find.gif" border="0" alt="Find more posts by She Said Destro"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35215"><img src="images/buddy.gif" border="0" alt="Add She Said Destro to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=186977"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=186977"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post187239"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post187239"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Destro I'm still learning Linux, all the stuff I did with that CS server I learned with FAQs and by searching through 3 forum communities, not because I know alot about linux . <br />
<br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr> chmod -Rv 777 <hr></blockquote><br />
<br />
I'm prolly not gona have a Linux for dummies book till next week so could I ask What does the -Rv standfor?<br />
<br />
Respectfully<br />
-Rick</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=187239">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=187239">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-25-2003 <font color="#D8DED3">03:27 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=187239"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=187239"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post187355"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 1107</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post187355"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >first get gdb(only way debugging will work).  it should be a package for your distro. then start hlds with this command.<br />
<br />
./hlds_run -debug -game ns +port 27030 -debug <br />
<br />
another thing to try is remove metamod if you have a plugin that's really messed up it could be crashing the server.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=187355">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=187355">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-25-2003 <font color="#D8DED3">05:01 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="lart is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10492" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for lart"></a>   <!--<a href="http://lart2150.ath.cx" target="_blank"><img src="images/home.gif" alt="Visit lart's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10492"><img src="images/find.gif" border="0" alt="Find more posts by lart"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10492"><img src="images/buddy.gif" border="0" alt="Add lart to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=187355"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=187355"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post187913"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 17</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post187913"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >-Rv make the command recursive (affects the directory and all within) (R) and verbose (v).</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=187913">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=187913">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-26-2003 <font color="#D8DED3">12:07 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="She Said Destro is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35215" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for She Said Destro"></a>   <!--<a href="http://www.hivelan.com" target="_blank"><img src="images/home.gif" alt="Visit She Said Destro's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35215"><img src="images/find.gif" border="0" alt="Find more posts by She Said Destro"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35215"><img src="images/buddy.gif" border="0" alt="Add She Said Destro to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=187913"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=187913"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post188013"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 1107</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post188013"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >it's being run as root so it does not matter</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=188013">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=188013">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-26-2003 <font color="#D8DED3">01:09 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="lart is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10492" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for lart"></a>   <!--<a href="http://lart2150.ath.cx" target="_blank"><img src="images/home.gif" alt="Visit lart's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10492"><img src="images/find.gif" border="0" alt="Find more posts by lart"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10492"><img src="images/buddy.gif" border="0" alt="Add lart to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=188013"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=188013"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post188080"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>LightF00t</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Houston<br>
	Posts: 65</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post188080"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>LightF00t</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >fyi, whenever in doubt about a particular command someone tells you to use, simply type man command.<br />
<br />
i.e. man chmod. It will show you the manual pages on the command and give you more information than you could possibly use <img src="images/smilies/smile.gif" border="0" alt=""><br />
<br />
Also, unless you want to make every file in the directory structure read write and execute, I would not use the -R switch.<br />
<br />
As for ns not loading, it appears that you have either a missing or corrupted binary. not sure which since the logs aren't specific about what file failed to load.</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by LightF00t on 10-26-2003 at 01:07 AM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=188080">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=188080">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-26-2003 <font color="#D8DED3">01:57 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="LightF00t is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35431" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for LightF00t"></a>   <!--<a href="http://www.needsomeskill.com" target="_blank"><img src="images/home.gif" alt="Visit LightF00t's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35431"><img src="images/find.gif" border="0" alt="Find more posts by LightF00t"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35431"><img src="images/buddy.gif" border="0" alt="Add LightF00t to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=188080"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=188080"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post188153"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 1107</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post188153"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >I have seen this error a few weeks back I don't rember what fixed it but it was something lame.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=188153">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=188153">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-26-2003 <font color="#D8DED3">01:35 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="lart is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10492" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for lart"></a>   <!--<a href="http://lart2150.ath.cx" target="_blank"><img src="images/home.gif" alt="Visit lart's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10492"><img src="images/find.gif" border="0" alt="Find more posts by lart"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10492"><img src="images/buddy.gif" border="0" alt="Add lart to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=188153"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=188153"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post188525"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post188525"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >ok well I did everything imaginable to get try to get this thing working. <br />
<br />
I 'chmod -Rv 777'ed hlds_run, replaced a metamod enabled liblist.gam with a stock one, and then I totally deleted the NS folder and started from scratch after 10 other ideas of mine did not work... it wont even work without the damn metamod... with or without the 2.0-2.01 update... sigh<br />
<br />
<br />
lol... anyone have any ideas?<br />
-Rick</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=188525">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=188525">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-26-2003 <font color="#D8DED3">09:54 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=188525"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=188525"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post189863"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>AfroFire</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: Lake Forest, CA<br>
	Posts: 69</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post189863"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>AfroFire</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">л</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Make sure when you do admin_install you are in the directory "Adminmod"... not the old "Admin" directory <img src="images/smilies/smile.gif" border="0" alt=""><br />
<br />
That was my problem.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=189863">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=189863">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">05:06 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="AfroFire is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=11021" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for AfroFire"></a>    <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=11021"><img src="images/find.gif" border="0" alt="Find more posts by AfroFire"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=11021"><img src="images/buddy.gif" border="0" alt="Add AfroFire to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=189863"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=189863"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post189918"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post189918"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Umm... I'm running AMX Mod, not Admin Mod. <br />
<br />
:-/<br />
-Rick</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=189918">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=189918">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">05:44 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=189918"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=189918"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190059"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190059"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" ><blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr><br />
Executing AMX Configuration File<br />
Scrolling message displaying frequency: 10:00 minutes<br />
Adding auth server 65.73.232.251:27040<br />
Adding auth server 65.73.232.253:27040<br />
Adding master server 207.173.177.12:27010<br />
Adding master server 207.173.177.11:27010<br />
Type 'amx_help' in the console to see available commands<br />
Time Left: 59:43 min. Next Map: ns_caged<br />
status<br />
hostname:  Lambda NS v2.0 - darkspireclan.net<br />
version :  46/1.1.2.0/Stdio 2545 insecure<br />
tcp/ip  :<br />
map     :  ns_eclipse at: 0 x, 0 y, 0 z<br />
players :  0 active (18 max)<br />
<br />
#      name userid uniqueid frag time ping loss adr<br />
0 users<br />
<hr></blockquote><br />
<br />
While none of you were able to actually fix/identify the problem for me, I would like to thank you all for you're imput [LART IS THE MAN] -&gt; It really helped me alot! In the last two days I've learned an increadible amount about Linux ... lol 2 days ago I had never used linux!<br />
<br />
The NS Server is running AMX Mod/Meta Mod... I've yet to join it to test it out... ill keep you guys posted on it. Till then, here is what you guys made possible!<br />
<br />
Pic of the CS/NS Server<br />
<a href="http://www.darkspireclan.net/msg/files/both.jpg" target="_blank">http://www.darkspireclan.net/msg/files/both.jpg</a><br />
<a href="http://www.darkspireclan.net/msg/viewtopic.php?t=273" target="_blank">http://www.darkspireclan.net/msg/viewtopic.php?t=273</a><br />
<br />
Picture of the NS Server<br />
<a href="http://www.darkspireclan.net/msg/files/ns.jpg" target="_blank">http://www.darkspireclan.net/msg/files/ns.jpg</a><br />
<a href="http://www.darkspireclan.net/msg/viewtopic.php?t=272" target="_blank">http://www.darkspireclan.net/msg/viewtopic.php?t=272</a><br />
<br />
Your Linux n00b,<br />
-Rick</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by DSC-Mutter on 10-27-2003 at 04:26 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190059">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190059">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">08:34 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190059"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190059"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190807"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 17</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190807"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>She Said Destro</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >so what was the problem ? =P</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190807">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190807">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">09:25 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="She Said Destro is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35215" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for She Said Destro"></a>   <!--<a href="http://www.hivelan.com" target="_blank"><img src="images/home.gif" alt="Visit She Said Destro's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35215"><img src="images/find.gif" border="0" alt="Find more posts by She Said Destro"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35215"><img src="images/buddy.gif" border="0" alt="Add She Said Destro to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190807"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190807"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190894"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Daytona Beach, Fl<br>
	Posts: 27</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190894"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>DSC-Mutter</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >No clue... I deleted the NS folder then ran <blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr>./steam -update valve . <a href="mailto:dsc-mutter@darkspireclan.net">dsc-mutter@darkspireclan.net</a> ****** y<hr></blockquote><br />
<br />
But instead of draging and droping out of the zip, I unziped it through console as root. <br />
<br />
I'm still not outa the woods with this damn NS server. I finally got around to testing it and I can't join it from any of my friend's computers. When I try to connect to a computer w/o steam I get this error: <br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr>host_error: usermsg: not present on client 66<hr></blockquote><br />
and its looking like thats a client side problem that will be fixed when 2.1 comes out (see:<br />
<a href="http://www.natural-selection.org/forums/index.php?act=ST&amp;f=18&amp;t=50667&amp;" target="_blank">http://www.natural-selection.org/fo...mp;t=50667&amp;</a>)<br />
<br />
But when I try to join from my room mates comp the connection times out and the ns server restarts after 10 seconds.<br />
<br />
<blockquote><font face="verdana,arial,helvetica" size="1" >quote:</font><hr>   Metamod version 1.16.2  Copyright (c) 2001-2003 Will Day &lt;willday@metamod.org&gt;<br />
   Metamod comes with ABSOLUTELY NO WARRANTY; for details type `meta gpl'.<br />
   This is free software, and you are welcome to redistribute it<br />
   under certain conditions; type `meta gpl' for details.<br />
<br />
Loaded plugin 'CS STATS' successfully<br />
Currently loaded plugins:<br />
      description      stat pend  file              vers      src  load  unlod<br />
 [ 1] AMX              RUN   -    amx_mm_i386.so    v0.9.7    ini  ANY   ANY<br />
 [ 2] &lt;fun_ms_i386.so  badf load  fun_ms_i386.so    v -       ini   -     -<br />
 [ 3] &lt;csstats_ms_i38  badf load  csstats_ms_i386.  v -       ini   -     -<br />
 [ 4] CS STATS         RUN   -    csstats_mm_i386.  v0.9.7    cmd  ANY   ANY<br />
4 plugins, 2 running<br />
Loaded plugin 'FUN' successfully<br />
Currently loaded plugins:<br />
      description      stat pend  file              vers      src  load  unlod<br />
 [ 1] AMX              RUN   -    amx_mm_i386.so    v0.9.7    ini  ANY   ANY<br />
 [ 2] &lt;fun_ms_i386.so  badf load  fun_ms_i386.so    v -       ini   -     -<br />
 [ 3] &lt;csstats_ms_i38  badf load  csstats_ms_i386.  v -       ini   -     -<br />
 [ 4] CS STATS         RUN   -    csstats_mm_i386.  v0.9.7    cmd  ANY   ANY<br />
 [ 5] FUN              RUN   -    fun_mm_i386.so    v0.9.7    cmd  ANY   ANY<br />
5 plugins, 3 running<br />
scandir failed:/usr/steam/hlds_l/./platform/SAVE<br />
<br />
Executing AMX Configuration File<br />
Scrolling message displaying frequency: 10:00 minutes<br />
Adding auth server 65.73.232.251:27040<br />
Adding auth server 65.73.232.253:27040<br />
Adding master server 207.173.177.12:27010<br />
Adding master server 207.173.177.11:27010<br />
L 10/27/2003 - 17:16:42: Login: "NSPlayer&lt;1&gt;&lt;STEAM_0:1:478212&gt;&lt;&gt;" become an admin (account "STEAM_0:1:478212") (access "abcdefghijklmnopqrstu") (address "155.31.213.103")<br />
SZ_GetSpace: overflow on MessageBegin/End<br />
FATAL ERROR (shutting down): MESSAGE_END called, but message buffer from .dll had overflowed<br />
<br />
Add "-debug" to the ./hlds_run command line to generate a debug.log to help with solving this problem<br />
Mon Oct 27 17:16:45 EST 2003: Server restart in 10 seconds<br />
<hr></blockquote><br />
<br />
So I thought I fixed the problem, but I ended up making a new one... lol... geez<br />
<br />
-Rick</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190894">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190894">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">10:17 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="DSC-Mutter is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=35352" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for DSC-Mutter"></a>   <!--<a href="http://www.darkspireclan.net" target="_blank"><img src="images/home.gif" alt="Visit DSC-Mutter's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=35352"><img src="images/find.gif" border="0" alt="Find more posts by DSC-Mutter"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=35352"><img src="images/buddy.gif" border="0" alt="Add DSC-Mutter to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190894"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190894"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post190936"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003<br>
	Location: <br>
	Posts: 1107</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post190936"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>lart</b></font><br>
	<font face="verdana,arial,helvetica" size="1" ><span style="font-family: Wingdings; font-size: 15px;"><font face="wingdings" size="3">ллл</font></span></font><br><br>
                <p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Jul 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >if you have the amx cs stats plugin it can **** this up if your not running cs.  I just reminded my self of this yesterday when my server was crashing after I added amx.</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;postid=190936">Report this post to a moderator</a> | IP: <a href="postings.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getip&amp;postid=190936">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-27-2003 <font color="#D8DED3">10:52 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="lart is offline" align="absmiddle">
			<a href="member.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=getinfo&amp;userid=10492" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for lart"></a>   <!--<a href="http://lart2150.ath.cx" target="_blank"><img src="images/home.gif" alt="Visit lart's homepage!" border="0"></a>--> <a href="search.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=finduser&amp;userid=10492"><img src="images/find.gif" border="0" alt="Find more posts by lart"></a> <a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addlist&amp;userlist=buddy&amp;userid=10492"><img src="images/buddy.gif" border="0" alt="Add lart to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=editpost&amp;postid=190936"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;postid=190936"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 05:03 PM.</b></font></td>
		<td><a href="newthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newthread&amp;forumid=19"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=newreply&amp;threadid=29745"><img src="images/reply.gif" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (2): <b>    <font size="2">[1]</font>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;perpage=15&amp;pagenumber=2">2</a>  <a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;perpage=15&amp;pagenumber=2" title="next page">&raquo;</a>  </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;threadid=29745">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=34bdf799f9f2d40e30720b2fa404e500&amp;action=addsubscription&amp;threadid=29745">Subscribe to this Thread</a>
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
	<input type="hidden" name="threadid" value="29745">
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