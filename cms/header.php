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
$header_file = __DIR__ . '/content/header.html';
if(file_exists($header_file)) {
    readfile($header_file);
}
?>
