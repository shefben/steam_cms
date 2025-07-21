<?php
require_once '../../../cms/db.php';
$db = cms_get_db();
$page = $_POST['f_page'] ?? '';
$lang = $_POST['f_language'] ?? 'en';
$vals = [];
for ($i=1;$i<=10;$i++) {
    $k = 'f_'.$i;
    $vals[$i] = $_POST[$k] ?? null;
}
$stmt = $db->prepare('INSERT INTO support_requests(page,language,f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,created) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,NOW())');
$stmt->execute([$page,$lang,$vals[1],$vals[2],$vals[3],$vals[4],$vals[5],$vals[6],$vals[7],$vals[8],$vals[9],$vals[10]]);
?>
<html>
<head>
	<title>Steam Troubleshooter</title>
	<link href="stylesheet.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="scripts.js"></script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<table class="content_area">
<tr valign="top">
	<td class="content" valign="top">
	<h1>Request Submitted</h1>
	<hr>
    
	<meta http-equiv="REFRESH" content="3; url=s_main.php">
	<p>Thank you for submitting your request. You will now be redirected to the Troubleshooter main page.</p>

	
    
	

	</td>
</tr>
<tr valign="bottom">
	<td class="bottom">
	<hr>
	<p>back | <a href="s_main.php" class="boldlink">Return to the Steam Troubleshooter page</a></p>
    
	</td>
</tr>
</table>

</body>

</html>
