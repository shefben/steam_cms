<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
	<title>Dormant User</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="ROBOTS" content="ALL">
	<meta name="DESCRIPTION" content="SteamPowered">
	<meta name="KEYWORDS" content="Steam, account, account creation, signup">
	<meta name="AUTHOR" content="Valve LLC">
	<LINK rel="stylesheet" type="text/css" href="steampowered.css">
	<script language="JavaScript" src="nav.js"></script>
	<link href="rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>

<body>

<!-- begin header -->
<div class="header">
<nobr><a href="index.php"><img src="/img/steam_logo_onblack.gif" align="top" alt="[Steam]" height="54" width="152"></a>
<span class="navBar">
	<a href="news.php"><img name="news" valign="bottom" height="22" width="54" src="img/news.gif"
		onMouseOut="this.src='img/news.gif';" onMouseOver="this.src='img/MOnews.gif';"
		alt="news"></a>

	<a href="getsteamnow.php"><img valign="bottom" height="22" width="108" src="img/getSteamNow.gif"
		onMouseOut="this.src='img/getSteamNow.gif'" onMouseOver="this.src='img/MOgetSteamNow.gif'"
		alt="getSteamNow"></a>

	<a href="cybercafes.php"><img valign="bottom" height="22" width="95" src="img/cafes.gif"
		onMouseOut="this.src='img/cafes.gif'" onMouseOver="this.src='img/MOcafes.gif'"
		alt="Cyber Cafes"></a>

	<a href="support.php"><img valign="bottom" height="22" width="68" src="img/support.gif"
		onMouseOut="this.src='img/support.gif'" onMouseOver="this.src='img/MOsupport.gif'"
		alt="Support"></a>

	<a href="forums.php"><img valign="bottom" height="22" width="68" src="img/forums.gif"
		onMouseOut="this.src='img/forums.gif'" onMouseOver="this.src='img/MOforums.gif'"
		alt="Forums"></a>

	<a href="status/status.html"><img valign="bottom" height="22" width="65" src="img/status.gif"
		onMouseOut="this.src='img/status.gif'" onMouseOver="this.src='img/MOstatus.gif'"
		alt="Status"></a>
</span>
</nobr>
</div>
<!-- end header -->

<!-- dormant user form -->

<div class="content" id="container">
<h1 style="text-transform:uppercase;">PONAQUITUDIRECCIONDECORREOQUEPUSISTEENELSTEAM</H1>
<h2>WE <EM>HAVEN'T SEEN YOU LATELY...</EM></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

<p>
Thanks for taking the time to visit this page and give us a bit of information about your use of Steam.<br>
<br>
We've noticed that your Steam account, <b>PONAQUITUDIRECCIONDECORREOQUEPUSISTEENELSTEAM</b>, hasn't been used to log into Steam in the last 30 days.<br>
<br>
<div style="background: #4C5844; border: solid; border-color: black; border-width: 6px; padding:24px 0px 24px 24px;">
<p>What is the main reason that you haven't used Steam lately?</p>

<script language="JavaScript">
<!-- Begin
areason = 0;  // 0 means 'no', 1 means 'yes'
//  End -->
</script>

<form action="index.php" method="post">
<input type="hidden" name="area" value="dormant">
<input type="hidden" name="account" value="PONAQUITUDIRECCIONDECORREOQUEPUSISTEENELSTEAM">
<table width="100%" cellspacing="0" cellpadding="0">

<!-- option 1 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top"nowrap><input type="radio" id="rb1" name="reason" value="I actually have been using Steam, I've just been logging in with a different account." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb1"><p style="width: 100%;">I <i>have</i> been using Steam, I just haven't been using the account <b>PONAQUITUDIRECCIONDECORREOQUEPUSISTEENELSTEAM</b>.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 2 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top"nowrap><input type="radio" id="rb2" name="reason" value="I have a technical problem with Steam." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb2"><p style="width: 100%;">I have a technical problem with Steam.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 3 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb3" name="reason" value="My CD-Key no longer works." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb3"><p style="width: 100%;">My CD-Key no longer works.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 4 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb4" name="reason" value="I generally have not enjoyed the experience of using Steam." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb4"><p style="width: 100%;">I generally have not enjoyed the experience of using Steam.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 5 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb5" name="reason" value="I went back to playing Counter-Strike 1.5 via WON." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb5"><p style="width: 100%;">I went back to playing Counter-Strike 1.5 via WON.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 6 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb6" name="reason" value="Cheating in multiplayer games has forced me to quit." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb6"><p style="width: 100%;">Cheating in multiplayer games has forced me to quit.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 7 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb7" name="reason" value="I'm on my summer break from college and don't have high-speed internet access." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb7"><p style="width: 100%;">I'm on my summer break from college and don't have high-speed internet access.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 8 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb8" name="reason" value="I'm waiting for Half-Life 2 to be available." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb8"><p style="width: 100%;">I'm waiting for Half-Life 2 to be available.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 9 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb9" name="reason" value="I've moved on to playing other games." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb9"><p style="width: 100%;">I've moved on to playing other games.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 10 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb10" name="reason" value="I'm taking a break from Steam games, but I plan on coming back." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb10"><p style="width: 100%;">I'm taking a break from Steam games, but I plan on coming back.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- option 11 -->

<tr onMouseOver="this.bgColor='#3E4637';" onMouseOut="this.bgColor='#4C5844';" style="cursor: pointer;">
	<td valign="top" nowrap><input type="radio" id="rb11" name="reason" value="My problem isn't listed here." onClick="areason=1;">&nbsp;&nbsp;</td>
	<td valign="top" width="100%"><label for="rb11"><p style="width: 100%;">My problem isn't listed here.</p></label></td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

<!-- feedback text entry -->

<tr>
	<td colspan="2" valign="top" nowrap><br>
	Comments (optional):<br>
	<textarea maxlength="300" cols="10" rows="7" name="feedback"
	style="font-family: Verdana;
	    font-color: Black;
	    width: 80%;
	    background-color: #495141;
	    border-style:solid;
	    border-width:1px;
	    border-top-color:#1C261E;
	    border-right-color:#818D7C;
	    border-bottom-color:#818D7C;
	    border-left-color:#1C261E;
	    color:#BFBA50;
	    scrollbar-base-color: #4C5844;"
	></textarea><br><br>
	</td>
</tr>
<tr>
	<td colspan="2" height="5"><spacer></td>
</tr>

</table>
<br>
<p><input type="submit" name="perform" value="submit" onClick="if (areason == 1) return true; else { alert('Please select a reason before submitting this form.'); return false; }"></p>

</form>
</div> <!-- end of black-border box -->

</div>
</div>

<!-- begin footer -->
<div class="footer">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td><a href="/valvesoftware"><img src="img/valve_greenlogo.gif"></a></td>
		<td>&nbsp;</td>
		<td><span class="footerfix">&copy; 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="/valvesoftware/privacy.htm">Privacy Policy</a>. <a href="/valvesoftware/legal.htm">Legal</a>. <a href="subscriber_agreement.php">Steam Subscriber Agreement</a>.</span></td>
		<td width="15%">&nbsp;</td>
	</tr>
	</table>
</div>
<!-- end footer -->

</body>
</html>