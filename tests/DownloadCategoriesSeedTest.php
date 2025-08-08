<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE download_pages(version TEXT PRIMARY KEY, years TEXT, content TEXT, created TEXT, updated TEXT)');
$pdo->exec('CREATE TABLE download_links(version TEXT, category TEXT, label TEXT, url TEXT, ord INT)');
$pdo->exec('CREATE TABLE download_categories(id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, file_size TEXT)');
require __DIR__.'/../sql/install_download_pages.php';
$count = $pdo->query('SELECT COUNT(*) FROM download_categories')->fetchColumn();
assert($count > 0);
$unique = $pdo->query('SELECT COUNT(DISTINCT name) FROM download_categories')->fetchColumn();
assert($count === $unique);
?>
