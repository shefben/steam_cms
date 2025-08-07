<?php

// simple sqlite insert test for storefront tabs
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE storefront_tabs (id INTEGER PRIMARY KEY AUTOINCREMENT, theme TEXT, title TEXT, ord INT)');
$pdo->exec('CREATE TABLE storefront_tab_games (tab_id INT, appid INT, image_path TEXT, ord INT)');
$pdo->prepare('INSERT INTO storefront_tabs(theme,title,ord) VALUES(?,?,?)')->execute(["2007_v2","Test",1]);
$id = $pdo->lastInsertId();
$pdo->prepare('INSERT INTO storefront_tab_games(tab_id,appid,image_path,ord) VALUES(?,?,?,?)')->execute([$id,100,'img.png',1]);
$rows = $pdo->query("SELECT * FROM storefront_tab_games WHERE tab_id=$id")->fetchAll(PDO::FETCH_ASSOC);
assert(count($rows) === 1 && $rows[0]['appid'] == 100);
