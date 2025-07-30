<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE random_content(uniqueid INTEGER PRIMARY KEY AUTOINCREMENT, tag_name TEXT, "group" TEXT, content TEXT)');
$pdo->exec("INSERT INTO random_content(tag_name,\"group\",content) VALUES('a','g1','one'),('b','g1','two'),('c','g2','three')");
$stmt = $pdo->prepare('SELECT content FROM random_content WHERE "group"=?');
$stmt->execute(['g1']);
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
assert(count($rows) === 2);

