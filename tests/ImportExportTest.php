<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE news (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, author TEXT, publish_date TEXT, publish_at TEXT, content TEXT, products TEXT, views INT, is_official INT, status TEXT)');
$pdo->beginTransaction();
$stmt = $pdo->prepare('INSERT INTO news(title,author,publish_date,publish_at,content,products,views,is_official,status) VALUES(?,?,?,?,?,\'\',0,0,\'published\')');
$stmt->execute(['Test','Admin','2020-01-01','2020-01-01','Body']);
$pdo->commit();
$row = $pdo->query('SELECT title FROM news')->fetchColumn();
assert($row === 'Test');
