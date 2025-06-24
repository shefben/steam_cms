<?php
if(!isset($page_title)) $page_title = 'Steam';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="ROBOTS" content="ALL">
    <meta name="DESCRIPTION" content="SteamPowered">
    <meta name="KEYWORDS" content="Steam, account, account creation, signup">
    <meta name="AUTHOR" content="Valve LLC">
    <link rel="stylesheet" type="text/css" href="/steampowered.css">
    <link rel="Shortcut Icon" type="image/png" href="/webicon.png">
    <script language="JavaScript" src="/nav.js"></script>
    <link href="/rss.xml" rel="alternate" type="application/rss+xml" title="Valve RSS News Feed" />
</head>
<body>
<?php
$json = __DIR__ . '/content/header.json';
$header_file = __DIR__ . '/content/header.html';
if(file_exists($json)) {
    $data = json_decode(file_get_contents($json), true);
    if(!$data) $data = [];
    $logo = isset($data['logo']) ? $data['logo'] : '/img/steam_logo_onblack.gif';
    $buttons = isset($data['buttons']) ? $data['buttons'] : [];
    echo "<div class=\"header\"><nobr>";
    echo "<a href=\"/index.php\"><img src=\"".htmlspecialchars($logo)."\" alt=\"[Steam]\" height=\"54\" width=\"152\"></a>";
    echo "<span class=\"navBar\">";
    foreach($buttons as $b) {
        $url = htmlspecialchars($b['url']);
        $img = htmlspecialchars($b['img']);
        $hover = htmlspecialchars($b['hover']);
        $alt = htmlspecialchars($b['alt']);
        echo "<a href=\"$url\"><img valign=\"bottom\" src=\"$img\" onMouseOver=\"this.src='$hover'\" onMouseOut=\"this.src='$img'\" alt=\"$alt\"></a>";
    }
    echo "</span></nobr></div>";
} elseif(file_exists($header_file)) {
    readfile($header_file);
}
?>
