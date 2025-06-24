<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Steam Users Forums - Floating-point exception thread</title>
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
	window.open("member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&action=aimmessage&aim="+aimid,"_blank","toolbar=no,location=no,menubar=no,scrollbars=no,width=175,height=275,resizeable=yes,status=no")


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
<font face="verdana, arial, helvetica" size="2" ><b><a href="index.php?s=2bb5bb35a5297a8be13db92ffc0b367f">Steam Users Forums</a> &gt; <a href="forumdisplay.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;forumid=13">Steam Discussions</a> &gt; <a href="forumdisplay.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;forumid=17">Steam Support / Help</a> &gt; Floating-point exception thread</b></font></td>
	<td align="right" valign="bottom"><img src="images/4stars.gif" alt="Thread Rating: 9 votes, 4.44 average."></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (15): <b>  <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=1" title="first page">&laquo; First</a> ...   <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=14" title="previous page">&laquo;</a>   <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=13">13</a>  <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=14">14</a>  <font size="2">[15]</font>    </b> &nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;goto=nextnewest">Next Thread</a>
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
		<td><a href="newthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;threadid=18437"><img src="" border="0" alt="Post A Reply"></a></td>
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
	<a name="post195808"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fishBurger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: <br>
	Posts: 37</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post195808"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>fishBurger</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >as a wise man once said...<br />
=================================<br />
I had this problem. im almost positive its the fault of a virus that goes under many names. i think mcafee calls int win32.pinfi or w32.pinf but its also known as win32.parite win32.paite/b and many other names. <br />
<br />
<a href="http://securityresponse.symantec.com/avcenter/venc/data/w32.pinfi.html" target="_blank">http://securityresponse.symantec.co.../w32.pinfi.html</a><br />
<br />
i dont have a norton thats compatible with my xp, and dont have the budget to buy one, so i tried a few different free scanners and cleaners, but the one that worked for me was panda softwares quick removal.<br />
<br />
<a href="http://www.pandasoftware.com/virus_info/encyclopedia/overview.aspx?idvirus=18181" target="_blank">http://www.pandasoftware.com/virus_...x?idvirus=18181</a><br />
<br />
under the prevention and cure there is a scanner to find it, and a pqremove download to cure it. i ran it, and next time i reinstalled the steam login popped up! <br />
<br />
good luck and may we soon all be able to play the same server with friends! <br />
=================================<br />
(it was me that said it)<br />
<br />
also, if you have xp, and this fixes the problem once, but next restart you get the error again, turn off system restore, run the cleaner, and then turn system restore back on. beauty.<br />
<br />
(btw taylor sherman i think you should close this thread somewhere near after this post, or create a new announcement that is unreplyable so that people wont post over this fix. i realize you probably shouldnt be sending people to panda software OFFICIALLY as a valve employee and all, but i highly recommend their program. neither avg or the mcafee trial or another one i tried worked.)</font></p>
	
	<p></p>
	<p><font face="verdana,arial,helvetica" size="1" ><i>Last edited by fishBurger on 10-30-2003 at 08:20 PM</i></font></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;postid=195808">Report this post to a moderator</a> | IP: <a href="postings.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getip&amp;postid=195808">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-30-2003 <font color="#D8DED3">08:17 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="fishBurger is offline" align="absmiddle">
			<a href="member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getinfo&amp;userid=27391" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for fishBurger"></a> <a href="private.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newmessage&amp;userid=27391"><img src="images/sendpm.gif" border="0" alt="Click here to Send fishBurger a Private Message"></a>   <a href="search.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=finduser&amp;userid=27391"><img src="images/find.gif" border="0" alt="Find more posts by fishBurger"></a> <a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addlist&amp;userlist=buddy&amp;userid=27391"><img src="images/buddy.gif" border="0" alt="Add fishBurger to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=editpost&amp;postid=195808"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;postid=195808"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post197531"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Ady</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003<br>
	Location: Brampton, Ontario<br>
	Posts: 7</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post197531"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Ady</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Junior Member</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Oct 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >YES it works! THe panda virus thingy found 200 infected files, it defected all the files and it works really good now, ty man!!</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
"nobody is perfect, I am nobody"</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;postid=197531">Report this post to a moderator</a> | IP: <a href="postings.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getip&amp;postid=197531">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-31-2003 <font color="#D8DED3">11:36 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Ady is offline" align="absmiddle">
			<a href="member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getinfo&amp;userid=34991" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Ady"></a> <a href="private.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newmessage&amp;userid=34991"><img src="images/sendpm.gif" border="0" alt="Click here to Send Ady a Private Message"></a>  <!--<a href="http://systemdead.cleardreams.net" target="_blank"><img src="images/home.gif" alt="Visit Ady's homepage!" border="0"></a>--> <a href="search.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=finduser&amp;userid=34991"><img src="images/find.gif" border="0" alt="Find more posts by Ady"></a> <a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addlist&amp;userlist=buddy&amp;userid=34991"><img src="images/buddy.gif" border="0" alt="Add Ady to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=editpost&amp;postid=197531"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;postid=197531"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post197536"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Taylor Sherman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: <br>
	Posts: 1393</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post197536"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Taylor Sherman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Cool. I'm going to close this thread so that the fix is pretty near the end and people don't have to search to find it.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Steam Developer</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;postid=197536">Report this post to a moderator</a> | IP: <a href="postings.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getip&amp;postid=197536">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	10-31-2003 <font color="#D8DED3">11:42 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Taylor Sherman is offline" align="absmiddle">
			<a href="member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getinfo&amp;userid=6022" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Taylor Sherman"></a> <a href="private.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newmessage&amp;userid=6022"><img src="images/sendpm.gif" border="0" alt="Click here to Send Taylor Sherman a Private Message"></a>   <a href="search.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=finduser&amp;userid=6022"><img src="images/find.gif" border="0" alt="Find more posts by Taylor Sherman"></a> <a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addlist&amp;userlist=buddy&amp;userid=6022"><img src="images/buddy.gif" border="0" alt="Add Taylor Sherman to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=editpost&amp;postid=197536"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;postid=197536"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post205014"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Taylor Sherman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003<br>
	Location: <br>
	Posts: 1393</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post205014"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Taylor Sherman</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Feb 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Oops - links fixed in that post up above.</font></p>
	
	<p><p><font face="verdana, arial, helvetica" size="2" >__________________<br>
Steam Developer</font></p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;postid=205014">Report this post to a moderator</a> | IP: <a href="postings.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getip&amp;postid=205014">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	11-04-2003 <font color="#D8DED3">06:00 AM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Taylor Sherman is offline" align="absmiddle">
			<a href="member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getinfo&amp;userid=6022" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Taylor Sherman"></a> <a href="private.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newmessage&amp;userid=6022"><img src="images/sendpm.gif" border="0" alt="Click here to Send Taylor Sherman a Private Message"></a>   <a href="search.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=finduser&amp;userid=6022"><img src="images/find.gif" border="0" alt="Find more posts by Taylor Sherman"></a> <a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addlist&amp;userlist=buddy&amp;userid=6022"><img src="images/buddy.gif" border="0" alt="Add Taylor Sherman to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=editpost&amp;postid=205014"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;postid=205014"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
	<a name="post500666"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Waldo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br>
	<p>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2003<br>
	Location: Oregon, USA<br>
	Posts: 1970</font></td>
 -->
	<td bgcolor="#3E4637" width="175" valign="top" nowrap>
	<a name="post500666"></a>
	
	<font face="verdana, arial, helvetica" size="2" ><b>Waldo</b></font><br>
	<font face="verdana,arial,helvetica" size="1" >Valve</font><br><br>
	<font face="verdana,arial,helvetica" size="1" >Registered: Apr 2003</font></p></td>
	
	<td bgcolor="#3E4637" width="100%" valign="top">
	<font face="verdana,arial,helvetica" size="1" > <b></b></font>
	<p><font face="verdana, arial, helvetica" size="2" >Unstuck support thread</font></p>
	
	<p></p>
	<p></p>
	<p align="right"><font face="verdana,arial,helvetica" size="1" ><a href="report.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;postid=500666">Report this post to a moderator</a> | IP: <a href="postings.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getip&amp;postid=500666">Logged</a></font></p>
	</td>
</tr>
<tr>
	<td bgcolor="#3E4637" width="175" height="16" nowrap><font face="verdana,arial,helvetica" size="1" ><img src="images/posticon.gif" border="0" alt="Old Post">
	04-05-2004 <font color="#D8DED3">09:53 PM</font></font></td>
	
	<td bgcolor="#3E4637" width="100%" valign="middle" height="16">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr valign="bottom">
			<td><font face="verdana,arial,helvetica" size="1" ><img src="images/off.gif" border="0" alt="Waldo is offline" align="absmiddle">
			<a href="member.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=getinfo&amp;userid=7759" target="_blank"><img src="images/profile.gif" border="0" alt="Click Here to See the Profile for Waldo"></a> <a href="private.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newmessage&amp;userid=7759"><img src="images/sendpm.gif" border="0" alt="Click here to Send Waldo a Private Message"></a>  <!--<a href="http://www.dayofdefeat.com" target="_blank"><img src="images/home.gif" alt="Visit Waldo's homepage!" border="0"></a>--> <a href="search.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=finduser&amp;userid=7759"><img src="images/find.gif" border="0" alt="Find more posts by Waldo"></a> <a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addlist&amp;userlist=buddy&amp;userid=7759"><img src="images/buddy.gif" border="0" alt="Add Waldo to your buddy list"></a>
			<!-- $ post[icqicon] --> <!-- $ post[aimicon] --> <!-- $ post[yahooicon] --> 
			</font></td>
			<td align="right" nowrap><font face="verdana,arial,helvetica" size="1" >
			<a href="editpost.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=editpost&amp;postid=500666"><img src="images/edit.gif" border="0" alt="Edit/Delete Message"></a>
			<a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;postid=500666"><img src="images/quote.gif" border="0" alt="Reply w/Quote"></a>
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
		<td width="100%"><font face="verdana,arial,helvetica" size="1"  color="#D8DED3"><b>All times are GMT. The time now is 07:52 PM.</b></font></td>
		<td><a href="newthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newthread&amp;forumid=17"><img src="images/newthread.gif" border="0" alt="Post New Thread"></a></td>
		<td><font face="verdana, arial, helvetica" size="2" >&nbsp;&nbsp;</font></td>
		<td><a href="newreply.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=newreply&amp;threadid=18437"><img src="" border="0" alt="Post A Reply"></a></td>
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
	<td><font face="verdana,arial,helvetica" size="1" >Pages (15): <b>  <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=1" title="first page">&laquo; First</a> ...   <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=14" title="previous page">&laquo;</a>   <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=13">13</a>  <a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;perpage=20&amp;pagenumber=14">14</a>  <font size="2">[15]</font>    </b>&nbsp;</font></td>
	<td align="right"><font face="verdana,arial,helvetica" size="1" >
	<img src="images/prev.gif" alt="" border="0">
	<a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;goto=nextoldest">Last Thread</a>
	&nbsp;
	<a href="showthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437&amp;goto=nextnewest">Next Thread</a>
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
	<a href="printthread.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437">Show Printable Version</a> |
	<img src="images/sendtofriend.gif" alt="" border="0" align="absmiddle">
	<a href="sendtofriend.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;threadid=18437">Email this Page</a> |
	<img src="images/subscribe.gif" alt="" border="0" align="absmiddle">
	<a href="member2.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=addsubscription&amp;threadid=18437">Subscribe to this Thread</a>
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
	<input type="hidden" name="s" value="2bb5bb35a5297a8be13db92ffc0b367f">
	<input type="hidden" name="threadid" value="18437">
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
		<a href="misc.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=bbcode" target="_blank">vB code</a> is <b>ON</b><br>
		<a href="misc.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=showsmilies" target="_blank">Smilies</a> are <b>ON</b><br>
		<a href="misc.php?s=2bb5bb35a5297a8be13db92ffc0b367f&amp;action=bbcode#imgcode" target="_blank">[IMG]</a> code is <b>OFF</b>
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