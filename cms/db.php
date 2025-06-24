<?php
function cms_get_db(){
    $file = __DIR__ . '/content/cms.sqlite';
    $init = !file_exists($file);
    $db = new PDO('sqlite:' . $file);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($init){
        $db->exec("CREATE TABLE news (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            author TEXT,
            date TEXT,
            views INTEGER DEFAULT 0,
            content TEXT
        )");
    }
    return $db;
}
?>
