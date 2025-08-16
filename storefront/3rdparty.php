<html>

<head>
	<title>Browse Games</title>
	<link rel="stylesheet" type="text/css" href="storefront.css">
	<script language=JavaScript>
	<!--

	//Disable right mouse click Script
	//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
	//For full source code, visit http://www.dynamicdrive.com

	var message="Function Disabled!";

	///////////////////////////////////
	function clickIE4(){
		if (event.button==2){
			return false;
		}
	}

	function clickNS4(e){
		if (document.layers||document.getElementById&&!document.all){
			if (e.which==2||e.which==3){
				return false;
			}
		}
	}

	if (document.layers){
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown=clickNS4;
	}
	else if (document.all&&!document.getElementById){
		document.onmousedown=clickIE4;
	}

	document.oncontextmenu=new Function("return false")
	// -->
	</script>
</head>

<body>

<?php
if (isset($_GET['i'])) {
	$i = $_GET['i'];
}
if (isset($_GET['s'])) {
	$s = $_GET['s'];
}
?>

<table bgcolor="black" width="100%" cellspacing="0">
<tr><td>&nbsp;</td></tr>
<tr>
	<td width="100%" style="border-bottom: 2px Solid #889180;">&nbsp;&nbsp;<!-- spacer / back button --></td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('packs.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
		style="cursor: hand;"
		>GAME PACKAGES</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_enabled"
		onMouseOver="this.style.color='#BDBE52'"
		onMouseOut="this.style.color='white'"
		onClick="window.open('games.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
		style="cursor: hand;"
		>INDIVIDUAL GAMES</td>
	<td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
	<td nowrap class="tab_active">THIRD-PARTY GAMES</td>
	<td nowrap width="20" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
</tr>
</table>
<br>
<div style="max-width:720px;width:720px;text-align:left;">
<b style="font-family:trebuchet ms bold; verdana, arial;font-size:16px;">THE CURRENT <a style="text-decoration:underline;" target="_new" href="/game_stats.html">MOST POPULAR</a> THIRD-PARTY GAMES ON STEAM:</b><br>
</div>
<?php
require_once __DIR__.'/../cms/db.php';
$db = cms_get_db();
$rows = $db->query("SELECT * FROM `0405_storefront_thirdpartGames` WHERE isHidden=0 ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $game): ?>

<!-- begin capsule -->
<div class="capsule3">
        <div class="captop3"><div>&nbsp; &nbsp;
<!-- begin thirdparty game title area -->
<?php echo htmlspecialchars($game['title']); ?>
<!-- end thirdparty game title area -->
</div></div>
        <div class="capcontent">

        <table width="96%">
        <tr>
                <td valign="bottom" height="100%">
<!-- begin thirdparty game thumbnail image area -->
<img src="<?php echo htmlspecialchars($game['image_thumb']); ?>" width="188">
<!-- end thirdparty game thumbnail image area-->
</td>
                <td nowrap>&nbsp;</td>
                <td width="100%">
<!-- begin thirdparty game description area -->
<?php echo htmlspecialchars($game['description']); ?>
<!-- end thirdparty game description area -->
</td>
                <td nowrap>&nbsp;</td>
                <td>

                        <table height="100%" cellspacing="0" cellpadding="0">
                        <tr height="100%">
                                <td><div>
<!-- begin thirdparty game screenshot area -->
<img src="<?php echo htmlspecialchars($game['image_screenshot']); ?>" width="188">
<!-- end thirdparty game screenshot area -->
</div><div></div></td>
                        </tr>
                        <tr>
                                <td align="right">

                                <table cellspacing="0">
                                <tr>
                                        <td height="10"><spacer></spacer></td>
                                </tr>
<!-- begin thirdparty game website button area -->
                                <tr onmouseover="this.style.color='#BDBE52'" onmouseout="this.style.color='white'" onclick="window.open('<?php echo htmlspecialchars($game['websiteUrl']); ?>', '_blank');" style="cursor: pointer; color: white;"><td nowrap class="purchase3">CLICK to VISIT WEBSITE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td nowrap class="purchase4">&nbsp;</td>
                                </tr>
<!-- end thirdparty game website button area -->
                                </table>

                                </td>
                        </tr>
                        </table>

                </td>
        </tr>
        </table>

        </div><!-- end capcontent -->
        <div class="capbot3"><div></div></div>
</div>
<!-- end capsule -->
<?php endforeach; ?>
</body>
</html>