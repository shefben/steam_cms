<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$appid = (int)($_GET['appid'] ?? 0);
$imageid = $_GET['id'] ?? '';

$page_title = 'Missing Screenshot';
$image_path = rtrim(cms_base_url(), '/') . '/images/err1.jpg';
$image_title = 'This image ID does not exist in the list.';

if (!$appid || $imageid === '') {
    $page_title = 'Invalid Request';
    $image_title = 'Invalid Request: Missing ?id= from url.';
} else {
    $stmt = $db->prepare('SELECT name FROM store_apps WHERE appid=?');
    $stmt->execute([$appid]);
    $app = $stmt->fetch(PDO::FETCH_ASSOC);

    $images = [];
    try {
        $rows = cms_get_app_screenshots($appid);
        if ($rows) {
            $images = array_column(array_filter($rows, fn($r) => !$r['hidden']), 'filename');
        }
    } catch (Exception $e) {
        $images = [];
    }
    if (!$images && $app) {
        $stmt = $db->prepare('SELECT images FROM store_apps WHERE appid=?');
        $stmt->execute([$appid]);
        $images = json_decode($stmt->fetchColumn() ?: '[]', true);
    }

    if ($app && in_array($imageid, $images, true)) {
        $page_title = $app['name'];
        $image_path = cms_app_screenshot_url($appid, $imageid);
        $image_title = $app['name'];
    } elseif (is_numeric($appid)) {
        $page_title = 'Missing Screenshot ' . $appid;
    }
}

?><html>

<head>
	<title><?php echo htmlspecialchars($page_title); ?></title>
</head>

<body
	leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0"
	marginwidth="0" marginheight="0"
	bgcolor="#000000" text="#c0c0c0"
>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; height: 100%;">
<tr>
	<td
		width="100%"
		height="100%"
		align="center"
		valign="middle"
	><a href="" onClick="javascript:window.close();"><img src="<?php echo htmlspecialchars($image_path); ?>" title="<?php echo htmlspecialchars($image_title); ?>" alt="<?php echo htmlspecialchars($image_title); ?>" border="0"></a></td>
</tr>
</table>

</body>
</html>
