<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

	<head>
                <title><?php echo htmlspecialchars($page_title ?? 'Welcome to Steam'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="ROBOTS" content="ALL">
	<meta name="DESCRIPTION" content="SteamPowered">
	<meta name="KEYWORDS" content="Steam, account, account creation, signup">
	<meta name="AUTHOR" content="Valve Corporation">
	<LINK rel="stylesheet" type="text/css" href="../steampowered02.css">
	<link rel="Shortcut Icon" type="image/png" href="/webicon.png">
		<csscriptdict>
			<script type="text/javascript"><!--

function newImage(arg) {
	if (document.images) {
		rslt = new Image();
		rslt.src = arg;
		return rslt;
	}
}
function changeImagesArray(array) {
	if (preloadFlag == true) {
		var d = document; var img;
		for (var i=0; i<array.length; i+=2) {
			img = null; var n = array[i];
			if (d.images) {img = d.images[n];}
			if (!img && d.getElementById) {img = d.getElementById(n);}
			if (img) {img.src = array[i+1];}
		}
	}
}
function changeImages() {
	changeImagesArray(changeImages.arguments);
}

// --></script>
		</csscriptdict>
		<csactiondict>
			<script type="text/javascript"><!--
var preloadFlag = false;
function preloadImages() {
	if (document.images) {
		over_Banner_Nav_02 = newImage('../img/index02/Banner_NAV/Banner_Nav_02-over.gif');
		over_Banner_Nav_04 = newImage('../img/index02/Banner_NAV/Banner_Nav_04-over.gif');
		over_Banner_Nav_06 = newImage('../img/index02/Banner_NAV/Banner_Nav_06-over.gif');
		over_Banner_Nav_08 = newImage('../img/index02/Banner_NAV/Banner_Nav_08-over.gif');
		over_Banner_Nav_10 = newImage('../img/index02/Banner_NAV/Banner_Nav_10-over.gif');
		over_Banner_Nav_12 = newImage('../img/index02/Banner_NAV/Banner_Nav_12-over.gif');
		preloadFlag = true;
	}
}

// --></script>
		</csactiondict>
	</head>

	<body onload="preloadImages();" bgcolor="#4c5844" leftmargin="0" topmargin="0">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
			<tr height="55">
				<td bgcolor="black" height="55">
					<table width="383" border="0" cellspacing="0" cellpadding="0" cool gridx="16" gridy="16" height="55" showgridx showgridy>
						<tr height="18">
							<td width="47" height="54" rowspan="2"></td>
							<td width="335" height="18"></td>
							<td width="1" height="18"><spacer type="block" width="1" height="18"></td>
						</tr>
						<tr height="36">
							<td width="335" height="36" valign="top" align="left" xpos="47"><a href="/valvesoftware"><img src="../img/index02/Logo_VALVE.gif" alt="" width="65" height="18" border="0"></a></td>
							<td width="1" height="36"><spacer type="block" width="1" height="36"></td>
						</tr>
						<tr height="1" cntrlrow>
							<td width="47" height="1"><spacer type="block" width="47" height="1"></td>
							<td width="335" height="1"><spacer type="block" width="335" height="1"></td>
							<td width="1" height="1"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center" valign="top"><br>
					<table width="800" border="0" cellspacing="0" cellpadding="0" background="../img/index02/TopBanner.gif" cool gridx="16" gridy="16" height="75" showgridx showgridy>
						<tr height="22">
							<td width="799" height="22" colspan="4"></td>
							<td width="1" height="22"><spacer type="block" width="1" height="22"></td>
						</tr>
						<tr height="3">
							<td width="262" height="52" rowspan="2"></td>
							<td content csheight="29" width="391" height="52" rowspan="2" valign="top" xpos="262">
								<div align="left">
									<font size="2"><span class="statusContent">Steam delivers Valve&rsquo;s games to your desktop and connects you to a massive gaming community. Check out the full <a href="features.php">feature list</a> now.</span></font></div>
							</td>
							<td width="146" height="3" colspan="2"></td>
							<td width="1" height="3"><spacer type="block" width="1" height="3"></td>
						</tr>
						<tr height="49">
							<td width="9" height="49"></td>
							<td width="137" height="49" valign="top" align="left" xpos="662"><a href="getsteamnow.php"><img src="../img/index02/but_getsteamnow02.gif" alt="" width="124" height="24" border="0"></a></td>
							<td width="1" height="49"><spacer type="block" width="1" height="49"></td>
						</tr>
						<tr height="1" cntrlrow>
							<td width="262" height="1"><spacer type="block" width="262" height="1"></td>
							<td width="391" height="1"><spacer type="block" width="391" height="1"></td>
							<td width="9" height="1"><spacer type="block" width="9" height="1"></td>
							<td width="137" height="1"><spacer type="block" width="137" height="1"></td>
							<td width="1" height="1"></td>
						</tr>
					</table>
					<table width="801" border="0" cellspacing="0" cellpadding="0" bgcolor="#3e4637" cool gridx="16" gridy="16" height="657" showgridx showgridy>
                                                <tr height="53">
                                                        <td colspan="15" valign="top" align="left">
                                                                <span class="navBar"></span>
                                                        </td>
                                                </tr>
						<tr height="364">
							<td width="11" height="394" rowspan="2"><spacer type="block" width="11" height="394"></td>
							<td width="789" height="364" colspan="18" valign="top" align="left" xpos="11">
								<table width="779" border="0" cellspacing="0" cellpadding="0" background="../img/index02/GamesBar_Q!02.gif" cool gridx="16" gridy="16" height="349" showgridx showgridy>
									<tr height="9">
										<td width="778" height="9" colspan="6"></td>
										<td width="1" height="9"><spacer type="block" width="1" height="9"></td>
									</tr>
									<tr height="258">
										<td width="264" height="258" colspan="3"></td>
										<td width="171" height="339" rowspan="2" valign="top" align="left" xpos="264">
											<table width="163" border="0" cellspacing="0" cellpadding="0" background="../img/index02/GameCel_EmptyOtln.gif" cool gridx="16" gridy="16" height="330" showgridx showgridy>
												<tr height="5">
													<td width="6" height="329" rowspan="7"></td>
													<td width="1" height="247" rowspan="5"></td>
													<td width="146" height="5" colspan="2"></td>
													<td width="9" height="42" rowspan="2"></td>
													<td width="1" height="5"><spacer type="block" width="1" height="5"></td>
												</tr>
												<tr height="37">
													<td content csheight="33" width="146" height="37" colspan="2" valign="top" xpos="7">
														<div align="left">
															<font color="white"><b><span class="offerBRONZE">HALF-LIFE 2 BRONZE</span></b></font></div>
													</td>
													<td width="1" height="37"><spacer type="block" width="1" height="37"></td>
												</tr>
												<tr height="11">
													<td width="155" height="11" colspan="3" valign="top" align="left" xpos="7"><img src="../img/index02/rule01.gif" alt="" width="150" height="2" border="0"></td>
													<td width="1" height="11"><spacer type="block" width="1" height="11"></td>
												</tr>
												<tr height="25">
													<td content csheight="25" width="145" height="25" valign="top" xpos="7"><font size="2" color="white"><b><span class="offerPRICE">$49.95<br>
																</span></b></font></td>
													<td width="1" height="25"></td>
													<td width="9" height="194" rowspan="2"></td>
													<td width="1" height="25"><spacer type="block" width="1" height="25"></td>
												</tr>
												<tr height="169">
													<td content csheight="146" width="146" height="169" colspan="2" valign="top" xpos="7">
														<p><span class="statusContent3">INCLUDES:</span><br>
															<span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Half-Life&reg; 2<br>
															<span class="statusContent">&#x25AA; </span>Half-Life&reg; 2: Deathmatch<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Counter-Strike&#153;:<br>
																	Source&#153;</span></font></p>
													</td>
													<td width="1" height="169"><spacer type="block" width="1" height="169"></td>
												</tr>
												<tr height="40">
													<td width="156" height="40" colspan="4" valign="top" align="left" xpos="6"><a href="steam://purchase/9"><img src="../img/index02/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="1" height="40"><spacer type="block" width="1" height="40"></td>
												</tr>
												<tr height="42">
													<td width="156" height="42" colspan="4" valign="top" align="left" xpos="6"><a href="getsteamnow.php"><img src="../img/index02/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="1" height="42"><spacer type="block" width="1" height="42"></td>
												</tr>
												<tr height="1" cntrlrow>
													<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
													<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
													<td width="145" height="1"><spacer type="block" width="145" height="1"></td>
													<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
													<td width="9" height="1"><spacer type="block" width="9" height="1"></td>
													<td width="1" height="1"></td>
												</tr>
											</table>
										</td>
										<td width="170" height="339" rowspan="2" valign="top" align="left" xpos="435">
											<table width="163" border="0" cellspacing="0" cellpadding="0" background="../img/index02/GameCel_EmptyOtln.gif" cool gridx="16" gridy="16" height="330" showgridx showgridy>
												<tr height="5">
													<td width="6" height="329" rowspan="7"></td>
													<td width="1" height="247" rowspan="5"></td>
													<td width="3" height="42" rowspan="2"></td>
													<td width="137" height="5"></td>
													<td width="11" height="42" colspan="2" rowspan="2"></td>
													<td width="4" height="329" rowspan="7"></td>
													<td width="1" height="5"><spacer type="block" width="1" height="5"></td>
												</tr>
												<tr height="37">
													<td content csheight="33" width="137" height="37" valign="top" xpos="10"><font color="white"><b><span class="offerSILVER">HALF-LIFE&nbsp;2 SILVER</span></b></font></td>
													<td width="1" height="37"><spacer type="block" width="1" height="37"></td>
												</tr>
												<tr height="11">
													<td width="151" height="11" colspan="4" valign="top" align="left" xpos="7"><img src="../img/index02/rule01.gif" alt="" width="150" height="2" border="0"></td>
													<td width="1" height="11"><spacer type="block" width="1" height="11"></td>
												</tr>
												<tr height="25">
													<td content csheight="25" width="145" height="25" colspan="3" valign="top" xpos="7"><font size="2" color="white"><b><span class="offerPRICE">$59.95<br>
																</span></b></font></td>
													<td width="6" height="25"></td>
													<td width="1" height="25"><spacer type="block" width="1" height="25"></td>
												</tr>
												<tr height="169">
													<td content csheight="119" width="151" height="169" colspan="4" valign="top" xpos="7">
														<p><span class="statusContent3">INCLUDES:</span><br>
															<span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Half-Life 2<br>
															<span class="statusContent">&#x25AA; </span>Half-Life 2: Deathmatch<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Counter-Strike:&nbsp;Source<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Day of Defeat&#153;:&nbsp;<br>
																	Source*<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent"><b>PLUS:</b> Valve's back catalog available on Steam!<br>
																</span></font></p>
													</td>
													<td width="1" height="169"><spacer type="block" width="1" height="169"></td>
												</tr>
												<tr height="41">
													<td width="152" height="41" colspan="5" valign="top" align="left" xpos="6"><a href="steam://purchase/10"><img src="../img/index02/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="1" height="41"><spacer type="block" width="1" height="41"></td>
												</tr>
												<tr height="41">
													<td width="152" height="41" colspan="5" valign="top" align="left" xpos="6"><a href="getsteamnow.php"><img src="../img/index02/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="1" height="41"><spacer type="block" width="1" height="41"></td>
												</tr>
												<tr height="1" cntrlrow>
													<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
													<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
													<td width="3" height="1"><spacer type="block" width="3" height="1"></td>
													<td width="137" height="1"><spacer type="block" width="137" height="1"></td>
													<td width="5" height="1"><spacer type="block" width="5" height="1"></td>
													<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
													<td width="4" height="1"><spacer type="block" width="4" height="1"></td>
													<td width="1" height="1"></td>
												</tr>
											</table>
										</td>
										<td width="173" height="339" rowspan="2" valign="top" align="left" xpos="605">
											<table width="163" border="0" cellspacing="0" cellpadding="0" background="../img/index02/GameCel_EmptyOtln.gif" cool gridx="16" gridy="16" height="330" showgridx showgridy>
												<tr height="5">
													<td width="7" height="329" rowspan="7"></td>
													<td width="3" height="247" rowspan="5"></td>
													<td width="147" height="5" colspan="2"></td>
													<td width="5" height="42" rowspan="2"></td>
													<td width="1" height="78" rowspan="4"></td>
													<td width="1" height="5"><spacer type="block" width="1" height="5"></td>
												</tr>
												<tr height="37">
													<td content csheight="35" width="147" height="37" colspan="2" valign="top" xpos="10"><font color="white"><b><span class="offerGOLD">HALF-LIFE 2<br>
																	GOLD</span></b></font></td>
													<td width="1" height="37"><spacer type="block" width="1" height="37"></td>
												</tr>
												<tr height="11">
													<td width="152" height="11" colspan="3" valign="top" align="left" xpos="10"><img src="../img/index02/rule01.gif" alt="" width="150" height="2" border="0"></td>
													<td width="1" height="11"><spacer type="block" width="1" height="11"></td>
												</tr>
												<tr height="25">
													<td content csheight="25" width="145" height="25" valign="top" xpos="10"><font size="2" color="white"><b><span class="offerPRICE">$89.95<br>
																</span></b></font></td>
													<td width="7" height="25" colspan="2"></td>
													<td width="1" height="25"><spacer type="block" width="1" height="25"></td>
												</tr>
												<tr height="169">
													<td content csheight="165" width="154" height="169" colspan="5" valign="top" xpos="10">
														<p><span class="statusContent3">INCLUDES:</span><br>
															<span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Half-Life 2<br>
															<span class="statusContent">&#x25AA; </span>Half-Life 2: Deathmatch<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Counter-Strike:Source<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Half-Life 1:&nbsp;Source</span></font><font size="2"><span class="statusContent"><br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Day of Defeat:&nbsp;Source*<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent">Valve's back catalog available on Steam.<br>
																</span></font><span class="statusContent">&#x25AA; </span><font size="2"><span class="statusContent"><b>PLUS:</b>&nbsp;HL2 posters, full strat guide, soundtrack, hat, collector's box, postcard &amp; more</span></font></p>
													</td>
												</tr>
												<tr height="41">
													<td width="150" height="41" colspan="3" valign="top" align="left" xpos="7"><a href="steam://purchase/13"><img src="../img/index02/but_withsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="6" height="82" colspan="2" rowspan="2"></td>
													<td width="1" height="41"><spacer type="block" width="1" height="41"></td>
												</tr>
												<tr height="41">
													<td width="150" height="41" colspan="3" valign="top" align="left" xpos="7"><a href="getsteamnow.php"><img src="../img/index02/but_withoutsteam.gif" alt="" width="150" height="35" border="0"></a></td>
													<td width="1" height="41"><spacer type="block" width="1" height="41"></td>
												</tr>
												<tr height="1" cntrlrow>
													<td width="7" height="1"><spacer type="block" width="7" height="1"></td>
													<td width="3" height="1"><spacer type="block" width="3" height="1"></td>
													<td width="145" height="1"><spacer type="block" width="145" height="1"></td>
													<td width="2" height="1"><spacer type="block" width="2" height="1"></td>
													<td width="5" height="1"><spacer type="block" width="5" height="1"></td>
													<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
													<td width="1" height="1"></td>
												</tr>
											</table>
										</td>
										<!--<td width="1" height="258"><spacer type="block" width="1" height="258"></td>-->
										<td width="1" height="282"><spacer type="block" width="1" height="282"></td>
									</tr>
									<!--<tr height="81">
										<td width="22" height="81"></td>
										<td content csheight="49" width="209" height="81" valign="top" xpos="22">
											<div align="center">
												<p><span class="offerPRICE">PLAY&nbsp;IT&nbsp;NOW.<span class="statusGetTheGamesSubhed"><br>
														</span></span><span class="statusContent"><span><a href="product_HL2bronsilvergold.php">CLICK&nbsp;HERE</a> for more details!</span></span></p>
											</div>
										</td>
										<td width="33" height="81"></td>
										<td width="1" height="81"><spacer type="block" width="1" height="81"></td>
									</tr>
									<tr height="1" cntrlrow>
										<td width="22" height="1"><spacer type="block" width="22" height="1"></td>
										<td width="209" height="1"><spacer type="block" width="209" height="1"></td>
										<td width="33" height="1"><spacer type="block" width="33" height="1"></td>
										<td width="171" height="1"><spacer type="block" width="171" height="1"></td>
										<td width="170" height="1"><spacer type="block" width="170" height="1"></td>
										<td width="173" height="1"><spacer type="block" width="173" height="1"></td>
										<td width="1" height="1"></td>
									</tr>-->
									<tr height="57">
										<td width="130" height="57"></td>
										<td content csheight="49" width="122" height="57" valign="top" xpos="130">
											<div align="left">
												<p><span class="statusGetTheGamesSubhed">ORDER&nbsp;NOW &gt;<br>
													</span><span class="statusGetTheGamesText">Click <a href="product_HL2bronsilvergold.php"><font color="black">here</font></a> for more details. &nbsp;</span></p>
											</div>
										</td>
										<td width="12" height="57"></td>
										<td width="1" height="57"><spacer type="block" width="1" height="57"></td>
									</tr>
									<tr height="1" cntrlrow>
										<td width="130" height="1"><spacer type="block" width="130" height="1"></td>
										<td width="122" height="1"><spacer type="block" width="122" height="1"></td>
										<td width="12" height="1"><spacer type="block" width="12" height="1"></td>
										<td width="171" height="1"><spacer type="block" width="171" height="1"></td>
										<td width="170" height="1"><spacer type="block" width="170" height="1"></td>
										<td width="173" height="1"><spacer type="block" width="173" height="1"></td>
										<td width="1" height="1"></td>
									</tr>
								</table>
							</td>
							<td width="1" height="364"><spacer type="block" width="1" height="364"></td>
						</tr>
						<tr height="30">
							<td width="271" height="30" colspan="6" valign="top" align="left" xpos="11"><img src="../img/index02/Hed_LatestNews.gif" alt="" width="263" height="25" border="0"></td>
							<td width="171" height="239" colspan="5" rowspan="2" valign="top" align="left" xpos="282">
								<table width="164" border="0" cellspacing="0" cellpadding="0" background="../img/index02/CEL_TechSupport.gif" cool gridx="16" gridy="16" height="228" showgridx showgridy>
									<tr height="30">
										<td width="163" height="30" colspan="3"></td>
										<td width="1" height="30"><spacer type="block" width="1" height="30"></td>
									</tr>
									<tr height="197">
										<td width="7" height="197"></td>
										<td content csheight="191" width="149" height="197" valign="top" xpos="7">
											<div class="INDEX02Body">
												<p class="Body"><font size="2" color="white"><span class="statusContent2"><b>Questions, Answers, Etc&#x2026;</b><br>
														</span></font></p>
												<p class="Body"><font size="2"><span class="statusContent">Steam&rsquo;s support pages offer message boards, a list of frequently asked questions, and the Steam Troubleshooter to help identify and resolve any technical support issues you may be experiencing.</span></font></p>
												<p class="Body"><font size="2"><span class="statusContent">&gt; <a href="support.php">visit support now</a> </span></font></p>
											</div>
										</td>
										<td width="7" height="197"></td>
										<td width="1" height="197"><spacer type="block" width="1" height="197"></td>
									</tr>
									<tr height="1" cntrlrow>
										<td width="7" height="1"><spacer type="block" width="7" height="1"></td>
										<td width="149" height="1"><spacer type="block" width="149" height="1"></td>
										<td width="7" height="1"><spacer type="block" width="7" height="1"></td>
										<td width="1" height="1"></td>
									</tr>
								</table>
							</td>
							<td width="167" height="239" colspan="5" rowspan="2" valign="top" align="left" xpos="453">
								<table width="164" border="0" cellspacing="0" cellpadding="0" background="../img/index02/CEL_CyberCafe.gif" cool gridx="16" gridy="16" height="228" showgridx showgridy>
									<tr height="30">
										<td width="163" height="30" colspan="3"></td>
										<td width="1" height="30"><spacer type="block" width="1" height="30"></td>
									</tr>
									<tr height="197">
										<td width="6" height="197"></td>
										<td content csheight="191" width="151" height="197" valign="top" xpos="6">
											<div class="INDEX02Body">
												<p class="Body"><font size="2" color="white"><span class="statusContent2"><b>Games Your Customers Want&#x2026;</b><br>
														</span></font></p>
												<p class="Body"><font size="2"><span class="statusContent">I</span></font><font size="2"><span class="statusContent">f you run a cyber caf&eacute; or gaming venue, Steam makes it easy for you to bring Valve&rsquo;s games to your customers. Over 1000 gaming venues have signed up for Valve&rsquo;s Cyber Caf&eacute; Program.</span></font></p>
												<p class="Body"><font size="2"><span class="statusContent">&gt;&nbsp;<a href="cybercafes.php">find out more now</a></span></font></p>
											</div>
										</td>
										<td width="6" height="197"></td>
										<td width="1" height="197"><spacer type="block" width="1" height="197"></td>
									</tr>
									<tr height="1" cntrlrow>
										<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
										<td width="151" height="1"><spacer type="block" width="151" height="1"></td>
										<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
										<td width="1" height="1"></td>
									</tr>
								</table>
							</td>
							<td width="6" height="239" rowspan="2"><spacer type="block" width="6" height="239"></td>
							<td width="174" height="239" rowspan="2" valign="top" align="left" xpos="626">
								<table width="164" border="0" cellspacing="0" cellpadding="0" background="../img/index02/CEL_GetSteamNow.gif" cool gridx="16" gridy="16" height="228" showgridx showgridy>
									<tr height="29">
										<td width="163" height="29" colspan="3"></td>
										<td width="1" height="29"><spacer type="block" width="1" height="29"></td>
									</tr>
									<tr height="198">
										<td width="6" height="198"></td>
										<td content csheight="191" width="154" height="198" valign="top" xpos="6">
											<div class="INDEX02Body">
												<p class="Body"><font size="2" color="white"><span class="statusContent2"><b>Sign Up and Play Games Today!</b><br>
														</span></font></p>
												<p class="Body"><font size="2"><span class="statusContent">S</span></font><span class="statusContent">tart playing Valve&rsquo;s award-winning games within minutes. With Steam, you'll also get access to an instant messenger, automatic updates, and more. If you don't already have Steam.</span></p>
											</div>
											<p><font size="2"><span class="statusContent">&gt;&nbsp;</span></font><span class="statusContent"><a href="getsteamnow.php">install it now</a></span></p>
										</td>
										<td width="3" height="198"></td>
										<td width="1" height="198"><spacer type="block" width="1" height="198"></td>
									</tr>
									<tr height="1" cntrlrow>
										<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
										<td width="154" height="1"><spacer type="block" width="154" height="1"></td>
										<td width="3" height="1"><spacer type="block" width="3" height="1"></td>
										<td width="1" height="1"></td>
									</tr>
								</table>
							</td>
							<td width="1" height="30"><spacer type="block" width="1" height="30"></td>
						</tr>
						<tr height="209">
							<td width="13" height="209" colspan="2"><spacer type="block" width="13" height="209"></td>
							<td content csheight="198" width="260" height="209" colspan="4" valign="top" xpos="13">
							
							<div style="
								overflow: auto; 
								width: 100%; 
								height: 198px;
								scrollbar-base-color: #4C5844;
								scrollbar-arrow-color: #969F8E;
								padding-right: 5px;
							" class="statusContent">

                                                        {news_index_summary(3)}

							<p align="right"><sub><a href="news.php" style="text-decoration: none;">read more &gt;</a>&nbsp;</sub></p>
							</div>							
							
							</td>
							<td width="9" height="209"><spacer type="block" width="9" height="209"></td>
							<td width="1" height="209"><spacer type="block" width="1" height="209"></td>
						</tr>
						<tr height="1" cntrlrow>
							<td width="11" height="1"><spacer type="block" width="11" height="1"></td>
							<td width="2" height="1"><spacer type="block" width="2" height="1"></td>
							<td width="160" height="1"><spacer type="block" width="160" height="1"></td>
							<td width="28" height="1"><spacer type="block" width="28" height="1"></td>
							<td width="30" height="1"><spacer type="block" width="30" height="1"></td>
							<td width="42" height="1"><spacer type="block" width="42" height="1"></td>
							<td width="9" height="1"><spacer type="block" width="9" height="1"></td>
							<td width="30" height="1"><spacer type="block" width="30" height="1"></td>
							<td width="32" height="1"><spacer type="block" width="32" height="1"></td>
							<td width="66" height="1"><spacer type="block" width="66" height="1"></td>
							<td width="32" height="1"><spacer type="block" width="32" height="1"></td>
							<td width="11" height="1"><spacer type="block" width="11" height="1"></td>
							<td width="34" height="1"><spacer type="block" width="34" height="1"></td>
							<td width="27" height="1"><spacer type="block" width="27" height="1"></td>
							<td width="40" height="1"><spacer type="block" width="40" height="1"></td>
							<td width="30" height="1"><spacer type="block" width="30" height="1"></td>
							<td width="36" height="1"><spacer type="block" width="36" height="1"></td>
							<td width="6" height="1"><spacer type="block" width="6" height="1"></td>
							<td width="174" height="1"><spacer type="block" width="174" height="1"></td>
							<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
						</tr>
					</table>
					<table width="801" border="0" cellspacing="0" cellpadding="0" cool gridx="16" gridy="16" height="104" showgridx showgridy>
						<tr height="11">
							<td width="800" height="11"></td>
							<td width="1" height="11"><spacer type="block" width="1" height="11"></td>
						</tr>
						<tr height="92">
							<td content csheight="92" width="800" height="92" valign="top" xpos="0"><div class="footer">&copy; 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="valvesoftware/privacy.htm">Privacy Policy</a>. <a href="valvesoftware/legal.htm">Legal</a>. <a href="subscriber_agreement.php">Steam Subscriber Agreement</a>.</div>
								<p></p>
								<div align="right">
									<p><img src="../img/index02/creditcardonsteam.gif" alt="" width="279" height="20" border="0"></p>
								</div>
							</td>
							<td width="1" height="92"><spacer type="block" width="1" height="92"></td>
						</tr>
						<tr height="1" cntrlrow>
							<td width="800" height="1"><spacer type="block" width="800" height="1"></td>
							<td width="1" height="1"></td>
						</tr>
					</table>
					<p></p>
				</td>
			</tr>
		</table>
		<div class="footer">
			</div>
	</body>

</html>















