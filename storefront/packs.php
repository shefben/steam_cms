<?php
require_once __DIR__.'/../cms/db.php';
$s = $_GET['s'] ?? '';
$i = $_GET['i'] ?? '';
$packages = cms_get_db()->query("SELECT * FROM `0405_storefront_packages` WHERE isHidden=0 ORDER BY subid")->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
    <title>Browse Games</title>
    <link rel="stylesheet" type="text/css" href="storefront.css">
    <script language="JavaScript">
    // Disable right mouse click
    function clickIE4(){ if (event.button==2){ return false; } }
    function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false; } } }
    if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; }
    else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
    document.oncontextmenu=new Function("return false");
    </script>
</head>
<body>
<table bgcolor="black" width="100%" cellspacing="0">
<tr><td>&nbsp;</td></tr>
<tr>
        <td width="100%" style="border-bottom: 2px Solid #889180;">&nbsp;&nbsp;<!-- spacer / back button --></td>
        <td nowrap class="tab_active">GAME PACKAGES</td>
        <td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
        <td nowrap class="tab_enabled"
                onMouseOver="this.style.color='#BDBE52'"
                onMouseOut="this.style.color='white'"
                onClick="window.open('games.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
                style="cursor: hand;"
                >INDIVIDUAL GAMES</td>
        <td nowrap width="10" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
        <td nowrap class="tab_enabled"
                onMouseOver="this.style.color='#BDBE52'"
                onMouseOut="this.style.color='white'"
                onClick="window.open('3rdparty.php?s=<?php echo $s ?>&i=<?php echo $i ?>&a=&l=english', '_top');"
                style="cursor: hand;"
                >THIRD-PARTY GAMES</td>
        <td nowrap width="20" style="border-bottom: 2px Solid #889180;">&nbsp;</td>
</tr>
</table>
<br>
<?php foreach($packages as $p): ?>
<div class="capsule">
    <div class="captop"><div> &nbsp; &nbsp;
<!-- begin package title area -->
<?php echo htmlspecialchars($p['title']); ?>
<!-- end package title area -->
</div></div>
    <div class="capcontent">
    <table width="96%">
    <tr>
        <td valign="bottom" height="100%" width="177">
<!-- begin package main image area -->
<img src="<?php echo htmlspecialchars($p['image_thumb']); ?>">
<!-- end package main image area -->
</td>
        <td>
<script language="JavaScript" src="/pop.js"></script>
<!-- begin package description area -->
<?php echo htmlspecialchars($p['description']); ?>
<!-- end package description area -->
</td>
        <td align="right">
            <table height="100%" cellspacing="0" cellpadding="0">
            <tr height="100%">
                <td class="pricing2">
<!-- begin package only steam badge OR screenshot area -->
<?php if($p['image_screenshot']): ?>
<img src="<?php echo htmlspecialchars($p['image_screenshot']); ?>">
<?php elseif($p['steamOnlyBadge']): ?>
<br><br><div class="discount" align="right" style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div>
<?php else: ?>&nbsp;<?php endif; ?>
<!-- end package only steam badge OR screenshot area -->
</td>
            </tr>
            <tr>
                <td class="pricing"><div>
                    <table cellspacing="0" width="190">
                    <tr>
                        <td nowrap class="arithmetic">Package price</td>
                        <td nowrap align="right" class="arithmetic">
<!-- begin package price area -->
<?php echo htmlspecialchars($p['price']); ?>
<!-- end package price area -->
</td>
                    </tr>
                    <tr>
                        <td nowrap class="arithmetic" colspan="2" style="border-top: 2px Solid #293021;">FINAL PRICE:<span class="total">
<!-- begin package price area -->
<?php echo htmlspecialchars($p['price']); ?>
<!-- end package price area -->
</span> +TAX+S&amp;H</td>
                    </tr>
<!-- begin package purchase button area -->
                    <tr onmouseover="this.style.color='#BDBE52'" onmouseout="this.style.color='white'" onclick="window.open('steam://purchase/<?php echo $p['subid']; ?>', '_top');" style="cursor: pointer; color: white;">
                        <td nowrap class="purchase5">PURCHASE THIS PACKAGE</td>
                        <td nowrap class="purchase6">&nbsp;</td>
                    </tr>
<!-- end package purchase button area -->
                    </table>
                    </div></td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
    </div><!-- end capcontent -->
    <div class="capbot"><div></div></div>
</div>
<?php endforeach; ?>
</body>
</html>
