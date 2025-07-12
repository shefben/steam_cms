<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE notifications (id INTEGER PRIMARY KEY AUTOINCREMENT,type TEXT,message TEXT,target_user INT,target_role TEXT,created DATETIME,read_at DATETIME)');
$pdo->exec("INSERT INTO notifications(type,message,target_user) VALUES('info','hello',NULL)");
$row = $pdo->query('SELECT type,message FROM notifications')->fetch(PDO::FETCH_ASSOC);
assert($row['type'] === 'info' && $row['message'] === 'hello');

