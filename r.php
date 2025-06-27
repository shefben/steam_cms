<?php
require_once __DIR__.'/cms/db.php';
$slug = trim($_GET['s'] ?? '');
if($slug===''){ header('HTTP/1.0 404 Not Found'); exit('Not found'); }
$db = cms_get_db();
$stmt = $db->prepare('SELECT target FROM redirects WHERE slug=?');
$stmt->execute([$slug]);
$target = $stmt->fetchColumn();
if(!$target){ header('HTTP/1.0 404 Not Found'); exit('Not found'); }
$db->prepare('UPDATE redirects SET hits=hits+1 WHERE slug=?')->execute([$slug]);
header('Location: '.$target, true, 302);
exit;
?>
