<?php

$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE store_apps(appid INT PRIMARY KEY, metacritic_url TEXT)');
$pdo->exec("INSERT INTO store_apps(appid,metacritic_url) VALUES(1,'http://example.com')");
$url = $pdo->query('SELECT metacritic_url FROM store_apps WHERE appid=1')->fetchColumn();
assert($url === 'http://example.com');
