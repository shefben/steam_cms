<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Welcome to Steam</title>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>
<link href="favicon.ico" rel="icon" type="image/x-icon"/>
<link href="styles_global.css" rel="stylesheet" type="text/css">
<link href="styles_home.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="minmax.js"></script>
<script language="JavaScript" src="cookies.js"></script>
<script language="JavaScript" src="collapse.js"></script>
<script language="JavaScript" src="swfobject.js"></script>
<script language="JavaScript" src="corners.js"></script>
<script language="JavaScript" src="javascript.js"></script>
<style>
		.inline { display: inline; }
		div.capsuleImage { position:relative; }
		div.capsuleLargeImage { position:relative; }
	</style>
</link></link></head>
<body>
<!-- image preloads -->
<div style="display: none;">
<img alt="" src="img/btn/btn_getSteam_ovr.gif"/>
<img alt="" src="img/btn_right_wd_over.jpg"/>
</div>
<!-- header bar -->
<script>
	function language_check()
	{
		var value = readCookie( 'language' );
		if ( value != '' && value != null )
		{
			document.getElementById( 'language_select' ).style.display = 'none';
		}
	}

	function set_default_language()
	{
		// disabled for now
		// createCookie( 'language', 'english', 365 );
	}

	</script>
<div id="language_select" name="language_select" style="width: 100%; height: 55px; background-color: #c26413; vertical-align: middle;">
<table cellpadding="0" cellspacing="0" width="100%">
<tr height="55">
<td width="119"><img align="left" src="img/main/worldMap_languageSel.gif"/></td>
<td width="20"></td>
<td>
<form action="index.php" style="margins: 0px;">
<input name="area" type="hidden" value="main"/>
<input name="cc" type="hidden" value="US"/>
<span style="font-family: Verdana; color: #222222; font-size: 10px;">Select your preferred language.</span><br/>
<select name="l" onchange="submit();" style="margin-top: 3px;">
<option value="">- choose language -</option>
<option id="l_danish" value="danish">Danish</option>
<option id="l_dutch" value="dutch">Dutch</option>
<option id="l_english" value="english">English</option>
<option id="l_finnish" value="finnish">Finnish</option>
<option id="l_french" value="french">French</option>
<option id="l_german" value="german">German</option>
<option id="l_italian" value="italian">Italian</option>
<option id="l_japanese" value="japanese">Japanese</option>
<option id="l_korean" value="korean">Korean</option>
<option id="l_norwegian" value="norwegian">Norwegian</option>
<option id="l_polish" value="polish">Polish</option>
<option id="l_portuguese" value="portuguese">Portuguese</option>
<option id="l_russian" value="russian">Russian</option>
<option id="l_schinese" value="schinese">Simplified Chinese</option>
<option id="l_tchinese" value="tchinese">Traditional Chinese</option>
<option id="l_spanish" value="spanish">Spanish</option>
<option id="l_swedish" value="swedish">Swedish</option>
<option id="l_thai" value="thai">Thai</option>
</select>
</form>
</td>
</tr>
</table>
</div>
<script>
	language_check();
	// set_default_language();
	</script>
<div style="min-width:850px;">
{partial_headerbar}
<center>
<div class="contentBG_home">
<div class="headerBG_main">
<!-- Left Collumn Content -->
<div class="leftCol_home">
<div class="leftCol_home_indent">
<div id="get_steam_now">
<table border="0" cellpadding="0" cellspacing="0" class="capsuleArea_header" height="73" width="574">
<tr>
<td height="73" valign="middle" width="250">
{join_steam_button}
</td>
<td height="73" valign="top"><p>{join_steam_text}</p></td>
</tr>
</table>
</div>
<!-- banner -->
<div id="first_2_banner" style="display: none;">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="publisherArea_header" height="134" width="560">
<tr>
<td align="center" height="134" width="575"></td>
</tr>
</table>
</div>
<div class="capsule" onclick="location.href='index.php?area=game&amp;AppId=1200&amp;cc=US';" onmouseout="this.className='capsule'; window.status='';" onmouseover="this.className='capsule_ovr'; window.status='index.php?area=game&amp;AppId=1200&amp;cc=US';">
<div class="capsuleImage"><img alt="Buy Red Orchestra: Ostfront 41-45" border="0" height="105" src="gfx/apps/1200/capsule_sm.jpg" width="280"/></div>
<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$19.95</div></div>
<div class="capsule" onclick="location.href='index.php?area=game&amp;AppId=6980&amp;cc=US';" onmouseout="this.className='capsule'; window.status='';" onmouseover="this.className='capsule_ovr'; window.status='index.php?area=game&amp;AppId=6980&amp;cc=US';">
<div class="capsuleImage"><img alt="Buy Thief: Deadly Shadows" border="0" height="105" src="gfx/apps/6980/capsule_sm.jpg" width="280"/></div>
<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$19.95</div></div>
</div>
<div class="inline" id="capsule_large">
<br clear="all"/>
<!-- Large capsule -->
<div class="capsule_large_area">
<div id="capsule_large_content">
<div class="capsuleLarge" onclick="location.href='index.php?area=game&amp;AppId=9340&amp;cc=US';" onmouseout="this.className='capsuleLarge'; window.status='';" onmouseover="this.className='capsuleLarge_ovr'; window.status='index.php?area=game&amp;AppId=9340&amp;cc=US';">
<div class="capsuleLargeImage"><img alt="Company of Heroes: Opposing Fronts" border="0" galleryimg="no" height="221" src="gfx/apps/9340/capsule_lrg.jpg" width="572"/></div>
<div class="capsuleLargeText"></div><div class="capsuleLargeCost">$39.95</div></div>
</div>
</div>
</div>
<script type="text/javascript">;
						var so = new SWFObject("swf/capsule_lg.swf?t=2", "movie", "578", "255", "8", "#282828");
						so.addVariable("img1", "9340");
						so.addVariable("txt1", "Company of Heroes: Opposing Fronts");
						so.addVariable("price1", "&#36;39.95");
						so.addVariable("type1", "apps");
						so.addVariable("timestamp1", "1191021226");
						so.addVariable("img2", "4780");
						so.addVariable("txt2", "Medieval II: Total War&trade; Kingdoms");
						so.addVariable("price2", "&#36;29.95");
						so.addVariable("type2", "apps");
						so.addVariable("timestamp2", "1188331962");
						so.addVariable("img3", "2630");
						so.addVariable("txt3", "Call of Duty&reg; 2");
						so.addVariable("price3", "&#36;19.95");
						so.addVariable("type3", "apps");
						so.addVariable("timestamp3", "1191879372");
						so.addVariable("img4", "451");
						so.addVariable("txt4", "BioShock&trade;");
						so.addVariable("price4", "&#36;49.95");
						so.addVariable("type4", "subs");
						so.addVariable("timestamp4", "1191513831");
						so.addVariable("img5", "506");
						so.addVariable("txt5", "Enemy Territory: QUAKE Wars&trade;");
						so.addVariable("price5", "&#36;49.95");
						so.addVariable("type5", "subs");
						so.addVariable("timestamp5", "1191368593");
						so.addVariable("img6", "496");
						so.addVariable("txt6", "PopCap Favorites");
						so.addVariable("price6", "&#36;39.95");
						so.addVariable("type6", "subs");
						so.addVariable("timestamp6", "1190853685");
						so.addVariable("img7", "4500");
						so.addVariable("txt7", "S.T.A.L.K.E.R.: Shadow of Chernobyl");
						so.addVariable("price7", "&#36;29.95");
						so.addVariable("type7", "apps");
						so.addVariable("timestamp7", "1191875051");
						so.addVariable("img8", "469");
						so.addVariable("txt8", "The Orange Box");
						so.addVariable("price8", "&#36;49.95");
						so.addVariable("type8", "subs");
						so.addVariable("desc_b8", "Pre-purchase Now");
						so.addVariable("desc_c8", "SAVE $5");
						so.addVariable("discount8", "&#36;44.95");
						so.addVariable("timestamp8", "1190130649");
						so.addVariable("urlparams", "cc=US");
						so.write("capsule_large_content");
						</script>
<div class="leftCol_home_indent">
<br clear="all"/>
<div class="capsule" onclick="location.href='index.php?area=game&amp;AppId=7260&amp;cc=US';" onmouseout="this.className='capsule'; window.status='';" onmouseover="this.className='capsule_ovr'; window.status='index.php?area=game&amp;AppId=7260&amp;cc=US';">
<div class="capsuleImage"><img alt="Loki" border="0" height="105" src="gfx/apps/7260/capsule_sm.jpg" width="280"/></div>
<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$39.95</div></div>
<div class="capsule" onclick="location.href='index.php?area=game&amp;AppId=8400&amp;cc=US';" onmouseout="this.className='capsule'; window.status='';" onmouseover="this.className='capsule_ovr'; window.status='index.php?area=game&amp;AppId=8400&amp;cc=US';">
<div class="capsuleImage"><img alt="Buy Geometry Wars: Retro Evolved" border="0" height="105" src="gfx/apps/8400/capsule_sm.jpg" width="280"/></div>
<div align="left" class="capsuleText"></div><div align="right" class="capsuleCost">$3.95</div></div>
<br clear="all"/>
<script language="javascript">

function addEvent(el, ev, fn, useCapture)
{
	if(el.addEventListener)
	{
		el.addEventListener(ev, fn, useCapture);
	}
	else if(el.attachEvent)
	{
		var ret = el.attachEvent("on"+ev, fn);
		return ret;
	}
	else
	{
		el["on"+ev] = fn;
	}
}

var allTabs = new Array();
function setupTabs()
{
	if(!document.getElementsByTagName)
	{
		return;
	}
	var pageSpans = document.getElementsByTagName('span');
	var focalTab = 3; // tab to focus initially
	var count = 0;
	for(var x = 0; x < pageSpans.length; x++)
	{
		tempClassName = " "+pageSpans[x].className+" ";
		if(tempClassName.indexOf(" tab_link ") != -1)
		{
			count++;
			allTabs.push(pageSpans[x].id);
			if(count == focalTab)
			{
				document.getElementById(pageSpans[x].id+'_li').className = 'main_tab_on';
				contentTab = document.getElementById(pageSpans[x].id+'_content');
				if(contentTab)
				{
					contentTab.style.display = '';
				}
			}
			else
			{
				document.getElementById(pageSpans[x].id+'_li').className = 'main_tab_off';
				contentTab = document.getElementById(pageSpans[x].id+'_content');
				if(contentTab)
				{
					contentTab.style.display = 'none';
				}
			}
			addEvent(pageSpans[x], "mouseover", tab_hilite, false);
			addEvent(pageSpans[x], "mouseout", tab_lolite, false);
			addEvent(pageSpans[x], "click", tab_display, false);
		}
	}
}
function tab_hilite(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"span","tab_link",0);
	if(el)
	{
		contentEl = document.getElementById(el.id+'_content');
		if(contentEl.style.display == 'none')
		{
			el.style.color = "#FFFFFF";
		}
	}
}
function tab_lolite(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"span","tab_link",0);
	if(el)
	{
		contentEl = document.getElementById(el.id+'_content');
		if(contentEl.style.display == 'none')
		{
			el.style.color = "#BCBCBC";
		}
	}
}
function tab_display(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"span","tab_link",0);
	if(el)
	{
		for(x=0;x<allTabs.length;x++)
		{
			document.getElementById(allTabs[x]+'_li').className = 'main_tab_off';
			document.getElementById(allTabs[x]+'_content').style.display = 'none';
		}

		tabContent = document.getElementById(el.id+'_content');
		tabContent.style.display = '';
		document.getElementById(el.id+'_li').className = 'main_tab_on';
		if(e && e.stopPropagation)
		{
			e.stopPropagation();
		}
		if(window.event)
		{
			window.event.cancelBubble = true;
		}
	}
}		
function getGoodElement(el,nn,cn,next)
{
	if(next == 1)
	{
		el = el.parentNode;
	}
	while(el.nodeName.toLowerCase() != nn && el.nodeName.toLowerCase() != "body")
	{
		el = el.parentNode;
	}
	thisClass = ' '+el.className+' ';
	if(el.nodeName.toLowerCase() != "body" && thisClass.indexOf(' '+cn+' ') == -1)
	{
		return getGoodElement(el,nn,cn,1);
	}
	else if(thisClass.indexOf(' '+cn+' ') != -1)
	{
		return el;
	}
	return false;
}
addEvent(window, "load", setupTabs, false);
var isIE = !window.opera && navigator.userAgent.indexOf('MSIE') != -1;

</script>
<div class="listArea">
<br clear="all"/>
<div>
<ul id="main_tab_list">
<li class="main_tab_off" id="tab_1_li"><span class="tab_link" id="tab_1">Top Sellers</span></li>
<li class="main_tab_off" id="tab_2_li"><span class="tab_link" id="tab_2">Top Rated</span></li>
<li class="main_tab_off" id="tab_3_li"><span class="tab_link" id="tab_3">New releases</span></li>
</ul>
</div>
<br clear="left"/>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td height="6"><img height="6" src="img/_spacer.gif" width="6"/></td>
<td align="right" height="6"><img height="6" src="img/home/listArea_tr.gif" width="6"/></td>
</tr>
<tr id="tab_1_content" style="display:none;">
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=package&amp;SubId=469&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy The Orange Box" border="0" height="45" src="gfx/subs/469/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">The Orange Box</div><br/>
<div class="listArea_gamePrice"><span style="color: #444444;"><strike>$49.95</strike></span> $44.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=240&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Counter-Strike: Source" border="0" height="45" src="gfx/apps/240/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Counter-Strike: Source</div><br/>
<div class="listArea_gamePrice">$19.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=10&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Counter-Strike" border="0" height="45" src="gfx/apps/10/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Counter-Strike</div><br/>
<div class="listArea_gamePrice">$9.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=3480&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Peggle Deluxe" border="0" height="45" src="gfx/apps/3480/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Peggle Deluxe</div><br/>
<div class="listArea_gamePrice"><span style="color: #444444;"><strike>$19.95</strike></span> $9.95</div>
</div>
</td>
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=10000&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Enemy Territory: QUAKE Wars™" border="0" height="45" src="gfx/apps/10000/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Enemy Territory: QUAKE Wars™</div><br/>
<div class="listArea_gamePrice">$49.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=7670&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy BioShock™" border="0" height="45" src="gfx/apps/7670/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">BioShock™</div><br/>
<div class="listArea_gamePrice">$49.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=9340&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Company of Heroes: Opposing Fronts" border="0" height="45" src="gfx/apps/9340/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Company of Heroes: Opposing Fronts</div><br/>
<div class="listArea_gamePrice">$39.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=4500&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy S.T.A.L.K.E.R.: Shadow of Chernobyl" border="0" height="45" src="gfx/apps/4500/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">S.T.A.L.K.E.R.: Shadow of Chernobyl</div><br/>
<div class="listArea_gamePrice">$29.95</div>
</div>
</td>
</tr>
<tr id="tab_2_content" style="display:none;">
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=7670&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy BioShock™" border="0" height="45" src="gfx/apps/7670/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">BioShock™</div><br/>
<div class="listArea_gamePrice">$49.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=220&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Half-Life 2" border="0" height="45" src="gfx/apps/220/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Half-Life 2</div><br/>
<div class="listArea_gamePrice"><span style="color: #444444;"><strike>$29.95</strike></span> $19.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=3900&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Sid Meier's Civilization® IV" border="0" height="45" src="gfx/apps/3900/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Sid Meier's Civilization® IV</div><br/>
<div class="listArea_gamePrice">$39.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=4760&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Rome: Total War - Gold" border="0" height="45" src="gfx/apps/4760/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Rome: Total War - Gold</div><br/>
<div class="listArea_gamePrice">$19.95</div>
</div>
</td>
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=70&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Half-Life" border="0" height="45" src="gfx/apps/70/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Half-Life</div><br/>
<div class="listArea_gamePrice">$9.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=2310&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy QUAKE" border="0" height="45" src="gfx/apps/2310/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">QUAKE</div><br/>
<div class="listArea_gamePrice">$9.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=4560&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Company of Heroes" border="0" height="45" src="gfx/apps/4560/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Company of Heroes</div><br/>
<div class="listArea_gamePrice">$29.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=2620&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Call of Duty" border="0" height="45" src="gfx/apps/2620/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Call of Duty</div><br/>
<div class="listArea_gamePrice">$19.95</div>
</div>
</td>
</tr>
<tr id="tab_3_content">
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=7260&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Loki" border="0" height="45" src="gfx/apps/7260/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Loki</div><br/>
<div class="listArea_gamePrice">$39.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=6270&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Ducati World Championship" border="0" height="45" src="gfx/apps/6270/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Ducati World Championship</div><br/>
<div class="listArea_gamePrice">$19.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=3483&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Peggle Extreme" border="0" height="45" src="gfx/apps/3483/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Peggle Extreme</div><br/>
<div class="listArea_gamePrice"></div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=2690&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Empires: Dawn of the Modern World" border="0" height="45" src="gfx/apps/2690/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Empires: Dawn of the Modern World</div><br/>
<div class="listArea_gamePrice">$19.95</div>
</div>
</td>
<td valign="top">
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=9340&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Company of Heroes: Opposing Fronts" border="0" height="45" src="gfx/apps/9340/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Company of Heroes: Opposing Fronts</div><br/>
<div class="listArea_gamePrice">$39.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=7250&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Sherlock Holmes - The Awakened" border="0" height="45" src="gfx/apps/7250/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Sherlock Holmes - The Awakened</div><br/>
<div class="listArea_gamePrice">$29.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=4500&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy S.T.A.L.K.E.R.: Shadow of Chernobyl" border="0" height="45" src="gfx/apps/4500/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">S.T.A.L.K.E.R.: Shadow of Chernobyl</div><br/>
<div class="listArea_gamePrice">$29.95</div>
</div>
<div class="listArea_game" onclick="location.href='index.php?area=game&amp;AppId=3260&amp;cc=US';" onmouseout="this.className='listArea_game';" onmouseover="this.className='listArea_game_ovr';">
<div class="listArea_gameImage"><img alt="Buy Safecracker: The Ultimate Puzzle Adventure" border="0" height="45" src="gfx/apps/3260/capsule_sm_120.jpg" width="120"/></div>
<div class="listArea_gameTitle">Safecracker: The Ultimate Puzzle Adventure</div><br/>
<div class="listArea_gamePrice">$9.95</div>
</div>
</td>
</tr>
<tr>
<td height="6"><img height="6" src="img/home/listArea_bl.gif" width="6"/></td>
<td align="right" height="6"><img height="6" src="img/home/listArea_br.gif" width="6"/></td>
</tr>
</table>
</div>
<br clear="all">
<br clear="left">
<div id="gear_and_stuff" style="display: inline;">
<div align="center" class="Gear">
<div class="GearTitle">Get The Gear!</div>
<div class="GearText">Get your hands on the brand-new Half-Life® 2: Episode Two poster at the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> now!!! Also featuring official shirts, posters, hats and more!</div>
</div>
<div align="center" class="Stuff">
<div class="StuffTitle">Free Stuff!</div>
<div class="StuffText">In addition to a catalog of great games, your free Steam account gives you access to game <a href="v/index.php?area=free&amp;tab=demos&amp;cc=US">demos</a>, <a href="v/index.php?area=free&amp;tab=mods&amp;cc=US">mods</a>, <a href="v/index.php?area=free&amp;tab=videos&amp;cc=US">trailers</a> and more. Browse our <a href="v/index.php?area=free&amp;cc=US">Free Stuff</a> page for more details.</div>
</div>
</div>
</br></br></div>
</div>
<!-- End Left Collumn Content -->
<!-- Right Collumn Content -->
{partial_right_column}
</div>
<br clear="left">
</br></div>
<!-- Footer Content -->
{partial_footer}
<br>
</br></center>
</br></body>
</html>
<!-- static / index_us / Tue, 09 Oct 2007 00:20:20 -0700-->
