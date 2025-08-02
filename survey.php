<?php
require_once __DIR__.'/cms/db.php';
$db = cms_get_db();
$info = $db->query('SELECT unique_samples,start_date,last_updated FROM survey_info ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
$categories = $db->query('SELECT id,slug,title FROM survey_categories ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<title>Valve Survey Summary</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="no-cache" http-equiv="pragma"/>
<meta content="ALL" name="ROBOTS"/>
<meta content="Valve - Survey Summary Data" name="DESCRIPTION"/>
<meta content="Steam, account, account creation, signup" name="KEYWORDS"/>
<meta content="Valve Corporation" name="AUTHOR"/>
<meta content="300" http-equiv="refresh"/>
<link href="archived_steampowered/2006/v1/steampowered.css" rel="stylesheet" type="text/css"/>
</head>
<style type="text/css">
        BODY    {color:#A0AA95; font-size:8pt;}
        .capsule        { background: #2C3329; width: 100%; margin:8px 0px 8px 0px;}
        .captop div  { background: url(archived_steampowered/2006/v1/img/tl.gif) no-repeat top left; }
        .captop      { background: url(archived_steampowered/2006/v1/img/tr.gif) no-repeat top right; }
        .capbot div  { background: url(archived_steampowered/2006/v1/img/bl.gif) no-repeat bottom left; }
        .capbot      { background: url(archived_steampowered/2006/v1/img/br.gif) no-repeat bottom right; }
        .captop div, .captop, .capbot div, .capbot {
                width: 100%;
                height: 7px;
                font-size: 1px;
                }
        .capcontent  { margin: 0 7px;
                }
        .content         { background:#4C5844;
                padding:8px 0px 32px 0px;
                margin:0px 0px 24px 68px;
                width:856px;
                }
        TABLE {
                margin:0px 0px 0px 0px;
                border:none;
                }
        TD {
                font-size:8pt;
                padding:0px 32px 0px 0px;
                }
        .legend {
                margin:0px 0px 0px 16px;
                padding:4px 4px 4px 4px;
                margin: 0 7px;
                }
        .legendRight {
                float:right;
                text-align:right;
                margin: 4px 7px;
                line-height:18px;
                }
</style>
<body>
<!-- begin header -->
<div class="header">
<nobr><a href="index.php"><img align="top" alt="[Valve]" height="54" src="archived_steampowered/2006/v1/img/steam_logo_onblack.gif" width="152"/></a>
<span class="navBar">
<a href="news.php"><img alt="news" height="22" name="news" onmouseout="this.src='archived_steampowered/2006/v1/img/news.gif';" onmouseover="this.src='archived_steampowered/2006/v1/img/MOnews.gif';" src="archived_steampowered/2006/v1/img/news.gif" valign="bottom" width="54"/></a>
<a href="getsteamnow.php"><img alt="getSteamNow" height="22" onmouseout="this.src='archived_steampowered/2006/v1/img/getSteamNow.gif'" onmouseover="this.src='archived_steampowered/2006/v1/img/MOgetSteamNow.gif'" src="archived_steampowered/2006/v1/img/getSteamNow.gif" valign="bottom" width="108"/></a>
<a href="cybercafes.php"><img alt="Cyber Cafes" height="22" onmouseout="this.src='archived_steampowered/2006/v1/img/cafes.gif'" onmouseover="this.src='archived_steampowered/2006/v1/img/MOcafes.gif'" src="archived_steampowered/2006/v1/img/cafes.gif" valign="bottom" width="95"/></a>
<a href="support.php"><img alt="Support" height="22" onmouseout="this.src='archived_steampowered/2006/v1/img/support.gif'" onmouseover="this.src='archived_steampowered/2006/v1/img/MOsupport.gif'" src="archived_steampowered/2006/v1/img/support.gif" valign="bottom" width="68"/></a>
<a href="forums"><img alt="Forums" height="22" onmouseout="this.src='archived_steampowered/2006/v1/img/forums.gif'" onmouseover="this.src='archived_steampowered/2006/v1/img/MOforums.gif'" src="archived_steampowered/2006/v1/img/forums.gif" valign="bottom" width="68"/></a>
<a href="status/status.html"><img alt="Status" height="22" onmouseout="this.src='archived_steampowered/2006/v1/img/status.gif'" onmouseover="this.src='archived_steampowered/2006/v1/img/MOstatus.gif'" src="archived_steampowered/2006/v1/img/status.gif" valign="bottom" width="65"/></a>
</span>
</nobr>
</div>
<!-- end header -->
<div class="content">
<h1>SURVEY RESULTS</h1>
<?php if ($info): ?>
<span style="float:right;">This survey began on <?php echo date('F jS, Y', strtotime($info['start_date'])); ?>. This page last updated: <?php echo htmlspecialchars($info['last_updated']); ?></span>
<b style="color:white;">Unique Samples: <?php echo number_format((int)$info['unique_samples']); ?></b>
<?php endif; ?>
<?php foreach ($categories as $cat): ?>
<div class="capsule" name="<?php echo htmlspecialchars($cat['slug']); ?>">
<div class="captop"><div></div></div>
<div class="capcontent">
<b style="color:white;"><?php echo htmlspecialchars($cat['title']); ?></b><br/>
<table>
<?php
$stmt = $db->prepare('SELECT label,percentage,count FROM survey_entries WHERE category_id=? ORDER BY ord,id');
$stmt->execute([$cat['id']]);
foreach ($stmt as $row):
    $blips = (int)round($row['percentage']);
?>
<tr>
<td align="right" width="200"><?php echo htmlspecialchars($row['label']); ?></td>
<td align="right" width="32"><?php echo number_format($row['count']); ?></td>
<td align="right" width="64"><?php echo number_format($row['percentage'],2); ?> %</td>
<td align="left" width="400"><?php for ($i=0; $i<$blips; $i++): ?><img alt="#" src="archived_steampowered/2006/v1/blip.png"/><?php endfor; ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>
<div class="capbot"><div></div></div>
</div>
<?php endforeach; ?>
</div>
</body>
</html>
