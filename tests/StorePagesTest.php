<?php

$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE store_pages(slug TEXT PRIMARY KEY,title TEXT,title_image TEXT)');
$pdo->exec("INSERT INTO store_pages(slug,title,title_image) VALUES('all','All Games','img/title_blue.jpg')");
$row = $pdo->query("SELECT title FROM store_pages WHERE slug='all'")->fetchColumn();
