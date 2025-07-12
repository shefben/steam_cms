#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once __DIR__ . '/../cms/db.php';

$db = cms_get_db();
$stmt = $db->query("SELECT id FROM news WHERE status='scheduled' AND publish_at<=NOW()");
$ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
foreach ($ids as $id) {
    $db->prepare("UPDATE news SET status='published', publish_date=publish_at WHERE id=?")
        ->execute([$id]);
    cms_admin_log('Auto-published news article ' . $id, 0);
}
if (!empty($ids)) {
    echo 'Published ' . count($ids) . " articles\n";
}

