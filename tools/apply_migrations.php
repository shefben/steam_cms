#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once __DIR__ . '/../cms/db.php';

$db = cms_get_db();
$db->exec("CREATE TABLE IF NOT EXISTS migrations (file VARCHAR(255) PRIMARY KEY, hash VARCHAR(64), applied DATETIME DEFAULT CURRENT_TIMESTAMP)");

$dir = __DIR__ . '/../migrations';
foreach (glob($dir . '/*.sql') as $file) {
    $hash = md5_file($file);
    $name = basename($file);
    $stmt = $db->prepare('SELECT hash FROM migrations WHERE file=?');
    $stmt->execute([$name]);
    $stored = $stmt->fetchColumn();
    if ($stored !== $hash) {
        $sql = file_get_contents($file);
        $db->exec($sql);
        if ($stored === false) {
            $ins = $db->prepare('INSERT INTO migrations(file,hash) VALUES(?,?)');
            $ins->execute([$name,$hash]);
        } else {
            $upd = $db->prepare('UPDATE migrations SET hash=?, applied=CURRENT_TIMESTAMP WHERE file=?');
            $upd->execute([$hash,$name]);
        }
        echo "Applied $name\n";
    }
}
