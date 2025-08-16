<?php
require_once __DIR__.'/../cms/db.php';
$games = cms_get_db()->query("SELECT * FROM `0405_storefront_games` WHERE isHidden=0 ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
    <title>Browse Games</title>
    <link rel="stylesheet" type="text/css" href="storefront.css">
</head>
<body>
<?php foreach($games as $game): ?>
<div class="capsule">
    <div class="captop"><div> &nbsp; &nbsp;
<!-- start game title area -->
<?php if(preg_match('~^/storefront/images/~',$game['title'])): ?>
<img src="<?php echo htmlspecialchars($game['title']); ?>">
<?php else: ?>
<?php echo htmlspecialchars($game['title']); ?>
<?php endif; ?>
<!-- end game title area -->
</div></div>
    <div class="capcontent">
    <table width="96%">
    <tr>
        <td valign="bottom" height="100%"><!-- start game image area -->
<img src="<?php echo htmlspecialchars($game['image_thumb']); ?>">
<!-- end game image area --></td>
        <td nowrap>&nbsp;</td>
        <td style="padding-left:12px;" width="100%">
<!-- start game description area -->
<?php echo htmlspecialchars($game['description']); ?>
<!-- end game description area -->
</td>
        <td height="100%">
            <table height="100%" cellspacing="0" cellpadding="0">
            <tr height="100%">
                <td><div><!-- start screenshot area -->
<img src="<?php echo htmlspecialchars($game['image_screenshot']); ?>">
<!-- end screenshot area --></div><div></div></td>
            </tr>
            <tr>
                <td>
                <table cellspacing="0" width="100%">
                <tr>
                    <td height="10"><spacer></spacer></td>
                </tr>
<!-- start game purchase button area -->
                <tr onmouseover="this.style.color='#BDBE52'" onmouseout="this.style.color='white'" onclick="window.open('steam://run/<?php echo $game['appid']; ?>', '_top');" style="cursor: pointer; color: white;">
                    <td nowrap class="purchase"><?php echo htmlspecialchars($game['purchaseButtonStr']); ?>&nbsp;</td>
                    <td nowrap class="purchase1">&nbsp;</td>
                </tr>
<!-- end game purchase button area -->
                </table>
                </td>
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
