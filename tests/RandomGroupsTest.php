<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE random_groups(id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT UNIQUE NOT NULL)');
$pdo->exec('CREATE TABLE random_content(uniqueid INTEGER PRIMARY KEY AUTOINCREMENT, tag_name TEXT, group_id INT, content TEXT)');
$pdo->exec("INSERT INTO random_groups(name) VALUES ('g1'),('g2')");
$pdo->exec("INSERT INTO random_content(tag_name,group_id,content) VALUES('a',1,'one'),('b',1,'two'),('c',2,'three')");
$stmt = $pdo->prepare('SELECT c.content FROM random_content c JOIN random_groups g ON c.group_id=g.id WHERE g.name=?');
$stmt->execute(['g1']);
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
assert(count($rows) === 2);

