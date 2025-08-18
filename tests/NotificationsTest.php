<?php

$pdo = new PDO('sqlite::memory:');
$pdo->exec(
    'CREATE TABLE notifications (id INTEGER PRIMARY KEY AUTOINCREMENT, admin_id INT DEFAULT 0, type TEXT, message TEXT, data TEXT NULL, is_read INT DEFAULT 0, created DATETIME)'
);
$pdo->exec("INSERT INTO notifications(admin_id,type,message) VALUES(0,'info','hello')");
$row = $pdo->query('SELECT type,message FROM notifications')->fetch(PDO::FETCH_ASSOC);
assert($row['type'] === 'info' && $row['message'] === 'hello');
