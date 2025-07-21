<?php
require_once __DIR__ . '/db.php';
$script = $_SERVER['SCRIPT_FILENAME'] ?? __FILE__;
$slug = basename($script, '.php');
$dir = dirname($script);
$lang = basename($dir);
$db = cms_get_db();
$stmt = $db->prepare('SELECT content FROM troubleshooter_pages WHERE lang=? AND slug=?');
$stmt->execute([$lang, $slug]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    echo $row['content'];
    exit;
}
?>
