<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE notifications(id INTEGER PRIMARY KEY AUTOINCREMENT, admin_id INT DEFAULT 0, type TEXT, message TEXT, data TEXT, is_read INT DEFAULT 0, created DATETIME)");
$pdo->exec("CREATE TABLE ccafe_registration(id INTEGER PRIMARY KEY AUTOINCREMENT, company TEXT)");
$pdo->exec("CREATE TRIGGER trg_ccafe_registration_notify AFTER INSERT ON ccafe_registration BEGIN INSERT INTO notifications(type,message,admin_id) VALUES('signup', 'New cafe signup: ' || NEW.company, 0); END;");
$pdo->exec("CREATE TABLE import_jobs(id INTEGER PRIMARY KEY AUTOINCREMENT, type TEXT, status TEXT)");
$pdo->exec("CREATE TRIGGER trg_import_jobs_notify AFTER INSERT ON import_jobs WHEN NEW.status <> 'complete' BEGIN INSERT INTO notifications(type,message,admin_id) VALUES('import', 'Import ' || NEW.type || ' pending', 0); END;");
$pdo->exec("CREATE TABLE platform_update_history(id INTEGER PRIMARY KEY AUTOINCREMENT, appid INT, title TEXT, date TEXT, content TEXT)");
$pdo->exec("CREATE TRIGGER trg_platform_update_notify AFTER INSERT ON platform_update_history BEGIN INSERT INTO notifications(type,message,admin_id) VALUES('release', 'Platform update for app ' || NEW.appid, 0); END;");

$pdo->exec("INSERT INTO ccafe_registration(company) VALUES('Test Cafe')");
$pdo->exec("INSERT INTO import_jobs(type,status) VALUES('faq','pending')");
$pdo->exec("INSERT INTO import_jobs(type,status) VALUES('news','complete')");
$pdo->exec("INSERT INTO platform_update_history(appid,title,date,content) VALUES(10,'Update','2024-01-01','fixes')");

$rows = $pdo->query("SELECT type,message,admin_id FROM notifications ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
assert(count($rows) === 3);
assert($rows[0]['type'] === 'signup' && str_contains($rows[0]['message'],'Test Cafe') && $rows[0]['admin_id']===0);
assert($rows[1]['type'] === 'import' && str_contains($rows[1]['message'],'faq') && $rows[1]['admin_id']===0);
assert($rows[2]['type'] === 'release' && str_contains($rows[2]['message'],'10') && $rows[2]['admin_id']===0);
