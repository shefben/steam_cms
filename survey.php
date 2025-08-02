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
<nobr><a href=""><img align="top" alt="[Valve]" height="54" src="archived_steampowered/2006/v1/img/steam_logo_onblack.gif" width="152"/></a>
<span class="navBar">
<a href="news.php"><img alt="news" height="22" src="archived_steampowered/2006/v1/img/news.gif" width="54"/></a>
<a href="getsteamnow.php"><img alt="getSteamNow" height="22" src="archived_steampowered/2006/v1/img/getSteamNow.gif" width="108"/></a>
<a href="cybercafes.php"><img alt="Cyber Cafes" height="22" src="archived_steampowered/2006/v1/img/cafes.gif" width="95"/></a>
<a href="support.php"><img alt="Support" height="22" src="archived_steampowered/2006/v1/img/support.gif" width="68"/></a>
<a href="forums"><img alt="Forums" height="22" src="archived_steampowered/2006/v1/img/forums.gif" width="68"/></a>
<a href="status/status.html"><img alt="Status" height="22" src="archived_steampowered/2006/v1/img/status.gif" width="65"/></a>
</span>
</nobr>
</div>
<!-- end header -->
<div class="content">
<h1>SURVEY RESULTS</h1>
<?php if ($info): ?>
<span style="float:right;">This survey began on <?php echo date('F jS, Y', strtotime($info['start_date'])); ?>. This page last updated: <?php echo date('g:ia T (H:i GMT), F j Y', strtotime($info['last_updated'])); ?></span>
<b style="color:white;">Unique Samples: <?php echo (int)$info['unique_samples']; ?></b>
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
    $green = (int)round(204 * $row['percentage'] / 100);
    $blank = 204 - $green;
?>
<tr>
<td align="right"><?php echo htmlspecialchars($row['label']); ?>&nbsp;</td>
<td align="right"><?php echo htmlspecialchars(number_format($row['percentage'],2)); ?>%</td>
<td width="204"><img src="archived_steampowered/2006/v1/img/bar_bl.gif" width="<?php echo $blank; ?>" height="8"/> <img src="archived_steampowered/2006/v1/img/bar_gr.gif" width="<?php echo $green; ?>" height="8"/></td>
<td><?php echo (int)$row['count']; ?></td>
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
