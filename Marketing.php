<?php
require_once __DIR__ . '/cms/db.php';
$msgtype = preg_replace('/[^a-z0-9_]/i', '', $_GET['t'] ?? '');
$lang = preg_replace('/[^a-z0-9_]/i', '', $_GET['l'] ?? 'english');
if ($msgtype === '') {
    header('HTTP/1.0 404 Not Found');
    exit('Not found');
}
$db = cms_get_db();
$stmt = $db->prepare('SELECT content FROM marketing WHERE msgtype=? AND language=?');
$stmt->execute([$msgtype, $lang]);
$html = $stmt->fetchColumn();
if (!$html && $lang !== 'english') {
    $stmt->execute([$msgtype, 'english']);
    $html = $stmt->fetchColumn();
}
if (!$html) {
    header('HTTP/1.0 404 Not Found');
    exit('Not found');
}
echo $html;
